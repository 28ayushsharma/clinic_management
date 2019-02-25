@extends('layouts.master')
@section('container')
    
    <body>

        <div class="site-wrapper">
        
        <div class="sign-in-wrapper mt-5">
            <form id="sign_in_form" class="sign-in__form">
                <div class="sign-in radius">
                    <div class="row [ d-flex mb-5 ]">
                        <h1 class="sign-in__heading col-md-6 [ mb-0 ]">Sign Up</h1>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input-section">
                                <input type="text" class="form-control" placeholder="Enter first name"
                                       name="first_name" id="first_name"
                                       >
                                <label for="first_name">First Name*</label>

                               <div class="form-error first_name_error">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-section">
                                <input type="text" class="form-control" placeholder="Enter last name"
                                       name="last_name" id="last_name"
                                       >
                                <label for="last_name">Last Name*</label>
                               <div class="form-error last_name_error">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input-section">
                                <input type="text" class="form-control" placeholder="Enter email"
                                       name="email" id="email"
                                       >
                                <label for="email">Email*</label>
                                 <div class="form-error email_error">
                                 </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-section">
                                <input type="text" class="form-control" placeholder="Enter phone number"
                                       name="phone" id="phone" >
                                <label for="phone">Phone*</label>
                                <div class="form-error phone_error">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 [ mb-0 ]">
                            <div class="input-section">
                                <input type="password" class="form-control" placeholder="Enter password"
                                       name="password" id="password"
                                       >
                                <label for="password">Password*</label>
                                <div class="form-error password_error">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 [ mb-0 ]">
                            <label id="term-condition-label" class="custom-control custom-checkbox [ font-weight-bold ]"
                                   for="term-condition">
                                <input type="checkbox" class="custom-control-input" id="term-condition" name="terms" >
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description agreement-text [ pl-2 ]">I agree</span>
                            </label>
                            <div class="form-error terms_error [ pl-3 ]" >
                            </div>
                        </div>
                    </div>
                </div> <!-- /.sign-in -->
                <button type="submit" class="btn btn-primary btn-large sign-in__btn [ mx-auto ]" id="sign-in__btn"> Sign Up </button>
            </form> <!-- /.sign-in__form -->
        </div> <!-- /.sign-in-wrapper -->

        </div>
        <!-- Main Wrapper Ends -->

        <!-- Scripts Start -->
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#sign_in_form').validate({ // initialize the plugin
                    rules: {
                        first_name: {
                            required: true,
                            minlength: 5
                        },
                        last_name: {
                            required  : true,
                            minlength : 5
                        },
                        email: {
                            required : true,
                            email    : true
                        },
                        phone:{
                            required : true,
                            digits   : true,
                            maxlength : 11,
                            minlength : 8
                        },
                        password:{
                            required : true,
                            minlength  : 6
                        },
                        terms:{
                            required : true
                        }
                    },
                     messages: {
                        terms: {
                            required: "Please accept terms & conditions."
                        }
                    },
                    errorElement: "span",
                    errorPlacement: function(error, element) {
                        $("."+element.attr("name")+"_error").html(error);                        
                    },
                    submitHandler: function (form) {
                        var formData = {
                            first_name  : $('#first_name').val(),
                            last_name   : $('#last_name').val(),
                            email       : $('#email').val(),
                            phone       : $('#phone').val(),
                            password    : $('#password').val()
                        };
                        $.ajax({
                            url     :   '{{route("signup-save")}}',
                            type    :   'POST',
                            data    :   {formData},
                            success :   function(result){
                                if(!result.status){
                                    $.each(result.errors, function( index, value ) {
                                        $("."+index+"_error").empty();
                                        $.each(value, function( nouse, value ) {
                                            
                                            $("."+index+"_error").append("<span>"+value+"</span>");
                                        });
                                    });
                                }else{
                                    $('#sign_in_form')[0].reset();
                                    alert("Signup Successfull. You can now login.");
                                    window.location.href = '{{ route("/")}}'; 
                                } 
                            }
                        });
                    }//submit handler END
                });


            });//document ready end
        </script>
        <!-- Scripts End -->
    </body>
@endsection