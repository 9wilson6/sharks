@component('mail::layout')
    {{-- Header --}}
    @slot('header')

        @component('mail::header', ['url' => config('app.url')])
            <img src="https://www.myhomeworkshark.com/img/mshark.png">
        @endcomponent

    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            You are receiving this mail as a member of {{ config('app.name') }}. If you do not want to get emails from us unsubscribe now
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
