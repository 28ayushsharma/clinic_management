@extends('layouts.master')
@section('container')

<body data-is-fixed="false">
    <div class="site-wrapper">

        <div class="dashboard-content">
            <!-- User Header -->
            <!-- Dashboard Header -->
            <nav class="col navbar navbar-expand-lg bg-white shadow header">
                <div class="collapse navbar-collapse [ d-flex justify-content-between ]" id="navbarNavDropdown">
                    <div class="col-sm-3 [ pl-0 ]">
                        <img class="company-logo" src="{{asset('images/company_placeholder.png')}}" alt="">
                    </div>

                    <ul class="user-dropdown navbar-nav col-sm-4 col-lg-3 col-xl-4 [ pr-0 align-items-center  justify-content-end ]">
                        <li class="nav-item">
                            <span>
                                <strong class="text-primary font-weight-semibold font-normal [ d-block text-capitalize text-right ]">John
                                    Doe</strong>
                                <small class="d-block text-muted text-capitalize">ADMIN &middot; VETERINARIAN</small>
                            </span>
                        </li>
                        <li class="nav-item dropdown [ ml-2 ]">
                            <div class="nav-link dropdown-toggle [ pr-0 ] no-arrow" id="single-button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="row no-gutters [ align-items-center ]">
                                    <div class="user-img col-auto">
                                        <img class="rounded-circle" src="{{asset('images/ic_placeholder.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-menu user-option" aria-labelledby="single-button">
                                <a href="{{ route('logout') }}" class="dropdown-item logout-user" value="Logout">
                                    <i class="dropdown-item--icon"></i>
                                    <span class="pl-3 align-middle text-red">
                                        Logout
                                    </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav><!-- Dashboard Header Ends -->

            <div>
                <!-- Module Heading Bar -->
                <div class="page-heading shadow [ d-flex flex-sm-wrap align-items-center  justify-content-start fix-width-heading ]">
                    <h5 class="primary-text-dark col-sm-3 font-large [ mb-0 text-capitalize pl-0 ]  ">
                        Edit Profile
                    </h5>
                </div>

                <div>
                    <!-- Admin setting sidebar menu -->
                    <aside class="acuro-sidebar acuro-sidebar--large">
                        <div class="box">
                            <div class="d-flex justify-content-center mb-5">
                                <div class="user-profile-dp">
                                    <img src="{{asset('profile_images/'.$userData->photo)}}" id="profile_img" alt="">
                                    <span role="button" class="user-profile-dp__edit">
                                        <img src="{{asset('images/ic_edit.png')}}" alt="">
                                        <form id="user_profile_dp">
                                            <input id="profile_image" type="file" name="pro_pic" id="">
                                        </form>
                                    </span>
                                    <div class="form-error profile_image_error">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <div class="input-section">
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            placeholder="First name" value={{$userData->first_name}}>
                                        <!--  <div class="form-error">
                                            <span>First name is required.</span>
                                        </div>  -->
                                        <label>First Name*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <div class="input-section">
                                        <input type="text" class="form-control" id="last_name" placeholder="Last name"
                                            name="last_name" value={{$userData->last_name}}>
                                        <!-- <div class="form-error" >
                                            <span ng-message="required">Last name is required.</span>
                                        </div> -->
                                        <label>Last Name*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <div class="input-section">
                                        <input type="text" class="form-control" id="email" placeholder="Enter email"
                                            name="email" value={{$userData->email}}>
                                        <!-- <div class="form-error" >
                                            <span ng-message="required">Email is required.</span>
                                        </div> -->
                                        <label for="email">Email*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <div class="input-section">
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone"
                                            name="phone" value={{$userData->phone}}>
                                        <!-- <div class="form-error" >
                                            <span ng-message="required">Phone is required.</span>
                                        </div> -->
                                        <label for="phone">Phone*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <div class="input-section">
                                        <input type="text" class="form-control" id="licence_no" placeholder="Enter license number"
                                            name="licence_no" value={{$userData->licence_no}} disabled>
                                        <label for="licence_no">License Number</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <!-- Admin setting sidebar menu Ends-->
                    <!-- Main area -->
                    <div class="main-content">
                        <div class="box-wrapper">
                            <div class="box">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="box__heading [ mb-0 ]">Clinics and Timings</h4>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addClinicModal">Add
                                        Clinic</button>
                                </div>

                                <div id="accordion-parent">
                                    @if(count($clinicData) > 0 )
                                        @foreach ($clinicData as $key=>$clinic)                                 
                                            <div id="accordion{{$key + 1 }}" role="tablist" data-accordion-theme="white" data-toggle-icon="arrow"
                                                data-accordion-style="border" class="card p-0 border mb-2">
                                                <div class="" role="tab" id="heading{{$key + 1 }}">
                                                    <h5 class="mb-0">
                                                        <a data-toggle="collapse" href="#" role="button" aria-controls="collapse{{$key + 1 }}"
                                                            data-toggle="collapse" data-target="#collapse{{$key + 1 }}">
                                                            <div class="accordion__heading height-auto">
                                                                <div class="py-2">
                                                                    <h6 class="primary-text mb-2">{{ $clinic->clinic_name }}</h6>
                                                                    <span class="font-normal font-weight-normal text-muted d-inline-block position-relative pl-4 mr-4">
                                                                        <i class="ic-phone"></i>
                                                                        {{ $clinic->clinic_phone }}
                                                                    </span>
                                                                    <span class="font-normal font-weight-normal text-muted d-inline-block position-relative pl-4">
                                                                        <i class="ic-email"></i>
                                                                        {{ $clinic->clinic_email }}
                                                                    </span>
                                                                </div>
                                                                <i class="toggle-icon">
                                                                </i>
                                                            </div>
                                                        </a>
                                                    </h5>
                                                </div><!-- end accordion heading -->

                                                <div id="collapse{{$key + 1 }}" class="collapse divider-top" role="tabpanel"
                                                    aria-labelledby="heading{{$key + 1 }}" data-parent="#accordion-parent">
                                                    <div class="card-body p-0">
                                                        <form id="{{strtolower(str_replace(' ', '_', $clinic->clinic_name))}}_form_{{$key + 1 }}">
                                                        <input type="hidden" id="clinic_id_{{$key + 1 }}" name="clinic_id_{{$key + 1 }}" value="{{$clinic->id}}">
                                                            <div>
                                                                <div class="box [ mb-0 pt-4 pb-0 ] position-relative z-index-0">
                                                                    <div class="row [ mb-4 ]">
                                                                        <div class="col-auto [ d-flex align-items-center ]">
                                                                            <div class="btn-group checkbox-group" data-toggle="buttons">
                                                                                <label class="btn">
                                                                                    <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="1"> Mon
                                                                                </label>
                                                                                <label class="btn">
                                                                                    <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="2"> Tue
                                                                                </label>
                                                                                <label class="btn">
                                                                                    <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="3"> Wed
                                                                                </label>
                                                                                <label class="btn">
                                                                                    <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="4"> Thu
                                                                                </label>
                                                                                <label class="btn">
                                                                                    <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="5"> Fri
                                                                                </label>
                                                                                <label class="btn">
                                                                                    <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="6"> Sat
                                                                                </label>
                                                                                <label class="btn">
                                                                                    <input name="day_{{$key + 1 }}" type="checkbox" autocomplete="off" value="7"> Sun
                                                                                </label>
                                                                                <div class="form-error day_error_{{$key + 1 }}">
                                                                                    <span></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-auto [ pl-lg-0 pr-lg-0 pl-xl-3 pr-xl-3 ]">
                                                                            <div class="time-group">
                                                                                <div class="time-group__item bootstrap-timepicker">
                                                                                    <input name="start_time_{{$key + 1 }}" type="text" class="form-control timepicker time-group__input start_time_{{$key + 1 }}"
                                                                                        placeholder="Start" />
                                                                                
                                                                                </div>
                                                                                <span class="mx-3">
                                                                                    To
                                                                                </span>
                                                                                <div class="time-group__item bootstrap-timepicker">
                                                                                    <input name="end_time_{{$key + 1 }}" type="text" class="form-control time-group__input timepicker end_time_{{$key + 1 }}"
                                                                                        placeholder="End" />
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-error form-error--full start_time_error_{{$key + 1 }} end_time_error_{{$key + 1 }} time_error_{{$key + 1 }}">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-auto [ pr-0 d-flex align-items-center ]">
                                                                            <button type="btn" class="btn btn-add book_slot"></button>
                                                                        </div>
                                                                    </div>

                                                                    
                                                                    <div class="appointment-list divider-top">
                                                                        @if( count($clinic->clinicSlots) > 0 )
                                                                            @foreach ($clinic->clinicSlots as $numDay=>$clientSlotData)
                                                                                <div class="appointment-list__item">
                                                                                    <div class="appointment-list__day">
                                                                                        {{ jddayofweek(($numDay - 1), 1)}}
                                                                                    </div> 
                                                                                    @foreach ($clientSlotData as $slot)
                                                                                        <div class="appointment-list__time">
                                                                                            <div class="badge badge-pill bg-light d-flex align-items-center secondary-text-dark ng-scope">
                                                                                                <span class="font-small font-weight-bold ng-binding">
                                                                                                    {{ $slot['start_time'] }}
                                                                                                </span>
                                                                                                <span class="font-small px-2 text-muted">
                                                                                                    To
                                                                                                </span>
                                                                                                <span class="font-small font-weight-bold ng-binding">
                                                                                                    {{$slot['end_time']}}
                                                                                                </span>
                                                                                                <a data-id="{{$slot['slot_id']}}" class="ic-close ml-2 delete_slot" style="cursor : pointer">
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div> <!-- /.appointment-list__item   -->
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div><!-- end accordion body-->
                                            </div><!-- end accordion -->
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="box">
                                <div class="row">
                                    <h5 class="box__heading col-xl-12">About User</h5>
                                    <div class="col-sm-12">
                                        <div class="input-section">
                                            <textarea class="form-control" id="about" placeholder="Enter text here"
                                                name="about"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box p-0">
                                <div class="box mb-0 box-bottom--shadow">
                                    <div class="row">
                                        <h5 class="box__heading col-xl-12">User Experience</h5>
                                        <div class="form-group col-sm-4">
                                            <div class="input-section">
                                                <select class="custom-select w-100" id="role" name="role">
                                                    <option selected>Select</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                                <label for="role">Role</label>
                                            </div>
                                        </div>
                                        <div class="form-group w-100p col-auto divider-date">
                                            <div class="input-section">
                                                <input type="text" id="role_from_year" name="from_year" placeholder="yyyy"
                                                    datepicker-mode="year" datetime-picker="yyyy" class="form-control roleFromYear icon-field ic-calendar" />
                                                <label for="role_from_year">From</label>
                                            </div>
                                        </div>
                                        <div class="form-group w-100p col-auto">
                                            <div class="input-section">
                                                <input type="text" id="role_to_year" name="to_year" placeholder="yyyy"
                                                    class="form-control roleToYear icon-field ic-calendar" />
                                                <label for="role_to_year">To</label>
                                            </div>
                                        </div>
                                        <div class="form-group col">
                                            <div class="input-section">
                                                <input type="text" id="clinic-hospital-companyname" name="company"
                                                    placeholder="Type to add" class="form-control">
                                                <label for="clinic-hospital-companyname">Clinic/Hospital/Company name</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-auto">
                                            <button class="btn btn-add"></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-container radius-none bg-transparent">
                                    <div class="box [ py-0 mb-0 ]">
                                        <table class="table data-table box-table [ mb-0 ]">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <a href="#" class="sorting">Role
                                                        </a>
                                                    </th>
                                                    <th>
                                                        <a href="#" class="sorting">
                                                            Duration
                                                        </a>
                                                    </th>
                                                    <th>
                                                        <a href="#" class="sorting">Clinic/Hospital/Company name
                                                        </a>
                                                    </th>
                                                    <th>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Doctor
                                                    </td>
                                                    <td>
                                                        2000-2002
                                                    </td>
                                                    <td>
                                                        Abc Hospital
                                                    </td>
                                                    <td class="text-center p-0">
                                                        <a href="" class="ic-close btn-close  [ d-inline-block align-middle ml-1 ]">
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Doctor
                                                    </td>
                                                    <td>
                                                        2000-2002
                                                    </td>
                                                    <td>
                                                        Abc Hospital
                                                    </td>
                                                    <td class="text-center p-0">
                                                        <a href="" class="ic-close btn-close  [ d-inline-block align-middle ml-1 ]">
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row [ mt-4 ]">
                                <div class="col-xl-12 [ text-right ]">
                                    <button type="button" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>

                        </div> <!-- /.box-wrapper -->
                    </div><!-- Main area Ends -->
                </div>
            </div>
        </div>
    </div>
    <!-- Main Wrapper Ends -->
    <!-- Modal -->
    <div class="modal fade" id="addClinicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-large" role="document">
            <div class="modal-content">
                <!--  <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div> -->
                <form id="add_clinic_form">
                <div class="modal-body">
                    <div class="box">
                       
                            <div class="row">
                                <h5 class="box__heading col-xl-12">Clinic Details</h5>
                                <div class="form-group col-sm-6 col-lg-6 col-xl-4">
                                    <div class="input-section">
                                        <input type="text" name="clinic_name" class="form-control" id="clinic_name"
                                            placeholder="Enter clinic name" value="" required>
                                        <label for="clinic_name">Clinic Name*</label>

                                        <div class="form-error clinic_name_error">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 col-lg-6 col-xl-4">
                                    <div class="input-section">
                                        <input type="text" name="clinic_email" class="form-control" id="clinic_email"
                                            placeholder="Enter clinic email" required>
                                        <label for="clinic_email">Clinic Email*</label>
                                        <div class="form-error clinic_email_error">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 col-lg-6 col-xl-4">
                                    <div class="input-section">
                                        <input type="text" name="clinic_phone" class="form-control" id="clinic_phone"
                                            placeholder="Enter clinic phone" value="">
                                        <label for="clinic_phone">Clinic Phone*</label>
                                        <div class="form-error clinic_phone_error">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <div class="input-section">
                                        <textarea name="clinic_about" id="clinic_about" class="form-control " placeholder="Enter about clinic"></textarea>
                                        <label for="clinic_about">About Clinic</label>
                                    </div>
                                </div>
                            </div>
                        
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Scripts Start -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script type="text/javascript">
        $('document').ready(function () {
            $('.timepicker').timepicker({
                template: false,
                showInputs: false,
                minuteStep: 5
            });


            var distance = $('.page-heading').offset().top,
                $window = $(window);

            $window.scroll(function () {

                if ($window.scrollTop() >= distance) {

                    $('body').attr("data-is-fixed", "true");

                } else {

                    $('body').attr("data-is-fixed", "false");

                }

                $('.acuro-sidebar').css('top', 114 - $(this).scrollTop());

            });
            $('#js-notification-trigger').on("click", function () {
                $('.user-notification-sidebar').toggleClass('active');
            });

    /**-- Custom script starts frm here*/

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#add_clinic_form').validate({ // initialize the plugin
                rules: {
                    clinic_name: {
                        required: true,
                        minlength: 5
                    },
                    clinic_email: {
                        required : true,
                        email    : true
                    },
                    clinic_phone:{
                        required : true,
                        digits   : true,
                        maxlength : 11,
                        minlength : 8
                    }
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    $("."+element.attr("name")+"_error").html(error);                        
                },
                submitHandler: function (form) {
                    var formData = {
                        clinic_name  : $('#clinic_name').val(),
                        clinic_phone   : $('#clinic_phone').val(),
                        clinic_email  : $('#clinic_email').val(),
                        clinic_about  : $('#clinic_about').val(),
                    };
                    $.ajax({
                            url     :   '{{route("clinic_store")}}',
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
                                    $('#add_clinic_form')[0].reset();
                                    $('#addClinicModal').modal('hide');
                                    alert("Clinic saved Successfully.");
                                    renderClinicData();
                                } 
                            }
                        });
                }//submit handler END
            });

            $(document).on('click','.book_slot',function(){
                var form_id = $(this).closest("form").attr("id");
                
                var postfix_id = form_id.slice(-1);
                
                $('#'+form_id).validate({ // initialize the plugin
                    rules: {
                        day: {
                            required: true
                        },
                        start_time: {
                            required : true
                        },
                        end_time:{
                            required : true
                        }
                    },
                    messages: {
                        day: {
                            required: "Please select atleast one day."
                        }
                    },
                    errorElement: "span",
                    errorPlacement: function(error, element) {
                        $("."+element.attr("name")+"_error_"+postfix_id).html(error);                        
                    },
                    submitHandler: function (form) {
                        var days = [];
                        $.each($("input[name="+'day_'+postfix_id+"]:checked"), function(){            
                            days.push($(this).val());
                        });
                       var formData = {
                            start_time  : $('.start_time_'+postfix_id).val(),
                            end_time    : $('.end_time_'+postfix_id).val(),
                            day        : days,
                            clinic_id   : $('#clinic_id_'+postfix_id).val()
                        };

                        $.ajax({
                            url     :   '{{route("book-slot")}}',
                            type    :   'POST',
                            data    :   {formData},
                            success :   function(result){
                                $(".form-error").empty();
                                if(!result.status){
                                    $.each(result.errors, function( index, value ) {
                                        $.each(value, function( nouse, value ) {
                                            console.log("."+index+"_error_"+postfix_id);
                                            $("."+index+"_error_"+postfix_id).append("<span>"+value+"</span>");
                                        });
                                    });
                                }else{
                                    renderClinicData();
                                    alert("Slot booked successfully.");
                                   
                                }  
                            }
                        });
                        
                        
                    }//submit handler END
                });
            });

            $(document).on('click','.delete_slot', function(){
                var res = confirm("Are you sure you want to delete this slot.");
                if(res){
                    var slot_id = $(this).attr('data-id');
                    $.ajax({
                        url     :   '{{route("delete_slot")}}',
                        type    :   'POST',
                        data    :   {slot_id:slot_id},
                        success :   function(result){
                            if(result.status){
                                renderClinicData();
                                alert(msg);
                            }else{
                                alert(msg);
                            }
                        }
                    });
                }
            })

            $('#user_profile_dp').on('submit',(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type:'POST',
                    url: '{{route('upload_pic')}}',
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(result){
                        $('.profile_image_error').empty();
                        var public_path = '<?php echo asset("profile_images"); ?>';
                        if(result.status){
                            $('#profile_img').attr('src', public_path+"/"+result.image_name);
                        }else{
                            $('.profile_image_error').html('<span>Invalid image</span>'); 
                        }
                    }
                });
            }));

            $("#profile_image").on("change", function() {
                $("#user_profile_dp").submit();
            });

    });//document ready end

    /**
    * function to render html of clinic details
    *
    */
    function renderClinicData() {
        $.ajax({
            url     :   '{{route('render_clinic')}}',
            type    :   'GET',
            success :   function(result){
                $('#accordion-parent').html(result);
            }
        });
    }
    </script>
    <!-- Scripts End -->

</body>
@endsection