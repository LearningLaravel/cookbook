@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">AJAX Login</div>
                    <div class="panel-body">

                        <form class="form-horizontal" id="login" method="POST" action="{{ url('users/login') }}"  data-parsley-validate>
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary ladda-button" data-style="expand-left"
                                            data-size="s" data-color="green">
                                        <i class="fa fa-btn fa-sign-in"></i> Login
                                    </button>
                                    <a href="/login/facebook">
                                        <div class="btn btn-md btn-primary ladda-button" data-style="expand-left"
                                             data-size="s" data-color="blue"><i class="fa fa-facebook"></i> Login with
                                            Facebook
                                        </div>
                                    </a>
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your
                                        Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
