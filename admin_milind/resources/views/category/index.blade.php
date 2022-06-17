@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center" style="margin-top: 3rem;">

        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-header">{{ __(' Category Dashboard') }}
                    @if(auth()->user()->usertype == '0' || auth()->user()->usertype == '1')
                    <div class="pull-right">
                        <a class="btn btn-info" href="{{ route('admin.index') }}"> Admin Home</a>
                        <!-- <a class="btn btn-info" href="{{ route('product.index') }}"> Product</a> -->
                        <a class="btn btn-primary" href="{{ route('category.create') }}"> Create New Category</a>
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
                        <tr style="background-color:#4a5568; color:white;">
                            <th>Category No</th>
                            <th>Category Name</th>
                            <th>Active</th>
                            @if(auth()->user()->usertype == '0' || auth()->user()->usertype == '1')
                            <th width="280px">Action</th>
                            @endif
                        </tr>
                        @foreach($data as $category)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $category->cname }}</td>
                            <td>{{ $category->active }}</td>

                            @if(auth()->user()->usertype == '0' || auth()->user()->usertype == '1')
                            <td>
                                <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                                    <a class="btn btn-primary" href="{{ route('category.edit',$category->id) }}">Edit</a>
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
    </div>
    {!! $data->links() !!}
</div>
@endsection