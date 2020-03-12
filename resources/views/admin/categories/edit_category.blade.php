@extends('layouts.admin_layout.admin_design')

@section('content')
<div role="main" class="col-md-9 ml-sm-auto col-lg-10 mt-4 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="px-2 fa fa-home"></i><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
        </ol>
    </nav>
    <p class="h5 text-secondary"><strong>Edit Category</strong></p>
    <hr>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><strong class="text-muted">{{ __('Edit Category') }}</strong></div>

                    <div class="card-body">
                        <form class="form-signin" id="loginform" method="post" action="{{ url('/admin/edit-category/'.$category_details->id) }}" >
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
                            <div class="row">
                                <label for="category_name" class="col-md-4 col-form-label pt-2 text-md-right">Category Name</label>
                                <div class="col-md-6">
                                    <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $category_details->name }}" required >
                                </div>
                                <!-- <span class="mx-3" id="category_exists"></span> -->
                            </div>
                            
                            <div class="row mt-4">
                                <label for="category_option" class="col-md-4 col-form-label pt-2 text-md-right">Category Options</label>
                                <div class="col-md-6">
                                    <select name="parent_id" class="form-control" style="width:100%;">
                                        <option value="0">Main Category</option>
                                        @foreach($options as $option)
                                            <option value="{{ $option->id }}" @if($option->id == $category_details->parent_id) selected @endif >{{ $option->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- <span class="mx-3" id="category_exists"></span> -->
                            </div>
                            <div class="row mt-4">
                                <label for="description" class="col-md-4 col-form-label pt-2 text-md-right">Description</label>
                                <div class="col-md-6">
                                    <textarea type="" name="description" id="description" class="form-control" placeholder="Description" required>{{ $category_details->description }}</textarea>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <label for="url" class="col-md-4 col-form-label pt-2 text-md-right">Url</label>
                                <div class="col-md-6">
                                    <input type="text" name="url" id="url" class="form-control" value="{{ $category_details->url }}" required> 
                                </div>
                            </div>  
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-md btn-success btn-block rounded-pill mt-4">
                                        {{ __('Update Category') }}
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