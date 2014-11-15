<?php
//Loads configuration from database into global CI config
function load_settings()
{
	#get CodeIgniter instance
	$CI =& get_instance();
    
    #Load models
    $CI->load->model('settings/settings_model','settings');
    $CI->load->model('users/user_model','user');
    
    #get user ID
    #Get the current user id
    $user_id = $CI->session->userdata('user_id');

	foreach($CI->settings->get_all()->result() as $setting)
	{
		$CI->config->set_item($setting->key,$setting->value);
	}
    
    #if the user has logged in

    if($user_id>0 && $user_id!=null){
      #user has looged in , let's get the user details 
      $user_details=$CI->user->get($user_id);
      
      #store the obtained information in the hook
      $CI->config->set_item('user_first_name',$user_details->first_name);
      $CI->config->set_item('user_last_name',$user_details->last_name);
      $CI->config->set_item('user_username',$user_details->username);
      $CI->config->set_item('user_email',$user_details->email);
    }	
	
	if ($CI->config->item('timezone'))
	{
		date_default_timezone_set($CI->config->item('timezone'));
	}
	else
	{
		date_default_timezone_set('Africa/Cairo');
	}
}
?>