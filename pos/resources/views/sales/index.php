    <div class="row d-flex box p-1 transaction-container">


        <div class="d-flex justify-content-end mb-4 item_title pt-0 ">
            <strong>Total Sales:&nbsp;</strong>
            <span id="total-sales">0 </span>
        </div>


        <div class="d-flex flex-wrap" style="width:60%">
            <?php foreach ($data->items as $item) {
                if ($item->quantity > 0) { ?>
                    <div class="card m-3" style="width:150px">
                        <?php if (isset($item->image) && !empty($item->image)) : ?>
                            <img id="card_single" src="./resources/image/<?= $item->image ?>" alt="" width='100px' height='90px' class="mt-3 m-auto">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= $item->item_name ?></h5>
                            <form class="d-flex">
                                <input type="hidden" name="user_id" value="<?= $data->id ?>">
                                <input type="hidden" name="items_id" value="<?= $item->id ?>">
                                <input type="number" class="form-control w-70" placeholder="quan" aria-describedby="addon-wrapping" min="0" name="quantity" required>
                                <button class="btn btn-outline-info ml-2">Add</button>
                            </form>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
        <?php if (!empty($_SESSION) && isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>

            <div class='alert alert-danger' role='alert'>
                <?= $_SESSION['error'] ?>
            </div>
        <?php

            $_SESSION['error'] = null;

        endif; ?>
        <div style="width:40%">
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
                            <th scope="col" class="text-center unit-price"> Unit price</th>
                            <th scope="col" class="text-center">total</th>
                        </tr>
                    </thead>
                    <tbody id="transaction">

                    </tbody>
                </table>

            </div>
        </div>



    </div>
    </div>
