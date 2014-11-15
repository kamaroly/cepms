<?php 

class LoanPayments_model extends MY_Model{

     public $_table='loan_payments';
     public $loan_table='loans';
     public $primary_key = 'id';
	 
   public function __construct()
   {
      parent::__construct();
      //Load loan model
      $this->load->model('loans/loans_model','loans');
   }



   //method to get latest loan payment details
   public function LoanPaymentHistory($loanid)
   {
     
 $this->db->select('
 `interest_rate`,
 `installment`,
`approved_amount`,
`interest`,
`total_loan_interest`,
`installment`,
`monthly_payment_fees`,
`loan_id`,
`paid_amount`,
`date_paid`');
$this->db->from($this->loan_table);
$this->db->join($this->_table,$this->db->dbprefix($this->loan_table).'.id='.$this->db->dbprefix($this->_table).'.loan_id','LEFT');
$this->db->where($this->db->dbprefix($this->loan_table).'.id',$loanid);
$query = $this->db->get();

return $query->result();
   }


   //Get all journals in the db
   public function GetLoanPaymentSum($loanid)
  {
  $total_payment=$this->db->select_sum('paid_amount')
  	                 ->from($this->_table)
  	                 ->where('loan_id',$loanid)
  	                 ->get()
  	                 ->result()[0]->paid_amount;
                     
 #if total payment is null then return 0
  return ($total_payment!=null)?$total_payment:0;
  }  

  
  //get the las tpayment date
  public function LastPaymentDate($memberid,$loanid=null)
  {
                     $this->db->select_max('date_paid')
                              ->from($this->_table)
                              ->where('balance >',0)
                              ->where('member_id',$memberid);
                    if ($loanid!=null) {
                        $this->db->where('loan_id',$loanid);
                    }
    return    $total_payment=$this->db->get()
                                ->result()[0]
                                ->date_paid;
  }


  
}
