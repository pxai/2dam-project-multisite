<?php
namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ApiBundle\Entity\User;
use ApiBundle\Form\Type\UserSignInType;

class SecurityController extends Controller
{
     /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request,$error='',$lastUsername='')
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $form = $this->createForm(UserSignInType::class);

        // get the login error if there is one
        //$error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
       // $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'ApiBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
                'form'=> $form->createView()
            )
        );
    }

    /**
     *
     * @Route("/login_check", name="login_check")
     */
    public function userSignInSaveAction(Request $request)
    {
        //$form = $this->createForm(new ApplicantType(), new Applicant());

        $form = $this->createForm(UserSignInType::class, new User());
        $lastUsername = '';
        $error = '';

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            //$form->submit($request->request->get($form->getName()));

            if ($form->isValid()) {
                $new_user = $form->getData();

                //$applicant = $this->getDoctrine()->getRepository("ApiBundle:Applicant")->findApplicant($new_applicant->getEmail());
                $user = $this->getDoctrine()->getRepository("ApiBundle:User")->checkLogin($new_user);

                if ( null != $user) {
                    $response =  $this->render('ApiBundle:Security:profile.html.twig', array('user' => $user));

           } else {
                    //$form = $this->createForm(ApplicantSignUpType::class, $new_applicant);
                    //$response = $this->render('CuatrovientosArteanBundle:User:signUp.html.twig', array('form'=> $form->createView()));
                    return $this->loginAction($request,'Login incorrect');
                }
                /* $em = $this->getDoctrine()->getEntityManager();
                 $em->merge($applicant);
                 $em->flush();
                 $this->sendEmail($applicant);*/
            } else {
               // $response = $this->render('ApiBundle:Security:signIn.html.twig', array('form'=> $form->createView(),'error'=>''));
                $response =  $this->render(
                    'ApiBundle:Security:login.html.twig',
                    array(
                        // last username entered by the user
                        'last_username' => $lastUsername,
                        'error'         => $error,
                    )
                );
            }
        }

        return $response;
    }
}
