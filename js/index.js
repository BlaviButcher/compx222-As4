// Declare variables
let searchBox = document.getElementById("search-box"); // The search box
let searchButton = document.getElementById("search-button"); // The button for the search box
let dropdownSort = document.getElementById("dropdown-sort"); // The dropdown box that determines what the song cards will be sorted by
let lastSearch = document.getElementById("search-box").innerText; // The contents of the last search

// Make the search box caret transparent
searchBox.style.caretColor = "transparent";

// On enter key-press in the search box, do a search
searchBox.addEventListener("keypress", (event) => {
  if (event.key == "Enter") {
    // Prevent a new line from being written in the search box
    event.preventDefault();
    search();
  }
});

// On click of the search button, do a search
searchButton.addEventListener("click", () => {
  search();
});

// Gets content of seach-box and dropdown-sort, then attaches these to the current URL in variables
function search() {
  // Get the contents of search-box and dropdown-sort.
  let search = searchBox.innerText;
  let sort = dropdownSort.innerText;

  // Set the URL to a new URL with the previous variables attached to it
  let url = new URL(window.location.href);
  url.searchParams.set("search", search);
  url.searchParams.set("sort", sort);
  window.location.href = url;
}

// Adds click events for grid items (song cards)
for (let item of document.getElementsByClassName("grid-item")) {
  // Get artist and song name of selected card and create a get request using these
  // variables going to php/detail.php
  item.addEventListener("click", () => {
    let artistName = item.children[1].children[1].children[1].textContent;
    let songName = item.children[1].children[0].children[1].textContent;

    // Generate a new URL from the current by removing its parameters using tokenisation
    let urlArray = location.href.split("/");
    let urlString = "";
    for (let i = 0; i < urlArray.length - 1; i++) {
      urlString += urlArray[i];
      urlString += "/";
    }
    urlString += "php/detail.php";
    let url = new URL(urlString);

    // Append the artist and song name to the variables of the new URL
    url.searchParams.set("title", songName);
    url.searchParams.set("artist", artistName);

    // Change the current URL to the new URL
    window.location.href = url;
  });
}

// Click event for each dropdown option
document.querySelectorAll("div.dropdown-menu a").forEach((dropdownItem) => {
  // Updates dropdown face appeareance and creates a new get request
  // using the previous search and the newly selected sort category
  dropdownItem.addEventListener("click", (event) => {
    let dropdownSortMain = document.getElementById("dropdown-sort");
    // Needs concat empty for style purposes - thanks bootstrap
    dropdownSortMain.innerText = event.target.innerText + " ";

    // Get the contents of dropdown-sort
    let sort = dropdownSort.innerText;

    // Add the selected sort as a variable for the URL
    let url = new URL(window.location.href);
    url.searchParams.set("search", lastSearch);
    url.searchParams.set("sort", sort);
    window.location.href = url;
  });
});
