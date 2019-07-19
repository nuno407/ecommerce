<?php

namespace App\Controller;


use App\Entity\Cart;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserController extends AbstractController
{

    public function getAllUsers(Request $request)
    {
        $page = $request->query->get("page", 1);
        $limit = $request->query->get("limit", 100);
        $users = $this  ->getDoctrine()
                        ->getRepository(User::class)
                        ->getAllUsers( $page, $limit);

        return $this->json($users);
    }

    public function createUser(Request $request)
    {
        $user = new User("Nuno", "Sousa", strval(random_int(0, 999999)), "asdasdasdasdadadsasd");
        $cart =  new Cart();
        $user->setCartID($cart);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->json($request);
    }

    public function deleteAllUsers(Request $request)
    {
        $this   ->getDoctrine()
                ->getRepository(User::class)
                ->deleteAllUsers();
        return $this->json($request);
    }

    public function getSpecificUser(Request $request, $userID)
    {
        $users = $this  ->getDoctrine()
                        ->getRepository(User::class)
                        ->findSpecificUser($userID);
        return $this->json($userID);
    }

    public function updateSpecificUser(Request $request, $userID)
    {
        return $this->json("Its me MARIO!");
    }
}
