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

    <div class="page">
        <div class="header" style="display:inline' ;overflow:inherit ">
            <div>
                <p style="margin-top:2px;font-size: 35px;font-weight: bold">uniquenaturalllc@gmail.com</p>
            </div>
            <div>
                <p style="margin-top:2px;font-size: 35px;font-weight: bold">+1 (240) 605 1416</p>
            </div>
            </div>
        <table>
            @for ($i = 0; $i < count($products); $i += 2)
                <tbody>
                    <tr>
                        <td>
                            <div class="card ">
                                <div>
                                    <P class="name">{{ $products[$i]->name }}</P>
                                </div>
                                <div>
                                    <img class="image"
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $products[$i]->image))) }}"
                                        alt="Denim Jeans" />
                                </div>

                                <div class="mainDiv">
                                    @if ($products[$i]->discount_price > 0)
                                        <span class="price">
                                            Price:
                                            <span class="off-price">
                                                {{ $products[$i]->price }}$
                                            </span>
                                            <span>{{ $products[$i]->discount_price }}</span>
                                        </span>
                                    @else
                                        <span class="price">Price:${{ $products[$i]->price }}</span>
                                    @endif


                                    <span class="SKU ">SKU: {{ $products[$i]->SKU }}</span>

                                </div>

                            </div>
                        </td>

                        @if (isset($products[$i + 1]))
                            <td>
                                <div class="card second">
                                    <div class="title">
                                        <P class="name">{{ $products[$i + 1]->name }}</P>
                                    </div>
                                    <div class="image-div">
                                        <img class="image"
                                            src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $products[$i + 1]->image))) }}"
                                            alt="Denim Jeans" />

                                    </div>

                                    <div class="mainDiv">
                                        @if ($products[$i + 1]->discount_price > 0)
                                            <span class="price">
                                                Price:
                                                <span class="off-price">
                                                    {{ $products[$i + 1]->price }}$
                                                </span>
                                                <span>${{ $products[$i + 1]->discount_price }}</span>
                                            </span>
                                        @else
                                            <span class="price">Price:${{ $products[$i + 1]->price }}</span>
                                        @endif


                                        <span class="SKU ">SKU: {{ $products[$i + 1]->SKU }}</span>

                                    </div>

                                </div>
                            </td>
                        @endif
                    </tr>

                </tbody>
            @endfor

        </table>
