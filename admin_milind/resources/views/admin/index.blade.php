@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 3rem;">
        <div class="col-lg-12 margin-tb">
            <div class="card">

                <div class="card-header">{{ __(' Admin Dashboard') }}
                    @if(auth()->user()->usertype == '0')
                    <div class="pull-right">
                        <a class="btn btn-info" href="{{ route('category.index') }}"> Category</a>
                        <a class="btn btn-info" href="{{ route('product.index') }}"> Product</a>
                        <a class="btn btn-primary" href="{{ route('admin.create') }}"> Create New Admin</a>

                    </div>
                    @endif

                    @if(auth()->user()->usertype == '1')
                    <div class="pull-right">
                        <a class="btn btn-info" href="{{ route('category.index') }}"> Category</a>
                        <a class="btn btn-info" href="{{ route('product.index') }}"> Product</a>
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <table class="table table-bordered" style="margin-top:1%;">
                        <tr style="background-color:#4a5568; color:white; ">
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Hobbies</th>
                            @if(auth()->user()->usertype == '0')
                            <th width="280px">Action</th>
                            @endif
                        </tr>
                        @foreach($data as $key => $value)
                        <tr style="text-align: center">
                            <td>{{ ++$i }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->gender }}</td>
                            <td>@foreach ( $value->hobbies as $values )
                                {{$values }}
                                @endforeach
                            </td>

                            @if(auth()->user()->usertype == '0')
                            <td>
                                <form action="{{ route('admin.destroy',$value->id) }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('admin.edit',$value->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        {!! $data->links() !!}
    </div>    
    @endsection