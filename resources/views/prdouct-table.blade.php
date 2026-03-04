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
                    <div class="mt-auto" style="padding-top: 8px; border-top: 1px solid #f0f0f0;">
                        <div class="d-flex justify-content-between align-items-center">
                            @if($product->original_price && $product->original_price > $product->price)
                                <span>
                                    <span style="font-size: 13px; color: #999; text-decoration: line-through;">${{ number_format($product->original_price, 2) }}</span>
                                    <span style="font-size: 18px; font-weight: 700; color: #C8941A;">${{ number_format($product->price, 2) }}</span>
                                </span>
                            @else
                                <span style="font-size: 18px; font-weight: 700; color: #1B3A5C;">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        @if($product->set_price)
                            <div style="font-size: 13px; color: #666; margin-top: 2px;">Set: <strong style="color: #1B3A5C;">${{ number_format($product->set_price, 2) }}</strong></div>
                        @endif
                        <div class="d-flex justify-content-end" style="margin-top: 4px;">
                            <span class="badge" style="background: #1B3A5C; color: #C8941A; font-size: 11px; padding: 4px 8px; border-radius: 4px;">{{ $product->SKU }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
