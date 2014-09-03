<?php

class User_model extends CI_Model {

  function __construct()
  {
    parent::__construct();
  }

  function get_user_id($user_email)
  {
    $result = $this->db->get_where('user_master', array('user_email' => $user_email));
    $id = $result->first_row()->iduser_master;
    return $id;
  }

  function check_user_name_exists($user_name)
  {
    $result = $this->db->get_where('user_master', array('user_email' => $user_name));
    return ($result->num_rows())?TRUE:FALSE;
  }

  function get_user_role($user_name)
  {
    $id = $this->get_user_id($user_name);
    $result = $this->db->get_where('user_roles', array('user_master_iduser_roles' => $id));
    return $result->num_rows()?$result->first_row()->user_role:1;
  }

  function generate_userdetails($user_name, $data = array())
  {
    $id = $this->get_user_id($user_name);
    $data['user_master_iduser_details'] = $id;
    $this->db->insert('user_details', $data);
  }

  function get_userdetails($query, $via='name')
  {
    if ($via == 'name')
    {
      $id = $this->get_user_id($query);
      $result = $this->db->get_where('user_details', array('user_master_iduser_details' => $id));
    }
    else
    {
      $result = $this->db->get_where('user_details', array('iduser_details' => $query));
    }
    return $result->first_row();
  }

  function get_userdetails_id($user_name)
  {
    $id = $this->get_user_id($user_name);
    $result = $this->db->get_where('user_details', array('user_master_iduser_details' => $id));
    return $result->first_row()->iduser_details;
  }

  function update_userdetails($user_name, $data)
  {
    $id = $this->get_user_id($user_name);
    $this->db->where('user_master_iduser_details', $id);
    $this->db->update('user_details', $data);
  }

  function search_users($query)
  {
    $this->db->like('name', $query);
    $result = $this->db->get('user_details');
    return $result->result();
  }

  function check_account_verified($user_name)
  {

    $result = $this->db->get_where('user_master', array('user_email' => $user_name));
    if ($result->num_rows())
    {
      $account_verified = $result->first_row()->account_verified;
      if ($account_verified == 0)
      {
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }
    else
    {
      return FALSE;
    }
  }

  function verify_account($email, $verification_key)
  {
    $data = array(
      'account_verified'  => 1
    );

    $this->db->where('user_email', $email);
    $this->db->where('verification_key', $verification_key);
    $result = $this->db->update('user_master', $data);
    return $result;
  }

  function generate_verification_key($user_name)
  {
    $result = $this->db->get_where('user_master', array('user_email' => $user_name));
    $salt = $user_name.rand(1000,6000);
    $verification_key = md5($salt);
    $id = $result->first_row()->iduser_master;
    $this->db->where('iduser_master', $id);
    $data = array(
      'verification_key'          => $verification_key,
      'account_verified'          => 0
    );
    $result = $this->db->update('user_master', $data);
    return $verification_key;
  }

  function generate_password_verification_key($user_name)
  {
    $result = $this->db->get_where('user_master', array('user_email' => $user_name));
    $salt = $user_name.rand(100,600);
    $password_verification_key = md5($salt);
    $id = $result->first_row()->iduser_master;
    $this->db->where('iduser_master', $id);
    $data = array(
      'password_verification_key' => $password_verification_key,
    );
    $result = $this->db->update('user_master', $data);
    return $password_verification_key;
  }

  function get_verification_key($user_name)
  {
    $id = $this->get_user_id($user_name);
    $result = $this->db->get_where('user_master', array('iduser_master' => $id));
    return $result->first_row()->verification_key;
  }

  function get_password_verification_key($user_name)
  {
    $id = $this->get_user_id($user_name);
    $result = $this->db->get_where('user_master', array('iduser_master' => $id));
    return $result->first_row()->password_verification_key;
  }

  function send_verification_mail($user_name)
  {
    $verification_key = $this->get_verification_key($user_name);

    $toemail = $user_name;
    // $u = $this->encrypt->encode($user_name);
    $user = urlencode($user_name);

    $this->email->set_newline("\r\n");
    $this->email->from('f2012598@goa.bits-pilani.ac.in', 'f2012598');
    $this->email->to($toemail);

    $message = 'Click the following link to confirm your registration.<br/><a href="'.site_url().'/main/verify/'.$user.'/'.$verification_key.'">'.site_url().'/main/verify/'.$user.'/'.$verification_key.'</a>';

    $this->email->subject('Account Verification');
    $this->email->message($message);

    if($this->email->send()) {
        return;
      } else {
        show_error($this->email->print_debugger());
      }
  }

  function send_new_password($user_name)
  {

    $password_verification_key = $this->generate_password_verification_key($user_name);
    $user = urlencode($user_name);

    $this->email->set_newline("\r\n");
    $this->email->from('f2012598@goa.bits-pilani.ac.in', 'f2012598');
    $this->email->to($user_name);

    $message = 'Click the following link to reset your password.<br/><a href="'.site_url().'/main/password_reset/'.$user.'/'.$password_verification_key.'">'.site_url().'/main/password_reset/'.$user.'/'.$password_verification_key.'</a>';

    $this->email->subject('Password reset request');
    $this->email->message($message);

    if($this->email->send()) {
        return;
      } else {
        show_error($this->email->print_debugger());
      }

  }

  function verify_password_reset_request($username,$password_verification_key)
  {
    $result = $this->db->get_where('user_master', array('user_email' => $username));
    if ($result->num_rows())
    {
      if ($password_verification_key == $result->first_row()->password_verification_key) {
        return TRUE;
      }
    }
    return FALSE;
  }




  function count_users()
  {
    $result = $this->db->count_all('user_master');
    return $result;
  }

}