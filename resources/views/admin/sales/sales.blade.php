@extends('layouts.app')
@section('content')
@include('admin.menus.adminmenus')
@include('includes.dashboardheader')

@if(Auth::user()->fkrole == 2)
<div class="row">
    <div class="col-12 d-flex justify-content-end">
      <button class="btn btn-block btn-warning" data-bs-toggle="modal" data-bs-target="#addsale">Sell</button>
     </div>
</div>
@endif
<div class="row" >
    <div class="col-12">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">Company</th>
      <th scope="col">Item Sold</th>
      <th scope="col">Stock Key</th>
      <th scope="col">Quantity Sold</th>
      <th scope="col">Amount sold</th>
      <th scope="col">Expe Purpose</th>
      
      <th scope="col">Exp Amount</th>
      <th scope="col">Total</th>
      <th scope="col">Order Status</th>
      
     
    
    </tr>
  </thead>
  <tbody>
      @foreach($sales as $sale)
    <tr>
    <td>
      @if($sale->handedover == false )
     <a href="{{url('handedover',[$sale->id])}}" style="color:red !important"> {{$sale->Companies->companyname}}</a>
    @elseif($sale->handedover == true )
    <p style="color:purple !important">{{$sale->Companies->companyname}}: <strong> Received<strong></p>
    @endif
    </td>
      <td>{{$sale->Products->productname}}</td>
      <td>{{$sale->stockid}}</td>
      <td>{{$sale->quantitysold}}</td>
      <td>{{$sale->amountsold}}</td>
      <td>{{$sale->expenditure}}</td>
      <td>{{$sale->expenditureamount}}</td>
      <td>{{$sale->totalprice}}</td>
      <td>{{$sale->orderstatus}}</td>
     
      @if($sale->orderstatus == 'pending' && Auth::user()->fkrole == 2)
      <td>
        <a href="{{url('delivered',[$sale->id])}}"> <button class="btn btn-warning">Delivered</button></a>
      </td>
      @elseif($sale->orderstatus == 'delivered' && Auth::user()->fkrole == 2)
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
            <option value="">Select Company</option>
            @foreach($companies as $company)
          <option value="{{$company->id}}">{{$company->companyname}}</option>
           
            @endforeach
          </select>

          <select class="form-control mb-2" name="product" >
                <option value="">Select Product</option>
                @foreach($products as $product)
               
                <option value="{{$product->id}}">{{$product->productname}} </option>
                @endforeach
              </select>
              <select class="form-control mb-2" name="batch" id="">
                <option value="">Select Batch</option>
                @foreach($batches as $batch)
               
                <option value="{{$batch->id}}">{{$batch->batch}}</option>
                @endforeach
              </select>
              <select class="form-control mb-2" name="stockid" id="">
                <option value="">Select Stock</option>
                @foreach($stocks as $stock)
               @if($stock->availablestock > 0)
                <option value="{{$stock->stockid}}">{{$stock->stockid}}: {{$stock->Companies->companyname}} : {{$stock->availablestock}} <strong style="color:green">{{$stock->Products->productname}} available</strong></option>
                @endif
                @endforeach
              </select>
                    <input class="form-control mb-2" type="number" name="quantitysold" id="" min='0' placeholder="Input Sold Quantity" required>
                    
                    <input class="form-control mb-2" type="number" name="saleprice" id="" min='0' placeholder="Input Sales Price" required>
                    <input class="form-control mb-2" type="text" name="expenditure" id="" placeholder="Enter Expenditure Purpose" required>
                    <input class="form-control mb-2" type="number" name="expenditureamount" id="" min='0' placeholder="Input Expenditure" required>
            </div>
            <div class="modal-footer">
            <button class="btn btn-success" type="submit">Sell</button>
            </div>
      </form>
    </div>
  </div>
</div>

@include('includes.dashboardfooter')

