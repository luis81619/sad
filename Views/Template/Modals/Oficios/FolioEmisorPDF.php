<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Activar Cuenta - SEL</title>
	<style type="text/css">
		p{
			font-family: arial;
			letter-spacing: 1px;
			color: #7f7f7f;
			font-size: 15px;
		}
		a{
			color: #3b74d7;
			font-family: arial;
			text-decoration: none;
			text-align: center;
			display: block;
			font-size: 18px;
		}
		.x_sgwrap p{
			font-size: 20px;
		    line-height: 32px;
		    color: #244180;
		    font-family: arial;
		    text-align: center;
		}
		.x_title_gray {
		    color: #0a4661;
		    padding: 5px 0;
		    font-size: 15px;
			border-top: 1px solid #CCC;
		}
		.x_title_blue {
		    padding: 08px 0;
		    line-height: 25px;
		    text-transform: uppercase;
			border-bottom: 1px solid #CCC;
		}
		.x_title_blue h1{
			color: #0a4661;
			font-size: 25px;
			font-family: 'arial';
		}
		.x_bluetext {
		    color: #244180 !important;
		}
		.x_title_gray a{
			text-align: center;
			padding: 10px;
			margin: auto;
			color: #0a4661;
		}
		.x_text_white a{
			color: #FFF;
		}
		.x_button_link {
		    width: 100%;
			max-width: 470px;
		    height: 40px;
		    display: block;
		    color: #FFF;
		    margin: 20px auto;
		    line-height: 40px;
		    text-transform: uppercase;
		    font-family: Arial Black,Arial Bold,Gadget,sans-serif;
		}
		.x_link_blue {
		    background-color: #307cf4;
		}
		.x_textwhite {
		    background-color: rgb(50, 67, 128);
		    color: #ffffff;
		    padding: 10px;
		    font-size: 15px;
		    line-height: 20px;
		}

		.x_text_left{
			height: 150px;
			float: left;
		}

		.x_text_right {
			height: 70px;     
		}
        
		.x_qr_right {
			height: 80px;
            float: right;     
		}

		.x_img_right {
			text-align: left;
		}

		.x_text_aling {
			text-align: right;
		}

        .x_text_div {
            width: 600px;
            height: auto;
            padding: 15px;
			position: relative;
  			left: 35px;	
            
        }

        .x_text_div_center {
            text-align: center;
        }
		
		.x_text_token{
			width: 375px;
			word-wrap: break-word;
			position: relative;
  			left: 170px;
		}

		.x_text_justify{
			text-align: justify;
		}
	</style>
</head>
<body>

<div class="x_text_div">

		<img src="http://localhost/sad/assets/images/michoacan.jpeg" class="x_text_left"> 
        <br><br><br><br>
        <p class="x_text_aling">Serie: <strong><?php echo $data['oficio_folio'];?></strong></p>
        <p class="x_text_aling">Fecha registro: <strong><?php echo $data['fechaCreate'];?></strong></p>
        <br><br><br>
        <p><strong><?php echo $data['oficio_dirigido'];?></strong></p>
        <p><strong>PRESENTE.</strong></p>
		<br><br>
        <p class="x_text_justify">CON ESTA FECHA SE HA REGISTRADO EL OFICIO EN EL SISTEMA SOD, CON NUMERO DE SERIE DEL SISTEMA <strong><?php echo $data['oficio_folio'];?></strong> Y CON LOS SIGUIENTES DATOS</p>
		<p>NUMERO DE FOLIO: <strong><?php echo $data['oficio_serie'];?></strong></p> 
		<p>ASUNTO: <strong><?php echo $data['oficio_asunto'];?></strong></p>
        <p>FECHA DE EMISION: <strong><?php echo $data['oficio_fecha_emision'];?></strong></p> 
		<p>DIRIGIDO AL PLANTEL: <strong><?php echo $data['plantel_recibe'];?></strong></p> 
		<br><br><br><br><br><br><br><br>   
        <div class="x_text_div_center">
        <p><strong>ATENTAMENTE</strong></p>		
        <p><strong><?php echo $data['plantel_emite'];?></strong></p>
        
        <p class="x_text_token"><strong><?php echo $data['oficio_token'];?></strong></p>
        
        <p><strong><?php echo $data['oficio_emite'];?></strong></p>
        </div>
        <br><br><br>
		<img src="https://upload.wikimedia.org/wikipedia/commons/d/d7/Commons_QR_code.png" class="x_qr_right">
        <br><br><br><br><br>
		<img src="http://localhost/sad/assets/images/cecytem.jpeg" class="x_text_right"> 
		 
    </div>

</body>
</html>


<?php
dep($data);
?>