@extends('layouts.admin_layout.admin_design')

@section('content')
<div role="main" class="col-md-9 ml-sm-auto col-lg-10 mt-4 px-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="px-2 fa fa-home"></i><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>
    <div class="float-right">
        <a href="{{ url('/admin/add-category') }}" class="btn btn-sm btn-primary">New Category</a>
    </div> <hr>

    <div class="table-responsive mt-5">
        <p class="h5 text-secondary"><strong>View Categories</strong></p>
        <hr>

        <div class="table-responsive" >
            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Desription</th>
                        <th>Category Url</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr class="odd gradeX">                    
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td class="center">{{ $category->url }}</td>
                        <td class="center">
                            <a href="{{ url('/admin/edit-category/'.$category->id) }}" class="btn btn-primary btn-sm mr-2">Edit </a> 
                            <!-- <a href="{{ url('/admin/delete-category/'.$category->id) }}" class="btn btn-sm btn-danger"> Delete</a> -->
                            <a rel="{{ $category->id }}" del="delete-category" href="javascript:" class="btn btn-sm btn-danger deleteRecord"> Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div> 

</div>
@endsection