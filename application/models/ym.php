<?
class Ym extends CI_Model {

    var $title   = 'Good2u';
    var $heading   = 'Good2u';
	var $error_info='';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->helper('date');
		$this->load->helper('url');
		$this->load->database();
		
    }
    
	
	function error($error_info)
	{	
		$data['info']=$error_info;
		$this->load->view('error_view',$data);
	}
	//單值query
	function one_query($query,$item)
	{
		$one_query = $this->db->query($query);
		if($one_query->num_rows()>0){
		$row=$one_query->row_array();
		return $row[$item];}else{return '';}
	}
	
	function hash($db)
	{
			$re='1';$x='0';
		while($re){
			$now = time();
			$hash = substr (md5($now), $x, 8);
			$check = $this->db->query('select * from '.$db.' where hash_id ="'.$hash.'" ');
			if($check->num_rows()==0)
				$re='0';
			else
				$x++;
			}
			return $hash;
	}
	
	function now()
	{
		date_default_timezone_set('Asia/Taipei');	
		$now = time();
		$timezone = "up8";
		$up8 = gmt_to_local($now, $timezone);
		return $up8;
		//echo "現在時間：".unix_to_human($now)."機器看的：".$now; // U.S. time, no seconds 
	}
	
	function time_change($time)
	{
		date_default_timezone_set('Asia/Taipei');
		$date = date ("Y-m-d  H:i:s",$time); 
		return $date;
		
	}
	
	function check_login()
	{
		if ($this->session->userdata('userid')==''){ 
			$userdata = array(  			
			'redirect_url'  => current_url()
			);
			$this->session->set_userdata($userdata);
			redirect(base_url().'index.php/user/login_page/');
		}
		return 0;
	}
	
	function check_admin()
	{
		$super_user=$this->one_query('select super_user from user where id="'.$this->session->userdata('userid').'"','super_user');
		if ($super_user!='1'){ 		
			redirect('ysong/error/您沒有這個權限哦！');
		}
		return 0;
	}
	
	
	function user_pic($user_id)
	{	
		$file_name=$this->one_query('select img from user where id="'.$user_id.'"','img');
		//$fid=$this->one_query('select fb_id from user where id="'.$user_id.'"','fb_id');
		$file='./upload/user/'.$file_name;
		if(file_exists($file)):
			//return "http://graph.facebook.com/".$fid."/picture";
			return base_url().'upload/user/'.$file_name;
		else:
			//return "http://graph.facebook.com/".$fid."/picture";
			return base_url().'upload/user/user.jpg';
		endif;
	}
	
	function set_session($email){
			$check = $this->db->query('select * from user where email ="'.$email.'" ');
			$row=$check->row_array();
			if($check->num_rows()!=0){				
			$user_id = $row['id'];
			$user_name = $row['name'];
			//$fb_id = $row['fb_id'];
			$img = $row['img'];
			$email = $row['email'];	
			$address = $row['address'];	
			$super_user = $row['super_user'];	
			$userdata = array(  			
			'username'  => $user_name,
			'userid' => $user_id,
			'super_user'  => $super_user,
			//'img'  => $img,
			'email'=>$email
			//'address'=>$address
			);
			$this->session->set_userdata($userdata);
			}
	}
	
	//email如果有人名，就換成人名
	function email_to_name($email){
		$query=$this->db->query('select name from user where email="'.$email.'"');
		$row=$query->row_array();
			if($query->num_rows()!=0 && $row['name']!=''){
				return $row['name']."(".$email.")";
			}else{
				return $email;				
			}	
		}
	//facebook照片insert
	function fb_pic_save($fid){
		//設定facebook 使用者圖片
		if($fid!=''){
		$img = file_get_contents('http://graph.facebook.com/'.$fid.'/picture?type=large');
		$file = dirname(__file__).'/../../upload/user/'.$fid.'.jpg';
		file_put_contents($file, $img);	
		//每次更新都換照片，所以也要加一個 flag

		$insert_data = array('img' => $fid.'.jpg');
		$this->db->where('fb_id', $fid);
		$this->db->update('user', $insert_data);
		}else return 0;
	}
	
	//
	function check_perm($uid,$db,$ucol){
		$check = $this->db->query('Select * from '.$db.' where '.$ucol.'="'.$uid.'"');
		if($check->num_rows()>0):
			return true;
		else:
			redirect('info/error/權限錯誤');
		endif;
		}

	//彈出訊息設定
	function flash_session($type,$msg)
	{
		//4種type: alert-success alert-info alert-error 和default(無)
		$value=array("type"=>$type,"msg"=>$msg);
		$this->session->set_flashdata('alert', $value);
	}	

	//驗證是否是開課人
	function check_creator($user_id,$course_id)
	{
		$check=$this->db->query('select * from course where id="'.$course_id.'" and creator_id="'.$user_id.'"');
		if($check->num_rows==0&&$this->check_admin($user_id)!=0)
			redirect('info/error/請您以該課程老師身份登入，方可進入此頁面');
		return TRUE;
	}

	//驗證是否是訂閱學員
	function check_subscribe($user_id,$course_id)
	{
		$check=$this->db->query('select * from user_course where course_id="'.$course_id.'" and user_id="'.$user_id.'"');
		$check_owner=$this->db->query('select * from course where id="'.$course_id.'" and creator_id="'.$this->session->userdata('userid').'"');
		if($check->num_rows==0):
			if($check_owner->num_rows==0):
				redirect('info/error/權限錯誤');
			endif;
		endif;
	}

	//檢查課程是否已刪除
	function check_delete_flag($course_id)
	{
		$this->db->where('id',$course_id);
		$if_exist=$this->db->get('course')->num_rows;
		$check=$this->db->query('select * from course where id="'.$course_id.'" and delete_flag=1 ');
		if($check->num_rows>0 ||$if_exist==0)
			redirect('info/error/課程不存在');
	}
	//檢查課程是否已發佈
	function check_publish($course_id)
	{
		$check=$this->db->query('select * from course where id="'.$course_id.'" and status=0 ');
		$check_owner=$this->db->query('select * from course where id="'.$course_id.'" and creator_id="'.$this->session->userdata('userid').'"');
		if($check->num_rows>0):
			if($check_owner->num_rows==0):
				//redirect('info/error/課程尚未發佈');
				$row=$check->row();
				redirect('page/not_publish/'.$row->category_id);
			endif;
		endif;
	}	

	function validateEmail($email) {

	if (filter_var($email, FILTER_VALIDATE_EMAIL)):
	    return TRUE;
	else:
		redirect('info/error/email格式錯誤');
	endif;
	}

	function id_to_name($user_id){
		$query=$this->db->query('select name from user where id="'.$user_id.'"');
		$row=$query->row_array();
			if($query->num_rows()!=0 && $row['name']!=''){
				return $row['name'];
			}else{
				return '(empty)';				
			}	
		}

	function check_enroll($email,$course_id){
		$this->db->where('email',$email);
		$this->db->where('course_id',$course_id);
		$check=$this->db->get('register');
		return $check->num_rows();
	}

	function course_type($course_id){
		$this->db->where('id',$course_id);
		$row=$this->db->get('course')->row();
		return $row->type;
	}

	function check_course_paid($course_id)
	{
		$this->db->where('id',$course_id);
		$row=$this->db->get('course')->row();
		return $row->paid;
	}
	
	function check_teacher_flag($user_id)
	{
		$row = $this->db->where('id',$user_id)->get('user')->row();
		return $row->teacher_flag;
	}

	function check_isteacher($user_id)
	{
		$this->db->where('id',$user_id);
		$row=$this->db->get('user')->row();
		if(!$row->teacher_flag)
			redirect('info/error/你沒有開課的權限哦！');
	}

}
?>