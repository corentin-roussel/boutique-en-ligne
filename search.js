const getAllProducts = async(search) => {

    const response = await fetch('_include/header.php?getAll=1&search=' + search);
    const products = await response.json();

    return products;

}

const searchBar = document.getElementById('searchBar');
const mainList = document.getElementsByTagName('main');
const mainBefore = mainList[0];
const bodyList = document.getElementsByTagName('body');
const body = bodyList[0];

searchBar.addEventListener('keyup', async() => {

    mainBefore.style.display = "none";

    const mainSearch = document.createElement('main');

    main.className = "searchMain";

    const productsPagination = getAllProducts(searchBar.value);

})