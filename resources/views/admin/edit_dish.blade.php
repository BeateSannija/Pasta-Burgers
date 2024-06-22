<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/addDish.css') }}"/>
    <title>Pievienot ēdienu</title>
</head>
<body>
    <form action="{{ url('update_dish', $dish->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="field">
            <label for="dish-name">Nosaukums</label>
            <input type="text" name="dish-name" id="dish-name" value="{{ $dish->dish_name }}" required>
        </div>
        <div class="field">
            <label for="dish-description">Apraksts</label>
            <textarea id="description" name="dish-description" required>{{ $dish->dish_description }}</textarea>
        </div>
        <div class="field">
            <label for="dish-price">Cena</label>
            <input type="text" name="dish-price" id="dish-price" value="{{ $dish->dish_price }}" required>
        </div>
        <div class="field">
            <label for="dish-category">Kategorija</label>
            <select id="dish-category" name="dish-category" required>
                <option value="uzkodas" {{ $dish->dish_category == 'uzkodas' ? 'selected' : '' }}>Uzkodas</option>
                <option value="salati" {{ $dish->dish_category == 'salati' ? 'selected' : '' }}>Salāti</option>
                <option value="pastas" {{ $dish->dish_category == 'pastas' ? 'selected' : '' }}>Pastas</option>
                <option value="burgeru-komplekti" {{ $dish->dish_category == 'burgeru-komplekti' ? 'selected' : '' }}>Burgeru komplekti</option>
                <option value="deserti" {{ $dish->dish_category == 'deserti' ? 'selected' : '' }}>Deserti</option>
            </select>
        </div>
        <div class="field">
            <label for="image">Attēls</label>
            <input type="file" name="image" id="image">
            @if ($dish->image)
                <div>
                    <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->dish_name }}" width="100">
                </div>
            @endif
        </div>
        <div class="field">
            <input class="btn btn-primary" type="submit" value="Saglabāt">
        </div>
    </form>    
</body>
</html>
