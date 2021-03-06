<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservatieController extends Controller
{

    /**
     * @Route("/reservatie", name="reservatie")
     */
    public function reservatieAction() {
        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        $formules = $em->getRepository('AppBundle:MenuFormules')->findAll();
        
        return $this->render('reservatie/reservatie.html.twig', array(
                    'openingsuren' => $openingsuren,
                    'user' => $this->getUser(),
                    'formules' => $formules
        ));
    }

    /**
    * @Route("/reservatie/send", name="send_mail")
    */
    public function sendAction(){
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('tseizoen@vdab.be')
            ->setTo('vincentvanlerberghe_73@hotmail.com')
            ->setBody(
                $this->renderView(
                    'email/bevestiging.html.twig',
                    array('name' => "vincent")
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);

        return $this->redirectToRoute('index', array(), 301);
    }
     /**
     * @Route("/reservatieajax", name="reservatieajax")
     */
    public function ajaxAction(Request $request) {
        $waarden = $request->query->all();
        
        $return = array("datum" => $waarden["datum"], "personen" => $waarden["personen"]);
        
        return new Response(json_encode($return));
    }

}
