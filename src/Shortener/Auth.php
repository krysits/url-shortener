<?php
namespace Shortener;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;
use Shortener\Models\User;

class Auth implements IMiddleware{
	
	public $uid;
	public $sid;
	
	public function handle(Request $request) {

		if(isset($_SESSION['sid'])) $this->sid = $_SESSION['sid'];

		if(isset($_SESSION['uid'])) {
			$this->uid = $_SESSION['uid'];
		}
		
		$request->user = (new User)->getRecord($this->uid, 'uid');

		// If authentication failed, redirect request to user-login page.
		if($request->user === null) {
			$request->setRewriteUrl('/');
		}
	}
	public function setUp($uid = '')
	{
		if(empty($uid)) {
			return false;
		}
		
		$_SESSION['uid'] = $uid;
		$_SESSION['sid'] = session_id();
	}
}