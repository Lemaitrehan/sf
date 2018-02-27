<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Payment;
use App\Form\PaymentType;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends Controller
{

    /**
     * @Route("/admin/payment/index", name="admin_payment_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $payment = $this->getDoctrine()->getRepository(Payment::class)->findAll();

        return $this->render('payment/index.html.twig', [
            'payment' => $payment
        ]);
    }

    /**
     * @Route("/admin/payment/create/{id}", name="admin_payment_create", defaults={"id"=0})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, $id)
    {
        if($id === 0) {
            $payment = new Payment();
        } else {
            $payment = $this->getDoctrine()->getRepository(Payment::class)->find($id);
        }

        $form = $this->createForm(PaymentType::class, $payment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $payment = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();

            return $this->redirectToRoute('admin_payment_index');
        }

        return $this->render('payment/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}