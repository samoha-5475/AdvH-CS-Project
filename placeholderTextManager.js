// Assigns the search dropdown and text elements to variables
const searchDropdown = document.getElementById("searchDropdown");
const searchText = document.getElementById("searchText");

// Adds an event listener to the search dropdown menu
searchDropdown.addEventListener("change", changeSearchPlaceholderText);

// Creates the function to change the placeholder text of the search field
function changeSearchPlaceholderText() {
    // Declares a switch function of the value of the search dropdown
    switch (searchDropdown.value) {
        // For each case, the placeholder text is changed appropriately
        case "drivers":
            searchText.placeholder = "Enter driver name...";
            break;
        case "constructors":
            searchText.placeholder = "Enter team name...";
            break;
        case "circuits":
            searchText.placeholder = "Enter track name...";
    }
}