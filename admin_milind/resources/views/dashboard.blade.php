@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Tranning Assignment</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        table tr th {
            text-align: center;
        }
    </style>
</head>
<div class="" style="text-align: right;padding-right:190px;">
    <span>Select Category : </span>
        <select name="category" id="category">
            <option value=" " selected="">Select </option>
            @if( count ( $categories ) > 0 )
            @foreach ($categories as $category)
            <option value="{{ $category['id'] }}"> {{ $category->cname }}</option>
            @endforeach
            @endif
        </select>
</div>
<body class="antialiased">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
                    @if(auth()->user())
                    <div class="pull-right">
                        <a class="btn btn-info" href="{{ route('admin.index') }}"> Admin Home</a>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr style="background-color:#4a5568; color:white;">
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Category Name</th>
                            <th>Product Image</th>
                            <th>created by user</th>
                            <th>Active</th>
                        </tr>
                        <tbody id="tbody">
                            @if(count($products) > 0)
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product['id'] }}</td>
                                <td>{{ $product->pname }}</td>
                                <td>{{ $product->cname }}</td>
                                <td><img src=" {{ asset('public/images/'. $product->image)}}" width="160" height="80"></td>
                                 <td>{{ $product->createdbyuserid }}</td>
                                <td>{{ $product->active }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!--  -->
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

                                        var products = data.products;
                                        var html = '';
                                        if (products.length > 0) {
                                            for (let i = 0; i < products.length; i++) {

                                                html += '<tr>\
                                                        <td>  ' + products[i]['id'] + ' </td>\
                                                        <td>  ' + products[i]['pname'] + '</td>\
                                                        <td>  ' + products[i]['cname'] + ' </td>\
                                                        <td> <img src="public/images/' + products[i]['image'] + '"width="160" height="80"> </td>\
                                                        <td>  ' + products[i]['createdbyuserid'] + ' </td>\
                                                           <td>  ' + products[i]['active'] + ' </td>\     </tr>';
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
</body>

</html>
@endsection