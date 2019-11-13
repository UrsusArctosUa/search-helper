<?php

namespace UrsusArctosUA\SearchHelper\Doctrine;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use LogicException;
use UrsusArctosUA\SearchHelper\Condition;
use UrsusArctosUA\SearchHelper\Filter;
use UrsusArctosUA\SearchHelper\Finder as FinderInterface;
use UrsusArctosUA\SearchHelper\Order;
use UrsusArctosUA\SearchHelper\Params;

class Finder implements FinderInterface
{
    /**
     * @var ManagerRegistry
     */
    private $registry;

    /**
     * Finder constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param string|EntityRepository $class
     * @param Params $params
     *
     * @return mixed
     */
    public function search($class, Params $params): iterable
    {
        $repository = $this->repository($class);
        $alias = uniqid('e');
        $builder = $repository->createQueryBuilder($alias);

        $this->filter($builder, $repository, $alias, $params->filters());
        $this->order($builder, $repository, $alias, $params->orders());
        $builder->setMaxResults($params->limit())
            ->setFirstResult($params->offset());

        $query = $builder->getQuery();

        return $query->getResult();
    }

    /**
     * @param string|EntityRepository $class
     * @param Params $params
     *
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function count($class, Params $params): int
    {
        $repository = $this->repository($class);
        $alias = uniqid('e');
        $builder = $repository->createQueryBuilder($alias);
        $builder->select("count($alias.id)");// we need count here, not an object

        $this->filter($builder, $repository, $alias, $params->filters());

        $query = $builder->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * @param $class
     *
     * @return ObjectRepository|EntityRepository
     */
    private function repository($class)
    {
        if ($class instanceof EntityRepository) {
            $repository = $class;
        } else {
            $em = $this->registry->getManagerForClass($class);
            $repository = $em->getRepository($class);
        }
        if (!($repository instanceof EntityRepository)) {
            throw new LogicException("Only EntityRepository supported");
        }

        return $repository;
    }

    /**
     * @param QueryBuilder $builder
     * @param EntityRepository $repo
     * @param string $alias
     * @param iterable<Filter> $filters
     */
    private function filter(
        QueryBuilder $builder,
        EntityRepository $repo,
        string $alias,
        iterable $filters
    ) {
        /** @var Filter $filter */
        foreach ($filters as $filter) {
            $method = "addFilterBy{$this->transform($filter->name(), true)}";

            $property = $this->transform($filter->name());
            if (method_exists($repo, $method)) {
                $builder = $repo->$method($builder, $filter->value(), $alias);
            } else {
                /**
                 * @todo check if property exists
                 */
                $eBuilder = $builder->expr();
                /** @var Condition $condition */
                foreach ($filter->conditions() as $condition) {
                    $parameter = uniqid('p');
                    $name = $condition->name();
                    $expr = $eBuilder->$name("$alias.$property", ":$parameter");
                    $builder->setParameter($parameter, $condition->value());
                    $builder->andWhere($expr);
                }
            }
        }
    }

    /**
     * @param QueryBuilder $builder
     * @param EntityRepository $repo
     * @param string $alias
     * @param iterable $orders
     */
    private function order(
        QueryBuilder $builder,
        EntityRepository $repo,
        string $alias,
        iterable $orders
    ) {
        /** @var Order $order */
        foreach ($orders as $order) {
            $method = "addOrderBy{$this->transform($order->name(), true)}";
            $property = $this->transform($order->name());
            if (method_exists($repo, $method)) {
                $builder = $repo->$method($builder, $order->direction(), $alias);
            } else {
                /**
                 * @todo check if property exists
                 */
                $builder->orderBy("$alias.$property", $order->direction());
            }
        }
    }

    /**
     * @param string $key
     * @param bool $first
     *
     * @return string
     */
    private function transform(string $key, bool $first = false): string
    {
        $str = str_replace('_', '', ucwords($key, '_'));

        if (!$first) {
            $str = lcfirst($str);
        }

        return $str;
    }
}