
 <form name="form_ajax_redir_1" method="post" style="display: none">
  <input type="hidden" name="nmgp_parms">
  <input type="hidden" name="nmgp_outra_jan">
  <input type="hidden" name="script_case_session" value="<?php echo session_id() ?>">
 </form>
 <form name="form_ajax_redir_2" method="post" style="display: none">
  <input type="hidden" name="nmgp_parms">
  <input type="hidden" name="nmgp_url_saida">
  <input type="hidden" name="script_case_init">
  <input type="hidden" name="script_case_session" value="<?php echo session_id() ?>">
 </form>

 <SCRIPT>
<?php
sajax_show_javascript();
?>

  function scCenterElement(oElem)
  {
    var $oElem    = $(oElem),
        $oWindow  = $(this),
        iElemTop  = Math.round(($oWindow.height() - $oElem.height()) / 2),
        iElemLeft = Math.round(($oWindow.width()  - $oElem.width())  / 2);

    $oElem.offset({top: iElemTop, left: iElemLeft});
  } // scCenterElement

  function scAjaxHideAutocomp(sFrameId)
  {
    if (document.getElementById("id_ac_frame_" + sFrameId))
    {
      document.getElementById("id_ac_frame_" + sFrameId).style.display = "none";
    }
  } // scAjaxHideAutocomp

  function scAjaxShowAutocomp(sFrameId)
  {
    if (document.getElementById("id_ac_frame_" + sFrameId))
    {
      document.getElementById("id_ac_frame_" + sFrameId).style.display = "";
      document.getElementById("id_ac_" + sFrameId).focus();
    }
  } // scAjaxShowAutocomp

  function scAjaxHideDebug()
  {
    if (document.getElementById("id_debug_window"))
    {
      document.getElementById("id_debug_window").style.display = "none";
      document.getElementById("id_debug_text").innerHTML = "";
    }
  } // scAjaxHideDebug

  function scAjaxShowDebug(oTemp)
  {
    if (!document.getElementById("id_debug_window"))
    {
      return;
    }
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (oResp["htmOutput"] && "" != oResp["htmOutput"])
    {
      document.getElementById("id_debug_window").style.display = "";
      document.getElementById("id_debug_text").innerHTML = scAjaxFormatDebug(oResp["htmOutput"]) + document.getElementById("id_debug_text").innerHTML;
      //scCenterElement(document.getElementById("id_debug_window"));
    }
  } // scAjaxShowDebug

  function scAjaxFormatDebug(sDebugMsg)
  {
    return "<table class=\"scFormMessageTable\" style=\"margin: 1px; width: 100%\"><tr><td class=\"scFormMessageMessage\">" + scAjaxSpecCharParser(sDebugMsg) + "</td></tr></table>";
  } // scAjaxFormatDebug

  function scAjaxHideErrorDisplay_default(sErrorId, bForce)
  {
    if (document.getElementById("id_error_display_" + sErrorId + "_frame"))
    {
        document.getElementById("id_error_display_" + sErrorId + "_frame").style.display = "none";
        document.getElementById("id_error_display_" + sErrorId + "_text").innerHTML = "";
        if (null == bForce)
        {
            bForce = true;
        }
        if (bForce)
        {
            var $oField = $('#id_sc_field_' + sErrorId);
            if (0 < $oField.length)
            {
                scAjax_removeFieldErrorStyle($oField);
            }
        }
    }
    if (document.getElementById("id_error_display_fixed"))
    {
        document.getElementById("id_error_display_fixed").style.display = "none";
    }
  } // scAjaxHideErrorDisplay_default

  function scAjaxShowErrorDisplay_default(sErrorId, sErrorMsg)
  {
    if (oResp && oResp['redirExitInfo'])
    {
      sErrorMsg += "<br /><input type=\"button\" onClick=\"window.location='" + oResp['redirExitInfo']['action'] + "'\" value=\"Ok\">";
    }
    sErrorMsg = scAjaxErrorSql(sErrorMsg);
    if (document.getElementById("id_error_display_" + sErrorId + "_frame"))
    {
      document.getElementById("id_error_display_" + sErrorId + "_frame").style.display = "";
      document.getElementById("id_error_display_" + sErrorId + "_text").innerHTML = sErrorMsg;
      if ("table" == sErrorId)
      {
        scCenterElement(document.getElementById("id_error_display_" + sErrorId + "_frame"));
      }
      var $oField = $('#id_sc_field_' + sErrorId);
      if (0 < $oField.length)
      {
        scAjax_applyFieldErrorStyle($oField);
      }
    }
    if (ajax_error_list && ajax_error_list[sErrorId] && ajax_error_list[sErrorId]["timeout"] && 0 < ajax_error_list[sErrorId]["timeout"])
    {
      setTimeout("scAjaxHideErrorDisplay('" + sErrorId + "', false)", ajax_error_list[sErrorId]["timeout"] * 1000);
    }
  } // scAjaxShowErrorDisplay_default

  var iErrorSqlId = 1;

  function scAjaxErrorSql(sErrorMsg)
  {
    var iTmpPos = sErrorMsg.indexOf("{SC_DB_ERROR_INI}"),
        sTmpId;
    while (-1 < iTmpPos)
    {
      sTmpId    = "sc_id_error_sql_" + iErrorSqlId;
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "<br /><span style=\"text-decoration: underline\" onClick=\"$('#" + sTmpId + "').show(); scCenterElement(document.getElementById('" + sTmpId + "'))\">" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_MID}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "</span><table class=\"scFormErrorTable\" id=\"" + sTmpId + "\" style=\"display: none; position: absolute\"><tr><td>" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_CLS}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "<br /><br /><span onClick=\"$('#" + sTmpId + "').hide()\">" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_END}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "</span></td></tr></table>" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_INI}");
      iErrorSqlId++;
    }
    return sErrorMsg;
  } // scAjaxErrorSql

  function scAjaxHideMessage_default()
  {
    if (document.getElementById("id_message_display_frame"))
    {
      document.getElementById("id_message_display_frame").style.display = "none";
      document.getElementById("id_message_display_text").innerHTML = "";
    }
  } // scAjaxHideMessage

  function scAjaxShowMessage_default()
  {
    if (!oResp["msgDisplay"] || !oResp["msgDisplay"]["msgText"])
    {
      return;
    }
    _scAjaxShowMessage_default({title: scMsgDefTitle, message: oResp["msgDisplay"]["msgText"], isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: false, toastPos: ""});
  } // scAjaxShowMessage

  var scMsgDefClose = "";

  function _scAjaxShowMessage_default(params) {
        var sTitle = params["title"],
                sMessage = params["message"],
                bModal = params["isModal"],
                iTimeout = params["timeout"],
                bButton = params["showButton"],
                sButton = params["buttonLabel"],
                iTop = params["topPos"],
                iLeft = params["leftPos"],
                iWidth = params["width"],
                iHeight = params["height"],
                sRedir = params["redirUrl"],
                sTarget = params["redirTarget"],
                sParam = params["redirParam"],
                bClose = params["showClose"],
                bBodyIcon = params["showBodyIcon"],
                bToast = params["isToast"],
                sToastPos = params["toastPos"];
    if ("" == sMessage) {
      if (bModal) {
        scMsgDefClick = "close_modal";
      }
      else {
        scMsgDefClick = "close";
      }
      _scAjaxMessageBtnClick();
      document.getElementById("id_message_display_title").innerHTML = scMsgDefTitle;
      document.getElementById("id_message_display_text").innerHTML = "";
      document.getElementById("id_message_display_buttone").value = scMsgDefButton;
      document.getElementById("id_message_display_buttond").style.display = "none";
    }
    else {
      document.getElementById("id_message_display_title").innerHTML = scAjaxSpecCharParser(sTitle);
      document.getElementById("id_message_display_text").innerHTML = scAjaxSpecCharParser(sMessage);
      document.getElementById("id_message_display_buttone").value = sButton;
      document.getElementById("id_message_display_buttond").style.display = bButton ? "" : "none";
      document.getElementById("id_message_display_buttond").style.display = bButton ? "" : "none";
      document.getElementById("id_message_display_title_line").style.display = (bClose || "" != sTitle) ? "" : "none";
      document.getElementById("id_message_display_close_icon").style.display = bClose ? "" : "none";
      if (document.getElementById("id_message_display_body_icon")) {
        document.getElementById("id_message_display_body_icon").style.display = bBodyIcon ? "" : "none";
      }
      $("#id_message_display_content").css('width', (0 < iWidth ? iWidth + 'px' : ''));
      $("#id_message_display_content").css('height', (0 < iHeight ? iHeight + 'px' : ''));
      if (bModal) {
        iWidth = iWidth || 250;
        iHeight = iHeight || 200;
        scMsgDefClose = "close_modal";
        tb_show('', '#TB_inline?height=' + (iHeight + 6) + '&width=' + (iWidth + 4) + '&inlineId=id_message_display_frame&modal=true', '');
        if (bButton) {
          if ("" != sRedir && "" != sTarget) {
            scMsgDefClick = "redir2_modal";
            document.form_ajax_redir_2.action = sRedir;
            document.form_ajax_redir_2.target = sTarget;
            document.form_ajax_redir_2.nmgp_parms.value = sParam;
            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;
          }
          else if ("" != sRedir && "" == sTarget) {
            scMsgDefClick = "redir1";
            document.form_ajax_redir_1.action = sRedir;
            document.form_ajax_redir_1.nmgp_parms.value = sParam;
          }
          else {
            scMsgDefClick = "close_modal";
          }
        }
        else if (null != iTimeout && 0 < iTimeout) {
          scMsgDefClick = "close_modal";
          setTimeout("_scAjaxMessageBtnClick()", iTimeout * 1000);
        }
      }
      else
      {
        scMsgDefClose = "close";
        $("#id_message_display_frame").css('top', (0 < iTop ? iTop + 'px' : ''));
        $("#id_message_display_frame").css('left', (0 < iLeft ? iLeft + 'px' : ''));
        document.getElementById("id_message_display_frame").style.display = "";
        if (0 == iTop && 0 == iLeft) {
          scCenterElement(document.getElementById("id_message_display_frame"));
        }
        if (bButton) {
          if ("" != sRedir && "" != sTarget) {
            scMsgDefClick = "redir2";
            document.form_ajax_redir_2.action = sRedir;
            document.form_ajax_redir_2.target = sTarget;
            document.form_ajax_redir_2.nmgp_parms.value = sParam;
            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;
          }
          else if ("" != sRedir && "" == sTarget) {
            scMsgDefClick = "redir1";
            document.form_ajax_redir_1.action = sRedir;
            document.form_ajax_redir_1.nmgp_parms.value = sParam;
          }
          else {
            scMsgDefClick = "close";
          }
        }
        else if (null != iTimeout && 0 < iTimeout) {
          scMsgDefClick = "close";
          setTimeout("_scAjaxMessageBtnClick()", iTimeout * 1000);
        }
      }
    }
  } // _scAjaxShowMessage_default

  function _scAjaxMessageBtnClose() {
    switch (scMsgDefClose) {
      case "close":
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "close_modal":
        tb_remove();
        break;
    }
  } // _scAjaxMessageBtnClick

  function _scAjaxMessageBtnClick() {
    switch (scMsgDefClick) {
      case "close":
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "close_modal":
        tb_remove();
        break;
      case "dismiss":
        scAjaxHideMessage();
        break;
      case "redir1":
        document.form_ajax_redir_1.submit();
        break;
      case "redir2":
        document.form_ajax_redir_2.submit();
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "redir2_modal":
        document.form_ajax_redir_2.submit();
        tb_remove();
        break;
    }
  } // _scAjaxMessageBtnClick

  function scAjaxHasError()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "ERROR" == oResp["result"];
  } // scAjaxHasError

  function scAjaxIsOk()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "OK" == oResp["result"] || "SET" == oResp["result"];
  } // scAjaxIsOk

  function scAjaxIsSet()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "SET" == oResp["result"];
  } // scAjaxIsSet

  function scAjaxCalendarReload()
  {
    if (oResp["calendarReload"] && "OK" == oResp["calendarReload"] && typeof self.parent.calendar_reload == "function")
    {
<?php
if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && isset($_SESSION['scriptcase']['display_mobile']) && $_SESSION['scriptcase']['display_mobile']) {
?>
      self.parent.calendar_reload();
      self.parent.tb_remove();
<?php
} else {
?>
      self.parent.calendar_reload();
      self.parent.tb_remove();
<?php
}
?>
      return true;
    }
    return false;
  } // scCalendarReload

  function scAjaxUpdateErrors(sType)
  {
    ajax_error_geral = "";
    oFieldErrors     = {};
    if (oResp["errList"])
    {
      for (iFieldErrors = 0; iFieldErrors < oResp["errList"].length; iFieldErrors++)
      {
        sTestField = oResp["errList"][iFieldErrors]["fldName"];
        if ("geral_app_settings_mob" == sTestField)
        {
          if (ajax_error_geral != '') { ajax_error_geral += '<br>';}
          ajax_error_geral += scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
        }
        else
        {
          if (scFocusFirstErrorField && '' == scFocusFirstErrorName)
          {
            scFocusFirstErrorName = sTestField;
          }
          if (oResp["errList"][iFieldErrors]["numLinha"])
          {
            sTestField += oResp["errList"][iFieldErrors]["numLinha"];
          }
          if (!oFieldErrors[sTestField])
          {
            oFieldErrors[sTestField] = new Array();
          }
          oFieldErrors[sTestField][oFieldErrors[sTestField].length] = scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
        }
      }
    }
    for (iUpdateErrors = 0; iUpdateErrors < ajax_field_list.length; iUpdateErrors++)
    {
      sTestField = ajax_field_list[iUpdateErrors];
      if (oFieldErrors[sTestField])
      {
        ajax_error_list[sTestField][sType] = oFieldErrors[sTestField];
      }
    }
  } // scAjaxUpdateErrors

  function scAjaxUpdateFieldErrors(sField, sType)
  {
    aFieldErrors = new Array();
    if (oResp["errList"])
    {
      iErrorPos  = 0;
      for (iFieldErrors = 0; iFieldErrors < oResp["errList"].length; iFieldErrors++)
      {
        sTestField = oResp["errList"][iFieldErrors]["fldName"];
        if (oResp["errList"][iFieldErrors]["numLinha"])
        {
          sTestField += oResp["errList"][iFieldErrors]["numLinha"];
        }
        if (sField == sTestField)
        {
          aFieldErrors[iErrorPos] = scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
          iErrorPos++;
        }
      }
    }
        if (ajax_error_list[sField])
        {
        ajax_error_list[sField][sType] = aFieldErrors;
        }
  } // scAjaxUpdateFieldErrors

  function scAjaxListErrors(bLabel)
  {
    bFirst        = false;
    sAppErrorText = "";
    if ("" != ajax_error_geral)
    {
      bFirst         = true;
      sAppErrorText += ajax_error_geral;
    }
    for (iFieldList = 0; iFieldList < ajax_field_list.length; iFieldList++)
    {
      sFieldError = scAjaxListFieldErrors(ajax_field_list[iFieldList], bLabel);
      if ("" != sFieldError)
      {
        if (bFirst)
        {
          bFirst         = false
          sAppErrorText += "<hr size=\"1\" width=\"80%\" />";
        }
        sAppErrorText += sFieldError;
      }
    }
    return sAppErrorText;
  } // scAjaxListErrors

  function scAjaxListFieldErrors(sField, bLabel)
  {
    sErrorText = "";
    for (iErrorType = 0; iErrorType < ajax_error_type.length; iErrorType++)
    {
      if (ajax_error_list[sField])
      {
        for (iListErrors = 0; iListErrors < ajax_error_list[sField][ajax_error_type[iErrorType]].length; iListErrors++)
        {
          if (bLabel)
          {
            sErrorText += ajax_error_list[sField]["label"] + ": ";
          }
          sErrorText += ajax_error_list[sField][ajax_error_type[iErrorType]][iListErrors] + "<br />";
        }
      }
    }
    return sErrorText;
  } // scAjaxListFieldErrors

        function scAjaxClearErrors() {
                var fieldName;

                for (fieldName in ajax_error_list) {
            if (null != ajax_error_list[fieldName]) {
                ajax_error_list[fieldName]["valid"] = new Array();
                ajax_error_list[fieldName]["onblur"] = new Array();
                ajax_error_list[fieldName]["onchange"] = new Array();
                ajax_error_list[fieldName]["onclick"] = new Array();
                ajax_error_list[fieldName]["onfocus"] = new Array();
            }
                }
        } // scAjaxClearErrors

  function scAjaxSetVariables()
  {
    if (!oResp["varList"])
    {
      return true;
    }
    for (var iVarFields = 0; iVarFields < oResp["varList"].length; iVarFields++)
    {
          if(typeof oResp["varList"][iVarFields] === 'object' && oResp["varList"][iVarFields] !== null)
          {
              var sVarName  = oResp["varList"][iVarFields].index;
              var sVarValue = oResp["varList"][iVarFields].value;
          }
          else
          {
              var sVarName  = oResp["varList"][iVarFields]["index"];
              var sVarValue = oResp["varList"][iVarFields]["value"];
          }

          if (sVarValue == 'new Array()') {
            eval(sVarName + " = new Array();");
          } else {
            eval(sVarName + " = \"" + sVarValue + "\";");
          }
    }
  } // scAjaxSetVariables
