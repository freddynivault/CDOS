function showUser(){
    var selectBox = document.getElementById('registration_form_role');
    if (null == selectBox)
    {
        selectBox = document.getElementById('super_admin_registration_form_role');
    }
    var userInput = selectBox.options[selectBox.selectedIndex].value;
    document.getElementById('formCandidat').style.display='none';
    document.getElementById('formAdminS').style.display='none';

    if (userInput == 'ROLE_CANDIDAT'){
        document.getElementById('formCandidat').style.display='flex';
        document.getElementById('formAdminS').style.display='none';
    }
    else if (userInput == 'ROLE_ADMIN_STRUCTURE'){
        document.getElementById('formCandidat').style.display='none';
        document.getElementById('formAdminS').style.display='flex';
    }
    else if (userInput == 'ROLE_SUPER_ADMIN'){
        document.getElementById('formCandidat').style.display='none';
        document.getElementById('formAdminS').style.display='none';
    }
    return false;
}