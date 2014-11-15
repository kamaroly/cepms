<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends MX_Controller{
	
 //This variable will be storing all information to pass to the view 
 public $data =array();

 //Validation rules
 public $rules = array(
                  array(
                     'field'   => 'code', 
                     'label'   => 'Code', 
                     'rules'   => 'trim|min_length[9]|max_length[50]required|xss_clean'
                  ),
                  array(
                     'field'   => 'name',
                     'label'   => 'Name',
                     'rules'   => 'trim|required|min_length[4]|max_length[30]|xss_clean'
                  )
                  );

 function __construct()
    {
        parent::__construct();
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

       if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('users/login', 'refresh');
        }
      
        //set the flash data error message if there is one

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');
       

    }
        /*
         * Displays all of the memebers in a table
         */
        public function index($offset=0)
        {
             
             
               //load models
              $this->load->model('account_model','accounts');

              
             
              $config['base_url'] = site_url('/accounts/index');
              $config['total_rows'] =$this->accounts->count_all();
              $config['per_page'] = '20';
              $config['uri_segment'] = 3;
              
              $this->pagination->initialize($config);
              $this->data['accounts']= $this->accounts->limit(20,$offset)->get_all();
              $this->data["links"] = $this->pagination->create_links();
               //Instatiate Epargne object
              $this->_render_page('accounts/index', $this->data);
               
        }


 /**
 * @Autor Kamaro Lambert
*  @method to save new member
*  @param   numeric $id : this is to determine the member id
*  @param   boolen $popup: this is to determine if we need popup to be displayed
 */
 
    public function save($id=NULL)
    {
      
    //Loading the validation library
     $this->load->library('form_validation');
    
      //Load models
      $this->load->model('account_model','accounts');
             
    
     //Get anything in the session
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

     
     
    if (empty($_POST) && $id===NULL)
     {
       $this->_render_page('accounts/form', $this->data);
     }
    
    elseif(($id!=NULL && is_numeric($id)) || !empty($_POST)){
         //User wants to save the members
         $this->form_validation->set_rules($this->rules);
    
          if ($this->form_validation->run() == TRUE){
           
              

                //New Account?
                if($id==NULL)
                {
                 $insert=$this->accounts->insert(array(
                                     'code' => $this->input->post('code'),
                                     'name' => $this->input->post('name'),
                                 ));
                }
                else{
                  //not new update the existing one
                  $this->accounts->update($id, array(
                                     'code' => $this->input->post('code'),
                                     'name' => $this->input->post('name'),
                                 ));
                }
         
             $this->session->set_flashdata('message', "Account Saved well!");

             redirect('accounts','refresh');
           
            }else{
             
             $this->data['errors'] =validation_errors();     

            }
                   
            //assign to the data just in case we need to show it on the form
           $this->data['account']=$this->accounts->get($id);

          $this->_render_page('accounts/form',$this->data);
     }
    
   }

   public function delete($id){

    if (empty($id)) {
      # code...
     show_404();
    }
    else
    {
      //Load models
      $this->load->model('account_model','accounts');

       if($this->accounts->delete($id)){
         $this->session->set_flashdata('message', "Account deleted well!");
        
       }else{
         $this->session->set_flashdata('message', "Unable to delete this Account!");
       }

        redirect("accounts", 'refresh');
    }
   
 }

    public function pickdate($id=null)
    {
        $this->_render_page('members/datepicker');
   }
   /**
   * @Author Kamaro Lambert
   * @Method to render the page to the mail template of our application
   */
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