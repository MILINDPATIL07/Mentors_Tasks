@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center" style="margin-top: 1rem;">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-header">{{ __('PRODUCT DASHBOARD') }}
                    <div class="pull-right">
                        <a class="btn btn-info" href="{{ route('admin.index') }}"> Admin Home</a>
                        <a class="btn btn-primary" href="product/create">Add New Product</a>
                    </div>
                </div>

                <table class="table table-bordered" style="margin-top:1%;">
                    <tr style="background-color:#4a5568; color:white;">
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Product Image</th>
                        <th>Created By User </th>
                        <th>Active</th>
                        @if(auth()->user()->usertype == '0' || auth()->user()->usertype == '1')
                        <th width="280px">Action</th>
                        @endif

                    </tr>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $value->pname }}</td>
                        <td>{{ $value->cname }}</td>
                        <td><img src=" {{ asset('public/images/' . $value->image)}}" width="160" height="80"> </td>
                        <td>{{ $value->createdbyuserid }}</td>
                        <td>{{ $value->active }}</td>

                        <td>
                            <form action="{{ route('product.destroy',$value->id) }}" method="POST">

                                <a class="btn btn-primary" href="{{ route('product.edit',$value->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection