
@extends('layouts.admin_layout.admin_design')

@section('content')
<div role="main" class="col-md-9 ml-sm-auto col-lg-10 mt-4 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="px-2 fa fa-home"></i><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Product Attribute</li>
        </ol>
    </nav>
    <p class="h5 text-secondary"><strong>Product Attributes</strong></p>
    <hr>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong class="text-muted">{{ __('Add Product Attributes') }}</strong></div>

                    <div class="card-body">
                        <form class="form-signin" id="loginform" method="post" action="{{ url('/admin/add-attributes/'.$product_details->id) }}" >
                            @csrf
                            @if(Session::has('flash_message_success'))
                                <div class="alert alert-success alert-block" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong> {!! session('flash_message_success') !!} </strong>
                                </div>
                            @endif 
                            @if(Session::has('flash_message_error'))
                                <div class="alert alert-warning alert-dismissable fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong> {!! session('flash_message_error') !!} </strong>
                                </div>
                            @endif
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }} </li>
                                        @endforeach
                                    </ul>
                                </div> 
                            @endif
                            
                            <div class="row mt-2">
                                <label for="product_name" class="col-md-4 col-form-label pt-3 text-md-right"><strong>Product Name</strong></label>
                                <label for="product_name" class="col-md-4 col-form-label pt-3 text-md-right">{{ $product_details->name }}</label>
                            </div>

                            <div class="row mt-2">
                                <label for="product_code" class="col-md-4 col-form-label pt-3 text-md-right"><strong>Product SKU</strong></label>
                                <label for="product_code" class="col-md-4 col-form-label pt-3 text-md-right">{{ $product_details->code }}</label>                                
                            </div>

                            <div class="row mt-4">
                                <label for="colour" class="col-md-4 col-form-label pt-2 text-md-right"><strong>Product Colour</strong></label>
                                <label for="product_name" class="col-md-4 col-form-label pt-3 text-md-right">{{ $product_details->colour }}</label>
                            </div>

                            <div class="row mt-4">
                                <label for="price" class="col-md-4 col-form-label pt-2 text-md-right"></label>
                                <div class="field_wrapper">
                                    <div>
                                        <input type="text" name="sku[]" placeholder="SKU" required id="sku" style="width:100px;">
                                        <input type="text" name="size[]" placeholder="Size" required id="size" style="width:100px;">
                                        <input type="text" name="price[]" placeholder="Price" required id="price" style="width:100px;">
                                        <input type="text" name="stock[]" placeholder="Stock" required id="stock" style="width:100px;">
                                        <a href="javascript:void(0)" class="add_button" title="Add field">Add
                                        <i class="fa fa-plus-circle  px-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-md btn-success btn-block rounded-pill mt-4">
                                        {{ __('Add Attributes') }}
                                    </button>
                                </div>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <div class="mt-5 container">
        <p class="h5 text-secondary"><strong>View Attributes </strong></p>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Attribute ID</th>
                        <th>Stock Keeping Unit</th>
                        <th>Product Size</th>
                        <th>Product Price </th>
                        <th>Stock Available</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product_details['attributes'] as $attribute)
                    <tr class="odd gradeX">                    
                        <td>{{ $attribute->id }}</td>
                        <td>{{ $attribute->sku }}</td>
                        <td>{{ $attribute->size }}</td>
                        <td>{{ $attribute->price }}</td>
                        <td>{{ $attribute->stock }}</td>
                        <td class="center">
                            <a rel="{{ $attribute->id }}" del="delete-attribute" href="javascript:" class="btn btn-sm btn-danger deleteRecord">Delete</a>
                        </td>
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>     
    
</div>
@endsection

