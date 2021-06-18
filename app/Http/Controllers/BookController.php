<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Utils\ApiResponse;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller

{

    use ApiResponse;

    /**
     * variable for getting book service
     * 
     */
    public $bookService;


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
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Return list of books
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->bookService->getBooks());
    }

    /**
     * Store new book data
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = $this->authorService->getAuthor($request->input("author_id"));
        return $this->successResponse($this->bookService->createBook($request->all()));
    }

    /**
     * Show book detail
     * @return Illuminate\Http\Response
     */
    public function show($bookId)
    {
        return $this->successResponse($this->bookService->getBook($bookId));
    }

    /**
     * Store new book data
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $bookId)
    {
        return $this->successResponse($this->bookService->editBook($bookId, $request->all()));
    }

    /**
     * Show book detail
     * @return Illuminate\Http\Response
     */
    public function destroy($bookId)
    {
        return $this->successResponse($this->bookService->deleteBook($bookId));
    }
}
