<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('home.head')

</head>
<body>
    <!-- navbar-->
    <section class="hero-area">
        <!--header section-->
        <header class="header-section">
            <div >
                <ul class="languages">
                    <li class="language"><a href>LV</a>
                    <li class="language"><a href>ENG</a>
            </div>
            <div>
                <a href="{{ route('home') }}"><img id="hero-area-logo" src="images/PASTA-BURGERS-uzraksts-bez-fona.png" alt="Pasta Burgers"></a>
            </div>
            <nav class="navbar">
                <ul id="navbar-list">
                    <!--<li class="nav-item"><a href="{{ route('home') }}"><img id="logo" src="images/PASTA-BURGERS-uzraksts-bez-fona.png" alt="Pasta Burgers"></a></li>-->
                    <li class="nav-item"><a href="#menu-caption">Ēdienkarte</a></li>
                    <li class="nav-item"><a href="#about-us">Par mums</a></li>
                    <li class="nav-item"><a href="#footer">Kontakti</a></li>
                    <li class="nav-item"><a href="{{url('/login')}}">Pieslēgties</a></li> <!--add href to login page-->
                    <li class="nav-item"><a href="{{url('/register')}}">Register</a></li> <!--add href to login page-->
                    <li class="nav-item"><a href="">Grozs</a></li> <!--add href to cart page and add icon-->
                </ul>
                <!--<div class="user-option">
                    <a href=""> Pieslēgties</a>
                    <a href=""> Grozs</a>
                </div>-->
            </nav>
        </header>   
    </section>

    <!--        Banner      -->
    <section class="banner">
        <pre id="dienas">
pirmdiena        
otrdiena        
trešdiena       
ceturtdiena     
piektdiena      
sestdiena       
svētdiena        
        </pre>
        <pre id="laiki">
nestrādājam
12:00 - 22:00
12:00 - 22:00
12:00 - 22:00
12:00 - 22:00
12:00 - 22:00
nestrādājam
     </pre>  
    </section>

<!--Contacts --later remove-->
    <section class="contact_section ">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2201.559659444305!2d21.007506177125375!3d56.50979203343258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46faa78d866a318d%3A0x4e698bc7c3c2f614!2sPASTA%20BURGERS!5e0!3m2!1sen!2slv!4v1718897786848!5m2!1sen!2slv" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </section>

  <br><br><br>

</body>
</html>