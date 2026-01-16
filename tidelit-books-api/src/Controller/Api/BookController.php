<?php

namespace App\Controller\Api;

use App\Entity\Review;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/api/books', name: 'api_books_list', methods: ['GET'])]
    public function list(BookRepository $bookRepository): JsonResponse
    {
        $books = $bookRepository->findAllWithAverageRating();

        $response = [];

        foreach ($books as $book) {
            $response[] = [
                'title' => $book['title'],
                'author' => $book['author'],
                'published_year' => $book['publishedYear'],
                'average_rating' => $book['average_rating'] !== null
                    ? round((float) $book['average_rating'], 2)
                    : null,
            ];
        }

        return new JsonResponse($response);
    }
#[Route('/api/reviews', name: 'api_reviews_create', methods: ['POST'])]
public function createReview(
    Request $request,
    BookRepository $bookRepository,
    EntityManagerInterface $entityManager
): JsonResponse {
    $data = json_decode($request->getContent(), true);

    if (!$data) {
        return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
    }

    if (!isset($data['book_id'], $data['rating'], $data['comment'])) {
        return new JsonResponse(['error' => 'Missing fields'], Response::HTTP_BAD_REQUEST);
    }

    $book = $bookRepository->find($data['book_id']);

    if (!$book) {
        return new JsonResponse(['error' => 'Book not found'], Response::HTTP_BAD_REQUEST);
    }

    $rating = (int) $data['rating'];
    if ($rating < 1 || $rating > 5) {
        return new JsonResponse(['error' => 'Rating must be between 1 and 5'], Response::HTTP_BAD_REQUEST);
    }

    if (trim($data['comment']) === '') {
        return new JsonResponse(['error' => 'Comment cannot be empty'], Response::HTTP_BAD_REQUEST);
    }

    $review = new Review();
    $review->setBook($book);
    $review->setRating($rating);
    $review->setComment($data['comment']);
    $review->setCreatedAt(new \DateTime());

    $entityManager->persist($review);
    $entityManager->flush();

    return new JsonResponse(
        [
            'id' => $review->getId(),
            'created_at' => $review->getCreatedAt()->format('Y-m-d H:i:s'),
        ],
        Response::HTTP_CREATED
    );
}


}

