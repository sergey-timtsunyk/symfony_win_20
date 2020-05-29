<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\Security\PasswordGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SetUserPasswordCommand extends Command
{
    private const ARG_USER_ID = 'user_id';
    private const OPT_PASS = 'password';

    protected static $defaultName = 'app:set_user_password';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var PasswordGenerator
     */
    private $passwordGenerator;

    /**
     * SetUserPasswordCommand constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
     * @param PasswordGenerator $passwordGenerator
     */
    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository, PasswordGenerator $passwordGenerator)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->passwordGenerator = $passwordGenerator;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Add password to user')
            ->addArgument(self::ARG_USER_ID, InputArgument::REQUIRED, 'User id')
            ->addOption(self::OPT_PASS, 'p', InputOption::VALUE_REQUIRED, 'Password for user')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $userId = $input->getArgument(self::ARG_USER_ID);
        $user = $this->userRepository->find($userId);

        if (!$user instanceof User) {
            $io->error(sprintf('Not fount user by user id: %s', $userId));

            return 0;
        }

        $pass = $input->getOption(self::OPT_PASS);

        $hash = $this->passwordGenerator->generatorHash($pass);
        $user->setPassword($hash);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        if ($hash) {
            $io->note(sprintf('You passed user id: %s', $userId));
            $io->note(sprintf('You passed pass: %s', $pass));
            $io->note(sprintf('You hash for user: %s', $hash));
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
