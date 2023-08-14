<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="{{ asset('css/print.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ public_path('/css/print.css')}}"> 
    <title>Unique Natural LLC</title>


    <style>

    </style>
</head>

<body>
    <header style="display:inline';overflow:inherit ">

        <p style="margin-top:2px;font-size: 25px;font-weight: bold">Unique Natural LLC</p>


    </header>

    <div class="page">

        <table>


            @for ($i = 0; $i < count($products); $i += 2)
                <tbody>


                    <tr>

                        <td>
                            <div class="card">
                                <img class="image"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $products[$i]->image))) }}">
                                {{-- <p class="quantity"> Out Of stock  </p> --}}
                                <P class="name">{{ $products[$i]->name }}</P>


                                <p class="price">Price : {{ $products[$i]->price }} $</p>



                                <p class="SKU"> SKU : {{ $products[$i]->SKU }} </p>

                            </div>
                        </td>


                        <td>

                            <div class="card second">
                                <img class="image"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $products[$i + 1]->image))) }}"
                                    alt="Denim Jeans">
                                <P class="name">{{ $products[$i + 1]->name }}</P>
                                <p class="item-number"> Item Number: : {{ $products[$i + 1]->item_number }}</p>

                                <p class="price">Price : {{ $products[$i + 1]->price }} $</p>



                                <p class="SKU">SKU: {{ $products[$i + 1]->SKU }}</p>

                            </div>
                        </td>


                    </tr>

                </tbody>
            @endfor

        </table>



    </div>


</body>

</html>
