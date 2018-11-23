<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topic extends My_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('topic_model');
    log_message('debug', '***topic init');
  }
	public function index()
	{
    $this->_head();
    $this->_sidebar();

    $this->load->view('main');
	  $this->_footer();
	}

  public function get($id) {
    log_message('debug', '***execute get function');
    log_message('debug', '***loading head');
    $this->_head();
    $this->_sidebar();

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
    $this->_footer();
  }

  public function upload_receive_from_ck() {
    // 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
    $config['upload_path'] = './static/user';
    // git,jpg,png 파일만 업로드를 허용한다.
    $config['allowed_types'] = 'gif|jpg|png';
    // 허용되는 파일의 최대 사이즈
    $config['max_size'] = '100';
    // 이미지인 경우 허용되는 최대 폭
    $config['max_width']  = '1024';
    // 이미지인 경우 허용되는 최대 높이
    $config['max_height']  = '768';
    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('upload')) {
      echo '{
              "uploaded": 0,
              "error": {
                          "message": "'.$this->upload->display_errors('', '').'"
                       }
            }';
		} else {
      $data = $this->upload->data();
      $filename = $data['file_name'];
      $url = '/board_codeigniter/static/user/'.$filename;
      echo '{
              "uploaded": 1,
              "fileName": "'.$filename.'",
              "url": "'.$url.'"
            }';
		}
  }

  public function upload_receive() {
    // 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
    $config['upload_path'] = './static/user';
    // git,jpg,png 파일만 업로드를 허용한다.
    $config['allowed_types'] = 'gif|jpg|png';
    // 허용되는 파일의 최대 사이즈
    $config['max_size'] = '100';
    // 이미지인 경우 허용되는 최대 폭
    $config['max_width']  = '1024';
    // 이미지인 경우 허용되는 최대 높이
    $config['max_height']  = '768';
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('user_upload_file')) {
			echo $this->upload->display_errors();
		} else {
			$data = array('upload_data' => $this->upload->data());
      echo 'Success';
      var_dump($data);
		}
  }

  public function upload_form() {
    $this->_head();
    $this->_sidebar();
    $this->load->view('upload_form');
    $this->_footer();
  }

  public function add() {
    if (!$this->session->userdata('is_login')) {
      $this->load->helper('url');
      redirect('/auth/login?returnURL='.rawurlencode(site_url('/topic/add')));
    }

    $this->_head();
    $this->_sidebar();

    $this->load->library('form_validation');
    $this->form_validation->set_rules('title', '제목', 'required');
    $this->form_validation->set_rules('description', '본문', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('add');
		}	else {
			$topic_id = $this->topic_model->add($this->input->post('title'), $this->input->post('description'));

      //add topic in batch queue
      $this->load->model('batch_model');
      $this->batch_model->add(array('job_name'=>'notify_email_add_topic', 'context'=>json_encode(array('topic_id'=>$topic_id))));

      $this->cache->delete('topics');

      $this->load->helper('url');
      redirect('/topic/'.$topic_id);
		}

    $this->_footer();
  }

  public function remove($topic_id) {
    $this->topic_model->remove($topic_id);
    $this->cache->delete('topics');
    $this->load->helper('url');
    redirect('/topic/');
  }
}
