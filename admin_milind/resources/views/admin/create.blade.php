@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 3rem;">

        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-header">{{ __(' Create New Admin') }}
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('admin.index') }}"> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                </div>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="name" class="form-control" placeholder="Enter Admin Name">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input type="text" name="email" class="form-control" placeholder="Enter Email">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Gender:</strong>
                                <input name="gender" value="male" type="radio" checked />Male
                                <input name="gender" value="female" type="radio" />Female
                                @if ($errors->has('gender'))
                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>hobbies:</strong>
                                <input type="checkbox" name="hobbies[]" value="cricket" />Cricket
                                <input type="checkbox" name="hobbies[]" value="Singing" />Singing
                                <input type="checkbox" name="hobbies[]" value="Shopping" />Shopping
                                <input type="checkbox" name="hobbies[]" value="Swimming" />Swimming
                                @if ($errors->has('hobbies'))
                                <span class="text-danger">{{ $errors->first('hobbies') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input type="password" class="form-control" name="password" placeholder="Enter Password" />
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        @endsection