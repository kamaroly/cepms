<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Journals extends MX_Controller{
	
 //This variable will be storing all information to pass to the view 
 public $data =array();

 //Validation rules
 public $rules = array(
                  array(
                     'field'   => 'type', 
                     'label'   => 'Type', 
                     'rules'   => 'trim|required|min_length[4]|max_length[30]|xss_clean'
                  ));

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
              $this->load->model('Journal_model','journals');
             
              $config['base_url'] = site_url('/journals/index');
              $config['total_rows'] = $this->journals->count_all();
              $config['per_page'] =  '20';
              $config['uri_segment'] = 3;

              $this->pagination->initialize($config);
              $this->data['journals']= $this->journals->limit(20,$offset)->get_all();
              $this->data["links"] = $this->pagination->create_links();
               //Instatiate Epargne object
              $this->_render_page('journals/index', $this->data);
               
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
      $this->load->model('Journal_model','journals');
             
    
     //Get anything in the session
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

     
     
    if (empty($_POST) && $id===NULL)
     {
       $this->_render_page('journals/form', $this->data);
     }
    
    elseif(($id!=NULL && is_numeric($id)) || !empty($_POST)){
         //User wants to save the members
         $this->form_validation->set_rules($this->rules);
    
          if ($this->form_validation->run() == TRUE){
           
              

                //New Journal?
                if($id==NULL)
                {
                 $insert=$this->journals->insert(array(
                                     'type' => $this->input->post('type'),
                                 ));
                }
                else{
                  //not new update the existing one
                  $this->journals->update($id, array('type' => $this->input->post('type')));
                }
         
             $this->session->set_flashdata('message', "Journal Saved well!");

             redirect('journals','refresh');
           
            }else{
      
                 
            }
                   
            //assign to the data just in case we need to show it on the form
           $this->data['journal']=$this->journals->get($id);

          $this->_render_page('journals/form',$this->data);
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
      $this->load->model('Journal_model','journals');

       if($this->journals->delete($id)){
         $this->session->set_flashdata('message', "Journal deleted well!");
        
       }else{
         $this->session->set_flashdata('message', "Unable to delete this journal!");
       }

        redirect("journals", 'refresh');
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