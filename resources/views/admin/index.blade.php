<!DOCTYPE html>
<html lang="en">
<head>

    @include('admin.head')

</head>
<body>
    <header>
        
        @include('admin.header')

    </header>
    <section class="main">
        
        @include('admin.sidebar')

        <div class="caption">
            <h2>Pasūtījumi</h2>
            <div class="content">    
                <!-- content, in this case - orders that are right now in-->
            </div>
        </div>
        
    </section>    
</body>
</html>