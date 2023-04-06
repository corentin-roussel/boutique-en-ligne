const btnAddPlateform = document.querySelector('#add_plat');
const formPlateform = document.querySelector('#form-insert-plateform');



btnAddPlateform.addEventListener('click',(e)=>{
    e.preventDefault();
    console.log("test");
})

formPlateform.addEventListener('submit',(e)=>{
    e.preventDefault();
    console.log("form");
})