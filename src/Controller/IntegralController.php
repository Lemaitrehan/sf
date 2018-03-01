<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Integral;
use App\Form\IntegralType;
use Symfony\Component\HttpFoundation\Request;

class IntegralController extends Controller
{
    /**
     * @Route("/admin/integral/index", name="admin_integral_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $integral = $this->getDoctrine()->getRepository(Integral::class)->findAll();

        return $this->render('integral/index.html.twig', [
            'integral' => $integral
        ]);
    }

    /**
     * @Route("/admin/integral/create/{id}", name="admin_integral_create", defaults={"id"=0})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, $id)
    {
        if($id == 0) {
            $integral = new Integral();
        } else {
            $integral = $this->getDoctrine()->getRepository(Integral::class)->find($id);
        }

        $form = $this->createForm(IntegralType::class, $integral);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $integral = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($integral);
            $em->flush();

            return $this->redirectToRoute('admin_integral_index');
        }

        return $this->render('integral/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}