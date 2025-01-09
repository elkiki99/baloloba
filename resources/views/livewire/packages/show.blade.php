<?php

use Livewire\Volt\Component;
use App\Models\Package;

new class extends Component {
    public $polaroidsPackage;
    public $fashionPackage;
    public $eventsPackage;

    public function mount()
    {
        $this->polaroidsPackage = Package::where('id', 1)->first();
        $this->fashionPackage = Package::where('id', 2)->first();
        $this->eventsPackage = Package::where('id', 3)->first();
    }
}; ?>

<div class="md:space-x-6 md:flex lg:space-x-8">
    <!-- Events -->
    <div class="max-w-[500px] mx-auto min-h-[50vh] flex flex-col my-10 p-6 text-center transition bg-gray-100 border rounded-lg shadow-lg md:w-1/3 md:hover:scale-[1.02]"
        x-data="{
            event_basicProductId: 3,
            event_extendedProductId: 6,
            event_productName: '{{ $eventsPackage->name }}',
            event_productDescription: '{{ $eventsPackage->description }}',
            event_basicPrice: '{{ number_format($eventsPackage->basic_price, 0, ',', '.') }}',
            event_extendedPrice: '{{ number_format($eventsPackage->extended_price, 0, ',', '.') }}',
            event_beforeBasicPrice: '{{ number_format($eventsPackage->before_basic_price, 0, ',', '.') }}',
            event_beforeExtendedPrice: '{{ number_format($eventsPackage->before_extended_price, 0, ',', '.') }}',
            event_basicFeatures: {{ $eventsPackage->basic_features }},
            event_extendedFeatures: {{ $eventsPackage->extended_features }},
        }">
        <div class="flex justify-between pb-2 text-start">
            <div>
                <h2 class="text-xl font-semibold lg:text-2xl">{{ $eventsPackage->name }}</h2>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-16 lg:size-20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>
            </div>
            <div class="flex flex-col items-end gap-2">
                <span class="text-3xl font-bold underline lg:text-4xl decoration-yellow-500"
                    x-text="isExtended ? event_extendedPrice : event_basicPrice"></span>
                <span class="font-bold text-gray-500 line-through text-md lg:text-xl"
                    x-text="isExtended ? event_beforeExtendedPrice : event_beforeBasicPrice"></span>
            </div>
        </div>

        <!-- Features: Eventos -->
        <ul class="flex-grow my-4">
            <template x-for="(feature, index) in (isExtended ? event_extendedFeatures : event_basicFeatures)"
                :key="index">
                <li class="flex mb-2 text-sm text-start lg:text-base" x-text="'✔ ' + feature"></li>
            </template>
        </ul>

        <form action="#" method="POST">
            @csrf

            <input type="hidden" id="event_product_id"
                x-bind:value="isExtended ? event_extendedProductId : event_basicProductId" />
            <input type="hidden" id="event_product_name" x-bind:value="event_productName" />
            <input type="hidden" id="event_product_price" x-bind:value="isExtended ? 5799 : 4499" />
            <input type="hidden" id="event_product_description" x-bind:value="event_productDescription" />
            <input type="hidden" id="event_before_price" x-bind:value="isExtended ? 6822 : 5293" />
            <input type="hidden" id="event_features"
                x-bind:value="isExtended ? event_extendedFeatures : event_basicFeatures" />

            <button id="event_checkout-btn" type="button"
                class="flex items-center justify-center w-full px-4 py-2 text-gray-100 rounded-lg hover:blur-xs hover:cursor-pointer bg-gray-950">Obtener
                sesión
            </button>
        </form>
    </div>

    <!-- Polaroids (Center Highlighted) -->
    <div class="max-w-[500px] mx-auto min-h-[50vh] flex flex-col my-10 p-6 text-center transition transform md:scale-110 bg-gray-950 border rounded-lg shadow-lg md:w-1/3 md:hover:scale-[1.12]"
        x-data="{
            polaroids_basicProductId: 1,
            polaroids_extendedProductId: 4,
            polaroids_productName: '{{ $polaroidsPackage->name }}',
            polaroids_productDescription: '{{ $polaroidsPackage->description }}',
            polaroids_basicPrice: '{{ number_format($polaroidsPackage->basic_price, 0, ',', '.') }}',
            polaroids_extendedPrice: '{{ number_format($polaroidsPackage->extended_price, 0, ',', '.') }}',
            polaroids_beforeBasicPrice: '{{ number_format($polaroidsPackage->before_basic_price, 0, ',', '.') }}',
            polaroids_beforeExtendedPrice: '{{ number_format($polaroidsPackage->before_extended_price, 0, ',', '.') }}',
            polaroids_basicFeatures: {{ $polaroidsPackage->basic_features }},
            polaroids_extendedFeatures: {{ $polaroidsPackage->extended_features }},
        }">
        <div class="flex justify-between pb-2 text-start">
            <div class="">
                <h2 class="text-xl font-semibold text-white lg:text-2xl">{{ $polaroidsPackage->name }}</h2>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="text-white size-16 lg:size-20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                </svg>
            </div>
            <div class="flex flex-col items-end gap-2 text-gray-100">
                <span class="text-3xl font-bold underline lg:text-4xl decoration-yellow-500"
                    x-text="isExtended ? polaroids_extendedPrice : polaroids_basicPrice"></span>
                <span class="font-bold text-gray-500 line-through text-md lg:text-xl"
                    x-text="isExtended ? polaroids_beforeExtendedPrice : polaroids_beforeBasicPrice"></span>
            </div>
        </div>

        <!-- Features: Polaroids -->
        <ul class="flex-grow my-4">
            <template x-for="(feature, index) in (isExtended ? polaroids_extendedFeatures : polaroids_basicFeatures)"
                :key="index">
                <li class="flex mb-2 text-sm text-gray-300 text-start lg:text-base" x-text="'✔ ' + feature"></li>
            </template>
        </ul>

        <form action="#" method="POST">
            @csrf

            <input type="hidden" id="polaroids_product_id"
                x-bind:value="isExtended ? polaroids_extendedProductId : polaroids_basicProductId" />
            <input type="hidden" id="polaroids_product_name" x-bind:value="polaroids_productName" />
            <input type="hidden" id="polaroids_product_price" x-bind:value="isExtended ? 3199 : 2499" />
            <input type="hidden" id="polaroids_product_description" x-bind:value="polaroids_productDescription" />
            <input type="hidden" id="polaroids_before_price" x-bind:value="isExtended ? 3764 : 2940" />
            <input type="hidden" id="polaroids_features"
                x-bind:value="isExtended ? polaroids_extendedFeatures : polaroids_basicFeatures" />

            <button id="polaroids_checkout-btn" type="button"
                class="flex items-center justify-center w-full px-4 py-2 text-gray-900 bg-yellow-500 rounded-lg hover:blur-xs hover:cursor-pointer">Obtener
                sesión
            </button>
        </form>
    </div>

    <!-- Fashion -->
    <div class="max-w-[500px] mx-auto min-h-[50vh] flex flex-col my-10 p-6 text-center transition bg-gray-100 border rounded-lg shadow-lg md:w-1/3 md:hover:scale-[1.02]"
        x-data="{
            fashion_basicProductId: 2,
            fashion_extendedProductId: 5,
            fashion_productName: '{{ $fashionPackage->name }}',
            fashion_productDescription: '{{ $fashionPackage->description }}',
            fashion_basicPrice: '{{ number_format($fashionPackage->basic_price, 0, ',', '.') }}',
            fashion_extendedPrice: '{{ number_format($fashionPackage->extended_price, 0, ',', '.') }}',
            fashion_beforeBasicPrice: '{{ number_format($fashionPackage->before_basic_price, 0, ',', '.') }}',
            fashion_beforeExtendedPrice: '{{ number_format($fashionPackage->before_extended_price, 0, ',', '.') }}',
            fashion_basicFeatures: {{ $fashionPackage->basic_features }},
            fashion_extendedFeatures: {{ $fashionPackage->extended_features }},
        }">
        <div class="flex justify-between pb-2 text-start">
            <div class="">
                <h2 class="text-xl font-semibold lg:text-2xl">{{ $fashionPackage->name }}</h2>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-16 lg:size-20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18Z" />
                </svg>
            </div>
            <div class="flex flex-col items-end gap-2">
                <span class="text-3xl font-bold underline lg:text-4xl decoration-yellow-500"
                    x-text="isExtended ? fashion_extendedPrice : fashion_basicPrice"></span>
                <span class="font-bold text-gray-500 line-through text-md lg:text-xl"
                    x-text="isExtended ? fashion_beforeExtendedPrice : fashion_beforeBasicPrice"></span>
            </div>
        </div>

        <!-- Features: Moda -->
        <ul class="flex-grow my-4">
            <template x-for="(feature, index) in (isExtended ? fashion_extendedFeatures : fashion_basicFeatures)"
                :key="index">
                <li class="flex mb-2 text-sm text-start lg:text-base" x-text="'✔ ' + feature"></li>
            </template>
        </ul>

        <form action="#" method="POST">
            @csrf

            <input type="hidden" id="fashion_product_id"
                x-bind:value="isExtended ? fashion_extendedProductId : fashion_basicProductId" />
            <input type="hidden" id="fashion_product_name" x-bind:value="fashion_productName" />
            <input type="hidden" id="fashion_product_price" x-bind:value="isExtended ? 4499 : 3199" />
            <input type="hidden" id="fashion_product_description" x-bind:value="fashion_productDescription" />
            <input type="hidden" id="fashion_before_price" x-bind:value="isExtended ? 5293 : 3764" />
            <input type="hidden" id="fashion_features"
                x-bind:value="isExtended ? fashion_extendedFeatures : fashion_basicFeatures" />

            <button id="fashion_checkout-btn" type="button"
                class="flex items-center justify-center w-full px-4 py-2 text-gray-100 rounded-lg hover:blur-xs hover:cursor-pointer bg-gray-950">Obtener
                sesión
            </button>
        </form>
    </div>
