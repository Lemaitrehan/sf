<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/admin/user", name="admin_user")
     */
    public function userAction()
    {
        return $this->render("admin/user.html.twig");
    }

    /**
     * @Route("/admin/order", name="admin_order")
     */
    public function orderAction()
    {
        return $this->render("admin/order.html.twig");
    }
}