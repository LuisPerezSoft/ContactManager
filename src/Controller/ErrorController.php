<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class ErrorController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/error", name="app_error")
     */
    public function show(\Throwable $exception): Response
    {
        if ($exception instanceof NotFoundHttpException) {
            if (!$this->security->isGranted('IS_AUTHENTICATED_FULLY')) {
                return new RedirectResponse($this->generateUrl('app_login'));
            }

            return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
        }

        throw $exception;
    }
}