</div>

<script>
    const mp = new MercadoPago("{{ env('MERCADO_PAGO_PUBLIC_KEY') }}");

    document.getElementById('event_checkout-btn').addEventListener('click', function() {

        const orderData = {
            product: [{
                id: document.getElementById('event_product_id').value,
                title: document.getElementById('event_product_name').value,
                description: document.getElementById('event_product_description').value,
                currency_id: "UYU",
                quantity: 1,
                unit_price: parseFloat(document.getElementById('event_product_price').value),
                additional_info: {
                    before_price: document.getElementById('event_before_price').value,
                    features: document.getElementById('event_features').value,
                }
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


    document.getElementById('polaroids_checkout-btn').addEventListener('click', function() {

        const orderData = {
            product: [{
                id: document.getElementById('polaroids_product_id').value,
                title: document.getElementById('polaroids_product_name').value,
                description: document.getElementById('polaroids_product_description').value,
                currency_id: "UYU",
                quantity: 1,
                unit_price: parseFloat(document.getElementById('polaroids_product_price').value),
                additional_info: {
                    before_price: document.getElementById('polaroids_before_price').value,
                    features: document.getElementById('polaroids_features').value,
                }
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
                        id: preference.id
                    },
                    autoOpen: true
                });
                console.log('Respuesta de la preferencia:', preference);
            })
            .catch(error => console.error('Error al crear la preferencia:', error));
    });


    document.getElementById('fashion_checkout-btn').addEventListener('click', function() {

        const orderData = {
            product: [{
                id: document.getElementById('fashion_product_id').value,
                title: document.getElementById('fashion_product_name').value,
                description: document.getElementById('fashion_product_description').value,
                currency_id: "UYU",
                quantity: 1,
                unit_price: parseFloat(document.getElementById('fashion_product_price').value),
                additional_info: {
                    before_price: document.getElementById('fashion_before_price').value,
                    features: document.getElementById('fashion_features').value,
                }
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
