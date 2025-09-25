<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    <title>Unique Natural LLC</title>
</head>

<body>
    <div class="page">
        <!-- Product Section -->
        <div class="product-container">
            @for ($i = 0; $i < count($products); $i += 4)
                <div class="page-section">
                    <!-- First Product -->
                    <div class="product-card">
                        <img class="image" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $products[$i]->image))) }}" alt="Product Image" />
                        <div class="info">
                            <p class="name">{{ $products[$i]->name }}</p>
                            <span class="SKU">{{ $products[$i]->SKU }}</span>
                        </div>
                        <div class="mainDiv">
                            @if ($products[$i]->SKU == 1907 or $products[$i]->SKU == 1908 or $products[$i]->SKU == 1924 or $products[$i]->SKU == 1925 or $products[$i]->SKU == 1926)
                                <span class="price">Price: ${{ $products[$i]->price }} /Set</span>
                            @else
                                <span class="price">Price: ${{ $products[$i]->price }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Second Product if available -->
                    @if (isset($products[$i + 1]))
                        <div class="product-card">
                            <img class="image" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $products[$i + 1]->image))) }}" alt="Product Image" />
                            <div class="info">
                                <p class="name">{{ $products[$i + 1]->name }}</p>
                                <span class="SKU">{{ $products[$i + 1]->SKU }}</span>
                            </div>
                            <div class="mainDiv">
                                @if ($products[$i + 1]->SKU == 1907 or $products[$i + 1]->SKU == 1908 or $products[$i + 1]->SKU == 1924 or $products[$i + 1]->SKU == 1925 or $products[$i + 1]->SKU == 1926)
                                    <span class="price">Price: ${{ $products[$i + 1]->price }} /Set</span>
                                @else
                                    <span class="price">Price: ${{ $products[$i + 1]->price }}</span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Third Product if available -->
                    @if (isset($products[$i + 2]))
                        <div class="product-card">
                            <img class="image" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $products[$i + 2]->image))) }}" alt="Product Image" />
                            <div class="info">
                                <p class="name">{{ $products[$i + 2]->name }}</p>
                                <span class="SKU">{{ $products[$i + 2]->SKU }}</span>
                            </div>
                            <div class="mainDiv">
                                @if ($products[$i + 2]->SKU == 1907 or $products[$i + 2]->SKU == 1908 or $products[$i + 2]->SKU == 1924 or $products[$i + 2]->SKU == 1925 or $products[$i + 2]->SKU == 1926)
                                    <span class="price">Price: ${{ $products[$i + 2]->price }} /Set</span>
                                @else
                                    <span class="price">Price: ${{ $products[$i + 2]->price }}</span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Fourth Product if available -->
                    @if (isset($products[$i + 3]))
                        <div class="product-card">
                            <img class="image" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $products[$i + 3]->image))) }}" alt="Product Image" />
                            <div class="info">
                                <p class="name">{{ $products[$i + 3]->name }}</p>
                                <span class="SKU">{{ $products[$i + 3]->SKU }}</span>
                            </div>
                            <div class="mainDiv">
                                @if ($products[$i + 3]->SKU == 1907 or $products[$i + 3]->SKU == 1908 or $products[$i + 3]->SKU == 1924 or $products[$i + 3]->SKU == 1925 or $products[$i + 3]->SKU == 1926)
                                    <span class="price">Price: ${{ $products[$i + 3]->price }} /Set</span>
                                @else
                                    <span class="price">Price: ${{ $products[$i + 3]->price }}</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    <!-- Footer with Header Content (Aligned to the Bottom) -->
    <div class="footer">
        <div class="contact-info">
            <p>uniquenaturalllc@gmail.com</p>
            <p>+1 (240) 605 1416</p>
        </div>
    </div>
</body>

</html>
