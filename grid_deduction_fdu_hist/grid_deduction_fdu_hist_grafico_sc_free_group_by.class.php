<?php

class grid_deduction_fdu_hist_grafico
{
    const GROUPBY_ORIGINAL = 1;
    const GROUPBY_COMPARISON = 2;
    const GROUPBY_PERC_CHANGE = 3;
    const CHART_MODE_SYNTHETIC = 1;
    const CHART_MODE_ANALYTIC = 2;
    var $chartTheme;

   var $Db;
   var $Ini;
   var $Erro;
   var $Lookup;

   var $nm_data;
   var $total;
   var $array_datay_geral;
   var $array_label_geral;
   var $array_datay;
   var $array_label;
   var $campo;
   var $campo_val;
   var $comando;
   var $label;
   var $list_titulo;
   var $max_size_datay;
   var $max_size_label;
   var $total_datay;
   var $nivel;
   var $titulo;
   var $Decimais;
   var $sc_proc_grid; 
   var $sc_graf_sint = false;
   var $graf_cor_fundo;
   var $graf_cor_margens;
   var $graf_cor_label;
   var $graf_cor_valores;
   var $graf_tipo_marcas;
   var $NM_tit_val;
   var $NM_ind_val;

   var $reload_as_analytic = false;

   //---- 
   function __construct()
   {
      $this->nm_data = new nm_data("en_us");
   }

	function generateChartImage($chartKey) {
		$this->monta_grafico($chartKey, 'pdf');
	} // generateChartImage

    function info_initializeChart($chartMd5, $isExport = false)
    {
        $this->info_initializeInfo($chartMd5);

        $this->info_loadMd5Info($chartMd5);
        $this->info_loadSessionInfo($chartMd5);
        $this->info_setSeriesMode();
        $this->info_setChartItemsLimit();
        $this->info_createFusionChartsData($isExport);

        $this->info_saveFusionChartsJson();
    }

    function info_initializeInfo($chartMd5)
    {
        $charset = <<<SCEOT
<META http-equiv="Content-Type" content="text/html; charset={$_SESSION['scriptcase']['charset_html']}" />
SCEOT;

        $this->SC_APP_info = [
            'chart' => [
                'page_title' => '',
                'chart_title' => "",
                'fill_empty_caption' => false,
                'available_types' => ['Bar', 'Pie', 'Line', 'Area'],
                'available_comparison_types' => ['Bar', 'Line', 'Area'],
                'default_type' => 'Bar',
                'available_modes' => ['synthetic', 'analytic'],
                'default_mode' => 'synthetic',
                'json_filename' => "sc_fc_grid_deduction_fdu_hist_{$chartMd5}.json",
                'json_base_dir' => $this->Ini->root . $this->Ini->path_imag_temp . '/',
                'json_base_url' => $this->Ini->path_imag_temp . '/',
                'fusioncharts_fix' => '',
            ],
            'types' => [
                'bar' => [
                    'orientation' => 'Vertical',
                    'dimension' => '3d',
                    'plotSpacePercent' => '',
                    'rotateValues' => '1',
                    'placeValuesInside' => '1',
                    'stacking' => false,
                    'stack100Percent' => '0',
                    'seriesMode' => 'Normal',
                    'isScroll' => 'false',
                    'isOverlapped' => 'false',
                ],
                'pie' => [
                    'format' => 'Pie',
                    'dimension' => '3d',
                    'order' => 'off',
                    'showPercentValues' => false,
                    'displayValuesException' => true,
                ],
                'line' => [
                    'format' => 'Line',
                    'seriesMode' => 'Normal',
                    'isScroll' => 'false',
                    'isZoom' => 'false',
                ],
                'area' => [
                    'format' => 'Area',
                    'stacking' => false,
                    'isScroll' => 'false',
                ],
            ],
            'options' => [
                'md5' => $chartMd5,
                'charset' => $charset,
                'favicon' => 'sys__NM__ico__NM__favicon (2).ico',
                'summary_css' => isset($_POST['summary_css']) && '' != $_POST['summary_css'] ? $_POST['summary_css'] : '',
                'use_fontawesome' => true,
                'chart_same_page' => false,
                'tooltip_expanded' => true,
                'formatNumberScale' => false,
                'legendPosition' => '',
                'setAdaptiveYMin' => true,
                'showValues' => false,
                'hasTrendline' => false,
                'trendlineIsZone' => false,
                'trendlineType' => '',
                'trendlineStart' => 0,
                'trendlineEnd' => 0,
            ],
            'css' => [
                'chart_page' => 'scGridPage',
            ],
        ];
    }

    function info_initializeData()
    {
        $this->SC_APP_data = [
            'type' => '',
            'order' => '',
            'width' => '800',
            'height' => '600',
            'phantom_width' => '800',
            'phantom_height' => '600',
            'data_mode' => '',
            'series_mode' => '',
            'md5_data' => [],
            'chart_id' => 'id_chart_' . mt_rand(1, 1000),
            'chart_div' => 'id_div_' . mt_rand(1, 1000),
            'chart_dataFormat' => 'jsonurl',
            'limit_chart_items' => '',
            'filtered_chart_items' => [],
            'fusioncharts_license' => [],
            'fusioncharts_javascript' => [],
            'fusioncharts_json' => [],
        ];

        if ($this->aux_isResponsive()) {
            $this->SC_APP_data['width'] = '100%';
            $this->SC_APP_data['height'] = '85%';
        } elseif ($this->aux_isMobile()) {
            $this->SC_APP_data['width'] = '100%';
        }
    }

    function info_loadMd5Info($chartMd5)
    {
        $chartInfo = $this->aux_getChartInfoType();

        $this->SC_APP_data['md5_data'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] [$chartInfo] [$chartMd5];

        $pageTitle = $this->aux_isUtf8() ? $this->aux_getMetricLabel($this->SC_APP_data['md5_data'] ['metric']) : sc_convert_encoding($this->aux_getMetricLabel($this->SC_APP_data['md5_data'] ['metric']), $_SESSION['scriptcase'] ['charset'], 'UTF-8');

        $this->SC_APP_info['chart'] ['page_title'] = $pageTitle;
        $this->SC_APP_data['type'] = $this->SC_APP_info['chart'] ['default_type'];
        $this->SC_APP_data['data_mode'] = $this->SC_APP_info['chart'] ['default_mode'];
    }

