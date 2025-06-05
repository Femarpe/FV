<?php

namespace Fv\FantasyVerse\Command;

use Fv\FantasyVerse\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:crear-usuario',
    description: 'Crea un usuario con correo, contraseña y rol (admin|usuario|invitado)',
)]
class CrearUsuarioCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('correo', InputArgument::REQUIRED, 'Correo electrónico');
        $this->addArgument('contraseña', InputArgument::REQUIRED, 'Contraseña');
        $this->addArgument('rol', InputArgument::REQUIRED, 'Rol: admin | usuario | invitado');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $correo = $input->getArgument('correo');
        $password = $input->getArgument('contraseña');
        $rol = strtoupper('ROLE_' . $input->getArgument('rol'));

        $usuario = new Usuario();
        $usuario->setCorreo($correo);
        $usuario->setRoles([$rol]);
        $usuario->setPassword($this->hasher->hashPassword($usuario, $password));

        $this->em->persist($usuario);
        $this->em->flush();

        $output->writeln("Usuario {$correo} creado con rol {$rol}");

        return Command::SUCCESS;
    }
}
