<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller
{

	public function loginAction($data = [])
	{
		if (sizeof($data)) {
			$user = $this->model->find($data['login'], $data['password']);
			if (!$user) $this->view->redirect('/login?code=error');
			@$_SESSION['user'] = $user;
			$this->view->redirect('/?success=login');
		} else {
			if (@$_SESSION['user']) $this->view->redirect('/');
			$this->view->render('Авторизация');
		}
	}

	public function logoutAction()
	{
		session_destroy();
		$this->view->redirect('/');
	}
}
