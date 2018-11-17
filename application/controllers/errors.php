<?php
class Errors extends CI_Controller {
  public function notfound() {
    $this->load->view('head');
    $this->load->view('error/404');
    $this->load->view('footer');
  }
}
 ?>
