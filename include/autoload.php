<?php
// autoload.php
spl_autoload_register(function ($class) {
	// Probar abrir controllers
	if ( file_exists( "./controllers/$class.controller.php")){
		require_once "./controllers/$class.controller.php";
		return;
	}
	
	// Probar abrir models
	if ( file_exists( "./models/$class.php")){
		require_once "./models/$class.php";
		return;
	}
	
	// Probar abrir utiles generales 
	if ( file_exists("./models/utils/$class.class.php")){
		require_once "./models/utils/$class.class.php";
		return;
	}
	
	// Probar abrir la clase del DSCore
	if ( file_exists( "./dscore/$class.class.php")){
		require_once "./dscore/$class.class.php";
		return;
	}
	
	// Probar abrir de views
	if ( file_exists( "./views/$class.views.php")){
		require_once  "./views/$class.views.php";
		return;
	}
});

// arrancar la sesion
session_start();
