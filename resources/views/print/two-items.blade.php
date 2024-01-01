<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ public_path('css/print.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    <title>Unique Natural LLC</title>


    <style>

    </style>
</head>

<body>
    <header style="display:inline';overflow:inherit ">

        <p style="margin-top:3px">Unique Natural LLC</p>


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
                                <P class="name">{{ $products[$i]->name }}</P>
                                <div class="mainDiv">

                                    <span class="price">Price : {{ $products[$i]->price }} $</span>
                                    <span class="SKU">SKU: {{ $products[$i]->SKU }}</span>

                                </div>
                            </div>
                        </td>

                        @if (isset($products[$i + 1]))
                            <td>
                                <div class="card second">
                                    <img class="image"
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $products[$i + 1]->image))) }}"
                                        alt="Denim Jeans">
                                    <P class="name">{{ $products[$i + 1]->name }}</P>
                                    <div class="mainDiv">

                                        <span class="price">Price : {{ $products[$i + 1]->price }} $</span>

                                        {{-- <span>
                                            <span class="item-number itemsIn"> Code :
                                                {{ $products[$i + 1]->item_number }}</span>
                                        </span> --}}

                                        <span class="SKU ">SKU: {{ $products[$i + 1]->SKU }}</span>

                                    </div>

                                </div>
                            </td>
                        @endif
                    </tr>

                </tbody>
            @endfor

        </table>
