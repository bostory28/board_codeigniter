<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topic extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->model('topic_model');
  }
	public function index()
	{
    $this->_head();

    $this->load->view('main');
	  $this->load->view('footer');
	}

  public function get($id) {
    $this->_head();

    $this->load->helper(array('url', 'HTML', 'korean'));
    $topic = $this->topic_model->get($id);
    $this->load->view('get', array('topic'=>$topic));

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

  public function _head() {
    $this->load->view('head');
    $topics = $this->topic_model->gets();
    $this->load->view('topic_list', array('topics' => $topics));
  }
}
