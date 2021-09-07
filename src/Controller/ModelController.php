<?php

namespace App\Controller;

use App\Repository\ModelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/api/model")
 */
class ModelController extends AbstractController
{
    /**
     * @Route("/findAll", name="model_fidnAll",methods={"GET"})
     */
    public function findAll(ModelRepository $repo): Response
    {   $models = $repo->findAll();
        return $this->json($models,200,[], [
            "groups" => ["model"]
        ]);
    }

    /**
     * @Route("/findOne/{modelId}", name="model_fidnOne",methods={"GET"}, requirements={"id":"\d+"})
     */
    public function findOne(ModelRepository $repo,$modelId): Response
    {   $model = $repo->findBy(["id" => $modelId]);
        return $this->json($model,200,[], [
            "groups" => ["model"]
        ]);
    }
}
