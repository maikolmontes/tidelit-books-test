<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Books
        $book1 = new Book();
        $book1->setTitle('El Arte de Programar');
        $book1->setAuthor('Donald Knuth');
        $book1->setPublishedYear(1968);
        $manager->persist($book1);

        $book2 = new Book();
        $book2->setTitle('Clean Code');
        $book2->setAuthor('Robert C. Martin');
        $book2->setPublishedYear(2008);
        $manager->persist($book2);

        $book3 = new Book();
        $book3->setTitle('Refactoring');
        $book3->setAuthor('Martin Fowler');
        $book3->setPublishedYear(1999);
        $manager->persist($book3);

        // Reviews
        $reviews = [
            [$book1, 5, 'Excelente libro'],
            [$book1, 4, 'Muy completo'],
            [$book2, 5, 'Imprescindible'],
            [$book2, 4, 'Muy buenas prácticas'],
            [$book3, 3, 'Bueno pero denso'],
            [$book3, 4, 'Recomendado'],
        ];

        foreach ($reviews as [$book, $rating, $comment]) {
            $review = new Review();
            $review->setBook($book);
            $review->setRating($rating);
            $review->setComment($comment);
            $review->setCreatedAt(new \DateTime());
            $manager->persist($review);
        }

        $manager->flush();
    }
}

