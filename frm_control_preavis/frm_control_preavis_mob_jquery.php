
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
  scEventControl_data["employe_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["name" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hire_date" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fire_date" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["net_earnings" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["duration" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["serv_month" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["type_preavis" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["preavis_net" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["jours_conges_pris" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["jours_conges_acquis" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["jours_conges_restant" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["montant_conges" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["total" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["employe_id" + iSeqRow] && scEventControl_data["employe_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["employe_id" + iSeqRow] && scEventControl_data["employe_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["name" + iSeqRow] && scEventControl_data["name" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["name" + iSeqRow] && scEventControl_data["name" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hire_date" + iSeqRow] && scEventControl_data["hire_date" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hire_date" + iSeqRow] && scEventControl_data["hire_date" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fire_date" + iSeqRow] && scEventControl_data["fire_date" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fire_date" + iSeqRow] && scEventControl_data["fire_date" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["net_earnings" + iSeqRow] && scEventControl_data["net_earnings" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["net_earnings" + iSeqRow] && scEventControl_data["net_earnings" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["duration" + iSeqRow] && scEventControl_data["duration" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["duration" + iSeqRow] && scEventControl_data["duration" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["serv_month" + iSeqRow] && scEventControl_data["serv_month" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["serv_month" + iSeqRow] && scEventControl_data["serv_month" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["type_preavis" + iSeqRow] && scEventControl_data["type_preavis" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["type_preavis" + iSeqRow] && scEventControl_data["type_preavis" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["preavis_net" + iSeqRow] && scEventControl_data["preavis_net" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["preavis_net" + iSeqRow] && scEventControl_data["preavis_net" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["jours_conges_pris" + iSeqRow] && scEventControl_data["jours_conges_pris" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["jours_conges_pris" + iSeqRow] && scEventControl_data["jours_conges_pris" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["jours_conges_acquis" + iSeqRow] && scEventControl_data["jours_conges_acquis" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["jours_conges_acquis" + iSeqRow] && scEventControl_data["jours_conges_acquis" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["jours_conges_restant" + iSeqRow] && scEventControl_data["jours_conges_restant" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["jours_conges_restant" + iSeqRow] && scEventControl_data["jours_conges_restant" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["montant_conges" + iSeqRow] && scEventControl_data["montant_conges" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["montant_conges" + iSeqRow] && scEventControl_data["montant_conges" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["total" + iSeqRow] && scEventControl_data["total" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["total" + iSeqRow] && scEventControl_data["total" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
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
  $('#id_sc_field_hire_date' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_hire_date_onblur('#id_sc_field_hire_date' + iSeqRow, iSeqRow) })
                                       .bind('focus', function() { sc_frm_control_preavis_hire_date_onfocus(this, iSeqRow) });
  $('#id_sc_field_fire_date' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_fire_date_onblur('#id_sc_field_fire_date' + iSeqRow, iSeqRow) })
                                       .bind('focus', function() { sc_frm_control_preavis_fire_date_onfocus(this, iSeqRow) });
  $('#id_sc_field_name' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_name_onblur('#id_sc_field_name' + iSeqRow, iSeqRow) })
                                  .bind('focus', function() { sc_frm_control_preavis_name_onfocus(this, iSeqRow) });
  $('#id_sc_field_net_earnings' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_net_earnings_onblur('#id_sc_field_net_earnings' + iSeqRow, iSeqRow) })
                                          .bind('focus', function() { sc_frm_control_preavis_net_earnings_onfocus(this, iSeqRow) });
  $('#id_sc_field_duration' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_duration_onblur('#id_sc_field_duration' + iSeqRow, iSeqRow) })
                                      .bind('focus', function() { sc_frm_control_preavis_duration_onfocus(this, iSeqRow) });
  $('#id_sc_field_serv_month' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_serv_month_onblur('#id_sc_field_serv_month' + iSeqRow, iSeqRow) })
                                        .bind('focus', function() { sc_frm_control_preavis_serv_month_onfocus(this, iSeqRow) });
  $('#id_sc_field_type_preavis' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_type_preavis_onblur('#id_sc_field_type_preavis' + iSeqRow, iSeqRow) })
                                          .bind('focus', function() { sc_frm_control_preavis_type_preavis_onfocus(this, iSeqRow) });
  $('#id_sc_field_preavis_net' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_preavis_net_onblur('#id_sc_field_preavis_net' + iSeqRow, iSeqRow) })
                                         .bind('focus', function() { sc_frm_control_preavis_preavis_net_onfocus(this, iSeqRow) });
  $('#id_sc_field_jours_conges_pris' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_jours_conges_pris_onblur('#id_sc_field_jours_conges_pris' + iSeqRow, iSeqRow) })
                                               .bind('focus', function() { sc_frm_control_preavis_jours_conges_pris_onfocus(this, iSeqRow) });
  $('#id_sc_field_jours_conges_acquis' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_jours_conges_acquis_onblur('#id_sc_field_jours_conges_acquis' + iSeqRow, iSeqRow) })
                                                 .bind('focus', function() { sc_frm_control_preavis_jours_conges_acquis_onfocus(this, iSeqRow) });
  $('#id_sc_field_jours_conges_restant' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_jours_conges_restant_onblur('#id_sc_field_jours_conges_restant' + iSeqRow, iSeqRow) })
                                                  .bind('focus', function() { sc_frm_control_preavis_jours_conges_restant_onfocus(this, iSeqRow) });
  $('#id_sc_field_montant_conges' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_montant_conges_onblur('#id_sc_field_montant_conges' + iSeqRow, iSeqRow) })
                                            .bind('focus', function() { sc_frm_control_preavis_montant_conges_onfocus(this, iSeqRow) });
  $('#id_sc_field_total' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_total_onblur('#id_sc_field_total' + iSeqRow, iSeqRow) })
                                   .bind('focus', function() { sc_frm_control_preavis_total_onfocus(this, iSeqRow) });
  $('#id_sc_field_employe_id' + iSeqRow).bind('blur', function() { sc_frm_control_preavis_employe_id_onblur('#id_sc_field_employe_id' + iSeqRow, iSeqRow) })
                                        .bind('focus', function() { sc_frm_control_preavis_employe_id_onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_frm_control_preavis_hire_date_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_hire_date();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_hire_date_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_fire_date_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_fire_date();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_fire_date_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_name_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_name();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_name_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_net_earnings_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_net_earnings();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_net_earnings_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_duration_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_duration();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_duration_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_serv_month_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_serv_month();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_serv_month_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_type_preavis_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_type_preavis();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_type_preavis_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_preavis_net_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_preavis_net();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_preavis_net_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_jours_conges_pris_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_jours_conges_pris();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_jours_conges_pris_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_jours_conges_acquis_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_jours_conges_acquis();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_jours_conges_acquis_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_jours_conges_restant_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_jours_conges_restant();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_jours_conges_restant_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_montant_conges_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_montant_conges();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_montant_conges_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_total_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_total();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_total_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_frm_control_preavis_employe_id_onblur(oThis, iSeqRow) {
  do_ajax_frm_control_preavis_mob_validate_employe_id();
  scCssBlur(oThis);
}

function sc_frm_control_preavis_employe_id_onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
        if ("0" == block) {
                displayChange_block_0(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("employe_id", "", status);
        displayChange_field("name", "", status);
        displayChange_field("hire_date", "", status);
        displayChange_field("fire_date", "", status);
        displayChange_field("net_earnings", "", status);
        displayChange_field("duration", "", status);
        displayChange_field("serv_month", "", status);
        displayChange_field("type_preavis", "", status);
        displayChange_field("preavis_net", "", status);
        displayChange_field("jours_conges_pris", "", status);
        displayChange_field("jours_conges_acquis", "", status);
        displayChange_field("jours_conges_restant", "", status);
        displayChange_field("montant_conges", "", status);
        displayChange_field("total", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_employe_id(row, status);
        displayChange_field_name(row, status);
        displayChange_field_hire_date(row, status);
        displayChange_field_fire_date(row, status);
        displayChange_field_net_earnings(row, status);
        displayChange_field_duration(row, status);
        displayChange_field_serv_month(row, status);
        displayChange_field_type_preavis(row, status);
        displayChange_field_preavis_net(row, status);
        displayChange_field_jours_conges_pris(row, status);
        displayChange_field_jours_conges_acquis(row, status);
        displayChange_field_jours_conges_restant(row, status);
        displayChange_field_montant_conges(row, status);
        displayChange_field_total(row, status);
}

function displayChange_field(field, row, status) {
        if ("employe_id" == field) {
                displayChange_field_employe_id(row, status);
        }
        if ("name" == field) {
                displayChange_field_name(row, status);
        }
        if ("hire_date" == field) {
                displayChange_field_hire_date(row, status);
        }
        if ("fire_date" == field) {
                displayChange_field_fire_date(row, status);
        }
        if ("net_earnings" == field) {
                displayChange_field_net_earnings(row, status);
        }
        if ("duration" == field) {
                displayChange_field_duration(row, status);
        }
        if ("serv_month" == field) {
                displayChange_field_serv_month(row, status);
        }
        if ("type_preavis" == field) {
                displayChange_field_type_preavis(row, status);
        }
        if ("preavis_net" == field) {
                displayChange_field_preavis_net(row, status);
        }
        if ("jours_conges_pris" == field) {
                displayChange_field_jours_conges_pris(row, status);
        }
        if ("jours_conges_acquis" == field) {
                displayChange_field_jours_conges_acquis(row, status);
        }
        if ("jours_conges_restant" == field) {
                displayChange_field_jours_conges_restant(row, status);
        }
        if ("montant_conges" == field) {
                displayChange_field_montant_conges(row, status);
        }
        if ("total" == field) {
                displayChange_field_total(row, status);
        }
}

function displayChange_field_employe_id(row, status) {
    var fieldId;
}

function displayChange_field_name(row, status) {
    var fieldId;
}

function displayChange_field_hire_date(row, status) {
    var fieldId;
}

function displayChange_field_fire_date(row, status) {
    var fieldId;
}

function displayChange_field_net_earnings(row, status) {
    var fieldId;
}

function displayChange_field_duration(row, status) {
    var fieldId;
}

function displayChange_field_serv_month(row, status) {
    var fieldId;
}

function displayChange_field_type_preavis(row, status) {
    var fieldId;
}

function displayChange_field_preavis_net(row, status) {
    var fieldId;
}

function displayChange_field_jours_conges_pris(row, status) {
    var fieldId;
}

function displayChange_field_jours_conges_acquis(row, status) {
    var fieldId;
}

function displayChange_field_jours_conges_restant(row, status) {
    var fieldId;
}

function displayChange_field_montant_conges(row, status) {
    var fieldId;
}

function displayChange_field_total(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_frm_control_preavis_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(31);
                }
        }
}
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'frm_control_preavis_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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

