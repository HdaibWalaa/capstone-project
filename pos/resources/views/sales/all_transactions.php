<div class="box transaction-div">
    <h1 class="table-title py-5 text-center">All Transactions List (<?= $data->transaction_count ?>)</h1>
    <table class="table ">

        <thead>

            <tr>

                <th scope="col" class="text-center Item-id ">Transaction id</th>
                <th scope="col" class="text-center">Item Name</th>
                <th scope="col" class="text-center">Quantity</th>
                <th scope="col" class="text-center">Total</th>
                <th scope="col" class="text-center created-at">Created at</th>
                <th scope="col" class="text-center updated-at">Updated at</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->transactions as $transaction) :
            ?>
                <tr>
                    <td class="text-center Transaction-id"><a href="/sales/single?id=<?= $transaction->id ?>"><?= $transaction->id ?></td></a>
                    <td class="text-center"><?= $transaction->item_name ?></td>
                    <td class="text-center"><?= $transaction->quantity ?></td>
                    <td class="text-center"><?= $transaction->total ?></td>
                    <td class="text-center created-at"><?= $transaction->created_at ?></td>
                    <td class="text-center updated-at"><?= $transaction->updated_at ?></td>



                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>