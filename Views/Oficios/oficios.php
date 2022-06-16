<?php headerAdmin($data); ?>
    <main class="app-content">

<?php
    getModalCarpeta('Oficios','modalOficios', $data);
    if(!empty($_SESSION['userData']['users_rol'] != 3 && $_SESSION['userData']['users_rol'] != 1)){
?>
    <p>Acceso Restringido</p>
    <?php
    }else{?>
      <div class="app-title">
        <div>
          <h1><i class="fas fa-file"></i> <?= $data['page_title'] ?>
              <button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Nuevo Oficio</button>
          </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/usuarios"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tableOficios">
                  <thead>
                    <tr>
                      <th>NO. OFICIO</th>
                      <th>NO. FOLIO</th>
                      <th>DIRIGIDO A</th>
                      <th>ASUNTO</th>
                      <th>EMITE</th>
                      <th>RECIBE</th>
                      <th>STATUS</th>
                      <th>ACCIONES</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </main>
<?php footerAdmin($data); ?>