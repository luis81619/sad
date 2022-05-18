<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    class Oficios extends Controllers{
        
        public function __construct()
        {
            parent::__construct();

        }

        public function Oficios($parems)
        {
           $data['page_tag'] = "Oficios";
           $data['page_title'] = "Oficios";
           $data['page_name'] = "oficios";
           $data['carp_js'] = "oficios";
           $data['arc_js'] = "function_oficios";
           $this->views->getView($this, "oficios", $data);
        }

        public function getSelectPlantel()
        {
            $htmlOptions = "";
			$arrData = $this->model->selectPlantel();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					$htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre'].'</option>';
				}
			}
			echo $htmlOptions;
			die(); 
        }

        public function setOficio(){

            //dep($_POST);
            //echo("\n");
            //dep($_FILES);

            $documento = $_FILES['oficioArchivo']['tmp_name'];
            $descripcion = "Descripcion-LUIS";
            dep($documento);
            echo("\n");
            dep($descripcion);
            //die();
            apiDrive($documento, $descripcion);

            /*
            if(($_POST) && ($_FILES['oficioArchivo']['name'] != "" )){

                //$apiDrive = apiDrive();

                dep($apiDrive);
                
                
            }else{
                echo("Triste");

            }
         */   
        }

    }

?>