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
use App\Entity\Cliente;




class ClienteController extends AbstractController {
    
     /**
     * @Route("/clientes", name="clientes")
     */
     public function index(): Response {
        $repositorio = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $repositorio->findAll();
        return $this->render('cliente/clientes.html.twig',
                        ['clientes' => $clientes]);
    }
    /**
     * @Route("/ver_cliente/{id}", name="ver_cliente", requirements={"id"="\d+"})
     * @param int $id
     */
    public function ver(Cliente $cliente) {
        /*
         * $repositorio = $this->getDoctrine()->getRepository(Articulo::class);
          $articulo = $repositorio->find($id);
         * 
         */
        return $this->render('cliente/ver_cliente.html.twig',
                        ['cliente' => $cliente]);
    }
    
    
    //put your code here
}
