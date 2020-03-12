@extends('layouts.admin_layout.admin_design')

@section('content')
<div role="main" class="col-md-9 ml-sm-auto col-lg-10 mt-4 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="px-2 fa fa-home"></i><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Product</li>
        </ol>
    </nav>
    <p class="h5 text-secondary"><strong>Add Product</strong></p>
    <hr>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong class="text-muted">{{ __('Add Product') }}</strong></div>

                    <div class="card-body">
                        <form class="form-signin" enctype="multipart/form-data" id="loginform" method="post" action="{{ url('/admin/add-product') }}" >
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
                            <div class="row">
                                <label for="product_name" class="col-md-4 col-form-label pt-2 text-md-right">Select Product Category</label>
                                <div class="col-md-6">
                                    <select name="category_id" id="category_id" class="form-control" style="width:100%;" required>
                                        <?php echo $categories_dropdown; ?>                                            
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mt-2">
                                <label for="product_name" class="col-md-4 col-form-label pt-3 text-md-right">Product Name</label>
                                <div class="col-md-6 mt-3">
                                    <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name" required> 
                                </div>
                                <span class="mx-3" id="product_exists"></span>
                            </div>

                            <div class="row mt-2">
                                <label for="product_code" class="col-md-4 col-form-label pt-3 text-md-right">Product SKU</label>
                                <div class="col-md-6 mt-3">
                                    <input type="text" name="product_code" id="product_code" class="form-control" placeholder="Product Stock Keeping Unit" required>
                                </div>
                                <span class="mx-3" id="product_exists"></span>
                            </div>

                            <div class="row mt-2">
                                <label for="product_colour" class="col-md-4 col-form-label pt-3 text-md-right">Product Colour</label>
                                <div class="col-md-6 mt-3">
                                    <input type="text" name="product_colour" id="product_colour" class="form-control" placeholder="Product Colour" >
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <label for="description" class="col-md-4 col-form-label pt-2 text-md-right">Description</label>
                                <div class="col-md-6">
                                    <textarea type="" name="description" id="description" class="form-control" placeholder="Description" required></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <label for="price" class="col-md-4 col-form-label pt-2 text-md-right">Price</label>
                                <div class="col-md-6">
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price" required> 
                                </div>
                            </div>

                            <div class="row mt-4">
                                <label for="image" class="col-md-4 col-form-label pt-2 text-md-right">Image</label>
                                <div class="col-md-6">
                                    <input type="file" name="image" id="image" class="form-control" required>
                                </div>
                            </div> 

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-md btn-success btn-block rounded-pill mt-4">
                                        {{ __('Add Product') }}
                                    </button>
                                </div>
                            </div>              
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>      
    
</div>
@endsection