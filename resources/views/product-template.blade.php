<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            box-sizing: border-box;
            min-height: 100vh;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {

            background-color: white;
            max-width: 1000px;
            min-height: 100px;
            align-self: center;
        }

        .myImages {
            height: 600px;
            width: 450px;
            object-fit: cover;
        }

        .items {}
    </style>
</head>

<body>
    <section class="container">

        <img src="{{ public_path('images/' . $product->image) }} " class="myImages" />
        <h3>Rug Code :A01 </h3>
        <h3>Available Sizes</h3>
        <h4>
            12 meters: 3m x 4m (9.8 ft x 13ft ft)
            12 meters: 3m x 4m (9.8 ft x 13ft ft)
            12 meters: 3m x 4m (9.8 ft x 13ft ft)
        </h4>

    </section>
</body>

</html>
