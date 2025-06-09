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

            $password1 = $request->request->get('password');
            $password2 = $request->request->get('password2');

            if (!empty($password1) || !empty($password2)) {
                if ($password1 !== $password2) {
                    return $this->render('usuario/perfil.html.twig', [
                        'usuario' => $usuario,
                        'admin' => $this->isGranted('ROLE_ADMIN'),
                        'error_contraseña' => 'Las contraseñas no coinciden.'
                    ]);
                }

                $hashedPassword = $hasher->hashPassword($usuario, $password1);
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
