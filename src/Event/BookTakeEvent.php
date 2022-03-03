<?php

namespace App\Event;

use App\Entity\Book;
use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class BookTakeEvent extends Event
{
    const NAME = 'book.take';
    private User $user;
    private Book $book;

    public function __construct(User $user, Book $book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Book
     */
    public function getBook(): Book
    {
        return $this->book;
    }

}