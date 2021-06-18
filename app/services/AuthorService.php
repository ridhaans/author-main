<?php

namespace App\Services;

use App\Utils\ConsumeExternalService;

class AuthorService
{

    use ConsumeExternalService;

    public $baseUri;
    public $secretKey;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secretKey = config('services.authors.secret_key');
    }

    public function getAuthors()
    {
        return $this->performRequest('GET', '/authors');
    }

    public function getAuthor($id)
    {
        return $this->performRequest('GET', "/authors/{$id}");
    }

    public function createAuthor($input)
    {
        return $this->performRequest('POST', '/authors', $input);
    }

    public function editAuthor($id, $input = [])
    {
        return $this->performRequest('PUT', "/authors/{$id}", $input);
    }

    public function deleteAuthor($id)
    {
        return $this->performRequest('DELETE', "/authors/{$id}");
    }
}
