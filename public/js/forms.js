// let index = 1;

// let nextForm = document.querySelectorAll('#step');

// nextForm.forEach(next => {
//     next.addEventListener('click', nextStep(next))
// })

// function nextStep(next) {
//         // let currentDiv = document.getElementById(`step-${next.value}`)
//         // let nextDiv = document.getElementById(`step-${parseInt(next.value) + 1}`)
//         // currentDiv.style.display = 'none'
//         // nextDiv.style.display = 'block'
//         console.log(next);
// }


// function formStep() {
//     // let requiredFields = document.querySelectorAll(`#required-${index}`);

//     // requiredFields.forEach(field => {
//     //     field.length === 0 ? stepButton.disabled = true : nextStep(stepButton);
//     // })
//     console.log('caca');
// }
let index = 1;
let requiredFields = document.querySelectorAll(`#required-1`)
let nextButton = document.getElementById('submit-1');

window.onload = varSetup();

function varSetup() {
    checkRequiredFields();
    requiredFields.forEach(field => {
        field.addEventListener('input', checkRequiredFields);
    });
}

function checkRequiredFields() {
    let allFieldsFilled = true;
    requiredFields.forEach(field => {
        if (field.value === '') {
            allFieldsFilled = false;
        }
    });

    if (allFieldsFilled) {
        nextButton.disabled = false;
        nextButton.addEventListener('click', showNextFields);
    } else {
        nextButton.disabled = true;
    }
}

function showNextFields() {
    let currentDiv = document.getElementById(`step-${index}`);
    index++;
    let nextDiv = document.getElementById(`step-${index}`);
    requiredFields = document.querySelectorAll(`#required-${index}`);
    nextButton = document.getElementById(`submit-${index}`);
    currentDiv.style.display = 'none';
    nextDiv.style.display = 'block';
    varSetup();
}

