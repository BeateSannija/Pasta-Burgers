<!DOCTYPE html>
<html lang="en">
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
        <label for="category-select">Kategorijas:</label>
        <select id="category-select" onchange="filterDishes()">
            <option value="all">Viss</option>
            <option value="uzkodas">Uzkodas</option>
            <option value="salati">Salāti</option>
            <option value="pastas">Pastas</option>
            <option value="burgeru-komplekti">Burgeru komplekti</option>
            <option value="deserti">Deserti</option>
        </select>
    </div>

    <section class="menu-container">
        @foreach($dish as $item)
            <div class="dish-card" data-category="{{ $item->dish_category }}">
                <h4>{{ $item->dish_name }}</h4>
                <div class="img-box">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->dish_name }}">
                </div>
                <p>{{ $item->dish_description }}</p>
                <h3>{{ $item->dish_price }}</h3>

                <a class="add-to-cart" href="">Pievienot pasūtījumam</a>

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
