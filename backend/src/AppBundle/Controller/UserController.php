<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Mapper\MapperInterface;
use AppBundle\Repository\UserRepository;
use RiotAPI\Definitions\Region;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    public function readUser($userId, UserRepository $userRepository)
    {
        if(!$userId) {
            throw new NotFoundHttpException();
        }

        $user = $userRepository->find($userId);

        if (null === $user) {
            throw new NotFoundHttpException();
        }

        return new JsonResponse([
            'user_id' => $user->getId(),
            'mail' => $user->getMail(),
            'pseudoGame' => $user->getPseudoGame(),
        ]);
    }

    public function createUser(UserRepository $userRepository, Request $request)
    {
        $pseudoGame = $request->get('pseudoGame');
        $mail = $request->get('mail');
        $password = $request->get('password');

        // check inputs
        if (null === $pseudoGame) {
            throw new \Exception("Missing field : `pseudoGame`");
        }
        if (null === $mail) {
            throw new \Exception("Missing field : `mail`");
        }
        if (null === $password) {
            throw new \Exception("Missing field : `password`");
        }

        // check pseudo does not exists
        $user = $userRepository->findBy(['pseudoGame' => $pseudoGame]);
        if ($user) {
            throw new \Exception("Pseudo game already registered");
        }

        // check email is valid
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Bad format for field : `mail`");
        }

        // check email does not exist
        $user = $userRepository->findBy(['mail' => $mail]);
        if ($user) {
            throw new \Exception("Mail already registered");
        }

        // insert in bd
        $user = new User();
        $user->setMail($mail);
        $user->setPassword(hash('sha256', $password));
        $user->setPseudoGame($pseudoGame);
        $user->setCreatedAt(new \DateTime());

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $this->getDoctrine()->getManager()->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse([
            'user_id' => $user->getId(),
            'mail' => $user->getMail(),
            'pseudoGame' => $user->getPseudoGame(),
        ]);
    }

    public function updateUser($userId, UserRepository $userRepository, Request $request)
    {
        if(!$userId) {
            throw new NotFoundHttpException();
        }

        $user = $userRepository->find($userId);

        if (null === $user) {
            throw new NotFoundHttpException();
        }

        $mail = $request->get('mail');
        $password = $request->get('password');

        // check inputs
        if (null === $mail) {
            throw new \Exception("Missing field : `mail`");
        }
        if (null === $password) {
            throw new \Exception("Missing field : `password`");
        }

        // check email is valid
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Bad format for field : `mail`");
        }

        // if email changed
        if ($mail !== $user->getMail()) {
            // check email does not exist
            if ($userRepository->findBy(['mail' => $mail])) {
                throw new \Exception("Mail already registered");
            }
        }

        // insert in bd
        $user->setMail($mail);
        if ($password) {
            $user->setPassword(hash('sha256', $password));
        }

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $this->getDoctrine()->getManager()->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse([
            'user_id' => $user->getId(),
            'mail' => $user->getMail(),
            'pseudoGame' => $user->getPseudoGame(),
        ]);
    }
}
