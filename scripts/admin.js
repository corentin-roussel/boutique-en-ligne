const btnAddPlateform = document.querySelector('#add_plat');
const formPlateform = document.querySelector('#form-insert-plateform');



// btnAddPlateform.addEventListener('click',(e)=>{

//     e.preventDefault();
//     console.log("test");
// })

formPlateform.addEventListener('submit',(e)=>{
    e.preventDefault();
    const form = new FormData(formPlateform);
    addPlateform(form);
    console.log("form");
})

async function addPlateform(form){
    const getUrlFetch = await fetch('admin.php',{
        method: 'POST',
        body:form
    });

    const dataJSON =  await getUrlFetch.json();
    console.log(JSON.stringify(dataJSON));

    displayMess(dataJSON);

}

function displayMess(dataJSON){

    const containerPlateform = document.querySelector('.container-mess-plateform');
    containerPlateform.innerHTML = "";
    
    
}

