<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('home.sections.head')
    <link rel="stylesheet" type="text/css" href="{{asset('css/home/orders.css')}}"/>

</head>
<body>
    <!-- navbar-->
    <section class="hero-area">
        <!--header section-->
        <header class="header-section">
            
            @include('home.sections.header')

        </header>   
    </section>

    <div class="orders-container">
        <table>
            <tr>
                <th>Pasūtījums</th>
                <th>Datums</th>
                <th>Statuss</th>
                <th>Progress</th>
                <th>Plānotais laiks</th>
            </tr>
    
            @foreach($orders as $order)
            <tr>
                <td>
                    <ul>
                        @foreach ($order->cartItems as $item)
                            <li>{{ $item->dish->dish_name }} - {{ $item->dish->dish_price }} €</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->progress }}</td>
                <td>{{ $order->estimated_time ? \Carbon\Carbon::parse($order->estimated_time)->format('H:i') : 'N/A' }}</td>
            </tr>
            @endforeach
    
        </table>
    </div>

    <p> Problēmu vai jautājumus gadījumā sazināties, zvanot uz numuru +371 270 700 25 </p>
</body>
</html>