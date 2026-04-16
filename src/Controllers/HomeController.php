<?php

declare(strict_types=1);

namespace App\Controllers;


use Framework\Controller\AbstractController;

class HomeController extends AbstractController

{
    public function index()
    {
        return $this->render('home/index');
    }
    public function about()
    {
        return $this->render('home/about');
    }
    public function contact()
    {
        return $this->render('home/contact');
    }
    public function login()
    {
        return $this->render('home/login');
    }
    public function register()
    {
        return $this->render('home/register');
    }

}