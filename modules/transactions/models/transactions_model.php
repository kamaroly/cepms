<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * This is a model helps to get transactions / posts in the CEPMS
 * 
 *
 * @package		CEPMS
 * @subpackage	Transaction
 * @category	Model
 * @author		Kamaro Lambert
 * @link		http://kamaroly.com/
*/
class Transactions_model extends MY_Model{

     public $_table='postings';
     public $primary_key = 'id';
     
     public $postingsTable ='postings';



//Get all journals in the db
public function all($limit=20,$offset=0){

//Because transaction are double recorded now we are going to double the limit too
$limit*=2;
//if exists then drop it
$this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('temp_postings_1'));

//Create temporary table that will store the mirrored table
 $this->db->query("CREATE TEMPORARY TABLE ".$this->db->dbprefix('temp_postings_1')."(SELECT * FROM ".$this->db->dbprefix('postings')." ORDER BY created_at desc LIMIT $offset,$limit)");

//if exists then drop it
$this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('temp_postings_2'));

$this->db->query("CREATE TEMPORARY TABLE ".$this->db->dbprefix('temp_postings_2')."(
SELECT a.transaction_id,
       a.account_id AS from_account,
       b.account_id AS to_account,
       a.journal_id,
       a.amount,
       a.comment,
       a.created_at,
       a.created_by
FROM ".$this->db->dbprefix('temp_postings_1')." AS a , ".$this->db->dbprefix('postings')." AS b 
WHERE a.journal_id=b.journal_id AND a.amount=b.amount*-1 
  AND a.comment=b.comment AND a.created_at=b.created_at
  AND a.created_by=b.created_by AND a.amount>0
  AND a.transaction_id=b.transaction_id)");



  $dataset=$this->db->query("SELECT a.transaction_id,
       CONCAT(b.name,' [#',b.code,'] ') AS from_account,
       CONCAT(c.name,' [#',c.code,'] ') AS to_account,
       d.type AS journal_type,
       a.amount,
       a.comment,
       a.created_at,
       CONCAT(e.first_name,' ',e.last_name) AS created_by

FROM ".$this->db->dbprefix('temp_postings_2')." AS a
LEFT JOIN ".$this->db->dbprefix('accounts')." AS b ON a.from_account=b.id
LEFT JOIN ".$this->db->dbprefix('accounts')." AS c ON a.to_account =c.id
LEFT JOIN ".$this->db->dbprefix('journals')." AS d ON a.journal_id =d.id
LEFT JOIN ".$this->db->dbprefix('users')." AS e ON a.created_by=e.id 
ORDER BY created_at DESC");

 return $dataset->result();
}
    




//Get all accounts transactions
public function gettransactions($startdate,$enddate,$id=false){

$condition = "";
//Are we looking transactions for only one account ?
  if ($id!=false) {
    $condition = " AND  account_id=$id ";
  }

//if exists then drop it
$this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('temp_postings_1'));

//Create temporary table that will store the mirrored table
 $this->db->query("CREATE TEMPORARY TABLE ".$this->db->dbprefix('temp_postings_1')."
                 (SELECT * FROM ".$this->db->dbprefix('postings')." 
                  WHERE (created_at BETWEEN '$startdate' AND '$enddate') $condition )");

//if exists then drop it
$this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('temp_postings_2'));

$this->db->query("CREATE TEMPORARY TABLE ".$this->db->dbprefix('temp_postings_2')."(
SELECT a.transaction_id,
       a.account_id AS from_account,
       b.account_id AS to_account,
       a.journal_id,
       a.amount,
       a.comment,
       a.created_at,
       a.created_by
FROM ".$this->db->dbprefix('temp_postings_1')." AS a , ".$this->db->dbprefix('postings')." AS b 
WHERE a.journal_id=b.journal_id AND a.amount=b.amount*-1 
  AND a.comment=b.comment AND a.created_at=b.created_at
  AND a.created_by=b.created_by AND a.amount>0
  AND a.transaction_id=b.transaction_id)");



  $dataset=$this->db->query("SELECT a.transaction_id,
       CONCAT(b.name,' [#',b.code,'] ') AS from_account,
       CONCAT(c.name,' [#',c.code,'] ') AS to_account,
       d.type AS journal_type,
       a.amount,
       a.comment,
       a.created_at,
       CONCAT(e.first_name,' ',e.last_name) AS created_by

FROM ".$this->db->dbprefix('temp_postings_2')." AS a
LEFT JOIN ".$this->db->dbprefix('accounts')." AS b ON a.from_account=b.id
LEFT JOIN ".$this->db->dbprefix('accounts')." AS c ON a.to_account =c.id
LEFT JOIN ".$this->db->dbprefix('journals')." AS d ON a.journal_id =d.id
LEFT JOIN ".$this->db->dbprefix('users')." AS e ON a.created_by=e.id 
ORDER BY created_at DESC");

 return $dataset->result();
}

