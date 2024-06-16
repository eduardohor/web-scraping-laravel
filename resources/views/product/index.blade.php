<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .card {
            height: 100%;
        }
        .card-body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-img-top {
            max-width: 100%;
            height: auto;
        }
        .description {
            overflow: hidden;
            max-height: 100px;
            transition: max-height 0.3s ease-out;
        }
        .read-more-btn {
            margin-top: auto;
        }

        .card-price {
            font-size: 1.25rem; /* Tamanho do texto do preço */
            font-weight: bold; /* Texto em negrito */
            color: #007bff; /* Cor azul para o preço */
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <h1 class="mb-4">Produtos</h1>
        <div class="row">
            @forelse ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>


                        <p class="card-price">R$ {{number_format($product->price, 2, ',' , '.')}}</p>
                        <div class="description">
                            {!! $product->description !!}
                        </div>
                        <button class="btn btn-link read-more-btn">Ler mais</button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <h2>Nenhum produto encontrado.</h2>
            </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.read-more-btn').on('click', function() {
                var $cardBody = $(this).closest('.card-body');
                var $description = $cardBody.find('.description');

                if ($description.hasClass('expanded')) {
                    $description.removeClass('expanded');
                    $description.css('max-height', '100px');
                    $(this).text('Ler mais');
                } else {
                    $description.addClass('expanded');
                    $description.css('max-height', $description[0].scrollHeight + 'px');
                    $(this).text('Recolher');
                }
            });
        });
    </script>
</body>
</html>
