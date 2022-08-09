@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 1rem;">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-header">{{ __('Pending Request') }}
                    <div class="pull-right">
                        <a class="btn btn-info" href="{{ route('admin.index') }}"> Admin</a>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <table class="table table-bordered" style="margin-top:1%;">
                    <tr style="background-color:#4a5568; color:white;">
                        <th width="80px">@sortablelink('id')</th>
                        <th>@sortablelink('name')</th>
                        <th>@sortablelink('email')</th>
                        <th>@sortablelink('gender')</th>
                        <th>@sortablelink('age')</th>
                        <th>@sortablelink('photo')</th>
                        <th>@sortablelink('status')</th>

                        @if (auth()->user()->usertype == '0' || auth()->user()->usertype == '1')
                        <th width="280px">Action</th>
                        @endif

                    </tr>
                    @foreach ($admin as $key => $value)
                    <tr style="text-align: center">
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->gender }}</td>
                        <td>{{ $value->approve }}</td>
                        <td> <img src="{{ asset('photos/' . $value->photo) }}" width="160" height="80"> </td>
                        <td>{{ $value->status }}</td>
                        <td>

                            <form method="get" action="{{route('admin.approve',$value->id) }}"> @csrf

                                <button type="submit">Approve</button>

                            </form>

                        </td>
                    </tr>
                    @endforeach
                </table>
                {{-- {!! $admin->appends(\Request::except('page'))->render() !!} --}}
            </div>
        </div>
    </div>
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
