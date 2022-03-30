const deleteForms = document.querySelectorAll('.delete-form');

deleteForms.forEach(form => {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const valid = confirm('Vuoi eleminare il post?');
        if (valid) e.target.submit();
    });
});
