<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head> 
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?=base_url()?>theme/favicon.ico" type="image/x-icon" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=base_url()?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="<?=base_url()?>js/jquery-1.8.3.min.js"></script>
    <script src="<?=base_url()?>bootstrap/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="<?=base_url()?>theme/e7learn.css">
    <script type="text/javascript">
      //全域變數
      var base_url="<?=base_url()?>";
    </script>
    
    <style type="text/css">
      body{background-image:url("<?=base_url()?>theme/noisy.png"); }
  	</style>	
  </head>
  <body>
  <div id="wrapper">
	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <?=anchor('home','<img src="'.base_url().'theme/white_logo.png" style="width:92px"/>','class="brand"')?>
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav-collapse collapse">
    			<ul class="nav">
    				<!-- <li><?=anchor('course/courses/all','課程總覽','class="actived"')?></li> -->
            <? foreach($course_cat_query->result() as $row): ?>
            <? $count='course_count_'.$row->id; ?>
              <li><?=anchor('course/category/'.$row->id.'/all',$row->name)?></li>
            <? endforeach;?>
            <? foreach($promote_query->result() as $row): ?>
              <li><?=anchor('course/flag/'.$row->id.'/all',$row->name)?></li>
            <? endforeach;?>
            <li> <a href="http://www.sharecourse.net/sc/index.php?page=schoolCourseList&school=9">磨課館</a> </li>
    			</ul>
          <div id="search">
              <?=form_open('search/keyword'); ?>
              <input type="text" name="keyword" placeholder="search" />
              <input type="submit" value=" ">
              </form>
          </div>                   
          
			<? if($this->session->userdata('userid')!=''):?>
			<ul class="nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						課程 <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><?=anchor('course/my_course','我訂閱的課程('.$this->course_model->my_sub_count().')')?></li>
						<li><?=anchor('course/my_follow_course','我追蹤的課程('.$this->course_model->my_follow_count().')')?></li>
            <? if($this->ym->check_teacher_flag($this->session->userdata('userid'))):?>
            <li><?=anchor('course/teach_course','我教授的課程('.$this->course_model->my_teach_count().')')?></li>
            <li class="divider"></li>
					  <li><?=anchor('course/course_choice','開新課程')?></li>
            <? endif;?>
					</ul>
				</li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              帳號
              <?//$this->ym->id_to_name($this->session->userdata('userid'))?>
              <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
              <li><?=anchor('user','個人資料')?></li>
              <? if($this->session->userdata('fb_login')): ?> 
              	<li><a href="#" onclick="sendRequestViaMultiFriendSelector()">推薦給朋友</a></li>
              	<li><?=anchor($this->session->userdata('fb_logout_url'),'登出')?></li>
              <? else: ?>
              	<li><?=anchor('user_module/user_login/logout/home','登出')?></li>
              <? endif;?>
              <? if($this->session->userdata('super_user')): ?>
              	<li class="divider"></li>
              	<li><?=anchor('backend/admin','管理後台')?></li>
          	  <? endif; ?>
          </ul>
        </li>
    			</ul>
            <? else:?>
            <ul class="nav pull-right">
              <li><a href="<?=base_url()?>index.php/user/login_page" ><i class="icon-user"></i>登入</a></li>
            </ul>
			<? endif;?>
      </div>
          </div>
      </div>
    </div>