<?php
class RegisterController extends Controller {

    public function __construct($db) {
    }


    public function index()
    {
        $this->render('login/index', [], false);
    }
    public function create()
    {
        $this->render('login/index', [], false);
    }


}