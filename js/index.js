let lastSearch = document.getElementById("search-box").innerText;

// Listens for a click event on the go button for the search bar.
document
  .getElementById("search-go-button")
  .addEventListener("click", () => {
    // // Get the contents of the search box.
    let search = document.getElementById("search-box").innerText;
    let order = document.getElementById("dropdownOrder").innerText;

    let url = new URL(window.location.href);

    url.searchParams.set("search", search);
    url.searchParams.set("order", order);
    window.location.href = url;
  });


// Listens for a click event on each a song card and takes the user to the song's page.
for (let item of document.getElementsByClassName("grid-item")) {
  item.addEventListener("click", () => {
    // Get the artist and song name of the selected card and put it into an array.
    let artistName = item.children[1].children[1].children[1].textContent;
    let songName = item.children[1].children[0].children[1].textContent;

    // TODO: tokenize to make relative
    let url = new URL(window.location.href + "/php/detail.php");

    url.searchParams.append("title", songName);
    url.searchParams.append("artist", artistName);

    window.location.href = url;

  });
}


// Stop the ability to create a new line in search box
document.getElementById("search-box").addEventListener('keypress', (event) => {
  if (event.key === "Enter") {
      event.preventDefault();
  }
});

// if searchbox is empty hide cursors. Removes glitch
document.getElementById("search-box").addEventListener("input", function(event) {
  event.target.style.caretColor = event.target.textContent == "" ? 'transparent' : 'black';
});

// Handles the visual change of the dropdown on click
document.querySelectorAll("div.dropdown-menu a").forEach(dropdownItem => {
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


