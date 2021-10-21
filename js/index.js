// Declare variables
let searchBox = document.getElementById("search-box"); // The search box
let lastSearch = searchBox.innerText; // The last search made
let searchButton = document.getElementById("search-button"); // The button for the search box
let dropdown = document.getElementById("dropdown"); // The dropdown box that determines how song cards will be sorted
let dropdownItems = document.querySelectorAll("div.dropdown-menu a"); // An array of items in the dropdown box
let songCards = document.getElementsByClassName("grid-item"); // An array of song cards

// On enter key-press in the search box, update the URL
searchBox.addEventListener("keypress", (event) => {
  if (event.key == "Enter") {
    // Prevent a new line from being written in the search box
    event.preventDefault();

    // Update the URL with the current contents of the search box
    updateURL(searchBox.innerText);
  }
});

// On click of the search button, update the URL with the current contents of the search box
searchButton.addEventListener("click", () => {
  updateURL(searchBox.innerText);
});

// On click of a dropdown item, update the dropdown box text and update the URL
dropdownItems.forEach((dropdownItem) => {
  dropdownItem.addEventListener("click", (event) => {
    // Set the text of the dropdown to the selected sort
    dropdown.innerText = event.target.innerText;

    // Update the URL with the previous contents of the search box
    updateURL(lastSearch);
  });
});

// Updates the URL based on the search contents given and the text in the dropdown box
function updateURL(search) {
  let url = new URL(window.location.href);
  url.searchParams.set("search", search);
  url.searchParams.set("sort", dropdown.innerText);
  window.location.href = url;
}

// Adds click events for each grid item (song card)
for (let songCard of songCards) {
  songCard.addEventListener("click", () => {
    // Get the artist and title of the selected card
    let artist = songCard.children[1].children[1].children[1].textContent;
    let title = songCard.children[1].children[0].children[1].textContent;

    // Generate a URL to "detail.php" by tokenising the current URL
    let urlArray = location.href.split("/");
    let urlString = "";
    for (let i = 0; i < urlArray.length - 1; i++) {
      urlString += urlArray[i];
      urlString += "/";
    }
    urlString += "php/detail.php";
    let url = new URL(urlString);

    // Add the artist and title to the URL
    url.searchParams.set("title", title);
    url.searchParams.set("artist", artist);
    window.location.href = url;
  });
}
