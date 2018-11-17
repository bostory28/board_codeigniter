<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topic extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->model('topic_model');
    log_message('debug', '***topic init');
  }
	public function index()
	{
    $this->_head();

    $this->load->view('main');
	  $this->load->view('footer');
	}

  public function get($id) {
    log_message('debug', '***execute get function');
    log_message('debug', '***loading head');
    $this->_head();

    $this->load->helper(array('url', 'HTML', 'korean'));
    $topic = $this->topic_model->get($id);
    if (empty($topic)) {
      log_message('error', 'There is no topic');
      show_error('There is no topic');
    }
    //log_message('info', var_export($topic, 1));
    log_message('debug', '***loading get view');
    $this->load->view('get', array('topic'=>$topic));

    log_message('debug', '***loading footer');
    $this->load->view('footer');
  }

  public function add() {
    $this->_head();

    $this->load->library('form_validation');
    $this->form_validation->set_rules('title', '제목', 'required');
    $this->form_validation->set_rules('description', '본문', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('add');
		}	else {
			$topic_id = $this->topic_model->add($this->input->post('title'), $this->input->post('description'));
      $this->load->helper('url');
      redirect('/topic/'.$topic_id);
		}

    $this->load->view('footer');
  }

  public function remove($topic_id) {
    $this->topic_model->remove($topic_id);
    $this->load->helper('url');
    redirect('/topic/');
  }

  public function _head() {
    $this->load->config('myconfig');
    $this->load->view('head');
    $topics = $this->topic_model->gets();
    $this->load->view('topic_list', array('topics' => $topics));
  }
}
