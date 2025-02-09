<?php

class AdminController extends Controller {
    public function index() {
        $this -> view('admin/index');
    }

    public function manageUsers() {
        $this -> view('admin/manageUsers');
    }

    public function manageSongs() {
        $this -> view('admin/manageSongs');
    }
}
