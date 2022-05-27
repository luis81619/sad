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
        private $strFolio;    

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
        string $dateOficio, string $emite, string $dirigido, int $plantelEmite, int $plantelRecibe, string $Folio)
        {
            $this->strNoficio = $noFicio;
            $this->strdateOficio = $dateOficio;
            $this->intPlantelRecibe = $plantelRecibe;
            $this->strDirigido = $dirigido;
            $this->strEmite = $emite;
            $this->strAsunto = $asunto;
            $this->intplantelEmite = $plantelEmite;
            $this->idarchivo = $idArchivo;
            $this->strFolio = $Folio;
            $status = 1;
            $return = 0;

            $sql = "SELECT * FROM sad_oficio WHERE
            oficio_serie = '{$this->strNoficio}'";
            
            $request = $this->select_all($sql);

            if(empty($request)){

                $query_insert = "INSERT INTO sad_oficio (oficio_archivo_id, oficio_folio, oficio_serie, oficio_asunto, 
                oficio_fecha_emision, oficio_emite, oficio_dirigido, oficio_status, plantel_id_emite, plantel_id_recibe)
                VALUES (?,?,?,?,?,?,?,?,?,?)";

                $arrData = array(
                    $this->idarchivo,
                    $this->strFolio,
                    $this->strNoficio,
                    $this->strAsunto,
                    $this->strdateOficio,
                    $this->strEmite,
                    $this->strDirigido,
                    $status,
                    $this->intplantelEmite,
                    $this->intPlantelRecibe);
                
                $request = $this->insert($query_insert, $arrData);
                return $request;
            }else{
                return 0;
            }
            return 0;
        }

        public function selectOficos()
        {
            $sql = "SELECT so.oficio_id, so.oficio_serie, so.oficio_folio, so.oficio_dirigido, so.oficio_asunto, 
                    so.oficio_emite, sp.nombre, so.oficio_status, so.oficio_archivo_id
            FROM sad_oficio so
            INNER JOIN sad_plantel sp ON so.plantel_id_recibe = sp.id";

            $request = $this->select_all($sql);
            return $request;
        }



    }

?>