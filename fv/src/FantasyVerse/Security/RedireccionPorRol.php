<?php

namespace Fv\FantasyVerse\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class RedireccionPorRol implements AuthenticationSuccessHandlerInterface
{
    public function __construct(private RouterInterface $router) {}

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        $usuario = $token->getUser();
        $roles = $usuario->getRoles();

        if (in_array('ROLE_ADMIN', $roles, true)) {
            return new RedirectResponse($this->router->generate('ruta_admin'));
        }

        if (in_array('ROLE_INVITADO', $roles, true)) {
            return new RedirectResponse($this->router->generate('ruta_invitado'));
        }

        return new RedirectResponse($this->router->generate('ruta_usuario'));
    }
}
