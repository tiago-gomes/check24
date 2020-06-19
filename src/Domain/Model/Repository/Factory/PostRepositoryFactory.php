<?php

namespace App\Domain\Model\Repository\Factory;

use App\Core\Service\Contract\FactoryInterface;
use App\Domain\Model\Repository\PostRepository;
use Psr\Container\ContainerInterface;

class PostRepositoryFactory implements FactoryInterface
{
    /**
     * Account Repository
     *
     * @param ContainerInterface $container
     *
     * @return PostRepository
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function service(ContainerInterface $container)
    {
        return (new PostRepository())->setEntityManager($container->get('doctrine.orm.entity_manager'));
    }
}
