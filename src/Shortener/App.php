<?php
namespace Shortener;

use Exception;
use Pecee\Http\Exceptions\MalformedUrlException;
use Pecee\SimpleRouter\Exceptions\HttpException;
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
	
	public function addUrl()
	{
		header('Content-Type: text/plain');
		echo (new Url)->addNew();
	}
	
	public function checkIP() {}

	public function redirect($uri='')
	{
		if(empty($uri)) {
            return;
        }
		header("Location: " . $uri);
	}
	
	// routes
	public function setRoutes() {
        try {
            Router::get('/{code}', function ($code) {
                $goUrl = (new Url)->getRecords(['code' => $code], ['url', 'id'], 1);
                $aliasUrl = (new Url)->getRecords(['alias' => $code], ['url', 'id'], 1);
                
                if ($goUrl) {
                    new Hit($goUrl[0]->id);
                    $this->redirect($goUrl[0]->url);
                } elseif ($aliasUrl) {
                    new Hit($aliasUrl[0]->id);
                    $this->redirect($aliasUrl[0]->url);
                } else {
                    $this->redirect('/');
                }
            })->where(['code' => '[A-Za-z0-9]+']);
        } catch (MalformedUrlException $e) {
        }
        
        try {
            Router::get('/', static function () {
                include_once 'front.php';
                return '';
            });
        } catch (MalformedUrlException $e) {
        }
    }
	
	public function run()
	{
		// output
        try {
            Router::start();
        } catch (MalformedUrlException $e) {
        } catch (HttpException $e) {
        } catch (Exception $e) {
        }
    }
}
