<div class="logo-container">
    <ul class="languages">
        <li class="language"><a href>LV</a>
        <li class="language"><a href>ENG</a>
    </ul>

        <div>
            <a href="{{ route('home') }}"><img id="hero-area-logo" src="images/PASTA-BURGERS-uzraksts-bez-fona.png" alt="Pasta Burgers"></a>
        </div>
</div>

<nav class="navbar">
    <ul id="navbar-list">
        <!--<li class="nav-item"><a href="{{ route('home') }}"><img id="logo" src="images/PASTA-BURGERS-uzraksts-bez-fona.png" alt="Pasta Burgers"></a></li>-->
        <li class="nav-item"><a href="{{ route('home') }}">Sākums</a></li>
        <li class="nav-item"><a href="{{url('view_menu')}}">Ēdienkarte</a></li>
        <li class="nav-item"><a href="#about-us">Par mums</a></li>
        <li class="nav-item"><a href="#footer">Kontakti</a></li>
        
    @if (Route::has('login'))
        @auth
        <!--<li class="nav-item"><a href="{url('mycart')}}"><img id="cart" src="images\shopping-cart.png" alt="Grozs">[{$count}}]</a></li> <--add href to cart page and add icon-->   
        
        <li class="nav-item">
            <a href="{{url('myorders')}}">
                Mani pasūtījumi
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
                <input type="submit" value="Atslēgties" class="logout-button">
            </form>
        </li>
    
        @else
        <li class="nav-item"><a href="{{url('/login')}}">Pieslēgties</a></li> <!--add href to login page-->
        <li class="nav-item"><a href="{{url('/register')}}">Reģistrēties</a></li> <!--add href to login page-->
        

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