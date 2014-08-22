<?php

class Event_model extends CI_Model {

  function __construct()
  {
    parent::__construct();
  }

  function get_event_id($event_name)
  {
    $result = $this->db->get_where('event_master', array('event_name' => $event_name));
    $id = $result->first_row()->event_id;
    return $id;
  }

  function check_event_exists($event_name)
  {
    $result = $this->db->get_where('event_master', array('event_name' => $event_name));
    return ($result->num_rows())?TRUE:FALSE;
  }

  function check_duplicate_event_exists($event_id,$event_name)
  {
    $this->db->where('event_name',$event_name);
    $this->db->where('event_id !=',$event_id);
    $result = $this->db->get('event_master');
    return ($result->num_rows())?TRUE:FALSE;
  }

  function check_event_id_exists($event_id)
  {
    $result = $this->db->get_where('event_master', array('event_id' => $event_id));
    return ($result->num_rows())?TRUE:FALSE;
  }


  function add_event($data)
  {
    $result = $this->db->insert('event_master', $data);
    return $result; 
  }

  function get_events($query="")
  {
    $this->db->like('event_name', $query);
    $result = $this->db->get('event_master');
    return $result->result();
  }

  function get_event_details($query, $via='id')
  {
    if ($via == 'id')
    {
      
      $result = $this->db->get_where('event_master', array('event_id' => $query));
    }
    else
    { 
      $id = $this->get_event_id($query);
      $result = $this->db->get_where('event_master', array('event_id' => $id));
    }
    return $result->first_row();
  }

  function update_event_details($event_id, $data)
  {
    $this->db->where('event_id', $event_id);
    $this->db->update('event_master', $data);
  }

  function count_events()
  {
    $result = $this->db->count_all('event_master');
    return $result;
  }





  function generate_userdetails($user_name, $data = array())
  {
    $id = $this->get_user_id($user_name);
    $data['user_master_iduser_details'] = $id;
    $this->db->insert('user_details', $data);
  }

  

  function get_userdetails_id($user_name)
  {
    $id = $this->get_user_id($user_name);
    $result = $this->db->get_where('user_details', array('user_master_iduser_details' => $id));
    return $result->first_row()->iduser_details;
  }

  

}