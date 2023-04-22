import { Modal } from 'bootstrap';

$(document).ready(function() {
    //Data Insert Code
    $('#validate_order').click(function(e) {


        var orderVal =  $('input[name="new_order"]').val();
        var dateVal =  $('input[name="new_date"]').val();
        // var phoneVal =  $('input[name="new_phone"]').val();
        var emailVal =  $('input[name="new_email"]').val();
        // var addressVal =  $('input[name="new_address"]').val();
        var countVall =  $('input[name="new_count"]').val();

        if( orderVal === '' || dateVal === ''  || emailVal === ''  || countVall === '' ){
            e.preventDefault();
            displayHtml()
            return false;
        }


        e.preventDefault();

        $.ajax({
            url: "/addOrder",
            type: "post",
            dataType: "json",
            data: $('#myForm').serialize(),
            success: function(response) {
                $('#myForm')[0].reset();
                console.log(response);
                table.ajax.reload();
                // $('#exampleModal_1').modal('hide')
            }
        });
    });

    function displayHtml() {
        $('#warning_validate').html(`<div class="alert alert-warning" id="#alertWhenEmpty" role="alert">All fields must be filled</div>`);
        alertTimeout(3000);
    }

    function alertTimeout(wait){
        setTimeout(function(){
            $('#warning_validate').remove()
        }, wait);
    }








    // Data Display Code
    var table = $('#orders_list').DataTable( {
        order: [[0, 'desc']],
        ajax: "/getOrders",
        columns: [
            { "data": "id" },
            { "data": "orders" },
            { "data": "customer_date",   render: function (data, type, row) {
                    // split the date string into an array
                    var dateParts = data.split('-');
                    // reorder the array to match the desired format
                    var formattedDate = dateParts[2] + '.' + dateParts[1] + '.' + dateParts[0];
                    // return the formatted date
                    return formattedDate;
                } },
            { "data": "customer_phone" },
            { "data": "email" },
            { "data": "address_latitude" },
            { "data": "address_longitude" },
            { "data": "count" },
            { "data": "cost" },
            { "data": "created_at", render: function (data, type, row) {
                    return formatDate(data);
                } },
            { "data": "updated_at", render: function (data, type, row) {
                    return formatDate(data);
                } },
            {
                "data": null,
                render: function(data, type, row) {
                    return `<button  type="button" data-id="${row.id}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#geoModal"  id="getGeo"><i class="fa-solid fa-location-dot"></i></button>`;
                }
            },
            {
                "data": null,
                render: function(data, type, row) {
                    return `<button  type="button" data-id="${row.id}" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" id="edit"><i class="fa-solid fa-pen-to-square"></i></button>`;
                }
            },
            {
                "data": null,
                render: function(data, type, row) {
                    return `<button type="button"  data-id="${row.id}" class="btn btn-danger" id="delete"><i class="fa-solid fa-trash"></i></button>`;
                }
            }
        ]
    } );

    function formatDate(dateString) {
        const dateObj = new Date(dateString);
        const day = dateObj.getDate().toString().padStart(2, '0');
        const month = (dateObj.getMonth() + 1).toString().padStart(2, '0');
        const year = dateObj.getFullYear().toString();

        return `${day}.${month}.${year}`;
    }


    $('#cost_column').on('change', function() {
        var minVal = 3000;
        var currentVal = $(this).val();
        if (currentVal < minVal) {
            displayHtml()
            // alert('Value must be more than or equal to ' + minVal);
            $(this).val(minVal);
        }
        function displayHtml() {
            $('#warning_validate_cost').html(`<div class="alert alert-warning" role="alert">Value must be more than or equal to 3000 </div>`);
        }
    });


    $(document).on('click', '#getGeo', function() {
        var id = $(this).data('id');
        var iframeHtml = '<iframe src="http://building-products.loc/getipuserbyid?id=' + id + '" width="470" height="400"></iframe>';
        $('#myframee').html(iframeHtml);
    });


    // edit city code goes here
    $(document).on('click', '#edit', function() {
        $.ajax({
            url: "/getOrderById",
            type: "get",
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": $(this).data('id')
            },
            success: function(response) {
                 $('input[name="id"]').val(response.data.id);
                // $('input[name="edit_date"]').val(response.data.date);
                $('input[name="edit_phone"]').val(response.data.customer_phone);
            }
        })
    })
    // Update city code goes here
    $(document).on('click', '#update', function() {
        if(confirm('Are you sure you want to update??')) {
            $.ajax({
                url: '/updateOrder',
                type: 'post',
                dataType: 'json',
                data: $('#updateForm').serialize(),
                success: function(response) {
                    $('#updateForm')[0].reset();
                    table.ajax.reload();
                    $('#exampleModal').modal('hide')
                }
            })
        }
    })
    // delete city code goes here
    $(document).on('click', '#delete', function() {
        if(confirm('Are you sure you want delete??')){
            $.ajax({
                url: "/deleteOrderById",
                type: "get",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": $(this).data('id')
                },
                success: function(response) {
                    table.ajax.reload();
                }
            })
        }
    })
});

