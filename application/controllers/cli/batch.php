<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch extends My_Controller {
  function __construct() {
    parent::__construct();
  }
  function process(){
        $this->load->model('batch_model');
        $queues = $this->batch_model->gets();
        foreach ($queues as $job) {
          switch ($job->job_name) {
            case 'notify_email_add_topic':
              $context = json_decode($job->context);
              $this->load->model('topic_model');
              $topic = $this->topic_model->get($context->topic_id);
              $this->load->model('user_model');
              $users = $this->user_model->gets();
              $this->load->library('email');
              $this->load->helper('url');
              $this->email->set_newline("\r\n");
              $this->email->initialize(array(
                'mailtype'=>'html',
                'smtp_host'=>'ssl://smtp.googlemail.com',
                'smtp_port'=>'465',
                'charset'=>'utf-8',
                'smtp_user'=>'',
                'smtp_pass'=>'',
                'wordwrap'=> true,
                'protocol'=>'smtp'
              ));
              foreach ($users as $user) {
                $this->email->from('');
                $this->email->to($user->email);
                $this->email->subject($topic->title);
                $this->email->message('<a href="'.site_url('/topic/'.$topic->id).'">'.$topic->title.'</a>');
                if(!$this->email->send()) {
                  show_error($this->email->print_debugger());
                } else {
                  echo "success of sending email to {$user->email}";
                }
              }
              $this->batch_model->delete(array('id'=>$job->id));
              break;
          }
        }
    }
}
