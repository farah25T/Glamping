<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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


    public function tonight (): ?Event
  { $currentDate = new \DateTime();
      $date = $currentDate->format('Y-m-d');
      return $this->createQueryBuilder('e')
          ->andWhere('e.date_debut = :date')
          ->setParameter('date', $date)
          ->setMaxResults(1)
          ->getQuery()
          ->getOneOrNullResult();
   }
    public function thisWeek (): ?Event
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
    public function NextWeek (): ?Event
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



    public function findTopEventOfYear(int $year): ?Event
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.User', 'eu')
            ->andWhere('YEAR(e.date_debut) = :year')
            ->setParameter('year', $year)
            ->groupBy('eu.event')
            ->orderBy('COUNT(eu.user)', 'DESC')
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
}
