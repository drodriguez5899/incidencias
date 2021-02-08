<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Usuario;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class UsuarioController extends AbstractController
{
    /**
     * @Route("/registrar", name="registrar")
     */
    public function registrar(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $usuario = new Usuario();
        $form = $this->createFormBuilder($usuario)
                ->add('email', TextType::class)
                ->add('password', PasswordType::class,['attr' => ['minlength' => 4]])
                ->add('nombre', TextType::class)
                ->add('apellidos', TextType::class)
                ->add('telefono', TextType::class)
                ->add('foto', FileType::class, [
                    'label' => 'Selecciona foto',
                    'constraints' => [
                        new File([
                            'maxSize' => '1024k',
                            'mimeTypes' => [
                                'image/jpeg',
                                'image/png',
                                'image/gif'
                            ],
                            'mimeTypesMessage' => 'Formato de archivo no válido',
                                ])
                    ]
                ])
                ->add('registrar', SubmitType::class, ['label' => 'Registrar'])
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $usuario = $form->getData();
            $foto = $form->get('foto')->getData();
            
            if ($foto) {
                
                $nuevo_nombre = uniqid() . '.' . $foto->guessExtension();

                try {
                    $foto->move('imagenes/',$nuevo_nombre);
                    $usuario->setFoto($nuevo_nombre);
                } catch (FileException $e) {
                    
                }
            }

            //Codificamos el password
            $usuario->setPassword($encoder->encodePassword($usuario, $usuario->getPassword()));
            
            //Guardamos el nuevo artículo en la base de datos
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('inicio');
        }
        
        return $this->render('usuario/registrar.html.twig',
                        ['form' => $form->createView()]);
    }
}