function showCart(cart) {
    $('#cart-modal .modal-cart-content').html(cart);
    const myModalEl = document.querySelector('#cart-modal');
    const modal = Modal.getOrCreateInstance(myModalEl);
    modal.show();
}


$('#get-cart').on('click', function (e) {
    e.preventDefault();
    // const modalContent = $(this).closest('.modal-cart-content'); // Get the modal content block
    $.ajax({
        url: 'cart/show',
        type: 'GET',
        success: function (res) {
            showCart(res);
           //  modalContent.html(res);
        },
        error: function () {
            alert('Error!');
        }
    });
});

$('#cart-modal .modal-cart-content').on('click', '.del-item', function (e) {
    e.preventDefault();
    const id = $(this).data('id');
    const modalContent = $(this).closest('.modal-cart-content'); // Get the modal content block
    $.ajax({
        url: 'cart/delete',
        type: 'GET',
        data: {id: id},
        beforeSend: function(xhr) {
            console.log(xhr.url); // Print the complete URL to the console
        },
        success: function (res) {
            var countItems = parseInt($(".count-items").text());
            countItems--;
            $(".count-items").text(countItems);
           // showCart(res);
            modalContent.html(res);
        },
        error: function () {
            alert('Error!');
        }
    });
});

$('#cart-modal .modal-cart-content').on('click', '#clear-cart', function () {
    const modalContent = $(this).closest('.modal-cart-content'); // Get the modal content block
    $.ajax({
        url: 'cart/clear',
        type: 'GET',
        success: function (res) {
           // showCart(res);
            $(".count-items").text('0');
            modalContent.html(res);
        },
        error: function () {
            alert('Error!');
        }
    });
});

$('.add-to-cart').on('click', function (e) {
    e.preventDefault();
    const id = $(this).data('id');
    // const qty = $('#input-quantity').val() ? $('#input-quantity').val() : 1;
    //const qty = 1;
    const $this = $(this);

    $.ajax({
        url: 'cart/add',
        type: 'GET',
        data: {id: id},
        success: function (res) {
            var aElement = $(".product-links").find("a[data-id='" + res.id + "']");
            aElement.parent(".product-links").html('<a disabled style="cursor: auto;" ><i class="fa-sharp fa-solid fa-cart-plus" style="font-size: 30px; color: #c0c0c0;"></i></a>');

            var countItems = parseInt($(".count-items").text());
            countItems++;
            $(".count-items").text(countItems);
        },
        error: function () {
            alert('Error!');
        }
    });
});






$(document).on('click', '.input-number-increment', function() {
    // Find the .group div to which that button belongs
    var groupDiv = $(this).closest('.group');

    // Increase its "input" value by one
    var inputValue = parseInt(groupDiv.find('input').val());
    groupDiv.find('input').val(inputValue + 1);



    var totalQty = parseInt($('.cart-qty').text()) + 1;
    $('.cart-qty').text(totalQty);

    const id = $(this).data('id');
    var price = parseInt($('td[data-id="' + id + '"]').text().replace(/\s+/g, ''));

    var totalSum = parseInt($('.cart-sum').text().replace(/\./g, ''), 10);
    var totalSumNew = totalSum + price;
    $('.cart-sum').text(addThousandSeparator(totalSumNew));

});


