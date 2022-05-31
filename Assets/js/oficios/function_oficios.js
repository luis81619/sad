let tableOficios;

document.addEventListener('DOMContentLoaded', function(){

    tableOficios = $('#tableOficios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Oficios/getOficios",
            "dataSrc":""
        },
        "columns":[
            {"data":"oficio_serie"},
            {"data":"oficio_folio"},
            {"data":"oficio_dirigido"},
            {"data":"oficio_asunto"},
            {"data":"plantelEmite"},
            {"data":"plantelRecibe"},
            {"data":"oficio_status"},
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

        
        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('is-invalid')) { 
                swal("Atención", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        }

        divLoading.style.display = "flex";
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Oficios/setOficio'; 
        var formData = new FormData(formOficios);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
                
                if(objData.status)
                {
                    $('#modalFormOficios').modal("hide");
                    formOficios.reset();
                    swal("Oficios", objData.msg, "success");
                    tableOficios.api().ajax.reload();
                }else{
                    swal("Error", objData.msg, "error");
                }
            }
            divLoading.style.display = "none";
            return false;
            
        }

    }

    var formAcuse = document.querySelector("#formAcuse");
    formAcuse.onsubmit = function(e){
        e.preventDefault();

        var intOficioAcuseId = document.querySelector('#oficioAcuseId').value;
        var strnAcuse = document.querySelector('#nAcuse').value;
        var strDateAcuse= document.querySelector('#datetimeAcuse').value;
        var strArchivoAcuse = document.querySelector('#acuseArchivo').value;

        if(strnAcuse == '' || strDateAcuse == '')
        {
            swal("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Oficios/setAcuse'; 
        var formDataAcuse = new FormData(formAcuse);
        request.open("POST",ajaxUrl,true);
        request.send(formDataAcuse);

        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
                
                if(objData.status)
                {
                    $('#modalFormAcuse').modal("hide");
                    formOficios.reset();
                    swal("Acuse", objData.msg, "success");
                    tableOficios.api().ajax.reload();
                }else{
                    swal("Error", objData.msg, "error");
                }
            }
            divLoading.style.display = "none";
            return false;
            
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

$('#datetimeAcuse').datepicker({
    format: "dd/mm/yyyy",
    language: "es",
    autoclose: true,
    todayBtn: true
});

function fntViewAcuse(archivoAcuse, acuseToken)
{
    let token = acuseToken;
    let rutaAcuse = archivoAcuse;

    $.ajax({
        type: 'GET',
        url: 'http://archivo.cecytem.net:8080/DriveService/service/drive/archivo/download?id='+rutaAcuse,
        dataType: 'json',
        success: function (data) {

        const binaryString = window.atob(data.content);
        const len = binaryString.length;
        const bytes = new Uint8Array(len);
        for (let i = 0; i < len; ++i) {
            bytes[i] = binaryString.charCodeAt(i);
        }
        var datosblob = new Blob([bytes], { type: 'application/pdf' });
        $('#documentoAcuse').attr('src',URL.createObjectURL(datosblob));
        
    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.log('error al ejecutar');
    }
});

var urlFolioAcuse = 'http://localhost/sad/folios/generarFolioAcuse/'+token;

$('#documentoFolioAcuse').attr('src', urlFolioAcuse);

$('#modalViewAcuses').modal('show');


}

function fntViewOficio(idOficio  ,idOficioArchivo) {
    let idArchivo = idOficioArchivo;
    //alert(idOficio);
	
    $.ajax({
        type: 'GET',
        url: 'http://archivo.cecytem.net:8080/DriveService/service/drive/archivo/download?id='+idArchivo,
        dataType: 'json',
        success: function (data) {

        const binaryString = window.atob(data.content);
        const len = binaryString.length;
        const bytes = new Uint8Array(len);
        for (let i = 0; i < len; ++i) {
            bytes[i] = binaryString.charCodeAt(i);
        }
        var datosblob = new Blob([bytes], { type: 'application/pdf' });
        $('#documentoOficio').attr('src',URL.createObjectURL(datosblob));
        
    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.log('error al ejecutar');
    }
});
    var urlFolioEmisor = 'http://localhost/sad/folios/generarFolioEmite/'+idOficio;

    $('#documentoFolioEmisor').attr('src', urlFolioEmisor);

    $('#modalViewOficio').modal('show');
}


document.querySelector('#oficioArchivo').addEventListener('change', () => {

    let archivoOficio = document.querySelector('#oficioArchivo').files[0];
    let archivoOficioURL = URL.createObjectURL(archivoOficio);

    document.querySelector('#vistaPrevia').setAttribute('src', archivoOficioURL);
    //console.log(archivoOficio);
})

document.querySelector('#acuseArchivo').addEventListener('change', () => {

    let archivoAcuse = document.querySelector('#acuseArchivo').files[0];
    let archivoAcuseURL = URL.createObjectURL(archivoAcuse);

    document.querySelector('#vistaPreviaAcuse').setAttribute('src', archivoAcuseURL);
    //console.log(archivoOficio);
})

function fntEditAcuse(element, idOficio) {
    rowTable = element.parentNode.parentNode.parentNode;
    var vidOficio = idOficio;
    $('#modalFormAcuse').modal('show');
    document.querySelector("#oficioAcuseId").value = vidOficio;

}

function openModal(){
    document.querySelector('#oficioId').value="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Oficio";
    document.querySelector("#formOficios").reset();

    $('#modalFormOficios').modal('show');
}