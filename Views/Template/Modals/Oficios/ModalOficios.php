<!-- Modal Agregar usuario-->
<div class="modal fade" id="modalFormOficios" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header headerRegister">
         <h5 class="modal-title" id="titleModal"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="formOficios" name="formOficios" class="form-horizontal">
               <input type="hidden" id="oficioId" name="oficioId" value="">
               <p class="text-primary"> Todos los campos son obligatorios.</p>

               <h5 class="text-primary">Digitalización de Oficios</h5>
               <hr>

               <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="control-label">No. Oficio</label>
                    <input class="form-control" id="nOficio" name="nOficio" type="text" placeholder="No. de Oficio" required="">
                </div>
                <div class="form-group col-md-6">
                     <label class="control-label">Fecha de emision</label>
                     <input size="16" type="text" class="form-control" id="datetime" name="datetime" readonly>
                </div>
                
               </div>
               
               <div class="form-row">
               <div class="form-group col-md-6">
                  <label class="control-label">Dirigido al plantel</label>
                    <select class="form-control" data-live-search="true" id="oficioPlantelid" name="oficioPlantelid" required>

                    </select>
               
                 <label class="control-label">Dirigido a: </label>
                     <input class="form-control valid validText" id="oficioDirigido" name="oficioDirigido" type="text" placeholder="Dirigido a" required="">

                  <label class="control-label">Emite</label>
                  <input class="form-control valid validText" id="oficioEmite" name="oficioEmite" type="text" placeholder="Emite" required="">
                  
                    <label class="control-label">Asunto</label>
                     <input class="form-control valid validText" id="oficioAsunto" name="oficioAsunto" type="text" placeholder="Asunto" required="">
                  
                  
                  
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label">Archivo</label>
                     <input class="form-control" id="oficioArchivo" name="oficioArchivo" type="file" placeholder="Archivo" required="">
                     <embed id="vistaPrevia" type="application/pdf" width="550" height="400">
                </div>
               </div> 
            

               
               
               <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
         </div>
      </div>
   </div>
</div>

<!-- Modal Visualizar Oficios Emisor -->
<div class="modal fade" id="modalViewOficio" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header header-primary">
         <h5 class="modal-title" id="titleModal">Datos del Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">


         <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
               <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">FOLIO</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">OFICIO</a>
            </li>
         </ul>
         <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
               <embed src="" type="application/pdf" id="documentoFolioEmisor" width="100%" height="600px" />
            </div>


            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
               <!--<embed src="" type="application/pdf" id="documentoOficio" width="100%" height="600px" />-->
               <a href="" id="documentoAcuse" target="_blank">Click para visualizar acuse</a>
            </div>
         </div>
            
         </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
      </div>
   </div>
</div>


<!-- Modal Acuse-->

<div class="modal fade" id="modalFormAcuse" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header headerRegister">
         <h5 class="modal-title" id="titleModal">Acuse</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="formAcuse" name="formAcuse" class="form-horizontal">
               <input type="hidden" id="oficioAcuseId" name="oficioAcuseId" value="">
               <p class="text-primary"> Todos los campos son obligatorios y los documentos requieren ser PDF</p>

               <h5 class="text-primary">Digitalización de Acuse</h5>
               <hr>

               <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="control-label">No. Acuse</label>
                    <input class="form-control" id="nAcuse" name="nAcuse" type="text" placeholder="No. de Acuse" required="">

                    <label class="control-label">Fecha de Acuse</label>
                    <input size="16" type="text" class="form-control" id="datetimeAcuse" name="datetimeAcuse" readonly>

                </div>

                <div class="form-group col-md-6">
                  <label class="control-label">Archivo</label>
                     <input class="form-control" id="acuseArchivo" name="acuseArchivo" type="file" placeholder="Archivo" required="">
                     <embed id="vistaPreviaAcuse" type="application/pdf" width="550" height="400">
                </div>
               </div> 
               
               <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
         </div>
      </div>
   </div>
</div>


<!-- Modal Visualizar ACUSES -->
<div class="modal fade" id="modalViewAcuses" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header header-primary">
         <h5 class="modal-title" id="titleModal">Acuse</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">


         <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
               <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">FOLIO-ACUSE</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">ACUSE</a>
            </li>
         </ul>
         <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">
               <embed src="" type="application/pdf" id="documentoFolioAcuse" width="100%" height="600px" />
            </div>


            <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab">
               <!--<embed src="" type="application/pdf" id="documentoAcuse" width="100%" height="600px" />-->
               <a href="" id="vistaAcuse" target="_blank">Click para visualizar acuse</a>
            </div>
         </div>
            
         </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
      </div>
   </div>
</div>

<!-- Modal Detalles-->

<div class="modal fade" id="modalViewDetalles" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header header-primary">
         <h5 class="modal-title" id="titleModal">DETALLES</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
         <table class="table table-bordered">
            <tbody>
                <tr>
                <td>Folio:</td>
                <td id="celNoTrabajador">654654654</td>
                </tr>
                <tr>
                <td>Nombres:</td>
                <td id="celNombre">Jacob</td>
                </tr>
                <tr>
                <td>Apellido Materno:</td>
                <td id="celApellido1">Jacob</td>
                </tr>
                <tr>
                <td>Apellido Paterno:</td>
                <td id="celApellido2">Jacob</td>
                </tr>
                <tr>
                <td>Email (Usuario):</td>
                <td id="celEmail">Larry</td>
                </tr>
                <tr>
                <td>Plantel:</td>
                <td id="celPlantel">Larry</td>
                </tr>
                <tr>
                <td>Tipo Usuario:</td>
                <td id="celTipoUsuario">Larry</td>
                </tr>
                <tr>
                <td>Status:</td>
                <td id="celStatus">Larry</td>
                </tr>
                <tr>
                <td>Fecha registro:</td>
                <td id="celFechaRegistro">Larry</td>
                </tr>
            </tbody>
            </table>
         </div>
         <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
      </div>
   </div>
</div>
