<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserController extends AbstractController
{

    public function getAllUsers(Request $request)
    {
        $page = $request->query->get("page");
        $limit = $request->query->get("limit");
        return $this->json($page);
    }

    public function createUser(Request $request)
    {
        return $this->json($request);
    }

    public function deleteAllUsers(Request $request)
    {
        return $this->json($request);
    }

    public function getSpecificUser(Request $request, $userID)
    {
        return $this->json($userID);
    }

    public function getMeUser(Request $request)
    {
        return $this->json("Its me MARIO!");
    }
}
