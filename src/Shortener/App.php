<?php
namespace Shortener;

use Shortener\Models\Url;
use Shortener\Models\Hit;
use Pecee\SimpleRouter\SimpleRouter as Router;

class App {
	public function __construct()
	{
		$this->checkIP();
		date_default_timezone_set("Europe/Riga");
		$this->setRoutes();
	}
	
	public function isJson()
	{
		header('Content-Type: application/json');
	}
	
	public function addUrl()
	{
		header('Content-Type: text/plain');
		echo (new Url)->addNew();
	}
	
	public function checkIP() {}

	public function redirect($uri='')
	{
		if(empty($uri)) return;
		header("Location: " . $uri);
	}

	public function _resave()
	{
		$list = (new Url)->getRecords();
		
		foreach($list as $key => $obj) {
			(new Url)->save((array) $obj, $obj->id);
		}
	}
	
	// routes
	public function setRoutes() {

		Router::get('/{code}', function ($code) {
			$goUrl = (new Url)->getRecords(['code'=>$code], ['url', 'id'], 1);
			$aliasUrl = (new Url)->getRecords(['alias'=>$code], ['url', 'id'], 1);
			
			if($goUrl) {
				new Hit($goUrl[0]->id);
				$this->redirect($goUrl[0]->url);
			}
			else if($aliasUrl) {
				new Hit($aliasUrl[0]->id);
				$this->redirect($aliasUrl[0]->url);
			}
			else $this->redirect('/');
			
		})->where(['code'=>'[A-Za-z]+']);

		Router::get('/', function () {
			include_once 'front.php';
			return '';
		});

	}
	
	public function run()
	{
		// output
		Router::start();
	}
};
