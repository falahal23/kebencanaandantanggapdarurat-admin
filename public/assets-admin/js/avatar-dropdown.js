const userDropdown = document.getElementById('userDropdown');
const userMenu = document.getElementById('userDropdownMenu');

if (userDropdown && userMenu) {
    userDropdown.addEventListener('click', function(e) {
        e.stopPropagation();
        userMenu.classList.toggle('opacity-0');
        userMenu.classList.toggle('pointer-events-none');
    });

    document.addEventListener('click', function() {
        userMenu.classList.add('opacity-0');
        userMenu.classList.add('pointer-events-none');
    });
}
