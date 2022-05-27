<?php 
	
	define("BASE_URL", "http://localhost/sad");
	//define("BASE_URL", "http://localhost:8888/sel_demo");

	//Zona horaria
	date_default_timezone_set('America/Mexico_City');

	//Datos de conexión a Base de Datos
	const DB_HOST = "127.0.0.1";
	const DB_NAME = "sad";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";

	//Para envio de correo
	const ENVIRONMENT = 0; //Local: 0, Produccion: 1

	//Datos envio de correo
	const NOMBRE_REMITENTE = "SISTEMA EVALUACION EN LINEA";
	const EMAIL_REMITENTE = "no-reply@cecytem.edu.mx";

	const TITULO_EMISOR = "EMISIÓN DE OFICIO DIGITAL";
	const WEB_SISTEMA = "www.cecyte.edu.mx";

 ?>