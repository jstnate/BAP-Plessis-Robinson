// Initialize the index to 1, which will be used to keep track of the current step
let index = 1;

// Select all required fields in step 1 and store them in an array
let requiredFields = document.querySelectorAll(`.required-1`);

// Select the "Next" button element by its ID and store it in a variable
let nextButton = document.getElementById('submit-1');

// Call the varSetup() function when the window is loaded
window.onload = varSetup();

// Function to set up the required event listeners
function varSetup() {
    // Call the checkRequiredFields() function initially
    checkRequiredFields();

    // Add an event listener to each required field that calls the checkRequiredFields() function when its value is changed
    requiredFields.forEach(field => {
        field.addEventListener('input', checkRequiredFields);
    });
}

// Function to check if all required fields are filled
function checkRequiredFields() {
    // Initialize a variable to true that will be used to determine if all required fields are filled
    let allFieldsFilled = true;

    // Loop through each required field and check if its value is empty
    requiredFields.forEach(field => {
        if (field.value === '') {
            // If the field value is empty, set the allFieldsFilled variable to false
            allFieldsFilled = false;
        }
    });

    // Check if the "Next" button element exists and if all required fields are filled
    if (nextButton !== null) {
        if (allFieldsFilled) {
            // If all required fields are filled, enable the "Next" button and add an event listener to show the next step
            nextButton.disabled = false;
            nextButton.addEventListener('click', showNextFields);
        } else {
            // If any required field is empty, disable the "Next" button
            nextButton.disabled = true;
        }
    }
}

// Function to show the next step
function showNextFields() {
    // Get the current step element by its ID and hide it
    let currentDiv = document.getElementById(`step-${index}`);
    index++;

    // Get the next step element by its ID and show it
    let nextDiv = document.getElementById(`step-${index}`);

    // Update the requiredFields array to include all required fields in the new step
    requiredFields = document.querySelectorAll(`.required-${index}`);

    // Update the nextButton variable to be the "Next" button element in the new step
    nextButton = document.getElementById(`submit-${index}`);

    // Hide the current step element and show the next step element
    currentDiv.style.display = 'none';
    nextDiv.style.display = 'flex';

    // Call the varSetup() function to set up event listeners for the new step
    varSetup();
}

// Select all file input elements and add an event listener to each one
const fileInputs = document.querySelectorAll('input[type="file"]');
fileInputs.forEach(fileInput => {
    fileInput.addEventListener('change', () => {
        // Get the dropbox element and file name element associated with the file input element
        let fileBox = document.getElementById(`${fileInput.id}-dropbox`);
        let fileName = document.getElementById(`${fileInput.id}-file-name`);

        if (fileInput.files.length > 0) {
            // If a file has been selected, add the "filled" class to the dropbox element and display the file name
            fileBox.classList.add('filled');
            console.log(fileBox.classList);
            fileName.textContent = fileInput.files[0].name;
        } else {
            // If no file has been selected, clear the file name
            fileName.textContent = '';
        }
    });
});    
