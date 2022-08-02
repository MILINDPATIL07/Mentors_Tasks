<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <select name="category" id="category">
        <option value="">Select Category</option>

        @if( count ( $categories ) > 0 )

        @foreach ($categories as $category)

        <option value="{{ $category['id'] }}"> {{ $category->cname }}</option>

        @endforeach

        @endif
    </select>

    <table border="1" class="table table-bordered" width="100%">
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
                <td>{{ $product->category_id }}</td>
                <td><img src=" {{ asset('public/images/'. $product->image)}}" width="160" height="80"></td>
                <td>{{ $product->createdbyuserid }}</td>
                <td>{{ $product->active }}</td>

            </tr>
            @endforeach
            @endif

        </tbody>
    </table>

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
                                    <td> <img src="public/images/' + products[i]['image'] + '"width="160" height="80"> </td>\
                                    <td>  ' + products[i]['category_id'] + ' </td>\
                                    <td>  ' + products[i]['createdbyuserid'] + ' </td>\     </tr>';
                            }

                        } else {
                            html += '<tr>\     <td> No Data Found </td>\      </tr>';


                        }
                        $("#tbody").html(html);
                    }

                });

            });

        });
    </script>
</body>

</html>
