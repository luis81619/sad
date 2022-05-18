<?php

    class LoginModel extends Mysql
    {
        private $intIdUsuario;
        private $strUsuario;
        private $strPassword;
        private $strToken;

        public function __construct()
        {
            parent::__construct();
        }

        public function loginUser (string $usuario, string $password)
        {
            $this->strUsuario = $usuario;
            $this->strPassword = $password;

            $sql = "SELECT usuario_id, usuario_status FROM sel_usuario WHERE
                    usuario_nombre = '$this->strUsuario' AND
                    usuario_password = '$this->strPassword' and
                    usuario_status != 0";
            
            $request = $this->select($sql);
            return $request;


        }

    }

?>