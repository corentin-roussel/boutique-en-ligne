const getURLId = () => {

    const URLGet = window.location.search;
    const params = new URLSearchParams(URLGet);
    const productId = parseInt(params.get("id"));

    return productId;

}

const getAllDataProduct = async() => {

    const id = getURLId();

    const response = await fetch('product.php?getDataProduct=' + id);
    const dataProduct = await response.json();

    return dataProduct;

}

const displayProductData = (data) => {

    const display1 = document.getElementById('displayImageTextSelect');
    const display2 = document.getElementById('displayDescriptionAbout');

    display1.innerHTML = data['part1'];
    display2.innerHTML = data['part2'];
        

}

window.addEventListener('load', async() => {

    const dataProduct = await getAllDataProduct();

    displayProductData(dataProduct);

    const selectPlatform = document.getElementById('selectPlatform');
    
    const quantitePlus = document.getElementById('quantitePlus');
    const quantiteMoins = document.getElementById('quantiteMoins');
    const quantiteNum = document.getElementById('quantiteNum');
    let numOf = parseInt(quantiteNum.innerHTML);

    const titreAbout = document.getElementById('titreAbout');
    const paraAbout = document.getElementById('paraAbout');
    const titreDescription = document.getElementById('titreDescription');
    const paraDescription = document.getElementById('paraDescription');

    const cartButton = document.getElementById('cartButton');

    titreAbout.addEventListener('click', () => {

        if(paraAbout.style.display = 'none') {

            paraAbout.style.display = 'block';
            paraDescription.style.display = 'none';

        }

    })

    titreDescription.addEventListener('click', () => {

        if(paraDescription.style.display = 'none') {

            paraAbout.style.display = 'none';
            paraDescription.style.display = 'block';

        }

    })

    quantitePlus.addEventListener('click', () => {

        if(numOf < 50) {
            numOf++;
            quantiteNum.innerHTML = "";
            quantiteNum.innerHTML = numOf;
        }
    })

    quantiteMoins.addEventListener('click', () => {

        if(numOf > 1) {
            numOf--;
            quantiteNum.innerHTML = "";
            quantiteNum.innerHTML = numOf;
        }
    })

    cartButton.addEventListener('click', () => {

        const response = fetch('product.php?addToCart=' + getURLId() + '&quantity=' + numOf + '&platformId=' + selectPlatform.value);
        const resultCart = response.text();

        console.log(resultCart);

    })
})

