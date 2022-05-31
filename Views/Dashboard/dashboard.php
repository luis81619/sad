<?php headerAdmin($data); ?>
    <main class="app-content">
    <?php
    if(!empty($_SESSION['userData']['users_rol'] != 3 && $_SESSION['userData']['users_rol'] != 1)){
?>
    <p>Acceso Restringido</p>
    <?php
    }else{?>
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">Create a beautiful dashboard</div>

            


          </div>
        </div>
      </div>

      <?php } ?>
    </main>

    <?php footerAdmin($data); ?>
