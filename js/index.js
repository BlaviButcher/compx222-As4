let lastSearch = document.getElementById("search-box").innerText;

// On go click get content of seach-box and dropdownOrder, then attatching
// these to the current url in varaibles
document.getElementById("search-go-button").addEventListener("click", () => {
  // // Get the contents of the search box.
  let search = document.getElementById("search-box").innerText;
  let order = document.getElementById("dropdownOrder").innerText;

  let url = new URL(window.location.href);

  url.searchParams.set("search", search);
  url.searchParams.set("order", order);
  window.location.href = url;
});

// Add click event for all grid items 
for (let item of document.getElementsByClassName("grid-item")) {
  // Get artist and song name of selected card and create a get request using these
  // variables going to php/detail.php
  item.addEventListener("click", () => {
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
    url.searchParams.set("title", songName);
    url.searchParams.set("artist", artistName);

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

// Add click event for each dropdown option
document.querySelectorAll("div.dropdown-menu a").forEach((dropdownItem) => {
  // updates dropdown face appeareance and creates a new get request
  // using the previous search and the newly selected order category
  dropdownItem.addEventListener("click", (event) => {
    let dropdownOrderMain = document.getElementById("dropdownOrder");
    // needs concat empty for style purposes - thanks bootstrap
    dropdownOrderMain.innerText = event.target.innerText + " ";

    // Get the contents of the search box.
    let order = document.getElementById("dropdownOrder").innerText;

    let url = new URL(window.location.href);

    url.searchParams.set("search", lastSearch);
    url.searchParams.set("order", order);
    window.location.href = url;
  });
});
