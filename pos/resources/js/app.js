$(function() {

    const items1 = $('#items');
    const quanitiy1 = $('#quantity');
    const addItem = $('#add-item');
    const table = $('#transaction');
    const totalSalesElement = $('#total-sales');
    const baseUrl = "http://pos.local";
    const user_id = $('#user_id').val();
    let totalSales = 0;



    $.ajax({

        type: "GET",
        url: baseUrl + "/transactions",
        success: function(response) {
            response.body.forEach(element => {
                table.append(`
                    <tr data-id=${element.id}>
                        <input type="hidden"  name='id'data-id=id${element.id} value=${element.id}>
                        <td class="text-center">${element.item_name}</td>
                        <input type="hidden" name='pre-quantity' data-id=pre-quantity${element.id} value=${element.quantity}>
                        <td class="text-center"><input  type="number" data-id=input${element.id} name=input${element.id} value=${element.quantity} style="
                        background-color: white;
                        width: 5rem;
                        border: none;
                        background-color: white;" class="text-center"></td>
                        <td name='price_id'data-id=price${element.id} class="text-center unit-price">${element.price}</td>
                        <input type="hidden" name='price'data-id=price${element.id} value=${element.price}>
                        <td data-id=total${element.id} class="text-center">${element.total}</td>
                        <td delete-id=${element.id} class="text-center"><button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></td>
                        </td>
                        </tr>
                    
            `);
                totalSales += element.quantity * element.price;
                totalSalesElement.text(totalSales + "JOD");

                $(`td[delete-id=${element.id}]`).click(function() {
                    $.ajax({
                        type: "DELETE",
                        url: baseUrl + '/transactions/delete',
                        data: JSON.stringify({ id: element.id }),
                        success: function(response) {
                            totalSales -= element.quantity * element.price;
                            totalSalesElement.text(totalSales + "JOD");
                            $(`tr[data-id="${element.id}"]`).remove();
                            swal({
                                title: "Deleted Success",
                                icon: "success",
                                button: "OK",
                            });
                        }
                    });
                })


            });
        }
    });


    $.ajax({
        type: "GET",
        url: baseUrl + "/allitems",
        success: function(data) {
            data.body.forEach((element) => {
                $('#table_item').append(`
                <div class="card m-3" style="width:150px">
                <img id="card_single" src="./resources/image/${element.image}" alt="" width='100px' height='90px' class="mt-3 m-auto">
                <div class="card-body">
                <h5 class="card-title">${element.item_name}</h5>
                <input type="hidden" name="items_id" value="${element.id}">
                <div class="d-flex">
                <input type="number" id="quantity${element.id}" class="form-control w-75" placeholder="qua" aria-describedby="addon-wrapping" min="0" name="quantity" required>
                <button data_id=${element.id} class="btn btn-outline-info p-1 ms-1">Add</button>
                </div>
                </div>
                </div>
                `);

                $(` button[data_id="${element.id}"]`).click(function() {
                    let user_id_input = user_id;
                    let quantity_input = $(`#quantity${element.id}`).val();


                    if (quantity_input > element.quantity) {
                        swal({
                            title: "Exceeded limit",
                            text: "Please Inter The Quantity",
                            icon: "error",
                            button: "OK",
                        });
                        return;
                    }

                    let data = {
                        user_id: user_id_input,
                        items_id: element.id,
                        quantity: quantity_input
                    }
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "/transactions/create",
                        data: JSON.stringify(data),
                        success: function(response) {
                            response.body.forEach(element => {
                                table.append(`
                                    <tr data-id=${element.id}>
                                    <input type="hidden" name='id'data-id=id${element.id} value=${element.id}>
                                    <td class="text-center">${element.item_name}</td>
                                    <input type="hidden" name='pre-quantity' data-id=pre-quantity${element.id} value=${element.quantity}>
                                    <td class="text-center"><input  type="number" data-id=input${element.id} name=input${element.id} value=${element.quantity} style="
                                    background-color: white;
                                    width: 5rem;
                                    border: none;
                                    background-color: white;" class="text-center"></td>
                                    <td name='price_id'data-id=price${element.id} class="text-center unit-price">${element.price}</td>
                                    <input type="hidden" name='price'data-id=price${element.id} value=${element.price}>
                                    <td data-id=total${element.id} class="text-center">${element.total}</td>
                                    <td delete-id=${element.id} class="text-center"><button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></td>
                                    </td>
                                    </tr>
                                `);

                                totalSales += element.quantity * element.price;
                                totalSalesElement.text(totalSales + "JOD");

                                $(`td[delete-id=${element.id}]`).click(function() {
                                    $.ajax({
                                        type: "DELETE",
                                        url: baseUrl + '/transactions/delete',
                                        data: JSON.stringify({ id: element.id }),
                                        success: function(response) {
                                            totalSales -= element.quantity * element.price;
                                            totalSalesElement.text(totalSales + "JOD");
                                            $(`tr[data-id="${element.id}"]`).remove();
                                            swal({
                                                title: "Deleted Success",
                                                icon: "success",
                                                button: "OK",
                                            });
                                        }
                                    });
                                })

                            });
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                });
            })
        }
    })
});
