<?php

Class Home extends CI_Controller{

    function __construct() {
        parent::__construct() ;
        $this->load->model( 'Posts_model' ) ;

        if ( ! $this->session -> userdata( 'language' ))
            $this->lang->load( 'main' ) ;
        else
            $this ->lang-> load( 'main' , $this-> session-> userdata( 'language' )) ;
    }
 function index() {
echo" Hello Code Igniter";
}

function load_view(){
    $this->load->view('welcome_message');
    }

    function dynamic_view(){
        $data['title']='Dynamic View';
        $data['body']= 'A view for Dynamic Contents!';
        $this->load->view('some_view',$data);
        }
        function list_users() {
            //first we need to load the pagination library
            $this->load->library( 'pagination' ) ;
            //second specify which segment of URI should be sent as offset
            $offset=$this->uri->segment( 3) ;
            //third specify the base URL
            $config[ 'base_url' ] = base_url(). 'index.php/home/list_users';
            //fourth specifying total rows so we can count it
            $config[ 'total_rows' ] =$this->Posts_model->count_posts() ;
            //fifth to specify how many posts in one page should be shown
            $config[ 'per_page' ] = 10;
            //six we need to know according to which segment of URI pagination proceeded
            $config[ 'uri_segment' ] = 3;
            //we need to initialize the settings
            $this->pagination->initialize($config) ;
            //call a function from the model to return posts
            $data[ 'user' ]=$this->Posts_model->get_user($config[ 'per_page' ] ,$offset) ;
            $data['contents']='show_user';
            $this->load->view( 'main_view' ,$data) ;
            }

        function get_posts() {
            // we need to set last visited as current URL to session
            $this -> session -> set_userdata( 'last_visited' , current_url()) ;
            //first we need to load the pagination library
            $this->load->library( 'pagination' ) ;
            //second specify which segment of URI should be sent as offset
            $offset=$this->uri->segment( 3) ;
            //third specify the base URL
            $config[ 'base_url' ] = base_url(). 'index.php/home/get_posts';
            //fourth specifying total rows so we can count it
            $config[ 'total_rows' ] =$this->Posts_model->count_posts() ;
            //fifth to specify how many posts in one page should be shown
            $config[ 'per_page' ] = 5;
            //six we need to know according to which segment of URI pagination proceeded
            $config[ 'uri_segment' ] = 3;
            // to enhance pagination we need for this settings
            $config[ ' cur_tag_open' ] = ' <span><b><i>';
            $config[ ' cur_tag_close' ] = ' </i></b></span>';
            $config[ ' full_tag_open' ] = ' <li>';
            $config[ ' full_tag_close' ] = ' </li>';
            //we need to initialize the settings
            $this->pagination->initialize($config) ;
            //call a function from the model to return posts
            $data[ 'posts' ]=$this->Posts_model->get_posts($config[ 'per_page' ] ,$offset) ;

            $data[ 'title' ]=lang('title_main') ;
            $data[ 'main_title' ]=lang('title_main') ;
            // $this->load->view( 'some_view' ,$data) ;

            // $data['contents']= 'something';
            $data['contents']='some_view';
            $this->load->view('main_view',$data) ;
            }

            function details($id) {
                $this->load->model( 'Posts_model' );
                $data[ 'post' ]=$this->Posts_model->get_post($id) ;
                $data[ 'contents' ]='show_d';
                $data[ 'main_title' ] = mb_convert_case(lang( 'title_main' ),MB_CASE_TITLE);

                // $this->load->view( 'show_d' ,$data) ;
                $this->load->view( 'main_view' ,$data) ;
                }

                function add_post() {
                    $data[ 'contents' ]='new_post';
                    $data[ 'main_title' ] = mb_convert_case(lang( 'title_main' ),MB_CASE_TITLE) ;
                    $this->load->view( 'main_view' ,$data) ;

                    }
                    
                    function add() {
                        $user = $this->session->userdata( 'user' ) ;
                        $user_id=2;
                        // if user is loged in than the user id is equal to the user id of the loged in
                        // use else the user 1 will be inserted to database
                        if ($this->session->userdata( 'login' )) {
                        $user_id=$user->user_id;
                        }else{
                        $user_id=1;
                        }
                        $data = array(
                        'title' =>$this->input->post('title' ) ,
                        'body' =>$this->input->post( 'body' ),
                        'user_id' => $user_id
                        ) ;
                        $this->Posts_model->add_post($data) ;
                        redirect( 'home/get_posts' ) ;
                        }


                        function delete( $id) {
                            $this->load->model( 'Posts_model' ) ;
                            $this->Posts_model->delete_post($id) ;
                             redirect( 'home/get_posts' ) ;
                            }


                            function update_post($id) {
                                // $this->load->model( 'Posts_model' ) ;
                                $data[ 'post' ]=$this->Posts_model->get_post($id) ;
                                $data[ 'contents' ]='update_post';
                                $data[ 'main_title' ] = mb_convert_case(lang( 'title_main' ),MB_CASE_TITLE) ;
                                // $this->load->view( 'update_post' ,$data) ;
                                $this->load->view( 'main_view' ,$data) ;
                                }

                                function update($id) {
                                    $this->load->model( 'Posts_model' ) ;
                                    $data = array(
                                    'title' =>$this->input->post( 'title' ) ,
                                    'body' =>$this->input->post( 'body' )
                                    ) ;
                                    $this->Posts_model->update_post($id,$data) ;
                                    redirect( 'Home/get_posts' ) ;
                                    }
                                function About(){
                                    $data[ 'contents' ]='About';
                                    $this->load->view( 'main_view' ,$data) ;
                                }
}