<?php

namespace AppBundle\Security\User;

use AppBundle\Security\User\WebserviceUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

class WebserviceUserProvider implements UserProviderInterface
{
    private $logger;
    private $connection;

    public function __construct(Connection $dbalConnection, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->connection = $dbalConnection;
    }

    public function loadUserByUsername($username)
    {
        $user = $this->findBy(array("username" => $username));
        if (!$user) {
            throw new UsernameNotFoundException(sprintf('No user with name "%s" was found.', $username));
        }

        return $user;

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return WebserviceUser::class === $class;
    }
}
