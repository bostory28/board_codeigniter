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
    $authentication = $this->config->item('authentication');
    if ($this->input->post('username') == $authentication['username'] &&
        $this->input->post('password') == $authentication['password']) {
      $this->session->set_userdata('is_login', true);
      $this->load->helper('url');
      redirect("./topic/add");
    } else {
      $this->session->set_flashdata('message', 'failed login');
      $this->load->helper('url');
      redirect('/auth/login');
    }
  }

  public function logout() {
    $this->session->sess_destroy();
    $this->load->helper('url');
    redirect('/');
  }
}
