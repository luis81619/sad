<?php 
require 'Libraries/apiDrive/vendor/autoload.php';

    $claveJSON = '1CaYNqbfwUDgZa99oKONBKPXe0LIPUbg3';
    $pathJSON = 'archivoprueba-66b65b06b014.json';

    //configurar variable de entorno
    putenv('GOOGLE_APPLICATION_CREDENTIALS='.$pathJSON);

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    $client->setScopes(['https://www.googleapis.com/auth/drive.file']);

    $service = new Google_Service_Drive($client);

    $resultado = $service->files->listFiles([
      'q' => "name='OF-001'",
      'fields' => 'files(id, size)'
    ]);

    $id = $resultado[0]->id;

    $ruta = 'https://drive.google.com/open?id='.$id.'/view';

    echo '<a href="'.$ruta.'" > archivoLuis </a>';

    ?>
<!--
<script type="text/javascript">

window.addEventListener('load', function() {
    funcionPrueba();
}, false);

function funcionPrueba() {
    
     $.ajax({
        type: 'GET',
        url: 'http://drive.google.com/open?id=1T73KkD4viIiv9Kmd65e_01eh9_zkyur0',
        dataType: 'json',
        success: function (data) {

        const binaryString = window.atob(data.content);
        const len = binaryString.length;
        const bytes = new Uint8Array(len);
        for (let i = 0; i < len; ++i) {
            bytes[i] = binaryString.charCodeAt(i);
        }
        var datosblob = new Blob([bytes], { type: 'application/pdf' });
        $('#documentoOficio2').attr('src',URL.createObjectURL(datosblob));
        
    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.log('error al ejecutar');
    }
});

}

</script>
-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <p>
      

    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <iframe id="documentoOficio2" src="<?php echo $ruta ?>" height="100%" width="100%"></iframe>
    </div>


  </body>
</html>

<script>
      const base_url = "<?= base_url();  ?>"

    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <script src="<?= media(); ?>/js/fontawesome.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>