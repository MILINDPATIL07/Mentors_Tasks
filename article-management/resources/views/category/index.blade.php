@extends('layouts.app')

@section('content')
    {{-- <h1>Welcome to category list</h1> --}}

    <div class="container">
        <div class="row justify-content-center" style="margin-top: 3rem;">

            <div class="col-lg-12 margin-tb">
                <div class="card">
                    <div class="card-header">{{ __(' Category Dashboard') }}

                        @if (auth()->user()->usertype == '0')
                            <div class="pull-right">
                                <a class="btn btn-info" href="{{ route('admin.index') }}">Admin</a>
                                <a class="btn btn-primary" href="{{ route('category.create') }}"> Create New Category</a>
                            </div>
                        @endif

                        @if (auth()->user()->usertype == '1')
                            <div class="pull-right">
                                <a class="btn btn-info" href="{{ route('admin.index') }}">Admin</a>
                            </div>
                        @endif
                        <div class="pull-right">
                            <a href="{{ route('category.export') }}" class="btn btn-primary"> Export Data to Excel</a>
                        </div>
                    </div>
                    <div class="card-body">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('warning'))
                            <div class="alert alert-warning alert-block">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('info'))
                            <div class="alert alert-info alert-block">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                Check the following errors :(
                            </div>
                        @endif

                        <table class="table table-bordered" style="margin-top:1%;">
                            <tr style="background-color:#4a5568; color:white;">
                                <th>Category No</th>
                                <th>Category Name</th>
                                <th>Active</th>
                                @if (auth()->user()->usertype == '0')
                                    <th width="280px">Action</th>
                                @endif
                            </tr>
                            @foreach ($data as $category)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $category->cname }}</td>
                                    <td>{{ $category->status }}</td>

                                    @if (auth()->user()->usertype == '0')
                                        <td>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                <a class="btn btn-primary"
                                                    href="{{ route('category.edit', $category->id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm"
                                                    data-toggle="tooltip" title='Delete'>Delete</button>
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

    {{-- script for delete confirmation --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
