<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="{{ asset('css/print.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ public_path('/css/print.css') }}">
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


            @for ($i = 0; $i < count($products); $i += 1)
                <tbody>


                    <tr>

                        <td>
                            <div class="card" style="width: 100% !important">
                                <img class="image"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $products[$i]->image))) }}">
                                {{-- <p class="quantity"> Out Of stock  </p> --}}
                                <P class="name">{{ $products[$i]->name }}</P>


                                <p class="price">Price : {{ $products[$i]->price }} $</p>



                                <p class="SKU"> SKU : {{ $products[$i]->SKU }} </p>

                            </div>
                        </td>
                    </tr>

                </tbody>
            @endfor

        </table>



    </div>


</body>

</html>
