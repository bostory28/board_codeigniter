<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  function __construct() {
    parent::__construct();
  }
	public function login() {
    $this->load->config('myconfig');
    $this->load->view('head');
    $this->load->view('login');
    $this->load->view('footer');
  }

  public function authentication() {
    //var_dump($this->config->item('authentication'));
  }
}
