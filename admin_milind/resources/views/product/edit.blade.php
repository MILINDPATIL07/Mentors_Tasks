@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 3rem;">

        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-header">{{ __(' Edit Product') }}
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

                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-10 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Product Name:</strong>
                                <input type="text" name="pname" class="form-control" value="{{ $product->pname }}" placeholder="Enter Product Name">

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Categories :</strong>
                                <select class="form-control" name="category_id">
                                    <option value="">Select</option>
                                    @foreach ($new as $key => $value)
                                    <option value="{{$value->id}}" {{$product->category_id==$value->id ? 'selected' : ''}}>{{$value->cname}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Product Image</strong>:</strong>
                                <input type="file" name="image" class="form-control" value="{{ $product->image }}">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Active:</strong>
                                <select class="form-control" name="active">
                                    <option value="">Select</option>
                                    <option name="active" value="Yes" {{ $product->active=="Yes"? "selected" : "" }}>Yes</option>
                                    <option name="active" value="No" {{ $product->active=="No"? "selected" : "" }}>No</option>
                                </select>
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