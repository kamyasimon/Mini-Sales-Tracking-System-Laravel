@extends('layouts.app')
@section('content')
@include('admin.menus.adminmenus')
@include('includes.dashboardheader')

<div class="row">
@if(Auth::user()->fkrole == 2)
  <div class="col-12 d-flex justify-content-around align-items-center">
 
      <button class="btn btn-block btn-success" data-bs-toggle="modal" data-bs-target="#addstock">Add Stock</button>
        <button class="btn btn-block btn-success" data-bs-toggle="offcanvas" data-bs-target="#createstockbatch" >Create Stock Batch</button> 
   
  </div>
  @endif
</div>
<hr>
<div class="row">
    <div class="col-12">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">Stock Batch</th>
    <th scope="col">Stock Id</th>
    <th scope="col">Stock Company</th>
    <th scope="col">Item Stocked</th>
    <th scope="col">Stock Quantity</th>
    <th scope="col">Stock Amount</th>
    <th scope="col">Stock Price</th>
    <th scope="col">Sale Price</th>
    <th scope="col">projected Profits</th>
    <th scope="col">available</th>
    <th scope="col">stockdate</th>
   
    </tr>
  </thead>
  <tbody>
      @foreach($stocks as $stock)
    <tr>
      <th>{{$stock->Batches->batch}}</th>
      <th>{{$stock->stockid}}</th>
      <th>{{$stock->Companies->companyname}}</th>
      <th>{{$stock->Products->productname}}</th>
      <td>{{$stock->stockquantity}}</td>
      <td>{{$stock->stockamount}}</td>
      <td>{{$stock->stockprice}}</td>
      <td>{{$stock->saleprice}}</td>
      <td>{{$stock->projectedprofits}}</td>
      @if($stock->availablestock == 0)
      <td  style = "color:red">Out of Stock</td>
      @elseif(($stock->availablestock /$stock->availablestock)*100 < 30)
      <td style = "color:orange">{{$stock->availablestock}} remaining</td>
      @else
      <td style = "color:green">{{$stock->availablestock}} available</td>
      @endif
      <td>{{$stock->created_at}}</td>
    </tr>
    @endforeach
   
  </tbody>
</table>
    </div>
</div>

@endsection

<!----------ADD BATCH MODEL---------->
<div class="offcanvas offcanvas-start" tabindex="-1" id="createstockbatch">
  
<div class="offcanvas-header">
  
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Create Stock Batch</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  
     
  </div>
  <div class="offcanvas-body">
     
      
    <form action="{{url('/addstockbatch')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row">
            <div class='col-8'>
                    <input class="form-control mb-2" type="text" name="batch" id="" placeholder="e.g: batch1/JAN/2022" required>
            </div>
            <div class='col-4' >
            <button class="btn btn-success btn-sm" type="submit">Create Batch</button>
            </div>
            </div> 
      </form>
    <div class="row">
      <div class="col-12">
        <ul>
        @foreach($batches as $batch)
            <li>{{$batch->batch}}</li>
        @endforeach
        </ul>
      </div>
    </div>
</div>
  
</div>


<!----------ADD STOCK MODEL---------->
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
              <select class="form-control mb-2" name="fkcompany" id="">
                <option value="">Select Company</option>
                @foreach($companies as $company)
               
                <option value="{{$company->id}}">{{$company->companyname}}</option>
                @endforeach
              </select>
              <select class="form-control mb-2" name="batch" id="">
                    <option value="">Select Batch</option>
                    @foreach($batches as $batch)
                    <option value="{{$batch->id}}">{{$batch->batch}}</option>
                    @endforeach
                    </select>
                <select class="form-control mb-2" name="product" id="">
                <option value="">Select Product</option>
                @foreach($products as $product)
               
                <option value="{{$product->id}}">{{$product->productname}}</option>
                @endforeach
              </select>
                    <input class="form-control mb-2" type="number" name="quantity" id="" min='0' placeholder="Input Stock Quantity" required>
                    <input class="form-control mb-2" type="number" name="stockprice" id="" min='0' placeholder="Input Stock Price" required>
                    <input class="form-control mb-2" type="number" name="saleprice" id="" min='0' placeholder="Input Sales Price" required>
            </div>
            <div class="modal-footer">
            <button class="btn btn-success" type="submit">Add Stock</button>
            </div>
      </form>
    </div>
  </div>
</div>
@include('includes.dashboardfooter')

