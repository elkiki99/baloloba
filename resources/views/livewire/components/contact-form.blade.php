<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThanksForContacting;
use App\Mail\ContactUs;

new class extends Component {
    public $name = '';
    public $email = '';
    public $phone = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'message' => 'required|string|max:5000',
    ];

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'name.string' => 'El nombre debe ser una cadena de texto.',
        'name.max' => 'El nombre no puede superar los 255 caracteres.',
        'email.required' => 'El email es obligatorio.',
        'email.email' => 'El email debe ser una dirección de correo electrónica válida.',
        'email.max' => 'El email no puede superar los 255 caracteres.',
        'phone.required' => 'El teléfono es obligatorio.',
        'phone.string' => 'El teléfono debe ser una cadena de texto.',
        'phone.max' => 'El teléfono no puede superar los 20 caracteres.',
        'message.required' => 'El mensaje es obligatorio.',
        'message.string' => 'El mensaje debe ser una cadena de texto.',
        'message.max' => 'El mensaje no puede superar los 5000 caracteres.',
    ];

    public function sendMessage()
    {
        $validatedData = $this->validate();

        Mail::to(config('mail.from.address'))->send(new ContactUs($validatedData));

        Mail::to($this->email)->send(new ThanksForContacting($this->name));

        Session::flash('status', 'message-sent');

        $this->reset(['name', 'email', 'phone', 'message']);
    }
}; ?>

<form wire:submit="sendMessage" class="mt-6 space-y-6">
    <div>
        <x-input-label for="name" :value="__('Nombre')" />
        <x-text-input wire:model="name" id="name" name="name" type="text" class="block w-full mt-1" required
            autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input wire:model="email" id="email" name="email" type="email" class="block w-full mt-1" required
            autocomplete="username" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <div>
        <x-input-label for="phone" :value="__('Teléfono')" />
        <x-text-input wire:model="phone" id="phone" name="phone" type="tel" class="block w-full mt-1" required
            autocomplete="phone" />
        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
    </div>

    <div>
        <x-input-label for="message" :value="__('Tu consulta')" />
        <textarea wire:model="message" id="message" name="message"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-500 focus:ring-yellow-500 dark:focus:ring-yellow-500"
            rows="4" required autocomplete="message"></textarea>
        <x-input-error class="mt-2" :messages="$errors->get('message')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Enviar') }}</x-primary-button>
    </div>

    @if (session('status') === 'message-sent')
        <p class="mt-5 text-sm font-medium text-green-600 dark:text-green-400">
            {{ __('¡Mensaje enviado exitosamente!') }}
        </p>
    @endif
</form>
