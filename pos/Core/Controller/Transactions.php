<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\Item;
use Core\Model\Transaction;


class Transactions extends Controller
{

        protected $request_body;
        protected $http_code = 200;

        protected $response_schema = array(
                "success" => true,
                "message_code" => "",
                "body" => []
        );
        /*
        *this method will directly make response from method to json object to send it to html page
        * 
        */
        public function render()
        {
                //we should change the content type as json type
                header("Content-Type: application/json");
                //control the http_response conde depend on response
                http_response_code($this->http_code);
                //we should encode the response to be acceptable to see it in html page
                echo json_encode($this->response_schema);
        }
        /** 
         *this method will automatically make request body json_decode to make it php object to use it 
         * 
         */
        function __construct()
        {

                $this->request_body = (array) json_decode(file_get_contents("php://input"));
        }

        /** 
         *fetch all transactions that meet the conditions
         * 
         */
        public function index()
        {
                try {
                        // make instance of transaction model to call with db
                        $transaction = new Transaction;

                        //we will fetch the data that belongs to user from table users_transactions(here we prapare the sql statment)
                        $stmt = $transaction->connection->prepare("SELECT *from users_transactions WHERE user_id=?");

                        // bind the parameter
                        $stmt->bind_param('i', $_SESSION['user']['user_id']);

                        // execute the statement on the DB
                        $stmt->execute();

                        // get the result of the execution 
                        $transaction_query = $stmt->get_result();
                        $stmt->close();

                        //assign variable to put inside the object that i need which is the transaction_id and user_id 
                        $transaction_user = array();

                        //fetche the result 
                        if ($transaction_query->num_rows > 0) {
                                while ($row = $transaction_query->fetch_object()) {
                                        $transaction_user[] = $row;
                                }
                        }

                        //assgin variable to put inside the transactions 
                        $transactions = array();

                        //now i have the id of transactions now i need to fetch all information of transactions in transactions table
                        foreach ($transaction_user as $relation) {

                                //we make the sql statement with condition that created tody
                                $sql = "SELECT *FROM transactions WHERE id= {$relation->transaction_id}";
                                $transaction_query_conditions = $transaction->connection->query($sql);
                                if ($transaction_query_conditions->num_rows > 0) {
                                        while ($row = $transaction_query_conditions->fetch_object()) {
                                                $transactions[] = $row;
                                        }
                                }
                        }

                        //we use try and catch to handle errors 
                        if (empty($transactions)) {
                                throw new \Exception('No transactions were found!');
                        }

                        //reassign the response_schema['body'] to the data i need
                        $this->response_schema['body'] = $transactions;

                        //reassgin the response_schema['message_code'] with massage i need
                        $this->response_schema['message_code'] = "transactions_collected_successfuly";
                } catch (\Exception $error) {
                        //if i have error will  false and massage code of error
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();
                        $this->http_code = 404;
                }
        }


        /**
         * GET THE ALL ITEMS
         * 
         * @return array
         */
        public function get_item()
        {
                try {
                        $stock = new Item;
                        $result = $stock->get_all();
                        if (!$result) {
                                $this->http_code = 404;
                                throw new \Exception("Sql_response_error");
                        } else {
                                $this->response_schema['body'] = $result;
                                $this->response_schema['message_code'] = "items_collected_successfully";
                        }
                } catch (\Exception $error) {
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();
                }
        }

        /**
         * create new transaction
         * 
         */

        public function create()
        {

                try {
                        // make new instance of item to call with database
                        $item = new Item;
                        //this variable will have the item that choosen in form 
                        $selected_item = $item->get_by_id($this->request_body['items_id']);
                        //check if selected item empty or not
                        if (empty($selected_item)) {
                                throw new \Exception('No item was found!');
                        }

                        //make new instance of trnasaction model
                        $transaction = new Transaction;

                        //assign value for total by multiply the quantity of request body and price of selected item
                        $total = ($this->request_body['quantity']) * ($selected_item->selling_price);



                        //assgin value of column of transaction 
                        $value = array(
                                "items_id" => $this->request_body['items_id'],
                                "item_name" => $selected_item->item_name,
                                "quantity" => $this->request_body['quantity'],
                                "price" => $selected_item->selling_price,
                                "cost" => $selected_item->cost,
                                "total" => $total
                        );

                        $request_item_id = $this->request_body['items_id'];
                        //if stock more than the request body quantity
                        if ($selected_item->quantity - $this->request_body['quantity'] >= '0') {

                                //we need to change the quantity of stock depend on the quantity i put it
                                $selected_item->quantity = $selected_item->quantity - $this->request_body['quantity'];
                                $new_quantity = $selected_item->quantity;

                                //update the quantity of stock
                                //prepare the sql statment
                                $stmt = $transaction->connection->prepare("UPDATE items SET quantity =?  WHERE id=?");

                                //bind the param
                                $stmt->bind_param('ii', $new_quantity, $request_item_id);

                                //execute the statement
                                $stmt->execute();

                                // get the result of the execution
                                $result = $stmt->get_result();

                                $stmt->close();
                        } else {
                                //if the request quantity more than request
                                $_SESSION['error'] = "there is no enough quantity in stock";

                                die;
                        }

                        //now we create the transaction on the db
                        $transaction->create($value);
                        if (empty($transaction)) {
                                throw new \Exception('No item was creat!');
                        }

                        //we need to fetch the last transaction to put it in front when create the transacstion
                        $transaction_id = $transaction->connection->insert_id;

                        //we should to insert the user id in users_transaction table
                        $user_id = $this->request_body['user_id'];

                        //reassign the  $this->response_schema['body']
                        $this->response_schema['body'][] = $transaction->get_by_id($transaction_id);
                        $this->response_schema['message_code'] = "transaction_collected_successfuly";

                        //prepare sql statement to insert the user_id and transaction_id in users_transactions table
                        $stmt2 = $transaction->connection->prepare("INSERT INTO users_transactions (user_id, transaction_id) VALUES (?,?)");

                        //bind the parameter
                        $stmt2->bind_param('ii', $user_id, $transaction_id);

                        //execute the statement
                        $stmt2->execute();

                        // get the result of the execution
                        $result2 = $stmt2->get_result();
                        $stmt2->close();
                } catch (\Exception $error) {
                        //if there is an error in previous if statement
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();
                        $this->http_code = 404;
                }
        }

        /**
         * DELETE THE TRANSACTION
         * 
         * @return void
         */
        public function delete()
        {
                try {
                        $Transaction = new Transaction;
                        if (!isset($this->request_body['id'])) {
                                $this->http_code = 422;
                                throw new \Exception("id_param_not_found");
                        }

                        if (!$Transaction->connection->query("DELETE FROM users_transactions WHERE transaction_id={$this->request_body['id']}")) {
                                $this->http_code = 500;
                                throw new \Exception("item_was_not_deleted");
                        }

                        $stmt = $Transaction->connection->prepare("DELETE FROM users_transactions WHERE transaction_id=?");
                        $stmt->bind_param('i', $this->request_body['id']);
                        if (!$stmt->execute()) {
                                $this->http_code = 500;
                                throw new \Exception("item_was_not_deleted");
                        }
                        $stmt->close();

                        $stmt = $Transaction->connection->prepare("DELETE FROM transactions WHERE id=?");
                        $stmt->bind_param('i', $this->request_body['id']);
                        if (!$stmt->execute()) {
                                $this->http_code = 500;
                                throw new \Exception("item_was_not_deleted");
                        }
                        $stmt->close();

                        $this->response_schema['message_code'] = "item_deleted";
                } catch (\Exception $error) {
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();
                }
        }
}
