<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Product Catalogue' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @page {
            margin: 0;
            size: A4 portrait;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', Arial, Helvetica, sans-serif;
            color: #222;
            background: #fff;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* ── Page Shell ─────────────────────────────── */
        .page {
            width: 794px;
            height: 1123px;
            position: relative;
            page-break-after: always;
            page-break-inside: avoid;
            overflow: hidden;
        }

        /* ── Wide Blue Decorative Border ───────────── */
        .page-border {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #1B3A5C;
            background-image:
                repeating-linear-gradient(0deg, transparent, transparent 11px, rgba(200, 148, 26, 0.07) 11px, rgba(200, 148, 26, 0.07) 12px),
                repeating-linear-gradient(90deg, transparent, transparent 11px, rgba(200, 148, 26, 0.07) 11px, rgba(200, 148, 26, 0.07) 12px);
        }

        .page-border::before {
            content: '';
            position: absolute;
            top: 4px;
            left: 4px;
            right: 4px;
            bottom: 4px;
            border: 2px solid #C8941A;
            pointer-events: none;
        }

        .page-border::after {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            border: 1.5px solid rgba(200, 148, 26, 0.45);
            pointer-events: none;
        }

        /* ── Cream Interior ─────────────────────────── */
        .page-inner {
            position: absolute;
            top: 24px;
            left: 24px;
            right: 24px;
            bottom: 24px;
            background: #FBF7F0;
            display: flex;
            flex-direction: column;
        }

        /* ═══ COVER PAGE ════════════════════════════════ */
        .cover-inner {
            position: absolute;
            top: 24px;
            left: 24px;
            right: 24px;
            bottom: 24px;
            background: #FBF7F0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .cover-logo {
            max-width: 260px;
            max-height: 180px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .cover-company {
            font-family: 'Great Vibes', 'Brush Script MT', cursive;
            font-size: 68px;
            color: #1B3A5C;
            margin-bottom: 8px;
        }

        .cover-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 36px;
            font-weight: 700;
            color: #1B3A5C;
            letter-spacing: 6px;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .cover-rule {
            width: 120px;
            height: 2.5px;
            background: #C8941A;
            margin-bottom: 24px;
        }

        .cover-subtitle {
            font-size: 22px;
            color: #555;
            letter-spacing: 2px;
            margin-bottom: 40px;
        }

        .cover-contact {
            font-size: 16px;
            color: #666;
            margin: 5px 0;
        }

        /* ═══ PAGE HEADER ═══════════════════════════════ */
        .page-header {
            text-align: center;
            padding: 14px 20px 8px;
            flex-shrink: 0;
        }

        .hdr-company {
            font-family: 'Great Vibes', 'Brush Script MT', cursive;
            font-size: 28px;
            color: #1B3A5C;
        }

        .hdr-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 14px;
            font-weight: 700;
            color: #1B3A5C;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .hdr-rule {
            width: 50px;
            height: 1.5px;
            background: #C8941A;
            margin: 5px auto 0;
        }

        /* ═══ 2x2 PRODUCT GRID ═════════════════════════ */
        .products-grid {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 12px;
            padding: 8px 16px 10px;
            min-height: 0;
        }

        /* ═══ PRODUCT CARD ═════════════════════════════ */
        .product-card {
            background: #fff;
            border: 1px solid #333;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.06);
        }

        .card-img-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            background: #fafafa;
            min-height: 0;
            overflow: hidden;
        }

        .card-img-wrap img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .card-body {
            padding: 6px 12px 0;
            text-align: center;
        }

        .card-name {
            font-size: 14px;
            font-weight: 600;
            color: #1B3A5C;
            line-height: 1.3;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-desc {
            font-size: 11px;
            color: #888;
        }

        /* ── Blue Price Box ─────────────────────────── */
        .card-price-box {
            background: #1B3A5C;
            border-radius: 8px;
            margin: 6px 10px 10px;
            padding: 14px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
        }

        .cpb-price {
            font-size: 20px;
            font-weight: 700;
        }

        .cpb-meta {
            text-align: right;
        }

        .cpb-sku {
            font-size: 12px;
            font-weight: 600;
        }

        .cpb-code {
            font-size: 11px;
            opacity: .8;
            margin-top: 2px;
        }

        .cpb-original-price {
            font-size: 14px;
            font-weight: 500;
            text-decoration: line-through;
            opacity: 0.55;
            margin-right: 6px;
        }

        .cpb-set-price {
            font-size: 11px;
            font-weight: 500;
            opacity: 0.75;
            margin-top: 2px;
        }

        /* ═══ PAGE FOOTER ══════════════════════════════ */
        .page-footer {
            flex-shrink: 0;
            padding: 7px 20px 9px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e0d8cc;
        }

        .ftr-left {
            font-size: 12px;
            font-weight: 600;
            color: #1B3A5C;
        }

        .ftr-center {
            font-size: 11px;
            color: #888;
            text-align: center;
        }

        .ftr-right {
            font-size: 11px;
            color: #888;
            text-align: right;
        }

        /* ═══ SCREEN-ONLY PREVIEW ══════════════════════ */
        @media screen {
            body {
                background: #6b7280;
            }

            .page {
                margin: 24px auto;
                box-shadow: 0 4px 24px rgba(0, 0, 0, 0.35);
            }
        }

        /* ═══ PRINT UTILITIES ══════════════════════════ */
        .print-btn {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 9999;
            background: #1B3A5C;
            color: #C8941A;
            border: 2px solid #C8941A;
            padding: 14px 32px;
            font-size: 16px;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .print-btn:hover {
            background: #C8941A;
            color: #1B3A5C;
        }

        .print-banner {
            background: #FEF3C7;
            border-bottom: 3px solid #C8941A;
            padding: 12px 28px;
            text-align: center;
            font-size: 14px;
            color: #1B3A5C;
            font-weight: 600;
        }

        @media print {

            .print-btn,
            .print-banner {
                display: none !important;
            }

            /* Performance optimizations for print spooling / PDF generation */
            .product-card {
                box-shadow: none !important;
                border: 1px solid #ccc !important;
            }

            .page-border {
                background-image: none !important;
            }

            /* Gradients are very slow to render in PDFs */
            .page {
                box-shadow: none !important;
                margin: 0 !important;
            }
        }
    </style>
</head>

<body>

    {{-- ═══ COVER PAGE ════════════════════════════════════ --}}
    @if(isset($company) && $company)
    <div class="page">
        <div class="page-border"></div>
        <div class="cover-inner">
            @if($company->cover_image)
            <img class="cover-logo" src="{{ asset('images/' . $company->cover_image) }}" alt="Logo">
            @endif
            <div class="cover-company">{{ $company->company_name }}</div>
            <div class="cover-title">Product Catalogue</div>
            <div class="cover-rule"></div>
            <div class="cover-subtitle">{{ $title }}</div>
            @if($company->address)<div class="cover-contact">{{ $company->address }}</div>@endif
            @if($company->phone)<div class="cover-contact">&#9742; {{ $company->phone }}</div>@endif
            @if($company->email)<div class="cover-contact">&#9993; {{ $company->email }}</div>@endif
        </div>
    </div>
    @endif

    {{-- ═══ PRODUCT PAGES · 4 PER PAGE (2x2 GRID) ═══════ --}}
    @for ($i = 0; $i < count($products); $i +=4)
        <div class="page">
        <div class="page-border"></div>
        <div class="page-inner">

            {{-- Header --}}
            <div class="page-header">
                @if(isset($company) && $company)
                <div class="hdr-company">{{ $company->company_name }}</div>
                @endif
                <div class="hdr-title">Product Catalogue</div>
                <div class="hdr-rule"></div>
            </div>

            {{-- 2x2 Grid --}}
            <div class="products-grid">
                @for ($j = 0; $j < 4; $j++)
                    @if(isset($products[$i + $j]))
                    @php $p=$products[$i + $j]; @endphp
                    <div class="product-card">
                    <div class="card-img-wrap">
                        @if($p->image)
                        <img src="{{ asset('images/' . $p->image) }}" alt="{{ $p->name }}">
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="card-name">{{ $p->name }}</div>
                        @if(isset($p->category_name))
                        <div class="card-desc">{{ $p->category_name }}</div>
                        @endif
                    </div>
                    <div class="card-price-box">
                        <div class="cpb-price">
                            @if($p->original_price && $p->original_price > $p->price)
                            <span class="cpb-original-price">${{ number_format($p->original_price, 2) }}</span>
                            @endif
                            ${{ number_format($p->price, 2) }}
                            @if($p->set_price)
                            <div class="cpb-set-price">Set: ${{ number_format($p->set_price, 2) }}</div>
                            @endif
                        </div>
                        <div class="cpb-meta">
                            <div class="cpb-sku">SKU {{ $p->SKU }}</div>
                            {{-- @if($p->item_number)
                            <div class="cpb-code">#{{ $p->item_number }}</div>
                            @endif --}}
                        </div>
                    </div>
            </div>
            @else
            <div></div>
            @endif
            @endfor
        </div>

        {{-- Footer --}}
        <div class="page-footer">
            @if(isset($company) && $company)
            <div class="ftr-left">{{ $company->company_name }}</div>
            <div class="ftr-center">@if($company->email)&#9993; {{ $company->email }}@endif</div>
            <div class="ftr-right">@if($company->phone)&#9742; {{ $company->phone }}@endif</div>
            @endif
        </div>

        </div>
        </div>
        @endfor

        <div class="print-banner">
            For best results: set orientation to <strong>Portrait</strong>, margins to <strong>None</strong>, and enable <strong>Background graphics</strong>.
        </div>
        <button class="print-btn" onclick="window.print()">Print / Save as PDF</button>

        <script>
            window.addEventListener('load', function() {
                setTimeout(function() {
                    window.print();
                }, 500);
            });
        </script>

</body>

</html>