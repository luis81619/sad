<?php

    class FoliosModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function selectFolioEmisor(int $idFolioEmisor){
            $this->intIdFolioEmisor = $idFolioEmisor;

            $sql = "SELECT *
            FROM sad_oficio so
            WHERE so.oficio_id = $this->intIdFolioEmisor ";

            $request = $this->select($sql);
            return $request;
        }

        public function selectFolioAcuse(string $tokenAcuse){
            $this->strTokenAcuse = $tokenAcuse;

            $sql = "SELECT *
            FROM sad_acuse sa
            WHERE sa.acuse_token = '{$this->strTokenAcuse}'";

            $request = $this->select($sql);
            return $request;
        }

    }

    

?>