<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.sections.head')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/updateMenu.css') }}">
    <script>
        function submitForm(dishId) {
            var form = document.getElementById('form-' + dishId);
            form.submit();
        }
    </script>
</head>
<body>
    <header>
        @include('admin.sections.header')
    </header>

    <section class="main">
        @include('admin.sections.sidebar')
        
        <div class="caption">
            <h1> LABOT ĒDIENKARTI </h1>
        </div>

        <!-- MENU ITEMS WITH CHOICE OF BEING "nav pieejams" -->
        <div class="dish-menu">
            @foreach($dishes as $dish)
                <div class="dish-card">
                    <h3>{{ $dish->dish_name }}</h3>
                    <p>{{ $dish->dish_description }}</p>
                    <div class="img-box">
                        <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->dish_name }}">
                    </div>
                    <p>Kategorija: {{ $dish->dish_category }}</p>
                    <p>{{ $dish->dish_price }}</p>

                    <form id="form-{{ $dish->id }}" action="{{ route('dishes.updateStatus', $dish->id) }}" method="POST">
                        @csrf
                        <div class="status-field">
                            <label for="dish-status-{{ $dish->id }}">Status: </label>
                            <select id="dish-status-{{ $dish->id }}" name="dish-status" onchange="submitForm('{{ $dish->id }}')">
                                <option value="Pieejams" {{ $dish->status == 'Pieejams' ? 'selected' : '' }}>Pieejams</option>
                                <option value="Nav pieejams" {{ $dish->status == 'Nav pieejams' ? 'selected' : '' }}>Nav pieejams</option>
                            </select>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </section>

    <!-- include paginate -->
</body>
</html>
