<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="{{ public_path('plugins/bootstrap-rtl/css/bootstrap.min.css') }}">

    <style type="text/css">
		thead { 
			display: table-header-group; 
		}

		tfoot { 
			display: table-row-group; 
		}

		tr { 
			page-break-inside: avoid; 
		}
	</style>
</head>
<body>
    <div class="row">
        <div class="col-xs-12 col-12">
            <table class="table table-bordered table-striped">
                <thead>
                </thead>
                <tbody>
                    @for($i = 0; $i < count($products); $i += 3)
                    <tr>
                        <td>
                            @include('product-template', ['product' => $products[$i]])
                        </td>
                        <td>
                            @include('product-template', ['product' => $products[$i+1]])
                        </td>
                        <td>
                            @include('product-template', ['product' => $products[$i+2]])
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>