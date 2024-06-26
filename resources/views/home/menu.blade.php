<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('home.sections.head')
</head>
<body>
    <section class="hero-area">
        <header class="header-section">
            @include('home.sections.header')
        </header>   
    </section>

    <div class="category-selector">
        <label for="category-select">{{ __('menu.cat') }}</label>
        <select id="category-select" onchange="filterDishes()">
            <option value="all">{{ __('menu.all') }}</option>
            <option value="uzkodas">{{ __('menu.appetizers') }}</option>
            <option value="salati">{{ __('menu.salad') }}</option>
            <option value="pastas">{{ __('menu.pastas') }}</option>
            <option value="burgeru-komplekti">{{ __('menu.burgers') }}</option>
            <option value="deserti">{{ __('menu.desserts') }}</option>
        </select>
    </div>

    <section class="menu-container">
        @foreach($dish as $item)
            <div class="dish-card" data-category="{{ $item->dish_category }}">
                <!-- <h4>{ $item->dish_name }}</h4>-->
                <h4>{{ app()->getLocale() === 'en' ? $item->dish_name_en : $item->dish_name }}</h4> <!-- to display also in english when needed-->
                <div class="img-box">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->dish_name }}">
                </div>
                <!--<p>{ $item->dish_description }}</p>-->
                <p>{{ app()->getLocale() === 'en' ? $item->dish_description_en : $item->dish_description }}</p>
                <h3>{{ $item->dish_price }}</h3>

                <a class="add-to-cart" href="{{url('add_to_cart', $item->id)}}">{{ __('menu.add_to_cart') }}</a>

            </div>
        @endforeach
    </section>

    <!-- JS script for category-->
    <script>
        function filterDishes() {
            const category = document.getElementById('category-select').value;
            const dishes = document.querySelectorAll('.dish-card');

            console.log(`Selected category: ${category}`);

            dishes.forEach(dish => {
                console.log(`Dish category: ${dish.getAttribute('data-category')}`);
                if (category === 'all' || dish.getAttribute('data-category') === category) {
                    dish.style.display = 'block';
                } else {
                    dish.style.display = 'none';
                }
            });
        }
        window.onload = filterDishes;
    </script>
</body>
</html>
