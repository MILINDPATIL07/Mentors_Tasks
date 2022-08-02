@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 1rem;">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-header">{{ __('Articles Dashboard') }}
                    <div class="pull-right">
                        <a class="btn btn-info" href="{{ route('admin.index') }}"> Admin</a>
                        <a class="btn btn-primary" href="{{ route('articles.create') }}">Add New article</a>
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
                        <th>@sortablelink('article_name')</th>
                        <th>@sortablelink('article_description')</th>
                        <th>@sortablelink('category')</th>
                        <th>@sortablelink('image')</th>
                        <th>@sortablelink('created_by')</th>
                        <th>@sortablelink('status')</th>

                        @if (auth()->user()->usertype == '0' || auth()->user()->usertype == '1')
                        <th width="280px">Action</th>
                        @endif

                    </tr>
                    @foreach ($article as $key => $value)
                    <tr style="text-align: center">
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->article_name }}</td>
                        <td>{{ $value->article_description }}</td>
                        <td>{{ $value->cname }}</td>
                        <td> <img src="{{ asset('images/' . $value->image) }}" width="160" height="80"> </td>
                        <td>{{ $value->created_by }}</td>

                        <td>{{ $value->status }}</td>
                        <td>

                            <form method="get" action="{{route('admin.accept',$value->id) }}"> @csrf

                                <button type="submit">Approve</button>

                            </form>

                        </td>
                    </tr>
                    @endforeach
                </table>
                {{-- {!! $article->appends(\Request::except('page'))->render() !!} --}}
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
