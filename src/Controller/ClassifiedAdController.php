<?php

namespace App\Controller;


use App\Entity\ClassifiedAd;
use App\Entity\Garage;
use App\Entity\User;
use App\Repository\BrandRepository;
use App\Repository\ClassifiedAdRepository;
use App\Repository\GarageRepository;
use App\Repository\ManufacturerRepository;
use App\Repository\ModelRepository;
use App\Repository\RegionRepository;
use App\Repository\SearchRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassifiedAdRepository")
 * @Route("/api")
 */
class ClassifiedAdController extends AbstractController
{
    /**
     * @Route("/classifiedAd/findall", name="classifiedAd_all", methods="GET")
     */
    public function findAll(ClassifiedAdRepository $repo): Response
    {
        $announces = $repo->findAll();
        return $this->json($announces, 200, [], ["groups" => "classifiedAd"]);
    }


    /**
     * @Route("/classifiedAds/user/findall",name="classifiedAds_by_users", methods={"GET"})
     */
    public function findAllByUser(ClassifiedAdRepository $repo): Response
    {
        if (!$this->getUser()) {
            return $this->json(["Désolé vous n avez pas acces a cette information !", 200, []]);
        }
        $isAdmin = in_array("ROLE_ADMIN", $this->getUser()->getRoles(), true);
        if ($isAdmin || $this->getUser()) {
            $announce = $repo->findBy(["user" => $this->getUser()->getId()], ["garage" => "ASC"]);
        }
        return $this->json($announce, 200, [], ["groups" => "classifiedAdById"]);
    }

    // Uniquement un User si il est le propietaire du garage  ou un Admin peut voir toutes les annonces

    /**
     * @Route("/classifiedAds/user/findall/brand",name="classifiedAds_by_brand", methods={"GET"})
     */
    public function findAllByBrand(ClassifiedAdRepository $repo): Response
    {
        if (!$this->getUser()) {
            return $this->json(["Désolé vous n avez pas acces a cette information !", 200, []]);
        }
        $isAdmin = in_array("ROLE_ADMIN", $this->getUser()->getRoles(), true);
        if ($isAdmin || $this->getUser()) {
            $announce = $repo->findBy(["user" => $this->getUser()->getId()], ["brand" => "ASC"]);
        }
        return $this->json($announce, 200, [], ["groups" => "classifiedAdById"]);

    }

    /**
     * @Route("/classifiedAd/{id}", name="show_ClassifiedAd", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(ClassifiedAdRepository $repo, int $id): Response
    {
        $announce = $repo->findBy(['id' => $id]);
        return $this->json($announce, 200, [], ["groups" => "classifiedAdById"]);
    }


    // Uniquement un User si il est le propietaire du garage  ou un Admin peut ajouter une annonce

    /**
     * @Route("/classifiedAd/add/", name="add_ClassifiedAd", methods={"POST"})
     */
    public function add(Request          $req, SerializerInterface $serializer, EntityManagerInterface $emi, UserRepository $userRepo, GarageRepository $garageRepo,
                        RegionRepository $regionRepo, BrandRepository $brandRepo, ModelRepository $modelRepo): Response
    {
        if (!$this->getUser()) {
            return $this->json(["Désolé vous n avez pas acces a cette information !", 200, []]);
        }
        $isAdmin = in_array("ROLE_ADMIN", $this->getUser()->getRoles(), true);

        if ($isAdmin || $this->getUser()) {

            $classifiedAdJson = $req->getContent();
            $classifiedAd = $serializer->deserialize($classifiedAdJson, ClassifiedAd::class, 'json');
            $data = $req->toArray();
            $brand = $brandRepo->findOneBy(["id" => $data['brand']]);
            $model = $modelRepo->findOneBy(["id" => $data['model']]);
            $region = $regionRepo->findOneBy(["id" => $data['region']]);
            $garage = $garageRepo->findOneBy(["id" => $data['garage']]);
            $classifiedAd->setUser($this->getUser());
            $classifiedAd->setBrand($brand);
            $classifiedAd->setModel($model);
            $classifiedAd->setRegion($region);
            $classifiedAd->setGarage($garage);
            $classifiedAd->setCreatedAt(new \DateTime());
            $classifiedAd->setUpdatedOnAt(new \DateTime());
            $emi->persist($classifiedAd);
            $emi->flush();
            return $this->json(["message" => "Votre annonce à bien été ajoutée !"], 200, []);
        }
        return $this->json(["message" => "Il semblerait qu 'il y a un un petit probleme merci de recommencer votre saisie"], 200, []);

    }

