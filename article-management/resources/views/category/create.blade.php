@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

            <div class="col-lg-12 margin-tb">
                <div class="card">
                    <div class="card-header">{{ __(' Create New Category') }}
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

                    <form action="{{ route('category.store') }}" method="POST" id="catregForm">
                        @csrf
                        <div class="row mb-3">
                            <div class="row" style="padding-bottom:1%">
                                <div class="col-md-6">
                                    <strong>Category Name:</strong>
                                    <input type="text" name="cname" id="cname" class="form-control"
                                        placeholder="Enter Category Name">
                                    @if ($errors->has('cname'))
                                        <span class="text-danger">{{ $errors->first('cname') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Active:</strong>
                                    <input name="status" value="active" type="radio" />active
                                    <input name="status" value="inactive" type="radio" />inactive
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
