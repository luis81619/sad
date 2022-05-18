var tableUsuarios;

document.addEventListener('DOMContentLoaded', function(){

    tableUsuarios = $('#tableUsuarios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Usuarios/getUsuarios",
            "dataSrc":""
        },
        "columns":[
            {"data":"trabajador_numero"},
            {"data":"nombre_trabajador"},
            {"data":"users_email"},
            {"data":"nombre"},
            {"data":"users_rol"},
            {"data":"users_status"},
            {"data":"options"}
        ],'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    var formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function(e){
        e.preventDefault();

        var intIdtrabajador = document.querySelector('#usuarioId').value;
        var strNoTrabajador = document.querySelector('#noTrabajador').value;
        var intPlantel = document.querySelector('#usuarioPlantelid').value;
        var strNombre = document.querySelector('#usuarioNombre').value;
        var strApellido1 = document.querySelector('#usuarioApellido1').value;
        var strApellido2 = document.querySelector('#usuarioApellido2').value;
        var intTipousuario = document.querySelector('#usuarioRolid').value;
        var strEmail = document.querySelector('#usuarioEmail').value;
        var strPassword = document.querySelector('#usuarioPassword').value;
        var strPasswordConfirm = document.querySelector('#usuarioPasswordConfirm').value;
        var intStatus = document.querySelector('#usuarioStatus').value;
        
        if(intIdtrabajador == ""){
            if(strNoTrabajador == '' || strEmail == '' || strNombre == '' || strApellido1 == '' || strApellido2 == '' || intPlantel == '' || intTipousuario == '' || strPassword == '' || strPasswordConfirm == '' )
            {
                swal("Atención", "Todos los campos son obligatorios 1.", "error");
                return false;
            }else{
                if(strPassword.length < 5){
                swal("Atención", "La contraseña debe tener un minimo de 5 caracteres.", "info");
                return false;
                }
                if(strPassword != strPasswordConfirm){
                swal("Atención", "La contraseña no son iguales.", "info");
                return false;
                }
            }
        }else{
            if(strNoTrabajador == '' || strEmail == '' || strNombre == '' || strApellido1 == '' || strApellido2 == '' || intPlantel == '' || intTipousuario == '' )
            {
                swal("Atención", "Todos los campos son obligatorios 2.", "error");
                return false;
            }
        }

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/Usuarios/setUsuario'; 
            var formData = new FormData(formUsuario);
            request.open("POST",ajaxUrl,true);
            request.send(formData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    //console.log(request);
                    var objData = JSON.parse(request.responseText);
                    
                    if(objData.status)
                    {
                        $('#modalFormUsuario').modal("hide");
                        formUsuario.reset();
                        swal("Usuarios", objData.msg, "success");
                        tableUsuarios.api().ajax.reload();
                        /*tableUsuarios.api().ajax.reload(function(){
                            fntRolesUsuario();
                            fntPlantelUsuario();
                        });*/
                    }else{
                        swal("Error", objData.msg, "error");
                    }
                }
            }
        

        
        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('is-invalid')) { 
                swal("Atención", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        } 

    }

}, false);



window.addEventListener('load', function() {
    //fntRolesUsuario();
    fntPlantelUsuario();
    /*fntViewUsuario();
    fntEditUsuario();
    fntDelUsuario();*/
}, false);

function fntPlantelUsuario(){

    var ajaxUrl = base_url+'/Usuarios/getSelectPlantel';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();
    
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#usuarioPlantelid').innerHTML = request.responseText;
            document.querySelector('#usuarioPlantelid').value = 1;
            $('#usuarioPlantelid').selectpicker('render');
        }
    }
    
    
}



