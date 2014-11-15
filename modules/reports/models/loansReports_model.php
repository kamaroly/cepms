<?php 
/**
* @author Kamaro Lambert
* @package cepms
* @description  Model to generated reports of the contribution from the database
*/
class LoansReports_model extends MY_Model
{
  public $_loan_payments_table = "loan_payments";
  public $_loans_table         ="loans";
  public $_members_table       ="members";

  #method to get member loans payments
  public function GetMemberLoanPayments($startdate,$enddate,$id=false,$overdue=false)
  {
    $condition = '';
    #if we need to check for one user then
    if ($id!=false) {
      #check if it is numeric

    $condition = " and a.member_id IN (".$id.") OR membership_number IN (".$id.") ";

    }

    $overduecondition ="";
    //check if user wants overdue loans payments
    if($overdue){
      $overduecondition =" AND (`letter_date` + INTERVAL `installment`+1 MONTH ) < CURDATE()";
    }
    #if the temporary table exists drop it first
  	$this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('TEMP_LOAN_PAYMENTS'));
    
    #create the temporary table
    $this->db->query("CREATE TEMPORARY TABLE ".$this->db->dbprefix('TEMP_LOAN_PAYMENTS')."
	                  (SELECT 
	                       loan_id,
                         member_id,
                         sum(paid_amount) as paid_amount 
	                   FROM ".$this->db->dbprefix($this->_loan_payments_table)." group  by loan_id,member_id
                     )
                     ");

    #join all tables to get the result
    $dataset=$this->db->query("SELECT 
                          a.id,
                          a.created_at,
                          a.member_id,
                          c.membership_number,
                          c.first_name,
                          c.last_name,
                          a.approved_amount,
                          a.total_loan_interest,
                          a.monthly_payment_fees,
                          a.letter_date,
                          a.interest,
                          a.interest_rate,
                          a.approved_amount/a.installment   as monthlypaid ,
                          a.total_loan_interest-b.paid_amount as balances,
                          c.rank,
                          period_diff(date_format(now(), '%Y%m'), date_format((`letter_date` + INTERVAL `installment`+1 MONTH ), '%Y%m')) as cnt_months, 
                          a.installment,
                          CASE WHEN b.paid_amount IS NULL THEN 0
                          ELSE b.paid_amount END AS paid_amount

                        FROM ".$this->db->dbprefix($this->_loans_table)." as a
                        LEFT JOIN ".$this->db->dbprefix('TEMP_LOAN_PAYMENTS')." as b
                        ON a.id=b.loan_id 
                        JOIN ".$this->db->dbprefix($this->_members_table)." c 
                        ON a.member_id=c.id 
                        WHERE (a.created_at BETWEEN '$startdate' AND '$enddate') 
                        $condition $overduecondition
                        order by  a.created_at desc ");
   
   #return the result

   return $dataset->result();
  }




  public function GetMemberLoanPaymentsPaid($startdate,$enddate,$id=false,$overdue=false)
  {
   $condition = '';
    #if we need to check for one user then
    if ($id!=false) {
      #check if it is numeric

    $condition = " and a.member_id IN (".$id.")";

    }

    $overduecondition ="";
    //check if user wants overdue loans payments
    if($overdue){
      $overduecondition =" AND (`letter_date` + INTERVAL `installment`+1 MONTH ) < CURDATE()";
    }
    #if the temporary table exists drop it first
    $this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('TEMP_LOAN_PAYMENTS'));
    
    #create the temporary table
    $this->db->query("CREATE TEMPORARY TABLE ".$this->db->dbprefix('TEMP_LOAN_PAYMENTS')."
                    (SELECT 
                         loan_id,
                         member_id,
                         modified_at,
                         sum(paid_amount) as paid_amount,
                         sum(balance)  as balance
                     FROM ".$this->db->dbprefix($this->_loan_payments_table)." group  by loan_id,member_id,modified_at
                     )
                     ");

    #join all tables to get the result
    $dataset=$this->db->query("SELECT 
                          a.id,
                          a.created_at,
                          a.member_id,
                          c.membership_number,
                          c.first_name,
                          c.last_name,
                          a.approved_amount,
                          a.total_loan_interest,
                          a.monthly_payment_fees,
                          a.letter_date,
                          a.interest,
                          b.balance,
                          b.modified_at,
                          c.rank,
                          period_diff(date_format(now(), '%Y%m'), date_format((`letter_date` + INTERVAL `installment`+1 MONTH ), '%Y%m')) as cnt_months, 
                          a.installment,
                          CASE WHEN b.paid_amount IS NULL THEN 0
                          ELSE b.paid_amount END AS paid_amount

                        FROM ".$this->db->dbprefix($this->_loans_table)." as a
                        LEFT JOIN ".$this->db->dbprefix('TEMP_LOAN_PAYMENTS')." as b
                        ON a.id=b.loan_id 
                        JOIN ".$this->db->dbprefix($this->_members_table)." c 
                        ON a.member_id=c.id 
                        WHERE (a.created_at BETWEEN '$startdate' AND '$enddate')  and  b.balance=0
                        $condition $overduecondition
                        order by  a.created_at desc ");
   
   #return the result

   return $dataset->result();
   }
}
