<?php

    class FoliosModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function selectFolioEmisor(int $idFolioEmisor){
            $this->intIdFolioEmisor = $idFolioEmisor;

            $sql = "SELECT *, sp.nombre as plantel_emite, spr.nombre as plantel_recibe, ac.acuse_f_recibo as fechaCreate
            FROM sad_oficio so
            INNER JOIN sad_plantel sp ON so.plantel_id_emite = sp.id
            INNER JOIN sad_plantel spr ON so.plantel_id_recibe = spr.id
            INNER JOIN sad_acuse ac ON so.acuse_id = ac.acuse_id
            WHERE so.oficio_id = $this->intIdFolioEmisor ";

            $request = $this->select($sql);
            return $request;
        }

        public function selectFolioAcuse(string $tokenAcuse){
            $this->strTokenAcuse = $tokenAcuse;

            $sql = "SELECT *, sp.nombre as plantel_emite, spr.nombre as plantel_recibe
            FROM sad_acuse sa
            INNER JOIN sad_oficio so ON sa.oficio_id = so.oficio_id
            INNER JOIN sad_plantel sp ON so.plantel_id_emite = sp.id
            INNER JOIN sad_plantel spr ON so.plantel_id_recibe = spr.id
            WHERE sa.acuse_token = '{$this->strTokenAcuse}'";

            $request = $this->select($sql);
            return $request;
        }

    }

    

?>