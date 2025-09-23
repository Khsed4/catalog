<div class="row" id="maincontent">
    @foreach ($products as $product)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card">
                <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                    <img class="w-100" src='{{ url('images/' . $product->image) }}' alt="apple">
                    <div class="mask">
                        <div class="d-flex justify-content-start align-items-end h-100">
                            <h5>
                                <span class="badge bg-primary ms-2">{{ $product->SKU }}</span><span
                                    class="badge bg-success ms-2">Eco</span><span
                                    class="badge bg-danger ms-2">-10%</span>
                            </h5>
                        </div>
                    </div>
                    <div class="hover-overlay">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="" class="text-reset">
                        <h5 class="card-title mb-3">{{ $product->name }}</h5>
                    </a>
                    <a href="" class="text-reset">
                        <p>Category</p>
                    </a>
                    <h6 class="mb-3">
                        <s>$61.99</s><strong class="ms-2 text-danger">{{ $product->price }}</strong>
                    </h6>
                </div>
            </div>
        </div>
    @endforeach

    </div>

