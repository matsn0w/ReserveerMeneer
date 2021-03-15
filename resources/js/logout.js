const logoutForm = document.forms.namedItem('logout-form');
const logoutButtons = document.querySelectorAll('*[data-action="logout"]');

if (logoutForm && logoutButtons) {
    logoutButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            logoutForm.submit();
        });
    });
}
