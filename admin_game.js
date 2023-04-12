let buttonAddFormGame = document.querySelector("#addFormGame");
let buttonShowGames = document.querySelector("#showGames")
let placeAddGame = document.querySelector("#placeAddGame");
let placeShowGame = document.querySelector("#placeShowGames")





const fetchFormGame = async() => {
    const response = await fetch("admin_back.php?formAddGame=ok");
    const form = await response.text();

    return form;
}

const displayForm = (form, place) => {
    place.innerHTML = "";
    place.innerHTML = form;
}

const displayErrorGame = async(json) => {
    const error_field = document.querySelector("#error-field");
    error_field.innerHTML = "";

    const error_desc = document.querySelector("#error-desc");
    error_desc.innerHTML = "";

    const error_price = document.querySelector("#error-price");
    error_price.innerHTML = "";

    if(json["priceCheck"])
    {
        const price_error = document.createElement("small");
        price_error.innerHTML = json['priceCheck'];
        price_error.className = "error";
        error_price.appendChild(price_error);
    }
    if(json["lengthDesc"])
    {
        const desc_error = document.createElement("small");
        desc_error.innerHTML = json['lengthDesc'];
        desc_error.className = "error";
        error_price.appendChild(desc_error);
    }
    if(json["emptyValues"])
    {
        const field_error = document.createElement("small");
        field_error.innerHTML = json['emptyValues'];
        field_error.className = "error";
        error_field.appendChild(field_error);
    }
    if(json['okAddGame'])
    {
        alert(json['okAddGame'])
    }

}

const loopOnIndex = (objet, index) => {
    let indexes;
    for(let i = 0; i < index.length; i++)
    {
        indexes = objet[i]
    }
    return {"indexes" : indexes}
}

const fetchAllGame = async() => {
    const response = await fetch("admin_back.php?showGame=1");
    const result = await response.json();

    displayGame(result, placeShowGame);
}

const displayPrice = (price) => {
    return price / 100;
}

const displayGame = (game, place) =>{
    placeShowGame.innerHTML = "";
    for(values of game)
    {
        const div_place_game = document.createElement("div");
        div_place_game.setAttribute("class", "div_place_game")
        place.appendChild(div_place_game);


        const image_game = document.createElement("img");
        image_game.setAttribute("src", values.image);
        image_game.setAttribute("class", "image_game");
        div_place_game.appendChild(image_game);

        const title_game = document.createElement("h2");
        title_game.setAttribute("class", "title_game");
        title_game.innerHTML = values.title;
        div_place_game.appendChild(title_game);

        const desc_game = document.createElement("p");
        desc_game.setAttribute("class", "desc_game");
        desc_game.innerHTML = values.description;
        div_place_game.appendChild(desc_game);

        const price_game = document.createElement("p");
        price_game.setAttribute("class", "price_game");
        let final_price = displayPrice(values.price);
        price_game.innerHTML = final_price + "€";
        div_place_game.append(price_game);

        const div_platform = document.createElement("div");
        div_platform.setAttribute("class", "div_platform")
        let platform_game;
        for(index of values.platforms)
        {
            platform_game = document.createElement("p");
            platform_game.setAttribute("class", "platform_game");
            platform_game.innerHTML = index.platform;
            div_platform.append(platform_game);
        }
        div_place_game.appendChild(div_platform);

        const update_game =document.createElement("button");
        update_game.setAttribute("value", values.id)
        update_game.setAttribute("class", "button");
        update_game.innerHTML = "Update";
        div_place_game.appendChild(update_game);

        const delete_game =document.createElement("button");
        delete_game.setAttribute("value", values.id)
        delete_game.setAttribute("class", "button");
        delete_game.innerHTML = "Delete";
        div_place_game.appendChild(delete_game);

    }
}

const submitGame = async(e, form) => {
    e.preventDefault();

    let formDataGame = new FormData(form);
    const response = await fetch("admin_back.php?submitGame=1", {body: formDataGame, method: "POST"});
    const displayErrorJSON = await response.json()

    await displayErrorGame(displayErrorJSON);

}




buttonAddFormGame.addEventListener('click', async() => {
    let formGame =  await fetchFormGame();
    displayForm(formGame, placeAddGame);
    let formSubmitGame = document.querySelector("#formGame");

    formSubmitGame.addEventListener('submit', (e) => {
        submitGame(e, formSubmitGame);
    })

})

buttonShowGames.addEventListener('click', async() => {
    await fetchAllGame();
})

