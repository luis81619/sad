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

        public function generarFolio()
        {
            $sql = "SELECT MAX(oficio_id) FROM sad_oficio";
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
        }

        public function insertOficio(string $idArchivo, string $noFicio, string $asunto,
        string $dateOficio, string $emite, string $dirigido, int $plantelEmite, int $plantelRecibe, string $Folio,
        string $token, string $nombreArchivo)
        {
            $this->strNoficio = $noFicio;
            $this->strdateOficio = $dateOficio;
            $this->intPlantelRecibe = $plantelRecibe;
            $this->strDirigido = $dirigido;
            $this->strEmite = $emite;
            $this->strAsunto = $asunto;
            $this->intplantelEmite = $plantelEmite;
            $this->idarchivo = $idArchivo;
            $this->strNombreArchivo = $nombreArchivo;
            $this->strFolio = $Folio;
            $this->strToken = $token;
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

                $query_insert_acuse = "INSERT INTO sad_acuse VALUES()";
                $arrData_acuse = array();
                $request_acuse = $this->insert($query_insert_acuse, $arrData_acuse);
                $lastAcuse = $request_acuse;


                $query_insert = "INSERT INTO sad_oficio (archivo_id, oficio_folio, oficio_serie, oficio_asunto, 
                oficio_fecha_emision, oficio_emite, oficio_dirigido, oficio_status, 
                plantel_id_emite, plantel_id_recibe, acuse_id, oficio_token)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

                $arrData = array(
                    $lastArchivo,
                    $this->strFolio,
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
            sp.nombre AS plantelEmite, spp.nombre AS plantelRecibe, so.oficio_status, so.archivo_id, sp.id AS idEmite, 
            spp.id AS idRecibe, sa.acuse_folio, sr.archivo_ruta
            FROM sad_oficio so
            INNER JOIN sad_plantel sp ON so.plantel_id_emite = sp.id
            INNER JOIN sad_plantel spp ON so.plantel_id_recibe = spp.id
            INNER JOIN sad_acuse sa ON so.acuse_id = sa.acuse_id 
            INNER JOIN sad_archivo sr ON so.archivo_id = sr.archivo_id
            WHERE so.plantel_id_emite = $this->intUsuarioPlantel  || so.plantel_id_recibe = $this->intUsuarioPlantel ";

            $request = $this->select_all($sql);
            return $request;
        }

        



    }

?>