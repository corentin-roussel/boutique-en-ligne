let buttonAddFormGame = document.querySelector("#addFormGame");
let buttonShowGames = document.querySelector("#showGames")
let placeAddGame = document.querySelector("#placeAddGame");
let placeShowGame = document.querySelector("#placeShowGames");
let update_game;
let delete_game;
let update_place;





const fetchFormGame = async() => {
    const response = await fetch("admin_back.php?formAddGame=ok");
    const form = await response.text();

    return form;
}

const submitGame = async(e, form) => {
    e.preventDefault();

    let formDataGame = new FormData(form);
    const response = await fetch("admin_back.php?submitGame=1", {body: formDataGame, method: "POST"});
    const displayErrorJSON = await response.json()

    await displayErrorGame(displayErrorJSON);

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



const displayAllGame = async() => {
    const response = await fetch("admin_back.php?showGame=1");
    const result = await response.json();

    displayGame(result, placeShowGame);
}

const displayPrice = (price) => {
    return price / 100;
}

const displayGame = (game, place) =>{
    placeShowGame.innerHTML = "";
    let button = [];
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

        update_game =document.createElement("button");
        update_game.setAttribute("value", values.id)
        update_game.setAttribute("class", "button_update");
        update_game.innerHTML = "Update";
        div_place_game.appendChild(update_game);

        delete_game =document.createElement("button");
        delete_game.setAttribute("value", values.id)
        delete_game.setAttribute("class", "button_delete");
        delete_game.innerHTML = "Delete";
        div_place_game.appendChild(delete_game);

        update_place = document.createElement("div");
        update_place.setAttribute("id", values.id);
        update_place.setAttribute("class", "update_place")
        div_place_game.appendChild(update_place);
    }
}



const deleteGame = (idDelete) =>  {
    let formData = new FormData();
    formData.append("id" ,idDelete);

    const response = fetch("admin_back.php?deleteGame=ok", {
        method: "POST",
        body: formData
    })
}

const fetchUpdateFrom = async (id) => {
    let formData = new FormData();
    formData.append("id_update", id)

    const response = await fetch("admin_back.php?formAddGame=ok&updateGame=ok", {
        method: "POST",
        body: formData
    });
    const formUpdate = await response.text();

    return formUpdate
}

const updateGame = async(e, form, id) => {
    e.preventDefault()
    const formData = new FormData(form);
    formData.append("id" , id)
    const response = await fetch("admin_back.php?updateGame=ok", {
        method: "POST",
        body: formData
    })
    const json = await response.json();

    await displayErrorGame(json);
}



buttonAddFormGame.addEventListener('click', async() => {
    let formGame =  await fetchFormGame();
    displayForm(formGame, placeAddGame);
    let formSubmitGame = document.querySelector("#formGame");
    if(update_place !== undefined)
    {
        for(formPlace of update_place)
        {
            formPlace.innerHTML = "";
        }
    }


    formSubmitGame.addEventListener('submit', async (e) => {
        await submitGame(e, formSubmitGame);
        if(placeShowGame.innerHTML.length > 10 )
        {
            update_game = document.querySelectorAll(".button_update");
            delete_game = document.querySelectorAll(".button_delete");
            update_place = document.querySelectorAll(".update_place");
            await displayAllGame();
        }
    })

})

buttonShowGames.addEventListener('click', async() => {
    let button = await displayAllGame();
    update_game = document.querySelectorAll(".button_update");
    delete_game = document.querySelectorAll(".button_delete");
    update_place = document.querySelectorAll(".update_place");


    for(let j = 0; j < update_game.length; j++)
    {
        update_game[j].addEventListener("click", async () => {
            placeAddGame.innerHTML = "";
            for(let x = 0; x < update_place.length; x++)
            {
                update_place[x].innerHTML = "";
            }
            let formUpdate = await fetchUpdateFrom(update_game[j].value);
            displayForm(formUpdate, update_game[j].nextSibling.nextSibling);
            let formSubmitGame = document.querySelector("#formGame");

            formSubmitGame.addEventListener("submit", async(e) => {
                await updateGame(e, formSubmitGame, update_game[j].value);
                await displayAllGame();
            })



        })
    }

    for(let i = 0; i < delete_game.length; i++)
    {

        delete_game[i].addEventListener("click", () => {
            if(confirm('Are you sure you want to delete this game ??') === true)
            {
                deleteGame(delete_game[i].value);
                displayAllGame();
                alert("Your game has been deleted")
            }

        })
    }
})


