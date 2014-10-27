<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}

require_once('phpass-0.3/PasswordHash.php');
require_once"facebook-php-sdk-v4-4.0-dev/autoload.php";
define('PHPASS_HASH_STRENGTH', 8);
define('PHPASS_HASH_PORTABLE', false);

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookClientException;

class SimpleLoginSecure
{
    var $CI;
    var $user_table = 'user_master';
    var $user_details_table = 'user_details';
    var $helper;
    var $session;
    var $permissions;
    var $redirect_url;
    /**
     * Create a user account
     *
     * @access  public
     * @param   string
     * @param   string
     * @param   bool
     * @return  bool
     */
    function create($user_name = '', $user_pass = '', $auto_login = TRUE)
    {
        $this->CI =& get_instance();

        //Make sure account info was sent
        if($user_name == '' OR $user_pass == '') {
            return false;
        }

        //Check against user table
        $this->CI->db->where('user_email', $user_name);
        $query = $this->CI->db->get_where($this->user_table);

        if ($query->num_rows() > 0) //user_name already exists
            return false;

        //Hash user_pass using phpass
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        $user_pass_hashed = $hasher->HashPassword($user_pass);

        //Insert account into the database
        $data = array(
                    'user_email' => $user_name,
                    'user_password' => $user_pass_hashed
                );

        $this->CI->db->set($data);

        if(!$this->CI->db->insert($this->user_table)) //There was a problem!
            return false;

        if($auto_login)
            $this->login($user_name, $user_pass);

        return true;
    }

