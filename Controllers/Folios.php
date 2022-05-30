<?php

require 'Libraries/html2pdf/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

    class Folios extends Controllers{
        
        public function __construct()
        {
            parent::__construct();
            session_start();

        }

        public function generarFolioEmite($idOficio)
        {
            if(is_numeric($idOficio)){
                $data = $this->model->selectFolioEmisor($idOficio);
                //dep($dataFolioEmisor);

                ob_end_clean();
                $html = getFile('Template/Modals/Oficios/FolioEmisorPDF', $data);
                $html2pdf = new Html2Pdf();
                $html2pdf->writeHTML($html);
                $html2pdf->output();


            }else{
                echo "Dato no valido";
            }
            
            /*
            ob_end_clean();
            $html = getModalCarpeta('Oficios','modalOficios', $dataFolioEmisor);
            $html2pdf = new Html2Pdf();
            $html2pdf->writeHTML($html);
            $html2pdf->output();
            */
            die();
        }
    }

?>