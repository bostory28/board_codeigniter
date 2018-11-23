<?php
class My_Controller extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->helper('url');
    if($peak = $this->config->item('peak_page_cache')){
        if($peak == current_url()){
            $this->output->cache(5);
        }
    }
    $this->load->driver('cache', array('adapter' => 'file'));
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
    if ( ! $topics = $this->cache->get('topics')) {
      $topics = $this->topic_model->gets();
     // Save into the cache for 5 minutes
     $this->cache->save('topics', $topics, 300);
   }
    $this->load->view('topic_list', array('topics' => $topics));
  }
}
?>
