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
			height: 110px;
			float: left;	
		}

		.x_text_right {
			height: 55px;
			float: left;	
		}
		.x_text_aling {
			text-align: right;	
		}
	</style>
</head>
<body>
	<table align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="text-align:center;">
		<tbody>
			<tr>
				<td>
					<div class="x_sgwrap x_title_blue">
						<h1><?= TITULO_EMISOR ?></h1>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<img src="http://localhost/sad/assets/images/michoacan.jpeg" class="x_text_left">
					<br><br><br>
					<p class="x_text_aling">Fecha: <strong><?= $data['fecha_emision']; ?></strong></p>
					<div class="x_sgwrap">
						<p>Hola <?= $data['dirigido']; ?></p>
					</div>
					<p>Se ha enviado el acuse de recibido del oficio con los siguientes datos:</p>
					<p>Folio de acuse: <strong><?= $data['folio']; ?></strong></p>
					<p>Folio del oficio: <strong><?= $data['nOficio']; ?></strong></p>
					<p>Fecha de emision: <strong><?= $data['fechaOficio']; ?></strong></p>
					<p>Emite: <strong></strong><?= $data['nombreEmisor']; ?></p>
					<p>Dirigido a: <strong><?= $data['dirigido']; ?></strong></p>
                    <p>Dirigido al plantel: <strong><?= $data['plantelRecibe']; ?></strong></p>
					<br><br>
					<img src="http://localhost/sad/assets/images/cecytem.jpeg" class="x_text_right">
					<br><br><br>
					<p class="x_title_gray"><a href="<?= WEB_SISTEMA; ?>" target="_blanck"><?= WEB_SISTEMA; ?></a></p>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>