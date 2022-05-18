document.addEventListener('DOMContentLoaded', function(){

    var formUsuario = document.querySelector("#formOficios");
    formUsuario.onsubmit = function(e){
        e.preventDefault();

        var strOficioId = document.querySelector('#oficioId').value;
        var strnOficio = document.querySelector('#nOficio').value;
        var strDate= document.querySelector('#datetime').value;
        var strPlantel = document.querySelector('#oficioPlantelid').value;
        var strDirigido = document.querySelector('#oficioDirigido').value;
        var strEmite = document.querySelector('#oficioEmite').value;
        var strAsunto = document.querySelector('#oficioAsunto').value;
        var strArchivo = document.querySelector('#oficioArchivo').value;

        
        
        if(strnOficio == '' || strDate == '' || strPlantel == '' || strDirigido == '' || strEmite == '' || strAsunto == '' )
        {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }

        /*
        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('is-invalid')) { 
                swal("Atención", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        } */

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Oficios/setOficio'; 
        var formData = new FormData(formOficios);
        request.open("POST",ajaxUrl,true);
        request.send(formData);

        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                console.log(request);
                /*
                var objData = JSON.parse(request.responseText);
                
                if(objData.status)
                {
                    $('#modalFormUsuario').modal("hide");
                    formUsuario.reset();
                    swal("Usuarios", objData.msg, "success");
                    tableUsuarios.api().ajax.reload();
                }else{
                    swal("Error", objData.msg, "error");
                }*/
            }
            
        }

    }

}, false);


window.addEventListener('load', function() {
    fntPlantelOficios();
}, false);

function fntPlantelOficios(){

    var ajaxUrl = base_url+'/Oficios/getSelectPlantel';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();
    
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#oficioPlantelid').innerHTML = request.responseText;
            document.querySelector('#oficioPlantelid').value = 1;
            $('#oficioPlantelid').selectpicker('render');
        }
    }
}

$('#datetime').datepicker({
    format: "dd/mm/yyyy",
    language: "es",
    autoclose: true,
    todayBtn: true
});


document.querySelector('#oficioArchivo').addEventListener('change', () => {

    let archivoOficio = document.querySelector('#oficioArchivo').files[0];
    let archivoOficioURL = URL.createObjectURL(archivoOficio);

    document.querySelector('#vistaPrevia').setAttribute('src', archivoOficioURL);
    //console.log(archivoOficio);
})

function openModal(){
    document.querySelector('#oficioId').value="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Oficio";
    document.querySelector("#formOficios").reset();

    $('#modalFormOficios').modal('show');
}