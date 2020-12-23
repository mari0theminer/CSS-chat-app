<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserCommand extends Command
{
    protected static $defaultName = 'app:adminUser';

    protected function configure()
    {
        $this
            ->setDescription('Create a Super Admin User')
        ;
    }
    public function __construct(string $name = null,EntityManagerInterface  $em,UserPasswordEncoderInterface $encoder )
    {
        $this->em =$em;
        $this->encoder =$encoder;
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $name= 'admin_' . md5(random_bytes(3));
        $io->comment('set name to' .$name);
        $pw =  md5(random_bytes(10));
        $io->comment('set pw to' .$pw);
        $io->info('create user');
        $User =new User();
        $User->setEmail($name . '@email.com');
        $User->setUsername($name );
        $User->setRoles(['ROLE_SUPER_ADMIN'] );
        $encoded = $this->encoder->encodePassword($User, $pw);

        $User->setPassword($encoded);
        $io->info('save in to DB');
        $this->em->persist($User);
        $this->em->flush();
        $io->success('You have create a Super admin User Name:'.$name.'   pw:'.$pw);

        return Command::SUCCESS;
    }
}
