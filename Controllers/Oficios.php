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

        public function setAcuse(){
            //dep($_POST);
            //dep($_FILES);
            //die();
            if(($_POST) && ($_FILES['acuseArchivo']['name'] != "" )){

                if(empty($_POST['nAcuse']) || empty($_POST['datetimeAcuse'])){
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{

                    $documento = $_FILES['acuseArchivo']['tmp_name'];
                    $nombreArchivo = strtoupper(strClean($_POST['nAcuse']));
                    $respAPI = apiDrive($nombreArchivo, $documento);

                    if($respAPI != "exit"){
                        $acuseOficioId = strtoupper(strClean($_POST['oficioAcuseId']));
                        $acuseFolio = strtoupper(strClean($_POST['nAcuse']));
                        $idarchivoAcuse = $respAPI;
                        $strdateAcuse = strtoupper(strClean(depFecha($_POST['datetimeAcuse'])));
                        $strTokenAcuse = token();

                        $request_Acuse = $this->model->insertAcuse(
                            $acuseOficioId,
                            $acuseFolio,
                            $idarchivoAcuse,
                            $strdateAcuse,
                            $strTokenAcuse
                        );



                        if($request_Acuse > 0){
                            $request_datosEmail = $this->model->getDatosEmailAcuse($acuseFolio);

                            $arrResponse = array('status' => true, 'msg' => 'Tu acuse se ha generado correctamente');
                            
                            $dataEmisor = array(
                                'asunto' => 'SOD-NOTIFICACION RESPUESTA DE ACUSE',
                                'email' => $request_datosEmail['correoRespuesta'],
                                'nombreEmisor' => $request_datosEmail['plantelEmite'],
                                'folio' => $acuseFolio,
                                'nOficio' => $request_datosEmail['oficio_serie'],
                                'fechaOficio' => $request_datosEmail['acuse_create'],
                                'fecha_emision' => $strdateAcuse,
                                'dirigido' => $request_datosEmail['plantelEmite'],
                                'plantelRecibe' => $request_datosEmail['plantelRecibe']);
                            
                            $sendEmail = sendEmail($dataEmisor, 'email_EmisorAcuse');

                            $dataRecibe = array(
                                'asunto' => 'SOD-NOTIFICACION ENVIASTE RESPUESTA DE ACUSE',
                                'email' => $request_datosEmail['correoAcuse'],
                                'nombreEmisor' => $request_datosEmail['plantelEmite'],
                                'folio' => $acuseFolio,
                                'nOficio' => $request_datosEmail['oficio_serie'],
                                'fechaOficio' => $request_datosEmail['acuse_create'],
                                'fecha_emision' => $strdateAcuse,
                                'dirigido' => $request_datosEmail['plantelEmite'],
                                'plantelRecibe' => $request_datosEmail['plantelRecibe']);
                            
                            $sendEmail = sendEmail($dataRecibe, 'email_RecibeAcuse');

                        }else{
                            $arrResponse = array("status" => false, "msg" => 'No es posible realizar el proceso.');
                        }

                    }else{
                        $arrResponse = array("status" => false, "msg" => 'No es posible realizar el proceso.');
                    }

                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function setOficio(){
            //dep($_FILES);
            //die();
            
            if(($_POST) && ($_FILES['oficioArchivo']['name'] != "" )){

                if(empty($_POST['nOficio']) || empty($_POST['datetime']) || empty($_POST['oficioPlantelid']) || empty($_POST['oficioPlantelid']) 
                || empty($_POST['oficioDirigido']) || empty($_POST['oficioEmite']) || empty($_POST['oficioAsunto']) ){
                    
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{
                    $documento = $_FILES['oficioArchivo']['tmp_name'];
                    $nombreArchivo = strtoupper(strClean($_POST['nOficio']));
                    $respAPI = apiDrive($nombreArchivo, $documento);
                    
                    if($respAPI != "exit"){
                        $idarchivo =  $respAPI;
                        //echo ("Se guardo correcto el archivo con id: \n ");
                        //echo $idarchivo;
                        $strNoficio = strtoupper(strClean($_POST['nOficio']));
                        $strdateOficio = strtoupper(strClean(depFecha($_POST['datetime'])));
                        $intPlantelRecibe = intval(strClean($_POST['oficioPlantelid']));
                        $strDirigido = strtoupper(strClean($_POST['oficioDirigido']));
                        $strEmite = strtoupper(strClean($_POST['oficioEmite']));
                        $strAsunto = strtoupper(strClean($_POST['oficioAsunto']));
                        $strEmailEmite = strClean($_SESSION['userData']['users_email']);
                        $intplantelEmite = intval(strClean($_SESSION['userData']['plantel_id']));
                        //$strFolio = $this->model->generarFolio();
                        $strToken = token();

                        $request_oficio = $this->model->insertOficio(
                            $idarchivo,
                            $strNoficio,
                            $strAsunto,
                            $strdateOficio,
                            $strEmite,
                            $strDirigido,
                            $intplantelEmite,
                            $intPlantelRecibe,
                            $strToken,
                            $strEmailEmite,
                            $nombreArchivo);

                        $request_datosEmail = $this->model->getDatosEmail();
                        $plantelEmite = $request_datosEmail['plantelEmite'];
                        
                        if($request_oficio > 0){
                            $arrResponse = array('status' => true, 'msg' => 'Tu oficio se ha generado correctamente');
                            $dataEmisor = array(
                                'asunto' => 'SOD-NOTIFICACION, ENVIO DE OFICIO',
                                'email' => $strEmailEmite,
                                'nombreEmisor' => $plantelEmite,
                                'folio' => $request_datosEmail['oficio_folio'],
                                'serie' => $strNoficio,
                                'fechaOficio' => $strdateOficio,
                                'fecha_emision' => $request_datosEmail['oficio_create'],
                                'dirigido' => $strDirigido,
                                'plantelRecibe' => $request_datosEmail['plantelRecibe'],
                                'asuntoOficio' => $strAsunto );
                            
                            $sendEmail = sendEmail($dataEmisor, 'email_Emisor');

                            $dataRecibe = array(
                                'asunto' => 'SOD-NOTIFICACION, RECIBISTE UN OFICIO',
                                'email' => $request_datosEmail['users_email'],
                                'nombreEmisor' => $request_datosEmail['plantelEmite'],
                                'folio' => $request_datosEmail['oficio_folio'],
                                'serie' => $strNoficio,
                                'fechaOficio' => $strdateOficio,
                                'fecha_emision' => $request_datosEmail['oficio_create'],
                                'dirigido' => $strDirigido,
                                'plantelRecibe' => $request_datosEmail['plantelRecibe'],
                                'asuntoOficio' => $strAsunto );
                            
                            $sendEmail2 = sendEmail($dataRecibe, 'email_Recibe');

                        }else{
                            $arrResponse = array("status" => false, "msg" => 'No es posible realizar el proceso.');
                        }
                        
                    }else{
                        $arrResponse = array("status" => false, "msg" => 'No es posible realizar el proceso.');
                    }
                    
                }
                sleep(2);
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                
            }                
                die();
             
        }

        public function getOficios()
        {
            //if(!empty($_SESSION['userData']['users_rol'] == 3 || $_SESSION['userData']['users_rol'] == 1)){

                $usuarioPlantel = intval(strClean($_SESSION['userData']['plantel_id']));
                $arrData = $this->model->selectOficos($usuarioPlantel);
                $archivoId="";
                //dep($arrData);
                //die();
                for ($i=0; $i < count($arrData); $i++) {
                    //echo("hola: ".$arrData[$i]['acuse_folio']);
                   // $archivoId = strval($arrData[$i]['acuse_folio']);                    

    

                    if(($arrData[$i]['idEmite'] == $usuarioPlantel && $arrData[$i]['idRecibe'] != $usuarioPlantel) && $arrData[$i]['acuse_folio'] == null){
                        $arrData[$i]['options'] = '<div class="text-center"> 
                        <button class="btn btn-info btn-sm btnViewOficios" onClick="fntViewOficio('.$arrData[$i]['oficio_id'].",'".$arrData[$i]['archivo_ruta']."'".')" title="Ver ofico"><i class="fa fa-folder"></i></button>
                        <button class="btn btn-secondary btn-sm btnViewDetalles" onClick="fntViewOficio('."'".$arrData[$i]['oficio_id']."'".')" title="Detalles"><i class="fa fa-info"></i></button>
                        <button class="btn btn-success btn-sm btnViewDetalles" onClick="fntViewOficio('."'".$arrData[$i]['oficio_id']."'".')" title="Ver Acuse"><i class="far fa-eye"></i></button>
                        </div>';

                    }else if(($arrData[$i]['idEmite'] != $usuarioPlantel && $arrData[$i]['idRecibe'] == $usuarioPlantel) && $arrData[$i]['acuse_folio'] == null){
                        $arrData[$i]['options'] = '<div class="text-center"> 
                        <button class="btn btn-info btn-sm btnViewOficios" onClick="fntViewOficio('.$arrData[$i]['oficio_id'].",'".$arrData[$i]['archivo_ruta']."'".')" title="Ver ofico"><i class="fa fa-folder"></i></button>
                        <button class="btn btn-secondary btn-sm btnViewDetalles" onClick="fntViewOficio('."'".$arrData[$i]['oficio_id']."'".')" title="Detalles"><i class="fa fa-info"></i></button>
                        
                        <button class="btn btn-danger btn-sm btnViewAcuse" onClick="fntEditAcuse(this,'.$arrData[$i]['oficio_id'].')" title="Acuse"><i class="fa fa-handshake-o"></i></button>
                        </div>';

                    }else if(($arrData[$i]['idEmite'] != $usuarioPlantel && $arrData[$i]['idRecibe'] == $usuarioPlantel) && $arrData[$i]['acuse_folio'] != null){
                        $arrData[$i]['options'] = '<div class="text-center"> 
                        <button class="btn btn-info btn-sm btnViewOficios" onClick="fntViewOficio('.$arrData[$i]['oficio_id'].",'".$arrData[$i]['archivo_ruta']."'".')" title="Ver ofico"><i class="fa fa-folder"></i></button>
                        <button class="btn btn-secondary btn-sm btnViewDetalles" onClick="fntViewOficio('."'".$arrData[$i]['oficio_id']."'".')" title="Detalles"><i class="fa fa-info"></i></button>
                        <button class="btn btn-success btn-sm btnViewDetalles" onClick="fntViewOficio('."'".$arrData[$i]['oficio_id']."'".')" title="Ver Acuse"><i class="far fa-eye"></i></button>
                        </div>';

                    }
                    else if(($arrData[$i]['idEmite'] == $usuarioPlantel && $arrData[$i]['idRecibe'] != $usuarioPlantel) && $arrData[$i]['acuse_folio'] != null){
                        $arrData[$i]['options'] = '<div class="text-center"> 
                        <button class="btn btn-info btn-sm btnViewOficios" onClick="fntViewOficio('.$arrData[$i]['oficio_id'].",'".$arrData[$i]['archivo_ruta']."'".')" title="Ver ofico"><i class="fa fa-folder"></i></button>
                        <button class="btn btn-secondary btn-sm btnViewDetalles" onClick="fntViewOficio('."'".$arrData[$i]['oficio_id']."'".')" title="Detalles"><i class="fa fa-info"></i></button>
                        <button class="btn btn-success btn-sm btnViewDetalles" onClick="fntViewOficio('."'".$arrData[$i]['oficio_id']."'".')" title="Ver Acuse"><i class="far fa-eye"></i></button>
                        </div>';

                    }

                    //$arrData[$i]['options'] = "opc1";
                    
                   //echo("hola: ".$arrData[$i]['acuse_folio']);

                    /*
                    $arrData[$i]['options'] = '<div class="text-center"> 
                    <button class="btn btn-info btn-sm btnViewOficios" onClick="fntViewOficio('."'".$arrData[$i]['oficio_id']."'".')" title="Ver ofico"><i class="fa fa-folder"></i></button>
                    <button class="btn btn-secondary btn-sm btnViewDetalles" onClick="fntViewOficio('."'".$arrData[$i]['oficio_id']."'".')" title="Detalles"><i class="fa fa-info"></i></button>
                    <button class="btn btn-danger btn-sm btnViewAcuse" onClick="fntViewOficio('."'".$arrData[$i]['oficio_id']."'".')" title="Acuse"><i class="fa fa-handshake-o"></i></button>
                    <button class="btn btn-success btn-sm btnViewDetaññes" onClick="fntViewOficio('."'".$arrData[$i]['oficio_id']."'".')" title="Ver Acuse"><i class="far fa-eye"></i></button>
                    </div>';*/

                    }
                    echo json_encode($arrData,JSON_UNESCAPED_UNICODE);    
           // }
            
            die();

        }

    }

?>