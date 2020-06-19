<?php

namespace App\Domain\Model\Repository\Factory;

use App\Core\Service\Contract\FactoryInterface;
use App\Domain\Model\Repository\UserRepository;
use Psr\Container\ContainerInterface;

class UserRepositoryFactory implements FactoryInterface
{
    /**
     * Account Repository
     *
     * @param ContainerInterface $container
     *
     * @return UserRepository
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function service(ContainerInterface $container)
    {
        return (new UserRepository())->setEntityManager($container->get('doctrine.orm.entity_manager'));
    }
}
