<! DOCTYPE html>
<?php $this->load->view('includes/header') ?>
<body role="document" >
    <!-- END header.php -->
    <div class="container theme-showcase" role="main" >
    <div class="row" >
    <div class="col-md-12 text-center" style=" background:gray" >
    <h1> 
        <?php echo $this->lang->line('title_main')?>
    </h1></div>
    <div class="col-md-12" >
    <div class="col-md-11" >
    <ul class="nav nav-tabs" role="tablist"  >
    <li ><a href=" <?php echo base_url('index.php/Home/get_posts')?>">  <?php echo $this->lang->line('Home')?></a></li>
    <li><a href=" <?php echo base_url('index.php/home/about')?>"> <?php echo $this->lang->line('About')?></a></li>
    <li><a href="<?php echo base_url('index.php/Home/add_post')?>"> <?php echo $this->lang->line('new_post')?></a></li>
    <li><a href="<?php echo base_url('index.php/user/register')?>"><?php echo $this->lang->line('Register')?></a></li>
    <li><a href="<?php echo base_url('index.php/Home/list_users')?>"><?php echo $this->lang->line('See_all_user')?></a></li>
    <li>
        <?php 
        $user= $this->session->userdata( 'user' ) ;
       

        if ($this->session->userdata( 'login' )) {
        // echo "You loged in as " .$user->user_name. " <br/>" ;
        echo anchor( 'User/logout' , "<li>logout</li>"). "";
    }else{
        echo anchor( 'User/user_login',"<li>login</li>" ). "";
    }?>
    </li>
    <li><a> <?php echo $this->lang->line('languoge')?>
    <div class="change_longuage">
    <ul> 
     <?php
        echo ' <a>' .anchor( 'User/lang/english' , $this->lang->line('english') ). " </a> <br/>"; 
        echo ' <a>' .anchor( 'User/lang/dari' , $this->lang->line('Dari') ). " </a>";
       
 ?> </ul>
    
    </div>
    </li></a>
    
    </ul>
    </div>
 
 <div class="col-md-12" ><?php $this->load->view($contents) ?></div>
 <div class="col-md-12 text-center" style=" background:gray" >
<?php $this->load->view('includes/footer') ?></div>
</div>