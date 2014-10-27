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
      $user_name = $this->session->userdata('user');
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

    $user_name = $this->session->userdata('user');

    $user_details = $this->user->get_userdetails($user_name);
    $data['fullName'] = $user_details->name;
    if ($user_details->dob != NULL)
     {
       $dob = explode(' ', $user_details->dob);
         $data['date'] = $dob[0];
         $data['month'] = $dob[1];
         $data['year'] = $dob[2];
     }
    else
     {
       $data['date'] = 1;
       $data['month'] = 'January';
       $data['year'] = 1991;
     }

     $data['contact'] = $user_details->contact;
     $data['college_name'] = $user_details->college_name;

     if ($this->form_validation->run('user/profile') == FALSE)
     {
       $this->load->view('user/edit_profile', $data);
     }
     else
     {
       $fullName = $this->input->post('fullName');
       $contact = $this->input->post('contact');
       $college_name = $this->input->post('college_name');
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
       if ($college_name)
         $arr_userdetails['college_name'] = $college_name;
       else
         $arr_userdetails['college_name'] = NULL;
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
     $user_name = $this->session->userdata('user');
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

  public function events($value='',$event_name='')
  {
    if ($value == 'register' && $event_name != '') {
      $event_details = $this->event->get_event_details($event_name, 'name');
      if ($event_details) {
        $data['page_title'] = "Register";
        $data['event_details'] = $event_details;
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
        $data['error'] = NULL;
        if ($this->form_validation->run('user/events_register'.$event_details->min_part) == FALSE)
        {
          $this->load->view('user/events_register', $data);
        }
        else {
          $college_name = $this->input->post('college_name');
          $team_name = $this->input->post('team_name');
          $user_name = array();
          $contact = array();
          $email = array();

          for ($i=0; $i < $event_details->max_part; $i++) {
            $user_name[$i] = $this->input->post('fullName'.$i);
            $contact[$i] = $this->input->post('contact'.$i);
            $email[$i] = $this->input->post('email'.$i);
          }


          if (!$this->unique_email(array_slice($email,0,$event_details->min_part)))
          {
            $data['error'] = 'Please enter unique email ids for each participant';
            $this->load->view('user/events_register', $data);
          }
          else {
            $flag = 0;
            for ($i=0; $i < $event_details->min_part; $i++)
            {
              if($this->event->check_if_registered($email[$i],$event_details->event_id))
              {
                $flag = 1;
                break;
              }
            }
            if($flag)
            {
              $data['error'] = $user_name[$i].' is already registered for this event';
              $this->load->view('user/events_register', $data);
            }
            else {
              $reg_event['reg_event_id'] = $event_details->event_id;
              $reg_event['reg_user_id'] = $this->session->userdata('user_id');
              $reg_event['college_name'] = $college_name;
              $reg_event['team_name'] = $team_name;
              $this->event->register_event($reg_event);

              $reg_id = $this->event->get_reg_id($reg_event);
              $flag = $event_details->max_part;
              for ($i=$event_details->min_part; $i < $event_details->max_part; $i++)
              {
                if($user_name[$i] == '')
                {
                  $flag = $i;
                  break;
                }
              }

              $info_reg = array();
              for ($i=0; $i < $flag; $i++)
              {
                array_push($info_reg, array('info_event_id' => $event_details->event_id,
                                            'info_reg_id'   => $reg_id,
                                            'info_username' => $user_name[$i],
                                            'info_email'    => $email[$i],
                                            'info_contact'  => $contact[$i]
                                            ));
              }
            $this->event->register_info($info_reg);
            $data['event_name'] = $event_details->event_name;
            $this->load->view('user/registered', $data);
          }
        }

      }


      } else {
        $this->load->view('user/event_not_exist', $data);
      }

    }else {
      $data['page_title'] = "Events";
      $events = $this->event->get_events();
      $data['events'] = $events;
      $this->load->view('user/events', $data);
    }

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
       $user_name = $this->session->userdata('user');
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

  private function unique_email($arr)
  {
    $a = array_unique($arr);
    if(count($a)<count($arr)) {
      return FALSE;
    }
    return TRUE;
  }

}