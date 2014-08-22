  <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('logged_in') == FALSE)
    {
        redirect('main/login', 'location');
    }
    $this->load->model('user_model', 'user');
    $this->load->model('event_model', 'event');
    $this->session->set_userdata(array('admin_controls' => FALSE));
  }

  public function index()
  {
    redirect('user/dashboard', 'location');
  }

  public function dashboard()
  {
      $data['page_title'] = 'Dashboard';
      $user_name = $this->session->userdata('user_name');
      $user_id = $this->user->get_userdetails_id($user_name);
      $user_details = $this->user->get_userdetails($user_name);
      $data['user_details'] = $user_details;
      $this->load->view('user/dashboard', $data);    
  }

  public function edit_profile()
  {
    $data['page_title'] = 'Edit Your Profile';
    $data['error'] = NULL;

    $this->form_validation->set_error_delimiters('<div class="alert alert-error"><p>', '</p></div>');

    $user_name = $this->session->userdata('user_name');
     
    $user_details = $this->user->get_userdetails($user_name);
    $data['fullName'] = $user_details->name;
    if ($user_details->dob != NULL)
     {
       $dob = explode(' ', $user_details->dob);
       if ($dob[0] != NULL)
       {
         $data['date'] = $dob[0];
       }
       if ($dob[1] != NULL)
       {
         $data['month'] = $dob[1];
       }
       if ($dob[2] != NULL)
       {
         $data['year'] = $dob[2];
       }
     }
    else
     {
       $data['date'] = 1;
       $data['month'] = 'January';
       $data['year'] = 1991;
     }

     $data['contact'] = $user_details->contact;

     if ($this->form_validation->run('user/profile') == FALSE)
     {
       $this->load->view('user/edit_profile', $data);
     }
     else
     {
       $fullName = $this->input->post('fullName');
       $contact = $this->input->post('contact');
       $dob = $this->input->post('date').' '.$this->input->post('month').' '.$this->input->post('year');
       if ($fullName)
         $arr_userdetails['name'] = $fullName;
       else
         $arr_userdetails['name'] = NULL;
        
       if ($dob)
         $arr_userdetails['dob'] = $dob;
       else
         $arr_userdetails['dob'] = NULL;
       if ($contact)
         $arr_userdetails['contact'] = $contact;
       else
         $arr_userdetails['contact'] = NULL;
        /*
         * Image Uploading
        */
       $upload_config['upload_path'] = './uploads/';
       $upload_config['allowed_types'] = 'gif|jpg|png';
       $upload_config['max_width'] = '1024';
       $upload_config['max_height'] = '768';
       $upload_config['file_name'] = $user_name;

       $this->load->library('upload', $upload_config);
       if (!$this->upload->do_upload('profile_image'))
       {
         $error = array('error' => $this->upload->display_errors());
       }
       else
       {
         $image_data = $this->upload->data();
         $arr_userdetails['image_name'] = $image_data['file_name'];
         $arr_userdetails['image_path'] = $image_data['file_path'];
          /*
           * Thumbnail Creation
           */
         $image_lib_config['image_library'] = 'gd2';
         $image_lib_config['create_thumb'] = TRUE;
         $image_lib_config['maintain_ratio'] = TRUE;
         $image_lib_config['width'] = 150;
         $image_lib_config['height'] = 150;
         $image_lib_config['source_image'] = $image_data['full_path'];
         $this->load->library('image_lib', $image_lib_config);
         $this->image_lib->resize();
         $arr_userdetails['image_thumb'] = $image_data['raw_name'].'_thumb'.$image_data['file_ext'];
       }

       $this->user->update_userdetails($user_name, $arr_userdetails);
       redirect('user', 'location');
     }
   }
    

  

  public function search() {
     $data['page_title'] = 'Search';
     $search_query = $this->input->post('query');
     $search_results = $this->user->search_users($search_query);
     $data['search_results'] = $search_results;
     $data['search_query'] = $search_query;
     $this->load->view('user/search', $data);
  }
    

  public function profile($query)
  {
     $user_name = $this->session->userdata('user_name');
     $user_id = $this->user->get_userdetails_id($user_name);
     if ($query == 'me' || $query == $user_name)
     {
       $id = $user_id;
     }
     else
     {
       $id = $query;
       $data['to_id'] = $id;
     }
     $user_details = $this->user->get_userdetails($id, 'id');
     if ($user_details)
     {
       $data['page_title'] = $user_details->name;
       $data['user_details'] = $user_details;
     }
     else
     {
       $data['page_title'] = 'User does not exist';
       $data['user_details'] = FALSE;
     }
     $this->load->view('user/profile', $data);
    
  }

  public function events($value='')
  {
    $data['page_title'] = "Events";
    $event_details = $this->event->get_events();
    $data['event_details'] = $event_details;

    $this->load->view('user/events', $data);
  }

 
  public function change_password()
  {
    
     if ($this->form_validation->run('user/set_new_password') == FALSE)
     {
       redirect('user/edit_profile', 'location');
     }
     else
     {
       $password = $this->input->post('password');
       $user_name = $this->session->userdata('user_name');
       $this->simpleloginsecure->new_password($user_name, $password);
       redirect('user/edit_profile', 'location');
     }
   
  }


  public function logout()
  {
    
     $this->simpleloginsecure->logout();
     $data['page_title'] = 'Logged Out';
     $data['type'] = 'main';
     $this->load->view('messages/logged-out', $data);
    
  }

}