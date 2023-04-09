let buttonAddFormGame = document.querySelector("#addFormGame");
let placeAddGame = document.querySelector("#placeAddGame");



const displayForm = (form, place) => {
    place.innerHTML = "";
    place.innerHTML = form;
}

const fetchFormGame = async() => {
    const response = await fetch("adminForm.php");
    const form = await response.text();

    return form;
}

const submitGame = async(e, form) => {
    e.preventDefault();

    let formDataGame = new FormData(form);
    const response = await fetch("admin.php?submitGame=1", {body: formDataGame, method: "POST"});
    const displayErrorJSON = await response.json()

    await displayErrorGame(displayErrorJSON);

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


buttonAddFormGame.addEventListener('click', async() => {
    let formGame =  await fetchFormGame();
    displayForm(formGame, placeAddGame);
    let formSubmitGame = document.querySelector("#formGame");

    formSubmitGame.addEventListener('submit', (e) => {
        submitGame(e, formSubmitGame);
    })

})