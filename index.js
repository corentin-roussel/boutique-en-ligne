let carousel = document.querySelector("#carousel");
let previous = document.querySelector("#prev");
let next = document.querySelector("#next");
let link = document.querySelector("#carousel-link");
let img = document.querySelector("#carousel-img");



const getArray = async() => {
    const response = await fetch("index.php?getArray=ok");
    return await response.json();
}

// const displayImage = (e, array, link, img) => {
//     let i = 0
//     if(e.target.id === "next")
//     {
//         console.log(i)
//         for(i ; array[i]; i+=1)
//         {
//             console.log(array[i])
//             link.setAttribute("href", "product.php?id="+array[i].id)
//             img.setAttribute("src", array[i].image)
//         }
//     }
//     if(e.target.id === "prev")
//     {
//         console.log(i)
//         for(i ; array[i]; i-=1)
//         {
//             console.log(array[i])
//             link.setAttribute("href", "product.php?id="+array[i].id)
//             img.setAttribute("src", array[i].image)
//         }
//     }

const displayImage = (e, array ,previous ,next , link, img) => {
    let i = 0;

        link.href = "product.php?id="+array[i].id
        img.src = array[i].image;

        next.addEventListener("click", () => {
            i++

            if(i > array.length - 1)
            {
                i = 0;
            }

            link.href = "product.php?id="+array[i].id
            img.src = array[i].image
        })


        previous.addEventListener("click", () => {
            i--

            if(i < 0)
            {
                i = array.length - 1;
            }
            link.href = "product.php?id="+array[i].id
            img.src = array[i].image
        })
}

window.addEventListener("load", async (e) => {
    let array = await getArray();
    displayImage(e, array ,previous ,next , link, img);
})