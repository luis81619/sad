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

            $sql = "SELECT users_id, users_email, users_status FROM sad_users WHERE
                    users_email = '$this->strUsuario' AND
                    users_password = '$this->strPassword' and
                    users_status != 0";
            
            $request = $this->select($sql);
            return $request;

        }

        public function sessionLogin(int $iduser){
            $this->intIdUsuario = $iduser;
            $sql = "SELECT * FROM sad_trabajador st
            INNER JOIN sad_users su ON st.trabajador_id = su.trabajador_id
            WHERE su.users_id = $this->intIdUsuario";
            $request = $this->select($sql);
            return $request;
        }

    }

?>