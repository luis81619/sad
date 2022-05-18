<?php

    class UsuariosModel extends Mysql
    {   
        private $intIdUsuario;
        private $strNombre;
        private $strApellido1;
        private $strApellido2;
        private $intPlantel;
        private $strNoTrabajador;
        private $strEmail;
        private $strPassword;
        private $intStatus;
        private $intRol;
        private $intTrabajador;

        public function __construct()
        {
            parent::__construct();
        }

        public function selectPlantel()
        {
            $sql = "SELECT * FROM sad_plantel";
            $request = $this->select_all($sql);
            return $request;
        }

        public function insertTrabajador(string $noTrabajador, string $email, string $nombre, string $apellido1, string $apellido2, int $plantel,
        int $rol, int $status, string $password){

            $this->strNombre = $nombre;
            $this->strApellido1 = $apellido1;
            $this->strApellido2 = $apellido2;
            $this->intPlantel = $plantel;
            $this->strNoTrabajador = $noTrabajador;
            $this->strEmail = $email;
            $this->strPassword = $password;
            $this->intRol = $rol;
            $this->intStatus = $status;
            $return = 0;

            $sql = "SELECT * FROM sad_trabajador st
            INNER JOIN sad_users su ON st.trabajador_id = su.trabajador_id
            WHERE st.trabajador_numero = '{$this->strNoTrabajador}' OR su.users_email = '{$this->strEmail}'";
            
            $request = $this->select_all($sql);
            

            if(empty($request))
            {
                $query_insert_trab = "INSERT INTO sad_trabajador(trabajador_numero, trabajador_nombre, trabajador_apellido1, trabajador_apellido2, plantel_id)
                                VALUES (?,?,?,?,?)";
                
                $arrData = array($this->strNoTrabajador,
                                $this->strNombre,
                                $this->strApellido1,
                                $this->strApellido2,
                                $this->intPlantel);

                $request_insert_trab = $this->insert($query_insert_trab, $arrData);

                $query_insert_user = "INSERT INTO sad_users (users_email, users_password, users_rol, trabajador_id, users_status)
                                        VALUES(?,?,?,?,?)";

                $arrDataUsers = array($this->strEmail,
                                      $this->strPassword,
                                      $this->intRol,
                                     $request_insert_trab,
                                      $this->intStatus);
                
                $recuest_insert_user = $this->insert($query_insert_user, $arrDataUsers);

                $return = $recuest_insert_user;
            }    
            else{
                $return = 0;
            }
            return $return;
        }

        public function selectUsuarios()
        {
            $sql = "SELECT su.users_id, st.trabajador_numero, CONCAT(st.trabajador_nombre,' ',st.trabajador_apellido1,' ',st.trabajador_apellido2) AS nombre_trabajador, su.users_email, sp.nombre, su.users_rol, su.users_status
            FROM sad_trabajador st
            INNER JOIN sad_users su ON st.trabajador_id = su.trabajador_id
            INNER JOIN sad_plantel sp ON st.plantel_id = sp.id";

            $request = $this->select_all($sql);
            return $request;
        }

        public function selectUsuario(int $idpersona)
        {
            $this->intIdUsuario = $idpersona;
            $sql = "SELECT su.users_id, st.trabajador_numero, st.trabajador_nombre, st.trabajador_apellido1,st.trabajador_apellido2, 
            su.users_email, sp.nombre, su.users_rol, su.users_status, DATE_FORMAT(st.trabajador_create, '%d-%m-%Y') AS fechaRegistro,sp.id
            FROM sad_trabajador st
            INNER JOIN sad_users su ON st.trabajador_id = su.trabajador_id
            INNER JOIN sad_plantel sp ON st.plantel_id = sp.id
            WHERE su.users_id = $this->intIdUsuario";

            $request = $this->select($sql);
            return $request;
        }

        public function updateTrabajador(int $idUsuario, string $nombre, string $apellido1, string $apellido2, int $plantel,
        string $noTrabajador, string $email, string $password, int $rol, int $status){

            $this->intIdUsuario = $idUsuario;
            $this->strNombre = $nombre;
            $this->strApellido1 = $apellido1;
            $this->strApellido2 = $apellido2;
            $this->intPlantel = $plantel;
            $this->strNoTrabajador = $noTrabajador;
            $this->strEmail = $email;
            $this->strPassword = $password;
            $this->intRol = $rol;
            $this->intStatus = $status;
            $return = 0;

            $sql = "SELECT *
            FROM sad_trabajador st
            INNER JOIN sad_users su ON st.trabajador_id = su.trabajador_id
            WHERE su.users_email = '{$this->strEmail}' AND su.users_id != $this->intIdUsuario
            OR st.trabajador_numero = '{$this->strNoTrabajador}' AND su.users_id != $this->intIdUsuario";
            
            $request_vald = $this->select_all($sql);
            if(empty($request_vald))
            {   
                $sql_idTrab = "SELECT st.trabajador_id FROM sad_trabajador st INNER JOIN sad_users su ON st.trabajador_id = su.trabajador_id WHERE su.users_id = $this->intIdUsuario";
                $request_idTrab = $this->select($sql_idTrab);
                $this->intTrabajador = $request_idTrab['trabajador_id'];

                if($this->strPassword != "")
                {
                    $query_up_us = "UPDATE sad_users SET users_email=?, users_password=?, users_rol=?, users_status=?
                            WHERE users_id = $this->intIdUsuario";
                    $arrData = array($this->strEmail,
                                    $this->strPassword,
                                    $this->intRol,
                                    $this->intStatus);
                
                    $sql_trab = "UPDATE sad_trabajador SET trabajador_numero=?, trabajador_nombre=?, trabajador_apellido1=?, trabajador_apellido2=?, plantel_id=?
                                WHERE trabajador_id = $this->intTrabajador";
                    $arrData_trab = array($this->strNoTrabajador,
                                            $this->strNombre,
                                            $this->strApellido1,
                                            $this->strApellido2,
                                            $this->intPlantel);
                }else{
                    $query_up_us = "UPDATE sad_users SET users_email=?, users_rol=?, users_status=?
                            WHERE users_id = $this->intIdUsuario";
                    $arrData = array($this->strEmail,
                                    $this->intRol,
                                    $this->intStatus);
                    $sql_trab = "UPDATE sad_trabajador SET trabajador_numero=?, trabajador_nombre=?, trabajador_apellido1=?, trabajador_apellido2=?, plantel_id=?
                                WHERE trabajador_id = $this->intTrabajador";
                    $arrData_trab = array($this->strNoTrabajador,
                                                $this->strNombre,
                                                $this->strApellido1,
                                                $this->strApellido2,
                                                $this->intPlantel);

                }
                $request_vald = $this->update($query_up_us,$arrData);
                $request_trab = $this->update($sql_trab,$arrData_trab);
            }else{
                $request_vald = 0;
            }
            return $request_vald;

        }

        public function deleteUsuario(int $intIdusuario)
        {
            $this->intIdUsuario = $intIdusuario;
            $sql = "UPDATE sad_users SET users_status = ? WHERE users_id = $this->intIdUsuario";
            $arrData = array(0);
            $request = $this->update($sql, $arrData);
            return $request;
        }



    }

?>