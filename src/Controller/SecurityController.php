<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegisterType;
use App\Form\ChangePasswordType;
use App\Form\Model\ChangePassword;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class SecurityController extends AbstractController
{
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $user = $this->getUser();

        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }

    public function logout(Request $req, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $changePassword = new changePassword();
        $form = $this->createForm(changePasswordType::class, $changePassword);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();

            $newPassword = $passwordEncoder->encodePassword($user, $changePassword->getNewPassword());

            $user->setPassword($newPassword);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Mot de passe changé');
            return $this->redirectToRoute('user_account');
        }
        return $this->render('shop/account/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

