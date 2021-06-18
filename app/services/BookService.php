<?php

namespace App\Services;

use App\Utils\ConsumeExternalService;

class BookService
{

    use ConsumeExternalService;

    public $baseUri;
    public $secretKey;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secretKey = config('services.books.secret_key');
    }

    public function getBooks()
    {
        return $this->performRequest('GET', '/books');
    }

    public function getBook($id)
    {
        return $this->performRequest('GET', "/books/{$id}");
    }

    public function createBook($input)
    {
        return $this->performRequest('POST', '/books', $input);
    }

    public function editBook($id, $input = [])
    {
        return $this->performRequest('PUT', "/books/{$id}", $input);
    }

    public function deleteBook($id)
    {
        return $this->performRequest('DELETE', "/books/{$id}");
    }
}
