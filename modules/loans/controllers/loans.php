<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Loans extends MX_Controller{
	
 //This variable will be storing all information to pass to the view 
 public $data =array();

 //Validation rules
 public $rules = array(
                  array(
                     'field'   => 'member_id', 
                     'label'   => 'Member ID', 
                     'rules'   => 'number|required|xss_clean'
                  ),
                  array(
                     'field'   => 'interest_rate', 
                     'label'   => 'interest Rate', 
                     'rules'   => 'number|required|xss_clean'
                  ),
                    array(
                     'field'   => 'wished_amount', 
                     'label'   => 'Wished amount', 
                     'rules'   => 'number|xss_clean'
                  ),
                  array(
                     'field'   => 'approved_amount', 
                     'label'   => 'Approved amount', 
                     'rules'   => 'number|required|xss_clean'
                  ),
                  array(
                     'field'   => 'interest', 
                     'label'   => 'Interest', 
                     'rules'   => 'number|required|xss_clean'
                  ),
                   array(
                     'field'   => 'total_loan_interest', 
                     'label'   => 'Total Loan + Interest', 
                     'rules'   => 'number|required|xss_clean'
                  ),
                     array(
                     'field'   => 'installment', 
                     'label'   => 'installment', 
                     'rules'   => 'number|required|xss_clean'
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
        
        #loading the loan model
        $this->load->model('loans_model','Loans');
        $this->load->model('LoanPayments_model','loanpayments');
        //load members model
        $this->load->model('members/member_model','members');
        
        #Get the current user id
        $this->user_id = $this->session->userdata('user_id');
       
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
              
              $config['base_url'] = site_url('/Loans/index');
              $config['total_rows'] = $this->Loans->count_all();
              $config['uri_segment'] = 3;
              $config['per_page'] = 20;
              $config['uri_segment'] = 3;
              $config['num_links'] = 5;
              $config['use_page_numbers'] = TRUE;

              $this->pagination->initialize($config);

              $this->pagination->initialize($config);
              $offset=(($offset-1)*$config['per_page']>0)?($offset-1)*$config['per_page']:0;

              $field=null;
              $value=null;

              if($this->input->get('field') && $this->input->get('search')){
                 
                $field=$this->input->get('field') ;
                 $value=$this->input->get('search');

              }

              $this->data['loans']= $this->Loans->all(20,$offset,FALSE,$field,$value);


              $this->data["links"] = $this->pagination->create_links();

               //Instatiate Epargne object
              $this->_render_page('Loans/index', $this->data);
               
        }


 
 /**
 * @Autor Kamaro Lambert
*  @method to save new loan
*  @param   numeric $id : this is to determine the loan id
*  @param   boolen $popup: this is to determine if we need popup to be displayed
 */
 
    public function save($memberid=FALSE)
    {



      //trying to save loan without memberid , show error 404 - not found
      if(empty($_POST) && $memberid===FALSE){
       show_404();

        return ;
      }
    
      //trying to show the loan of the user
      if(empty($_POST) && $memberid!=FALSE)
      {

        //does the member exists?
        if(!$this->members->exists($memberid))
        {
         
          $this->session->set_flashdata('errors','<h4>The person you are trying to give loan does not exist!</h4>');
          redirect('loans','refresh');
        }

        $this->data['member']     = $this->members->get($memberid); //get lember details
        $this->data['contractid'] = $this->Loans->getMaxid()+1; //get the id of the next loan

        $this->_render_page('loans/form',$this->data);
        return ;
      }

    //did the user post some data with the member id
   if (!empty($_POST) && $memberid!=FALSE) {
    
    //Loading the validation library
     $this->load->library('form_validation');

        //User wants to save the loan let's validate it first
         $this->form_validation->set_rules($this->rules);

         if ($this->form_validation->run() == FALSE){
    
             $this->session->set_flashdata('errors',validation_errors());

             redirect($this->uri->uri_string());
            return;    
         }
    
    //get member details 
    $member = $this->members->get($memberid); 
  
    //Get Maximum allowed top up 
    $maxtopup=($this->config->item(str_replace(' ', '_', $member->level.'_topup'))*12)-(($this->config->item(str_replace(' ', '_', $member->level.'_topup'))*12)*0.18);

    //Get Oustanding amount
    $outstanding=($this->Loans->GetOustandingPayment($member->id,TRUE)<0)?0:$this->Loans->GetOustandingPayment($member->id,TRUE);
    
    $balance=$maxtopup-$outstanding;


    //validate if the approved amount is not above the wished amount
    if($this->input->post('approved_amount')<$this->input->post('wished_amount')){

      $this->session->set_flashdata('errors','<h4>You are not allowed to approve amount which is higher than wished amount.</h4>');

      redirect($this->uri->uri_string());
      return;
    }

      //check if the member is eligible for loan
       if(!$this->Loans->eligibleforloan($memberid,TRUE))
         {
           #this loan doesn't exist
          $this->session->set_flashdata('errors','<h4>The person you are trying to give loan is not eligeable for it!</h4>');
          redirect('members','refresh');
          return ;
         }
    
    //Check if we are giving the member amount that is not higher than top up
      if ($this->input->post('approved_amount')>$maxtopup) {
      
       $this->session->set_flashdata('errors','<h3>'.$member->first_name.' '.$member->last_name.' is not allowed to have more than '.intval($maxtopup).' RWF at this time, Please adjust approved amount.<h3>');

      redirect($this->uri->uri_string());
      return;
      }


    //you cannot approved amount higher than wished amount
    if($this->input->post('approved_amount')<$this->input->post('wished_amount')){
      $this->session->set_flashdata('errors','<h4>You are not allowed to approve amount which is higher than wished amount.</h4>');

      redirect($this->uri->uri_string());
      return;
    }

   
   //Does he/she have an active loan
   $secondLoan = FALSE;
   $approved_amount=$this->input->post('approved_amount');

   if ($this->loans->GetOustandingPayment($this->user_id,TRUE)) {
     //tell the system that this is the second loan    
     $secondLoan = TRUE;
     //Get outstanding
     $outstanding=$this->loans->GetOustandingPayment($this->user_id,TRUE);
     //add outstanding to the gotten loan
     $approved_amount +=  $outstanding;
   }
   //prepare the data for the new loan
   
   $insert_array=array(
                      'member_id'=>$this->input->post('member_id'),
                      'letter_date'=>$this->input->post('letter_date'),
                      'loan_contract_number'=>$this->input->post('loan_contract_number'),
                      'interest_rate'   =>$this->input->post('interest_rate'),
                      'wished_amount'   =>$this->input->post('wished_amount'),
                      'approved_amount' =>$approved_amount,
                      'interest'        =>str_replace(',','', $this->input->post('interest')),
                      'total_loan_interest'=>str_replace(',','', $this->input->post('total_loan_interest')),
                      'installment'=>$this->input->post('installment'),
                      'monthly_payment_fees'=>str_replace(',','', $this->input->post('monthly_payment_fees')),
                      'cheque_number'=>$this->input->post('cheque_number'),
                      'bank'=>$this->input->post('bank'),
                      'second' =>$secondLoan,
                      'description'=>$this->input->post('description'),
                      'created_by'=>$this->user_id
                    );

    //New loan to record
  
    $insert=$this->Loans->insert($insert_array);
    
   if ($loanId=$insert) {

     //Second created let's mark the previoius loan ID
     $previousLoanId = $this->loans->getPreviousLoanId($this->input->post('member_id'));
     
     //Mark previous loan as transfered
     $this->loans->setTransfered($previousLoanId,$this->input->post('member_id'));

     $this->session->set_flashdata('message', "Loan  well Given!");
     
    //Prepare data to show on the contract
     $this->data=array(
                      'member_id'=>$this->input->post('member_id'),
                      'first_name'=>$member->first_name,
                      'last_name'=>$member->last_name,
                      'letter_date'=>$this->input->post('letter_date'),
                      'loan_contract_number'=>$this->input->post('loan_contract_number'),
                      'interest_rate'   =>$this->input->post('interest_rate'),
                      'wished_amount'   =>$this->input->post('wished_amount'),
                      'approved_amount' =>$this->input->post('approved_amount'),
                      'interest'        =>$this->input->post('interest'),
                      'total_loan_interest'=>$this->input->post('total_loan_interest'),
                      'installment'=>$this->input->post('installment'),
                      'monthly_payment_fees'=>(int) $approved_amount/$this->input->post('installment'),
                      'cheque_number'=>$this->input->post('cheque_number'),
                      'recievable_amount'=>$this->input->post('cheque_number'),
                      'outstanding' => $outstanding,
                      'previousloanid' =>$previousLoanId,
                      'totalloan' =>$approved_amount,
                      'bank'=>$this->input->post('bank'),
                      'second' =>$secondLoan,
                      'description'=>$this->input->post('description'),
                      'created_by'=>$this->user_id
                    );

     $this->data['membership_number']=$this->members->get($this->input->post('member_id'))->membership_number;

     $contract=$this->load->view('reports/prints/contracts',$this->data,TRUE);

     //insert contract 
     $this->loans->setContract($loanId,$contract);

     echo $contract;
     return ;
   }

   $this->session->set_flashdata('errors','<h4> Unable to save loan. </h4>');
 
   redirect('loans','refresh');
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
      $this->load->model('Journal_model','Loans');

       if($this->Loans->delete($id)){
         $this->session->set_flashdata('message', "<h4>Journal deleted well!</h4>");
        
       }else{
         $this->session->set_flashdata('message', "<h4>Unable to delete this journal!</h4>");
       }

        redirect("Loans", 'refresh');
    }
   
 }

    public function payment($id=false)
    {

      #check if teh user has submitted information
      if($_POST){


        #get sum loan payments so far
        $loanpaymentssum=$this->loanpayments->GetLoanPaymentSum($this->input->post('loan_id'));

        #if the result is null then assign zero
        $loanpaymentssum=(($loanpaymentssum!=null)?$loanpaymentssum:0) + $this->input->post('paid_amount');
        $total_loan_interest=$this->input->post('total_loan_interest');
        #calculate the balance
        $balance = $total_loan_interest-$loanpaymentssum;

        $insert_array=array(
                    'member_id'   =>$this->input->post('member_id'),
                    'loan_id'     =>$this->input->post('loan_id'),
                    'date_paid'   =>$this->input->post('date_paid'),
                    'paid_amount' =>$this->input->post('paid_amount'), 
                    'description' =>$this->input->post('description'),
                    'type_of_payment' =>$this->input->post('type_of_payment'),
                    'balance'     =>$balance,
                    'created_by'  =>$this->user_id
                    );
      #check if we have saved the payment very well.
         if($this->loanpayments->insert($insert_array))
         {
            $this->session->set_flashdata('message', "installment paid well!");
         }
        else{
             $this->session->set_flashdata('errors','Unable to pay this installment.');
         }

         redirect('loans','refresh');
         return ;
      } 

      $this->data['id']=$id;
      $this->data['loan']= $this->Loans->all(1,0,$id)[0];
      $this->load->view('loans/paymentform',$this->data);
    }


   public function test()
   {
     $this->load->view('reports/prints/contracts');
   }
   /**
   * @author Kamaro Lambert
   * @method to render the page to the mail template of our application
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