<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprovante extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('congressista_model','modelcongressista');
  }

}