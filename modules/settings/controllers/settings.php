<?php

class Settings extends  MX_Controller {

	public $data=array();

	function __construct()
	{
		parent::__construct('config');
		
		$this->load->library('authentication', NULL, 'ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');

        // Load MongoDB library instead of native db driver if required
        $this->config->item('use_mongodb', 'ion_auth') ?
        $this->load->library('mongo_db') :

        $this->load->database();

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->language('settings');

       if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('users/login', 'refresh');
        }
         //set the flash data error message if there is one
               $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
               //set the flash data error message if there is one
               $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');

       
	}

function index()
	{
		//set the flash data  message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        //set the flash data error if there is one
        $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');

		$this->_render_page('settings',$this->data);
	}



function save()
	{  
		//loading model
		$this->load->model('settings_model','settings');

		$batch_save_data=array(
		'language'=>$this->input->post('language'),
		'timezone'=>$this->input->post('timezone'),
        'A0_cep'  =>$this->input->post('A0_cep'),
        'A0_social'  =>$this->input->post('A0_social'),
        'A0_topup'  =>$this->input->post('A0_topup'),
        'A1_cep'  =>$this->input->post('A1_cep'),
        'A1_social'  =>$this->input->post('A1_social'),
        'A1_topup'  =>$this->input->post('A1_topup'),
        'A2_cep'  =>$this->input->post('A2_cep'),
        'A2_social'  =>$this->input->post('A2_social'),
        'A2_topup'  =>$this->input->post('A2_topup'),
        'A3_cep'  =>$this->input->post('A3_cep'),
        'A3_social'  =>$this->input->post('A3_social'),
        'A3_topup'  =>$this->input->post('A3_topup'),
        'Dr_Generaliste_cep'  =>$this->input->post('Dr_Generaliste_cep'),
        'Dr_Generaliste_social'  =>$this->input->post('Dr_Generaliste_social'),
        'Dr_Generaliste_topup'  =>$this->input->post('Dr_Generaliste_topup'),
        'Dr_Specialiste_cep'  =>$this->input->post('Dr_Specialiste_cep'),
        'Dr_Specialiste_social'  =>$this->input->post('Dr_Specialiste_social'),
        'Dr_Specialiste_topup'  =>$this->input->post('Dr_Specialiste_topup'),
        'MASTER_cep'  =>$this->input->post('MASTER_cep'),
        'MASTER_social'  =>$this->input->post('MASTER_social'),
        'MASTER_topup'  =>$this->input->post('MASTER_topup'),
        'SPECIALISTE_cep'  =>$this->input->post('SPECIALISTE_cep'),
        'SPECIALISTE_social'  =>$this->input->post('SPECIALISTE_social'),
        'SPECIALISTE_topup'  =>$this->input->post('SPECIALISTE_topup'),
        'interest_rate'    =>$this->input->post('interest_rate')
		
		);

		if( $this->settings->batch_save( $batch_save_data ) )
		{
			$this->session->set_flashdata('message',$this->lang->line('config_saved_successfully'));
		}
        else{
        	$this->session->set_flashdata('errors','Oops! error occured while saving settings');
        }
        redirect('settings');
	}
	/**
	 * @author Kamaro Lambert
	 * @name do_upload()
	 * @method to upload image
	 */
	function do_upload()
	{
		$config['upload_path'] = './images/company_logo/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['file_name']='sme_logo';
		$config['overwrite']=TRUE;
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$data = array('error' => $this->upload->display_errors());
	        
			
		}
		else
		{
			$data_uploaded = array('upload_data' => $this->upload->data());
			$config_data=array(
					'key'=>'company_logo',
					'value'=>$data_uploaded['upload_data']['file_name']
			);
			$data=array('success' => 'New log set successfully');
			$this->db->where('key', 'company_logo');
			$this->db->update('app_config',$config_data);
			
		}
		 $this->images($data);
		
	}


	/**
	 * @author Kamaro Lambert
	 * @name backup()
	 * @method to upload image
	 */
	function backup($confirm='yes')
	{
	  $this->load->dbutil();

       // Backup your entire database and assign it to a variable
       $backup =& $this->dbutil->backup();

       // Load the file helper and write the file to your server
       $this->load->helper('file');
       $mybackup='CEPMSBackup'.DATE('D.d.M.Y').'at'.date("G:i:s").'.sql';
       write_file($mybackup, $backup);

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('CEPMSBackup'.DATE('D.d.M.Y').'at'.date("G:i:s").'.kamaro', $backup); 
		$this->session->set_flashdata('message','<H4>Database Backed Up successfully!</H4>');
	    redirect('settings','refresh');
	 
	}
	
	
    function optimize()
    {
    	        
    	$this->load->dbutil();
    	 
    	$result = $this->dbutil->optimize_database();
    
    	if ($result)
    	{
    		
    
    		$this->session->set_flashdata('message','<H4>Database optimized successfully!</H4>');
    			
    	}
    	else
    	{
    		$this->session->set_flashdata('type','danger');
    		$this->session->set_flashdata('errors','<H4>Unable to optimize  database</H4>');
    		$this->currency();
    	}
    	redirect('settings','refresh');
    } 

    function _render_page($view, $data=null, $render=false)
    {
        // $this->viewdata = (empty($data)) ? $this->data: $data;

        // $view_html = $this->load->view($view, $this->viewdata, $render);

        // if (!$render) return $view_html;

        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

            if ( ! in_array($view, array('auth/index')))
            {
                $this->template->set_layout('pagelet');
            }

            if ( ! empty($data['title']))
            {
                $this->template->set_title($data['title']);
            }

            $this->template->load_view($view, $data);
        }
        else
        {
            return $this->load->view($view, $data, TRUE);
        }
    }
}
?>