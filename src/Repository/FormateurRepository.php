<?php

namespace App\Repository;

use App\Entity\Formateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Formateur>
 *
 * @method Formateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formateur[]    findAll()
 * @method Formateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formateur::class);
    }

    public function add(Formateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Formateur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllWithoutPromotion()
    {
        // $em = $this->getEntityManager();
        // $query = $em->createQuery('SELECT * FROM App\Entity\Formateur formateur WHERE formateur.id NOT IN (SELECT promotion.formateur_id FROM App\Entity\Promotion promotion)');

        // return $query->getResult(); // array of Company objects

        $conn = $this->getEntityManager()->getConnection();


        $sql = 'SELECT * FROM formateur WHERE formateur.id NOT IN (SELECT promotion.formateur_id FROM promotion)';
        $stmt = $conn->prepare($sql);
        return $stmt->executeQuery();

        // ESSAYER PLUS TARD 

        // public function findOneByIdJoinedToCategory(int $productId): ?Product
        // {
        //     $entityManager = $this->getEntityManager();

        //     $query = $entityManager->createQuery(
        //         'SELECT p, c
        //         FROM App\Entity\Product p
        //         INNER JOIN p.category c
        //         WHERE p.id = :id'
        //     )->setParameter('id', $productId);

        //     return $query->getOneOrNullResult();
        // }
    }

    //    /**
    //     * @return Formateur[] Returns an array of Formateur objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Formateur
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
