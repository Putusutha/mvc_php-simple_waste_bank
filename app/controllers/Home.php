<?php

class Home extends Controller {
    public function index() {
        $this->view('templates/headers/HeaderHome');
        $this->view('home/index');
        $this->view('templates/footers/FooterHome');
    }
}
