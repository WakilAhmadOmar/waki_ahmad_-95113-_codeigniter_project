<?php
class Posts_model extends CI_Model{


//change this function to return posts as offsets and limit
function get_posts( $limit = 5, $offset = 0){

    return $this->db->get( 'posts' ,$limit,$offset)->result() ;
}
function get_user( $limit = 5, $offset = 0){

    return $this->db->get( 'user' ,$limit,$offset)->result() ;
}

function get_post($x) {
    $post=$this->db->select()->from( 'posts' )->where('id' ,$x)->get() ;
    return $post->row() ;
    }

    function add_post( $data) {
        $this->db->insert('posts' ,$data) ;
        }

        function delete_post($x) {
            $this->db->where( 'id' ,$x) ;
            $this->db->delete( 'posts' ) ;
            }

            function update_post( $x,$data) {
                $this->db->where( 'id' ,$x) ;
               $this->db->update( 'posts' ,$data) ;
               }
               // create this function to count posts
        function count_posts()
        {
            return $this->db->count_all( 'posts' ) ;
        }

}