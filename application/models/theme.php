<?
class Theme extends CI_Model {

	var $view   = '';
	var $data   = '';
   
    function __construct()
    {
        parent::__construct();
    }
	
	function load($view,$data)
    {		
        //user validation 驗證
        $this->load->view('head');
		$this->load->view($view,$data);
		$this->load->view('foot');		
    }

}