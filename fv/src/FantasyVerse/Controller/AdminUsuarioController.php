<?php

namespace Fv\FantasyVerse\Controller;

use Fv\FantasyVerse\Entity\Usuario;
use Fv\FantasyVerse\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[Route('/admin/usuarios')]
class AdminUsuarioController extends AbstractController
{
    #[Route('', name: 'admin_usuarios')]
    public function index(UsuarioRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/usuarios/listaUsuarios.html.twig', [
            'usuarios' => $repo->findAll(),
        ]);
    }

    #[Route('/editar/{id}', name: 'admin_editar_usuario')]
    public function editar(Usuario $usuario, Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($request->isMethod('POST')) {
            $usuario->setNombre($request->request->get('nombre'));
            $usuario->setCorreo($request->request->get('correo'));
            $usuario->setRoles([$request->request->get('rol')]);

            $password1 = $request->request->get('password');
            $password2 = $request->request->get('password2');

            if (!empty($password1) || !empty($password2)) {
                if ($password1 !== $password2) {
                    return $this->render('usuario/perfil.html.twig', [
                        'usuario' => $usuario,
                        'admin' => true,
                        'error_contraseña' => 'Las contraseñas no coinciden.'
                    ]);
                }

                $hashedPassword = $hasher->hashPassword($usuario, $password1);
                $usuario->setPassword($hashedPassword);
            }

            $em->flush();
            $this->addFlash('success', '✅ Usuario actualizado correctamente.');
            return $this->redirectToRoute('admin_usuarios');
        }

        return $this->render('usuario/perfil.html.twig', [
            'usuario' => $usuario,
            'admin' => true,
        ]);
    }

    #[Route('/nuevo', name: 'admin_nuevo_usuario')]
    public function nuevo(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $usuario = new Usuario();

        if ($request->isMethod('POST')) {
            $usuario->setNombre($request->request->get('nombre'));
            $usuario->setCorreo($request->request->get('correo'));
            $usuario->setRoles([$request->request->get('rol')]);

            $password1 = $request->request->get('password');
            $password2 = $request->request->get('password2');

            if (empty($password1) || empty($password2)) {
                return $this->render('usuario/perfil.html.twig', [
                    'usuario' => $usuario,
                    'admin' => true,
                    'error_contraseña' => 'Debes introducir y confirmar una contraseña.'
                ]);
            }

            if ($password1 !== $password2) {
                return $this->render('usuario/perfil.html.twig', [
                    'usuario' => $usuario,
                    'admin' => true,
                    'error_contraseña' => 'Las contraseñas no coinciden.'
                ]);
            }

            $hashedPassword = $hasher->hashPassword($usuario, $password1);
            $usuario->setPassword($hashedPassword);

            $em->persist($usuario);
            $em->flush();

            $this->addFlash('success', '✅ Usuario creado');
            return $this->redirectToRoute('admin_usuarios');
        }

        return $this->render('usuario/perfil.html.twig', [
            'usuario' => $usuario,
            'admin' => true
        ]);
    }

}
