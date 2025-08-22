
function scJQGeneralAdd() {
  scLoadScInput('input:text.sc-js-input');
  scLoadScInput('input:password.sc-js-input');
  scLoadScInput('input:checkbox.sc-js-input');
  scLoadScInput('input:radio.sc-js-input');
  scLoadScInput('select.sc-js-input');
  scLoadScInput('textarea.sc-js-input');

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if ($("#id_ac_" + sField).length > 0) {
    if ($oField.hasClass("select2-hidden-accessible")) {
      if (false == scSetFocusOnField($oField, sField)) {
        setTimeout(function() { scSetFocusOnField($oField, sField); }, 500);
      }
    }
    else {
      if (false == scSetFocusOnField($oField, sField)) {
        if (false == scSetFocusOnField($("#id_ac_" + sField, sField))) {
          setTimeout(function() { scSetFocusOnField($("#id_ac_" + sField, sField)); }, 500);
        }
      }
      else {
        setTimeout(function() { scSetFocusOnField($oField, sField); }, 500);
      }
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField, sField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField, sField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["session_expire" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["remember_me" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cookie_expiration_time" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["theme" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["language" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["login_mode" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["captcha" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["pswd_last_updated" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["brute_force" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["brute_force_attempts" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["brute_force_time_block" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["retrieve_password" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["recover_pswd" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["password_min" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["password_strength" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["group_administrator" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["enable_2fa" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["enable_2fa_expiration_time" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["enable_2fa_mode" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["enable_2fa_api_type" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["enable_2fa_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["mfa_last_updated" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["new_users" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["req_email_act" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["send_email_adm" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["group_default" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtp_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtp_server" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtp_port" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtp_security" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtp_user" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtp_pass" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtp_from_email" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["smtp_from_name" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["auth_sn_position" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["auth_sn_fb" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["auth_sn_fb_app_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["auth_sn_fb_secret" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["auth_sn_x" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["auth_sn_x_key" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["auth_sn_x_secret" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["auth_sn_google" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["auth_sn_google_client_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["auth_sn_google_secret" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["session_expire" + iSeqRow] && scEventControl_data["session_expire" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["session_expire" + iSeqRow] && scEventControl_data["session_expire" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["remember_me" + iSeqRow] && scEventControl_data["remember_me" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["remember_me" + iSeqRow] && scEventControl_data["remember_me" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cookie_expiration_time" + iSeqRow] && scEventControl_data["cookie_expiration_time" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cookie_expiration_time" + iSeqRow] && scEventControl_data["cookie_expiration_time" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["theme" + iSeqRow] && scEventControl_data["theme" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["theme" + iSeqRow] && scEventControl_data["theme" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["language" + iSeqRow] && scEventControl_data["language" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["language" + iSeqRow] && scEventControl_data["language" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["login_mode" + iSeqRow] && scEventControl_data["login_mode" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["login_mode" + iSeqRow] && scEventControl_data["login_mode" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["captcha" + iSeqRow] && scEventControl_data["captcha" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["captcha" + iSeqRow] && scEventControl_data["captcha" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["pswd_last_updated" + iSeqRow] && scEventControl_data["pswd_last_updated" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["pswd_last_updated" + iSeqRow] && scEventControl_data["pswd_last_updated" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["brute_force" + iSeqRow] && scEventControl_data["brute_force" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["brute_force" + iSeqRow] && scEventControl_data["brute_force" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["brute_force_attempts" + iSeqRow] && scEventControl_data["brute_force_attempts" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["brute_force_attempts" + iSeqRow] && scEventControl_data["brute_force_attempts" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["brute_force_time_block" + iSeqRow] && scEventControl_data["brute_force_time_block" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["brute_force_time_block" + iSeqRow] && scEventControl_data["brute_force_time_block" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["retrieve_password" + iSeqRow] && scEventControl_data["retrieve_password" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["retrieve_password" + iSeqRow] && scEventControl_data["retrieve_password" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["recover_pswd" + iSeqRow] && scEventControl_data["recover_pswd" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["recover_pswd" + iSeqRow] && scEventControl_data["recover_pswd" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["password_min" + iSeqRow] && scEventControl_data["password_min" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["password_min" + iSeqRow] && scEventControl_data["password_min" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["password_strength" + iSeqRow] && scEventControl_data["password_strength" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["password_strength" + iSeqRow] && scEventControl_data["password_strength" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["group_administrator" + iSeqRow] && scEventControl_data["group_administrator" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["group_administrator" + iSeqRow] && scEventControl_data["group_administrator" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["enable_2fa" + iSeqRow] && scEventControl_data["enable_2fa" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["enable_2fa" + iSeqRow] && scEventControl_data["enable_2fa" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["enable_2fa_expiration_time" + iSeqRow] && scEventControl_data["enable_2fa_expiration_time" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["enable_2fa_expiration_time" + iSeqRow] && scEventControl_data["enable_2fa_expiration_time" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["enable_2fa_mode" + iSeqRow] && scEventControl_data["enable_2fa_mode" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["enable_2fa_mode" + iSeqRow] && scEventControl_data["enable_2fa_mode" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["enable_2fa_api_type" + iSeqRow] && scEventControl_data["enable_2fa_api_type" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["enable_2fa_api_type" + iSeqRow] && scEventControl_data["enable_2fa_api_type" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["enable_2fa_api" + iSeqRow] && scEventControl_data["enable_2fa_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["enable_2fa_api" + iSeqRow] && scEventControl_data["enable_2fa_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["mfa_last_updated" + iSeqRow] && scEventControl_data["mfa_last_updated" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["mfa_last_updated" + iSeqRow] && scEventControl_data["mfa_last_updated" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["new_users" + iSeqRow] && scEventControl_data["new_users" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["new_users" + iSeqRow] && scEventControl_data["new_users" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["req_email_act" + iSeqRow] && scEventControl_data["req_email_act" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["req_email_act" + iSeqRow] && scEventControl_data["req_email_act" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["send_email_adm" + iSeqRow] && scEventControl_data["send_email_adm" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["send_email_adm" + iSeqRow] && scEventControl_data["send_email_adm" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["group_default" + iSeqRow] && scEventControl_data["group_default" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["group_default" + iSeqRow] && scEventControl_data["group_default" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtp_api" + iSeqRow] && scEventControl_data["smtp_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtp_api" + iSeqRow] && scEventControl_data["smtp_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtp_server" + iSeqRow] && scEventControl_data["smtp_server" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtp_server" + iSeqRow] && scEventControl_data["smtp_server" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtp_port" + iSeqRow] && scEventControl_data["smtp_port" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtp_port" + iSeqRow] && scEventControl_data["smtp_port" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtp_security" + iSeqRow] && scEventControl_data["smtp_security" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtp_security" + iSeqRow] && scEventControl_data["smtp_security" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtp_user" + iSeqRow] && scEventControl_data["smtp_user" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtp_user" + iSeqRow] && scEventControl_data["smtp_user" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtp_pass" + iSeqRow] && scEventControl_data["smtp_pass" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtp_pass" + iSeqRow] && scEventControl_data["smtp_pass" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtp_from_email" + iSeqRow] && scEventControl_data["smtp_from_email" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtp_from_email" + iSeqRow] && scEventControl_data["smtp_from_email" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["smtp_from_name" + iSeqRow] && scEventControl_data["smtp_from_name" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["smtp_from_name" + iSeqRow] && scEventControl_data["smtp_from_name" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_position" + iSeqRow] && scEventControl_data["auth_sn_position" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_position" + iSeqRow] && scEventControl_data["auth_sn_position" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_fb" + iSeqRow] && scEventControl_data["auth_sn_fb" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_fb" + iSeqRow] && scEventControl_data["auth_sn_fb" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_fb_app_id" + iSeqRow] && scEventControl_data["auth_sn_fb_app_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_fb_app_id" + iSeqRow] && scEventControl_data["auth_sn_fb_app_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_fb_secret" + iSeqRow] && scEventControl_data["auth_sn_fb_secret" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_fb_secret" + iSeqRow] && scEventControl_data["auth_sn_fb_secret" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_x" + iSeqRow] && scEventControl_data["auth_sn_x" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_x" + iSeqRow] && scEventControl_data["auth_sn_x" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_x_key" + iSeqRow] && scEventControl_data["auth_sn_x_key" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_x_key" + iSeqRow] && scEventControl_data["auth_sn_x_key" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_x_secret" + iSeqRow] && scEventControl_data["auth_sn_x_secret" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_x_secret" + iSeqRow] && scEventControl_data["auth_sn_x_secret" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_google" + iSeqRow] && scEventControl_data["auth_sn_google" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_google" + iSeqRow] && scEventControl_data["auth_sn_google" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_google_client_id" + iSeqRow] && scEventControl_data["auth_sn_google_client_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_google_client_id" + iSeqRow] && scEventControl_data["auth_sn_google_client_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_google_secret" + iSeqRow] && scEventControl_data["auth_sn_google_secret" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["auth_sn_google_secret" + iSeqRow] && scEventControl_data["auth_sn_google_secret" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("session_expire" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("login_mode" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("recover_pswd" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("group_administrator" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("enable_2fa_mode" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("group_default" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("smtp_security" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("auth_sn_position" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("smtp_api" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val() || scEventControl_data[sFieldName]["calculated"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_session_expire' + iSeqRow).bind('blur', function() { sc_app_settings_session_expire_onblur('#id_sc_field_session_expire' + iSeqRow, iSeqRow) })
                                            .bind('change', function() { sc_app_settings_session_expire_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_app_settings_session_expire_onfocus(this, iSeqRow) });
  $('#id_sc_field_remember_me' + iSeqRow).bind('blur', function() { sc_app_settings_remember_me_onblur('#id_sc_field_remember_me' + iSeqRow, iSeqRow) })
                                         .bind('change', function() { sc_app_settings_remember_me_onchange(this, iSeqRow) })
                                         .bind('click', function() { sc_app_settings_remember_me_onclick(this, iSeqRow) })
                                         .bind('focus', function() { sc_app_settings_remember_me_onfocus(this, iSeqRow) });
  $('#id_sc_field_cookie_expiration_time' + iSeqRow).bind('blur', function() { sc_app_settings_cookie_expiration_time_onblur('#id_sc_field_cookie_expiration_time' + iSeqRow, iSeqRow) })
                                                    .bind('change', function() { sc_app_settings_cookie_expiration_time_onchange(this, iSeqRow) })
                                                    .bind('focus', function() { sc_app_settings_cookie_expiration_time_onfocus(this, iSeqRow) });
  $('#id_sc_field_retrieve_password' + iSeqRow).bind('blur', function() { sc_app_settings_retrieve_password_onblur('#id_sc_field_retrieve_password' + iSeqRow, iSeqRow) })
                                               .bind('change', function() { sc_app_settings_retrieve_password_onchange(this, iSeqRow) })
                                               .bind('click', function() { sc_app_settings_retrieve_password_onclick(this, iSeqRow) })
                                               .bind('focus', function() { sc_app_settings_retrieve_password_onfocus(this, iSeqRow) });
  $('#id_sc_field_new_users' + iSeqRow).bind('blur', function() { sc_app_settings_new_users_onblur('#id_sc_field_new_users' + iSeqRow, iSeqRow) })
                                       .bind('change', function() { sc_app_settings_new_users_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_app_settings_new_users_onfocus(this, iSeqRow) });
  $('#id_sc_field_brute_force_time_block' + iSeqRow).bind('blur', function() { sc_app_settings_brute_force_time_block_onblur('#id_sc_field_brute_force_time_block' + iSeqRow, iSeqRow) })
                                                    .bind('change', function() { sc_app_settings_brute_force_time_block_onchange(this, iSeqRow) })
                                                    .bind('focus', function() { sc_app_settings_brute_force_time_block_onfocus(this, iSeqRow) });
  $('#id_sc_field_brute_force_attempts' + iSeqRow).bind('blur', function() { sc_app_settings_brute_force_attempts_onblur('#id_sc_field_brute_force_attempts' + iSeqRow, iSeqRow) })
                                                  .bind('change', function() { sc_app_settings_brute_force_attempts_onchange(this, iSeqRow) })
                                                  .bind('focus', function() { sc_app_settings_brute_force_attempts_onfocus(this, iSeqRow) });
  $('#id_sc_field_enable_2fa' + iSeqRow).bind('blur', function() { sc_app_settings_enable_2fa_onblur('#id_sc_field_enable_2fa' + iSeqRow, iSeqRow) })
                                        .bind('change', function() { sc_app_settings_enable_2fa_onchange(this, iSeqRow) })
                                        .bind('click', function() { sc_app_settings_enable_2fa_onclick(this, iSeqRow) })
                                        .bind('focus', function() { sc_app_settings_enable_2fa_onfocus(this, iSeqRow) });
  $('#id_sc_field_enable_2fa_expiration_time' + iSeqRow).bind('blur', function() { sc_app_settings_enable_2fa_expiration_time_onblur('#id_sc_field_enable_2fa_expiration_time' + iSeqRow, iSeqRow) })
                                                        .bind('change', function() { sc_app_settings_enable_2fa_expiration_time_onchange(this, iSeqRow) })
                                                        .bind('focus', function() { sc_app_settings_enable_2fa_expiration_time_onfocus(this, iSeqRow) });
  $('#id_sc_field_brute_force' + iSeqRow).bind('blur', function() { sc_app_settings_brute_force_onblur('#id_sc_field_brute_force' + iSeqRow, iSeqRow) })
                                         .bind('change', function() { sc_app_settings_brute_force_onchange(this, iSeqRow) })
                                         .bind('click', function() { sc_app_settings_brute_force_onclick(this, iSeqRow) })
                                         .bind('focus', function() { sc_app_settings_brute_force_onfocus(this, iSeqRow) });
  $('#id_sc_field_captcha' + iSeqRow).bind('blur', function() { sc_app_settings_captcha_onblur('#id_sc_field_captcha' + iSeqRow, iSeqRow) })
                                     .bind('change', function() { sc_app_settings_captcha_onchange(this, iSeqRow) })
                                     .bind('focus', function() { sc_app_settings_captcha_onfocus(this, iSeqRow) });
  $('#id_sc_field_theme' + iSeqRow).bind('blur', function() { sc_app_settings_theme_onblur('#id_sc_field_theme' + iSeqRow, iSeqRow) })
                                   .bind('change', function() { sc_app_settings_theme_onchange(this, iSeqRow) })
                                   .bind('focus', function() { sc_app_settings_theme_onfocus(this, iSeqRow) });
  $('#id_sc_field_language' + iSeqRow).bind('blur', function() { sc_app_settings_language_onblur('#id_sc_field_language' + iSeqRow, iSeqRow) })
                                      .bind('change', function() { sc_app_settings_language_onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_app_settings_language_onfocus(this, iSeqRow) });
  $('#id_sc_field_recover_pswd' + iSeqRow).bind('blur', function() { sc_app_settings_recover_pswd_onblur('#id_sc_field_recover_pswd' + iSeqRow, iSeqRow) })
                                          .bind('change', function() { sc_app_settings_recover_pswd_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_app_settings_recover_pswd_onfocus(this, iSeqRow) });
  $('#id_sc_field_req_email_act' + iSeqRow).bind('blur', function() { sc_app_settings_req_email_act_onblur('#id_sc_field_req_email_act' + iSeqRow, iSeqRow) })
                                           .bind('change', function() { sc_app_settings_req_email_act_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_app_settings_req_email_act_onfocus(this, iSeqRow) });
  $('#id_sc_field_send_email_adm' + iSeqRow).bind('blur', function() { sc_app_settings_send_email_adm_onblur('#id_sc_field_send_email_adm' + iSeqRow, iSeqRow) })
                                            .bind('change', function() { sc_app_settings_send_email_adm_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_app_settings_send_email_adm_onfocus(this, iSeqRow) });
  $('#id_sc_field_group_default' + iSeqRow).bind('blur', function() { sc_app_settings_group_default_onblur('#id_sc_field_group_default' + iSeqRow, iSeqRow) })
                                           .bind('change', function() { sc_app_settings_group_default_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_app_settings_group_default_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtp_api' + iSeqRow).bind('blur', function() { sc_app_settings_smtp_api_onblur('#id_sc_field_smtp_api' + iSeqRow, iSeqRow) })
                                      .bind('change', function() { sc_app_settings_smtp_api_onchange(this, iSeqRow) })
                                      .bind('focus', function() { sc_app_settings_smtp_api_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtp_server' + iSeqRow).bind('blur', function() { sc_app_settings_smtp_server_onblur('#id_sc_field_smtp_server' + iSeqRow, iSeqRow) })
                                         .bind('change', function() { sc_app_settings_smtp_server_onchange(this, iSeqRow) })
                                         .bind('focus', function() { sc_app_settings_smtp_server_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtp_port' + iSeqRow).bind('blur', function() { sc_app_settings_smtp_port_onblur('#id_sc_field_smtp_port' + iSeqRow, iSeqRow) })
                                       .bind('change', function() { sc_app_settings_smtp_port_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_app_settings_smtp_port_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtp_user' + iSeqRow).bind('blur', function() { sc_app_settings_smtp_user_onblur('#id_sc_field_smtp_user' + iSeqRow, iSeqRow) })
                                       .bind('change', function() { sc_app_settings_smtp_user_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_app_settings_smtp_user_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtp_from_email' + iSeqRow).bind('blur', function() { sc_app_settings_smtp_from_email_onblur('#id_sc_field_smtp_from_email' + iSeqRow, iSeqRow) })
                                             .bind('change', function() { sc_app_settings_smtp_from_email_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_app_settings_smtp_from_email_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtp_from_name' + iSeqRow).bind('blur', function() { sc_app_settings_smtp_from_name_onblur('#id_sc_field_smtp_from_name' + iSeqRow, iSeqRow) })
                                            .bind('change', function() { sc_app_settings_smtp_from_name_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_app_settings_smtp_from_name_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtp_pass' + iSeqRow).bind('blur', function() { sc_app_settings_smtp_pass_onblur('#id_sc_field_smtp_pass' + iSeqRow, iSeqRow) })
                                       .bind('change', function() { sc_app_settings_smtp_pass_onchange(this, iSeqRow) })
                                       .bind('focus', function() { sc_app_settings_smtp_pass_onfocus(this, iSeqRow) });
  $('#id_sc_field_enable_2fa_mode' + iSeqRow).bind('blur', function() { sc_app_settings_enable_2fa_mode_onblur('#id_sc_field_enable_2fa_mode' + iSeqRow, iSeqRow) })
                                             .bind('change', function() { sc_app_settings_enable_2fa_mode_onchange(this, iSeqRow) })
                                             .bind('focus', function() { sc_app_settings_enable_2fa_mode_onfocus(this, iSeqRow) });
  $('#id_sc_field_smtp_security' + iSeqRow).bind('blur', function() { sc_app_settings_smtp_security_onblur('#id_sc_field_smtp_security' + iSeqRow, iSeqRow) })
                                           .bind('change', function() { sc_app_settings_smtp_security_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_app_settings_smtp_security_onfocus(this, iSeqRow) });
  $('#id_sc_field_enable_2fa_api' + iSeqRow).bind('blur', function() { sc_app_settings_enable_2fa_api_onblur('#id_sc_field_enable_2fa_api' + iSeqRow, iSeqRow) })
                                            .bind('change', function() { sc_app_settings_enable_2fa_api_onchange(this, iSeqRow) })
                                            .bind('focus', function() { sc_app_settings_enable_2fa_api_onfocus(this, iSeqRow) });
  $('#id_sc_field_enable_2fa_api_type' + iSeqRow).bind('blur', function() { sc_app_settings_enable_2fa_api_type_onblur('#id_sc_field_enable_2fa_api_type' + iSeqRow, iSeqRow) })
                                                 .bind('change', function() { sc_app_settings_enable_2fa_api_type_onchange(this, iSeqRow) })
                                                 .bind('click', function() { sc_app_settings_enable_2fa_api_type_onclick(this, iSeqRow) })
                                                 .bind('focus', function() { sc_app_settings_enable_2fa_api_type_onfocus(this, iSeqRow) });
  $('#id_sc_field_login_mode' + iSeqRow).bind('blur', function() { sc_app_settings_login_mode_onblur('#id_sc_field_login_mode' + iSeqRow, iSeqRow) })
                                        .bind('change', function() { sc_app_settings_login_mode_onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_app_settings_login_mode_onfocus(this, iSeqRow) });
  $('#id_sc_field_pswd_last_updated' + iSeqRow).bind('blur', function() { sc_app_settings_pswd_last_updated_onblur('#id_sc_field_pswd_last_updated' + iSeqRow, iSeqRow) })
                                               .bind('change', function() { sc_app_settings_pswd_last_updated_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_app_settings_pswd_last_updated_onfocus(this, iSeqRow) });
  $('#id_sc_field_password_strength' + iSeqRow).bind('blur', function() { sc_app_settings_password_strength_onblur('#id_sc_field_password_strength' + iSeqRow, iSeqRow) })
                                               .bind('change', function() { sc_app_settings_password_strength_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_app_settings_password_strength_onfocus(this, iSeqRow) });
  $('#id_sc_field_password_min' + iSeqRow).bind('blur', function() { sc_app_settings_password_min_onblur('#id_sc_field_password_min' + iSeqRow, iSeqRow) })
                                          .bind('change', function() { sc_app_settings_password_min_onchange(this, iSeqRow) })
                                          .bind('focus', function() { sc_app_settings_password_min_onfocus(this, iSeqRow) });
  $('#id_sc_field_mfa_last_updated' + iSeqRow).bind('blur', function() { sc_app_settings_mfa_last_updated_onblur('#id_sc_field_mfa_last_updated' + iSeqRow, iSeqRow) })
                                              .bind('change', function() { sc_app_settings_mfa_last_updated_onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_app_settings_mfa_last_updated_onfocus(this, iSeqRow) });
  $('#id_sc_field_group_administrator' + iSeqRow).bind('blur', function() { sc_app_settings_group_administrator_onblur('#id_sc_field_group_administrator' + iSeqRow, iSeqRow) })
                                                 .bind('change', function() { sc_app_settings_group_administrator_onchange(this, iSeqRow) })
                                                 .bind('focus', function() { sc_app_settings_group_administrator_onfocus(this, iSeqRow) });
  $('#id_sc_field_auth_sn_fb' + iSeqRow).bind('blur', function() { sc_app_settings_auth_sn_fb_onblur('#id_sc_field_auth_sn_fb' + iSeqRow, iSeqRow) })
                                        .bind('change', function() { sc_app_settings_auth_sn_fb_onchange(this, iSeqRow) })
                                        .bind('click', function() { sc_app_settings_auth_sn_fb_onclick(this, iSeqRow) })
                                        .bind('focus', function() { sc_app_settings_auth_sn_fb_onfocus(this, iSeqRow) });
  $('#id_sc_field_auth_sn_fb_app_id' + iSeqRow).bind('blur', function() { sc_app_settings_auth_sn_fb_app_id_onblur('#id_sc_field_auth_sn_fb_app_id' + iSeqRow, iSeqRow) })
                                               .bind('change', function() { sc_app_settings_auth_sn_fb_app_id_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_app_settings_auth_sn_fb_app_id_onfocus(this, iSeqRow) });
  $('#id_sc_field_auth_sn_fb_secret' + iSeqRow).bind('blur', function() { sc_app_settings_auth_sn_fb_secret_onblur('#id_sc_field_auth_sn_fb_secret' + iSeqRow, iSeqRow) })
                                               .bind('change', function() { sc_app_settings_auth_sn_fb_secret_onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_app_settings_auth_sn_fb_secret_onfocus(this, iSeqRow) });
  $('#id_sc_field_auth_sn_x' + iSeqRow).bind('blur', function() { sc_app_settings_auth_sn_x_onblur('#id_sc_field_auth_sn_x' + iSeqRow, iSeqRow) })
                                       .bind('change', function() { sc_app_settings_auth_sn_x_onchange(this, iSeqRow) })
                                       .bind('click', function() { sc_app_settings_auth_sn_x_onclick(this, iSeqRow) })
                                       .bind('focus', function() { sc_app_settings_auth_sn_x_onfocus(this, iSeqRow) });
  $('#id_sc_field_auth_sn_x_key' + iSeqRow).bind('blur', function() { sc_app_settings_auth_sn_x_key_onblur('#id_sc_field_auth_sn_x_key' + iSeqRow, iSeqRow) })
                                           .bind('change', function() { sc_app_settings_auth_sn_x_key_onchange(this, iSeqRow) })
                                           .bind('focus', function() { sc_app_settings_auth_sn_x_key_onfocus(this, iSeqRow) });
  $('#id_sc_field_auth_sn_x_secret' + iSeqRow).bind('blur', function() { sc_app_settings_auth_sn_x_secret_onblur('#id_sc_field_auth_sn_x_secret' + iSeqRow, iSeqRow) })
                                              .bind('change', function() { sc_app_settings_auth_sn_x_secret_onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_app_settings_auth_sn_x_secret_onfocus(this, iSeqRow) });
  $('#id_sc_field_auth_sn_google' + iSeqRow).bind('blur', function() { sc_app_settings_auth_sn_google_onblur('#id_sc_field_auth_sn_google' + iSeqRow, iSeqRow) })
                                            .bind('change', function() { sc_app_settings_auth_sn_google_onchange(this, iSeqRow) })
                                            .bind('click', function() { sc_app_settings_auth_sn_google_onclick(this, iSeqRow) })
                                            .bind('focus', function() { sc_app_settings_auth_sn_google_onfocus(this, iSeqRow) });
  $('#id_sc_field_auth_sn_google_client_id' + iSeqRow).bind('blur', function() { sc_app_settings_auth_sn_google_client_id_onblur('#id_sc_field_auth_sn_google_client_id' + iSeqRow, iSeqRow) })
                                                      .bind('change', function() { sc_app_settings_auth_sn_google_client_id_onchange(this, iSeqRow) })
                                                      .bind('focus', function() { sc_app_settings_auth_sn_google_client_id_onfocus(this, iSeqRow) });
  $('#id_sc_field_auth_sn_google_secret' + iSeqRow).bind('blur', function() { sc_app_settings_auth_sn_google_secret_onblur('#id_sc_field_auth_sn_google_secret' + iSeqRow, iSeqRow) })
                                                   .bind('change', function() { sc_app_settings_auth_sn_google_secret_onchange(this, iSeqRow) })
                                                   .bind('focus', function() { sc_app_settings_auth_sn_google_secret_onfocus(this, iSeqRow) });
  $('#id_sc_field_auth_sn_position' + iSeqRow).bind('blur', function() { sc_app_settings_auth_sn_position_onblur('#id_sc_field_auth_sn_position' + iSeqRow, iSeqRow) })
                                              .bind('change', function() { sc_app_settings_auth_sn_position_onchange(this, iSeqRow) })
                                              .bind('focus', function() { sc_app_settings_auth_sn_position_onfocus(this, iSeqRow) });
  $('.sc-ui-checkbox-remember_me' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-language' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-captcha' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-brute_force' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-retrieve_password' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-password_strength' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-enable_2fa' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-enable_2fa_api_type' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-new_users' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-req_email_act' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-send_email_adm' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-auth_sn_fb' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-auth_sn_x' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-auth_sn_google' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

function sc_app_settings_session_expire_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_session_expire();
  scCssBlur(oThis);
}

function sc_app_settings_session_expire_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_session_expire_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_remember_me_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_remember_me();
  scCssBlur(oThis);
}

function sc_app_settings_remember_me_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_remember_me_onclick(oThis, iSeqRow) {
  do_ajax_app_settings_event_remember_me_onclick();
}

function sc_app_settings_remember_me_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_cookie_expiration_time_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_cookie_expiration_time();
  scCssBlur(oThis);
}

function sc_app_settings_cookie_expiration_time_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_cookie_expiration_time_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_retrieve_password_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_retrieve_password();
  scCssBlur(oThis);
}

function sc_app_settings_retrieve_password_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_retrieve_password_onclick(oThis, iSeqRow) {
  do_ajax_app_settings_event_retrieve_password_onclick();
}

function sc_app_settings_retrieve_password_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_new_users_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_new_users();
  scCssBlur(oThis);
}

function sc_app_settings_new_users_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_new_users_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_brute_force_time_block_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_brute_force_time_block();
  scCssBlur(oThis);
}

function sc_app_settings_brute_force_time_block_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_brute_force_time_block_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_brute_force_attempts_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_brute_force_attempts();
  scCssBlur(oThis);
}

function sc_app_settings_brute_force_attempts_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_brute_force_attempts_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_enable_2fa_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_enable_2fa();
  scCssBlur(oThis);
}

function sc_app_settings_enable_2fa_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_enable_2fa_onclick(oThis, iSeqRow) {
  do_ajax_app_settings_event_enable_2fa_onclick();
}

function sc_app_settings_enable_2fa_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_enable_2fa_expiration_time_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_enable_2fa_expiration_time();
  scCssBlur(oThis);
}

function sc_app_settings_enable_2fa_expiration_time_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_enable_2fa_expiration_time_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_brute_force_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_brute_force();
  scCssBlur(oThis);
}

function sc_app_settings_brute_force_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_brute_force_onclick(oThis, iSeqRow) {
  do_ajax_app_settings_event_brute_force_onclick();
}

function sc_app_settings_brute_force_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_captcha_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_captcha();
  scCssBlur(oThis);
}

function sc_app_settings_captcha_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_captcha_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_theme_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_theme();
  scCssBlur(oThis);
}

function sc_app_settings_theme_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_theme_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_language_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_language();
  scCssBlur(oThis);
}

function sc_app_settings_language_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_language_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_recover_pswd_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_recover_pswd();
  scCssBlur(oThis);
}

function sc_app_settings_recover_pswd_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_recover_pswd_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_req_email_act_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_req_email_act();
  scCssBlur(oThis);
}

function sc_app_settings_req_email_act_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_req_email_act_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_send_email_adm_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_send_email_adm();
  scCssBlur(oThis);
}

function sc_app_settings_send_email_adm_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_send_email_adm_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_group_default_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_group_default();
  scCssBlur(oThis);
}

function sc_app_settings_group_default_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_group_default_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_smtp_api_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_smtp_api();
  scCssBlur(oThis);
}

function sc_app_settings_smtp_api_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  do_ajax_app_settings_event_smtp_api_onchange();
}

function sc_app_settings_smtp_api_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_smtp_server_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_smtp_server();
  scCssBlur(oThis);
}

function sc_app_settings_smtp_server_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_smtp_server_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_smtp_port_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_smtp_port();
  scCssBlur(oThis);
}

function sc_app_settings_smtp_port_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_smtp_port_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_smtp_user_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_smtp_user();
  scCssBlur(oThis);
}

function sc_app_settings_smtp_user_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_smtp_user_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_smtp_from_email_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_smtp_from_email();
  scCssBlur(oThis);
}

function sc_app_settings_smtp_from_email_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_smtp_from_email_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_smtp_from_name_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_smtp_from_name();
  scCssBlur(oThis);
}

function sc_app_settings_smtp_from_name_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_smtp_from_name_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_smtp_pass_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_smtp_pass();
  scCssBlur(oThis);
}

function sc_app_settings_smtp_pass_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_smtp_pass_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_enable_2fa_mode_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_enable_2fa_mode();
  scCssBlur(oThis);
}

function sc_app_settings_enable_2fa_mode_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_enable_2fa_mode_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_smtp_security_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_smtp_security();
  scCssBlur(oThis);
}

function sc_app_settings_smtp_security_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_smtp_security_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_enable_2fa_api_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_enable_2fa_api();
  scCssBlur(oThis);
}

function sc_app_settings_enable_2fa_api_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_enable_2fa_api_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_enable_2fa_api_type_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_enable_2fa_api_type();
  scCssBlur(oThis);
}

function sc_app_settings_enable_2fa_api_type_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_enable_2fa_api_type_onclick(oThis, iSeqRow) {
  do_ajax_app_settings_event_enable_2fa_api_type_onclick();
}

function sc_app_settings_enable_2fa_api_type_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_login_mode_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_login_mode();
  scCssBlur(oThis);
}

function sc_app_settings_login_mode_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_login_mode_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_pswd_last_updated_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_pswd_last_updated();
  scCssBlur(oThis);
}

function sc_app_settings_pswd_last_updated_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_pswd_last_updated_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_password_strength_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_password_strength();
  scCssBlur(oThis);
}

function sc_app_settings_password_strength_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_password_strength_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_password_min_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_password_min();
  scCssBlur(oThis);
}

function sc_app_settings_password_min_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_password_min_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_mfa_last_updated_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_mfa_last_updated();
  scCssBlur(oThis);
}

function sc_app_settings_mfa_last_updated_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_mfa_last_updated_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_group_administrator_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_group_administrator();
  scCssBlur(oThis);
}

function sc_app_settings_group_administrator_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_group_administrator_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_auth_sn_fb_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_auth_sn_fb();
  scCssBlur(oThis);
}

function sc_app_settings_auth_sn_fb_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_auth_sn_fb_onclick(oThis, iSeqRow) {
  do_ajax_app_settings_event_auth_sn_fb_onclick();
}

function sc_app_settings_auth_sn_fb_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_auth_sn_fb_app_id_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_auth_sn_fb_app_id();
  scCssBlur(oThis);
}

function sc_app_settings_auth_sn_fb_app_id_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_auth_sn_fb_app_id_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_auth_sn_fb_secret_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_auth_sn_fb_secret();
  scCssBlur(oThis);
}

function sc_app_settings_auth_sn_fb_secret_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_auth_sn_fb_secret_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_auth_sn_x_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_auth_sn_x();
  scCssBlur(oThis);
}

function sc_app_settings_auth_sn_x_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_auth_sn_x_onclick(oThis, iSeqRow) {
  do_ajax_app_settings_event_auth_sn_x_onclick();
}

function sc_app_settings_auth_sn_x_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_auth_sn_x_key_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_auth_sn_x_key();
  scCssBlur(oThis);
}

function sc_app_settings_auth_sn_x_key_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_auth_sn_x_key_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_auth_sn_x_secret_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_auth_sn_x_secret();
  scCssBlur(oThis);
}

function sc_app_settings_auth_sn_x_secret_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_auth_sn_x_secret_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_auth_sn_google_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_auth_sn_google();
  scCssBlur(oThis);
}

function sc_app_settings_auth_sn_google_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_auth_sn_google_onclick(oThis, iSeqRow) {
  do_ajax_app_settings_event_auth_sn_google_onclick();
}

function sc_app_settings_auth_sn_google_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_auth_sn_google_client_id_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_auth_sn_google_client_id();
  scCssBlur(oThis);
}

function sc_app_settings_auth_sn_google_client_id_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_auth_sn_google_client_id_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_auth_sn_google_secret_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_auth_sn_google_secret();
  scCssBlur(oThis);
}

function sc_app_settings_auth_sn_google_secret_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_auth_sn_google_secret_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_app_settings_auth_sn_position_onblur(oThis, iSeqRow) {
  do_ajax_app_settings_validate_auth_sn_position();
  scCssBlur(oThis);
}

function sc_app_settings_auth_sn_position_onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_app_settings_auth_sn_position_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
        if ("0" == block) {
                displayChange_block_0(status);
        }
        if ("1" == block) {
                displayChange_block_1(status);
        }
        if ("2" == block) {
                displayChange_block_2(status);
        }
        if ("3" == block) {
                displayChange_block_3(status);
        }
        if ("4" == block) {
                displayChange_block_4(status);
        }
        if ("5" == block) {
                displayChange_block_5(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("session_expire", "", status);
        displayChange_field("remember_me", "", status);
        displayChange_field("cookie_expiration_time", "", status);
        displayChange_field("theme", "", status);
        displayChange_field("language", "", status);
        displayChange_field("login_mode", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("captcha", "", status);
        displayChange_field("pswd_last_updated", "", status);
        displayChange_field("brute_force", "", status);
        displayChange_field("brute_force_attempts", "", status);
        displayChange_field("brute_force_time_block", "", status);
        displayChange_field("retrieve_password", "", status);
        displayChange_field("recover_pswd", "", status);
        displayChange_field("password_min", "", status);
        displayChange_field("password_strength", "", status);
        displayChange_field("group_administrator", "", status);
}

function displayChange_block_2(status) {
        displayChange_field("enable_2fa", "", status);
        displayChange_field("enable_2fa_expiration_time", "", status);
        displayChange_field("enable_2fa_mode", "", status);
        displayChange_field("enable_2fa_api_type", "", status);
        displayChange_field("enable_2fa_api", "", status);
        displayChange_field("mfa_last_updated", "", status);
}

function displayChange_block_3(status) {
        displayChange_field("new_users", "", status);
        displayChange_field("req_email_act", "", status);
        displayChange_field("send_email_adm", "", status);
        displayChange_field("group_default", "", status);
}

function displayChange_block_4(status) {
        displayChange_field("smtp_api", "", status);
        displayChange_field("smtp_server", "", status);
        displayChange_field("smtp_port", "", status);
        displayChange_field("smtp_security", "", status);
        displayChange_field("smtp_user", "", status);
        displayChange_field("smtp_pass", "", status);
        displayChange_field("smtp_from_email", "", status);
        displayChange_field("smtp_from_name", "", status);
}

function displayChange_block_5(status) {
        displayChange_field("auth_sn_position", "", status);
        displayChange_field("auth_sn_fb", "", status);
        displayChange_field("auth_sn_fb_app_id", "", status);
        displayChange_field("auth_sn_fb_secret", "", status);
        displayChange_field("auth_sn_x", "", status);
        displayChange_field("auth_sn_x_key", "", status);
        displayChange_field("auth_sn_x_secret", "", status);
        displayChange_field("auth_sn_google", "", status);
        displayChange_field("auth_sn_google_client_id", "", status);
        displayChange_field("auth_sn_google_secret", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_session_expire(row, status);
        displayChange_field_remember_me(row, status);
        displayChange_field_cookie_expiration_time(row, status);
        displayChange_field_theme(row, status);
        displayChange_field_language(row, status);
        displayChange_field_login_mode(row, status);
        displayChange_field_captcha(row, status);
        displayChange_field_pswd_last_updated(row, status);
        displayChange_field_brute_force(row, status);
        displayChange_field_brute_force_attempts(row, status);
        displayChange_field_brute_force_time_block(row, status);
        displayChange_field_retrieve_password(row, status);
        displayChange_field_recover_pswd(row, status);
        displayChange_field_password_min(row, status);
        displayChange_field_password_strength(row, status);
        displayChange_field_group_administrator(row, status);
        displayChange_field_enable_2fa(row, status);
        displayChange_field_enable_2fa_expiration_time(row, status);
        displayChange_field_enable_2fa_mode(row, status);
        displayChange_field_enable_2fa_api_type(row, status);
        displayChange_field_enable_2fa_api(row, status);
        displayChange_field_mfa_last_updated(row, status);
        displayChange_field_new_users(row, status);
        displayChange_field_req_email_act(row, status);
        displayChange_field_send_email_adm(row, status);
        displayChange_field_group_default(row, status);
        displayChange_field_smtp_api(row, status);
        displayChange_field_smtp_server(row, status);
        displayChange_field_smtp_port(row, status);
        displayChange_field_smtp_security(row, status);
        displayChange_field_smtp_user(row, status);
        displayChange_field_smtp_pass(row, status);
        displayChange_field_smtp_from_email(row, status);
        displayChange_field_smtp_from_name(row, status);
        displayChange_field_auth_sn_position(row, status);
        displayChange_field_auth_sn_fb(row, status);
        displayChange_field_auth_sn_fb_app_id(row, status);
        displayChange_field_auth_sn_fb_secret(row, status);
        displayChange_field_auth_sn_x(row, status);
        displayChange_field_auth_sn_x_key(row, status);
        displayChange_field_auth_sn_x_secret(row, status);
        displayChange_field_auth_sn_google(row, status);
        displayChange_field_auth_sn_google_client_id(row, status);
        displayChange_field_auth_sn_google_secret(row, status);
}

function displayChange_field(field, row, status) {
        if ("session_expire" == field) {
                displayChange_field_session_expire(row, status);
        }
        if ("remember_me" == field) {
                displayChange_field_remember_me(row, status);
        }
        if ("cookie_expiration_time" == field) {
                displayChange_field_cookie_expiration_time(row, status);
        }
        if ("theme" == field) {
                displayChange_field_theme(row, status);
        }
        if ("language" == field) {
                displayChange_field_language(row, status);
        }
        if ("login_mode" == field) {
                displayChange_field_login_mode(row, status);
        }
        if ("captcha" == field) {
                displayChange_field_captcha(row, status);
        }
        if ("pswd_last_updated" == field) {
                displayChange_field_pswd_last_updated(row, status);
        }
        if ("brute_force" == field) {
                displayChange_field_brute_force(row, status);
        }
        if ("brute_force_attempts" == field) {
                displayChange_field_brute_force_attempts(row, status);
        }
        if ("brute_force_time_block" == field) {
                displayChange_field_brute_force_time_block(row, status);
        }
        if ("retrieve_password" == field) {
                displayChange_field_retrieve_password(row, status);
        }
        if ("recover_pswd" == field) {
                displayChange_field_recover_pswd(row, status);
        }
        if ("password_min" == field) {
                displayChange_field_password_min(row, status);
        }
        if ("password_strength" == field) {
                displayChange_field_password_strength(row, status);
        }
        if ("group_administrator" == field) {
                displayChange_field_group_administrator(row, status);
        }
        if ("enable_2fa" == field) {
                displayChange_field_enable_2fa(row, status);
        }
        if ("enable_2fa_expiration_time" == field) {
                displayChange_field_enable_2fa_expiration_time(row, status);
        }
        if ("enable_2fa_mode" == field) {
                displayChange_field_enable_2fa_mode(row, status);
        }
        if ("enable_2fa_api_type" == field) {
                displayChange_field_enable_2fa_api_type(row, status);
        }
        if ("enable_2fa_api" == field) {
                displayChange_field_enable_2fa_api(row, status);
        }
        if ("mfa_last_updated" == field) {
                displayChange_field_mfa_last_updated(row, status);
        }
        if ("new_users" == field) {
                displayChange_field_new_users(row, status);
        }
        if ("req_email_act" == field) {
                displayChange_field_req_email_act(row, status);
        }
        if ("send_email_adm" == field) {
                displayChange_field_send_email_adm(row, status);
        }
        if ("group_default" == field) {
                displayChange_field_group_default(row, status);
        }
        if ("smtp_api" == field) {
                displayChange_field_smtp_api(row, status);
        }
        if ("smtp_server" == field) {
                displayChange_field_smtp_server(row, status);
        }
        if ("smtp_port" == field) {
                displayChange_field_smtp_port(row, status);
        }
        if ("smtp_security" == field) {
                displayChange_field_smtp_security(row, status);
        }
        if ("smtp_user" == field) {
                displayChange_field_smtp_user(row, status);
        }
        if ("smtp_pass" == field) {
                displayChange_field_smtp_pass(row, status);
        }
        if ("smtp_from_email" == field) {
                displayChange_field_smtp_from_email(row, status);
        }
        if ("smtp_from_name" == field) {
                displayChange_field_smtp_from_name(row, status);
        }
        if ("auth_sn_position" == field) {
                displayChange_field_auth_sn_position(row, status);
        }
        if ("auth_sn_fb" == field) {
                displayChange_field_auth_sn_fb(row, status);
        }
        if ("auth_sn_fb_app_id" == field) {
                displayChange_field_auth_sn_fb_app_id(row, status);
        }
        if ("auth_sn_fb_secret" == field) {
                displayChange_field_auth_sn_fb_secret(row, status);
        }
        if ("auth_sn_x" == field) {
                displayChange_field_auth_sn_x(row, status);
        }
        if ("auth_sn_x_key" == field) {
                displayChange_field_auth_sn_x_key(row, status);
        }
        if ("auth_sn_x_secret" == field) {
                displayChange_field_auth_sn_x_secret(row, status);
        }
        if ("auth_sn_google" == field) {
                displayChange_field_auth_sn_google(row, status);
        }
        if ("auth_sn_google_client_id" == field) {
                displayChange_field_auth_sn_google_client_id(row, status);
        }
        if ("auth_sn_google_secret" == field) {
                displayChange_field_auth_sn_google_secret(row, status);
        }
}

function displayChange_field_session_expire(row, status) {
    var fieldId;
}

function displayChange_field_remember_me(row, status) {
    var fieldId;
}

function displayChange_field_cookie_expiration_time(row, status) {
    var fieldId;
}

function displayChange_field_theme(row, status) {
    var fieldId;
}

function displayChange_field_language(row, status) {
    var fieldId;
}

function displayChange_field_login_mode(row, status) {
    var fieldId;
}

function displayChange_field_captcha(row, status) {
    var fieldId;
}

function displayChange_field_pswd_last_updated(row, status) {
    var fieldId;
}

function displayChange_field_brute_force(row, status) {
    var fieldId;
}

function displayChange_field_brute_force_attempts(row, status) {
    var fieldId;
}

function displayChange_field_brute_force_time_block(row, status) {
    var fieldId;
}

function displayChange_field_retrieve_password(row, status) {
    var fieldId;
}

function displayChange_field_recover_pswd(row, status) {
    var fieldId;
}

function displayChange_field_password_min(row, status) {
    var fieldId;
}

function displayChange_field_password_strength(row, status) {
    var fieldId;
}

function displayChange_field_group_administrator(row, status) {
    var fieldId;
}

function displayChange_field_enable_2fa(row, status) {
    var fieldId;
}

function displayChange_field_enable_2fa_expiration_time(row, status) {
    var fieldId;
}

function displayChange_field_enable_2fa_mode(row, status) {
    var fieldId;
}

function displayChange_field_enable_2fa_api_type(row, status) {
    var fieldId;
}

function displayChange_field_enable_2fa_api(row, status) {
    var fieldId;
}

function displayChange_field_mfa_last_updated(row, status) {
    var fieldId;
}

function displayChange_field_new_users(row, status) {
    var fieldId;
}

function displayChange_field_req_email_act(row, status) {
    var fieldId;
}

function displayChange_field_send_email_adm(row, status) {
    var fieldId;
}

function displayChange_field_group_default(row, status) {
    var fieldId;
}

function displayChange_field_smtp_api(row, status) {
    var fieldId;
}

function displayChange_field_smtp_server(row, status) {
    var fieldId;
}

function displayChange_field_smtp_port(row, status) {
    var fieldId;
}

function displayChange_field_smtp_security(row, status) {
    var fieldId;
}

function displayChange_field_smtp_user(row, status) {
    var fieldId;
}

function displayChange_field_smtp_pass(row, status) {
    var fieldId;
}

function displayChange_field_smtp_from_email(row, status) {
    var fieldId;
}

function displayChange_field_smtp_from_name(row, status) {
    var fieldId;
}

function displayChange_field_auth_sn_position(row, status) {
    var fieldId;
}

function displayChange_field_auth_sn_fb(row, status) {
    var fieldId;
}

function displayChange_field_auth_sn_fb_app_id(row, status) {
    var fieldId;
}

function displayChange_field_auth_sn_fb_secret(row, status) {
    var fieldId;
}

function displayChange_field_auth_sn_x(row, status) {
    var fieldId;
}

function displayChange_field_auth_sn_x_key(row, status) {
    var fieldId;
}

function displayChange_field_auth_sn_x_secret(row, status) {
    var fieldId;
}

function displayChange_field_auth_sn_google(row, status) {
    var fieldId;
}

function displayChange_field_auth_sn_google_client_id(row, status) {
    var fieldId;
}

function displayChange_field_auth_sn_google_secret(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_app_settings_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(20);
                }
        }
}
function scJQSpinAdd(iSeqRow) {
  $("#id_sc_field_cookie_expiration_time" + iSeqRow).spinner({
    max: 1.0E+20,
    min: 0,
    step: 1,
    page: 5,
    change: function(event, ui) {
      $(this).trigger("change");
    },
    stop: function(event, ui) {
      $(this).trigger("change");
    }
  });
  $("#id_sc_field_pswd_last_updated" + iSeqRow).spinner({
    max: 1.0E+20,
    min: 0,
    step: 1,
    page: 5,
    change: function(event, ui) {
      $(this).trigger("change");
    },
    stop: function(event, ui) {
      $(this).trigger("change");
    }
  });
  $("#id_sc_field_brute_force_attempts" + iSeqRow).spinner({
    max: 1.0E+20,
    min: 0,
    step: 1,
    page: 5,
    change: function(event, ui) {
      $(this).trigger("change");
    },
    stop: function(event, ui) {
      $(this).trigger("change");
    }
  });
  $("#id_sc_field_brute_force_time_block" + iSeqRow).spinner({
    max: 1.0E+20,
    min: 0,
    step: 1,
    page: 5,
    change: function(event, ui) {
      $(this).trigger("change");
    },
    stop: function(event, ui) {
      $(this).trigger("change");
    }
  });
  $("#id_sc_field_enable_2fa_expiration_time" + iSeqRow).spinner({
    max: 1.0E+20,
    min: 0,
    step: 1,
    page: 5,
    change: function(event, ui) {
      $(this).trigger("change");
    },
    stop: function(event, ui) {
      $(this).trigger("change");
    }
  });
  $("#id_sc_field_mfa_last_updated" + iSeqRow).spinner({
    max: 99999999999999999999,
    min: -99999999999999999999,
    step: 1,
    page: 5,
    change: function(event, ui) {
      $(this).trigger("change");
    },
    stop: function(event, ui) {
      $(this).trigger("change");
    }
  });
} // scJQSpinAdd

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd

var api_cache_requests = [];
function ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, hasRun, img_before){
    setTimeout(function(){
        if(img_name == '') return;
        iSeqRow= iSeqRow !== undefined && iSeqRow !== null ? iSeqRow : '';
        var hasVar = p.indexOf('_@NM@_') > -1 || p_cache.indexOf('_@NM@_') > -1 ? true : false;

        p = p.split('_@NM@_');
        $.each(p, function(i,v){
            try{
                p[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p[i] = v;
            }
        });
        p = p.join('');

        p_cache = p_cache.split('_@NM@_');
        $.each(p_cache, function(i,v){
            try{
                p_cache[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p_cache[i] = v;
            }
        });
        p_cache = p_cache.join('');

        img_before = img_before !== undefined ? img_before : $(t).attr('src');
        var str_key_cache = '<?php echo $this->Ini->sc_page; ?>' + img_name+field+p+p_cache;
        if(api_cache_requests[ str_key_cache ] !== undefined && api_cache_requests[ str_key_cache ] !== null){
            if(api_cache_requests[ str_key_cache ] != false){
                do_ajax_check_file(api_cache_requests[ str_key_cache ], field  ,t, iSeqRow);
            }
            return;
        }
        //scAjaxProcOn();
        $(t).attr('src', '<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif');
        api_cache_requests[ str_key_cache ] = false;
        var rs =$.ajax({
                    type: "POST",
                    url: 'index.php?script_case_init=<?php echo $this->Ini->sc_page; ?>',
                    async: true,
                    data:'nmgp_opcao=ajax_check_file&AjaxCheckImg=' + encodeURI(img_name) +'&rsargs='+ field + '&p=' + p + '&p_cache=' + p_cache,
                    success: function (rs) {
                        if(rs.indexOf('</span>') != -1){
                            rs = rs.substr(rs.indexOf('</span>') + 7);
                        }
                        if(rs.indexOf('/') != -1 && rs.indexOf('/') != 0){
                            rs = rs.substr(rs.indexOf('/'));
                        }
                        rs = sc_trim(rs);

                        // if(rs == 0 && hasVar && hasRun === undefined){
                        //     delete window.api_cache_requests[ str_key_cache ];
                        //     ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, 1, img_before);
                        //     return;
                        // }
                        window.api_cache_requests[ str_key_cache ] = rs;
                        do_ajax_check_file(rs, field  ,t, iSeqRow)
                        if(rs == 0){
                            delete window.api_cache_requests[ str_key_cache ];

                           // $(t).attr('src',img_before);
                            do_ajax_check_file(img_before+'_@@NM@@_' + img_before, field  ,t, iSeqRow)

                        }


                    }
        });
    },100);
}

function do_ajax_check_file(rs, field  ,t, iSeqRow){
    if (rs != 0) {
        rs_split = rs.split('_@@NM@@_');
        rs_orig = rs_split[0];
        rs2 = rs_split[1];
        try{
            if(!$(t).is('img')){

                if($('#id_read_on_'+field+iSeqRow).length > 0 ){
                                    var usa_read_only = false;

                switch(field){

                }
                     if(usa_read_only && $('a',$('#id_read_on_'+field+iSeqRow)).length == 0){
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'app_settings')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href', target.join(','));
                }else{
                    var target = $(t).attr('href').split(',');
                     target[1] = "'"+rs2+"'";
                     $(t).attr('href', target.join(','));
                }
            }else{
                $(t).attr('src', rs2);
                $(t).css('display', '');
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $(t).attr('href', target.join(','));
                }else{
                     var t_link = $(t).parent('a');
                     var target = $(t_link).attr('href').split(',');
                     target[0] = "javascript:nm_mostra_img('"+rs_orig+"'";
                     $(t_link).attr('href', target.join(','));
                }

            }
            eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        } catch(err){
                        eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        }
    }
   /* hasFalseCacheRequest = false;
    $.each(api_cache_requests, function(i,v){
        if(v == false){
            hasFalseCacheRequest = true;
        }
    });
    if(hasFalseCacheRequest == false){
        scAjaxProcOff();
    }*/
}

$(document).ready(function(){
});

function scJQPasswordToggleAdd(seqRow) {
  $(".sc-ui-pwd-toggle-icon" + seqRow).on("click", function() {
    var fieldName = $(this).attr("id").substr(17), fieldObj = $("#id_sc_field_" + fieldName), fieldFA = $("#id_pwd_fa_" + fieldName);
    if ("text" == fieldObj.attr("type")) {
      fieldObj.attr("type", "password");
      fieldFA.attr("class", "fa fa-eye sc-ui-pwd-eye");
    } else {
      fieldObj.attr("type", "text");
      fieldFA.attr("class", "fa fa-eye-slash sc-ui-pwd-eye");
    }
  });
} // scJQPasswordToggleAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQSpinAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
} // scJQElementsAdd

function scGetFileExtension(fileName)
{
    fileNameParts = fileName.split(".");

    if (1 === fileNameParts.length || (2 === fileNameParts.length && "" == fileNameParts[0])) {
        return "";
    }

    return fileNameParts.pop().toLowerCase();
}

function scFormatExtensionSizeErrorMsg(errorMsg)
{
    var msgInfo = errorMsg.split("||"), returnMsg = "";

    if ("err_size" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_size'] ?>. <?php echo $this->Ini->Nm_lang['lang_errm_file_size_extension'] ?>".replace("{SC_EXTENSION}", msgInfo[1]).replace("{SC_LIMIT}", msgInfo[2]);
    } else if ("err_extension" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_invl'] ?>";
    }

    return returnMsg;
}

