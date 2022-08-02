@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __(' Edit Article') }}
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('articles.index') }}"> Back</a>
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

                <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" id="EditarticleForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-10 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>article Name:</strong>
                                <input type="text" name="article_name" class="form-control" value="{{ $article->article_name }}" placeholder="Enter article Name">
                            </div>
                            @if ($errors->has('article_name'))
                            <span class="text-danger">{{ $errors->first('article_name') }}</span>
                            @endif
                        </div>
                        <div class="col-xs-10 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Article Description</strong>:</strong>
                                <input type="text" name="article_description" class="form-control" value="{{ $article->article_description }}" placeholder="Enter article Description">
                            </div>
                            @if ($errors->has('article_description'))
                            <span class="text-danger">{{ $errors->first('article_description') }}</span>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Categories :</strong>
                                <select class="form-control" name="category">
                                    <option value="" disabled>Select</option>
                                    @foreach ($category as $key => $value)
                                    <option value="{{ $value->id }}" {{ $article->category == $value->id ? 'selected' : '' }}>{{ $value->cname }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>article Image</strong>:</strong>
                                <input type="file" name="image" class="form-control" value="{{ $article->image }}">
                            </div>
                            @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Status:</strong>
                                <select class="form-control" name="status">
                                    <option value="" disabled>Select</option>

                                    <option name="status" value="active" {{ $article->status=="active"? "selected" : "" }}>active</option>
                                    <option name="status" value="inactive" {{ $article->status=="inactive"? "selected" : "" }}>inactive</option>
                                </select>
                                @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
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
