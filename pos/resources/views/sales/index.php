<div class="row d-flex box p-1 transaction-container">


    <div class="d-flex justify-content-end mb-4 item_title pt-0 ">
        <strong>Total Sales:&nbsp;</strong>
        <span id="total-sales">0 </span>
    </div>


    <form id="submit_form" class="my-4 d-flex justify-content-between input-form">
        <input type="hidden" id="user_id" name="user_id" value="<?= $data->id ?>">
        <div class="input-group flex-nowrap me-2">
            <select id="items_id" class="form-select" aria-label="Default select example" name="items_id" required>
                <option selected>Select One Of The Items</option>
                <?php foreach ($data->items as $item) {
                    $name = array();
                    if (!in_array($item->item_name, $name) && $item->quantity > 0) {
                        $name[] = $item->item_name; ?>
                        <option value="<?= $item->id ?>"><?= $item->item_name ?></option>
                    <?php  } ?>
                <?php } ?>
            </select>
        </div>

        <div class="input-group flex-nowrap quantitiy-space">
            <input id="quantity" type="number" class="form-control" placeholder="Enter the quantity" aria-describedby="addon-wrapping" min="0" name="quantity" required>

            <button id="add-item" class="btn py-2 pl-0 border-left btn-outline-info">Add</button>
        </div>



    </form>
    <?php if (!empty($_SESSION) && isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>

        <div class='alert alert-danger' role='alert'>
            <?= $_SESSION['error'] ?>
        </div>
    <?php

        $_SESSION['error'] = null;

    endif; ?>

    <div id="dataTableContainer">
        <h2 class="text-center m-auto m-5">Transactions</h2>
        <hr>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="text-center tranaction-id">transaction id</th>
                    <th scope="col" class="text-center item-id"> item id</th>
                    <th scope="col" class="text-center"> item Name</th>
                    <th scope="col" class="text-center"> quantity</th>
                    <th scope="col" class="text-center unit-price"> item price</th>
                    <th scope="col" class="text-center">total</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody id="transaction">

            </tbody>
        </table>

    </div>
</div>