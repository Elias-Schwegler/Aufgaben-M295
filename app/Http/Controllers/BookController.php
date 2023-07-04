<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function getBooks()
    {
        return Book::get();
    }

    public function getBookById(int $id)
    {
        return Book::find($id);
    }

    public function getBooksBySlug(string $slug)
    {
        return Book::where('slug','like', $slug.'%')->get();
    }

    public function getBooksByYear(int $year)
    {
        return Book::where('year', $year)->get();
    }

    public function getBooksByMaxPages(int $pages)
    {
        return Book::where('pages', '<', $pages)->get();
    }

    public function searchBooks(string $search)
    {
        return Book::where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')->get();
    }

    public function countBooks()
    {
        return ['count' => Book::count()];
    }

    public function avgPages()
    {
        return ['avg-pages' => Book::avg('pages')];
    }
/*
    public function dashboard()
    {
        return [
            'books' => Book::count(),
            'pages' => Book::sum('pages'),
            'oldest' => Book::orderBy('year', 'asc')->first()->title,
            'newest' => Book::orderBy('year', 'desc')->first()->title,
        ];
    }
 */
    public function dashboard()
    {
        $books = Book::all();
        #perfonmance increase, because only one select instead of 4 selects
        return [
            'books' => $books::count(),
            'pages' => $books::sum('pages'),
            'oldest' => Book::orderBy('year', 'asc')->first()->title,
            'newest' => Book::orderBy('year', 'desc')->first()->title,
        ];
    }
}
#