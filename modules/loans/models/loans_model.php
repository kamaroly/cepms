<?php 

class Loans_model extends MY_Model{

     public $_table='Loans';
     public $_loan_payments_table = "loan_payments";
     public $primary_key = 'id';



	 //Get all journals in the db
     

    
//Get all journals in the db
public function all($limit=20,$offset=0,$loanid=FALSE,$field=null,$value=null)
{

$this->db->select($this->db->dbprefix('loans').'.id as loanid,
  	                           first_name,
  	                           last_name,
                               member_id,
                               installment,
                               letter_date,
                               rank,
                               approved_amount,
                               total_loan_interest,
                               monthly_payment_fees,
                               second, 
                               transfered,' //true if the person has tasken second loan
                               .$this->db->dbprefix('loans').'.created_at'
                               )
                      ->from('loans')
                      ->join('members', 'members.id = loans.member_id');
   
$this->db->where('transfered',0);
    //Check if we need loan information for a specific user only 

     if ($loanid!=FALSE && is_numeric($loanid)) {
     	$this->db->where($this->db->dbprefix('loans').'.id',$loanid);
     }
  //if user has searched for a loan
  if ($field!=null && $value!=null) {

    $this->db->like($field, $value); 
  }
  
  $this->db->limit($limit,$offset);


  return $this->db->get()->result();
 }
  
  //method to get the count of users with loans
  public function MembersWithLoans($value='')
  {
          $this->db->distinct();
          $this->db->select('member_id'); 
          $query = $this->db->get($this->_table);

    return $query->num_rows();
  }

  //get member latest loan id
  public function  LatestLoanId($memberid){
    
    //Get the latest Loan ID of the member
          $MaxLoanId=$this->db->select_max('id')
                              ->where('member_id',$memberid)
                              ->get($this->_table)
                              ->result()[0]
                              ->id;
                       
    #if total payment is null then return 0
    return ($MaxLoanId!=null)?$MaxLoanId:0;
  }


  //Method to get total issued loans
  //UseLatestLoan is when you want to compare the latest loan
  public function GetTotalLoans($member_id=null,$UseLatestLoan=FALSE)
  {

            $this->db->select_sum('total_loan_interest') ;
            #are we looking for one user?
            if($member_id!=null):
            $this->db->where('member_id',$member_id);
            endif;

            //We compaire latest loan?
            if($UseLatestLoan!=FALSE):
               $this->db->where('id',$this->LatestLoanId($member_id));
            endif;

  //Get the sum of the total approved amount          
  $total_loan= $this->db->get($this->_table)
                        ->result();
  
  //Remove bug error by checking if total loan isn't null
  if (count($total_loan)>0) {
        $total_loan = $total_loan[0]->total_loan_interest;
    }   

 //if total payment is null then return 0
  return ($total_loan!=null)?$total_loan:0;

  }  


  #method to check the total payment of loan
  public function gettotalpayment($memberid,$UseLatestLoan=FALSE)
  {

          //Get recent Loan id of this member
         $maxLoanId=intval($this->LatestLoanId($memberid));

          $this->db->select_sum('paid_amount')
                   ->where('member_id',$memberid);
      
        //check if We need to use latest loan id
        if ($UseLatestLoan!=FALSE) {
          $this->db->where('loan_id',$maxLoanId);
        }
         
  $paid_amount  =  $this->db->get($this->_loan_payments_table)
                             ->result();
//Remove bug error by checking if total loan isn't null
  if (count($paid_amount)>0) {
        $paid_amount = $paid_amount[0]->paid_amount;
    }   

   return ($paid_amount==NULL)?0:$paid_amount;
  }

  /**
  *@author Kamaro Lambert
  *@method to check if a member has loan 
  *@return Boolen --> it returns TRUE if member has loan and FALSE if Member doesn't have loan
  */
  public function checkmemberloan($memberid)
  {
  $memberloan= $this->GetTotalLoans($memberid);
  $loanpayments =$this->gettotalpayment($memberid);

  return ($memberloan> $loanpayments)?TRUE:FALSE;
  }
  
  /**
  *@author Kamaro Lambert
  *method to check loan outstanding amount for a member
  * @param integer $memberid
  * @return the balance of the remaining amount ( if the return is positive, then 
  * the returned amount is the what a members still have to pay, if the return 
  * is negative then the user has already paid)
  **/


  //Method to return the payment in percentaage
  public function GetPaymentPercentage($memberid,$userLatestLoan=FALSE)
  {
     $memberloan= $this->GetTotalLoans($memberid,$userLatestLoan);

     
     if ($memberloan==0) {
       return 100;
     }

     $loanpayments =$this->gettotalpayment($memberid,$userLatestLoan);

     return number_format(($loanpayments*100)/($memberloan));
  }

   //Get outstanding Payment

  public function GetOustandingPayment($memberid,$userLatestLoan=FALSE)
  {
     $memberloan= $this->GetTotalLoans($memberid,$userLatestLoan);

     
     $loanpayments =$this->gettotalpayment($memberid,$userLatestLoan);

     return ($memberloan-$loanpayments);
  }
  

