let lastSearch = document.getElementById("search-box").innerText;

// On go click, gets content of seach-box and dropdown-sort, then attaches
// these to the current URL in variables
document.getElementById("search-go-button").addEventListener("click", () => {
  // Get the contents of search-box and dropdown-sort.
  let search = document.getElementById("search-box").innerText;
  let sort = document.getElementById("dropdown-sort").innerText;

  // Set the URL to a new URL with the previous variables attached to it
  let url = new URL(window.location.href);
  url.searchParams.set("search", search);
  url.searchParams.set("sort", sort);
  window.location.href = url;
});

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

// Prevents new lines from being able to be created in the search box
document.getElementById("search-box").addEventListener("keypress", (event) => {
  if (event.key === "Enter") {
    event.preventDefault();
  }
});

// If the search box is empty, hide the cursor (patches the pesky Mozzilla cursor rendering glitch)
document
  .getElementById("search-box")
  .addEventListener("input", function (event) {
    event.target.style.caretColor = "transparent";
  });

// Click event for each dropdown option
document.querySelectorAll("div.dropdown-menu a").forEach((dropdownItem) => {
  // Updates dropdown face appeareance and creates a new get request
  // using the previous search and the newly selected sort category
  dropdownItem.addEventListener("click", (event) => {
    let dropdownSortMain = document.getElementById("dropdown-sort");
    // Needs concat empty for style purposes - thanks bootstrap
    dropdownSortMain.innerText = event.target.innerText + " ";

    // Get the contents of dropdown-sort
    let sort = document.getElementById("dropdown-sort").innerText;

    let url = new URL(window.location.href);

    url.searchParams.set("search", lastSearch);
    url.searchParams.set("sort", sort);
    window.location.href = url;
  });
});
