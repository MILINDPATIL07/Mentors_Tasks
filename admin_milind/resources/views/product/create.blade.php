@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 3rem;">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-header">{{ __('Create New Product') }}
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('product.index') }}"> Back</a>
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

                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="ProductForm">
                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Product Name:</strong>
                                <input type="text" name="pname" id="pname" class="form-control" value="{{old('pname')}}" placeholder="Enter Product Name">
                                @if ($errors->has('pname'))
                                <span class="text-danger">{{ $errors->first('pname') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Categories :</strong>
                                <select class="form-control" name="category_id">
                                    <option value="" disabled>Select</option>
                                    @foreach ($new as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->cname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Product Image</strong>:</strong>
                                <input type="file" name="image" id="image" class="form-control" value="{{old('image')}}" accept=".jpg,.jpeg,.png">
                                @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Active:</strong>
                                <select class="form-control" name="active" id="active">
                                    <option value="">Select</option>
                                    <option name="active" value="Yes">Yes</option>
                                    <option name="active" value="No">No</option>
                                   
                                </select>
                                @if ($errors->has('active'))
                                <span class="text-danger">{{ $errors->first('active') }}</span>
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