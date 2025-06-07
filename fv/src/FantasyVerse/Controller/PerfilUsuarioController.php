<?php

namespace Fv\FantasyVerse\Controller;

use Fv\FantasyVerse\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PerfilUsuarioController extends AbstractController
{
    #[Route('/perfil', name: 'perfil_usuario')]
    public function perfil(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $usuario = $this->getUser();

        if (!$usuario) {
            throw $this->createAccessDeniedException();
        }

        if ($request->isMethod('POST')) {
            $usuario->setNombre($request->request->get('nombre'));
            $usuario->setCorreo($request->request->get('correo'));

            $rawPassword = $request->request->get('password');
            if (!empty($rawPassword)) {
                $hashedPassword = $hasher->hashPassword($usuario, $rawPassword);
                $usuario->setPassword($hashedPassword);
            }
            
            if ($this->isGranted('ROLE_ADMIN')) {
                $usuario->setRoles([$request->request->get('rol')]);
            }

            $em->persist($usuario);
            $em->flush();

            $this->addFlash('success', '✅ Perfil actualizado correctamente.');
            return $this->redirectToRoute('perfil_usuario');
        }

        return $this->render('usuario/perfil.html.twig', [
            'usuario' => $usuario,
            'admin' => false
        ]);
    }
}
