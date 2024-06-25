<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.sections.head')
</head>
<body>
    <header>
        @include('admin.sections.header')
    </header>
    <section class="main">
        @include('admin.sections.sidebar')

        <div class="caption">
            <h2>Pasūtījumi</h2>
        </div>

        <div class="orders-list">
            @foreach ($orders as $order)
                <div class="order">
                    <h3>Pasūtījums ID: {{ $order->id }}</h3>
                    <p>Klients: {{ $order->user->name }}</p>
                    <p>Progress: {{ $order->progress ?? 'null' }}</p>
                    <p>Pasūtījums:</p>
                    <ul>
                        @foreach ($order->cartItems as $item)
                            <li>{{ $item->dish->dish_name }} - {{ $item->dish->dish_price }}</li>
                        @endforeach
                    </ul>
                    <form action="{{ route('admin.update_order_progress', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" name="progress" value="ready">Ready</button>
                        <button type="submit" name="progress" value="in_progress">In Progress</button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>    
</body>
</html>
