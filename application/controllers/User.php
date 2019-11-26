<?php
class User extends CI_Controller{
    function __construct() {
        parent::__construct() ;
        $this->load->model('User_model') ;
        // if a language is placed in the session use it else use main language in ourcontext it is english
    if ( !$this->session->userdata('language'))
        $this->lang->load('main' ) ;
    else
        $this->lang->load('main', $this->session->userdata('language')) ;
    }

    function index() {
        $this->load->view('includes/langbar' ) ;
        // set current url as last visited
        $this ->session->set_userdata('last_visited',current_url()) ;
        // go to language that is in session and load a variable called par_about.
         echo lang('par_about') ;
        }
/*
 * thisfunction used to loas a view called rigister located in Form
directory of views
 */
    function register() {
        // $this->load->view( 'Form/register') ;
        //take contents of a variable called title_main from language and assign it to
        //index of main_title of data array, than we can get it in our view
        $data[ 'main_title' ] = mb_convert_case(lang( 'title_main' ),MB_CASE_TITLE) ;
        $data[ 'contents' ]= 'Form/register';
        $this->load->view( 'main_view' ,$data) ;
    }
//--------------------------------------------------------------------------

/*
 * this function is to create new user and the form data is sent to this
function from register.php file
 * and send to user table of blog_data database
 */

    // this fnction is to check the existance of user name in the database.
function username_check( $username)
    {
    // call a User_model function for checking the user name
    $user=$this->User_model->check_username($username) ;
    // if user name existed in the database than show this message
    if ($user)
        {
        $this->form_validation->set_message( 'username_check' , 'The' .
        $username. 'Already Exist in Database' ) ;
        return FALSE;
        }
    else
    {
    return TRUE;
    }
}
 
    function register_user() {
        $this->load->helper('date') ;
        if($this->input->post('submit')){
        // load the form validation library 
         $this->load->library('form_validation') ;
        // set rules for desired inputes
        $config = array(
         array(
         'field'=>'name',
         'label'=>'First Name',
         'rules'=>'required'
         ),
         array(
         'field'=>'uname',
         'label'=>'User Name',
         'rules'=>'required|callback_username_check'
         ),
         array(
         'field'=>'password',
         'label'=>'Password',
         'rules'=>'required'
         ),
         array(
         'field'=>'email',
         'label'=>'Email',
         'rules'=>'required'
         )
         ) ;
        // initialize the rules
        $this->form_validation->set_rules($config) ;
        // if the form do not be as in the rule call register function
        if ($this->form_validation->run() == FALSE)
        {
         $this->register();
        }
        // if the rule is fulfilled run this part
        else
        {
         $f_dir=config_item('base_path'). 'staff_images';
        $config['upload_path']='./staff_images/'; //$f_dir;
        $config['allowed_types']=' gif|jpg|png|jpeg';
        $config['file_name']=time() ;
        $config['image_library']='gd2';
        $config['create_thumb']=false;
        $config['width']=20;
        $config['height']=30;
        $this->load->library('image_lib',$config) ;
        $this->image_lib->resize();
         $this->load->library('upload', $config) ;
         if (!$this->upload->do_upload())
         {
            $error = $this->upload->display_errors() ;
            $this->register($error) ;
         }
         else
         {
            $data = array(
            'name'=>$this->input->post('name'),
            'lname'=>$this->input->post('lname'),
            'user_name'=>$this->input->post('uname'),
            'password'=>$this->input->post('password'),
            'email' =>$this->input->post('email'),
            'image_path'=>$this->upload->data('file_name' ),
            
        ) ; 
         $this->User_model->add_user($data) ;
         redirect('home/get_posts') ;
          }
        }
         }else{echo "Not submited"; }
          }
/*
 * this function load a file called login from the Form Directory.
 */
    function user_login() {
        //take contents of a variable called title_main from language and assign it to
        //index of main_title of data array, than we can get it in our view
        $data['main_title'] = mb_convert_case(lang( 'title_main' ),MB_CASE_TITLE) ;
        // $this->load->view( 'Form/login' ) ;
        $data[ 'contents' ]= 'Form/login';
        $this->load->view( 'main_view' ,$data) ;
    }
//------------------------------------------------------------------------

/*
 * this function take login data and send to database and than retrive the
desired field and copmare
 * with these data
 */
    public function login() {
        $username = $this ->input->post('username' ) ;
        $password = $this ->input->post( 'password' ) ;
        if ($this ->input-> post( 'remember' ) == 'yes' ) {
// set a cookie with the username. It will expire in 269200.seconds(3 days)
            $cookie = array( 'name' => 'username' , 'value' =>$username,
            'expire' => 259200) ;
            $this->input->set_cookie($cookie) ;
        } else {
// delete the cookie
            $cookie = array( 'name'=> 'username' , 'value'=> NULL, 'expire'=> NULL) ;
            $this -> input -> set_cookie($cookie) ;
        }
        $uid=($this->User_model->login($username, $password)) ;

        if (!$uid){
        redirect(site_url( 'home/get_posts' )) ;
        
        }
// if login successful than send the all data related to the user to session array
    $this->session->set_userdata('uid', $uid) ;
    $this->session->set_userdata( 'user' , $this->User_model->get_userdata($uid)) ;
    $this->session->set_userdata( 'login' , true) ;
//print_r($this->session->all_userdata());
    redirect($this->session->userdata( 'last_visited' )) ;
    }

//--------------------------------------------------------------------------

// this function is called by log out button and delete the session array
    public function logout() {
        $this->load->view('logout');
    $this->session->unset_userdata( 'login' ) ;
    $this->session->unset_userdata( 'user' ) ;
    $this->session->unset_userdata( 'uid' ) ;
    redirect($this->session->userdata('last_visited' )) ;

    
    }

    //this function take a language as parameter and put it in the session
public function lang( $language) {
    // here we send it to session
    $this->session->set_userdata('language',$language) ;
    // redirect to last visited page.
    redirect($this->session->userdata('last_visited')) ;
    }
    // this function is for loading different views it take view as parameter and loadit in the main view
public function view( $page) {
    $this->session->set_userdata('last_visited' , current_url()) ;
    // try to translate the title, then capitalize it.
    $data[ 'title' ] = mb_convert_case(lang( 'title_' . $page),MB_CASE_TITLE) ;
    // translate and capitalize the main title that shows in the banner
    $data[ 'main_title' ] = mb_convert_case(lang( 'title_main' ),MB_CASE_TITLE) ;
    $data[ 'contents']='includes/' .$page;
    $this ->load->view( 'main_view', $data) ;
}
}