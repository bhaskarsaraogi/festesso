<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('user_model', 'user');
    $this->session->set_userdata(array('admin_controls' => FALSE));
    if ($this->session->userdata('logged_in'))
    {
      redirect('user', 'location');
    }
  }

  public function index()
  {
    $data['page_title'] = 'Home';
    $data['user_count'] = $this->user->count_users();
    $this->load->view('standard/main', $data);
  }

  public function register()
  {


      $data['page_title'] = 'Register';
      $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
      $data['error'] = NULL;
      if ($this->form_validation->run('standard/signup') == FALSE) //validate registration data
      {
        $this->load->view('standard/register', $data);
      }
      else
      {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');


      //check if user_name already registered.
        $check_val = $this->user->check_user_name_exists($user_name);

        if($check_val)
        {
         $data['error'] = "This username is already registered with us.";
         $this->output->cache(5);
         $this->load->view('standard/register', $data);
        }

       else // proceed with registration
       {
         $registration_val = $this->simpleloginsecure->create($user_name, $password, FALSE);
         if ($registration_val)
         {
           $this->user->generate_userdetails($user_name);
           $this->user->generate_verification_key($user_name);
           $this->user->send_verification_mail($user_name);


           $data['page_title'] = 'Registration Success';
           $this->load->view('messages/registration_success', $data);
         }
         else
         {
            $data['page_title'] = 'Registration Problem';
            $this->load->view('messages/registration_problem', $data);
         }
        }
      }
  }


  public function login()
  {

      $data['page_title'] = 'Login';
      $data['error'] = NULL;

      $this->form_validation->set_error_delimiters('<div class="alert alert-error"><p>', '</p></div>');

      if ($this->form_validation->run('standard/login') == FALSE)
      {
        $this->load->view('standard/login', $data);
      }
      else
      {
        $user_name = $this->input->post('user_name');
        $password = $this->input->post('password');

        $check_val = $this->simpleloginsecure->login($user_name, $password);
        $this->session->set_userdata(array('logged_in' => FALSE));
        $data['check_val'] = $check_val;

        if (!$check_val)
        {
          $data['error'] = 'Incorrect username or password. Please try again.';
          $this->session->set_userdata(array('logged_in' => FALSE));
          $this->load->view('standard/login', $data);
        }
        else
        {
          if ($this->session->userdata('account_verified')) {
            $this->session->set_userdata(array('logged_in' => TRUE));
            redirect('user', 'location');
          }
          else {
            $data['page_title'] = 'Acount not verified';
            $this->load->view('messages/account_not_verified', $data);
          }

        }
      }
  }

  public function resend_verification_mail()
  {

      $data['page_title'] = 'Resend Verification Mail';
      $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
      $data['error'] = NULL;

      if ($this->form_validation->run('standard/verify') == FALSE) //validate registration data
      {
        $this->load->view('standard/resend_verification_mail', $data);
      }
      else
      {
        $user_name = $this->input->post('user_name');

      //check if user_name already registered.
        $check_val = $this->user->check_user_name_exists($user_name);

        if(!$check_val)
        {
         $data['error'] = $user_name." is not registered with us, you can signup with it ".anchor('main/register', 'here');
         $this->output->cache(5);
         $this->load->view('standard/resend_verification_mail', $data);
        }

       else // proceed with registration
       {
         $account_verified = $this->user->check_account_verified($user_name);
         if ($account_verified)
         {

           $data['page_title'] = 'Account Verified';
           $data['error'] = $user_name." has already been verified. ".anchor('main/forgot_password', 'Click here')." to reset your password";

           $this->load->view('standard/resend_verification_mail', $data);
         }
         else
         {
            $this->user->send_verification_mail($user_name);
            $data['page_title'] = 'Verification mail';
            $this->load->view('messages/email_sent', $data);
         }
        }
      }
  }

 public function verify($user_name,$verification_key)
  {
    $email = urldecode($user_name);
    // $email = $this->encrypt->decode($e);
    $check_val = $this->user->verify_account($email,$verification_key);
    if ($check_val)
    {
      $data['page_title'] = 'Account Verified';
      $this->load->view('messages/account_verified', $data);
    }
    else
    {
      $data['page_title'] = 'Account Verification Problem';
      $this->load->view('messages/account_verification_problem', $data);
    }
  }


  public function forgot_password()
  {

      $data['page_title'] = 'Forgot Your Password';

      $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
      $data['error'] = NULL;
      if ($this->form_validation->run('standard/verify') == FALSE) //validate registration data
      {
        $this->load->view('standard/forgot_password', $data);
      }
      else
      {
        $user_name = $this->input->post('user_name');

      //check if user_name already registered.
        $check_val = $this->user->check_user_name_exists($user_name);

        if(!$check_val)
        {
         $data['error'] = $user_name." is not registered with us.";
         $this->load->view('standard/forgot_password', $data);
        }
        else // proceed with password reset
        {
         $this->user->send_new_password($user_name);
         $data['page_title'] = 'Password Reset mail';
         $this->load->view('messages/password_sent', $data);
        }
      }

  }


  public function password_reset($username,$password_verification_key)
  {
    $email = urldecode($username);

    $check_val = $this->user->verify_password_reset_request($email,$password_verification_key);

    if ($check_val) {
      $this->session->set_userdata(array('username' => $email));
      redirect('main/reset_password','location');

    }
    else
    {
      $data['page_title'] = 'Account Verification Problem';
      $this->load->view('messages/account_verification_problem', $data);
    }
  }

  public function reset_password()
  {
      $data['page_title'] = 'Enter new password';
      $username = $this->session->userdata('username');
      $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
      $data['error'] = NULL;
      if ($this->form_validation->run('standard/change_password') == FALSE) //validate registration data
      {
         $this->load->view('standard/password_reset', $data);
      }
      else
      {
         $password = $this->input->post('password');
         $this->simpleloginsecure->new_password($username, $password);
         $data['page_title'] = 'Password changed';
         $this->load->view('standard/password_changed', $data);
      }
  }


  public function changelog()
  {
    $this->output->cache(3600);
    $data['page_title'] = 'Changelog';
    $this->load->view('standard/changelog', $data);
  }


}