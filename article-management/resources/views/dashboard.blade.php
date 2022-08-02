@extends('layouts.app')

@section('content')
<div class="" style="text-align: right;padding-right:190px;">
    <span>Filter Category : </span>
    <select name="category" id="category">
        <option value="" selected="" disabled>Select </option>
        @if( count ( $cat ) > 0 )
        @foreach ($cat as $category)
        <option value="{{ $category['id'] }}"> {{ $category->cname }}</option>
        @endforeach
        @endif
    </select>
</div>
<div class="container">
    <div class="row justify-content-center" style="margin-top: 1rem;">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-header">{{ __('Articles Dashboard') }}
                    <div class="pull-right">
                        <a class="btn btn-info" href="{{ route('admin.index') }}"> Admin</a>
                        <a class="btn btn-primary" href="{{ route('articles.create') }}">Add New article</a>
                        <a href="{{ route('articles.export') }}" class="btn btn-primary">Export To Excel</a>
                    </div>
                </div>
                <table class="table table-bordered" style="margin-top:1%;">
                    <tr style="background-color:#4a5568; color:white;">
                        <th width="80px">@sortablelink('id')</th>
                        <th>@sortablelink('article_name')</th>
                        <th>@sortablelink('article_description')</th>
                        <th>@sortablelink('category')</th>
                        <th>@sortablelink('image')</th>
                        <th>@sortablelink('created_by')</th>
                        <th>@sortablelink('status')</th>
                    </tr>
                    <tbody id="tbody">
                        @foreach ($articles as $key => $value)
                        <tr style="text-align: center">
                            <td>{{ ++$i }}</td>
                            <td>{{ $value->article_name }}</td>
                            <td>{{ $value->article_description }}</td>
                            <td>{{ $value->cname }}</td>
                            <td> <img src="{{ asset('images/' . $value->image) }}" width="160" height="80"> </td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->status }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- {{-- {!! $article->appends(\Request::except('page'))->render() !!} --}} -->
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
<script>
    $(document).ready(function() {
        $("#category").on('change', function() {
            var category = $(this).val();
            $.ajax({
                url: "{{ route ('filter') }}",
                type: "GET",
                data: {
                    'category': category
                },
                success: function(data) {
                    console.log(data);
                    var articles = data.articles;
                    var html = '';
                    if (articles.length > 0) {
                        for (let i = 0; i < articles.length; i++) {
                            html += '<tr>\
                                                        <td>  ' + articles[i]['id'] + ' </td>\
                                                        <td>  ' + articles[i]['article_name'] + ' </td>\
                                                        <td>  ' + articles[i]['article_description'] + '</td>\
                                                        <td>  ' + articles[i]['cname'] + ' </td>\
                                                        <td> <img src="images/' + articles[i]['image'] + '"width="160" height="80"> </td>\
                                                        <td>  ' + articles[i]['name'] + ' </td>\
                                                           <td>  ' + articles[i]['status'] + ' </td>\     </tr>';
                        }
                    } else {
                        html +=
                            '<tr>\     <td> No Data Found </td>\      </tr>';
                    }
                    $("#tbody").html(html);
                }
            });
        });
    });
</script>
@endsection
