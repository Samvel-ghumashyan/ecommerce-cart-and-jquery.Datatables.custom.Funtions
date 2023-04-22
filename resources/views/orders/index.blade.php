<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    @vite(['resources/front/css/front_index.css', 'resources/js/app.js'])
</head>
<body>
<div class="container">
    <h1 class="text-center">Orders List</h1>
    <button  class="btn btn-success" data-toggle="modal" data-target="#exampleModal_1" style="font-size: 25px; font-weight: bold; width: 100px; height: 40px; padding: 0" >+</button>
    <hr>
    <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModallLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModallLabel">Add Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="warning_validate_cost"></div>
                    <div id="warning_validate"></div>
                    <form id="myForm">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Order</label>
                            <input type="text" name="new_order" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" name="new_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="number" name="new_phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="new_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="new_address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Count</label>
                            <input type="number" name="new_count" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Cost</label>
                            <input id="cost_column" type="number" name="new_cost" class="form-control" value="3000">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="validate_order" class="btn btn-primary submitt ">Add Order</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div style="width: 100%">
        <div class="table-responsive" style="width: 100%">
            <table id="orders_list" class="table select table-bordered hover order-column stripe" style="width: 100%">
                <thead style="width: 100%">
                <tr style="width: 100%">
                    <th>Id</th>
                    <th>Products</th>
                    <th>Date</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Count</th>
                    <th>Cost</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody class="table" style="width: 100%"></tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        {{csrf_field()}}
                        <!-- hidden id input field -->
                        <input type="hidden" name="id">

                        <div class="form-group">
                            <label for="">Edit Date</label>
                            <input name="edit_date" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Edit Phone</label>
                            <input name="edit_phone" type="text" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="update" class="btn btn-primary">Update Order</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script>
    $('#validate_order').click(function() {
        var orderVal =  $('input[name="new_order"]').val();
        var dateVal =  $('input[name="new_date"]').val();
        var phoneVal =  $('input[name="new_phone"]').val();
        var emailVal =  $('input[name="new_email"]').val();
        var addressVal =  $('input[name="new_address"]').val();
        var countVall =  $('input[name="new_count"]').val();
        if( orderVal === '' || dateVal === '' || phoneVal === '' || emailVal === '' || addressVal === '' || countVall === '' ){
            displayHtml()
        }

        function displayHtml() {
            $('#warning_validate').html(`<div class="alert alert-warning" role="alert">All fields must be filled</div>`);
        }
    });

    $(document).ready(function() {
        //Data Insert Code
        $('.submitt').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ url('addOrder') }}",
                type: "post",
                dataType: "json",
                data: $('#myForm').serialize(),
                success: function(response) {
                    $('#myForm')[0].reset();
                    console.log(response);
                    table.ajax.reload();
                    $('#exampleModal_1').modal('hide')
                }
            });
        });
        // Data Display Code
        var table = $('#orders_list').DataTable( {
            order: [[0, 'desc']],
            ajax: "{{ url('getOrders') }}",
            columns: [
                { "data": "id" },
                { "data": "orders" },
                { "data": "date", render: function (data, type, row) {
                        return moment(new Date(data).toString()).format('DD.MM.YYYY');
                    }},
                { "data": "phone" },
                { "data": "email" },
                { "data": "address" },
                { "data": "count" },
                { "data": "cost" },
                { "data": "created_at", render: function (data, type, row) {
                        return moment(new Date(data).toString()).format('DD.MM.YYYY');
                    }},
                { "data": "updated_at", render: function (data, type, row) {
                        return moment(new Date(data).toString()).format('DD.MM.YYYY');
                    } },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return `<button data-id="${row.id}" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" id="edit"><i class="fa fa-edit"></i></button>`;
                    }
                },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return `<button data-id="${row.id}" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i></button>`;
                    }
                }
            ]
        } );


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



        // edit city code goes here
        $(document).on('click', '#edit', function() {
            $.ajax({
                url: "{{ url('getOrderById') }}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": $(this).data('id')
                },
                success: function(response) {
                    $('input[name="id"]').val(response.data.id);
                    $('input[name="edit_date"]').val(response.data.date);
                    $('input[name="edit_phone"]').val(response.data.phone);
                }
            })
        })
        // Update city code goes here
        $(document).on('click', '#update', function() {
            if(confirm('Are you sure you want to update??')) {
                $.ajax({
                    url: '{{ url("updateOrder") }}',
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
                    url: "{{ url('deleteOrderById') }}",
                    type: "post",
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
</script>
</body>
</html>
