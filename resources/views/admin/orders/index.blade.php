@extends('admin.layouts.layout')

@section('content')
<div class="container">
    <h1 class="text-center">Orders List</h1>
    <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal_1" style="font-size: 25px; font-weight: bold; width: 100px; height: 40px; padding: 0" >+</button>
    <hr>
    <div id="warning_validate"></div>
    <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModallLabel" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModallLabel">Add Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="warning_validate_cost"></div>
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
                            <iframe src="http://building-products.loc/getipuser" width="470" height="300"></iframe>
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
                    <button id="validate_order" class="btn btn-primary" data-bs-dismiss="modal">Add Order</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                </div>
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
                    <th>Address_latitude</th>
                    <th>Address_longitude</th>
                    <th>Count</th>
                    <th>Cost</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Geo</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody class="table" style="width: 100%"></tbody>
            </table>
        </div>
    </div>

    <br>


        <div class="modal fade"  tabindex="-1" id="geoModal" aria-labelledby="exampleModalLabell" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabell">Geolocation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="myframee"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        {{csrf_field()}}
                        <!-- hidden id input field -->
                        <input type="hidden" name="id">

                        <div class="form-group">
                            <label for="">Edit Date</label>
                            <input name="edit_date" type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Edit Phone</label>
                            <input name="edit_phone" type="text" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="update" class="btn btn-primary">Update Order</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

