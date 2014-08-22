<?php
if ($this->session->userdata('admin_controls'))
{
  if ($this->session->userdata('logged_in'))
  {
    $links = array(
      0 => site_url().'/admin/dashboard',
      1 => site_url().'/admin/settings',
      2 => site_url().'/admin/edit_event',
      3 => site_url().'/admin/logout'
      );
    $links_text = array(
      0 => 'Dashboard',
      1 => 'Settings',
      2 => 'Edit Event',
      3 => 'Logout'
      );
  }
  else
  {
    $links = array(
      0 => site_url().'/admin',
      1 => site_url().'/admin/login'
      );
    $links_text = array(
      0 => 'Home',
      1 => 'Login'
      );
  }
}
else
{
  if ($this->session->userdata('logged_in'))
  {
    $links = array(
      0 => site_url().'/user/dashboard',
      1 => site_url().'/user/edit_profile',
      2 => site_url().'/user/profile/me',
      3 => site_url().'/user/events',
      4 => site_url().'/user/logout'
      );
    $links_text = array(
      0 => 'Dashboard',
      1 => 'Settings',
      2 => 'Profile',
      3 => 'Events',
      4 => 'Logout'
      );
  }
  else
  {
    $links = array(
      0 => site_url().'/main',
      1 => site_url().'/main/register',
      2 => site_url().'/main/login'
      );

    $links_text = array(
      0 => 'Home',
      1 => 'Register',
      2 => 'Login'
      );
  }
}
?>