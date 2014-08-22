<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
            'standard/login' => 
            array(
                array(
                    'field'   => 'user_name',
                    'label'   => 'Username',
                    'rules'   => 'xss_clean|required'
                  ),
                array(
                    'field'   => 'password',
                    'label'   => 'Password',
                    'rules'   => 'xss_clean|required'
                  )
            ),
            'standard/signup' => 
            array(
                array(
                    'field'   => 'user_name',
                    'label'   => 'Username',
                    'rules'   => 'xss_clean|valid_email|required'
                  ),
                array(
                    'field'   => 'password',
                    'label'   => 'Password',
                    'rules'   => 'xss_clean|required|matches[passconf]|min_length[6]'
                  ),
                array(
                    'field'   => 'passconf',
                    'label'   => 'Confirm Password',
                    'rules'   => 'xss_clean|required'
                )
            ),
            'standard/forgot_password' =>
            array(
                array(
                    'field' => 'user_name',
                    'label' => 'Username',
                    'rules' => 'xss_clean|valid_email|required'
                )
            ),
            'standard/verify' =>
            array(
                array(
                    'field' => 'user_name',
                    'label' => 'Email',
                    'rules' => 'xss_clean|valid_email|required'
                )
            ),
            'standard/change_password' =>
            array(
                array(
                    'field'   => 'password',
                    'label'   => 'Password',
                    'rules'   => 'xss_clean|required|matches[passconf]|min_length[6]'
                  ),
                array(
                    'field'   => 'passconf',
                    'label'   => 'Confirm Password',
                    'rules'   => 'xss_clean|required'
                )
            ),
            'admin/settings' =>
            array(
                array(
                    'field' => 'event_name',
                    'label' => 'Event Name',
                    'rules' => 'xss_clean|required'
                ),
                array(
                    'field' => 'event_desp',
                    'label' => 'Event Descripton',
                    'rules' => 'xss_clean|required'
                ),
                array(
                    'field' => 'min_part',
                    'label' => 'Minimum Participants',
                    'rules' => 'xss_clean|required|integer'
                ),
                array(
                    'field' => 'max_part',
                    'label' => 'Maximum Participants',
                    'rules' => 'xss_clean|required|integer'
                )
            ),
            'admin/populate_first_degree' =>
            array(
                array(
                    'field' => 'first_degree_number',
                    'label' => 'First Degree',
                    'rules' => 'xss_clean|required|is_number'
                )
            ),
            'admin/populate_higher_degree' =>
            array(
                array(
                    'field' => 'higher_degree_number',
                    'label' => 'Higher Degree',
                    'rules' => 'xss_clean|required|is_number'
                )
            ),
            'user/set_new_password' =>
            array(
                array(
                    'field'   => 'password',
                    'label'   => 'Password',
                    'rules'   => 'xss_clean|required|matches[passconf]|min_length[6]'
                  ),
                array(
                    'field'   => 'passconf',
                    'label'   => 'Confirm Password',
                    'rules'   => 'xss_clean|required'
                )
            ),
            'user/profile'  =>
            array(
                array(
                    'field'   => 'fullName',
                    'label'   => 'Full Name',
                    'rules'   => 'xss_clean'
                  ),
                array(
                    'field'   => 'date',
                    'label'   => 'Date',
                    'rules'   => 'xss_clean|is_natural|greater_than[0]|less_than[32]'
                  ),
                array(
                    'field'   => 'month',
                    'label'   => 'Month',
                    'rules'   => 'xss_clean'
                  ),
                array(
                    'field'   => 'year',
                    'label'   => 'Year',
                    'rules'   => 'xss_clean|is_natural|exact_length[4]'
                  ),
                array(
                    'field'   => 'contact',
                    'label'   => 'Contact',
                    'rules'   => 'xss_clean|is_natural'
                  )
            )
        );

/* End of file form_validation.php */
/* Location: /application/config/form_validation.php */ 