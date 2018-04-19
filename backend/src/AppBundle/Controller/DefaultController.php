<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use RiotAPI\RiotAPI;
use RiotAPI\Definitions\Region;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

    }
    /**
     * @Route("/formcreate", name="creationpage")
     */
    public function creationAction(Request $request)
    {
        $formBuilder = $this->createFormBuilder();

        $formBuilder
            ->add('mail',EmailType::class,[
                'required' => true,
                'label' => 'form.Mail',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                    ]),
                    new Email(),
                ],

            ])
            ->add('password',Text::class,[
                'required' => true,
                'label' => 'form.password',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 4,
                        'max' => 30,
                    ]),
                ],
            ])
            ->add('pseudo',Text::class,[
                'required' => true,
                'label' => 'form.pseudo',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 4,
                        'max' => 30,
                    ]),
                ],
            ]);

        $form = $formBuilder->getForm();

        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user= $form->getData();

            $user['mail'];
            $user['password'];
            $user['pseudo'];

            return $this->redirectToRoute('successcontactpage',[
            ]);
        }

        return new  JsonResponse ([
        ]);
    }

}
