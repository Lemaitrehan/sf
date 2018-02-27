<?php

namespace App\Controller;

use App\Entity\Info;
use App\Form\InfoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Logistics;
use App\Form\LogisticsType;

class LogisticsController extends Controller
{

    /**
     * @Route("/admin/logistics/index", name="admin_logistics_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $logistics = $this->getDoctrine()->getRepository(Logistics::class)->findAll();

        return $this->render('logistics/index.html.twig', [
            'logistics' => $logistics
        ]);
    }

    /**
     * @Route("/admin/logistics/create/{id}", name="admin_logistics_create", defaults={"id"=0})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request, $id)
    {
        if($id == 0) {
            $logistics = new Logistics();
        } else {
            $logistics = $this->getDoctrine()->getRepository(Logistics::class)->find($id);
        }

        $form = $this->createForm(LogisticsType::class, $logistics);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $logistics = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($logistics);
            $em->flush();

            return $this->redirectToRoute('admin_logistics_index');
        }

        return $this->render('logistics/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/logistics/info", name="admin_logistics_info")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function info()
    {
        $info = $this->getDoctrine()->getRepository(Info::class)->findAll();
        return $this->render('logistics/info.html.twig', [
            'info' => $info
        ]);
    }

    /**
     * @Route("/admin/logistics/info/create/{id}", name="admin_logistics_info_create", defaults={"id"=0})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function infoCreateAction(Request $request, $id)
    {
        if($id == 0) {
            $info = new Info();
        } else {
            $info = $this->getDoctrine()->getRepository(Info::class)->find($id);
        }

        $form = $this->createForm(InfoType::class, $info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $info = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($info);
            $em->flush();

            return $this->redirectToRoute('admin_logistics_info');
        }

        return $this->render('logistics/info_create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}