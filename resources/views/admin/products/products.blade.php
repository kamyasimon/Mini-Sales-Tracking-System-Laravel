@extends('layouts.app')
@section('content')
@include('admin.menus.adminmenus')
@include('includes.dashboardheader')

<div class="row">
    <div class="col-12">
    <table class="table">
  <thead>
    <tr>
    <th scope="col">Product Name</th>
    <th scope="col">Visible</th>
    <th scope="col">Added Date</th>
     <th scope="col">  <button class="btn btn-block btn-warning" data-bs-toggle="modal" data-bs-target="#addproduct">Add Product</button> </th>
    </tr>
  </thead>
  <tbody>
      @foreach($products as $product)
    <tr>
    <td>{{$product->productname}}</td>
      <th>{{$product->visible}}</th>
      <th>{{$product->created_at}}</th>
      
    </tr>
    @endforeach
   
  </tbody>
</table>
    </div>
</div>

@endsection

<!----------ADD CAPITAL MODEL---------->
<div class="modal" tabindex="-1" id="addproduct">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ADD PRODUCT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url('/addproduct')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field()}}
            <div class="modal-body">

                    <input class="form-control mb-2" type="text" name="productname" id="" placeholder="Enter Product name" required>
                
                     </div>
            <div class="modal-footer">
            <button class="btn btn-success" type="submit">Create</button>
            </div>
      </form>
    </div>
  </div>
</div>

@include('includes.dashboardfooter')

