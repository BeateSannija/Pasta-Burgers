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
        <li class="nav-item"><a href=""><img id="cart" src="images\shopping-cart.png" alt="Grozs"></a></li> <!--add href to cart page and add icon-->   
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

    
    <!--<div class="user-option">
        <a href=""> Pieslēgties</a>
        <a href=""> Grozs</a>
    </div>-->
</nav>