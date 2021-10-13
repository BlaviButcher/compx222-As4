// Listens for a click event on the go button for the search bar.
document
  .getElementById("search-go-button")
  .addEventListener("click", () => {
    // // Get the contents of the search box.
    let request = document.getElementById("search-box").innerText;

    let url = new URL(window.location.href);

    url.searchParams.set("search", request);
    window.location.href = url;
  });


// Listens for a click event on each a song card and takes the user to the song's page.
for (let item of document.getElementsByClassName("grid-item")) {
  item.addEventListener("click", () => {
    // Get the artist and song name of the selected card and put it into an array.
    let artistName = item.children[1].children[1].children[1].textContent;
    let songName = item.children[1].children[0].children[1].textContent;

    // TODO: tokenize to make relative
    let url = new URL("http://localhost/compx222-As4/php/detail.php");

    url.searchParams.append("title", songName);
    url.searchParams.append("artist", artistName);

    window.location.href = url;

  });
}
