const form = document.getElementById('feedbackForm');
const alert = document.getElementById('alert-message')

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    document.querySelectorAll('[data-error]').forEach(el => {
        el.innerText = '';
    });

    const formData = new FormData(form);
    try {
        const response = await fetch('/api/tickets', {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
            },
            body: formData
        });

        const data = await response.json();

        if (!response.ok) {

            if (data.errors) {
                if(data.errors.contact !== undefined) {
                    alert.classList.add('warning')
                    alert.style.display = 'flex'
                    alert.innerText = data.errors.contact[0]
                }

                Object.keys(data.errors).forEach(field => {
                    const errorBlock = document.querySelector(`[data-error="${field}"]`);
                    if (errorBlock) {
                        errorBlock.innerText = data.errors[field][0];
                    }
                });
            }

            return;
        }

        // form.reset();
        alert.classList.remove('warning')
        alert.style.display = 'flex'
        alert.innerText = data.message;

    } catch (err) {
        alert.classList.add('warning')
        alert.style.display = 'flex'
        alert.innerText =`Server Error: ${err}`;
    }
});
