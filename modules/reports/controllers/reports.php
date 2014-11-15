<?php 

class Reports extends mx_controller{

   public $data;
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
        #loading the loan model
        $this->load->model('loans/loans_model','Loans');
        $this->load->model('loans/LoanPayments_model','loanpayments');
      
        //load members model
        $this->load->model('members/member_model','members');
        $this->load->model('members/contributions_model','contributions');
       
       //Load Accounts transactions model report
        $this->load->model('transactions/Transactions_model','AccountTransactions');
        $this->load->model('accounts/account_model','accounts');
        $this->load->model('journals/journal_model','journals');


     
        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');
          
        # Loading contribution model
        $this->load->model('contribution_model','contribution');  

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('users/login', 'refresh');
        }
    }

   

    #intrace function for this controller
	public function index()
	{
         
        #getting contribution data

		$this->_render_page('reports/dashboard', $this->data);
	}

    
public function paybackplan($memberid=false)
{

   if ($memberid==false && !$this->input->post('membersids')) {
       show_404();
   }
  
   if ($this->input->post('membersids')) {
       
       $memberid=$this->input->post('membersids');
       $this->data['member']=$this->members->get_like('membership_number',$memberid)[0];
       $memberid=$this->data['member']->id;
   }


   $loanid=$this->Loans->LatestLoanId($memberid);
  
   $this->data['paybackhistory'] = $this->Loans->get( $loanid);


   $this->data['body']=$this->load->view('reports/members/paybackhistory',$this->data,true);
  
   $this->load->view('reports/prints/tabular',$this->data);
  
}

