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

    //displayErrorGame(displayErrorJSON);

}

const displayErrorGame = () => {
    
}


buttonAddFormGame.addEventListener('click', async() => {
    let formGame =  await fetchFormGame();
    displayForm(formGame, placeAddGame);
    let formSubmitGame = document.querySelector("#formGame");

    formSubmitGame.addEventListener('submit', (e) => {
        submitGame(e, formSubmitGame);
    })

})