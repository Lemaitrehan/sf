<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/admin/product/index", name="admin_product_index")
     */
    public function indexAction()
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('product/index.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/admin/product/create/{id}", name="admin_product_create", defaults={"id"=0})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, $id)
    {
        if($id ==0) {
            $product = new Product();
        }else{
            $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        }

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $product = $form->getData();

           $em = $this->getDoctrine()->getManager();
           $em->persist($product);
           $em->flush();

           return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('product/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}