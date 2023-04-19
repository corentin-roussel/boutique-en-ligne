const containerProfil = document.querySelector('.container-profil-left')

window.addEventListener('load', async()=>{
    await displayForm();
})


const displayForm = async()=>{
    const getUrlForm = await fetch('./profile_form.php');
    const responseRequest = await getUrlForm.text();
    containerProfil.innerHTML = responseRequest;
    const formProfil = document.querySelector('#form_profil');
    
    formProfil.addEventListener('submit',async(e)=>{
        e.preventDefault();
        // console.log("toto");
        await getInfo(formProfil);
    })

    
}


// displayForm();

const getInfo  = async(formData) =>{
    const url = await fetch('./profile.php?other=1',{
        method:"POST",
        body : new FormData(formData)
        
    })

    const response = await url.json();
    console.log(response);
}

// const displayMess = async () =>{
//     const getAddUrl = await fetch('./profil.php');

// }

