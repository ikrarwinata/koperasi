<?php

namespace App\Controllers;

class Home extends BaseController
{
	protected function onLoad(){
	}

	public function languange($rdr = NULL){
		$this->setLocale();
		return $this->index($rdr);
	}
	
	public function index($rdr = NULL)
	{
		$this->getLocale();
		$rdr = ($rdr == NULL ? urldecode($this->request->getGetPost("redirect")) : urldecode($rdr));
		if($rdr!=NULL){
			return redirect()->to("/".base64_decode($rdr));
		}

		return view('welcome_message');
	}
}
