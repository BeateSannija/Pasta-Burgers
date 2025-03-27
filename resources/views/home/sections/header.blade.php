<div class="logo-container">
    <ul class="languages">
        <li class="language"><a href="locale/lv">LV</a>
        <li class="language"><a href="locale/en">ENG</a>
    </ul>

        <div>
            <a href="{{ route('home') }}"><img id="hero-area-logo" src="images/PASTA-BURGERS-uzraksts-bez-fona.png" alt="Pasta Burgers"></a>
        </div>
</div>

<nav class="navbar">
    <ul id="navbar-list">
        <li class="nav-item"><a href="{{ route('home') }}">{{ __('homepage.index') }}</a></li>
        <li class="nav-item"><a href="{{url('view_menu')}}">{{ __('homepage.menu') }}</a></li>
        <li class="nav-item"><a href="">{{ __('homepage.about_us') }}</a></li>
        <li class="nav-item"><a href="">{{ __('homepage.contact_us') }}</a></li>
        
    @if (Route::has('login'))
        @auth   
        
        <li class="nav-item">
            <a href="{{url('myorders')}}">
                {{ __('homepage.my_orders') }}
            </a> 
        </li>
            
        <li class="nav-item">
            <a href="{{url('mycart')}}">
                <img id="cart" src="images/shopping-cart.png" alt="Grozs">[<span id="cart-count">{{ $count }}</span>]
            </a>
        </li>
        
        <li> 
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <input type="submit" value="{{ __('homepage.logo_out')}}" class="logout-button">
            </form>
        </li>
    
        @else
        <li class="nav-item"><a href="{{url('/login')}}">{{ __('homepage.log_in') }}</a></li>
        <li class="nav-item"><a href="{{url('/register')}}">{{ __('homepage.register') }}</a></li> 
        

        @endauth
    @endif

    </ul>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (@json(Auth::check())) {
            updateCartCount();
        }
    });

    function updateCartCount() {
        fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-count').innerText = data.count;
            });
    }
</script>
