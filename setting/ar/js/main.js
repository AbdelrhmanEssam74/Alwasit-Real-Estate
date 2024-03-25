// Get all navigation items
const navItems = document.querySelectorAll('.sidebar__list-item');

// Add a click event listener to each item
navItems.forEach(item => {
    item.addEventListener('click', function () {
        // Remove the "active" class from all items
        navItems.forEach(navItem => {
            navItem.classList.remove('is_active');
        });

        // Add the "active" class to the clicked item
        this.classList.add('is_active');
    });
});
