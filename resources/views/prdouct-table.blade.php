<div class="row" id="maincontent">
    @foreach ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100" style="border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.08); transition: transform 0.2s, box-shadow 0.2s;">
                <div style="position: relative; padding-top: 100%; background: #f8f8f8;">
                    <img src='{{ url('images/' . $product->image) }}' alt="{{ $product->name }}"
                         style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain; padding: 12px;">
                </div>
                <div class="card-body d-flex flex-column" style="padding: 14px 16px;">
                    <h6 class="mb-1" style="font-weight: 600; color: #1B3A5C; font-size: 14px; line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $product->name }}
                    </h6>
                    @if(isset($product->category_name))
                    <small class="text-muted mb-2" style="font-size: 12px;">{{ $product->category_name }}</small>
                    @endif
                    <div class="mt-auto d-flex justify-content-between align-items-center" style="padding-top: 8px; border-top: 1px solid #f0f0f0;">
                        <span style="font-size: 18px; font-weight: 700; color: #1B3A5C;">${{ number_format($product->price, 2) }}</span>
                        <span class="badge" style="background: #1B3A5C; color: #C8941A; font-size: 11px; padding: 4px 8px; border-radius: 4px;">{{ $product->SKU }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
