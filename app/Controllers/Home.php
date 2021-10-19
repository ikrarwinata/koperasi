<?php

namespace App\Controllers;

use App\Models\Kelola_nasabah_model;
use App\Models\User_model;

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

		if (session()->has("keepalive")) {
			if (session("keepalive") == 1) {
				if (session()->has("username") && session()->has("password")) {
					if (session("username") != NULL && session("password") != NULL) {
						return $this->login_auth(session("username"), session("password"));
					}
				}
			}
		}

		return $this->login();
	}

	public function login()
	{
		$this->getLocale();
		return view('login', array('Page' => $this->PageData));
	}
	public function login_auth($username = NULL, $password = NULL)
	{
		$this->getLocale();
		if ($username == NULL) $username = $this->request->getPost("username");
		if ($password == NULL) $password = md5(trim($this->request->getPost("password")));

		$user = new User_model();

		$account = $user->where(array('username' => $username, 'password' => $password))->first();

		if ($account) {
			$sess = (array) $account;
			if ($this->request->getPost("keepalive") == 1) $sess["keepalive"] = 1;
			$sess['level'] = $sess['hak_akses'];
			session()->set($sess);
			switch ($sess['hak_akses']) {
				case 'Administrator':
					return redirect()->to("/Administrator/Dashboard");
					break;
				case 'Superadministrator':
					return redirect()->to("/Superadministrator/Dashboard");
					break;
				case 'Nasabah':
					$nasbahah = new Kelola_nasabah_model();
					$s = $nasbahah->select("id_nasabah, id_jenissimpanpinjam")->where("username", $username)->first();
					session()->set("id_nasabah", $s->id_nasabah);
					session()->set("id_jenissimpanpinjam", $s->id_jenissimpanpinjam);
					return redirect()->to("/Nasabah/Dashboard");
					break;
				default:
					session()->setFlashdata('ci_login_flash_message', 'Terjadi kesalahan saat login, Hak Akses tidak diketahui.');
					session()->setFlashdata('ci_login_flash_message_type', 'warning');
					return redirect()->to("/Home/login");
					break;
			}
		} else {
			session()->setFlashdata('ci_flash_login_message', 'Username atau password yang anda masukan salah');
			session()->setFlashdata('ci_flash_login_message_type', 'error');
			return redirect()->to("/Home/login");
		}
	}

	public function logout()
	{
		$this->getLocale();
		$user = new User_model();
		$sess = (array) $user->getFields();
		$sess[] = "level";
		session()->remove($sess);
		return $this->login();
	}
}
