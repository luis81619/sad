<?php

    class OficiosModel extends Mysql
    {
        private $intIdOficio;
        private $strNoficio;
        private $strdateOficio;  
        private $intPlantelRecibe;  
        private $strDirigido;  
        private $strEmite;  
        private $strAsunto;  
        private $intplantelEmite;  
        private $idarchivo;
        private $strNombreArchivo; 
        private $strFolio; 
        private $strToken;   
        private $intUsuarioPlantel;
        private $intIdFolioEmisor;
        private $intIdAcuse; 
        private $strFolioAcuse; 
        private $strIdArchivoAcuse; 
        private $strDateAcuse; 
        private $strTokenAcuse;
        private $strEmailEmite;

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

        /*
        public function generarFolio()
        {
            $sql = "SELECT MAX(oficio_id) FROM sad_acuse";
            $request = $this->select($sql);
            $valor = intval($request);

            if($valor > 0 && $valor < 10){
                $folio = "FL-SOD-00".$valor;
            }else if($valor > 9 && $valor < 100){
                $folio = "FL-SOD-0".$valor; 
            }else{
                $folio = "FL-SOD-".$valor;
            }
            return $folio;
        }*/

        public function insertOficio(string $idArchivo, string $noFicio, string $asunto,
        string $dateOficio, string $emite, string $dirigido, int $plantelEmite, int $plantelRecibe,
        string $token, string $emailEmite ,string $nombreArchivo)
        {
            /*
            if($plantelRecibe == $plantelEmite){
                return 0;
                die();
            }*/

            $this->strNoficio = $noFicio;
            $this->strdateOficio = $dateOficio;
            $this->intPlantelRecibe = $plantelRecibe;
            $this->strDirigido = $dirigido;
            $this->strEmite = $emite;
            $this->strAsunto = $asunto;
            $this->intplantelEmite = $plantelEmite;
            $this->idarchivo = $idArchivo;
            $this->strNombreArchivo = $nombreArchivo;
            $this->strToken = $token;
            $this->strEmailEmite = $emailEmite; 
            $status = 1;
            $return = 0;
            $tipoArchivo = "DRIVE";

            $sql = "SELECT * FROM sad_oficio WHERE
            oficio_serie = '{$this->strNoficio}'";
            
            $request = $this->select_all($sql);

            if(empty($request)){

                $query_insert_archivo = "INSERT INTO sad_archivo (archivo_ruta, archivo_tipo, archivo_nombre)
                VALUES (?,?,?)";

                $arrData_archivo = array(
                    $this->idarchivo,
                    $tipoArchivo,
                    $this->strNombreArchivo);
                
                $request_archivo = $this->insert($query_insert_archivo, $arrData_archivo);
                $lastArchivo = $request_archivo;
                
                $archivoTempId = 1;
                $query_insert_acuse = "INSERT INTO sad_acuse (archivo_id, acuse_correo_asignado) VALUES(?,?)";
                $arrData_acuse = array($archivoTempId, $this->strEmailEmite);
                $request_acuse = $this->insert($query_insert_acuse, $arrData_acuse);
                $lastAcuse = $request_acuse;

                if($lastAcuse > 0 && $lastAcuse < 10){
                    $folio = "FL-SOD-00".$lastAcuse;
                }else if($lastAcuse > 9 && $lastAcuse < 100){
                    $folio = "FL-SOD-0".$lastAcuse; 
                }else{
                    $folio = "FL-SOD-".$lastAcuse;
                }


                $query_insert = "INSERT INTO sad_oficio (archivo_id, oficio_folio, oficio_serie, oficio_asunto, 
                oficio_fecha_emision, oficio_emite, oficio_dirigido, oficio_status, 
                plantel_id_emite, plantel_id_recibe, acuse_id, oficio_token)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

                $arrData = array(
                    $lastArchivo,
                    $folio,
                    $this->strNoficio,
                    $this->strAsunto,
                    $this->strdateOficio,
                    $this->strEmite,
                    $this->strDirigido,
                    $status,
                    $this->intplantelEmite,
                    $this->intPlantelRecibe,
                    $lastAcuse,
                    $this->strToken);
                
                $request = $this->insert($query_insert, $arrData);
                $lastOFicio = $request;

                $query_up = "UPDATE sad_acuse SET oficio_id = ? WHERE acuse_id = ".$lastAcuse;
                $arrDataUp = array(
                    $lastOFicio,
                );
    
                $requestup = $this->update($query_up, $arrDataUp);
                return $request;
            }else{
                return 0;
            }
            return 0;
        }

        public function selectOficos(int $usuarioPlantel)
        {
            $this->intUsuarioPlantel = $usuarioPlantel;

            $sql = "SELECT so.oficio_id, so.oficio_serie, so.oficio_folio, so.oficio_dirigido, so.oficio_asunto, 
            sp.nombre AS plantelEmite, spp.nombre AS plantelRecibe, so.oficio_status, so.archivo_id, 
            sp.id AS idEmite, spp.id AS idRecibe, sa.acuse_folio, sr.archivo_ruta, sa.acuse_token, srr.archivo_ruta AS rutaAcuse
            FROM sad_oficio so 
            INNER JOIN sad_plantel sp ON so.plantel_id_emite = sp.id 
            INNER JOIN sad_plantel spp ON so.plantel_id_recibe = spp.id 
            INNER JOIN sad_acuse sa ON so.acuse_id = sa.acuse_id 
            INNER JOIN sad_archivo sr ON so.archivo_id = sr.archivo_id
            INNER JOIN sad_archivo srr ON sa.archivo_id = srr.archivo_id
            WHERE so.plantel_id_emite = $this->intUsuarioPlantel  || so.plantel_id_recibe = $this->intUsuarioPlantel ";

            $request = $this->select_all($sql);
            return $request;
        }

        public function insertAcuse(int $oficioId,string $AcuseFolio, string $idarchivoAcuse, string $dateAcuse, string $TokenAcuse){

            $this->intIdOficio = $oficioId;
            $this->strFolioAcuse = $AcuseFolio;
            $this->strIdArchivoAcuse = $idarchivoAcuse;
            $this->strDateAcuse = $dateAcuse;
            $this->strTokenAcuse = $TokenAcuse;
            $tipoArchivo = "DRIVE";
            $return = 0;

            $sql = "SELECT * FROM sad_acuse WHERE
            acuse_folio = '{$this->strFolioAcuse}'";

            $requestSql = $this->select_all($sql);

            if(empty($requestSql)){
                $sqlIdAcuse = "SELECT sa.acuse_id FROM sad_acuse sa INNER JOIN sad_oficio so ON sa.acuse_id = so.acuse_id
                WHERE so.oficio_id = $this->intIdOficio ";

                $requestIdAcuse = $this->select($sqlIdAcuse);
                $this->intIdAcuse = $requestIdAcuse['acuse_id'];

                $query_insert_archivo = "INSERT INTO sad_archivo (archivo_ruta, archivo_tipo, archivo_nombre)
                    VALUES (?,?,?)";

                $arrData_archivo = array(
                    $this->strIdArchivoAcuse,
                    $tipoArchivo,
                    $this->strFolioAcuse);
                    
                $request_archivo = $this->insert($query_insert_archivo, $arrData_archivo);
                $lastArchivo = $request_archivo;

                $query_update_acuse = "UPDATE sad_acuse SET acuse_folio = ?, archivo_id = ?, acuse_f_asignado =?,
                acuse_token = ?, acuse_create= now() WHERE acuse_id = $this->intIdAcuse";
                $arrDataUpAcuse = array(
                    $this->strFolioAcuse,
                    $lastArchivo,
                    $this->strDateAcuse,
                    $this->strTokenAcuse
                );

            $request = $this->update($query_update_acuse, $arrDataUpAcuse);

            return $request;   
                     
            }else{
                return 0;
            }
            return 0;
        }

        public function getDatosEmail(){

            $sql = "SELECT so.oficio_id, sp.nombre AS plantelEmite, so.oficio_fecha_emision, su.users_email, so.oficio_folio 
            FROM sad_oficio so 
            INNER JOIN sad_plantel sp ON so.plantel_id_emite = sp.id 
            INNER JOIN sad_trabajador st ON st.plantel_id = so.plantel_id_recibe 
            INNER JOIN sad_users su ON st.trabajador_id = su.trabajador_id 
            WHERE oficio_id = (SELECT MAX(oficio_id) FROM sad_oficio soo); ";

            $request = $this->select($sql);
            return $request;
        }

        public function getDatosEmailRecibe(){

            $sql="SELECT su.users_email, sp.nombre 
            FROM sad_users su
            INNER JOIN sad_trabajador st ON su.trabajador_id = st.trabajador_id
            INNER JOIN sad_plantel sp ON st.plantel_id = sp.id
            WHERE sp.id = (SELECT plantel_id_recibe 
            FROM sad_oficio so 
            WHERE so.oficio_id = (SELECT MAX(oficio_id) FROM sad_oficio))";

            $request = $this->select($sql);
            return $request;

        }

        public function getValidarOficio(string $oficioFolio){
            $this->strNoficio = $oficioFolio;

            $sql = "SELECT * FROM sad_oficio so
            WHERE so.oficio_serie = '{$this->strNoficio}'";

            $request = $this->select_all($sql);
            return $request;

        }

        public function getValidarAcuse(string $acuseFolio){
            $this->strNoficio = $acuseFolio;

            $sql = "SELECT * FROM sad_acuse sa
            WHERE sa.acuse_folio = '{$this->strNoficio}'";

            $request = $this->select_all($sql);
            return $request;

        }


        public function getDatosEmailAcuse(string $FolioAcuse){
            $this->strFolioAcuse = $FolioAcuse;

            $sql = "SELECT sa.acuse_folio, sp.nombre AS plantelEmite, spp.nombre AS plantelRecibe, sa.acuse_correo_asignado AS correoRespuesta,
            su.users_email AS correoAcuse, sa.acuse_token, sa.acuse_create, so.oficio_serie
            FROM sad_oficio so
            INNER JOIN sad_acuse sa ON so.acuse_id = sa.acuse_id
            INNER JOIN sad_plantel sp ON so.plantel_id_emite = sp.id
            INNER JOIN sad_plantel spp ON so.plantel_id_recibe = spp.id
            INNER JOIN sad_trabajador st ON spp.id = st.plantel_id
            INNER JOIN sad_users su ON st.trabajador_id = su.trabajador_id
            WHERE sa.acuse_folio = '{$this->strFolioAcuse}'";

            $request = $this->select($sql);
            return $request;
        }

        public function selectOficio(int $oficio)
        {
            $this->intIdOficio = $oficio;
            $sql = "SELECT * FROM sad_oficio
            WHERE oficio_id = $this->intIdOficio";

            $request = $this->select($sql);
            return $request;
        }

    }

?>