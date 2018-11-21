<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends My_Controller {
  function __construct() {
    parent::__construct();
    $this->load->database();
  }
	public function login() {
    $this->load->config('myconfig');
    $this->load->view('head');
    $this->load->view('login');
    $this->_footer();
  }

  public function authentication() {
    //$authentication = $this->config->item('authentication');
    $this->load->model('user_model');
    $user = $this->user_model->getByEmail(array('email'=>$this->input->post('email')));
    if ($this->input->post('email') == $user->email &&
        password_verify($this->input->post('password'), $user->password)) {
      $this->session->set_userdata('is_login', true);
      $this->load->helper('url');
      redirect("./topic/");
    } else {
      $this->session->set_flashdata('message', 'failed login');
      $this->load->helper('url');
      redirect('/auth/login');
    }
  }

  public function logout() {
    $this->session->sess_destroy();
    $this->load->helper('url');
    redirect('/topic/');
  }

  public function register() {
    $this->_head();

    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'email address', 'required|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('nickname', 'nickname', 'required|min_length[5]|max_length[20]');
    $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[30]|matches[re_password]');
    $this->form_validation->set_rules('re_password', 'confirm password', 'required');
    if ($this->form_validation->run() === false) {
      $this->load->view('register');
    } else {
      $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
      $this->load->model('user_model');
      $this->user_model->add(array(
        'email'=>$this->input->post('email'),
        'password'=>$hash,
        'nickname'=>$this->input->post('nickname')
      ));

      $this->session->set_flashdata('message', 'Success register');
      $this->load->helper('url');
      redirect('/topic/');
    }

    $this->_footer();
  }
}
