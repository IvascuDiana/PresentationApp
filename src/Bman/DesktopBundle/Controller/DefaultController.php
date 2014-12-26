<?php

namespace Bman\DesktopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction(Request $request, $_locale)
    {
        $ip = $request->getClientIp();
        $locationHelper = $this->get('location_helper');
        $arr_languages = array('en', 'hu', 'ro');

        if ($ip == '127.0.0.1') {
            $ip = '5.15.177.142';
        }

        //set locale from client IP
        $localeFromIp = $locationHelper->getLocationByIp($ip);
        $request->setLocale($localeFromIp);

        if (strlen($request->getLocale()) == 0) {
            $request->setLocale("en");
        }

        //the select form for languages
        $form = $this->createFormBuilder()
            ->add('Languages', 'choice', array(
                'choices' => array('en' => 'En', 'hu' => 'Hu', 'ro' => 'Ro'),
                'data' => "en",
                'placeholder' => false,
                'required'    => false,
                'empty_data'  => null,
            ))
            ->add('Change Language', 'submit')
            ->getForm();

        //handle language form submission
        $form->handleRequest($request);

        if (($form->isValid()) &&(in_array($form->getData()['Languages'], $arr_languages))) {
            $request->setLocale($form->getData()['Languages']);

            if ($request->getLocale() == "en") {
                $url = "\\en";
            } else {
                $url = $this->generateUrl('bman_desktop_homepage', array('_locale' => $request->getLocale()));
            }

            return $this->redirect($url);
        }

        return $this->render('BmanDesktopBundle:Default:index.html.twig', array(
            'locale' => $request->getLocale(),
            'form' => $form->createView(),
            'title' => 'title',
        ));
    }

}
