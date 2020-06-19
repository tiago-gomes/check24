<?php

namespace App\Domain\Model\Repository\Factory;

use App\Core\Service\Contract\FactoryInterface;
use App\Domain\Model\Repository\CommentRepository;
use Psr\Container\ContainerInterface;

class CommentRepositoryFactory implements FactoryInterface
{
    /**
     * Account Repository
     *
     * @param ContainerInterface $container
     *
     * @return CommentRepository
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function service(ContainerInterface $container)
    {
        return (new CommentRepository())->setEntityManager($container->get('doctrine.orm.entity_manager'));
    }
}
