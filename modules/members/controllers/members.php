<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends MX_Controller{
	
   //This variable will be storing all information to pass to the view 
   public $data ;
   public $user_id;
 function __construct()
    {
        parent::__construct();
        //Loading Lybrary
        $this->load->library('session');
        
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
        //load members model
        $this->load->model('member_model','members');
        $this->load->model('Contributions_model','contributions');
        $this->load->model('Contributions_archive_model','contributions_archives');
        $this->load->model('loans/loans_model','loans');        
        $this->load->model('loans/LoanPayments_model','loanpayments');

        //Get the current user id
        $this->user_id = $this->session->userdata('user_id');



    }
     

        /*
         * Displays all of the memebers in a table
         */
        public function index($offset=0)
        {

                 //set the flash data error message if there is one
               $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                   //set the flash data error message if there is one
               $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');

             
              $config['base_url'] = site_url('/members/index');
              
              $config['per_page'] = 20;
              $config['uri_segment'] = 3;
              $config['num_links'] = 5;
              $config['use_page_numbers'] = TRUE;
              $config['total_rows'] = $this->members->count_all();
              
              $this->pagination->initialize($config);
              $offset=(($offset-1)*$config['per_page']>0)?($offset-1)*$config['per_page']:0;
              $this->members->limit($config['per_page'],$offset);

              $this->data['members']= $this->members->get_all();
              #check if there is a search
              if($this->input->get('field') && $this->input->get('search'))
              {
                #get members as per search
                $this->data['members']= $this->members->get_like($this->input->get('field'),$this->input->get('search'));
                
                #get the num rows
               $config['total_rows'] =count($this->data['members']);
              }

              $this->pagination->initialize($config);

              $this->data["links"] = $this->pagination->create_links();

               //Instatiate Epargne object
              $this->_render_page('members/index', $this->data);
               
               
        }

public function test($memberid=1)
{
  
  var_dump($this->loans->eligibleforloan($memberid,TRUE));
}
 /**
 * @Autor Kamaro Lambert
*  @method to save new member
*  @param   numeric $id : this is to determine the member id
*  @param   boolen $popup: this is to determine if we need popup to be displayed
 */
 
    public function save($id=FALSE)
    {
  
   //check if the user is looking for new member form
      if(empty($_POST) && $id===FALSE){
        $this->_render_page('members/form');

        return ;
      }

    
      //User wants to update a member
      if(empty($_POST) && $id!=FALSE){
        
        if(!$this->members->exists($id))
        {
          #this member doesn't exist
          $this->session->set_flashdata('message','Member does not exists');
          redirect('members','refresh');
        }
        $this->data['member'] =$this->members->get($id);

        $this->_render_page('members/form',$this->data);
        return ;
      }
    //check if there is some submitted data with post method
   if (!empty($_POST)) {
      
    # data submitted now let's check if it's for update existing member
    
    $membership_id=$this->input->post('membership_id');

    if($id===FALSE && !$membership_id)
     {
      $membership_id=$this->members->MaxMemberNumber()+1;
    
      while (strlen($membership_id)<3) {
       $membership_id='0'.$membership_id;
     }
       $membership_id= date('Y').$membership_id;
    }
  

      #this is the section to upload pictures#
      ########################################

            #let's check if there is a new uploaded image
            $this->load->library('upload');
            $config['upload_path'] = 'assets/img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';
           // $config['max_width']  = '5024';
           // $config['max_height']  = '1768';
            
            //Initialise the upload library
            $this->upload->initialize($config);
           
            //Go through all uploaded files
            foreach($_FILES as $field => $file)
            {
             
                // No problems with the file
                if($file['error'] == 0)
                {
                    // So lets upload
                    if ($this->upload->do_upload($field))
                    {
                        $data = $this->upload->data();
                        //Get the name of the file you have uploaded
                        $this->data[$field]=$data['file_name'];
                    }
                    else
                    {
                        $errors = $this->upload->display_errors();
                        //get the errors
                        $this->data['errors']= $this->data['errors'].$errors;
                        $this->session->set_flashdata('errors',$this->data['errors']);
                    }

                }

             }
        
        $photo     = false;
        $signature = false;

        if (isset($this->data['photo'])) 
           {
              $photo   = $this->data['photo'];
           }
        elseif (isset($this->data['signature'])) 
           {
              $signature= $this->data['signature'];
           }

      
  $insert_array=array(
                     'membership_number'=>$membership_id,
                     'rank'=>$this->input->post('rank'),
                     'first_name'=>$this->input->post('first_name'),
                     'last_name'=>$this->input->post('last_name'),
                     'dob'=>$this->input->post('dob'),
                     'nationality'=>$this->input->post('nationality'),
                     'district'=>$this->input->post('district'),
                     'province'=>$this->input->post('province'),
                     'sex'=>$this->input->post('sex'),
                     'nid'=>$this->input->post('nid'),
                     'phone'=>$this->input->post('phone'),
                     'email'=>$this->input->post('email'),
                     'start_date'=>$this->input->post('start_date'),
                     'service'=>$this->input->post('service'),
                     'level'=>$this->input->post('level'),
                     'cep_fund'=>$this->input->post('cep_fund'),
                     'social_fund'=>$this->input->post('social_fund'),
                     'net_salary'=>$this->input->post('net_salary'),
                     'status'=>$this->input->post('status'),
                     'created_by'=>$this->user_id
                    );
   
   //insert images array if they are available
   if($photo!=false):
    $insert_array['photo']     =$photo;
   endif;
   
   if($signature):
     $insert_array['signature'] =$signature;
   endif;
    #New member to record

    if($id===FALSE)
    { 
     $insert=$this->members->insert($insert_array);
    }
   else
   {
  #update the existing member
    $insert=$this->members->update($id,$insert_array);
   }
    
   if ($insert) {
     $this->session->set_flashdata('message', "Member Saved well!");
   }
   else{
    $this->session->set_flashdata('errors','Unable to save member');
   }

   redirect('members','refresh');
  }   
 

   }

   // method to delete

   public function delete($id){

  if (empty($id)) {
      # code...
     show_404();
    }
    else
    {
    
       if($this->members->delete($id)){
         $this->session->set_flashdata('message', "Member deleted well!");
        
       }else{
         $this->session->set_flashdata('message', "Unable to delete this Member!");
       }

        redirect("members", 'refresh');
    }
 }


public function batchcotisation($level="A0")
{
 
 $this->load->library("pagination");  // Load the pagination library in controller

  if ($_POST) {
     //get all submitted data

    $month      = $this->input->post('month');
    $cep_fund   = $this->input->post('cep_fund');
    $social_fund= $this->input->post('social_fund');

    $members    = $this->input->post('members');

    #members selected ?
     if ($members!=false && count($members)>0) {

         foreach ($members as $member => $id) {
            $this->contributions
                 ->insert(array(
                             'memberid'         =>$id,
                             'cep_contribution' =>$cep_fund,
                             'social_fund'      => $social_fund,
                             'month'            => $month,
                             'created_by'       =>$this->user_id
                               )
                 );
         }
     $this->session->set_flashdata('message', "Contribution for ".count($members)." members in level ".$level." are well saved!");
     redirect('members');
     return;
     }
     else{
        $this->session->set_flashdata('errors', "Please select members for this contribution");
      
       $this->data['month']      =$month;
       $this->data['cep_fund']   =$cep_fund;
       $this->data['social_fund']=$social_fund;
   
        $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');

       $this->_render_page('members/batchcotisation',$this->data);
       return ;
   
     }
 
    return;
  }
  $level = str_replace('%20',' ', $level);

 $this->data['members']=$this->members->ByLevel($level);
          
 $this->_render_page('members/batchcotisation',$this->data);

    }



    public function pickdate($id=null)
    {
        $this->_render_page('members/datepicker');
   }

//Get next member id
public function getNextMemberNumber(){

  return date('Y').$this->members->MaxMemberNumber()+1;
}

#multiple uploads 

 function multipleuploads()
    {
        if (isset($_POST['submit']))
        {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';
           // $config['max_width']  = '5024';
           // $config['max_height']  = '1768';
 
            $this->upload->initialize($config);
           
       
            foreach($_FILES as $field => $file)
            {
             
                // No problems with the file
                if($file['error'] == 0)
                {
                    // So lets upload
                    if ($this->upload->do_upload($field))
                    {
                        $data = $this->upload->data();
                        $this->data[$field]=$data['file_name'];
                    }
                    else
                    {
                        $errors = $this->upload->display_errors();
                        $this->data['errors']= $this->data['errors'].$errors;
                    }

                }

             }

            if (isset($this->data['file1'])) {
              var_dump($this->data['file1']);
            }
            elseif (isset($this->data['file2'])) {
             var_dump($this->data['file2']);
            }
        }
 
        $this->load->view("members/upload_form",$this->data);
    }

//get total CEP contribution per member
public function leavecep($memberid=null)
{

   if ($memberid==null || empty($memberid)) {
     show_404();
   }

     //check if member is already archived 
    if($this->contributions_archives->exists($memberid)){
     
      $this->session->set_flashdata('errors','<h4>Member cannot leave , because he/she has left CEP sometimes back.</h4>');
      redirect('members');
    }
    //Load extra models to use
    $this->load->model('Contributions_refund_model','refund');

    $total_cep_contributions=$this->contributions->GetTotalContributions(TRUE,$memberid); //GET TOTAL CEP CONTRIBUTION

    $outstanding=$this->members->OutStandingAmount($memberid);
       
       if ($outstanding>0) {

         $insert_array=array(
                    'member_id'   =>$memberid,
                    'loan_id'     =>$this->loans->LatestLoanId($memberid),
                    'date_paid'   =>date('Y-m-d'),
                    'paid_amount' =>$outstanding, 
                    'description' =>'Automatically Paid by the system when member left CEP',
                    'balance'     =>0,
                    'created_by'  =>$this->user_id
                    );
          if(!$this->loanpayments->insert($insert_array))
         {
            $this->session->set_flashdata('errors','<h4>Unable to refund outstanding amount, Please refund it manual before allowing the member to leave.</h4>');
            redirect('members');
         }
       }

      
      $balance = $total_cep_contributions-$outstanding;

      $insert_refund_array=array(
                    'memberid'                      =>$memberid,
                    'total_cep_found'               =>$total_cep_contributions,
                    'loan_not_paid_plus_interest'   =>$outstanding,
                    'balance'                       =>$balance, 
                    'created_at'                    =>date('Y-m-d :h:i:s'),
                    'created_by'                    =>$this->user_id
                    );
     
      // record the refund
      $this->refund->insert($insert_refund_array);

          //Change the status to left
          if($this->members->ChangeState($memberid,'left')){

            //Archive all his contributions
            if($this->contributions->archive($memberid)) {

              //set all cep contribution to zero
              if($this->contributions->SetCepToZero($memberid)){
                
                $this->data['member'] = $this->members->get($memberid);
                $this->data['balance'] =$balance;
                $this->data['outstanding'] =$outstanding;
                $this->data['total_cep_contributions'] = $total_cep_contributions;

                $this->data['outstanding'] = $outstanding;

                $this->load->view('reports/prints/cepleave',$this->data);
              }else{
                 $this->session->set_flashdata('errors','<h4>Member left CEP, but we could not initialize the contribution ,please do it manually or contact the support team.</h4>');
                 redirect('members'.$id);
              }
            } else{
                 $this->session->set_flashdata('errors','<h4>Member left CEP, but we could not archive his/her contributions ,please do it manually or contact the support team.</h4>');
                 redirect('members'.$id);
            }         
          }else{
                 $this->session->set_flashdata('errors','<h4>Member paid loan but we couldn\'t change his state ,please do it manually or contact the support team.</h4>');
                 redirect('members'.$id);
            }     
       


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