$(document).on('click', '.input-number-decrement', function() {
    // Find the .group div to which that button belongs
    var groupDiv = $(this).closest('.group');

    // Increase its "input" value by one
    var inputValue = parseInt(groupDiv.find('input').val());
    groupDiv.find('input').val(inputValue - 1);



    var totalQty = parseInt($('.cart-qty').text()) - 1;
    $('.cart-qty').text(totalQty);

    const id = $(this).data('id');
    var price = parseInt($('td[data-id="' + id + '"]').text().replace(/\s+/g, ''));

    var totalSum = parseInt($('.cart-sum').text().replace(/\./g, ''), 10);
    var totalSumNew = totalSum - price;
    $('.cart-sum').text(addThousandSeparator(totalSumNew));

});

function addThousandSeparator(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}



$(document).ready(function() {
    // Add input event listener on text input element
    $(document).on('input', '#txtNumber', function() {

        var phone = $('#txtNumber').val();

        var phoneNumberRegex =/^\+\d+$/;
        if (!phone.match(phoneNumberRegex)) {
            // Show error message
            displayHtml()
            // console.log('hiiii')
            $('#txtNumber').val('+');

        }
    });

    function displayHtml() {
        $('#modalPhoneValidate').html(`<div class="alert alert-warning" id="#alertWhenEmpty" role="alert">Please enter a valid phone number</div>`);
        alertTimeout(2000);
    }

function alertTimeout(wait) {
    setTimeout(function () {
        $('#modalPhoneValidate').html('')
    }, wait);
}

});


$(document).ready(function() {

    $(document).on('click', '#buyBtnn', function(e) {

        var orderVal =  $('#cart_email').val();

        if( orderVal === ''){
            displayHtmlWarning()
            return false;
        }


        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });



        e.preventDefault();

        var tableTitle = [];
        var tableData = [];
        var otherData = [];
        $('.cart-tableBody tr').each(function(index, row) {
            var rowTitle = [];
            var rowData = [];
            // Find the td elements within each row and get their text content
            $(row).find('td.productTitle').each(function(index, cell) {
                rowTitle.push($(cell).text());
            });
            $(row).find('td.cartQnty').each(function(index, cell) {
                rowData.push($(cell).text());
            });
            $(row).find('td.cartSum').each(function(index, cell) {
                rowData.push($(cell).text());
            });


            tableTitle.push(rowTitle);
            tableData.push(rowData);
        });

        const cartPhoneNumber = $('#txtNumber').val()
        const cartEmail = $('#cart_email').val()

        var otherDatas = [];

        otherDatas = [cartPhoneNumber, cartEmail]

        otherData.push(otherDatas);


        tableTitle = tableTitle.filter(function(array) {
            return array.length > 0; // Keep arrays with length greater than 0
        });

        tableData = tableData.filter(function(array) {
            return array.length > 0; // Keep arrays with length greater than 0
        });


        $.ajax({
            url: 'cart/buy',
            type: 'post',
            dataType: 'json',
            data: {
                _token: csrf_token,
                tableTitle: tableTitle,
                tableData: tableData,
                otherData: otherData
            },
            success: function (res) {
                $(".count-items").text('0');
                $('#cart-modal').modal('hide')
                displayHtml(res)
            },
            error: function () {
                alert('Error!');
            }
        });


        function displayHtml(res) {
            $('#successProductsOrder').html(`
<div class="alert alert-success" role="alert" style="position: fixed; top: 200px; width: auto; color: white;">
  ✓ ` + res.message + `
</div>
`);

   alertTimeout(4000);
        }

        function displayHtmlWarning() {
            $('#modalEmailValidate').html(`<div class="alert alert-warning" id="#alertWhenEmpty" role="alert">All fields must be filled</div>`);
            alertTimeout(3000);
        }

        function alertTimeout(wait) {
            setTimeout(function () {
                $('#successProductsOrder').html('')
            }, wait);
        }


    })

})
















