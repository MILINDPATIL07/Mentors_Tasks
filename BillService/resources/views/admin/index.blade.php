@extends('layouts.app')
@section('content')
{{-- <h1>welcome to admin list</h1> --}}

{{-- @php
echo "<pre>";
print_r($data);
echo "</pre>";
@endphp --}}



<div class="container" style="width:90% !important;">
    <div class="row justify-content-center " style="margin-top: 3rem;">
        <form method="GET" action="{{ route('admin.index') }}" style="margin: left;">
            <div class="row">
                <label for="filter" class="col-md-4 col-form-label text-md-end" >{{ __('Filter') }}</label>

            <select name="filter" class="col-md-4 col-form-label">
                    <option value="">Select</option>
                    @foreach($services as $service)
                    <option value=" {{$service->id}}"> {{ $service->Service_Type }}</option>
                    @endforeach
                    </select>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('submit') }}
                        </button>
                    </div>
                    @error('filter')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>

        </form>
        <div class="col-lg-12 margin-tb">
            <div class="card">

                <div class="card-header">{{ __(' Admin Dashboard') }}

                    @if (auth()->user()->usertype == '0')
                    <div class="pull-right">

                        <a class="btn btn-primary" href="{{ route('admin.create') }}"> Create New User</a>
                        {{-- <a class="btn btn-success" href="/admin/show">Pending Articals Requests</a> --}}
                    </div>
                    @endif

                    <div class="pull-right">
                        <a href="{{ route('admin.export') }}" class="btn btn-primary"> Export Data to Excel</a>
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

                        <tr style="background-color:#4a5568; color:white; ">
                            <th width="80px">@sortablelink('id')</th>
                            <th>@sortablelink('name')</th>
                            <th>@sortablelink('email')</th>
                            <th>@sortablelink('gender')</th>
                            <th>@sortablelink('age')</th>
                            <th>@sortablelink('status')</th>
                            <th>@sortablelink('approve')</th>
                            <th>@sortablelink('services')</th>
                            <th>@sortablelink('photo')</th>

                            <th>Action</th>
                            @if (auth()->user()->usertype == '0')
                            <th width="200px"> Status Action</th>
                            @endif
                        </tr>
                        @foreach ($data as $key => $value)
                        <tr style="text-align: center">
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->gender }}</td>
                            <td>{{ $value->age }}</td>
                            <td>{{ $value->status }}</td>
                            <td>{{ $value->approve }}</td>
                            <td>
                                @foreach ($value->services as $service)
                                {{ $service->Service_Type }},
                                @endforeach
                            <td>

                            <td> <img src="{{ asset('photos/' . $value->photo) }}" width="160" height="80">
                                @if(auth()->user()->usertype == '0')
                            <td> <a class="btn btn-primary" href="{{ route('admin.active', $value->id) }}">Active</a>
                                <a class="btn btn-danger" href="{{ route('admin.inactive', $value->id) }}">Inactive</a>
                            </td>
                            @endif
                            </td>
                            @if (auth()->user()->usertype == '0' || auth()->user()->id == $value->id)
                            <td>
                                @if (auth()->user()->usertype == '1' || auth()->user()->id == $value->id)
                                <a class="btn btn-info" href="{{ route('admin.edit', $value->id) }}">Edit</a>
                                @endif

                                @if (auth()->user()->usertype == '0' && $value->approve == 'F')
                                <a class="btn btn-ls btn-info btn-flat approve_confirm" href="{{ route('admin.approve', $value->id) }}">Approve</a>
                                @endif
                                <form action="{{ route('admin.destroy', $value->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @if (auth()->user()->usertype == '0')
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                                    @endif
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $data->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
        {{-- {!! $data->links() !!} --}}
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
