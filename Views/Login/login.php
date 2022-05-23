<!DOCTYPE html>
<html lang="es">
  <head>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Sistema de Evaluación en Linea - CECYTEM">
    <title><?= $data['page_tag'] ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Departamento de Informatica | CECYTEM">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?= media(); ?>/images/favicon.ico">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
  </head>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>SAD</h1>
      </div>
      <div class="login-box">
        <div id="divLoading">
          <div>
            <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
          </div>
        </div>
        <form class="login-form" name="formLogin" id="formLogin" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Iniciar Sesión</h3>
          <div class="form-group">
            <label class="control-label">USUARIO</label>
            <input id="loginEmail" name="loginEmail" class="form-control" type="email" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">Contraseña</label>
            <input id="loginPassword" name="loginPassword" class="form-control" type="password" placeholder="Contraseña">
          </div>
          <div id="alertLogin" class="text-center"></div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i>Iniciar Sesión</button>
          </div>
        </form>
        <form class="forget-form" action="index.html">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿Olvidaste tu contraseña?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input id="loginEmailReset" class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESTAURAR</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar sesión</a></p>
          </div>
        </form>
      </div>
    </section>

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

    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>




    <script type="text/javascript" src="<?= media(); ?>/js/function_admin.js"></script>

    <?php if($data['carp_js'] != "" && $data['arc_js'] != "" ){ ?>
    <script src="<?= media(); ?>/js/<?=$data['carp_js']?>/<?=$data['arc_js']?>.js"></script>
    <?php } else { ?>
    <script src="<?= media(); ?>/js/<?=$data['arc_js']?>.js"></script>
    <?php } ?>
    
  </body>
</html>