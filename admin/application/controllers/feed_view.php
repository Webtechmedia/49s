<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Feed_view extends MX_Controller
{

	function index($sub_page = '')
	{
		$data['title'] = 'Results Data';

		$this->template->add_js('js/admin_feed.js');

		$data['content_module']=modules::run('admin_feed_view/index');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'content/cms_empty_canvas',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	function numbers_49()
	{
		$data['title'] = '49s';

		$this->template->add_js('js/admin_feed.js');

		$data['content_module']=modules::run('admin_feed_view/numbers_49');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'content/cms_empty_canvas',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	function numbers_lucky()
	{
		$data['title'] = 'Irish Lotto';

		$this->template->add_js('js/admin_feed.js');

		$data['content_module']=modules::run('admin_feed_view/numbers_lucky');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'content/cms_empty_canvas',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	function numbers_rapido()
	{
		$data['title'] = 'Rapido';

		$this->template->add_js('js/admin_feed.js');

		$data['content_module']=modules::run('admin_feed_view/numbers_rapido');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'content/cms_empty_canvas',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	function virtual_horse_race()
	{
		$data['title'] = 'Horse Racing';

		$this->template->add_js('js/admin_feed.js');

		$data['content_module']=modules::run('admin_feed_view/virtual_horse_race');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'content/cms_empty_canvas',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	function edit49($id = 0)
	{
		$data = array();
		$data['id'] = $id;
		$data['title'] = 'Horse Racing';

		$this->template->add_js('js/admin_feed.js');

		$data['content_module']=modules::run('admin_feed_view/edit49',$data);

		//$this->template->write_view('head', 'common/head',$data);
		//$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'content/cms_empty_canvas',$data);
		//$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	function editrace($id = 0)
	{
		$data = array();
		$data['id'] = $id;
		$data['title'] = 'Horse Racing';

		$this->template->add_js('js/admin_feed.js');

		$data['content_module']=modules::run('admin_feed_view/editrace',$data);

		//$this->template->write_view('head', 'common/head',$data);
		//$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'content/cms_empty_canvas',$data);
		//$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	function virtual_dog_race()
	{
		$data['title'] = 'Dog Racing';

		$this->template->add_js('js/admin_feed.js');

		$data['content_module']=modules::run('admin_feed_view/virtual_dog_race');

		$this->template->write_view('head', 'common/head',$data);
		$this->template->write_view('header', 'common/header',$data);
		$this->template->write_view('content', 'content/cms_empty_canvas',$data);
		$this->template->write_view('footer', 'common/footer',$data);

		$this->template->set_master_template('templates/one_column_layout');
		$this->template->render();
	}

	function number_49_draw($game_type = '', $year = 0, $month = 0, $day = 0)
	{
		$data = array();
		$data['year'] = $year;
		$data['day'] = $day;
		$data['month'] = $month;
		$data['game_type'] = $game_type;

		//var_dump($data);
		$data['content_module']=modules::run('admin_feed_view/draw_49' , $data);

		echo($data['content_module']);
	}

	function race_show($game_type = '', $year = 0, $month = 0, $day = 0)
	{
		$data = array();
		$data['year'] = $year;
		$data['month'] = $month;
		$data['day'] = $day;
		$data['game_type'] = $game_type;
		//var_dump($data);
		$data['content_module']=modules::run('admin_feed_view/race_show' , $data);

		echo($data['content_module']);
	}



}
