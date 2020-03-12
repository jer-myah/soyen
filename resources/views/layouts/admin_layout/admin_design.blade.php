<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Soyen</title>
        <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/backend_css/datatables.bootstrap4.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/backend_css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/css/all.min.css') }}">
        

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <style>
            #dataTable th, td {
                white-space: nowrap;
            }
        </style>
    </head>
    <body > <!-- style="background-color:rgba(1, 1, 1, 0.1);" -->         
        
        <div class="container-fluid">
            @include('layouts.admin_layout.admin_header')
            
            @include('layouts.admin_layout.admin_sidebar')

            @yield('content')

            @include('layouts.admin_layout.admin_footer')
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('js/backend_js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/backend_js/popper.js') }}" ></script>
        <script src="{{ asset('js/backend_js/bootstrap.min.js') }}" ></script>
        <script src="{{ asset('js/backend_js/jquery.datatables.min.js') }}" ></script>
        <script src="{{ asset('js/backend_js/datatables.bootstrap4.min.js') }}" ></script>
        <script src="{{ asset('js/backend_js/dashboard.js') }}" ></script>
        <script src="{{ asset('js/backend_js/form_validate.js') }}" ></script>
        <script src="{{ asset('js/backend_js/soyen.popover.js') }}" ></script>
        <script src="{{ asset('js/sweetalert2.all.min.js') }}" ></script>

        <script>
            $(document).ready(function () {
                //$('#dataTable').DataTable();
                $('#dataTable').DataTable({ "scrollX": true });
                $('#dataTable').addClass('bs-select');  

                $(".deleteRecord").click(function(){
                    var id = $(this).attr('rel');
                    var deleteUrl = $(this).attr('del');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        
                        if (result.value) {
                            window.location.href = "/admin/"+deleteUrl+"/"+id;
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                            return true;
                        }
                    });
                });
                
                        
            });
            
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                var maxField = 5; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper
                var fieldHTML = '<div class="mt-3"><input type="text" name="sku[]" placeholder="SKU" id="sku" style="width:100px;"/> <input type="text" name="size[]" placeholder="Size" id="size" style="width:100px;"/> <input type="text" name="price[]" placeholder="Price" id="price" style="width:100px;"> <input type="text" name="stock[]" placeholder="Stock" id="stock" style="width:100px;"><a href="javascript:void(0);" class="remove_button ml-2 text-danger">Remove<i class="fa fa-minus-circle px-2"></i></a></div>'; //New input field html 
                var x = 1; //Initial field counter is 1
                
                //Once add button is clicked
                $(addButton).click(function(){
                    //Check maximum number of input fields
                    if(x < maxField){ 
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); //Add field html
                    }
                });
                
                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        </script>
        
    </body>
</html>

