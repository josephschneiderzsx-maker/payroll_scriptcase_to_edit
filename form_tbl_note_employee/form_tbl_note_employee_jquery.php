
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
  scEventControl_data["date_note_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["note_description_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["file_name_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["file_size_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["date_note_" + iSeqRow] && scEventControl_data["date_note_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["date_note_" + iSeqRow] && scEventControl_data["date_note_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["note_description_" + iSeqRow] && scEventControl_data["note_description_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["note_description_" + iSeqRow] && scEventControl_data["note_description_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["file_size_" + iSeqRow] && scEventControl_data["file_size_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["file_size_" + iSeqRow] && scEventControl_data["file_size_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_" + iSeqRow] && scEventControl_data["id_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_" + iSeqRow] && scEventControl_data["id_" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_active_all() {
  for (var i = 1; i < iAjaxNewLine; i++) {
    if (scEventControl_active(i)) {
      return true;
    }
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
  $('#id_sc_field_id_' + iSeqRow).bind('blur', function() { sc_form_tbl_note_employee_id__onblur('#id_sc_field_id_' + iSeqRow, iSeqRow) })
                                 .bind('change', function() { sc_form_tbl_note_employee_id__onchange(this, iSeqRow) })
                                 .bind('focus', function() { sc_form_tbl_note_employee_id__onfocus(this, iSeqRow) });
  $('#id_sc_field_userid_int_' + iSeqRow).bind('change', function() { sc_form_tbl_note_employee_userid_int__onchange(this, iSeqRow) });
  $('#id_sc_field_note_description_' + iSeqRow).bind('blur', function() { sc_form_tbl_note_employee_note_description__onblur('#id_sc_field_note_description_' + iSeqRow, iSeqRow) })
                                               .bind('change', function() { sc_form_tbl_note_employee_note_description__onchange(this, iSeqRow) })
                                               .bind('focus', function() { sc_form_tbl_note_employee_note_description__onfocus(this, iSeqRow) });
  $('#id_sc_field_file_name_' + iSeqRow).bind('blur', function() { sc_form_tbl_note_employee_file_name__onblur('#id_sc_field_file_name_' + iSeqRow, iSeqRow) })
                                        .bind('change', function() { sc_form_tbl_note_employee_file_name__onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_tbl_note_employee_file_name__onfocus(this, iSeqRow) });
  $('#id_sc_field_file_size_' + iSeqRow).bind('blur', function() { sc_form_tbl_note_employee_file_size__onblur('#id_sc_field_file_size_' + iSeqRow, iSeqRow) })
                                        .bind('change', function() { sc_form_tbl_note_employee_file_size__onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_tbl_note_employee_file_size__onfocus(this, iSeqRow) });
  $('#id_sc_field_document_' + iSeqRow).bind('change', function() { sc_form_tbl_note_employee_document__onchange(this, iSeqRow) });
  $('#id_sc_field_date_note_' + iSeqRow).bind('blur', function() { sc_form_tbl_note_employee_date_note__onblur('#id_sc_field_date_note_' + iSeqRow, iSeqRow) })
                                        .bind('change', function() { sc_form_tbl_note_employee_date_note__onchange(this, iSeqRow) })
                                        .bind('focus', function() { sc_form_tbl_note_employee_date_note__onfocus(this, iSeqRow) });
} // scJQEventsAdd

function sc_form_tbl_note_employee_id__onblur(oThis, iSeqRow) {
  do_ajax_form_tbl_note_employee_validate_id_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_tbl_note_employee_id__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_tbl_note_employee_id__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_tbl_note_employee_userid_int__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tbl_note_employee_note_description__onblur(oThis, iSeqRow) {
  do_ajax_form_tbl_note_employee_validate_note_description_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_tbl_note_employee_note_description__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_tbl_note_employee_note_description__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_tbl_note_employee_file_name__onblur(oThis, iSeqRow) {
  scCssBlur(oThis, iSeqRow);
}

function sc_form_tbl_note_employee_file_name__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_tbl_note_employee_file_name__onfocus(oThis, iSeqRow) {
  scCssFocus(oThis, iSeqRow);
}

function sc_form_tbl_note_employee_file_size__onblur(oThis, iSeqRow) {
  do_ajax_form_tbl_note_employee_validate_file_size_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_tbl_note_employee_file_size__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_tbl_note_employee_file_size__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_tbl_note_employee_document__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
}

function sc_form_tbl_note_employee_date_note__onblur(oThis, iSeqRow) {
  do_ajax_form_tbl_note_employee_validate_date_note_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_tbl_note_employee_date_note__onchange(oThis, iSeqRow) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_tbl_note_employee_date_note__onfocus(oThis, iSeqRow) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function displayChange_block(block, status) {
        if ("0" == block) {
                displayChange_block_0(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("date_note_", "", status);
        displayChange_field("note_description_", "", status);
        displayChange_field("file_name_", "", status);
        displayChange_field("file_size_", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_date_note_(row, status);
        displayChange_field_note_description_(row, status);
        displayChange_field_file_name_(row, status);
        displayChange_field_file_size_(row, status);
        displayChange_field_id_(row, status);
}

function displayChange_field(field, row, status) {
        if ("date_note_" == field) {
                displayChange_field_date_note_(row, status);
        }
        if ("note_description_" == field) {
                displayChange_field_note_description_(row, status);
        }
        if ("file_name_" == field) {
                displayChange_field_file_name_(row, status);
        }
        if ("file_size_" == field) {
                displayChange_field_file_size_(row, status);
        }
        if ("id_" == field) {
                displayChange_field_id_(row, status);
        }
}

function displayChange_field_date_note_(row, status) {
    var fieldId;
}

function displayChange_field_note_description_(row, status) {
    var fieldId;
}

function displayChange_field_file_name_(row, status) {
    var fieldId;
}

function displayChange_field_file_size_(row, status) {
    var fieldId;
}

function displayChange_field_id_(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_tbl_note_employee_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(30);
                }
        }
}
<?php
if (!$this->Embutida_form) {
    $selectedFieldsDefault = '"0", "1"';
    $setControlStateLoop = '2';
} else {
    $selectedFieldsDefault = '"0"';
    $setControlStateLoop = '1';
}
?>
var scFixCol_left = 0, scFixCol_list = [], scFixCol_selectedFields = [];

function scFixCol()
{
    var i;

    scFixCol_left = 0;
    scFixCol_list = [];

    scFixCol_addFieldColumns();

    for (i = 0; i < scFixCol_list.length; i++) {
        scFixCol_fix(scFixCol_list[i].type, scFixCol_list[i].name);
    }
}

function scFixCol_clear()
{
    let colList;

    scFixCol_selectedFields = [<?php echo $selectedFieldsDefault ?>];

    colList = $(".sc-col-op,.sc-col-fld");

    colList.css({
        "position": "static",
        "left": "auto"
    }).removeClass("sc-col-is-fixed");

    colList.filter(".sc-header-fixed").css({
        "position": "sticky"
    });
}

function scFixCol_addFieldColumns()
{
    var i;

    for (i = 0; i < scFixCol_selectedFields.length; i++) {
        scFixCol_list.push({"type": "fld", "name": scFixCol_selectedFields[i]});
    }
}

function scFixCol_fix(type, columnName)
{
    var columnCells = $(".sc-col-" + type + "-" + columnName), thisWidth = 0;

    if (columnCells.length) {
        thisWidth = columnCells[0].offsetWidth;

        columnCells.css({
            'position': 'sticky',
            'left': scFixCol_left,
            'z-index': 3
        }).addClass("sc-col-is-fixed");
    }

    scFixCol_left += thisWidth;
}

function scFixCol_fixTop()
{
    var columnCells = $(".sc-col-title");

    columnCells.css({
        'position': 'sticky',
        'top': 0,
        'z-index': 4
    });

    columnCells.filter(".sc-col-is-fixed").css("z-index", 5);
    columnCells.filter(".sc-col-is-fixed").filter(".sc-col-actions").css("z-index", 6);
}

function scFixCol_clickColumn(columnId)
{
    var action;

    action = scFixCol_fixColumns(columnId, "click");

    scFixCol_saveConfig(columnId, action);
}

function scFixCol_fixColumns(columnId, fixAction)
{
    var action = "";

    if ("click" == fixAction) {
        action = scFixCol_setControlState(columnId);
    } else {
        scFixCol_resetControlState(columnId);
    }

    scFixCol_clear();
    scFixCol_addFixedCells();
    scFixCol();
    scFixCol_fixTop();

    return action;
}

function scFixCol_setControlState(columnId)
{
    let i, fixColLength, action;

    if ($("#sc-fld-fix-col-" + columnId).hasClass("sc-op-fix-col-notfixed")) {
        action = "on";

        for (i = <?php echo $setControlStateLoop ?>; i <= columnId; i++) {
            $(".sc-op-fix-col-" + i).removeClass("sc-op-fix-col-notfixed").addClass("sc-op-fix-col-fixed");
        }
    } else {
        action = "off";

        fixColLength = $(".sc-op-fix-col").length;

        for (i = columnId; i < fixColLength; i++) {
            $(".sc-op-fix-col-" + i).removeClass("sc-op-fix-col-fixed").addClass("sc-op-fix-col-notfixed");
        }
    }

    return action;
}

function scFixCol_resetControlState(columnId)
{
    let i;

    $(".sc-op-fix-col").addClass("sc-op-fix-col-notfixed").removeClass("sc-op-fix-col-fixed");

    if ("" == columnId) {
        return;
    }

    for (i = <?php echo $setControlStateLoop ?>; i <= columnId; i++) {
        $(".sc-op-fix-col-" + i).removeClass("sc-op-fix-col-notfixed").addClass("sc-op-fix-col-fixed");
    }
}

function scFixCol_addFixedCells()
{
    selectedFields = $(".sc-ui-header-row .sc-op-fix-col.sc-op-fix-col-fixed");

    for (i = 0; i < selectedFields.length; i++) {
        scFixCol_selectedFields.push($(selectedFields[i]).attr("id").substr(15));
    }
}

function scFixCol_saveConfig(index, action)
{
    $.ajax({
        url: "form_tbl_note_employee.php",
        dataType: "json",
        method: "POST",
        data: {
            script_case_init: "<?php echo $this->Ini->sc_page ?>",
            nmgp_opcao: "ajax_fixed_columns_form_save",
            fixed_index: index,
            fixed_action: action
        }
    }).done(function(data, textStatus, jqXHR) {
    });
}

function scFixCol_loadState()
{
    $.ajax({
        url: "form_tbl_note_employee.php",
        dataType: "json",
        method: "POST",
        data: {
            script_case_init: "<?php echo $this->Ini->sc_page ?>",
            nmgp_opcao: "ajax_fixed_columns_form_load"
        }
    }).done(function(data, textStatus, jqXHR) {
        if (typeof data.status !== undefined && "ok" == data.status) {
            scFixCol_fixColumns(data.last_index, "load");
        }
    });
}

function scFixCol_addClickControl()
{
    $(".sc-op-fix-col").on("click", function() {
        scFixCol_clickColumn($(this).attr("data-fixcolid"));
    });
}

$(function()
{
    scFixCol();
    scFixCol_addClickControl();
    scFixCol_loadState();
    $(window).on('resize', function() {
        scFixCol_loadState();
    });
});

<?php

$formWidthCorrection = '';
if (false !== strpos($this->Ini->form_table_width, 'calc')) {
        $formWidthCalc = substr($this->Ini->form_table_width, strpos($this->Ini->form_table_width, '(') + 1);
        $formWidthCalc = substr($formWidthCalc, 0, strpos($formWidthCalc, ')'));
        $formWidthParts = explode(' ', $formWidthCalc);
        if (3 == count($formWidthParts) && 'px' == substr($formWidthParts[2], -2)) {
                $formWidthParts[2] = substr($formWidthParts[2], 0, -2) / 2;
                $formWidthCorrection = $formWidthParts[1] . ' ' . $formWidthParts[2];
        }
}

?>

function scSetFixedHeadersCss(baseTop)
{
    let rows, cols, i, j, thisTop;

    rows = $(".sc-ui-header-row");
    thisTop = baseTop;

    for (i = 0; i < rows.length; i++) {
        cols = $(rows[i]).find("td").filter(".sc-col-title");
        for (j = 0; j < cols.length; j++) {
            $(cols[j]).css({
                "position": "sticky",
                "top": thisTop + "px",
                "z-index": 4
            }).addClass("sc-header-fixed");
        }
        thisTop += $(rows[i]).height();
    }

    rows = $(".sc-ui-header-row");

    rows.filter(".sc-col-is-fixed").css("z-index", 5);
    rows.filter(".sc-col-is-fixed").filter(".sc-col-actions").css("z-index", 6);
}

$(function() {
    scSetFixedHeadersCss(0);
});

$(window).scroll(function() {
        scSetFixedHeaders();
});

var rerunHeaderDisplay = 1;

function scSetFixedHeaders(forceDisplay) {
    return;
        if (null == forceDisplay) {
                forceDisplay = false;
        }
        var divScroll, formHeaders, headerPlaceholder;
        formHeaders = scGetHeaderRow();
        headerPlaceholder = $("#sc-id-fixedheaders-placeholder");
        if (!formHeaders) {
                headerPlaceholder.hide();
        }
        else {
                if (scIsHeaderVisible(formHeaders)) {
                        headerPlaceholder.hide();
                }
                else {
                        if (!headerPlaceholder.filter(":visible").length || forceDisplay) {
                                scSetFixedHeadersContents(formHeaders, headerPlaceholder);
                                scSetFixedHeadersSize(formHeaders);
                                headerPlaceholder.show();
                        }
                        scSetFixedHeadersPosition(formHeaders, headerPlaceholder);
                        if (0 < rerunHeaderDisplay) {
                                rerunHeaderDisplay--;
                                setTimeout(function() {
                                        scSetFixedHeadersContents(formHeaders, headerPlaceholder);
                                        scSetFixedHeadersSize(formHeaders);
                                        headerPlaceholder.show();
                                        scSetFixedHeadersPosition(formHeaders, headerPlaceholder);
                                }, 5);
                        }
                }
        }
}

function scSetFixedHeadersPosition(formHeaders, headerPlaceholder) {
        if (formHeaders) {
                headerPlaceholder.css({"top": 0<?php echo $formWidthCorrection ?>, "left": (Math.floor(formHeaders.offset().left) - $(document).scrollLeft()<?php echo $formWidthCorrection ?>) + "px"});
        }
}

function scIsHeaderVisible(formHeaders) {
        if (typeof(scIsHeaderVisibleMobile) === typeof(function(){})) { return scIsHeaderVisibleMobile(formHeaders); }
        return formHeaders.offset().top > $(document).scrollTop();
}

function scGetHeaderRow() {
        var formHeaders = $(".sc-ui-header-row").filter(":visible");
        if (!formHeaders.length) {
                formHeaders = false;
        }
        return formHeaders;
}

function scSetFixedHeadersContents(formHeaders, headerPlaceholder) {
        var i, htmlContent;
        htmlContent = "<table id=\"sc-id-fixed-headers\" class=\"scFormTable\">";
        for (i = 0; i < formHeaders.length; i++) {
                htmlContent += "<tr class=\"scFormLabelOddMult\" id=\"sc-id-headers-row-" + i + "\">" + $(formHeaders[i]).html() + "</tr>";
        }
        htmlContent += "</table>";
        headerPlaceholder.html(htmlContent);
}

function scSetFixedHeadersSize(formHeaders) {
        var i, j, headerColumns, formColumns, cellHeight, cellWidth, tableOriginal, tableHeaders;
        tableOriginal = $("#hidden_bloco_0");
        tableHeaders = document.getElementById("sc-id-fixed-headers");
        $(tableHeaders).css("width", $(tableOriginal).outerWidth());
        for (i = 0; i < formHeaders.length; i++) {
                headerColumns = $("#sc-id-fixed-headers-row-" + i).find("td");
                formColumns = $(formHeaders[i]).find("td");
                for (j = 0; j < formColumns.length; j++) {
                        if (window.getComputedStyle(formColumns[j])) {
                                cellWidth = window.getComputedStyle(formColumns[j]).width;
                                cellHeight = window.getComputedStyle(formColumns[j]).height;
                        }
                        else {
                                cellWidth = $(formColumns[j]).width() + "px";
                                cellHeight = $(formColumns[j]).height() + "px";
                        }
                        $(headerColumns[j]).css({
                                "width": cellWidth,
                                "height": cellHeight
                        });
                }
        }
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_date_note_" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_date_note_" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_date_note_" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_tbl_note_employee_validate_date_note_(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("SU"); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("ddmmyyyy", "-"); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  })
<?php
if ('' != $miniCalendarFA) {
?>
    .next('button').append("<?php echo $miniCalendarFA; ?>")
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    .next('button').append("<?php echo $miniCalendarButton[0]; ?>")
<?php
}
?>
} // scJQCalendarAdd

function scJQUploadAdd(iSeqRow) {
  $("#id_sc_field_file_name_" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_tbl_note_employee_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'param_field', value: 'file_name_'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_file_name_" + iSeqRow);
        loaderContent = $("#id_img_loader_file_name_" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_file_name_" + iSeqRow);
        loader.show();
      }
    },
    change: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_file_name_(data);
      if ('ok' != checkUploadSize) {
        e.preventDefault();
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    drop: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_file_name_(data);
      if ('ok' != checkUploadSize) {
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    done: function(e, data) {
      var fileData, respData, respPos, respMsg, thumbDisplay, checkDisplay, var_ajax_img_thumb, oTemp;
      fileData = null;
      respMsg = "";
      if (data && data.result && data.result[0] && data.result[0].body) {
        respData = data.result[0].body.innerText;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = $.parseJSON(respData);
        }
        else {
          respMsg = respData;
        }
      }
      else {
        respData = data.result;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = eval(respData);
        }
        else {
          respMsg = respData;
        }
      }
      if (window.FormData !== undefined)
      {
        $("#id_img_loader_file_name_" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_file_name_" + iSeqRow).hide();
      }
      if (null == fileData) {
        if ("" != respMsg) {
          oTemp = {"htmOutput" : "<?php echo $this->Ini->Nm_lang['lang_errm_upld_admn']; ?>"};
          scAjaxShowDebug(oTemp);
        }
        return;
      }
      if (fileData[0].error && "" != fileData[0].error) {
        var uploadErrorMessage = "";
        oResp = {};
        if ("acceptFileTypes" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_invl']) ?>";
        }
        else if ("maxFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("minFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("emptyFile" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_empty']) ?>";
        }
        scAjaxShowErrorDisplay("table", uploadErrorMessage);
        return;
      }
      $("#id_sc_field_file_name_" + iSeqRow).val("");
      $("#id_sc_field_file_name__ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_file_name__ul_type" + iSeqRow).val(fileData[0].type);
      $("#id_ajax_doc_file_name_" + iSeqRow).html(fileData[0].name);
      $("#id_ajax_doc_file_name_" + iSeqRow).css("display", "");
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_file_name_" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_file_name_" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
    }
  });

  $("#id_sc_field_document_" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_tbl_note_employee_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'param_field', value: 'document_'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_document_" + iSeqRow);
        loaderContent = $("#id_img_loader_document_" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_document_" + iSeqRow);
        loader.show();
      }
    },
    change: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_document_(data);
      if ('ok' != checkUploadSize) {
        e.preventDefault();
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    drop: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_document_(data);
      if ('ok' != checkUploadSize) {
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    done: function(e, data) {
      var fileData, respData, respPos, respMsg, thumbDisplay, checkDisplay, var_ajax_img_thumb, oTemp;
      fileData = null;
      respMsg = "";
      if (data && data.result && data.result[0] && data.result[0].body) {
        respData = data.result[0].body.innerText;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = $.parseJSON(respData);
        }
        else {
          respMsg = respData;
        }
      }
      else {
        respData = data.result;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = eval(respData);
        }
        else {
          respMsg = respData;
        }
      }
      if (window.FormData !== undefined)
      {
        $("#id_img_loader_document_" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_document_" + iSeqRow).hide();
      }
      if (null == fileData) {
        if ("" != respMsg) {
          oTemp = {"htmOutput" : "<?php echo $this->Ini->Nm_lang['lang_errm_upld_admn']; ?>"};
          scAjaxShowDebug(oTemp);
        }
        return;
      }
      if (fileData[0].error && "" != fileData[0].error) {
        var uploadErrorMessage = "";
        oResp = {};
        if ("acceptFileTypes" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_invl']) ?>";
        }
        else if ("maxFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("minFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("emptyFile" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_empty']) ?>";
        }
        scAjaxShowErrorDisplay("table", uploadErrorMessage);
        return;
      }
      $("#id_sc_field_document_" + iSeqRow).val("");
      $("#id_sc_field_document__ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_document__ul_type" + iSeqRow).val(fileData[0].type);
      $("#id_ajax_doc_document_" + iSeqRow).html(fileData[0].name);
      $("#id_ajax_doc_document_" + iSeqRow).css("display", "");
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_document_" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_document_" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
    }
  });

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
                case 'date_note_':
                        usa_read_only = 1
                    break;                case 'note_description_':
                        usa_read_only = 1
                    break;                case 'file_name_':
                        usa_read_only = 1
                    break;                case 'file_size_':
                        usa_read_only = 1
                    break;                case 'id_':
                        usa_read_only = 1
                    break;                case 'userid_int_':
                        usa_read_only = 1
                    break;                case 'document_':
                        usa_read_only = 1
                    break;
                }
                     if(usa_read_only && $('a',$('#id_read_on_'+field+iSeqRow)).length == 0){
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_tbl_note_employee')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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

$(document).ready(function(){<?php if($this->nmgp_opcao != 'novo' && $this->nmgp_opcao != 'nada'): ?>

        for (var iSeqRow = 1; iSeqRow <= iAjaxNewLine; iSeqRow++){
            $('[id^=id_ajax_doc_document_'+iSeqRow+'],[id^=id_read_on_document_'+iSeqRow+']').each(function(i, t){
                ajax_check_file($(this).text() , 'document_', $('#id_ajax_doc_document_'+iSeqRow+' a,#id_read_on_document_'+iSeqRow ), '<?php echo '/PAYROLLHTG/EMPFOLDER'; ?>', '<?php echo '//'; ?>', iSeqRow );
            });
            $('[id^=id_ajax_doc_document_],[id^=id_read_on_document_]').on('DOMSubtreeModified', function(){
                iSeqRow = $(this).attr('id').indexOf('id_ajax_doc_') != -1 ? $(this).attr('id').split('id_ajax_doc_document_').join('') : $(this).attr('id').split('id_read_on_document_').join('');
                ajax_check_file($(this).text() , 'document_', $('#id_ajax_doc_document_'+iSeqRow+' a, #id_read_on_document_'+iSeqRow ), '<?php echo '/PAYROLLHTG/EMPFOLDER'; ?>', '<?php echo '//'; ?>', iSeqRow );
            });
         }

<?php endif; ?>
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

function scJQSelect2Add(seqRow, specificField) {
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
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

function scCheckUploadExtensionSize_file_name_(thisField)
{
    if ("files" in thisField && thisField.files.length > 0) {
        thisFileExtension = scGetFileExtension(thisField.files[0].name);

        if ("pdf" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||PDF||30 MB';
        }
        if ("jpeg" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||JPEG||30 MB';
        }
        if ("png" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||PNG||30 MB';
        }
        if ("jpg" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||JPG||30 MB';
        }
        if ("xls" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||XLS||30 MB';
        }
        if ("xlsx" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||XLSX||30 MB';
        }
        if ("doc" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||DOC||30 MB';
        }
        if ("docx" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||DOCX||30 MB';
        }

        if (!["pdf", "jpeg", "png", "jpg", "xls", "xlsx", "doc", "docx"].includes(thisFileExtension)) {
            return 'err_extension||' + thisFileExtension.toUpperCase();
        }
    }

    return 'ok';
}

function scCheckUploadExtensionSize_document_(thisField)
{
    if ("files" in thisField && thisField.files.length > 0) {
        thisFileExtension = scGetFileExtension(thisField.files[0].name);

        if ("pdf" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||PDF||30 MB';
        }
        if ("jpeg" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||JPEG||30 MB';
        }
        if ("png" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||PNG||30 MB';
        }
        if ("jpg" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||JPG||30 MB';
        }
        if ("xls" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||XLS||30 MB';
        }
        if ("xlsx" == thisFileExtension && 31457280 < thisField.files[0].size) {
            return 'err_size||XLSX||30 MB';
        }

        if (!["pdf", "jpeg", "png", "jpg", "xls", "xlsx"].includes(thisFileExtension)) {
            return 'err_extension||' + thisFileExtension.toUpperCase();
        }
    }

    return 'ok';
}

