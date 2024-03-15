const checkboxes = document.querySelectorAll('.checkbox');
const submitButton = document.getElementById('compareButton');

submitButton.disabled = true;

checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function() {
        const checkedCheckboxes = document.querySelectorAll('.checkbox:checked');

        if (checkedCheckboxes.length == 2) {
            submitButton.disabled = false;
        }else {
            submitButton.disabled = true;
        }
    });
});