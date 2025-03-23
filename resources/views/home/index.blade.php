<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('home.sections.head')

</head>
<body>
    <!-- navbar-->
    <section class="hero-area">
        <!--header section-->
        <header class="header-section">
            
            @include('home.sections.header')

        </header>   
    </section>

    <!--        Banner      -->
        <section class="banner">
            <!-- random dish view  -->
            <div class="merged-cell">
                @foreach($randomDishes as $item)
                    <div class="ran-dish">
                        <div class="img-ran-box">
                            @php
                                $imagePath = Str::startsWith($item->image, 'images/')
                                    ? asset($item->image) // seeder photo from public/images
                                    : asset('storage/' . $item->image); // admin photo from storage/app/public/dishes
                            @endphp
                            <img src="{{ $imagePath }}" alt="{{ $item->dish_name }}">
                        </div>
                        <h4 class="dish-title">{{ app()->getLocale() === 'en' ? $item->dish_name_en : $item->dish_name }}</h4>
                    </div>
                 @endforeach
            </div>



            <div class="promo-container">
                <img src="images\PROMO_1.jpg" alt="Promo" class="promo">
            </div>

            <!--menu link-->
            <div class="grid-item">
                <a href="{{url('view_menu')}}" id="link-menu">{{ __('homepage.menu') }}<a>
            </div>
        </section>
            
    </section>

    <section class="contact_section">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2201.559659444305!2d21.007506177125375!3d56.50979203343258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46faa78d866a318d%3A0x4e698bc7c3c2f614!2sPASTA%20BURGERS!5e0!3m2!1sen!2slv!4v1718897786848!5m2!1sen!2slv" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="info-wrapper">
            <div id="dienas">
                <pre>{{ __('homepage.days') }}</pre>      
            </div>
            <div id="laiki">
                <pre>{{__('homepage.working_hours')}}</pre>
            </div>
        </div>
    </section>
  @include('home.sections.footer')

</body>
</html>