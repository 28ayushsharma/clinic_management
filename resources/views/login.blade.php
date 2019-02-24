@extends('layouts.master')
@section('container')
  
    <body>
        <div class="site-wrapper">
                        <!-- Content Part -->
            <div class="login-wrapper">
                <div class="container">
                    <div class="row login-row">

                        <div class="col-md-4 [ m-auto d-flex align-items-center sign-in radius ]">
                            <div class="login-section m-auto">
                                <h5 class="primary-text-dark font-large [ text-capitalize mb-4 ]">Sign In</h5>
                                <form class="login__form" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="input-section">
                                            <input type="text" class="form-control" placeholder="Enter email" name="email" id="email" >
                                            <label for="email">Email*</label>

                                            <div class="form-error">
                                                <span>{{ $errors->first('email')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-section">
                                            <input type="password" class="form-control login-input" placeholder="Enter password"  id="password" name="password">
                                            <label for="password">Password*</label>

                                            <div class="form-error" >
                                                <span>{{ $errors->first('password') }}</span>
                                            </div>

                                            <!-- <a href="" class="forgot-link text-primary text-uppercase font-weight-bold font-small">Forgot</a> -->
                                        </div> 
                                    </div>   
                                    <button class="btn btn-primary login-in__button">Log in</button>
                                </form> <!-- /.login__form -->

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="form-separator"></div>
                                    </div>
                                </div>

                                <div class="row login-footer">
                                    <div class="col-sm-12">
                                        <a href="{{ route ('sign-up') }}" class="btn btn-outline-primary btn-block login-in__button" id="tiral-button">Sign Up</a>
                                    </div>
                                    
                                </div> <!-- /.login-footer -->

                            </div> <!-- /.login-section -->
                        </div>
                    </div> <!-- /.login-row -->
                </div>
            </div> <!-- /.login-wrapper -->
            <!-- Content Part End -->
        </div>
        <!-- Main Wrapper Ends -->
    </body>
@endsection