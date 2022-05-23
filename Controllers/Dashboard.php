<?php

    class Dashboard extends Controllers{
        
        public function __construct()
        {
            sessionStart();
            parent::__construct();
            //session_start();
            //session_regenerate_id(true);
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
            }
        }

        public function Dashboard()
        {
           $data['page_id'] = "2";
           $data['page_tag'] = "Dashboard - SEL";
           $data['page_title'] = "Dashboard - SEL";
           $data['page_name'] = "Dashboard";
           $this->views->getView($this, "dashboard", $data);
        }
    }

?>