    function info_loadSessionInfo($chartMd5)
    {
        $this->SC_APP_data['type'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'];
        $this->SC_APP_data['data_mode'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['graf_opc_atual'];

        $this->SC_APP_data['width'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_larg'];
        $this->SC_APP_data['height'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_alt'];

        $this->SC_APP_data['order'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['graf_order'];

        $this->SC_APP_info['types'] ['area'] ['format'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_forma'];
        $this->SC_APP_info['types'] ['area'] ['stacking'] = 'Off' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_empil'];
        $this->SC_APP_info['types'] ['area'] ['isScroll'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_is_scroll'];

        $this->SC_APP_info['types'] ['bar'] ['orientation'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'];
        $this->SC_APP_info['types'] ['bar'] ['dimension'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'];
        $this->SC_APP_info['types'] ['bar'] ['stacking'] = 'Off' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'];
        $this->SC_APP_info['types'] ['bar'] ['stack100Percent'] = 'Percent' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] ? '1' : '0';
        $this->SC_APP_info['types'] ['bar'] ['seriesMode'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_agrup'];
        $this->SC_APP_info['types'] ['bar'] ['isScroll'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'];
        $this->SC_APP_info['types'] ['bar'] ['isOverlapped'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'];

        $this->SC_APP_info['types'] ['funnel'] ['dimension'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_funil_dimen'];

        $this->SC_APP_info['types'] ['gauge'] ['format'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_gauge_forma'];

        $this->SC_APP_info['types'] ['line'] ['format'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_forma'];
        $this->SC_APP_info['types'] ['line'] ['seriesMode'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_agrup'];
        $this->SC_APP_info['types'] ['line'] ['isScroll'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_scroll'];
        $this->SC_APP_info['types'] ['line'] ['isZoom'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_zoom'];

        $this->SC_APP_info['types'] ['pie'] ['format'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_forma'];
        $this->SC_APP_info['types'] ['pie'] ['dimension'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_dimen'];
        $this->SC_APP_info['types'] ['pie'] ['order'] = strtolower($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_orden']);
        $this->SC_APP_info['types'] ['pie'] ['showPercentValues'] = 'Percent' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_valor'];

        $this->SC_APP_info['types'] ['pyramid'] ['dimension'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pyram_dimen'];
        $this->SC_APP_info['types'] ['pyramid'] ['showPercentValues'] = 'Percent' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pyram_valor'];
        $this->SC_APP_info['types'] ['pyramid'] ['isSliced'] = 'S' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pyram_forma'];

        $this->SC_APP_info['types'] ['combination'] ['dimension'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_combi_dimen'];

        if ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_has_enable_scroll']) {
            $this->SC_APP_info['types'] ['area'] ['isScroll'] = 'S' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_enable_scroll'];
            $this->SC_APP_info['types'] ['bar'] ['isScroll'] = 'S' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_enable_scroll'];
            $this->SC_APP_info['types'] ['line'] ['isScroll'] = 'S' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_enable_scroll'];
        } else {
            $this->SC_APP_info['types'] ['area'] ['isScroll'] = false;
            $this->SC_APP_info['types'] ['bar'] ['isScroll'] = false;
            $this->SC_APP_info['types'] ['line'] ['isScroll'] = false;
        }
    }

    function info_setSeriesMode()
    {
        switch ($this->SC_APP_data['type']) {
            case 'Area':
            case 'Bar':
            case 'Line':
                $chatAppDisplaySerie = false;

                if ($chatAppDisplaySerie) {
                    $this->SC_APP_data['data_mode'] = self::CHART_MODE_ANALYTIC;
                    $this->SC_APP_data['series_mode'] = 'set';
                } elseif ('Series' == $this->SC_APP_info['types'] ['bar'] ['seriesMode']) {
                    $this->SC_APP_data['series_mode'] = 'serie';
                } else {
                    $this->SC_APP_data['series_mode'] = 'set';
                }
                break;

            default:
                $this->SC_APP_data['series_mode'] = 'set';
                break;
        }
    }

    function info_setChartItemsLimit()
    {
        if ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['has_limit_chart_items']) {
            if ('' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['limit_chart_items'] && '0' != $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['limit_chart_items']) {
                $this->SC_APP_data['limit_chart_items'] = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['limit_chart_items'];
            } elseif (isset($this->SC_APP_data['md5_data'] ['options'] ['limit_chart_items']) && '' != $this->SC_APP_data['md5_data'] ['options'] ['limit_chart_items']) {
                $this->SC_APP_data['limit_chart_items'] = $this->SC_APP_data['md5_data'] ['options'] ['limit_chart_items'];
            }
        }
    }

    function info_createFusionChartsData($isExport)
    {
        if ($this->SC_APP_data['md5_data'] ['options'] ['is_grand_total']) {
            $this->SC_APP_info['options'] ['tooltip_expanded'] = false;
        }

        $this->info_createFusionChartsData_json($isExport);
        $this->info_createFusionChartsData_javascript();
    }

    function info_createFusionChartsData_javascript()
    {
        $this->SC_APP_data['fusioncharts_javascript'] ['type'] = $this->aux_getFusionChartsRenderer();
        $this->SC_APP_data['fusioncharts_javascript'] ['width'] = $this->SC_APP_data['width'];
        $this->SC_APP_data['fusioncharts_javascript'] ['height'] = $this->SC_APP_data['height'];
        $this->SC_APP_data['fusioncharts_javascript'] ['dataFormat'] = 'jsonurl';
        $this->SC_APP_data['fusioncharts_javascript'] ['dataSource'] = $this->SC_APP_info['chart'] ['json_base_url'] . $this->SC_APP_info['chart'] ['json_filename'];

        if ($this->aux_isResponsive()) {
            $this->SC_APP_data['fusioncharts_javascript'] ['width'] = '100%';
            $this->SC_APP_data['fusioncharts_javascript'] ['height'] = '85%';
        } elseif ($this->aux_isMobile()) {
            $this->SC_APP_data['fusioncharts_javascript'] ['width'] = '100%';
        }
    }

    function info_createFusionChartsData_json($isExport)
    {
        $this->info_createFusionChartsData_json_chart($isExport);

        switch ($this->SC_APP_data['type']) {
            case 'Area':
                $this->info_createFusionChartsData_json_type_area();
                break;
            case 'Bar':
                $this->info_createFusionChartsData_json_type_bar();
                break;
            case 'Chord':
                $this->info_createFusionChartsData_json_type_chord();
                break;
            case 'Combination':
                $this->info_createFusionChartsData_json_type_combination();
                break;
            case 'Funnel':
                $this->info_createFusionChartsData_json_type_funnel();
                break;
            case 'Gauge':
                $this->info_createFusionChartsData_json_type_gauge();
                break;
            case 'Heatmap':
                $this->info_createFusionChartsData_json_type_heatmap();
                break;
            case 'Line':
                $this->info_createFusionChartsData_json_type_line();
                break;
            case 'Pie':
                $this->info_createFusionChartsData_json_type_pie();
                break;
            case 'Pyramid':
                $this->info_createFusionChartsData_json_type_pyramid();
                break;
            case 'Radar':
                $this->info_createFusionChartsData_json_type_radar();
                break;
            case 'Sankey':
                $this->info_createFusionChartsData_json_type_sankey();
                break;
            case 'Sunburst':
                $this->info_createFusionChartsData_json_type_sunburst();
                break;
            case 'Treemap':
                $this->info_createFusionChartsData_json_type_treemap();
                break;
        }

        $this->info_createFusionChartsData_json_data_series();

        $this->info_createFusionChartsData_json_data_order();
        $this->info_createFusionChartsData_json_data_trendline();
    }

    function info_createFusionChartsData_json_chart($isExport)
    {
        $this->SC_APP_data['fusioncharts_json'] ['sc'] ['chart_md5'] = $this->SC_APP_info['options'] ['md5'];
        $this->SC_APP_data['fusioncharts_json'] ['sc'] ['chart_title'] = $this->aux_getMetricLabel($this->SC_APP_data['md5_data'] ['metric']);

        $chartCaption = '';
        if ('' != $this->SC_APP_info['chart'] ['chart_title']) {
            $chartCaption = $this->SC_APP_info['chart'] ['chart_title'];
        } elseif ($this->SC_APP_info['chart'] ['fill_empty_caption']) {
            $chartCaption = $this->aux_getMetricLabel($this->SC_APP_data['md5_data'] ['metric']);
        }

        $this->SC_APP_data['fusioncharts_json'] ['chart'] = [
            'caption' => $chartCaption,
            'subCaption' => $this->info_createFusionChartsData_json_chart_subtitle(),
            'xAxisName' => $this->SC_APP_data['md5_data'] ['dimension'] ['label'],
            'yAxisName' => $this->aux_getMetricLabel($this->SC_APP_data['md5_data'] ['metric']),
            'chartLeftMargin' => '10',
            'chartTopMargin' => '10',
            'chartRightMargin' => '10',
            'plotHighlightEffect' => 'fadeout',
            'showValues' => $this->SC_APP_info['options'] ['showValues'] ? '1' : '0',
        ];

        if ($this->SC_APP_info['options'] ['formatNumberScale']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['formatNumberScale'] = '1';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['numberScaleValue'] = '1000,1000,1000,1000';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['numberScaleUnit']  = 'K,M,G,T';
        } else {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['formatNumberScale'] = '0';
        }

        if ($this->SC_APP_info['options'] ['setAdaptiveYMin']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['setAdaptiveYMin'] = '1';
        }

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLegend'] = '1';

        $this->info_createFusionChartsData_json_chart_format();
        $this->info_createFusionChartsData_json_chart_theme();
        $this->info_createFusionChartsData_json_chart_export($isExport);

        if ('below' == $this->SC_APP_info['options'] ['legendPosition']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['legendPosition'] = 'bottom';
        } elseif ('right' == $this->SC_APP_info['options'] ['legendPosition']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['legendPosition'] = 'right';
        } elseif ('hide' == $this->SC_APP_info['options'] ['legendPosition']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLegend'] = '0';
        }

        if ($isExport) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['animation'] = '0';
        }
    }

    function info_createFusionChartsData_json_chart_export($isExport)
    {
        if ($isExport) {
            return;
        }
    }

    function info_createFusionChartsData_json_chart_format()
    {
        $formatFunction = $this->SC_APP_data['md5_data'] ['metric'] [0] ['format'];

        if (!$formatFunction) {
            return;
        }

        $formatRules = $this->$formatFunction();
        foreach ($formatRules as $formatIndex => $formatValue) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] [$formatIndex] = $formatValue;
        }
    }

    function info_createFusionChartsData_json_chart_subtitle()
    {
        $parameters = [];
        $lastParameter = '';

        foreach ($this->SC_APP_data['md5_data'] ['parameters'] as $parameterInfo) {
            $lastParameter = "{$parameterInfo['field_label']} = {$parameterInfo['label']}";
            $parameters[] = $lastParameter;
        }

        $this->SC_APP_data['fusioncharts_json'] ['sc'] ['chart_subtitle'] = $lastParameter;

        return implode(' :: ', $parameters);
    }

    function info_createFusionChartsData_json_chart_theme()
    {
        $this->chartTheme = $this->load_chart_theme();
        $this->chartGradient = ['FF4545', 'FF9C73', 'FBD288', 'FCF596', '62B58F'];

        foreach ($this->chartTheme as $property => $value) {
            if ('' != $value) {
                if ('gradientColors' == $property) {
                    if ('' != $value) {
                        $gradientColors = explode(',', $value);
                        $this->chartGradient = [];
                        foreach ($gradientColors as $thisGradientColor) {
                            if ('#' == substr($thisGradientColor, 0, 1)) {
                                $thisGradientColor = substr($thisGradientColor, 1);
                            }
                            $this->chartGradient[] = $thisGradientColor;
                        }
                    }
                } else {
                    $this->SC_APP_data['fusioncharts_json'] ['chart'] [$property] = $value; 
                }
            }
        }
    }

    function info_createFusionChartsData_json_type_area()
    {
    }

    function info_createFusionChartsData_json_type_chord()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['nodeLabelPosition'] = 'outside';
    }

    function info_createFusionChartsData_json_type_combination()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['rotateValues'] = $this->SC_APP_info['types'] ['bar'] ['rotateValues'];
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['placeValuesInside'] = $this->SC_APP_info['types'] ['bar'] ['placeValuesInside'];
    }

    function info_createFusionChartsData_json_type_bar()
    {
        if ('' != $this->SC_APP_info['types'] ['bar'] ['plotSpacePercent']) {
            if (20 > $this->SC_APP_info['types'] ['bar'] ['plotSpacePercent']) {
                $this->SC_APP_data['fusioncharts_json'] ['chart'] ['plotSpacePercent'] = '20';
            } elseif (80 < $this->SC_APP_info['types'] ['bar'] ['plotSpacePercent']) {
                $this->SC_APP_data['fusioncharts_json'] ['chart'] ['plotSpacePercent'] = '80';
            } else {
                $this->SC_APP_data['fusioncharts_json'] ['chart'] ['plotSpacePercent'] = $this->SC_APP_info['types'] ['bar'] ['plotSpacePercent'];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['rotateValues'] = $this->SC_APP_info['types'] ['bar'] ['rotateValues'];
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['placeValuesInside'] = $this->SC_APP_info['types'] ['bar'] ['placeValuesInside'];
        if (1 == $this->SC_APP_info['types'] ['bar'] ['stack100Percent'] && $this->aux_isMultiSeries()) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['stack100Percent'] = '1';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showPercentValues'] = '0';
        }
    }

    function info_createFusionChartsData_json_type_funnel()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['useSameSlantAngle'] = '1';
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['isHollow'] = '0';
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLabels'] = '0';

        if ($this->SC_APP_info['types'] ['funnel'] ['displayValuesException']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showValues'] = '0';
        }

        if ('2d' == $this->SC_APP_info['types'] ['funnel'] ['dimension']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['is2D'] = '1';
        }

        if ('0' == $this->SC_APP_info['types'] ['funnel'] ['streamlinedData']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['streamlinedData'] = '0';
        }
    }

    function info_createFusionChartsData_json_type_gauge()
    {
        if ('Circular' == $this->SC_APP_info['types'] ['gauge'] ['format']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['gaugeStartAngle'] = '180';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['gaugeEndAngle'] = '-180';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['lowerLimitDisplay'] = ' ';
        }

        if ($this->SC_APP_info['types'] ['gauge'] ['show_ticks']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['majorTMNumber'] = '9';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['majorTMHeight'] = '15';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['majorTMThickness'] = '2';

            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['minorTMNumber'] = '4';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['minorTMHeight'] = '10';
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['minorTMThickness'] = '1';
        }

        if ($this->SC_APP_info['types'] ['gauge'] ['use_interval']) {
            $this->SC_APP_data['fusioncharts_json'] ['colorRange'] = [
                'color' => $this->SC_APP_info['types'] ['gauge'] ['interval_colors']
            ];
        }
    }

    function info_createFusionChartsData_json_type_heatmap()
    {
        $this->SC_APP_data['fusioncharts_json'] ['colorrange'] ['gradient'] = '1';
        $this->SC_APP_data['fusioncharts_json'] ['colorrange'] ['startlabel'] = '';
        $this->SC_APP_data['fusioncharts_json'] ['colorrange'] ['endlabel'] = '';

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showplotborder'] = '1';
    }

    function info_createFusionChartsData_json_type_line()
    {
    }

    function info_createFusionChartsData_json_type_pie()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['use3DLighting'] = '0';

        if ($this->SC_APP_info['types'] ['pie'] ['displayValuesException']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showValues'] = '0';
        }

        if ($this->SC_APP_info['types'] ['pie'] ['showPercentValues']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showPercentValues'] = '1';
        } else {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showPercentValues'] = '0';
        }
    }

    function info_createFusionChartsData_json_type_pyramid()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLabels'] = '0';

        if ($this->SC_APP_info['types'] ['pyramid'] ['displayValuesException']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showValues'] = '0';
        }

        if ('2d' == $this->SC_APP_info['types'] ['pyramid'] ['dimension']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['is2D'] = '1';
        }

        if ($this->SC_APP_info['types'] ['pyramid'] ['showPercentValues']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showPercentValues'] = '1';
        } else {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showPercentValues'] = '0';
        }

        if ($this->SC_APP_info['types'] ['pyramid'] ['isSliced']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['isSliced'] = '1';
        } else {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['isSliced'] = '0';
        }
    }

    function info_createFusionChartsData_json_type_radar()
    {
    }

    function info_createFusionChartsData_json_type_sankey()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['linkColor'] = 'blend';
    }

    function info_createFusionChartsData_json_type_sunburst()
    {
    }

    function info_createFusionChartsData_json_type_treemap()
    {
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['algorithm'] = 'squarified';

        if (isset($this->SC_APP_data['fusioncharts_json'] ['chart'] ['labelFontSize']) && '' != $this->SC_APP_data['fusioncharts_json'] ['chart'] ['labelFontSize']) {
            $this->SC_APP_data['fusioncharts_json'] ['chart'] ['parentLabelLineHeight'] = 4 + $this->SC_APP_data['fusioncharts_json'] ['chart'] ['labelFontSize'];
        }
    }

    function info_createFusionChartsData_json_data_series()
    {
        if (0 < $this->SC_APP_data['limit_chart_items']) {
            $this->aux_filterChartItems();
        }

        $this->aux_setFusionchartsFix();

        if ($this->SC_APP_data['md5_data'] ['options'] ['is_comparison']) {
            $this->info_createFusionChartsData_json_data_comparisonSeries();
        } elseif ('Line' == $this->SC_APP_data['type'] && 'Step' == $this->SC_APP_info['types'] ['line'] ['format'] && !$this->aux_isMultiSeries()) {
            $this->info_createFusionChartsData_json_data_singleSerieCategorySeries();
        } elseif ('Bar' == $this->SC_APP_data['type'] && $this->SC_APP_info['types'] ['bar'] ['isScroll'] && !$this->aux_isMultiSeries()) {
            $this->info_createFusionChartsData_json_data_singleSerieCategorySeries();
        } elseif ('Line' == $this->SC_APP_data['type'] && $this->SC_APP_info['types'] ['line'] ['isScroll'] && !$this->aux_isMultiSeries()) {
            $this->info_createFusionChartsData_json_data_singleSerieCategorySeries();
        } elseif ('Line' == $this->SC_APP_data['type'] && $this->SC_APP_info['types'] ['line'] ['isZoom'] && !$this->aux_isMultiSeries()) {
            $this->info_createFusionChartsData_json_data_singleSerieCategorySeries();
        } elseif ('Area' == $this->SC_APP_data['type'] && $this->SC_APP_info['types'] ['area'] ['isScroll'] && !$this->aux_isMultiSeries()) {
            $this->info_createFusionChartsData_json_data_singleSerieCategorySeries();
        } elseif ('Heatmap' == $this->SC_APP_data['type']) {
            $this->info_createFusionChartsData_json_data_heatMapSeries();
        } elseif ('Treemap' == $this->SC_APP_data['type']) {
            $this->info_createFusionChartsData_json_data_treeMapSeries();
        } elseif ('Chord' == $this->SC_APP_data['type']) {
            $this->info_createFusionChartsData_json_data_chordSeries();
        } elseif ('Sankey' == $this->SC_APP_data['type']) {
            $this->info_createFusionChartsData_json_data_sankeySeries();
        } elseif ('Sunburst' == $this->SC_APP_data['type']) {
            $this->info_createFusionChartsData_json_data_sunburstSeries();
        } elseif ('Gauge' == $this->SC_APP_data['type']) {
            $this->info_createFusionChartsData_json_data_gaugeSeries();
        } elseif ('Scatter' == $this->SC_APP_data['type']) {
            $this->info_createFusionChartsData_json_data_scatterSeries();
        } elseif ('Bubble' == $this->SC_APP_data['type']) {
            $this->info_createFusionChartsData_json_data_bubbleSeries();
        } elseif ('Combination' == $this->SC_APP_data['type']) {
            $this->info_createFusionChartsData_json_data_combinationSeries();
        } elseif ('Radar' == $this->SC_APP_data['type']) {
            if (self::CHART_MODE_SYNTHETIC == $this->SC_APP_data['data_mode']) {
                $this->info_createFusionChartsData_json_data_singleSerieCategorySeries();
            } else {
                $this->info_createFusionChartsData_json_data_multiSeries();
            }
        } elseif ($this->aux_isMultiSeries()) {
            $this->info_createFusionChartsData_json_data_multiSeries();
        } else {
            $this->info_createFusionChartsData_json_data_singleSeries();
        }
    }

    function info_createFusionChartsData_json_data_singleSeries()
    {
        $this->SC_APP_data['fusioncharts_json'] ['data'] = [];

        $displayValues = [];
        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_display_values'] as $thisDisplayValue) {
            $displayValues[] = $thisDisplayValue;
        }
        if (isset($displayValues[0])) {
            if (false === $displayValues[0]) {
                $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showValues'] = '0';
            } elseif ($displayValues[0]) {
                $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showValues'] = '1';
            }
        }

        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $thisData = [
                    'label' => $this->SC_APP_info['chart'] ['fusioncharts_fix'] . $plotInfo['label'],
                    'value' => $plotInfo['value'],
                ];

                if ('none' != $this->SC_APP_data['md5_data'] ['options'] ['chart_link'] && '' != $this->SC_APP_data['md5_data'] ['dimension'] ['next']) {
                    $thisData['link'] = 'j-chartDrillDown-' . $this->aux_getChartLink($this->SC_APP_data['md5_data'] ['dimension_list'], $this->SC_APP_data['md5_data'] ['metric'], $this->SC_APP_data['md5_data'] ['parameters'], $plotInfo['dimension_value']);
                }

                if ($this->SC_APP_info['options'] ['tooltip_expanded']) {
                    $metricLabel = $this->aux_getMetricLabel($this->SC_APP_data['md5_data'] ['metric']);

                    $displayValue = '$dataValue';
                    if ('Pie' == $this->SC_APP_data['type'] && $this->SC_APP_info['types'] ['pie'] ['showPercentValues']) {
                        $displayValue = '$percentValue';
                    } elseif ('Pyramid' == $this->SC_APP_data['type'] && $this->SC_APP_info['types'] ['pyramid'] ['showPercentValues']) {
                        $displayValue = '$percentValue';
                    } elseif ('Pyramid' == $this->SC_APP_data['type'] && !$this->SC_APP_info['types'] ['pyramid'] ['showPercentValues']) {
                        $displayValue = '$value';
                    } elseif ('Funnel' == $this->SC_APP_data['type']) {
                        $displayValue = '$value';
                    }

                    $thisData['tooltext'] = "<b>{$this->SC_APP_data['md5_data'] ['dimension'] ['label']}</b>: {$plotInfo['label']}";
                    $thisData['tooltext'] .= "<br>";
                    $thisData['tooltext'] .= "<b>{$metricLabel}</b>: " . $displayValue;
                }

                $this->SC_APP_data['fusioncharts_json'] ['data'] [] = $thisData;
            }
        }
    }

    function info_createFusionChartsData_json_data_multiSeries()
    {
        $this->SC_APP_data['fusioncharts_json'] ['categories'] = [];
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] = [];

        $category = [];
        foreach ($this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['categories'] as $categoryLabel) {
            $addItem = true;

            if ('set' == $this->SC_APP_data['series_mode'] && !empty($this->SC_APP_data['filtered_chart_items']) && !in_array($categoryLabel, $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $category[] = [
                    'label' => $this->SC_APP_info['chart'] ['fusioncharts_fix'] . $categoryLabel,
                ];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['categories'] [] = [
            'category' => $category,
        ];

        $displayValues = [];
        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_display_values'] as $thisDisplayValue) {
            $displayValues[] = $thisDisplayValue;
        }

        if ('set' == $this->SC_APP_data['series_mode']) {
            $seriesCount = 0;

            foreach ($this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['dataset'] as $seriesValue => $seriesInfo) {
                $data = [];

                foreach ($this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['categories'] as $categoryIndex => $categoryLabel) {
                    $plotValue = $categoryIndex;
                    if (isset($seriesInfo['data'] [$categoryIndex])) {
                        $plotInfo = $seriesInfo['data'] [$categoryIndex];
                    } else {
                        $plotInfo = [
                            'label' => $categoryLabel,
                            'dimension_value' => $categoryIndex,
                            'value' => 0,
                        ];
                    }

                    $addItem = true;

                    if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                        $addItem = false;
                    }

                    if ($addItem) {
                        $thisData = [
                            'value' => $plotInfo['value'],
                        ];

                        if ('none' != $this->SC_APP_data['md5_data'] ['options'] ['chart_link'] && '' != $this->SC_APP_data['md5_data'] ['dimension'] ['next']) {
                            $thisData['link'] = 'j-chartDrillDown-' . $this->aux_getChartLink($this->SC_APP_data['md5_data'] ['dimension_list'], $this->SC_APP_data['md5_data'] ['metric'], $this->SC_APP_data['md5_data'] ['parameters'], $plotInfo['dimension_value']);
                        }

                        if ($this->SC_APP_info['options'] ['tooltip_expanded']) {
                            if ($this->SC_APP_data['md5_data'] ['options'] ['is_multimetric']) {
                                $thisData['tooltext'] = "<br><b>{$this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['field_name'] ['x_axys']}</b>: {$plotValue}";
                                $thisData['tooltext'] .= "<br>";
                                $thisData['tooltext'] .= "<b>{$seriesInfo['label']}</b>: \$dataValue<br>";
                            } else {
                                $metricLabel = $this->aux_getMetricLabel($this->SC_APP_data['md5_data'] ['metric']);
    
                                $thisData['tooltext'] = "<br><b>{$this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['field_name'] ['x_axys']}</b>";
                                $thisData['tooltext'] .= "<br>";
                                $thisData['tooltext'] .= "<b>{$plotInfo['label']}</b>";
                                $thisData['tooltext'] .= "<br>";
                                $thisData['tooltext'] .= "<b>{$this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['field_name'] ['legend']}</b>: {$seriesInfo['label']}";
                                $thisData['tooltext'] .= "<br>";
                                $thisData['tooltext'] .= "<b>{$metricLabel}</b>: {$plotInfo['value']}<br>";
                            }
                        }

                        $data[] = $thisData;
                    }
                }

                $dataSet = [
                    'seriesName' => $seriesInfo['label'],
                    'data' => $data,
                ];

                if (isset($displayValues[$seriesCount])) {
                    if (false === $displayValues[$seriesCount]) {
                        $dataSet['showValues'] = '0';
                    } elseif ($displayValues[$seriesCount]) {
                        $dataSet['showValues'] = '1';
                    }
                }

                $this->SC_APP_data['fusioncharts_json'] ['dataset'] [] = $dataSet;

                $seriesCount++;
            }
        } else {
            foreach ($this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['dataset'] as $seriesValue => $seriesInfo) {
                $data = [];

                foreach ($seriesInfo['data'] as $plotValue => $plotInfo) {
                    $addItem = true;

                    if ('serie' == $this->SC_APP_data['series_mode'] && !empty($this->SC_APP_data['filtered_chart_items']) && !in_array($seriesInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                        $addItem = false;
                    }

                    if ($addItem) {
                        $thisData = [
                            'value' => $plotInfo['value'],
                        ];

                        if ('none' != $this->SC_APP_data['md5_data'] ['options'] ['chart_link'] && '' != $this->SC_APP_data['md5_data'] ['dimension'] ['next']) {
                            $thisData['link'] = 'j-chartDrillDown-' . $this->aux_getChartLink($this->SC_APP_data['md5_data'] ['dimension_list'], $this->SC_APP_data['md5_data'] ['metric'], $this->SC_APP_data['md5_data'] ['parameters'], $plotInfo['dimension_value']);
                        }

                        if ($this->SC_APP_info['options'] ['tooltip_expanded']) {
                            if ($this->SC_APP_data['md5_data'] ['options'] ['is_multimetric']) {
                                $thisData['tooltext'] = "<b>{$this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['field_name'] ['x_axys']}</b>: {$plotValue}";
                                $thisData['tooltext'] .= "<br>";
                                $thisData['tooltext'] .= "<b>{$seriesInfo['label']}</b>: \$dataValue";
                            } else {
                                $metricLabel = $this->aux_getMetricLabel($this->SC_APP_data['md5_data'] ['metric']);
    
                                $thisData['tooltext'] = "<b>{$this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['field_name'] ['x_axys']}</b>";
                                $thisData['tooltext'] .= "<br>";
                                $thisData['tooltext'] .= "<b>{$plotInfo['label']}</b>";
                                $thisData['tooltext'] .= "<br><br>";
                                $thisData['tooltext'] .= "<b>{$this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['field_name'] ['legend']}</b>: {$seriesInfo['label']}";
                                $thisData['tooltext'] .= "<br>";
                                $thisData['tooltext'] .= "<b>{$metricLabel}</b>: {$plotInfo['value']}";
                            }
                        }

                        $data[] = $thisData;
                    }
                }

                $addItem = true;

                if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($seriesInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                    $addItem = false;
                }

                if ($addItem) {
                    $this->SC_APP_data['fusioncharts_json'] ['dataset'] [] = [
                        'seriesName' => $seriesInfo['label'],
                        'data' => $data,
                    ];
                }
            }
        }
    }

    function info_createFusionChartsData_json_data_comparisonSeries()
    {
        $this->SC_APP_data['fusioncharts_json'] ['categories'] = [];
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] = [];

        $category = [];
        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $category[] = [
                    'label' => $plotInfo['label'],
                ];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['categories'] [] = [
            'category' => $category,
        ];

        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] as $seriesIndex => $seriesInfo) {
            $data = [];

            foreach ($seriesInfo as $plotInfo) {
                $addItem = true;
    
                if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                    $addItem = false;
                }
    
                if ($addItem) {
                    $thisData = [
                        'value' => $plotInfo['value'],
                    ];
    
                    if ($this->SC_APP_info['options'] ['tooltip_expanded']) {
                        $metricLabel = $this->aux_getMetricLabel($this->SC_APP_data['md5_data'] ['metric']);

                        $thisData['tooltext'] = "<b>{$this->SC_APP_data['md5_data'] ['dimension'] ['label']}</b>";
                        $thisData['tooltext'] .= "<br>";
                        $thisData['tooltext'] .= "<b>{$plotInfo['label']}</b>";
                        $thisData['tooltext'] .= "<br><br>";
                        $thisData['tooltext'] .= "<b>{$this->SC_APP_data['md5_data'] ['options'] ['comparison_field_label']}</b>: {$this->SC_APP_data['md5_data'] ['options'] ['series_name'] [$seriesIndex]}";
                        $thisData['tooltext'] .= "<br>";
                        $thisData['tooltext'] .= "<b>{$metricLabel}</b>: {$plotInfo['value']}";
                    }
    
                    $data[] = $thisData;
                }
            }

            $this->SC_APP_data['fusioncharts_json'] ['dataset'] [] = [
                'seriesName' => $this->SC_APP_data['md5_data'] ['options'] ['series_name'] [$seriesIndex],
                'data' => $data,
            ];
        }
    }

    function info_createFusionChartsData_json_data_singleSerieCategorySeries()
    {
        $this->SC_APP_data['fusioncharts_json'] ['categories'] = [];
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] = [];

        $category = [];
        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $category[] = [
                    'label' => $this->SC_APP_info['chart'] ['fusioncharts_fix'] . $plotInfo['label'],
                ];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['categories'] [] = [
            'category' => $category,
        ];

        $displayValues = [];
        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_display_values'] as $thisDisplayValue) {
            $displayValues[] = $thisDisplayValue;
        }
        if (isset($displayValues[0])) {
            if (false === $displayValues[0]) {
                $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showValues'] = '0';
            } elseif ($displayValues[0]) {
                $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showValues'] = '1';
            }
        }

        $data = [];
        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $thisData = [
                    'value' => $plotInfo['value'],
                ];

                if ($this->SC_APP_info['options'] ['tooltip_expanded']) {
                    $thisData['tooltext'] = "<b>{$this->SC_APP_data['md5_data'] ['dimension'] ['label']}</b>: {$plotInfo['label']}";
                    $thisData['tooltext'] .= "<br>";
                    $thisData['tooltext'] .= "<b>{$this->SC_APP_data['md5_data'] ['metric'] [0] ['label']}</b>: {$plotInfo['value']}";
                }

                $data[] = $thisData;
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] [] = [
            'seriesName' => $this->SC_APP_data['md5_data'] ['metric'] [0] ['label'],
            'data' => $data,
        ];

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['showLegend'] = '0';
    }

    function info_createFusionChartsData_json_data_combinationSeries()
    {
        if (2 > count($this->SC_APP_data['md5_data'] ['metric'])) {
            return;
        }

        $this->SC_APP_data['fusioncharts_json'] ['categories'] = [];
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] = [];

        $category = [];
        foreach ($this->SC_APP_data['md5_data'] ['data_analytic'] ['set'] ['categories'] as $categoryLabel) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($categoryLabel, $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $category[] = [
                    'label' => $this->SC_APP_info['chart'] ['fusioncharts_fix'] . $categoryLabel,
                ];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] ['categories'] [] = [
            'category' => $category,
        ];

        $renderAs = [];
        $displayValues = [];
        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['comb_field_display_type'] as $thisRenderAs) {
            $renderAs[] = $thisRenderAs;
        }
        foreach ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_display_values'] as $thisDisplayValue) {
            $displayValues[] = $thisDisplayValue;
        }

        $primaryAxysName = [];
        $secondaryAxysName = '';

        $axysCount = 0;
        foreach ($this->SC_APP_data['md5_data'] ['data_analytic'] ['set'] ['dataset'] as $serieName => $serieInfo) {
            $data = [];

            if (0 == $axysCount) {
                $secondaryAxysName = $serieInfo['label'];
            } else {
                $primaryAxysName[] = $serieInfo['label'];
            }

            foreach ($serieInfo ['data'] as $plotValue => $plotInfo) {
                $addItem = true;
    
                if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                    $addItem = false;
                }
    
                if ($addItem) {
                    $thisData = [
                        'value' => $plotInfo['value'],
                    ];
    
                    if ('none' != $this->SC_APP_data['md5_data'] ['options'] ['chart_link'] && '' != $this->SC_APP_data['md5_data'] ['dimension'] ['next']) {
                        $thisData['link'] = 'j-chartDrillDown-' . $this->aux_getChartLink($this->SC_APP_data['md5_data'] ['dimension_list'], $this->SC_APP_data['md5_data'] ['metric'], $this->SC_APP_data['md5_data'] ['parameters'], $plotInfo['dimension_value']);
                    }
    
                    if ($this->SC_APP_info['options'] ['tooltip_expanded']) {
                        $thisData['tooltext'] = "<b>{$this->SC_APP_data['md5_data'] ['data_analytic'] ['set'] ['field_name'] ['x_axys']}</b>: {$plotValue}";
                        $thisData['tooltext'] .= "<br>";
                        $thisData['tooltext'] .= "<b>{$serieName}</b>: {$plotInfo['value']}";
                    }
    
                    $data[] = $thisData;
                }
            }
    
            $datasetInfo = [
                'seriesName' => $serieInfo['label'],
                'data' => $data,
            ];
            if (0 == $axysCount) {
                $datasetInfo['parentYAxis'] = 'S';
            }
            if (isset($renderAs[$axysCount]) && '' != $renderAs[$axysCount]) {
                $datasetInfo['renderAs'] = $renderAs[$axysCount];
            }
            if (isset($displayValues[$axysCount])) {
                if (false === $displayValues[$axysCount]) {
                    $datasetInfo['showValues'] = '0';
                } elseif ($displayValues[$axysCount]) {
                    $datasetInfo['showValues'] = '1';
                }
            }
    
            $this->SC_APP_data['fusioncharts_json'] ['dataset'] [] = $datasetInfo;

            $axysCount++;
        }

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['pYAxisName'] = implode(', ', $primaryAxysName);
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['sYAxisName'] = $secondaryAxysName;