///get  transaction by journal

public function gettransactionsbyjournal($startdate,$enddate,$id=false){

$condition = "";
//Are we looking transactions for only one account ?
  if ($id!=false) {
    $condition = " AND  journal_id=$id ";

  }

//if exists then drop it
$this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('temp_postings_1'));

//Create temporary table that will store the mirrored table
 $this->db->query("CREATE TEMPORARY TABLE ".$this->db->dbprefix('temp_postings_1')."
                 (SELECT * FROM ".$this->db->dbprefix('postings')." 
                  WHERE (created_at BETWEEN '$startdate' AND '$enddate') $condition )");

//if exists then drop it
$this->db->query("DROP TABLE IF EXISTS ".$this->db->dbprefix('temp_postings_2'));

$this->db->query("CREATE TEMPORARY TABLE ".$this->db->dbprefix('temp_postings_2')."(
SELECT a.transaction_id,
       a.account_id AS from_account,
       b.account_id AS to_account,
       a.journal_id,
       a.amount,
       a.comment,
       a.created_at,
       a.created_by
FROM ".$this->db->dbprefix('temp_postings_1')." AS a , ".$this->db->dbprefix('postings')." AS b 
WHERE a.journal_id=b.journal_id AND a.amount=b.amount*-1 
  AND a.comment=b.comment AND a.created_at=b.created_at
  AND a.created_by=b.created_by AND a.amount>0
  AND a.transaction_id=b.transaction_id)");



  $dataset=$this->db->query("SELECT a.transaction_id,
       CONCAT(b.name,' [#',b.code,'] ') AS from_account,
       CONCAT(c.name,' [#',c.code,'] ') AS to_account,
       d.type AS journal_type,
       a.amount,
       a.comment,
       a.created_at,
       CONCAT(e.first_name,' ',e.last_name) AS created_by

FROM ".$this->db->dbprefix('temp_postings_2')." AS a
LEFT JOIN ".$this->db->dbprefix('accounts')." AS b ON a.from_account=b.id
LEFT JOIN ".$this->db->dbprefix('accounts')." AS c ON a.to_account =c.id
LEFT JOIN ".$this->db->dbprefix('journals')." AS d ON a.journal_id =d.id
LEFT JOIN ".$this->db->dbprefix('users')." AS e ON a.created_by=e.id 
ORDER BY created_at DESC");

 return $dataset->result();
}

/**
*method to get the account activities
*/

public function getAccountActivities($account_id,$startdate,$enddate)
{
  //let us get the transactions(postings) of a given account id in periods of given dates

 return $this->db->where('created_at >=',$startdate)
                 ->where('created_at <=',$enddate)
                 ->where('account_id',$account_id)
                 ->order_by('created_at','ASC')
                 ->get($this->postingsTable)
                 ->result();

}

//method to check the balance of the account before a give date
//parameters , account id and date
public  function SumAccountBeforeDate($account_id,$startdate)
{
  
  //Let's get the balance of the given account before given date
  $sum =$this->db->select_sum('amount')
                 ->where('created_at <',$startdate)
                 ->where('account_id',$account_id)
                 ->get($this->postingsTable)
                 ->result()[0]
                 ->amount;
  //if the sum is null which means there is no transaction for this account then instead of return 
  // null let us return 0

  return (is_null($sum))?0:$sum;               
}

//method to return the maximum transaction id before given date

public function MaxTranefsactionId($account_id,$startdate)
{
    $id =$this->db->select_max('transaction_id')
                 ->where('created_at <',$startdate)
                 ->where('account_id',$account_id)
                 ->get($this->postingsTable)
                 ->result()[0]
                 ->transaction_id;
  //if the sum is null which means there is no transaction for this account then instead of return 
  // null let us return 0

  return (is_null($id))?0:$id;               

}
}
