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
                <th>{{ __('order.order') }}</th> <!--<th>Pasūtījums</th>-->
                <th>{{ __('order.date') }}</th>
                <th>{{ __('order.status') }}</th>
                <th>{{ __('order.progress') }}</th>
                <th>{{ __('order.Estimated_time') }}</th>
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
                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>

                <td> <!-- show statuss in lv-->
                    @if ($order->status === 'accepted')
                    {{ __('order.accepted')}}
                    @elseif ($order->status === 'declined')
                    {{ __('order.declined')}}
                    @else
                        {{ $order->status }} <!-- Default status if not 'accepted' or 'declined' -->
                    @endif
                </td>

                <td>
                    @if ($order->progress === 'ready')
                    {{ __('order.ready')}}
                    @elseif ($order->progress === 'in_progress')
                    {{ __('order.in_progress')}}
                    @else
                        {{ $order->progress }} <!-- Default status if not 'accepted' or 'declined' -->
                    @endif
                    
                    <!--{ $order->progress }}-->
                </td>

                <td>{{ $order->estimated_time ? \Carbon\Carbon::parse($order->estimated_time)->format('H:i') : 'N/A' }}</td>
            </tr>
            @endforeach
    
        </table>
    </div>

    <p>{{ __('order.if_problems') }}</p>
</body>
</html>