// Assigns the checkboxes and submit button of the form to variables
const checkboxes= document.querySelectorAll('.checkbox');
const submitButton = document.getElementById('compareButton');

// Disables usage of the submit button on page load
submitButton.disabled = true;

// Adds an event listener to each checkbox in 'checkboxes'
checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function() {
        // Assigns a variable to contain the checked checkboxes
        const checkedCheckboxes = document.querySelectorAll('.checkbox:checked');

        // Checks if the user has checked 2 checkboxes
        if (checkedCheckboxes.length == 2) {
            // Allows usage of the submit button
            submitButton.disabled = false;
        }else {
            // Disables usage of the submit button
            submitButton.disabled = true;
        }
    });
});