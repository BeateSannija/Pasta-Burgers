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

        <div class="actions">
            <span class="total">Kopējā summa: {{ number_format($value, 2) }} €</span>
            <form action="{{url('confirm_order')}}" method="post">
                <input type="submit" class="btn checkout-btn" value="Pabeigt pasūtījumu">
            </form>
        </div>
    </section>
</body>
</html>