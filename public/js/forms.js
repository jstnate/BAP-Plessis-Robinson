let nextForm = document.querySelectorAll('#step');

nextForm.forEach(next => {
    next.addEventListener('click', () => {
        let currentDiv = document.getElementById(`step-${next.value}`)
        let nextDiv = document.getElementById(`step-${parseInt(next.value) + 1}`)
        currentDiv.style.display = 'none'
        nextDiv.style.display = 'block'
    })
})