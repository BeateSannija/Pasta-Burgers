<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('home.sections.head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home/mycart.css') }}"/>

</head>
<body>
    <!-- navbar-->
    <section class="hero-area">
        <!--header section-->
        <header class="header-section">
            
            @include('home.sections.header')

        </header>   
    </section>
    <!-- CART -->
    <section class="cart-container">
        <table>
            <tr>
                <th>Ēdiena nosaukums</th>
                <th>Cena</th>
                <th>Vienības</th>
                <th>Attēls</th>
                <th></th>   <!-- for remove button -->
            </tr>

            <?php
                $value = 0;
            ?>

    @foreach($cart as $item)
            <tr>
                <td>{{$item->dish->dish_name}}</td>
                <td>{{$item->dish->dish_price}}</td>
                <td>???</td> <!--need to get quantity-->
                <td><img width="100" src="{{ asset('storage/' . $item->dish->image) }}"></td>

                <!-- remove button-->
                <td><a class="remove-item" href="{{url('remove_item', $item->id)}}">Noņemt</a></td>
            </tr>


            <?php
                $value = $value + $item->dish->dish_price
            ?>

    @endforeach

        </table>

        <!--<div class="actions">
            <span class="total">Kopējā summa: { number_format($value, 2) }} €</span>
            php if (count($cart) > 0): ?>     -- makes sure that if the cart is empty user cant submit order
                <form action="{url('create_order')}}" method="post">
                    csrf
                    <input type="submit" class="btn checkout-btn" value="Pabeigt pasūtījumu">
                </form>
            php endif; ?>
        </div>-->


        <div class="actions">
            <span class="total">Kopējā summa: {{ number_format($value, 2) }} €</span>
            @if($value > 0)
                <form action="{{ url('create_order') }}" method="post">
                    @csrf
                    <input type="submit" class="btn checkout-btn" value="Pabeigt pasūtījumu">
                </form>
            @endif
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cartItems = document.querySelectorAll(".cart-item");

            cartItems.forEach(function(item) {
                if (item.getAttribute("data-ordered") === "true") {
                    item.style.display = "none";
                }
            });
        });
    </script>

    </section>
</body>
</html>