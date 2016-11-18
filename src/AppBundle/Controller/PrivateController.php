<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Account;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Class PrivateController
 * @package AppBundle\Controller
 */
class PrivateController extends Controller
{
    /**
     * @Route("/users", name="userlist")
     */
    public function usersAction(Request $request)
    {
        $accounts = $this->getDoctrine()->getRepository('AppBundle:Account')->findAll();

        return $this->render('private/users.html.twig', array('accounts' => $accounts));
    }
}
