@extends('layouts.admin_layout.admin_design')

@section('content')
<div role="main" class="col-md-9 ml-sm-auto col-lg-10 mt-4 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="px-2 fa fa-home"></i><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </nav>
    <div class="float-right">
        <a href="{{ url('/admin/add-product') }}" class="btn btn-sm btn-primary">New Product</a>
    </div> <hr>

    <div class="mt-5">
        <p class="h5 text-secondary"><strong>View Products</strong></p>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>SKU</th>
                        <th>Desription</th>
                        <th>Colour </th>
                        <th>Price </th>
                        <th>Image </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="odd gradeX">                    
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category_name }}</td>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->colour }}</td>
                        <td>{{ $product->price }}</td>
                        <td> <img src="{{ asset('images/products/small/'.$product->image) }}" alt="" style="width:60px; height:50px" >  </td>
                        <td class="center">
                            <a href="#myModal{{ $product->id }}" class="btn btn-success btn-sm mr-2" data-toggle="modal">View </a> 
                            <a href="{{ url('/admin/edit-product/'.$product->id) }}" class="btn btn-primary btn-sm mr-2">Edit </a> 
                            <a href="{{ url('/admin/add-attributes/'.$product->id) }}" class="btn btn-sm btn-secondary" >Add</a>
                            <a rel="{{ $product->id }}" del="delete-product" href="javascript:" class="btn btn-sm btn-danger deleteRecord"> Delete</a>
                        </td>
                    </tr>
                    <!-- modal -->
                    <div class="modal fade" id="myModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewLabel"><strong>{{ $product->name }} Full Details</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" arai-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong class="mr-3">Product ID:</strong> {{ $product->id }}</p>
                                    <p><strong class="mr-3">Product Name:</strong> {{ $product->name }}</p>
                                    <p><strong class="mr-3">Product Category ID:</strong> {{ $product->category_id }}</p>
                                    <p><strong class="mr-3">Product Category:</strong> {{ $product->category_name }}</p>
                                    <p><strong class="mr-3">Stock Keeping Unit:</strong> {{ $product->code }}</p>
                                    <p><strong class="mr-3">Description:</strong> {{ $product->description }}</p>
                                    <p><strong class="mr-3">Colour:</strong> {{ $product->colour }}</p>
                                    <p><strong class="mr-3">Price:</strong> {{ $product->price }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div> 

</div>
@endsection