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
                     <input class="form-control valid validText" id="oficioAsunto" name="oficioAsunto" type="text" placeholder="No. de Oficio" required="">
                  
                  
                  
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
               <embed src="" type="application/pdf" id="documentoOficio" width="100%" height="600px" />
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
               <input type="hidden" id="oficioId" name="oficioId" value="">
               <p class="text-primary"> Todos los campos son obligatorios y los documentos requieren ser PDF</p>

               <h5 class="text-primary">Digitalización de Acuse</h5>
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
                  <label class="control-label">Archivo</label>
                     <input class="form-control" id="oficioArchivo" name="oficioArchivo" type="file" placeholder="Archivo" required="">
                     <embed id="vistaPrevia" type="application/pdf" width="550" height="400">
                </div>
                <div class="form-group col-md-6">
                     <label class="control-label">Correo</label>
                     <input size="16" type="text" class="form-control" id="datetime" name="datetime" readonly>
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
