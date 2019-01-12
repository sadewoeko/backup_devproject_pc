@extends('dashboard')
@section('content')

<section class="login-section">
    <div class="section-padding">
      <div class="container">
        <div class="row" style="margin-top : -130px">

            <div class="col-md-5">
                <div class="sign-in bg-gray">
                    <h2 class="title">Enter your E-mail</h2>
                    

                    @if (session('error-forgot'))
                        <div class="alert alert-danger">
                        {{ session('error-forgot') }}
                        </div>
                    @endif

                    @if (session('success-forgot'))
                        <div class="alert alert-success">
                        {{ session('success-forgot') }}
                        </div>
                    @endif

                    {{ Form::open(array('class'=> 'sign-in-form','route' => 'auth.generate-token-forgot-password','enctype' => 'multipart/form-data')) }}
                    <p class="form-input">
                        <input type="text" name="email" id="user_login" class="input" value="" placeholder="Email" required/>
                    </p>
                    <p class="form-input">
                        <input type="submit" name="wp-submit" id="wp-submit" class="btn" value="Sign In" />
                    </p>
                    {{ Form::close() }}
                    
                </div><!-- /.sign-in -->

                
            </div>
        </div><!-- /.row -->
      </div><!--/.container-->
    </div><!-- /.section-padding -->
</section><!--/.login-section-->


@endsection