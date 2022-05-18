<?php

    class Home extends Controllers{
        
        public function __construct()
        {
            parent::__construct();

        }

        public function home($parems)
        {
           $data['tag_page'] = "Home";
           $data['page_title'] = "Pagina Principal";
           $data['page_name'] = "home";
           $this->views->getView($this, "home", $data);
        }
    }

?>