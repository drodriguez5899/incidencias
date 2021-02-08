<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Incidencia;

/**
 * Description of IncidenciaController
 *
 * @author David
 */
class IncidenciaController extends AbstractController {
    /**
     * @Route("/incidencias", name="incidencias")
     */
    public function index(): Response {
        $repositorio = $this->getDoctrine()->getRepository(Incidencia::class);
        $incidencias = $repositorio->findAll();
        return $this->render('incidencia/index.html.twig',
                        ['incidencias' => $incidencias]);
    }
    //put your code here
}
