<!-- Modal Agregar usuario-->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header headerRegister">
         <h5 class="modal-title" id="titleModal"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="formUsuario" name="formUsuario" class="form-horizontal">
               <input type="hidden" id="usuarioId" name="usuarioId" value="">
               <p class="text-primary"> Todos los campos son obligatorios.</p>

               <h5 class="text-primary">Datos de la institución y Personales</h5>
               <hr>

               <div class="form-row">
                <div class="form-group col-md-6">
                    <input class="form-control valid validNumber" id="noTrabajador" name="noTrabajador" type="text" placeholder="No. del trabajador" required="">
                </div>
                <div class="form-group col-md-6">
                    <select class="form-control" data-live-search="true" id="usuarioPlantelid" name="usuarioPlantelid" required>

                    </select>
                </div>
                
               </div>
               
               <div class="form-row">
                <div class="form-group col-md-4">
                    <input class="form-control valid validText" id="usuarioNombre" name="usuarioNombre" type="text" placeholder="Nombre del trabajador" required="">
                </div>
                <div class="form-group col-md-4">
                    <input class="form-control valid validText" id="usuarioApellido1" name="usuarioApellido1" type="text" placeholder="Apellido Paterno" required="">
                </div>
                <div class="form-group col-md-4">
                    <input class="form-control valid validText" id="usuarioApellido2" name="usuarioApellido2" type="text" placeholder="Apellido Materno" required="">
                </div>
               </div>

               <h5 class="text-primary">Datos del Usuario</h5>
               <hr>

               <div class="form-row">
               <div class="form-group col-md-3">
                    <select class="form-control" data-live-search="true" id="usuarioRolid" name="usuarioRolid"required>
                     <option hidden selected>Selecciona un Rol</option>
                       <option value="1">DIGITALIZADOR</option>
                       <option value="3">ADMINISTRADOR</option>

                    </select>
                </div>
                <div class="form-group col-md-3">
                    <select class="form-control" data-live-search="true" id="usuarioStatus" name="usuarioStatus"required>
                     <option hidden selected>Selecciona un Status</option>
                       <option value="1">ACTIVO</option>
                       <option value="0">DESACTIVADO</option>

                    </select>
                </div>
               <div class="form-group col-md-6">
                  <input class="form-control valid validEmail" type="text" placeholder="Correo Electronico" id="usuarioEmail" name="usuarioEmail" required="">
                </div>

                <div class="form-group col-md-6">
                    <input class="form-control" id="usuarioPassword" name="usuarioPassword" type="password" placeholder="Contraseña">
                </div>

                <div class="form-group col-md-6">
                    <input class="form-control" id="usuarioPasswordConfirm" name="usuarioPasswordConfirm" type="password" placeholder="Confirmar Contraseña">
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

<!-- Modal Visualizar usuario -->
<div class="modal fade" id="modalViewUsuario" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header header-primary">
         <h5 class="modal-title" id="titleModal">Datos del Usuario</h5>
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