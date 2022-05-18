<?php

    class OficiosModel extends Mysql
    {   

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
    }

?>