@extends('layouts.app')
@section('content')
@include('admin.menus.adminmenus')
@include('includes.dashboardheader')

<div class="row">
    <div class="col-12">
    <table class="table">
  <thead>
    <tr>
     
      <th scope="col">Item Stocked</th>
      <th scope="col">Stock Quantity</th>
      <th scope="col">Stock Amount</th>
      <th scope="col">Stock Price</th>
      <th scope="col">Sale Price</th>
      <th scope="col">projected Sales</th>
     @if(Auth::user()->fkrole == 2)
      <th scope="col">  <button class="btn btn-block btn-success" data-bs-toggle="modal" data-bs-target="#addstock">Add Stock</button> </th>
    @endif
    </tr>
  </thead>
  <tbody>
      @foreach($stocks as $stock)
    <tr>
      <th >{{$stock->itemstocked}}</th>
      <td>{{$stock->stockquantity}}</td>
      <td>{{$stock->stockamount}}</td>
      <td>{{$stock->stockprice}}</td>
      <td>{{$stock->saleprice}}</td>
      <td>{{$stock->projectedsales}}</td>
    </tr>
    @endforeach
   
  </tbody>
</table>
    </div>
</div>

@endsection

<!----------ADD CAPITAL MODEL---------->
<div class="modal" tabindex="-1" id="addstock">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url('/addstock')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field()}}
            <div class="modal-body">
                    <input class="form-control mb-2" type="text" name="stockitem" id="" placeholder="Enter Stock Item">
                    <input class="form-control mb-2" type="number" name="quantity" id="" min='0' placeholder="Input Stock Quantity">
                    <input class="form-control mb-2" type="number" name="stockprice" id="" min='0' placeholder="Input Stock Price">
                    <input class="form-control mb-2" type="number" name="saleprice" id="" min='0' placeholder="Input Sales Price">
            </div>
            <div class="modal-footer">
            <button class="btn btn-success" type="submit">Add Stock</button>
            </div>
      </form>
    </div>
  </div>
</div>

@include('includes.dashboardfooter')

