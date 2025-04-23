document.addEventListener('DOMContentLoaded', function () {
    var userIcon = document.getElementById('userIcon');
    var tooltipBox = document.getElementById('tooltipBox');

    if (userIcon) {
        userIcon.addEventListener('click', function () {
            // Alternar la visibilidad del tooltip
            if (tooltipBox.style.display === 'block') {
                tooltipBox.style.display = 'none';
            } else {
                tooltipBox.style.display = 'block';
            }
        });
    }
});

