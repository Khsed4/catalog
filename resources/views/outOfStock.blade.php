resources/views/products-print.blade.php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Natural LLC</title>


    <style>
        header {
            position: fixed;
            top: 5px;
            border: 3px solid gray;
            left: 0px;
            right: 0px;
            background-color: lightblue;
            height: 30px;
            text-align: center;
            color: #656262;
        }

        table {
            width: 100%;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 100%;
            height: 80vh;
            margin-top: 90px;
            /* margin-left: 90px; */
            text-align: center;
            font-family: arial;
            margin-right: 15px;
            border: 3px solid rgb(12, 12, 12);
            position: relative;
        }

        .image {
            max-width: 100%;
            max-height: 47vh;
            margin-top: 8px;

        }

        .price {
            color: grey;
            font-size: 22px;
        }




        .second {
            page-break-after: always;
        }

        .page {
            height: 100vh;
            width: 100%;
            margin-right: 10px;


        }

        body {
            background-color: #f2f2f2;
        }

        .name {
            width: 82%;
            position: absolute;
            bottom: 100px;
            font-size: 3vh;

            -webkit-border-radius: 28;
            -moz-border-radius: 28;
            border-radius: 28px;
            font-family: Arial;
            color: #ffffff;
            font-size: 20px;
            background: #2690ed;
            padding: 5px 20px 5px 20px;
            border: solid #ebe4e4 2px;
            text-decoration: none;
            font-weight: bolder;
            right: 50px;
            left: 15px;
            border: solid #ebe4e4 2px;
            text-decoration: none;
        }

        .price {
            display: block;
            float: left;
            margin-left: 10px;
            -webkit-border-radius: 28;
            -moz-border-radius: 28;
            border-radius: 28px;
            font-family: Arial;
            color: #ffffff;
            font-size: 20px;
            background: rgb(230, 83, 83);
            padding: 5px 20px 5px 20px;
            border: solid #ebe4e4 2px;
            text-decoration: none;
            position: absolute;
            bottom: 3px;
            right: 8px;



        }
        .quantity {
margin-left: auto;
width: 30%;

            -webkit-border-radius: 28;
            -moz-border-radius: 28;
            border-radius: 28px;
            font-family: Arial;
            color: #ffffff;
            font-size: 20px;
            background: rgb(243, 7, 7);
            padding: 5px 20px 5px 20px;
            border: solid #ebe4e4 2px;





        }

        .SKU {
            float: right;
            margin-right: 10px;
            background: #60e00a !important;
            background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
            background-image: -moz-linear-gradient(top, #3498db, #2980b9);
            background-image: -ms-linear-gradient(top, #3498db, #2980b9);
            background-image: -o-linear-gradient(top, #3498db, #2980b9);
            background-image: linear-gradient(to bottom, #3498db, #2980b9);
            -webkit-border-radius: 28;
            -moz-border-radius: 28;
            border-radius: 28px;
            font-family: Arial;
            color: #ffffff;
            font-size: 20px;
            padding: 5px 20px 5px 20px;
            text-decoration: none;
            position: absolute;
            bottom: 3px;
            left: 8px;


        }

        .item-number {
            visibility: hidden;
            -webkit-border-radius: 28;
            -moz-border-radius: 28;
            border-radius: 28px;
            font-family: Arial;
            color: #ffffff;
            font-size: 20px;
            background: gray;
            padding: 5px 20px 5px 20px;
            border: solid #ebe4e4 2px;
            text-decoration: none;
            font-weight: bolder;
        }
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
                                <p class="item-number"> Item Number: : {{ $products[$i]->item_number }}</p>

                                    <p class="price">Out Of Stock</p>



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

                                    <p class="price">Out Of Stock</p>
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
