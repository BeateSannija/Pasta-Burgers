<ul id="menu">
    <li class="menu-item"><a href="{{ url('admin/dashboard')}}">Pasūtījumi</a></li>
    <li class="menu-item"><a href="">Pieprasījumi</a></li>
    <li class="menu-item"><a href="{{url('view_updateMenu')}}">Labot ēdienkarti</a></li>
    <li class="menu-item"><a href="">Pieņemšanas laiki</a></li>
    <li class="menu-item"><a href="">Pasūtījumu vēsture</a></li>
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