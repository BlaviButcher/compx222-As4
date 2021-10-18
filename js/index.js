let lastSearch = document.getElementById("search-box").innerText;

// On go click, gets content of seach-box and dropdown-order, then attaches
// these to the current URL in variables
document.getElementById("search-go-button").addEventListener("click", () => {
  // Get the contents of search-box and dropdown-order.
  let search = document.getElementById("search-box").innerText;
  let order = document.getElementById("dropdown-order").innerText;

  // Set the URL to a new URL with the previous variables attached to it
  let url = new URL(window.location.href);
  url.searchParams.set("search", search);
  url.searchParams.set("order", order);
  window.location.href = url;
});

// Click event for grid items (song cards)
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
    event.target.style.caretColor =
      event.target.textContent == "" ? "transparent" : "black";
  });

// Click event for each dropdown option
document.querySelectorAll("div.dropdown-menu a").forEach((dropdownItem) => {
  // Updates dropdown face appeareance and creates a new get request
  // using the previous search and the newly selected order category
  dropdownItem.addEventListener("click", (event) => {
    let dropdownOrderMain = document.getElementById("dropdown-order");
    // Needs concat empty for style purposes - thanks bootstrap
    dropdownOrderMain.innerText = event.target.innerText + " ";

    // Get the contents of dropdown-order
    let order = document.getElementById("dropdown-order").innerText;

    let url = new URL(window.location.href);

    url.searchParams.set("search", lastSearch);
    url.searchParams.set("order", order);
    window.location.href = url;
  });
});
