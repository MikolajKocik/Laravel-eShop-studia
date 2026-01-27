<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Dzięki za zarejestrowanie się! Zanim przejdziesz dalej, mogę prosić cię o zweryfikowanie adresu email, poprzez kliknięcie w link który właśnie do ciebie wysłaliśmy? Jeśli wiadomość do ciebie nie dotarłą to mozemy wysłać kolejną.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Nowy link weryfikacyjny został wysłany na adres email, który podałeś w trakcie rejestracji.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Wyślij link weryfikacyjny ponownie') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Wyloguj się') }}
            </button>
        </form>
    </div>
</x-guest-layout>
