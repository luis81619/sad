$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});

document.addEventListener('DOMContentLoaded', function(){
    if(document.querySelector("#formLogin")){

        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function(e){
            e.preventDefault();

            let strEmail = document.querySelector("#loginEmail").value;
            let strPassword = document.querySelector("#loginPassword").value;

            if(strEmail == "" || strPassword== "")
            {
                swal("Por favor", "Escribe usuario y contraseña", "error");
                return false;
            }else{
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				var ajaxUrl = base_url+'/Login/loginUser'; 
				var formData = new FormData(formLogin);
				request.open("POST",ajaxUrl,true);
				request.send(formData);

                request.onreadystatechange = function(){
                    if(request.readyState != 4) return;
                    if(request.status == 200){
                        var objData = JSON.parse(request.responseText);
                        if(objData.status)
                        {
                            window.location = base_url+'/dashboard';
                        }else{
                            swal("Atenciòn", objData.msg, "error");
                            document.querySelector('#loginPassword').value = "";
                        }
                    }else{
                        swal("Atenciòn", "Error en el proceso", "error")
                    }
                    return false;

                //console.log(request);
                }
            }
            


        }
    }

}, false);