function fntViewUsuario(idusuario) {
	var idusuario = idusuario;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url + '/Usuarios/getUsuario/' + idusuario;
	request.open("GET", ajaxUrl, true);
	request.send();

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);

			if (objData.status) {

                
				var rolUsuario = objData.data.users_rol == 1 ?
                '<span>DIGITALIZADOR</span>' :
                '<span>ADMINISTRADOR</span>';

				var estadoUsuario = objData.data.users_status == 1 ?
					'<span class="badge badge-success">Activo</span>' :
					'<span class="badge badge-danger">Inactivo</span>';

				document.querySelector("#celNoTrabajador").innerHTML = objData.data.trabajador_numero;
				document.querySelector("#celNombre").innerHTML = objData.data.trabajador_nombre;
				document.querySelector("#celApellido1").innerHTML = objData.data.trabajador_apellido1;
				document.querySelector("#celApellido2").innerHTML = objData.data.trabajador_apellido2;
				document.querySelector("#celEmail").innerHTML = objData.data.users_email;
				document.querySelector("#celPlantel").innerHTML = objData.data.nombre;
				document.querySelector("#celTipoUsuario").innerHTML = objData.data.rolUsuario;
				document.querySelector("#celStatus").innerHTML = estadoUsuario;
				document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
				$('#modalViewUsuario').modal('show');
			} else {
				swal("Error", objData.msg, "error");
			}
		}
	}
}


function fntEditUsuario(idusuario) {

	document.querySelector('#titleModal').innerHTML = "Actualizar Usuario";
	document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
	document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
	document.querySelector('#btnText').innerHTML = "Actualizar";
    
	var idusuario = idusuario;
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url + '/Usuarios/getUsuario/' + idusuario;
	request.open("GET", ajaxUrl, true);
	request.send();

	request.onreadystatechange = function () {

		if (request.readyState == 4 && request.status == 200) {
			var objData = JSON.parse(request.responseText);
            
			if (objData.status) {
				document.querySelector("#usuarioId").value = objData.data.users_id;
				document.querySelector("#noTrabajador").value = objData.data.trabajador_numero;
				document.querySelector("#usuarioPlantelid").value = objData.data.id;
				document.querySelector("#usuarioNombre").value = objData.data.trabajador_nombre;
				document.querySelector("#usuarioApellido1").value = objData.data.trabajador_apellido1;
				document.querySelector("#usuarioApellido2").value = objData.data.trabajador_apellido2;
				document.querySelector("#usuarioRolid").value = objData.data.rol_id;
				document.querySelector("#usuarioEmail").value = objData.data.users_email;
                document.querySelector("#usuarioStatus").value = objData.data.users_status;
				$('#usuarioPlantelid').selectpicker('render');

				if (objData.data.users_rol == 1) {
					document.querySelector("#usuarioRolid").value = 1;
				} else {
					document.querySelector("#usuarioRolid").value = 3;
				}
				$('#usuarioRolid').selectpicker('render');

                if (objData.data.users_status == 1) {
					document.querySelector("#usuarioStatus").value = 1;
				} else {
					document.querySelector("#usuarioStatus").value = 0;
				}
				$('#usuarioStatus').selectpicker('render');

			}
			$('#modalFormUsuario').modal('show');
		}
	}

}


function fntDelUsuario(idusuario) {

	var idusuario = idusuario;
	swal({
		title: "Desactivar Usuario",
		text: "¿Realmente quiere desactivar el Usuario?",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: "Si, desactivar!",
		cancelButtonText: "No, cancelar!",
		closeOnConfirm: false,
		closeOnCancel: true
	}, function (isConfirm) {

		if (isConfirm) {
			var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			var ajaxUrl = base_url + '/Usuarios/delUsuario/';
			var strData = "idusuario=" + idusuario;
			request.open("POST", ajaxUrl, true);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			request.send(strData);
			request.onreadystatechange = function () {
				if (request.readyState == 4 && request.status == 200) {
					var objData = JSON.parse(request.responseText);
					if (objData.status) {
						swal("Eliminar!", objData.msg, "success");
						tableUsuarios.api().ajax.reload(function () {
							//fntRolesUsuario();
							//fntPlantelUsuario();
							//fntViewUsuario();
							//fntEditUsuario();
							//fntDelUsuario();
						});
					} else {
						swal("Atención!", objData.msg, "error");
					}
				}
			}
		}

	});
}

function openModal(){
    document.querySelector('#usuarioId').value="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();

    $('#modalFormUsuario').modal('show');
}

