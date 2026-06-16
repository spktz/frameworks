<?php

namespace App\Controller;

use App\Entity\Currency;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/currencies')]
class CurrencyController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $currencies = $entityManager->getRepository(Currency::class)->findAll();
        $data = [];
        foreach ($currencies as $currency) {
            $data[] = [
                'id' => $currency->getId(),
                'code' => $currency->getCode(),
                'name' => $currency->getName(),
                'rate' => $currency->getRate(),
            ];
        }
        return $this->json($data, Response::HTTP_OK);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $currency = new Currency();
        $currency->setCode($data['code'] ?? '');
        $currency->setName($data['name'] ?? '');
        $currency->setRate((float)($data['rate'] ?? 0));

        $entityManager->persist($currency);
        $entityManager->flush();

        return $this->json([
            'id' => $currency->getId(),
            'code' => $currency->getCode(),
            'name' => $currency->getName(),
            'rate' => $currency->getRate()
        ], Response::HTTP_CREATED);
    }

    #[Route('/{id<\d+>}', methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $currency = $entityManager->getRepository(Currency::class)->find($id);
        if (!$currency) return $this->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);

        return $this->json([
            'id' => $currency->getId(),
            'code' => $currency->getCode(),
            'name' => $currency->getName(),
            'rate' => $currency->getRate()
        ], Response::HTTP_OK);
    }

    #[Route('/{id<\d+>}', methods: ['PATCH'])]
    public function update(int $id, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $currency = $entityManager->getRepository(Currency::class)->find($id);
        if (!$currency) return $this->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);

        $data = json_decode($request->getContent(), true);
        if (isset($data['code'])) $currency->setCode($data['code']);
        if (isset($data['name'])) $currency->setName($data['name']);
        if (isset($data['rate'])) $currency->setRate((float)$data['rate']);

        $entityManager->flush();
        return $this->json(['message' => 'Updated'], Response::HTTP_OK);
    }

    #[Route('/{id<\d+>}', methods: ['DELETE'])]
    public function delete(int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        $currency = $entityManager->getRepository(Currency::class)->find($id);
        if (!$currency) return $this->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);

        $entityManager->remove($currency);
        $entityManager->flush();
        return $this->json(['message' => 'Deleted'], Response::HTTP_NO_CONTENT);
    }
}