        $this->formatThemeSecondary($this->SC_APP_data['fusioncharts_json'] ['chart']);
    }

    function info_createFusionChartsData_json_data_heatMapSeries()
    {
        $divideBy = count($this->chartGradient) - 1;
        $firstColor = $this->chartGradient[0];

        $this->SC_APP_data['fusioncharts_json'] ['dataset'] [] = [
            'data' => $this->SC_APP_data['md5_data'] ['data_heatmap'] ['dataset']
        ];

        $this->SC_APP_data['fusioncharts_json'] ['columns'] = [
            'column' => $this->SC_APP_data['md5_data'] ['data_heatmap'] ['columns']
        ];

        $this->SC_APP_data['fusioncharts_json'] ['rows'] = [
            'row' => $this->SC_APP_data['md5_data'] ['data_heatmap'] ['rows']
        ];

        if ('' != $this->SC_APP_info['chart'] ['fusioncharts_fix']) {
            foreach ($this->SC_APP_data['fusioncharts_json'] ['columns'] ['column'] as $columnIndex => $columnInfo) {
                $this->SC_APP_data['fusioncharts_json'] ['columns'] ['column'] [$columnIndex] ['label'] = $this->SC_APP_info['chart'] ['fusioncharts_fix'] . $columnInfo['label'];
            }
        }

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['yAxisName'] = $this->SC_APP_data['md5_data'] ['data_heatmap'] ['yDimensionName'];

        $stepValue = ($this->SC_APP_data['md5_data'] ['data_heatmap'] ['maxValue'] - $this->SC_APP_data['md5_data'] ['data_heatmap'] ['minValue']) / $divideBy;
        $minValue = (float)$this->SC_APP_data['md5_data'] ['data_heatmap'] ['minValue'];

        $colors = [];

        for ($i = 1; $i < count($this->chartGradient); $i++) {
            $minMultiplier = $i - 1;
            $colors[] = [
                'code' => $this->chartGradient[$i],
                'label' => '',
                'minvalue' => $minValue + ($stepValue * $minMultiplier),
                'maxvalue' => $minValue + ($stepValue * $i),
            ];
        }

        $this->SC_APP_data['fusioncharts_json'] ['colorrange'] ['minvalue'] = $this->SC_APP_data['md5_data'] ['data_heatmap'] ['minValue'];
        $this->SC_APP_data['fusioncharts_json'] ['colorrange'] ['code'] = $firstColor;
        $this->SC_APP_data['fusioncharts_json'] ['colorrange'] ['color'] = $colors;

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['plotToolText'] = "<div><b>{$this->SC_APP_data['md5_data'] ['dimension_label'] [1]}: </b>\$rowLabel<br/><b>{$this->SC_APP_data['md5_data'] ['dimension_label'] [0]}: </b>\$columnLabel<br/><b>{$this->SC_APP_data['md5_data'] ['metric'] [0] ['label']}: </b>\$value</div>";
    }

    function info_createFusionChartsData_json_data_treeMapSeries()
    {
        $divideBy = count($this->chartGradient) - 1;
        $firstColor = $this->chartGradient[0];

        $this->SC_APP_data['fusioncharts_json'] ['data'] [] = $this->SC_APP_data['md5_data'] ['data_treemap'] ['data'];

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['yAxisName'] = $this->SC_APP_data['md5_data'] ['data_treemap'] ['yDimensionName'];

        $stepValue = ($this->SC_APP_data['md5_data'] ['data_treemap'] ['maxValue'] - $this->SC_APP_data['md5_data'] ['data_treemap'] ['minValue']) / $divideBy;
        $minValue = (float)$this->SC_APP_data['md5_data'] ['data_treemap'] ['minValue'];

        $colors = [];

        for ($i = 1; $i < count($this->chartGradient); $i++) {
            $colors[] = [
                'code' => $this->chartGradient[$i],
                'label' => '',
                'maxvalue' => $minValue + ($stepValue * $i),
            ];
        }

        $this->SC_APP_data['fusioncharts_json'] ['colorrange'] ['gradient'] = '1';
        $this->SC_APP_data['fusioncharts_json'] ['colorrange'] ['minvalue'] = $this->SC_APP_data['md5_data'] ['data_treemap'] ['minValue'];
        $this->SC_APP_data['fusioncharts_json'] ['colorrange'] ['code'] = $firstColor;
        $this->SC_APP_data['fusioncharts_json'] ['colorrange'] ['color'] = $colors;

        $this->SC_APP_data['fusioncharts_json'] ['data'] [0] ['labelFontBold'] = '0';
        $this->SC_APP_data['fusioncharts_json'] ['data'] [0] ['fillcolor'] = 'c0c0c0';

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['plotToolText'] = "<div><b>\$label</b><br/> <b>{$this->SC_APP_data['md5_data'] ['metric'] [0] ['label']}: </b>\$value<br/><b>{$this->SC_APP_data['md5_data'] ['metric'] [1] ['label']}: </b>\$svalue</div>";
    }

    function info_createFusionChartsData_json_data_chordSeries()
    {
        $chartCaption = '';
        if ('' != $this->SC_APP_info['chart'] ['chart_title']) {
            $chartCaption = $this->SC_APP_info['chart'] ['chart_title'];
        } elseif ($this->SC_APP_info['chart'] ['fill_empty_caption']) {
            $chartCaption = $this->SC_APP_data['md5_data'] ['metric'] [0] ['label'];
        }

        $this->SC_APP_data['fusioncharts_json'] ['links'] = $this->SC_APP_data['md5_data'] ['data_chord'] ['links'];

        $this->SC_APP_data['fusioncharts_json'] ['nodes'] = $this->SC_APP_data['md5_data'] ['data_chord'] ['nodes'];

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['caption'] = $chartCaption;
    }

    function info_createFusionChartsData_json_data_sankeySeries()
    {
        $chartCaption = '';
        if ('' != $this->SC_APP_info['chart'] ['chart_title']) {
            $chartCaption = $this->SC_APP_info['chart'] ['chart_title'];
        } elseif ($this->SC_APP_info['chart'] ['fill_empty_caption']) {
            $chartCaption = $this->SC_APP_data['md5_data'] ['metric'] [0] ['label'];
        }

        $this->SC_APP_data['fusioncharts_json'] ['links'] = $this->SC_APP_data['md5_data'] ['data_sankey'] ['links'];

        $this->SC_APP_data['fusioncharts_json'] ['nodes'] = $this->SC_APP_data['md5_data'] ['data_sankey'] ['nodes'];

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['caption'] = $chartCaption;
    }

    function info_createFusionChartsData_json_data_sunburstSeries()
    {
        $this->SC_APP_data['fusioncharts_json'] ['data'] = $this->SC_APP_data['md5_data'] ['data_sunburst'] ['data'];
    }

    function info_createFusionChartsData_json_data_gaugeSeries()
    {
        $valueMarker = 'LinearGauge' == $this->SC_APP_info['types'] ['gauge'] ['format'] ? 'pointer' : 'dial';

        $this->SC_APP_data['fusioncharts_json'] [$valueMarker . 's'] = [];

        $gaugeMin = 0;
        $gaugeMax = 0;

        $dial = [];
        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $gaugeMin = min($gaugeMin, $plotInfo['value']);
                $gaugeMax = max($gaugeMax, $plotInfo['value']);
               
                $dial[] = [
                    'value' => $plotInfo['value'],
                    'tooltext' => "{$plotInfo['label']}: {$plotInfo['value']}",
                ];
            }
        }
        $this->SC_APP_data['fusioncharts_json'] [$valueMarker . 's'] = [
            $valueMarker => $dial,
        ];

        if (10 > $gaugeMax) {
            $gaugeMax = 10;
        }
        $gaugeMax = ceil($gaugeMax * 1.1);

        if (!$this->SC_APP_info['types'] ['gauge'] ['use_interval']) {
            if (isset($this->chart_theme['css_chart_background_pallete_color']) && '' != $this->chart_theme['css_chart_background_pallete_color']) {
                $chartPallete = explode(',', $this->chart_theme['css_chart_background_pallete_color']);
    
                $this->SC_APP_data['fusioncharts_json'] ['colorRange'] = [
                    'color' => [[
                        'minValue' => '0',
                        'maxValue' => $gaugeMax,
                        'code' => str_replace('#', '', $chartPallete[0])
                    ]]
                ];
            } else {
                $this->SC_APP_data['fusioncharts_json'] ['colorRange'] = [
                    'color' => [[
                        'minValue' => '0',
                        'maxValue' => $gaugeMax,
                        'code' => '9bc8f2'
                    ]]
                ];
            }
        }

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['lowerLimit'] = $gaugeMin;
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['upperLimit'] = $gaugeMax;
    }

    function info_createFusionChartsData_json_data_scatterSeries()
    {
        if (2 != count($this->SC_APP_data['md5_data'] ['metric'])) {
            return;
        }

        $this->SC_APP_data['fusioncharts_json'] ['categories'] = [];
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] = [];

        $seriesXName = $this->SC_APP_data['md5_data'] ['metric'] [0] ['field'];
        $seriesYName = $this->SC_APP_data['md5_data'] ['metric'] [1] ['field'];

        $seriesXLabel = $this->SC_APP_data['md5_data'] ['metric'] [0] ['label'];
        $seriesYLabel = $this->SC_APP_data['md5_data'] ['metric'] [1] ['label'];

        $category = [];
        $data = [];

        foreach ($this->SC_APP_data['md5_data'] ['data_analytic'] ['set'] ['dataset'] [$seriesXName] ['data'] as $plotValue => $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $category[] = [
                    'x' => $plotInfo['value'],
                    'showverticalline' => '1',
                ];

                $plotYValue = $this->SC_APP_data['md5_data'] ['data_analytic'] ['set'] ['dataset'] [$seriesYName] ['data'] [$plotValue] ['value']; 

                $thisData = [
                    'x' => $plotInfo['value'],
                    'y' => $plotYValue,
                ];

                if ('none' != $this->SC_APP_data['md5_data'] ['options'] ['chart_link'] && '' != $this->SC_APP_data['md5_data'] ['dimension'] ['next']) {
                    $thisData['link'] = 'j-chartDrillDown-' . $this->aux_getChartLink($this->SC_APP_data['md5_data'] ['dimension_list'], $this->SC_APP_data['md5_data'] ['metric'], $this->SC_APP_data['md5_data'] ['parameters'], $plotInfo['dimension_value']);
                }

                if ($this->SC_APP_info['options'] ['tooltip_expanded']) {
                    $thisData['tooltext'] = "<b>{$this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['field_name'] ['x_axys']}</b>: {$plotValue}";
                    $thisData['tooltext'] .= "<br>";
                    $thisData['tooltext'] .= "<b>{$seriesXLabel}</b>: {$plotInfo['value']}";
                    $thisData['tooltext'] .= "<br>";
                    $thisData['tooltext'] .= "<b>{$seriesYLabel}</b>: {$plotYValue}";
                }

                $data[] = $thisData;
            }
        }

        $this->SC_APP_data['fusioncharts_json'] ['categories'] [] = [
            'category' => $category,
        ];
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] [] = [
            'seriesName' => $this->SC_APP_data['md5_data'] ['data_analytic'] ['set'] ['field_name'] ['x_axys'],
            'showregressionline' => 1,
            'data' => $data,
        ];

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['xaxisname'] = $seriesXLabel;
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['yaxisname'] = $seriesYLabel;
    }

    function info_createFusionChartsData_json_data_bubbleSeries()
    {
        if (3 != count($this->SC_APP_data['md5_data'] ['metric'])) {
            return;
        }

        $this->SC_APP_data['fusioncharts_json'] ['categories'] = [];
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] = [];

        $seriesXName = $this->SC_APP_data['md5_data'] ['metric'] [0] ['field'];
        $seriesYName = $this->SC_APP_data['md5_data'] ['metric'] [1] ['field'];
        $seriesZName = $this->SC_APP_data['md5_data'] ['metric'] [2] ['field'];

        $seriesXLabel = $this->SC_APP_data['md5_data'] ['metric'] [0] ['label'];
        $seriesYLabel = $this->SC_APP_data['md5_data'] ['metric'] [1] ['label'];
        $seriesZLabel = $this->SC_APP_data['md5_data'] ['metric'] [2] ['label'];
        
        $category = [];
        $data = [];

        foreach ($this->SC_APP_data['md5_data'] ['data_analytic'] ['set'] ['dataset'] [$seriesXName] ['data'] as $plotValue => $plotInfo) {
            $addItem = true;

            if (!empty($this->SC_APP_data['filtered_chart_items']) && !in_array($plotInfo['label'], $this->SC_APP_data['filtered_chart_items'])) {
                $addItem = false;
            }

            if ($addItem) {
                $category[] = [
                    'x' => $plotInfo['value'],
                    'showverticalline' => '1',
                ];

                $plotYValue = $this->SC_APP_data['md5_data'] ['data_analytic'] ['set'] ['dataset'] [$seriesYName] ['data'] [$plotValue] ['value']; 
                $plotZValue = $this->SC_APP_data['md5_data'] ['data_analytic'] ['set'] ['dataset'] [$seriesZName] ['data'] [$plotValue] ['value']; 

                $thisData = [
                    'x' => $plotInfo['value'],
                    'y' => $plotYValue,
                    'z' => $plotZValue,
                ];

                if ('none' != $this->SC_APP_data['md5_data'] ['options'] ['chart_link'] && '' != $this->SC_APP_data['md5_data'] ['dimension'] ['next']) {
                    $thisData['link'] = 'j-chartDrillDown-' . $this->aux_getChartLink($this->SC_APP_data['md5_data'] ['dimension_list'], $this->SC_APP_data['md5_data'] ['metric'], $this->SC_APP_data['md5_data'] ['parameters'], $plotInfo['dimension_value']);
                }

                if ($this->SC_APP_info['options'] ['tooltip_expanded']) {
                    $thisData['tooltext'] = "<b>{$this->SC_APP_data['md5_data'] ['data_analytic'] [ $this->SC_APP_data['series_mode'] ] ['field_name'] ['x_axys']}</b>: {$plotValue}";
                    $thisData['tooltext'] .= "<br>";
                    $thisData['tooltext'] .= "<b>{$seriesXLabel}</b>: {$plotInfo['value']}";
                    $thisData['tooltext'] .= "<br>";
                    $thisData['tooltext'] .= "<b>{$seriesYLabel}</b>: {$plotYValue}";
                }

                $data[] = $thisData;
            }
        }

        $this->SC_APP_data['fusioncharts_json'] ['categories'] [] = [
            'category' => $category,
        ];
        $this->SC_APP_data['fusioncharts_json'] ['dataset'] [] = [
            'seriesName' => $this->SC_APP_data['md5_data'] ['data_analytic'] ['set'] ['field_name'] ['x_axys'],
            'showregressionline' => 1,
            'data' => $data,
        ];

        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['xaxisname'] = $seriesXLabel;
        $this->SC_APP_data['fusioncharts_json'] ['chart'] ['yaxisname'] = $seriesYLabel;
    }

    function info_createFusionChartsData_json_data_order()
    {
        if ('Pie' == $this->SC_APP_data['type'] && 'off' != $this->SC_APP_info['types'] ['pie'] ['order']) {
            $this->aux_orderSerie($this->SC_APP_data['fusioncharts_json'] ['data'], $this->SC_APP_info['types'] ['pie'] ['order']);
            $this->aux_rearrangeOrderIndexes($this->SC_APP_data['fusioncharts_json'] ['data']);
        } elseif ('Line' == $this->SC_APP_data['type'] && 'Step' == $this->SC_APP_info['types'] ['line'] ['format'] && !$this->aux_isMultiSeries()) {
            $this->aux_orderSerie($this->SC_APP_data['fusioncharts_json'] ['dataset'] [0] ['data'], $this->SC_APP_data['order']);
            $this->aux_rearrangeOrderMultiIndexes($this->SC_APP_data['fusioncharts_json'] ['dataset'] [0] ['data'], $this->SC_APP_data['fusioncharts_json'] ['categories'] [0] ['category']);
        } elseif ('Radar' == $this->SC_APP_data['type'] && self::CHART_MODE_SYNTHETIC == $this->SC_APP_data['data_mode']) {
            $this->aux_orderSerie($this->SC_APP_data['fusioncharts_json'] ['dataset'] [0] ['data'], $this->SC_APP_data['order']);
            $this->aux_rearrangeOrderMultiIndexes($this->SC_APP_data['fusioncharts_json'] ['dataset'] [0] ['data'], $this->SC_APP_data['fusioncharts_json'] ['categories'] [0] ['category']);
        } elseif (!$this->aux_isMultiSeries() && !$this->SC_APP_data['md5_data'] ['options'] ['is_comparison'] && '' != $this->SC_APP_data['order'] && !in_array($this->SC_APP_data['type'], ['Gauge', 'Radar'])) {
            $this->aux_orderSerie($this->SC_APP_data['fusioncharts_json'] ['data'], $this->SC_APP_data['order']);
            $this->aux_rearrangeOrderIndexes($this->SC_APP_data['fusioncharts_json'] ['data']);
        }
    }

    function info_createFusionChartsData_json_data_trendline()
    {
        if (!$this->SC_APP_info['options'] ['hasTrendline']) {
            return;
        }

        $this->SC_APP_data['fusioncharts_json'] ['trendlines'] = [];

        if ($this->SC_APP_info['options'] ['trendlineIsZone']) {
            $this->aux_addTrendline_zone();
        } elseif ('fixed' == $this->SC_APP_info['options'] ['trendlineType']) {
            $this->aux_addTrendline_fixed();
        } else {
            $series = [];

            if (isset($this->SC_APP_data['fusioncharts_json'] ['data'])) {
                $thisSerie = [];
                foreach ($this->SC_APP_data['fusioncharts_json'] ['data'] as $plotInfo) {
                    $thisSerie[] = $plotInfo['value'];
                }
                $series[] = $thisSerie;
            } elseif (isset($this->SC_APP_data['fusioncharts_json'] ['categories']) && isset($this->SC_APP_data['fusioncharts_json'] ['dataset'])) {
                foreach ($this->SC_APP_data['fusioncharts_json'] ['dataset'] as $serieInfo) {
                    $thisSerie = [];
                    foreach ($serieInfo['data'] as $plotInfo) {
                        $thisSerie[] = $plotInfo['value'];
                    }
                    $series[] = $thisSerie;
                }
            }

            if (!empty($series)) {
                if ('linear' == $this->SC_APP_info['options'] ['trendlineType']) {
                    require_once($this->Ini->path_lib_php . 'PolynomialRegression.php');
                }

                foreach ($series as $thisSerie) {
                    switch ($this->SC_APP_info['options'] ['trendlineType']) {
                        case 'avg';
                                $this->aux_addTrendline_average($thisSerie);
                            break;
                        case 'linear';
                                $this->aux_addTrendline_linear($thisSerie);
                            break;
                        case 'std_deviation';
                                $this->aux_addTrendline_standardDeviation($thisSerie);
                            break;
                        case 'variance';
                                $this->aux_addTrendline_variance($thisSerie);
                            break;
                    }
                }
            }
        }

        if (empty($this->SC_APP_data['fusioncharts_json'] ['trendlines'])) {
            unset($this->SC_APP_data['fusioncharts_json'] ['trendlines']);
        }
    }

    function info_saveFusionChartsJson()
    {
        @file_put_contents(
            $this->SC_APP_info['chart'] ['json_base_dir'] . $this->SC_APP_info['chart'] ['json_filename'],
            json_encode($this->SC_APP_data['fusioncharts_json'])
        );
    }

    function display_chartApp_inline_startUp()
    {
        $htmlCode = $this->display_chart_htmlFusionChartsLibrary();
        $htmlCode .= $this->display_chart_htmlFusionChartsDiv_breadcrumb();
        $htmlCode .= $this->display_chart_htmlFusionChartsDiv_newPage();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_function();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_drilldown();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_chartApp();

        return $htmlCode;
    }

    function display_chartApp_type($chartMd5, $chartType, $chartTitle)
    {
        $this->aux_setChartType($chartType);

        $this->info_initializeData();
        $this->info_initializeChart($chartMd5);

        $ajaxResponse = [
            'status' => 'ok',
            'chartType' => $this->SC_APP_data['fusioncharts_javascript'] ['type'],
            'chartUrl' => "{$this->SC_APP_info['chart'] ['json_base_url']}sc_fc_grid_deduction_fdu_hist_{$chartMd5}.json",
            'chartMd5' => $chartMd5,
            'chartTitle' => $chartTitle,
            'errorMessage' => $this->aux_getChartErrorMessage(),
        ];

        echo json_encode($ajaxResponse);
        exit;
    }

    function display_summaryChart_inline_startUp()
    {
        $htmlCode = $this->display_chart_htmlFusionChartsLibrary();
        $htmlCode .= $this->display_chart_htmlFusionChartsDiv_breadcrumb();
        $htmlCode .= $this->display_chart_htmlFusionChartsDiv_inline();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_function();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_drilldown();
        $htmlCode .= <<<SCEOT
    <span id="sc-summary-fusioncharts-placeholder">
    </span>

SCEOT;

        return $htmlCode;
    }

    function display_summaryChart_inline_initialAjaxCall($chartMd5)
    {
        $this->info_initializeData();
        $this->info_initializeChart($chartMd5);

        $scPage = NM_encode_input($this->Ini->sc_page);
        $ajaxUrl = "{$this->Ini->path_link}grid_deduction_fdu_hist/index.php";

        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        drillDownBreadcrumb = [{
            label: "{$this->SC_APP_data['fusioncharts_json'] ['sc'] ['chart_title']}",
            md5: "{$this->SC_APP_data['fusioncharts_json'] ['sc'] ['chart_md5']}"
        }];
        $.ajax({
            type: "POST",
            url: "{$ajaxUrl}",
            dataType: "json",
            data: {
                nmgp_opcao: "grafico",
                script_case_init: "{$scPage}",
                chart_inline_create: "Y",
                chart_md5: "{$chartMd5}",
            }
        }).done(function(data) {
            $("#sc-summary-fusioncharts-placeholder").html(data.chartHtml);
            if ('' != data.chartType && '' != data.chartUrl) {
                scFusionCharts_create(data.chartType, data.chartUrl, data.chartWidth, data.chartHeight, data.errorMessage);
            }
        });
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_summaryChart_inline_initialAjaxResponse($chartMd5)
    {
        $this->info_initializeData();
        $this->info_initializeChart($chartMd5);

        $ajaxResponse = [
            'status' => 'ok',
            'chartHtml' => '',
            'chartType' => '',
            'chartUrl' => '',
            'chartMd5' => $chartMd5,
            'chartWidth' => $this->SC_APP_data['width'],
            'chartHeight' => $this->SC_APP_data['height'],
            'errorMessage' => $this->aux_getChartErrorMessage(),
        ];

        if ('' != $chartMd5 && isset($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_info'] [$chartMd5])) {
            $ajaxResponse['chartHtml'] .= $this->display_chart_htmlFusionChartsJavascript_setInlineChartMd5($chartMd5);
            $ajaxResponse['chartType'] = $this->SC_APP_data['fusioncharts_javascript'] ['type'];
            $ajaxResponse['chartUrl'] = $this->SC_APP_data['fusioncharts_javascript'] ['dataSource'];
        }

        echo json_encode($ajaxResponse);
        exit;
    }

    function display_summaryChart_inline_updateAjaxResponse($chartMd5)
    {
        $this->info_initializeData();
        $this->info_initializeChart($chartMd5);

        $ajaxResponse = [
            'status' => 'ok',
            'chartType' => $this->SC_APP_data['fusioncharts_javascript'] ['type'],
            'chartUrl' => $this->SC_APP_data['fusioncharts_javascript'] ['dataSource'],
            'chartMd5' => $chartMd5,
            'chartWidth' => $this->SC_APP_data['width'],
            'chartHeight' => $this->SC_APP_data['height'],
            'errorMessage' => $this->aux_getChartErrorMessage(),
        ];

        echo json_encode($ajaxResponse);
        exit;
    }

    function display_summaryChart_data($chartMd5)
    {
        $this->info_initializeChart($chartMd5);

        $chartFile = "{$this->SC_APP_info['chart'] ['json_base_dir']}sc_fc_grid_deduction_fdu_hist_{$chartMd5}.json";

        echo @file_get_contents($chartFile);
        exit;
    }

    function display_summaryChart_newPage($chartMd5)
    {
        global $nm_saida;

        $this->info_initializeData();
        $this->info_initializeChart($chartMd5);

        $htmlCode = $this->display_chart_htmlHeader();
        $htmlCode .= $this->display_chart_summaryBody();
        $htmlCode .= $this->display_chart_htmlFooter();

        $nm_saida->saida($htmlCode);
    }

    function display_summaryChart_phantom()
    {
        $htmlCode = $this->display_chart_htmlFusionChartsDiv_newPage();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_phantom();

        return $htmlCode;
    }

    function display_summaryChart_phantom_md5()
    {
        return '__' . implode('X', [
            ($this->SC_APP_data['md5_data'] ['options'] ['is_comparison'] ? 'comparison' : 'standard'),
            $this->SC_APP_data['fusioncharts_javascript'] ['type'],
            $this->SC_APP_data['fusioncharts_javascript'] ['width'],
            $this->SC_APP_data['fusioncharts_javascript'] ['height'],
        ]);
    }

    function display_chart_summaryBody()
    {
        $htmlCode = <<<SCEOT
<body class="{$this->SC_APP_info['css'] ['chart_page']}">

SCEOT;
        $htmlCode .= $this->display_chart_htmlFusionChartsConfigDiv();
        $htmlCode .= $this->display_chart_htmlFusionChartsDiv_breadcrumb();
        $htmlCode .= $this->display_chart_htmlFusionChartsDiv_newPage();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_function();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_onReady();
        $htmlCode .= $this->display_chart_htmlSamePageBackButton();
        $htmlCode .= <<<SCEOT
</body>


SCEOT;

        return $htmlCode;
    }

    function display_chart_chartBody()
    {
        $htmlCode = $this->display_chart_htmlFusionChartsDiv_breadcrumb();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_function();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_onReady();

        return $htmlCode;
    }

    function display_chart_htmlHeader()
    {
        $htmlCode = <<<SCEOT
<html>

<head>
    {$this->SC_APP_info['options'] ['charset']}

SCEOT;
        if ('' != $this->SC_APP_info['options'] ['favicon']) {
            $htmlCode .= <<<SCEOT
    <link rel="shortcut icon" href="../_lib/img/{$this->SC_APP_info['options'] ['favicon']}" />

SCEOT;
        }
        if ($this->aux_isMobile()) {
            $htmlCode .= <<<SCEOT
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

SCEOT;
        }
        $htmlCode .= $this->display_chart_htmlHeader_css();
        $htmlCode .= $this->display_chart_htmlHeader_javascript();
        $htmlCode .= $this->display_chart_htmlFusionChartsJavascript_drilldown();
        $htmlCode .= <<<SCEOT
    <title>{$this->SC_APP_info['chart'] ['page_title']}</title>
</head>


SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlHeader_css()
    {
        $htmlCode = <<<SCEOT
    <style>
        #sc-id-chart-blockui {
            display: none;
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            background-color: rgb(255, 255, 255);
            z-index: 99900;
            opacity: 0.7;
        }
        #sc-id-div-config {
            position: absolute;
            top: 50%;
            left: 50%;
            padding: 1.5rem;
            z-index: 99990;
            width: 700px;
            border: 1px solid #c2c2c2;
            display: none;
            flex-flow: column nowrap;
            row-gap: 2rem;
            justify-content: center;
            align-items: flex-start;
            box-sizing: border-box;
            transform: translate(-50%, -50%);
            box-shadow: 0 8px 16px rgba(0,0,0,.25);
        }
        #sc-id-div-config-input {
            width: 100%;
            display: flex;
            flex-flow: row wrap;
            row-gap: .875rem;
            column-gap: .875rem;
            justify-content: space-between;
            align-items: center;
        }
        #sc-id-div-config-button {
            width: 100%;
            display: flex;
            flex-flow: row nowrap;
            justify-content: end;
            column-gap: .75rem;
        }
        .input-group {
            flex-flow: column nowrap;
            justify-content: flex-start;
            align-items: flex-start;
            row-gap: .5rem;
            display: flex;
        }
        .input-group > label {
            font-weight: 700;
        }
        #sc-id-drilldown-breadcrumb {
            padding: 10px 0;
        }
    </style>

