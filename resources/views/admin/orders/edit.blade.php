
  
    @if(($order->payment_type != 'cod' && $order->status) || ($order->payment_type == 'cod'))
  
        @if($order->approved_status == 'pending')
            <form action="{{route('admin.orders.edit',$order->id)}}?type=approved_status" method="get" class="submit-form">
                <div class="card">
                    <div class="card-header">
                        Admin Approved Reject Order
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                        <textarea class="form-control" id="reason" name="reason">{{$order->reject_reason}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                        <select class="form-control update-order-status" name="status">
                                                <option value="pending" {{($order->approved_status == 'pending' ? 'selected' : "")}}>Pending</option>
                                                <option value="rejected" {{($order->approved_status == 'rejected' ? 'selected' : "")}}>Reject</option>
                                                <option value="approved" {{($order->approved_status == 'approved' ? 'selected' : "")}}>Approved</option>
                                            </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
        @if($order->approved_status == 'approved')
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-3">Admin Update Order and Payment Status</h6>
    
                </div>
                <div class="card-body">
                    <form action="{{route('admin.orders.edit',$order->id)}}?type=order_status" method="get" class="submit-form">
                        
                        <div class="row">

                            <div class="col-md-12">
                                <lable>Reason</lable>

                                <div class="form-group">
                                    <textarea name="cancel_reason" class="form-control">{{$order->cancel_reason}}</textarea>
                                </div>
                            </div>
                        
                            <div class="col-md-4">
                                <lable>Order Status</lable>

                                <div class="form-group">
                                        <select class="form-control update-order-status" name="status">
                                                <option value="pending" {{($order->order_status == 'pending' ? 'selected' : "")}}>Pending</option>
                                    <option value="confirmed" {{($order->order_status == 'confirmed' ? 'selected' : "")}}>Confirmed</option>
                                    <option value="cancelled" {{($order->order_status == 'cancelled' ? 'selected' : "")}}>Cancelled</option>
                                    <option value="shipped" {{($order->order_status == 'shipped' ? 'selected' : "")}}>Shipped</option>
                                    <option value="delivered" {{($order->order_status == 'delivered' ? 'selected' : "")}}>Delivered</option>
                                            </select>
                                </div>
                            </div>

                            <div class="col-md-4 hcr1 hide_cancel_reason_1">
                                <lable>Order Cancelled Reason</lable>
                                <div class="form-group ">
                                        <select class="form-control hcrr1" name="order_status_type">
                                                <option value="cancel" {{($order->order_status_type == 'cancel' ? 'selected' : "")}}>Cancel</option>
                                                <option value="reorder" {{($order->order_status_type == 'reorder' ? 'selected' : "")}}>Reorder</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-4 hcr2 hide_cancel_reason_2">
                                <lable>Cancelled Reason</lable>
                                <div class="form-group">
                                        <select class="form-control hcrr2" name="order_cancel_reason">
                                                <option value="item_damaged_fully" {{($order->order_cancel_reason == 'item_damaged_fully' ? 'selected' : "")}}>Item Damaged Fully</option>
                                                <option value="item_damaged_partially" {{($order->order_cancel_reason == 'item_damaged_partially' ? 'selected' : "")}}>Item Damaged Partially</option>
                                                <option value="item_mismatched" {{($order->order_cancel_reason == 'item_mismatched' ? 'selected' : "")}}>Item Mismatched</option>
                                                <option value="cancel_by_customer" {{($order->order_cancel_reason == 'cancel_by_customer' ? 'selected' : "")}}>Cancelled by customer</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-4 hcr3 hide_cancel_reason_3">
                                <lable>Reorder Reason</lable>
                                <div class="form-group">
                                        <select class="form-control hcrr3" name="reorder_status">
                                                <option value="item_damaged" {{($order->reorder_status == 'item_damaged' ? 'selected' : "")}}>Item Damaged</option>
                                                <option value="item_mismatched" {{($order->reorder_status == 'item_mismatched' ? 'selected' : "")}}>Item Mismatched</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <lable>Payment Status</lable>

                                <div class="form-group">
                                    <select class="form-control update-payment-status" name="payment_status">
                                        <option value="paid" {{($order->status == 'paid' ? 'selected' : "")}}>Complete</option>
                                        <option value="pending" {{($order->status == 'pending' ? 'selected' : "")}}>Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <lable>Payment Collection</lable>

                                <div class="form-group">
                                    <select class="form-control collection_type" name="collection_type">
                                        <option value="">Select Payment Collection</option>
                                        <option value="account" {{($order->collection_type == 'account' ? 'selected' : "")}}>Company Account</option>
                                        <option value="cash" {{($order->collection_type == 'cash' ? 'selected' : "")}}>Cash</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-3">Reject Reason</h6>
    
                </div>
                <div class="card-body">
                    <p><strong>Reject Reason : {{$order->reject_reason}}</strong></p>
                </div>
            </div>
        @endif
        @endif
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-3"><strong>Transit Order Status admin</strong></h6>
                </div>
                <div class="card-body">
                <form action="{{route('admin.orders.edit',$order->id)}}?type=transit_status" method="get" class="submit-form">
                            <div class="row">
                                    <div class="col-md-12">
                                        <lable>Transit/Transfer Status</lable>
                                        <div class="form-group">
                                            <select class="form-control update-order-status" name="order_transfer_status">
                                                @foreach (transitStatus() as $key =>$item)
                                                    
                                                <option value="{{$key}}" {{($order->order_transfer_status == $key ? 'selected' : "")}}>{{$item['name']}}</option>
                                                @endforeach
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                    </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
</div>