    function fblogin()
    {
        $this->CI =& get_instance();
        $this->permissions = $this->CI->config->item('permissions', 'simpleloginsecure');
        FacebookSession::setDefaultApplication($this->CI->config->item('app_id', 'simpleloginsecure'), $this->CI->config->item('app_secret', 'simpleloginsecure') );
        $this->redirect_url = $this->CI->config->item('redirect_url', 'simpleloginsecure');
        $this->helper = new FacebookRedirectLoginHelper($this->CI->config->item('redirect_url', 'simpleloginsecure'));

        // No session exists
        try {
            $this->session = $this->helper->getSessionFromRedirect();
        } catch( FacebookRequestException $ex ) {
            // When Facebook returns an error
            // die(" Error : " . $ex->getMessage())/;
        } catch( Exception $ex ) {
            // When validation fails or other local issues
            // die(" Error : " . $ex->getMessage());
        }

        if ($this->session)
        {
            $user_profile = (new FacebookRequest($this->session, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
            //$user_permissions = (new FacebookRequest($this->session, 'GET', '/me/permissions'))->execute()->getGraphObject(GraphUser::className())->asArray();
            /*$found_permission = false;
            foreach($user_permissions as $key => $val)
            {
                if($val->permission == 'publish_actions')
                {
                $found_permission = true;
                }
            }

            if($found_permission)
            {
                try
                {
                    $response = (new FacebookRequest($this->session, 'POST', '/me/feed', array('message' => 'testing')))->execute()->getGraphObject()->asArray();
                }
                catch(FacebookClientException $e)
                {
                    //echo $e->getMessage();
                }
            }
            */
            $user_details = $user_profile->asArray();
            if(!isset($user_details['email']))
            {
                return false;
            }

            $this->CI->db->where('user_email', $user_details['email']);
            $query = $this->CI->db->get_where($this->user_table);

            if ($query->num_rows() > 0)
            {//user_name already exists
                if($query->first_row()->login_type == 0)
                {
                    $data = array(
                        'user_fb_id' =>  $user_details['id'],
                        'login_type' => 2,
                        'user_last_login' => date('Y-m-d H:i:s')
                    );
                    $this->CI->db->where('user_email', $user_details['email']);
                    $this->CI->db->update($this->user_table, $data);

                    //Destroy old session
                    $this->CI->session->sess_destroy();
                    //Create a fresh, brand new session
                    $this->CI->session->sess_create();
                    // fetch user details
                    $this->CI->db->where('user_email', $user_details['email']);
                    $result = $this->CI->db->get_where($this->user_table);
                    $user_data = $result->row_array();
                    unset($user_data['user_password']);
                    $user_data['user'] = $user_data['user_email'];
                    $user_data['user_id'] = $user_data['iduser_master']; // for compatibility with Simplelogin
                    $user_data['logged_in'] = true;
                    //set session for logged in user
                    $this->CI->session->set_userdata($user_data);
                    return true;

                }
                else
                {
                    $this->CI->db->simple_query('UPDATE ' . $this->user_table  . ' SET user_last_login = NOW() WHERE user_email = ' . $user_details['email']);
                    $this->CI->session->sess_destroy();
                    //Create a fresh, brand new session
                    $this->CI->session->sess_create();
                    // fetch user details
                    $this->CI->db->where('user_email', $user_details['email']);
                    $result = $this->CI->db->get_where($this->user_table);
                    $user_data = $result->row_array();
                    unset($user_data['user_password']);
                    $user_data['user'] = $user_data['user_email'];
                    $user_data['user_id'] = $user_data['iduser_master']; // for compatibility with Simplelogin
                    $user_data['logged_in'] = true;
                    //set session for logged in user
                    $this->CI->session->set_userdata($user_data);
                    return true;
                }
            }
            else
            {
                $data = array(
                        'user_email' => $user_details['email'],
                        'user_fb_id' =>  $user_details['id'],
                        'login_type' => 1,
                        'user_last_login' => date('Y-m-d H:i:s')
                );
                $this->CI->db->set($data);
                if(!$this->CI->db->insert($this->user_table)) //There was a problem!
                    return false;
                $this->CI->session->sess_destroy();
                //Create a fresh, brand new session
                $this->CI->session->sess_create();
                // fetch user details
                $this->CI->db->where('user_email', $user_details['email']);
                $result = $this->CI->db->get_where($this->user_table);
                $user_data = $result->row_array();
                $data = array(
                        'user_master_iduser_details' => $user_data['iduser_master'],
                        'name' =>  $user_details['name']
                );
                $this->CI->db->set($data);
                if(!$this->CI->db->insert($this->user_details_table)) //There was a problem!
                    return false;
                unset($user_data['user_password']);
                $user_data['user'] = $user_data['user_email'];
                $user_data['user_id'] = $user_data['iduser_master']; // for compatibility with Simplelogin
                $user_data['logged_in'] = true;
                //set session for logged in user
                $this->CI->session->set_userdata($user_data);
                return true;
            }
        }
        return false;
    }


    function login_url() {
        return $this->helper->getLoginUrl($this->redirect_url,$this->permissions);
    }
    /**
     * Login and sets session variables
     *
     * @access  public
     * @param   string
     * @param   string
     * @return  bool
     */
    function login($user_name = '', $user_pass = '')
    {
        $this->CI =& get_instance();

        if($user_name == '' OR $user_pass == '')
            return false;


        //Check if already logged in
        if($this->CI->session->userdata('user_name') == $user_name)
            return true;


        //Check against user table
        $this->CI->db->where('user_email', $user_name);
        $query = $this->CI->db->get_where($this->user_table);


        if ($query->num_rows() > 0)
        {
            $user_data = $query->row_array();

            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);

            if(!$hasher->CheckPassword($user_pass, $user_data['user_password']))
                return false;

            //Destroy old session
            $this->CI->session->sess_destroy();

            //Create a fresh, brand new session
            $this->CI->session->sess_create();

            $this->CI->db->simple_query('UPDATE ' . $this->user_table  . ' SET user_last_login = NOW() WHERE iduser_master = ' . $user_data['iduser_master']);

            //Set session data
            unset($user_data['user_password']);
            $user_data['user'] = $user_data['user_email'];
            $user_data['user_id'] = $user_data['iduser_master']; // for compatibility with Simplelogin
            $user_data['logged_in'] = true;
            $this->CI->session->set_userdata($user_data);

            return true;
        }
        else
        {
            return false;
        }

    }

    /**
     * Logout user
     *
     * @access  public
     * @return  void
     */
    function logout() {
        $this->CI =& get_instance();

        $this->CI->session->sess_destroy();
    }

    /**
     * Delete user
     *
     * @access  public
     * @param       integer
     * @return  bool
     */
    function delete($user_id)
    {
        $this->CI =& get_instance();

        if(!is_numeric($user_id))
            return false;

        return $this->CI->db->delete($this->user_table, array('iduser_master' => $user_id));
    }

        /**
     * New password
     *
     * @access  public
     * @param       integer
     * @return  bool
     */
    function new_password($user_name = '', $user_pass = '')
    {
        $this->CI =& get_instance();

        //Hash user_pass using phpass
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        $user_pass_hashed = $hasher->HashPassword($user_pass);

                $data = array(
                    'user_password' => $user_pass_hashed,
                    'password_verification_key' => NULL
                    );
                $this->CI->db->where('user_email', $user_name);
                return $this->CI->db->update($this->user_table, $data);
    }

}
?>
