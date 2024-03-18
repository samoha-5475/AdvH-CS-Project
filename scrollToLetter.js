// Assigns a <div> container and initializes the alphabet to a variable
const alphabetContainer = document.getElementById('alphabetContainer');
const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

// Defines the function to scroll to a letter within a defined container
function scrollToLetter(letter) {
    // Gets a <div> container by id and assigns it to a variable
    const listContainer = document.getElementById('listContainer');

    // Generates an array from the elements classed 'listItem' in the container defined above
    const listItems = Array.from(listContainer.getElementsByClassName('listItem'));

    // Starts a loop each item in the array of list items
    for (let listItem of listItems) {
        // If the content of the current list item matches the letter passed into the function
        if (listItem.textContent.startsWith(letter)) {
            // Scroll to that list item on the page
            listItem.scrollIntoView();
            break;
        }
    }
}

// Starts a loop for each letter in the alphabet
for (let letter of alphabet) {
    // Creates a button on the screen
    const button = document.createElement('button');

    // Gives the content of the button the current letter
    button.textContent = letter;

    // Assigns the button to a class for styling
    button.classList.add('alphabetButton');

    // Adds the button to a <div> container
    alphabetContainer.appendChild(button);

    // Adds an onclick event listener to the current button
    button.addEventListener('click', () => scrollToLetter(letter));
}