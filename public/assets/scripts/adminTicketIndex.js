const form = document.getElementById('filter-form')
const resetBtn = document.getElementById('reset-btn')

resetBtn.addEventListener('click', (e) => {
    e.preventDefault()
    form.reset()
})
