<?php

namespace App\Controller;


use App\Entity\Cart;
use App\Entity\User;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController extends AbstractController
{
    /** This function is used to handle all request to display all users whithin the system
     * @param Request $request Contains request info. Possible parameters to check: "page" and "limit"
     * @return JsonResponse
     */
    public function getAllUsers(Request $request)
    {

        $page = $request->query->get("page", 1);
        $limit = $request->query->get("limit", 100);
        $users = $this  ->getDoctrine()
                        ->getRepository(User::class)
                        ->getAllUsers( $page, $limit);

        $serializer = SerializerBuilder::create()->build();
        $response = new Response($serializer->serialize($users, 'json'), Response::HTTP_OK);
        return $response;
    }

    /** This function is used to handle all requests to create users in the system
     * @param Request $request Contains request info. Request body should be used to get info of user to be created
     * @return JsonResponse
     * @throws \Exception
     */
    public function createUser(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $user->setFirstName("Nuno");
        $user->setLastName("Sousa");
        $user->setPassword("asdasdasd");
        $cart =  new Cart();
        $user->setCartID($cart);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $serializer = SerializerBuilder::create()->build();
        $response = new Response($serializer->serialize($user, 'json'), Response::HTTP_CREATED);
        return $response;
    }

    /** This function is used to handle requests to delete all users
     */
    public function deleteAllUsers(Request $request)
    {
        $this   ->getDoctrine()
                ->getRepository(User::class)
                ->deleteAllUsers();

        $response = new Response( "", Response::HTTP_NO_CONTENT);
        return $response;
    }

    /** This function is used to handle requests to get a specific user.
     * @param $userID UserID present in the url. Please not that this userID could be a integer or the word "me" if exists a session in place
     * @return JsonResponse
     */
    public function getSpecificUser(Request $request, $userID)
    {
        $user = $this  ->getDoctrine()
                        ->getRepository(User::class)
                        ->getSpecificUser(intval($userID));

        if ($user == null) {
            throw $this->createNotFoundException($message = "Specified user was not found");
        }

        $serializer = SerializerBuilder::create()->build();
        $response = new Response($serializer->serialize($user, 'json'),Response::HTTP_OK);
        return $response;
    }

    /** This function is used to handle all update requests to a specific user
     * @param Request $request Contains request info. Request body should be used to get info of user to be updated
     * @return JsonResponse
     */
    public function updateSpecificUser(Request $request, $userID)
    {
        $user = $this   ->getDoctrine()
                        ->getRepository(User::class)
                        ->getSpecificUser(intval($userID));

        if ($user == null) {
            throw $this->createNotFoundException("Specified user was not found");
        }

        // change from here

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $serializer = SerializerBuilder::create()->build();
        $response = new Response($serializer->serialize($user, 'json'), Response::HTTP_OK);
        return $response;
    }

    /** This function is used to handle all delete requests to specific users
     * @param Request $request
     * @param $userID userid to be deleted
     * @return Response
     */
    public function deleteSpecificUser(Request $request, $userID)
    {
        $this   ->getDoctrine()
            ->getRepository(User::class)
            ->deleteSpecificUser(intval($userID));

        $response = new Response( "", Response::HTTP_NO_CONTENT);
        return $response;
    }

    /** This function is used to handle get requests of session user
     * @return JsonResponse
     */
    public function getMeUser(Request $request)
    {
        // get user id from session
        return $this->getSpecificUser($request, "77");
    }

    /** This function is used to handle all update requests of session user
     * @param Request $request Contains request info. Request body should be used to get info of user to be updated
     * @return JsonResponse
     */
    public function updateMeUser(Request $request)
    {
        // get user id from session
        return $this->updateSpecificUser($request, "77");
    }
}
