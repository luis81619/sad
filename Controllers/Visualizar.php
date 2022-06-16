
<?php

use Google\Auth\OAuth2;

require 'Libraries/apiDrive/vendor/autoload.php';

    class Visualizar extends Controllers{
        
        public function __construct()
        {
            parent::__construct();
            session_start();

        }

        public function Visualizar($parems)
        {
           $data['page_tag'] = "Oficios";
           $data['page_title'] = "Oficios";
           $data['page_name'] = "oficios";
           $data['carp_js'] = "oficios";
           $data['arc_js'] = "function_oficios";
           $this->views->getView($this, "visualizar", $data);
        }

        
        public function generarFolioEmite()
        {
            $claveJSON = '1CaYNqbfwUDgZa99oKONBKPXe0LIPUbg3';
            $pathJSON = 'archivoprueba-66b65b06b014.json';

            //configurar variable de entorno
            putenv('GOOGLE_APPLICATION_CREDENTIALS='.$pathJSON);

            $client = new Google_Client();
            $client->useApplicationDefaultCredentials();
            $client->setScopes(['https://www.googleapis.com/auth/drive.file']);

            $service = new Google_Service_Drive($client);

            

            
            die();
        }

    }

?>

