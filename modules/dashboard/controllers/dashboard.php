<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

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

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');
            
    }

    function index()
    {
         //set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');
   
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('users/login', 'refresh');
        }
        elseif (!$this->ion_auth->is_admin())
        {
           //Load models
            $memberswithloans = $this->Loans->MembersWithLoans();
            $this->data['countmembers']=$this->members->count_all();
            
            $this->data['memberwithloan_percentage']= ($memberswithloans/$this->data['countmembers'])*100;
            $this->data['cep_contributions']=$this->contributions->GetTotalContributions(TRUE);

            $this->data['social_contributions']=$this->contributions->GetTotalContributions(FALSE);
             

            $this->data['totalloans']= $this->Loans->GetTotalLoans();

            $this->data['countmembers']=$this->members->count_all();

          
            $this->_render_page('dashboard', $this->data);
        }
        else
        {
            //Load models
            $memberswithloans = $this->Loans->MembersWithLoans();
            $this->data['countmembers']=$this->members->count_all();
            
            $this->data['memberwithloan_percentage']= ($memberswithloans/$this->data['countmembers'])*100;
            $this->data['cep_contributions']=$this->contributions->GetTotalContributions(TRUE);

            $this->data['social_contributions']=$this->contributions->GetTotalContributions(FALSE);
             

            $this->data['totalloans']= $this->Loans->GetTotalLoans();

          
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
             $this->data['errors'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('errors');
   

            $this->_render_page('dashboard', $this->data);
        }
    }




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