SCEOT;

        if ($this->SC_APP_info['options'] ['use_fontawesome']) {
            $htmlCode .= <<<SCEOT
    <link rel="stylesheet" href="{$this->Ini->path_prod}/third/font-awesome/6/css/all.min.css" type="text/css" media="screen,print" />

SCEOT;
        }

        if ('' != $this->SC_APP_info['options'] ['summary_css']) {
            $summaryCss = NM_encode_input($this->SC_APP_info['options'] ['summary_css']);

            $htmlCode .= <<<SCEOT
    <link rel="stylesheet" href="{$summaryCss}" type="text/css" media="screen,print" />

SCEOT;
        }

        $htmlCode .= <<<SCEOT
    <link rel="stylesheet" href="../_lib/buttons/{$this->Ini->Str_btn_css}" type="text/css" media="screen,print" />

SCEOT;

        if (isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) {
            $htmlCode .= <<<SCEOT
    <link rel="stylesheet" href="{$this->Ini->str_google_fonts}" type="text/css" media="screen,print" />

SCEOT;
        }

        return $htmlCode;
    }

    function display_chart_htmlHeader_javascript()
    {
        $scPage = NM_encode_input($this->Ini->sc_page);
        $ajaxUrl = "{$this->Ini->path_link}grid_deduction_fdu_hist/grid_deduction_fdu_hist_config_graf_flash.php?nome_apl=grid_deduction_fdu_hist&campo_apl=nm_resumo_graf&sc_page=" . NM_encode_input($this->Ini->sc_page) . "&language=en_us";
        $ajaxUrlDrillDown = "{$this->Ini->path_link}grid_deduction_fdu_hist/index.php";

        $htmlCode = <<<SCEOT
    <script type="text/javascript" src="{$this->Ini->path_prod}/third/jquery/js/jquery.js"></script>
    <script type="text/javascript">
        function showChartConfig()
        {
            $("#sc-id-div-config").css("display", "flex").show();
            $("#sc-id-chart-blockui").show();
        }
        function hideChartConfig()
        {
            $("#sc-id-div-config").hide();
            $("#sc-id-chart-blockui").hide();
        }
        $(function() {
            $("#sc-id-button-submit").on("click", function() {
                $.ajax({
                    type: "POST",
                    url: "{$ajaxUrl}",
                    data: {
                        bok_graf: "OK",
                        ajax: "OK",
                        nome_apl: "grid_deduction_fdu_hist",
                        campo_apl: "nm_resumo_graf",
                        sc_page: "{$scPage}",
                        tipo: $("#sc-id-chart-type").val(),
                        opc_atual: $("#sc-id-chart-mode").val(),
                        largura: $("#sc-id-chart-width").val(),
                        altura: $("#sc-id-chart-height").val(),
                        order: $("#sc-id-chart-order").val()
                    }
                }).done(function(data, textStatus, jqXHR) {
                    document.refresh_chart.submit();
                });
            });
            $("#sc-id-button-cancel").on("click", function() {
                hideChartConfig();
            });
        });
    </script>

SCEOT;
        $htmlCode .= $this->display_chart_htmlFusionChartsLibrary();

        return $htmlCode;
    }

    function display_chart_htmlFooter()
    {
        $htmlCode = <<<SCEOT
</html>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsLibrary($useServer = '')
    {
        $jsServer = '';
        if ('pdf' == $useServer || 'phantom' == $useServer) {
            $jsServer = $this->Ini->server_pdf;
        }

        $htmlCode = <<<SCEOT
    <script type="text/javascript" src="{$jsServer}{$this->Ini->path_prod}/third/fusioncharts-suite-xt/js/fusioncharts.js"></script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsConfigDiv()
    {
        $translate = [];
        $language = 'en_us';
        if (isset($_SESSION['scriptcase'] ['sc_idioma_graf_flash'])) {
            $translate = $_SESSION['scriptcase'] ['sc_idioma_graf_flash'];
        }
        if (!isset($translate[$language])) {
            foreach ($translate as $language => $rest) {
                break;
            }
        }

        $modeSyntheticSelected = self::CHART_MODE_SYNTHETIC == $this->SC_APP_data['data_mode'] ? ' selected="selected"' : '';
        $modeAnalyticSelected = self::CHART_MODE_ANALYTIC == $this->SC_APP_data['data_mode'] ? ' selected="selected"' : '';
        $modeSyntheticValue = self::CHART_MODE_SYNTHETIC;
        $modeAnalyticValue = self::CHART_MODE_ANALYTIC;

        $orderNoneSelected = '' == $this->SC_APP_data['order'] ? ' selected="selected"' : '';
        $orderAscSelected = 'asc' == $this->SC_APP_data['order'] ? ' selected="selected"' : '';
        $orderDescSelected = 'desc' == $this->SC_APP_data['order'] ? ' selected="selected"' : '';

        $configButtonCode = trim(nmButtonOutput($this->arr_buttons, "bconf_graf", "showChartConfig()", "showChartConfig()", "Rgraf", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", ""));
        $okButtonCode = trim(nmButtonOutput($this->arr_buttons, "bok", "", "", "sc-id-button-submit", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", ""));
        $cancelButtonCode = trim(nmButtonOutput($this->arr_buttons, "bcancelar", "", "", "sc-id-button-cancel", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", ""));
 
        $htmlCode = <<<SCEOT
    {$configButtonCode}
    <div id="sc-id-chart-blockui"></div>
    <div id="sc-id-div-config" class="scGridToolbar">
        <div id="sc-id-div-config-input" class="group">
            <div class="input-group">
                <label>{$translate[$language] ['tipo_g']}</label>
                <select id="sc-id-chart-type" class="css_toolbar_obj">

SCEOT;
        foreach ($this->SC_APP_info['chart'] ['available_types'] as $chartType) {
            $typeSelected = $chartType == $this->SC_APP_data['type'] ? ' selected="selected"' : '';
             switch ($chartType) {
                case 'Area':
                   $chartTitle = 'tp_area';
                   break;
                case 'Bar':
                   $chartTitle = 'tp_barra';
                   break;
                case 'Funnel':
                   $chartTitle = 'tp_funil';
                   break;
                case 'Gauge':
                   $chartTitle = 'tp_gauge';
                   break;
                case 'Line':
                   $chartTitle = 'tp_linha';
                   break;
                case 'Mark':
                   $chartTitle = 'tp_marcador';
                   break;
                case 'Pie':
                   $chartTitle = 'tp_pizza';
                   break;
                case 'Pyramid':
                   $chartTitle = 'tp_pyramid';
                   break;
                case 'Polar':
                   $chartTitle = 'tp_polar';
                   break;
                case 'Radar':
                   $chartTitle = 'tp_radar';
                   break;
             }

            $htmlCode .= <<<SCEOT
                    <option value="{$chartType}"{$typeSelected}>{$translate[$language] [$chartTitle]}</option>
            
SCEOT;
        }
        $htmlCode .= <<<SCEOT
                </select>
            </div>
            <div class="input-group">
                <label>{$translate[$language] ['modo_gera']}</label>
                <select id="sc-id-chart-mode" class="css_toolbar_obj">
                    <option value="{$modeSyntheticValue}"{$modeSyntheticSelected}>{$translate[$language] ['sintetico']}</option>
                    <option value="{$modeAnalyticValue}"{$modeAnalyticSelected}>{$translate[$language] ['analitico']}</option>
                </select>
            </div>
            <div class="input-group">
                <label>{$translate[$language] ['largura']}</label>
                <input id="sc-id-chart-width" type="text" size="5" value="{$this->SC_APP_data['width']}" class="css_toolbar_obj" style="text-align: right" />
            </div>
            <div class="input-group">
                <label>{$translate[$language] ['altura']}</label>
                <input id="sc-id-chart-height" type="text" size="5" value="{$this->SC_APP_data['height']}" class="css_toolbar_obj" style="text-align: right" />
            </div>
            <div class="input-group">
                <label>{$translate[$language] ['order']}</label>
                <select id="sc-id-chart-order" class="css_toolbar_obj">
                    <option value=""{$orderNoneSelected}>{$translate[$language] ['order_none']}</option>
                    <option value="asc"{$orderAscSelected}>{$translate[$language] ['order_asc']}</option>
                    <option value="desc"{$orderDescSelected}>{$translate[$language] ['order_desc']}</option>
                </select>
            </div>
        </div>
        <div id="sc-id-div-config-button" class="input-group">
            {$okButtonCode}
            {$cancelButtonCode}
        </div>
    </div>
    <form name="refresh_chart" action="./" method="POST">

SCEOT;
        foreach ($_POST as $postItem => $postValue) {
            $htmlCode .= <<<SCEOT
        <input type="hidden" name="{$postItem}" value="{$postValue}" />

SCEOT;
        }
        $htmlCode .= <<<SCEOT
    </form>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsDiv_inline()
    {
        $htmlCode = <<<SCEOT
    <div id="{$this->SC_APP_data['chart_div']}" style="display: inline-block; position: sticky; left: 0"></div>


SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsDiv_newPage()
    {
        $backgroundColor = '#FFFFFF';
        $fontColor = '#000000';

        $chartTheme = $this->load_chart_theme();
        if (isset($chartTheme['bgColor']) && '' != $chartTheme['bgColor']) {
            $backgroundColor = $chartTheme['bgColor'];
            $fontColor = $chartTheme['captionFontColor'];
        }

        $htmlCode = <<<SCEOT
    <div style="position: relative;">
        <div id="{$this->SC_APP_data['chart_div']}" style="width: 100%"></div>
        <div id="sc-id-fusioncharts-error" style="position: absolute; display: none; background-color: {$backgroundColor}; color: {$fontColor}">
            <div style="display: flex; height: 100%; justify-content: center; align-items: center;" id="sc-id-fusioncharts-error-message"></div>
        </div>
    </div>
    <script type="text/javascript">var scCombChartId = "{$this->SC_APP_data['chart_div']}";</script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsDiv_breadcrumb()
    {
        $htmlCode = <<<SCEOT
    <div id="sc-id-drilldown-breadcrumb" style="display: none"></div>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsJavascript_function()
    {
        $jsServer = '';
        if ('pdf' == $useServer) {
            $jsServer = $this->Ini->server_pdf;
        }

        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        let scFusionCharts;
        let scFusionChartsType = "{$this->SC_APP_data['fusioncharts_javascript'] ['type']}";
        let scFusionChartsDataSource = "{$jsServer}{$this->SC_APP_data['fusioncharts_javascript'] ['dataSource']}";
        let scFusionChartsWidth = "{$this->SC_APP_data['width']}";
        let scFusionChartsHeight = "{$this->SC_APP_data['height']}";
        function scFusionCharts_create(chartType, chartDataSource, chartWidth, chartHeight, errorMessage) {
            var _0x2a9c6f=_0x1dca;function _0x1dca(_0xe4377e,_0x1b81e2){var _0x5b52f4=_0x5b52();return _0x1dca=function(_0x1dca71,_0x2a923f){_0x1dca71=_0x1dca71-0x1c7;var _0x141613=_0x5b52f4[_0x1dca71];return _0x141613;},_0x1dca(_0xe4377e,_0x1b81e2);}function _0x5b52(){var _0x2f555f=['667805zEUTHi','2537110AnXgKT','9908390zHctCU','8968kYpBKO','4xIkojs','3cNIlPu','license','159962VsDImE','5018772jBJBQw','7rNiKXc','1067788GrVIGD','2700mLIdJZ'];_0x5b52=function(){return _0x2f555f;};return _0x5b52();}(function(_0x4cefc0,_0x430fb3){var _0x10ab7a=_0x1dca,_0x50734d=_0x4cefc0();while(!![]){try{var _0x9fcd02=-parseInt(_0x10ab7a(0x1ce))/0x1+parseInt(_0x10ab7a(0x1cc))/0x2*(parseInt(_0x10ab7a(0x1c7))/0x3)+parseInt(_0x10ab7a(0x1d2))/0x4*(parseInt(_0x10ab7a(0x1cf))/0x5)+-parseInt(_0x10ab7a(0x1ca))/0x6*(parseInt(_0x10ab7a(0x1cb))/0x7)+parseInt(_0x10ab7a(0x1d1))/0x8*(parseInt(_0x10ab7a(0x1cd))/0x9)+parseInt(_0x10ab7a(0x1d0))/0xa+parseInt(_0x10ab7a(0x1c9))/0xb;if(_0x9fcd02===_0x430fb3)break;else _0x50734d['push'](_0x50734d['shift']());}catch(_0x5b5696){_0x50734d['push'](_0x50734d['shift']());}}}(_0x5b52,0xd688a),FusionCharts['options'][_0x2a9c6f(0x1c8)]({'key':'YcC1orx'+'B1D8B1D3F3'+'C2D2F1C2B4A7B6'+'C4C-9ni1C2C5i'+'qC-13avH2I2es'+'lE2D6E2C3E3'+'G3I3B7A4E2'+'F4B2E3D4F3H3B'+'-22ffF4E2'+'D3nD2G'+'1B6cfqB2'+'E3C1C-7yhB1E'+'4B1suwA33A8B'+'14C5D7'+'A2D5G2H4B3B2'+'hbbA3C4IA2'+'rveA4D4E2'+'C-11oF1I'+'1F2C2'+'eevE6E1G4F2A1'+'C3B1'+'E6E2A2C5F1'+'D1F2l==','creditLabel':![]}));
            FusionCharts.ready(function() {
                scFusionCharts = new FusionCharts({
                    "renderAt": "{$this->SC_APP_data['chart_div']}",
                    "id": "{$this->SC_APP_data['chart_id']}",
                    "type": chartType,
                    "width": chartWidth,
                    "height": chartHeight,
                    "dataFormat": "{$this->SC_APP_data['chart_dataFormat']}",
                    "dataSource": chartDataSource,
                    "loadMessage": "{$this->Ini->Nm_lang['lang_msg_chart_load']}",
                    "dataEmptyMessage": "{$this->Ini->Nm_lang['lang_msg_chart_empty']}",
                }).render();
                if ("" !== errorMessage) {
                    scFusionCharts_showErrorMessage(errorMessage);
                }
            });
        }
        function scFusionCharts_showErrorMessage(errorMessage)
        {
            let chartContainer = $("#{$this->SC_APP_data['chart_div']}");
            $("#sc-id-fusioncharts-error-message").html(errorMessage);
            $("#sc-id-fusioncharts-error")
                .offset({top: 0, left: 0})
                .width(chartContainer.width())
                .height(chartContainer.height())
                .show();
        }
        function scFusionCharts_hideErrorMessage()
        {
            $("#sc-id-fusioncharts-error").hide();
        }
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsJavascript_phantom()
    {
        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        FusionCharts.options.license({
            key: "YcC1orxB1D8B1D3F3C2D2F1C2B4A7B6C4C-9ni1C2C5iqC-13avH2I2eslE2D6E2C3E3G3I3B7A4E2F4B2E3D4F3H3B-22ffF4E2D3nD2G1B6cfqB2E3C1C-7yhB1E4B1suwA33A8B14C5D7A2D5G2H4B3B2hbbA3C4IA2rveA4D4E2C-11oF1I1F2C2eevE6E1G4F2A1C3B1E6E2A2C5F1D1F2l==",
            creditLabel: false,
        });
        FusionCharts.ready(function() {
            var scFusionCharts = new FusionCharts({
                "creditLabel": false,
                "renderAt": "{$this->SC_APP_data['chart_div']}",
                "id": "{$this->SC_APP_data['chart_id']}",
                "type": "{$this->SC_APP_data['fusioncharts_javascript'] ['type']}",
                "width": "{$this->SC_APP_data['phantom_width']}",
                "height": "{$this->SC_APP_data['phantom_height']}",
                "dataFormat": "{$this->SC_APP_data['chart_dataFormat']}",
                "dataSource": "{$this->Ini->server_pdf}{$this->SC_APP_data['fusioncharts_javascript'] ['dataSource']}",
            }).render();
        });
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsJavascript_onReady()
    {
        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        $(function() {
            scFusionCharts_create(scFusionChartsType, scFusionChartsDataSource, scFusionChartsWidth, scFusionChartsHeight, '');
        });
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsJavascript_chartApp()
    {
        $scPage = NM_encode_input($this->Ini->sc_page);
        $ajaxUrl = "{$this->Ini->path_link}grid_deduction_fdu_hist/index.php";

        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        function changeChartType(newType, chartAction)
        {
            if ("" == newType) {
                newType = fc_chart_type;
            }
            $.ajax({
                type: "POST",
                url: "{$ajaxUrl}",
                dataType: "json",
                data: {
                    chartapp_action: "Y",
                    chartapp_chart_type: "Y",
                    script_case_init: "{$scPage}",
                    chart_md5: scChartInlineMd5,
                    chart_type: newType,
                    chart_action: chartAction,
                }
            }).done(function(data) {
                scFusionCharts_hideErrorMessage();
                if ("" === data.errorMessage) {
                    scFusionCharts.chartType(data.chartType, {
                        dataSource: data.chartUrl,
                        dataFormat: "jsonUrl"
                    });
                } else {
                    scFusionCharts_showErrorMessage(data.errorMessage);
                }
                if ("scSaveChartChanges" == chartAction) {
                    scChartInlineMd5 = data.chartMd5;
                    drillDownBreadcrumb = [{
                        label: data.chartTitle,
                        md5: data.chartMd5
                    }];
                    chartDrillDown_content();
                }
                if ("scChangeChartType" == chartAction || "scSaveChartSorting" == chartAction) {
                    scChartInlineMd5 = data.chartMd5;
                    chartDrillDown_clearBreadcrumb();
                }
            });
        }
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsJavascript_drilldown()
    {
        $scPage = NM_encode_input($this->Ini->sc_page);
        $ajaxUrl = "{$this->Ini->path_link}grid_deduction_fdu_hist/index.php";

        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        let drillDownBreadcrumb = [{
            label: "{$this->SC_APP_data['fusioncharts_json'] ['sc'] ['chart_title']}",
            md5: "{$this->SC_APP_data['fusioncharts_json'] ['sc'] ['chart_md5']}"
        }];
        function chartLink(chartMd5)
        {
            chartDrillDown(chartMd5);
        }
        function chartDrillDown(chartMd5)
        {
            $.ajax({
                type: "POST",
                url: "{$ajaxUrl}",
                dataType: "json",
                data: {
                    nmgp_opcao: "grafico",
                    summary_chart_data: "Y",
                    script_case_init: "{$scPage}",
                    chart_md5: chartMd5,
                }
            }).done(function(data) {
                drillDownBreadcrumb.push({
                    label: data.sc.chart_subtitle,
                    md5: data.sc.chart_md5
                });
                scFusionCharts.setChartData(data);
                chartDrillDown_content();
            });
        }
        function chartDrillDown_back(chartIndex)
        {
            $.ajax({
                type: "POST",
                url: "{$ajaxUrl}",
                dataType: "json",
                data: {
                    nmgp_opcao: "grafico",
                    summary_chart_data: "Y",
                    script_case_init: "{$scPage}",
                    chart_md5: drillDownBreadcrumb[chartIndex].md5,
                }
            }).done(function(data) {
                let removeCount = drillDownBreadcrumb.length - chartIndex - 1;
                while (removeCount > 0) {
                    drillDownBreadcrumb.pop();
                    removeCount--;
                }
                scFusionCharts.setChartData(data);
                chartDrillDown_content();
            });
        }
        function chartDrillDown_content()
        {
            if (1 == drillDownBreadcrumb.length) {
                $("#sc-id-drilldown-breadcrumb").html("").slideUp("slow");
            } else {
                let chartTitles = [], i, thisChartTitle;
                for (i = 0; i < drillDownBreadcrumb.length; i++) {
                    thisChartTitle = drillDownBreadcrumb[i].label;
                    if (i < drillDownBreadcrumb.length - 1) {
                        thisChartTitle = "<a href='javascript: chartDrillDown_back(" + i + ")'>" + thisChartTitle + "</a>"; 
                    }
                    chartTitles.push(thisChartTitle);
                }
                $("#sc-id-drilldown-breadcrumb").html(chartTitles.join(' <i class="fa-solid fa-angle-right"></i> '));
                if (2 == drillDownBreadcrumb.length) {
                    $("#sc-id-drilldown-breadcrumb").slideDown("slow")
                }
            }
        }
        function chartDrillDown_clearBreadcrumb()
        {
            while (1 < drillDownBreadcrumb.length) {
                drillDownBreadcrumb.pop();
            }
            chartDrillDown_content();
        }
        function chartLinkToGrid(chartInfo)
        {
            opener.nm_link_cons(chartInfo);
            window.close();
        }
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlFusionChartsJavascript_setInlineChartMd5($chartMd5)
    {
        $htmlCode = <<<SCEOT
    <script type="text/javascript">
        $(function() {
            scChartInlineMd5 = "{$chartMd5}";
        });
    </script>

SCEOT;

        return $htmlCode;
    }

    function display_chart_htmlSamePageBackButton()
    {
        global $nm_retorno_graf;

        if (!$this->SC_APP_info['options'] ['chart_same_page']) {
            return;
        }

        //$security = scSecurity_use_sc_session() ? '&script_case_session=' . session_id() : '';
        $scInit = NM_encode_input($this->Ini->sc_page);

        if (empty($nm_retorno_graf)) {
            $nm_retorno_graf = 'resumo';
        }

        $htmlCode = <<<SCEOT
<br /><br />
<a class="scGridPageLink" href="index.php?script_case_init={$scInit}{$security}&nmgp_opcao={$nm_retorno_graf}">{$this->Ini->Nm_lang['lang_btns_rtrn_hint']}</a>

SCEOT;

        return $htmlCode;
    }

    function aux_addTrendline_average($serie)
    {
        $mean = $this->calculateMean($serie);

        $lines = ['line' => []];
        $lines['line'][] = [
            'startvalue' => $mean,
            'tooltext' => '$startDataValue',
            'dashed' => '1',
            'dashLen' => '5',
            'dashGap' => '2',
        ];

        $this->SC_APP_data['fusioncharts_json'] ['trendlines'] [] = $lines;
    }

    function aux_addTrendline_fixed()
    {
        $lines = ['line' => []];
        $lines['line'][] = [
            'startvalue' => $this->SC_APP_info['options'] ['trendlineStart'],
            'tooltext' => '$startDataValue',
            'dashed' => '1',
            'dashLen' => '5',
            'dashGap' => '2',
        ];

        $this->SC_APP_data['fusioncharts_json'] ['trendlines'] [] = $lines;
    }

    function aux_addTrendline_linear($serie)
    {
        if (function_exists('bcscale')) {
            bcscale(10);
            $polynomialRegression = new PolynomialRegression(2);
            foreach ($serie as $i => $dataPoint) {
                $polynomialRegression->addData($i, $dataPoint);
            }
            $coefficients = $polynomialRegression->getCoefficients();
    
            $lines = ['line' => []];
            $lines['line'][] = [
                'startvalue' => $coefficients[0],
                'endvalue' => ($coefficients[1] * $i) + $coefficients[0],
                'tooltext' => '$startDataValue',
                'dashed' => '1',
                'dashLen' => '5',
                'dashGap' => '2',
            ];
    
            $this->SC_APP_data['fusioncharts_json'] ['trendlines'] [] = $lines;
        }
    }

    function aux_addTrendline_standardDeviation($serie)
    {
        $mean = $this->calculateMean($serie);
        $variance = $this->calculateVariance($serie, $mean);
        $stdDeviation = $this->calculateStandardDeviation($variance);

        $lines = ['line' => []];
        $lines['line'][] = [
            'startvalue' => $stdDeviation,
            'tooltext' => '$startDataValue',
            'dashed' => '1',
            'dashLen' => '5',
            'dashGap' => '2',
        ];

        $this->SC_APP_data['fusioncharts_json'] ['trendlines'] [] = $lines;
    }

    function aux_addTrendline_variance($serie)
    {
        $mean = $this->calculateMean($serie);
        $variance = $this->calculateVariance($serie, $mean);

        $lines = ['line' => []];
        $lines['line'][] = [
            'startvalue' => $variance,
            'tooltext' => '$startDataValue',
            'dashed' => '1',
            'dashLen' => '5',
            'dashGap' => '2',
        ];

        $this->SC_APP_data['fusioncharts_json'] ['trendlines'] [] = $lines;
    }

    function aux_addTrendline_zone()
    {
        $lines = ['line' => []];
        $lines['line'][] = [
            'isTrendZone' => 1,
            'startvalue' => $this->SC_APP_info['options'] ['trendlineStart'],
            'endvalue' => $this->SC_APP_info['options'] ['trendlineEnd'],
            'tooltext' => '$startDataValue - $endDataValue',
            'displayvalue' => ' ',
        ];

        $this->SC_APP_data['fusioncharts_json'] ['trendlines'] [] = $lines;
    }

    function aux_filterChartItems()
    {
        $itemCount = 0;
        $itemValues = [];

        foreach ($this->SC_APP_data['md5_data'] ['data_synthetic'] [self::GROUPBY_ORIGINAL] as $dimensionValue => $dimensionInfo) {
            $itemValues[ $dimensionInfo['label'] ] = $dimensionInfo['value'];
        }

        arsort($itemValues);

        foreach ($itemValues as $dimensionLabel => $dimensionValue) {
            $this->SC_APP_data['filtered_chart_items'] [] = $dimensionLabel;

            $itemCount++;
            if ($itemCount == $this->SC_APP_data['limit_chart_items']) {
                break;
            }
        }
    }

    function aux_format_sal_brut_reg_S()
    {
        $chartFormat = [
            'decimals' => "2",
            'decimalSeparator' => ".",
            'thousandSeparator' => ",",
            'trailingZeros' => "2",
            'monetarySymbol' => "HTG",
            'monetaryPosition' => "left",
            'monetarySpace' => " ",
            'monetaryDecimal' => ".",
            'monetaryThousands' => ",",
            'formatNumberScale' => "0",
            'forceDecimals' => "1",
        ];

        return $this->aux_formatFinalize($chartFormat);
    }

    function aux_format_tax_fdu_S()
    {
        $chartFormat = [
            'decimals' => "2",
            'decimalSeparator' => ".",
            'thousandSeparator' => ",",
            'trailingZeros' => "2",
            'monetarySymbol' => "HTG",
            'monetaryPosition' => "left",
            'monetarySpace' => " ",
            'monetaryDecimal' => ".",
            'monetaryThousands' => ",",
            'formatNumberScale' => "0",
            'forceDecimals' => "1",
        ];

        return $this->aux_formatFinalize($chartFormat);
    }

    function aux_formatFinalize($formatConfig)
    {
        $monetaryIni = '';
        $monetaryEnd = '';
        
        if ('' != $formatConfig['monetarySymbol']) {
            if ('' == $formatConfig['monetaryPosition'] || 'left' == $formatConfig['monetaryPosition']) {
                $monetaryIni = $this->aux_protectText($formatConfig['monetarySymbol']) . $formatConfig['monetarySpace'];
                $monetaryEnd = '';
            } else {
                $monetaryIni = '';
                $monetaryEnd = $formatConfig['monetarySpace'] . $this->aux_protectText($formatConfig['monetarySymbol']);
            }
            $formatConfig['decimalSeparator'] = $formatConfig['monetaryDecimal'];
            $formatConfig['thousandSeparator'] = $formatConfig['monetaryThousands'];
        }
        if ('' == $formatConfig['decimals']) {
            $formatConfig['decimals'] = 0;
            unset($formatConfig['trailingZeros']);
        } elseif (1 != $formatConfig['forceDecimals']) {
            $formatConfig['forceDecimals'] = 0;
        } else {
            $formatConfig['forceDecimals'] = 1;
        }
        if ('' == $formatConfig['trailingZeros']) {
            unset($formatConfig['trailingZeros']);
        }
        if ('' != $monetaryIni) {
            $formatConfig['numberPrefix'] = $monetaryIni;
        }
        if ('' != $monetaryEnd) {
            $formatConfig['numberSuffix'] = $monetaryEnd;
        }
        unset($formatConfig['monetarySymbol']);
        unset($formatConfig['monetaryPosition']);
        unset($formatConfig['monetarySpace']);
        unset($formatConfig['monetaryDecimal']);
        unset($formatConfig['monetaryThousands']);
        
        if (',' == $formatConfig['decimalSeparator']) {
            unset($formatConfig['decimalSeparator']);
            $formatConfig['decimalSeparator'] = ',';
        }
        if (',' == $formatConfig['thousandSeparator']) {
            unset($formatConfig['thousandSeparator']);
            $formatConfig['thousandSeparator'] = ',';
        }
        
        if (isset($formatConfig['formatNumberScale']) && '1' == $formatConfig['formatNumberScale']) {
            unset($formatConfig['trailingZeros']);
            $formatConfig['decimals'] = 0;
        }
        
        foreach ($formatConfig as $i => $v) {
            if ('' === $v) {
                unset($formatConfig[$i]);
            }
        }
        
        return $formatConfig;
    }

    function aux_getChartErrorMessage()
    {
        $dimensionCount = isset($this->SC_APP_data['md5_data'] ['dimension_list']) && is_array($this->SC_APP_data['md5_data'] ['dimension_list']) ? count($this->SC_APP_data['md5_data'] ['dimension_list']) : 0;
        $metricCount = isset($this->SC_APP_data['md5_data'] ['metric']) && is_array($this->SC_APP_data['md5_data'] ['metric']) ? count($this->SC_APP_data['md5_data'] ['metric']) : 0;
        //return $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] . ' - ' . $dimensionCount . ' - ' . $metricCount;

        switch ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo']) {
            case 'Bubble':
                    if (3 != $metricCount) {
                        return "{$this->Ini->Nm_lang['lang_msg_chart_bubble']}";
                    }
                break;
            case 'Chord':
                    if (2 != $dimensionCount && 1 != $metricCount) {
                        return "{$this->Ini->Nm_lang['lang_msg_chart_chord']}";
                    }
                break;
            case 'Combination':
                    if (2 > $metricCount) {
                        return "{$this->Ini->Nm_lang['lang_msg_chart_combination']}";
                    }
                break;
            case 'Heatmap':
                    if (2 != $dimensionCount && 1 != $metricCount) {
                        return "{$this->Ini->Nm_lang['lang_msg_chart_heatmap']}";
                    }
                break;
            case 'Sankey':
                    if (2 != $dimensionCount && 1 != $metricCount) {
                        return "{$this->Ini->Nm_lang['lang_msg_chart_sankey']}";
                    }
                break;
            case 'Scatter':
                    if (2 != $metricCount) {
                        return "{$this->Ini->Nm_lang['lang_msg_chart_scatter']}";
                    }
                break;
            case 'Sunburst':
                    if (1 != $metricCount) {
                        return "{$this->Ini->Nm_lang['lang_msg_chart_sunburst']}";
                    }
                break;
            case 'Treemap':
                    if (2 != $dimensionCount && 2 != $metricCount) {
                        return "{$this->Ini->Nm_lang['lang_msg_chart_treemap']}";
                    }
                break;
            default:
                //return $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'];
                break;
        }

        return '';
    }

    function aux_getChartInfoType()
    {
        switch ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo']) {
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

    function aux_getChartLink($dimension, $metric, $parameters, $thisValue)
    {
        $identifierParameters = [];
        foreach ($parameters as $parameterInfo) {
            $identifierParameters[] = $parameterInfo['value'];
        }
        $identifierParameters[] = $thisValue;
        return $this->aux_getChartLinkMd5($dimension, $metric, $identifierParameters);
    }

    function aux_getChartLinkInfo($identifierParameters)
    {
        $linkInfo = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_drilldown'] ['chart_links_to_grid'];

        while (!empty($identifierParameters)) {
            $thisParameter = array_shift($identifierParameters);
            $linkInfo = $linkInfo[$thisParameter];
        }

        return $linkInfo['__sc_chart_link'];
    }

    function aux_getChartLinkMd5($dimension, $metric, $identifierParameters)
    {
        $dimensionLabel = [];
        foreach ($dimension as $dimensionInfo) {
            $dimensionLabel[] = $dimensionInfo;
        }

        $metricLabel = [];
        foreach ($metric as $metricInfo) {
            $metricLabel[] = $metricInfo['label'];
        }

        $identifier = 'Dim(' . implode('+', $dimensionLabel) . ')_X_Met(' . implode('+', $metricLabel) . ')_|_Par(' . implode('+', $identifierParameters) . ')';

        return md5($identifier);
    }

    function aux_getFusionChartsRenderer()
    {
        if ($this->SC_APP_data['md5_data'] ['options'] ['is_comparison']) {
            return $this->aux_getFusionChartsComparisonRenderer();
        }

        $multiSeriesSuffix = $this->aux_isMultiSeries() ? 'ms' : '';

        switch ($this->SC_APP_data['type']) {
            case 'Area':
                if ($this->aux_isMultiSeries() && $this->SC_APP_info['types'] ['area'] ['stacking']) {
                    return 'stackedarea2d';
                } elseif ($this->SC_APP_info['types'] ['area'] ['isScroll']) {
                    return 'scrollarea2d';
                } elseif ('Spline' == $this->SC_APP_info['types'] ['area'] ['format']) {
                    return $multiSeriesSuffix . 'splinearea';
                } elseif ($this->aux_isMultiSeries()) {
                    return 'msarea';
                } else {
                    return 'area2d';
                }
                break;

            case 'Bar';
                if ($this->aux_isMultiSeries() && $this->SC_APP_info['types'] ['bar'] ['stacking']) {
                    $multiSeriesSuffix = 'stacked';
                }
                if ('Horizontal' == $this->SC_APP_info['types'] ['bar'] ['orientation']) {
                    if ($this->SC_APP_info['types'] ['bar'] ['isScroll']) {
                        return 'scrollbar2d';
                    } elseif ($this->SC_APP_info['types'] ['bar'] ['isOverlapped']) {
                        return 'overlappedbar2d';
                    } elseif ('2d' == $this->SC_APP_info['types'] ['bar'] ['dimension']) {
                        return $multiSeriesSuffix . 'bar2d';
                    } else {
                        return $multiSeriesSuffix . 'bar3d';
                    }
                } else {
                    if ($this->SC_APP_info['types'] ['bar'] ['isScroll']) {
                        return 'scrollcolumn2d';
                    } elseif ($this->SC_APP_info['types'] ['bar'] ['isOverlapped']) {
                        return 'overlappedcolumn2d';
                    } elseif ('2d' == $this->SC_APP_info['types'] ['bar'] ['dimension']) {
                        return $multiSeriesSuffix . 'column2d';
                    } else {
                        return $multiSeriesSuffix . 'column3d';
                    }
                }
                break;

            case 'Bubble';
                return 'bubble';
                break;

            case 'Chord';
                return 'chord';
                break;

            case 'Combination';
                    if ('2d' == $this->SC_APP_info['types'] ['combination'] ['dimension']) {
                        return 'mscombidy2d';
                    } else {
                        return 'mscolumn3dlinedy';
                    }
                break;

            case 'Funnel';
                return 'funnel';
                break;

            case 'Gauge';
                if ('LinearGauge' == $this->SC_APP_info['types'] ['gauge'] ['format']) {
                    return 'hlineargauge';
                } else {
                    return 'angulargauge';
                }
                break;

            case 'Heatmap';
                return 'heatmap';
                break;

            case 'Line':
                if ($this->SC_APP_info['types'] ['line'] ['isScroll']) {
                    return 'scrollline2d';
                } elseif ($this->SC_APP_info['types'] ['line'] ['isZoom']) {
                    return 'zoomline';
                } elseif ('Spline' == $this->SC_APP_info['types'] ['line'] ['format']) {
                    return 'spline';
                } elseif ('Step' == $this->SC_APP_info['types'] ['line'] ['format']) {
                    return 'msstepline';
                } else {
                    return $multiSeriesSuffix . 'line';
                }
                break;

            case 'Pie':
                if ('Donut' == $this->SC_APP_info['types'] ['pie'] ['format']) {
                    if ('2d' == $this->SC_APP_info['types'] ['pie'] ['dimension']) {
                        return 'doughnut2d';
                    } else {
                        return 'doughnut3d';
                    }
                } else {
                    if ('2d' == $this->SC_APP_info['types'] ['pie'] ['dimension']) {
                        return 'pie2d';
                    } else {
                        return 'pie3d';
                    }
                }
                break;

            case 'Pyramid';
                return 'pyramid';
                break;

            case 'Radar';
                return 'radar';
                break;

            case 'Sankey';
                return 'sankey';
                break;

            case 'Sunburst';
                return 'sunburst';
                break;

            case 'Scatter';
                return 'scatter';
                break;

            case 'Treemap';
                return 'treemap';
                break;
        }
    }

    function aux_getFusionChartsComparisonRenderer()
    {
        $chartType = $this->SC_APP_data['type'];
        if (!in_array($chartType, ['Area', 'Bar', 'Line', 'Radar'])) {
            $chartType = $this->SC_APP_info['chart'] ['available_comparison_types'] [0];
        }
 
        switch ($chartType) {
            case 'Area':
                if ('Spline' == $this->SC_APP_info['types'] ['area'] ['format']) {
                    return 'mssplinearea';
                } else {
                    return 'msarea';
                }
                break;

            case 'Bar';
                if ('Horizontal' == $this->SC_APP_info['types'] ['bar'] ['orientation']) {
                    if ('2d' == $this->SC_APP_info['types'] ['bar'] ['dimension']) {
                        return 'msbar2d';
                    } else {
                        return 'msbar3d';
                    }
                } else {
                    if ('2d' == $this->SC_APP_info['types'] ['bar'] ['dimension']) {
                        return 'mscolumn2d';
                    } else {
                        return 'mscolumn3d';
                    }
                }
                break;

            case 'Line':
                if ('Step' == $this->SC_APP_info['types'] ['line'] ['format']) {
                    return 'msstepline';
                } else {
                    return 'msline';
                }
                break;

            case 'Radar';
                return 'radar';
                break;
        }
    }

    function aux_getMetricField($metricInfo)
    {
        if (1 == count($metricInfo)) {
            return $metricInfo[0] ['field'];
        }
    }

    function aux_getMetricLabel($metricInfo)
    {
        if (!is_array($metricInfo)) {
            return $metricInfo;
        } elseif (1 == count($metricInfo)) {
            return $metricInfo[0] ['label'];
        } else {
            $metricLabel = [];
            foreach ($metricInfo as $thisMetricInfo) {
                $metricLabel[] = $thisMetricInfo['label'];
            }
            return implode(', ', $metricLabel);
        }
    }

    function aux_isJsonChartCreated()
    {
        return @is_file($this->SC_APP_info['chart'] ['json_base_dir'] . $this->SC_APP_info['chart'] ['json_filename']);
    }

    function aux_isMobile()
    {
        return $_SESSION['scriptcase'] ['proc_mobile'];
    }

    function aux_isMultiSeries()
    {
        if (self::CHART_MODE_ANALYTIC == $this->SC_APP_data['data_mode'] && !empty($this->SC_APP_data['md5_data'] ['data_analytic'])) {
            switch ($this->SC_APP_data['type']) {
                case 'Area':
                case 'Bar';
                case 'Line':
                    if ('Spline' != $this->SC_APP_info['types'] ['line'] ['format']) {
                        return true;
                    }
            }
        }

        return false;
    }

    function aux_isPdf()
    {
        if ('pdf' == $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['opcao']) {
            return true;
        }

        return false;
    }

    function aux_isResponsive()
    {
        return $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['responsive_chart'] ['active'];
    }

    function aux_isUtf8()
    {
        return 'UTF-8' == $_SESSION['scriptcase'] ['charset'];
    }

    function aux_orderChartMultipleSeries()
    {
        $this->tempSortField = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_combination_order_field'];
        $this->tempSortRule = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_combination_order_rule'];

        if ('label' == $this->tempSortField || !isset($this->SC_APP_data['fusioncharts_json'] ['dataset'] [$this->tempSortField])) {
            $sortSerie = $this->SC_APP_data['fusioncharts_json'] ['categories'] [0] ['category'];

            uasort($sortSerie, function($a, $b) {
                if ('asc' == $this->tempSortRule) {
                    return strnatcmp($a['label'], $b['label']);
                } else {
                    return strnatcmp($b['label'], $a['label']);
                }
            });
        } else {
            $sortSerie = $this->SC_APP_data['fusioncharts_json'] ['dataset'] [$this->tempSortField] ['data'];

            uasort($sortSerie, function($a, $b) {
                if ('asc' == $this->tempSortRule) {
                    return strnatcmp($a['value'], $b['value']);
                } else {
                    return strnatcmp($b['value'], $a['value']);
                }
            });
        }

        $sortKeys = array_keys($sortSerie);

        $categories = [];
        $series = [];
        foreach ($sortKeys as $thisKey) {
            $categories[] = $this->SC_APP_data['fusioncharts_json'] ['categories'] [0] ['category'] [$thisKey];
            foreach ($this->SC_APP_data['fusioncharts_json'] ['dataset'] as $datasetIndex => $datasetInfo) {
                if (!isset($series[$datasetIndex])) {
                    $series[$datasetIndex] = [];
                }

                $series[$datasetIndex] [] = $datasetInfo['data'] [$thisKey];
            }
        }

        $this->SC_APP_data['fusioncharts_json'] ['categories'] [0] ['category'] = $categories;
        foreach ($this->SC_APP_data['fusioncharts_json'] ['dataset'] as $datasetIndex => $datasetInfo) {
            $this->SC_APP_data['fusioncharts_json'] ['dataset'] [$datasetIndex] ['data'] = $series[$datasetIndex];
        }
    }

    function aux_orderChartSingleSerie()
    {
        $this->tempSortField = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_combination_order_field'];
        $this->tempSortRule = $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['chart_combination_order_rule'];

        usort($this->SC_APP_data['fusioncharts_json'] ['data'], function($a, $b) {
            if ('label' == $this->tempSortField) {
                if ('asc' == $this->tempSortRule) {
                    return strnatcmp($a['label'], $b['label']);
                } else {
                    return strnatcmp($b['label'], $a['label']);
                }
            } elseif ($a['value'] == $b['value']) {
                if ('asc' == $this->tempSortRule) {
                    return strnatcmp($a['label'], $b['label']);
                } else {
                    return strnatcmp($b['label'], $a['label']);
                }
            } else {
                if ('asc' == $this->tempSortRule) {
                    return strnatcmp($a['value'], $b['value']);
                } else {
                    return strnatcmp($b['value'], $a['value']);
                }
            }
        });
    }

    function aux_orderSerie(&$serie, $direction)
    {
        $this->tempSortRule = $direction;

        uasort($serie, function($a, $b) {
            if ($a['value'] == $b['value']) {
                if ('asc' == $this->tempSortRule) {
                    return strnatcmp($a['label'], $b['label']);
                } else {
                    return strnatcmp($b['label'], $a['label']);
                }
            } else {
                if ('asc' == $this->tempSortRule) {
                    return strnatcmp($a['value'], $b['value']);
                } else {
                    return strnatcmp($b['value'], $a['value']);
                }
            }
        });
    }

    function aux_protectText($s)
    {
        if ('UTF-8' != $_SESSION['scriptcase'] ['charset'])
        {
            $s = sc_convert_encoding($s, 'UTF-8', $_SESSION['scriptcase'] ['charset']);
        }

        return function_exists('html_entity_decode') ? html_entity_decode($s, ENT_COMPAT | ENT_HTML401, 'UTF-8') : $s;
    }

    function aux_rearrangeOrderIndexes(&$serie)
    {
        $newSerie = [];

        foreach ($serie as $itemIndex => $itemInfo) {
            $newSerie[] = $itemInfo;
        }

        $serie = $newSerie;
    }

    function aux_rearrangeOrderMultiIndexes(&$serie, &$category)
    {
        $newSerie = [];
        $newCategory = [];

        foreach ($serie as $itemIndex => $itemInfo) {
            $newSerie[] = $itemInfo;
            $newCategory[] = $category[$itemIndex];
        }

        $serie = $newSerie;
        $category = $newCategory;
    }

    function aux_setChartType($chartType)
    {
        switch ($chartType) {
            // bar
            case 'bar2d':
            case 'msbar2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Horizontal';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '2d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'Off';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = false;
                break;

            case 'bar3d':
            case 'msbar3d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Horizontal';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '3d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'Off';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = false;
                break;

            case 'column2d':
            case 'mscolumn2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Vertical';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '2d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'Off';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = false;
                break;

            case 'column3d':
            case 'mscolumn3d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Vertical';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '3d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'Off';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = false;
                break;

            case 'stackedbar2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Horizontal';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '2d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'On';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = false;
                break;

            case 'stackedbar3d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Horizontal';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '3d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'On';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = false;
                break;

            case 'stackedcolumn2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Vertical';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '2d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'On';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = false;
                break;

            case 'stackedcolumn3d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Vertical';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '3d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'On';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = false;
                break;

            case 'scrollbar2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Horizontal';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '2d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'Off';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = true;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = false;
                break;

            case 'overlappedbar2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Horizontal';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '2d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'Off';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = true;
                break;

            case 'scrollcolumn2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Vertical';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '2d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'Off';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = true;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = false;
                break;

            case 'overlappedcolumn2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bar';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_orien'] = 'Vertical';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_dimen'] = '2d';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_empil'] = 'Off';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_barra_is_overlapped'] = true;
                break;

            // line
            case 'line':
            case 'msline':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Line';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_forma'] = 'Line';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_zoom'] = false;
                break;

            case 'spline':
            case 'msspline':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Line';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_forma'] = 'Spline';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_zoom'] = false;
                break;

            case 'stepline':
            case 'msstepline':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Line';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_forma'] = 'Step';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_zoom'] = false;
                break;

            case 'scrollline2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Line';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_scroll'] = true;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_zoom'] = false;
                break;

            case 'zoomline':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Line';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_scroll'] = false;
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_linha_is_zoom'] = true;
                break;

            // area
            case 'area':
            case 'area2d':
            case 'msarea':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Area';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_forma'] = 'Area';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_empil'] = 'Off';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_is_scroll'] = false;
                break;

            case 'splinearea':
            case 'mssplinearea':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Area';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_forma'] = 'Spline';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_empil'] = 'Off';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_is_scroll'] = false;
                break;

            case 'scrollarea2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Area';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_forma'] = 'Area';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_empil'] = 'Off';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_is_scroll'] = true;
                break;

            case 'stackedarea':
            case 'stackedarea2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Area';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_forma'] = 'Area';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_empil'] = 'On';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_area_is_scroll'] = false;
                break;

            // pie
            case 'pie2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Pie';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_forma'] = 'Pie';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_dimen'] = '2d';
                break;

            case 'pie3d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Pie';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_forma'] = 'Pie';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_dimen'] = '3d';
                break;

            case 'doughnut2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Pie';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_forma'] = 'Donut';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_dimen'] = '2d';
                break;

            case 'doughnut3d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Pie';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_forma'] = 'Donut';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pizza_dimen'] = '3d';
                break;

            // gauge
            case 'angulargauge':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Gauge';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_gauge_forma'] = 'Circular';
                break;

            case 'semicirculargauge':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Gauge';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_gauge_forma'] = 'Semicircular';
                break;

            case 'hlineargauge':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Gauge';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_gauge_forma'] = 'LinearGauge';
                break;

            // heatmap
            case 'heatmap':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Heatmap';
                break;

            // treemap
            case 'treemap':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Treemap';
                break;

            // chord
            case 'chord':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Chord';
                break;

            // sankey
            case 'sankey':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Sankey';
                break;

            // sunburst
            case 'sunburst':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Sunburst';
                break;

            // pyramid
            case 'pyramid':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Pyramid';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pyram_dimen'] = '3d';
                break;

            case 'pyramid2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Pyramid';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_pyram_dimen'] = '2d';
                break;

            // funnel
            case 'funnel':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Funnel';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_funil_dimen'] = '3d';
                break;

            case 'funnel2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Funnel';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_funil_dimen'] = '2d';
                break;

            // radar
            case 'radar':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Radar';
                break;

            // scatter
            case 'scatter':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Scatter';
                break;

            // bubble
            case 'bubble':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Bubble';
                break;

            // combination
            case 'mscombidy2d':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Combination';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_combi_dimen'] = '2d';
                break;

            case 'mscolumn3dlinedy':
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo'] = 'Combination';
                $_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_combi_dimen'] = '3d';
                break;
        }
    }

    function aux_setFusionchartsFix()
    {
        $this->SC_APP_info['chart'] ['fusioncharts_fix'] = '';

        if ($this->aux_isPdf()) {
            return;
        }
        switch ($_SESSION['sc_session'] [$this->Ini->sc_page] ['grid_deduction_fdu_hist'] ['cfg_graf'] ['graf_tipo']) {
            case 'Bubble':
            case 'Chord':
            case 'Funnel':
            case 'Gauge';
            case 'Pie';
            case 'Pyramid':
            case 'Radar':
            case 'Sankey':
            case 'Scatter':
            case 'Sunburst':
            case 'Treemap':
                return;
        }

        $this->SC_APP_info['chart'] ['fusioncharts_fix'] = '<br />';
    }

   //---- 
   function monta_grafico($chart_key = '', $operation = 'chart', $graf_col = false)
   {
       $graf_field = false;
       $this->graf_col = $graf_col;
       if (is_array($chart_key) && isset($chart_key['field']))
       {
           $field = $chart_key['field'];
           $graf_field = true;
       }
       if ('pdf_lib' == $operation)
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf'];
           $this->grafico_flash_js();
           return;
       }
       if ($graf_field)
       {
           $this->sc_graf_sint = true;
       }
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_opc_atual'] == 1)
       {
           $this->sc_graf_sint = true;
       }

       $b_export = false;
       if (isset($_GET['flash_graf']) && 'chart' == $_GET['flash_graf'])
       {
           $b_export = true;
           $chart_key = key($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['pivot_charts']);
       }
       elseif ('' == $chart_key)
       {
           $chart_key = isset($_POST['nmgp_parms']) ? $_POST['nmgp_parms'] : '';
       }

       if ($graf_field)
       {
           $chart_data = array();
           $chart_data['title']    = $chart_key['title'];
           $chart_data['label_x']  = $chart_key['label_x'];
           $chart_data['label_y']  = $chart_key['label_y'];
           $chart_data['labels']   = $chart_key['labels'];
           $chart_data['show_sub'] = true;
           $chart_data['subtitle'] = "";
           $chart_data['format']   = $chart_key['format'];
           $chart_data['legend']   = "";
           $chart_data['values']['sint'] = $chart_key['vals'];
           $arr_param = array(
               'type'        => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_tipo'],
               'width'       => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_larg'],
               'height'      => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_alt'],
               'barra_orien' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_barra_orien'],
               'barra_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_barra_forma'],
               'barra_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_barra_dimen'],
               'barra_sobre' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_barra_sobre'],
               'barra_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_barra_empil'],
               'barra_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_barra_inver'],
               'barra_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_barra_agrup'],
               'barra_funil' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_barra_funil'],
               'pizza_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_pizza_forma'],
               'pizza_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_pizza_dimen'],
               'pizza_orden' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_pizza_orden'],
               'pizza_explo' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_pizza_explo'],
               'pizza_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_pizza_valor'],
               'linha_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_linha_forma'],
               'linha_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_linha_inver'],
               'linha_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_linha_agrup'],
               'area_forma'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_area_forma'],
               'area_empil'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_area_empil'],
               'area_inver'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_area_inver'],
               'area_agrup'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_area_agrup'],
               'marca_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_marca_inver'],
               'marca_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_marca_agrup'],
               'gauge_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_gauge_forma'],
               'radar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_radar_forma'],
               'radar_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_radar_empil'],
               'polar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_polar_forma'],
               'funil_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_funil_dimen'],
               'funil_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_funil_inver'],
               'pyram_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_pyram_dimen'],
               'pyram_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_pyram_valor'],
               'pyram_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field]['graf_pyram_forma'],
               'tit_datay'   => $chart_data['label_y'],
               'tit_label'   => $chart_data['label_x'],
               'tit_chart'   => $chart_data['title'],
               'export'      => 'N',
               'pdf'         => 'N',
               'xml'         => '',
           );
           $mode = 'full';
           $this->arr_param = $arr_param;
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']               = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist'][$field];
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_order'];
           $this->grafico_flash($arr_param, $this->grafico_dados($chart_data, $arr_param['export'], ''), $mode);
       }
       elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['pivot_charts'][$chart_key]))
       {
           $chart_data = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['pivot_charts'][$chart_key];

           $arr_param = array(
               'type'        => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_tipo'],
               'width'       => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_larg'],
               'height'      => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_alt'],
               'barra_orien' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_orien'],
               'barra_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_forma'],
               'barra_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_dimen'],
               'barra_sobre' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_sobre'],
               'barra_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_empil'],
               'barra_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_inver'],
               'barra_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_agrup'],
               'barra_funil' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_funil'],
               'pizza_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pizza_forma'],
               'pizza_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pizza_dimen'],
               'pizza_orden' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pizza_orden'],
               'pizza_explo' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pizza_explo'],
               'pizza_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pizza_valor'],
               'linha_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_linha_forma'],
               'linha_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_linha_inver'],
               'linha_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_linha_agrup'],
               'area_forma'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_area_forma'],
               'area_empil'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_area_empil'],
               'area_inver'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_area_inver'],
               'area_agrup'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_area_agrup'],
               'marca_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_marca_inver'],
               'marca_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_marca_agrup'],
               'gauge_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_gauge_forma'],
               'radar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_radar_forma'],
               'radar_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_radar_empil'],
               'polar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_polar_forma'],
               'funil_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_funil_dimen'],
               'funil_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_funil_inver'],
               'pyram_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pyram_dimen'],
               'pyram_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pyram_valor'],
               'pyram_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pyram_forma'],
               'tit_datay'   => $chart_data['label_y'],
               'tit_label'   => $chart_data['label_x'],
               'tit_chart'   => $chart_data['title'],
               'export'      => $b_export ? 'Y' : ('xml' == $operation ? 'xml' : 'N'),
               'pdf'         => 'pdf' == $operation ? 'Y' : 'N',
               'xml'         => 'xml' == $operation ? $chart_data['xml'] : '',
           );
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']               = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf'];
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_order'];
           if ('pdf' == $operation)
           {
               $mode = 'chart';
           }
           elseif ('xml' == $operation)
           {
               $mode = 'xml_only';
           }
           elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_full'])
           {
               $mode = 'full';
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_full']);
           }
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_bot']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_bot'])
           {
               $mode = 'full';
           }
           elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_first'])
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_first'] = false;
               $mode = array('js', 'chart');
           }
           else
           {
               $mode = 'chart';
           }
           $this->arr_param = $arr_param;
           $this->grafico_flash($arr_param, $this->grafico_dados($chart_data, $arr_param['export'], $chart_key), $mode);
           if ('pdf' == $operation || 'xml' == $operation)
           {
               return;
           }
           elseif ((!isset($_GET['flash_graf']) || 'chart' != $_GET['flash_graf']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_bot']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_bot']))
           {
               exit;
           }
       }
       elseif (isset($_GET['flash_graf']) && 'chart' == $_GET['flash_graf'])
       {
?><!DOCTYPE html>
<html>
<body>
<?php
           $this->grafico_flash_form();
?>
<script type="text/javascript" language="javascript">
  document.flashRedir.submit();
 </script>
</body>
</html>
<?php
       }
       elseif ('__no_record_found__' == $chart_key)
       {
           $arr_param = array(
               'type'        => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_tipo'],
               'width'       => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_larg'],
               'height'      => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_alt'],
               'barra_orien' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_orien'],
               'barra_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_forma'],
               'barra_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_dimen'],
               'barra_sobre' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_sobre'],
               'barra_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_empil'],
               'barra_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_inver'],
               'barra_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_agrup'],
               'barra_funil' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_barra_funil'],
               'pizza_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pizza_forma'],
               'pizza_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pizza_dimen'],
               'pizza_orden' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pizza_orden'],
               'pizza_explo' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pizza_explo'],
               'pizza_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pizza_valor'],
               'linha_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_linha_forma'],
               'linha_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_linha_inver'],
               'linha_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_linha_agrup'],
               'area_forma'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_area_forma'],
               'area_empil'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_area_empil'],
               'area_inver'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_area_inver'],
               'area_agrup'  => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_area_agrup'],
               'marca_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_marca_inver'],
               'marca_agrup' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_marca_agrup'],
               'gauge_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_gauge_forma'],
               'radar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_radar_forma'],
               'radar_empil' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_radar_empil'],
               'polar_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_polar_forma'],
               'funil_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_funil_dimen'],
               'funil_inver' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_funil_inver'],
               'pyram_dimen' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pyram_dimen'],
               'pyram_valor' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pyram_valor'],
               'pyram_forma' => $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['cfg_graf']['graf_pyram_forma'],
               'tit_datay'   => '',
               'tit_label'   => '',
               'tit_chart'   => '',
               'export'      => 'N',
               'pdf'         => 'N',
               'xml'         => '',
           );
           $this->grafico_flash($arr_param, null, '__no_record_found__');
       }
   }

   //---- 
   function inicializa_vars()
   {
      global 
             $nivel_quebra, $nm_lang, $campo, $campo_val;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_opc_atual'] == 1)
      {
         $this->sc_graf_sint = true;
      }
      //---- 
      $this->array_decimais = array();
      $this->NM_tit_val[1]     = strip_tags("Reg Gross Income (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")");
      $this->NM_ind_val[1]     = 1;
      $this->array_decimais[1] = 2;
      $this->NM_tit_val[2]     = strip_tags("Tax FDU (" .  $this->Ini->Nm_lang['lang_btns_smry_msge_sum'] . ")");
      $this->NM_ind_val[2]     = 2;
      $this->array_decimais[2] = 2;
      $this->campo     = (isset($campo))        ? $campo        : 0;
      $this->nivel     = (isset($nivel_quebra)) ? $nivel_quebra : 0;
      $this->campo_val = (isset($campo_val))    ? $campo_val    : 1;
      //---- 
      $this->array_total_dept = array();
      //---- 
      $ind_tit = $this->campo_val;
      if ($this->campo > 0)
      {
          foreach ($this->NM_ind_val as $i => $seq)
          {
              if ($ind_tit == $seq)
              {
                  $ind_tit = $i;
                  break;
              }
          }
      }
      $this->list_titulo = (isset($this->NM_tit_val[$ind_tit]))  ? $this->NM_tit_val[$ind_tit]  : "";
      $this->Decimais    = (isset($this->array_decimais[$ind_tit])) ? $this->array_decimais[$ind_tit] : 2;
      $this->titulo      = $this->list_titulo;
      //---- Label
      $this->label    = array();
      $prep_label    = array();
      $prep_label['dept'] = "Department";
      $x = 0;
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['SC_Gb_Free_cmp'] as $cmp_gb => $resto)
      {
          $this->label[$x] = $prep_label[$cmp_gb];
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['contr_label_graf'][$cmp_gb]) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['contr_label_graf'][$cmp_gb]))
          {
             $this->label[$x] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['contr_label_graf'][$cmp_gb];
          }
          $x++;
      }
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
   function monta_arrays()
   {
      $this->array_label = array();
      $this->array_datay = array();
      if ($this->campo > 0)
      {
          $this->sc_graf_sint = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_total']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_total'] as $label => $valor)
          {
              $this->array_label[] = $valor[3];
              if ($this->campo == 0 && $this->nivel == 0)
              {
                  if ($this->sc_graf_sint)
                  {
                      $this->array_datay[" "][] = $valor[$this->campo_val];
                  }
              }
          }
          if (!$this->sc_graf_sint)
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_linhas'] as $cada_elemento)
              {
                  if (substr($cada_elemento[0], 0, 1) == 1)
                  {
                      $ind_val = $this->NM_ind_val[$this->campo_val];
                      $legenda = substr($cada_elemento[0], 1);
                      foreach ($this->array_label as $ind => $lixo)
                      {
                          if (isset($cada_elemento[$ind + 1]))
                          {
                              $this->array_datay[$legenda][] = $cada_elemento[$ind + 1][$ind_val];
                          }
                          else
                          {
                              $this->array_datay[$legenda][] = 0;
                          }
                      }
                  }
              }
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_linhas']))
      {
          if ($this->campo > 0)
          {
              $lab_quebra    = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_linhas'][$this->campo][0], 1);
              $lab_quebra    = str_replace("&nbsp;", "", $lab_quebra);
              $this->titulo .= " - " . $this->label[$this->nivel] . " = " . $lab_quebra;
          }
          if ($this->campo > 0)
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['graf_linhas'][$this->campo] as $ind => $valor)
              {
                  if ($ind > 0)
                  {
                      $this->array_datay[" "][$ind - 1] = $valor[$this->campo_val];
                  }
              }
              for ($i = 0; $i < count($this->array_label); $i++)
              {
                   if (!isset($this->array_datay[" "][$i]))
                   {
                       $this->array_datay[" "][$i] = 0;
                   }
              }
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['del_graph_col']))
      {
          $trab_graf = $this->array_label;
          $this->array_label = array();
          foreach ($trab_graf as $ind => $resto)
          {
              $tst_ind = $ind + 1;
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['del_graph_col'][$tst_ind]))
              {
                  $this->array_label[] = $resto;
              }
          }
          $trab_graf = $this->array_datay;
          $this->array_datay = array();
          foreach ($trab_graf as $legenda => $dados)
          {
              ksort($dados);
              foreach ($dados as $ind => $resto)
              {
                  $tst_ind = $ind + 1;
                  if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['del_graph_col'][$tst_ind]))
                  {
                      $this->array_datay[$legenda][] = $resto;
                  }
              }
          }
      }
      $this->max_size_label = 0;
      for ($i = 0; $i < sizeof($this->array_label); $i++)
      {
         $size_label           = strlen("" . $this->array_label[$i]);
         $this->max_size_label = ($this->max_size_label < $size_label) ? $size_label : $this->max_size_label;
      }
      $this->max_size_datay = 0;
      $this->total_datay = 0;
      foreach ($this->array_datay as $legenda => $dadosY)
      {
          for ($i = 0; $i < sizeof($dadosY); $i++)
          {
             $size_datay           = strlen("" . $dadosY[$i]);
             $this->max_size_datay = ($this->max_size_datay < $size_datay) ? $size_datay : $this->max_size_datay;
             $this->total_datay   += $dadosY[$i];
          }
      }
   }

    function orderCharts(&$arr_charts, $rule = '', $field = '')
    {
        if ('' == $rule)
        {
            return;
        }

        if ('' == $field)
        {
            $field = 0;
        }

        if ('label' != $field && !isset($arr_charts[0][$field]))
        {
            $field = 0;
        }

        foreach ($arr_charts as $i => $c)
        {
            if ('label' === $field)
            {
                $sOrderIndex  = isset($arr_charts[$i][0]['label_order']) && 'value' == $arr_charts[$i][0]['label_order'] ? 'db_values' : 'label';
                $aOrderSample = $arr_charts[$i][0][$sOrderIndex];
            }
            else
            {
                $aOrderSample = $arr_charts[$i][$field]['data'];
            }
            $aNewOrder = $this->getNewOrder($aOrderSample, $rule);
            $this->applyNewOrder($aNewOrder, $arr_charts[$i]);
        }
    }

    function getNewOrder($data, $rule)
    {
        if (!is_array($data))
        {
            return $data;
        }
        if ('asc' == $rule)
        {
            asort($data);
        }
        elseif ('desc' == $rule)
        {
            arsort($data);
        }

        return $data;
    }

    function applyNewOrder(&$order, &$charts)
    {
        for ($i = 0; $i < sizeof($charts); $i++)
        {
            $fix_xml   = is_array($charts[$i]['xml_link']);
            $new_data  = array();
            $new_label = array();
            $new_dbval = array();
            $new_link  = array();
            if ($fix_xml)
            {
                $new_xml = array();
            }

            foreach ($order as $new_index => $value)
            {
                $new_data[]  = $charts[$i]['data'][$new_index];
                $new_label[] = $charts[$i]['label'][$new_index];
                $new_dbval[] = $charts[$i]['db_values'][$new_index];
                $new_link[]  = $charts[$i]['link'][$new_index];
                if ($fix_xml)
                {
                    $new_xml[] = $charts[$i]['xml_link'][$new_index];
                }
            }

            $charts[$i]['data']      = $new_data;
            $charts[$i]['label']     = $new_label;
            $charts[$i]['db_values'] = $new_dbval;
            $charts[$i]['link']      = $new_link;
            if ($fix_xml)
            {
                $charts[$i]['xml_link'] = $new_xml;
            }
        }
    }

   function orderChart(&$label, &$data, &$link, $rule = '')
   {
       if ('' == $rule)
       {
           return;
       }
       elseif ('asc' == $rule)
       {
           asort($data);
       }
       elseif ('desc' == $rule)
       {
           arsort($data);
       }

       $new_data  = array();
       $new_label = array();
       $new_link  = array();
       foreach ($data as $i => $v)
       {
           $new_data[]  = $v;
           $new_label[] = $label[$i];
           $new_link[]  = $link[$i];
       }
       $data  = $new_data;
       $label = $new_label;
       $link  = $new_link;
   }

   function getChartType($bMulti, $bComb = false)
   {
       return strtolower($this->getChartRenderer($bMulti, $bComb));
   }

   function getChartRenderer($bMulti, $bComb)
   {
       $Ind_groupby = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['SC_Ind_Groupby'];
       if ($bComb)
       {
           $tmp_count = 0;
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['summarizing_fields_order'][$Ind_groupby] as $i_sum)
           {
               if ('' != $i_sum && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['summarizing_fields_display'][$Ind_groupby][$i_sum]))
               {
                   $d_sum = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['summarizing_fields_display'][$Ind_groupby][$i_sum];
                   if ($d_sum['display'])
                   {
                       foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['summarizing_fields_control'][$Ind_groupby] as $l_field => $d_field)
                       {
                           foreach ($d_field['options'] as $d_option)
                           {
                               if ($d_option['index'] == $i_sum)
                               {
                                   $tmp_count++;
                               }
                           }
                       }
                   }
               }
           }
           $multiDimensions = $bMulti;
           $multiMetrics = $tmp_count > 1;
           switch ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['chart_combination_type']) {
               case 'angulargauge':
                   $newChartType = "angulargauge";
                   break;
               case 'semicirculargauge':
                   $newChartType = "angulargauge";
                   break;
               case 'hlineargauge':
                   $newChartType = "hlineargauge";
                   break;
               case 'area';
               case 'msarea';
               case 'msarea';
                   $newChartType = $multiMetrics || $multiDimensions ? "msarea" : "msarea";
                   break;
               case 'areaspline';
               case 'mssplinearea';
               case 'splinearea';
                   $newChartType = $multiMetrics || $multiDimensions  ? "mssplinearea" : "splinearea";
                   break;
               case 'bar2d';
               case 'msbar2d';
                   $newChartType = $multiMetrics || $multiDimensions  ? "msbar2d" : "bar2d";
                   break;
               case 'bar3d';
               case 'msbar3d';
                   $newChartType = $multiMetrics || $multiDimensions  ? "msbar3d" : "bar3d";
                   break;
               case 'bubble':
                   $newChartType = "bubble";
                   break;
               case 'column2d';
               case 'mscolumn2d';
                   $newChartType = $multiMetrics || $multiDimensions  ? "mscolumn2d" : "column2d";
                   break;
               case 'column3d';
               case 'mscolumn3d';
                   $newChartType = $multiMetrics || $multiDimensions  ? "mscolumn3d" : "column3d";
                   break;
               case 'combination2d';
               case 'mscombidy2d';
               case 'mscombi2d';
                   $newChartType = $multiMetrics || $multiDimensions  ? "mscombidy2d" : "mscombi2d";
                   break;
               case 'combination3d';
               case 'mscolumn3dlinedy';
                   $newChartType = "mscolumn3dlinedy";
                   break;
               case 'doughnut2d':
                   $newChartType = "doughnut2d";
                   break;
               case 'doughnut3d':
                   $newChartType = "doughnut3d";
                   break;
               case 'funnel':
                   $newChartType = "funnel";
                   break;
               case 'funnel2d':
                   $newChartType = "funnel";
                   break;
               case 'line';
               case 'msline';
                   $newChartType = $multiMetrics || $multiDimensions  ? "msline" : "line";
                   break;
               case 'pie2d':
                   $newChartType = "pie2d";
                   break;
               case 'pie3d':
                   $newChartType = "pie3d";
                   break;
               case 'pyramid':
                   $newChartType = "pyramid";
                   break;
               case 'pyramid2d':
                   $newChartType = "pyramid";
                   break;
               case 'radar':
                   $newChartType = "radar";
                   break;
               case 'scatter':
                   $newChartType = "scatter";
                   break;
               case 'scrollarea':
               case 'scrollarea2d':
                   $newChartType = "scrollarea2d";
                   break;
               case 'scrollbar2d':
                   $newChartType = "scrollbar2d";
                   break;
               case 'overlappedbar2d':
                   $newChartType = "overlappedbar2d";
                   break;
               case 'scrollcolumn2d':
                   $newChartType = "scrollcolumn2d";
                   break;
               case 'overlappedcolumn2d':
                   $newChartType = "overlappedcolumn2d";
                   break;
               case 'scrollline':
               case 'scrollline2d':
                   $newChartType = "scrollline2d";
                   break;
               case 'spline';
               case 'msspline';
                   $newChartType = $multiMetrics || $multiDimensions  ? "msspline" : "spline";
                   break;
               case 'stackedarea';
               case 'stackedarea2d';
                   $newChartType = "stackedarea2d";
                   break;
               case 'stackedbar2d':
                   $newChartType = "stackedbar2d";
                   break;
               case 'stackedbar3d':
                   $newChartType = "stackedbar3d";
                   break;
               case 'stackedcolumn2d':
                   $newChartType = "stackedcolumn2d";
                   break;
               case 'stackedcolumn3d':
                   $newChartType = "stackedcolumn3d";
                   break;
               case 'step';
               case 'msstepline';
                   $newChartType = "msstepline";
                   break;
               case 'zoomline':
                   $newChartType = "zoomline";
                   break;
           }
           return $newChartType;
       }
       $sChart = '';
       $sMulti = $bMulti ? 'MS' : '';
       switch ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_tipo'])
       {
           case 'Bar':
               if ('Horizontal' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_barra_orien'])
               {
                   if ('Off' != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_barra_empil'] && $bMulti)
                   {
                       $sChart .= 'StackedBar';
                       $sChart .= '3d' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_barra_dimen']  ? '3D' : '2D';
                   }
                   else
                   {
                       $sChart .= $sMulti . 'Bar';
                       $sChart .= '3d' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_barra_dimen'] ? '3D' : '2D';
                   }
               }
               else
               {
                   if ('Off' != $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_barra_empil'] && $bMulti)
                   {
                       $sChart .= 'StackedColumn';
                       $sChart .= '2d' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_barra_dimen'] ? '2D' : '3D';
                   }
                   else
                   {
                       $sChart .= $sMulti . 'Column';
                       $sChart .= '2d' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_barra_dimen'] ? '2D' : '3D';
                   }
               }
               break;
           case 'Pie':
               if ('Pie' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_pizza_forma'])
               {
                   $sChart .= 'Pie';
               }
               else
               {
                   $sChart .= 'Doughnut';
               }
               $sChart .= '2d' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_pizza_dimen'] ? '2D' : '3D';
               break;
           case 'Line':
               if ('Line' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_linha_forma'])
               {
                   $sChart .= $sMulti . 'Line';
               }
               elseif ('Spline' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_linha_forma'])
               {
                   $sChart .= $sMulti . 'Spline';
               }
               else
               {
                   $sChart .= 'MSStepLine';
               }
               break;
           case 'Area':
               if ('Area' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_area_forma'])
               {
                   if ($bMulti)
                   {
                       $sChart .= $sMulti . 'Area';
                   }
                   else
                   {
                       $sChart .= 'Area2D';
                   }
               }
               else
               {
                   $sChart .= $sMulti . 'SplineArea';
               }
               break;
           case 'Mark':
               $sChart .= 'Column3D';
               break;
           case 'Gauge':
               $sChart .= 'AngularGauge';
               break;
           case 'Radar':
           case 'Polar':
               $sChart .= 'Radar';
               break;
           case 'Funnel':
               $sChart .= 'Funnel';
               break;
           case 'Pyramid':
               $sChart = 'Pyramid';
               break;
       }
       return $sChart;
   }

   function getChartModule($sChartType = '')
   {
       if ('' == $sChartType)
       {
           $sChartType = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_tipo'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_tipo'] : "";
       }
       switch ($sChartType)
       {
           case 'Bar':
               return 'FusionCharts';
               break;
           case 'Pie':
               return 'FusionCharts';
               break;
           case 'Line':
               if ('Line' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_linha_forma'])
               {
                   return 'FusionCharts';
               }
               elseif ('Spline' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_linha_forma'])
               {
                   return 'PowerCharts';
               }
               else
               {
                   return 'PowerCharts';
               }
               break;
           case 'Area':
               if ('Area' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_deduction_fdu_hist']['parms_graf']['graf_area_forma'])
               {
                   return 'FusionCharts';
               }
               else
               {
                   return 'PowerCharts';
               }
               break;
           case 'Mark':
               return 'FusionCharts';
               break;
           case 'Gauge':
               return 'FusionWidgets';
               break;
           case 'Radar':
           case 'Polar':
               return 'PowerCharts';
               break;
           case 'Pyramid':
               return 'FusionWidgets';
               break;
           case 'Funnel':
               return 'FusionWidgets';
               break;
       }
       return $sChartType;
   }

   function getColorList($values, $colors)
   {
       $iValCount = 0;
       foreach ($values as $serie)
       {
           $iValCount = max($iValCount, sizeof($serie['label']));
       }
       $aColors   = explode(',', $colors);
       $iColCount = sizeof($aColors);
       $aMulti    = $this->getDivisions($iValCount, $iColCount);
       if (1 == $aMulti)
       {
           return $aColors[0];
       }
       $aAllColors = $this->getAllColors($aMulti[2], $aColors);
       return implode(',', $this->getUsedColors($aMulti[1], $iValCount, $aAllColors));
   }

   function getDivisions($a, $b)
   {
       if (1 >= $a || 1 >= $b)
       {
           return 1;
       }
       return $this->getSubDivisions($a, 0, $b, 0);
   }

   function getSubDivisions($a, $am, $b, $bm)
   {
       $v1 = $a + (($a - 1) * $am);
       $v2 = $b + (($b - 1) * $bm);
       if ($v1 == $v2)
       {
           return array($v1, $am, $bm);
       }
       elseif ($v1 > $v2)
       {
           return $this->getSubDivisions($a, $am, $b, $bm + 1);
       }
       else
       {
           return $this->getSubDivisions($a, $am + 1, $b, $bm);
       }
   }

   function getAllColors($div, $colors)
   {
       $aNewColors = array($colors[0]);
       for ($i = 1; $i < sizeof($colors); $i++)
       {
           $this->getColorIntervals($aNewColors, $colors[$i - 1], $colors[$i], $div);
           $aNewColors[] = $colors[$i];
       }
       return $aNewColors;
   }

   function getUsedColors($div, $count, $colors)
   {
       $used = array();
       for ($i = 0; $i < $count; $i++)
       {
           $used[] = $colors[($div + 1) * $i];
       }
       return $used;
   }

   function getColorIntervals(&$colors, $first, $last, $div)
   {
       $RGBini = $this->hex2dec($first);
       $RGBend = $this->hex2dec($last);
       $RGBint = array(
           abs(($RGBini[0] - $RGBend[0]) / ($div + 1)),
           abs(($RGBini[1] - $RGBend[1]) / ($div + 1)),
           abs(($RGBini[2] - $RGBend[2]) / ($div + 1)),
       );
       for ($i = 1; $i <= $div; $i++)
       {
           $newR = $RGBini[0] > $RGBend[0] ? $RGBini[0] - ($i * $RGBint[0]) : $RGBini[0] + ($i * $RGBint[0]);
           $newG = $RGBini[1] > $RGBend[1] ? $RGBini[1] - ($i * $RGBint[1]) : $RGBini[1] + ($i * $RGBint[1]);
           $newB = $RGBini[2] > $RGBend[2] ? $RGBini[2] - ($i * $RGBint[2]) : $RGBini[2] + ($i * $RGBint[2]);
           $colors[] = $this->dec2hex($newR, $newG, $newB);
       }
   }

   function hex2dec($color)
   {
       $dec = explode(' ', chunk_split($color, 2, ' '));
       return array(
           hexdec($dec[0]),
           hexdec($dec[1]),
           hexdec($dec[2]),
       );
   }

   function dec2hex($r, $g, $b)
   {
       $newr = dechex(round($r));
       if (1 == strlen($newr))
       {
           $newr = '0' . $newr;
       }
       $newg = dechex(round($g));
       if (1 == strlen($newg))
       {
           $newg = '0' . $newg;
       }
       $newb = dechex(round($b));
       if (1 == strlen($newb))
       {
           $newb = '0' . $newb;
       }
       return $newr . $newg . $newb;
   }

//
}

?>
