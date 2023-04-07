const getRolesJSON = async() => {

    const response = await fetch('back_admin_user.php?roles=1');
    const dataJSON = await response.json();

    console.log(dataJSON);

    return dataJSON;

}

const displaySelectRoles = async(functionToUse, selectId) => {

    const rolesJSON = await functionToUse;

    const parentSelect = document.getElementById(selectId);

    rolesJSON.forEach(role => {

        let selectRole = document.createElement("option");
        selectRole.value = role['id'];
        selectRole.innerHTML = role['role'];
        parentSelect.appendChild(selectRole);
        
    });

}

const getRoleByInput = async(roleId) => {

    const response = await fetch('back_admin_user.php?inputRole=' + roleId);
    const userDataJSON = await response.json();

    return userDataJSON;

}

const getAllRolesExeptActualJSON = async(actualRoleId) => {

    const response = await fetch('back_admin_user.php?actualRole=' + actualRoleId);
    const roles = await response.json();

    return roles;

}

const displayRoleByInput = async(roleId) => {

    const displayDiv = document.getElementById('displayUserData');

    const userDataJSON = await getRoleByInput(roleId);

    userDataJSON.forEach(user => {
        console.log(user);

        displayDiv.innerHTML = "";

        const sectionUser = document.createElement("section");
        sectionUser.id = 'user' + user['id'];
        sectionUser.className = 'sectionUser';

        displayDiv.appendChild(sectionUser);

            const divLoginRoleDelete = document.createElement("div");
            divLoginRoleDelete.className = 'divLoginRoleDelete';

            sectionUser.appendChild(divLoginRoleDelete);

                const titreLogin = document.createElement("h3");
                titreLogin.className = 'titreLogin';
                titreLogin.innerHTML = user['login'];

                divLoginRoleDelete.appendChild(titreLogin);

                const selectChangeRole = document.createElement("select");
                selectChangeRole.name='rolesChange';
                selectChangeRole.id = 'changeRoleUser' + user['id'];
                selectChangeRole.className = 'selectChangeRole';
                
                divLoginRoleDelete.appendChild(selectChangeRole);

                    const optionActuelRoleUser = document.createElement("option");
                    optionActuelRoleUser.value = user['id_role'];
                    optionActuelRoleUser.innerHTML = user['role'];
                    displaySelectRoles(getAllRolesExeptActualJSON(user['id_role']), selectChangeRole.id);
                    
                    selectChangeRole.appendChild(optionActuelRoleUser);

                const deleteUserButton = document.createElement("button");
                deleteUserButton.id = user['id'];
                deleteUserButton.className = 'deleteUserButtons';
                deleteUserButton.innerHTML = 'Delete';

                divLoginRoleDelete.appendChild(deleteUserButton);

                /**************************************************************************************/
                /************************** AJOUTER ICONE FLECHE VERS LE BAS **************************/
                /**************************************************************************************/

            const divOtherUserData = document.createElement("div");
            divOtherUserData.className = 'divOtherUserData';
            // divOtherUserData.style.display = "none";

            sectionUser.appendChild(divOtherUserData);

                const paraId = document.createElement("p");
                paraId.innerHTML = 'id : ' + user['id'];

                const paraEmail = document.createElement("p");
                paraEmail.innerHTML = 'email : ' + user['email'];

                const paraFirstname = document.createElement("p");
                paraFirstname.innerHTML = 'firstname : ' + user['firstname'];

                const paraLastname = document.createElement("p");
                paraLastname.innerHTML = 'lastname : ' + user['lastname'];

                const paraBirthDate = document.createElement("p");
                paraBirthDate.innerHTML = 'birth date : ' + user['birth_date'];

                const paraPhoneNumber = document.createElement("p");
                paraPhoneNumber.innerHTML = 'phone number : ' + user['phone_number'];

                divOtherUserData.appendChild(paraId).appendChild(paraEmail).appendChild(paraFirstname).appendChild(paraLastname).appendChild(paraBirthDate).appendChild(paraPhoneNumber);

                /*********************************************************************************/
                /************************** AJOUTER COMMANDES DU USER ? **************************/
                /*********************************************************************************/
    
    });

}





const rolesSelect = document.getElementById('role');

displaySelectRoles(getRolesJSON(), 'role');
displayRoleByInput('all');

rolesSelect.onchange = async(e) => {

    var roleId = e.target.value;
    displayRoleByInput(roleId);

}