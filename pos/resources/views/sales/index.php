<div class="row d-flex box p-1 transaction-container">


    <div class="d-flex justify-content-end mb-4 item_title pt-0 ">
        <strong>Total Sales:&nbsp;</strong>
        <span id="total-sales">0</span>
    </div>

    <input type="hidden" id="user_id" value="<?= $_SESSION['user']['user_id'] ?>">


    <div id="table_item" class="d-flex flex-wrap" style="width:60%">
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
                        <th scope="col" class="text-center"> item Name</th>
                        <th scope="col" class="text-center"> quantity</th>
                        <th scope="col" class="text-center unit-price"> Unit price</th>
                        <th scope="col" class="text-center">total</th>
                        <th scope="col" class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody id="transaction">

                </tbody>
            </table>

        </div>
    </div>



</div>
</div>
