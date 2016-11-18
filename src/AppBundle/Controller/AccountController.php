<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use AppBundle\Form\RegistrationType;
use AppBundle\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Class AccountController
 * @package AppBundle\Controller
 */
class AccountController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $registrationForm = $this->createForm(RegistrationType::class, null, array('action' => $this->generateUrl('create')));
        $loginForm = $this->createForm(LoginType::class, null, array('action' => $this->generateUrl('login')));

        return $this->_renderTemplate($registrationForm, $loginForm);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function _renderTemplate($registrationForm, $loginForm){

        return $this->render('account/index.html.twig',
            array(
                'form' => $registrationForm->createView(),
                'login' => $loginForm->createView()
            )
        );
    }

    /**
     * @Route("/create", name="create")
     */
    public function createAction(Request $request){

        $account = new Account();
        $registrationForm = $this->createForm(RegistrationType::class, $account, array('action' => $this->generateUrl('create')));
        $registrationForm->handleRequest($request);
        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {

            /** @var Account $samePasswordAccount */
            $samePasswordAccount = $this->getDoctrine()
                ->getRepository('AppBundle:Account')
                ->findOneByPassword($account->getPassword());

            try  {
                if($samePasswordAccount) {
                    throw new \Exception(sprintf("User %s already uses this password.", $samePasswordAccount->getLogin()));
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($account);
                $em->flush();

                if($account->getHasCat()) {
                    return $this->redirectToRoute('homepage');
                }

                $this->addFlash('success', 'Your registration is successful.');
            } catch (\Exception $e) {
                $this->addFlash(
                    'error',
                    $e->getMessage()
                );
            }

            return $this->redirectToRoute('homepage');
        }

        return $this->_renderTemplate($registrationForm, $this->createForm(LoginType::class));
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request){

        $loginForm = $this->createForm(LoginType::class, null, array('action' => $this->generateUrl('login')));

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->_renderTemplate(
            $this->createForm(RegistrationType::class, null, array('action' => $this->generateUrl('create'))),
            $loginForm
        );
    }
}
