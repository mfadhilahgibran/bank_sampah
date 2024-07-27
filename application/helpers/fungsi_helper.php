<?php
function check_already_login(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('no_induk');
    if($user_session){
        redirect('C_Dashboard');
    }

}
function check_not_login(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('no_induk');
    if(!$user_session){
        redirect('Auth');
    }

}

?>