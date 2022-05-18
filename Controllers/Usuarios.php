<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    class Usuarios extends Controllers{
        
        public function __construct()
        {
            parent::__construct();

        }

        public function Usuarios($parems)
        {
           $data['page_tag'] = "Usuarios";
           $data['page_title'] = "Usuarios Administrativos";
           $data['page_name'] = "usuarios";
           $data['carp_js'] = "usuario";
           $data['arc_js'] = "function_usuarios";
           $this->views->getView($this, "usuarios", $data);
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

        public function setUsuario(){
            if($_POST){
                //dep($_POST);
                //die();
                if(empty($_POST['noTrabajador']) || empty($_POST['usuarioEmail']) || empty($_POST['usuarioNombre']) || empty($_POST['usuarioApellido1'])
                || empty($_POST['usuarioApellido2']) || empty($_POST['usuarioPlantelid']) || empty($_POST['usuarioRolid']))
                {
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else {
                    $idUsuario = intval($_POST['usuarioId']);
                    $strNoTrabajador = strClean($_POST['noTrabajador']);
                    $strEmail = strtolower($_POST['usuarioEmail']);
                    $strNombre = strtoupper(strClean($_POST['usuarioNombre']));
                    $strApellido1 = strtoupper(strClean($_POST['usuarioApellido1']));
					$strApellido2 = strtoupper(strClean($_POST['usuarioApellido2']));
                    $intPlantel = intval(strClean($_POST['usuarioPlantelid']));
                    $intRol = intval(strClean($_POST['usuarioRolid']));
                    $strPassword = $_POST['usuarioPassword'];
                    $strPasswordConfirm = $_POST['usuarioPasswordConfirm'];
                    $intStatus = $_POST['usuarioStatus'];
                    

                    if($strPassword != $strPasswordConfirm && $idUsuario != '' ){
                        $arrResponse = array("status" => false, "msg" => 'Las contraseña no son iguales.');
                        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                        die();
                    }else{
                        if($idUsuario == 0){
                            $option = 1;
                            $strPassword = hash("SHA256", strClean($_POST['usuarioPassword']));
                            $request_user = $this->model->insertTrabajador($strNoTrabajador,
                                                                        $strEmail,
                                                                        $strNombre,
                                                                        $strApellido1,
                                                                        $strApellido2,
                                                                        $intPlantel,
                                                                        $intRol,
                                                                        $intStatus,
                                                                        $strPassword);
                        }else{
                            $option = 2;
                            $strPassword =  empty($_POST['usuarioPassword']) ? "" : hash("SHA256",$_POST['usuarioPassword']);
                            $request_user = $this->model->updateTrabajador($idUsuario,
                                                                        $strNombre,
                                                                        $strApellido1,
                                                                        $strApellido2,
                                                                        $intPlantel,
                                                                        $strNoTrabajador,
                                                                        $strEmail,
                                                                        $strPassword,
                                                                        $intRol,
                                                                        $intStatus);
                        }

                    }
                    
                    //die();
                    if($request_user > 0 )
                    {   
                        if($option == 1){
                            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        }else if($option == 2){
                            $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                        }

                    }else if($request_user == 0){
                        $arrResponse = array('status' => false, 'msg' => '¡Atención! el email o usuario ya existe, ingresa otro.');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                    }

                }

                
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                

            }
            die();
        }

        public function getUsuarios()
        {
            $arrData = $this->model->selectUsuarios();
            //dep($arrData);
            for ($i=0; $i < count($arrData); $i++) { 

                if($arrData[$i]['users_rol'] == 1)
                {
                    $arrData[$i]['users_rol'] = '<span>DIGITALIZADOR</span>';

                }else{
                    $arrData[$i]['users_rol'] = '<span>ADMINISTRADOR</span>';
                }

                if($arrData[$i]['users_status'] == 1)
                {
                    $arrData[$i]['users_status'] = '<span class="badge-success">Activo</span>';

                }else{
                    $arrData[$i]['users_status'] = '<span class="badge-danger">Inactivo</span>';
                }

                $arrData[$i]['options'] = '<div class="text-center"> 
                <button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['users_id'].')" title="Ver usuario"><i class="far fa-eye"></i></button>
                <button class="btn btn-primary btn-sm btnEditUsuario" onClick="fntEditUsuario('.$arrData[$i]['users_id'].')" title="Editar Usuario"><i class="fas fa-pencil-alt"></i></button>
                <button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['users_id'].')" title="Eliminar Usuario"><i class="fas fa-power-off"></i></button>
                </div>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();

        }

        public function getUsuario(int $idpersona){
            //echo $idpersona;
            $idusuario = intval($idpersona);
            if($idusuario > 0)
            {
                $arrData = $this->model->selectUsuario($idusuario);
                if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                
            }
            die();
        }

        public function delUsuario(){
            if($_POST){
                $intIdusuario = intval($_POST['idusuario']);
                $requestDelete = $this->model->deleteUsuario($intIdusuario);
                if($requestDelete)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha desactivado el usuario.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al desactivar el usuario.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }


    }

?>