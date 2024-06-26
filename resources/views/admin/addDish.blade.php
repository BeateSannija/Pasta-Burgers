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
    <form action="{{ url('add_dish') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="field">
            <label for="dish-name">Nosaukums</label>
            <input type="text" name="dish-name" id="dish-name" required>
        </div>
        <div class="field">
            <label for="dish-description">Apraksts</label>
            <textarea id="description" name="dish-description" required></textarea>
        </div>

        <!-- adding name and description in english for localization-->
        <div class="field">
            <label for="dish-name-en">Nosaukums(EN)</label>
            <input type="text" name="dish-name-en" id="dish-name-en">
        </div>

        <div class="field">
            <label for="dish-description-en">Apraksts (EN)</label>
            <textarea id="description-en" name="dish-description-en"></textarea>
        </div>
        <!-- -->

        <div class="field">
            <label for="dish-price">Cena</label>
            <input type="text" name="dish-price" id="dish-price" required>
        </div>
        <div class="field">
            <label for="dish-category">Kategorija</label>
            <select id="dish-category" name="dish-category" required>
                <option value="uzkodas">Uzkodas</option>
                <option value="salati">Salāti</option>
                <option value="pastas">Pastas</option>
                <option value="burgeru-komplekti">Burgeru komplekti</option>
                <option value="deserti">Deserti</option>
            </select>
        </div>
        <div class="field">
            <label for="image" >Attēls</label>
            <input type="file" name="image">
        </div>
        <div class="field">
            <input class="btn btn-primary" type="submit" value="Pievienot">
        </div>
    </form>
</body>
</html>
