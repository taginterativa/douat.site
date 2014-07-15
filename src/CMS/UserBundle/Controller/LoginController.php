<?php

namespace CMS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * User controller.
 */
class LoginController extends Controller
{

    /**
     *
     * @Route("/cms/login", name="login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        if($error):
            $error = null;
            $error['message'] = "Usuário e/ou senha incorretas";
        endif;

        return array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            );
    }
    
    /**
     * 
     * @Route("/cms/login_check", name="login_check")
     */
    
    public function loginCheckAction(){
        
    }
    
    /**
     * 
     * @Route("/cms/logout", name="logout")
     */
    
    public function logoutAction(){
        
    }
    
}
