@extends('layouts.app')
@section('content')
@include('admin.menus.adminmenus')
@include('includes.dashboardheader')

<div class="row">
    <div class="col-12">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">Customer Name</th>
    <th scope="col">Customer Number</th>
      <th scope="col">Product Description</th>
     
      <th scope="col">  <button class="btn btn-block btn-warning" data-bs-toggle="modal" data-bs-target="#addbooking">Book Item</button> </th>
    </tr>
  </thead>
  <tbody>
      @foreach($bookings as $booking)
    <tr>
    <td>{{$booking->customername}}</td>
      <th>{{$booking->customernumber}}</th>
      <td>{{$booking->productdescription}}</td>
    </tr>
    @endforeach
   
  </tbody>
</table>
    </div>
</div>

@endsection

<!----------ADD CAPITAL MODEL---------->
<div class="modal" tabindex="-1" id="addbooking">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sell Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url('/addbooking')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field()}}
            <div class="modal-body">
         

                    <input class="form-control mb-2" type="text" name="customername" id="" placeholder="Enter Customer Name">
                    <input class="form-control mb-2" type="text" name="customernumber" id="" placeholder="Enter Customer Contact">
                    <textarea class="form-control mb-2" name="productdescription" id="" cols="30" rows="10" placeholder="Enter Product Description"></textarea>
                     </div>
            <div class="modal-footer">
            <button class="btn btn-success" type="submit">Book</button>
            </div>
      </form>
    </div>
  </div>
</div>

@include('includes.dashboardfooter')

