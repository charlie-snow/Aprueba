<?php

	require_once("clases/clase.usuario.php");
	$claseusuario = new usuario;

	// if (!isset($_SESSION['usuario']['nombre'])) { $_SESSION['usuario']['nombre'] = $usuario['name']; }
	// if (!isset($_SESSION['id_fb_usuario'])) { $_SESSION['id_fb_usuario'] = $uid; }
	
	$claseusuario->id = $_SESSION['usuario_id'];

	/* if (!$claseusuario->existe()) {
		$claseusuario->nivel = 2; // usuario
		$claseusuario->insertar();
	} */
	
	$claseusuario->get_datos();
	$usuario['id'] = $claseusuario->id;
	$usuario['nombre'] = $claseusuario->nombre;
	$usuario['uid_facebook'] = $claseusuario->uid_facebook;
	$usuario['nivel'] = $claseusuario->nivel;
	$_SESSION['usuario'] = $usuario;
	$claseusuario->nueva_visita();
?>
