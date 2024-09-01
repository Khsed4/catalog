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
        body {
            box-sizing: border-box;
            height: 100%;
        }



        .button-69 {
            font-weight: bolder;
        }

        .main-container {
            display: flex;
            flex-direction: row;
            margin-top: 5px
        }

        .first-section {
            height: 200px;
            width: 50%;
            align-self: flex-start;
        }

        .second-section {
            height: 200px;
            width: 50%;
            align-self: flex-end
        }

        .button-69 {
            background-color: initial;
            background-image: linear-gradient(#8614f8 0, #760be0 100%);
            border-radius: 5px;
            border-style: none;
            box-shadow: rgba(245, 244, 247, .25) 0 1px 1px inset;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-family: Inter, sans-serif;
            font-size: 20px;
            font-weight: 500;
            height: 60px;
            width: 200px;
            line-height: 60px;
            margin-left: -4px;
            outline: 0;
            text-align: center;
            transition: all .3s cubic-bezier(.05, .03, .35, 1);
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: bottom;
        }



        @media screen and (max-width: 1000px) {
            .button-69 {
                font-size: 14px;
                height: 55px;
                line-height: 55px;
                width: 150px;
            }
        }

        .name {
            margin: 1px
        }

        .avail-text {
            margin-top: 12px;
            margin-bottom: 1px;
            margin-left: 50px;
            text-align: start;
            color: #0a5ead
        }

        li {
            text-align: start;
            padding: 0;
            color: rgb(20, 19, 19);
            font-size: 22px;
        }

        ul {
            margin-top: 3px;
        }
    </style>
</head>

<body>
    <header style="display:inline';overflow:inherit ">

        <p style="margin-top:3px">Unique Natural LLC</p>


    </header>

    <div class="page" style="height: 100vh">

        <table>


            @for ($i = 0; $i < count($products); $i += 2)
                <tbody>
                    <tr>
                        <td>
                            <div class="card second">
                                <img class="image"
                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $products[$i]->image))) }}"
                                    alt="Denim Jeans">
                                <P class="name">{{ $products[$i]->name }}</P>
                                <div class="main-container">
                                    <ul>
                                        @foreach (explode(',', $products[$i]->description) as $row)
                                            <li>{{ $row }}</li>
                                        @endforeach

                                    </ul>
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

                                    <div class="main-container">
                                        <ul>

                                            @foreach (explode(',', $products[$i + 1]->description) as $row)
                                                <li>{{ $row }}</li>
                                            @endforeach

                                        </ul>
                                    </div>



                                </div>

                            </td>
                        @endif
                    </tr>

                </tbody>
            @endfor

        </table>
    </div>
</body>

</html>
