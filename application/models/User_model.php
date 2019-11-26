<?php
class User_model extends CI_Model{
/*
 * this function is for creating new User
 */
function add_user( $data) {
    $this->db->insert('user' ,$data) ;
    
}
// this function check the database for existing record of user name
function check_username($username) {
    $this->db->where('user_name',$username) ;
    $this->db->select('user_name') ;
    $query=$this->db->get('user') ;
    if ($query->num_rows() > 0) {
    return true;
    } else{
    return FALSE;
    }
    }

/*
 * this function is to compare user name from form comming with existing
values in th database
 */
function login( $username, $password) {
$array =array('user_name'=> $username,'password'=> $password) ;
$this->db->where($array) ;
$this->db->select('user_id') ;
$query=$this->db->get('user') ;
if ($query->num_rows() > 0) {
return $query->first_row()->user_id;
} else{
return 0;
}
}
/*
 * this function is to return all user data
 */
function get_userdata( $uid) {
$this->db->where( 'user_id' , $uid) ;
$query=$this->db->get('user') ;
if ($query->num_rows()>0) {
return $query->first_row() ;
} else
return false;
}
}