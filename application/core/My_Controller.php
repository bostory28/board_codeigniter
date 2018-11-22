<?php
class My_Controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    if (!$this->input->is_cli_request()) {
      $this->load->library('session');
    }
  }

  public function _footer() {
    $this->load->view('footer');
  }

  public function _head() {
    //var_dump($this->session->userdata());
    $this->load->config('myconfig');
    $this->load->view('head');
  }

  public function _sidebar() {
    $topics = $this->topic_model->gets();
    $this->load->view('topic_list', array('topics' => $topics));
  }
}
?>
