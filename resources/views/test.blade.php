<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <p>
    <ol>
        @foreach (explode(',', $test) as $row)
            <li>{{ $row }}</li>
        @endforeach
    </ol>

    </p>
</body>

</html>
