<?php defined('BASEPATH') OR exit('No direct script access allowed');

function getMensagem($session){
	if($session->sucesso){
		echo '<div class="alert bg-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Sucesso!</strong> '.$session->sucesso.'</div>';
	}
	if($session->erro){
		echo '<div class="alert bg-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Ops...</strong> '.$session->erro.'</div>';
	}
}

