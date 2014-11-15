<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends MX_Controller{
	
 //This variable will be storing all information to pass to the view 
 public $data =array();
 public $to_account =1;
 //Validation rules
 public $rules = array(
                  array(
                     'field'   => 'from_account', 
                     'label'   => 'From account', 
                     'rules'   => 'numeric|required|xss_clean|is_natural_no_zero'
                  ),
                  array(
                     'field'   => 'to_account', 
                     'label'   => 'To account', 
                     'rules'   => 'numeric|required|xss_clean|is_natural_no_zero'
                  ),
                  array(
                     'field'   => 'amount',
                     'label'   => 'Amount',
                     'rules'   => 'trim|required|xss_clean'
                  ),
                  array(
                     'field'   => 'journal',
                     'label'   => 'Journal',
                     'rules'   => 'trim|required|xss_clean'
                  ),
                  array(
                     'field'   => 'comment',
                     'label'   => 'Comment',
                     'rules'   => 'trim|required|xss_clean'
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
               //set the flash data error message if there is one
               $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');

       

    }
        /*
         * Displays all of the memebers in a table
         */
        public function index($offset=0)
        {
             
               //set the flash data error message if there is one
               $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

              
               //load models
              $this->load->model('transactions_model','transactions');
             
              $config['base_url'] = site_url('/transactions/index');
              $config['total_rows'] = $this->transactions->count_all()/2;
              $config['per_page'] = 20;
              $config['uri_segment'] = 3;

              $this->pagination->initialize($config);
              $this->data['transactions']= $this->transactions->all(20,$offset);
              $this->data["links"] = $this->pagination->create_links();
               //Instatiate Epargne object
              $this->_render_page('transactions/index', $this->data);
               
        }


 /**
 * @Autor Kamaro Lambert
*  @method to record new transaction
*  @param   numeric $id : this is to determine the member id
*  @param   boolen $popup: this is to determine if we need popup to be displayed
 */
 
    public function save($id=NULL)
    {
     
    //Loading the validation library
     $this->load->library('form_validation');
    
      //Load models
      $this->load->model('transactions_model','transactions');
      $this->load->model('accounts/account_model','accounts');
      $this->load->model('journals/journal_model','journals');

      //Get all accounts 
      $this->data['accounts']   =$this->accounts->get_all();
      //get all journals
      $this->data['journals']   =$this->journals->get_all();
      
       //Get anything in the session
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
       
      if (empty($_POST) && $id===NULL)
       {
  
           $this->_render_page('transactions/form', $this->data);
       }
        
      elseif(!empty($_POST)){

         //User wants to save the members
         $this->form_validation->set_rules($this->rules);
       
          if ($this->form_validation->run() == TRUE){
            
           
            //check if the user is trying to credit and debit same account
            if(!$this->check_same($this->input->post('from_account'),$this->input->post('to_account')))     
             {
               //Setting the error in the flash
               $this->data['errors']='From Account and To account fields cannot be the same';

               $this->_render_page('transactions/form',$this->data);
               return false;
             }
             $user_id = $this->session->userdata('user_id');
            
             $random_string_len=5-strlen($user_id);
             
             //Generate transaction number
             $transaction_id='TRANS'.date('YmdHis'). $user_id.random_string('numeric',  $random_string_len);
           
            //Record Credited account
             $credited=$insert=$this->transactions->insert(array(
                                     'account_id'        => $this->input->post('to_account'),
                                     'journal_id'        => $this->input->post('journal'),
                                     'amount'            => $this->input->post('amount'),
                                     'comment'           => $this->input->post('comment'),
                                     'payment_method'    => $this->input->post('payment_method'),
                                     'reference_number'  => $this->input->post('reference_number'),
                                     'created_by'        => $user_id,
                                     'transaction_id'    => $transaction_id
                                 ));
         
            //If we credited the account then debit 
            if ($credited)
             //Record debited account
             $debited=$this->transactions->insert(array(
                                     'account_id'  => $this->input->post('from_account'),
                                     'journal_id'  => $this->input->post('journal'),
                                     'amount'      => $this->input->post('amount')*-1,
                                     'comment'     => $this->input->post('comment'),
                                     'payment_method'    => $this->input->post('payment_method'),
                                     'reference_number'  => $this->input->post('reference_number'),
                                     'created_by'  => $user_id,
                                     'transaction_id'=> $transaction_id
                                 ));

             $this->session->set_flashdata('message', "transaction Saved well!");
             //if the second transaction failed and change the message
             if(!$insert)
             {
                  //Delete previous transaction 
                  $this->transactions->delete($debited);

                  //change the error message
                  $this->session->set_flashdata('errors', "Could not complete transction, please check if everything is well set.");
             }
            
             redirect('transactions','refresh');
           
            }else{
             
             $this->data['errors'] =validation_errors();     
             
             $this->_render_page('transactions/form',$this->data);
            }
                   
     }
    
   }
  /**
  *@method to delete transaction.
  *@todo normally this method cannot be executed because transaction should be deleted.
  *@param integer $id
  *
  */
   public function _delete($id){

    if (empty($id)) {
      # code...
     show_404();
    }
    else
    {
      //Load models
      $this->load->model('transactions_model','transactions');

       if($this->transactions->delete($id)){
         $this->session->set_flashdata('message', "transaction deleted well!");
        
       }else{
         $this->session->set_flashdata('message', "Unable to delete this transaction!");
       }

        redirect("transactions", 'refresh');
    }
   
 }

  
 /**
 *@author Kamaro Lambert
 *@method   method to check if two fields are equal 
 *@return boolen
 */

  function check_same($second_field,$first_field)
  {
    if ($second_field == $first_field)
      {
        $this->form_validation->set_message('check_equal_less', 'You cannot do same transaction at the same account.');
        return false;       
      }
      else
      {
        return true;
      }
  }


   /**
   * @author Kamaro Lambert
   * @method to render the page to the main template of our application
   * @param string $view
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