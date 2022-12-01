<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Book;

class BooksController extends Controller
{
    /**
     * Get Books By API
     */
    public function getBooks() {
        $responseMsg = '';

        $response = Http::withHeaders([
            'Authorization' => 'AppRinger' 
        ])->get('https://run.mocky.io/v3/821d47eb-b962-4a30-9231-e54479f1fbdf');

        $response = json_decode($response);
        // dd($response);
        if ( !empty($response) && !empty($response->items) ) {
            $books = $response->items;
            $no_of_insert = 0;

            foreach ( $books as $book ) {
                // if book id is exist
                $booksObj = Book::where('book_id', $book->id)->get()->first();

                if ( $booksObj ) {  // if book id is exist
                    continue;
                }
                
                $no_of_insert++;

                $booksObj = new Book();
                $booksObj->book_id = $book->id;

                // get book information
                $bookInfo = ( isset($book->volumeInfo) && !empty($book->volumeInfo) ) ? $book->volumeInfo : false;

                if ( $bookInfo ) {
                    $title = isset( $bookInfo->title ) ? $bookInfo->title : '( no title )';
                    $subtitle = isset( $bookInfo->subtitle ) ? $bookInfo->subtitle : '( no sub title )';
                    
                    $authors = '( no author )';
                    if ( isset( $bookInfo->authors ) ) {
                        $authors = is_array( $bookInfo->authors ) ? implode(', ', $bookInfo->authors) : $bookInfo->authors;
                    }

                    $booksObj->title = $title;
                    $booksObj->subtitle = $subtitle;
                    $booksObj->authors = $authors;

                    // get book images
                    $bookImage = isset( $bookInfo->imageLinks ) ? $bookInfo->imageLinks : '';
                    if ( $bookImage ) {
                        $thumbnail = isset( $bookImage->thumbnail ) ? $bookImage->thumbnail : '';
                        $smallThumbnail = isset( $bookImage->smallThumbnail ) ? $bookImage->smallThumbnail : '';

                        $booksObj->thumbnail = $thumbnail;
                        $booksObj->small_thumbnail = $smallThumbnail;
                    }
                }

                $booksObj->save();
            }

            return redirect()->route('showBooks')->with('success', "$no_of_insert books have been added.");
        } else {
            return redirect()->route('showBooks')->with('success', 'There is no books to add.');
        }
    }

    /**
     * Display Books
     */
    public function showBooks() {
        // fetch all books
        $books = Book::paginate(6);
        
        return view('books.view_book', compact('books'));
    }
}