    /**
     * @Route("/classifiedAds/update/{id}", name="update_classifiedAd", methods={"PATCH"}, requirements={"id":"\d+"})
     */
    public function classifiedUpdate(Request          $req, SerializerInterface $serializer, EntityManagerInterface $emi, UserRepository $userRepo, GarageRepository $garageRepo,
                                     RegionRepository $regionRepo, BrandRepository $brandRepo, ModelRepository $modelRepo)
    {
        {
            if (!$this->getUser()) {
                return $this->json(["Désolé vous n avez pas acces a cette information !", 200, []]);
            }
            $isAdmin = in_array("ROLE_ADMIN", $this->getUser()->getRoles(), true);
            if ($isAdmin && $this->getUser()) {
                $classifiedAdJson = $req->getContent();
                $classifiedAd = $serializer->deserialize($classifiedAdJson, ClassifiedAd::class, 'json');
                $data = $req->toArray();
                $brand = $brandRepo->findOneBy(["id" => $data['brand']]);
                $model = $modelRepo->findOneBy(["id" => $data['model']]);
                $region = $regionRepo->findOneBy(["id" => $data['region']]);
                $garage = $garageRepo->findOneBy(["id" => $data['garage']]);
                $user = $userRepo->findOneBy(["id" => $data['user']]);
                $classifiedAd->setBrand($brand);
                $classifiedAd->setModel($model);
                $classifiedAd->setRegion($region);
                $classifiedAd->setUser($user);
                $classifiedAd->setGarage($garage);
                $classifiedAd->setCreatedAt(new \DateTime());
                $classifiedAd->setUpdatedOnAt(new \DateTime());
                $emi->persist($classifiedAd);
                $emi->flush();
                return $this->json(["message" => "Votre annonce à bien été ajoutée !"], 200, []);
            }
            return $this->json(["message" => "Il semblerait qu 'il y a un un petit probleme merci de recommencer votre saisie"], 200, []);

        }

    }


    /**
     *
     * @Route("/classifiedAd/delete/{id}", name="delete_classifiedAd", methods={"DELETE"}, requirements={"id":"\d+"})
     */
    public function delete(ClassifiedAd $classifiedAd, EntityManagerInterface $manager, UserInterface $currentUser, $id): Response
    {
        $isAdmin = in_array("ROLE_ADMIN", $currentUser->getRoles(), true);
        if ($isAdmin || $currentUser->getId() === $classifiedAd->getUser()->getId()) {
            $manager->remove($classifiedAd);
            $manager->flush();
            return $this->json("Cette annonce a bien été supprimé", 200);
        }
        return $this->json(["message" => "Désolé vous n'avez pas acces a cette fonction,merci de contater l'admin du site"], 200);
    }

    /**
     * @Route("/classifiedAds/count/brand", name="count_classifiedAdByBrand", methods={"GET"})
     */
    public function count(ClassifiedAdRepository $repo): Response
    {
        $selectedMarque = [];
        $nombre = 0;
        $totalclassifiedAd = $repo->findAll();
        for ($i=0, $iMax = count($totalclassifiedAd); $i < $iMax; $i++){
            if(!in_array($totalclassifiedAd[$i]->getBrand()->getid(), $selectedMarque, true)){

                $selectedMarque[$totalclassifiedAd[$i]->getBrand()->getname()] = count($repo->findBy(['brand'=>$totalclassifiedAd[$i]->getBrand()->getid()]));
            }
        }
        return $this->json($selectedMarque, 200, [], ["groups" => "countAnnonces"]);
    }

    /**
     * @Route("/search", name="search_classifiedAd", methods={"POST"})
     *
     */
    public function filterClassifiedAd(Request $req, ClassifiedAdRepository $repo): Response
    {
        $announces = "";
        $searchData = $req->toArray();
        $announces = $repo->findByFilter($searchData);
        return $this->json($announces, 200, [], ["groups" => "classifiedAd"]);
    }
}