  /**
  *@author Kamaro Lambert
  *method to check if a member can have the another loan
  *@param integer $memberid
  **/

  public function eligibleforloan($memberid,$userLatestLoan=FALSE)
  {
        $paymentPercentage = $this->GetPaymentPercentage($memberid,$userLatestLoan);

     
        $hasSecondLoan= (Boolean) $this->getColumnValue($memberid,'second');

         // if the percentage is higher than 2 then he has paid less than 50%
         // 
        return ($paymentPercentage>=50 && !$hasSecondLoan) ;
  
  }
  
  /**
  *@author kamaro lambert
  *method to get the total monthly payment of the member
  * return the monthly payment of the member
  **/
  public function memberloans_payments($memberid)
  {
 
$query=$this->db->query("SELECT CASE 
                                WHEN sum(monthly_payment_fees) IS NULL THEN 0
                                ELSE sum(monthly_payment_fees) END AS monthly_payment_fees
                         FROM (SELECT b.id,CASE 
               WHEN balance IS NULL THEN total_loan_interest
               ELSE balance END AS balance,
              monthly_payment_fees,
              total_loan_interest,
              b.member_id 
FROM ".$this->db->dbprefix('loan_payments')." a
RIGHT JOIN ".$this->db->dbprefix('loans')." b ON a.loan_id=b.id 
WHERE b.member_id = '$memberid') as foo WHERE balance >0");



  return $query->result()[0]->monthly_payment_fees;
  }

  /**
  *@author Kamaro Lambert
  *method to return the maxum id from the loan 
  */

  public function getMaxId()
  {
  return $this->db->select_max('id')
                  ->get($this->_table)
                  ->result()[0]
                  ->id;
  }
 
 /**
  * @author  Kamaro Lambert
  * @method to get the column value based on the member id
  * @param $memberId Id of the member in the loan table 
  * @param $columnName 
  */
  public function getColumnValue($memberId,$columnName)
  {
  
   // Did the user get loan before ?
   if ($this->exists('member_id',$memberId)<=1) {
     return (string) 0;
   }

   return $this->db->select($columnName)
                   ->where('member_id',$memberId)
                   ->get($this->_table)
                   ->result()[0]
                   ->$columnName;
  }



  /**
   * @brief exists
   * @details check if the row exists based on the 
   * searched field
   * @return integer
   */
  public function exists($field,$value)
  {
     return $this->db->where($field,$value)
                     ->get($this->_table)
                     ->num_rows();
  }
  
  /**
   * @brief getByColumn
   * @details get loan by column specified
   * @return [description]
   */
  public function getByColumn($field,$value)
   {
     return $this->db->where($field,$value)
                     ->get($this->_table)
                     ->result();
   } 
  /**
   * set loan to transfered
   */
  public function setTransfered($loanid,$toloanid){

    //Update loan in the database
    return $this->db->update($this->_table, 
                            array('transfered'  =>$toloanid,
                                  'description' => 'Loan Transfered to loan ID # '.$toloanid), 
                            array('id' => $loanid)
                            );
    
  }

  /**
   * unset loan to non transfered
   */
  public function unSetTransfered($loanid){
    
    //Change loan to non transfered
    return $this->db->update($this->_table, 
                            array('transfered'=>0),
                            array('id' => $loanid)
                            );
  }

   /**
   * Insert contract to the loan
   */
  public function setContract($loanid,$contract=nll){
    
    //Change loan to non transfered
    return $this->db->update($this->_table, 
                            array('contract'=>$contract),
                            array('id' => $loanid)
                            );
  }
 
 
  /**
   * get member previous loan id
   * @return integer loan id.
   */

  public function getPreviousLoanId($memberid=FALSE)
  {
    if(!$memberid){
      return false;
    }

    return $this->db->order_by("id", "desc")
                    ->select('id')
                    ->where('member_id',$memberid)
                    ->get($this->_table)
                    ->result()[1]
                    ->id;
  }


  /**
   * get latest loan ID
   * @return integer loan id.
   */

  public function getLastLoanId($memberid=FALSE)
  {
    if(!$memberid){
      return false;
    }

    return $this->db->order_by("id", "desc")
                    ->select('id')
                    ->where('member_id',$memberid)
                    ->get($this->_table)
                    ->result()[0]
                    ->id;
  }

  /**
   * check if this loan is second(has some transfers) or not
   * @return  boolean;
   */
  public function secondLoan($loanid)
  {
   return (boolean) $this->db->select('second')
                             ->where('id',$loanid)
                             ->get($this->_table)
                             ->result()[0]
                             ->second;
  }


  /**
   * Get paid amount per loan
   */
  public function getPaidPerLoan($loanid)
  {
    return  $this->db->select_sum('paid_amount')
                     ->where('loan_id',$loanid)
                     ->get($this->_loan_payments_table)
                     ->result()[0]
                     ->paid_amount;
                     
  }

  public function getLoanBalance($loanid)
  {
     //get total approved amount for this loan
     $totalLoan = $this->getByColumn('id',$loanid)[0]->total_loan_interest;

     //Get loan paid amount 
     $paidAmount = $this->getPaidPerLoan($loanid);

     return $totalLoan-$paidAmount;
  }
}
