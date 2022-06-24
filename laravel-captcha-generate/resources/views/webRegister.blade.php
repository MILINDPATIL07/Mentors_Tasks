<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <style>
        element.style {
            visibility: hidden !important;
        }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Styles -->
    <!-- Load Captcha -->
    <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">

    <style>
        .container {
            max-width: 500px;
        }

        .reload {
            font-family: Lucida Sans Unicode
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{-- <script>
     $(document).ready(function(){
         $("a[title ~= 'BotDetect']").removeAttr("style");
         $("a[title ~= 'BotDetect']").removeAttr("href");
         $("a[title ~= 'BotDetect']").css('visibility', 'hidden');

     });
     </script> --}}
</head>

<body>
    <div class="container mt-5">
        <center>
            <h4>LARAVEL BOT-DETECT CAPTCHA</h4>
        </center>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <form method="POST" action="{{ url('/web-register') }}">
            @csrf

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">E-Mail Address</label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Password</label>
                <input type="password" class="form-control" name="password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group mb-4{{ $errors->has('CaptchaCode') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Captcha</label>
                {{-- get captcha image from package --}}
                {!! captcha_image_html('ExampleCaptcha') !!}
                <input class="form-control" type="text" id="CaptchaCode" name="CaptchaCode"
                    placeholder="Enter Captcha here" style="margin-top:5px;">

                @if ($errors->has('CaptchaCode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('CaptchaCode') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-btn fa-user"></i>Register
                </button>
            </div>
        </form>
    </div>
</body>
</html>
