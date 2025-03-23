<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.sections.head')
    <style>
        .orders-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .order {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: box-shadow 0.3s ease;
        }
        .order:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .order h3 {
            margin-top: 0;
            font-size: 1.5em;
        }
        .order p {
            margin: 0.5em 0;
        }
        .order ul {
            list-style: none;
            padding: 0;
        }
        .order ul li {
            margin: 0.5em 0;
        }
        .order button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .order button:hover {
            background-color: #0056b3;
        }
        .order button:last-child {
            background-color: #28a745;
        }
        .order button:last-child:hover {
            background-color: #218838;
        }
        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 15px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <header>
        @include('admin.sections.header')
    </header>
    <section class="main">
        @include('admin.sections.sidebar')
        
        <div class="caption">
            <h1>Pasūtījumu vēsture</h1>
        </div>

        <div>
            <form id="delete-orders-form" method="POST" action="{{ route('admin.delete_orders') }}">
                @csrf
                <table class="dishes-table">
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Vārds, uzvārds</th>
                        <th>Pasūtījums</th>
                        <th>Statuss</th>
                        <th>Progress</th>
                        <th>Datums</th>
                        <th>Laiks</th>
                        <th></th>
                    </tr>
                    @foreach($orders as $order)
                    <tr>
                        <td><input type="checkbox" name="order_ids[]" value="{{ $order->id }}" class="order-checkbox"></td>
                        <td>{{ $order->user->name }}</td>
                        <td>
                            @foreach($order->cartItems as $item)
                                <p>{{ $item->dish->dish_name }} - {{ $item->dish->dish_price }} €</p>
                            @endforeach
                        </td>
                        <td>
                            <select class="status-dropdown" data-order-id="{{ $order->id }}">
                                <option value="">Nezināms</option>
                                <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>Apstiprināt</option>
                                <option value="declined" {{ $order->status == 'declined' ? 'selected' : '' }}>Noraidīt</option>
                            </select>
                        </td>
                        <td>
                            <select class="progress-dropdown" data-order-id="{{ $order->id }}">
                                <option value="">Nezināms</option>
                                <option value="in_progress" {{ $order->progress == 'in_progress' ? 'selected' : '' }}>Tiek gatavots</option>
                                <option value="ready" {{ $order->progress == 'ready' ? 'selected' : '' }}>Gatavs</option>
                            </select>
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>
                            <input type="time" class="time-input" data-order-id="{{ $order->id }}" value="{{ $order->estimated_time ? \Carbon\Carbon::parse($order->estimated_time)->format('H:i') : '00:00' }}">
                        </td>
                        <td>
                            <button class="accept-btn" data-order-id="{{ $order->id }}">Saglabāt</button>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <button type="button" class="delete-btn" id="delete-selected">Delete Selected</button>
            </form>
        </div>
    </section> 

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector("#select-all").addEventListener("click", function() {
            const checkboxes = document.querySelectorAll(".order-checkbox");
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        document.querySelectorAll(".accept-btn").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default form submission
                const orderId = this.getAttribute("data-order-id");
                const status = document.querySelector(`.status-dropdown[data-order-id="${orderId}"]`).value;
                const progress = document.querySelector(`.progress-dropdown[data-order-id="${orderId}"]`).value;
                const time = document.querySelector(`.time-input[data-order-id="${orderId}"]`).value;

                fetch(`/update_order/${orderId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status,
                        progress: progress,
                        estimated_time: time
                    })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        console.error("Failed to update the order.");
                    }
                }).catch(error => {
                    console.error("Error:", error);
                });
            });
        });

        document.querySelector("#delete-selected").addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default form submission
            const selectedOrderIds = Array.from(document.querySelectorAll(".order-checkbox:checked")).map(cb => cb.value);

            if (selectedOrderIds.length === 0) {
                alert("Please select at least one order to delete.");
                return;
            }

            fetch(`/delete_orders`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order_ids: selectedOrderIds })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Selected orders have been deleted.");
                    location.reload();
                } else {
                    console.error("Failed to delete the orders.");
                }
            }).catch(error => {
                console.error("Error:", error);
            });
        });
    });
</script>
</body>
</html>