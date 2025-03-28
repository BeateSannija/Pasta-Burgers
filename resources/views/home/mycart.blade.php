<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    
    @include('home.sections.head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home/mycart.css') }}">

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
                <th>{{ __('cart.name')}}</th>
                <th>{{ __('cart.price')}}</th>
                <th>{{ __('cart.image')}}</th>
                <th></th>   <!-- for remove button -->
            </tr>

            <?php
                $value = 0;
            ?>

    @foreach($cart as $item)
            <tr>
                <td>{{ app()->getLocale() === 'en' ? $item->dish->dish_name_en : $item->dish->dish_name }}</td>
                <td>{{$item->dish->dish_price}}</td>
                <td>
                    @php
                        $imagePath = Str::startsWith($item->dish->image, 'images/')
                            ? asset($item->dish->image) // seeder photo from public/images
                            : asset('storage/' . $item->dish->image); // admin photo from storage/app/public/dishes
                    @endphp
                    <img width="100" src="{{ $imagePath }}" alt="{{ $item->dish->dish_name }}">
                </td>

                <!-- remove button-->
                <td><a class="remove-item" href="{{url('remove_item', $item->id)}}">{{ __('cart.remove')}}</a></td>
            </tr>


            <?php
                $value = $value + $item->dish->dish_price
            ?>

    @endforeach

        </table>

<!-- TOTAL -->
        <div class="actions">
            <span class="total">{{ __('cart.total')}} {{ number_format($value, 2) }} €</span>
            @if($value > 0)     <!--makes sure that if the cart is empty user cant submit order-->
                <form action="{{ url('create_order') }}" method="post">
                    @csrf
                    <input type="submit" class="btn checkout-btn" value="Pabeigt pasūtījumu">
                </form>
            @endif
        </div>
    </section>

<!-- -->
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