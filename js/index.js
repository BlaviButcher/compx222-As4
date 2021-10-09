// Listens for a click event on the go button for the search bar.
document.getElementById("search-go-button").addEventListener("click", (event) => {
    
    // Get the contents of the search box.
    let request = document.getElementById("search-box").innerText;

    // Create a form and configure it.
    let form = document.createElement("form");
    form.method = "GET";
    form.action = window.location.href;
    
    // Create a field for the form that contains the search request.
    let field = document.createElement("input");
    field.type = "hidden";
    field.name = "search";
    field.value = request;

    // Append the field and the form to the body.
    form.appendChild(field);
    document.body.appendChild(form);


    // Submit the form.
    form.submit();
});

// Listens for a click event on each a song card and takes the user to the song's page.
for (let item of document.getElementsByClassName("grid-item")) {
    item.addEventListener("click", () => {
    
        // Get the artist and song name of the selected card and put it into an array.
        let artistName = item.children[1].children[1].children[1].textContent;
        let songName = item.children[1].children[0].children[1].textContent;
        let data = [
            artistName,
            songName
        ];

        // Create a form and configure it.
        let form = document.createElement("form");
        form.method = "get";
        form.action = window.location.href;
        
        // Create a field for the form that contains the search request.
        for (let i = 0; i < 2; i++) {
        let field = document.createElement("input");
        field.type = "hidden";
        field.name = "search";
        field.value = data[i];
        form.appendChild(field);
        }

        // Append the form to the body and submit it.
        document.body.appendChild(form);
        form.submit();
    })
}



