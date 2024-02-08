const searchDropdown = document.getElementById("searchDropdown");
const searchText = document.getElementById("searchText");

searchDropdown.addEventListener("change", changeSearchPlaceholderText);

function changeSearchPlaceholderText() {
    switch (searchDropdown.value) {
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