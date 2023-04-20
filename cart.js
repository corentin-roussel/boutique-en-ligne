const getCartContentHTML = async() => {

    const response = await fetch('cart.php?getCart=1');
    const cartContentJSON = await response.text();

    return cartContentJSON;

}

const displayGamesIfNotEmpty = async() => {

    const content = JSON.parse(await getCartContentHTML());

    const divCartContent = document.getElementById('displayCartContent');

    const divAllGames = document.createElement('div');
    divAllGames.className = 'divAllGames';
    divAllGames.innerHTML = "";
    divCartContent.appendChild(divAllGames);

    let numOfTest = document.getElementsByClassName('numOf');


    for (const game in content) {
        if (Object.hasOwnProperty.call(content, game)) {

            const element = content[game];

            if(game === "displayGame") {

                for (const gameHTML in element) {
                    if (Object.hasOwnProperty.call(element, gameHTML)) {
                        
                        const htmlGame = element[gameHTML];
                        divAllGames.innerHTML = divAllGames.innerHTML + htmlGame;
                    }
                }                
            }
        }
    }

    const deleteButtons = document.getElementsByClassName('deleteGameCart');

    for (const deleteButton of deleteButtons) {

        deleteButton.addEventListener('click', async() => {

            const response = await fetch('cart.php?deleteItem=' + deleteButton.id);
            const result = await response.text();

            const allGames = deleteButton.parentNode.parentNode.parentNode.parentNode;
            const gameToDelete = deleteButton.parentNode.parentNode.parentNode;

            console.log(result);

            gameToDelete.innerHTML = result;

            setTimeout(() => {
                allGames.removeChild(gameToDelete)
            }, 5000);

            displayPriceBuy();
        })
    }



    for (const elementNumOf of numOfTest) {

        let numOf = elementNumOf.innerHTML;
        const itemId = elementNumOf.classList[0];
        const quantiteMoins = elementNumOf.previousElementSibling;
        const quantitePlus = elementNumOf.nextElementSibling;

        quantiteMoins.addEventListener('click', async() => {

            if(numOf > 1) {
                numOf--;
                elementNumOf.innerHTML = "";
                elementNumOf.innerHTML = numOf;
            }

            const response = await fetch('cart.php?changeQuantity=' + numOf + '&itemId=' + itemId)
            const message = await response.json();

        })

        quantitePlus.addEventListener('click', async() => {

            if(numOf < 50) {
                numOf++;
                elementNumOf.innerHTML = "";
                elementNumOf.innerHTML = numOf;
            }

            const response = await fetch('cart.php?changeQuantity=' + numOf + '&itemId=' + itemId);
            const message = await response.json();

        })
        
    }

}

const displayPriceIfNotEmpty = async() => {

    const content = JSON.parse(await getCartContentHTML());

    const divCartPriceBuy = document.getElementById('displayCartPriceBuy');

}



const divInspired = document.getElementById('displayInspired');

window.addEventListener('load', async() => {

    const contentJSON = JSON.parse(await getCartContentHTML());

    if(contentJSON['isEmpty'] === false) {

        displayGamesIfNotEmpty();

    }else{

        displayIfEmpty();

    }

});