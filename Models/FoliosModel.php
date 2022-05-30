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

    }

    

?>