@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center" style="margin-top: 3rem;">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-header">{{ __('Edit Admin') }}
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('admin.index') }}"> Back</a>
                    </div>
                </div>
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

            <form action="{{ route('admin.update',$admin->id) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" id="name" value="{{ $admin->name }}" class="form-control"
                                placeholder="Enter Name">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="text" name="email" id="email" value="{{ $admin->email }}" class="form-control"
                                placeholder="Enter Email">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Gender:</strong>
                            <input name="gender" value="male" type="radio"
                                {{ $admin->gender == 'male' ? 'checked' : ''}} />Male
                            <input name="gender" value="female" type="radio"
                                {{ $admin->gender == 'female' ? 'checked' : ''}} />Female
                            @if ($errors->has('gender'))
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Hobbies:</strong><br>
                            <input class="form-check-input" type="checkbox" name="hobbies[]" value="Cricket"
                                {{ in_array('Cricket', $admin->hobbies ) ? 'checked' : '' }}> Cricket
                            <input class="form-check-input" type="checkbox" name="hobbies[]" value="Singing"
                                {{ in_array('Singing', $admin->hobbies ) ? 'checked' : '' }}> Singing
                            <input class="form-check-input" type="checkbox" name="hobbies[]" value="Swimming"
                                {{ in_array('Swimming', $admin->hobbies ) ? 'checked' : '' }}> Swimming
                            <input class="form-check-input" type="checkbox" name="hobbies[]" value="Shopping"
                                {{ in_array('Shopping', $admin->hobbies ) ? 'checked' : '' }}> Shopping

                        </div>
                    </div>

                    <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password:</strong>
                            {{-- <input type="password" name="password" value="{{ $admin->password }}" class="form-control" placeholder="Enter password"> --}}
                            {{-- @if ($errors->has('password')) --}}
                            {{-- <span class="text-danger">{{ $errors->first('password') }}</span> --}}
                            {{-- @endif --}}
                        </div>
                    </div> -->

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection