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
            <h1> Pieprasījumi </h1>
        </div>

        <div>
            <table class="dishes-table">
                <tr>
                    <th>Vārds, uzvārds</th>
                    <th>Pasūtījums</th>
                    <th>Statuss</th>
                    <th>Laiks</th>      <!-- ja ievada, ka 'apstirpināts', tad obligāti jāievada plānotais laiks-->
                    <th></th>   
                </tr>
        

                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        @foreach($order->cartItems as $item)
                            <p>{{ $item->dish->dish_name }} - {{ $item->dish->dish_price }} €</p>
                        @endforeach
                    </td>

                    <td><!--{ $order->status }}-->
                        <select class="status-dropdown" data-order-id="{{ $order->id }}">
                            <option value="">Statuss</option>
                            <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>Apstiprināt</option>
                            <option value="declined" {{ $order->status == 'declined' ? 'selected' : '' }}>Noraidīt</option>
                        </select>
                    </td>

                    <td>
                        <input type="time" class="time-input" data-order-id="{{ $order->id }}" value="{{ $order->estimated_time ? \Carbon\Carbon::parse($order->estimated_time)->format('H:i') : '00:00' }}">
                    </td>
                    <!--<td><a href="" class="accept-btn"> Pabeigt </a></td>-->
                    <td><button class="accept-btn" data-order-id="{{ $order->id }}">Saglabāt</button></td>
                </tr>
                @endforeach
        


            </table>
        </div>

    </section> 

<!-- Handles the submission of updates via a button click and sends a POST request to update the order.-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".accept-btn").forEach(button => {
            button.addEventListener("click", function() {
                const orderId = this.getAttribute("data-order-id");
                const status = document.querySelector(`.status-dropdown[data-order-id="${orderId}"]`).value;
                const time = document.querySelector(`.time-input[data-order-id="${orderId}"]`).value;

                if (status === 'accepted' && !time) {
                    alert("Please set a time when the status is accepted.");
                    return;
                }

                fetch(`/update_order/${orderId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status,
                        estimated_time: time
                    })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Izmaiņas tika veiktas.");
                        location.reload();
                    } else {
                        alert("Neizdevās veikt izmaiņas");
                    }
                });
            });
        });
    });
</script>



</body>
</html>