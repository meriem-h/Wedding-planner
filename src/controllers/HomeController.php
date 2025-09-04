<?php
class HomeController  extends Controller {

    public function __construct($db) {
    }

    // Récupérer tous les users
    public function index()
    {
        $this->render('home/index', []);
    }


}