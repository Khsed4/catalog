<div class="card">
    <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
        <img src="{{ public_path('images/' . $product->image) }}" class="w-100" />
        <a href="#!">
            <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                    <h5>
                        <span class="badge bg-primary ms-2">New</span>
                    </h5>
                </div>
            </div>
            <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251,251,251,0.15);"></div>
            </div>
        </a>
    </div>
    <div class="card-body">
        <a href="" class="text-reset">
            <h5 class="card-title mb-3">{{ $product->name }}</h5>
        </a>
        <a href="" class="text-reset"><p>{{ $product->category }}</p></a>
        <h6 class="mb-3">$61.99</h6>
    </div>
</div>