<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    class Oficios extends Controllers{
        
        public function __construct()
        {
            sessionStart();
            parent::__construct();
            //session_start();
            //session_regenerate_id(true);
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
            }

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

            if(($_POST) && ($_FILES['oficioArchivo']['name'] != "" )){
                //dep($_POST); echo("\n"); dep($_FILES);
                //die();

                if(empty($_POST['nOficio']) || empty($_POST['datetime']) || empty($_POST['oficioPlantelid']) || empty($_POST['oficioPlantelid']) 
                || empty($_POST['oficioDirigido']) || empty($_POST['oficioEmite']) || empty($_POST['oficioAsunto']) ){
                    
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $strNoficio = strtoupper(strClean($_POST['nOficio']));
                    $strNoficio = strtoupper(strClean($_POST['datetime']));
                    $strNoficio = strtoupper(strClean($_POST['oficioPlantelid']));
                    $strNoficio = strtoupper(strClean($_POST['oficioDirigido']));
                    $strNoficio = strtoupper(strClean($_POST['oficioEmite']));
                    $strNoficio = strtoupper(strClean($_POST['oficioAsunto']));
                }
                
                
            }else{
                echo("Triste");

            }

            $documento = $_FILES['oficioArchivo']['tmp_name'];
            $descripcion = "Descripcion-LUIS";
            $nombre = $_FILES['oficioArchivo']['name'];
            dep($documento);
            echo("\n");
            dep($descripcion);
            //die();
            apiDrive($nombre, $documento, $descripcion);
        }

    }

?>