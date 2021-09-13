<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface as EMI;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 *
 * @Route("/api/user")
 */
class AdminController extends AbstractController
{

    /**
     *
     * @Route("/searchAll", name="search_All_Users",methods={"GET"})
     *
     */
    public function searchAllUsers(UserRepository $repo): Response
    {
        if (!$this->getUser()) {
            return $this->json(["message" => "Désolé vous n'avez pas l'autorisation pour faire cela !"], 200, []);
        }
        $user = $this->getUser();
        $isAdmin = in_array("ROLE_ADMIN", $user->getRoles(), true);
        if ($isAdmin) {
            $users = $repo->findAll();
            return $this->json($users, 200, [], ["groups" => ["users"]]);
        }
        return $this->json(["message" => "Desolé mais vous n'avez pas acces a cette page !"], 200, []);

    }

    /**
     * @Route("/show/{id}", name="admin_show_user",methods={"GET"})
     *
     */
    public function show(User $user, $id): Response
    {
        if (!$this->getUser()) {
            return $this->json(["message" => "Desolé mais vous n'avez pas acces a cette page !"], 200, []);
        }
        //Un user peut voir uniqument son compte
        if ($user->getId() === (int)$id && !in_array("ROLE_ADMIN", $user->getRoles(), true)) {
            return $this->json($user, 200, [], ["groups" => ["users"]]);
        }
        //Un admin peut voir le détails d 'un utilisateur .
        if (in_array("ROLE_ADMIN", $user->getRoles(), true)) {

            return $this->json($user, 200, [], ["groups" => ["users"]]);
        }
        return $this->json(["message" => "Desolé mais vous n'avez pas acces a cette page !"], 200, []);
    }


//Création uniquement pour l'admin
    /**
     * @Route("/register", name="admin_register",methods={"POST"})
     */
    public function register(Request $req, SerializerInterface $serializer, EMI $manager, UserPasswordHasherInterface $hasher): Response
    {
        if (!$this->getUser()) {
            dd($this->getUser());
            return $this->json(["message" => "Desolé mais vous n'avez pas acces a cette page !"], 200, []);
        }
        $user = $this->getUser();
        //// seulement un admin peut avoir acces a ce controller
        if (in_array("ROLE_ADMIN", $user->getRoles(), true)) {
            $jsonRecu = $req->getContent();
            $user = $serializer->deserialize($jsonRecu, User::class, 'json');
            if ($user->getPassword() !== $user->getPasswordConfirm()) {
                return $this->json(['message' => 'Les mots de passe ne corespondent pas'], 200, []);
            }
            if ($user->getPassword() === $user->getPasswordConfirm()) {
                $user->setUsename($user->getUsername());
                $hasedPasword = $hasher->hashPassword($user, $user->getPassword());
                //$user->setEmail($user->getEmail());
                $user->setPassword($hasedPasword);
                $user->setDateOfRegistration(new DateTime());
                $user->setUpdatedOn(new DateTime());
                $user->setRoles(["ROLE_USER"]);
                $manager->persist($user);
                $manager->flush();
                return $this->json(["message" => "Utilisateur ajouté !"], 200, []);
            }
        }
        return $this->json(["message" => "Desolé mais vous avez pas acces a cette page!"], 200, []);
    }

    /**
     * //Update uniquement pour l'admin
     * @Route("/edit/{id}", name="admin_update_user", methods={"PATCH"}, requirements={"id"="\d+"})
     */
    public function edit(Request $req, SerializerInterface $serializer, EMI $manager,
                         UserPasswordHasherInterface $hasher,User $user, $id): Response
    {
        if (!$this->getUser()) {
            return $this->json(["message" => "Desolé mais vous n'avez pas acces a cette page !"], 200, []);
        }
        $currentUser = $this->getUser();

        $isAdmin = in_array("ROLE_ADMIN", $currentUser->getRoles(), true);
        //seulement un admin peut avoir acces a ce controller
        if ($isAdmin) {
            $jsonUser = $req->getContent();
            $userEdit = $serializer->deserialize($jsonUser, User::class, 'json');
            //$hashedPassword = $hasher->hashPassword($user, $user->getPassword());
            //$user->setPassword($hashedPassword);
            $user->setTitle($userEdit->getTitle());
            $user->setFirstName($userEdit->getfirstName());
            $user->setLastName($userEdit->getLastName());
            $user->setFirstname($userEdit->getUsername());
            $user->setEmail($userEdit->getEmail());
            $user->setPhoneNumber($userEdit->getPhoneNumber());
            $user->setSiret($userEdit->getSiret());
            if(!empty($userEdit->getPassword()) && !$userEdit->getPassword()==""){
                if($userEdit->getPassword() ===$userEdit->getPasswordConfirm())
                {
                    $user->setPaswword($userEdit->getPaswword());
                    $user->setPaswwordConfirm($userEdit->getPaswwordConfirm());
                }else{
                    return $this->json(["message" => "Les mots de passe doivent correspondre!"]);
                }
            }
            $user->setUpdatedOn(new DateTime());
            $user->setdateOfRegistration(new DateTime());
            $user->setRoles(["ROLE_USER"]);
            $manager->persist($user);
            $manager->flush();
            $message = ["message" => "Utilisateur mis a jour!"];
            return $this->json($message, 200, []);
        }

        return $this->json(["message" => "Désolé vous n'avez pas la permission pou faire cela !"], 200, []);

    }

    /**
     * //suppression uniquement pour l'admin
     * @Route("/delete/{id}",name="admin_delete",methods={"DELETE"}, requirements={"id":"\d+"})
     */
    public function UserDelete(UserRepository $repo, EMI $manager, $id): Response
    {
        if (!$this->getUser()) {
            return $this->json(["message" => "Desolé mais vous n'avez pas acces a cette page !"], 200, []);
        }
        $user = $this->getUser();
        $isAdmin = in_array("ROLE_ADMIN", $user->getRoles(), true);
        if ($isAdmin) {

            $deletedUser = $repo->findBy(["id" => $id]);
            $manager->remove($deletedUser[0]);
            $manager->flush();
            return $this->json(['message' => "L utilisateur a été supprimé !"], 200, []);

        }

        return $this->json(["message" => "Vous n'avez pas la permission de faire ça !"], 200, []);
    }

    /**
     * @Route("/currentUser",name="current_user",methods={"GET"})
     */
    public function currentUser()
    {
        if (!$this->getUser()) {
            return $this->json(["message" => "Desolé mais vous n'avez pas acces a cette page !"], 200, []);
        }
        $user = $this->getUser();
        return $this->json($user, 200, [], ["groups" => ["users-details"]]);


    }
}
