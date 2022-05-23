
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    class Login extends Controllers{
        
        public function __construct()
        {
            session_start();
            
            if(isset($_SESSION['login']))
            {
                header('Location: '.base_url().'/dashboard');
            }
            parent::__construct();

        }

        public function login($parems)
        {
           $data['page_tag'] = "Login";
           $data['page_title'] = "Login";
           $data['page_name'] = "login";
           $data['carp_js'] = "login";
           $data['arc_js'] = "function_login";
           $this->views->getView($this, "login", $data);
        }

        public function loginUser(){
            //dep($_POST);
            // die();
            if($_POST){
                if(empty($_POST['loginEmail']) || empty($_POST['loginPassword'])){
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos');
                }else{
                    $strUsuario = strtolower(strClean($_POST['loginEmail']));
                    $strPassword = hash("SHA256", $_POST['loginPassword']);
                    $requestUser = $this->model->loginUser($strUsuario, $strPassword);
                    //dep($requestUser);

                    if(empty($requestUser)){
                        $arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.');
                    }else{
                        $arrData = $requestUser;
                        if($arrData['users_status'] == 1){
                            $_SESSION['idUser'] = $arrData['users_id'];
                            $_SESSION['login'] = true;
                            $_SESSION['timeout'] = true;
                            $_SESSION['inicio'] = time();

                            $arrData = $this->model->sessionLogin($_SESSION['idUser']);
                            $_SESSION['userData'] = $arrData;


                            $arrResponse = array('status' => true, 'msg' => 'OK.');
                            
                        }else{ 
                            $arrResponse = array('status' => false, 'msg' => 'Usuario inactivo.');
                        }
                    }

                }
                sleep(5);
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>

