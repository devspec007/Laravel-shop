@if ($purchase->due_amount > 0)
            
<form action="{{route('admin.purchase-transaction')}}" method="post" class="submit-form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Due AMount</label>
                        <input type="text" disabled value="{{$purchase->due_amount}}">
                    

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Transaction Date </label>
                        <div class="input-groupicon">
                            <input type="date" class="form-control" name="transaction_date" >
                            
                        </div>
                        <div class="text-danger form-error" id="transaction_date_error"></div>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Total Amount Paid</label>
                        <input type="text" name="amount_paid">
                        <div class="text-danger form-error" id="amount_paid_error"></div>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Payment Type</label>
                        <select class="select" name="payment_type">
                            <option value="">Choose Status</option>
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                        </select>
                        <div class="text-danger form-error" id="payment_type_error"></div>

                    </div>
                </div>
            
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Note</label>
                        <textarea class="form-control" name="note"></textarea>
                        <div class="text-danger form-error" id="note_error"></div>

                    </div>
                </div>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-submit me-2">Submit</button>
                    <a href="{{url('purchaselist')}}" class="btn btn-cancel">Cancel</a>
                </div>
            </div>  
        </div>      
</form>
@endif