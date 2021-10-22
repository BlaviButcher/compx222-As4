// Get the last search made
let lastSearch = document.getElementById("search-box").innerText;

// On enter key-press in the search box, update the URL
document.getElementById("search-box").addEventListener("keypress", (event) => {
  if (event.key == "Enter") {
    // Prevent a new line from being written in the search box
    event.preventDefault();

    // Update the URL with the current contents of the search box
    updateURL(document.getElementById("search-box").innerText);
  }
});

// On click of the search button, update the URL with the current contents of the search box
document.getElementById("search-button").addEventListener("click", () => {
  updateURL(document.getElementById("search-box").innerText);
});

// On click of a dropdown item, update the dropdown box text and update the URL
document.querySelectorAll("div.dropdown-menu a").forEach((dropdownItem) => {
  dropdownItem.addEventListener("click", (event) => {
    // Set the text of the dropdown to the selected sort
    document.getElementById("dropdown").innerText = event.target.innerText;

    // Update the URL with the previous contents of the search box
    updateURL(lastSearch);
  });
});

// Adds click events for each grid item (song card)
for (let songCard of document.getElementsByClassName("grid-item")) {
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

/**
 * Updates the URL based on the search query passed in and the text in the dropdown box
 * @param {string} search The search query to put into the URL
 */
function updateURL(search) {
  let url = new URL(window.location.href);
  url.searchParams.set("search", search);
  url.searchParams.set("sort", document.getElementById("dropdown").innerText);
  window.location.href = url;
}
