{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <style>
        .btn-submit {
            padding: 0.75rem;
            background-color: #4f46e5;
            /* Indigo-600 */
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #4338ca;
            /* Indigo-700 */
        }

        .btn-pay {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            background-color: #38a169;
            /* Green-400 */
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }

        .btn-pay:hover {
            background-color: #2f855a;
            /* Green-700 */
        }

        .icon-credit-card {
            margin-right: 0.5rem;
        }
    </style>
</head>
<div class="product-container px-36">
    <div class="product-details">
        <div class="product-info">
            <h1 class="product-name">Paquete básico de eventos</h1>
            <div class="product-price" id="product-price">$4.499</div>
            <hr />
            <form action="#" method="POST" class="order-form">
                @csrf
                <input type="hidden" id="product_id" value="1234567890" />
                <input type="hidden" id="product_name" value="Paquete básico de eventos" />
                <input type="hidden" id="product_price" value="4499.99" />

                <button class="btn-submit" id="checkout-btn" type="button">
                    <span class="text-center icon-credit-card">💳</span>Pagar
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago("{{ env('MERCADO_PAGO_PUBLIC_KEY') }}");

    document.getElementById('checkout-btn').addEventListener('click', function() {

        const orderData = {
            product: [{
                id: document.getElementById('product_id').value,
                title: document.getElementById('product_name').value,
                description: 'Descripción del producto', // Puedes ajustar esto si tienes más información
                currency_id: "USD",
                quantity: 1,
                unit_price: parseFloat(document.getElementById('product_price').value),
            }],
            name: "{{ Auth::user()->name ?? '' }}",
            email: "{{ Auth::user()->email ?? '' }}",
        };

        console.log('Datos del pedido:', orderData);

        fetch('/mercadopago_test', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify(orderData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(preference => {
                if (preference.error) {
                    throw new Error(preference.error);
                }
                mp.checkout({
                    preference: {
                        id: preference.id // Asegúrate de que esta línea sea correcta
                    },
                    autoOpen: true
                });
                console.log('Respuesta de la preferencia:', preference);
            })
            .catch(error => console.error('Error al crear la preferencia:', error));
    });
</script>

</html> --}}