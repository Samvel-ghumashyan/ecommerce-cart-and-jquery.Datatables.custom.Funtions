                <div class="modal-body">
                    @if(!empty(session('cart')))
                        <div class="table-responsive">
                            <table id="cartTable" class="table text-start">
                                <thead>
                                <tr>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col"><i class="far fa-trash-alt"></i></th>
                                </tr>
                                </thead>
                                <tbody class="cart-tableBody">
                                @foreach(session('cart') as $id => $item)
                                    <tr>
                                        <td>
                                            <a href="#"><img src="{{ asset('uploads/' . ($item['img'] ?? '')) }}" style="width: 100px;" alt=""></a>
                                        </td>
                                        <td class="productTitle">{{$item['title'] ?? ''}}</td>
                                        <td>

{{--                                            <input id="qty_input" data-id="{{$id}}" type="number" value="{{$item['qty'] ?? ''}}" min="1"  step="1">--}}
                                            <div class="group">

                                                <div class="input-number" min="1" max="10">
                                                    <input type="text" value="1" />
                                                    <button class="input-number-increment" data-id="{{$id}}" data-increment></button>
                                                    <button class="input-number-decrement" data-id="{{$id}}" data-decrement></button>
                                                </div>

                                            </div>
                                        </td>
                                        <td data-id="{{$id}}">{{$item['price'] ?? ''}}</td>
                                        <td><a  data-id="{{$id}}" class="del-item"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-end">Cart quantity</td>
                                    <td class="cart-qty cartQnty">{{session('qnty')}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Cost</td>
                                    <td class="cart-sum cartSum">{{session('summ')}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h4 class="text-start">Empty Cart</h4>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if(!empty(session('cart')))
                        <button type="button" class="btn btn-primary" id="buyBtnn">Buy</button>
                        <button type="button" id="clear-cart" class="btn btn-danger">Clear Cart</button>
                    @endif
                </div>

                <div class="modal-body" style="background-color: #bcbcbc">
                <form id="cartForm">
                    <label for="txtNumber">Phone Number:</label>
                    <input id="txtNumber"  name="txtNumber"  type="tex" value="+"/>

                    <label for="email">Email:</label>
                    <input id="cart_email" type="email" name="email"  />
                </form>
                    <div id="modalPhoneValidate"></div>
                    <div id="modalEmailValidate"></div>
                </div>
