<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Garage;
use App\Repository\UserRepository;
use App\Repository\GarageRepository;
use phpDocumentor\Reflection\Types\Integer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/api")
 *
 */
class GarageController extends AbstractController
{   //voir touts les garages
    /**
     * @Route("/garages", name="garages", methods={"GET"})
     */
    public function findAllGarages(GarageRepository $repo): Response
    {
        if (!$this->getUser()) {
            return $this->json(["Désolé vous n'avez pas acces acette page !", 200, []]);
        }
        $user = $this->getUser();
        if (in_array("ROLE_ADMIN", $user->getRoles(), true)) {
            $garages = $repo->findAll();
            return $this->json($garages, 200, [], [
                "groups" => ["garages"]
            ]);
        } //Dans le cas d'un ROLE_User on retourne uniuemnet les garages de l'utilisateur conecté
        else if (in_array("ROLE_USER", $user->getRoles()) && $user === $this->getUser()) {
            //findAll by user
            //sql => SELECT * FROM `garage` WHERE `user_id`=9
            $user = $this->getUser();
            $userId = $user->getId();
            $garages = $this->getDoctrine()->getRepository(Garage::class)->findBy(["user" => $userId]);
            return $this->json($garages, 200, [], [
                "groups" => ["garages"]
            ]);
        }
        return $this->json(["Désolé vous n'avez pas acces acette page !", 200, []]);
    }
    //Voir une le details d'un garage

    /**
     * @Route("/garage/show/{id}", name="show_garage", methods={"GET"}, requirements={"id":"\d+"})
     *
     */
    public function show(Garage $garage): Response
    {  //Si l'utilisateur conécté n'est pas le propietaire du garage ni l'admin
        if (!$this->getUser()) {
            return $this->json(["Désolé vous n avez pas acces a cette information !", 200, []]);
        }
        $user = $this->getUser();
        $isAdmin = in_array("ROLE_ADMIN", $user->getRoles());
        //Uniquement le proprietaire du garage et l'admin peuvent acceder ici
        if ($user->getId() === $garage->getUser()->getId() || $isAdmin) {
            return $this->json($garage, 200, [], ["groups" => ["garages"]]);
        }
        return $this->json(["Vous avez pas encore enregistré un garage!"], 200, []);
    }


    //Ajout de garages (seul l'admin ou le proprietaire peut ajouter un gararge)

    /**
     * @Route("/garage/add/{userId}", name="add_garage", methods={"POST"}, requirements={"id":"\d+"})
     */
    public function add(Request $req, SerializerInterface $serializer, EntityManagerInterface $emi, userRepository $repo, $userId): Response
    {
        if (!$this->getUser()) {
            return $this->json(["message" => "Désolé vous n avez pas acces a cette information !"], 200);
        }

        //get garage user et id garage
        $isAdmin = in_array("ROLE_ADMIN", $this->getUser()->getRoles(), true);
        if ($isAdmin || (string)$this->getUser()->getId() === $userId) {

            $garageJson = $req->getContent();
            $garageAdd = $serializer->deserialize($garageJson, Garage::class, 'json');
            $user = $repo->findBy(["id" => $userId]);
            $garageAdd->setUser($user[0]);
            $garageAdd->setcreatedAt(new \DateTime());
            $garageAdd->setupdatedOnAt(new \DateTime());
            $emi->persist($garageAdd);
            $emi->flush();
            return $this->json(["message" => "Ce garage a bien été ajouté !"], 200);
        } else {

            return $this->json(["message" => "Désolé vous n'avez pas acces a cette information,merci de contater l'admin du site"], 200);
        }
    }


    //seulement le proprietaire du garage ou l'admin peut modifier un garage

    /**
     * @Route("/garage/update/{id}", name="update_garage", methods={"PATCH"}, requirements={"id":"\d+"})
     */
    public function update(Request $req, Garage $garage, UserInterface $currentUser, GarageRepository $repo, SerializerInterface $serializer,
                           EntityManagerInterface $manager, $id): Response
    {   $userCanEdit = false;
        $isAdmin = in_array("ROLE_ADMIN", $currentUser->getRoles(), true);
        dd($this->getUser()->getGarage());
        if($garage->getUser()->getId() === (int)$id){
            $userCanEdit = true;
            dd('ok can edit');
        }
        if ($isAdmin || $userCanEdit) {
            $garage = $repo->findOneBy(["id" => $id]);
            $jsonRecu = $req->getContent();
            $jsonRecu = $serializer->deserialize($jsonRecu, Garage::class, 'json');
            $garage->setName($jsonRecu->getName());
            $garage->setstreetNumber($jsonRecu->getStreetNumber());
            $garage->setAddress($jsonRecu->getAddress());
            $garage->setPostalCode($jsonRecu->getPostalCode());
            $garage->setCity($jsonRecu->getCity());
            $garage->setUpdatedOnAt(new \DateTime());
            $manager->persist($garage);
            $manager->flush();
            return $this->json(["Le garage a éte modifié avec succes !"], 200);
        }
        return $this->json(["message" => "Désolé vous n'avez pas acces a cette fonction,merci de contater l'admin du site"], 200);
    }

    /**
     *
     * @Route("/garage/delete/{id}", name="delete_garage", methods={"DELETE"}, requirements={"id":"\d+"})
     */
    public function delete(Garage $garage, EntityManagerInterface $manager, UserInterface $currentUser, $id): Response
    {
        $isAdmin = in_array("ROLE_ADMIN", $currentUser->getRoles(), true);
        if ($isAdmin || $currentUser->getId() === $garage->getUser()->getId()) {
            $manager->remove($garage);
            $manager->flush();
            return $this->json("Ce garage a bien été supprimé", 200);
        }
        return $this->json(["message" => "Désolé vous n'avez pas acces a cette fonction,merci de contater l'admin du site"], 200);
    }

    /**
     * @Route("/garages/count/", name="count_garage", methods={"GET"})
     */
    public function count(GarageRepository $repo)
    {
        if (!$this->getUser()) {
            return $this->json(["Désolé vous n avez pas acces a cette information !", 200, []]);
        }

        $isAdmin = in_array("ROLE_ADMIN", $this->getUser()->getRoles(), true);
        if ($isAdmin) {
            $totalGarage = count($repo->findAll());
        } else {
            $totalGarage = count($repo->findBy(["user" => $this->getUser()->getId()]));
        }
        return $this->json($totalGarage, 200, []);
    }

    /**
     * @Route("/photos", name="Upload_photos", methods={"POST"})
     *
     */
    public function postPhotos(Request $req):Response
    {
        $photo = $req->files->get('image');
        if ($photo) {
            try {
                // On cree un nom unique pour cette image avec uniqueId() et on gere son extention avec gessExtension
                $nouveauNomImage = uniqid('', true) . "." . $photo->guessExtension();
                //déplace l'image du dossier tmp dans le repertoire public/uploads/images/festivals
                $photo->move(
                //chemin cible ( c est le chemin par défaut dans config/services.yaml )
                    $this->getParameter('images_vehicules'),
                    //nom de la cible (nouvelle adresse)
                    $nouveauNomImage
                );
            } catch (FileException $e) {
                throw $e;

                }

        } return $this->json($nouveauNomImage, 200);
    }
}



