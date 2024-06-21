<ul id="menu">
    <li class="menu-item"><a href="{{url('admin/dashboard')}}">Pasūtījumi</a></li> <!--mark as ready-->
    <li class="menu-item"><a href="{{url('view_requests')}}">Pieprasījumi</a></li> <!--accept or reject-->
    <li class="menu-item"><a href="{{url('view_updateMenu')}}">Ēdienkarte</a></li> <!--add dishes from database or remove from menu-->
    <li class="menu-item"><a href="{{url('view_dishes')}}">Ēdieni</a></li> <!--add or delete dishes from database-->
    <li class="menu-item"><a href="{{url('view_time')}}">Pieņemšanas laiki</a></li> <!--set time when ordering ends-->
    <li class="menu-item"><a href="{{url('view_orderHistory')}}">Pasūtījumu vēsture</a></li> <!--all history of orders (like in lab about cars)-->
</ul>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('#menu a');
        const currentUrl = new URL(window.location.href);
        console.log('Current URL:', currentUrl.href);

        const normalizePath = (url) => url.pathname.replace(/\/$/, '');

        links.forEach(link => {
            link.classList.remove('highlight');
            const linkUrl = new URL(link.href, window.location.origin);
            console.log('Link URL:', linkUrl.href);

            // Compare only the pathnames, ignoring trailing slashes
            if (normalizePath(linkUrl) === normalizePath(currentUrl)) {
                console.log('Match found:', link.href);
                link.classList.add('highlight');
            }
        });

        // Handle clicks to dynamically highlight menu items
        links.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior
                links.forEach(link => link.classList.remove('highlight'));
                this.classList.add('highlight');
                window.location.href = this.href; // Manually navigate to the clicked link
            });
        });
    });
</script>