const alphabetContainer = document.getElementById('alphabetContainer');
const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

function scrollToLetter(letter) {
    const listContainer = document.getElementById('listContainer');
    const listItems = Array.from(listContainer.getElementsByClassName('listItem'));

    for (let listItem of listItems) {
        if (listItem.textContent.startsWith(letter)) {
            listItem.scrollIntoView();
            break;
        }
    }
}

for (let letter of alphabet) {
    const button = document.createElement('button');

    button.textContent = letter;
    button.classList.add('alphabetButton');
    alphabetContainer.appendChild(button);
    button.addEventListener('click', () => scrollToLetter(letter));
}