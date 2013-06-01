<?
class Theme extends CI_Model {

	var $view   = '';
	var $data   = '';
   
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
		$this->load->library('session');
        $this->load->library('facebook');
        $this->load->model('course_model');
    }
	
	function load($view,$data)
    {		
        //user validation 驗證
        $this->user_model->check_validation($this->session->userdata('userid'));
        $hdata['course_cat_query']=$this->db->order_by('order_id','ASC')->where('display','1')->get('course_cat');
        $hdata['promote_query']=$this->db->where('promote','1')->get('flag');
        $hdata['login_url'] = $this->facebook->getLoginUrl(array('scope' => 'email'));
        $this->load->view('head',$hdata);
        $this->load->view('container_head');
		$this->load->view($view,$data);
		$this->load->view('foot');		
    }

}