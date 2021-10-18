// Gets the last search.
let lastSearch = document.getElementById("search-box").innerText;

// Listens for a click event on the go button for the search bar.
document.getElementById("search-go-button").addEventListener("click", () => {
  // // Get the contents of the search box.
  let search = document.getElementById("search-box").innerText;
  let order = document.getElementById("dropdownOrder").innerText;

  let url = new URL(window.location.href);

  url.searchParams.set("search", search);
  url.searchParams.set("order", order);
  window.location.href = url;
});

// Listens for a click event on each song card and takes the user to the appropriate song page upon click.
for (let item of document.getElementsByClassName("grid-item")) {
  item.addEventListener("click", () => {
    // Get the artist and song name of the selected card.
    let artistName = item.children[1].children[1].children[1].textContent;
    let songName = item.children[1].children[0].children[1].textContent;

    // Generate a new URL from the current by removing its parameters using tokenisation.
    let urlArray = location.href.split("/");
    let urlString = "";
    for (let i = 0; i < urlArray.length - 1; i++) {
      urlString += urlArray[i];
      urlString += "/";
    }
    urlString += "php/detail.php";
    let url = new URL(urlString);

    // Append the artist and song name to the params of the new URL.
    url.searchParams.append("title", songName);
    url.searchParams.append("artist", artistName);

    // Change the current URL to the new URL.
    window.location.href = url;
  });
}

// Prevents new lines from being able to be created in the search box.
document.getElementById("search-box").addEventListener("keypress", (event) => {
  if (event.key === "Enter") {
    event.preventDefault();
  }
});

// If the search box is empty, hide the cursor. (Patches the pesky Mozzilla cursor rendering glitch.)
document
  .getElementById("search-box")
  .addEventListener("input", function (event) {
    event.target.style.caretColor =
      event.target.textContent == "" ? "transparent" : "black";
  });

// Handles the visual change of the dropdown on click
document.querySelectorAll("div.dropdown-menu a").forEach((dropdownItem) => {
  dropdownItem.addEventListener("click", (event) => {
    let dropdownOrderMain = document.getElementById("dropdownOrder");
    // needs concat empty for style purposes - thanks bootstrap
    dropdownOrderMain.innerText = event.target.innerText + " ";

    // // // Get the contents of the search box.
    let order = document.getElementById("dropdownOrder").innerText;

    let url = new URL(window.location.href);

    url.searchParams.set("search", lastSearch);
    url.searchParams.set("order", order);
    window.location.href = url;
  });
});
