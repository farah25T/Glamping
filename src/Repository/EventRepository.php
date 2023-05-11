<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function save(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function tonight(): ?Event
    {
        $currentDate = new \DateTime();
        $date = $currentDate->format('Y-m-d');
        return $this->createQueryBuilder('e')
            ->andWhere('e.date_debut = :date')
            ->setParameter('date', $date)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function thisWeek(): ?Event
    {
        $currentDate = new \DateTime();
        $date_inf = $currentDate->sub(new \DateInterval('P4D'))->format('Y-m-d');
        $date_sup = $currentDate->add(new \DateInterval('P4D'))->format('Y-m-d');
        return $this->createQueryBuilder('e')
            ->andWhere('e.date_debut >= :date_inf')
            ->andWhere('e.date_debut < :date_sup')
            ->setParameter('date_inf', $date_inf)
            ->setParameter('date_sup', $date_sup)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function NextWeek(): ?Event
    {
        $currentDate = new \DateTime();
        $date_inf = $currentDate->add(new \DateInterval('P7D'))->format('Y-m-d');
        return $this->createQueryBuilder('e')
            ->andWhere('e.date_debut >= :date_inf')
            ->setParameter('date_inf', $date_inf)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findMaxNbrGuests(): ?int
    {
        $qb = $this->createQueryBuilder('e')
            ->select('MAX(e.nbr_guests_max) as max_guests');

        $result = $qb->getQuery()->getOneOrNullResult();

        return $result['max_guests'];
    }

    public function findTopEventOfYear2023(): ?Event
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.users', 'eu')
            ->andWhere("e.date_debut >= '2023-01-01' ")
            ->andWhere("e.date_debut <=  '2023-12-31'")
            ->groupBy('e')
            ->orderBy('COUNT(eu.id)', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findTopEventOfYear2022(): ?Event
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.users', 'eu')
            ->andWhere("e.date_debut >= '2022-01-01' ")
            ->andWhere("e.date_debut <=  '2022-12-31'")
            ->groupBy('e')
            ->orderBy('COUNT(eu.id)', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findTopEventOfYear2021(): ?Event
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.users', 'eu')
            ->andWhere("e.date_debut >= '2021-01-01' ")
            ->andWhere("e.date_debut <=  '2021-12-31'")
            ->groupBy('e')
            ->orderBy('COUNT(eu.id)', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }






    //    /**
    //     * @return Event[] Returns an array of Event objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Event
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function GetFilter_SortQueryBuilder(array $queryparams): QueryBuilder
    {

        $qb = $this->createQueryBuilder('event');
        if (array_key_exists('Search', $queryparams)) {

            $qb->andWhere('event.name LIKE :word')
                ->setParameter('word', '%' . $queryparams['Search'] . '%');
        }
        if (array_key_exists('minPrice', $queryparams)) {
            $MinPrice = (int)$queryparams['minPrice'];
            $qb->andWhere('event.price >= :price')
                ->setParameter('price', $MinPrice);
        }
        if (array_key_exists('maxPrice', $queryparams)) {
            $MaxPrice = (int)$queryparams['maxPrice'];
            $qb->andWhere('event.price <= :price')
                ->setParameter('price', $MaxPrice);
        }
        if (array_key_exists('location', $queryparams)) {
            $qb->andWhere('event.city LIKE :loc1')
                ->setParameter('loc1', '%' . $queryparams["location"] . '%');
            $qb->orWhere('event.country LIKE :loc2')
                ->setParameter('loc2', '%' . $queryparams["location"] . '%');
        }
        if (array_key_exists('sort', $queryparams)) {
            switch ($queryparams["sort"]) {
                case "PriceAsc":
                    $qb->orderBy('event.price', 'ASC');
                    break;
                case "PriceDesc":
                    $qb->orderBy('event.price', 'DESC');
                    break;
            }
        }

        return $qb;
    }
}