//get the active loan history
 public function activeloanhistory($memberid=false)
 {

   if ($memberid==false && !$this->input->post('membersids')) {
       show_404();
   }

   if ($this->input->post('membersids')) {
       
       $memberid=$this->input->post('membersids');
       $memberid=$this->members->get_like('membership_number',$memberid)[0]->id;
   }


   $loanid=$this->Loans->LatestLoanId($memberid);
   $this->data['paymenthistory'] = $this->loanpayments->LoanPaymentHistory( $loanid);
   $this->data['member'] =$this->members->get($memberid);
   $this->data['body']=$this->load->view('reports/members/MemberPaymentinterest',$this->data,true);
  
   $this->load->view('reports/prints/tabular',$this->data);

   
 }

    #getting contribution for members

    public function contributions($id=false)
    {


        #if user didn't submit form then show error of page not found
        if((!$this->input->post('start_date') || !$this->input->post('end_date') )){
            show_404();
            return ;
        }

        #getting submited values
        $start_date = $this->input->post('start_date');
        $end_date   = $this->input->post('end_date');
      

    if ($this->input->post('membersids') && is_array($this->input->post('membersids'))) {
         # use has submited the ids of the members who needs to be checked up while reports
         $id=implode(',', $this->input->post('membersids'));
    }       
    elseif ($this->input->post('membersids')){
      $id =$this->input->post('membersids'); 
    }
        #getting contribution data
        $this->data['member_contributions']=$this->contribution->MemberContribution($start_date,$end_date,$id);

        #binding data to the view
        $this->data['body']=$this->load->view('reports/contributions/cep_social_contribution',$this->data,TRUE);

        $this->load->view('reports/prints/tabular',$this->data);
    }
   


   #Members loan reports
    public function membersloans($id=false)
    {
        #if user didn't submit form then show error of page not found
        if((!$this->input->post('start_date') || !$this->input->post('end_date') )){
            show_404();
            return ;
        }

        
        #getting submited values
        $start_date = $this->input->post('start_date').'-01';
        $end_date   = $this->input->post('end_date').'-01';
        

    if ($this->input->post('membersids') && is_array($this->input->post('membersids'))) {
            # use has submited the ids of the members who needs to be checked up while reports
         $id=implode(',', $this->input->post('membersids'));
    }
    elseif ($this->input->post('membersids') && is_string($this->input->post('membersids'))) {
       $id=$this->input->post('membersids');
    }

    
        #load models
        $this->load->model('LoansReports_model','memberloans');
        
        #getting the data
        $this->data['memberloans'] = $this->memberloans->GetMemberLoanPayments($start_date,$end_date,$id);

        $this->data['body']=$this->load->view('reports/loans/memberloans',$this->data,TRUE);

        $this->load->view('reports/prints/tabular',$this->data);
    }

    #Members loan reports
    public function membersgivenloans($id=false)
    {
        #if user didn't submit form then show error of page not found
        if((!$this->input->post('start_date') || !$this->input->post('end_date') )){
            show_404();
            return ;
        }

        
        #getting submited values
        $start_date = $this->input->post('start_date').'-01';
        $end_date   = $this->input->post('end_date').'-01';
        

    if ($this->input->post('membersids')) {
            # use has submited the ids of the members who needs to be checked up while reports
         $id=implode(',', $this->input->post('membersids'));
    }

        #load models
        $this->load->model('LoansReports_model','memberloans');
        
        #getting the data
        $this->data['memberloans'] = $this->memberloans->GetMemberLoanPayments($start_date,$end_date,$id);

        $this->data['body']=$this->load->view('reports/loans/LoanGiven',$this->data,TRUE);

        $this->load->view('reports/prints/tabular',$this->data);
    }


 public function loansPayedAmount($id=false)
    {
        #if user didn't submit form then show error of page not found
        if((!$this->input->post('start_date') || !$this->input->post('end_date') )){
            show_404();
            return ;
        }

        
        #getting submited values
        $start_date = $this->input->post('start_date').'-01';
        $end_date   = $this->input->post('end_date').'-01';
        

    if ($this->input->post('membersids')) {
            # use has submited the ids of the members who needs to be checked up while reports
         $id=implode(',', $this->input->post('membersids'));
    }

        #load models
        $this->load->model('LoansReports_model','PayedAmount');
        
        #getting the data
        $this->data['PayedAmount'] = $this->PayedAmount->GetMemberLoanPaymentsPaid($start_date,$end_date,$id);

        $this->data['body']=$this->load->view('reports/loans/LoansPayed',$this->data,TRUE);

        $this->load->view('reports/prints/tabular',$this->data);
    }


 #Members loan reports
    public function delayedloan($id=false)
    {
        #if user didn't submit form then show error of page not found
        if((!$this->input->post('start_date') || !$this->input->post('end_date') )){
            show_404();
            return ;
        }

        
        #getting submited values
        $start_date = $this->input->post('start_date').'-01';
        $end_date   = $this->input->post('end_date').'-01';
        

    if ($this->input->post('membersids')) {
            # use has submited the ids of the members who needs to be checked up while reports
         $id=implode(',', $this->input->post('membersids'));
    }

        #load models
        $this->load->model('LoansReports_model','memberloans');
        
        #getting the data
        $this->data['memberloans'] = $this->memberloans->GetMemberLoanPayments($start_date,$end_date,$id,TRUE);

        $this->data['body']=$this->load->view('reports/loans/LoanDelayed',$this->data,TRUE);

        $this->load->view('reports/prints/tabular',$this->data);
    }

