function scHideUserField(fieldName) {
    if (fieldName == 'new_user') {
        $('#id-new_user-1').hide();
    } else if (fieldName == 'retrieve_pswd') {
        $('#id-retrieve_pswd-1').hide();
    } else if (fieldName == 'remember_me') {
        $('#id_sc_field_remember_me_1').hide();
        $('#txtremember').hide();
    } else if (fieldName == 'language') {
        $('#id_sc_field_language').hide();
    }
}

function scShowUserField(fieldName) {
    if (fieldName == 'new_user') {
        $('#id-new_user-1').show();
    } else if (fieldName == 'retrieve_pswd') {
        $('#id-retrieve_pswd-1').show();
    } else if (fieldName == 'remember_me') {
        $('#id_sc_field_remember_me_1').show();
        $('#txtremember').show();
    } else if (fieldName == 'language') {
        $('#id_sc_field_language').show();
    }
}