/*
  function scAjaxSetVariables()
  {
    if (!oResp["varList"])
    {
      return true;
    }
    for (var iVarFields = 0; iVarFields < oResp["varList"].length; iVarFields++)
    {
      var sVarName  = oResp["varList"][iVarFields]["index"];
      var sVarValue = oResp["varList"][iVarFields]["value"];
              if (sVarValue.indexOf('new Array') > -1) {
                        eval(sVarName + " = sVarValue;");
                  } else {
                        eval(sVarName + " = \"" + sVarValue + "\";");
                  }
        }
  } // scAjaxSetVariables
*/
  function scAjaxSetSummaryLine()
  {
    if (!oResp["navSummary"] || !oResp["navSummary"]["summary_line"])
    {
      return true;
    }
    $("#sc-summary-line").html(oResp["navSummary"]["summary_line"]);
  } // scAjaxSetSummaryLine

  function scAjaxSetFields()
  {
    if (!oResp["fldList"])
    {
      return true;
    }
    for (iSetFields = 0; iSetFields < oResp["fldList"].length; iSetFields++)
    {
      var sFieldName = oResp["fldList"][iSetFields]["fldName"];
      var sFieldType = oResp["fldList"][iSetFields]["fldType"];

      if ("selectdd" == sFieldType)
      {
        var bSelectDD = true;
        sFieldType = "select";
      }
      else
      {
        var bSelectDD = false;
      }
      if ("select2_ac" == sFieldType)
      {
        var bSelect2AC = true;
        sFieldType = "select";
      }
      else
      {
        var bSelect2AC = false;
      }
      if (oResp["fldList"][iSetFields]["valList"])
      {
        var oFieldValues = oResp["fldList"][iSetFields]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (oResp["fldList"][iSetFields]["optList"])
      {
        var oFieldOptions = oResp["fldList"][iSetFields]["optList"];
      }
      else
      {
        var oFieldOptions = null;
      }
/*
      if ("_autocomp" == sFieldName.substr(sFieldName.length - 9) &&
          iSetFields > 0 &&
          sFieldName.substr(0, sFieldName.length - 9) == oResp["fldList"][iSetFields - 1]["fldName"] &&
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)) &&
          oFieldValues[0]['value'])
      {
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)).innerHTML = oFieldValues[0]['value'];
      }
*/

      if ("corhtml" == sFieldType)
      {
        sFieldType = 'text';

        /*sCor = (oFieldValues[0]['value']) ? oFieldValues[0]['value'] : "";
        setaCorPaleta(sFieldName, sCor);*/
      }

      if ("_autocomp" == sFieldName.substr(sFieldName.length - 9) &&
          iSetFields > 0 &&
          sFieldName.substr(0, sFieldName.length - 9) == oResp["fldList"][iSetFields - 1]["fldName"] &&
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)))
      {
          sLabel_auto_Comp = (oFieldValues[0]['value']) ? oFieldValues[0]['value'] : "";
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)).innerHTML = sLabel_auto_Comp;
      }


      if (oResp["fldList"][iSetFields]["colNum"])
      {
        var iColNum = oResp["fldList"][iSetFields]["colNum"];
      }
      else
      {
        var iColNum = 1;
      }
      if (oResp["fldList"][iSetFields]["row"])
      {
        var iRow = oResp["fldList"][iSetFields]["row"];
                var thisRow = oResp["fldList"][iSetFields]["row"];
      }
      else
      {
        var iRow = 1;
                var thisRow = "";
      }
      if (oResp["fldList"][iSetFields]["htmComp"])
      {
        var sHtmComp = oResp["fldList"][iSetFields]["htmComp"];
        sHtmComp     = sHtmComp.replace(/__AD__/gi, '"');
        sHtmComp     = sHtmComp.replace(/__AS__/gi, "'");
      }
      else
      {
        var sHtmComp = null;
      }
      if (oResp["fldList"][iSetFields]["imgFile"])
      {
        var sImgFile = oResp["fldList"][iSetFields]["imgFile"];
      }
      else
      {
        var sImgFile = "";
      }
      if (oResp["fldList"][iSetFields]["imgOrig"])
      {
        var sImgOrig = oResp["fldList"][iSetFields]["imgOrig"];
      }
      else
      {
        var sImgOrig = "";
      }
      if (oResp["fldList"][iSetFields]["keepImg"])
      {
        var sKeepImg = oResp["fldList"][iSetFields]["keepImg"];
      }
      else
      {
        var sKeepImg = "N";
      }
      if (oResp["fldList"][iSetFields]["hideName"])
      {
        var sHideName = oResp["fldList"][iSetFields]["hideName"];
      }
      else
      {
        var sHideName = "N";
      }
      if (oResp["fldList"][iSetFields]["imgLink"])
      {
        var sImgLink = oResp["fldList"][iSetFields]["imgLink"];
      }
      else
      {
        var sImgLink = null;
      }
      if (oResp["fldList"][iSetFields]["docLink"])
      {
        var sDocLink = oResp["fldList"][iSetFields]["docLink"];
      }
      else
      {
        var sDocLink = "";
      }
      if (oResp["fldList"][iSetFields]["docIcon"])
      {
        var sDocIcon = oResp["fldList"][iSetFields]["docIcon"];
      }
      else
      {
        var sDocIcon = "";
      }

      if (oResp["fldList"][iSetFields]["docReadonly"])
      {
        var sDocReadonly = oResp["fldList"][iSetFields]["docReadonly"];
      }
      else
      {
        var sDocReadonly = "";
      }

      if (oResp["fldList"][iSetFields]["optComp"])
      {
        var sOptComp = oResp["fldList"][iSetFields]["optComp"];
      }
      else
      {
        var sOptComp = "";
      }
      if (oResp["fldList"][iSetFields]["optClass"])
      {
        var sOptClass = oResp["fldList"][iSetFields]["optClass"];
      }
      else
      {
        var sOptClass = "";
      }
      if (oResp["fldList"][iSetFields]["optMulti"])
      {
        var sOptMulti = oResp["fldList"][iSetFields]["optMulti"];
      }
      else
      {
        var sOptMulti = "";
      }
      if (oResp["fldList"][iSetFields]["imgHtml"])
      {
        var sImgHtml = oResp["fldList"][iSetFields]["imgHtml"];
      }
      else
      {
        var sImgHtml = "";
      }
      if (oResp["fldList"][iSetFields]["mulHtml"])
      {
        var sMULHtml = oResp["fldList"][iSetFields]["mulHtml"];
      }
      else
      {
        var sMULHtml = "";
      }
      if (oResp["fldList"][iSetFields]["updInnerHtml"])
      {
        var sInnerHtml = scAjaxSpecCharParser(oResp["fldList"][iSetFields]["updInnerHtml"]);
      }
      else
      {
        var sInnerHtml = null;
      }
      if (oResp["fldList"][iSetFields]["lookupCons"])
      {
        var sLookupCons = scAjaxSpecCharParser(oResp["fldList"][iSetFields]["lookupCons"]);
      }
      else
      {
        var sLookupCons = "";
      }
      if (oResp["clearUpload"])
      {
        var sClearUpload = scAjaxSpecCharParser(oResp["clearUpload"]);
      }
      else
      {
        var sClearUpload = "N";
      }
      if (oResp["eventField"])
      {
        var sEventField = scAjaxSpecCharParser(oResp["eventField"]);
      }
      else
      {
        var sEventField = "__SC_NO_FIELD";
      }
      if (oResp["fldList"][iSetFields]["switch"])
      {
        var bSwitch = true == oResp["fldList"][iSetFields]["switch"];
      }
      else
      {
        var bSwitch = false;
      }
      if ("checkbox" == sFieldType)
      {
        scAjaxSetFieldCheckbox(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sInnerHtml, sOptComp, sOptClass, sOptMulti, bSwitch, sEventField);
      }
      else if ("duplosel" == sFieldType)
      {
        scAjaxSetFieldDuplosel(sFieldName, oFieldValues, oFieldOptions);
      }
      else if ("imagem" == sFieldType)
      {
        scAjaxSetFieldImage(sFieldName, oFieldValues, sImgFile, sImgOrig, sImgLink, sKeepImg, sHideName);
      }
      else if ("documento" == sFieldType)
      {
        scAjaxSetFieldDocument(sFieldName, oFieldValues, sDocLink, sDocIcon, sClearUpload, sDocReadonly);
      }
      else if ("label" == sFieldType)
      {
        scAjaxSetFieldLabel(sFieldName, oFieldValues, oFieldOptions, sLookupCons);
      }
      else if ("radio" == sFieldType)
      {
        scAjaxSetFieldRadio(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, bSwitch, sEventField);
      }
      else if ("select" == sFieldType)
      {
        scAjaxSetFieldSelect(sFieldName, oFieldValues, oFieldOptions, bSelectDD, bSelect2AC, iRow, sEventField, thisRow);
      }
      else if ("text" == sFieldType)
      {
        scAjaxSetFieldText(sFieldName, oFieldValues, sLookupCons, thisRow, sEventField);
      }
      else if ("color_palette" == sFieldType)
      {
        scAjaxSetFieldColorPalette(sFieldName, oFieldValues);
      }
      else if ("editor_html" == sFieldType)
      {
        scAjaxSetFieldEditorHtml(sFieldName, oFieldValues);
      }
      else if ("imagehtml" == sFieldType)
      {
        scAjaxSetFieldImageHtml(sFieldName, oFieldValues, sImgHtml);
      }
      else if ("innerhtml" == sFieldType)
      {
        scAjaxSetFieldInnerHtml(sFieldName, oFieldValues);
      }
      else if ("multi_upload" == sFieldType)
      {
        scAjaxSetFieldMultiUpload(sFieldName, sMULHtml);
      }
      else if ("recur_info" == sFieldType)
      {
        scAjaxSetFieldRecurInfo(sFieldName, sMULHtml);
      }
      else if ("signature" == sFieldType)
      {
        scAjaxSetFieldSignature(sFieldName, oFieldValues);
      }
      else if ("rating" == sFieldType)
      {
        scAjaxSetFieldRating(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingstar" == sFieldType)
      {
        scAjaxSetFieldRatingStar(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingsmile" == sFieldType)
      {
        scAjaxSetFieldRatingSmile(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingthumb" == sFieldType)
      {
        scAjaxSetFieldRatingThumb(sFieldName, oFieldValues, thisRow);
      }
      scAjaxUpdateHeaderFooter(sFieldName, oFieldValues);
    }
  } // scAjaxSetFields

  function scAjaxUpdateHeaderFooter(sFieldName, oFieldValues)
  {
    if (self.updateHeaderFooter)
    {
      if (null == oFieldValues)
      {
        sNewValue = '';
      }
      else if (oFieldValues[0]["label"])
      {
        sNewValue = oFieldValues[0]["label"];
      }
      else
      {
        sNewValue = oFieldValues[0]["value"];
      }
      updateHeaderFooter(sFieldName, scAjaxSpecCharParser(sNewValue));
    }
  } // scAjaxUpdateHeaderFooter

  function scAjaxSetFieldText(sFieldName, oFieldValues, sLookupCons, thisRow, sEventField)
  {
    if (document.F1.elements[sFieldName])
    {
      var jqField = $("#id_sc_field_" + sFieldName),
          Temp_text = scAjaxReturnBreakLine(scAjaxSpecCharParser(scAjaxProtectBreakLine(oFieldValues[0]['value'])));
      if (jqField.length)
      {
        jqField.val(Temp_text);
        if (sEventField != sFieldName && sEventField != "__SC_NO_FIELD" && sEventField != "")
        {
          //jqField.trigger("change");
        }
      }
      else
      {
        eval("document.F1." + sFieldName + ".value = Temp_text");
      }
      if (scEventControl_data[sFieldName]) {
        scEventControl_data[sFieldName]["calculated"] = Temp_text;
      }
    }
    if (document.getElementById("id_lookup_" + sFieldName))
    {
      document.getElementById("id_lookup_" + sFieldName).innerHTML = sLookupCons;
    }
    if (oFieldValues[0]['label'])
    {
      scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues);
    }
    else
    {
      oFieldValues[0]['value'] = scAjaxBreakLine(oFieldValues[0]['value']);
      scAjaxSetReadonlyValue(sFieldName, oFieldValues[0]['value']);
    }
        scAjaxSetSliderValue(sFieldName, thisRow);
  } // scAjaxSetFieldText

  function scAjaxSetSliderValue(fieldName, thisRow)
  {
          var sliderObject = $("#sc-ui-slide-" + fieldName);
          if (!sliderObject.length) {
                  return;
          }
          scJQSlideValue(fieldName, thisRow);
  } // scAjaxSetSliderValue

  function scAjaxSetFieldColorPalette(sFieldName, oFieldValues)
  {
    if (document.F1.elements[sFieldName])
    {
        var Temp_text = scAjaxReturnBreakLine(scAjaxSpecCharParser(scAjaxProtectBreakLine(oFieldValues[0]['value'])));
        eval ("document.F1." + sFieldName + ".value = Temp_text");
    }
    if (oFieldValues[0]['label'])
    {
      scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues);
    }
    else
    {
      oFieldValues[0]['value'] = scAjaxBreakLine(oFieldValues[0]['value']);
          setaCorPaleta(sFieldName, oFieldValues[0]['value']);
      scAjaxSetReadonlyValue(sFieldName, oFieldValues[0]['value']);
    }
  } // scAjaxSetFieldColorPalette

  function scAjaxSetFieldSelect(sFieldName, oFieldValues, oFieldOptions, bSelectDD, bSelect2AC, iRow, sEventField, thisRow)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    if (bSelectDD)
    {
        $("#id_sc_field_" + sFieldName).dropdownchecklist("destroy");
    }
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      scAjaxSetFieldText(sFieldNameHtml, oFieldValues, "", "", sEventField);
      return;
    }

    if (null != oFieldOptions)
    {
      $("#id_sc_field_" + sFieldName).children().remove()
      if ("<select" != oFieldOptions.substr(0, 7))
      {
        var $oField = $("#id_sc_field_" + sFieldName);
        if (0 < $oField.length)
        {
          $oField.html(oFieldOptions);
        }
        else
        {
          document.getElementById("idAjaxSelect_" + sFieldName).innerHTML = oFieldOptions;
        }
      }
      else
      {
        document.getElementById("idAjaxSelect_" + sFieldName).innerHTML = oFieldOptions;
      }
    }
    var aValues = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    var oFormField = $("#id_sc_field_" + sFieldName);
    for (iFieldSelect = 0; iFieldSelect < oFormField[0].length; iFieldSelect++)
    {
      if (scAjaxInArray(oFormField[0].options[iFieldSelect].value, aValues))
      {
        oFormField[0].options[iFieldSelect].selected = true;
      }
      else
      {
        oFormField[0].options[iFieldSelect].selected = false;
      }
    }
        scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
    if (bSelectDD)
    {
        scJQDDCheckBoxAdd(thisRow, true);
    }
        if (bSelect2AC)
        {
                var newOption = new Option(oFieldValues[0]["label"], oFieldValues[0]["value"], true, true);
                $("#id_ac_" + sFieldName).append(newOption);
                $("#id_sc_field_" + sFieldName).val(oFieldValues[0]["value"]);
        }
        else if (oFormField.hasClass("select2-hidden-accessible"))
        {
        $("#id_sc_field_" + sFieldName).select2("destroy");
                var select2Field = sFieldName;
                if ("" != thisRow) {
                        select2Field = select2Field.substr(0, select2Field.length - thisRow.toString().length);
                }
        scJQSelect2Add(thisRow, select2Field);
        }
  } // scAjaxSetFieldSelect

  function scAjaxSetFieldDuplosel(sFieldName, oFieldValues, oFieldOptions)
  {
    var sFieldNameOrig = sFieldName + "_orig";
    var sFieldNameDest = sFieldName + "_dest";
    var oFormFieldOrig = document.F1.elements[sFieldNameOrig];
    var oFormFieldDest = document.F1.elements[sFieldNameDest];

    if (null != oFieldOptions)
    {
      scAjaxClearSelect(sFieldNameOrig);
      for (iFieldSelect = 0; iFieldSelect < oFieldOptions.length; iFieldSelect++)
      {
        oFormFieldOrig.options[iFieldSelect] = new Option(scAjaxSpecCharParser(oFieldOptions[iFieldSelect]["label"]), scAjaxSpecCharParser(oFieldOptions[iFieldSelect]["value"]));
      }
    }
    while (oFormFieldDest.length > 0)
    {
      oFormFieldDest.options[0] = null;
    }
    var aValues = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        sNewOptionLabel = oFieldValues[iFieldSelect]["label"] ? scAjaxSpecCharParser(oFieldValues[iFieldSelect]["label"]) : scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
        sNewOptionValue = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
        if (sNewOptionValue.substr(0, 8) == "@NMorder")
        {
           sNewOptionValue                      = sNewOptionValue.substr(8);
           oFormFieldDest.options[iFieldSelect] = new Option(scAjaxSpecCharParser(sNewOptionLabel), sNewOptionValue);
           sNewOptionValue                      = sNewOptionValue.substr(1);
           aValues[iFieldSelect]                = sNewOptionValue;
        }
        else
        {
           aValues[iFieldSelect]                = sNewOptionValue;
           oFormFieldDest.options[iFieldSelect] = new Option(scAjaxSpecCharParser(sNewOptionLabel), sNewOptionValue);
        }
      }
    }
    for (iFieldSelect = 0; iFieldSelect < oFormFieldOrig.length; iFieldSelect++)
    {
      oFormFieldOrig.options[iFieldSelect].selected = false;
      if (scAjaxInArray(oFormFieldOrig.options[iFieldSelect].value, aValues))
      {
        oFormFieldOrig.options[iFieldSelect].disabled    = true;
        oFormFieldOrig.options[iFieldSelect].style.color = "#A0A0A0";
      }
      else
      {
        oFormFieldOrig.options[iFieldSelect].disabled = false;
      }
    }
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldDuplosel

  function scAjaxSetFieldCheckbox(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sInnerHtml, sOptComp, sOptClass, sOptMulti, bSwitch, sEventField)
  {
        if (null == bSwitch)
        {
          bSwitch = false;
        }
    if (document.getElementById("idAjaxCheckbox_" + sFieldName) && null != sInnerHtml)
    {
      document.getElementById("idAjaxCheckbox_" + sFieldName).innerHTML = sInnerHtml;
      return;
    }
    if (null != oFieldOptions)
    {
        scAjaxClearCheckbox(sFieldName);
    }
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      scAjaxSetFieldText(sFieldName, oFieldValues, "", "", sEventField);
      return;
    }
    if (null != oFieldOptions && "" != oFieldOptions)
    {
/*      scAjaxClearCheckbox(sFieldName); */
      scAjaxRecreateOptions("Checkbox", "checkbox", sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, sOptClass, sOptMulti, bSwitch);
    }
    else
    {
      scAjaxSetCheckboxOptions(sFieldName, oFieldValues);
    }
        scAjaxSetSwitchOptions(sFieldName, "checkbox");
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldCheckbox

  function scAjaxSetFieldRadio(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, bSwitch, sEventField)
  {
        if (null == bSwitch)
        {
          bSwitch = false;
        }
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      scAjaxSetFieldText(sFieldName, oFieldValues, "", "", sEventField);
      return;
    }
    if (null != oFieldOptions)
    {
        scAjaxClearRadio(sFieldName);
    }
    if (null != oFieldOptions && "" != oFieldOptions)
    {
/*      scAjaxClearRadio(sFieldName); */
      scAjaxRecreateOptions("Radio", "radio", sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, "", "", bSwitch);
    }
    else
    {
      scAjaxSetRadioOptions(sFieldName, oFieldValues);
    }
        scAjaxSetSwitchOptions(sFieldName, "radio");
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldRadio

  function scAjaxSetSwitchOptions(fieldName, fieldType)
  {
        var fieldOptions = $(".sc-ui-" + fieldType + "-" + fieldName + ".lc-switch");
        if (!fieldOptions.length) {
                return;
        }
        for (var i = 0; i < fieldOptions.length; i++) {
                if ($(fieldOptions[i]).prop("checked")) {
                        $(fieldOptions[i]).lcs_on();
                }
                else {
                        $(fieldOptions[i]).lcs_off();
                }
        }
  }

  function scAjaxSetFieldLabel(sFieldName, oFieldValues, oFieldOptions, sLookupCons)
  {
    sFieldValue = oFieldValues[0]["value"];
    if ("undefined" == typeof oFieldValues[0]["label"]) {
      sFieldLabel = oFieldValues[0]["value"];
    } else {
      sFieldLabel = oFieldValues[0]["label"];
    }
    sFieldLabel = scAjaxBreakLine(sFieldLabel);
    if (null != oFieldOptions)
    {
      for (iRecreate = 0; iRecreate < oFieldOptions.length; iRecreate++)
      {
        sOptText  = scAjaxSpecCharParser(oFieldOptions[iRecreate]["value"]);
        sOptValue = scAjaxSpecCharParser(oFieldOptions[iRecreate]["label"]);
        if (sFieldValue == sOptText)
        {
          sFieldLabel = sOptValue;
        }
      }
    }
    if (document.getElementById("id_ajax_label_" + sFieldName))
    {
      document.getElementById("id_ajax_label_" + sFieldName).innerHTML = scAjaxSpecCharParser(sFieldLabel);
    }
    if (document.F1.elements[sFieldName])
    {
//      document.F1.elements[sFieldName].value = scAjaxSpecCharParser(sFieldValue);
        Temp_text = scAjaxProtectBreakLine(sFieldValue);
        Temp_text = scAjaxSpecCharParser(Temp_text);
        document.F1.elements[sFieldName].value = scAjaxReturnBreakLine(Temp_text);

    }
    if (document.getElementById("id_lookup_" + sFieldName))
    {
      document.getElementById("id_lookup_" + sFieldName).innerHTML = sLookupCons;
    }
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(sFieldLabel));
  } // scAjaxSetFieldLabel

  function scAjaxSetFieldImage(sFieldName, oFieldValues, sImgFile, sImgOrig, sImgLink, sKeepImg, sHideName)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    if ("N" == sKeepImg && document.getElementById("id_ajax_img_"  + sFieldName))
    {
      document.getElementById("id_ajax_img_"  + sFieldName).src           = scAjaxSpecCharParser(sImgFile);
      document.getElementById("id_ajax_img_"  + sFieldName).style.display = ("" == sImgFile) ? "none" : "";
    }
    if (document.getElementById("id_ajax_link_" + sFieldName) && null != sImgLink)
    {
      document.getElementById("id_ajax_link_" + sFieldName).innerHTML = oFieldValues[0]["value"];
      document.getElementById("id_ajax_link_" + sFieldName).href      = scAjaxSpecCharParser(sImgLink);
    }
    if (document.getElementById("chk_ajax_img_" + sFieldName))
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = ("" == oFieldValues[0]["value"]) ? "none" : "";
    }
    if ("" == oFieldValues[0]["value"] && document.F1.elements[sFieldName + "_limpa"])
    {
      document.F1.elements[sFieldName + "_limpa"].checked = false;
    }
    if ("N" == sKeepImg && document.getElementById("txt_ajax_img_" + sFieldName))
    {
      document.getElementById("txt_ajax_img_" + sFieldName).innerHTML     = oFieldValues[0]["value"];
      document.getElementById("txt_ajax_img_" + sFieldName).style.display = ("" == oFieldValues[0]["value"] || "S" == sHideName) ? "none" : "";
    }
    if ("" != sImgOrig)
    {
      eval("if (var_ajax_img_" + sFieldName + ") var_ajax_img_" + sFieldName + " = '" + sImgOrig + "';");
      if (document.F1.elements["temp_out1_" + sFieldName])
      {
        document.F1.elements["temp_out_" + sFieldName].value = sImgFile;
        document.F1.elements["temp_out1_" + sFieldName].value = sImgOrig;
      }
      else if (document.F1.elements["temp_out_" + sFieldName])
      {
        document.F1.elements["temp_out_" + sFieldName].value = sImgOrig;
      }
    }
    if ("" != oFieldValues[0]["value"])
    {
      if (document.F1.elements[sFieldName + "_salva"]) document.F1.elements[sFieldName + "_salva"].value = oFieldValues[0]["value"];
    }
    else if (oResp && oResp["ajaxRequest"] && "navigate_form" == oResp["ajaxRequest"])
    {
      if (document.F1.elements[sFieldName + "_salva"]) document.F1.elements[sFieldName + "_salva"].value = "";
    }
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldImage

  function scAjaxSetFieldDocument(sFieldName, oFieldValues, sDocLink, sDocIcon, sClearUpload, sDocReadonly)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    document.getElementById("id_ajax_doc_"  + sFieldName).innerHTML = scAjaxSpecCharParser(sDocLink);
    if (document.getElementById("id_ajax_doc_icon_"  + sFieldName))
    {
      document.getElementById("id_ajax_doc_icon_"  + sFieldName).src = scAjaxSpecCharParser(sDocIcon);
    }
    if ("" == oFieldValues[0]["value"])
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = "none";
      document.getElementById("id_ajax_doc_" + sFieldName).style.display = "none";
    }
    else
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = "";
      document.getElementById("id_ajax_doc_" + sFieldName).style.display = "";
    }
    if ("" == oFieldValues[0]["value"] && document.F1.elements[sFieldName + "_limpa"])
    {
      document.F1.elements[sFieldName + "_limpa"].checked = false;
    }
    if ("S" == sClearUpload && document.F1.elements[sFieldName + "_ul_name"])
    {
      document.F1.elements[sFieldName + "_ul_name"].value = "";
    }
    if ("" != sDocLink && sDocReadonly == "S")
    {
      scAjaxSetReadonlyValue(sFieldName, sDocLink);
    }
    else
    {
      scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
    }
  } // scAjaxSetFieldDocument

  function scAjaxSetFieldInnerHtml(sFieldName, oFieldValues)
  {
    if (document.getElementById(sFieldName))
    {
      document.getElementById(sFieldName).innerHTML = scAjaxSpecCharParser(oFieldValues[0]["value"]);
    }
  } // scAjaxSetFieldInnerHtml

  function scAjaxSetFieldMultiUpload(sFieldName, sMULHtml)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    $("#id_sc_loaded_" + sFieldName).html(scAjaxSpecCharParser(sMULHtml));
  } // scAjaxSetFieldMultiUpload

  function scAjaxExecFieldEditorHtml(strOption, bolUI, oField)
  {
                  if(tinymce.majorVersion > 3)
                {
                        if(strOption == 'mceAddControl')
                        {
                                tinymce.execCommand('mceAddEditor', bolUI, oField);
                        }else
                        if(strOption == 'mceRemoveControl')
                        {
                                tinymce.execCommand('mceRemoveEditor', bolUI, oField);
                        }
                }
                else
                {
                        tinyMCE.execCommand(strOption, bolUI, oField);
                }
  }

  function scAjaxSetFieldEditorHtml(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName])
    {
      return;
    }
        if(tinymce.majorVersion > 3)
        {
                var oFormField = tinyMCE.get(sFieldName);
        }
        else
        {
                var oFormField = tinyMCE.getInstanceById(sFieldName);
        }
    oFormField.setContent(scAjaxSpecCharParser(oFieldValues[0]["value"]));
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldEditorHtml

  function scAjaxSetFieldImageHtml(sFieldName, oFieldValues, sImgHtml)
  {
    if (document.getElementById("id_imghtml_" + sFieldName))
    {
      document.getElementById("id_imghtml_" + sFieldName).innerHTML = scAjaxSpecCharParser(sImgHtml);
    }
  } // scAjaxSetFieldEditorHtml

  function scAjaxSetFieldRecurInfo(sFieldName, oFieldValues)
  {
          var jsonData = "" != oFieldValues[0]["value"]
                       ? JSON.parse(oFieldValues[0]["value"])
                                   : { repeat: "1", endon: "E", endafter: "", endin: ""};
          $("#id_rinf_repeat_" + sFieldName).val(jsonData.repeat);
          $(".cl_rinf_endon_" + sFieldName).filter(function(index) {return $(this).val() == jsonData.endon}).prop("checked", true),
          $("#id_rinf_endafter_" + sFieldName).val(jsonData.endafter);
          $("#id_rinf_endin_" + sFieldName).val(jsonData.endin);
          scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldRecurInfo

  function scAjaxSetFieldSignature(sFieldName, oFieldValues)
  {
        var fieldValue = scAjaxSpecCharParser(oFieldValues[0]['value']);
        if ("data:image/png;base64," != fieldValue.substr(0, 22) && "data:image/jsignature;base30," != fieldValue.substr(0, 29))
        {
                scJQSignatureClear(sFieldName);
                return;
        }
        $("#id_sc_field_" + sFieldName).val(fieldValue);
        scJQSignatureRedraw(sFieldName);
         scFormHasChanged = false; // mantis 0020638
  } // scAjaxSetFieldSignature

  function scAjaxSetFieldRating(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingStar(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingStarRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingSmile(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingSmileRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingThumb(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingThumbRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetCheckboxOptions(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"] && !document.F1.elements[sFieldName + "[0]"])
    {
      return;
    }
    var aValues    = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    if (document.F1.elements[sFieldName + "[]"])
    {
      var oFormField = document.F1.elements[sFieldName + "[]"];
      if (oFormField.length)
      {
        for (iFieldCheckbox = 0; iFieldCheckbox < oFormField.length; iFieldCheckbox++)
        {
          if (scAjaxInArray(oFormField[iFieldCheckbox].value, aValues))
          {
            oFormField[iFieldCheckbox].checked = true;
          }
          else
          {
            oFormField[iFieldCheckbox].checked = false;
          }
        }
      }
      else
      {
        if (scAjaxInArray(oFormField.value, aValues))
        {
          oFormField.checked = true;
        }
        else
        {
          oFormField.checked = false;
        }
      }
    }
    else if (document.F1.elements[sFieldName + "[0]"])
    {
      for (iFieldCheckbox = 0; iFieldCheckbox < document.F1.elements.length; iFieldCheckbox++)
      {
        oFormElement = document.F1.elements[iFieldCheckbox];
        if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1) && scAjaxInArray(oFormElement.value, aValues))
        {
          oFormElement.checked = true;
        }
        else if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1))
        {
          oFormElement.checked = false;
        }
      }
    }
    else
    {
      oFormElement = document.F1.elements[sFieldName];
      if (scAjaxInArray(oFormElement.value, aValues))
      {
        oFormElement.checked = true;
      }
      else
      {
        oFormElement.checked = false;
      }
    }
  } // scAjaxSetCheckboxOptions

  function scAjaxSetRadioOptions(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName])
    {
      return;
    }
    var oFormField = document.F1.elements[sFieldName];
    var aValues    = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
    {
      oFormField[iFieldRadio].checked = false;
    }
    for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
    {
      if (scAjaxInArray(oFormField[iFieldRadio].value, aValues))
      {
        oFormField[iFieldRadio].checked = true;
      }
    }
  } // scAjaxSetRadioOptions

  function scAjaxSetReadonlyValue(sFieldName, sFieldValue)
  {
    if (document.getElementById("id_read_on_" + sFieldName))
    {
      document.getElementById("id_read_on_" + sFieldName).innerHTML = sFieldValue;
    }
  } // scAjaxSetReadonlyValue

  function scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, sDelim)
  {
    if (null == oFieldValues)
    {
      return;
    }
    if (null == sDelim)
    {
      sDelim = " ";
    }
    sReadLabel = "";
    for (iReadArray = 0; iReadArray < oFieldValues.length; iReadArray++)
    {
      if (oFieldValues[iReadArray]["label"])
      {
        if ("" != sReadLabel)
        {
          sReadLabel += sDelim;
        }
        sReadLabel += oFieldValues[iReadArray]["label"];
      }
      else if (oFieldValues[iReadArray]["value"])
      {
        if ("" != sReadLabel)
        {
          sReadLabel += sDelim;
        }
        sReadLabel += oFieldValues[iReadArray]["value"];
      }
    }
    scAjaxSetReadonlyValue(sFieldName, sReadLabel);
  } // scAjaxSetReadonlyArrayValue

  function scAjaxGetFieldValue(sFieldGet)
  {
    sValue = "";
    if (!oResp["fldList"])
    {
      return sValue;
    }
    for (iFieldValue = 0; iFieldValue < oResp["fldList"].length; iFieldValue++)
    {
      var sFieldName  = oResp["fldList"][iFieldValue]["fldName"];
      if (oResp["fldList"][iFieldValue]["valList"])
      {
        var oFieldValues = oResp["fldList"][iFieldValue]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (sFieldGet == sFieldName && null != oFieldValues)
      {
        if (1 == oFieldValues.length)
        {
          sValue = scAjaxSpecCharParser(oFieldValues[0]["value"]);
        }
        else
        {
          sValue = new Array();
          for (jFieldValue = 0; jFieldValue < oFieldValues.length; jFieldValue++)
          {
            sValue[jFieldValue] = scAjaxSpecCharParser(oFieldValues[jFieldValue]["value"]);
          }
        }
      }
    }
    return sValue;
  } // scAjaxGetFieldValue

  function scAjaxGetKeyValue(sFieldGet)
  {
    sValue = "";
    if (!oResp["fldList"])
    {
      return sValue;
    }
    for (iKeyValue = 0; iKeyValue < oResp["fldList"].length; iKeyValue++)
    {
      var sFieldName = oResp["fldList"][iKeyValue]["fldName"];
      if (sFieldGet == sFieldName)
      {
        if (oResp["fldList"][iKeyValue]["keyVal"])
        {
          return scAjaxSpecCharParser(oResp["fldList"][iKeyValue]["keyVal"]);
        }
        else
        {
          return scAjaxGetFieldValue(sFieldGet);
        }
      }
    }
    return sValue;
  } // scAjaxGetKeyValue

  function scAjaxGetLineNumber()
  {
    sLineNumber = "";
    if (oResp["errList"])
    {
      for (iLineNumber = 0; iLineNumber < oResp["errList"].length; iLineNumber++)
      {
        if (oResp["errList"][iLineNumber]["numLinha"])
        {
          sLineNumber = oResp["errList"][iLineNumber]["numLinha"];
        }
      }
      return sLineNumber;
    }
    if (oResp["fldList"])
    {
      return oResp["fldList"][0]["numLinha"];
    }
    if (oResp["msgDisplay"])
    {
      return oResp["msgDisplay"]["numLinha"];
    }
    return sLineNumber;
  } // scAjaxGetLineNumber

  function scAjaxFieldExists(sFieldGet)
  {
    bExists = false;
    if (!oResp["fldList"])
    {
      return bExists;
    }
    for (iFieldValue = 0; iFieldValue < oResp["fldList"].length; iFieldValue++)
    {
      var sFieldName  = oResp["fldList"][iFieldValue]["fldName"];
      if (oResp["fldList"][iFieldValue]["valList"])
      {
        var oFieldValues = oResp["fldList"][iFieldValue]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (sFieldGet == sFieldName && null != oFieldValues)
      {
        bExists = true;
      }
    }
    return bExists;
  } // scAjaxFieldExists

  function scAjaxGetFieldText(sFieldName)
  {
    $oHidden = $("input[name='" + sFieldName + "']");
    if (!$oHidden.length)
    {
      $oHidden = $("input[name='" + sFieldName + "_']");
    }
    if ($oHidden.length)
    {
      for (var i = 0; i < $oHidden.length; i++)
      {
        if ("hidden" == $oHidden[i].type && $oHidden[i].form && $oHidden[i].form.name && "F1" == $oHidden[i].form.name)
        {
          return scAjaxSpecCharProtect($oHidden[i].value);//.replace(/[+]/g, "__NM_PLUS__");
        }
      }
    }
    $oField = $("#id_sc_field_" + sFieldName);
    if(!$oField.length)
    {
      $oField = $("#id_sc_field_" + sFieldName + "_");
    }
    if ($oField.length && "select" != $oField[0].type.substr(0, 6))
    {
      return scAjaxSpecCharProtect($oField.val());//.replace(/[+]/g, "__NM_PLUS__");
    }
    else if (document.F1.elements[sFieldName])
    {
      return scAjaxSpecCharProtect(document.F1.elements[sFieldName].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else if (document.F1.elements[sFieldName + '_'])
    {
      return scAjaxSpecCharProtect(document.F1.elements[sFieldName + '_'].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else
    {
      return '';
    }
  } // scAjaxGetFieldText

  function scAjaxGetFieldHidden(sFieldName)
  {
    for( i= 0; i < document.F1.elements.length; i++)
    {
       if (document.F1.elements[i].name == sFieldName)
       {
          return scAjaxSpecCharProtect(document.F1.elements[i].value);//.replace(/[+]/g, "__NM_PLUS__");
       }
    }
//    return document.F1.elements[sFieldName].value.replace(/[+]/g, "__NM_PLUS__");
  } // scAjaxGetFieldHidden

  function scAjaxGetFieldSelect(sFieldName)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return "";
    }
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      return scAjaxGetFieldHidden(sFieldNameHtml);
    }
    var oFormField = document.F1.elements[sFieldNameHtml];
    var iSelected  = oFormField.selectedIndex;
    if (-1 < iSelected)
    {
      return scAjaxSpecCharProtect(oFormField.options[iSelected].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else
    {
      return "";
    }
  } // scAjaxGetFieldSelect

  function scAjaxGetFieldSelectMult(sFieldName, sFieldDelim)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      return scAjaxGetFieldHidden(sFieldNameHtml);
    }
    var oFormField = document.F1.elements[sFieldNameHtml];
    var sFieldVals = "";
    for (iFieldSelect = 0; iFieldSelect < oFormField.length; iFieldSelect++)
    {
      if (oFormField[iFieldSelect].selected)
      {
        if ("" != sFieldVals)
        {
          sFieldVals += sFieldDelim;
        }
        sFieldVals += scAjaxSpecCharProtect(oFormField[iFieldSelect].value);//.replace(/[+]/g, "__NM_PLUS__");
      }
    }
    return sFieldVals;
  } // scAjaxGetFieldSelectMult

  function scAjaxGetFieldCheckbox(sFieldName, sDelim)
  {
    var aValues = new Array();
    var sValue  = "";
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"] && !document.F1.elements[sFieldName + "[0]"])
    {
      return sValue;
    }
    if (document.F1.elements[sFieldName + "[]"] && "hidden" == document.F1.elements[sFieldName + "[]"].type)
    {
      return scAjaxGetFieldHidden(sFieldName + "[]");
    }
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    if (document.F1.elements[sFieldName + "[]"])
    {
      var oFormField = document.F1.elements[sFieldName + "[]"];
      if (oFormField.length)
      {
        for (iFieldCheck = 0; iFieldCheck < oFormField.length; iFieldCheck++)
        {
          if (oFormField[iFieldCheck].checked)
          {
            aValues[aValues.length] = oFormField[iFieldCheck].value;
          }
        }
      }
      else
      {
        if (oFormField.checked)
        {
          aValues[aValues.length] = oFormField.value;
        }
      }
    }
    else
    {
      for (iFieldCheck = 0; iFieldCheck < document.F1.elements.length; iFieldCheck++)
      {
        oFormElement = document.F1.elements[iFieldCheck];
        if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1) && oFormElement.checked)
        {
          aValues[aValues.length] = oFormElement.value;
        }
        else if (sFieldName == oFormElement.name && oFormElement.checked)
        {
          aValues[aValues.length] = oFormElement.value;
        }
      }
    }
    for (iFieldCheck = 0; iFieldCheck < aValues.length; iFieldCheck++)
    {
      sValue += scAjaxSpecCharProtect(aValues[iFieldCheck]);//.replace(/[+]/g, "__NM_PLUS__");
      if (iFieldCheck + 1 != aValues.length)
      {
        sValue += sDelim;
      }
    }
    return sValue;
  } // scAjaxGetFieldCheckbox

  function scAjaxGetFieldRadio(sFieldName)
  {
    if ("hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    var sValue = "";
    if (!document.F1.elements[sFieldName])
    {
      return sValue;
    }
    var oFormField = document.F1.elements[sFieldName];
    if (!oFormField.length)
    {
        var sc_cmp_radio = eval("document.F1." + sFieldName);
        if (sc_cmp_radio.checked)
        {
           sValue = scAjaxSpecCharProtect(sc_cmp_radio.value);//.replace(/[+]/g, "__NM_PLUS__");
        }
    }
    else
    {
      for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
      {
        if (oFormField[iFieldRadio].checked)
        {
          sValue = scAjaxSpecCharProtect(oFormField[iFieldRadio].value);//.replace(/[+]/g, "__NM_PLUS__");
        }
      }
    }
    return sValue;
  } // scAjaxGetFieldRadio

  function scAjaxGetFieldEditorHtml(sFieldName)
  {
    if ("hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    var sValue = "";
    if (!document.F1.elements[sFieldName])
    {
      return sValue;
    }

        if(tinymce.majorVersion > 3)
        {
                var oFormField = tinyMCE.get(sFieldName);
        }
        else
        {
                var oFormField = tinyMCE.getInstanceById(sFieldName);
        }
    return scAjaxSpecCharParser(scAjaxSpecCharProtect(oFormField.getContent()));//.replace(/[+]/g, "__NM_PLUS__"));
  } // scAjaxGetFieldEditorHtml

  function scAjaxGetFieldSignature(sFieldName)
  {
    var signatureData = $("#sc-id-sign-" + sFieldName).jSignature("getData", "base30");
        $("#id_sc_field_" + sFieldName).val("data:" + signatureData[0] + "," + signatureData[1]);
        return $("#id_sc_field_" + sFieldName).val();
  } // scAjaxGetFieldEditorHtml

  function scAjaxGetFieldRecurInfo(sFieldName)
  {
          var repeatInList = $(".cl_rinf_repeatin_" + sFieldName).filter(":checked"), repeatInValues = [], jsonData, i;
          for (i = 0; i < repeatInList.length; i++) {
                  repeatInValues.push($(repeatInList[i]).val());
          }
          jsonData = {
                  repeat: $("#id_rinf_repeat_" + sFieldName).val(),
                  repeatin: repeatInValues.join(";"),
                  endon: $(".cl_rinf_endon_" + sFieldName).filter(":checked").val(),
                  endafter: $("#id_rinf_endafter_" + sFieldName).val(),
                  endin: $("#id_rinf_endin_" + sFieldName).val()
          };
          return JSON.stringify(jsonData);
  } // scAjaxGetFieldRecurInfo

  function scAjaxDoNothing(e)
  {
  } // scAjaxDoNothing

  function scAjaxInArray(mVal, aList)
  {
    for (iInArray = 0; iInArray < aList.length; iInArray++)
    {
      if (aList[iInArray] == mVal)
      {
        return true;
      }
    }
    return false;
  } // scAjaxInArray

  function scAjaxSpecCharParser(sParseString)
  {
    if (null == sParseString) {
      return "";
    }
    var ta = document.createElement("textarea");
    ta.innerHTML = sParseString.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    return ta.value;
  } // scAjaxSpecCharParser

  function scAjaxSpecCharProtect(sOriginal)
  {
        var sProtected;
        sProtected = sOriginal.replace(/[+]/g, "__NM_PLUS__");
        sProtected = sProtected.replace(/[%]/g, "__NM_PERC__");
        return sProtected;
  } // scAjaxSpecCharProtect

  function scAjaxRecreateOptions(sFieldType, sHtmlType, sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, sOptClass, sOptMulti, bSwitch)
  {
    var sSuffix  = ("checkbox" == sHtmlType) ? "[]" : "";
    var sDivName = "idAjax" + sFieldType + "_" + sFieldName;
    var sDivText = "";
    var iCntLine = 0;
    var aValues  = new Array();
    var sClass;
    var markChangedClass;
    if (null != oFieldValues)
    {
      for (iRecreate = 0; iRecreate < oFieldValues.length; iRecreate++)
      {
        aValues[iRecreate] = scAjaxSpecCharParser(oFieldValues[iRecreate]["value"]);
      }
    }
    sDivText += "<table border=0>";
    if ("checkbox" == sHtmlType)
    {
        markChangedClass = "sc-ui-checkbox-" + sFieldName;
    }
    if ("radio" == sHtmlType)
    {
        markChangedClass = "sc-ui-radio-" + sFieldName;
    }
    for (iRecreate = 0; iRecreate < oFieldOptions.length; iRecreate++)
    {
        sOptText  = scAjaxSpecCharParser(oFieldOptions[iRecreate]["label"]);
        sOptValue = scAjaxSpecCharParser(oFieldOptions[iRecreate]["value"]);
        if (0 == iCntLine)
        {
            sDivText += "<tr>";
        }
        iCntLine++;
        if ("" != sOptClass)
        {
            sClass = " class=\"" + sOptClass;
            if ("" != sOptMulti)
            {
                sClass += " " + sOptClass + sOptMulti;
            }
            if ("" != markChangedClass)
            {
                sClass += " " + markChangedClass;
            }
            sClass += "\"";
        }
        else
        {
            sClass = " class=\"";
            if ("" != markChangedClass)
            {
                sClass += " " + markChangedClass;
            }
            sClass += "\"";
        }
        if (sHtmComp == null)
        {
            sHtmComp = "";
        }
        sChecked  = (scAjaxInArray(sOptValue, aValues)) ? " checked" : "";
        sDivText += "<td class=\"scFormDataFontOdd css_" + sFieldName + "_line\">";
                if (bSwitch)
                {
                        sDivText += "<div class=\"sc ";
                        if ("Checkbox" == sFieldType)
                        {
                                sDivText += "switch";
                        }
                        else
                        {
                                sDivText += "radio";
                        }
                        sDivText += "\">";
                }
        sDivText += "<input id=\"id-opt-" + sFieldName + "-"  + iRecreate + "\" type=\"" + sHtmlType + "\" name=\"" + sFieldName + sSuffix + "\" value=\"" + sOptValue + "\"" + sChecked + " " + sHtmComp + " " + sOptComp + sClass + ">";
                if (bSwitch)
                {
                        sDivText += "<span></span>";
                }
        sDivText += "<label for=\"id-opt-" + sFieldName + "-"  + iRecreate + "\">" + sOptText + "</label>";
                if (bSwitch)
                {
                        sDivText += "</div>";
                }
        sDivText += "</td>";
        if (iColNum == iCntLine)
        {
            sDivText += "</tr>";
            iCntLine  = 0;
        }
    }
    sDivText += "</table>";
    document.getElementById(sDivName).innerHTML = sDivText;
    if ("" != markChangedClass)
    {
      $("." + markChangedClass).on("click", function() { scMarkFormAsChanged(); });
    }
  } // scAjaxRecreateOptions

  function scAjaxProcOn(bForce)
  {
    if (null == bForce)
    {
      bForce = false;
    }
    if (document.getElementById("id_div_process"))
    {
      if ($ && $.blockUI && !bForce)
      {
        $.blockUI({
          message: $("#id_div_process_block"),
          overlayCSS: { backgroundColor: sc_ajaxBg },
          css: {
            borderColor: sc_ajaxBordC,
            borderStyle: sc_ajaxBordS,
            borderWidth: sc_ajaxBordW
          }
        });
      }
      else
      {
        document.getElementById("id_div_process").style.display = "";
        document.getElementById("id_fatal_error").style.display = "none";
        if (null != scCenterElement)
        {
          scCenterElement(document.getElementById("id_div_process"));
        }
      }
    }
  } // scAjaxProcOn

  function scAjaxProcOff(bForce)
  {
    if (null == bForce)
    {
      bForce = false;
    }
    if (document.getElementById("id_div_process"))
    {
      if ($ && $.unblockUI && !bForce)
      {
        $.unblockUI();
      }
      else
      {
        document.getElementById("id_div_process").style.display = "none";
      }
    }
  } // scAjaxProcOff

  function scAjaxSetMaster()
  {
    if (!oResp["masterValue"])
    {
      return;
    }
        if (scMasterDetailParentIframe && "" != scMasterDetailParentIframe)
        {
      var dbParentFrame = $(parent.document).find("[name='" + scMasterDetailParentIframe + "']");
          if (!dbParentFrame || !dbParentFrame[0] || !dbParentFrame[0].contentWindow.scAjaxDetailValue)
          {
                return;
          }
      for (iMaster = 0; iMaster < oResp["masterValue"].length; iMaster++)
      {
        dbParentFrame[0].contentWindow.scAjaxDetailValue(oResp["masterValue"][iMaster]["index"], oResp["masterValue"][iMaster]["value"]);
      }
        }
    if (!parent || !parent.scAjaxDetailValue)
    {
      return;
    }
    for (iMaster = 0; iMaster < oResp["masterValue"].length; iMaster++)
    {
      parent.scAjaxDetailValue(oResp["masterValue"][iMaster]["index"], oResp["masterValue"][iMaster]["value"]);
    }
  } // scAjaxSetMaster

  function scAjaxSetFocus()
  {
    if (!oResp["setFocus"] && '' == scFocusFirstErrorName)
    {
      return;
    }
    sFieldName = oResp["setFocus"];
    if (document.F1.elements[sFieldName])
    {
        scFocusField(sFieldName);
    }
    scAjaxFocusError();
  } // scAjaxSetFocus

  function scAjaxFocusError()
  {
    if ('' != scFocusFirstErrorName)
    {
      scFocusField(scFocusFirstErrorName);
      scFocusFirstErrorName = '';
    }
  } // scAjaxFocusError

  function scAjaxSetNavStatus(sBarPos)
  {
    if (!oResp["navStatus"])
    {
      return;
    }
    sNavRet = "S";
    sNavAva = "S";
    if (oResp["navStatus"]["ret"])
    {
      sNavRet = oResp["navStatus"]["ret"];
    }
    if (oResp["navStatus"]["ava"])
    {
      sNavAva = oResp["navStatus"]["ava"];
    }
    if ("S" != sNavRet && "N" != sNavRet)
    {
      sNavRet = "S";
    }
    if ("S" != sNavAva && "N" != sNavAva)
    {
      sNavAva = "S";
    }
    Nav_permite_ret = sNavRet;
    Nav_permite_ava = sNavAva;
    nav_atualiza(Nav_permite_ret, Nav_permite_ava, sBarPos);
  } // scAjaxSetNavStatus

  function scAjaxSetSummary()
  {
    if (!oResp["navSummary"])
    {
      return;
    }
    sreg_ini = oResp["navSummary"].reg_ini;
    sreg_qtd = oResp["navSummary"].reg_qtd;
    sreg_tot = oResp["navSummary"].reg_tot;
    summary_atualiza(sreg_ini, sreg_qtd, sreg_tot);
  } // scAjaxSetSummary

  function scAjaxSetNavpage()
  {
    navpage_atualiza(oResp["navPage"]);
  } // scAjaxSetNavpage


  function scAjaxRedir(oTemp)
  {
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (!oResp["redirInfo"])
    {
      return;
    }
    sMetodo = oResp["redirInfo"]["metodo"];
    sAction = oResp["redirInfo"]["action"];
    if ("location" == sMetodo)
    {
      if ("parent.parent" == oResp["redirInfo"]["target"])
      {
        parent.parent.location = sAction;
      }
      else if ("parent" == oResp["redirInfo"]["target"])
      {
        parent.location = sAction;
      }
      else if ("_blank" == oResp["redirInfo"]["target"])
      {
        window.open(sAction, "_blank");
      }
      else
      {
        document.location = sAction;
      }
    }
    else if ("html" == sMetodo)
    {
        document.write(scAjaxSpecCharParser(oResp["redirInfo"]["action"]));
    }
    else
    {
      if (oResp["redirInfo"]["target"] == "modal")
      {
          tb_show('', sAction + '?script_case_init=' +  oResp["redirInfo"]["script_case_init"] + '&script_case_session=<?php echo session_id() ?>&nmgp_parms=' + oResp["redirInfo"]["nmgp_parms"] + '&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&TB_iframe=true&modal=true&height=' +  oResp["redirInfo"]["h_modal"] + '&width=' + oResp["redirInfo"]["w_modal"], '');
          return;
      }
      sFormRedir = (oResp["redirInfo"]["nmgp_outra_jan"]) ? "form_ajax_redir_1" : "form_ajax_redir_2";
      document.forms[sFormRedir].action           = sAction;
      document.forms[sFormRedir].target           = oResp["redirInfo"]["target"];
      document.forms[sFormRedir].nmgp_parms.value = oResp["redirInfo"]["nmgp_parms"];
      if ("form_ajax_redir_1" == sFormRedir)
      {
        document.forms[sFormRedir].nmgp_outra_jan.value = oResp["redirInfo"]["nmgp_outra_jan"];
      }
      else
      {
        document.forms[sFormRedir].nmgp_url_saida.value   = oResp["redirInfo"]["nmgp_url_saida"];
        document.forms[sFormRedir].script_case_init.value = oResp["redirInfo"]["script_case_init"];
      }
      document.forms[sFormRedir].submit();
    }
  } // scAjaxRedir

  function scAjaxSetDisplay(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    var aDispData = new Array();
    var aDispCont = {};
    var vertButton;
    if (bReset)
    {
      for (iDisplay = 0; iDisplay < ajax_block_list.length; iDisplay++)
      {
        aDispCont[ajax_block_list[iDisplay]] = aDispData.length;
        aDispData[aDispData.length] = new Array(ajax_block_id[ajax_block_list[iDisplay]], "on");
      }
      for (iDisplay = 0; iDisplay < ajax_field_list.length; iDisplay++)
      {
        if (ajax_field_id[ajax_field_list[iDisplay]])
        {
          aFieldIds = ajax_field_id[ajax_field_list[iDisplay]];
          for (iDisplay2 = 0; iDisplay2 < aFieldIds.length; iDisplay2++)
          {
            aDispCont[aFieldIds[iDisplay2]] = aDispData.length;
            aDispData[aDispData.length] = new Array(aFieldIds[iDisplay2], "on");
          }
        }
      }
    }
        var blockDisplay = {};
    if (oResp["blockDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["blockDisplay"].length; iDisplay++)
      {
        if (bReset)
        {
          aDispData[ aDispCont[ oResp["blockDisplay"][iDisplay][0] ] ][1] = oResp["blockDisplay"][iDisplay][1];
        }
        else
        {
          aDispData[aDispData.length] = new Array(ajax_block_id[ oResp["blockDisplay"][iDisplay][0] ], oResp["blockDisplay"][iDisplay][1]);
        }
                blockDisplay[ oResp["blockDisplay"][iDisplay][0] ] = oResp["blockDisplay"][iDisplay][1];
      }
          //scCheckPagesWithoutBlock();
    }
        var fieldDisplay = {}, controlHtmlHideField = [], controlHtmlShowField = [];
    if (oResp["fieldDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["fieldDisplay"].length; iDisplay++)
      {
        if (typeof scHideUserField === "function" && "off" == oResp["fieldDisplay"][iDisplay][1]) {
          controlHtmlHideField.push(oResp["fieldDisplay"][iDisplay][0]);
        }
        if (typeof scShowUserField === "function" && "on" == oResp["fieldDisplay"][iDisplay][1]) {
          controlHtmlShowField.push(oResp["fieldDisplay"][iDisplay][0]);
        }
        for (iDisplay2 = 1; iDisplay2 < ajax_field_mult[ oResp["fieldDisplay"][iDisplay][0] ].length; iDisplay2++)
        {
          aFieldIds = ajax_field_id[ ajax_field_mult[ oResp["fieldDisplay"][iDisplay][0] ][iDisplay2] ];
          for (iDisplay3 = 0; iDisplay3 < aFieldIds.length; iDisplay3++)
          {
            if (bReset)
            {
              aDispData[ aDispCont[ aFieldIds[iDisplay3] ] ][1] = oResp["fieldDisplay"][iDisplay][1];
            }
            else
            {
              aDispData[aDispData.length] = new Array(aFieldIds[iDisplay3], oResp["fieldDisplay"][iDisplay][1]);
            }
                        if ("hidden_field_data_" == aFieldIds[iDisplay3].substr(0, 18)) {
                          fieldDisplay[ aFieldIds[iDisplay3].substr(18) ] = oResp["fieldDisplay"][iDisplay][1];
                        }
          }
        }
      }
    }
    if (oResp["buttonDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["buttonDisplay"].length; iDisplay++)
      {
        var sBtnName2 = "";
        var sBtnName3 = "";
        switch (oResp["buttonDisplay"][iDisplay][0])
        {
          case "first": var sBtnName = "sc_b_ini"; break;
          case "back": var sBtnName = "sc_b_ret"; break;
          case "forward": var sBtnName = "sc_b_avc"; break;
          case "last": var sBtnName = "sc_b_fim"; break;
          case "insert": var sBtnName = "sc_b_ins"; break;
          case "update": var sBtnName = "sc_b_upd"; break;
          case "delete": var sBtnName = "sc_b_del"; break;
          default: var sBtnName = "sc_b_" + oResp["buttonDisplay"][iDisplay][0]; sBtnName2 = "sc_" + oResp["buttonDisplay"][iDisplay][0]; sBtnName3 = "gbl_sc_" + oResp["buttonDisplay"][iDisplay][0]; break;
        }
        aDispData[aDispData.length] = new Array(sBtnName, oResp["buttonDisplay"][iDisplay][1]);
        aDispData[aDispData.length] = new Array(sBtnName + "_t", oResp["buttonDisplay"][iDisplay][1]);
        aDispData[aDispData.length] = new Array(sBtnName + "_b", oResp["buttonDisplay"][iDisplay][1]);
        if ("" != sBtnName2)
        {
          aDispData[aDispData.length] = new Array(sBtnName2, oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName2 + "_top", oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName2 + "_bot", oResp["buttonDisplay"][iDisplay][1]);
        }
        if ("" != sBtnName3)
        {
          aDispData[aDispData.length] = new Array(sBtnName3, oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName3 + "_top", oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName3 + "_bot", oResp["buttonDisplay"][iDisplay][1]);
        }
      }
    }
    if (oResp["buttonDisplayVert"])
    {
      for (iDisplay = 0; iDisplay < oResp["buttonDisplayVert"].length; iDisplay++)
      {
        vertButton = oResp["buttonDisplayVert"][iDisplay];
        aDispData[aDispData.length] = new Array("sc_exc_line_" + vertButton.seq, vertButton.delete);
        if (vertButton.gridView)
        {
          aDispData[aDispData.length] = new Array("sc_open_line_" + vertButton.seq, vertButton.update);
        }
        else
        {
          aDispData[aDispData.length] = new Array("sc_upd_line_" + vertButton.seq, vertButton.update);
        }
      }
    }
    for (iDisplay = 0; iDisplay < aDispData.length; iDisplay++)
    {
      scAjaxElementDisplay(aDispData[iDisplay][0], aDispData[iDisplay][1]);
    }
        for (var blockId in blockDisplay) {
                displayChange_block(blockId, blockDisplay[blockId]);
        }
        for (var fieldId in fieldDisplay) {
                displayChange_field(fieldId, "", fieldDisplay[fieldId]);
        }
        if (controlHtmlHideField.length) {
          for (iDisplay = 0; iDisplay < controlHtmlHideField.length; iDisplay++) {
            scHideUserField(controlHtmlHideField[iDisplay]);
          }
        }
        if (controlHtmlShowField.length) {
          for (iDisplay = 0; iDisplay < controlHtmlShowField.length; iDisplay++) {
            scShowUserField(controlHtmlShowField[iDisplay]);
          }
        }
  } // scAjaxSetDisplay

  function scAjaxNavigateButtonDisplay(sButton, sStatus)
  {
    sButton2 = sButton + "_off";

    if ("off" == sStatus)
    {
      sStatus2 = "off";
    }
    else
    {
      if ("sc_b_ini" == sButton || "sc_b_ret" == sButton)
      {
        if ("S" == Nav_permite_ret)
        {
          sStatus  = "on";
          sStatus2 = "off";
        }
        else
        {
          sStatus  = "off";
          sStatus2 = "on";
        }
      }
      else
      {
        if ("S" == Nav_permite_ava)
        {
          sStatus  = "on";
          sStatus2 = "off";
        }
        else
        {
          sStatus  = "off";
          sStatus2 = "on";
        }
      }
    }

    scAjaxElementDisplay(sButton        , sStatus);
    scAjaxElementDisplay(sButton + "_t" , sStatus);
    scAjaxElementDisplay(sButton + "_b" , sStatus);
    scAjaxElementDisplay(sButton2       , sStatus2);
    scAjaxElementDisplay(sButton2 + "_t", sStatus2);
    scAjaxElementDisplay(sButton2 + "_b", sStatus2);
  } // scAjaxNavigateButtonDisplay

  function scAjaxElementDisplay(sElement, sAction)
  {
    if (ajax_block_tab && ajax_block_tab[sElement] && "" != ajax_block_tab[sElement])
    {
      scAjaxElementDisplay(ajax_block_tab[sElement], sAction);
    }
    if (document.getElementById(sElement))
    {

      if("off" == sAction)
      {
        $('#' + sElement).hide();
      }
      else
      {
        $('#' + sElement).show();
        if (typeof $('#' + sElement).data('elementDisplay') != undefined) {
          $('#' + sElement).css('display', $('#' + sElement).data('elementDisplay'));
        }
      }
      if (document.getElementById(sElement + "_dumb"))
      {
        if("off" == sAction)
        {
          $('#' + sElement + "_dumb").show();
          if (typeof $('#' + sElement).data('elementDisplay') != undefined) {
            $('#' + sElement).css('display', $('#' + sElement).data('elementDisplay'));
          }
        }
        else
        {
          $('#' + sElement + "_dumb").hide();
        }
      }
    }
  } // scAjaxElementDisplay

  function scAjaxSetLabel(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    if (bReset)
    {
      for (iLabel = 0; iLabel < ajax_field_list.length; iLabel++)
      {
        if (ajax_field_list[iLabel] && ajax_error_list[ajax_field_list[iLabel]])
        {
          scAjaxFieldLabel(ajax_field_list[iLabel], ajax_error_list[ajax_field_list[iLabel]]["label"]);
        }
      }
    }
    if (oResp["fieldLabel"])
    {
      for (iLabel = 0; iLabel < oResp["fieldLabel"].length; iLabel++)
      {
        scAjaxFieldLabel(oResp["fieldLabel"][iLabel][0], scAjaxSpecCharParser(oResp["fieldLabel"][iLabel][1]));
      }
    }
  } // scAjaxSetLabel

  function scAjaxFieldLabel(sField, sLabel)
  {
    if (document.getElementById("id_label_" + sField))
    {
      if (document.getElementById("id_label_" + sField).innerHTML != sLabel)
      {
        document.getElementById("id_label_" + sField).innerHTML = sLabel;
      }
    }
    else if (document.getElementById("hidden_field_label_" + sField) && document.getElementById("hidden_field_label_" + sField).innerHTML != sLabel)
    {
      document.getElementById("hidden_field_label_" + sField).innerHTML = sLabel;
    }
  } // scAjaxFieldLabel

  function scAjaxSetReadonly(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    if (bReset)
    {
      for (iRead = 0; iRead < ajax_field_list.length; iRead++)
      {
        scAjaxFieldRead(ajax_field_list[iRead], ajax_read_only[ajax_field_list[iRead]]);
      }
      for (iRead = 0; iRead < ajax_field_Dt_Hr.length; iRead++)
      {
        scAjaxFieldRead(ajax_field_Dt_Hr[iRead], ajax_read_only[ajax_field_Dt_Hr[iRead]]);
      }
    }
    if (oResp["readOnly"])
    {
      for (iRead = 0; iRead < oResp["readOnly"].length; iRead++)
      {
        if (ajax_read_only[ oResp["readOnly"][iRead][0] ])
        {
          scAjaxFieldRead(oResp["readOnly"][iRead][0], oResp["readOnly"][iRead][1]);
        }
        else if (oResp["rsSize"])
        {
          for (var i = 0; i <= oResp["rsSize"]; i++)
          {
            if (ajax_read_only[ oResp["readOnly"][iRead][0] + i ])
            {
              scAjaxFieldRead(oResp["readOnly"][iRead][0] + i, oResp["readOnly"][iRead][1]);
            }
          }
        }
      }
    }
  } // scAjaxSetReadonly

  function scAjaxFieldRead(sField, sStatus)
  {
    if ("on" == sStatus)
    {
      var sDisplayOff = "none";
      var sDisplayOn  = "";
    }
    else
    {
      var sDisplayOff = "";
      var sDisplayOn  = "none";
    }
    if (document.getElementById("id_read_off_" + sField))
    {
      document.getElementById("id_read_off_" + sField).style.display = sDisplayOff;
    }
    if (document.getElementById("id_sc_dragdrop_" + sField))
    {
      document.getElementById("id_sc_dragdrop_" + sField).style.display = sDisplayOff;
    }
    if (document.getElementById("id_read_on_" + sField))
    {
      document.getElementById("id_read_on_" + sField).style.display = sDisplayOn;
    }
  } // scAjaxFieldRead

  function scAjaxSetBtnVars()
  {
    if (oResp["btnVars"])
    {
      for (iBtn = 0; iBtn < oResp["btnVars"].length; iBtn++)
      {
        eval(oResp["btnVars"][iBtn][0] + " = scAjaxSpecCharParser('" + oResp["btnVars"][iBtn][1] + "');");
      }
    }
  } // scAjaxSetBtnVars

  function scAjaxClearText(sFormField)
  {
    document.F1.elements[sFormField].value = "";
  } // scAjaxClearText

  function scAjaxClearLabel(sFormField)
  {
    document.getElementById("id_ajax_label_" + sFormField).innerHTML = "";
  } // scAjaxClearLabel

  function scAjaxClearSelect(sFormField)
  {
    document.F1.elements[sFormField].length = 0;
  } // scAjaxClearSelect

  function scAjaxClearCheckbox(sFormField)
  {
    document.getElementById("idAjaxCheckbox_" + sFormField).innerHTML = "";
  } // scAjaxClearCheckbox

  function scAjaxClearRadio(sFormField)
  {
    document.getElementById("idAjaxRadio_" + sFormField).innerHTML = "";
  } // scAjaxClearRadio

  function scAjaxClearEditorHtml(sFormField)
  {
    if(tinymce.majorVersion > 3)
        {
                var oFormField = tinyMCE.get(sFieldName);
        }
        else
        {
                var oFormField = tinyMCE.getInstanceById(sFieldName);
        }
    oFormField.setContent("");
  } // scAjaxClearEditorHtml

  function scCheckPagesWithoutBlock()
  {
        var page_id, block_id, has_block_shown;
    for (page_id in ajax_page_blocks) {
          has_block_shown = false;
      for (block_id in ajax_page_blocks[page_id]) {
                console.log(page_id + ' ' + ajax_page_blocks[page_id][block_id]);
                console.log($("#div_" + ajax_block_id[ajax_page_blocks[page_id][block_id]]).css('display'));
        //$("#div_" + ajax_block_id[block_id]);
      }
    }
  }

  function scAjaxJavascript()
  {
    if (oResp["ajaxJavascript"])
    {
      var sJsFunc = "";
      for (var i = 0; i < oResp["ajaxJavascript"].length; i++)
      {
        sJsFunc = scAjaxSpecCharParser(oResp["ajaxJavascript"][i][0]);
        if ("" != sJsFunc)
        {
          var aParam = new Array();
          if (oResp["ajaxJavascript"][i][1] && 0 < oResp["ajaxJavascript"][i][1].length)
          {
            for (var j = 0; j < oResp["ajaxJavascript"][i][1].length; j++)
            {
              aParam.push("'" + oResp["ajaxJavascript"][i][1][j] + "'");
            }
          }
          eval("if (" + sJsFunc + ") { " + sJsFunc + "(" + aParam.join(", ") + ") }");
        }
      }
    }
  } // scAjaxJavascript

  function scAjaxAlert(callbackOk)
  {
    if (oResp["ajaxAlert"] && oResp["ajaxAlert"]["message"] && "" != oResp["ajaxAlert"]["message"])
    {
      scJs_alert(oResp["ajaxAlert"]["message"], callbackOk, oResp["ajaxAlert"]["params"]);
    }
    else
    {
      callbackOk();
    }
  } // scAjaxAlert

        function scJs_alert_default(message, callbackOk) {
                alert(message);
                if (typeof callbackOk == "function") {
                        callbackOk();
                }
        } // scJs_alert_default

        function scJs_confirm_default(message, callbackOk, callbackCancel) {
                if (confirm(message)) {
                        callbackOk();
                }
                else {
                        callbackCancel();
                }
        } // scJs_confirm_default

  function scAjaxMessage(oTemp)
  {
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (oResp["ajaxMessage"] && oResp["ajaxMessage"]["message"] && "" != oResp["ajaxMessage"]["message"])
    {
      var sTitle    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["title"])        ? oResp["ajaxMessage"]["title"]               : scMsgDefTitle,
          bModal    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["modal"])        ? ("Y" == oResp["ajaxMessage"]["modal"])      : false,
          iTimeout  = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["timeout"])      ? parseInt(oResp["ajaxMessage"]["timeout"])   : 0,
          bButton   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["button"])       ? ("Y" == oResp["ajaxMessage"]["button"])     : false,
          sButton   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["button_label"]) ? oResp["ajaxMessage"]["button_label"]        : "Ok",
          iTop      = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["top"])          ? parseInt(oResp["ajaxMessage"]["top"])       : 0,
          iLeft     = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["left"])         ? parseInt(oResp["ajaxMessage"]["left"])      : 0,
          iWidth    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["width"])        ? parseInt(oResp["ajaxMessage"]["width"])     : 0,
          iHeight   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["height"])       ? parseInt(oResp["ajaxMessage"]["height"])    : 0,
          bClose    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["show_close"])   ? ("Y" == oResp["ajaxMessage"]["show_close"]) : true,
          bBodyIcon = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["body_icon"])    ? ("Y" == oResp["ajaxMessage"]["body_icon"])  : true,
          sRedir    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir"])        ? oResp["ajaxMessage"]["redir"]               : "",
          sTarget   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir_target"]) ? oResp["ajaxMessage"]["redir_target"]        : "",
          sParam    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir_par"])    ? oResp["ajaxMessage"]["redir_par"]           : "",
          bToast    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["toast"])        ? ("Y" == oResp["ajaxMessage"]["toast"])      : false,
          sToastPos = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["toast_pos"])    ? oResp["ajaxMessage"]["toast_pos"]           : "",
          sType     = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["type"])         ? oResp["ajaxMessage"]["type"]                : "";
      if (typeof scDisplayUserMessage == "function") {
        scDisplayUserMessage(oResp["ajaxMessage"]["message"]);
      }
      else {
                  var params = {
                          title: sTitle,
                          message: oResp["ajaxMessage"]["message"],
                          isModal: bModal,
                          timeout: iTimeout,
                          showButton: bButton,
                          buttonLabel: sButton,
                          topPos: iTop,
                          leftPos: iLeft,
                          width: iWidth,
                          height: iHeight,
                          redirUrl: sRedir,
                          redirTarget: sTarget,
                          redirParams: sParam,
                          showClose: bClose,
                          showBodyIcon: bBodyIcon,
                          isToast: bToast,
                          toastPos: sToastPos,
                          type: sType
                  };
        _scAjaxShowMessage(params);
      }
    }
  } // scAjaxMessage

  function scAjaxResponse(sResp)
  {
    eval("var oResp = " + sResp);
    return oResp;
  } // scAjaxResponse

  function scAjaxBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      input += "";
      while (input.lastIndexOf(String.fromCharCode(10)) > -1)
      {
         input = input.replace(String.fromCharCode(10), '<br>');
      }
      return input;
  } // scAjaxBreakLine

  function scAjaxProtectBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      var input1 = input + "";
      while (input1.lastIndexOf(String.fromCharCode(10)) > -1)
      {
         input1 = input1.replace(String.fromCharCode(10), '#@NM#@');
      }
      return input1;
  } // scAjaxProtectBreakLine

  function scAjaxReturnBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      while (input.lastIndexOf('#@NM#@') > -1)
      {
         input = input.replace('#@NM#@', String.fromCharCode(10));
      }
      return input;
  } // scAjaxReturnBreakLine

  function scOpenMasterDetail(widget, url)
  {
          var iframe = $(parent.document).find("[name='" +  widget+ "']");
          iframe.attr("src", url);
  } // scOpenMasterDetail

  function scMoveMasterDetail(widget)
  {
          var iframe = $(parent.document).find("[name='" +  widget+ "']");
          iframe[0].contentWindow.nm_move("apl_detalhe", true);
  } // scMoveMasterDetail

        function scAjaxError_markList() {
            if ('undefined' == typeof oResp.errList) {
                return;
            }
                var i, fieldName, fieldList = new Array();
                for (i = 0; i < oResp.errList.length; i++) {
                        fieldName = oResp.errList[i]["fldName"];
                        if (oResp.errList[i]["numLinha"]) {
                                fieldName += oResp.errList[i]["numLinha"];
                        }
            fieldList.push(fieldName);
                }
                scAjaxError_markFieldList(fieldList);
        } // scAjaxError_markList

        function scAjaxError_markFieldList(fieldList) {
                var i;
                for (i = 0; i < fieldList.length; i++) {
            scAjaxError_markField(fieldList[i]);
                }
        } // scAjaxError_markFieldList

        function scAjaxError_unmarkList() {
                var i;
                for (i = 0; i < ajax_field_list.length; i++) {
            scAjaxError_unmarkField(ajax_field_list[i]);
                }
        } // scAjaxError_unmarkList

        function scAjaxError_markField(fieldName) {
                var $oField = $("#id_sc_field_" + fieldName);
                if (0 < $oField.length) {
                        scAjax_applyFieldErrorStyle($oField);
                }
        } // scAjaxError_markField

        function scAjaxError_unmarkField(fieldName) {
                var $oField = $("#id_sc_field_" + fieldName);
                if (0 < $oField.length) {
                        scAjax_removeFieldErrorStyle($oField);
                }
        } // scAjaxError_unmarkField

        function scAjax_displayEmptyForm() {
        $("#sc-ui-empty-form").show();
        $(".sc-ui-page-tab-line").hide();
        $("#sc-id-required-row").hide();
        sc_hide_app_settings_mob_form();
        }

  function scAjax_applyFieldErrorStyle(fieldObj) {
    if (fieldObj.hasClass("sc-ui-pwd-toggle")) {
        fieldObj.addClass(sc_css_status_pwd_text);
        fieldObj.parent().addClass(sc_css_status_pwd_box);
      } else {
        fieldObj.addClass(sc_css_status);
      }
  }

  function scAjax_removeFieldErrorStyle(fieldObj) {
    if (fieldObj.hasClass("sc-ui-pwd-toggle")) {
        fieldObj.removeClass(sc_css_status_pwd_text);
        fieldObj.parent().removeClass(sc_css_status_pwd_box);
      } else {
        fieldObj.removeClass(sc_css_status);
      }
  }

  function scAjax_formReload() {
<?php
    if ($this->nmgp_opcao == 'novo') {
        echo "      nm_move('reload_novo');";
    } else {
        echo "      nm_move('igual');";
    }
?>
  }

  function scBtnDisabled()
  {
    var btnNameNav, hasNavButton = false;

    if (typeof oResp.btnDisabled != undefined) {
      for (var btnName in oResp.btnDisabled) {
        btnNameNav = btnName.substring(0, 9);

        if ("on" == oResp.btnDisabled[btnName]) {
          $("#" + btnName).addClass("disabled");

          if ("sc_b_ini_" == btnNameNav) {
            Nav_binicio_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_ret_" == btnNameNav) {
            Nav_bretorna_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_avc_" == btnNameNav) {
            Nav_bavanca_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_fim_" == btnNameNav) {
            Nav_bfinal_macro_disabled = "on";
            hasNavButton = true;
          }
        } else {
          $("#" + btnName).removeClass("disabled");

          if ("sc_b_ini_" == btnNameNav) {
            Nav_binicio_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_ret_" == btnNameNav) {
            Nav_bretorna_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_avc_" == btnNameNav) {
            Nav_bavanca_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_fim_" == btnNameNav) {
            Nav_bfinal_macro_disabled = "off";
            hasNavButton = true;
          }
        }
      }
    }

    if (hasNavButton) {
      nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');
      nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');
    }
  }

  function scBtnLabel()
  {
    if (typeof oResp.btnLabel != undefined) {
      for (var btnName in oResp.btnLabel) {
        $("#" + btnName).find(".btn-label").html(oResp.btnLabel[btnName]);
      }
    }
  }

  var scFormHasChanged = false;

  function scMarkFormAsChanged() {
    scFormHasChanged = true;
  }

  function scResetFormChanges() {
    scFormHasChanged = false;
  }

  var isRunning_scFormClose_F5 = false;
  function scFormClose_F5(exitUrl) {
    if (isRunning_scFormClose_F5) {
      return;
    }
    isRunning_scFormClose_F5 = true;
    setTimeout(function() { isRunning_scFormClose_F5 = false; }, 3000);

    if (scFormHasChanged) {
      scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', function() { document.F5.action = exitUrl; document.F5.submit(); }, function() {});
    } else {
      document.F5.action = exitUrl;
      document.F5.submit();
    }

  }

  var isRunning_scFormClose_F6 = false;
  function scFormClose_F6(exitUrl) {
    if (isRunning_scFormClose_F6) {
      return;
    }
    isRunning_scFormClose_F6 = true;
    setTimeout(function() { isRunning_scFormClose_F6 = false; }, 3000);

    if (scFormHasChanged) {
      scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', function() { document.F6.action = exitUrl; document.F6.submit(); }, function() {});
    } else {
      document.F6.action = exitUrl;
      document.F6.submit();
    }

  }

  // ---------- Validate session_expire
  function do_ajax_app_settings_mob_validate_session_expire()
  {
    var nomeCampo_session_expire = "session_expire";
    var var_session_expire = scAjaxGetFieldSelect(nomeCampo_session_expire);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_session_expire(var_session_expire, var_script_case_init, do_ajax_app_settings_mob_validate_session_expire_cb);
  } // do_ajax_app_settings_mob_validate_session_expire

  function do_ajax_app_settings_mob_validate_session_expire_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "session_expire";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_session_expire_cb

  // ---------- Validate remember_me
  function do_ajax_app_settings_mob_validate_remember_me()
  {
    var nomeCampo_remember_me = "remember_me";
    var var_remember_me = scAjaxGetFieldCheckbox(nomeCampo_remember_me, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_remember_me(var_remember_me, var_script_case_init, do_ajax_app_settings_mob_validate_remember_me_cb);
  } // do_ajax_app_settings_mob_validate_remember_me

  function do_ajax_app_settings_mob_validate_remember_me_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "remember_me";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_remember_me_cb

  // ---------- Validate cookie_expiration_time
  function do_ajax_app_settings_mob_validate_cookie_expiration_time()
  {
    var nomeCampo_cookie_expiration_time = "cookie_expiration_time";
    var var_cookie_expiration_time = scAjaxGetFieldText(nomeCampo_cookie_expiration_time);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_cookie_expiration_time(var_cookie_expiration_time, var_script_case_init, do_ajax_app_settings_mob_validate_cookie_expiration_time_cb);
  } // do_ajax_app_settings_mob_validate_cookie_expiration_time

  function do_ajax_app_settings_mob_validate_cookie_expiration_time_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "cookie_expiration_time";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_cookie_expiration_time_cb

  // ---------- Validate theme
  function do_ajax_app_settings_mob_validate_theme()
  {
    var nomeCampo_theme = "theme";
    var var_theme = scAjaxGetFieldText(nomeCampo_theme);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_theme(var_theme, var_script_case_init, do_ajax_app_settings_mob_validate_theme_cb);
  } // do_ajax_app_settings_mob_validate_theme

  function do_ajax_app_settings_mob_validate_theme_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "theme";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_theme_cb

  // ---------- Validate language
  function do_ajax_app_settings_mob_validate_language()
  {
    var nomeCampo_language = "language";
    var var_language = scAjaxGetFieldCheckbox(nomeCampo_language, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_language(var_language, var_script_case_init, do_ajax_app_settings_mob_validate_language_cb);
  } // do_ajax_app_settings_mob_validate_language

  function do_ajax_app_settings_mob_validate_language_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "language";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_language_cb

  // ---------- Validate login_mode
  function do_ajax_app_settings_mob_validate_login_mode()
  {
    var nomeCampo_login_mode = "login_mode";
    var var_login_mode = scAjaxGetFieldSelect(nomeCampo_login_mode);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_login_mode(var_login_mode, var_script_case_init, do_ajax_app_settings_mob_validate_login_mode_cb);
  } // do_ajax_app_settings_mob_validate_login_mode

  function do_ajax_app_settings_mob_validate_login_mode_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "login_mode";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_login_mode_cb

  // ---------- Validate captcha
  function do_ajax_app_settings_mob_validate_captcha()
  {
    var nomeCampo_captcha = "captcha";
    var var_captcha = scAjaxGetFieldCheckbox(nomeCampo_captcha, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_captcha(var_captcha, var_script_case_init, do_ajax_app_settings_mob_validate_captcha_cb);
  } // do_ajax_app_settings_mob_validate_captcha

  function do_ajax_app_settings_mob_validate_captcha_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "captcha";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_captcha_cb

  // ---------- Validate pswd_last_updated
  function do_ajax_app_settings_mob_validate_pswd_last_updated()
  {
    var nomeCampo_pswd_last_updated = "pswd_last_updated";
    var var_pswd_last_updated = scAjaxGetFieldText(nomeCampo_pswd_last_updated);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_pswd_last_updated(var_pswd_last_updated, var_script_case_init, do_ajax_app_settings_mob_validate_pswd_last_updated_cb);
  } // do_ajax_app_settings_mob_validate_pswd_last_updated

  function do_ajax_app_settings_mob_validate_pswd_last_updated_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "pswd_last_updated";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_pswd_last_updated_cb

  // ---------- Validate brute_force
  function do_ajax_app_settings_mob_validate_brute_force()
  {
    var nomeCampo_brute_force = "brute_force";
    var var_brute_force = scAjaxGetFieldCheckbox(nomeCampo_brute_force, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_brute_force(var_brute_force, var_script_case_init, do_ajax_app_settings_mob_validate_brute_force_cb);
  } // do_ajax_app_settings_mob_validate_brute_force

  function do_ajax_app_settings_mob_validate_brute_force_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "brute_force";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_brute_force_cb

  // ---------- Validate brute_force_attempts
  function do_ajax_app_settings_mob_validate_brute_force_attempts()
  {
    var nomeCampo_brute_force_attempts = "brute_force_attempts";
    var var_brute_force_attempts = scAjaxGetFieldText(nomeCampo_brute_force_attempts);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_brute_force_attempts(var_brute_force_attempts, var_script_case_init, do_ajax_app_settings_mob_validate_brute_force_attempts_cb);
  } // do_ajax_app_settings_mob_validate_brute_force_attempts

  function do_ajax_app_settings_mob_validate_brute_force_attempts_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "brute_force_attempts";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_brute_force_attempts_cb

  // ---------- Validate brute_force_time_block
  function do_ajax_app_settings_mob_validate_brute_force_time_block()
  {
    var nomeCampo_brute_force_time_block = "brute_force_time_block";
    var var_brute_force_time_block = scAjaxGetFieldText(nomeCampo_brute_force_time_block);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_brute_force_time_block(var_brute_force_time_block, var_script_case_init, do_ajax_app_settings_mob_validate_brute_force_time_block_cb);
  } // do_ajax_app_settings_mob_validate_brute_force_time_block

  function do_ajax_app_settings_mob_validate_brute_force_time_block_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "brute_force_time_block";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_brute_force_time_block_cb

  // ---------- Validate retrieve_password
  function do_ajax_app_settings_mob_validate_retrieve_password()
  {
    var nomeCampo_retrieve_password = "retrieve_password";
    var var_retrieve_password = scAjaxGetFieldCheckbox(nomeCampo_retrieve_password, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_retrieve_password(var_retrieve_password, var_script_case_init, do_ajax_app_settings_mob_validate_retrieve_password_cb);
  } // do_ajax_app_settings_mob_validate_retrieve_password

  function do_ajax_app_settings_mob_validate_retrieve_password_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "retrieve_password";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_retrieve_password_cb

  // ---------- Validate recover_pswd
  function do_ajax_app_settings_mob_validate_recover_pswd()
  {
    var nomeCampo_recover_pswd = "recover_pswd";
    var var_recover_pswd = scAjaxGetFieldSelect(nomeCampo_recover_pswd);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_recover_pswd(var_recover_pswd, var_script_case_init, do_ajax_app_settings_mob_validate_recover_pswd_cb);
  } // do_ajax_app_settings_mob_validate_recover_pswd

  function do_ajax_app_settings_mob_validate_recover_pswd_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "recover_pswd";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_recover_pswd_cb

  // ---------- Validate password_min
  function do_ajax_app_settings_mob_validate_password_min()
  {
    var nomeCampo_password_min = "password_min";
    var var_password_min = scAjaxGetFieldText(nomeCampo_password_min);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_password_min(var_password_min, var_script_case_init, do_ajax_app_settings_mob_validate_password_min_cb);
  } // do_ajax_app_settings_mob_validate_password_min

  function do_ajax_app_settings_mob_validate_password_min_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "password_min";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_password_min_cb

  // ---------- Validate password_strength
  function do_ajax_app_settings_mob_validate_password_strength()
  {
    var nomeCampo_password_strength = "password_strength";
    var var_password_strength = scAjaxGetFieldCheckbox(nomeCampo_password_strength, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_password_strength(var_password_strength, var_script_case_init, do_ajax_app_settings_mob_validate_password_strength_cb);
  } // do_ajax_app_settings_mob_validate_password_strength

  function do_ajax_app_settings_mob_validate_password_strength_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "password_strength";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_password_strength_cb

  // ---------- Validate group_administrator
  function do_ajax_app_settings_mob_validate_group_administrator()
  {
    var nomeCampo_group_administrator = "group_administrator";
    var var_group_administrator = scAjaxGetFieldSelect(nomeCampo_group_administrator);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_group_administrator(var_group_administrator, var_script_case_init, do_ajax_app_settings_mob_validate_group_administrator_cb);
  } // do_ajax_app_settings_mob_validate_group_administrator

  function do_ajax_app_settings_mob_validate_group_administrator_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "group_administrator";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_group_administrator_cb

  // ---------- Validate enable_2fa
  function do_ajax_app_settings_mob_validate_enable_2fa()
  {
    var nomeCampo_enable_2fa = "enable_2fa";
    var var_enable_2fa = scAjaxGetFieldCheckbox(nomeCampo_enable_2fa, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_enable_2fa(var_enable_2fa, var_script_case_init, do_ajax_app_settings_mob_validate_enable_2fa_cb);
  } // do_ajax_app_settings_mob_validate_enable_2fa

  function do_ajax_app_settings_mob_validate_enable_2fa_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "enable_2fa";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_enable_2fa_cb

  // ---------- Validate enable_2fa_expiration_time
  function do_ajax_app_settings_mob_validate_enable_2fa_expiration_time()
  {
    var nomeCampo_enable_2fa_expiration_time = "enable_2fa_expiration_time";
    var var_enable_2fa_expiration_time = scAjaxGetFieldText(nomeCampo_enable_2fa_expiration_time);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_enable_2fa_expiration_time(var_enable_2fa_expiration_time, var_script_case_init, do_ajax_app_settings_mob_validate_enable_2fa_expiration_time_cb);
  } // do_ajax_app_settings_mob_validate_enable_2fa_expiration_time

  function do_ajax_app_settings_mob_validate_enable_2fa_expiration_time_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "enable_2fa_expiration_time";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_enable_2fa_expiration_time_cb

  // ---------- Validate enable_2fa_mode
  function do_ajax_app_settings_mob_validate_enable_2fa_mode()
  {
    var nomeCampo_enable_2fa_mode = "enable_2fa_mode";
    var var_enable_2fa_mode = scAjaxGetFieldSelect(nomeCampo_enable_2fa_mode);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_enable_2fa_mode(var_enable_2fa_mode, var_script_case_init, do_ajax_app_settings_mob_validate_enable_2fa_mode_cb);
  } // do_ajax_app_settings_mob_validate_enable_2fa_mode

  function do_ajax_app_settings_mob_validate_enable_2fa_mode_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "enable_2fa_mode";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_enable_2fa_mode_cb

  // ---------- Validate enable_2fa_api_type
  function do_ajax_app_settings_mob_validate_enable_2fa_api_type()
  {
    var nomeCampo_enable_2fa_api_type = "enable_2fa_api_type";
    var var_enable_2fa_api_type = scAjaxGetFieldRadio(nomeCampo_enable_2fa_api_type);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_enable_2fa_api_type(var_enable_2fa_api_type, var_script_case_init, do_ajax_app_settings_mob_validate_enable_2fa_api_type_cb);
  } // do_ajax_app_settings_mob_validate_enable_2fa_api_type

  function do_ajax_app_settings_mob_validate_enable_2fa_api_type_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "enable_2fa_api_type";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_enable_2fa_api_type_cb

  // ---------- Validate enable_2fa_api
  function do_ajax_app_settings_mob_validate_enable_2fa_api()
  {
    var nomeCampo_enable_2fa_api = "enable_2fa_api";
    var var_enable_2fa_api = scAjaxGetFieldHidden(nomeCampo_enable_2fa_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_enable_2fa_api(var_enable_2fa_api, var_script_case_init, do_ajax_app_settings_mob_validate_enable_2fa_api_cb);
  } // do_ajax_app_settings_mob_validate_enable_2fa_api

  function do_ajax_app_settings_mob_validate_enable_2fa_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "enable_2fa_api";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_enable_2fa_api_cb

  // ---------- Validate mfa_last_updated
  function do_ajax_app_settings_mob_validate_mfa_last_updated()
  {
    var nomeCampo_mfa_last_updated = "mfa_last_updated";
    var var_mfa_last_updated = scAjaxGetFieldText(nomeCampo_mfa_last_updated);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_mfa_last_updated(var_mfa_last_updated, var_script_case_init, do_ajax_app_settings_mob_validate_mfa_last_updated_cb);
  } // do_ajax_app_settings_mob_validate_mfa_last_updated

  function do_ajax_app_settings_mob_validate_mfa_last_updated_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "mfa_last_updated";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_mfa_last_updated_cb

  // ---------- Validate new_users
  function do_ajax_app_settings_mob_validate_new_users()
  {
    var nomeCampo_new_users = "new_users";
    var var_new_users = scAjaxGetFieldCheckbox(nomeCampo_new_users, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_new_users(var_new_users, var_script_case_init, do_ajax_app_settings_mob_validate_new_users_cb);
  } // do_ajax_app_settings_mob_validate_new_users

  function do_ajax_app_settings_mob_validate_new_users_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "new_users";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_new_users_cb

  // ---------- Validate req_email_act
  function do_ajax_app_settings_mob_validate_req_email_act()
  {
    var nomeCampo_req_email_act = "req_email_act";
    var var_req_email_act = scAjaxGetFieldCheckbox(nomeCampo_req_email_act, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_req_email_act(var_req_email_act, var_script_case_init, do_ajax_app_settings_mob_validate_req_email_act_cb);
  } // do_ajax_app_settings_mob_validate_req_email_act

  function do_ajax_app_settings_mob_validate_req_email_act_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "req_email_act";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_req_email_act_cb

  // ---------- Validate send_email_adm
  function do_ajax_app_settings_mob_validate_send_email_adm()
  {
    var nomeCampo_send_email_adm = "send_email_adm";
    var var_send_email_adm = scAjaxGetFieldCheckbox(nomeCampo_send_email_adm, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_send_email_adm(var_send_email_adm, var_script_case_init, do_ajax_app_settings_mob_validate_send_email_adm_cb);
  } // do_ajax_app_settings_mob_validate_send_email_adm

  function do_ajax_app_settings_mob_validate_send_email_adm_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "send_email_adm";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_send_email_adm_cb

  // ---------- Validate group_default
  function do_ajax_app_settings_mob_validate_group_default()
  {
    var nomeCampo_group_default = "group_default";
    var var_group_default = scAjaxGetFieldSelect(nomeCampo_group_default);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_group_default(var_group_default, var_script_case_init, do_ajax_app_settings_mob_validate_group_default_cb);
  } // do_ajax_app_settings_mob_validate_group_default

  function do_ajax_app_settings_mob_validate_group_default_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "group_default";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_group_default_cb

  // ---------- Validate smtp_api
  function do_ajax_app_settings_mob_validate_smtp_api()
  {
    var nomeCampo_smtp_api = "smtp_api";
    var var_smtp_api = scAjaxGetFieldHidden(nomeCampo_smtp_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_smtp_api(var_smtp_api, var_script_case_init, do_ajax_app_settings_mob_validate_smtp_api_cb);
  } // do_ajax_app_settings_mob_validate_smtp_api

  function do_ajax_app_settings_mob_validate_smtp_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "smtp_api";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_smtp_api_cb

  // ---------- Validate smtp_server
  function do_ajax_app_settings_mob_validate_smtp_server()
  {
    var nomeCampo_smtp_server = "smtp_server";
    var var_smtp_server = scAjaxGetFieldText(nomeCampo_smtp_server);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_smtp_server(var_smtp_server, var_script_case_init, do_ajax_app_settings_mob_validate_smtp_server_cb);
  } // do_ajax_app_settings_mob_validate_smtp_server

  function do_ajax_app_settings_mob_validate_smtp_server_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "smtp_server";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_smtp_server_cb

  // ---------- Validate smtp_port
  function do_ajax_app_settings_mob_validate_smtp_port()
  {
    var nomeCampo_smtp_port = "smtp_port";
    var var_smtp_port = scAjaxGetFieldText(nomeCampo_smtp_port);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_smtp_port(var_smtp_port, var_script_case_init, do_ajax_app_settings_mob_validate_smtp_port_cb);
  } // do_ajax_app_settings_mob_validate_smtp_port

  function do_ajax_app_settings_mob_validate_smtp_port_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "smtp_port";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_smtp_port_cb

  // ---------- Validate smtp_security
  function do_ajax_app_settings_mob_validate_smtp_security()
  {
    var nomeCampo_smtp_security = "smtp_security";
    var var_smtp_security = scAjaxGetFieldSelect(nomeCampo_smtp_security);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_smtp_security(var_smtp_security, var_script_case_init, do_ajax_app_settings_mob_validate_smtp_security_cb);
  } // do_ajax_app_settings_mob_validate_smtp_security

  function do_ajax_app_settings_mob_validate_smtp_security_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "smtp_security";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_smtp_security_cb

  // ---------- Validate smtp_user
  function do_ajax_app_settings_mob_validate_smtp_user()
  {
    var nomeCampo_smtp_user = "smtp_user";
    var var_smtp_user = scAjaxGetFieldText(nomeCampo_smtp_user);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_smtp_user(var_smtp_user, var_script_case_init, do_ajax_app_settings_mob_validate_smtp_user_cb);
  } // do_ajax_app_settings_mob_validate_smtp_user

  function do_ajax_app_settings_mob_validate_smtp_user_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "smtp_user";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_smtp_user_cb

  // ---------- Validate smtp_pass
  function do_ajax_app_settings_mob_validate_smtp_pass()
  {
    var nomeCampo_smtp_pass = "smtp_pass";
    var var_smtp_pass = scAjaxGetFieldText(nomeCampo_smtp_pass);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_smtp_pass(var_smtp_pass, var_script_case_init, do_ajax_app_settings_mob_validate_smtp_pass_cb);
  } // do_ajax_app_settings_mob_validate_smtp_pass

  function do_ajax_app_settings_mob_validate_smtp_pass_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "smtp_pass";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_smtp_pass_cb

  // ---------- Validate smtp_from_email
  function do_ajax_app_settings_mob_validate_smtp_from_email()
  {
    var nomeCampo_smtp_from_email = "smtp_from_email";
    var var_smtp_from_email = scAjaxGetFieldText(nomeCampo_smtp_from_email);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_smtp_from_email(var_smtp_from_email, var_script_case_init, do_ajax_app_settings_mob_validate_smtp_from_email_cb);
  } // do_ajax_app_settings_mob_validate_smtp_from_email

  function do_ajax_app_settings_mob_validate_smtp_from_email_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "smtp_from_email";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_smtp_from_email_cb

  // ---------- Validate smtp_from_name
  function do_ajax_app_settings_mob_validate_smtp_from_name()
  {
    var nomeCampo_smtp_from_name = "smtp_from_name";
    var var_smtp_from_name = scAjaxGetFieldText(nomeCampo_smtp_from_name);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_smtp_from_name(var_smtp_from_name, var_script_case_init, do_ajax_app_settings_mob_validate_smtp_from_name_cb);
  } // do_ajax_app_settings_mob_validate_smtp_from_name

  function do_ajax_app_settings_mob_validate_smtp_from_name_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "smtp_from_name";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_smtp_from_name_cb

  // ---------- Validate auth_sn_position
  function do_ajax_app_settings_mob_validate_auth_sn_position()
  {
    var nomeCampo_auth_sn_position = "auth_sn_position";
    var var_auth_sn_position = scAjaxGetFieldSelect(nomeCampo_auth_sn_position);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_auth_sn_position(var_auth_sn_position, var_script_case_init, do_ajax_app_settings_mob_validate_auth_sn_position_cb);
  } // do_ajax_app_settings_mob_validate_auth_sn_position

  function do_ajax_app_settings_mob_validate_auth_sn_position_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "auth_sn_position";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_auth_sn_position_cb

  // ---------- Validate auth_sn_fb
  function do_ajax_app_settings_mob_validate_auth_sn_fb()
  {
    var nomeCampo_auth_sn_fb = "auth_sn_fb";
    var var_auth_sn_fb = scAjaxGetFieldCheckbox(nomeCampo_auth_sn_fb, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_auth_sn_fb(var_auth_sn_fb, var_script_case_init, do_ajax_app_settings_mob_validate_auth_sn_fb_cb);
  } // do_ajax_app_settings_mob_validate_auth_sn_fb

  function do_ajax_app_settings_mob_validate_auth_sn_fb_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "auth_sn_fb";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_auth_sn_fb_cb

  // ---------- Validate auth_sn_fb_app_id
  function do_ajax_app_settings_mob_validate_auth_sn_fb_app_id()
  {
    var nomeCampo_auth_sn_fb_app_id = "auth_sn_fb_app_id";
    var var_auth_sn_fb_app_id = scAjaxGetFieldText(nomeCampo_auth_sn_fb_app_id);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_auth_sn_fb_app_id(var_auth_sn_fb_app_id, var_script_case_init, do_ajax_app_settings_mob_validate_auth_sn_fb_app_id_cb);
  } // do_ajax_app_settings_mob_validate_auth_sn_fb_app_id

  function do_ajax_app_settings_mob_validate_auth_sn_fb_app_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "auth_sn_fb_app_id";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_auth_sn_fb_app_id_cb

  // ---------- Validate auth_sn_fb_secret
  function do_ajax_app_settings_mob_validate_auth_sn_fb_secret()
  {
    var nomeCampo_auth_sn_fb_secret = "auth_sn_fb_secret";
    var var_auth_sn_fb_secret = scAjaxGetFieldText(nomeCampo_auth_sn_fb_secret);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_auth_sn_fb_secret(var_auth_sn_fb_secret, var_script_case_init, do_ajax_app_settings_mob_validate_auth_sn_fb_secret_cb);
  } // do_ajax_app_settings_mob_validate_auth_sn_fb_secret

  function do_ajax_app_settings_mob_validate_auth_sn_fb_secret_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "auth_sn_fb_secret";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_auth_sn_fb_secret_cb

  // ---------- Validate auth_sn_x
  function do_ajax_app_settings_mob_validate_auth_sn_x()
  {
    var nomeCampo_auth_sn_x = "auth_sn_x";
    var var_auth_sn_x = scAjaxGetFieldCheckbox(nomeCampo_auth_sn_x, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_auth_sn_x(var_auth_sn_x, var_script_case_init, do_ajax_app_settings_mob_validate_auth_sn_x_cb);
  } // do_ajax_app_settings_mob_validate_auth_sn_x

  function do_ajax_app_settings_mob_validate_auth_sn_x_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "auth_sn_x";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_auth_sn_x_cb

  // ---------- Validate auth_sn_x_key
  function do_ajax_app_settings_mob_validate_auth_sn_x_key()
  {
    var nomeCampo_auth_sn_x_key = "auth_sn_x_key";
    var var_auth_sn_x_key = scAjaxGetFieldText(nomeCampo_auth_sn_x_key);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_auth_sn_x_key(var_auth_sn_x_key, var_script_case_init, do_ajax_app_settings_mob_validate_auth_sn_x_key_cb);
  } // do_ajax_app_settings_mob_validate_auth_sn_x_key

  function do_ajax_app_settings_mob_validate_auth_sn_x_key_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "auth_sn_x_key";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_auth_sn_x_key_cb

  // ---------- Validate auth_sn_x_secret
  function do_ajax_app_settings_mob_validate_auth_sn_x_secret()
  {
    var nomeCampo_auth_sn_x_secret = "auth_sn_x_secret";
    var var_auth_sn_x_secret = scAjaxGetFieldText(nomeCampo_auth_sn_x_secret);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_auth_sn_x_secret(var_auth_sn_x_secret, var_script_case_init, do_ajax_app_settings_mob_validate_auth_sn_x_secret_cb);
  } // do_ajax_app_settings_mob_validate_auth_sn_x_secret

  function do_ajax_app_settings_mob_validate_auth_sn_x_secret_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "auth_sn_x_secret";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_auth_sn_x_secret_cb

  // ---------- Validate auth_sn_google
  function do_ajax_app_settings_mob_validate_auth_sn_google()
  {
    var nomeCampo_auth_sn_google = "auth_sn_google";
    var var_auth_sn_google = scAjaxGetFieldCheckbox(nomeCampo_auth_sn_google, ";");
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_auth_sn_google(var_auth_sn_google, var_script_case_init, do_ajax_app_settings_mob_validate_auth_sn_google_cb);
  } // do_ajax_app_settings_mob_validate_auth_sn_google

  function do_ajax_app_settings_mob_validate_auth_sn_google_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "auth_sn_google";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_auth_sn_google_cb

  // ---------- Validate auth_sn_google_client_id
  function do_ajax_app_settings_mob_validate_auth_sn_google_client_id()
  {
    var nomeCampo_auth_sn_google_client_id = "auth_sn_google_client_id";
    var var_auth_sn_google_client_id = scAjaxGetFieldText(nomeCampo_auth_sn_google_client_id);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_auth_sn_google_client_id(var_auth_sn_google_client_id, var_script_case_init, do_ajax_app_settings_mob_validate_auth_sn_google_client_id_cb);
  } // do_ajax_app_settings_mob_validate_auth_sn_google_client_id

  function do_ajax_app_settings_mob_validate_auth_sn_google_client_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "auth_sn_google_client_id";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_auth_sn_google_client_id_cb

  // ---------- Validate auth_sn_google_secret
  function do_ajax_app_settings_mob_validate_auth_sn_google_secret()
  {
    var nomeCampo_auth_sn_google_secret = "auth_sn_google_secret";
    var var_auth_sn_google_secret = scAjaxGetFieldText(nomeCampo_auth_sn_google_secret);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_app_settings_mob_validate_auth_sn_google_secret(var_auth_sn_google_secret, var_script_case_init, do_ajax_app_settings_mob_validate_auth_sn_google_secret_cb);
  } // do_ajax_app_settings_mob_validate_auth_sn_google_secret

  function do_ajax_app_settings_mob_validate_auth_sn_google_secret_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    sFieldValid = "auth_sn_google_secret";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_app_settings_mob_validate_auth_sn_google_secret_cb

  // ---------- Event onclick auth_sn_fb
  function do_ajax_app_settings_mob_event_auth_sn_fb_onclick()
  {
    var var_auth_sn_fb = scAjaxGetFieldCheckbox("auth_sn_fb", ";");
    var var_auth_sn_fb_app_id = scAjaxGetFieldText("auth_sn_fb_app_id");
    var var_auth_sn_fb_secret = scAjaxGetFieldText("auth_sn_fb_secret");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_app_settings_mob_event_auth_sn_fb_onclick(var_auth_sn_fb, var_auth_sn_fb_app_id, var_auth_sn_fb_secret, var_script_case_init, do_ajax_app_settings_mob_event_auth_sn_fb_onclick_cb);
  } // do_ajax_app_settings_mob_event_auth_sn_fb_onclick

  function do_ajax_app_settings_mob_event_auth_sn_fb_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "auth_sn_fb";
    scAjaxUpdateFieldErrors(sFieldValid, "onclick");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_app_settings_mob_event_auth_sn_fb_onclick_cb_after_alert);
  } // do_ajax_app_settings_mob_event_auth_sn_fb_onclick_cb
  function do_ajax_app_settings_mob_event_auth_sn_fb_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_app_settings_mob_event_auth_sn_fb_onclick_cb_after_alert

  // ---------- Event onclick auth_sn_google
  function do_ajax_app_settings_mob_event_auth_sn_google_onclick()
  {
    var var_auth_sn_google = scAjaxGetFieldCheckbox("auth_sn_google", ";");
    var var_auth_sn_google_client_id = scAjaxGetFieldText("auth_sn_google_client_id");
    var var_auth_sn_google_secret = scAjaxGetFieldText("auth_sn_google_secret");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_app_settings_mob_event_auth_sn_google_onclick(var_auth_sn_google, var_auth_sn_google_client_id, var_auth_sn_google_secret, var_script_case_init, do_ajax_app_settings_mob_event_auth_sn_google_onclick_cb);
  } // do_ajax_app_settings_mob_event_auth_sn_google_onclick

  function do_ajax_app_settings_mob_event_auth_sn_google_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "auth_sn_google";
    scAjaxUpdateFieldErrors(sFieldValid, "onclick");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_app_settings_mob_event_auth_sn_google_onclick_cb_after_alert);
  } // do_ajax_app_settings_mob_event_auth_sn_google_onclick_cb
  function do_ajax_app_settings_mob_event_auth_sn_google_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_app_settings_mob_event_auth_sn_google_onclick_cb_after_alert

  // ---------- Event onclick auth_sn_x
  function do_ajax_app_settings_mob_event_auth_sn_x_onclick()
  {
    var var_auth_sn_x = scAjaxGetFieldCheckbox("auth_sn_x", ";");
    var var_auth_sn_x_key = scAjaxGetFieldText("auth_sn_x_key");
    var var_auth_sn_x_secret = scAjaxGetFieldText("auth_sn_x_secret");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_app_settings_mob_event_auth_sn_x_onclick(var_auth_sn_x, var_auth_sn_x_key, var_auth_sn_x_secret, var_script_case_init, do_ajax_app_settings_mob_event_auth_sn_x_onclick_cb);
  } // do_ajax_app_settings_mob_event_auth_sn_x_onclick

  function do_ajax_app_settings_mob_event_auth_sn_x_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "auth_sn_x";
    scAjaxUpdateFieldErrors(sFieldValid, "onclick");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_app_settings_mob_event_auth_sn_x_onclick_cb_after_alert);
  } // do_ajax_app_settings_mob_event_auth_sn_x_onclick_cb
  function do_ajax_app_settings_mob_event_auth_sn_x_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_app_settings_mob_event_auth_sn_x_onclick_cb_after_alert

  // ---------- Event onclick brute_force
  function do_ajax_app_settings_mob_event_brute_force_onclick()
  {
    var var_brute_force = scAjaxGetFieldCheckbox("brute_force", ";");
    var var_brute_force_time_block = scAjaxGetFieldText("brute_force_time_block");
    var var_brute_force_attempts = scAjaxGetFieldText("brute_force_attempts");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_app_settings_mob_event_brute_force_onclick(var_brute_force, var_brute_force_time_block, var_brute_force_attempts, var_script_case_init, do_ajax_app_settings_mob_event_brute_force_onclick_cb);
  } // do_ajax_app_settings_mob_event_brute_force_onclick

  function do_ajax_app_settings_mob_event_brute_force_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "brute_force";
    scAjaxUpdateFieldErrors(sFieldValid, "onclick");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_app_settings_mob_event_brute_force_onclick_cb_after_alert);
  } // do_ajax_app_settings_mob_event_brute_force_onclick_cb
  function do_ajax_app_settings_mob_event_brute_force_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_app_settings_mob_event_brute_force_onclick_cb_after_alert

  // ---------- Event onclick enable_2fa_api_type
  function do_ajax_app_settings_mob_event_enable_2fa_api_type_onclick()
  {
    var var_enable_2fa_api_type = scAjaxGetFieldRadio("enable_2fa_api_type");
    var var_enable_2fa_api = scAjaxGetFieldHidden("enable_2fa_api");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_app_settings_mob_event_enable_2fa_api_type_onclick(var_enable_2fa_api_type, var_enable_2fa_api, var_script_case_init, do_ajax_app_settings_mob_event_enable_2fa_api_type_onclick_cb);
  } // do_ajax_app_settings_mob_event_enable_2fa_api_type_onclick

  function do_ajax_app_settings_mob_event_enable_2fa_api_type_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "enable_2fa_api_type";
    scAjaxUpdateFieldErrors(sFieldValid, "onclick");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_app_settings_mob_event_enable_2fa_api_type_onclick_cb_after_alert);
  } // do_ajax_app_settings_mob_event_enable_2fa_api_type_onclick_cb
  function do_ajax_app_settings_mob_event_enable_2fa_api_type_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_app_settings_mob_event_enable_2fa_api_type_onclick_cb_after_alert

  // ---------- Event onclick enable_2fa
  function do_ajax_app_settings_mob_event_enable_2fa_onclick()
  {
    var var_enable_2fa = scAjaxGetFieldCheckbox("enable_2fa", ";");
    var var_enable_2fa_expiration_time = scAjaxGetFieldText("enable_2fa_expiration_time");
    var var_enable_2fa_mode = scAjaxGetFieldSelect("enable_2fa_mode");
    var var_enable_2fa_api = scAjaxGetFieldHidden("enable_2fa_api");
    var var_enable_2fa_api_type = scAjaxGetFieldRadio("enable_2fa_api_type");
    var var_mfa_last_updated = scAjaxGetFieldText("mfa_last_updated");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_app_settings_mob_event_enable_2fa_onclick(var_enable_2fa, var_enable_2fa_expiration_time, var_enable_2fa_mode, var_enable_2fa_api, var_enable_2fa_api_type, var_mfa_last_updated, var_script_case_init, do_ajax_app_settings_mob_event_enable_2fa_onclick_cb);
  } // do_ajax_app_settings_mob_event_enable_2fa_onclick

  function do_ajax_app_settings_mob_event_enable_2fa_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "enable_2fa";
    scAjaxUpdateFieldErrors(sFieldValid, "onclick");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_app_settings_mob_event_enable_2fa_onclick_cb_after_alert);
  } // do_ajax_app_settings_mob_event_enable_2fa_onclick_cb
  function do_ajax_app_settings_mob_event_enable_2fa_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_app_settings_mob_event_enable_2fa_onclick_cb_after_alert

  // ---------- Event onclick remember_me
  function do_ajax_app_settings_mob_event_remember_me_onclick()
  {
    var var_remember_me = scAjaxGetFieldCheckbox("remember_me", ";");
    var var_cookie_expiration_time = scAjaxGetFieldText("cookie_expiration_time");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_app_settings_mob_event_remember_me_onclick(var_remember_me, var_cookie_expiration_time, var_script_case_init, do_ajax_app_settings_mob_event_remember_me_onclick_cb);
  } // do_ajax_app_settings_mob_event_remember_me_onclick

  function do_ajax_app_settings_mob_event_remember_me_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "remember_me";
    scAjaxUpdateFieldErrors(sFieldValid, "onclick");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_app_settings_mob_event_remember_me_onclick_cb_after_alert);
  } // do_ajax_app_settings_mob_event_remember_me_onclick_cb
  function do_ajax_app_settings_mob_event_remember_me_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_app_settings_mob_event_remember_me_onclick_cb_after_alert

  // ---------- Event onclick retrieve_password
  function do_ajax_app_settings_mob_event_retrieve_password_onclick()
  {
    var var_retrieve_password = scAjaxGetFieldCheckbox("retrieve_password", ";");
    var var_recover_pswd = scAjaxGetFieldSelect("recover_pswd");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_app_settings_mob_event_retrieve_password_onclick(var_retrieve_password, var_recover_pswd, var_script_case_init, do_ajax_app_settings_mob_event_retrieve_password_onclick_cb);
  } // do_ajax_app_settings_mob_event_retrieve_password_onclick

  function do_ajax_app_settings_mob_event_retrieve_password_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "retrieve_password";
    scAjaxUpdateFieldErrors(sFieldValid, "onclick");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_app_settings_mob_event_retrieve_password_onclick_cb_after_alert);
  } // do_ajax_app_settings_mob_event_retrieve_password_onclick_cb
  function do_ajax_app_settings_mob_event_retrieve_password_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_app_settings_mob_event_retrieve_password_onclick_cb_after_alert

  // ---------- Event onchange smtp_api
  function do_ajax_app_settings_mob_event_smtp_api_onchange()
  {
    var var_smtp_api = scAjaxGetFieldHidden("smtp_api");
    var var_smtp_server = scAjaxGetFieldText("smtp_server");
    var var_smtp_port = scAjaxGetFieldText("smtp_port");
    var var_smtp_security = scAjaxGetFieldSelect("smtp_security");
    var var_smtp_user = scAjaxGetFieldText("smtp_user");
    var var_smtp_pass = scAjaxGetFieldText("smtp_pass");
    var var_smtp_from_email = scAjaxGetFieldText("smtp_from_email");
    var var_smtp_from_name = scAjaxGetFieldText("smtp_from_name");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_app_settings_mob_event_smtp_api_onchange(var_smtp_api, var_smtp_server, var_smtp_port, var_smtp_security, var_smtp_user, var_smtp_pass, var_smtp_from_email, var_smtp_from_name, var_script_case_init, do_ajax_app_settings_mob_event_smtp_api_onchange_cb);
  } // do_ajax_app_settings_mob_event_smtp_api_onchange

  function do_ajax_app_settings_mob_event_smtp_api_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "smtp_api";
    scEventControl_onChange(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "onchange");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors)
    {
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_app_settings_mob_event_smtp_api_onchange_cb_after_alert);
  } // do_ajax_app_settings_mob_event_smtp_api_onchange_cb
  function do_ajax_app_settings_mob_event_smtp_api_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_app_settings_mob_event_smtp_api_onchange_cb_after_alert
function scAjaxShowErrorDisplay(sErrorId, sErrorMsg) {
        if ("table" != sErrorId && !$("id_error_display_" + sErrorId + "_frame").hasClass('scFormToastDivFixed')) {
                scAjaxShowErrorDisplay_default(sErrorId, sErrorMsg);
        }
        else {
                scAjaxShowErrorDisplay_toast(sErrorId, sErrorMsg);
        }
} // scAjaxShowErrorDisplay

function scAjaxHideErrorDisplay(sErrorId, sErrorMsg) {
        if ("table" != sErrorId && !$("id_error_display_" + sErrorId + "_frame").hasClass('scFormToastDivFixed')) {
                scAjaxHideErrorDisplay_default(sErrorId, sErrorMsg);
        }
        else {
                scAjaxHideErrorDisplay_toast(sErrorId, sErrorMsg);
        }
} // scAjaxHideErrorDisplay

function scAjaxShowErrorDisplay_toast(sErrorId, sErrorMsg) {
        params = {type: 'error'};
        params['title'] = 'ERROR';
        scJs_alert_sweetalert(sErrorMsg, function() { scAjaxHideErrorDisplay(sErrorId, sErrorMsg); }, scJs_sweetalert_params(params));
} // scAjaxShowErrorDisplay_toast

function scAjaxHideErrorDisplay_toast(sErrorId, bForce) {
        if (document.getElementById("id_error_display_" + sErrorId + "_frame")) {
                if (null == bForce) {
                        bForce = true;
                }
                if (bForce) {
                        var $oField = $('#id_sc_field_' + sErrorId);
                        if (0 < $oField.length) {
                                $oField.removeClass(sc_css_status);
                        }
                }
        }
} // scAjaxHideErrorDisplay_toast

function scAjaxShowMessage(messageType) {
        scAjaxShowMessage_toast(true, messageType);
} // scAjaxShowMessage_toast

function scAjaxHideMessage() {
} // scAjaxHideMessage_toast

function scAjaxShowMessage_toast(isToast, messageType) {
        if (!oResp["msgDisplay"] || !oResp["msgDisplay"]["msgText"]) {
                return;
        }

        if (oResp["msgDisplay"]["toast"] || isToast) {
                _scAjaxShowMessageToast({title: scMsgDefTitle, message: oResp["msgDisplay"]["msgText"], isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, toastPos: "", type: messageType});
        }
        else {
                scJs_alert(oResp["msgDisplay"]["msgText"], scForm_cancel, {});
        }
} // scAjaxShowMessage_toast

function _scAjaxShowMessageToast(params) {
        var sweetAlertParams = {toast: true, showConfirmButton: false};

        if ("" != params["type"]) {
                sweetAlertParams["type"] = params["type"];
        }

        if ("" != params["title"]) {
                sweetAlertParams["title"] = scAjaxSpecCharParser(params["title"]);
        }

        if ("" != params["toastPos"]) {
                sweetAlertParams["position"] = params["toastPos"];
        }

        if (null == sweetAlertParams["position"]) {
                sweetAlertParams["position"] = "center-end";
        }

        if (null == sweetAlertParams["timer"]) {
                sweetAlertParams["timer"] = 3000;
        }

        scJs_alert_sweetalert(scAjaxSpecCharParser(params["message"]), scForm_cancel, scJs_sweetalert_params(sweetAlertParams));
} // _scAjaxShowMessageToast

function _scAjaxShowMessage(params) {
        if (params["isToast"]) {
                _scAjaxShowMessageToast(params);
        }
        else {
                if ("" != params["redirUrl"] && "" != params["redirTarget"]) {
            document.form_ajax_redir_2.action = params["redirUrl"];
            document.form_ajax_redir_2.target = params["redirTarget"];
            document.form_ajax_redir_2.nmgp_parms.value = params["redirParams"];
            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;
                        callbackOk = function() { document.form_ajax_redir_2.submit(); };
                }
                else if ("" != params["redirUrl"] && "" == params["redirTarget"]) {
            document.form_ajax_redir_1.action = params["redirUrl"];
            document.form_ajax_redir_1.nmgp_parms.value = params["redirParams"];
                        callbackOk = function() { document.form_ajax_redir_1.submit(); };
                }
                else {
                        callbackOk = scForm_cancel;
                }

                var alertParams = {title: params["title"]};
                if (0 < params["width"]) {
                        alertParams["width"] = params["width"];
                }
                if (0 < params["timeout"]) {
                        alertParams["timer"] = params["timeout"] * 1000;
                }
                if (!params["showButton"]) {
                        alertParams["showConfirmButton"] = false;
                }
                if ("" != params["buttonLabel"]) {
                        alertParams["confirmButtonText"] = params["buttonLabel"];
                }
                if ("" != params["type"]) {
                        alertParams["type"] = params["type"];
                }

                scJs_alert_sweetalert(params["message"], callbackOk, scJs_sweetalert_params(alertParams));
        }
} // _scAjaxShowMessage

<?php
$confirmButtonClass = '';
$cancelButtonClass  = '';
$confirmButtonFA    = '';
$cancelButtonFA     = '';
$confirmButtonFAPos = '';
$cancelButtonFAPos  = '';
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['style']) && '' != $this->arr_buttons['bsweetalert_ok']['style']) {
        $confirmButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_ok']['style'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['style']) && '' != $this->arr_buttons['bsweetalert_cancel']['style']) {
        $cancelButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_cancel']['style'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) {
        $confirmButtonFA = $this->arr_buttons['bsweetalert_ok']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) {
        $cancelButtonFA = $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_ok']['display_position']) {
        $confirmButtonFAPos = 'text_right';
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_cancel']['display_position']) {
        $cancelButtonFAPos = 'text_right';
}
?>
function scJs_alert(message, callbackOk, params) {
    message = message.replace(/<!--SC_NL-->/gi, "<br />");
        scJs_alert_sweetalert(message, callbackOk, scJs_sweetalert_params(params));
} // scJs_alert

function scJs_confirm(message, callbackOk, callbackCancel) {
        scJs_confirm_sweetalert(message, callbackOk, callbackCancel);
} // scJs_confirm

function scJs_alert_sweetalert(message, callbackOk, params) {
        var sweetAlertConfig;

        if (null == params) {
                params = {};
        }

        params['html'] = message;

        sweetAlertConfig = params;

        Swal.fire(sweetAlertConfig).then(function (result) {
                if (result.value) {
                        if (typeof callbackOk == "function") {
                                callbackOk();
                        }
                }
                else if (result.dismiss == Swal.DismissReason.timer || result.dismiss == Swal.DismissReason.close) {
                        Swal.close();
            $(".swal2-container.swal2-shown").remove();
                }
        else {
            console.log(result.dismiss);
        }
        });
} // scJs_alert_sweetalert

function scJs_confirm_sweetalert(message, callbackOk, callbackCancel) {
        var sweetAlertConfig, params = {};

        params['html'] = message;
        params['type'] = 'question';
        params['showCancelButton'] = true;

        sweetAlertConfig = scJs_sweetalert_params(params);

        Swal.fire(sweetAlertConfig).then(function (result) {
                if (result.value) {
                        callbackOk();
                }
                else if (result.dismiss === Swal.DismissReason.backdrop || result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason.esc) {
                        callbackCancel();
                }
        });
} // scJs_confirm_sweetalert

function scJs_sweetalert_params(params) {
        var parName, confirmText, confirmFA, confirmPos, cancelText, cancelFA, cancelPos, sweetAlertConfig;

        sweetAlertConfig = {
                customClass: {
                        popup: 'scSweetAlertPopup',
                        header: 'scSweetAlertHeader',
                        content: 'scSweetAlertMessage',
                        confirmButton: '<?php echo $confirmButtonClass; ?>',
                        cancelButton: '<?php echo $cancelButtonClass; ?>'
                }
        };

        confirmText = '<?php echo isset($this->arr_buttons['bsweetalert_ok']['value']) ? $this->arr_buttons['bsweetalert_ok']['value'] : $this->Ini->Nm_lang['lang_btns_cfrm'] ?>';
        confirmFA = '<?php echo $confirmButtonFA ?>';
        confirmPos = '<?php echo $confirmButtonFAPos ?>';
        cancelText = '<?php echo isset($this->arr_buttons['bsweetalert_cancel']['value']) ? $this->arr_buttons['bsweetalert_cancel']['value'] : $this->Ini->Nm_lang['lang_btns_cncl'] ?>';
        cancelFA = '<?php echo $cancelButtonFA ?>';
        cancelPos = '<?php echo $cancelButtonFAPos ?>';

        for (parName in params) {
                if ('confirmButtonText' == parName) {
                        confirmText = params[parName];
                }
                else if ('confirmButtonFA' == parName) {
                        confirmFA = params[parName];
                }
                else if ('confirmButtonFAPos' == parName) {
                        confirmPos = params[parName];
                }
                else if ('cancelButtonText' == parName) {
                        cancelText = params[parName];
                }
                else if ('cancelButtonFA' == parName) {
                        cancelFA = params[parName];
                }
                else if ('cancelButtonFAPos' == parName) {
                        cancelPos = params[parName];
                }
                else {
                        sweetAlertConfig[parName] = params[parName];
                }
        }

        if ('' != confirmFA) {
                if ('text_right' == confirmPos) {
                        confirmText = '<i class="fas ' + confirmFA + '"></i> ' + confirmText;
                }
                else {
                        confirmText += ' <i class="fas ' + confirmFA + '"></i>';
                }
        }
        if ('' != cancelFA) {
                if ('text_right' == cancelPos) {
                        cancelText = '<i class="fas ' + cancelFA + '"></i> ' + cancelText;
                }
                else {
                        cancelText += ' <i class="fas ' + cancelFA + '"></i>';
                }
        }

        sweetAlertConfig['confirmButtonText'] = confirmText;
        sweetAlertConfig['cancelButtonText'] = cancelText;

        if (sweetAlertConfig['toast']) {
                sweetAlertConfig['showConfirmButton'] = false;
                sweetAlertConfig['showCancelButton'] = false;
                sweetAlertConfig['customClass']['popup'] = 'scToastPopup';
                sweetAlertConfig['customClass']['header'] = 'scToastHeader';
                sweetAlertConfig['customClass']['content'] = 'scToastMessage';
                if (null == sweetAlertConfig['timer']) {
                        sweetAlertConfig['timer'] = 3000;
                }
                if (null == sweetAlertConfig["position"]) {
                        sweetAlertConfig["position"] = "center-end";
                }
        }

        return sweetAlertConfig;
} // scJs_sweetalert_params

  // ---------- Form
  function do_ajax_app_settings_mob_submit_form()
  {
    if (scEventControl_active("")) {
      setTimeout(function() { do_ajax_app_settings_mob_submit_form(); }, 500);
      return;
    }
    scAjaxHideMessage();
    var var_session_expire = scAjaxGetFieldSelect("session_expire");
    var var_remember_me = scAjaxGetFieldCheckbox("remember_me", ";");
    var var_cookie_expiration_time = scAjaxGetFieldText("cookie_expiration_time");
    var var_theme = scAjaxGetFieldText("theme");
    var var_language = scAjaxGetFieldCheckbox("language", ";");
    var var_login_mode = scAjaxGetFieldSelect("login_mode");
    var var_captcha = scAjaxGetFieldCheckbox("captcha", ";");
    var var_pswd_last_updated = scAjaxGetFieldText("pswd_last_updated");
    var var_brute_force = scAjaxGetFieldCheckbox("brute_force", ";");
    var var_brute_force_attempts = scAjaxGetFieldText("brute_force_attempts");
    var var_brute_force_time_block = scAjaxGetFieldText("brute_force_time_block");
    var var_retrieve_password = scAjaxGetFieldCheckbox("retrieve_password", ";");
    var var_recover_pswd = scAjaxGetFieldSelect("recover_pswd");
    var var_password_min = scAjaxGetFieldText("password_min");
    var var_password_strength = scAjaxGetFieldCheckbox("password_strength", ";");
    var var_group_administrator = scAjaxGetFieldSelect("group_administrator");
    var var_enable_2fa = scAjaxGetFieldCheckbox("enable_2fa", ";");
    var var_enable_2fa_expiration_time = scAjaxGetFieldText("enable_2fa_expiration_time");
    var var_enable_2fa_mode = scAjaxGetFieldSelect("enable_2fa_mode");
    var var_enable_2fa_api_type = scAjaxGetFieldRadio("enable_2fa_api_type");
    var var_enable_2fa_api = scAjaxGetFieldHidden("enable_2fa_api");
    var var_mfa_last_updated = scAjaxGetFieldText("mfa_last_updated");
    var var_new_users = scAjaxGetFieldCheckbox("new_users", ";");
    var var_req_email_act = scAjaxGetFieldCheckbox("req_email_act", ";");
    var var_send_email_adm = scAjaxGetFieldCheckbox("send_email_adm", ";");
    var var_group_default = scAjaxGetFieldSelect("group_default");
    var var_smtp_api = scAjaxGetFieldHidden("smtp_api");
    var var_smtp_server = scAjaxGetFieldText("smtp_server");
    var var_smtp_port = scAjaxGetFieldText("smtp_port");
    var var_smtp_security = scAjaxGetFieldSelect("smtp_security");
    var var_smtp_user = scAjaxGetFieldText("smtp_user");
    var var_smtp_pass = scAjaxGetFieldText("smtp_pass");
    var var_smtp_from_email = scAjaxGetFieldText("smtp_from_email");
    var var_smtp_from_name = scAjaxGetFieldText("smtp_from_name");
    var var_auth_sn_position = scAjaxGetFieldSelect("auth_sn_position");
    var var_auth_sn_fb = scAjaxGetFieldCheckbox("auth_sn_fb", ";");
    var var_auth_sn_fb_app_id = scAjaxGetFieldText("auth_sn_fb_app_id");
    var var_auth_sn_fb_secret = scAjaxGetFieldText("auth_sn_fb_secret");
    var var_auth_sn_x = scAjaxGetFieldCheckbox("auth_sn_x", ";");
    var var_auth_sn_x_key = scAjaxGetFieldText("auth_sn_x_key");
    var var_auth_sn_x_secret = scAjaxGetFieldText("auth_sn_x_secret");
    var var_auth_sn_google = scAjaxGetFieldCheckbox("auth_sn_google", ";");
    var var_auth_sn_google_client_id = scAjaxGetFieldText("auth_sn_google_client_id");
    var var_auth_sn_google_secret = scAjaxGetFieldText("auth_sn_google_secret");
    var var_nm_form_submit = document.F1.nm_form_submit.value;
    var var_nmgp_url_saida = document.F1.nmgp_url_saida.value;
    var var_nmgp_opcao = document.F1.nmgp_opcao.value;
    var var_nmgp_ancora = document.F1.nmgp_ancora.value;
    var var_nmgp_num_form = document.F1.nmgp_num_form.value;
    var var_nmgp_parms = document.F1.nmgp_parms.value;
    var var_script_case_init = document.F1.script_case_init.value;
    var var_csrf_token = scAjaxGetFieldText("csrf_token");
    scAjaxProcOn();
    x_ajax_app_settings_mob_submit_form(var_session_expire, var_remember_me, var_cookie_expiration_time, var_theme, var_language, var_login_mode, var_captcha, var_pswd_last_updated, var_brute_force, var_brute_force_attempts, var_brute_force_time_block, var_retrieve_password, var_recover_pswd, var_password_min, var_password_strength, var_group_administrator, var_enable_2fa, var_enable_2fa_expiration_time, var_enable_2fa_mode, var_enable_2fa_api_type, var_enable_2fa_api, var_mfa_last_updated, var_new_users, var_req_email_act, var_send_email_adm, var_group_default, var_smtp_api, var_smtp_server, var_smtp_port, var_smtp_security, var_smtp_user, var_smtp_pass, var_smtp_from_email, var_smtp_from_name, var_auth_sn_position, var_auth_sn_fb, var_auth_sn_fb_app_id, var_auth_sn_fb_secret, var_auth_sn_x, var_auth_sn_x_key, var_auth_sn_x_secret, var_auth_sn_google, var_auth_sn_google_client_id, var_auth_sn_google_secret, var_nm_form_submit, var_nmgp_url_saida, var_nmgp_opcao, var_nmgp_ancora, var_nmgp_num_form, var_nmgp_parms, var_script_case_init, var_csrf_token, do_ajax_app_settings_mob_submit_form_cb);
  } // do_ajax_app_settings_mob_submit_form

  function do_ajax_app_settings_mob_submit_form_cb(sResp)
  {
    scAjaxProcOff();
    oResp = scAjaxResponse(sResp);
    scAjaxUpdateErrors("valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors || "menu_link" == document.F1.nmgp_opcao.value)
    {
      $('.sc-js-ui-statusimg').css('display', 'none');
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxError_markList();
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (scAjaxIsOk())
    {
      scResetFormChanges();
      scAjaxShowMessage("success");
      scAjaxHideErrorDisplay("table");
      scLigEditLookupCall();
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['app_settings_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings_mob']['dashboard_info']['under_dashboard']) {
?>
      var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings_mob']['dashboard_info']['parent_widget']; ?>']");
      if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.nm_gp_move) {
        dbParentFrame[0].contentWindow.nm_gp_move("igual");
      }
<?php
}
?>
    }
    Nm_Proc_Atualiz = false;
    if (!scAjaxHasError())
    {
      scAjaxSetFields(false);
      scAjaxSetVariables();
      scAjaxSetMaster();
      if (scInlineFormSend())
      {
        self.parent.tb_remove();
        return;
      }
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxAlert(do_ajax_app_settings_mob_submit_form_cb_after_alert);
  } // do_ajax_app_settings_mob_submit_form_cb
  function do_ajax_app_settings_mob_submit_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_app_settings_mob_submit_form_cb_after_alert

  var scStatusDetail = {};

  function do_ajax_app_settings_mob_navigate_form()
  {
    if (scFormHasChanged) {
      scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', perform_ajax_app_settings_mob_navigate_form, function() {});
    } else {
      perform_ajax_app_settings_mob_navigate_form();
    }
  }

  function perform_ajax_app_settings_mob_navigate_form()
  {
    if (scRefreshTable())
    {
      return;
    }
  } // do_ajax_app_settings_mob_navigate_form

  var scMasterDetailParentIframe = "<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['app_settings_mob']['dashboard_info']['parent_widget'] ?>";
  var scMasterDetailIframe = {};
<?php
foreach ($this->Ini->sc_lig_iframe as $tmp_i => $tmp_v)
{
?>
  scMasterDetailIframe["<?php echo $tmp_i; ?>"] = "<?php echo $tmp_v; ?>";
<?php
}
?>
  function do_ajax_app_settings_mob_navigate_form_cb(sResp)
  {
    scAjaxProcOff();
    oResp = scAjaxResponse(sResp);
    var var_nmgp_opcao = document.F2.nmgp_opcao.value;
    scAjaxRedir();
    if (oResp['empty_filter'] && oResp['empty_filter'] == "ok")
    {
        document.F5.nmgp_opcao.value = "inicio";
        document.F5.nmgp_parms.value = "";
        document.F5.submit();
    }
    scAjaxClearErrors()
    scResetFormChanges()
    sc_mupload_ok = true;
    scAjaxSetFields(false);
    scAjaxSetVariables();
    scAjaxSetSummaryLine();
    scAjaxShowDebug();
    scAjaxSetLabel(true);
    scAjaxSetReadonly(true);
    scAjaxSetMaster();
    scAjaxSetNavStatus("b");
    scAjaxSetDisplay(true);
    scAjaxSetBtnVars();
    $('.sc-js-ui-statusimg').css('display', 'none');
    scAjaxAlert(do_ajax_app_settings_mob_navigate_form_cb_after_alert);
  } // do_ajax_app_settings_mob_navigate_form_cb
  function do_ajax_app_settings_mob_navigate_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
<?php
if ($this->Embutida_form)
{
?>
    do_ajax_app_settings_mob_restore_buttons();
<?php
}
?>
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_app_settings_mob_navigate_form_cb_after_alert

  function sc_hide_app_settings_mob_form()
  {
    for (var block_id in ajax_block_id) {
      $("#div_" + ajax_block_id[block_id]).hide();
    }
  } // sc_hide_app_settings_mob_form


  function scAjaxDetailProc()
  {
    return true;
  } // scAjaxDetailProc


  var ajax_error_geral = "";

  var ajax_error_type = new Array("valid", "onblur", "onchange", "onclick", "onfocus");

  var ajax_field_list = new Array();
  var ajax_field_Dt_Hr = new Array();
  ajax_field_list[0] = "session_expire";
  ajax_field_list[1] = "remember_me";
  ajax_field_list[2] = "cookie_expiration_time";
  ajax_field_list[3] = "theme";
  ajax_field_list[4] = "language";
  ajax_field_list[5] = "login_mode";
  ajax_field_list[6] = "captcha";
  ajax_field_list[7] = "pswd_last_updated";
  ajax_field_list[8] = "brute_force";
  ajax_field_list[9] = "brute_force_attempts";
  ajax_field_list[10] = "brute_force_time_block";
  ajax_field_list[11] = "retrieve_password";
  ajax_field_list[12] = "recover_pswd";
  ajax_field_list[13] = "password_min";
  ajax_field_list[14] = "password_strength";
  ajax_field_list[15] = "group_administrator";
  ajax_field_list[16] = "enable_2fa";
  ajax_field_list[17] = "enable_2fa_expiration_time";
  ajax_field_list[18] = "enable_2fa_mode";
  ajax_field_list[19] = "enable_2fa_api_type";
  ajax_field_list[20] = "enable_2fa_api";
  ajax_field_list[21] = "mfa_last_updated";
  ajax_field_list[22] = "new_users";
  ajax_field_list[23] = "req_email_act";
  ajax_field_list[24] = "send_email_adm";
  ajax_field_list[25] = "group_default";
  ajax_field_list[26] = "smtp_api";
  ajax_field_list[27] = "smtp_server";
  ajax_field_list[28] = "smtp_port";
  ajax_field_list[29] = "smtp_security";
  ajax_field_list[30] = "smtp_user";
  ajax_field_list[31] = "smtp_pass";
  ajax_field_list[32] = "smtp_from_email";
  ajax_field_list[33] = "smtp_from_name";
  ajax_field_list[34] = "auth_sn_position";
  ajax_field_list[35] = "auth_sn_fb";
  ajax_field_list[36] = "auth_sn_fb_app_id";
  ajax_field_list[37] = "auth_sn_fb_secret";
  ajax_field_list[38] = "auth_sn_x";
  ajax_field_list[39] = "auth_sn_x_key";
  ajax_field_list[40] = "auth_sn_x_secret";
  ajax_field_list[41] = "auth_sn_google";
  ajax_field_list[42] = "auth_sn_google_client_id";
  ajax_field_list[43] = "auth_sn_google_secret";

  var ajax_block_list = new Array();
  ajax_block_list[0] = "0";
  ajax_block_list[1] = "1";
  ajax_block_list[2] = "2";
  ajax_block_list[3] = "3";
  ajax_block_list[4] = "4";
  ajax_block_list[5] = "5";

  var ajax_error_list = {
    "session_expire": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_session_expire'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "remember_me": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_remember_me'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "cookie_expiration_time": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_cookie_exp_time'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "theme": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_theme'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "language": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_language'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "login_mode": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_login_mode'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "captcha": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_captcha'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "pswd_last_updated": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_pswd_last_updated'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "brute_force": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_brute_force'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "brute_force_attempts": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_bf_attempts'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "brute_force_time_block": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_bf_time_bl'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "retrieve_password": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_retrieve_password'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "recover_pswd": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_recover_pswd'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "password_min": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_password_min'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "password_strength": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_password_strength'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "group_administrator": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_group_administrator'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "enable_2fa": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_2fa'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "enable_2fa_expiration_time": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_2fa_exp_time'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "enable_2fa_mode": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_enable_2fa_mode'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "enable_2fa_api_type": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_enable_2fa_api_type'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "enable_2fa_api": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_enable_2fa_api'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "mfa_last_updated": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_mfa_last_updated'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "new_users": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_new_users'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "req_email_act": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_req_email_act'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "send_email_adm": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_send_email_adm'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "group_default": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_group_default'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "smtp_api": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_smtp_api'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "smtp_server": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_smtp_server'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "smtp_port": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_smtp_port'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "smtp_security": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_smtp_security'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "smtp_user": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_smtp_user'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "smtp_pass": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_smtp_smtp_pass'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "smtp_from_email": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_smtp_from_email'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "smtp_from_name": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_smtp_from_name'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "auth_sn_position": {"label": "<?php echo $this->Ini->Nm_lang['lang_sec_set_sn_position'] ?>", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "auth_sn_fb": {"label": "Facebook", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "auth_sn_fb_app_id": {"label": "APP ID", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "auth_sn_fb_secret": {"label": "Secret", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "auth_sn_x": {"label": "X (Twitter)", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "auth_sn_x_key": {"label": "Key", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "auth_sn_x_secret": {"label": "Secret", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "auth_sn_google": {"label": "Google", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "auth_sn_google_client_id": {"label": "Client ID", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5},
    "auth_sn_google_secret": {"label": "Secret", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 5}
  };
  var ajax_error_timeout = 5;

  var ajax_block_id = {
    "0": "hidden_bloco_0",
    "1": "hidden_bloco_1",
    "2": "hidden_bloco_2",
    "3": "hidden_bloco_3",
    "4": "hidden_bloco_4",
    "5": "hidden_bloco_5"
  };

  var ajax_block_tab = {
    "hidden_bloco_0": "",
    "hidden_bloco_1": "",
    "hidden_bloco_2": "",
    "hidden_bloco_3": "",
    "hidden_bloco_4": "",
    "hidden_bloco_5": ""
  };

  var ajax_field_mult = {
    "session_expire": new Array(),
    "remember_me": new Array(),
    "cookie_expiration_time": new Array(),
    "theme": new Array(),
    "language": new Array(),
    "login_mode": new Array(),
    "captcha": new Array(),
    "pswd_last_updated": new Array(),
    "brute_force": new Array(),
    "brute_force_attempts": new Array(),
    "brute_force_time_block": new Array(),
    "retrieve_password": new Array(),
    "recover_pswd": new Array(),
    "password_min": new Array(),
    "password_strength": new Array(),
    "group_administrator": new Array(),
    "enable_2fa": new Array(),
    "enable_2fa_expiration_time": new Array(),
    "enable_2fa_mode": new Array(),
    "enable_2fa_api_type": new Array(),
    "enable_2fa_api": new Array(),
    "mfa_last_updated": new Array(),
    "new_users": new Array(),
    "req_email_act": new Array(),
    "send_email_adm": new Array(),
    "group_default": new Array(),
    "smtp_api": new Array(),
    "smtp_server": new Array(),
    "smtp_port": new Array(),
    "smtp_security": new Array(),
    "smtp_user": new Array(),
    "smtp_pass": new Array(),
    "smtp_from_email": new Array(),
    "smtp_from_name": new Array(),
    "auth_sn_position": new Array(),
    "auth_sn_fb": new Array(),
    "auth_sn_fb_app_id": new Array(),
    "auth_sn_fb_secret": new Array(),
    "auth_sn_x": new Array(),
    "auth_sn_x_key": new Array(),
    "auth_sn_x_secret": new Array(),
    "auth_sn_google": new Array(),
    "auth_sn_google_client_id": new Array(),
    "auth_sn_google_secret": new Array()
  };
  ajax_field_mult["session_expire"][1] = "session_expire";
  ajax_field_mult["remember_me"][1] = "remember_me";
  ajax_field_mult["cookie_expiration_time"][1] = "cookie_expiration_time";
  ajax_field_mult["theme"][1] = "theme";
  ajax_field_mult["language"][1] = "language";
  ajax_field_mult["login_mode"][1] = "login_mode";
  ajax_field_mult["captcha"][1] = "captcha";
  ajax_field_mult["pswd_last_updated"][1] = "pswd_last_updated";
  ajax_field_mult["brute_force"][1] = "brute_force";
  ajax_field_mult["brute_force_attempts"][1] = "brute_force_attempts";
  ajax_field_mult["brute_force_time_block"][1] = "brute_force_time_block";
  ajax_field_mult["retrieve_password"][1] = "retrieve_password";
  ajax_field_mult["recover_pswd"][1] = "recover_pswd";
  ajax_field_mult["password_min"][1] = "password_min";
  ajax_field_mult["password_strength"][1] = "password_strength";
  ajax_field_mult["group_administrator"][1] = "group_administrator";
  ajax_field_mult["enable_2fa"][1] = "enable_2fa";
  ajax_field_mult["enable_2fa_expiration_time"][1] = "enable_2fa_expiration_time";
  ajax_field_mult["enable_2fa_mode"][1] = "enable_2fa_mode";
  ajax_field_mult["enable_2fa_api_type"][1] = "enable_2fa_api_type";
  ajax_field_mult["enable_2fa_api"][1] = "enable_2fa_api";
  ajax_field_mult["mfa_last_updated"][1] = "mfa_last_updated";
  ajax_field_mult["new_users"][1] = "new_users";
  ajax_field_mult["req_email_act"][1] = "req_email_act";
  ajax_field_mult["send_email_adm"][1] = "send_email_adm";
  ajax_field_mult["group_default"][1] = "group_default";
  ajax_field_mult["smtp_api"][1] = "smtp_api";
  ajax_field_mult["smtp_server"][1] = "smtp_server";
  ajax_field_mult["smtp_port"][1] = "smtp_port";
  ajax_field_mult["smtp_security"][1] = "smtp_security";
  ajax_field_mult["smtp_user"][1] = "smtp_user";
  ajax_field_mult["smtp_pass"][1] = "smtp_pass";
  ajax_field_mult["smtp_from_email"][1] = "smtp_from_email";
  ajax_field_mult["smtp_from_name"][1] = "smtp_from_name";
  ajax_field_mult["auth_sn_position"][1] = "auth_sn_position";
  ajax_field_mult["auth_sn_fb"][1] = "auth_sn_fb";
  ajax_field_mult["auth_sn_fb_app_id"][1] = "auth_sn_fb_app_id";
  ajax_field_mult["auth_sn_fb_secret"][1] = "auth_sn_fb_secret";
  ajax_field_mult["auth_sn_x"][1] = "auth_sn_x";
  ajax_field_mult["auth_sn_x_key"][1] = "auth_sn_x_key";
  ajax_field_mult["auth_sn_x_secret"][1] = "auth_sn_x_secret";
  ajax_field_mult["auth_sn_google"][1] = "auth_sn_google";
  ajax_field_mult["auth_sn_google_client_id"][1] = "auth_sn_google_client_id";
  ajax_field_mult["auth_sn_google_secret"][1] = "auth_sn_google_secret";

  var ajax_field_id = {
    "session_expire": new Array("hidden_field_label_session_expire", "hidden_field_data_session_expire"),
    "remember_me": new Array("hidden_field_label_remember_me", "hidden_field_data_remember_me"),
    "cookie_expiration_time": new Array("hidden_field_label_cookie_expiration_time", "hidden_field_data_cookie_expiration_time"),
    "theme": new Array("hidden_field_label_theme", "hidden_field_data_theme"),
    "language": new Array("hidden_field_label_language", "hidden_field_data_language"),
    "login_mode": new Array("hidden_field_label_login_mode", "hidden_field_data_login_mode"),
    "captcha": new Array("hidden_field_label_captcha", "hidden_field_data_captcha"),
    "pswd_last_updated": new Array("hidden_field_label_pswd_last_updated", "hidden_field_data_pswd_last_updated"),
    "brute_force": new Array("hidden_field_label_brute_force", "hidden_field_data_brute_force"),
    "brute_force_attempts": new Array("hidden_field_label_brute_force_attempts", "hidden_field_data_brute_force_attempts"),
    "brute_force_time_block": new Array("hidden_field_label_brute_force_time_block", "hidden_field_data_brute_force_time_block"),
    "retrieve_password": new Array("hidden_field_label_retrieve_password", "hidden_field_data_retrieve_password"),
    "recover_pswd": new Array("hidden_field_label_recover_pswd", "hidden_field_data_recover_pswd"),
    "password_min": new Array("hidden_field_label_password_min", "hidden_field_data_password_min"),
    "password_strength": new Array("hidden_field_label_password_strength", "hidden_field_data_password_strength"),
    "group_administrator": new Array("hidden_field_label_group_administrator", "hidden_field_data_group_administrator"),
    "enable_2fa": new Array("hidden_field_label_enable_2fa", "hidden_field_data_enable_2fa"),
    "enable_2fa_expiration_time": new Array("hidden_field_label_enable_2fa_expiration_time", "hidden_field_data_enable_2fa_expiration_time"),
    "enable_2fa_mode": new Array("hidden_field_label_enable_2fa_mode", "hidden_field_data_enable_2fa_mode"),
    "enable_2fa_api_type": new Array("hidden_field_label_enable_2fa_api_type", "hidden_field_data_enable_2fa_api_type"),
    "enable_2fa_api": new Array("hidden_field_label_enable_2fa_api", "hidden_field_data_enable_2fa_api"),
    "mfa_last_updated": new Array("hidden_field_label_mfa_last_updated", "hidden_field_data_mfa_last_updated"),
    "new_users": new Array("hidden_field_label_new_users", "hidden_field_data_new_users"),
    "req_email_act": new Array("hidden_field_label_req_email_act", "hidden_field_data_req_email_act"),
    "send_email_adm": new Array("hidden_field_label_send_email_adm", "hidden_field_data_send_email_adm"),
    "group_default": new Array("hidden_field_label_group_default", "hidden_field_data_group_default"),
    "smtp_api": new Array("hidden_field_label_smtp_api", "hidden_field_data_smtp_api"),
    "smtp_server": new Array("hidden_field_label_smtp_server", "hidden_field_data_smtp_server"),
    "smtp_port": new Array("hidden_field_label_smtp_port", "hidden_field_data_smtp_port"),
    "smtp_security": new Array("hidden_field_label_smtp_security", "hidden_field_data_smtp_security"),
    "smtp_user": new Array("hidden_field_label_smtp_user", "hidden_field_data_smtp_user"),
    "smtp_pass": new Array("hidden_field_label_smtp_pass", "hidden_field_data_smtp_pass"),
    "smtp_from_email": new Array("hidden_field_label_smtp_from_email", "hidden_field_data_smtp_from_email"),
    "smtp_from_name": new Array("hidden_field_label_smtp_from_name", "hidden_field_data_smtp_from_name"),
    "auth_sn_position": new Array("hidden_field_label_auth_sn_position", "hidden_field_data_auth_sn_position"),
    "auth_sn_fb": new Array("hidden_field_label_auth_sn_fb", "hidden_field_data_auth_sn_fb"),
    "auth_sn_fb_app_id": new Array("hidden_field_label_auth_sn_fb_app_id", "hidden_field_data_auth_sn_fb_app_id"),
    "auth_sn_fb_secret": new Array("hidden_field_label_auth_sn_fb_secret", "hidden_field_data_auth_sn_fb_secret"),
    "auth_sn_x": new Array("hidden_field_label_auth_sn_x", "hidden_field_data_auth_sn_x"),
    "auth_sn_x_key": new Array("hidden_field_label_auth_sn_x_key", "hidden_field_data_auth_sn_x_key"),
    "auth_sn_x_secret": new Array("hidden_field_label_auth_sn_x_secret", "hidden_field_data_auth_sn_x_secret"),
    "auth_sn_google": new Array("hidden_field_label_auth_sn_google", "hidden_field_data_auth_sn_google"),
    "auth_sn_google_client_id": new Array("hidden_field_label_auth_sn_google_client_id", "hidden_field_data_auth_sn_google_client_id"),
    "auth_sn_google_secret": new Array("hidden_field_label_auth_sn_google_secret", "hidden_field_data_auth_sn_google_secret")
  };

  var ajax_read_only = {
    "session_expire": "off",
    "remember_me": "off",
    "cookie_expiration_time": "off",
    "theme": "off",
    "language": "off",
    "login_mode": "off",
    "captcha": "off",
    "pswd_last_updated": "off",
    "brute_force": "off",
    "brute_force_attempts": "off",
    "brute_force_time_block": "off",
    "retrieve_password": "off",
    "recover_pswd": "off",
    "password_min": "off",
    "password_strength": "off",
    "group_administrator": "off",
    "enable_2fa": "off",
    "enable_2fa_expiration_time": "off",
    "enable_2fa_mode": "off",
    "enable_2fa_api_type": "off",
    "enable_2fa_api": "off",
    "mfa_last_updated": "off",
    "new_users": "off",
    "req_email_act": "off",
    "send_email_adm": "off",
    "group_default": "off",
    "smtp_api": "off",
    "smtp_server": "off",
    "smtp_port": "off",
    "smtp_security": "off",
    "smtp_user": "off",
    "smtp_pass": "off",
    "smtp_from_email": "off",
    "smtp_from_name": "off",
    "auth_sn_position": "off",
    "auth_sn_fb": "off",
    "auth_sn_fb_app_id": "off",
    "auth_sn_fb_secret": "off",
    "auth_sn_x": "off",
    "auth_sn_x_key": "off",
    "auth_sn_x_secret": "off",
    "auth_sn_google": "off",
    "auth_sn_google_client_id": "off",
    "auth_sn_google_secret": "off"
  };
  var bRefreshTable = false;
  function scRefreshTable()
  {
    return false;
  }

  function scAjaxDetailValue(sIndex, sValue)
  {
    var aValue = new Array();
    aValue[0] = {"value" : sValue};
    if ("session_expire" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("remember_me" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("cookie_expiration_time" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("theme" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("language" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("login_mode" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("captcha" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("pswd_last_updated" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("brute_force" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("brute_force_attempts" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("brute_force_time_block" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("retrieve_password" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("recover_pswd" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("password_min" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("password_strength" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("group_administrator" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("enable_2fa" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("enable_2fa_expiration_time" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("enable_2fa_mode" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("enable_2fa_api_type" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("enable_2fa_api" == sIndex)
    {
      scAjaxSetFieldLabel(sIndex, aValue);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("mfa_last_updated" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("new_users" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("req_email_act" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("send_email_adm" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("group_default" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("smtp_api" == sIndex)
    {
      scAjaxSetFieldLabel(sIndex, aValue);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("smtp_server" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("smtp_port" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("smtp_security" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("smtp_user" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("smtp_pass" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("smtp_from_email" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("smtp_from_name" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("auth_sn_position" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("auth_sn_fb" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("auth_sn_fb_app_id" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("auth_sn_fb_secret" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("auth_sn_x" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("auth_sn_x_key" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("auth_sn_x_secret" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("auth_sn_google" == sIndex)
    {
      scAjaxSetFieldCheckbox(sIndex, aValue, null, 1, null, null, "", "", "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("auth_sn_google_client_id" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("auth_sn_google_secret" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    scAjaxSetFieldInnerHtml(sIndex, aValue);
  }
 </SCRIPT>