//
 public function AccountActivies()
    {
             #if user didn't submit form then show error of page not found
        if(!$this->input->post('start_date') || !$this->input->post('end_date') ||  !$this->input->post('from_account')  ){
            show_404();
            return ;
        }

        $start_date =$this->input->post('start_date');
        $end_date   =$this->input->post('end_date');
        $accountid  =$this->input->post('from_account') ;

        $this->data['postings'] = $this->AccountTransactions->getAccountActivities($accountid,$start_date,$end_date);
        $this->data['start_date'] =date('Y-m-d H:m:i',strtotime($start_date)); //converting the string to the date time format

        $this->data['MaxTranefsactionId'] =$this->AccountTransactions->MaxTranefsactionId($accountid,$start_date);
        $this->data['openingbalance'] =$this->AccountTransactions->SumAccountBeforeDate($accountid,$start_date);

       $this->data['body']= $this->load->view('reports/transactions/livredebank',$this->data,TRUE);

       $this->load->view('reports/prints/tabular',$this->data);
    }

 //Not paid loans
 public function loansnotyetpaid($id=false)
    {
        #if user didn't submit form then show error of page not found
        if((!$this->input->post('start_date') || !$this->input->post('end_date') )){
            show_404();
            return ;
        }

        
        #getting submited values
        $start_date = $this->input->post('start_date').'-01';
        $end_date   = $this->input->post('end_date').'-01';
        

    if ($this->input->post('membersids')) {
            # use has submited the ids of the members who needs to be checked up while reports
         $id=implode(',', $this->input->post('membersids'));
    }

        #load models
        $this->load->model('Loansnotyetpaid_model','loansnotyetpaid');
        
        #getting the data
        $this->data['loansnotyetpaid'] = $this->loansnotyetpaid->GetMemberLoanPayments($start_date,$end_date,$id);

        $this->data['body']=$this->load->view('reports/loans/loansnotyetpaid',$this->data,TRUE);

        $this->load->view('reports/prints/tabular',$this->data);
    }


   public function activestatus($status="active")
   {   
       //Are we looking for one person details?
        if ($this->input->post()) {

          
            $this->data['member']= $this->members->get_by('membership_number', $this->input->post('membersids'));

            $this->data['body']=$this->load->view('reports/members/cardmember',$this->data,TRUE);

            $this->load->view('reports/prints/tabular',$this->data);

            return TRUE;
        }
        //check if we are looking for all members
        elseif ($status!='all') {
            $member=$this->members->get_like('status',$status);
        }else{
            $member=$this->members->get_all();
        }
        $this->data['members']=$member;

        $this->data['body']=$this->load->view('reports/members/memberstable',$this->data,TRUE);

        $this->load->view('reports/prints/tabular',$this->data);
   }




   public function returnedcontribution()
   {   
       //Are we looking for one person details?
        #if user didn't submit form then show error of page not found
       
          $this->load->model('returned_contribution_model','returned');
        
   
        #getting contribution data
        $this->data['returned']=$this->returned->MemberContributionReturned();

        #binding data to the view
        $this->data['body']=$this->load->view('reports/contributions/cep_returned_contribution',$this->data,TRUE);

        $this->load->view('reports/prints/tabular',$this->data);
   }


    #reports from member module
   public function membersreports($value='')
    {
        
        if ($this->input->post('button')=='Contributions') {
           $this->contributions();
        }
        elseif ($this->input->post('button')=='Loans') {
           
           $this->membersloans();
        }
        elseif ($this->input->post('button')=='refund') {
            //check if user has selected only one member
           if (count($this->input->post('membersids'))==1) {

            //get member id
             $memberid =$this->input->post('membersids')[0];
            
             redirect('members/leavecep/'.$memberid);

           }else{
            $this->session->set_flashdata('errors','<h4>Only one member can leave CEP at time, Please select one member who is leaving.</h4>');
            redirect('members');
           }
        }
        else{
            show_404();
        }
    }

    //account activities report
    public function AcccountActiviies(){

    

        $accountid=false;
        if ($this->input->post('from_account')!=0) {
            //user selected account to check 
           $accountid=$this->input->post('from_account');
        }

        //if user didn't submit form then show error of page not found
        if((!$this->input->post('start_date') || !$this->input->post('end_date') )){
            show_404();
            return ;
        }
        $start_date=$this->input->post('start_date');
        $end_date  =$this->input->post('end_date');

        $this->data['transactions']=$this->AccountTransactions->gettransactions($start_date,$end_date,$accountid);
        
         $this->data['body']=$this->load->view('reports/accounts/AccountActivities',$this->data,TRUE);

        $this->load->view('reports/prints/tabular',$this->data);

        }


        //account activities report
    public function AccountProduction(){

        #if user didn't submit form then show error of page not found
        if(!$this->input->post('start_date') || !$this->input->post('end_date') ||  !$this->input->post('from_account')  ){
            show_404();
            return ;
        }

        $start_date =$this->input->post('start_date');
        $end_date   =$this->input->post('end_date');
        $accountid  =$this->input->post('from_account') ;

        $this->data['postings'] = $this->AccountTransactions->getAccountActivities($accountid,$start_date,$end_date);
        $this->data['start_date'] =date('Y-m-d H:m:i',strtotime($start_date)); //converting the string to the date time format

        $this->data['MaxTranefsactionId'] =$this->AccountTransactions->MaxTranefsactionId($accountid,$start_date);
        $this->data['openingbalance'] =$this->AccountTransactions->SumAccountBeforeDate($accountid,$start_date);

       $this->data['body']= $this->load->view('reports/transactions/livredebankproduction',$this->data,TRUE);

       $this->load->view('reports/prints/tabular',$this->data);

        }

        //account activities report
    public function bilan(){

       
        #if user didn't submit form then show error of page not found
        /*if(!$this->input->post('start_date') || !$this->input->post('end_date') ||  !$this->input->post('from_account')  ){
            show_404();
            return ;
        }
*/
        $start_date =$this->input->post('start_date');
        $end_date   =$this->input->post('end_date');
        $this->data['body'] = "<h1>CEPMS BILAN BETWEEN  $start_date and $end_date </h1>";

        $allaccounts =$this->accounts->get_all();
        
        foreach ($allaccounts as $account ) {
        
        $accountid= $account->id;
        
        $this->data['start_date'] =$start_date;
        $this->data['end_date'] =$end_date;

        $this->data['account_name'] =$account->name;

        $this->data['postings'] = $this->AccountTransactions->getAccountActivities($accountid,$start_date,$end_date);
        $this->data['start_date'] =date('Y-m-d H:m:i',strtotime($start_date)); //converting the string to the date time format

        $this->data['MaxTranefsactionId'] =$this->AccountTransactions->MaxTranefsactionId($accountid,$start_date);
        $this->data['openingbalance'] =$this->AccountTransactions->SumAccountBeforeDate($accountid,$start_date);

       $this->data['body'] .= $this->load->view('reports/accounts/bilan',$this->data,TRUE);
       
        }
       $this->load->view('reports/prints/tabular',$this->data);

        }



        public function Gift(){

    

        $journalid=false;
        if ($this->input->post('from_account')!=0) {
            //user selected account to check 
           $journalid=$this->input->post('from_account');
     

        }

        //if user didn't submit form then show error of page not found
        if((!$this->input->post('start_date') || !$this->input->post('end_date') )){
            show_404();
            return;
        }
        $start_date=$this->input->post('start_date');
        $end_date  =$this->input->post('end_date');
        
        $this->data['transactions']=$this->AccountTransactions->gettransactionsbyjournal($start_date,$end_date,$journalid);
        
         $this->data['body']=$this->load->view('reports/accounts/Gift',$this->data,TRUE);


        $this->load->view('reports/prints/tabular',$this->data);

        }


   #contract page
   public function contracts($value='')
    {
        $this->load->view('reports/filters/member_contract');
    } 

