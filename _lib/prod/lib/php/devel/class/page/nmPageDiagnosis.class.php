<?php

/* Classes ancestrais */
nm_load_class('page', 'Page');

/* Definicao da classe */
class nmPageDiagnosis extends nmPage
{
    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o nome da pagina a ser exibida.
     *
     * @access  public
     * @global  array   $nm_config  Array de configuracao do ScriptCase.
     */
    function __construct()
    {
        $this->doAjax();

        $this->SetBody('nmPage');
        $this->SetMargin(10);
        $this->SetPage('Diagnosis');
		$this->CheckLogin();
        $this->SetPageSubtitle('');
    } // nmPageMenu

    function doAjax()
    {
        if(isset($_GET['ajax']) && $_GET['ajax'] = 'nm')
        {
            $str_retorno = "";
            if(isset($_GET['button']))
            {
                if ($_GET['button'] == "button_ok.png")
                    $image = "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";
                elseif ($_GET['button'] == "button_cancel.png")
                    $image = "iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAMnSURBVHjaXJNPTBN2HMU/v9ICTbF/pFALxVbRQEg0GFO5SPgjEMASNqCgCStg1/LHEYEsDpkh27zs4LaD2WFnsyUeWNgErBUqGMVNEkYc0+ywbNnBxGW3HXbY4tuhNW47vHxP309e3sujDWgHWqC8Pz9/sQMSXcBrwGmgCTiVuxEYjlmtSz0QHAD6AdpeaeJKOPzXkMuVaQf/6/8CNGdVcq6wMH0lGHwRhanoS0AzBNrg/MeNjXpy7ZpujY9ryOHInAZfBGjIOihOFhSkbzQ0KBWJ6MNgUP0w3Qsh+u32pQ9qa7V79aq25ua0demSls+eVdJuX20HbxN4xgsKUov19Uq1turLEye0GA7rfbdb5/Ly0rRaLMODLld6KRbTtzMz2ojHtTU6qlRnpxI2251RqzV16+RJ3W9v10o4rK9qanQ9GNSYzXav15gxmrI2i2OFhemvIxE9GhnRg2hU2wMDWqmv18rx43pUV6dMKKS0z6cbTqemLZZ7USjvJJfwqVxIcas1tdLYqJ2eHn3X0aGdujptB4P6pqRED71eLTkcehs24lDxRraV7HNLTo3gTFitqZVjx/S4pkaPy8r0tKJCP+7fr3W3W7MWy90hKJ0AYi8Bzf914UxAaqGoSE/Ky/VLZaWeVVXp2aFD2vR49C6sXQDPPDAB9PCqY1qgJAmpBYdDO2Vl+ungQf1eXa0/jx7VH0eO6Pnhw3qYhaxeBP8k0Euu52YojkP6emGhNr1e7QQC+rWyUpslJdotL9fftbV6Xl2tn0MhrblcumxMZgR83QBdMBwzJv2ZzablPXu07vXq+0BAG8XFmoHVd4xZ/cHv129VVXoaCml73z7dLCrStDFrg/Amg3D7ojH6wmbTot2uux6PbjqdumDM6hh4p8B72ZjVTa9Xu4GAHpSWat3t1kdWqyaNuUMXHOiDmfcsFi3Y7frcbtdbxmROgy8JzAEz4Js1JnPb5dL9vXv1aX6+kjAdhwN059I8A9PzeXlKGpOJgL8TGAVmgXngPPinjMl8YrW+GIOpJJAA6Ab6gCiERmClDxKR3BL/B+AMJCZhOQGhsRzgnwEAq7Qzh9XK2kEAAAAASUVORK5CYII=";

                header("Content-type: image/gif");
                $str_retorno = base64_decode($image);
            }
            echo $str_retorno;
            exit;
        }
    }

    /**
     * Exibe o conteudo.
     *
     * Exibe o conteudo da tela inicial do ScriptCase.
     *
     * @access  protected
     * @global  object     $nm_template  Objeto para exibicao de templates.
     */
    function DisplayContent()
    {
        global $nm_template, $nm_lang;

        $nm_template->Display('body_diagnosis');
    } // DisplayContent

    /**
     * Define funcoes Javascript da pagina.
     *
     * Define a lista de funcoes Javascript especificos da pagina atual.
     *
     * @access  protected
     * @global  array      $nm_config  Array de configuracao do ScriptCase.
     * @global  array      $nm_lang    Array de idioma.
     */
    function PageJavascript()
    {
    } // PageJavascript

    /**
     * Define arquivos JS da pagina.
     *
     * Define a lista de arquivos JS especificos da pagina atual.
     *
     * @access  protected
     */
    function PageJs()
    {
    } // PageJs

    /**
     * Define folhas de estilo da pagina.
     *
     * Define a lista de folhas de estilo especificas da pagina atual.
     *
     * @access  protected
     */
    function PageStyle()
    {
    } // PageStyle


}

?>