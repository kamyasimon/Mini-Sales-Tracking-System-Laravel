@extends('layouts.app')
@section('content')
@include('admin.menus.adminmenus')
@include('includes.dashboardheader')

<div class="row">
    <div class="col-12">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">Company</th>
      <th scope="col">Item Sold</th>
      <th scope="col">Quantity Sold</th>
      <th scope="col">Amount sold</th>
      <th scope="col">Cust Name</th>
      <th scope="col">CustNumber</th>
      <th scope="col">Expe Purpose</th>
      
      <th scope="col">Exp Amount</th>
      <th scope="col">Total</th>
      <th scope="col">Order Status</th>
      
     
     
      <th scope="col">  <button class="btn btn-block btn-warning" data-bs-toggle="modal" data-bs-target="#addsale">Sell</button> </th>
    </tr>
  </thead>
  <tbody>
      @foreach($sales as $sale)
    <tr>
    <td>{{$sale->company}}</td>
      <th >{{$sale->itemsold}}</th>
      <td>{{$sale->quantitysold}}</td>
      <td>{{$sale->amountsold}}</td>
      <td>{{$sale->customername}}</td>
      <td>{{$sale->customernumber}}</td>
      <td>{{$sale->expenditure}}</td>
      <td>{{$sale->expenditureamount}}</td>
      <td>{{$sale->totalprice}}</td>
      <td>{{$sale->orderstatus}}</td>
      @if($sale->orderstatus == 'pending')
      <td>
        <a href="{{url('delivered',[$sale->id])}}"> <button class="btn btn-warning">Delivered</button></a>
      </td>
      @elseif($sale->orderstatus == 'delivered')
      <td>
      <a href="{{url('paid',[$sale->id])}}">  <button class="btn btn-success">Paid</button></a>
      </td>
      @elseif($sale->orderstatus == 'paid')
      <td>
        <p>Completed</p>
      </td>
      @endif
     
    </tr>
    @endforeach
   
  </tbody>
</table>
    </div>
</div>

@endsection

<!----------ADD CAPITAL MODEL---------->
<div class="modal" tabindex="-1" id="addsale">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sell Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url('/addsale')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field()}}
            <div class="modal-body">
          <select class="form-control mb-2" name="company" id="">
          <option value="CZNKI">CZNKI</option>
            <option value="GB SACCO">GB SACCO</option>
          </select>

                    <input class="form-control mb-2" type="text" name="itemsold" id="" placeholder="Enter Sold Item">
                    <input class="form-control mb-2" type="number" name="quantitysold" id="" min='0' placeholder="Input Sold Quantity">
                    
                    <input class="form-control mb-2" type="number" name="saleprice" id="" min='0' placeholder="Input Sales Price">
                    <input class="form-control mb-2" type="text" name="expenditure" id="" placeholder="Enter Expenditure Purpose">
                    <input class="form-control mb-2" type="number" name="expenditureamount" id="" min='0' placeholder="Input Expenditure">
            </div>
            <div class="modal-footer">
            <button class="btn btn-success" type="submit">Sell</button>
            </div>
      </form>
    </div>
  </div>
</div>

@include('includes.dashboardfooter')

