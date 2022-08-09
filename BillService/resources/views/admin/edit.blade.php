@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __(' Edit Profile') }}
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

                    <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data"
                        id="EditForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-10 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>User Name:</strong>
                                    <input type="text" name="name" class="form-control" value="{{ $admin->name }}"
                                        placeholder="Enter User Name">
                                </div>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <input type="email" name="email" id="email" value="{{ $admin->email }}"
                                        class="form-control" placeholder="Enter Email" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Photo</strong>:</strong>
                                    <input type="file" name="photo" class="form-control" value="{{ $admin->photo }}">
                                </div>
                                @if ($errors->has('photo'))
                                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                                @endif
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <br>
                                    <strong>Gender</strong>:</strong>
                                    <input name="gender" value="male" type="radio"
                                        {{ $admin->gender == 'male' ? 'checked' : '' }} />Male
                                    <input name="gender" value="female" type="radio"
                                        {{ $admin->gender == 'female' ? 'checked' : '' }} />Female
                                    @if ($errors->has('gender'))
                                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <br>
                                    <strong> Age: </strong>
                                    <select class="form-control" name="age" id="age">
                                        <option value="" disabled>Select</option>
                                        <option value="18-30">18-30</option>
                                        <option value="31-40">31-40</option>
                                        <option value="Above 40">Above 40</option>
                                    </select>
                                </div>


                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <br>
                                    <strong>Service Type :</strong><br>
                                    {{-- <select class="form-control" name="Service Type">
                                        <option value="" disabled>Select</option> --}}
                                        {{-- @foreach ($service as $key => $value)
                                    <option value="{{ $value->id }}" {{ $value->Servive_Type == $value->id ? 'selected' : '' }}>{{ $value->Servive_Type }}
                                    </option>
                                    @endforeach --}}
                                        @foreach ($services as $service)
                                            <input type="checkbox" id="services" name="services[]"
                                                value="{{ $service->id }}" {{in_array($service->id,$user_services) ? 'checked' : ''}}>{{ $service->Service_Type }}<br />
                                        @endforeach

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

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $("#EditForm").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 20,
                },

                email: {
                    required: true,
                    email: true,
                    maxlength: 50
                },

                gender: {
                    required: true,
                },

            },
            messages: {
                name: {
                    required: "User name is required",
                    maxlength: "User name cannot be more than 20 characters"
                },
                email: {
                    required: "Email is required",
                    email: "Email must be a valid email address",
                    maxlength: "Email cannot be more than 50 characters",
                },

                gender: {
                    required:  "Please select the gender",
                },

            }
        });
    });
</script>
