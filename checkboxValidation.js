const checkboxes = document.querySelectorAll('.checkbox');
const maxCheckedboxes= 2;

checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function() {
        const checkedCheckboxes = document.querySelectorAll('.checkbox:checked');

        if (checkedCheckboxes.length > maxCheckedboxes) {
            this.checked = false;
        }
    });
});