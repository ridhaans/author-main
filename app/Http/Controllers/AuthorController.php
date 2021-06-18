<?php

namespace App\Http\Controllers;

use App\Utils\ApiResponse;
use App\Services\AuthorService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller

{
    use ApiResponse;

    /**
     * variable for getting auth service
     * 
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Return list of authors
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->authorService->getAuthors());
    }

    /**
     * Store new author data
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all()));
    }

    /**
     * Show author detail
     * @return Illuminate\Http\Response
     */
    public function show($authorId)
    {
        return $this->successResponse($this->authorService->getAuthor($authorId));
    }

    /**
     * Store new author data
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $authorId)
    {
        return $this->successResponse($this->authorService->editAuthor($authorId, $request->all()));
    }

    /**
     * Show author detail
     * @return Illuminate\Http\Response
     */
    public function destroy($authorId)
    {
        return $this->successResponse($this->authorService->deleteAuthor($authorId));
    }
}
