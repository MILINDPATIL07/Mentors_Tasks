@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center" style="margin-top: 3rem;">

        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-header">{{ __(' Edit Category') }}
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('category.index') }}"> Back</a>
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

                <form action="{{ route('category.update',$category->id) }}" method="POST" id="cateditForm">
                    @csrf
                    @method('PUT')

                    <div class="row" style="padding-bottom:1%">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Category Name:</strong>
                                <input type="text" name="cname" id="cname" value="{{ $category->cname }}" class="form-control" placeholder="Enter Name">
                                @if ($errors->has('cname'))
                                <span class="text-danger">{{ $errors->first('cname') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Active</strong>:</strong>
                                <input name="active" value="Yes" type="radio" {{ $category->active == 'Yes' ? 'checked' : ''}} />Yes
                                <input name="active" value="No" type="radio" {{ $category->active == 'No' ? 'checked' : ''}} />No
                                @if ($errors->has('active'))
                                <span class="text-danger">{{ $errors->first('active') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection