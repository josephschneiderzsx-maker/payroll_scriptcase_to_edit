<?php

class grid_income_offday_ot_resumo
{
    const GROUPBY_ORIGINAL = 1;
    const GROUPBY_COMPARISON = 2;
    const GROUPBY_PERC_CHANGE = 3;
    const TOTAL_ARRAY_LABEL_INDEX = 4;
    const TOTAL_ARRAY_VALUE_INDEX = 5;

   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $total;
   var $tipo;
   var $nm_data;
   var $NM_res_sem_reg;
   var $NM_export;
   var $prim_linha;
   var $que_linha;
   var $css_line_back; 
   var $css_line_fonf; 
   var $comando_grafico;
   var $resumo_campos;
   var $nm_location;
   var $Print_All;
   var $NM_raiz_img; 
   var $NM_tit_val; 
   var $NM_totaliz_hrz; 
   var $link_graph_tot; 
   var $Tot_ger; 
   var $nmgp_botoes     = array();
   var $nm_btn_exist    = array();
   var $nm_btn_label    = array(); 
   var $nm_btn_disabled = array();
   var $array_total_dept;
   var $array_total_geral;
   var $array_tot_lin;
   var $array_final;
   var $array_links;
   var $array_links_tit;
   var $array_export;
   var $quant_colunas;
   var $conv_col;
   var $count_ger;
   var $sum_ot_hh_o;
   var $sum_ot_hh_o_pm;
   var $sum_income_offday_ot;
   var $sc_proc_quebra_dept;
   var $count_dept;
   var $sum_dept_ot_hh_o;
   var $sum_dept_ot_hh_o_pm;
   var $sum_dept_income_offday_ot;

   //---- 
   function __construct($tipo = "")
   {
      $this->Graf_left_dat   = true;
      $this->Graf_left_tot   = true;
      $this->NM_export       = false;
      $this->NM_totaliz_hrz  = false;
      $this->link_graph_tot  = array();
      $this->proc_res_grid   = false;
      $this->array_final     = array();
      $this->array_links     = array();
      $this->array_links_tit = array();
      $this->array_export    = array();
      $this->resumo_campos    = array();
      $this->comando_grafico  = array();
      $this->array_total_dept = array();
      $this->array_general_total = array();
      $this->nm_data = new nm_data("en_us");
      if ("" != $tipo && "out" == strtolower($tipo))
      {
         $this->NM_tipo = "out";
      }
      else
      {
         $this->NM_tipo = "pag";
      }
   }

   //---- 
   function initializeButtons()
   {
      $this->nmgp_botoes['group_1'] = "on";
      $this->nmgp_botoes['group_1'] = "on";
      $this->nmgp_botoes['xls'] = "on";
      $this->nmgp_botoes['imp'] = "on";
      $this->nmgp_botoes['xls'] = "on";
      $this->nmgp_botoes['print'] = "on";
      $this->nmgp_botoes['html'] = "on";
      $this->nmgp_botoes['gridsave'] = "on";
      $this->nmgp_botoes['gridsavesession'] = "on";
      $this->nmgp_botoes['chart_exit'] = "on";

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['grid_income_offday_ot'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['grid_income_offday_ot'];

              $this->nmgp_botoes['first']          = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['back']           = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['last']           = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['forward']        = $tmpDashboardButtons['grid_navigate']  ? 'on' : 'off';
              $this->nmgp_botoes['summary']        = $tmpDashboardButtons['grid_summary']   ? 'on' : 'off';
              $this->nmgp_botoes['qsearch']        = $tmpDashboardButtons['grid_qsearch']   ? 'on' : 'off';
              $this->nmgp_botoes['dynsearch']      = $tmpDashboardButtons['grid_dynsearch'] ? 'on' : 'off';
              $this->nmgp_botoes['filter']         = $tmpDashboardButtons['grid_filter']    ? 'on' : 'off';
              $this->nmgp_botoes['sel_col']        = $tmpDashboardButtons['grid_sel_col']   ? 'on' : 'off';
              $this->nmgp_botoes['sort_col']       = $tmpDashboardButtons['grid_sort_col']  ? 'on' : 'off';
              $this->nmgp_botoes['goto']           = $tmpDashboardButtons['grid_goto']      ? 'on' : 'off';
              $this->nmgp_botoes['qtline']         = $tmpDashboardButtons['grid_lineqty']   ? 'on' : 'off';
              $this->nmgp_botoes['navpage']        = $tmpDashboardButtons['grid_navpage']   ? 'on' : 'off';
              $this->nmgp_botoes['pdf']            = $tmpDashboardButtons['grid_pdf']       ? 'on' : 'off';
              $this->nmgp_botoes['xls']            = $tmpDashboardButtons['grid_xls']       ? 'on' : 'off';
              $this->nmgp_botoes['xml']            = $tmpDashboardButtons['grid_xml']       ? 'on' : 'off';
              $this->nmgp_botoes['json']           = $tmpDashboardButtons['grid_json']      ? 'on' : 'off';
              $this->nmgp_botoes['csv']            = $tmpDashboardButtons['grid_csv']       ? 'on' : 'off';
              $this->nmgp_botoes['rtf']            = $tmpDashboardButtons['grid_rtf']       ? 'on' : 'off';
              $this->nmgp_botoes['word']           = $tmpDashboardButtons['grid_word']      ? 'on' : 'off';
              $this->nmgp_botoes['print']          = $tmpDashboardButtons['grid_print']     ? 'on' : 'off';
              $this->nmgp_botoes['chart_conf']     = $tmpDashboardButtons['chart_conf']     ? 'on' : 'off';
              $this->nmgp_botoes['chart_settings'] = $tmpDashboardButtons['chart_settings'] ? 'on' : 'off';
              $this->nmgp_botoes['groupby']        = $tmpDashboardButtons['sel_groupby']    ? 'on' : 'off';
              $this->nmgp_botoes['chart_detail']   = $tmpDashboardButtons['chart_detail']   ? 'on' : 'off';
              $this->nmgp_botoes['new']            = $tmpDashboardButtons['grid_new']       ? 'on' : 'off';
              $this->nmgp_botoes['reload']         = $tmpDashboardButtons['grid_reload']    ? 'on' : 'off';
          }
      }

   if ($this->Ini->Embutida_iframe) {
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['sub_cons_iframe_btns'] as $BTN => $BTN_opc) {
           $this->nmgp_botoes[$BTN] = $BTN_opc;
       }
   }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_income_offday_ot']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_income_offday_ot']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_income_offday_ot']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
   }

    function info_initializeSummary()
    {
        $this->info_performInitializeActions();
        $this->info_initializeInfo();
        $this->info_initializeData();
        $this->info_loadProcessInfo();
        $this->info_saveSessionDefaultInfo();
        $this->info_loadSessionInfo();
        $this->info_processData();
        $this->info_changeSort();
        $this->info_changePagination();
    }

    function info_processSummary()
    {
        $this->info_orderAxys();
        $this->info_setPagination();
        $this->info_setComparisonLabels();

        if ($this->aux_isExport()) {
            $this->info_exportData();
        }
    }

    function info_performInitializeActions()
    {
        if ($this->aux_isPdf()) {
            @set_time_limit(0);
        }
    }

    function info_initializeInfo()
    {
        $this->SC_APP_info = [
            'group_by' => [
                'dimension' => [
                    'x' => [
                    ],
                    'y' => [
                        'dept',
                    ],
                    'order' => [
                        'dept',
                    ],
                    'unselected' => [
                    ],
                ],
                'metric' => [
                    'ot_hh_o-S',
                    'ot_hh_o_pm-S',
                    'income_offday_ot-S',
                ],
            ],
            'dimension' => [
                'dept' => [
                    'label' => "Department",
                    'datatype' => 'varchar',
                    'lowercase' => 'dept',
                    'summary_values_array' => 'array_total_dept',
                    'summary_line_values_array' => 'array_line_dept',
                    'order_by_index' => self::TOTAL_ARRAY_LABEL_INDEX,
                    'order_by_direction' => 'asc',
                    'order_by_direction_default' => 'asc',
                    'is_rating' => '' != '',
                    'rating_function' => '',
                    'fill_empty_axys' => true,
                    'align_css_class' => '',
                    'show_link' => true,
                    'link_field_var_name' => 'dept',
                    'link_protect_string' => '@aspass@',
                    'has_order' => true,
                    'limit_chart_items' => '0',
                ],
            ],
            'metric' => [
                'ot_hh_o-S' => [
                    'label' => "Offday AM OT HH (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")",
                    'label_justify_content' => "flex-end",
                    'value_index' => 1,
                    'is_rating' => '' != '',
                    'rating_function' => '',
                    'format_function' => 'aux_format_ot_hh_o_S',
                    'css_class' => "css_ot_hh_o_sum_field",
                    'show_percentuals' => false,
                    'show_percentuals_below' => false,
                    'has_order' => true,
                ],
                'ot_hh_o_pm-S' => [
                    'label' => "Offday PM OT HH (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")",
                    'label_justify_content' => "flex-end",
                    'value_index' => 2,
                    'is_rating' => '' != '',
                    'rating_function' => '',
                    'format_function' => 'aux_format_ot_hh_o_pm_S',
                    'css_class' => "css_ot_hh_o_pm_sum_field",
                    'show_percentuals' => false,
                    'show_percentuals_below' => false,
                    'has_order' => true,
                ],
                'income_offday_ot-S' => [
                    'label' => "Income Offday OT (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")",
                    'label_justify_content' => "flex-end",
                    'value_index' => 3,
                    'is_rating' => '' != '',
                    'rating_function' => '',
                    'format_function' => 'aux_format_income_offday_ot_S',
                    'css_class' => "css_income_offday_ot_sum_field",
                    'show_percentuals' => false,
                    'show_percentuals_below' => true,
                    'has_order' => true,
                ],
            ],
            'dimension_by_lowercase' => [
                'dept' => 'dept',
            ],
            'metric_by_index' => [
                2 => 'ot_hh_o-S',
                3 => 'ot_hh_o_pm-S',
                4 => 'income_offday_ot-S',
            ],
            'chart' => [
                'dept' => [
                    'ot_hh_o-S' => [
                        'has_chart' => true, 
                    ],
                    'ot_hh_o_pm-S' => [
                        'has_chart' => true, 
                    ],
                    'income_offday_ot-S' => [
                        'has_chart' => true, 
                    ],
                ],
            ],
            'options' => [
                'chart_create_time' => 150,
                'chart_icon_position_data' => 'left',
                'chart_icon_position_total' => 'left',
                'chart_has_analytical' => true,
                'chart_new_page' => true,
                'chart_grand_total' => false,
                'comparison_change_positive_color' => '#080',
                'comparison_change_negative_color' => '#C00',
                'comparison_change_positive_icon' => 'fas fa-long-arrow-alt-up',
                'comparison_change_negative_icon' => 'fas fa-long-arrow-alt-down',
                'display_abbreviated_value' => false,
                'display_inline_chart' => false,
                'display_label_on_total' => true,
                'display_seq' => true,
                'display_summary_every_page' => false,
                'display_summary_label' => "{$this->Ini->Nm_lang['lang_othr_smry_info']}",
                'display_summary_total' => 'last_page',
                'display_total_column' => true,
                'display_total_row' => true,
                'display_subtotal_row' => true,
                'display_total_top' => false,
                'has_limit_chart_items' => true,
                'has_summary_button' => false,
                'order_initial_metric' => '',
                'order_initial_rule' => '',
                'order_metric_apply_to_dimensions' => [],
                'starting_group_by' => false,
                'show_percentuals' => false,
                'tabular' => true,
                'use_fontawesome_order_icons' => true,
                'use_pagination' => false,
            ],
            'css' => [
                'mobile_inner_control' => 'sc-mobile-inner-control',
                'summary_container' => 'scGridTabelaTd',
                'summary_table' => 'scGridTabela',
                'header_row' => 'sc-ui-summary-header-row',
                'header_cell' => 'scGridSummaryLabel',
                'data_row' => 'scGridSummaryLine',
                'data_seq' => 'scGridSummaryGroupbySeq',
                'data_visible' => 'scGridSummaryGroupbyVisible',                
                'data_hover' => 'scGridSummaryGroupbyInvisible',
                'data_hover_display' => 'scGridSummaryGroupbyInvisibleDisplay',                
                'data_subtotal' => 'scGridSummarySubtotal',
                'data_total' => 'scGridSummaryTotal',
                'data_odd' => 'scGridSummaryLineOdd',
                'data_even' => 'scGridSummaryLineEven',
                'data_odd_grid' => 'scGridFieldOdd',
                'summary_line' => 'scGridTotal',
                'summary_font' => 'scGridTotalFont',
                'fixed_column_title' => '',
                'fixed_column_op' => '',
                'fixed_column_op_seq' => '',
                'fixed_column_field' => '',
                'fixed_column_is_fixed' => '',
                'fixed_column_pin_fix' => '',
                'fixed_column_pin_not_fixed' => '',
                'fixed_fa_pin' => 'fas fa-thumbtack',
                'sort_dimension' => 'sc-ui-sort-dimension',
                'sort_metric' => 'sc-ui-sort-metric',
                'comparison_label' => 'sc-comparison-label',
                'comparison_color_down' => 'sc-comparison-color-down',
                'comparison_color_up' => 'sc-comparison-color-up',
                'percentage_dimension' => 'sc-summary-metric-percentage',
                'valign_top' => 'sc-valign-top',
            ],
        ];

        if (is_file('../_lib/css/' . $this->Ini->str_schema_all . '_grid.php')) {
            include('../_lib/css/' . $this->Ini->str_schema_all . '_grid.php');

            if (isset($css_grid_smry_colorpos) && !empty($css_grid_smry_colorpos)) {
                $this->SC_APP_info['options'] ['comparison_change_positive_color'] = $css_grid_smry_colorpos;
            }
            if (isset($css_grid_smry_colorneg) && !empty($css_grid_smry_colorneg)) {
                $this->SC_APP_info['options'] ['comparison_change_negative_color'] = $css_grid_smry_colorneg;
            }
            if (isset($css_grid_smry_iconpos) && !empty($css_grid_smry_iconpos)) {
                $this->SC_APP_info['options'] ['comparison_change_positive_icon'] = $css_grid_smry_iconpos;
            }
            if (isset($css_grid_smry_iconneg) && !empty($css_grid_smry_iconneg)) {
                $this->SC_APP_info['options'] ['comparison_change_negative_icon'] = $css_grid_smry_iconneg;
            }
        }
    }

    function info_initializeData()
    {
        $this->SC_APP_data = [
            'line_count' => 1,
            'css_line_count' => 1,
            'fixed_col_count' => 0,
            'dimension_count' => [
                'x' => 0,
                'y' => 0
            ],
            'metric_count' => 0,
            'comparison_labels' => [
                'comparison_field' => '',
                self::GROUPBY_ORIGINAL => '',
                self::GROUPBY_COMPARISON => '',
                self::GROUPBY_PERC_CHANGE => ''
            ],
            'pagination' => [
                'page' => 1,
                'length' => 10,
                'page_count' => 1,
                'first' => 1,
                'last'=> 0,
                'back' => 0,
                'forward' => 0,
                'record_count' => 0,
                'page_link_count' => 5,
                'page_link_first' => '',
                'page_link_last' => '',
                'page_link_actual' => '',
                'page_link_list' => '',
                'page_link_html' => '',
                'page_navigation_description' => '',
            ],
            'metric_order' => [
                'using' => false,
                'name' => '',
                'rule' => '',
                'parameters' => [],
            ],
            'process' => [
                'is_process' => false,
                'option' => '',
                'parameters' => [],
            ],
            'dimension_label_rowspan' => '',
            'dimension_last_value' => [],
            'dimension_value_labels' => [
                'dept' => [],
            ],
            'ordered_x_axys' => [],
            'ordered_y_axys' => [],
            'ordered_x_matrix' => [],
            'ordered_y_matrix' => [],
            'chart_md5_initial' => '',
            'chart_md5_list' => [],
            'chart_links_to_grid' => [],
        ];
    }

    function info_loadProcessInfo()
    {
        if (isset($_POST['nmgp_opcao']) && 'ajax_navigate' == $_POST['nmgp_opcao'] && isset($_POST['opc']) && 'resumo' == $_POST['opc']) {
            $this->SC_APP_data['process'] ['is_process'] = true;

            $parameterList = explode('*scout', $_POST['parm']);
            foreach ($parameterList as $parameterString) {
                $parameterInfo = explode('*scin', $parameterString);
                if (isset($parameterInfo[1])) {
                    $this->SC_APP_data['process'] ['parameters'] [ $parameterInfo[0] ] = $parameterInfo[1];
                }

            }

            if (isset($this->SC_APP_data['process'] ['parameters'] ['change_dimension_sort']) && 'Y' == $this->SC_APP_data['process'] ['parameters'] ['change_dimension_sort']) {
                $this->SC_APP_data['process'] ['option'] = 'change_dimension_sort';
            } elseif (isset($this->SC_APP_data['process'] ['parameters'] ['change_metric_sort']) && 'Y' == $this->SC_APP_data['process'] ['parameters'] ['change_metric_sort']) {
                $this->SC_APP_data['process'] ['option'] = 'change_metric_sort';
            } elseif (isset($this->SC_APP_data['process'] ['parameters'] ['change_length_pagination']) && 'Y' == $this->SC_APP_data['process'] ['parameters'] ['change_length_pagination']) {
                $this->SC_APP_data['process'] ['option'] = 'change_length_pagination';
            } elseif (isset($this->SC_APP_data['process'] ['parameters'] ['change_page_pagination']) && 'Y' == $this->SC_APP_data['process'] ['parameters'] ['change_page_pagination']) {
                $this->SC_APP_data['process'] ['option'] = 'change_page_pagination';
            } elseif (isset($this->SC_APP_data['process'] ['parameters'] ['change_record_pagination']) && 'Y' == $this->SC_APP_data['process'] ['parameters'] ['change_record_pagination']) {
                $this->SC_APP_data['process'] ['option'] = 'change_record_pagination';
            }
        }
    }

    function info_updateOldPivotSessionInfo()
    {
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_group_by'] = [];
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_order'] = [];
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_x_axys'] = [];
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_y_axys'] = [];

        $dimensionCount = 0;

        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['x'] as $dimensionName) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_group_by'] [] = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_order'] [] = self::TOTAL_ARRAY_LABEL_INDEX == $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_index'] ? 'label' : 'value';
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_order_direction'] [] = $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_direction'];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_x_axys'] [] = $dimensionCount;

            $dimensionCount++;
        }

        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['y'] as $dimensionName) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_group_by'] [] = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_order'] [] = self::TOTAL_ARRAY_LABEL_INDEX == $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_index'] ? 'label' : 'value';
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_order_direction'] [] = $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_direction'];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_y_axys'] [] = $dimensionCount;

            $dimensionCount++;
        }

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['dimension_order'] = [];
        foreach ($this->SC_APP_info['dimension'] as $dimensionName => $dimensionInfo) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['dimension_order'] [$dimensionName] = $dimensionInfo['order_by_direction'];
        }
    }

    function info_saveSessionDefaultInfo()
    {
        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['last_displayed_group_by'])) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['last_displayed_group_by'] = 'sc_free_group_by';
            $this->SC_APP_info['options'] ['starting_group_by'] = true;
        }
        if ('sc_free_group_by' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['last_displayed_group_by']) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['last_displayed_group_by'] = 'sc_free_group_by';
            $this->SC_APP_info['options'] ['starting_group_by'] = true;
        }

        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_x_axys'])) {
            $this->info_deleteSummaryCache();
            $this->info_updateOldPivotSessionInfo();
        }

        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_using'])) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_using'] = false;
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_name'] = '';
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_rule'] = '';
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_parameters'] = [];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_info'] = [];
        }

        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_length'])) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_length'] = $this->SC_APP_data['pagination'] ['length'];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_first'] = $this->SC_APP_data['pagination'] ['first'];
        }

        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_info'])) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_info'] = [];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['heatmap_info'] = [];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['treemap_info'] = [];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chord_info'] = [];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['sankey_info'] = [];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['sunburst_info'] = [];
        }

        if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_tabular'])) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_tabular'] = $this->SC_APP_info['options'] ['tabular'];
        }

        if ($this->SC_APP_info['options'] ['starting_group_by']) {
            if ('' != $this->SC_APP_info['options'] ['order_initial_metric'] && '' != $this->SC_APP_info['options'] ['order_initial_rule'] && !$this->aux_hasXAxysDimensionField()) {
                $this->SC_APP_data['metric_order'] ['using'] = true;
                $this->SC_APP_data['metric_order'] ['name'] = $this->SC_APP_info['options'] ['order_initial_metric'];
                $this->SC_APP_data['metric_order'] ['rule'] = $this->SC_APP_info['options'] ['order_initial_rule'];
                $this->SC_APP_data['metric_order'] ['parameters'] = [];

                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_using'] = true;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_name'] = $this->SC_APP_info['options'] ['order_initial_metric'];
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_rule'] = $this->SC_APP_info['options'] ['order_initial_rule'];
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_parameters'] = [];
            }

            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['has_limit_chart_items'] = $this->SC_APP_info['options'] ['has_limit_chart_items'];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['limit_chart_items'] = '0';
        }
    }

    function info_loadSessionInfo()
    {
        $this->SC_APP_info['group_by'] ['dimension'] ['x'] = [];
        $this->SC_APP_info['group_by'] ['dimension'] ['y'] = [];
        $this->SC_APP_info['group_by'] ['metric'] = [];

        if (!empty($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['SC_Gb_Free_cmp']) && empty($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_x_axys']) && empty($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_y_axys'])) {
            foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['SC_Gb_Free_cmp'] as $dimensionNameLower => $dimensionAppField) {
                $dimensionName = $this->SC_APP_info['dimension_by_lowercase'] [$dimensionNameLower];

                $this->SC_APP_info['group_by'] ['dimension'] ['y'] [] = $dimensionName;
            }
        } else {
            $dimensionIndex = 0;
    
            foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['SC_Gb_Free_cmp'] as $dimensionNameLower => $dimensionAppField) {
                $dimensionName = $this->SC_APP_info['dimension_by_lowercase'] [$dimensionNameLower];
    
                $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_index'] = 'label' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_order'] [$dimensionIndex] ? self::TOTAL_ARRAY_LABEL_INDEX : self::TOTAL_ARRAY_VALUE_INDEX;
                $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_direction'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_order_direction'] [$dimensionIndex];
    
                if (in_array($dimensionIndex, $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_x_axys'])) {
                    $this->SC_APP_info['group_by'] ['dimension'] ['x'] [] = $dimensionName;
                }
                if (in_array($dimensionIndex, $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_y_axys'])) {
                    $this->SC_APP_info['group_by'] ['dimension'] ['y'] [] = $dimensionName;
                }
    
                $dimensionIndex++;
            }
        }

        $this->info_updateOldPivotSessionInfo();

        $this->SC_APP_info['group_by'] ['dimension'] ['order'] = array_merge($this->SC_APP_info['group_by'] ['dimension'] ['x'], $this->SC_APP_info['group_by'] ['dimension'] ['y']);

        foreach ($this->SC_APP_info['metric_by_index'] as $metricIndex => $metricName) {
            if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summarizing_fields_display'] ['sc_free_group_by'] [$metricIndex])) {
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summarizing_fields_display'] ['sc_free_group_by'] [$metricIndex] = ['display' => false];
            }
        }
        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summarizing_fields_order'] ['sc_free_group_by'] as $metricIndex) {
            if ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summarizing_fields_display'] ['sc_free_group_by'] [$metricIndex] ['display']) {
                $this->SC_APP_info['group_by'] ['metric'] [] = $this->SC_APP_info['metric_by_index'] [$metricIndex];
            }
        }

        $this->SC_APP_info['options'] ['tabular'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pivot_tabular'];

        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['dimension_order'] as $dimensionName => $dimensionOrder) {
            $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_direction'] = $dimensionOrder;
        }

        if (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['contr_array_resumo']) && 'NAO' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['contr_array_resumo']) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_first'] = 1;
        }
        $this->SC_APP_data['pagination'] ['length'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_length'];
        $this->SC_APP_data['pagination'] ['first'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_first'];

        $this->SC_APP_data['metric_order'] ['using'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_using'];
        $this->SC_APP_data['metric_order'] ['name'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_name'];
        $this->SC_APP_data['metric_order'] ['rule'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_rule'];
        $this->SC_APP_data['metric_order'] ['parameters'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_parameters'];
    }

    function info_processData()
    {
        $this->SC_APP_data['dimension_count'] ['x'] = count($this->SC_APP_info['group_by'] ['dimension'] ['x']);
        $this->SC_APP_data['dimension_count'] ['y'] = count($this->SC_APP_info['group_by'] ['dimension'] ['y']);

        $this->SC_APP_data['metric_count'] = count($this->SC_APP_info['group_by'] ['metric']);

        if ($this->aux_hasXAxysDimensionField()) {
            $this->SC_APP_data['dimension_label_rowspan'] = ' rowspan="' . ($this->SC_APP_data['dimension_count'] ['x'] + 1) . '"';
        }
    }

    function info_changeSort()
    {
        if ('change_dimension_sort' == $this->aux_getProcessOption()) {
            $this->info_deleteSummaryCache();
            $this->info_changeSort_dimension();
        } elseif ('change_metric_sort' == $this->aux_getProcessOption()) {
            $this->info_deleteSummaryCache();
            $this->info_changeSort_metric();
        }
    }

    function info_changeSort_dimension()
    {
        $sortDimension = $this->SC_APP_data['process'] ['parameters'] ['dimension'];
        if ($this->SC_APP_data['metric_order'] ['using'] && in_array($sortDimension, $this->SC_APP_info['options'] ['order_metric_apply_to_dimensions'])) {
            $sortRule = $this->SC_APP_info['dimension'] [$sortDimension] ['order_by_direction_default'];
        } else {
            $sortRule = $this->SC_APP_data['process'] ['parameters'] ['new_order'];
        }

        $this->SC_APP_info['dimension'] [$sortDimension] ['order_by_direction'] = $sortRule;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['dimension_order'] [$sortDimension] = $sortRule;

        if (in_array($sortDimension, $this->SC_APP_info['options'] ['order_metric_apply_to_dimensions'])) {
            $this->info_clearSort_metric();
        }
    }

    function info_changeSort_metric()
    {
        $sortMetricMd5 = $this->SC_APP_data['process'] ['parameters'] ['metric']; 
        $sortRule = $this->SC_APP_data['process'] ['parameters'] ['new_order'];

        if (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_info'] [$sortMetricMd5])) {
            if ('' != $sortRule) {
                $this->SC_APP_data['metric_order'] ['using'] = true;
                $this->SC_APP_data['metric_order'] ['name'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_info'] [$sortMetricMd5] ['metric'];
                $this->SC_APP_data['metric_order'] ['rule'] = $sortRule;
                $this->SC_APP_data['metric_order'] ['parameters'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_info'] [$sortMetricMd5] ['parameters'];

                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_using'] = true;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_name'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_info'] [$sortMetricMd5] ['metric'];
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_rule'] = $sortRule;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_parameters'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_info'] [$sortMetricMd5] ['parameters'];
            } else {
                $this->info_clearSort_metric();
            }
        }
    }

    function info_clearSort_metric()
    {
        $this->SC_APP_data['metric_order'] ['using'] = false;
        $this->SC_APP_data['metric_order'] ['name'] = '';
        $this->SC_APP_data['metric_order'] ['rule'] = '';
        $this->SC_APP_data['metric_order'] ['parameters'] = [];

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_using'] = false;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_name'] = '';
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_rule'] = '';
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_parameters'] = [];
    }

    function info_changePagination()
    {
        if ('change_length_pagination' == $this->aux_getProcessOption()) {
            $this->info_changePagination_length();
        } elseif ('change_page_pagination' == $this->aux_getProcessOption()) {
            $this->info_changePagination_page();
        } elseif ('change_record_pagination' == $this->aux_getProcessOption()) {
            $this->info_changePagination_record();
        }
    }

    function info_changePagination_length()
    {
        if ('all' == strtolower($this->SC_APP_data['process'] ['parameters'] ['length'])) {
            $paginationLength = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_record_count']; 
        } else {
            $paginationLength = (int)$this->SC_APP_data['process'] ['parameters'] ['length']; 
        }

        $this->SC_APP_data['pagination'] ['length'] = $paginationLength;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_length'] = $paginationLength;

        $this->SC_APP_data['pagination'] ['first'] = 1;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_first'] = 1;
    }

    function info_changePagination_page()
    {
        $paginationPage = (int)$this->SC_APP_data['process'] ['parameters'] ['page']; 
        $paginationFirst = (($paginationPage - 1) * $this->SC_APP_data['pagination'] ['length']) + 1;

        $this->SC_APP_data['pagination'] ['first'] = $paginationFirst;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_first'] = $paginationFirst;
    }

    function info_changePagination_record()
    {
        $paginationRecord = (int)$this->SC_APP_data['process'] ['parameters'] ['record']; 

        $this->SC_APP_data['pagination'] ['first'] = $paginationRecord;
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_first'] = $paginationRecord;
    }

    function info_orderAxys()
    {
        if (!$this->info_isUsingSummaryCache()) {
            $this->info_addOrderValues($this->SC_APP_data['ordered_x_axys'], $this->SC_APP_info['group_by'] ['dimension'] ['x'], $this->SC_APP_data['ordered_y_axys'], $this->SC_APP_info['group_by'] ['dimension'] ['y'], []);

            $this->info_addXColspan();
            $this->info_removeXDimensions();

            $this->info_addMetricOrderValues();

            $this->info_orderDimensions($this->SC_APP_data['ordered_x_axys']);
            $this->info_orderDimensions($this->SC_APP_data['ordered_y_axys']);

            $this->info_createOrderedXMatrix();
            $this->info_createOrderedYMatrix();

            $this->info_saveSummaryCache();
        } else {
            $this->info_loadSummaryCache();
        }
    }

    function info_addOrderValues(&$xOrderedValues, $xDimensionList, &$yOrderedValues, $yDimensionList, $parameterList)
    {
        if (count($xDimensionList) == 0 && count($yDimensionList) == 0) {
            return;
        }

        $usingXAxys = false;
        if (count($xDimensionList) == 0) {
            $thisDimensionField = array_shift($yDimensionList);
        } else {
            $usingXAxys = true;
            $thisDimensionField = array_shift($xDimensionList);
        }

        $thisSummArrayName = $this->SC_APP_info['dimension'] [$thisDimensionField] ['summary_values_array'];
        $thisSummArray = $this->$thisSummArrayName;
        $thisOrderByIndex = $this->SC_APP_info['dimension'] [$thisDimensionField] ['order_by_index'];
        $thisOrderByDirection = $this->SC_APP_info['dimension'] [$thisDimensionField] ['order_by_direction'];

        $originalParameterList = $parameterList;
        while (count($parameterList) != 0) {
            $thisParameter = array_shift($parameterList);
            $thisSummArray = $thisSummArray[$thisParameter];
        }

        foreach ($thisSummArray as $thisDimensionValue => $thisDimensionInfo) {
            $this->SC_APP_data['dimension_value_labels'] [$thisDimensionField] [$thisDimensionValue] = $thisDimensionInfo[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_LABEL_INDEX];

            $newDimensionItem = [
                'dimension' => $thisDimensionField,
                'dimension_order_value' => $thisDimensionInfo[self::GROUPBY_ORIGINAL] [$thisOrderByIndex],
                'dimension_order_direction' => $thisOrderByDirection,
                'children' => []
            ];

            $thisParameterList = array_merge($originalParameterList, [$thisDimensionValue]);

            if ($usingXAxys) {
                $xOrderedValues[$thisDimensionValue] = $newDimensionItem;
                $yOrderedValues[$thisDimensionValue] = $newDimensionItem;
                $this->info_addOrderValues($xOrderedValues[$thisDimensionValue] ['children'], $xDimensionList, $yOrderedValues[$thisDimensionValue] ['children'], $yDimensionList, $thisParameterList);
            } else {
                $yOrderedValues[$thisDimensionValue] = $newDimensionItem;
                $this->info_addOrderValues($xOrderedValues, $xDimensionList, $yOrderedValues[$thisDimensionValue] ['children'], $yDimensionList, $thisParameterList);
            }
        }
    }

    function info_addXColspan()
    {
        $this->info_addXColspanItem($this->SC_APP_data['ordered_x_axys']);
    }

    function info_addXColspanItem(&$orderedValues)
    {
        if (count($orderedValues) == 0) {
            return $this->SC_APP_data['metric_count'];
        }

        $total = 0;
        foreach ($orderedValues as $dimensionValue => $dimensionInfo) {
            $colSpan = $this->info_addXColspanItem($orderedValues[$dimensionValue] ['children']);

            $orderedValues[$dimensionValue] ['colspan'] = $colSpan;

            $total += $colSpan;
        }

        return $total;
    }

    function info_removeXDimensions()
    {
        if (!$this->aux_hasXAxysDimensionField()) {
            return;
        }

        $oldOrderedY = $this->SC_APP_data['ordered_y_axys'];
        $this->SC_APP_data['ordered_y_axys'] = [];
        $this->info_removeOrdered($oldOrderedY, $this->SC_APP_data['ordered_y_axys']);
    }

    function info_addMetricOrderValues()
    {
        $this->info_addMetricOrderValues_items($this->SC_APP_data['ordered_y_axys'], []);
    }

    function info_addMetricOrderValues_items(&$orderedValues, $parameters)
    {
        if (!$this->SC_APP_data['metric_order'] ['using']) {
            return;
        }

        foreach ($orderedValues as $dimensionValue => $dimensionInfo) {
            $thisParameters = array_merge($parameters, [$dimensionValue]);

            $metricArray = $this->aux_getMetricArray($this->SC_APP_data['metric_order'] ['parameters'], $thisParameters);

            $orderedValues[$dimensionValue] ['order_by_metric'] = true;
            $orderedValues[$dimensionValue] ['metric_order_value'] = $metricArray[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [ $this->SC_APP_data['metric_order'] ['name'] ] ['value_index'] ];
            $orderedValues[$dimensionValue] ['metric_order_direction'] = $this->SC_APP_data['metric_order'] ['rule'];

            $this->info_addMetricOrderValues_items($orderedValues[$dimensionValue] ['children'], $thisParameters);
        }
    }

    function info_removeOrdered($oldOrderedDimension, &$newOrderedDimension)
    {
        if (count($oldOrderedDimension) == 0) {
            return;
        }

        foreach ($oldOrderedDimension as $dimensionValue => $dimensionInfo) {
            $dimensionName = $dimensionInfo['dimension'];

            if (in_array($dimensionName, $this->SC_APP_info['group_by'] ['dimension'] ['x'])) {
                $this->info_removeOrdered($dimensionInfo['children'], $newOrderedDimension);
            } else {
                if (!isset($newOrderedDimension[$dimensionValue])) {
                    $newOrderedDimension[$dimensionValue] = [
                        'dimension' => $dimensionInfo['dimension'],
                        'dimension_order_value' => $dimensionInfo['dimension_order_value'],
                        'dimension_order_direction' => $dimensionInfo['dimension_order_direction'],
                        'children' => [],
                    ];
                }

                $this->info_mergeOrdered($dimensionInfo['children'], $newOrderedDimension[$dimensionValue] ['children']);
            }
        }
    }

    function info_mergeOrdered($oldOrderedDimension, &$newOrderedDimension)
    {
        if (count($oldOrderedDimension) == 0) {
            return;
        }

        foreach ($oldOrderedDimension as $dimensionValue => $dimensionInfo) {
            if (!isset($newOrderedDimension[$dimensionValue])) {
                $newOrderedDimension[$dimensionValue] = $dimensionInfo;
            } else {
                $this->info_mergeOrdered($dimensionInfo['children'], $newOrderedDimension[$dimensionValue] ['children']);
            }
        }
    }

    function info_orderDimensions(&$dimension)
    {
        if (count($dimension) == 0) {
            return;
        }

        uasort($dimension, function($a, $b) {
            if (isset($a['order_by_metric']) && (empty($this->SC_APP_info['options'] ['order_metric_apply_to_dimensions']) || in_array($a['dimension'], $this->SC_APP_info['options'] ['order_metric_apply_to_dimensions']))) {
                if ($a['metric_order_value'] == $b['metric_order_value']) {
                    if ('asc' == $a['dimension_order_direction']) {
                        return strnatcasecmp($a['dimension_order_value'], $b['dimension_order_value']);
                    } else {
                        return strnatcasecmp($b['dimension_order_value'], $a['dimension_order_value']);
                    }
                } elseif ('asc' == $a['metric_order_direction']) {
                    return strnatcasecmp($a['metric_order_value'], $b['metric_order_value']);
                } else {
                    return strnatcasecmp($b['metric_order_value'], $a['metric_order_value']);
                }
            } else {
                if ('asc' == $a['dimension_order_direction']) {
                    return strnatcasecmp($a['dimension_order_value'], $b['dimension_order_value']);
                } else {
                    return strnatcasecmp($b['dimension_order_value'], $a['dimension_order_value']);
                }
            }
        });

        foreach ($dimension as $dimensionKey => $dimensionInfo) {
            $this->info_orderDimensions($dimension[$dimensionKey] ['children']);
        }
    }

    function info_createOrderedXMatrix()
    {
        $this->info_addOrderedXRow($this->SC_APP_data['ordered_x_axys'], [], 0);
    }

    function info_addOrderedXRow($orderedDimension, $parameters, $dimensionLevel)
    {
        if (count($orderedDimension) == 0) {
            return;
        }

        if (!isset($this->SC_APP_data['ordered_x_matrix'] [$dimensionLevel])) {
            $this->SC_APP_data['ordered_x_matrix'] [$dimensionLevel] = [];
        }

        foreach ($orderedDimension as $dimensionValue => $dimensionInfo) {
            $thisParameters = array_merge($parameters, [$dimensionValue]);

            $this->SC_APP_data['ordered_x_matrix'] [$dimensionLevel] [] = [
                'dimension' => $dimensionValue,
                'dimensions' => $thisParameters,
                'colspan' => $dimensionInfo['colspan']
            ];

            $this->info_addOrderedXRow($dimensionInfo['children'], $thisParameters, $dimensionLevel + 1);
        }
    }

    function info_createOrderedYMatrix()
    {
        $this->info_addOrderedYRow($this->SC_APP_data['ordered_y_axys'], []);
    }

    function info_addOrderedYRow($orderedDimension, $orderParameters)
    {
        if (count($orderedDimension) == 0) {
            $this->SC_APP_data['ordered_y_matrix'] [] = [
                'dimensions' => $orderParameters,
                'type' => 'row',
                'colspan' => 1
            ];
            return;
        }

        foreach ($orderedDimension as $dimensionValue => $dimensionInfo)
        {
            $thisParameters = array_merge($orderParameters, [$dimensionValue]);
            $this->info_addOrderedYRow($dimensionInfo['children'], $thisParameters);
        }

        $parametersCount = count($orderParameters);
        $rowTotalType = $parametersCount == 0 ? 'total' : 'subtotal';

        if ('subtotal' != $rowTotalType || $this->SC_APP_info['options'] ['display_subtotal_row']) {
            $this->SC_APP_data['ordered_y_matrix'] [] = [
                'dimensions' => $orderParameters,
                'type' => $rowTotalType,
                'colspan' => $this->SC_APP_data['dimension_count'] ['y'] - $parametersCount + 1
            ];
        }
    }

    function info_setPagination()
    {
        $this->SC_APP_data['pagination'] ['record_count'] = count($this->SC_APP_data['ordered_y_matrix']);
        if ($this->aux_hasYAxysDimensionField()) {
            $this->SC_APP_data['pagination'] ['record_count']--;
        }
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['pagination_record_count'] = $this->SC_APP_data['pagination'] ['record_count'];

        if ($this->aux_hasPagination()) {
            $paginationLast = $this->SC_APP_data['pagination'] ['first'] + $this->SC_APP_data['pagination'] ['length'] - 1;
            if ($paginationLast < $this->SC_APP_data['pagination'] ['record_count']) {
                $this->SC_APP_data['pagination'] ['last'] = $paginationLast;
            } else {
                $this->SC_APP_data['pagination'] ['last'] = $this->SC_APP_data['pagination'] ['record_count'];
            }

            $this->SC_APP_data['pagination'] ['page_count'] = ceil($this->SC_APP_data['pagination'] ['record_count'] / $this->SC_APP_data['pagination'] ['length']);

            if (1 > $this->SC_APP_data['pagination'] ['first'] - $this->SC_APP_data['pagination'] ['length']) {
                $this->SC_APP_data['pagination'] ['back'] = 1;
            } else {
                $this->SC_APP_data['pagination'] ['back'] = $this->SC_APP_data['pagination'] ['first'] - $this->SC_APP_data['pagination'] ['length'];
            }

            if ($this->SC_APP_data['pagination'] ['record_count'] < $this->SC_APP_data['pagination'] ['last'] + 1) {
                $this->SC_APP_data['pagination'] ['forward'] = $this->SC_APP_data['pagination'] ['record_count'];
            } else {
                $this->SC_APP_data['pagination'] ['forward'] = $this->SC_APP_data['pagination'] ['last'] + 1;
            }

            $this->info_setPagination_navigationBar();
            $this->info_setPagination_jsonReturn();
        } else {
            $this->SC_APP_data['pagination'] ['first'] = 1;
            $this->SC_APP_data['pagination'] ['last'] = $this->SC_APP_data['pagination'] ['record_count'];
        }

        $this->SC_APP_data['line_count'] = $this->SC_APP_data['pagination'] ['first'];
        $this->SC_APP_data['css_line_count'] = $this->SC_APP_data['pagination'] ['first'];
    }

    function info_setPagination_navigationBar()
    {
        if ($this->SC_APP_data['pagination'] ['page_count'] < $this->SC_APP_data['pagination'] ['page_link_count']) {
            $this->SC_APP_data['pagination'] ['page_link_count'] = $this->SC_APP_data['pagination'] ['page_count'];
        }

        $this->SC_APP_data['pagination'] ['page_link_actual'] = ceil($this->SC_APP_data['pagination'] ['first'] / $this->SC_APP_data['pagination'] ['length']);

        $rightSideLinkCount = floor($this->SC_APP_data['pagination'] ['page_link_count'] / 2);
        $leftSideLinkCount = $rightSideLinkCount;
        if ($this->SC_APP_data['pagination'] ['page_link_count'] % 2 == 0) {
            $leftSideLinkCount--;
        }

        if ($this->SC_APP_data['pagination'] ['page_link_actual'] <= $leftSideLinkCount + 1) {
            $firstPageLink = 1;
        } else {
            $firstPageLink = $this->SC_APP_data['pagination'] ['page_link_actual'] - $leftSideLinkCount;
        }

        $lastPageLink = $firstPageLink + $leftSideLinkCount + $rightSideLinkCount;
        if ($lastPageLink > $this->SC_APP_data['pagination'] ['page_count']) {
            $pageShift = $this->SC_APP_data['pagination'] ['page_count'] - $lastPageLink;
            $lastPageLink = $this->SC_APP_data['pagination'] ['page_count'];
            $firstPageLink += $pageShift;
        }

        $this->SC_APP_data['pagination'] ['page_link_list'] = [];
        for ($i = $firstPageLink; $i <= $lastPageLink; $i++) {
            $this->SC_APP_data['pagination'] ['page_link_list'] [] = $i;
        }

        $this->SC_APP_data['pagination'] ['page_link_html'] = $this->aux_createPaginationLinks();
        $this->SC_APP_data['pagination'] ['page_navigation_description'] = $this->aux_createPaginationDescription();
    }

    function info_setPagination_jsonReturn()
    {
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_first',
            'value' => $this->SC_APP_data['pagination'] ['first']
        ];
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_last',
            'value' => $this->SC_APP_data['pagination'] ['last']
        ];
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_back',
            'value' => $this->SC_APP_data['pagination'] ['back']
        ];
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_forward',
            'value' => $this->SC_APP_data['pagination'] ['forward']
        ];

        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_count',
            'value' => $this->SC_APP_data['pagination'] ['record_count']
        ];
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_length',
            'value' => $this->SC_APP_data['pagination'] ['length']
        ];
        $this->Ini->Arr_result['setVar'] [] = [
            'var' => 'scPag_pageCount',
            'value' => $this->SC_APP_data['pagination'] ['page_count']
        ];

        $this->Ini->Arr_result['setJqueryVal'] [] = [
            'field' => 'res_brec_qtd_top',
            'value' => $this->SC_APP_data['pagination'] ['page_link_actual']
        ];
        $this->Ini->Arr_result['setJqueryVal'] [] = [
            'field' => 'res_brec_qtd_bot',
            'value' => $this->SC_APP_data['pagination'] ['page_link_actual']
        ];

        $this->Ini->Arr_result['setValue'] [] = [
            'field' => 'res_nav_top',
            'value' => $this->SC_APP_data['pagination'] ['page_link_html']
        ];
        $this->Ini->Arr_result['setValue'] [] = [
            'field' => 'res_nav_bot',
            'value' => $this->SC_APP_data['pagination'] ['page_link_html']
        ];

        $this->Ini->Arr_result['setValue'] [] = [
            'field' => 'res_summary_top',
            'value' => $this->SC_APP_data['pagination'] ['page_navigation_description']
        ];
        $this->Ini->Arr_result['setValue'] [] = [
            'field' => 'res_summary_bot',
            'value' => $this->SC_APP_data['pagination'] ['page_navigation_description']
        ];

        $this->Ini->Arr_result['exec_JS'] [] = [
            'function' => 'scPagination_navigation_control',
            'parm' => ''
        ];
    }

    function info_setComparisonLabels()
    {
        if ($this->aux_isComparison()) {
            $this->SC_APP_data['comparison_labels'] [self::GROUPBY_ORIGINAL] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['cond_pesq_compara'] [self::GROUPBY_ORIGINAL];
            $this->SC_APP_data['comparison_labels'] [self::GROUPBY_COMPARISON] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['cond_pesq_compara'] [self::GROUPBY_COMPARISON];
            $this->SC_APP_data['comparison_labels'] [self::GROUPBY_PERC_CHANGE] = $this->Ini->Nm_lang['lang_othr_comp_variation'];
        }
    }

    function info_isUsingSummaryCache()
    {
        return isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['using_summary_cache']) && $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['using_summary_cache'];
    }

    function info_saveSummaryCache()
    {
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['using_summary_cache'] = true;

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summary_cache'] = [
            'dimension_value_labels' => $this->SC_APP_data['dimension_value_labels'],
            'ordered_x_axys' => $this->SC_APP_data['ordered_x_axys'],
            'ordered_y_axys' => $this->SC_APP_data['ordered_y_axys'],
            'ordered_x_matrix' => $this->SC_APP_data['ordered_x_matrix'],
            'ordered_y_matrix' => $this->SC_APP_data['ordered_y_matrix'],
        ];
    }

    function info_loadSummaryCache()
    {
        $this->SC_APP_data['dimension_value_labels'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summary_cache'] ['dimension_value_labels'];
        $this->SC_APP_data['ordered_x_axys'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summary_cache'] ['ordered_x_axys'];
        $this->SC_APP_data['ordered_y_axys'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summary_cache'] ['ordered_y_axys'];
        $this->SC_APP_data['ordered_x_matrix'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summary_cache'] ['ordered_x_matrix'];
        $this->SC_APP_data['ordered_y_matrix'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summary_cache'] ['ordered_y_matrix'];
    }

    function info_deleteSummaryCache()
    {
        if (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['using_summary_cache'])) {
            unset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['using_summary_cache']);
            unset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summary_cache']);
        }
    }

    function info_exportData()
    {
        $exportInfo = [];
        $exportData = [];
        $exportColumnInfo = [];

        if ($this->aux_hasXAxysDimensionField()) {
            $lastXRow = count($this->SC_APP_data['ordered_x_matrix']) - 1;

            foreach ($this->SC_APP_data['ordered_x_matrix'] [$lastXRow] as $colDimensionInfo) {
                $thisColumnInfo = [];

                foreach ($colDimensionInfo['dimensions'] as $colDimensionIndex => $colDimensionValue) {
                    $colDimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['x'] [$colDimensionIndex];

                    $thisColumnInfo[$colDimensionValue] = $this->SC_APP_data['dimension_value_labels'] [$colDimensionName] [$colDimensionValue];
                }

                foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
                    $exportColumnInfo[] = [
                        'column_total' => false,
                        'column_label' => '',
                        'column_parameters' => $thisColumnInfo,
                        'metric_name' => $metricName,
                        'metric_label' => $this->SC_APP_info['metric'] [$metricName] ['label'],
                    ];
                }
            }
        } else {
            foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
                $exportColumnInfo[] = [
                    'column_total' => false,
                    'column_label' => '',
                    'column_parameters' => [],
                    'metric_name' => $metricName,
                    'metric_label' => $this->SC_APP_info['metric'] [$metricName] ['label'],
                ];
            }
        }

        foreach ($this->SC_APP_data['ordered_y_matrix'] as $rowDimensionInfo) {
            $exportRowInfo = [];

            foreach ($rowDimensionInfo['dimensions'] as $rowDimensionIndex => $rowDimensionValue) {
                $rowDimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$rowDimensionIndex];

                $exportRowInfo[$rowDimensionValue] = $this->SC_APP_data['dimension_value_labels'] [$rowDimensionName] [$rowDimensionValue];
            }

            $thisExportRow = [
                'row_parameters' => $exportRowInfo,
                'row_total' => empty($exportRowInfo),
                'row_label' => empty($exportRowInfo) ? $this->Ini->Nm_lang['lang_msgs_totl'] : '',
                'column_list' => []
            ];
            foreach ($exportColumnInfo as $thisExportColumnInfo) {
                $metricArray = $this->aux_getMetricArray(array_keys($thisExportColumnInfo['column_parameters']), array_keys($exportRowInfo));
                $metricValuePosition = $this->SC_APP_info['metric'] [ $thisExportColumnInfo['metric_name'] ] ['value_index'];

                $thisExportColumnInfo['metric_value'] = is_array($metricArray) && isset($metricArray[self::GROUPBY_ORIGINAL] [$metricValuePosition]) ? $metricArray[self::GROUPBY_ORIGINAL] [$metricValuePosition] : '';

                $thisExportRow['column_list'] [] = $thisExportColumnInfo;
            }

            if ($this->aux_hasXAxysDimensionField() && $this->SC_APP_info['options'] ['display_total_column']) {
                $metricArray = $this->aux_getLineMetricArray(array_keys($exportRowInfo));

                foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
                    $metricValuePosition = $this->SC_APP_info['metric'] [$metricName] ['value_index'];

                    $thisExportRow['column_list'] []  = [
                        'column_total' => true,
                        'column_label' => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
                        'metric_name' => $metricName,
                        'metric_label' => $this->SC_APP_info['metric'] [$metricName] ['label'],
                        'metric_value' => is_array($metricArray) && isset($metricArray[self::GROUPBY_ORIGINAL] [$metricValuePosition]) ? $metricArray[self::GROUPBY_ORIGINAL] [$metricValuePosition] : '',
                    ];
                }
            }

            $exportData[] = $thisExportRow;
        }

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['export_data'] = $exportData;

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['export_info'] = [
            'dimension_count' => [
                'x' => $this->SC_APP_data['dimension_count'] ['x'],
                'y' => $this->SC_APP_data['dimension_count'] ['y'],
            ],
            'dimension_value_labels' => $this->SC_APP_data['dimension_value_labels'],
            'ordered_x_matrix' => $this->SC_APP_data['ordered_x_matrix'],
        ];
    }

    function display_summary()
    {
        global $nm_saida;

        $this->display_css();
        $this->display_js();

        $this->display_inlineChart_startUp();

        $this->display_summary_header_pdf();

        $this->display_summary_container_init();

        $htmlCode = <<<SCEOT
<td class="{$this->SC_APP_info['css'] ['summary_container']} {$this->SC_APP_info['css'] ['mobile_inner_control']}">

SCEOT;
        $htmlCode .= $this->display_body();
        $htmlCode .= $this->display_inlineChart_setInlineChartMd5();
        $htmlCode .= <<<SCEOT
</td>

SCEOT;
        $nm_saida->saida($htmlCode);

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_drilldown'] ['chart_links_to_grid'] = $this->SC_APP_data['chart_links_to_grid'];

        $this->display_summary_container_end();

        $this->display_export_charts();

        $this->display_inlineChart_initialAjax();
    }

    function display_summary_header_pdf()
    {
        if ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['proc_pdf'] || $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['proc_pdf_vert']) {
            $this->monta_cabecalho();
        }    }

    function display_summary_container_init()
    {
        global $nm_saida;

        $htmlCode = <<<SCEOT
<tr id="summary_body" class="{$this->SC_APP_info['css'] ['mobile_inner_control']}">

SCEOT;

        $nm_saida->saida($htmlCode);

        if ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['ajax_nav']) {
            $_SESSION['scriptcase'] ['saida_html'] = '';
        }
    }

    function display_summary_container_end()
    {
        global $nm_saida;

        if ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['ajax_nav']) {
            if ($this->proc_res_grid) {
                $this->Ini->Arr_result['setValue'] [] = [
                    'field' => 'sc_res_grid',
                    'value' => NM_charset_to_utf8($_SESSION['scriptcase'] ['saida_html'])
                ];
            } else {
                $this->Ini->Arr_result['setValue'] [] = [
                    'field' => 'summary_body',
                    'value' => NM_charset_to_utf8($_SESSION['scriptcase'] ['saida_html'])
                ];
            }
            $_SESSION['scriptcase'] ['saida_html'] = "";
        }

        $htmlCode = <<<SCEOT
</tr>

SCEOT;

        $nm_saida->saida($htmlCode);
    }

    function display_emptyBody()
    {
        $htmlCode = <<<SCEOT
<script>
    scChartIsEmpty = true;
</script>
<span style="display: block; text-align: center">{$this->Ini->Nm_lang['lang_errm_empt']}</span>

SCEOT;

        return $htmlCode;
    }

    function display_body()
    {
        if ($this->aux_isEmptySummary()) {
            return $this->display_emptyBody();
        }

        $htmlCode = <<<SCEOT
<script>
    scChartIsEmpty = false;
</script>
<table id="sc-ui-summary-body" class="{$this->SC_APP_info['css'] ['summary_table']}">

SCEOT;

        $htmlCode .= $this->display_labels();
        if ($this->SC_APP_info['options'] ['display_total_top']) {
            $htmlCode .= $this->display_totals();
        }
        $htmlCode .= $this->display_rows();
        if (!$this->SC_APP_info['options'] ['display_total_top']) {
            $htmlCode .= $this->display_totals();
        }
        $htmlCode .= $this->display_summaryLine();
        $htmlCode .= <<<SCEOT
</table>

SCEOT;

        if ($this->aux_skipSummary()) {
            return '';
        }

        return $htmlCode;
    }

    function display_inlineChart_startUp()
    {
        global $nm_saida;

        if (!$this->aux_hasCharts()) {
            return;
        } elseif (!$this->aux_hasInlineChart()) {
            return;
        }

        $this->getChartInstance();
        $this->Graf->info_initializeData();

        $htmlCode = <<<SCEOT
    <tr>
        <td class="{$this->SC_APP_info['css'] ['summary_container']}" id="sc-summary-chart-container">

SCEOT;
        $htmlCode .= $this->Graf->display_summaryChart_inline_startUp();
        $htmlCode .= <<<SCEOT
        </td>
    </tr>

SCEOT;

        $nm_saida->saida($htmlCode);
    }

    function display_inlineChart_initialAjax()
    {
        global $nm_saida;

        if (!$this->aux_hasCharts()) {
            return;
        } elseif (!$this->aux_hasInlineChart()) {
            return;
        }

        $htmlCode = $this->Graf->display_summaryChart_inline_initialAjaxCall($this->SC_APP_data['chart_md5_initial']);

        $nm_saida->saida($htmlCode);
    }

    function display_inlineChart_setInlineChartMd5()
    {
        if (!$this->aux_hasReloadChartMd5()) {
            return '';
        }

        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        $(function() {
            scChartInlineMd5 = "{$this->SC_APP_data['chart_md5_initial']}";
            scChart_update_inline();
        });
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_labels()
    {
        $this->SC_APP_data['fixed_col_count'] = 0;

        $htmlCode = <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['header_row']}">

SCEOT;
        $htmlCode .= $this->display_labels_rowCount();
        $htmlCode .= $this->display_labels_dimensions();
        $htmlCode .= $this->display_labels_comparison();
        $htmlCode .= $this->display_labels_metrics_firstRow();
        $htmlCode .= $this->display_labels_total();
        $htmlCode .= <<<SCEOT
    </tr>

SCEOT;

        $htmlCode .= $this->display_labels_metrics_otherRows();

        return $htmlCode;
    }

    function display_labels_rowCount()
    {
        if (!$this->SC_APP_info['options'] ['display_seq']) {
            return '';
        }

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']} {$this->SC_APP_info['css'] ['fixed_column_title']} {$this->SC_APP_info['css'] ['fixed_column_op']} {$this->SC_APP_info['css'] ['fixed_column_op_seq']} {$this->SC_APP_info['css'] ['fixed_column_is_fixed']}"{$this->SC_APP_data['dimension_label_rowspan']}>&nbsp;</td>

SCEOT;

        return $htmlCode;
    }

    function display_labels_comparison()
    {
        if (!$this->aux_isComparison()) {
            return '';
        }

        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : ''; 

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']} {$this->SC_APP_info['css'] ['fixed_column_title']} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss}"{$this->SC_APP_data['dimension_label_rowspan']}>{$this->SC_APP_data['comparison_labels'] ['comparison_field']}</td>

SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_labels_dimensions()
    {
        if ($this->aux_isTabular()) {
            return $this->display_labels_dimensions_tabular();
        } else {
            return $this->display_labels_dimensions_nonTabular();
        }
    }

    function display_labels_dimensions_tabular()
    {
        $htmlCode = '';

        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['y'] as $dimensionName) {
            $dimensionLabel = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];
            $dimensionFixPin = $this->aux_getFixPin($this->SC_APP_data['fixed_col_count']);

            list($dimensionLabel, $dimensionIcon) = $this->aux_addOrderToDimension($dimensionLabel, $dimensionName);

            $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : ''; 

            $finalLabel = $this->display_labels_dimensions_tabular_labelHtml($metricName, $dimensionLabel, $dimensionIcon, $dimensionFixPin);

            $htmlCode .= <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']} {$this->SC_APP_info['css'] ['fixed_column_title']} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss}"{$this->SC_APP_data['dimension_label_rowspan']}>{$finalLabel}</td>

SCEOT;

            $this->SC_APP_data['fixed_col_count']++;
        }

        return $htmlCode;
    }
    function display_labels_dimensions_tabular_labelHtml($metricName, $dimensionLabel, $dimensionIcon, $dimensionFixPin)
    {
        if (empty($this->Ini->Label_summary_sort_pos) || 'right' == $this->Ini->Label_summary_sort_pos) {
            $this->Ini->Label_summary_sort_pos = 'right_field';
        }

        switch ($this->Ini->Label_summary_sort_pos) {
            case 'left_cell':
                $spanFinal = <<<SCEOT
{$dimensionIcon}<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$dimensionLabel}</span>
SCEOT;
                break;

            case 'right_cell':
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$dimensionLabel}</span>{$dimensionIcon}
SCEOT;
                break;

            case 'left_field':
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$dimensionIcon}{$dimensionLabel}</span>
SCEOT;
                break;

            case 'right_field':
            default:
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$dimensionLabel}{$dimensionIcon}</span>
SCEOT;
                break;

        }
        
        $spanFinal = <<<SCEOT
<span style="display: flex; flex-direction: row; align-items: center; justify-content: space-between"><span style="display: flex; flex-grow: 1; align-items: center; justify-content: space-between">{$spanFinal}</span>$dimensionFixPin</span>
SCEOT;

        return $spanFinal;
    }

    function display_labels_dimensions_nonTabular()
    {
        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : '';
 
        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']} {$this->SC_APP_info['css'] ['fixed_column_title']} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss}"{$this->SC_APP_data['dimension_label_rowspan']}>{$this->Ini->Nm_lang['lang_othr_smry_msge']}</td>

SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_labels_metrics($parameters, $isLineTotal)
    {
        $htmlCode = '';

        foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
            $metricLabel = $this->SC_APP_info['metric'] [$metricName] ['label'];

            if (!$isLineTotal) {
                list($orderLabel, $orderIcon) = $this->aux_addOrderToMetric($metricLabel, $metricName, $parameters);
            } else {
                $orderLabel = $metricLabel;
                $orderIcon = '';
            }

            $chartDimensionName = isset($this->SC_APP_info['group_by'] ['dimension'] ['y'] [0]) ? $this->SC_APP_info['group_by'] ['dimension'] ['y'] [0] : '';
            if ($this->SC_APP_info['chart'] [$chartDimensionName] [$metricName] ['has_chart']) {
                $chartIcon = $this->aux_addChart($chartDimensionName, $metricName, $parameters, [], false);
            } else {
                $chartIcon = '';
            }

            $finalLabel = $this->display_labels_metrics_labelHtml($metricName, $orderLabel, $orderIcon, $chartIcon);

            $htmlCode .= <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']}">{$finalLabel}</td>

SCEOT;
        }

        return $htmlCode;
    }

    function display_labels_metrics_labelHtml($metricName, $orderLabel, $orderIcon, $chartIcon)
    {
        if ('' == $chartIcon) {
            $spanLabel = $orderLabel;
        } elseif ('right' == $this->SC_APP_info['options'] ['chart_icon_position_data']) {
            $spanLabel = "<span>{$orderLabel}&nbsp;{$chartIcon}</span>";
        } else {
            $spanLabel = "<span>{$chartIcon}&nbsp;{$orderLabel}</span>";
        }

        if (empty($this->Ini->Label_summary_sort_pos) || 'right' == $this->Ini->Label_summary_sort_pos) {
            $this->Ini->Label_summary_sort_pos = 'right_field';
        }

        switch ($this->Ini->Label_summary_sort_pos) {
            case 'left_cell':
                $spanFinal = <<<SCEOT
{$orderIcon}<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$spanLabel}</span>
SCEOT;
                break;

            case 'right_cell':
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$spanLabel}</span>{$orderIcon}
SCEOT;
                break;

            case 'left_field':
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$orderIcon}{$spanLabel}</span>
SCEOT;
                break;

            case 'right_field':
            default:
                $spanFinal = <<<SCEOT
<span style="display: flex; flex-grow: 1; align-items: center; justify-content: {$this->SC_APP_info['metric'] [$metricName] ['label_justify_content']}">{$spanLabel}{$orderIcon}</span>
SCEOT;
                break;

        }
        
        $spanFinal = <<<SCEOT
<span style="display: flex; flex-direction: row; align-items: center; justify-content: space-between">{$spanFinal}</span>
SCEOT;

        return $spanFinal;
    }

    function display_labels_metrics_firstRow()
    {
        if ($this->aux_hasXAxysDimensionField()) {
            $htmlCode = $this->display_labels_metrics_firstRow_dimensionMetric();
        } else {
            $htmlCode = $this->display_labels_metrics([], false);
        }
        return $htmlCode;
    }

    function display_labels_metrics_firstRow_dimensionMetric()
    {
        return $this->display_labels_metrics_metricItems($this->SC_APP_data['ordered_x_matrix'], 0);
    }

    function display_labels_metrics_otherRows()
    {
        if (!$this->aux_hasXAxysDimensionField()) {
            return '';
        }

        $htmlCode = '';

        if ($this->SC_APP_data['dimension_count'] ['x'] > 1) {
            for ($i = 1; $i < $this->SC_APP_data['dimension_count'] ['x']; $i++) {
                $htmlCode .= <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['header_row']}">

SCEOT;
                $htmlCode .= $this->display_labels_metrics_metricItems($this->SC_APP_data['ordered_x_matrix'], $i);
                $htmlCode .= <<<SCEOT
    </tr>

SCEOT;
            }
        }

        $htmlCode .= <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['header_row']}">

SCEOT;
        $lastXDimensionIndex = $this->SC_APP_data['dimension_count'] ['x'] - 1;
        foreach ($this->SC_APP_data['ordered_x_matrix'] [$lastXDimensionIndex] as $dimensionInfo) {
            $htmlCode .= $this->display_labels_metrics($dimensionInfo['dimensions'], false);
        }
        if ($this->SC_APP_info['options'] ['display_total_column']) {
            $htmlCode .= $this->display_labels_metrics([], true);
        }
        $htmlCode .= <<<SCEOT
    </tr>

SCEOT;

        return $htmlCode;
    }

    function display_labels_metrics_metricItems($orderedMatrix, $matrixLevel)
    {
        $htmlCode = '';

        foreach ($orderedMatrix[$matrixLevel] as $dimensionInfo) {
            $dimensionLabel = $this->aux_getDimensionValueLabel('x', $matrixLevel, $dimensionInfo['dimension']);
            $colSpan = 1 < $dimensionInfo['colspan'] ? ' colspan="' . $dimensionInfo['colspan'] . '"' : '';

            $htmlCode .= <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']}"{$colSpan}>{$dimensionLabel}</td>

SCEOT;
        }

        return $htmlCode;
    }

    function display_labels_total()
    {
        if (!$this->aux_hasXAxysDimensionField() || !$this->SC_APP_info['options'] ['display_total_column']) {
            return '';
        }

        $colSpan = $this->SC_APP_data['metric_count'] > 1 ? ' colspan="' . $this->SC_APP_data['metric_count'] . '"' : '';
        $rowSpan = $this->SC_APP_data['dimension_count'] ['x'] > 1 ? ' rowspan="' . $this->SC_APP_data['dimension_count'] ['x'] . '"' : '';

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['header_cell']}"{$colSpan}{$rowSpan}>{$this->Ini->Nm_lang['lang_othr_chrt_totl']}</td>

SCEOT;

        return $htmlCode;
    }

    function display_rows()
    {
        if ($this->aux_isTabular()) {
            return $this->display_rows_tabular();
        } else {
            return $this->display_rows_nonTabular();
        }
    }

    function display_rows_tabular()
    {
        $htmlCode = '';

        for ($i = $this->SC_APP_data['pagination'] ['first'] - 1; $i < $this->SC_APP_data['pagination'] ['last']; $i++) {
            $rowDimensionsInfo = $this->SC_APP_data['ordered_y_matrix'] [$i];
            $isSeqRow = 'row' == $rowDimensionsInfo['type'];

            if ('total' == $rowDimensionsInfo['type']) {
                continue;
            }

            $htmlCode .= $this->display_rows_tabular_thisRow($rowDimensionsInfo, self::GROUPBY_ORIGINAL, $isSeqRow, false); 

            if ($this->aux_isComparison()) {
                if ($isSeqRow) {
                    $this->SC_APP_data['css_line_count']++;
                }
                $htmlCode .= $this->display_rows_tabular_thisRow($rowDimensionsInfo, self::GROUPBY_COMPARISON, $isSeqRow, true); 
                if ($isSeqRow) {
                    $this->SC_APP_data['css_line_count']++;
                }
                $htmlCode .= $this->display_rows_tabular_thisRow($rowDimensionsInfo, self::GROUPBY_PERC_CHANGE, $isSeqRow, true); 
            }

            $this->SC_APP_data['line_count']++;
            if ($isSeqRow) {
                $this->SC_APP_data['css_line_count']++;
            }
        }

        return $htmlCode;
    }

    function display_rows_tabular_thisRow($rowDimensionsInfo, $comparisonArrayIndex, $isSeqRow, $isComparisonRow)
    {
        $this->SC_APP_data['fixed_col_count'] = 0;

        $htmlCode = <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['data_row']}">

SCEOT;
        $htmlCode .= $this->display_rows_rowCount($isSeqRow, $isComparisonRow);
        $htmlCode .= $this->display_rows_dimensions_tabular($rowDimensionsInfo, $isComparisonRow);
        $htmlCode .= $this->display_rows_comparison($comparisonArrayIndex, $rowDimensionsInfo['type']);
        $htmlCode .= $this->display_rows_metrics($rowDimensionsInfo['dimensions'], $comparisonArrayIndex);
        $htmlCode .= $this->display_rows_total($rowDimensionsInfo['dimensions'], $comparisonArrayIndex);
        $htmlCode .= <<<SCEOT
    </tr>

SCEOT;

        return $htmlCode;
    }

    function display_rows_nonTabular()
    {
        $htmlCode = $this->display_rows_nonTabular_items($this->SC_APP_data['ordered_y_axys'], []);

        return $htmlCode;
    }

    function display_rows_nonTabular_items($dimensionList, $parameterList)
    {
        if (count($dimensionList) == 0) {
            return '';
        }

        $htmlCode = '';

        foreach ($dimensionList as $dimensionValue => $dimensionInfo) {
            $dimensionIndex = count($parameterList);
            $thisParameterList = array_merge($parameterList, [$dimensionValue]);

            $htmlCode .= $this->display_rows_nonTabular_items_thisRow($dimensionIndex, $dimensionValue, $thisParameterList, self::GROUPBY_ORIGINAL, false);

            if ($this->aux_isComparison()) {
                $this->SC_APP_data['css_line_count']++;
                $htmlCode .= $this->display_rows_nonTabular_items_thisRow($dimensionIndex, $dimensionValue, $thisParameterList, self::GROUPBY_COMPARISON, true);
                $this->SC_APP_data['css_line_count']++;
                $htmlCode .= $this->display_rows_nonTabular_items_thisRow($dimensionIndex, $dimensionValue, $thisParameterList, self::GROUPBY_PERC_CHANGE, true);
            }

            $this->SC_APP_data['line_count']++;
            $this->SC_APP_data['css_line_count']++;

            $htmlCode .= $this->display_rows_nonTabular_items($dimensionInfo['children'], $thisParameterList);
        }

        return $htmlCode;
    }

    function display_rows_nonTabular_items_thisRow($dimensionIndex, $dimensionValue, $parameterList, $comparisonArrayIndex, $isComparisonRow)
    {
        $this->SC_APP_data['fixed_col_count'] = 0;

        $htmlCode = <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['data_row']}">

SCEOT;
        $htmlCode .= $this->display_rows_rowCount(true, $isComparisonRow);
        $htmlCode .= $this->display_rows_dimensions_nonTabular($dimensionIndex, $dimensionValue, $parameterList, $isComparisonRow);
        $htmlCode .= $this->display_rows_comparison($comparisonArrayIndex, 'row');
        $htmlCode .= $this->display_rows_metrics($parameterList, $comparisonArrayIndex);
        $htmlCode .= $this->display_rows_total($parameterList, $comparisonArrayIndex);
        $htmlCode .= <<<SCEOT
    </tr>

SCEOT;

        return $htmlCode;
    }

    function display_rows_rowCount($isSeqRow, $isComparisonRow)
    {
        if (!$this->SC_APP_info['options'] ['display_seq']) {
            return '';
        }

        $rowSpan = '';
        $valignTop = '';
        if ($this->aux_isComparison() && $isComparisonRow) {
            return '';
        } elseif ($this->aux_isComparison()) {
            $rowSpan = ' rowspan="3"';
            $valignTop = $this->SC_APP_info['css'] ['valign_top'];
        }

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['data_visible']} {$this->SC_APP_info['css'] ['data_seq']} {$this->SC_APP_info['css'] ['fixed_column_op']} {$this->SC_APP_info['css'] ['fixed_column_op_seq']} {$this->SC_APP_info['css'] ['fixed_column_is_fixed']} {$valignTop}"{$rowSpan}>{$this->SC_APP_data['line_count']}</td>

SCEOT;

        return $htmlCode;
    }

    function display_rows_comparison($comparisonArrayIndex, $rowType)
    {
        if (!$this->aux_isComparison()) {
            return '';
        }

        $cellCss = 'row' == $rowType ? $this->SC_APP_info['css'] ['data_visible'] : $this->SC_APP_info['css'] ['data_subtotal'];
        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : '';
        $percentualChangeCss = self::GROUPBY_PERC_CHANGE == $comparisonArrayIndex ? $this->SC_APP_info['css'] ['comparison_label'] : ''; 

        $htmlCode = <<<SCEOT
        <td class="{$cellCss} {$this->SC_APP_info['css'] ['fixed_column_field']} {$percentualChangeCss} {$fixedColCountCss}">{$this->SC_APP_data['comparison_labels'] [$comparisonArrayIndex]}</td>

SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_rows_dimensions_tabular($rowDimensionInfo, $isComparisonRow)
    {
        $htmlCode = '';
        $parameters = [];
        $dimensionCount = count($rowDimensionInfo['dimensions']);

        $rowSpan = '';
        $valignTop = '';
        if ($this->aux_isComparison() && $isComparisonRow) {
            return '';
        } elseif ($this->aux_isComparison()) {
            $rowSpan = ' rowspan="3"';
            $valignTop = $this->SC_APP_info['css'] ['valign_top'];
        }

        foreach ($rowDimensionInfo['dimensions'] as $dimensionIndex => $dimensionValue) {
            $dimensionLabel = $this->aux_getDimensionValueLabel('y', $dimensionIndex, $dimensionValue);
            $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$dimensionIndex];
            $dimensionAlign = '' != $this->SC_APP_info['dimension'] [$dimensionName] ['align_css_class'] ? $this->SC_APP_info['dimension'] [$dimensionName] ['align_css_class'] : '';

            $parameters[] = $dimensionValue;

            $colSpan = '';
            if ($rowDimensionInfo['colspan'] > 1 && $dimensionCount == $dimensionIndex + 1) {
                $colSpan = ' colspan="' . $rowDimensionInfo['colspan'] . '"';
            }

            $invisibleSpanIni = '';
            $invisibleSpanEnd = '';

            if (!isset($this->SC_APP_info['dimension_last_value'] [$dimensionIndex])) {
                $this->SC_APP_info['dimension_last_value'] [$dimensionIndex] = $dimensionValue;
                $cellBaseCss = $this->SC_APP_info['css'] ['data_visible'];
            } elseif ($this->SC_APP_info['dimension_last_value'] [$dimensionIndex] != $dimensionValue) {
                $this->SC_APP_info['dimension_last_value'] [$dimensionIndex] = $dimensionValue;
                $cellBaseCss = $this->SC_APP_info['css'] ['data_visible'];
                for ($i = $dimensionIndex + 1; $i <= $this->SC_APP_data['dimension_count'] ['y']; $i++) {
                    if (isset($this->SC_APP_info['dimension_last_value'] [$i])) {
                        unset($this->SC_APP_info['dimension_last_value'] [$i]);
                    }
                }
            } else {
                $cellBaseCss = $this->SC_APP_info['css'] ['data_hover'];
                $invisibleSpanIni = '<span class="' . $this->SC_APP_info['css'] ['data_hover_display'] . '">';
                $invisibleSpanEnd = '</span>';
            }

            if ('subtotal' == $rowDimensionInfo['type'] && $dimensionIndex == $dimensionCount - 1) {
                $cellBaseCss = $this->SC_APP_info['css'] ['data_subtotal'];
                $invisibleSpanIni = '';
                $invisibleSpanEnd = '';
                if (!$this->SC_APP_info['options'] ['display_label_on_total']) {
                    $dimensionLabel = $this->Ini->Nm_lang['lang_othr_chrt_totl'];
                }
            }

            if ($this->SC_APP_info['dimension'] [$dimensionName] ['show_link']) {
                $this->aux_addLinkToDimension($dimensionLabel, $parameters, '' != $invisibleSpanIni);
            }

            $dimensionDisplayString = $invisibleSpanIni . $dimensionLabel . $invisibleSpanEnd;

            $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : ''; 

            $htmlCode .= <<<SCEOT
        <td class="{$cellBaseCss} {$dimensionAlign} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss} {$valignTop}"{$colSpan}{$rowSpan}>{$dimensionDisplayString}</td>

SCEOT;

            $this->SC_APP_data['fixed_col_count']++;
        }

        return $htmlCode;
    }

    function display_rows_dimensions_nonTabular($dimensionIndex, $dimensionValue, $parameters, $isComparisonRow)
    {
        $dimensionLabel = $this->aux_getDimensionValueLabel('y', $dimensionIndex, $dimensionValue);
        $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$dimensionIndex];
        $dimensionTab = str_repeat("&nbsp; &nbsp; &nbsp;", $dimensionIndex);

        $rowSpan = '';
        $valignTop = '';
        if ($this->aux_isComparison() && $isComparisonRow) {
            return '';
        } elseif ($this->aux_isComparison()) {
            $rowSpan = ' rowspan="3"';
            $valignTop = $this->SC_APP_info['css'] ['valign_top'];
        }

        if ($this->SC_APP_info['dimension'] [$dimensionName] ['show_link']) {
            $this->aux_addLinkToDimension($dimensionLabel, $parameters, false);
        }

        $cellLabel = $dimensionTab . $dimensionLabel; 
        $baseCss = $this->SC_APP_info['css'] ['data_visible'];

        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : '';
 
        $htmlCode = <<<SCEOT
        <td class="{$baseCss} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss} {$valignTop}"{$rowSpan}>{$cellLabel}</td>
SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_rows_metrics($rowDimensionValues, $comparisonArrayIndex)
    {
        if ($this->aux_hasXAxysDimensionField()) {
            $htmlCode = '';

            foreach ($this->SC_APP_data['ordered_x_matrix'] [ $this->SC_APP_data['dimension_count'] ['x'] - 1 ] as $colDimensionInfo) {
                $htmlCode .= $this->display_rows_metrics_item($colDimensionInfo['dimensions'], $rowDimensionValues, $comparisonArrayIndex); 
            }

            return $htmlCode;
        } else {
            return $this->display_rows_metrics_item([], $rowDimensionValues, $comparisonArrayIndex);
        }
    }

    function display_rows_metrics_item($colDimensionValues, $rowDimensionValues, $comparisonArrayIndex)
    {
        $rowDimensionCount = count($rowDimensionValues);
        $chartDimensionName = 0 < $rowDimensionCount ? $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$rowDimensionCount] : ''; 

        $metricArray = $this->aux_getMetricArray($colDimensionValues, $rowDimensionValues);
        $previousMetricArray = [];
        if ($this->SC_APP_info['options'] ['show_percentuals'] && 0 < $rowDimensionCount) {
            $previousMetricArray = $this->aux_getPreviousMetricArray($colDimensionValues, $rowDimensionValues);
        }

        $evenOddCss = $this->SC_APP_data['css_line_count'] % 2 ? $this->SC_APP_info['css'] ['data_odd'] : $this->SC_APP_info['css'] ['data_even'];

        $htmlCode = '';

        if (0 == $rowDimensionCount) {
            $isChartLevel = false;
        } elseif ($this->SC_APP_data['dimension_count'] ['y'] == $rowDimensionCount) {
            $isChartLevel = false;
        } else {
            $isChartLevel = true;
        }

        foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
            $metricCss = $this->SC_APP_info['metric'] [$metricName] ['css_class'];

            if (0 == $rowDimensionCount) {
                $cellBaseCss = $this->SC_APP_info['css'] ['data_total'];
            } elseif ($this->aux_isTabular() && $rowDimensionCount < $this->SC_APP_data['dimension_count'] ['y']) {
                $cellBaseCss = $this->SC_APP_info['css'] ['data_subtotal'];
            } else {
                $cellBaseCss = $evenOddCss;
            }

            list($formattedValue, $percentualValue) = $this->aux_formatValueAndPercentual($comparisonArrayIndex, $metricArray, $previousMetricArray, $metricName);

            if ($isChartLevel && $this->SC_APP_info['chart'] [$chartDimensionName] [$metricName] ['has_chart']) {
                $chartIcon = $this->aux_addChart($chartDimensionName, $metricName, $colDimensionValues, $rowDimensionValues, self::GROUPBY_ORIGINAL != $comparisonArrayIndex);
            } else {
                $chartIcon = '';
            }

            $finalLabel = $this->display_rows_metrics_item_labelHtml($metricName, $formattedValue, $percentualValue, $chartIcon);

            $htmlCode .= <<<SCEOT
        <td class="{$cellBaseCss} {$metricCss}">{$finalLabel}</td>

SCEOT;
        }

        return $htmlCode; 
    }

    function display_rows_metrics_item_labelHtml($metricName, $formattedValue, $percentualValue, $chartIcon)
    {
        if ($this->SC_APP_info['metric'] [$metricName] ['show_percentuals_below']) {
            $displayValue = $formattedValue;
        } else {
            $displayValue = $formattedValue . $percentualValue;
        }

        if ('' == $chartIcon) {
            $spanLabel = $displayValue;
        } elseif ('right' == $this->SC_APP_info['options'] ['chart_icon_position_data']) {
            $spanLabel = "<span>{$displayValue}&nbsp;{$chartIcon}</span>";
        } else {
            $spanLabel = "<span>{$chartIcon}&nbsp;{$displayValue}</span>";
        }

        if ($this->SC_APP_info['metric'] [$metricName] ['show_percentuals_below']) {
            $spanLabel .= $percentualValue;
        }

        return $spanLabel;
    }

    function display_rows_total($rowDimensionValues, $comparisonArrayIndex)
    {
        if (!$this->aux_hasXAxysDimensionField() || !$this->SC_APP_info['options'] ['display_total_column']) {
            return '';
        }

        $htmlCode = '';

        $metricArray = $this->aux_getLineMetricArray($rowDimensionValues);
        $previousMetricArray = [];
        if ($this->SC_APP_info['options'] ['show_percentuals'] && 0 < count($rowDimensionValues)) {
            $previousMetricArray = $this->aux_getPreviousLineMetricArray($rowDimensionValues);
        }

        foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
            $metricCss = $this->SC_APP_info['metric'] [$metricName] ['css_class'];

            list($formattedValue, $percentualValue) = $this->aux_formatValueAndPercentual($comparisonArrayIndex, $metricArray, $previousMetricArray, $metricName);

            $htmlCode .= <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['data_total']} {$metricCss}">{$formattedValue}{$percentualValue}</td>

SCEOT;
        }

        return $htmlCode;
    }

    function display_totals()
    {
        if (!$this->SC_APP_info['options'] ['display_total_row']) {
            return '';
        }
        if (!$this->aux_hasYAxysDimensionField()) {
            return '';
        }
        if ('no' == $this->SC_APP_info['options'] ['display_summary_total']) {
            return '';
        }
        if ('last_page' == $this->SC_APP_info['options'] ['display_summary_total'] && $this->aux_hasPagination() && $this->SC_APP_data['pagination'] ['page_link_actual'] != $this->SC_APP_data['pagination'] ['page_count']) {
            return '';
        }

        $htmlCode = $this->display_totals_thisRow(self::GROUPBY_ORIGINAL, false);
        if ($this->aux_isComparison()) {
            $htmlCode .= $this->display_totals_thisRow(self::GROUPBY_COMPARISON, true);
            $htmlCode .= $this->display_totals_thisRow(self::GROUPBY_PERC_CHANGE, true);
        }

        return $htmlCode;
    }

    function display_totals_thisRow($comparisonArrayIndex, $isComparisonRow)
    {
        $htmlCode = <<<SCEOT
    <tr class="{$this->SC_APP_info['css'] ['data_row']}">

SCEOT;
        $htmlCode .= $this->display_totals_rowCount($isComparisonRow);
        $htmlCode .= $this->display_totals_dimensions($isComparisonRow);
        $htmlCode .= $this->display_totals_comparison($comparisonArrayIndex);
        $htmlCode .= $this->display_rows_metrics([], $comparisonArrayIndex);
        $htmlCode .= $this->display_totals_total($comparisonArrayIndex);
        $htmlCode .= <<<SCEOT
    </tr>

SCEOT;

        return $htmlCode;
    }

    function display_totals_rowCount($isComparisonRow)
    {
        if (!$this->SC_APP_info['options'] ['display_seq']) {
            return '';
        }

        $rowSpan = '';
        $valignTop = '';
        if ($this->aux_isComparison() && $isComparisonRow) {
            return '';
        } elseif ($this->aux_isComparison()) {
            $rowSpan = ' rowspan="3"';
            $valignTop = $this->SC_APP_info['css'] ['valign_top'];
        }

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['data_visible']} {$this->SC_APP_info['css'] ['data_seq']} {$this->SC_APP_info['css'] ['fixed_column_op']} {$this->SC_APP_info['css'] ['fixed_column_op_seq']} {$this->SC_APP_info['css'] ['fixed_column_is_fixed']} {$valignTop}"{$rowSpan}>&nbsp;</td>

SCEOT;

        return $htmlCode;
    }

    function display_totals_dimensions($isComparisonRow)
    {
        $colSpan = $this->aux_isTabular() ? ' colspan="' . $this->SC_APP_data['dimension_count'] ['y'] . '"' : '';

        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : ''; 

        $rowSpan = '';
        $valignTop = '';
        if ($this->aux_isComparison() && $isComparisonRow) {
            return '';
        } elseif ($this->aux_isComparison()) {
            $rowSpan = ' rowspan="3"';
            $valignTop = $this->SC_APP_info['css'] ['valign_top'];
        }

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['data_even']} {$this->SC_APP_info['css'] ['fixed_column_field']} {$fixedColCountCss} {$valignTop}"{$colSpan}{$rowSpan}>{$this->Ini->Nm_lang['lang_msgs_totl']}</td>

SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_totals_comparison($comparisonArrayIndex)
    {
        if (!$this->aux_isComparison()) {
            return '';
        }

        $fixedColCountCss = '' != $this->SC_APP_info['css'] ['fixed_column_field'] ? $this->SC_APP_info['css'] ['fixed_column_field'] . '-' . $this->SC_APP_data['fixed_col_count'] : '';
        $percentualChangeCss = self::GROUPBY_PERC_CHANGE == $comparisonArrayIndex ? $this->SC_APP_info['css'] ['comparison_label'] : ''; 

        $htmlCode = <<<SCEOT
        <td class="{$this->SC_APP_info['css'] ['data_subtotal']} {$this->SC_APP_info['css'] ['fixed_column_field']} {$percentualChangeCss} {$fixedColCountCss}">{$this->SC_APP_data['comparison_labels'] [$comparisonArrayIndex]}</td>

SCEOT;

        $this->SC_APP_data['fixed_col_count']++;

        return $htmlCode;
    }

    function display_totals_total($comparisonArrayIndex)
    {
        if (!$this->aux_hasXAxysDimensionField() || !$this->SC_APP_info['options'] ['display_total_column']) {
            return '';
        }

        return $this->display_rows_metrics_item([], [], $comparisonArrayIndex);
    }

    function display_summaryLine()
    {
        if (!$this->SC_APP_info['options'] ['display_summary_every_page']) {
            return '';
        }
        if ($this->SC_APP_info['options'] ['has_summary_button']) {
            return '';
        }
        if (!$this->aux_hasPagination()) {
            return '';
        }

        $colspanInfo = $this->aux_getSummaryColspanInfo();
        if (1 < $colspanInfo['total']) {
            $colspan = " colspan=\"{$colspanInfo['total']}\"";
        } else {
            $colspan = '';
        }

        $summaryLabel = str_replace(
            [
                '?start?',
                '?final?',
                '?total?'
            ],
            [
                $this->SC_APP_data['pagination'] ['first'],
                $this->SC_APP_data['pagination'] ['last'],
                $this->SC_APP_data['pagination'] ['record_count']
            ],
            $this->SC_APP_info['options'] ['display_summary_label']
        );

        $htmlCode = <<<SCEOT
<tr id="summary_body_summary"><td class="{$this->SC_APP_info['css'] ['summary_container']}"{$colspan}>
<table style="width: 100%">
    <tr class="{$this->SC_APP_info['css'] ['summary_line']}">
        <td class="{$this->SC_APP_info['css'] ['summary_font']}" style="text-align: center">
            <span id="res_summary_line">[{$summaryLabel}]</span>
        </td>
    </tr>
</table>
</td></tr>

SCEOT;

        return $htmlCode;
    }

    function display_css()
    {
        global $nm_saida;

        $cssCode = <<<SCEOT
<style>
#sc-ui-summary-body {
    width: 100%;
}
.sc-summary-metric-percentage {
    font-size: 75%;
}
.sc-align-left {
    text-align: left;
}
.sc-align-center {
    text-align: center;
}
.sc-align-right {
    text-align: right;
}
.sc-valign-top {
    vertical-align: top;
}
.sc-comparison-label {
    font-weight: bold;
}
.sc-comparison-color-down {
    color: {$this->SC_APP_info['options'] ['comparison_change_negative_color']};
}
.sc-comparison-color-up {
    color: {$this->SC_APP_info['options'] ['comparison_change_positive_color']};
}

SCEOT;
        $cssCode .= $this->display_css_negativeColors();
        $cssCode .= <<<SCEOT
</style>

SCEOT;

        $nm_saida->saida($cssCode);
    }

    function display_css_negativeColors()
    {
        $cssCode = <<<SCEOT
SCEOT;

        return $cssCode;
    }

    function display_js()
    {
        global $nm_saida;

        $jsCode = <<<SCEOT
<script>

SCEOT;
        $jsCode .= $this->display_js_chart();
        $jsCode .= $this->display_js_order();
        $jsCode .= $this->display_js_pagination();
        $jsCode .= <<< SCEOT
</script>

SCEOT;

        $nm_saida->saida($jsCode);
    }

    function display_js_chart()
    {
        $scPage = NM_encode_input($this->Ini->sc_page);
        $ajaxUrl = "{$this->Ini->path_link}grid_income_offday_ot/index.php";
        $isInlineChart = $this->aux_hasInlineChart() ? 'true' : 'false';

        $jsCode = <<<SCEOT
let scChartIsInline = {$isInlineChart};
let scChartInlineMd5 = "";
let scChartIsEmpty = false;

function scChart_display(chartMd5)
{

SCEOT;
        if ($this->aux_hasInlineChart()) {
            $jsCode.= <<<SCEOT
    scChart_display_inline(chartMd5);

SCEOT;
        } else {
            $jsCode.= <<<SCEOT
    scChart_display_newPage(chartMd5);

SCEOT;
        }
        $jsCode.= <<<SCEOT
}

function scChart_update_inline()
{
    if (scChartIsInline) {
        if (scChartIsEmpty) {
            if (typeof scFusionCharts != "undefined") {
                scFusionCharts.dispose();
            }
        } else {
            scChart_display_inline(scChartInlineMd5);
        }
    }
}

function scChart_display_inline(chartMd5)
{
    scChartInlineMd5 = chartMd5;

    $.ajax({
        type: "POST",
        url: "{$ajaxUrl}",
        dataType: "json",
        data: {
            nmgp_opcao: "grafico",
            script_case_init: "{$scPage}",
            chart_inline_update: "Y",
            chart_md5: chartMd5,
        }
    }).done(function(data) {
        if (typeof scFusionCharts != "undefined") {
            scFusionCharts.dispose();
        }
        scFusionCharts_create(data.chartType, data.chartUrl, data.chartWidth, data.chartHeight, data.errorMessage);
        let scrollTarget = $("#sc-summary-chart-container").find("div");
        if (scrollTarget.length) {
            $('html, body').stop().animate({
                scrollTop: scrollTarget.offset().top
            }, 500);
        }
    });
}

function scChart_display_newPage(chartMd5)
{

SCEOT;
        if ($this->SC_APP_info['options'] ['chart_new_page']) {
            $jsCode .= <<<SCEOT
    let oldAction = document.Fgraf.action;
    let oldTarget = document.Fgraf.target;
    let windowName = "grid_income_offday_ot_chart_window" + (Math.floor(Math.random() * 100) + 1);
    let chartWindow = window.open("", windowName);
    document.Fgraf.action = nm_url_rand(document.Fgraf.action);
    document.Fgraf.target = windowName;

SCEOT;
        }
        $jsCode .= <<<SCEOT
    document.Fgraf.summary_chart.value = 'Y';
    document.Fgraf.chart_md5.value = chartMd5;
    document.Fgraf.submit();

SCEOT;
        if ($this->SC_APP_info['options'] ['chart_new_page']) {
            $jsCode .= <<<SCEOT
    document.Fgraf.action = oldAction;
    document.Fgraf.target = oldTarget;

SCEOT;
        }
        $jsCode .= <<<SCEOT
}


SCEOT;

        return $jsCode;
    }

    function display_js_order()
    {
        $jsCode = <<<SCEOT
$(function() {
    scOrder_addClickControl();
});

function scOrder_addClickControl()
{
    scOrder_addClickControl_dimension();
    scOrder_addClickControl_metric();
}

function scOrder_addClickControl_dimension()
{
    $(".sc-ui-sort-dimension").on("mouseover", function() {
        $(this).css("cursor", "pointer");
    }).on("click", function() {
        let newOrder, clickedDimension;
        if ($(this).hasClass("sc-ui-sort-asc")) {
            newOrder = "desc";
        } else {
            newOrder = "asc";
        }
        clickedDimension = $(this).data("orderDimension");
        scChangeSummarySort("dimension", clickedDimension, newOrder);
    });
}

function scOrder_addClickControl_metric()
{
    $(".sc-ui-sort-metric").on("mouseover", function() {
        $(this).css("cursor", "pointer");
    }).on("click", function() {
        let newOrder, clickedMetric, iconObj;
        iconObj = $("#" + $(this).data("orderId"));
        if (iconObj.find(".sc-summary-order-icon").hasClass("sc-summary-order-icon-unused")) {
            newOrder = "asc";
        } else if (iconObj.hasClass("sc-ui-sort-asc")) {
            newOrder = "desc";
        } else {
            newOrder = "";
        }
        clickedMetric = $(this).data("orderMetric");
        scChangeSummarySort("metric", clickedMetric, newOrder);
    });
}

function scChangeSummarySort(option, field, order)
{
    let orderChangeParameters = new Array();
    orderChangeParameters.push("change_" + option + "_sort" + "*scin" + "Y");
    orderChangeParameters.push(option + "*scin" + field);
    orderChangeParameters.push("new_order" + "*scin" + order);

    nm_gp_submit_ajax("resumo", orderChangeParameters.join("*scout"));
}


SCEOT;

        return $jsCode;
    }

    function display_js_pagination()
    {
        $jsCode = <<<SCEOT
let scPag_first = {$this->SC_APP_data['pagination'] ['first']};
let scPag_last = {$this->SC_APP_data['pagination'] ['last']};
let scPag_back = {$this->SC_APP_data['pagination'] ['back']};
let scPag_forward = {$this->SC_APP_data['pagination'] ['forward']};
let scPag_count = {$this->SC_APP_data['pagination'] ['record_count']};
let scPag_length = {$this->SC_APP_data['pagination'] ['length']};
let scPag_pageCount = {$this->SC_APP_data['pagination'] ['page_count']};

function scPagination_navigation_control()
{
    if ("string" == typeof scPag_first) {
        scPag_first = parseInt(scPag_first);
    }
    if ("string" == typeof scPag_last) {
        scPag_last = parseInt(scPag_last);
    }
    if ("string" == typeof scPag_back) {
        scPag_back = parseInt(scPag_back);
    }
    if ("string" == typeof scPag_forward) {
        scPag_forward = parseInt(scPag_forward);
    }

    if (1 < scPag_first) {
        scPagination_navigation_back('enable');
    } else {
        scPagination_navigation_back('disable');
    }
    if (scPag_count > scPag_last) {
        scPagination_navigation_forward('enable');
    } else {
        scPagination_navigation_forward('disable');
    }
}

function scPagination_navigation_back(operation)
{
    if ('enable' == operation) {
        $("#res_first_top").removeClass("disabled");
        $("#res_back_top").removeClass("disabled");
        $("#res_first_bot").removeClass("disabled");
        $("#res_back_bot").removeClass("disabled");
    } else {
        $("#res_first_top").addClass("disabled");
        $("#res_back_top").addClass("disabled");
        $("#res_first_bot").addClass("disabled");
        $("#res_back_bot").addClass("disabled");
    }
}

function scPagination_navigation_forward(operation)
{
    if ('enable' == operation) {
        $("#res_last_top").removeClass("disabled");
        $("#res_forward_top").removeClass("disabled");
        $("#res_last_bot").removeClass("disabled");
        $("#res_forward_bot").removeClass("disabled");
    } else {
        $("#res_last_top").addClass("disabled");
        $("#res_forward_top").addClass("disabled");
        $("#res_last_bot").addClass("disabled");
        $("#res_forward_bot").addClass("disabled");
    }
}

function scChangePagination(option, value)
{
    let paginationChangeParameters = new Array();
    paginationChangeParameters.push("change_" + option + "_pagination" + "*scin" + "Y");
    paginationChangeParameters.push(option + "*scin" + value);

    nm_gp_submit_ajax("resumo", paginationChangeParameters.join("*scout"));
}


SCEOT;

        return $jsCode;
    }

    function display_export_charts()
    {
        if ($this->aux_displayPdfCharts()) {
            $this->display_pdf_charts();
        } elseif ($this->aux_displayPrintCharts()) {
            $this->display_print_charts();
        }

    }

    function display_pdf_charts()
    {
        global $nm_saida;

        $chartCount = 1;
        $chartInfoType = $this->aux_getChartInfoType();
        $chartTotal = 0;
        $chartLang = isset($this->Ini->Nm_lang['lang_pdff_pcht']) ? $this->Ini->Nm_lang['lang_pdff_pcht'] : 'Generating chart';
        $chartFP = true;

        foreach ($this->SC_APP_data['chart_md5_list'] as $chartInfo) {
            if (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level']) && '' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level'] && $chartInfo['chart_level'] > $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level']) {
                continue;
            }
            if ($chartInfo['info_type'] == $chartInfoType) {
                $chartTotal++;
            }
        }

        if (!isset($this->progress_fp) || !$this->progress_fp) {
            $chartFP = true;
            $progressBarFile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
            $this->progress_fp = fopen($progressBarFile, 'a');
            $this->progress_tot = 100;
            $this->progress_now = 90;
            $this->progress_res = 0;
        }

        $htmlCode = '';
        $htmlCode .= <<<SCEOT
</table></td></tr></table>

SCEOT;
        if (!$this->aux_skipSummary()) {
            $htmlCode .= <<<SCEOT
<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>

SCEOT;
        }
        $htmlCode .= <<<SCEOT
<b><div style="height:1px; overflow:hidden"><H1 style="font-size:0; padding:1px">{$this->Ini->Nm_lang['lang_btns_chrt_pdff_hint']}</H1></div></b>

SCEOT;

        $firstChart = true;
        foreach ($this->SC_APP_data['chart_md5_list'] as $chartInfo) {
            if ($chartInfo['info_type'] != $chartInfoType) {
                continue;
            } elseif (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level']) && '' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level'] && $chartInfo['chart_level'] > $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level']) {
                continue;
            }

            if ($this->progress_fp) {
                grid_income_offday_ot_pdf_progress_call($this->progress_tot . "_#NM#_" . $this->progress_now . "_#NM#_" . $chartLang . " " . $chartCount . "/" . $chartTotal . "...\n", $this->Ini->Nm_lang, true);
                fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $chartLang . " " . $chartCount . "/" . $chartTotal . "...\n");
                $chartCount++;
                if (0 < $this->progress_res) {
                    $this->progress_now++;
                }
            }

            $chartImage = $this->aux_generatePhantomImage($chartInfo['md5']);

            $chartTitle = $chartInfo['title'];
            if ('' != $chartInfo['subtitle']) {
                $chartTitle .= ' - ' . $chartInfo['subtitle'];
            }
            if ('UTF-8' != $_SESSION['scriptcase'] ['charset']) {
                $chartTitle = sc_convert_encoding($chartTitle, $_SESSION['scriptcase'] ['charset'], 'UTF-8');
            }
            $bookmarkTitle = str_replace(' ', '&nbsp;', $chartTitle);
            $chartId = 'sc-id-h2-' . md5(session_id() . microtime() . rand(1, 1000));

            if (!$firstChart) {
                $htmlCode .= <<<SCEOT
<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>

SCEOT;
            }
            $htmlCode .= <<<SCEOT
<table><tr><td>
    <b><h2 id="$chartId">$bookmarkTitle</h2></b>
    <img src="{$chartImage}" />
</td></tr></table>

SCEOT;

            $firstChart = false;
        }

        if ($chartFP) {
            $pdfGenerateLang = $this->Ini->Nm_lang['lang_pdff_gnrt'];
            if (!NM_is_utf8($pdfGenerateLang)) {
                $pdfGenerateLang = sc_convert_encoding($pdfGenerateLang, "UTF-8", $_SESSION['scriptcase'] ['charset']);
            }
            grid_income_offday_ot_pdf_progress_call(100 . "_#NM#_" . 90 . "_#NM#_" . $pdfGenerateLang . "...\n", $this->Ini->Nm_lang);
            fwrite($this->progress_fp, 90 . "_#NM#_" . $pdfGenerateLang . "...\n");
            fclose($this->progress_fp);
        }

        $nm_saida->saida($htmlCode);
    }

    function display_print_charts()
    {
        global $nm_saida;

        $this->getChartInstance();

        $htmlCode = <<<SCEOT
</table></td></tr></table>

<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>
<b><div style="height:1px; overflow:hidden"><H1 style="font-size:0; padding:1px">{$this->Ini->Nm_lang['lang_btns_chrt_pdff_hint']}</H1></div></b>

SCEOT;

        $htmlCode .= $this->Graf->display_chart_htmlFusionChartsLibrary('pdf');

        $firstChart = true;
        foreach ($this->SC_APP_data['chart_md5_list'] as $chartInfo) {
            $this->Graf->info_initializeData();
            $this->Graf->info_initializeChart($chartInfo['md5'], true);

            $chartTitle = $chartInfo['title'];
            if ('' != $chartInfo['subtitle']) {
                $chartTitle .= ' - ' . $chartInfo['subtitle'];
            }
            if ('UTF-8' != $_SESSION['scriptcase'] ['charset']) {
                $chartTitle = sc_convert_encoding($chartTitle, $_SESSION['scriptcase'] ['charset'], 'UTF-8');
            }
            $bookmarkTitle = str_replace(' ', '&nbsp;', $chartTitle);
            $chartId = 'sc-id-h2-' . md5(session_id() . microtime() . rand(1, 1000));

            if (!$firstChart) {
                $htmlCode .= <<<SCEOT
<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>

SCEOT;
            }
            $htmlCode .= <<<SCEOT
<table><tr><td>
    <b><h2 id="$chartId">$bookmarkTitle</h2></b>

SCEOT;
            $htmlCode .= $this->Graf->display_chart_htmlFusionChartsDiv_newPage();
            $htmlCode .= $this->Graf->display_chart_htmlFusionChartsJavascript_phantom();
            $htmlCode .= <<<SCEOT
</td></tr></table>

SCEOT;

            $firstChart = false;
        }

        $nm_saida->saida($htmlCode);
    }

    function aux_addChartAppCharts()
    {
        if ($this->SC_APP_info['options'] ['chart_grand_total']) {
            $this->aux_addChartAppGrandTotalChart();
            return;
        }

        if (1 < count($this->SC_APP_info['group_by'] ['metric'])) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['graf_opc_atual'] = 2;
        } else {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['graf_opc_atual'] = 1;
        }

        $this->aux_addChartData($this->SC_APP_info['group_by'] ['dimension'] ['y'] [0], $this->SC_APP_info['group_by'] ['metric'], [], [], false);

        foreach ($this->SC_APP_data['ordered_y_matrix'] as $rowDimensionInfo) {
            if ('total' == $rowDimensionsInfo['type']) {
                continue;
            }
            if (!isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summarizing_drill_down']) || !$_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['summarizing_drill_down']) {
                continue;
            }

            $rowDimensionValues = $rowDimensionInfo['dimensions'];
            $rowDimensionCount = count($rowDimensionValues);
            $chartDimensionName = 0 < $rowDimensionCount ? $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$rowDimensionCount] : ''; 

            if (0 == $rowDimensionCount) {
                $isChartLevel = false;
            } elseif ($this->SC_APP_data['dimension_count'] ['y'] == $rowDimensionCount) {
                $isChartLevel = false;
            } else {
                $isChartLevel = true;
            }

            if ($isChartLevel) {
                $this->aux_addChartData($chartDimensionName, $this->SC_APP_info['group_by'] ['metric'], [], $rowDimensionInfo['dimensions'], false);
            }
        }

        $this->aux_addHeatmapChartData();
        $this->aux_addTreemapChartData();
        $this->aux_addChordChartData();
        $this->aux_addSankeyChartData();
        $this->aux_addSunburstChartData();

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_md5_list'] = $this->SC_APP_data['chart_md5_list'];

        $this->aux_storeSummaryTableInfo();
    }

    function aux_addChartAppGrandTotalChart()
    {
        $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['order'] [0];
        $dimensionArray = $this->array_total_geral;

        if (1 < count($this->SC_APP_info['group_by'] ['metric'])) {
            $isMultiMetric = true;
            $metricChartInfo = [];
            $metricTitle = [];
            foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
                $metricChartInfo[] = [
                    'field' => $metricName,
                    'label' => $this->SC_APP_info['metric'] [$metricName] ['label'],
                    'format' => $this->SC_APP_info['metric'] [$metricName] ['format_function'],
                ];
                $metricTitle[] = $this->SC_APP_info['metric'] [$metricName] ['label'];
            }
            $metricChartLabel = implode(', ', $metricTitle);
        } else {
            $isMultiMetric = false;
            $metricName = $this->SC_APP_info['group_by'] ['metric'] [0];
            $metricChartInfo = [
                [
                    'field' => $metricName,
                    'label' => $this->SC_APP_info['metric'] [$metricName] ['label'],
                    'format' => $this->SC_APP_info['metric'] [$metricName] ['format_function'],
                ]
            ];
            $metricChartLabel = $this->SC_APP_info['metric'] [$metricName] ['label'];
        }

        $chartParameters = [];

        $originalValues = [];
        foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
            $originalValues[$metricName] = [
                'label' => $this->SC_APP_info['metric'] [$metricName] ['label'],
                'dimension_value' => $metricName,
                'value' => $dimensionArray[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [$metricName] ['value_index'] - 1 ],
            ];
        }

        $chartInfo = [
            'options' => [
                'is_grand_total' => true,
                'is_comparison' => false,
                'is_multimetric' => $isMultiMetric,
                'is_heatmap' => false,
                'is_treemap' => false,
                'is_chord' => false,
                'is_sankey' => false,
                'is_sunburst' => false,
                'has_analytic' => false,
                'comparison_field_label' => '',
                'limit_chart_items' => $this->SC_APP_info['dimension'] [$dimensionName] ['limit_chart_items'],
                'series_name' => [],
                'chart_link' => '',
            ],
            'dimension' => [
                'field' => $dimensionName,
                'label' => $this->Ini->Nm_lang['lang_msgs_totl'],
                'next'=> '',
            ],
            'metric' => $metricChartInfo,
            'parameters' => $chartParameters,
            'dimension_list' => $this->SC_APP_info['group_by'] ['dimension'] ['order'],
            'data_synthetic' => [
                self::GROUPBY_ORIGINAL => $originalValues,
            ],
            'data_analytic' => $analyticValues,
        ];

        $chartIdentifier = $this->aux_addChart_getIdentifier($chartInfo);
        $chartMd5 = md5($chartIdentifier);

        $chartInfo['options'] ['identifier'] = $chartIdentifier;
        $chartInfo['options'] ['md5'] = $chartMd5;

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_info'] [$chartMd5] = $chartInfo;

        if ('' == $this->SC_APP_data['chart_md5_initial']) {
            $this->SC_APP_data['chart_md5_initial'] = $chartMd5;
            $this->SC_APP_data['chart_title_initial'] = $metricChartLabel;
        }
        $this->SC_APP_data['chart_md5_list'] [] = [
            'md5' => $chartMd5,
            'title' => $metricChartLabel,
            'subtitle' => $this->aux_addChart_subtitle($chartParameters),
            'info_type' => 'chart_info',
            'chart_level' => 0
        ];
    }

    function aux_addChart($dimensionName, $metricName, $colDimensionValues, $rowDimensionValues, $isComparisonRow)
    {
        if (!$this->aux_hasCharts()) {
            return '';
        } elseif ($isComparisonRow) {
            return '';
        }

        $chartMd5 = $this->aux_addChartData($dimensionName, $metricName, $colDimensionValues, $rowDimensionValues, $isComparisonRow);

        if ($this->aux_isPdf() || $this->aux_isPrint()) {
            return '';
        } else {
            return trim(nmButtonOutput($this->arr_buttons, "bgraf", "scChart_display('{$chartMd5}')", "scChart_display('{$chartMd5}')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "{$this->SC_APP_info['dimension'] [$dimensionName] ['label']} X {$this->SC_APP_info['metric'] [$metricName] ['label']}", "", "", "", "only_text", "text_right", "", "", "", "", "", "", ""));
        }
    }

    function aux_addChartData($dimensionName, $metricInfo, $colDimensionValues, $rowDimensionValues, $isComparisonRow)
    {
        if (is_array($metricInfo) && 1 < count($metricInfo)) {
            $isMultiMetric = true;
            $metricChartInfo = [];
            $metricTitle = [];
            foreach ($metricInfo as $metricName) {
                $metricChartInfo[] = [
                    'field' => $metricName,
                    'label' => $this->SC_APP_info['metric'] [$metricName] ['label'],
                    'format' => $this->SC_APP_info['metric'] [$metricName] ['format_function'],
                ];
                $metricTitle[] = $this->SC_APP_info['metric'] [$metricName] ['label'];
            }
            $metricChartLabel = implode(', ', $metricTitle);
        } else {
            if (is_array($metricInfo)) {
                $metricInfo = $metricInfo[0];
            }

            $isMultiMetric = false;
            $metricChartInfo = [
                [
                    'field' => $metricInfo,
                    'label' => $this->SC_APP_info['metric'] [$metricInfo] ['label'],
                    'format' => $this->SC_APP_info['metric'] [$metricInfo] ['format_function'],
                ]
            ];
            $metricChartLabel = $this->SC_APP_info['metric'] [$metricInfo] ['label'];
        }

        $summaryValuesArrayIndex = empty($colDimensionValues) && empty($rowDimensionValues) && $this->aux_hasXAxysDimensionField() ? 'summary_line_values_array' : 'summary_values_array';

        $dimensionArrayName = $this->SC_APP_info['dimension'] [$dimensionName] [$summaryValuesArrayIndex];
        $dimensionArray = $this->$dimensionArrayName;

        $hasNextDimension = false;
        $nextDimensionName = '';
        if ($this->SC_APP_info['options'] ['chart_has_analytical']) {
            $nextDimensionOrderPosition = array_search($dimensionName, $this->SC_APP_info['group_by'] ['dimension'] ['order']) + 1;

            if (count($this->SC_APP_info['group_by'] ['dimension'] ['order']) > $nextDimensionOrderPosition) {
                $hasNextDimension = true;

                $nextDimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['order'] [$nextDimensionOrderPosition];
                $nextDimensionArrayName = $this->SC_APP_info['dimension'] [$nextDimensionName] [$summaryValuesArrayIndex];
                $nextDimensionArray = $this->$nextDimensionArrayName;
            }
        }

        $chartParameters = [];
        foreach ($colDimensionValues as $dimensionIndex => $thisParameter) {
            $dimensionArray = $dimensionArray[$thisParameter];
            if ($hasNextDimension) {
                $nextDimensionArray = $nextDimensionArray[$thisParameter];
            }

            $thisDimension = $this->SC_APP_info['group_by'] ['dimension'] ['x'] [$dimensionIndex];
            $chartParameters[] = [
                'name' => $thisDimension,
                'field_label' => $this->SC_APP_info['dimension'] [$thisDimension] ['label'],
                'value' => $thisParameter,
                'label' => $this->SC_APP_data['dimension_value_labels'] [$thisDimension] [$thisParameter],
            ];
        }
        foreach ($rowDimensionValues as $dimensionIndex => $thisParameter) {
            $dimensionArray = $dimensionArray[$thisParameter];
            if ($hasNextDimension) {
                $nextDimensionArray = $nextDimensionArray[$thisParameter];
            }

            $thisDimension = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$dimensionIndex];
            $chartParameters[] = [
                'name' => $thisDimension,
                'field_label' => $this->SC_APP_info['dimension'] [$thisDimension] ['label'],
                'value' => $thisParameter,
                'label' => $this->SC_APP_data['dimension_value_labels'] [$thisDimension] [$thisParameter],
            ];
        }

        $originalValues = [];
        $comparisonValues = [];
        $analyticValues = [];

        $orderArray = $this->SC_APP_data['ordered_y_axys'];

        foreach ($rowDimensionValues as $dimensionValue) {
            $orderArray = $orderArray[$dimensionValue] ['children'];
        }
        foreach ($orderArray as $dimensionValue => $dimensionInfo) {
            $dimensionLabel = $this->SC_APP_data['dimension_value_labels'] [ $dimensionInfo['dimension'] ] [$dimensionValue];

            $originalValues[$dimensionValue] = [
                'label' => $dimensionLabel,
                'value' => 0,
            ];

            if ($this->aux_isComparison()) {
                $comparisonValues[$dimensionValue] = [
                    'label' => $dimensionLabel,
                    'value' => 0,
                ];
            }
        }

        if ($hasNextDimension) {
            $analyticValues = [
                'set' => [
                    'field_name' => [
                        'x_axys' => '',
                        'legend' => '',
                    ],
                    'categories' => [],
                    'dataset' => [],
                ],
                'serie' => [
                    'field_name' => [
                        'x_axys' => '',
                        'legend' => '',
                    ],
                    'categories' => [],
                    'dataset' => [],
                ]
            ];
        }

        foreach ($dimensionArray as $metricArray) {
            $dimensionValue = $metricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_VALUE_INDEX];
            $dimensionLabel = $metricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_LABEL_INDEX];

            if ($isMultiMetric) {
                $originalValues[$dimensionValue] = [
                    'label' => $dimensionLabel,
                    'dimension_value' => $dimensionValue,
                    'value' => $metricArray[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [$metricInfo[0]] ['value_index'] ],
                ];
    
                $analyticValues['set'] ['field_name'] ['x_axys'] = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];

                if (!isset($analyticValues['set'] ['categories'] [$dimensionValue])) {
                    $analyticValues['set'] ['categories'] [$dimensionValue] = $dimensionLabel;
                }

                foreach ($metricInfo as $metricName) {
                    if (!isset($analyticValues['set'] ['dataset'] [$metricName])) {
                        $analyticValues['set'] ['dataset'] [$metricName] = [
                            'label' => $this->SC_APP_info['metric'] [$metricName] ['label'],
                            'dimension_value' => $metricName,
                            'data' => [],
                        ];
                    }
                    $analyticValues['set'] ['dataset'] [$metricName] ['data'] [$dimensionValue] = [
                        'label' => $dimensionLabel,
                        'dimension_value' => $dimensionValue,
                        'value' => $metricArray[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [$metricName] ['value_index'] ],
                    ];
                }
            } else {
                $originalValues[$dimensionValue] = [
                    'label' => $dimensionLabel,
                    'dimension_value' => $dimensionValue,
                    'value' => $metricArray[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [$metricInfo] ['value_index'] ],
                ];
    
                if ($this->aux_isComparison()) {
                    $comparisonValues[$dimensionValue] = [
                        'label' => $dimensionLabel,
                        'dimension_value' => $dimensionValue,
                        'value' => $metricArray[self::GROUPBY_COMPARISON] [ $this->SC_APP_info['metric'] [$metricInfo] ['value_index'] ],
                    ];
                }

                if ($hasNextDimension) {
                    $analyticValues['set'] ['field_name'] ['x_axys'] = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];
                    $analyticValues['set'] ['field_name'] ['legend'] = $this->SC_APP_info['dimension'] [$nextDimensionName] ['label'];
                    $analyticValues['serie'] ['field_name'] ['x_axys'] = $this->SC_APP_info['dimension'] [$nextDimensionName] ['label'];
                    $analyticValues['serie'] ['field_name'] ['legend'] = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];
    
                    foreach ($nextDimensionArray[$dimensionValue] as $nextMetricArray) {
                        $nextDimensionValue = $nextMetricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_VALUE_INDEX];
                        $nextDimensionLabel = $nextMetricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_LABEL_INDEX];
                        if (!isset($analyticValues['set'] ['categories'] [$dimensionValue])) {
                            $analyticValues['set'] ['categories'] [$dimensionValue] = $dimensionLabel;
                        }
    
                        if (!isset($analyticValues['set'] ['dataset'] [$nextDimensionValue])) {
                            $analyticValues['set'] ['dataset'] [$nextDimensionValue] = [
                                'label' => $nextDimensionLabel,
                                'dimension_value' => $nextDimensionValue,
                                'data' => [],
                            ];
                        }
                        $analyticValues['set'] ['dataset'] [$nextDimensionValue] ['data'] [$dimensionValue] = [
                            'label' => $dimensionLabel,
                            'dimension_value' => $dimensionValue,
                            'value' => $nextMetricArray[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [$metricInfo] ['value_index'] ],
                        ];
                    }
    
                    $nextDimensionValues = [];
                    foreach ($nextDimensionArray[$dimensionValue] as $nextMetricArray) {
                        $nextDimensionValue = $nextMetricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_VALUE_INDEX];
                        $nextDimensionLabel = $nextMetricArray[self::GROUPBY_ORIGINAL] [self::TOTAL_ARRAY_LABEL_INDEX];
                        if (!isset($analyticValues['serie'] ['categories'] [$nextDimensionValue])) {
                            $analyticValues['serie'] ['categories'] [$nextDimensionValue] = $nextDimensionLabel;
                        }
    
                        $nextDimensionValues[$nextDimensionValue] = [
                            'label' => $nextDimensionLabel,
                            'dimension_value' => $nextDimensionValue,
                            'value' => $nextMetricArray[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [$metricInfo] ['value_index'] ],
                        ];
                    }
                    $analyticValues['serie'] ['dataset'] [$dimensionValue] = [
                        'label' => $dimensionLabel,
                        'dimension_value' => $dimensionValue,
                        'data' => $nextDimensionValues,
                    ];
                }
            }
        }

        $dimensionLabel = [];
        $chartLevel = 0;
        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['order'] as $thisDimensionIndex => $thisDimensionName) {
            $dimensionLabel[] = $this->SC_APP_info['dimension'] [$thisDimensionName] ['label'];
            if ($dimensionName == $thisDimensionName) {
                $chartLevel = $thisDimensionIndex;
            }
        }

        $chartInfo = [
            'options' => [
                'is_grand_total' => false,
                'is_comparison' => false,
                'is_multimetric' => $isMultiMetric,
                'is_heatmap' => false,
                'is_treemap' => false,
                'is_chord' => false,
                'is_sankey' => false,
                'is_sunburst' => false,
                'has_analytic' => $hasNextDimension,
                'comparison_field_label' => '',
                'limit_chart_items' => $this->SC_APP_info['dimension'] [$dimensionName] ['limit_chart_items'],
                'series_name' => [],
                'chart_link' => 'drilldown',
            ],
            'dimension' => [
                'field' => $dimensionName,
                'label' => $this->SC_APP_info['dimension'] [$dimensionName] ['label'],
                'next'=> $nextDimensionName,
            ],
            'metric' => $metricChartInfo,
            'parameters' => $chartParameters,
            'dimension_list' => $this->SC_APP_info['group_by'] ['dimension'] ['order'],
            'data_synthetic' => [
                self::GROUPBY_ORIGINAL => $originalValues,
            ],
            'data_analytic' => $analyticValues,
        ];
        if ($this->aux_isComparison()) {
            $chartInfo['data_synthetic'] [self::GROUPBY_COMPARISON] = $comparisonValues;
            $chartInfo['options'] ['is_comparison'] = true;
            $chartInfo['options'] ['comparison_field_label'] = $this->SC_APP_data['comparison_labels'] ['comparison_field'];
            
            $chartInfo['options'] ['series_name'] [self::GROUPBY_ORIGINAL] = $this->SC_APP_data['comparison_labels'] [self::GROUPBY_ORIGINAL];
            $chartInfo['options'] ['series_name'] [self::GROUPBY_COMPARISON] = $this->SC_APP_data['comparison_labels'] [self::GROUPBY_COMPARISON];
        }

        $chartIdentifier = $this->aux_addChart_getIdentifier($chartInfo);
        $chartMd5 = md5($chartIdentifier);

        $chartInfo['options'] ['identifier'] = $chartIdentifier;
        $chartInfo['options'] ['md5'] = $chartMd5;

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_info'] [$chartMd5] = $chartInfo;

        if (0 == count($colDimensionValues) && 0 == count($rowDimensionValues) && '' == $this->SC_APP_data['chart_md5_initial']) {
            $this->SC_APP_data['chart_md5_initial'] = $chartMd5;
            $this->SC_APP_data['chart_title_initial'] = $metricChartLabel;
        }
        $this->SC_APP_data['chart_md5_list'] [] = [
            'md5' => $chartMd5,
            'title' => $metricChartLabel,
            'subtitle' => $this->aux_addChart_subtitle($chartParameters),
            'info_type' => 'chart_info',
            'chart_level' => $chartLevel
        ];

        return $chartMd5;
    }

    function aux_addHeatmapChartData()
    {
    }

    function aux_addTreemapChartData()
    {
    }

    function aux_addChordChartData()
    {
    }

    function aux_addSankeyChartData()
    {
    }

    function aux_addSunburstChartData()
    {
    }

    function aux_addSunburstChartData_recursive(&$chartData, $dimensionLevel, $dimensionParent, $dimensionParameters)
    {
        $dimensionCount = count($this->SC_APP_info['group_by'] ['dimension'] ['y']);

        $thisDimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$dimensionLevel];
        $thisDimensionArrayName = $this->SC_APP_info['dimension'] [$thisDimensionName] ['summary_values_array'];
        $thisDimensionArray = $this->$thisDimensionArrayName;
        foreach ($dimensionParameters as $thisDimensionParameter) {
            $thisDimensionArray = $thisDimensionArray[$thisDimensionParameter];
        }

        $metricName = $this->SC_APP_info['group_by'] ['metric'] [0];

        $dimensionLevelId = $dimensionLevel + 1;

        foreach ($thisDimensionArray as $thisDimensionValue => $thisDimensionInfo) {
            $thisDimensionId = "{$dimensionLevelId}.{$thisDimensionValue}";
            $thisDimensionParameters = array_merge($dimensionParameters, [$thisDimensionValue]);

            $chartData[] = [
                'id' => $thisDimensionId,
                'parent' => $dimensionParent,
                'label' => $this->SC_APP_data['dimension_value_labels'] [$thisDimensionName] [$thisDimensionValue],
                'value' => $thisDimensionInfo[self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [$metricName] ['value_index'] ],
            ];

            if ($dimensionCount > $dimensionLevel + 1) {
                $this->aux_addSunburstChartData_recursive($chartData, $dimensionLevel + 1, $thisDimensionId, $thisDimensionParameters);
            }
        }
    }

    function aux_addChart_getIdentifier($chartInfo)
    {
        $identifierParameters = [];
        foreach ($chartInfo['parameters'] as $parameterInfo) {
            $identifierParameters[] = $parameterInfo['value'];
        }

        $dimensionLabel = [];
        foreach ($chartInfo['dimension_list'] as $dimensionInfo) {
            $dimensionLabel[] = $dimensionInfo;
        }

        $metricLabel = [];
        foreach ($chartInfo['metric'] as $metricInfo) {
            $metricLabel[] = $metricInfo['label'];
        }

        $identifier = 'Dim(' . implode('+', $dimensionLabel) . ')_X_Met(' . implode('+', $metricLabel) . ')_|_Par(' . implode('+', $identifierParameters) . ')';

        return $identifier;
    }

    function aux_addChart_subtitle($chartParameters)
    {
        $parameters = [];

        foreach ($chartParameters as $parameterInfo) {
            $parameters[] = "{$parameterInfo['field_label']} = {$parameterInfo['label']}";
        }

        return implode(' :: ', $parameters);
    }

    function aux_addLinkToDimension(&$dimensionLabel, $parameters, $isInvisible)
    {
        if ($this->aux_isPdf() || $this->aux_isPrint()) {
            return;
        }

        $linkCssClass = $isInvisible ? 'scGridSummaryGroupbyInvisibleLink' : 'scGridSummaryGroupbyVisibleLink';
        $linkCall = $this->aux_createLinkInfo($parameters);

        $this->aux_storeLinkInfo($parameters, $linkCall);

        $dimensionLabel = <<<SCEOT
<a class="{$linkCssClass}" href="javascript: nm_link_cons('{$linkCall}')">{$dimensionLabel}</a>
SCEOT;
    }

    function aux_addOrderToDimension($dimensionLabel, $dimensionName)
    {
        if ($this->aux_isPdf() || $this->aux_isPrint()) {
            return [$dimensionLabel, ''];
        } elseif (!$this->SC_APP_info['dimension'] [$dimensionName] ['has_order']) {
            return [$dimensionLabel, ''];
        }

        $sortRule = $this->SC_APP_info['dimension'] [$dimensionName] ['order_by_direction'];
        $sortIcon = $this->aux_getDimensionOrderIcon($dimensionName, $sortRule);

        if (in_array($dimensionName, $this->SC_APP_info['options'] ['order_metric_apply_to_dimensions'])) {
            $sortClassMetricApplied = 'sc-ui-sort-metric-applied';
            if ($this->SC_APP_data['metric_order'] ['using']) {
                $sortClassMetricUsing = 'sc-summary-order-icon-unused';
            } else {
                $sortClassMetricUsing = '';
            }
        } else {
            $sortClassMetricApplied = 'sc-ui-sort-metric-not-applied';
            $sortClassMetricUsing = '';
        }

        $dimensionLabel = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['sort_dimension']} sc-ui-sort-{$sortRule}" data-order-dimension="{$dimensionName}">{$dimensionLabel}</span>
SCEOT;
        $dimensionIcon = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['sort_dimension']} sc-ui-sort-{$sortRule} {$sortClassMetricApplied} {$sortClassMetricUsing}" data-order-dimension="{$dimensionName}">{$sortIcon}</span>
SCEOT;

        return [$dimensionLabel, $dimensionIcon];
    }

    function aux_addOrderToMetric($metricLabel, $metricName, $parameters)
    {
        if ($this->aux_isPdf() || $this->aux_isPrint()) {
            return [$metricLabel, ''];
        } elseif (!$this->SC_APP_info['metric'] [$metricName] ['has_order']) {
            return [$metricLabel, ''];
        }

        if (!$this->SC_APP_data['metric_order'] ['using']) {
            $sortRule = '';
        } elseif ($this->SC_APP_data['metric_order'] ['name'] != $metricName) {
            $sortRule = '';
        } elseif ($this->SC_APP_data['metric_order'] ['parameters'] != $parameters) {
            $sortRule = '';
        } else {
            $sortRule = $this->SC_APP_data['metric_order'] ['rule'];
        }
        $sortIcon = $this->aux_getDimensionOrderIcon($dimensionName, $sortRule);

        $orderInfo = [
            'metric' => $metricName,
            'parameters' => $parameters,
        ];
        $metricOrderMd5 = md5(serialize($orderInfo));
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['metric_order_info'] [$metricOrderMd5] = $orderInfo;

        $iconId = 'sc-order-icon-' . substr(md5(microtime() . rand(1, 1000) . session_id()), 0, 8);

        $metricLabel = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['sort_metric']} sc-ui-sort-{$sortRule}" data-order-id="{$iconId}" data-order-metric="{$metricOrderMd5}">{$metricLabel}</span>
SCEOT;
        $metricIcon = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['sort_metric']} sc-ui-sort-{$sortRule}" data-order-id="{$iconId}" data-order-metric="{$metricOrderMd5}" id="{$iconId}">{$sortIcon}</span>
SCEOT;

        return [$metricLabel, $metricIcon];
    }

    function aux_addPercentualChangeVisual(&$value, $isZero, $isNegative)
    {
        if ($isZero) {
            return;
        }
        if ($isNegative) {
            $value = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['comparison_color_down']}"><span class="{$this->SC_APP_info['options'] ['comparison_change_negative_icon']}"></span> {$value}</span>
SCEOT;
        } else {
            $value = <<<SCEOT
<span class="{$this->SC_APP_info['css'] ['comparison_color_up']}"><span class="{$this->SC_APP_info['options'] ['comparison_change_positive_icon']}"></span> {$value}</span>
SCEOT;
        }
    }

    function aux_createLinkInfo($parameters)
    {
        $fieldLinkList = [];

        foreach ($parameters as $dimensionIndex => $dimensionValue) {
            $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$dimensionIndex];

            $fieldLinkList[] = $this->SC_APP_info['dimension'] [$dimensionName] ['link_field_var_name']
                              . '?#?'
                              . $this->SC_APP_info['dimension'] [$dimensionName] ['link_protect_string']
                              . addslashes($dimensionValue)
                              . $this->SC_APP_info['dimension'] [$dimensionName] ['link_protect_string'];
        }

        $linkInfo = implode('?@?', $fieldLinkList);
        $linkMd5 = md5($linkInfo);

        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['LigR_Md5'] [$linkMd5] = $linkInfo;

        return '@SC_par@' . NM_encode_input($this->Ini->sc_page) . '@SC_par@grid_income_offday_ot@SC_par@' . $linkMd5;
    }

    function aux_createPaginationDescription()
    {
        $htmlCode = str_replace([
                '?start?',
                '?final?',
                '?total?'
            ], [
                $this->SC_APP_data['pagination'] ['first'],
                $this->SC_APP_data['pagination'] ['last'],
                $this->SC_APP_data['pagination'] ['record_count']
            ], "[{$this->Ini->Nm_lang['lang_othr_smry_info']}]");


        return $htmlCode;
    }

    function aux_createPaginationLinks()
    {
        $htmlCode = '';

        foreach ($this->SC_APP_data['pagination'] ['page_link_list'] as $pageLinkNumber) {
            if ($pageLinkNumber == $this->SC_APP_data['pagination'] ['page_link_actual']) {
                $htmlCode .= <<<SCEOT
            <span class="scGridToolbarNavOpen" style="vertical-align: middle;">{$pageLinkNumber}</span>

SCEOT;
            } else {
                $pageFirstRecord = (($pageLinkNumber - 1) * $this->SC_APP_data['pagination'] ['length']) + 1;

                $htmlCode .= <<<SCEOT
            <a class="scGridToolbarNav" style="vertical-align: middle;" href="javascript: scChangePagination('record', {$pageFirstRecord});">{$pageLinkNumber}</a>

SCEOT;
            }
        }

        return $htmlCode;
    }

    function aux_displayPdfCharts()
    {
        if (!$this->aux_isPdf()) {
            return false;
        } elseif (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['skip_charts']) && $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['skip_charts']) {
            return false;
        } elseif (0 == count($this->SC_APP_data['chart_md5_list'])) {
            return false;
        }

        return true;
    }

    function aux_displayPrintCharts()
    {
        if (!$this->aux_isPrint()) {
            return false;
        } elseif (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['skip_charts']) && $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['skip_charts']) {
            return false;
        } elseif (0 == count($this->SC_APP_data['chart_md5_list'])) {
            return false;
        }

        return true;
    }

    function aux_format_ot_hh_o_S($value)
    {
        $isNegative = 0 > $value;
        $suffix = '';

        if ($this->SC_APP_info['options'] ['display_abbreviated_value']) {
            $this->aux_getAbbreviatedValue($value, $suffix);
        }

        nmgp_Form_Num_Val($value, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']);
        $value .= $suffix;

        return $value;
    }

    function aux_format_ot_hh_o_pm_S($value)
    {
        $isNegative = 0 > $value;
        $suffix = '';

        if ($this->SC_APP_info['options'] ['display_abbreviated_value']) {
            $this->aux_getAbbreviatedValue($value, $suffix);
        }

        nmgp_Form_Num_Val($value, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']);
        $value .= $suffix;

        return $value;
    }

    function aux_format_income_offday_ot_S($value)
    {
        $isNegative = 0 > $value;
        $suffix = '';

        if ($this->SC_APP_info['options'] ['display_abbreviated_value']) {
            $this->aux_getAbbreviatedValue($value, $suffix);
        }

        nmgp_Form_Num_Val($value, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "12", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']);
        $value .= $suffix;

        return $value;
    }

    function aux_formatPercentage($value)
    {
        nmgp_Form_Num_Val($value, $_SESSION['scriptcase'] ['reg_conf'] ['grup_num'], $_SESSION['scriptcase'] ['reg_conf'] ['dec_num'], "2", "S", "2", "");

        return $value . '%'; 
    }

    function aux_formatValueAndPercentual($comparisonArrayIndex, $metricArray, $previousMetricArray, $metricName)
    {
        $formattedValue = '';
        $percentualValue = '';

        $valueIndex = $this->SC_APP_info['metric'] [$metricName] ['value_index'];
        $formatFunction = $this->SC_APP_info['metric'] [$metricName] ['format_function'];
        $percentualSeparator = $this->SC_APP_info['metric'] [$metricName] ['show_percentuals_below'] ? '<br />' : '&nbsp;';

        if (self::GROUPBY_PERC_CHANGE == $comparisonArrayIndex) {
            $initialValue = $metricArray[self::GROUPBY_COMPARISON] [$valueIndex];
            $finalValue = $metricArray[self::GROUPBY_ORIGINAL] [$valueIndex];
            if ('' == $initialValue) {
                $initialValue = 0;
            }
            if ('' == $finalValue) {
                $finalValue = 0;
            }

            if (0 == $initialValue) {
                $formattedValue = '-';
            } else {
                $percentualChange = (($finalValue - $initialValue) / $initialValue) * 100;
                $isZeroPercentual = 0 == $percentualChange;
                $isNegativePercentual = 0 > $percentualChange;
                $formattedValue = $this->aux_formatPercentage($percentualChange);
                $this->aux_addPercentualChangeVisual($formattedValue, $isZeroPercentual, $isNegativePercentual);
            }
        } else {
            $thisMetricValue = $metricArray[$comparisonArrayIndex] [$valueIndex];

            if ($this->SC_APP_info['metric'] [$metricName] ['show_percentuals'] && !$this->SC_APP_info['metric'] [$metricName] ['is_rating']) {
                if (is_array($previousMetricArray) && count($previousMetricArray) && '' != $thisMetricValue) {
                    $previousMetricValue = $previousMetricArray[$comparisonArrayIndex] [$valueIndex];

                    if ('' == $previousMetricValue) {
                        $previousMetricValue = 0;
                    }

                    $percentualValue = 0 == $previousMetricValue ? 0 : ($thisMetricValue / $previousMetricValue) * 100; 
                    $percentualValue = $percentualSeparator . '<span class="' . $this->SC_APP_info['css'] ['percentage_dimension'] . '">(' . $this->aux_formatPercentage($percentualValue) . ')</span>';
                }
            }

            $formattedValue = $this->$formatFunction($thisMetricValue);
        }

        return [$formattedValue, $percentualValue];
    }

    function aux_generatePhantomImage($chartMd5)
    {
        $this->getChartInstance();
        $this->Graf->info_initializeData();
        $this->Graf->info_initializeChart($chartMd5, true);

        $phantomId = md5($chartMd5 . $this->Graf->display_summaryChart_phantom_md5());

        $imageName = "sc_pjs_png_{$phantomId}.png";
        $imageUrlDir = "{$_SESSION['scriptcase'] ['grid_income_offday_ot'] ['glo_nm_path_imag_temp']}/";
        $imageUrlName = $imageUrlDir . $imageName;
        $imageFileDir = $this->Ini->root . $imageUrlDir;
        $imageFileName = $imageFileDir . $imageName;

        $appDirectory = getcwd();
        $appOs = $this->Ini->getRunningOS();

        $phantomJsDelay = $this->SC_APP_info['options'] ['chart_create_time'];
        $phantomCommandLine = "phantomjs --ignore-ssl-errors=true \"{$imageFileDir}sc_pjs_js_{$phantomId}.js\"";
        if ('win' != $appOs['os']) {
            $phantomCommandLine = './' . $phantomCommandLine;
        }

        $isImageGenerated = @is_file($imageFileName);
        $imageSizeLimit = 6 * 1024;
        $imageSize = $isImageGenerated ? @filesize($imageFileName) : 0;

        if (!$isImageGenerated || $imageSize < $imageSizeLimit) {
            $this->aux_generatePhantomJs($phantomId, $imageFileName, $phantomJsDelay);
            $this->aux_generatePhantomPhp($phantomId);

            @chdir($this->Ini->path_third . '/phantomjs/' . $appOs['os']);

            $attempt = 0;
            $imageSize = 0;
            while ($attempt < 3 && $imageSize < $imageSizeLimit) {
                @exec($phantomCommandLine);
                $attempt++;

                $imageSize = @is_file($imageFileName) ? @filesize($imageFileName) : 0;
                if ($imageSize < $imageSizeLimit) {
                    $phantomJsDelay += floor($this->SC_APP_info['options'] ['chart_create_time'] / 2);
                    $this->aux_generatePhantomJs($phantomId, $imageFileName, $phantomJsDelay);
                }
            }

            @chdir($appDirectory);
        }

        return $imageUrlName;
    }

    function aux_generatePhantomJs($phantomId, $imageFileName, $phantomJsDelay)
    {
        $jsCode = <<<SCEOT
var thisPage = require('webpage').create(),
    chartUrl = '{$this->Ini->server_pdf}{$this->Ini->path_imag_temp}/sc_pjs_php_{$phantomId}.html',
    imageFile = '$imageFileName',
    jsDelay = $phantomJsDelay;
thisPage.open(chartUrl, function () {
    window.setTimeout(function () {
        thisPage.render(imageFile);
        phantom.exit();
    }, jsDelay);
});

SCEOT;

        @file_put_contents("{$this->Ini->root}{$_SESSION['scriptcase'] ['grid_income_offday_ot'] ['glo_nm_path_imag_temp']}/sc_pjs_js_{$phantomId}.js", $jsCode);
    }

    function aux_generatePhantomPhp($phantomId)
    {
        $htmlCode = <<<SCEOT
<html>
<head>
    {$_SESSION['nm_session'] ['charset']}

SCEOT;
        $htmlCode .= $this->Graf->display_chart_htmlFusionChartsLibrary('phantom');
        $htmlCode .= <<<SCEOT
    <script type="text/javascript">
        var d = new Date();
        d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = "PHPSESSID_=;" + Math.random().toString(36).substring(2) + ";" + expires + ";path=/";
    </script>  
</head>
<body>

SCEOT;
        $htmlCode .= $this->Graf->display_summaryChart_phantom();
        $htmlCode .= <<<SCEOT
</body>
</html>

SCEOT;

        @file_put_contents("{$this->Ini->root}{$_SESSION['scriptcase'] ['grid_income_offday_ot'] ['glo_nm_path_imag_temp']}/sc_pjs_php_{$phantomId}.html", $htmlCode);
    }

    function aux_getAbbreviatedValue(&$value, &$suffix)
    {
        if (is_numeric($value)) {
            $isNegative = 0 > $value;

            if ($isNegative) {
                $value *= -1;
            }

            $suffix = "&nbsp;&nbsp;";
            if ($value > 1000) { // kilo
                $value /= 1000;
                $suffix = ' k';
            }
            if ($value > 1000) { // mega
                $value /= 1000;
                $suffix = ' M';
            }
            if ($value > 1000) { // giga
                $value /= 1000;
                $suffix = ' G';
            }
            if ($value > 1000) { // tera
                $value /= 1000;
                $suffix = ' T';
            }
            if ($value > 1000) { // peta
                $value /= 1000;
                $suffix = ' P';
            }
            if ($value > 1000) { // exa
                $value /= 1000;
                $suffix = ' E';
            }
            if ($value > 1000) { // zetta
                $value /= 1000;
                $suffix = ' Z';
            }

            if ($isNegative) {
                $value *= -1;
            }
        }
    }

    function aux_getChartInfoType()
    {
        switch ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['cfg_graf'] ['graf_tipo']) {
            case 'Chord':
                return 'chord_info';
            case 'Heatmap':
                return 'heatmap_info';
            case 'Sankey':
                return 'sankey_info';
            case 'Sunburst':
                return 'sunburst_info';
            case 'Treemap':
                return 'treemap_info';
            default:
                return 'chart_info';
        }
    }

    function aux_getDefaultOrderIcon($fieldName)
    {
        if (isset($this->SC_APP_info['dimension'] [$fieldName])) {
            return $this->SC_APP_info['dimension'] [$fieldName] ['order_by_direction'];
        }

        return 'asc';
    }

    function aux_getDimensionOrderIcon($dimensionName, $sortRule)
    {
        if ($this->SC_APP_info['options'] ['use_fontawesome_order_icons']) {
            return $this->aux_getOrderIcon_fontAwesome($dimensionName, $sortRule);
        } else {
            return $this->aux_getOrderIcon_fontAwesome($dimensionName, $sortRule);
        }
    }

    function aux_getDimensionValueLabel($axys, $dimensionIndex, $dimensionValue)
    {
        $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] [$axys] [$dimensionIndex];
        $ratingFunction = $this->SC_APP_info['dimension'] [$dimensionName] ['rating_function']; 

        if ('' != $ratingFunction) {
            return $this->$ratingFunction($dimensionValue);
        } else {
            return $this->SC_APP_data['dimension_value_labels'] [$dimensionName] [$dimensionValue];
        }
    }

    function aux_getFixPin($columnIndex)
    {
        return '';
    }

    function aux_getLineMetricArray($rowDimensionValues)
    {
        $rowDimensionCount = count($rowDimensionValues);

        if (0 == $rowDimensionCount) {
            $dimensionTotalArray = [];
            foreach ($this->array_total_geral as $comparisonIndex => $comparisonArray) {
                foreach ($comparisonArray as $i => $v) {
                    $dimensionTotalArray[$comparisonIndex] [$i + 1] = $v;
                }
            }
            return $dimensionTotalArray;
        }

        $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$rowDimensionCount - 1];
        $dimensionTotalArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_line_values_array'];
        $dimensionTotalArray = $this->$dimensionTotalArrayName;

        foreach ($rowDimensionValues as $dimensionValue) {
            $dimensionTotalArray = $dimensionTotalArray[$dimensionValue];
        }

        return $dimensionTotalArray;
    }

    function aux_getMetricArray($colDimensionValues, $rowDimensionValues)
    {
        $colDimensionCount = count($colDimensionValues);
        $rowDimensionCount = count($rowDimensionValues);

        if (0 == $colDimensionCount && 0 == $rowDimensionCount) {
            $dimensionTotalArray = [];
            foreach ($this->array_total_geral as $comparisonIndex => $comparisonArray) {
                foreach ($comparisonArray as $i => $v) {
                    $dimensionTotalArray[$comparisonIndex] [$i + 1] = $v;
                }
            }
            return $dimensionTotalArray;
        } elseif (0 == $rowDimensionCount) {
            $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['x'] [$colDimensionCount - 1];
        } else {
            $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$rowDimensionCount - 1];
        }
        $dimensionTotalArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_values_array'];
        $dimensionTotalArray = $this->$dimensionTotalArrayName;

        $dimensionValues = count($colDimensionValues) ? array_merge($colDimensionValues, $rowDimensionValues) : $rowDimensionValues;

        foreach ($dimensionValues as $dimensionValue) {
            $dimensionTotalArray = $dimensionTotalArray[$dimensionValue];
        }

        return $dimensionTotalArray;
    }

    function aux_getOrderIcon_fontAwesome($fieldName, $sortRule)
    {
        if ($this->aux_isNumericField($fieldName)) {
            $defaultOffIcon = 'asc' == $this->aux_getDefaultOrderIcon($fieldName) ? "fas fa-sort-numeric-down" : "fas fa-sort-numeric-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down-alt sc-summary-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down sc-summary-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-summary-order-icon sc-summary-order-icon-unused\"></span>";
            }
        } else {
            $defaultOffIcon = 'asc' == $this->aux_getDefaultOrderIcon($fieldName) ? "fas fa-sort-alpha-down" : "fas fa-sort-alpha-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down-alt sc-summary-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down sc-summary-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-summary-order-icon sc-summary-order-icon-unused\"></span>";
            }
        }
    }

    function aux_getPreviousMetricArray($colDimensionValues, $rowDimensionValues)
    {
        if (0 == count($colDimensionValues) && 0 == count($rowDimensionValues)) {
            return [];
        }

        if (0 == count($rowDimensionValues)) {
            array_pop($colDimensionValues);
        } else {
            array_pop($rowDimensionValues);
        }

        return $this->aux_getMetricArray($colDimensionValues, $rowDimensionValues);
    }

    function aux_getPreviousLineMetricArray($rowDimensionValues)
    {
        if (0 == count($rowDimensionValues)) {
            return [];
        }

        array_pop($rowDimensionValues);

        return $this->aux_getLineMetricArray($rowDimensionValues);
    }

    function aux_getProcessOption()
    {
        if (!$this->aux_isProcess()) {
            return '';
        }

        return $this->SC_APP_data['process'] ['option'];
    }

    function aux_getSummaryColspanInfo()
    {
        if ($this->aux_isTabular()) {
            $dimensionColspan = $this->SC_APP_data['dimension_count'] ['y'];
        } else {
            $dimensionColspan = 1;
        }
        if ($this->SC_APP_info['options'] ['display_seq']) {
            $dimensionColspan++;
        }
        if ($this->aux_isComparison()) {
            $dimensionColspan++;
        }

        if ($this->aux_hasXAxysDimensionField()) {
            $metricColspan = 0;

            foreach ($this->SC_APP_data['ordered_x_axys'] as $cellInfo) {
                $metricColspan += $cellInfo['colspan'];
            }

            if ($this->SC_APP_info['options'] ['display_total_row']) {
                $metricColspan += $this->SC_APP_data['metric_count'];
            }
        } else {
            $metricColspan = $this->SC_APP_data['metric_count'];
        }

        return [
            'dimension' => $dimensionColspan,
            'metric' => $metricColspan,
            'total' => $dimensionColspan + $metricColspan
        ];
    }

    function aux_hasCharts()
    {
        return false;
    }

    function aux_hasInlineChart()
    {
        if (!$this->SC_APP_info['options'] ['display_inline_chart']) {
            return false;
        } elseif ($this->aux_isProcess()) {
            return false;
        } elseif ($this->aux_isPdf()) {
            return false;
        } elseif ($this->aux_isPrint()) {
            return false;
        }

        return true;
    }

    function aux_hasPagination()
    {
        if (!$this->SC_APP_info['options'] ['use_pagination']) {
            return false;
        } elseif ($this->grid_emb_form) {
            return false;
        } elseif ($this->NM_res_sem_reg) {
            return false;
        } elseif ($this->aux_isPdf()) {
            return false;
        } elseif ($this->aux_isPrint()) {
            return false;
        }

        return true;
    }

    function aux_hasReloadChartMd5()
    {
        return isset($_POST['reload_chart']) && 'Y' == $_POST['reload_chart'];
    }

    function aux_hasXAxysDimensionField()
    {
        return $this->SC_APP_data['dimension_count'] ['x'] > 0;
    }

    function aux_hasYAxysDimensionField()
    {
        return $this->SC_APP_data['dimension_count'] ['y'] > 0;
    }

    function aux_isComparison()
    {
        return $this->Tem_Res_Compara;
    }

    function aux_isEmptySummary()
    {
        if ($this->NM_res_sem_reg) {
            return true;
        } elseif (0 == count($this->SC_APP_info['group_by'] ['dimension'] ['order'])) {
            return true;
        }

        return false;
    }

    function aux_isExport()
    {
        if ('doc_word' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('doc_word_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('xls' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('xls_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('csv' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('csv_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('xml' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('xml_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('json' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('json_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('rtf' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('rtf_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        }

        return false;
    }

    function aux_isExportOld()
    {
        if ('xls' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('xls_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        }

        if ('xml' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('xml_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        }

        if ('rtf' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        } elseif ('rtf_res' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        }
    }

    function aux_isNumericField($fieldName)
    {
        if (isset($this->SC_APP_info['dimension'] [$fieldName])) {
            if (!in_array($this->SC_APP_info['dimension'] [$fieldName] ['datatype'], array('integer', 'numeric'))) {
                return false;
            }
        }

        return true;
    }

    function aux_isPdf()
    {
        if ('pdf' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        }

        return false;
    }

    function aux_isPrint()
    {
        if ('print' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['opcao']) {
            return true;
        }

        return false;
    }

    function aux_isProcess()
    {
        return $this->SC_APP_data['process'] ['is_process'];
    }

    function aux_isTabular()
    {
        return $this->SC_APP_info['options'] ['tabular'];
    }

    function aux_loadNewInfo()
    {
        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['order'] as $dimensionName) {
            $dimensionArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_values_array'];
            $this->$dimensionArrayName = $this->SC_APP_data['new_info'] [$dimensionName];
        }

        $this->array_total_geral = $this->SC_APP_data['new_info'] ['___total_geral___'];
    }

    function aux_loadOldInfo()
    {
        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['order'] as $dimensionName) {
            $dimensionArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_values_array'];
            $this->$dimensionArrayName = $this->SC_APP_data['old_info'] [$dimensionName];
        }

        $this->array_total_geral = $this->SC_APP_data['old_info'] ['___total_geral___'];
    }

    function aux_skipSummary()
    {
        return $this->aux_isPdf() && $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['skip_summary'];
    }

    function aux_storeLinkInfo($parameters, $linkCall)
    {
        $this->aux_storeLinkInfo_recursive($this->SC_APP_data['chart_links_to_grid'], $parameters, $linkCall);
    }

    function aux_storeLinkInfo_recursive(&$storage, $parameters, $linkCall)
    {
        if (empty($parameters)) {
            $storage['__sc_chart_link'] = $linkCall;
        } else {
            $thisDimensionValue = array_shift($parameters);

            if (!isset($storage[$thisDimensionValue])) {
                $storage[$thisDimensionValue] = [];
            }

            $this->aux_storeLinkInfo_recursive($storage[$thisDimensionValue], $parameters, $linkCall);
        }
    }

    function aux_storeSummaryTableInfo()
    {
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['comb_table_def'] = [
            'field' => [],
            'label' => [],
            'summ' => [],
        ];
        $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['comb_table_data'] = [];

        foreach ($this->SC_APP_info['group_by'] ['metric'] as $i => $metricName) {
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['comb_table_def'] ['field'] [] = $metricName;
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['comb_table_def'] ['label'] [] = $this->SC_APP_info['metric'] [$metricName] ['label'];
            $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['comb_table_def'] ['summ'] [] = $i;
        }

        $this->aux_storeSummaryTableInfo_recursive($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['comb_table_data'], $this->SC_APP_data['ordered_y_axys'], 0, []);
    }

    function aux_storeSummaryTableInfo_recursive(&$tableData, $summaryInfo, $dimensionLevel, $dimensionParameters)
    {
        $dimensionName = $this->SC_APP_info['group_by'] ['dimension'] ['y'] [$dimensionLevel];
        $dimensionLabel = $this->SC_APP_info['dimension'] [$dimensionName] ['label'];
        $dimensionArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_values_array'];
        $dimensionArray = $this->$dimensionArrayName;
        foreach ($dimensionParameters as $thisDimensionParameter) {
            $dimensionArray = $dimensionArray[$thisDimensionParameter];
        }

        foreach ($summaryInfo as $thisDimensionValue => $thisDimensionInfo) {
            $thisDimensionParameters = array_merge($dimensionParameters, [$thisDimensionValue]);
            $thisDimensionValueLabel = $this->SC_APP_data['dimension_value_labels'] [$dimensionName] [$thisDimensionValue];

            $tableData[$thisDimensionValue] = [
                'field_x' => $thisDimensionInfo['dimension'],
                'label_x' => $dimensionLabel,
                'label' => $thisDimensionValueLabel,
                'values' => [],
            ];

            foreach ($this->SC_APP_info['group_by'] ['metric'] as $metricName) {
                $tableData[$thisDimensionValue] ['values'] [] = $dimensionArray[$thisDimensionValue] [self::GROUPBY_ORIGINAL] [ $this->SC_APP_info['metric'] [$metricName] ['value_index'] ];
            }

            if (isset($thisDimensionInfo['children']) && !empty($thisDimensionInfo['children']) && 1 > $dimensionLevel) {
                $tableData[$thisDimensionValue] ['children'] = [];

                $this->aux_storeSummaryTableInfo_recursive($tableData[$thisDimensionValue] ['children'], $thisDimensionInfo['children'], $dimensionLevel + 1, $thisDimensionParameters);
            }
        }
    }

    function aux_transformInfoToOldFormat()
    {
        $this->SC_APP_data['new_info'] = [];
        $this->SC_APP_data['old_info'] = [];

        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['order'] as $dimensionName) {
            $dimensionArrayName = $this->SC_APP_info['dimension'] [$dimensionName] ['summary_values_array'];

            $this->SC_APP_data['new_info'] [$dimensionName] = $this->$dimensionArrayName;
            $this->SC_APP_data['old_info'] [$dimensionName] = [];
        }

        foreach ($this->SC_APP_info['group_by'] ['dimension'] ['order'] as $i => $dimensionName) {
            $this->aux_transformInfoToOldFormat_recursive($i, $this->SC_APP_data['new_info'] [$dimensionName], $this->SC_APP_data['old_info'] [$dimensionName]);
        }

        $this->SC_APP_data['new_info'] ['___total_geral___'] = $this->array_total_geral;
        $this->SC_APP_data['old_info'] ['___total_geral___'] = $this->array_total_geral[self::GROUPBY_ORIGINAL];
    }

    function aux_transformInfoToOldFormat_recursive($groupByDepth, $newInfo, &$oldInfo)
    {
        if (0 == $groupByDepth) {
            foreach ($newInfo as $dimensionValue => $dimensionComparisonArrays) {
                $oldInfo[$dimensionValue] = $dimensionComparisonArrays[self::GROUPBY_ORIGINAL];
            }
        } else {
            foreach ($newInfo as $dimensionValue => $nextDimensionArray) {
                $oldInfo[$dimensionValue] = [];
                $this->aux_transformInfoToOldFormat_recursive($groupByDepth - 1, $nextDimensionArray, $oldInfo[$dimensionValue]);
            }
        }
    }

    function aux_useNewSummary()
    {
        if ($this->aux_isExportOld()) {
            return false;
        }
        return true;
    }

   //---- 
   function resumo_export()
   { 
      $this->NM_export = true;
      $this->monta_resumo();
   } 

    function generateRatingSummarizationJsCss()
    {
        $html = $this->generateRatingSummarizationBreakdownJs();
        $html .= $this->generateRatingSummarizationBarCss();
        return $html;
    }

    function generateRatingSummarizationBreakdownJs()
    {
        $html = <<<SCEOT
<script>
$(function() {
    ratingBreakdownDisplay();
});
function ratingBreakdownDisplay()
{
    $('.sc-rating-breakdown-trigger').on('mouseover', function() {
        let thisId = $(this).data('breakdownId');
        sc_position($(this), $('#sc-breakdown-' + thisId));
    }).on('mouseout', function() {
        let thisId = \$(this).data('breakdownId');
        $('#sc-breakdown-' + thisId).hide();
    });
}
</script>

SCEOT;
        return $html;
    }

    function generateRatingSummarizationBarCss()
    {
        $html = <<<SCEOT
<style>
</style>

SCEOT;
        return $html;
    }

    function getChartInstance()
    {
        require_once $this->Ini->path_aplicacao . $this->Ini->Apl_grafico;
        $this->Graf         = new grid_income_offday_ot_grafico();
        $this->Graf->Db     = $this->Db;
        $this->Graf->Erro   = $this->Erro;
        $this->Graf->Ini    = $this->Ini;
        $this->Graf->Lookup = $this->Lookup;
    }

    function generateChartImages()
    {
        $this->getChartInstance();

        $chartInfoType = $this->aux_getChartInfoType();
        $chartList = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_md5_list'];
        $chartFiles = array();

        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['phantomjs_export_process'] = true;
        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_step']     = 'image';
        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_count']    = 0;
        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_total']    = 0;

        foreach ($chartList as $chartInfo) {
            if (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level']) && '' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level'] && $chartInfo['chart_level'] > $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level']) {
                continue;
            }
            if ($chartInfo['info_type'] == $chartInfoType) {
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_total']++;
            }
        }

        foreach ($chartList as $chartInfo) {
            if (isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level']) && '' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level'] && $chartInfo['chart_level'] > $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_income_offday_ot'] ['chart_level']) {
                continue;
            }
            if ($chartInfo['info_type'] == $chartInfoType) {
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['phantomjs_export_file'] = '';
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_count']++;
    
                $this->writeProgressFile();
    
                $chartImage = $this->aux_generatePhantomImage($chartInfo['md5']);
    
                if ('' != $chartImage) {
                    $chartFiles[] = basename($chartImage);
                }
            }
        }

        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['phantomjs_export_process'] = false;

        return $chartFiles;
    } // generateChartImages

    function zipChartImages($password = '')
    {
        $this->info_initializeSummary();
        $chartImages = $this->generateChartImages();

        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_step'] = 'zip';

        $this->writeProgressFile();

        $zipFile = $this->zipFileList($chartImages, $password);

        $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_step'] = 'end';

        $this->writeProgressFile();

        return $zipFile;
    }

    function zipFileList($fileList, $password = '') {
        $tempDir = $this->Ini->root . $_SESSION['scriptcase']['grid_income_offday_ot']['glo_nm_path_imag_temp'] . '/';
        $zipFile = 'sc_zip_' . md5(microtime() . rand(1, 1000) . session_id()) . '.zip';
        $zipFileFull = $this->zipProtectFileName($tempDir . $zipFile);

        if ('' != $password) {
            if (@is_file($tempDir . $zipFile)) {
                @unlink($tempDir . $zipFile);
            }

            $filename = array_shift($fileList);
            $filenameFull = $this->zipProtectFileName($tempDir . $filename);

            if (FALSE !== strpos(strtolower(php_uname()), 'windows')) {
                chdir("{$this->Ini->path_third}/zip/windows");
                $zipCommand = "zip.exe -P -j {$password} {$zipFileFull} {$filenameFull}";
            } elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) {
                if (FALSE !== strpos(strtolower(php_uname()), 'i686')) {
                    chdir("{$this->Ini->path_third}/zip/linux-i386/bin");
                } else {
                    chdir("{$this->Ini->path_third}/zip/linux-amd64/bin");
                }
                $zipCommand = "./7za -p{$password} a {$zipFileFull} {$filenameFull}";
            } elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin')) {
                chdir("{$this->Ini->path_third}/zip/mac/bin");
                $zipCommand = "./7za -p{$password} a {$zipFileFull} {$filenameFull}";
            }

            if (!empty($zipCommand)) {
                exec($zipCommand);
            }

            while (!empty($fileList)) {
                $filename = array_shift($fileList);
                $filenameFull = $this->zipProtectFileName($tempDir . $filename);

                if (FALSE !== strpos(strtolower(php_uname()), 'windows')) {
                    chdir("{$this->Ini->path_third}/zip/windows");
                    $zipCommand = "zip.exe -P -j -u {$password} {$zipFileFull} {$filenameFull}";
                } elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) {
                    if (FALSE !== strpos(strtolower(php_uname()), 'i686')) {
                        chdir("{$this->Ini->path_third}/zip/linux-i386/bin");
                    } else {
                        chdir("{$this->Ini->path_third}/zip/linux-amd64/bin");
                    }
                    $zipCommand = "./7za -p{$password} a {$zipFileFull} {$filenameFull}";
                } elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin')) {
                    chdir("{$this->Ini->path_third}/zip/mac/bin");
                    $zipCommand = "./7za -p{$password} a {$zipFileFull} {$filenameFull}";
                }

                if (!empty($zipCommand)) {
                    exec($zipCommand);
                }
            }
        } else {
            require_once $this->Ini->path_third . '/zipfile/zipfile.php';

            $tempDir = $this->Ini->root . $_SESSION['scriptcase']['grid_income_offday_ot']['glo_nm_path_imag_temp'] . '/';
            $zipFile = 'sc_zip_' . md5(microtime() . rand(1, 1000) . session_id()) . '.zip';

            $zipHandler = new zipfile();
            $zipHandler->set_file($tempDir . $zipFile);

            foreach ($fileList as $chartImageName) {
                $chartImageFile = $tempDir . $chartImageName;

                $zipHandler->sc_zip_all($chartImageFile);
            }

            $zipHandler->file();
        }

        return $zipFile;
    }

    function zipProtectFileName($filename) {
        return false !== strpos($filename, ' ') ? "\"{$filename}\"" : $filename;
    }

    function writeProgressFile() {
        if ('image' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_step']) {
            $progress = floor($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_count'] * 100 / ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_total'] + 1));
            $content = $this->Ini->Nm_lang['lang_pdff_pcht'] . ": {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_count']}/{$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_total']}###$progress";

            $content = $_SESSION['scriptcase']['charset'] != 'UTF-8' ? sc_convert_encoding($content, 'UTF-8', $_SESSION['scriptcase']['charset']) : $content;
        } elseif ('zip' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_step']) {
            $progress = floor($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_count'] * 100 / ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_total'] + 1));
            $content = $this->Ini->Nm_lang['lang_chrt_zip_img'] . "###$progress";

            $content = $_SESSION['scriptcase']['charset'] != 'UTF-8' ? sc_convert_encoding($content, 'UTF-8', $_SESSION['scriptcase']['charset']) : $content;
        } elseif ('end' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_step']) {
            $content = "ok###100";
        } else {
            $content = "init###0";
        }

        $f = @fopen("{$this->Ini->root}{$_SESSION['scriptcase']['grid_income_offday_ot']['glo_nm_path_imag_temp']}/{$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['export_progress_file']}", 'w');
        fwrite($f, $content);
        fclose($f);
    }

   function monta_resumo($b_export = false)
   {
       global $nm_saida;

       $this->initializeButtons();

      $this->NM_res_sem_reg = false;
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_filtro'];
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca']))
     { 
         $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca'];
         if ($_SESSION['scriptcase']['charset'] != "UTF-8")
         {
             $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
       $this->userid_int = (isset($Busca_temp['userid_int'])) ? $Busca_temp['userid_int'] : ""; 
       $tmp_pos = (is_string($this->userid_int)) ? strpos($this->userid_int, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->userid_int))
       {
           $this->userid_int = substr($this->userid_int, 0, $tmp_pos);
       }
       $this->username = (isset($Busca_temp['username'])) ? $Busca_temp['username'] : ""; 
       $tmp_pos = (is_string($this->username)) ? strpos($this->username, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->username))
       {
           $this->username = substr($this->username, 0, $tmp_pos);
       }
       $this->hiredate = (isset($Busca_temp['hiredate'])) ? $Busca_temp['hiredate'] : ""; 
       $tmp_pos = (is_string($this->hiredate)) ? strpos($this->hiredate, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->hiredate))
       {
           $this->hiredate = substr($this->hiredate, 0, $tmp_pos);
       }
       $hiredate_2 = (isset($Busca_temp['hiredate_input_2'])) ? $Busca_temp['hiredate_input_2'] : ""; 
       $this->hiredate_2 = $hiredate_2; 
       $this->designation = (isset($Busca_temp['designation'])) ? $Busca_temp['designation'] : ""; 
       $tmp_pos = (is_string($this->designation)) ? strpos($this->designation, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->designation))
       {
           $this->designation = substr($this->designation, 0, $tmp_pos);
       }
       $this->dept = (isset($Busca_temp['dept'])) ? $Busca_temp['dept'] : ""; 
       $tmp_pos = (is_string($this->dept)) ? strpos($this->dept, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dept))
       {
           $this->dept = substr($this->dept, 0, $tmp_pos);
       }
     } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "pdf")
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_resumo']);
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['res_hrz']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['res_hrz'] = $this->NM_totaliz_hrz;
      } 
      $this->NM_totaliz_hrz = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['res_hrz'];
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']) && !$this->NM_export)
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("grid_income_offday_ot", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['iframe_menu'] && !$this->NM_export && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['array_graf_pdf'] = array();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "pdf")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_resumo'] = "";
      }
      $this->inicializa_vars();
        $this->info_initializeSummary();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['contr_array_resumo'] == "OK")
      {
            if ($this->aux_hasXAxysDimensionField()) {
                $this->array_line_dept = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['arr_total_line']['dept'];
            }
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
          {
              $Arr_tot_name = "array_total_" . $cmp_gb;
              $this->$Arr_tot_name = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['arr_total'][$cmp_gb];
          }
          $this->array_total_geral = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral_res'];
          $this->NM_res_sem_reg    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['res_sem_reg'];
          $this->Tem_Res_Compara   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['res_compara'];
      }
      else
      {
            $this->info_deleteSummaryCache();
            if ($this->aux_hasXAxysDimensionField() && $this->SC_APP_info['options'] ['display_total_column']) {
                $forceFields = [];
                foreach ($this->SC_APP_info['group_by'] ['dimension'] ['y'] as $dimensionName) {
                    $forceFields[] = $this->SC_APP_info['dimension'] [$dimensionName] ['lowercase'];
                }
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_force_fiels_gb'] = $forceFields;
                $this->array_total_dept = array();
                $this->totaliza();
                if ($this->Tem_Res_Compara) {
                    $this->completa_arrays();
                    $this->finaliza_arrays(1);
                    $this->finaliza_arrays(2);
                }
                else {
                    $this->finaliza_arrays(1);
                }
                $this->array_line_dept = $this->array_total_dept;
                $forceFields = [];
                foreach ($this->SC_APP_info['group_by'] ['dimension'] ['x'] as $dimensionName) {
                    $forceFields[] = $this->SC_APP_info['dimension'] [$dimensionName] ['lowercase'];
                }
                foreach ($this->SC_APP_info['group_by'] ['dimension'] ['y'] as $dimensionName) {
                    $forceFields[] = $this->SC_APP_info['dimension'] [$dimensionName] ['lowercase'];
                }
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_force_fiels_gb'] = $forceFields;
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_clear_total'] = true;
            }
          $this->array_total_dept = array();
          $this->totaliza('main');
          if ($this->Tem_Res_Compara) {
              $this->completa_arrays();
              $this->finaliza_arrays(1);
              $this->finaliza_arrays(2);
          }
          else {
              $this->finaliza_arrays(1);
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['arr_total']['dept'] = $this->array_total_dept;
            if ($this->aux_hasXAxysDimensionField() && $this->SC_APP_info['options'] ['display_total_column']) {
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['arr_total_line']['dept'] = $this->array_line_dept;
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_force_fiels_gb']);
            }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['contr_array_resumo'] = "OK";
      }
      if ($this->aux_useNewSummary()) {
          $this->info_processSummary();
      } else {
          $this->aux_transformInfoToOldFormat();
          $this->aux_loadOldInfo();
      }
      $this->resumo_init();
      if ($this->NM_res_sem_reg)
      {
          $this->resumo_sem_reg();
          $this->resumo_final();
          return;
      }
      if ($b_export)
      {
          return;
      }
      if (!$this->aux_useNewSummary()) {
          $this->completeMatrix();
          $this->buildMatrix();
      }
      if (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] == 'print' || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] == 'pdf') && strpos(" " . $this->Ini->SC_module_export, "resume") === false)
      { }
      else
      {
          if ($this->aux_useNewSummary()) {
              $this->display_summary();
          } else {
              $this->drawMatrix();
          }
      }
      $this->resumo_final();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['contr_label_graf'] = array();
      if (isset($this->nmgp_label_quebras) && !empty($this->nmgp_label_quebras))
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['contr_label_graf'] = $this->nmgp_label_quebras;
      }
   }

   function completeMatrix()
   {
       $this->comp_align       = array();
       $this->comp_display     = array();
       $this->comp_field       = array();
       $this->comp_field_nm    = array();
       $this->comp_field_nm_rv = array();
       $this->comp_fill        = array();
       $this->comp_group       = array();
       $this->comp_index       = array();
       $this->comp_label       = array();
       $this->comp_links_fl    = array();
       $this->comp_links_gr    = array();
       $this->comp_order       = array();
       $this->comp_order_start = array();
       $this->comp_order_col   = '';
       $this->comp_order_level = '';
       $this->comp_order_sort  = '';
       $this->comp_sum         = array();
       $this->comp_sum_order   = array();
       $this->comp_sum_display = array();
       $this->comp_sum_dummy   = array();
       $this->comp_sum_fn      = array();
       $this->comp_sum_lnk     = array();
       $this->comp_sum_css     = array();
       $this->comp_sum_nm      = array();
       $this->comp_sum_fill_0  = false;
       $this->comp_tabular     = true;
       $this->comp_tab_hover   = true;
       $this->comp_tab_seq     = true ;
       $this->comp_tab_extend  = true;
       $this->comp_tab_label   = true;
       $this->comp_totals_a    = array();
       $this->comp_totals_al   = array();
       $this->comp_totals_g    = array();
       $this->comp_totals_x    = array();
       $this->comp_totals_y    = array();
       $this->comp_x_axys      = array();
       $this->comp_y_axys      = array();

       $this->build_total_row  = array();
       $this->build_col_count  = 0;

       $this->show_totals_x    = true;
       $this->show_totals_y    = true;
       //-----
       if ($this->NM_export && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['json_use_label']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['json_use_label'])
       {
          $Lab_dept = "dept";
       }
       else
       {
       $Lab_dept = "Department";
       }
       $prep_field = array();
       $prep_field['dept'] = $Lab_dept;
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['dept'] = $Lab_dept; 
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($Str_gb == "") ? "" : ",";
          $Str_gb .= '"' . $prep_field[$cmp_gb] . '"';
       }
       eval ("\$this->comp_field = array(" . $Str_gb . ");");;

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['userid_int']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['userid_int'] = "ID"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['username']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['username'] = "Employee Name"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['pay_startdate']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['pay_startdate'] = "Start Date"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['pay_enddate']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['pay_enddate'] = "End Date"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['ot_hh_o']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['ot_hh_o'] = "Offday AM OT HH"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['ot_hh_o_pm']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['ot_hh_o_pm'] = "Offday PM OT HH"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['rate_ot_offday_factor']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['rate_ot_offday_factor'] = "Offday Factor"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['rate_work']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['rate_work'] = "Rate Work"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['income_offday_ot']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['income_offday_ot'] = "Income Offday OT"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['hiredate']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['hiredate'] = "Hiredate"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['dept']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['dept'] = "Department"; 
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['designation']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['labels']['designation'] = "Designation"; 
       }
       //-----
       $ix = 0;
       $this->comp_field_nm = array();
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
           $this->comp_field_nm[$cmp_gb] = $ix;
           $ix++;
       }

       $this->comp_field_nm_rv = array_flip($this->comp_field_nm);

       //-----
       $this->comp_sum = array(
           2 => "Offday AM OT HH (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")",
           3 => "Offday PM OT HH (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")",
           4 => "Income Offday OT (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")",
       );

       //-----
       $this->comp_sum_order = array(
           2,
           3,
           4,
       );

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['summarizing_fields_order']['sc_free_group_by']))
       {
           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['summarizing_fields_order']['sc_free_group_by'][] = $i_sum;
           }
       }
       else
       {
           $this->comp_sum_order = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['summarizing_fields_order']['sc_free_group_by'];
       }

       //-----
       $this->comp_sum_display = array(
           2 => true,
           3 => true,
           4 => true,
       );

           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['summarizing_fields_display']['sc_free_group_by'][$i_sum]))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['summarizing_fields_display']['sc_free_group_by'][$i_sum] = array('label' => $l_sum, 'display' => $this->comp_sum_display[$i_sum]);
               }
               else
               {
                   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['summarizing_fields_display']['sc_free_group_by'][$i_sum]['label']))
                   {
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['summarizing_fields_display']['sc_free_group_by'][$i_sum]['label'] = $l_sum;
                   }
                   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['summarizing_fields_display']['sc_free_group_by'][$i_sum]['display']))
                   {
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['summarizing_fields_display']['sc_free_group_by'][$i_sum]['display'] = $this->comp_sum_display[$i_sum];
                   }
               }
           }
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['summarizing_fields_display']['sc_free_group_by'] as $i_sum => $d_sum)
           {
               $this->comp_sum_display[$i_sum] = $d_sum['display'];
           }

       //-----
       $this->comp_sum_dummy = array(
           0,
           0,
           0,
           0,
       );

       //-----
       $this->comp_sum_fn = array(
           2 => "S",
           3 => "S",
           4 => "S",
       );

       //-----
       $this->comp_sum_lnk = array(
           2 => array('field' => "ot_hh_o", 'show' => true),
           3 => array('field' => "ot_hh_o_pm", 'show' => true),
           4 => array('field' => "income_offday_ot", 'show' => true),
       );

       //-----
       $this->comp_sum_css = array(
           2 => "css_ot_hh_o_sum",
           3 => "css_ot_hh_o_pm_sum",
           4 => "css_income_offday_ot_sum",
       );

       //-----
       $this->comp_sum_nm = array(
           2 => "ot_hh_o_sum",
           3 => "ot_hh_o_pm_sum",
           4 => "income_offday_ot_sum",
       );

       //-----
      $Str_gb   = "";
      $Arr_gb   = array();
      $Arr_name = array();
      $Arr_lab  = array();
      $Control  = "";
      $Ctr_lab  = "";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $Arr_gb[]   = $cmp_gb;
          $Arr_name[] = "array_total_" . $cmp_gb . $Control;
          $Arr_lab[]  = $Ctr_lab;
          $Control   .= "[\$campo_" . $cmp_gb . "]";
          $Ctr_lab   .= "[\$dados_" . $cmp_gb . "[5]]";
      }
      for ($ix = 0; $ix < sizeof($Arr_gb); $ix++)
      {
          $Str_gb .= "foreach (\$this->" . $Arr_name[$ix] . " as \$campo_" . $Arr_gb[$ix] . " => \$dados_" . $Arr_gb[$ix] . ")";
          $Str_gb .= "{";
          $Str_gb .= "    if (!isset(\$this->comp_label[" . $ix . "]" . $Arr_lab[$ix] . ") || !in_array(\$campo_" . $Arr_gb[$ix] . ", \$this->comp_label[" . $ix . "]" . $Arr_lab[$ix] . ", true)) {";
          $Str_gb .= "         \$this->comp_index[" . $ix . "][\$dados_" . $Arr_gb[$ix] . "[5] ] = \$dados_" . $Arr_gb[$ix] . "[4];";
          $Str_gb .= "         \$this->comp_label[" . $ix . "]" . $Arr_lab[$ix] . "[ \$dados_" . $Arr_gb[$ix] . "[5] ] = \$dados_" . $Arr_gb[$ix] . "[4];";
          $Str_gb .= "    }";
      }
      for ($ix = 0; $ix < sizeof($Arr_gb); $ix++)
      {
          $Str_gb .= "}";
      }
      eval ($Str_gb);

       //-----
       $x = 0;
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($x == 0) ? $x : ", " . $x;
          $x++;
       }
       eval ("\$this->comp_y_axys = array(" . $Str_gb . ");");;
       $this->comp_x_axys = array();

       $Arr_parms = array();
       $Arr_parms['dept']['alin'] = "''";
       $Arr_parms['dept']['link'] = "S";
       $Arr_parms['dept']['fill'] = "true";
       $Arr_parms['dept']['order'] = "label";
       $Arr_parms['dept']['order_start'] = 'asc';
       $Arr_parms['dept']['order_invert'] = 'false';
       $Arr_parms['dept']['order_enabled'] = 'true';
       $Arr_parms['dept']['order_datatype'] = 'varchar';
       $Arr_parms['dept']['rating_function'] = '';
       //-----
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($Str_gb == "") ? "" : ", ";
          $Str_gb .= $Arr_parms[$cmp_gb]['alin'];
       }
       eval ("\$this->comp_align = array(" . $Str_gb . ");");;

       //-----
       $x = 0;
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
           if ($Arr_parms[$cmp_gb]['link'] == "S")
           {
              $Str_gb .= ($Str_gb == "") ? $x : ", " . $x;
           }
          $x++;
       }
       eval ("\$this->comp_links_gr = array(" . $Str_gb . ");");;

       //-----
       $prep_links_fl = array();
       $prep_links_fl['dept'] = array(0 => 'dept', 1 => '@aspass@');
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $col_sql)
       {
           if (isset($prep_links_fl[$cmp_gb]))
           {
              $Str_gb .= "array('name' => '" . $prep_links_fl[$cmp_gb][0] . "', 'prot' => '" . $prep_links_fl[$cmp_gb][1] . "'),";
           }
       }
       eval ("\$this->comp_links_fl = array(" . $Str_gb . ");");;

       //-----
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($Str_gb == "") ? "" : ", ";
          $Str_gb .= "\"" . $Arr_parms[$cmp_gb]['rating_function'] . "\"";
       }
       eval("\$this->comp_rating_gby = array(" . $Str_gb . ");");

       //-----
       $this->comp_rating_sum = array(
           1 => "",
           2 => "",
           3 => "",
       );

       //-----
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($Str_gb == "") ? "" : ", ";
          $Str_gb .= $Arr_parms[$cmp_gb]['fill'];
       }
       eval ("\$this->comp_fill = array(" . $Str_gb . ");");;

       //-----
       $x = 0;
       $Str_gb = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb .= ($Str_gb == "") ? $x : ", " . $x;
          $Str_gb .= " => 'label'";
          $x++;
       }
       eval ("\$this->comp_display = array(" . $Str_gb . ");");;

       //-----
       $Str_gb  = "";
       $Str_gbs = "";
       $Str_gbi = "";
       $Str_gbe = "";
       $Str_gbdt = "";
       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
       {
          $Str_gb  .= ($Str_gb == "") ? "" : ", ";
          $Str_gb  .= '"' . $Arr_parms[$cmp_gb]['order'] . '"';
          $Str_gbs .= ($Str_gbs == "") ? "" : ", ";
          $Str_gbs .= '"' . $Arr_parms[$cmp_gb]['order_start'] . '"';
          $Str_gbi .= ($Str_gbi == "") ? "" : ", ";
          $Str_gbi .= $Arr_parms[$cmp_gb]['order_invert'];
          $Str_gbe .= ($Str_gbe == "") ? "" : ", ";
          $Str_gbe .= $Arr_parms[$cmp_gb]['order_enabled'];
          $Str_gbdt .= ($Str_gbdt == "") ? "" : ", ";
          $Str_gbdt .= "'" . $Arr_parms[$cmp_gb]['order_datatype'] . "'";
       }
       eval ("\$this->comp_order = array(" . $Str_gb . ");");;
       eval ("\$this->comp_order_start = array(" . $Str_gbs . ");");;
       eval ("\$this->comp_order_invert = array(" . $Str_gbi . ");");;
       eval ("\$this->comp_order_enabled = array(" . $Str_gbe . ");");;
       eval ("\$this->comp_order_datatype = array(" . $Str_gbdt . ");");;

       //-----
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_fill']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_fill'] = $this->comp_fill;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_start']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_start'] = $this->comp_order_start;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_tabular_hover']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_tabular_hover'] = $this->comp_tabular && $this->comp_tab_hover;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_tabular_seq']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_tabular_seq'] = $this->comp_tabular && $this->comp_tab_seq;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_tabular_label']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_tabular_label'] = $this->comp_tabular && $this->comp_tab_label;
       }

       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_col']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_col'] = 0;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_level']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_level'] = 0;
       }
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_sort']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_sort'] = '';
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['ajax_nav'] && isset($_POST['parm']))
       { 
           $todo  = explode("*scout", $_POST['parm']);
           foreach ($todo as $param)
           {
               $cadapar = explode("*scin", $param);
               if (isset($cadapar[1])) {
                   $_POST[$cadapar[0]] = $cadapar[1];
               }
           }
        } 
       if (isset($_POST['change_sort']) && 'Y' == $_POST['change_sort'])
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_sort'] = $_POST['sort_ord'];
           if ('' == $_POST['sort_ord'])
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_col']  = 0;
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_col']  = $_POST['sort_col'];
           }
       }
       if (isset($_POST['change_sort']) && 'NEW' == $_POST['change_sort']) {
           for ($i = 0; $i < sizeof($this->comp_label); $i++) {
               if ($i == $_POST['sort_col']) {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_start'][$i] = $_POST['sort_ord'];
               }
           }
       }

       $this->comp_x_axys      = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_x_axys'];
       $this->comp_y_axys      = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_y_axys'];
       $this->comp_fill        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_fill'];
       $this->comp_order       = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order'];
       $this->comp_order_start = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_start'];
       $this->comp_order_col   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_col'];
       $this->comp_order_level = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_level'];
       $this->comp_order_sort  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_sort'];
       $this->comp_tabular     = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_tabular'];
       $this->comp_tab_hover   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_tabular_hover'];
       $this->comp_tab_seq     = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_tabular_seq'];
       $this->comp_tab_label   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_tabular_label'];

       //-----
       for ($i = 0; $i < sizeof($this->comp_label); $i++) {
           if ('label' == $this->comp_order[$i]) {
               if (('desc' == $this->comp_order_start[$i] && !$this->comp_order_invert[$i]) || ('asc' == $this->comp_order_start[$i] && $this->comp_order_invert[$i]))
               {
                   $sortFn = 'arsort';
                   arsort($this->comp_index[$i]);
               }
               else
               {
                   $sortFn = 'asort';
                   asort($this->comp_index[$i]);
               }
               $this->comp_label[$i] = $this->arrangeLabelList($this->comp_label[$i], $i, $sortFn);
           }
           else {
               if (('desc' == $this->comp_order_start[$i] && !$this->comp_order_invert[$i]) || ('asc' == $this->comp_order_start[$i] && $this->comp_order_invert[$i]))
               {
                   $sortFn = 'krsort';
                   krsort($this->comp_index[$i]);
               }
               else
               {
                   $sortFn = 'ksort';
                   ksort($this->comp_index[$i]);
               }
               $this->comp_label[$i] = $this->arrangeLabelList($this->comp_label[$i], $i, $sortFn);
           }
       }

       //-----
      $Str_gb   = "";
      $Arr_gb   = array();
      $Arr_name = array();
      $Arr_lab  = array();
      $Arr_grp  = array();
      $Control  = "";
      $Ctr_grp  = "";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $Ctr_grp   .= "[\$campo_" . $cmp_gb . "]";
          $Arr_gb[]   = $cmp_gb;
          $Arr_name[] = "array_total_" . $cmp_gb;
          $Arr_lab[]  = $Control;
          $Arr_grp[]  = $Ctr_grp;
          $Control   .= "[\$campo_" . $cmp_gb . "]";
      }
      for ($ix = 0; $ix < sizeof($Arr_gb); $ix++)
      {
          $Str_gb .= "foreach (\$this->comp_label[" . $ix . "]" . $Arr_lab[$ix] . " as \$campo_" . $Arr_gb[$ix] . " => \$dados_" . $Arr_gb[$ix] . ") {";
          $Str_gb .= "    if (isset(\$this->" . $Arr_name[$ix] . $Arr_grp[$ix] . ")) {";
          $Str_gb .= "        \$this->comp_group" . $Arr_grp[$ix] . " = array();";
          $Str_gb .= "    }";
      }
      for ($ix = 0; $ix < sizeof($Arr_gb); $ix++)
      {
          $Str_gb .= "}";
      }
      eval ($Str_gb);

   }

   function arrangeLabelList($label, $level, $method) {
       $new_label = $label;

       if (0 == $level) {
           if ('reverse' == $method) {
               $new_label = array_reverse($new_label, true);
           }
           elseif ('asort' == $method) {
               asort($new_label);
           }
           else {
               ksort($new_label);
           }
       }
       else {
           foreach ($label as $i => $sub_label) {
               $new_label[$i] = $this->arrangeLabelList($sub_label, $level - 1, $method);
           }
       }

       return $new_label;
   }

   function getCompData($level, $params = array()) {
      $Str_gb   = "";
      $Arr_name = array();
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $Arr_name[] = "array_total_" . $cmp_gb;
      }
      for ($ix = 0; $ix < sizeof($Arr_name); $ix++)
      {
          $Str_gb .= "    if (\$level == " . $ix . ") {";
          $Str_gb .= "        \$return = \$this->" . $Arr_name[$ix] . ";";
          $Str_gb .= "    }";
      }
      eval ($Str_gb);

       if (array() == $params) {
           return $return;
       }

       foreach ($params as $i_param => $param) {
           if (!isset($return[$param])) {
               return 0;
           }

           $return = $return[$param];
       }

       return $return;
   }   

   function buildMatrix()
   {
       $this->build_labels = $this->getXAxys();
       $this->build_data   = $this->getYAxys();
   }

   function getXAxys()
   {
       $a_axys = array();

       if (0 == sizeof($this->comp_x_axys))
       {
           if (0 < sizeof($this->comp_sum))
           {
               foreach ($this->comp_sum_order as $i_sum)
               {
                   if ($this->comp_sum_display[$i_sum])
                   {
                       $l_sum = $this->comp_sum[$i_sum];
                       $chart    = '0|' . ($i_sum - 1) . '|';
                       $a_axys[] = array(
                           'group'      => 1,
                           'value'      => $i_sum,
                           'label'      => $l_sum,
                           'field_name' => $this->comp_sum_nm[$i_sum],
                           'function'   => $this->comp_sum_fn[$i_sum],
                           'params'     => array($i_sum - 1),
                           'children'   => array(),
                           'chart'      => '',
                           'css'        => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                       );
                   }
               }
           }
           else
           {
               $a_axys = array();
           }
           $a_labels[] = $a_axys;

           $this->build_col_count = count($a_labels[0]);
       }
       else
       {
           foreach ($this->comp_index[0] as $i_group => $l_group)
           {
               $a_params = array($i_group);
               $a_axys[] = array(
                   'group'    => 0,
                   'value'    => $i_group,
                   'label'    => $this->getRatingGroupBy($l_group, $i_group, 0),//$l_group,
                   'params'   => $a_params,
                   'children' => $this->addChildren(1, $this->comp_fill[1], $this->comp_group[$i_group], $a_params),
               );
           }

           $a_labels = array();
           $this->addChildrenLabel($a_axys, $a_labels);

           $this->build_col_count = 0;
           if (isset($a_labels[0])) {
               foreach ($a_labels[0] as $labelInfo) {
                   if (isset($labelInfo['colspan'])) {
                       $this->build_col_count += $labelInfo['colspan'];
                   }
               }
           }
       }

       if ($this->show_totals_x && 0 < sizeof($this->comp_x_axys))
       {
           $a_labels[0][] = array(
               'group'   => -1,
               'value'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
               'label'   => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
               'params'  => array(),
               'colspan' => sizeof($this->comp_sum),
               'rowspan' => sizeof($this->comp_x_axys),
           );
           foreach ($this->comp_sum_order as $i_sum)
           {
               if ($this->comp_sum_display[$i_sum])
               {
                   $s_label = $this->comp_sum[$i_sum];
                   $a_labels[sizeof($this->comp_x_axys)][] = array(
                       'group'    => -1,
                       'value'    => $s_label,
                       'label'    => $s_label,
                       'function' => $this->comp_sum_fn[$i_sum],
                       'params'   => array(),
                       'chart'    => '',
                           'css'      => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                   );
               }
           }
       }

       return $a_labels;
   }

   function addChildren($group, $fill, $children, $params)
   {
       if (!isset($this->comp_x_axys[$group]))
       {
           if (0 < sizeof($this->comp_sum))
           {
               $a_sum = array();
               foreach ($this->comp_sum_order as $i_sum)
               {
                   if ($this->comp_sum_display[$i_sum])
                   {
                       $l_sum = $this->comp_sum[$i_sum];
                       $chart    = $group . '|' . ($i_sum - 1) . '|' . implode('|', $params);
                       $params_n = array_merge($params, array($i_sum - 1));
                       $a_sum[] = array(
                           'group'    => $group,
                           'value'    => $i_sum,
                           'label'    => $l_sum,
                           'function' => $this->comp_sum_fn[$i_sum],
                           'params'   => $params_n,
                           'children' => array(),
                           'chart'    => '',
                           'css'      => isset($this->comp_sum_css[$i_sum]) ? $this->comp_sum_css[$i_sum] : '',
                       );
                   }
               }
               return $a_sum;
           }
           else
           {
               return array();
           }
       }

       $a_axys = array();

       if ($fill)
       {
           foreach ($this->comp_index[$group] as $i_group => $l_group)
           {
               $params_n = array_merge($params, array($i_group));
               $a_axys[] = array(
                   'group'    => $group,
                   'value'    => $i_group,
                   'label'    => $this->getRatingGroupBy($l_group, $i_group, $group),//$l_group,
                   'params'   => $params_n,
                   'children' => $this->addChildren($group + 1, $this->comp_fill[$group + 1], $children[$i_group], $params_n),
               );
           }
       }
       else
       {
           foreach ($children as $i_group => $a_group)
           {
               $params_n = array_merge($params, array($i_group));
               $a_axys[] = array(
                   'group'    => $group,
                   'value'    => $i_group,
                   'label'    => $this->getRatingGroupBy($this->comp_index[$group][$i_group], $i_group, $group),//$this->comp_index[$group][$i_group],
                   'params'   => $params_n,
                   'children' => $this->addChildren($group + 1, $this->comp_fill[$group + 1], $children[$i_group], $params_n),
               );
           }
       }

       return $a_axys;
   }

   function countChildren($children)
   {
       if (empty($children))
       {
           return 1;
       }

       $i = 0;
       foreach ($children as $data)
       {
           $i += $this->countChildren($data['children']);
       }
       return $i;
   }

   function addChildrenLabel($children, &$a_labels)
   {
       foreach ($children as $a_cols)
       {
           $a_labels[$a_cols['group']][] = array(
               'group'    => $a_cols['group'],
               'value'    => $a_cols['value'],
               'label'    => $a_cols['label'],
               'function' => isset($a_cols['function']) ? $a_cols['function'] : '',
               'params'   => $a_cols['params'],
               'colspan'  => $this->countChildren($a_cols['children']),
               'chart'    => '',
               'css'      => isset($a_cols['css'])   ? $a_cols['css']   : '',
           );
           if (!empty($a_cols['children']))
           {
               $this->addChildrenLabel($a_cols['children'], $a_labels);
           }
       }
   }

   function getYAxys()
   {
       $a_axys = array();

       $this->addYChildren(0, $this->comp_group, $a_axys, array());
       $this->fixOrder($a_axys);
       $this->orderBy($a_axys, $this->comp_order_sort, $this->comp_order_col - 1, 0, array());
       $this->comp_chart_axys = $a_axys;

       $a_data              = array();
       $i_row               = 0;
       $this->subtotal_data = array();
       $this->addYChildrenData($a_axys, $a_data, $i_row, 0, array(), array());

       if (!empty($this->subtotal_data))
       {
           end($this->subtotal_data);
           $i_max = key($this->subtotal_data);
           for ($i = $i_max; $i >= 0; $i--)
           {
               $this->build_total_row[] = true;
               $a_data[] = $this->subtotal_data[$i];
           }
       }

       $this->makeTabular($a_data);

       $this->buildTotalsY($a_data);

       return $a_data;
   }

   function addYChildren($group, $tree, &$axys, $param)
   {
       $comp_label = (isset($this->comp_label[$group])) ? $this->comp_label[$group] : array();
       $tmp_param  = $param;
       while (!empty($tmp_param))
       {
           $tmp_index  = array_shift($tmp_param);
           $comp_label = (isset($comp_label[$tmp_index])) ? $comp_label[$tmp_index] : array();
       }
       foreach ($comp_label as $i_group => $l_group)
       {
           if (isset($tree[$i_group]))
           {
               $new_param = array_merge($param, array($i_group));
               if (in_array($group, $this->comp_y_axys))
               {
                   if (!isset($axys[$i_group]))
                   {
                       $axys[$i_group] = array(
                           'group'    => $group,
                           'value'    => $i_group,
                           'label'    => $l_group,
                           'children' => array(),
                       );
                   }
                   $this->addYChildren($group + 1, $tree[$i_group], $axys[$i_group]['children'], $new_param);
               }
               else
               {
                   $this->addYChildren($group + 1, $tree[$i_group], $axys, $new_param);
               }
           }
       }
   }

   function fixOrder(&$axys)
   {
       $n_axys = array();
       $key    = key($axys);
     if (isset($axys[$key]['group'])) 
     {
       $group  = $axys[$key]['group'];

       foreach ($this->comp_index[$group] as $i_group => $l_group)
       {
           if (isset($axys[$i_group]))
           {
               $n_axys[$i_group] = $axys[$i_group];
           }
           if (!empty($n_axys[$i_group]['children']))
           {
               $this->fixOrder($n_axys[$i_group]['children']);
           }
       }

       $axys = $n_axys;
     }
   }

   function orderBy(&$axys, $ord, $col, $level, $keys)
   {
       if (-1 == $col || '' == $ord)
       {
           return;
       }

       if ($this->comp_order_level <= $level)
       {
           $n_axys = array();
           $o_axys = array();

           foreach ($axys as $i_group => $d_group)
           {
               $o_axys[$i_group] = 0;
           }

           $a_order = $this->getOrderArray($this->getCompData($level), $ord, $col, $keys, $o_axys);

           foreach ($a_order as $i_group => $v_group)
           {
               $n_axys[$i_group] = $axys[$i_group];
           }

           $axys = $n_axys;
       }

       foreach ($axys as $i_group => $d_group)
       {
           if (!empty($d_group['children']))
           {
               $n_keys = array_merge($keys, array($i_group));
               $this->orderBy($axys[$i_group]['children'], $ord, $col, $level + 1, $n_keys);
           }
       }
   }

   function getOrderArray($data, $ord, $col, $keys, $elem)
   {
       while (!empty($keys))
       {
           $key = key($keys);

           if (isset($data[ $keys[$key] ]))
           {
               $data = $data[ $keys[$key] ];
           }

           unset($keys[$key]);
       }

       foreach ($elem as $i_group => $v_group)
       {
           if (isset($data[$i_group]) && isset($data[$i_group][$col]))
           {
               $elem[$i_group] = $data[$i_group][$col];
           }
       }

       if ('a' == $ord)
       {
           asort($elem);
       }
       else
       {
           arsort($elem);
       }

       return $elem;
   }

   function getRatingGroupBy($originalLabel, $value, $groupByField)
   {
       if (isset($this->comp_rating_gby[$groupByField]) && '' != $this->comp_rating_gby[$groupByField] && method_exists($this, $this->comp_rating_gby[$groupByField])) {
           $fnName = $this->comp_rating_gby[$groupByField];
           return $this->$fnName($value);
       }
       return $originalLabel;
   }

   function getRatingSummarization($value, $summarizationField, $alreadyArray = false)
   {
       if (isset($this->comp_rating_sum[$summarizationField]) && '' != $this->comp_rating_sum[$summarizationField] && method_exists($this, $this->comp_rating_sum[$summarizationField])) {
           $fnName = $this->comp_rating_sum[$summarizationField];
           return $this->$fnName($value, $alreadyArray);
       }
       return '';
   }

   function addYChildrenData($axys, &$data, &$row, $level, $params, $tab_col)
   {
       foreach ($axys as $i_data)
       {
           $params_n = array_merge($params, array($i_data['value']));
           if (sizeof($this->comp_y_axys) > $level + 1)
           {
               $tab_col[$level]['label'] = $i_data['label'];
               $tab_col[$level]['group'] = $i_data['group'];
               $tab_col[$level]['value'] = $i_data['value'];
           }
           $b_subtotal = !(!$this->comp_tabular || ($this->comp_tabular && sizeof($this->comp_y_axys) == $level + 1));
           if (1)
           {
               $new_data = array();
               if ($this->comp_tabular)
               {
                   foreach ($tab_col as $i_tab_col => $a_col_data)
                   {
                       $new_data[] = array(
                           'level'  => $level,
                           'label'  => $this->getRatingGroupBy($a_col_data['label'], $a_col_data['value'], $a_col_data['group']),
                           'link'   => in_array($a_col_data['group'], $this->comp_links_gr) ? $this->getLabelLink($params, $i_tab_col, false) : '',
                       );
                   }
               }
               if (!$b_subtotal)
               {
                   $new_data[] = array(
                       'level'  => $level,
                       'group'  => $i_data['group'],
                       'value'  => $i_data['value'],
                       'label'  => $this->getRatingGroupBy($i_data['label'], $i_data['value'], $i_data['group']),
                       'params' => $params_n,
                       'link'   => in_array($i_data['group'], $this->comp_links_gr) ? $this->getLabelLink($params_n, -1, false) : '',
                   );
               }
               elseif ($this->comp_tab_extend && $this->comp_tab_hover)
               {
                   $last_item                           = count($new_data) - 1;
                   $new_data[$last_item]['colspan']    = sizeof($this->comp_y_axys) - sizeof($params_n) + 1;
                   $new_data[$last_item]['display_as'] = 'subtotal';
                   if (!$this->comp_tab_label)
                   {
                       $new_data[$last_item]['label'] = $this->Ini->Nm_lang['lang_othr_chrt_totl'];
                   }
                   $new_data[$last_item]['link'] = $this->getLabelLink($params_n, -1, false);
               }
               else
               {
                   $last_item = count($new_data) - 1;
                   $new_data[] = array(
                       'level'      => $level,
                       'group'      => $i_data['group'],
                       'value'      => $this->Ini->Nm_lang['lang_othr_chrt_totl'],
                       'label'      => $this->comp_tab_label ? $new_data[$last_item]['label'] : $this->Ini->Nm_lang['lang_othr_chrt_totl'],
                       'params'     => $params_n,
                       'link'       => '',
                       'colspan'    => sizeof($this->comp_y_axys) - sizeof($params_n),
                       'display_as' => 'subtotal'
                   );
               }
               $a_columns = 1 == sizeof($this->build_labels)
                          ? current($this->build_labels)
                          : $this->build_labels[sizeof($this->build_labels) - 1];
               if (0 < sizeof($this->comp_x_axys))
               {
                   $this->initTotalsX();
               }
               $i = 0;
               foreach ($a_columns as $a_col_data)
               {
                   if (-1 < $a_col_data['group'])
                   {
                       $val = $this->getCellValue($a_col_data['params'], $params_n);
                       $rat = $this->getCellRating($a_col_data['params'], $params_n);
                       $cnt = $this->getCellCount($a_col_data['params'], $params_n);
                       $fmt = isset($a_col_data['params']) ? $a_col_data['params'][sizeof($a_col_data['params']) - 1] : 0;
                       $key = '';
                       $lnk = $this->getDataLinkParams($params_n, $a_col_data['params']);
                       if (1 == sizeof($this->comp_x_axys))
                       {
                           $key = $this->addTotalsG($i_data, $a_col_data, $params, $val);
                       }
                       unset($a_col_data['chart']);
                       if (sizeof($this->comp_y_axys) - 1 > $level)
                       {
                           $a_chart_params = $a_col_data['params'];
                           unset($a_chart_params[sizeof($a_col_data['params']) - 1]);
                           if (0 < sizeof($params_n))
                           {
                               for ($j = 0; $j < sizeof($params_n); $j++)
                               {
                                   $a_chart_params[] = $params_n[$j];
                               }
                           }
                           $a_col_data['chart'] = ($i_data['group'] + 1). '|' . $fmt . '|' . implode('|', $a_chart_params);
                       }
                       $new_data[] = array(
                           'level'     => -1,
                           'value'     => $val,
                           'rating'    => $rat,
                           'format'    => $fmt,
                           'link_fld'  => (is_numeric($fmt)) ? $fmt + 1 : 0,
                           'link_data' => $lnk,
                           'chart'     => '',
                           'css'       => isset($a_col_data['css'])   ? $a_col_data['css']   : '',
                           'subtotal'  => $b_subtotal,
                       );
                       $aCellColP = $a_col_data['params'];
                       if (0 < sizeof($this->comp_x_axys))
                       {
                           $i_col_x = array_pop($a_col_data['params']);
                           $this->addTotalsX($i_col_x, $val, $key, $cnt);
                           if (0 == $level && 0 < sizeof($this->comp_x_axys))
                           {
                               $this->addTotalsA ('anal', $i_col_x, $val, $a_col_data['params'][0]);
                               $this->addTotalsAL('anal', $i_col_x, $val, $i_data['value']);
                           }
                       }
                       if (($this->comp_tabular || 0 == $level) && !$b_subtotal)
                       {
                           $iTotalP   = array_pop($aCellColP);
                           $aCellParams = array(
                               'col' => $aCellColP,
                               'row' => array(),
                               'fnc' => $iTotalP
                           );
                           $this->addTotalsY($i, $val, $a_col_data['function'], $fmt, $aCellParams);
                       }
                       $i++;
                   }
               }
               if (0 < sizeof($this->comp_x_axys))
               {
                   $this->buildTotalsX($new_data, $i, $level, $i_data['label'], $b_subtotal);
               }
               if (!$b_subtotal)
               {
                   $this->build_total_row[$row] = false;
                   $data[$row] = $new_data;
                   $row++;
               }
               elseif ($this->show_totals_y && !empty($this->comp_sum))
               {
                   if (!isset($this->subtotal_data[$level]))
                   {
                       $this->subtotal_data[$level] = $new_data;
                   }
                   else
                   {
                       end($this->subtotal_data);
                       $i_max = key($this->subtotal_data);
                       for ($i = $i_max; $i >= $level; $i--)
                       {
                           $this->build_total_row[$row] = true;
                           $data[$row] = $this->subtotal_data[$i];
                           $row++;
                           if ($i != $level)
                           {
                               unset($this->subtotal_data[$i]);
                           }
                       }
                       $this->subtotal_data[$level] = $new_data;
                   }
               }
           }
           $this->addYChildrenData($i_data['children'], $data, $row, $level + 1, $params_n, $tab_col);
       }
   }

   function getDataLinkParams($param, $col)
   {
       $a_par = array();

       if (1 < sizeof($col))
       {
           for ($i = 0; $i < sizeof($col) - 1; $i++)
           {
               $a_par[] = $col[$i];
           }
       }

       return implode('|', array_merge($a_par, $param));
   }

   function getDataLink($field, $data, $value)
   {
       if (!isset($this->comp_sum_lnk[$field]) || !$this->comp_sum_lnk[$field]['show'])
       {
           return $value;
       }

       $s_link_field = $this->comp_sum_lnk[$field]['field'];

       $a_link = array(
       );

       if (!isset($a_link[$s_link_field]))
       {
           return $value;
       }

       $a_data = explode('|', $data);
       $a_par  = array();
       $b_ok   = true;

       foreach ($a_link[$s_link_field]['param'] as $s_param => $a_param)
       {
           if ('C' == $a_param['type'])
           {
               if (!isset($a_data[ $this->comp_field_nm[ $a_param['value'] ] ]))
               {
                   $b_ok = false;
               }
               else
               {
                   $a_par[$s_param] = $a_data[ $this->comp_field_nm[ $a_param['value'] ] ];
               }
           }
           else
           {
               $a_par[$s_param] = $a_param['value'];
           }
       }

       if (!$b_ok)
       {
           return $value;
       }

       $b_modal = false;
       if (false !== strpos($a_link[$s_link_field]['html'], '__NM_FLD_PAR_M__'))
       {
           $b_modal                       = true;
           $a_link[$s_link_field]['html'] = str_replace('__NM_FLD_PAR_M__', '__NM_FLD_PAR__', $a_link[$s_link_field]['html']);
       }

       $return = str_replace('__NM_FLD_PAR__', $this->getDataLinkValue($a_par), $a_link[$s_link_field]['html']) . $value . '</a>';

       return $b_modal ? $this->getModalLink($return) :  $return;
   }

   function getDataLinkValue($param)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $i . '?#?' . $v;
       }

       return implode('?@?', $a_links);
   }

   function getModalLink($param)
   {
       return str_replace(array('?#?', '?@?'), array('*scin', '*scout'), $param);
   }

   function getLabelLink($param, $i_tmp = -1, $bProtect = true)
   {
       $a_links = array();

       if (-1 == $i_tmp)
       {
           foreach ($param as $i => $v)
           {
               $i_fld     = $i + sizeof($this->comp_x_axys);
               $a_links[] = $this->comp_links_fl[$i_fld]['name'] . '?#?' . $this->comp_links_fl[$i_fld]['prot'] . addslashes($this->getChartText($v, $bProtect)) . $this->comp_links_fl[$i_fld]['prot'];
           }
       }
       else
       {
           for ($i = 0; $i <= $i_tmp; $i++)
           {
               $v         = (isset($param[$i])) ? $param[$i] : "";
               $i_fld     = $i + sizeof($this->comp_x_axys);
               $a_links[] = $this->comp_links_fl[$i_fld]['name'] . '?#?' . $this->comp_links_fl[$i_fld]['prot'] . addslashes($this->getChartText($v, $bProtect)) . $this->comp_links_fl[$i_fld]['prot'];
           }
       }

       $Parms_Res  = implode('?@?', $a_links);
       $Md5_Res    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_income_offday_ot@SC_par@" . md5($Parms_Res);
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['LigR_Md5'][md5($Parms_Res)] = $Parms_Res;
       return $Md5_Res;
   }

   function getChartLink($param, $bProtect = true)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $this->comp_links_fl[$i]['name'] . '?#?' . $this->comp_links_fl[$i]['prot'] . $this->getChartText($v, $bProtect) . $this->comp_links_fl[$i]['prot'];
       }

       return implode('?@?', $a_links);
   }

   function getCellCount($aColPar, $aRowPar)
   {
       array_pop($aColPar);
       $i_tot = 0;
       $a_val = (0 == sizeof($this->comp_x_axys))
              ? array_merge($aRowPar, array($i_tot))
              : array_merge($aColPar, $aRowPar, array($i_tot));
       return $this->getCompDataCell($a_val, $this->getCompData(sizeof($aColPar) + sizeof($aRowPar) - 1));
   }

   function getCellRating($aColPar, $aRowPar)
   {
       $i_tot = array_pop($aColPar);
       $a_val = (0 == sizeof($this->comp_x_axys))
              ? array_merge($aRowPar, array($i_tot))
              : array_merge($aColPar, $aRowPar, array($i_tot));
       return $this->getRatingSummarization($this->getCompDataCell($a_val, $this->getCompData(sizeof($aColPar) + sizeof($aRowPar) - 1)), $i_tot);
   }

   function getCellValue($aColPar, $aRowPar)
   {
       $i_tot = array_pop($aColPar);
       $a_val = (0 == sizeof($this->comp_x_axys))
              ? array_merge($aRowPar, array($i_tot))
              : array_merge($aColPar, $aRowPar, array($i_tot));
       return $this->getCompDataCell($a_val, $this->getCompData(sizeof($aColPar) + sizeof($aRowPar) - 1));
   }

   function getCompDataCell($par, $data)
   {
       $key = key($par);
       $cur = $par[$key];
       if (is_array($data[$cur]))
       {
           unset($par[$key]);
           return $this->getCompDataCell($par, $data[$cur]);
       }
       elseif (isset($data[$cur]))
       {
           return $data[$cur];
       }
       elseif (!$this->comp_sum_fill_0)
       {
           return '';
       }
       else
       {
           return 0;
       }
   }

   function makeTabular(&$a_data)
   {
       if ($this->comp_tabular)
       {
           $a_labels = array();
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf_vert'])
   {
     $this->comp_tab_hover = true;
   }
           if ($this->comp_tab_hover)
           {
               foreach ($a_data as $row => $columns)
               {
                   for ($i = 0; $i < sizeof($this->comp_y_axys) - 1; $i++)
                   {
                      if (!isset($a_labels[$i]))
                      {
                          $a_labels[$i] = '';
                      }
                      if (isset($a_data[$row][$i]) && !isset($a_data[$row][$i]['display_as']))
                      {
                          if (isset($columns[$i]['label']) && $a_labels[$i] == $columns[$i]['label'])
                          {
                              $a_data[$row][$i]['display_as'] = 'none';
                          }
                          else
                          {
                              $a_data[$row][$i]['display_as'] = 'auto';
                          }
                      }
                      $a_labels[$i] = (isset($columns[$i]['label'])) ? $columns[$i]['label'] : "";
                   }
               }
           }
           else
           {
               foreach ($a_data as $row => $columns)
               {
                   for ($i = 0; $i < sizeof($this->comp_y_axys) - 1; $i++)
                   {
                       if (!isset($a_labels[$i]))
                       {
                           $a_labels[$i] = array(
                               'old'  => $columns[$i]['label'],
                               'row'  => $row,
                               'span' => 1,
                           );
                       }
                       elseif ($a_labels[$i]['old'] == $columns[$i]['label'])
                       {
                           unset($a_data[$row][$i]);
                           $a_labels[$i]['span']++;
                       }
                       else
                       {
                           $a_data[ $a_labels[$i]['row'] ][$i]['rowspan'] = $a_labels[$i]['span'];
                           $a_labels[$i]['old']  = $columns[$i]['label'];
                           $a_labels[$i]['row']  = $row;
                           $a_labels[$i]['span'] = 1;
                       }
                   }
               }
               foreach ($a_labels as $i_col => $a_col_data)
               {
                   $a_data[ $a_col_data['row'] ][$i_col]['rowspan'] = $a_col_data['span'];
               }
           }
       }
   }

   function initTotalsX()
   {
       $this->comp_totals_x = array();

       if (!$this->show_totals_x)
       {
           return;
       }

       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               $this->comp_totals_x[$i_sum - 1] = array('values' => array(), 'count' => array(), 'chart' => '');
           }
       }
   }

   function addTotalsX($col, $val, $chart, $count)
   {
       if (!$this->show_totals_x)
       {
           return;
       }

       $this->comp_totals_x[$col]['chart'] = $chart;
       $this->comp_totals_x[$col]['count'][] = $count;
       if (isset($this->comp_rating_sum[$col]) && '' != $this->comp_rating_sum[$col] && method_exists($this, $this->comp_rating_sum[$col])) {
           $this->comp_totals_x[$col]['values'][] = json_decode($val, true);
       } else {
           $this->comp_totals_x[$col]['values'][] = $val;
       }
   }

   function buildTotalsX(&$row, $col, $level, $label, $sub)
   {
       if (!$this->show_totals_x)
       {
           return;
       }

       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               if (isset($this->comp_rating_sum[$i_sum - 1]) && '' != $this->comp_rating_sum[$i_sum - 1] && method_exists($this, $this->comp_rating_sum[$i_sum - 1])) {
                   $i_temp[$i_sum - 1] = array();
               } else {
                   $i_temp[$i_sum - 1] = '';
               }
               $i_count[$i_sum - 1] = 0;
           }
       }

       $key = key($this->comp_totals_x);

       for ($i = 0; $i < sizeof($this->comp_totals_x[$key]['values']); $i++)
       {
           foreach ($this->comp_sum_order as $i_sum)
           {
               if ($this->comp_sum_display[$i_sum])
               {
                   if (isset($this->comp_rating_sum[$i_sum - 1]) && '' != $this->comp_rating_sum[$i_sum - 1] && method_exists($this, $this->comp_rating_sum[$i_sum - 1])) {
                       foreach ($this->comp_totals_x[$i_sum - 1]['values'][$i]['vls'] as $ratingValue => $ratingCount) {
                           if (!isset($i_temp[$i_sum - 1][$ratingValue])) {
                               $i_temp[$i_sum - 1][$ratingValue] = 0;
                           }
                           $i_temp[$i_sum - 1][$ratingValue] += $ratingCount;
                       }
                       continue;
                   }
                   if ('' == $this->comp_totals_x[$i_sum - 1]['values'][$i])
                   {
                       $this->comp_totals_x[$i_sum - 1]['values'][$i] = 0;
                   }
                   $l_sum = $this->comp_sum[$i_sum];
                   $this_count = (int) $this->comp_totals_x[$i_sum - 1]['count'][$i];
                   if ('' == $i_temp[$i_sum - 1])
                   {
                       if ('A' == $this->comp_sum_fn[$i_sum])
                       {
                           $i_temp[$i_sum - 1] = $this->comp_totals_x[$i_sum - 1]['values'][$i] * $this_count;
                       } else {
                           $i_temp[$i_sum - 1] = $this->comp_totals_x[$i_sum - 1]['values'][$i];
                       }
                   }
                   elseif ('M' == $this->comp_sum_fn[$i_sum] && '' !== $this->comp_totals_x[$i_sum - 1]['values'][$i])
                   {
                       $i_temp[$i_sum - 1] = min($i_temp[$i_sum - 1], $this->comp_totals_x[$i_sum - 1]['values'][$i]);
                   }
                   elseif ('X' == $this->comp_sum_fn[$i_sum])
                   {
                       $i_temp[$i_sum - 1] = max($i_temp[$i_sum - 1], $this->comp_totals_x[$i_sum - 1]['values'][$i]);
                   }
                   else
                   {
                       if ('A' == $this->comp_sum_fn[$i_sum])
                       {
                           $i_temp[$i_sum - 1] += ($this->comp_totals_x[$i_sum - 1]['values'][$i] * $this_count);
                       } else {
                           $i_temp[$i_sum - 1] += $this->comp_totals_x[$i_sum - 1]['values'][$i];
                       }
                   }
                   $i_count[$i_sum - 1] += $this_count;
               }
           }
       }
       foreach ($this->comp_sum as $i_sum => $l_sum)
       {
           if (isset($this->comp_rating_sum[$i_sum - 1]) && '' != $this->comp_rating_sum[$i_sum - 1] && method_exists($this, $this->comp_rating_sum[$i_sum - 1])) {
               continue;
           }
           if ('A' == $this->comp_sum_fn[$i_sum] && isset($this->comp_totals_x[$i_sum - 1]['values']) && is_numeric($i_count[$i_sum - 1]))
           {
               $i_temp[$i_sum - 1] /= $i_count[$i_sum - 1];
           }
           if ('%' == $this->comp_sum_fn[$i_sum])
           {
               $i_temp[$i_sum - 1] = 100.00;
           }
       }
       foreach ($this->comp_sum_order as $i_sum)
       {
           if ($this->comp_sum_display[$i_sum])
           {
               $l_sum = $this->comp_sum[$i_sum];
               $row[] = array(
                   'total'  => true,
                   'level'  => -1,
                   'value'  => $i_temp[$i_sum - 1],
                   'rating' => $this->getRatingSummarization($i_temp[$i_sum - 1], $i_sum - 1, true),
                   'format' => $i_sum - 1,
                   'chart'  => '',
               );
               if (0 == $level && 0 < sizeof($this->comp_x_axys))
               {
                   $this->addTotalsA('sint', $i_sum - 1, $i_temp[$i_sum - 1], $label);
               }
               if (($this->comp_tabular || 0 == $level) && !$sub)
               {
                   $aCellParams = array(
                       'col' => false,
                       'row' => array(),
                       'fnc' => $i_sum - 1
                   );
                   $this->addTotalsY($col + ($i_sum - 1), $i_temp[$i_sum - 1], $this->comp_sum_fn[$i_sum], $i_sum - 1, $aCellParams);
               }
           }
       }
   }

   function addTotalsA($mode, $col, $val, $label)
   {
       if (!isset($this->comp_totals_a[$col]))
       {
           $this->comp_totals_a[$col] = array(
               'labels' => array(),
               'values' => array(
                   'anal' => array(),
                   'sint' => array(),
               ),
           );
       }
       if ('sint' == $mode)
       {
           $this->comp_totals_a[$col]['labels'][]         = $label;
           $this->comp_totals_a[$col]['values']['sint'][] = $val;
       }
       elseif ('anal' == $mode)
       {
           if (isset($this->comp_index[ $this->comp_x_axys[0] ][$label]))
           {
               $label = $this->comp_index[ $this->comp_x_axys[0] ][$label];
           }
           $this->comp_totals_a[$col]['values']['anal'][$label][] = $val;
       }
   }

   function addTotalsAL($mode, $col, $val, $label)
   {
       if (!isset($this->comp_totals_al[$col]))
       {
           $this->comp_totals_al[$col] = array(
               'labels' => array(),
               'values' => array(
                   'anal' => array(),
                   'sint' => array(),
               ),
           );
       }
       if ('sint' == $mode)
       {
           $this->comp_totals_al[$col]['labels'][]         = $label;
           $this->comp_totals_al[$col]['values']['sint'][] = $val;
       }
       elseif ('anal' == $mode)
       {
           if (isset($this->comp_index[ $this->comp_y_axys[0] ][$label]))
           {
               $label = $this->comp_index[ $this->comp_y_axys[0] ][$label];
           }
           $this->comp_totals_al[$col]['values']['anal'][$label][] = $val;
       }
   }

   function addTotalsY($col, $val, $fun, $fmt, $par = array())
   {
       if (!$this->show_totals_y)
       {
           return;
       }

       if (!isset($this->comp_totals_y[$col]))
       {
           $this->comp_totals_y[$col] = array(
               'format'   => $fmt,
               'function' => $fun,
               'param_c'  => empty($par) ? false : $par['col'],
               'param_r'  => empty($par) ? false : $par['row'],
               'param_f'  => empty($par) ? ''    : $par['fnc'],
               'values'   => array(),
           );
       }
       $this->comp_totals_y[$col]['values'][] = $val;
   }

   function buildTotalsY(&$matrix)
   {
       if (!$this->show_totals_y)
       {
           return;
       }

       $row = sizeof($matrix);

       $this->build_total_row[$row] = true;

       $matrix[$row][] = array(
           'group'      => -1,
           'value'      => $this->Ini->Nm_lang['lang_msgs_totl'],
           'label'      => $this->Ini->Nm_lang['lang_msgs_totl'],
           'params'     => array(),
           'colspan'    => $this->comp_tabular ? sizeof($this->comp_y_axys) : 1,
           'display_as' => $this->comp_tab_hover ? 'total' : 'total'
       );

       $aTotals = array();
       foreach ($this->comp_totals_y as $cols)
       {
           $iSum           = empty($cols['param_c']) ? $this->getColumnTotal(false, $cols['param_f']) : $this->getColumnTotal($cols['param_c'], $cols['param_f']);
           if ($cols['function'] == "%") {
               $iSum = 100.00;
           }
           $aTotals[]      = $iSum;
           $matrix[$row][] = array(
               'total'  => true,
               'level'  => -1,
               'value'  => $iSum,
               'format' => $cols['format'],
           );
           $this->array_general_total[] = $iSum;
       }

       if (1 == sizeof($this->comp_x_axys))
       {
           $i_count = 0;
           $aLabels = array();
           foreach ($this->comp_index[0] as $group_label)
           {
               $aLabels[] = $group_label;
               foreach ($this->comp_sum as $i_sum => $l_sum)
               {
                   $this->comp_totals_al[$i_sum - 1]['values']['sint'][] = $aTotals[$i_count];
                   $i_count++;
               }
           }
           foreach ($this->comp_sum as $i_sum => $l_sum)
           {
               $this->comp_totals_al[$i_sum - 1]['labels'] = $aLabels;
           }
       }
   }

   function addTotalsG($line, $column, $param, $value)
   {
       $s_item  = $column['params'][0];
       $i_total = $column['params'][1];
       $param[] = $line['value'];
       $s_key   = 'G|' . $i_total . '|' . implode('|', $param);

       if (!isset($this->comp_totals_g[$s_key]))
       {
           $this->comp_totals_g[$s_key] = array(
               'title'    => $this->getChartText($this->comp_sum[$i_total + 1]),
               'show_sub' => true,
               'subtitle' => $this->getChartText($this->getChartSubtitle($param, 1)),
               'field_x'  => $this->getCompFieldName(0),
               'field_y'  => $this->comp_sum_nm[$i_total + 1],
               'label_x'  => $this->getChartText($this->comp_field[0]),
               'label_y'  => $this->getChartText($this->comp_sum[$i_total + 1]),
               'labels'   => array(),
               'values'   => array(
               'sint'     => array(0 => array()),
               ),
           );
       }

       $this->comp_totals_g[$s_key]['labels'][]            = isset($this->comp_index[0][$s_item]) ? $this->comp_index[0][$s_item] : $s_item;
       $this->comp_totals_g[$s_key]['values']['sint'][0][] = $value;

       return $s_key;
   }

   function getCompFieldName($index)
   {
       foreach ($this->comp_field_nm as $fieldName => $fieldIndex) {
           if ($index == $fieldIndex) {
               return $fieldName;
           }
       }
       return '';
   }

   function getColumnTotal($param_c, $param_f)
   {
       $paramCompRatingSum = $param_f;
       if (false == $param_c)
       {
           $final_data = $this->array_total_geral;
           if (empty($final_data)) {
               return "";
           }
           $param_f   -= 1;
       }
       else
       {
          $Str_gb   = "";
          $Arr_name = array();
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
          {
              $Arr_name[] = "array_total_" . $cmp_gb;
          }
          for ($ix = 0; $ix < sizeof($Arr_name); $ix++)
          {
              $Str_gb .= "    if (count(\$this->comp_x_axys) == " . ($ix + 1) . ") {";
              $Str_gb .= "        \$return = \$this->" . $Arr_name[$ix] . ";";
              $Str_gb .= "    }";
          }
          eval ($Str_gb);
           $final_data = $this->getColumnTotalData($param_c, $return);
       }
       if (isset($this->comp_rating_sum[$paramCompRatingSum]) && '' != $this->comp_rating_sum[$paramCompRatingSum] && method_exists($this, $this->comp_rating_sum[$paramCompRatingSum])) {
           $fnName = $this->comp_rating_sum[$paramCompRatingSum];
           return $this->$fnName($final_data[$param_f]);
       } else {
           return $final_data[$param_f];
       }
   }

   function getColumnTotalData($param_c, $data)
   {
       $elem = array_shift($param_c);

       if (empty($param_c))
       {
            return $data[$elem];
       }
       else
       {
           return $this->getColumnTotalData($param_c, $data[$elem]);
       }
   }

   function buildColumnTotal($fun, $rows)
   {
       $total = '';

       foreach ($rows as $val)
       {
           if ('' == $total)
           {
               $total = $val;
           }
           elseif ('M' == $fun && '' !== $val)
           {
               $total = min($total, $val);
           }
           elseif ('X' == $fun)
           {
               $total = max($total, $val);
           }
           else
           {
               $total += $val;
           }
       }

       if ('A' == $fun)
       {
           $total /= sizeof($rows);
       }
       if ('%' == $fun)
       {
           $total = 100.00;
       }
       if ('W' == $fun || 'V' == $fun || 'P' == $fun)
       {
           $total = "";
       }

       return $total;
   }

   function getFusionLink($originalLink)
   {
       $linkParts = explode('!!!', $originalLink);

       if (1 == count($linkParts)) {
           return $originalLink;
       }

       $linkParts[1] = md5($linkParts[1]);

       return implode('', $linkParts);
   }

   function getKeysTotals(&$a_keys, &$a_totals, $data, $param)
   {
       for ($i = 0; $i < sizeof($this->comp_x_axys); $i++)
       {
           $key_param = key($param);
           unset($param[$key_param]);
       }
       $list_data = $this->comp_chart_axys;
       foreach ($param as $now_param)
       {
           $list_data = $list_data[$now_param]['children'];
       }
       $list_data = (is_array($list_data)) ? array_keys($list_data) : array();
       $size = sizeof($this->comp_sum_dummy);
       foreach ($list_data as $k_group)
       {
           if (isset($data[$k_group])) {
               $totals = $data[$k_group];
           }
           else {
               $totals = $this->comp_sum_dummy;
           }
           $a_keys[] = $k_group;
           $count    = 0;
           foreach ($totals as $i_total => $v_total)
           {
               if ($count == $size)
               {
                   break;
               }
               $a_totals[$i_total][] = $v_total;
               $count++;
           }
       }
       if (!empty($param))
       {
           $a_indexes = $this->getRealIndexes($this->comp_chart_axys, $param);
           foreach ($a_keys as $i => $v)
           {
               if (!in_array($v, $a_indexes))
               {
                   unset($a_keys[$i]);
                   foreach ($a_totals as $t => $l)
                   {
                       unset($a_totals[$t][$i]);
                   }
               }
           }
           $a_keys = array_values($a_keys);
           foreach ($a_totals as $t => $l)
           {
               $a_totals[$t] = array_values($a_totals[$t]);
           }
       }
   }

   function getRealIndexes($data, $param)
   {
       if (empty($param))
       {
           $a_indexes = array();
           foreach ($data as $i => $v)
           {
               $a_indexes[] = $i;
           }
           return $a_indexes;
       }
       else
       {
           $key = key($param);
           $val = $param[$key];
           unset($param[$key]);
           return $this->getRealIndexes($data[$val]['children'], $param);
       }
   }

   function getGroupLabels($group, $keys)
   {
       $a_labels = array();
       foreach ($keys as $key)
       {
           $a_labels[] = isset($this->comp_index[$group][$key]) ? $this->comp_index[$group][$key] : $key;
       }
       return $a_labels;
   }

   function getChartSubtitle($param, $s = 0)
   {
       $a_links = array();

       foreach ($param as $i => $v)
       {
           $a_links[] = $this->comp_field[$i + $s] . ' = ' . $this->comp_index[$i + $s][$v];
       }

       return implode(' :: ', $a_links);
   }

   function getAnaliticCharts($total, &$chart_data)
   {
       $chart_data['labels_anal']           = array();
       $chart_data['legend']                = (isset($this->comp_field[1])) ? $this->comp_field[1] : "";
       $chart_data['values']['anal']        = array();
       $chart_data['values']['anal_values'] = array();
       $chart_data['values']['anal_links']  = array();

       foreach ($this->comp_index[0] as $i_0 => $v_0)
       {
           $chart_data['labels_anal'][] = $v_0;
       }
      if (isset($this->comp_index[1])) {
       foreach ($this->comp_index[1] as $i_1 => $v_1)
       {
           $chart_data['values']['anal'][$v_1] = array();
           foreach ($this->comp_index[0] as $i_0 => $v_0)
           {
               $vCompData                                  = $this->getCompData(1, array($i_0, $i_1, $total));
               $chart_data['values']['anal'][$v_1][]       = isset($vCompData) ? $vCompData : 0;
               $chart_data['values']['anal_values'][$v_1]  = $i_1;
               $chart_data['values']['anal_links'][$i_1][] = $this->getChartLink(array($i_0, $i_1), -1);
           }
       }
      }
   }

   function getChartText($s, $bProtect = true)
   {
       if (!$bProtect)
       {
           return $s;
       }
       if ('UTF-8' != $_SESSION['scriptcase']['charset'])
       {
           $s = sc_convert_encoding($s, 'UTF-8', $_SESSION['scriptcase']['charset']);
       }
       return function_exists('html_entity_decode') ? html_entity_decode($s, ENT_COMPAT | ENT_HTML401, 'UTF-8') : $s;
   }

   function drawMatrix()
   {
       global $nm_saida;

       if ($this->NM_export)
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['arr_export']['label'] = $this->build_labels;
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['arr_export']['data']  = $this->build_data;
           return;
       }

       $nm_saida->saida("<tr id=\"summary_body\" class='sc-mobile-inner-control'>\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['ajax_nav'])
       { 
           $_SESSION['scriptcase']['saida_html'] = "";
       } 
      $TD_padding = (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] == "pdf") ? " style=\"padding: 0px !important;\"" : "";
       $nm_saida->saida("<td class=\"" . $this->css_scGridTabelaTd . " sc-mobile-inner-control\"" . $TD_padding . ">\r\n");
       $nm_saida->saida("<table class=\"scGridTabela\" id=\"sc-ui-summary-body\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\">\r\n");

       $this->drawMatrixLabels();
      if ($this->comp_tab_hover)
      {
          $nm_saida->saida("    <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("        $(function() {\r\n");
          $nm_saida->saida("            $(\".scGridSummaryLine\").click(function() {\r\n");
          $nm_saida->saida("              var bHasClicked = $(this).find(\".scGridSummaryLineOdd\").hasClass(\"scGridSummaryClickedLine\") || $(this).find(\".scGridSummaryLineEven\").hasClass(\"scGridSummaryClickedLine\") || $(this).find(\".scGridSummarySubtotal\").hasClass(\"scGridSummaryClickedSubtotal\") || $(this).find(\".scGridSummaryTotal\").hasClass(\"scGridSummaryClickedTotal\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryLineOdd\").removeClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryLineEven\").removeClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryGroupbyVisible\").removeClass(\"scGridSummaryClickedGroupbyVisible\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryGroupbyInvisible\").removeClass(\"scGridSummaryClickedGroupbyInvisible\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryGroupbyInvisibleDisplay\").removeClass(\"scGridSummaryClickedGroupbyInvisibleDisplay\");\r\n");
          $nm_saida->saida("              $(\".scGridSummarySubtotal\").removeClass(\"scGridSummaryClickedSubtotal\");\r\n");
          $nm_saida->saida("              $(\".scGridSummaryTotal\").removeClass(\"scGridSummaryClickedTotal\");\r\n");
          $nm_saida->saida("              if (!bHasClicked) {\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryLineOdd\").addClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryLineEven\").addClass(\"scGridSummaryClickedLine\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryGroupbyVisible\").addClass(\"scGridSummaryClickedGroupbyVisible\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryGroupbyInvisible\").addClass(\"scGridSummaryClickedGroupbyInvisible\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryGroupbyInvisibleDisplay\").addClass(\"scGridSummaryClickedGroupbyInvisibleDisplay\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummarySubtotal\").addClass(\"scGridSummaryClickedSubtotal\");\r\n");
          $nm_saida->saida("                $(this).find(\".scGridSummaryTotal\").addClass(\"scGridSummaryClickedTotal\");\r\n");
          $nm_saida->saida("              }\r\n");
          $nm_saida->saida("            });\r\n");
          $nm_saida->saida("        });\r\n");
          $nm_saida->saida("    </script>\r\n");
      }

       $s_class   = 'scGridSummaryLineOdd';
       $s_class_v = 'scGridSummaryGroupbyVisible';
        $iSeqCount = 0;
       foreach ($this->build_data as $row_i => $lines)
       {
           $fixedColumnCount = 0;
           $this->prim_linha = false;
           $sTrClass         = $this->comp_tab_hover ? ' class="scGridSummaryLine"' : '';
           $nm_saida->saida(" <tr $sTrClass>\r\n");
           if ($this->comp_tab_seq)
           {
               if ($this->build_total_row[$row_i])
               {
                   $sSeqDisplay = '&nbsp;';
               }
               else
               {
                   $iSeqCount++;
                   $sSeqDisplay = $iSeqCount;
               }
               $nm_saida->saida(" <td class=\"scGridSummaryGroupbyVisible scGridSummaryGroupbySeq sc-col-op sc-col-op-seq\">$sSeqDisplay</td>\r\n");
           }
           foreach ($lines as $col_i => $columns)
           {
               $this->NM_graf_left = $this->Graf_left_dat;
               if (isset($columns['level']) && 0 <= $columns['level'])
               {
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida'])
                   {
                       $columns['label'] = ($columns['label'] == "") ? "&nbsp;" : $columns['label'];
                       $s_label   = (isset($columns['link']) && '' != $columns['link']) ? "<a href=\"javascript: nm_link_cons('" . $columns['link'] . "')\" class=\"" . (isset($columns['display_as']) && 'none' == $columns['display_as'] ? 'scGridSummaryGroupbyInvisibleLink' : 'scGridSummaryGroupbyVisibleLink') . "\">" . $columns['label'] . '</a>' : $columns['label'];
                   }
                   else
                   {
                       $s_label   = $columns['label'];
                   }
                   $s_style   = '';
                   $s_text    = $this->comp_tabular ? $s_label : str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $columns['level']) . $s_label;
                   $s_class_v = 'scGridSummaryGroupbyVisible';
                   if (isset($columns['display_as']) && 'none' == $columns['display_as'])
                   {
                       $s_text    = '<span class="scGridSummaryGroupbyInvisibleDisplay">' . $s_text . '</span>';
                       $s_class_v = 'scGridSummaryGroupbyInvisible';
                   }
                   elseif (isset($columns['display_as']) && 'subtotal' == $columns['display_as'])
                   {
                       $s_class_v = 'scGridSummarySubtotal';
                   }
                   elseif (isset($columns['display_as']) && 'total' == $columns['display_as'])
                   {
                       $s_class_v = 'scGridSummaryTotal';
                   }
                   $s_class_fix_fld = ' sc-col-fld sc-col-fld-';
                   $s_class_fix_fld_idx = $fixedColumnCount;
                   $fixedColumnCount++;
               }
               else
               {
                   $s_style = '';
                   $columnValue = isset($columns['rating']) && '' != $columns['rating'] ? $columns['rating'] : $this->formatValue($columns['format'], $columns['value']);
                   if (isset($columns['total']) && $columns['total'])
                   {
                       $s_style   = ' style="text-align: right"';
                       $s_text    = $columnValue;
                       $s_class_v = 'scGridSummaryTotal';
                       $this->NM_graf_left = $this->Graf_left_tot;
                   }
                   elseif (isset($columns['subtotal']) && $columns['subtotal'])
                   {
                       $s_text    = $columnValue;
                       $s_class_v = 'scGridSummarySubtotal';
                   }
                   else
                   {
                       if (!isset($columns['link_fld']))  { $columns['link_fld']  = "";}
                       if (!isset($columns['link_data'])) { $columns['link_data'] = "";}
                       if (!isset($columns['format']))    { $columns['format']    = "";}
                       $s_text    = $this->getDataLink($columns['link_fld'], $columns['link_data'], $columnValue);
                       $s_class_v = $s_class;
                   }
                   $s_class_fix_fld = '';
                   $s_class_fix_fld_idx = '';
               }
               $css     = (isset($columns['css']) && '' != $columns['css']) ? ' ' . $columns['css'] . '_field' : '';
               $colspan = (isset($columns['colspan']) && 1 < $columns['colspan']) ? ' colspan="' . $columns['colspan'] . '"' : '';
               $rowspan = (isset($columns['rowspan']) && 1 < $columns['rowspan']) ? ' rowspan="' . $columns['rowspan'] . '"' : '';
               $chart   = (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida']) && isset($columns['chart']) && '' != $columns['chart'] && isset($this->comp_chart_data[ $columns['chart'] ]))
                        ? nmButtonOutput($this->arr_buttons, "bgraf", "nm_graf_submit_2('" . $columns['chart'] . "')", "nm_graf_submit_2('" . $columns['chart'] . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->comp_chart_data[ $columns['chart'] ]['label_x'] . " X " . $this->comp_chart_data[ $columns['chart'] ]['label_y'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "") : '';
               if ($this->NM_graf_left)
               {
                   $nm_saida->saida("  <td" . $s_style . " class=\"" . $s_class_v . $s_class_fix_fld . $s_class_fix_fld_idx . $css . "\"" . $colspan . "" . $rowspan . ">" . $chart . "" . $s_text . "</td>\r\n");
               }
               else
               {
                   $nm_saida->saida("  <td" . $s_style . " class=\"" . $s_class_v . $s_class_fix_fld . $s_class_fix_fld_idx . $css . "\"" . $colspan . "" . $rowspan . ">" . $s_text . "" . $chart . "</td>\r\n");
               }
           }
           $nm_saida->saida(" </tr>\r\n");
           if ('scGridSummaryLineOdd' == $s_class)
           {
               $s_class                   = 'scGridSummaryLineEven';
               $this->Ini->cor_link_dados = 'scGridFieldEvenLink';
           }
           else
           {
               $s_class                   = 'scGridSummaryLineOdd';
               $this->Ini->cor_link_dados = 'scGridFieldOddLink';
           }
       }

       $nm_saida->saida("</table>\r\n");
       $nm_saida->saida("</td>\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['ajax_nav'])
       { 
           $nm_saida->saida("<script>\r\n");
           $nm_saida->saida("if (typeof ratingBreakdownDisplay == \"function\") {\r\n");
           $nm_saida->saida("    setTimeout(function() { ratingBreakdownDisplay() }, 500);\r\n");
           $nm_saida->saida("}\r\n");
           $nm_saida->saida("</script>\r\n");
           if ($this->proc_res_grid)
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_res_grid', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
           } 
           else 
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'summary_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
           } 
           $_SESSION['scriptcase']['saida_html'] = "";
       } 
       $nm_saida->saida("</tr>\r\n");
   }

   function drawMatrixLabels()
   {
       global $nm_saida;

       $this->prim_linha = true;

       $nm_saida->saida("    <script type=\"text/javascript\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida'])
       { 
           $nm_saida->saida("        function sc_session_redir(url_redir)\r\n");
           $nm_saida->saida("        {\r\n");
           $nm_saida->saida("            if (typeof(sc_session_redir_mobile) === typeof(function(){})) { sc_session_redir_mobile(url_redir); }\r\n");
           $nm_saida->saida("            if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')\r\n");
           $nm_saida->saida("            {\r\n");
           $nm_saida->saida("                window.parent.sc_session_redir(url_redir);\r\n");
           $nm_saida->saida("            }\r\n");
           $nm_saida->saida("            else\r\n");
           $nm_saida->saida("            {\r\n");
           $nm_saida->saida("                if (window.opener && typeof window.opener.sc_session_redir === 'function')\r\n");
           $nm_saida->saida("                {\r\n");
           $nm_saida->saida("                    window.close();\r\n");
           $nm_saida->saida("                    window.opener.sc_session_redir(url_redir);\r\n");
           $nm_saida->saida("                }\r\n");
           $nm_saida->saida("                else\r\n");
           $nm_saida->saida("                {\r\n");
           $nm_saida->saida("                    window.location = url_redir;\r\n");
           $nm_saida->saida("                }\r\n");
           $nm_saida->saida("            }\r\n");
           $nm_saida->saida("        }\r\n");
       }
       $nm_saida->saida("        $(function() {\r\n");
       $nm_saida->saida("            $(\".sc-ui-sort\").mouseover(function() {\r\n");
       $nm_saida->saida("                $(this).css(\"cursor\", \"pointer\");\r\n");
       $nm_saida->saida("            }).click(function() {\r\n");
       $nm_saida->saida("                var newOrder, colOrder;\r\n");
       $nm_saida->saida("                if ($(this).hasClass(\"sc-ui-sort-desc\")) {\r\n");
       $nm_saida->saida("                    $(this).removeClass(\"sc-ui-sort-desc\").addClass(\"sc-ui-sort-asc\");\r\n");
       $nm_saida->saida("                    newOrder = \"asc\";\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                else {\r\n");
       $nm_saida->saida("                    $(this).removeClass(\"sc-ui-sort-asc\").addClass(\"sc-ui-sort-desc\");\r\n");
       $nm_saida->saida("                    newOrder = \"desc\";\r\n");
       $nm_saida->saida("                }\r\n");
       $nm_saida->saida("                colOrder = $(this).attr(\"id\").substr(11);\r\n");
       $nm_saida->saida("                changeSort(colOrder, newOrder, false);\r\n");
       $nm_saida->saida("            });\r\n");
       $nm_saida->saida("        });\r\n");
       $nm_saida->saida("    </script>\r\n");
if($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf_vert']) { 
           $nm_saida->saida("   <thead>\r\n");
       $this->monta_cabecalho();
 }

       $apl_cab_resumo = $this->Ini->Nm_lang['lang_othr_smry_msge'];

       $b_display     = false;
       $b_display_seq = false;
       foreach ($this->build_labels as $lines)
       {
           $nm_saida->saida(" <tr class=\"sc-ui-summary-header-row\">\r\n");
           if ($this->comp_tab_seq && !$b_display_seq) {
               $nm_saida->saida("  <td class=\"scGridSummaryLabel sc-col-title sc-col-op sc-col-op-seq\" rowspan=\"" . sizeof($this->build_labels) . "\">&nbsp;</td>\r\n");
               $b_display_seq = true;
           }

           if (!$b_display)
           {
               if ($this->comp_tabular)
               {
                   $fixedColumnCount = 0;
                   foreach ($this->comp_y_axys as $iYAxysIndex)
                   {
                       $hasOrder = !isset($this->comp_order_enabled[$iYAxysIndex]) || $this->comp_order_enabled[$iYAxysIndex];
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf_vert']) {
                           $hasOrder = false;
                       }
                       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_start'][$iYAxysIndex]))
                       {
                           $sInitialOrder   = '';
                           $sInitialOrderFA = '';
                           $sInitialDisplay = '; display: none';
                           $sInitialSrc     = '';
                       }
                       elseif ('asc' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['pivot_order_start'][$iYAxysIndex])
                       {
                           $sInitialOrder   = ' sc-ui-sort-asc';
                           $sInitialOrderFA = 'asc';
                           $sInitialDisplay = '';
                           $sInitialSrc     = $this->Ini->Label_summary_sort_asc;
                       }
                       else
                       {
                           $sInitialOrder   = ' sc-ui-sort-desc';
                           $sInitialOrderFA = 'desc';
                           $sInitialDisplay = '';
                           $sInitialSrc     = $this->Ini->Label_summary_sort_desc;
                       }
                       $nm_saida->saida("  <td class=\"scGridSummaryLabel sc-col-title sc-col-fld sc-col-fld-{$fixedColumnCount}\" rowspan=\"" . sizeof($this->build_labels) . "\">\r\n");
                       if ($hasOrder) {
                           $nm_saida->saida("    <span class=\"sc-ui-sort" . $sInitialOrder . "\" id=\"sc-id-sort-" . $iYAxysIndex . "\">\r\n");
                       }
                       $nm_saida->saida("   " . $this->comp_field[$iYAxysIndex] . "\r\n");
                       if ($hasOrder) {
                           $faOrderIcon = $this->scGetFontawesomeOrderIcon($sInitialOrderFA, $iYAxysIndex);
                               $nm_saida->saida("     " . $faOrderIcon . "\r\n");
                           $nm_saida->saida("    </span>\r\n");
                       }
                       $nm_saida->saida("  </td>\r\n");
                       $fixedColumnCount++;
                   }
               }
               else
               {
                   $nm_saida->saida("  <td class=\"scGridSummaryLabel sc-col-title sc-col-fld sc-col-fld-0\" rowspan=\"" . sizeof($this->build_labels) . "\">\r\n");
                       if (0 < $this->comp_order_col)
                       {
                       $nm_saida->saida("    <a href=\"javascript: changeSort('0', '0', true)\" class=\"scGridLabelLink \">\r\n");
                       }
                   $nm_saida->saida("   " . $apl_cab_resumo . "\r\n");
                       if (0 < $this->comp_order_col)
                       {
                           if (!$this->Ini->Export_html_zip) {
                           $nm_saida->saida("    <IMG style=\"vertical-align: middle\" SRC=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_summary_sort_asc . "\" BORDER=\"0\"/>\r\n");
                       }
                       else {
                           $nm_saida->saida("    <IMG style=\"vertical-align: middle\" SRC=\"" . $this->Ini->Label_summary_sort_asc . "\" BORDER=\"0\"/>\r\n");
                       }
                       $nm_saida->saida("    </a>\r\n");
                       }
               $nm_saida->saida("  </td>\r\n");
               }
               $b_display = true;
           }
           foreach ($lines as $columns) {
               $tdStyleTags = array();
               $this->NM_graf_left = $this->Graf_left_dat;
               if (isset($columns['group']) && $columns['group'] == -1) {
                   $this->NM_graf_left = $this->Graf_left_tot;
               }
               if ('' == $columns['function'] && '' != $this->comp_align[ $columns['group'] ]) {
                   $tdStyleTags[] = 'text-align: ' . $this->comp_align[ $columns['group'] ];
               }
               $css       = ('' != $columns['css']) ? ' ' . $columns['css'] . '_label' : '';
               $colspan   = (isset($columns['colspan']) && 1 < $columns['colspan']) ? ' colspan="' . $columns['colspan'] . '"' : '';
               $rowspan   = (isset($columns['rowspan']) && 1 < $columns['rowspan']) ? ' rowspan="' . $columns['rowspan'] . '"' : '';
               $chart     = (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "print" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida']) && isset($columns['chart']) && '' != $columns['chart'] && isset($this->comp_chart_data[ $columns['chart'] ]))
                          ? nmButtonOutput($this->arr_buttons, "bgraf", "nm_graf_submit_2('" . $columns['chart'] . "')", "nm_graf_submit_2('" . $columns['chart'] . "')", "", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->comp_chart_data[ $columns['chart'] ]['label_x'] . " X " . $this->comp_chart_data[ $columns['chart'] ]['label_y'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "") : '';
               $col_label = $this->getColumnLabel($columns['label'], $columns['params'][0], $css, $chart, $tdStyleTags, $this->NM_graf_left);
               $tdStyle   = empty($tdStyleTags) ? '' : ' style="' . implode(';', $tdStyleTags) . '"';
                   $nm_saida->saida("  <td class=\"scGridSummaryLabel" . $css . "\"" . $colspan . "" . $rowspan . "><span class='scGridSummaryLabelContainerSpan' " . $tdStyle . ">" . $col_label . "</span></td>\r\n");
           }
           $nm_saida->saida(" </tr>\r\n");
       }
if($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf_vert']){ 
           $nm_saida->saida("   </thead>\r\n");
 }
   }

   function getColumnLabel($label, $col, $css, $chartValue, &$tdStyleTags, $chartLeft, $labelLeft = true)
   {
       $tdStyleTags[] = 'display: flex';
       $tdStyleTags[] = 'flex-direction: row';
       $tdStyleTags[] = 'align-items: center';
       if (0 != sizeof($this->comp_x_axys)) {
           $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
           return $chartLeft ? $chartValue . $label : $label . $chartValue;
       }

       if (1 == $col) {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf_vert']) {
               return nl2br($label);
           }
           $sortIconValue = $this->Ini->Label_summary_sort;
           $spanLabelAlign = '; justify-content: flex-end;';
           $sortOrder = 'a';
           if (isset($this->comp_order_col) && $this->comp_order_col == $col + 1) {
               if ($this->comp_order_sort == 'd') {
                   $sortIconValue = $this->Ini->Label_summary_sort_desc;
                   $sInitialOrderFA = 'desc';
                   $sortOrder = '';
               } else {
                   $sortIconValue = $this->Ini->Label_summary_sort_asc;
                   $sInitialOrderFA = 'asc';
                   $sortOrder = 'd';
               }
           }
           $linkIni = "<a href=\"javascript: changeSort(" . ($col + 1) . ", '" . $sortOrder . "', true)\" class=\"scGridLabelLink" . $css . "\">";
           $linkEnd = "</a>";
           $labelValue = nl2br($label);
           $labelLink = $linkIni . $labelValue . $linkEnd;
           $labelChart = $chartLeft ? $chartValue . $labelLink : $labelLink . $chartValue;
           $sortIconLink = $linkIni . $this->scGetFontawesomeOrderIcon($sInitialOrderFA, '__SC_METRIC_FIELD__') . $linkEnd;
           if (empty($this->Ini->Label_summary_sort_pos) || $this->Ini->Label_summary_sort_pos == "right") {
               $this->Ini->Label_summary_sort_pos = "right_field";
           }
           if (empty($sortIconValue)) {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return $labelChart;
           } elseif ($this->Ini->Label_summary_sort_pos == "right_field") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . $sortIconLink . '</span>';
           } elseif ($this->Ini->Label_summary_sort_pos == "left_field") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $sortIconLink . $labelChart . '</span>';
           } elseif ($this->Ini->Label_summary_sort_pos == "right_cell") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: space-between' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . '</span>' . $sortIconLink;
           } elseif ($this->Ini->Label_summary_sort_pos == "left_cell") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: space-between';
               return $sortIconLink . '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . '</span>';
           }
       }

       if (2 == $col) {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf_vert']) {
               return nl2br($label);
           }
           $sortIconValue = $this->Ini->Label_summary_sort;
           $spanLabelAlign = '; justify-content: flex-end;';
           $sortOrder = 'a';
           if (isset($this->comp_order_col) && $this->comp_order_col == $col + 1) {
               if ($this->comp_order_sort == 'd') {
                   $sortIconValue = $this->Ini->Label_summary_sort_desc;
                   $sInitialOrderFA = 'desc';
                   $sortOrder = '';
               } else {
                   $sortIconValue = $this->Ini->Label_summary_sort_asc;
                   $sInitialOrderFA = 'asc';
                   $sortOrder = 'd';
               }
           }
           $linkIni = "<a href=\"javascript: changeSort(" . ($col + 1) . ", '" . $sortOrder . "', true)\" class=\"scGridLabelLink" . $css . "\">";
           $linkEnd = "</a>";
           $labelValue = nl2br($label);
           $labelLink = $linkIni . $labelValue . $linkEnd;
           $labelChart = $chartLeft ? $chartValue . $labelLink : $labelLink . $chartValue;
           $sortIconLink = $linkIni . $this->scGetFontawesomeOrderIcon($sInitialOrderFA, '__SC_METRIC_FIELD__') . $linkEnd;
           if (empty($this->Ini->Label_summary_sort_pos) || $this->Ini->Label_summary_sort_pos == "right") {
               $this->Ini->Label_summary_sort_pos = "right_field";
           }
           if (empty($sortIconValue)) {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return $labelChart;
           } elseif ($this->Ini->Label_summary_sort_pos == "right_field") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . $sortIconLink . '</span>';
           } elseif ($this->Ini->Label_summary_sort_pos == "left_field") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $sortIconLink . $labelChart . '</span>';
           } elseif ($this->Ini->Label_summary_sort_pos == "right_cell") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: space-between' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . '</span>' . $sortIconLink;
           } elseif ($this->Ini->Label_summary_sort_pos == "left_cell") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: space-between';
               return $sortIconLink . '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . '</span>';
           }
       }

       if (3 == $col) {
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf_vert']) {
               return nl2br($label);
           }
           $sortIconValue = $this->Ini->Label_summary_sort;
           $spanLabelAlign = '; justify-content: flex-end;';
           $sortOrder = 'a';
           if (isset($this->comp_order_col) && $this->comp_order_col == $col + 1) {
               if ($this->comp_order_sort == 'd') {
                   $sortIconValue = $this->Ini->Label_summary_sort_desc;
                   $sInitialOrderFA = 'desc';
                   $sortOrder = '';
               } else {
                   $sortIconValue = $this->Ini->Label_summary_sort_asc;
                   $sInitialOrderFA = 'asc';
                   $sortOrder = 'd';
               }
           }
           $linkIni = "<a href=\"javascript: changeSort(" . ($col + 1) . ", '" . $sortOrder . "', true)\" class=\"scGridLabelLink" . $css . "\">";
           $linkEnd = "</a>";
           $labelValue = nl2br($label);
           $labelLink = $linkIni . $labelValue . $linkEnd;
           $labelChart = $chartLeft ? $chartValue . $labelLink : $labelLink . $chartValue;
           $sortIconLink = $linkIni . $this->scGetFontawesomeOrderIcon($sInitialOrderFA, '__SC_METRIC_FIELD__') . $linkEnd;
           if (empty($this->Ini->Label_summary_sort_pos) || $this->Ini->Label_summary_sort_pos == "right") {
               $this->Ini->Label_summary_sort_pos = "right_field";
           }
           if (empty($sortIconValue)) {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return $labelChart;
           } elseif ($this->Ini->Label_summary_sort_pos == "right_field") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . $sortIconLink . '</span>';
           } elseif ($this->Ini->Label_summary_sort_pos == "left_field") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $sortIconLink . $labelChart . '</span>';
           } elseif ($this->Ini->Label_summary_sort_pos == "right_cell") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: space-between' : 'justify-content: right';
               return '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . '</span>' . $sortIconLink;
           } elseif ($this->Ini->Label_summary_sort_pos == "left_cell") {
               $tdStyleTags[] = $labelLeft ? 'justify-content: left' : 'justify-content: space-between';
               return $sortIconLink . '<span style="flex-grow: 1' . $spanLabelAlign . '">' . $labelChart . '</span>';
           }
       }

       $spanLabelAlign = $labelLeft ? 'justify-content: left' : 'justify-content: right';
       if (1 == $col) {
           $spanLabelAlign = 'justify-content: flex-end';
       }
       if (2 == $col) {
           $spanLabelAlign = 'justify-content: flex-end';
       }
       if (3 == $col) {
           $spanLabelAlign = 'justify-content: flex-end';
       }
       $tdStyleTags[] = $spanLabelAlign;
       return $chartLeft ? $chartValue . $label : $label . $chartValue;
   }

   public static function formatValue($total, $valor_campo)
   {
       $isNegative = 0 > $valor_campo;
       if ($total == 1)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']);
       }
       if ($total == 2)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "2", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']);
       }
       if ($total == 3)
       {
           nmgp_Form_Num_Val($valor_campo, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "12", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']);
       }
       return $valor_campo;
   }

    function scGetFontawesomeOrderIcon($sortRule, $fieldName)
    {
        if ($this->scIsFieldNumeric($fieldName)) {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-numeric-down" : "fas fa-sort-numeric-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down-alt sc-summary-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down sc-summary-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-summary-order-icon sc-summary-order-icon-unused\"></span>";
            }
        } else {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-alpha-down" : "fas fa-sort-alpha-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down-alt sc-summary-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down sc-summary-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-summary-order-icon sc-summary-order-icon-unused\"></span>";
            }
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        if (isset($this->comp_order_datatype[$fieldName])) {
            if (!in_array($this->comp_order_datatype[$fieldName], array('integer', 'numeric'))) {
                return false;
            }
        }
        return true;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        if (isset($this->comp_order_start[$fieldName])) {
            return false;
        }
        return 'asc';
    }
   //---- 
   function resumo_init()
   {
      $this->arr_buttons['group_group_1']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'type'             => "button",
          'display'          => "text_fontawesomeicon",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__export.png",
          'fontawesomeicon'  => "fas fa-download",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_1']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'type'             => "button",
          'display'          => "text_fontawesomeicon",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__export.png",
          'fontawesomeicon'  => "fas fa-download",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      if ($this->NM_export)
      {
          return;
      }
      if ("out" == $this->NM_tipo)
      {
         $this->monta_html_ini();
         $this->monta_cabecalho();
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
         {
             $this->monta_barra_top();
             $this->monta_embbed_placeholder_top();
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
         {
             $this->monta_barra_top();
             $this->monta_embbed_placeholder_mobile_top();
         }
      }
      elseif ($this->Print_All)
      {
          $this->monta_cabecalho();
      }
   }

   function monta_css()
   {
      global $nm_saida, $nmgp_tipo_pdf, $nmgp_cor_print;
       $compl_css = "";
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida'])
       {
           include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida'])
       {
          if (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] == "print" && strtoupper($nmgp_cor_print) == "PB") || $nmgp_tipo_pdf == "pb")
           { 
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['grid_income_offday_ot']))
               {
                   $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']['grid_income_offday_ot']) . "_";
               } 
           } 
           else 
           { 
               if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['grid_income_offday_ot']))
               {
                   $compl_css = str_replace(".", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']['grid_income_offday_ot']) . "_";
               } 
           }
       }
       $temp_css  = explode("/", $compl_css);
       if (isset($temp_css[1])) { $compl_css = $temp_css[1];}
       $this->css_scGridPage          = $compl_css . "scGridPage";
       $this->css_scGridToolbar       = $compl_css . "scGridToolbar";
       $this->css_scGridToolbarPadd   = $compl_css . "scGridToolbarPadding";
       $this->css_css_toolbar_obj     = $compl_css . "css_toolbar_obj";
       $this->css_scGridHeader        = $compl_css . "scGridHeader";
       $this->css_scGridHeaderFont    = $compl_css . "scGridHeaderFont";
       $this->css_scGridFooter        = $compl_css . "scGridFooter";
       $this->css_scGridFooterFont    = $compl_css . "scGridFooterFont";
       $this->css_scGridTotal         = $compl_css . "scGridTotal";
       $this->css_scGridTotalFont     = $compl_css . "scGridTotalFont";
       $this->css_scGridFieldEven     = $compl_css . "scGridFieldEven";
       $this->css_scGridFieldEvenFont = $compl_css . "scGridFieldEvenFont";
       $this->css_scGridFieldEvenVert = $compl_css . "scGridFieldEvenVert";
       $this->css_scGridFieldEvenLink = $compl_css . "scGridFieldEvenLink";
       $this->css_scGridFieldOdd      = $compl_css . "scGridFieldOdd";
       $this->css_scGridFieldOddFont  = $compl_css . "scGridFieldOddFont";
       $this->css_scGridFieldOddVert  = $compl_css . "scGridFieldOddVert";
       $this->css_scGridFieldOddLink  = $compl_css . "scGridFieldOddLink";
       $this->css_scGridLabel         = $compl_css . "scGridLabel";
       $this->css_scGridLabelFont     = $compl_css . "scGridLabelFont";
       $this->css_scGridLabelLink     = $compl_css . "scGridLabelLink";
       $this->css_scGridTabela        = $compl_css . "scGridTabela";
       $this->css_scGridTabelaTd      = $compl_css . "scGridTabelaTd";
       $this->css_scAppDivMoldura     = $compl_css . "scAppDivMoldura";
       $this->css_scAppDivHeader      = $compl_css . "scAppDivHeader";
       $this->css_scAppDivHeaderText  = $compl_css . "scAppDivHeaderText";
       $this->css_scAppDivContent     = $compl_css . "scAppDivContent";
       $this->css_scAppDivContentText = $compl_css . "scAppDivContentText";
       $this->css_scAppDivToolbar     = $compl_css . "scAppDivToolbar";
       $this->css_scAppDivToolbarInput= $compl_css . "scAppDivToolbarInput";
   }

   function resumo_sem_reg()
   {
      global $nm_saida;
      $res_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
      $nm_saida->saida("  <script>let scSummaryNoRecords = true;</script>\r\n");
      $nm_saida->saida("  <TR id=\"summary_body\">\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("   <TD class=\"scGridFieldOdd scGridFieldOddFont\" align=\"center\" style=\"vertical-align: top;font-size:12px;\">\r\n");
      $nm_saida->saida("     " . $res_sem_reg . "\r\n");
      $nm_saida->saida("     <script>\r\n");
      $nm_saida->saida("         scChartIsEmpty = true;\r\n");
      $nm_saida->saida("     </script>\r\n");
      $nm_saida->saida("   </TD>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['ajax_nav'])
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'summary_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("  </TR>\r\n");
   }

   function resumo_sem_reg_chart()
   {
      global $nm_saida;
      $res_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
      $displayMessage = $this->NM_res_sem_reg ? '' : ' style="display: none"';
      $nm_saida->saida("  <TR id=\"rec_not_found_chart\"" . $displayMessage . ">\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("   <TD class=\"scGridFieldOdd scGridFieldOddFont\" align=\"center\" style=\"vertical-align: top;font-size:12px;\">\r\n");
      $nm_saida->saida("     " . $res_sem_reg . "\r\n");
      $nm_saida->saida("   </TD>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['ajax_nav'])
      { 
         if ($this->NM_res_sem_reg)
         {
              $this->Ini->Arr_result['setDisplay'][] = array('field' => 'rec_not_found_chart', 'value' => '');
              $this->Ini->Arr_result['setVisibility'][] = array('field' => 'res_chart_table', 'value' => 'hidden');
         }
         else
         {
              $this->Ini->Arr_result['setDisplay'][] = array('field' => 'rec_not_found_chart', 'value' => 'none');
              $this->Ini->Arr_result['setDisplay'][] = array('field' => 'res_chart_table', 'value' => '');
              $this->Ini->Arr_result['setVisibility'][] = array('field' => 'res_chart_table', 'value' => 'visible');
         }
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("  </TR>\r\n");
   }

   //---- 
   function resumo_final()
   {
       global $nm_saida;
      if ($this->NM_export)
      {
          return;
      }
      if ("out" == $this->NM_tipo)
      {
          $this->monta_html_fim();
      }
   }

   //---- 
   function inicializa_vars()
   {
      $this->Tot_ger = false;
      if ("out" == $this->NM_tipo)
      {
          require_once($this->Ini->path_aplicacao . "grid_income_offday_ot_total.class.php"); 
      }
      $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['print_all'];
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['doc_word'] || $this->Ini->sc_export_ajax_img)
      { 
          $this->NM_raiz_img = $this->Ini->root; 
      } 
      else 
      { 
          $this->NM_raiz_img = ""; 
      } 
      if ($this->Print_All)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] = "print";
          $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_res_prt; 
      }
      else
      {
          $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_res; 
      }
      $this->Total   = new grid_income_offday_ot_total($this->Ini->sc_page);
      $this->prep_modulos("Total");
      if ($this->NM_export)
      {
          return;
      }
      $this->monta_css();
      $this->que_linha = "impar";
      $this->css_line_back = $this->css_scGridFieldOdd;
      $this->css_line_fonf = $this->css_scGridFieldOddFont;
      $this->Ini->cor_link_dados = $this->css_scGridFieldOddLink;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['LigR_Md5'] = array();
   }

   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   //---- 
   function totaliza($tipo='')
   {
      $this->Tem_Res_Compara = false;
      $save_where_pesq = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq'];
      $where_compara   = "";
      $this->Total->Calc_resumo_sc_free_group_by("res", $this->NM_export, 1, $tipo);
      if ((isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_compara'])    && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_compara'])) 
       || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_dyn_compara'])     && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_dyn_compara'])) )
       {
          $tmp_cmd = "";
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_orig'])) {
              $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_orig']; 
          }
          if  (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_compara']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_compara'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_compara'] . ")"; 
              }
              else {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_compara'] . ")"; 
              }
          }
          elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_filtro'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_filtro'] . ")"; 
              }
              else {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_filtro'] . ")"; 
              }
          }
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_fast'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_fast'] . ")";
              }
              else {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_fast'] . ")";
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_resumo_search_2']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_resumo_search_2'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_resumo_search_2'] . ")"; 
              }
              else {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_resumo_search_2'] . ")"; 
               }
          }
          elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_resumo_search']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_resumo_search'])) {
              if (!empty($tmp_cmd)) {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_resumo_search'] . ")"; 
              }
              else {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_resumo_search'] . ")"; 
               }
          }
          $where_compara = $tmp_cmd;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq'] = $tmp_cmd;
          $this->Total->Calc_resumo_sc_free_group_by("res", $this->NM_export, 2, $tipo);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq'] = $save_where_pesq;
          $this->Tem_Res_Compara = true;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['res_compara'] = $this->Tem_Res_Compara;
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['arr_total'] as $cmp_gb => $resto)
      {
          $Arr_tot_name = "array_total_" . $cmp_gb;
          $this->$Arr_tot_name = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['arr_total'][$cmp_gb];
      }
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $Arr_tot_name = "array_total_" . $cmp_gb;
          if (is_array($this->$Arr_tot_name)) {
              ksort($this->$Arr_tot_name);
          }
      }
      $this->NM_res_sem_reg = true;
      $Sv_tot_ger  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral'];
      $Sv_flag_tot = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['contr_total_geral'];
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['contr_total_geral'] = "N";
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Ind_Groupby'];
      $tp_tot = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['Res_search_metric_use']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['Res_search_metric_use'])) ? true : false;
      $this->Total->$Gb_geral($tp_tot, $this->NM_export);
      $this->array_total_geral = array();
      $this->array_total_geral[1][0] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral'][2];
      $this->array_total_geral[1][1] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral'][3];
      $this->array_total_geral[1][2] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral'][4];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral'][1]) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral'][1] > 0) {
          $this->NM_res_sem_reg = false;
      }
      if ($this->Tem_Res_Compara) {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq'] = $where_compara;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['contr_total_geral'] = "N";
          $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Ind_Groupby'];
          $tp_tot = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['Res_search_metric_use']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['Res_search_metric_use'])) ? true : false;
          $this->Total->$Gb_geral($tp_tot, $this->NM_export);
          $this->array_total_geral[2][0] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral'][2];
          $this->array_total_geral[2][1] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral'][3];
          $this->array_total_geral[2][2] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral'][4];
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral'][1]) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral'][1] > 0) {
              $this->NM_res_sem_reg = false;
          }
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral_res']     = $this->array_total_geral;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['tot_geral']         = $Sv_tot_ger;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['contr_total_geral'] = $Sv_flag_tot;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['res_sem_reg']       = $this->NM_res_sem_reg;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq']        = $save_where_pesq;
      if ("out" == $this->NM_tipo)
      {
          $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Ind_Groupby'];
          $this->Total->$Gb_geral(false, $this->NM_export);
      }
   }

   //----- 
   function monta_html_ini($first_table = true)
   {
      global $nm_saida, $nmgp_tipo_pdf, $nmgp_cor_print;

      if ($first_table)
      {

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida'])
      { 
          $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px; width: 100%;\">\r\n");
          return;
      } 
       header("X-XSS-Protection: 1; mode=block");
       header("X-Frame-Options: SAMEORIGIN");
if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['doc_word'])
{
       $nm_saida->saida("<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:word\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
}
if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['responsive_chart']['active']) {
$nm_saida->saida("<!DOCTYPE html>\r\n");
}
$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_refresh_after_chart'] = 'resumo';
      $nm_saida->saida("<HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
      $nm_saida->saida("<HEAD>\r\n");
      $nm_saida->saida(" <TITLE>INCOME OFFDAY OT</TITLE>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['doc_word'])
{
      $nm_saida->saida(" <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Last-Modified\" content=\"" . gmdate('D, d M Y H:i:s') . " GMT\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
      $nm_saida->saida(" <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
}
      $nm_saida->saida(" <link rel=\"shortcut icon\" href=\"../_lib/img/sys__NM__ico__NM__favicon (2).ico\">\r\n");
       $css_body = "";
      $nm_saida->saida(" <style type=\"text/css\">\r\n");
      $nm_saida->saida("  BODY { " . $css_body . " }\r\n");
      $nm_saida->saida(" </style>\r\n");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['doc_word'])
      { 
           $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form.css\" /> \r\n");
           $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var applicationKeys = '';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+q';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'ctrl+s';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'ctrl+f';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+p';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+w';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+x';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+m';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+c';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+r';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'ctrl+p';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+p';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+w';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+x';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+m';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+c';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+shift+r';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'alt+enter';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'f1';\r\n");
           $nm_saida->saida("     applicationKeys += ',';\r\n");
           $nm_saida->saida("     applicationKeys += 'ctrl+g';\r\n");
           $nm_saida->saida("     var hotkeyList = '';\r\n");
           $nm_saida->saida("     function execHotKey(e, h) {\r\n");
           $nm_saida->saida("         var hotkey_fired = false\r\n");
           $nm_saida->saida("         switch (true) {\r\n");
           $nm_saida->saida("             case (['alt+q'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_sai');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['ctrl+s'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_savegrid');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['ctrl+f'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_fil');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+p'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_pdf');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+w'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_word');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+x'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_xls');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+m'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_xml');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+c'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_csv');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+r'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_rtf');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['ctrl+p'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_imp');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+p'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_pdf');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+w'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_word');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+x'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_xls');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+m'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_xml');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+c'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_csv');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+shift+r'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_email_rtf');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['alt+enter'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_cons');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['f1'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_webh');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("             case (['ctrl+g'].indexOf(h.key) > -1):\r\n");
           $nm_saida->saida("                 hotkey_fired = process_hotkeys('sys_format_gbrl');\r\n");
           $nm_saida->saida("                 break;\r\n");
           $nm_saida->saida("         }\r\n");
           $nm_saida->saida("         if (hotkey_fired) {\r\n");
           $nm_saida->saida("             e.preventDefault();\r\n");
           $nm_saida->saida("             return false;\r\n");
           $nm_saida->saida("         } else {\r\n");
           $nm_saida->saida("             return true;\r\n");
           $nm_saida->saida("         }\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/hotkeys.inc.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/hotkeys_setup.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery-ui.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/scInput.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput2.js\"></script>\r\n");
           $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/font-awesome/6/css/all.min.css\" type=\"text/css\" media=\"screen,print\" />\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
           $nm_saida->saida(" <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/select2/css/select2.min.css\" type=\"text/css\" />\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/select2/js/select2.full.min.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"grid_income_offday_ot_ajax.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("   var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("   var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("   var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("   var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida(" </script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"grid_income_offday_ot_jquery_8551.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"grid_income_offday_ot_message.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/scInput.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery.scInput2.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/bluebird.min.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/nm_position.js\"></script>\r\n");
           $nm_saida->saida("        <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("          var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';\r\n");
           $nm_saida->saida("          var sc_tbLangClose = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida("          var sc_tbLangEsc = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida("        </script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
           $nm_saida->saida(" <script type=\"text/javascript\" src=\"../_lib/lib/js/nm_position.js\"></script>\r\n");
           $summaryOrderUnusedVisivility = $_SESSION['scriptcase']['proc_mobile'] ? 'visible' : 'hidden';
           $summaryOrderUnusedOpacity = $_SESSION['scriptcase']['proc_mobile'] ? '0.5' : '1';
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        .sc-summary-order-icon-unused {\r\n");
$nm_saida->saida("            visibility: " . $summaryOrderUnusedVisivility . ";\r\n");
$nm_saida->saida("            opacity: 0.5;\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridSummaryLabel:hover .sc-summary-order-icon-unused {\r\n");
$nm_saida->saida("            visibility: visible;\r\n");
$nm_saida->saida("            opacity: " . $summaryOrderUnusedOpacity . ";\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("    </style>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid.css\"  type=\"text/css\"/> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"  type=\"text/css\"/> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_filter.css\" /> \r\n");
           if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
           { 
               $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->str_google_fonts . "\"  type=\"text/css\"/> \r\n");
           } 
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['num_css']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['num_css'] = rand(0, 1000);
      }
      $NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_income_offday_ot_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['num_css'] . '.css', 'w');
      if (($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] == "print" && strtoupper($nmgp_cor_print) == "PB") || $nmgp_tipo_pdf == "pb")
      {
          $NM_css_file = $this->Ini->str_schema_all . "_grid_bw.css";
          $NM_css_dir  = $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      }
      else
      {
          $NM_css_file = $this->Ini->str_schema_all . "_grid.css";
          $NM_css_dir  = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      }
      if (is_file($this->Ini->path_css . $NM_css_file))
      {
          $NM_css_attr = file($this->Ini->path_css . $NM_css_file);
          foreach ($NM_css_attr as $NM_line_css)
          {
              $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
              @fwrite($NM_css, "    " .  $NM_line_css . "\r\n");
          }
      }
      if (is_file($this->Ini->path_css . $NM_css_dir))
      {
          $NM_css_attr = file($this->Ini->path_css . $NM_css_dir);
          foreach ($NM_css_attr as $NM_line_css)
          {
              $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
              @fwrite($NM_css, "    " .  $NM_line_css . "\r\n");
          }
      }
      @fclose($NM_css);
     $this->Ini->summary_css = $this->Ini->path_imag_temp . '/sc_css_grid_income_offday_ot_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['num_css'] . '.css';
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] == "print")
     {
         $nm_saida->saida("  <style type=\"text/css\">\r\n");
         $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_income_offday_ot_sum_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['num_css'] . '.css');
         foreach ($NM_css as $cada_css)
         {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
         }
         $nm_saida->saida("  </style>\r\n");
     }
     else
     {
         $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->summary_css . "\" type=\"text/css\" media=\"screen\" />\r\n");
     }
     $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_res_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) . ".css\" />\r\n");
     $nm_saida->saida(" <style type=\"text/css\">\r\n");
     if (!$this->Ini->Export_html_zip)     {
           $nm_saida->saida(" .scGridSummaryLabel a img[src\$='" . $this->Ini->Label_sort_desc . "'], \r\n");
           $nm_saida->saida(" .scGridSummaryLabel a img[src\$='" . $this->Ini->Label_sort_asc . "'], \r\n");
           $nm_saida->saida(" .scGridSummaryLabel a img[src\$='" . $this->arr_buttons['bgraf']['image'] . "']{opacity:1!important;} \r\n");
           $nm_saida->saida(" .scGridSummaryLabel a img{opacity:0;transition:all .2s;} \r\n");
           $nm_saida->saida(" .scGridSummaryLabel:HOVER a img{opacity:1;transition:all .2s;} \r\n");
           $nm_saida->saida(" .scGridSummaryLabel span > img[src\$='" . $this->Ini->Label_sort_desc . "'], \r\n");
           $nm_saida->saida(" .scGridSummaryLabel span > img[src\$='" . $this->Ini->Label_sort_asc . "']{opacity:1!important;} \r\n");
           $nm_saida->saida(" .scGridSummaryLabel span > img{opacity:0;transition:all .2s;} \r\n");
           $nm_saida->saida(" .scGridSummaryLabel:HOVER span > img{opacity:1;transition:all .2s;} \r\n");
     }
      $nm_saida->saida(" .scGridTabela TD { white-space: nowrap }\r\n");
      $nm_saida->saida(" </style>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           $nm_saida->saida("   var scBtnGrpStatus = {};\r\n");
           $nm_saida->saida("   \$(function(){ \r\n");
           $nm_saida->saida("     $(\".scBtnGrpText\").mouseover(function() { $(this).addClass(\"scBtnGrpTextOver\"); }).mouseout(function() { $(this).removeClass(\"scBtnGrpTextOver\"); });\r\n");
           $nm_saida->saida("     $(\".scBtnGrpClick\").mouseup(function(event){\r\n");
           $nm_saida->saida("          event.preventDefault();\r\n");
           $nm_saida->saida("          if(event.target !== event.currentTarget) return;\r\n");
           $nm_saida->saida("          if($(this).find(\"a\").prop('href') != '')\r\n");
           $nm_saida->saida("          {\r\n");
           $nm_saida->saida("              $(this).find(\"a\").click();\r\n");
           $nm_saida->saida("          }\r\n");
           $nm_saida->saida("          else\r\n");
           $nm_saida->saida("          {\r\n");
           $nm_saida->saida("              eval($(this).find(\"a\").prop('onclick'));\r\n");
           $nm_saida->saida("          }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }); \r\n");
           $nm_saida->saida("   function scBtnGrpShow(sGroup) {\r\n");
           $nm_saida->saida("     if (typeof(scBtnGrpShowMobile) === typeof(function(){})) { return scBtnGrpShowMobile(sGroup); };\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).addClass('selected');\r\n");
           $nm_saida->saida("     var btnPos = $('#sc_btgp_btn_' + sGroup).offset();\r\n");
           $nm_saida->saida("     scBtnGrpStatus[sGroup] = 'open';\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).mouseout(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = '';\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("       }, 1000);\r\n");
           $nm_saida->saida("     }).mouseover(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'over';\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup + ' span a').click(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup).css({\r\n");
           $nm_saida->saida("       'left': btnPos.left\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseover(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'over';\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseleave(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("       }, 1000);\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .show('fast');\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGrpHide(sGroup, bForce) {\r\n");
           $nm_saida->saida("     if (bForce || 'over' != scBtnGrpStatus[sGroup]) {\r\n");
           $nm_saida->saida("       $('#sc_btgp_div_' + sGroup).hide('fast');\r\n");
           $nm_saida->saida("       $('#sc_btgp_btn_' + sGroup).removeClass('selected');\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   </script> \r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     function scBtnGroupByShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).done(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("         $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_groupby_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnGroupByHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSelCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).done(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("         $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_sel_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnSelCamposHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnOrderCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("       $.ajax({\r\n");
           $nm_saida->saida("         type: \"GET\",\r\n");
           $nm_saida->saida("         dataType: \"html\",\r\n");
           $nm_saida->saida("         url: sUrl\r\n");
           $nm_saida->saida("       }).done(function(data) {\r\n");
           $nm_saida->saida("         $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("         $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("         $(\"#sc_id_order_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       });\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     function scBtnOrderCamposHide(sPos) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   </script>\r\n");
foreach ($this->Ini->tippy_themes as $tippyTheme => $tippyThemeInfo) {
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $tippyThemeInfo['file'] . "\" />\r\n");
}
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/light.css\" />\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/light-border.css\" />\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/material.css\" />\r\n");
           $nm_saida->saida("<link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/tippyjs/translucent.css\" />\r\n");
           $nm_saida->saida("<script src=\"" . $this->Ini->path_prod . "/third/tippyjs/popper.min.js\"></script>\r\n");
           $nm_saida->saida("<script src=\"" . $this->Ini->path_prod . "/third/tippyjs/tippy-bundle.umd.min.js\"></script>\r\n");
           $cssJsContent = $this->generateRatingSummarizationJsCss();
           $nm_saida->saida("$cssJsContent\r\n");
           $nm_saida->saida("<style type=\"text/css\">\r\n");
           $nm_saida->saida("</style>\r\n");
           $nm_saida->saida("<script>\r\n");
           $nm_saida->saida("</script>\r\n");

if ($_SESSION['scriptcase']['proc_mobile'])
{
       $nm_saida->saida("   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\" />\r\n");
}

      $nm_saida->saida("</HEAD>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['responsive_chart']['active']) {
          $summary_width = "width=\"100%\"";
          $chart_height = " style=\"height: 100%\"";
          $border_height = "height: 100%;";
      }
      else {
          $chart_height = '';
          $border_height = '';
          if ($_SESSION['scriptcase']['proc_mobile'])
          {
              $summary_width = "width=\"100%\"";
          }
          else
          {
              $summary_width = "width=\"\"";
          }
      }
      if (!$this->Ini->Export_html_zip && $this->Print_All && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['doc_word']) 
      {
          $nm_saida->saida(" <BODY id=\"grid_summary\" class=\"" . $this->css_scGridPage . " sc-app-grid\" style=\"-webkit-print-color-adjust: exact;\">\r\n");
          $nm_saida->saida("   <TABLE id=\"sc_table_print\" cellspacing=0 cellpadding=0 align=\"center\" valign=\"top\" " . $summary_width . ">\r\n");
          $nm_saida->saida("     <TR>\r\n");
          $nm_saida->saida("       <TD align=\"center\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "prit_web_page()", "prit_web_page()", "Bprint_print", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + P)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("       </TD>\r\n");
          $nm_saida->saida("     </TR>\r\n");
          $nm_saida->saida("   </TABLE>\r\n");
          $nm_saida->saida("  <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("     function prit_web_page()\r\n");
          $nm_saida->saida("     {\r\n");
          $nm_saida->saida("        document.getElementById('sc_table_print').style.display = 'none';\r\n");
          $nm_saida->saida("        var is_safari = navigator.userAgent.indexOf(\"Safari\") > -1;\r\n");
          $nm_saida->saida("        var is_chrome = navigator.userAgent.indexOf('Chrome') > -1\r\n");
          $nm_saida->saida("        if ((is_chrome) && (is_safari)) {is_safari=false;}\r\n");
          $nm_saida->saida("        window.print();\r\n");
          $nm_saida->saida("        if (is_safari) {setTimeout(\"window.close()\", 1000);} else {window.close();}\r\n");
          $nm_saida->saida("     }\r\n");
          $nm_saida->saida("  </script>\r\n");
      }
      else
      {
          $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['remove_margin'] ? 'margin: 0;' : '';
          $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['remove_border'] ? 'border-width: 0;' : '';
          $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none;' : '';
          $vertical_center = '';
          $nm_saida->saida(" <BODY id=\"grid_summary\" class=\"" . $this->css_scGridPage . " sc-app-grid\" style=\"" . $remove_margin . $remove_background . $vertical_center . "\">\r\n");
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida'] && !$this->aux_isPdf())
      {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none;\" class='scDebugWindow'><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
      }
      $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] == "pdf")
      { 
              $nm_saida->saida("  <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\">" . $this->Ini->Nm_lang['lang_othr_smry_msge'] . "</H1></div>\r\n");
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['doc_word'])
      { 
          $nm_saida->saida("      <STYLE>\r\n");
          $nm_saida->saida("       .ttip {border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;color:black;}\r\n");
          $nm_saida->saida("      </STYLE>\r\n");
          $nm_saida->saida("      <div id=\"tooltip\" style=\"position:absolute;visibility:hidden;border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;padding:1px;color:black;\"></div>\r\n");
      } 

      }

      $nm_saida->saida("<TABLE id=\"main_table_res\" cellspacing=0 cellpadding=0 align=\"center\" valign=\"top\" " . $summary_width . $chart_height . ">\r\n");
      $nm_saida->saida(" <TR class='sc-mobile-inner-control'>\r\n");
      $nm_saida->saida("  <TD class='sc-mobile-inner-control' " . $chart_height . ">\r\n");
      $nm_saida->saida("  <div class=\"scGridBorder\" style=\"" . $border_height . (isset($remove_border) ? $remove_border : '') . "\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"scGridLabel\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
      $nm_saida->saida("  <table width='100%' cellspacing=0 cellpadding=0" . $chart_height . " class='sc-mobile-inner-control'>\r\n");
      $nm_saida->saida("<TR class='sc-mobile-inner-control'>\r\n");
      $nm_saida->saida("<TD style=\"padding: 0px; vertical-align: initial\" class='sc-mobile-inner-control'>\r\n");
       $tableHeight = "";
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['under_dashboard'])
       {
           $tableHeight = "; height: 100%";
       }
      $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px; border-collapse: collapse;  vertical-align: top; width: 100%" . $tableHeight . "\" class='sc-mobile-inner-control'>\r\n");
   }

   //-----  top
   function monta_barra_top_normal()
   {
      global $nm_url_saida, $nm_apl_dependente, $nm_saida;
      $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida'])
      {
         $nm_saida->saida(" <TR align=\"center\" id=\"obj_barra_top\">\r\n");
         $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
         $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\">\r\n");
         $nm_saida->saida("    <TR class=\"" . $this->css_scGridToolbarPadd . "_tr\">\r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\">\r\n");
         $NM_btn  = false;
         $NM_Gbtn = false;
      if (!$this->grid_emb_form && $this->nmgp_botoes['group_1'] == "on")
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_fontawesomeicon", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
         if ($NM_Gbtn)
         {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
            $NM_Gbtn = false;
         }
      if (!$this->grid_emb_form && $this->nmgp_botoes['xls'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rxls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['xls'][] = "Rxls_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "", "", "Rxls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + X)", "thickbox", "" . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_config_xls.php?script_case_init=" . $this->Ini->sc_page . "&app_name=grid_income_offday_ot&nm_tp_xls=xls&nm_tot_xls=S&nm_tot_xls=S&nm_res_cons=s&nm_ini_xls_res=grid,resume&nm_all_modules=grid,resume&password=n&summary_export_columns=S&origem=res&language=en_us&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
         if ($NM_Gbtn)
         {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
            $NM_Gbtn = false;
         }
      if (!$this->grid_emb_form && $this->nmgp_botoes['print'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rprinttop\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['print'][] = "Rprint_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "Rprint_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + P)", "thickbox", "" . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_opc=resumo&nm_cor=CO&nm_res_cons=s&nm_ini_prt_res=grid,resume&nm_all_modules=grid,resume&password=n&origem=res&language=en_us&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
         if (is_file("grid_income_offday_ot_help.txt") && !$this->grid_emb_form && !$this->NM_res_sem_reg)
         {
            $Arq_WebHelp = file("grid_income_offday_ot_help.txt"); 
            if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
            {
                $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                $Tmp = explode(";", $Arq_WebHelp[0]); 
                foreach ($Tmp as $Cada_help)
                {
                    $Tmp1 = explode(":", $Cada_help); 
                    if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "res" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                    {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "Rhelp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                    }
                }
            }
         }
      if ($this->nmgp_botoes['chart_exit'] == 'on' && !$this->grid_emb_form)
      {
          $this->nm_btn_exist['exit'][] = "Rsai_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('igual', '0');", "nm_gp_move('igual', '0');", "Rsai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\">\r\n");
         $NM_btn = false;
         $NM_Gbtn = false;
         $nm_saida->saida("     </TD> \r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\">\r\n");
         $NM_btn = false;
         $NM_Gbtn = false;
         $nm_saida->saida("     </TD>\r\n");
         $nm_saida->saida("    </TR>\r\n");
         $nm_saida->saida("   </TABLE>\r\n");
         $nm_saida->saida("  </TD>\r\n");
         $nm_saida->saida(" </TR>\r\n");
      }
   }

   //-----  top
   function monta_barra_top_mobile()
   {
      global $nm_url_saida, $nm_apl_dependente, $nm_saida;
      $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['opcao'] != "print" && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida'])
      {
         $nm_saida->saida(" <TR align=\"center\" id=\"obj_barra_top\">\r\n");
         $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . "\">\r\n");
         $nm_saida->saida("   <TABLE class=\"" . $this->css_scGridToolbar . "\" style=\"padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;\">\r\n");
         $nm_saida->saida("    <TR class=\"" . $this->css_scGridToolbarPadd . "_tr\">\r\n");
         $nm_saida->saida("     <TD class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\">\r\n");
         $NM_btn  = false;
         $NM_Gbtn = false;
      if (!$this->grid_emb_form && $this->nmgp_botoes['group_1'] == "on")
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_fontawesomeicon", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
         if ($NM_Gbtn)
         {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
            $NM_Gbtn = false;
         }
      if (!$this->grid_emb_form && $this->nmgp_botoes['xls'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rxls_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['xls'][] = "Rxls_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bexcel", "", "", "Rxls_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + X)", "thickbox", "" . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_config_xls.php?script_case_init=" . $this->Ini->sc_page . "&app_name=grid_income_offday_ot&nm_tp_xls=xls&nm_tot_xls=S&nm_tot_xls=S&nm_res_cons=s&nm_ini_xls_res=grid,resume&nm_all_modules=grid,resume&password=n&summary_export_columns=S&origem=res&language=en_us&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
         if ($NM_Gbtn)
         {
                  $nm_saida->saida("           </td></tr><tr><td class=\"scBtnGrpBackground\">\r\n");
            $NM_Gbtn = false;
         }
      if (!$this->grid_emb_form && $this->nmgp_botoes['print'] == "on" && !$this->NM_res_sem_reg)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_Rprinttop\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
         $this->nm_btn_exist['print'][] = "Rprint_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "Rprint_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + P)", "thickbox", "" . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=S&nm_opc=resumo&nm_cor=CO&nm_res_cons=s&nm_ini_prt_res=grid,resume&nm_all_modules=grid,resume&password=n&origem=res&language=en_us&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
      }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
         if (is_file("grid_income_offday_ot_help.txt") && !$this->grid_emb_form && !$this->NM_res_sem_reg)
         {
            $Arq_WebHelp = file("grid_income_offday_ot_help.txt"); 
            if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
            {
                $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                $Tmp = explode(";", $Arq_WebHelp[0]); 
                foreach ($Tmp as $Cada_help)
                {
                    $Tmp1 = explode(":", $Cada_help); 
                    if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "res" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                    {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "Rhelp_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                    }
                }
            }
         }
      if ($this->nmgp_botoes['chart_exit'] == 'on' && !$this->grid_emb_form)
      {
          $this->nm_btn_exist['exit'][] = "Rsai_top";
         $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "nm_gp_move('igual', '0');", "nm_gp_move('igual', '0');", "Rsai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
         $nm_saida->saida("           $Cod_Btn \r\n");
      }
         $nm_saida->saida("     </TD>\r\n");
         $nm_saida->saida("    </TR>\r\n");
         $nm_saida->saida("   </TABLE>\r\n");
         $nm_saida->saida("  </TD>\r\n");
         $nm_saida->saida(" </TR>\r\n");
      }
   }

   function monta_barra_top()
   {
       $this->grid_emb_form = false;
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->monta_barra_top_mobile();
       }
       else
       {
           $this->monta_barra_top_normal();
       }
   }
   function monta_barra_bot()
   {
       $this->grid_emb_form = false;
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->monta_barra_bot_mobile();
       }
       else
       {
           $this->monta_barra_bot_normal();
       }
   }
   function monta_embbed_placeholder_top()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   function monta_embbed_placeholder_mobile_top()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
   }
   //----- 
   function monta_html_fim()
   {
      global $nm_saida;
      $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
      $nm_saida->saida("</TABLE>\r\n");
      $nm_saida->saida("<link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_sweetalert.css\" />\r\n");
      $nm_saida->saida("<script type=\"text/javascript\" src=\"" . $_SESSION['scriptcase']['grid_income_offday_ot']['glo_nm_path_prod'] . "/third/sweetalert/sweetalert2.all.min.js\"></script>\r\n");
      $nm_saida->saida("<script type=\"text/javascript\" src=\"" . $_SESSION['scriptcase']['grid_income_offday_ot']['glo_nm_path_prod'] . "/third/sweetalert/polyfill.min.js\"></script>\r\n");
      $nm_saida->saida("<script type=\"text/javascript\" src=\"../_lib/lib/js/frameControl.js\"></script>\r\n");
      $confirmButtonClass = '';
      $cancelButtonClass  = '';
      $confirmButtonText  = $this->Ini->Nm_lang['lang_btns_cfrm'];
      $cancelButtonText   = $this->Ini->Nm_lang['lang_btns_cncl'];
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
      if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['value']) && '' != $this->arr_buttons['bsweetalert_ok']['value']) {
          $confirmButtonText = $this->arr_buttons['bsweetalert_ok']['value'];
      }
      if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['value']) && '' != $this->arr_buttons['bsweetalert_cancel']['value']) {
          $cancelButtonText = $this->arr_buttons['bsweetalert_cancel']['value'];
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
      $nm_saida->saida("<script type=\"text/javascript\">\r\n");
      $nm_saida->saida("  var scSweetAlertConfirmButton = \"" . $confirmButtonClass . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertCancelButton = \"" . $cancelButtonClass . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertConfirmButtonText = \"" . $confirmButtonText . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertCancelButtonText = \"" . $cancelButtonText . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertConfirmButtonFA = \"" . $confirmButtonFA . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertCancelButtonFA = \"" . $cancelButtonFA . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertConfirmButtonFAPos = \"" . $confirmButtonFAPos . "\";\r\n");
      $nm_saida->saida("  var scSweetAlertCancelButtonFAPos = \"" . $cancelButtonFAPos . "\";\r\n");
      $nm_saida->saida("</script>\r\n");
      $nm_saida->saida("<script type=\"text/javascript\">\r\n");
      $nm_saida->saida("$(function() {\r\n");
      if ((isset($this->nm_mens_alert) && count($this->nm_mens_alert)) || (isset($this->Ini->nm_mens_alert) && count($this->Ini->nm_mens_alert))) {
   if (isset($this->Ini->nm_mens_alert) && !empty($this->Ini->nm_mens_alert))
   {
       if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
       {
           $this->nm_mens_alert   = array_merge($this->Ini->nm_mens_alert, $this->nm_mens_alert);
           $this->nm_params_alert = array_merge($this->Ini->nm_params_alert, $this->nm_params_alert);
       }
       else
       {
           $this->nm_mens_alert   = $this->Ini->nm_mens_alert;
           $this->nm_params_alert = $this->Ini->nm_params_alert;
       }
   }
   if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
   {
       foreach ($this->nm_mens_alert as $i_alert => $mensagem)
       {
           $alertParams = array();
           if (isset($this->nm_params_alert[$i_alert]))
           {
               foreach ($this->nm_params_alert[$i_alert] as $paramName => $paramValue)
               {
                   if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('background' == $paramName)
                   {
                       $image_param = $paramValue;
                       preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $paramValue, $matches, PREG_PATTERN_ORDER);
                       if (isset($matches[3])) {
                           foreach ($matches[3] as $match) {
                               if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                                   $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                               }
                           }
                       }
                       $paramValue = $image_param;
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
               }
           }
           $jsonParams = json_encode($alertParams);
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['ajax_nav'])
           { 
               $this->Ini->Arr_result['AlertJS'][] = NM_charset_to_utf8($mensagem);
               $this->Ini->Arr_result['AlertJSParam'][] = $alertParams;
           } 
           else 
           { 
$nm_saida->saida("       scJs_alert('" . $mensagem . "', $jsonParams);\r\n");
           } 
       }
   }
      }
      $nm_saida->saida("});\r\n");
      $nm_saida->saida("</script>\r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida'])
      { 
          return;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['doc_word'])
      { 
      $nm_saida->saida("</BODY>\r\n");
      $nm_saida->saida("</HTML>\r\n");
          return;
      } 
if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['doc_word'])
{ 
      $nm_saida->saida("</TABLE>\r\n");
      $nm_saida->saida("</div>\r\n");
      $nm_saida->saida("</TD>\r\n");
      $nm_saida->saida("</TR>\r\n");
      $nm_saida->saida("</TABLE>\r\n");
       $nm_saida->saida("<script type=\"text/javascript\">\r\n");
       $nm_saida->saida("function summaryConfig() {\r\n");
       $nm_saida->saida("  tb_show('', 'grid_income_offday_ot_config_pivot.php?nome_apl=grid_income_offday_ot&sc_page=" . NM_encode_input($this->Ini->sc_page) . "&language=en_us&TB_iframe=true&modal=true&height=300&width=500', '');\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("function changeSort(col, ord, oldSort) {\r\n");
       $nm_saida->saida("  Parm_change  = 'change_sort*scin';\r\n");
       $nm_saida->saida("  Parm_change += oldSort ? 'Y' : 'NEW';\r\n");
       $nm_saida->saida("  Parm_change += '*scoutsort_col*scin';\r\n");
       $nm_saida->saida("  Parm_change +=  col;\r\n");
       $nm_saida->saida("  Parm_change += '*scoutsort_ord*scin';\r\n");
       $nm_saida->saida("  Parm_change +=  ord;\r\n");
       $nm_saida->saida("  nm_gp_submit_ajax('resumo', Parm_change);\r\n");
       $nm_saida->saida("}\r\n");
       $nm_saida->saida("</script>\r\n");
       $nm_saida->saida("<form name=\"refresh_config\" method=\"post\" action=\"./\" style=\"display: none\">\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"nmgp_opcao\" value=\"resumo\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"change_sort\" value=\"N\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"sort_col\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"sort_ord\" />\r\n");
       $nm_saida->saida("<input type=\"hidden\" name=\"reload_summary_data\" />\r\n");
       $nm_saida->saida("</form>\r\n");
}
      $nm_saida->saida("<FORM name=\"F3\" method=\"post\" action=\"./\"\r\n");
      $nm_saida->saida("                                  target = \"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_chave\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_opcao\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_ordem\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_chave_det\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_quant_linhas\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_url_saida\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_parms\" value=\"\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_outra_jan\" value=\"\"/>\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_orig_pesq\" value=\"\"/>\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\" />\r\n");
      $nm_saida->saida("</FORM>\r\n");
      $nm_saida->saida("<form name=\"FRES\" method=\"post\" \r\n");
      $nm_saida->saida("                    action=\"\" \r\n");
      $nm_saida->saida("                    target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("</form> \r\n");
      $nm_saida->saida("<form name=\"FRES_chart_export_view\" method=\"get\" target=\"_blank\" style=\"display: none\"></form>\r\n");
      $nm_saida->saida("<form name=\"FCONS\" method=\"post\" \r\n");
      $nm_saida->saida("                    action=\"./\" \r\n");
      $nm_saida->saida("                    target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_opcao\" value=\"link_res\" />\r\n");
      $nm_saida->saida("<INPUT type=\"hidden\" name=\"nmgp_parms_where\" value=\"\" />\r\n");
      $nm_saida->saida("<input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("</form> \r\n");
   $nm_saida->saida("   <form name=\"F4\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"rec\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"rec\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_call_php\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
      $nm_saida->saida("<form name=\"Fgraf\" method=\"post\" \r\n");
      $nm_saida->saida("                   action=\"./\" \r\n");
      $nm_saida->saida("                   target=\"_self\" style=\"display: none\"> \r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_opcao\" value=\"grafico\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"campo\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nivel_quebra\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"campo_val\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_parms\" value=\"\" />\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"summary_chart\" value=\"N\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"chart_md5\" value=\"\"/>\r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("  <input type=\"hidden\" name=\"summary_css\" value=\"" . NM_encode_input($this->Ini->summary_css) . "\"/> \r\n");
      $nm_saida->saida("</form> \r\n");
   $nm_saida->saida("<form name=\"Fprint\" id=\"sc-id-form-print\" method=\"post\" \r\n");
   $nm_saida->saida("                  action=\"grid_income_offday_ot_iframe_prt.php\" \r\n");
   $nm_saida->saida("                  target=\"jan_print\" style=\"display: none\"> \r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"path_botoes\" value=\"" . $this->Ini->path_botoes . "\"/> \r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"opcao\" value=\"res_print\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"tp_print\" value=\"RC\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"cor_print\" value=\"CO\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_opcao\" value=\"res_print\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_tipo_print\" value=\"RC\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_cor_print\" value=\"CO\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("  <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("</form> \r\n");
   $nm_saida->saida("   <form name=\"Fexport\" id=\"sc-id-form-export\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tp_xls\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tot_xls\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_line\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_col\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_dados\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_label_csv\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_xml_tag\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_xml_label\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_json_format\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_json_label\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("  <form name=\"Fres_pdf\" method=\"post\" target=\"_self\" style=\"display: none\">\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_tp_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_parms_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"chart_level\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_create_charts\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_graf_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_graf_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"use_pass_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_all_cab\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_all_label\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_label_group\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_zip\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"" . session_id() . "\"/> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("<SCRIPT language=\"Javascript\">\r\n");
   $nm_saida->saida("   $(function(){ \r\n");
   $nm_saida->saida("       NM_btn_disable();\r\n");
   $nm_saida->saida("   }); \r\n");
   $nm_saida->saida("   function NM_btn_disable()\r\n");
   $nm_saida->saida("   {\r\n");
   foreach ($this->nm_btn_disabled as $cod_btn => $st_btn) {
      if (isset($this->nm_btn_exist[$cod_btn]) && $st_btn == 'on') {
         foreach ($this->nm_btn_exist[$cod_btn] as $cada_id) {
           $nm_saida->saida("     $('#" . $cada_id . "').prop('onclick', null).off('click').addClass('disabled').removeAttr('href');\r\n");
           $nm_saida->saida("     $('#div_" . $cada_id . "').addClass('disabled');\r\n");
         }
      }
   }
   $nm_saida->saida("   }\r\n");
      $nm_saida->saida(" function nm_link_cons(x) \r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("     document.FCONS.nmgp_parms_where.value = x;\r\n");
      $nm_saida->saida("     document.FCONS.submit();\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida("   function nm_gp_print_conf(tp, cor, SC_module_export, password, ajax, str_type, bol_param)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (\"R\" == ajax)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           $('#TB_window').remove();\r\n");
      $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__cor_print=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.Fprint.tp_print.value = tp;\r\n");
      $nm_saida->saida("           document.Fprint.cor_print.value = cor;\r\n");
      $nm_saida->saida("           document.Fprint.nmgp_tipo_print.value = tp;\r\n");
      $nm_saida->saida("           document.Fprint.nmgp_cor_print.value = cor;\r\n");
      $nm_saida->saida("           document.Fprint.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("           document.Fprint.nmgp_password.value = password;\r\n");
      $nm_saida->saida("           if (password != \"\")\r\n");
      $nm_saida->saida("           {\r\n");
      $nm_saida->saida("               document.Fprint.target = '_self';\r\n");
      $nm_saida->saida("               document.Fprint.action = \"grid_income_offday_ot_export_ctrl.php\";\r\n");
      $nm_saida->saida("           }\r\n");
      $nm_saida->saida("           else\r\n");
      $nm_saida->saida("           {\r\n");
      $nm_saida->saida("               window.open('','jan_print','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
      $nm_saida->saida("           }\r\n");
      $nm_saida->saida("           document.Fprint.submit() ;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_gp_xls_conf(tp_xls, SC_module_export, password, tot_xls, ajax, str_type, bol_param)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (\"R\" == ajax)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           $('#TB_window').remove();\r\n");
      $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_tp_xls=\" + tp_xls + \"__E__nmgp_tot_xls=\" + tot_xls + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_opcao.value = 'xls_res';\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_tp_xls.value = tp_xls;\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_tot_xls.value = tot_xls;\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
      $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("               document.Fexport.action = \"grid_income_offday_ot_export_ctrl.php\";\r\n");
      $nm_saida->saida("           document.Fexport.submit() ;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_gp_csv_conf(delim_line, delim_col, delim_dados, label_csv, SC_module_export, password, ajax, str_type, bol_param)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (\"R\" == ajax)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           $('#TB_window').remove();\r\n");
      $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_delim_line=\" + delim_line + \"__E__nm_delim_col=\" + delim_col + \"__E__nm_delim_dados=\" + delim_dados + \"__E__nm_label_csv=\" + label_csv + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"csv_res\";\r\n");
      $nm_saida->saida("           document.Fexport.nm_delim_line.value = delim_line;\r\n");
      $nm_saida->saida("           document.Fexport.nm_delim_col.value = delim_col;\r\n");
      $nm_saida->saida("           document.Fexport.nm_delim_dados.value = delim_dados;\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
      $nm_saida->saida("           document.Fexport.nm_label_csv.value = label_csv;\r\n");
      $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("               document.Fexport.action = \"grid_income_offday_ot_export_ctrl.php\";\r\n");
      $nm_saida->saida("           document.Fexport.submit() ;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_gp_xml_conf(xml_tag, xml_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (\"R\" == ajax)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           $('#TB_window').remove();\r\n");
      $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_xml_tag=\" + xml_tag + \"__E__nm_xml_label=\" + xml_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"xml_res\";\r\n");
      $nm_saida->saida("           document.Fexport.nm_xml_tag.value   = xml_tag;\r\n");
      $nm_saida->saida("           document.Fexport.nm_xml_label.value = xml_label;\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
      $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("               document.Fexport.action = \"grid_income_offday_ot_export_ctrl.php\";\r\n");
      $nm_saida->saida("           document.Fexport.submit() ;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_gp_json_conf(json_format, json_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (\"R\" == ajax)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           $('#TB_window').remove();\r\n");
      $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_json_format=\" + json_format + \"__E__nm_json_label=\" + json_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_opcao.value    = \"json_res\";\r\n");
      $nm_saida->saida("           document.Fexport.nm_json_format.value   = json_format;\r\n");
      $nm_saida->saida("           document.Fexport.nm_json_label.value = json_label;\r\n");
      $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
      $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("               document.Fexport.action = \"grid_income_offday_ot_export_ctrl.php\";\r\n");
      $nm_saida->saida("           document.Fexport.submit() ;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_gp_rtf_conf()\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       document.Fexport.nmgp_opcao.value = \"rtf_res\";\r\n");
      $nm_saida->saida("       document.Fexport.action = \"grid_income_offday_ot_export_ctrl.php\";\r\n");
      $nm_saida->saida("       document.Fexport.submit() ;\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida(" function nm_open_export(arq_export) \r\n");
      $nm_saida->saida(" { \r\n");
      $nm_saida->saida("    window.location = arq_export;\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida(" function nm_gp_submit_ajax(opc, parm)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("    return ajax_navigate_res(opc, parm);\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida("   function nm_submit_modal(parms, t_parent) \r\n");
      $nm_saida->saida("   { \r\n");
      $nm_saida->saida("      if (t_parent == 'S' && typeof parent.tb_show == 'function')\r\n");
      $nm_saida->saida("      { \r\n");
      $nm_saida->saida("           parent.tb_show('', parms, '');\r\n");
      $nm_saida->saida("      } \r\n");
      $nm_saida->saida("      else\r\n");
      $nm_saida->saida("      { \r\n");
      $nm_saida->saida("         tb_show('', parms, '');\r\n");
      $nm_saida->saida("      } \r\n");
      $nm_saida->saida("   } \r\n");
      $nm_saida->saida("   function nm_move() \r\n");
      $nm_saida->saida("   { \r\n");
      $nm_saida->saida("      document.F3.target = \"_self\"; \r\n");
      $nm_saida->saida("      document.F3.submit();\r\n");
      $nm_saida->saida("   } \r\n");
      $nm_saida->saida(" function nm_gp_move(x, y, z, p, g, crt, ajax, chart_level, page_break_pdf, SC_module_export, use_pass_pdf, pdf_all_cab, pdf_all_label, pdf_label_group, pdf_zip) \r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("  document.F3.nmgp_opcao.value = x;\r\n");
      $nm_saida->saida("  document.F3.target = \"_self\"; \r\n");
      $nm_saida->saida("  if (y == 1) \r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.target = \"_blank\"; \r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  if (\"busca\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.nmgp_orig_pesq.value = z; \r\n");
      $nm_saida->saida("      z = '';\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  if (z != null && z != '') \r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("     document.F3.nmgp_tipo_pdf.value = z;\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  document.F3.script_case_init.value = \"" . NM_encode_input($this->Ini->sc_page) . "\" ;\r\n");
      $nm_saida->saida("  if (\"xls_res\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("       document.F3.SC_module_export.value = z;\r\n");
      $nm_saida->saida("       str_type = (z == \"s\") ? \"xls\" : \"xls_res\"\r\n");
      $nm_saida->saida("       document.F3.nmgp_opcao.value = str_type;\r\n");
      if (!extension_loaded("zip"))
      {
      $nm_saida->saida("      alert (\"" . html_entity_decode($this->Ini->Nm_lang['lang_othr_prod_xtzp'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\");\r\n");
      $nm_saida->saida("      return false;\r\n");
      } 
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  if (\"xml_res\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("       document.F3.SC_module_export.value = z;\r\n");
      $nm_saida->saida("  }\r\n");
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['grid_income_offday_ot_iframe_params'] = array(
          'str_tmp'          => $this->Ini->path_imag_temp,
          'str_prod'         => $this->Ini->path_prod,
          'str_btn'          => $this->Ini->Str_btn_css,
          'str_lang'         => $this->Ini->str_lang,
          'str_schema'       => $this->Ini->str_schema_all,
          'str_google_fonts' => $this->Ini->str_google_fonts,
      );
      $prep_parm_pdf = "nmgp_opcao?#?pdf_res?@?scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?jspath?#?" . $this->Ini->path_js . "?#?";
      $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@grid_income_offday_ot@SC_par@" . md5($prep_parm_pdf);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
      $nm_saida->saida("      document.Fres_pdf.sc_tp_pdf.value = z;\r\n");
      $nm_saida->saida("      document.Fres_pdf.nmgp_tipo_pdf.value = z;\r\n");
      $nm_saida->saida("      document.Fres_pdf.sc_parms_pdf.value = p;\r\n");
      $nm_saida->saida("      document.Fres_pdf.nmgp_parms_pdf.value = p;\r\n");
      $nm_saida->saida("      document.Fres_pdf.chart_level.value = chart_level;\r\n");
      $nm_saida->saida("      document.Fres_pdf.sc_create_charts.value = crt;\r\n");
      $nm_saida->saida("      document.Fres_pdf.sc_graf_pdf.value = g;\r\n");
      $nm_saida->saida("      document.Fres_pdf.nmgp_graf_pdf.value = g;\r\n");
      $nm_saida->saida("      document.Fres_pdf.SC_module_export.value = SC_module_export;\r\n");
      $nm_saida->saida("      document.Fres_pdf.use_pass_pdf.value = use_pass_pdf;\r\n");
      $nm_saida->saida("      document.Fres_pdf.pdf_all_cab.value = pdf_all_cab;\r\n");
      $nm_saida->saida("      document.Fres_pdf.pdf_all_label.value = pdf_all_label;\r\n");
      $nm_saida->saida("      document.Fres_pdf.pdf_label_group.value = pdf_label_group;\r\n");
      $nm_saida->saida("      document.Fres_pdf.pdf_zip.value = pdf_zip;\r\n");
      $nm_saida->saida("  if (\"pdf_res\" == x)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      if (\"R\" == ajax)\r\n");
      $nm_saida->saida("      {\r\n");
      $nm_saida->saida("          $('#TB_window').remove();\r\n");
      $nm_saida->saida("          $('body').append(\"<div id='TB_window'></div>\");\r\n");
      $nm_saida->saida("          nm_submit_modal(\"" . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=pdf_res&sAdd=__E__nmgp_tipo_pdf=\" + z + \"__E__sc_parms_pdf=\" + p + \"__E__sc_create_charts=\" + crt + \"__E__sc_graf_pdf=\" + g + \"__E__chart_level=\" + chart_level + \"__E__SC_module_export=\" + SC_module_export + \"__E__use_pass_pdf=\" + use_pass_pdf + \"__E__pdf_all_cab=\" + pdf_all_cab + \"__E__pdf_all_label=\" +  pdf_all_label + \"__E__pdf_label_group=\" +  pdf_label_group + \"__E__pdf_zip=\" +  pdf_zip + \"&nm_opc=pdf&KeepThis=true&TB_iframe=true&modal=true\", '');\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      else\r\n");
      $nm_saida->saida("      {\r\n");
      $nm_saida->saida("          document.Fres_pdf.nmgp_parms.value = \"" . $Md5_pdf . "\" ;\r\n");
      $nm_saida->saida("          document.Fres_pdf.action = \"grid_income_offday_ot_iframe.php\";\r\n");
      $nm_saida->saida("          document.Fres_pdf.submit();\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  else\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("      document.F3.submit();\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_gp_submit5(apl_lig, apl_saida, parms, target, opc, modal_h, modal_w) \r\n");
      $nm_saida->saida(" { \r\n");
      $nm_saida->saida("    if (apl_lig.substr(0, 7) == \"http://\" || apl_lig.substr(0, 8) == \"https://\")\r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        if (target == '_blank') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            window.open (apl_lig);\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        else\r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            window.location = apl_lig;\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        return;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    if (target == 'modal') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        par_modal = '?script_case_init=" . NM_encode_input($this->Ini->sc_page) . "&nmgp_outra_jan=true&nmgp_url_saida=modal';\r\n");
      $nm_saida->saida("        if (opc != null && opc != '') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            par_modal += '&nmgp_opcao=grid';\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        if (parms != null && parms != '') \r\n");
      $nm_saida->saida("        {\r\n");
      $nm_saida->saida("            par_modal += '&nmgp_parms=' + parms;\r\n");
      $nm_saida->saida("        }\r\n");
      $nm_saida->saida("        tb_show('', apl_lig + par_modal + '&TB_iframe=true&modal=true&height=' + modal_h + '&width=' + modal_w, '');\r\n");
      $nm_saida->saida("        return;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.target               = target; \r\n");
      $nm_saida->saida("    if (target == '_blank') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_outra_jan.value = \"true\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.action               = apl_lig  ;\r\n");
      $nm_saida->saida("    if (opc != null && opc != '') \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_opcao.value = \"grid\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    else\r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.F3.nmgp_opcao.value = \"\" ;\r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.F3.nmgp_url_saida.value = apl_saida ;\r\n");
      $nm_saida->saida("    document.F3.nmgp_parms.value = parms ;\r\n");
      $nm_saida->saida("    document.F3.submit() ;\r\n");
      $nm_saida->saida("    document.F3.nmgp_outra_jan.value = \"\";\r\n");
      $nm_saida->saida("    document.F3.nmgp_parms.value = \"\";\r\n");
      $nm_saida->saida("    document.F3.action = \"./\";\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida("   var tem_hint;\r\n");
      $nm_saida->saida("   function nm_mostra_hint(nm_obj, nm_evt, nm_mens)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (nm_mens == \"\")\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           return;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       tem_hint = true;\r\n");
      $nm_saida->saida("       if (document.layers)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           theString=\"<DIV CLASS='ttip'>\" + nm_mens + \"</DIV>\";\r\n");
      $nm_saida->saida("           document.tooltip.document.write(theString);\r\n");
      $nm_saida->saida("           document.tooltip.document.close();\r\n");
      $nm_saida->saida("           document.tooltip.left = nm_evt.pageX + 14;\r\n");
      $nm_saida->saida("           document.tooltip.top = nm_evt.pageY + 2;\r\n");
      $nm_saida->saida("           document.tooltip.visibility = \"show\";\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           if(document.getElementById)\r\n");
      $nm_saida->saida("           {\r\n");
      $nm_saida->saida("              nmdg_nav = navigator.appName;\r\n");
      $nm_saida->saida("              elm = document.getElementById(\"tooltip\");\r\n");
      $nm_saida->saida("              elml = nm_obj;\r\n");
      $nm_saida->saida("              elm.innerHTML = nm_mens;\r\n");
      $nm_saida->saida("              if (nmdg_nav == \"Netscape\")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  elm.style.height = elml.style.height;\r\n");
      $nm_saida->saida("                  elm.style.top = nm_evt.pageY + 2;\r\n");
      $nm_saida->saida("                  elm.style.left = nm_evt.pageX + 14;\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              else\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  elm.style.top = nm_evt.y + document.body.scrollTop + 10;\r\n");
      $nm_saida->saida("                  elm.style.left = nm_evt.x + document.body.scrollLeft + 10;\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              elm.style.visibility = \"visible\";\r\n");
      $nm_saida->saida("           }\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("   function nm_apaga_hint()\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("       if (!tem_hint)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           return;\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       tem_hint = false;\r\n");
      $nm_saida->saida("       if (document.layers)\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           document.tooltip.visibility = \"hidden\";\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("       else\r\n");
      $nm_saida->saida("       {\r\n");
      $nm_saida->saida("           if(document.getElementById)\r\n");
      $nm_saida->saida("           {\r\n");
      $nm_saida->saida("              elm.style.visibility = \"hidden\";\r\n");
      $nm_saida->saida("           }\r\n");
      $nm_saida->saida("       }\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida(" function nm_graf_submit(campo, nivel, campo_val, parms, target) \r\n");
      $nm_saida->saida(" { \r\n");
      $nm_saida->saida("    document.Fgraf.campo.value = campo ;\r\n");
      $nm_saida->saida("    document.Fgraf.nivel_quebra.value = nivel ;\r\n");
      $nm_saida->saida("    document.Fgraf.campo_val.value = campo_val ;\r\n");
      $nm_saida->saida("    document.Fgraf.nmgp_parms.value = parms ;\r\n");
      $nm_saida->saida("    document.Fgraf.summary_chart.value = 'N';\r\n");
      $nm_saida->saida("    if (target != null) \r\n");
      $nm_saida->saida("    {\r\n");
      $nm_saida->saida("        document.Fgraf.target = target; \r\n");
      $nm_saida->saida("    }\r\n");
      $nm_saida->saida("    document.Fgraf.submit() ;\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida(" function nm_graf_submit_2(chart)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("    var oldAction = document.Fgraf.action;\r\n");
      $nm_saida->saida("    document.Fgraf.action = nm_url_rand(document.Fgraf.action);\r\n");
      $nm_saida->saida("    document.Fgraf.nmgp_parms.value = chart;\r\n");
      $nm_saida->saida("    document.Fgraf.summary_chart.value = 'N';\r\n");
      $nm_saida->saida("    document.Fgraf.target = \"_blank\";\r\n");
      $nm_saida->saida("    document.Fgraf.submit();\r\n");
      $nm_saida->saida("    document.Fgraf.action = oldAction;\r\n");
      $nm_saida->saida(" } \r\n");
      $nm_saida->saida(" function Refresh_Chart()\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("     document.FRES.action = \"./\";\r\n");
      $nm_saida->saida("     document.FRES.submit();\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_open_popup(parms)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("     NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida(" function nm_url_rand(v_str_url)\r\n");
      $nm_saida->saida(" {\r\n");
      $nm_saida->saida("  str_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';\r\n");
      $nm_saida->saida("  str_rand  = v_str_url;\r\n");
      $nm_saida->saida("  str_rand += (-1 == v_str_url.indexOf('?')) ? '?' : '&';\r\n");
      $nm_saida->saida("  str_rand += 'r=';\r\n");
      $nm_saida->saida("  for (i = 0; i < 8; i++)\r\n");
      $nm_saida->saida("  {\r\n");
      $nm_saida->saida("   str_rand += str_chars.charAt(Math.round(str_chars.length * Math.random()));\r\n");
      $nm_saida->saida("  }\r\n");
      $nm_saida->saida("  return str_rand;\r\n");
      $nm_saida->saida(" }\r\n");
      $nm_saida->saida("   function process_hotkeys(hotkey)\r\n");
      $nm_saida->saida("   {\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_xls') { \r\n");
      $nm_saida->saida("         var output =  $('#Rxls_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_imp') { \r\n");
      $nm_saida->saida("         var output =  $('#Rprint_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_webh') { \r\n");
      $nm_saida->saida("         var output =  $('#Rhelp_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("      if (hotkey == 'sys_format_sai') { \r\n");
      $nm_saida->saida("         var output =  $('#Rsai_top').click();\r\n");
      $nm_saida->saida("         return (0 < output.length);\r\n");
      $nm_saida->saida("      }\r\n");
      $nm_saida->saida("   return false;\r\n");
      $nm_saida->saida("   }\r\n");
      $nm_saida->saida("</SCRIPT>\r\n");
      $nm_saida->saida("</BODY>\r\n");
      $nm_saida->saida("</HTML>\r\n");
   }

   function monta_html_ini_pdf()
   {
      global $nm_saida;
       $tp_quebra = "";
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['num_css']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['num_css']))
       {
           $NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_grid_income_offday_ot_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['num_css'] . '.css', 'a');
           $NM_css_file = $this->Ini->root . $this->Ini->path_link . "grid_income_offday_ot/grid_income_offday_ot_res_" . strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']). ".css";
           if (is_file($NM_css_file))
           {
               $NM_css_attr = file($NM_css_file);
               foreach ($NM_css_attr as $NM_line_css)
               {
                   @fwrite($NM_css, "    " . $NM_line_css . "\r\n");
               }
           }
           @fclose($NM_css);
       }
       $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['print_all'];
       $tp_quebra = "<div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div>";
       if ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['print_all'])
       {
       $tp_quebra = "<div style=\"page-break-after: always;\"><span style=\"display: none;\">&nbsp;</span></div>";
       }
       $nm_saida->saida("" . $tp_quebra . "\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['responsive_chart']['active']) {
           $summary_width = "width=\"100%\"";
       }
       else {
           if ($_SESSION['scriptcase']['proc_mobile'])
           {
               $summary_width = "width=\"100%\"";
           }
           else
           {
               $summary_width = "width=\"100%\"";
           }
       }
       $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px;\" align=\"center\" valign=\"top\" " . $summary_width . ">\r\n");
       $nm_saida->saida("<TR>\r\n");
       $nm_saida->saida("<TD style=\"padding: 0px\">\r\n");
       $nm_saida->saida("<TABLE style=\"padding: 0px; border-spacing: 0px; border-width: 0px; width: 100%;\">\r\n");
   }
   function monta_html_fim_pdf()
   {
      global $nm_saida;
      $nm_saida->saida("</TABLE>\r\n");
      $nm_saida->saida("</TD>\r\n");
      $nm_saida->saida("</TR>\r\n");
      $nm_saida->saida("</TABLE>\r\n");
   }
        function getHeaderColspan() {
                return $this->getHeaderColspan_index() + $this->getHeaderColspan_labels() + $this->getHeaderColspan_summarizing() + $this->getHeaderColspan_lineTotal();
        } // getHeaderColspan

        function getHeaderColspan_index() {
                return $this->comp_tab_seq ? 1 : 0;
        } // getHeaderColspan_index

        function getHeaderColspan_labels() {
                return $this->comp_tabular ? count($this->comp_y_axys) : 1;
        } // getHeaderColspan_labels

        function getHeaderColspan_summarizing() {
                return $this->build_col_count;
        } // getHeaderColspan_summarizing

        function getHeaderColspan_summarizing_fields() {
                $total = 0;

                foreach ($this->comp_sum_display as $displayFlag) {
                        if ($displayFlag) {
                                $total++;
                        }
                }

                return $total;
        } // getHeaderColspan_summarizing_fields

        function getHeaderColspan_lineTotal() {
             if (substr($this->Ini->PHP_ver, 0, 2) > 72) {
                return (isset($this->comp_x_axys) && is_countable($this->comp_x_axys) && count($this->comp_x_axys)) ? $this->getHeaderColspan_summarizing_fields() : 0;
             }
             else {
                return (isset($this->comp_x_axys) && is_array($this->comp_x_axys) && count($this->comp_x_axys)) ? $this->getHeaderColspan_summarizing_fields() : 0;
             }
        } // getHeaderColspan_lineTotal

   //----- 
   function monta_cabecalho()
   {
      global $nm_saida;
      if ($this->Ini->Embutida_iframe || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['dashboard_info']['compact_mode'])
      { 
          return;
      } 
      $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
      $nm_cab_filtro   = ""; 
      $nm_cab_filtrobr = ""; 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca']))
      { 
        $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca'];
        if ($_SESSION['scriptcase']['charset'] != "UTF-8")
        {
            $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
          $userid_int = (isset($Busca_temp['userid_int'])) ? $Busca_temp['userid_int'] : ""; 
          $tmp_pos = (is_string($userid_int)) ? strpos($userid_int, "##@@") : false;
          if ($tmp_pos !== false && !is_array($userid_int))
          {
              $userid_int = substr($userid_int, 0, $tmp_pos);
          }
          $username = (isset($Busca_temp['username'])) ? $Busca_temp['username'] : ""; 
          $tmp_pos = (is_string($username)) ? strpos($username, "##@@") : false;
          if ($tmp_pos !== false && !is_array($username))
          {
              $username = substr($username, 0, $tmp_pos);
          }
          $hiredate = (isset($Busca_temp['hiredate'])) ? $Busca_temp['hiredate'] : ""; 
          $tmp_pos = (is_string($hiredate)) ? strpos($hiredate, "##@@") : false;
          if ($tmp_pos !== false && !is_array($hiredate))
          {
              $hiredate = substr($hiredate, 0, $tmp_pos);
          }
          $hiredate_2 = (isset($Busca_temp['hiredate_input_2'])) ? $Busca_temp['hiredate_input_2'] : ""; 
          $designation = (isset($Busca_temp['designation'])) ? $Busca_temp['designation'] : ""; 
          $tmp_pos = (is_string($designation)) ? strpos($designation, "##@@") : false;
          if ($tmp_pos !== false && !is_array($designation))
          {
              $designation = substr($designation, 0, $tmp_pos);
          }
          $dept = (isset($Busca_temp['dept'])) ? $Busca_temp['dept'] : ""; 
          $tmp_pos = (is_string($dept)) ? strpos($dept, "##@@") : false;
          if ($tmp_pos !== false && !is_array($dept))
          {
              $dept = substr($dept, 0, $tmp_pos);
          }
      } 
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['cond_pesq']))
      {  
          $pos       = 0;
          $trab_pos  = false;
          $pos_tmp   = true; 
          $tmp       = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['cond_pesq'];
          while ($pos_tmp)
          {
             $pos = strpos($tmp, "##*@@", $pos);
             if ($pos !== false)
             {
                 $trab_pos = $pos;
                 $pos += 4;
             }
             else
             {
                 $pos_tmp = false;
             }
          }
          $nm_cond_filtro_or  = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['cond_pesq'], $trab_pos + 5) == "or")  ? " " . trim($this->Ini->Nm_lang['lang_srch_orr_cond']) . " " : "";
          $nm_cond_filtro_and = (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['cond_pesq'], $trab_pos + 5) == "and") ? " " . trim($this->Ini->Nm_lang['lang_srch_and_cond']) . " " : "";
          $nm_cab_filtro   = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['cond_pesq'], 0, $trab_pos);
          $nm_cab_filtrobr = str_replace("##*@@", ", " . $nm_cond_filtro_or . "<br />", $nm_cab_filtro);
          $pos       = 0;
          $trab_pos  = false;
          $pos_tmp   = true; 
          $tmp       = $nm_cab_filtro;
          while ($pos_tmp)
          {
             $pos = strpos($tmp, "##*@@", $pos);
             if ($pos !== false)
             {
                 $trab_pos = $pos;
                 $pos += 4;
             }
             else
             {
                 $pos_tmp = false;
             }
          }
          if ($trab_pos === false)
          {
          }
          else  
          {  
             $nm_cab_filtro = substr($nm_cab_filtro, 0, $trab_pos) . " " .  $nm_cond_filtro_or . $nm_cond_filtro_and . substr($nm_cab_filtro, $trab_pos + 5);
             $nm_cab_filtro = str_replace("##*@@", ", " . $nm_cond_filtro_or, $nm_cab_filtro);
          }   
      }   
      $nm_saida->saida(" <TR align=\"center\">\r\n");
     if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['proc_pdf_vert']) {
          $header_colspan = $this->getHeaderColspan();
          $nm_saida->saida("  <TD colspan=\"" . $header_colspan . "\" class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\">\r\n");
     }
     else {
          $nm_saida->saida("  <TD class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridPage . "\">\r\n");
     }
   $this->nm_data->SetaData(date("Y/m/d H:i:s"), "YYYY/MM/DD HH:II:SS");
   $sc_data_cab1 = $this->nm_data->FormataSaida("d-m-Y");
      $nm_saida->saida("<style>\r\n");
      $nm_saida->saida("    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}\r\n");
      $nm_saida->saida("</style>\r\n");
      $nm_saida->saida("<div class=\"" . $this->css_scGridHeader . "\" style=\"height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;\">\r\n");
      $nm_saida->saida("    <div class=\"" . $this->css_scGridHeaderFont . "\" style=\"float: left; text-transform: uppercase;\">INCOME OFFDAY OT</div>\r\n");
      $nm_saida->saida("    <div class=\"" . $this->css_scGridHeaderFont . "\" style=\"float: right;\">" . $sc_data_cab1 . "</div>\r\n");
      $nm_saida->saida("</div>\r\n");
      $nm_saida->saida("  </TD>\r\n");
      $nm_saida->saida(" </TR>\r\n");
   }


   //---- 
   function inicializa_arrays()
   {
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $Arr_tot_name = "array_total_" . $cmp_gb;
          $this->$Arr_tot_name = array();
      }
   }

   //---- 
   function adiciona_registro($sum_ot_hh_o, $sum_ot_hh_o_pm, $sum_income_offday_ot, $quebra_dept, $quebra_dept_orig)
   {
      $contr_arr = "";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $Name_orig  = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_orig'][$cmp_gb])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_orig'][$cmp_gb] : $cmp_gb;
          $Cmp_temp   = "quebra_" . $Name_orig . "_orig";
          $Cmp_format = "quebra_" . $Name_orig;
          $Format_tst = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp_gb);
          $Prefix_dat = $this->Ini->Get_Gb_prefix_date_format('sc_free_group_by', $cmp_gb);
          $TP_Time    = (in_array($Cmp_temp, $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
          $Cmp_arg    = $this->Ini->Get_arg_groupby($TP_Time . $$Cmp_temp, $Format_tst);
          $TP_Time    = (in_array($cmp_gb, $this->Ini->Cmp_Sql_Time)) ? "0000-00-00 " : "";
          $Cmp_formt  = $this->Ini->GB_date_format($TP_Time . $$Cmp_format, $Format_tst, $Prefix_dat);
          $contr_arr .= "['" . $Cmp_arg . "']";
          $arr_name   = "array_total_" . $cmp_gb . $contr_arr;
          $cmp_look   = "Cmp_formt";
          $cmp_orig   = "Cmp_arg";
          if (empty($sum_ot_hh_o)) {$sum_ot_hh_o = '0';}
          if (empty($sum_ot_hh_o_pm)) {$sum_ot_hh_o_pm = '0';}
          if (empty($sum_income_offday_ot)) {$sum_income_offday_ot = '0';}
          eval ('
          if (!isset($this->' . $arr_name . '))
          {
              $this->' . $arr_name . '[0] = 1;
              $this->' . $arr_name . '[1] = ' . $sum_ot_hh_o . ';
              $this->' . $arr_name . '[2] = ' . $sum_ot_hh_o_pm . ';
              $this->' . $arr_name . '[3] = ' . $sum_income_offday_ot . ';
              $this->' . $arr_name . '[4] = "' . addslashes($$cmp_look) . '";
              $this->' . $arr_name . '[5] = "' . $$cmp_orig . '";
          }
          else
          {
              $this->' . $arr_name . '[0]++;
              $this->' . $arr_name . '[1] = bcadd($this->' . $arr_name . '[1], ' . $sum_ot_hh_o . ', 10);
              $this->' . $arr_name . '[2] = bcadd($this->' . $arr_name . '[2], ' . $sum_ot_hh_o_pm . ', 10);
              $this->' . $arr_name . '[3] = bcadd($this->' . $arr_name . '[3], ' . $sum_income_offday_ot . ', 10);
          }
          ');
      }
   }

   //---- 
   function completa_arrays()
   {
      $contr_cmp_gb = array();
      $contr_ordem  = array();
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $contr_cmp_gb[] = $cmp_gb;
      }
      if (empty($contr_cmp_gb)) {
          return;
      }
 /*-----*/ 
      if (isset($contr_cmp_gb[0]))
      {
         eval ("\$arr_name_0  = \$this->array_total_" . $contr_cmp_gb[0] . ";");
         foreach ($arr_name_0 as $cmp_name_0  => $dados_gb)
         {
            $ind_exists  = "";
            $ind_missing = "";
            if (!isset($arr_name_0[$cmp_name_0][1])) {
                $ind_exists  = 2;
                $ind_missing = 1;
            }
            if (!isset($arr_name_0[$cmp_name_0][2])) {
                $ind_exists  = 1;
                $ind_missing = 2;
            }
            if (!empty($ind_missing)) {
                $arr_name_0[$cmp_name_0][$ind_missing][0] = 0;
                $arr_name_0[$cmp_name_0][$ind_missing][1] = 0;
                $arr_name_0[$cmp_name_0][$ind_missing][2] = 0;
                $arr_name_0[$cmp_name_0][$ind_missing][3] = 0;
                $arr_name_0[$cmp_name_0][$ind_missing][4] = $dados_gb[$ind_exists][4];
                $arr_name_0[$cmp_name_0][$ind_missing][5] = $dados_gb[$ind_exists][5];
                ksort($arr_name_0[$cmp_name_0]);
                eval ("\$this->array_total_" . $contr_cmp_gb[0] . "['" . $cmp_name_0 . "'] = \$arr_name_0['" . $cmp_name_0 . "'];");
            }
         } 
      } 
   }
   function finaliza_arrays($ind_compara=1)
   {
   }

   function prepara_resumo()
   {
      $this->inicializa_vars();
      $this->resumo_init();
      $this->inicializa_arrays();
   }

   function finaliza_resumo()
   {
      $this->finaliza_arrays();
   }

//
   function nm_acumula_resumo($nm_tipo="resumo")
   {
     global $nm_lang;
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca']))
     { 
         $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca'];
         if ($_SESSION['scriptcase']['charset'] != "UTF-8")
         {
             $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
       $this->userid_int = $Busca_temp['userid_int']; 
       $this->userid_int = (isset($Busca_temp['userid_int'])) ? $Busca_temp['userid_int'] : ""; 
       $tmp_pos = (is_string($this->userid_int)) ? strpos($this->userid_int, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->userid_int))
       {
           $this->userid_int = substr($this->userid_int, 0, $tmp_pos);
       }
       $this->username = $Busca_temp['username']; 
       $this->username = (isset($Busca_temp['username'])) ? $Busca_temp['username'] : ""; 
       $tmp_pos = (is_string($this->username)) ? strpos($this->username, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->username))
       {
           $this->username = substr($this->username, 0, $tmp_pos);
       }
       $this->hiredate = $Busca_temp['hiredate']; 
       $this->hiredate = (isset($Busca_temp['hiredate'])) ? $Busca_temp['hiredate'] : ""; 
       $tmp_pos = (is_string($this->hiredate)) ? strpos($this->hiredate, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->hiredate))
       {
           $this->hiredate = substr($this->hiredate, 0, $tmp_pos);
       }
       $hiredate_2 = (isset($Busca_temp['hiredate_input_2'])) ? $Busca_temp['hiredate_input_2'] : ""; 
       $this->hiredate_2 = $hiredate_2; 
       $this->designation = $Busca_temp['designation']; 
       $this->designation = (isset($Busca_temp['designation'])) ? $Busca_temp['designation'] : ""; 
       $tmp_pos = (is_string($this->designation)) ? strpos($this->designation, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->designation))
       {
           $this->designation = substr($this->designation, 0, $tmp_pos);
       }
       $this->dept = $Busca_temp['dept']; 
       $this->dept = (isset($Busca_temp['dept'])) ? $Busca_temp['dept'] : ""; 
       $tmp_pos = (is_string($this->dept)) ? strpos($this->dept, "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->dept))
       {
           $this->dept = substr($this->dept, 0, $tmp_pos);
       }
     } 
     $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_orig'];
     $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq'];
     $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq_filtro'];
     $this->nm_field_dinamico = array();
     $this->nm_order_dinamico = array();
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ""; 
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
     { 
         $nmgp_select = "SELECT userid_int, username, pay_startdate, pay_enddate, ot_hh_o, ot_hh_o_PM, rate_ot_offday_factor, Rate_Work, income_offday_ot, hiredate, dept, designation from " . $this->Ini->nm_tabela; 
     } 
     else 
     { 
         $nmgp_select = "SELECT userid_int, username, pay_startdate, pay_enddate, ot_hh_o, ot_hh_o_PM, rate_ot_offday_factor, Rate_Work, income_offday_ot, hiredate, dept, designation from " . $this->Ini->nm_tabela; 
     } 
     $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['where_pesq']; 
     $campos_order = "";
     foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['SC_Gb_Free_sql'] as $cmp_var => $resto)
     {
         foreach ($resto as $SC_Sql_col => $SC_Sql_order)
         {
             $format       = $this->Ini->Get_Gb_date_format('sc_free_group_by', $cmp_var);
             $campos_order = $this->Ini->Get_date_order_groupby($SC_Sql_col, $SC_Sql_order, $format, $campos_order);
         }
     }
     $nmgp_order_by = " order by " . $campos_order;
     $nmgp_select .= $nmgp_order_by; 
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
     $rs_res = $this->Db->Execute($nmgp_select) ; 
     if ($rs_res === false && !$rs_graf->EOF) 
     { 
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
// 
     if ($nm_tipo != "resumo") 
     {  
          $this->nm_acum_res_unit($rs_res, $nm_tipo);
     }  
     else  
     {  
         while (!$rs_res->EOF) 
         {  
                $this->nm_acum_res_unit($rs_res, "resumo");
                $rs_res->MoveNext();
         }  
     }  
     $rs_res->Close();
   }
// 
   function nm_acum_res_unit($rs_res, $nm_tipo="resumo")
   {
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca']))
            { 
                $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_income_offday_ot']['campos_busca'];
                if ($_SESSION['scriptcase']['charset'] != "UTF-8")
                {
                    $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
                }
                $this->userid_int = (isset($Busca_temp['userid_int'])) ? $Busca_temp['userid_int'] : ""; 
                $tmp_pos = (is_string($this->userid_int)) ? strpos($this->userid_int, "##@@") : false;
                if ($tmp_pos !== false && !is_array($this->userid_int))
                {
                   $this->userid_int = substr($this->userid_int, 0, $tmp_pos);
                }
                $this->username = (isset($Busca_temp['username'])) ? $Busca_temp['username'] : ""; 
                $tmp_pos = (is_string($this->username)) ? strpos($this->username, "##@@") : false;
                if ($tmp_pos !== false && !is_array($this->username))
                {
                   $this->username = substr($this->username, 0, $tmp_pos);
                }
                $this->designation = (isset($Busca_temp['designation'])) ? $Busca_temp['designation'] : ""; 
                $tmp_pos = (is_string($this->designation)) ? strpos($this->designation, "##@@") : false;
                if ($tmp_pos !== false && !is_array($this->designation))
                {
                   $this->designation = substr($this->designation, 0, $tmp_pos);
                }
                $this->dept = (isset($Busca_temp['dept'])) ? $Busca_temp['dept'] : ""; 
                $tmp_pos = (is_string($this->dept)) ? strpos($this->dept, "##@@") : false;
                if ($tmp_pos !== false && !is_array($this->dept))
                {
                   $this->dept = substr($this->dept, 0, $tmp_pos);
                }
            } 
            $this->userid_int = $rs_res->fields[0] ;  
            $this->username = $rs_res->fields[1] ;  
            $this->pay_startdate = $rs_res->fields[2] ;  
            $this->pay_enddate = $rs_res->fields[3] ;  
            $this->ot_hh_o = $rs_res->fields[4] ;  
            $this->ot_hh_o_pm = $rs_res->fields[5] ;  
            $this->rate_ot_offday_factor = $rs_res->fields[6] ;  
            $this->rate_work = $rs_res->fields[7] ;  
            $this->rate_work =  str_replace(",", ".", $this->rate_work);
            $this->income_offday_ot = $rs_res->fields[8] ;  
            $this->income_offday_ot =  str_replace(",", ".", $this->income_offday_ot);
            $this->hiredate = $rs_res->fields[9] ;  
            $this->dept = $rs_res->fields[10] ;  
            $this->designation = $rs_res->fields[11] ;  
            $this->dept_orig = $this->dept;
            if ($nm_tipo == "resumo")
            {
                $this->adiciona_registro($this->ot_hh_o, $this->ot_hh_o_pm, $this->income_offday_ot, $this->dept, $this->dept_orig);
            }
   }
//
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($tam_campo >= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 
   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
function calculate_income_offday_ot()
{
$_SESSION['scriptcase']['grid_income_offday_ot']['contr_erro'] = 'on';
  


$SQL04 = 
"
UPDATE tbl_salary
SET income_offday_ot = 
    (Rate_Work * rate_ot_offday_factor * rate_ot_offday_factor * ot_hh_o) +
    (Rate_Work * rate_ot_offday_factor * rate_ot_offday_factor * rate_ot_offday_factor * ot_hh_o_PM)
";


     $nm_select = $SQL04; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['grid_income_offday_ot']['contr_erro'] = 'off';
}
}
?>
