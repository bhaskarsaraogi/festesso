<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
 
  function __construct()
  { 
    parent::__construct();
    if ($this->session->userdata('is_admin') == TRUE && $this->session->userdata('logged_in') == TRUE) {
      $this->session->set_userdata(array('login_flag' => 1));
    }
    else
    {
      $this->session->set_userdata(array('login_flag' => 0));
    }
    $this->session->set_userdata(array('admin_controls' => TRUE));
    $this->load->model('admin_model', 'admin'); 
    $this->load->model('user_model', 'user');
    $this->load->model('event_model', 'event');
  }

  public function index()
  {
    $this->output->cache(3600);
    $data['page_title'] = 'Admin Controls';
    $this->load->view('admin/main', $data);           
  }
  
  public function login()
  {         
    if ($this->session->userdata('login_flag')) {
      redirect('admin/dashboard', 'location');
    }
    else {      
      $data['page_title'] = 'Admin Login';
      $data['error'] = NULL;
      
      $this->form_validation->set_error_delimiters('<div class="alert alert-error"><p>', '</p></div>');
      
      if ($this->form_validation->run('standard/login') == FALSE) //present and validate login form
      {
        $this->load->view('admin/login', $data);
      }
      else
      {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');
        
        $check_val = $this->simpleloginsecure->login($user_name, $password);

        $data['check_val'] = $check_val;
        
        if (!$check_val)
        {
          $data['error'] = 'Incorrect username or password. Please try again.';
          $this->load->view('admin/login', $data);
        }                        
        else
        {
          $user_role = $this->user->get_user_role($user_name);
          if ($user_role == 2 || $user_role == 3)
          {
            $this->session->set_userdata(array('logged_in' => TRUE, 'is_admin' => TRUE));
            redirect('admin/dashboard', 'location');
          }
          else
          {
            $this->session->set_userdata(array('logged_in' => FALSE, 'is_admin' => FALSE));
            $this->load->view('admin/login', $data);
          }
        }
      }
    }              
  }
  
  public function dashboard()
  {  
    if ($this->session->userdata('login_flag')) {
      $data['page_title'] = 'Dashboard';
      
      $this->load->view('admin/dashboard', $data);
    }
    else {
      redirect('404', 'location');
    }                
  }
  
  public function settings()
  { 
    if ($this->session->userdata('login_flag'))
    {
      $data['page_title'] = 'Settings';
      $data['error'] = null;
      
      $this->form_validation->set_error_delimiters('<div class="alert alert-error"><p>', '</p></div>');
      
      if ($this->form_validation->run('admin/settings') == FALSE) {
        $this->load->view('admin/settings', $data);
      }
      else {
        $arr_detals = array();
        $arr_detals['event_name'] = $this->input->post('event_name');
        $arr_detals['event_desp'] = $this->input->post('event_desp');
        $arr_detals['min_part'] = $this->input->post('min_part');
        $arr_detals['max_part'] = $this->input->post('max_part');
        
        $check_val = $this->event->check_event_exists($arr_detals['event_name']);

        if($check_val)
        {
         $data['error'] = "The event <strong>".$arr_detals['event_name']."</strong> is already registered with us.<br>".anchor('admin/edit_event', 'Click here')." to edit event.";
         $this->load->view('admin/settings', $data);
        }
        else {
          if ($this->event->add_event($arr_detals))
          {
          $data['page_title'] = "Event Added";
          $this->load->view('admin/event_added', $data);
          }
          // redirect('admin/settings', 'location');
          else
          {
          $this->load->view('admin/settings', $data); 
          }
        }                 
      }
    }
    else
    {
      redirect('404', 'location');
    }
  }
  
  public function edit_event($id='')
  {
    if ($this->session->userdata('login_flag'))
    {
      if ($id == '')
      {
        $data['page_title'] = "Edit Event";
        $search_results = $this->event->get_events();
        $data['search_results'] = $search_results;
        $this->load->view('admin/events', $data);
      }
      else
      {
        $check_val = $this->event->check_event_id_exists($id);
        if(!$check_val) 
        {
          redirect('admin/edit_event','location');
        }
        else
        {
          $data['page_title'] = "Edit event";
          $data['error'] = NULL;
          $event_details = $this->event->get_event_details($id);
          $data['event_id'] = $event_details->event_id;
          $data['event_name'] = $event_details->event_name;
          $data['event_desp'] = $event_details->event_desp;
          $data['min_part'] = $event_details->min_part;
          $data['max_part'] = $event_details->max_part;
          if ($this->form_validation->run('admin/settings') == FALSE)
          {
            $this->load->view('admin/edit_event', $data);
          }
          else
          {
            $arr_details = array();
            $arr_details['event_name'] = $this->input->post('event_name');
            $arr_details['event_desp'] = $this->input->post('event_desp');
            $arr_details['min_part'] = $this->input->post('min_part');
            $arr_details['max_part'] = $this->input->post('max_part');

            $check_val = $this->event->check_duplicate_event_exists($data['event_id'],$arr_details['event_name']);
            if ($check_val)
            {
              $data['error'] = "<strong>Error!</strong> An event with the same name already exists.";
              $this->load->view('admin/edit_event', $data);
            }
            else
            {
              $this->event->update_event_details($data['event_id'], $arr_details);
              $data['error'] = "<strong>Success!</strong> Event details have been modified.";
              $this->load->view('admin/edit_event', $data); 
            }
          }
      }
    }
  }       
    else
    {
      redirect('404', 'location');
    }
  }
  
  public function make_admin($user_name)
  {          
    if ($this->session->userdata('login_flag')) {
      $data['page_title'] = 'Make Admin';
      $id = $this->user->get_user_id($user_name);
      $this->admin->make_admin($id);
      $data['user_name'] = $user_name;
      $this->load->view('admin/make_admin', $data);
    }
    else
    {
      redirect('404', 'location');
    }          
  }
    
  
  public function logout()
  {
    if ($this->session->userdata('login_flag'))
    {
      $this->simpleloginsecure->logout();
      $data['page_title'] = 'Logged Out';
      $data['type'] = 'admin';
      $this->load->view('messages/logged-out', $data);
    }
    else
    {
      redirect('404', 'location');
    }  
  }
  
}