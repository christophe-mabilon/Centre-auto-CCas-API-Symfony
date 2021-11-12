<?php

namespace App\Repository;

use App\Entity\ClassifiedAd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClassifiedAd|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassifiedAd|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassifiedAd[]    findAll()
 * @method ClassifiedAd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassifiedAdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassifiedAd::class);
    }
    public function findByFilter($searchData){
        $parameters = new ArrayCollection();
        $qb = $this->createQueryBuilder('a');
        /* filter brand */
        if($searchData['brand'] = ""){
            $qb->andWhere('a.brand = 1');
            $parameters->add(new Parameter('brand', 1));
        }else if($searchData['brand'] >0 ) {
            $qb->andWhere('a.brand = :brand');
            $parameters->add(new Parameter('brand', $searchData['brand']));
        }
        /* filter model */
        if($searchData['model'] = ""){
            $qb->andWhere('a.model = 1');
            $parameters->add(new Parameter('model', 1));
        }else if($searchData['model'] >0){
            $qb->andWhere('a.model = :model');
            $parameters->add(new Parameter('model', $searchData['model']));
        }
        /* filter region */
        if($searchData['region'] = ""){
            $qb->andWhere('a.region = 1');
            $parameters->add(new Parameter('region', 1));
        }else if($searchData['region'] >0){
            $qb->andWhere('a.region = :region');
            $parameters->add(new Parameter('region', $searchData['region']));
        }
        /* filter fuel */
        if($searchData['fuel'] = ""){
            $qb->andWhere('a.fuel = 1');
            $parameters->add(new Parameter('fuel', 1));
        }else if($searchData['fuel']>0){
            $qb->andWhere('a.fuel = :fuel');
            $parameters->add(new Parameter('fuel', $searchData['fuel']));
        }
        /* filter typeOfVehicle */
        if($searchData['typeOfVehicle'] = ""){
            $qb->andWhere('a.typeOfVehicle = 1');
            $parameters->add(new Parameter('typeOfVehicle', 1));
        }else if($searchData['typeOfVehicle']>0){
            $qb->andWhere('a.typeOfVehicle = :typeOfVehicle');
            $parameters->add(new Parameter('typeOfVehicle', $searchData['typeOfVehicle']));
        }
        /* filter gearbox */
        if($searchData['gearbox'] = ""){
            $qb->andWhere('a.gearbox = 1');
            $parameters->add(new Parameter('gearbox', 1));
        }else if($searchData['gearbox']>0){
            $qb->andWhere('a.gearbox = :gearbox');
            $parameters->add(new Parameter('gearbox', $searchData['gearbox']));
        }
        /* filter places */
        if($searchData['places'] = ""){
            $qb->andWhere('a.places = 1');
            $parameters->add(new Parameter('places', 1));
        }else if($searchData['places']>0){
            $qb->andWhere('a.places = :places');
            $parameters->add(new Parameter('places', $searchData['places']));
        }
        /* filter minKilometre */
        if($searchData['minKilometre']>=0){
            $qb->andWhere('a.kilometre >= :minKilometre');
            $parameters->add(new Parameter('minKilometre', $searchData['minKilometre']));
        }
        /* filter maxKilometre */
        if($searchData['maxKilometre']>=0){
            $qb->andWhere('a.kilometre <= :maxKilometre');
            $parameters->add(new Parameter('maxKilometre', $searchData['maxKilometre']));
        }
        /* filter minYear */
        if($searchData['minYear']>=0){
            $qb->andWhere('a.year >= :minYear');
            $parameters->add(new Parameter('minYear', $searchData['minYear']));
        }
        /* filter maxYear */
        if($searchData['maxYear']>=0){
            $qb->andWhere('a.year <= :maxYear');
            $parameters->add(new Parameter('maxYear', $searchData['maxYear']));
        }
        /* filter minPrice */
        if($searchData['minPrice']>=0){
            $qb->andWhere('a.price >= :minPrice');
            $parameters->add(new Parameter('minPrice', $searchData['minPrice']));
        }
        /* filter maxPrice */
        if($searchData['maxPrice']>=0){
            $qb->andWhere('a.price <= :maxPrice');
            $parameters->add(new Parameter('maxPrice', $searchData['maxPrice']));
        }
        /* filter minPower */
        if($searchData['minPower']>=0){
            $qb->andWhere('a.power >= :minPower');
            $parameters->add(new Parameter('minPower', $searchData['minPower']));
        }
        /* filter maxPower */
        if($searchData['maxPower']>=0){
            $qb->andWhere('a.power <= :maxPower');
            $parameters->add(new Parameter('maxPower', $searchData['maxPower']));
        }
        return $qb->setParameters($parameters)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult()
            ;
    }





}
