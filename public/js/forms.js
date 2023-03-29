let index = 1;
let requiredFields = document.querySelectorAll(`.required-1`)
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
    requiredFields = document.querySelectorAll(`.required-${index}`);
    nextButton = document.getElementById(`submit-${index}`);
    currentDiv.style.display = 'none';
    nextDiv.style.display = 'flex';
    varSetup();
}

const fileInputs = document.querySelectorAll('input[type="file"]');

fileInputs.forEach(fileInput => {
    fileInput.addEventListener('change', () => {
        let fileBox = document.getElementById(`${fileInput.id}-dropbox`)
        let fileName = document.getElementById(`${fileInput.id}-file-name`)
        if (fileInput.files.length > 0) {
          fileBox.classList.add('filled');
          console.log(fileBox.classList)
          fileName.textContent = fileInput.files[0].name;
        } else {
          fileName.textContent = '';
        }
      });
})

