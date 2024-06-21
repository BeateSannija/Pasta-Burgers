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
            <h1> Ēdieni </h1>
        </div>
        <h2 id="add-dish"><a href="{{url('view_addDish')}}"> Pievienot ēdienu </a></h2>

        <div>
            <table class="dishes-table">
                <tr>
                    <th>Ēdiena nosaukums</th>    
                    <th>Apraksts</th> 
                    <th>Kategorija</th> 
                    <th>Cena</th> 
                    <th></th>
                    <th></th>
                </tr>  

                @foreach($dishes as $dish)
                <tr>
                    <td>{{ $dish->dish_name }}</td>
                    <td>{{ $dish->dish_description }}</td>
                    <td>{{ $dish->dish_category }}</td>
                    <td>{{ $dish->dish_price }}</td>
                    <td><a class="btn btn-success" href="{{url('edit_dish', $dish->id)}}">Labot</a></td>
                    <td><a class="btn btn-danger" href="{{url('delete_dish', $dish->id)}}">Dzēst</a></td>
                </tr>
            @endforeach

            </table>
        </div>

    </section> 

    


</body>
</html>