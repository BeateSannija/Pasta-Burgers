<section class="top">
    <div class="logo-container">
        <img id="logo" src="{{ asset('images/PASTA-BURGERS-uzraksts-bez-fona.png') }}" alt="Pasta Burgers">
    </div>
</section>
<form id="logout" method="POST" action="{{ route('logout') }}">
    @csrf
    <input id="logout-submit" type="submit" value="Logout">
</form>