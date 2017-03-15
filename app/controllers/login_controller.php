<?php

class LoginController extends AppController
{
    public function index()
    {
        if (Session::get('user')) {
            $this->redirect(url('user/index'));
        }
    }
}