#return date filter
public function datefilter($report_url='')
{

    #getting the next controller 
    $this->data['report_url']=$report_url;
    
    $this->load->view('reports/filters/date_filters',$this->data);
}


#return date filter
public function memberfilter($report_url='')
{

    #getting the next controller 
    $this->data['report_url']=$report_url;
    
    $this->load->view('reports/filters/member_filters',$this->data);
}

//account filter
public function accountfilter($report_url='')
{

    #getting the next controller 
    $this->data['report_url']=$report_url;
    
    //Get all accounts 
    $this->data['accounts']   =$this->accounts->get_all();

    $this->load->view('reports/filters/account_filter',$this->data);
}



public function accountfilter2($report_url='')
{

    #getting the next controller 
    $this->data['report_url']=$report_url;
  
       $this->data['accounts'] =$this->accounts->get_like('name','PRODUCTION'); 


    $this->load->view('reports/filters/account_filter2',$this->data);
}

public function accountfilter3($report_url='')
{

    #getting the next controller 
    $this->data['report_url']=$report_url;
  
       $this->data['accounts'] =$this->journals->get_like('type','DEPOSIT_GIFT'); 


    $this->load->view('reports/filters/account_filter3',$this->data);


}
public function memberfilterContract($report_url='')
{

    #getting the next controller 
    $this->data['report_url']=$report_url;
    
    $this->load->view('reports/filters/member_contract',$this->data);
}

	 /**
   * @author Kamaro Lambert
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
