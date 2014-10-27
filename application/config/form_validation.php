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
            ),
            'user/events_register0'  => create_validator(0),
            'user/events_register1'  => create_validator(1),
            'user/events_register2'  => create_validator(2),
            'user/events_register3'  => create_validator(3),
            'user/events_register4'  => create_validator(4),
            'user/events_register5'  => create_validator(5),
            'user/events_register6'  => create_validator(6),
            'user/events_register7'  => create_validator(7),
            'user/events_register8'  => create_validator(8)
    );

function create_validator($min_part)
{
    $a = array();
    array_push($a, array('field' => 'college_name', 'label' => 'College Name','rules'   => 'xss_clean|required'));
    array_push($a, array('field' => 'team_name', 'label' => 'Team Name','rules'   => 'xss_clean'));
    for ($i=0; $i < $min_part; $i++) { 
        array_push($a, array('field'   => 'fullName'.$i,
                             'label'   => 'Full Name of participant '.($i+1),
                             'rules'   => 'xss_clean|required'
                  ));
        array_push($a, array('field'   => 'email'.$i,
                             'label'   => 'Email of participant '.($i+1),
                             'rules'   => 'xss_clean|required|valid_email'
                  ));
        array_push($a, array('field'   => 'contact'.$i,
                             'label'   => 'Contact Number of participant '.($i+1),
                             'rules'   => 'xss_clean|required|is_natural'
                  ));
        array_push($a, array('field'   => 'date'.$i,
                             'label'   => 'Date',
                             'rules'   => 'xss_clean|is_natural|greater_than[0]|less_than[32]'
                  ));
        array_push($a, array('field'   => 'month'.$i,
                             'label'   => 'Month',
                             'rules'   => 'xss_clean'
                  ));
        array_push($a, array('field'   => 'year'.$i,
                             'label'   => 'Year',
                             'rules'   => 'xss_clean|is_natural|exact_length[4]'
                  ));
    }
    for ($i=$min_part; $i < 20; $i++) { 
        array_push($a, array('field'   => 'fullName'.$i,
                             'label'   => 'Full Name of participant '.($i+1),
                             'rules'   => 'xss_clean'
                  ));
        array_push($a, array('field'   => 'email'.$i,
                             'label'   => 'Email of participant '.($i+1),
                             'rules'   => 'xss_clean|valid_email'
                  ));
        array_push($a, array('field'   => 'contact'.$i,
                             'label'   => 'Contact Number of participant '.($i+1),
                             'rules'   => 'xss_clean|is_natural'
                  ));
        array_push($a, array('field'   => 'date'.$i,
                             'label'   => 'Date',
                             'rules'   => 'xss_clean|is_natural|greater_than[0]|less_than[32]'
                  ));
        array_push($a, array('field'   => 'month'.$i,
                             'label'   => 'Month',
                             'rules'   => 'xss_clean'
                  ));
        array_push($a, array('field'   => 'year'.$i,
                             'label'   => 'Year',
                             'rules'   => 'xss_clean|is_natural|exact_length[4]'
                  ));
    }
    return $a;
}
/* End of file form_validation.php */
/* Location: /application/config/form_validation.php */ 