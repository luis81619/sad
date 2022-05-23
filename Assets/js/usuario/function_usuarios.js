let tableUsuarios;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

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

    let formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function(e){
        e.preventDefault();

        let intIdtrabajador = document.querySelector('#usuarioId').value;
        let strNoTrabajador = document.querySelector('#noTrabajador').value;
        let intPlantel = document.querySelector('#usuarioPlantelid').value;
        let strNombre = document.querySelector('#usuarioNombre').value;
        let strApellido1 = document.querySelector('#usuarioApellido1').value;
        let strApellido2 = document.querySelector('#usuarioApellido2').value;
        let intTipousuario = document.querySelector('#usuarioRolid').value;
        let strEmail = document.querySelector('#usuarioEmail').value;
        let strPassword = document.querySelector('#usuarioPassword').value;
        let strPasswordConfirm = document.querySelector('#usuarioPasswordConfirm').value;
        let intStatus = document.querySelector('#usuarioStatus').value;
        let strNombreCompleto = strNombre +" "+strApellido1+" "+strApellido2
        
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
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Usuarios/setUsuario'; 
            let formData = new FormData(formUsuario);
            request.open("POST",ajaxUrl,true);
            request.send(formData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    //console.log(request);
                    let objData = JSON.parse(request.responseText);
                    
                    if(objData.status)
                    {
                        if(rowTable == ""){
                            tableUsuarios.api().ajax.reload();
                        }else{
                            htmlStatus = intStatus == 1 ? 
                            '<span class="badge badge-success">Activo</span>':
                            '<span class="badge badge-danger">Inactivo</span>';

                            rowTable.cells[0].textContent = strNoTrabajador;
                            rowTable.cells[1].textContent = strNombreCompleto;
                            rowTable.cells[2].textContent = strEmail;
                            rowTable.cells[3].textContent = document.querySelector("#usuarioPlantelid").selectedOptions[0].text;
                            rowTable.cells[4].textContent = document.querySelector("#usuarioRolid").selectedOptions[0].text;
                            rowTable.cells[5].innerHTML = htmlStatus;
                        }
                        $('#modalFormUsuario').modal("hide");
                        formUsuario.reset();
                        swal("Usuarios", objData.msg, "success");
                        
                    }else{
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        

        
        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('is-invalid')) { 
                swal("Atención", "Por favor verifique los campos en rojo." , "error");
                divLoading.style.display = "none";
                return false;
            } 
        } 

    }

}, false);



window.addEventListener('load', function() {
    fntPlantelUsuario();
}, false);

function fntPlantelUsuario(){

    let ajaxUrl = base_url+'/Usuarios/getSelectPlantel';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
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
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = base_url + '/Usuarios/getUsuario/' + idusuario;
	request.open("GET", ajaxUrl, true);
	request.send();

	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			let objData = JSON.parse(request.responseText);

			if (objData.status) {

                
				let rolUsuario = objData.data.users_rol == 1 ?
                '<span>DIGITALIZADOR</span>' :
                '<span>ADMINISTRADOR</span>';

				let estadoUsuario = objData.data.users_status == 1 ?
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


function fntEditUsuario(element, idusuario) {
    rowTable = element.parentNode.parentNode.parentNode;
    //console.log(rowTable);
	document.querySelector('#titleModal').innerHTML = "Actualizar Usuario";
	document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
	document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
	document.querySelector('#btnText').innerHTML = "Actualizar";
    
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = base_url + '/Usuarios/getUsuario/' + idusuario;
	request.open("GET", ajaxUrl, true);
	request.send();

	request.onreadystatechange = function () {

		if (request.readyState == 4 && request.status == 200) {
			let objData = JSON.parse(request.responseText);
            
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


function openModal(){
    rowTable = "";  
    document.querySelector('#usuarioId').value="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();

    $('#modalFormUsuario').modal('show');
}

