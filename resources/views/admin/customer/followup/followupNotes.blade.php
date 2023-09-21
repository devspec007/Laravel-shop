<div class="text-center">
    <b>Order No.: </b>{{$order->order_number}}
</div>
<table class="table table-bordered table-striped">
  <tbody>
    @foreach($customer_follow as $key => $follow)
    <tr>
      <td>
          <div class="row">
            <div class="col-md-6">
                <b>Note create date </b>
                <br> {{$follow->notes_date}}
            </div>
            <div class="col-md-6">
                <b>Pickup date </b>
                <br> {{$follow->pickup_date?$follow->pickup_date:'N/A'}}
            </div>
          </div>
          <br>
          <b>Notes: </b>{{$follow->notes}}
      </td>
    </tr>
    @endforeach
    @empty($customer_follow)
        <tr>
          <td>No Record Found</td>
        </tr>
    @endempty
  </tbody>
</table>