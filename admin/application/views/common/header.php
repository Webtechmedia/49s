<?php
$username=$this->tank_auth->get_username();
//if($username==''){redirect('auth/logout'); }?>
<nav class="navbar navbar-default ">
      <div class="container">
        <div class="navbar-header">
          	<a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo base_url("images/cms_logo.png") ?>" alt="49s logo" width="55px"/></a>
        </div>
          <ul class="nav navbar-nav">
            <li <?php if($this->uri->segment(1)=='')echo 'class="active"' ?>><a href="<?php echo base_url() ?>">Home</a></li>
            <li class="dropdown <?php if($this->uri->segment(1)=='feed_view')echo 'active' ?>">
              <a href="#" class="dropdown-toggle <?php if($this->uri->segment(1)=='feed_view')echo 'class="active"' ?>" data-toggle="dropdown" role="button" aria-expanded="false">Results Data <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url('feed_view/numbers_49') ?>">49s</a></li>
                <li><a href="<?php echo base_url('feed_view/numbers_lucky') ?>">Irish Lotto</a></li>
                <li><a href="<?php echo base_url('feed_view/numbers_rapido') ?>">Rapido</a></li>
                <li><a href="<?php echo base_url('feed_view/virtual_dog_race') ?>">Virtual Greyhound Racing</a></li>
                <li><a href="<?php echo base_url('feed_view/virtual_horse_race') ?>">Virtual Horse Racing</a></li>
              </ul>
            </li>
            <li class="dropdown <?php if($this->uri->segment(1)=='uploads' || $this->uri->segment(1)=='uploadsmobile' || $this->uri->segment(1)=='shareholders' || $this->uri->segment(1)=='shareholdersmobile' )echo 'active' ?>">
              <a href="#" class="dropdown-toggle <?php if($this->uri->segment(1)=='feed_view')echo 'class="active"' ?>" data-toggle="dropdown" role="button" aria-expanded="false">Images &amp; Videos <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url('uploads') ?>">Website Uploads</a></li>
                <li><a href="<?php echo base_url('uploadsmobile') ?>">Mobile Apps Uploads</a></li>
                <li><a href="<?php echo base_url('shareholders') ?>">Website Shareholders</a></li>
                <li><a href="<?php echo base_url('shareholdersmobile') ?>">Mobile Shareholders</a></li>
              </ul>
            </li>
			<li <?php if($this->uri->segment(1)=='bookmakers')echo 'class="active"' ?>><a href="<?php echo base_url('bookmakers') ?>">Bookmakers</a></li>
            <li <?php if($this->uri->segment(1)=='members')echo 'class="active"' ?>><a href="<?php echo base_url('members') ?>">Members</a></li>
            <li <?php if($this->uri->segment(1)=='competitions')echo 'class="active"' ?>><a href="<?php echo base_url('competitions') ?>">Competitions</a></li>
            <li <?php if($this->uri->segment(1)=='reports')echo 'class="active"' ?>><a href="<?php echo base_url('reports') ?>">Reports</a></li>
            <li <?php if($this->uri->segment(1)=='alerts')echo 'class="active"' ?>><a href="<?php echo base_url('alerts') ?>">Alerts</a></li>
            <li <?php if($this->uri->segment(1)=='faqs')echo 'class="active"' ?>><a href="<?php echo base_url('faqs') ?>">Faq</a></li>
            <li <?php if($this->uri->segment(1)=='presenters')echo 'class="active"' ?>><a href="<?php echo base_url('presenters') ?>">Presenters</a></li>
            <li <?php if($this->uri->segment(1)=='admin'|| $this->uri->segment(2)=='register')echo 'class="active"' ?>><a href="<?php echo base_url('admin') ?>">Admins</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            	<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <span class="fa fa-user fa-fw"></span> <?php echo $this->tank_auth->get_username();?> <span class="fa fa-caret-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url('auth/change_password') ?>">Change Password</a>
                        </li>
                        <li><a href="<?php echo base_url('auth/change_email') ?>">Change Email</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('auth/logout') ?>">Logout</a>
                        </li>
                    </ul>
                </li>
          </ul>
      </div>
    </nav>
<?php if($this->session->flashdata('message')!=''):?>
<div class="container">
	<div class="row">
    	<div class="col-xs-12">
			<div class="alert alert-success" role="alert">
				<?php echo $this->session->flashdata('message'); ?>
			</div>
		</div>
	</div>
</div>
<?php endif;?>
<?php if($this->session->flashdata('error_message')!=''):?>
<div class="container">
	<div class="row">
    	<div class="col-xs-12">
			<div class="alert alert-danger" role="alert">
				<?php echo $this->session->flashdata('error_message'); ?>
			</div>
		</div>
	</div>
</div>
<?php endif;?>
