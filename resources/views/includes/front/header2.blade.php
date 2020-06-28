<header>
    <div class="wrapper">
        <div class="short-line">
            <a href="/" class="logo">
                <img src="{{ asset('front/img/logo_black.png') }}" alt="logo black">
            </a>
            <button class="menu-button-open dekstop-hidden">
                <svg class="menu-icons" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" viewBox="0 0 30 24" style="enable-background:new 0 0 30 24;" xml:space="preserve">
                    <g>
                        <path class="st0" d="M28.5,22.9H8.8c-0.8,0-1.5-0.7-1.5-1.5S8,20,8.8,20h19.7c0.8,0,1.5,0.7,1.5,1.5S29.3,22.9,28.5,22.9z"></path>
                        <path class="st0" d="M28.5,13.7H8.8c-0.8,0-1.5-0.7-1.5-1.5c0-0.8,0.7-1.5,1.5-1.5h19.7c0.8,0,1.5,0.7,1.5,1.5
								C30,13,29.3,13.7,28.5,13.7z"></path>
                        <path class="st0" d="M28.5,4.4H8.8C8,4.4,7.3,3.8,7.3,3S8,1.5,8.8,1.5h19.7C29.3,1.5,30,2.2,30,3S29.3,4.4,28.5,4.4z"></path>
                        <circle class="st0" cx="2.5" cy="3.1" r="2"></circle>
                        <circle class="st0" cx="2.5" cy="12.2" r="2"></circle>
                        <circle class="st0" cx="2.5" cy="21.3" r="2"></circle>
                    </g>
                </svg>
            </button>
        </div>
        <div class="right-header">
            <button class="menu-button-close dekstop-hidden">
                <img class="menu-icons" src="{{ asset('front/img/svg/close.svg') }}" alt="close icon">
            </button>
            <a class="phone" href="tel:+18889466886"></a>
            @include('includes.front.nav')
        </div>
    </div>
</header>
