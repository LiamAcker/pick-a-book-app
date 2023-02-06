<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookLibrary;
use App\Models\CartDetail;
use App\Models\CartHeader;
use App\Models\Category;
use App\Models\Library;
use App\Models\Publisher;
use App\Models\Language;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class BookController extends BaseController
{
    public function home(){
        // $books = DB::table('books');
        // return view('home', compact('books'));
        // return view('home');
        $books_editorsPick = Book::whereRelation('group', 'groupId', 1)->limit(3)->get();
        $books_popular = Book::whereRelation('group', 'groupId', 2)->limit(3)->get();
        $books = Book::whereRelation('group', 'groupId', 3)->limit(3)->get();
        // change n in take(n) to change the number of authors shown
        $authors = Author::all()->shuffle()->take(6);
        $colours = ['primary', 'dark', 'danger', 'warning', 'success'];
        // dd($books_newRelease);
        return view('home', compact('books', 'books_popular', 'books_editorsPick', 'authors', 'colours'));
    }

    public function newRelease(){
        $books = Book::whereRelation('group', 'groupId', 3)->Paginate(4);
        return view('newRelease', compact('books'));
    }

    public function popularBooks(){
        $books_popular = Book::whereRelation('group', 'groupId', 2)->Paginate(4);
        return view('popularBooks', compact('books_popular'));
    }

    public function editorsPick(){
        $books_editorsPick = Book::whereRelation('group', 'groupId', 1)->Paginate(4);
        return view('editorsPick', compact('books_editorsPick'));
    }

    public function viewAll(){
        $books = Book::Paginate(8);
        return view('books', compact('books'));
    }

    public function searchBook(Request $request){
        $books = Book::where('title', 'LIKE', "%$request->q%")->Paginate(8);
        return view('books', compact('books'));
    }

    // param boleh id, boleh ISBN. ISBN might be better.
    public function bookDetail($id){
        $book = Book::whereId($id)->first();

        $stock = 0;

        // book exists in at least 1 library
        if(BookLibrary::where('bookId', $id)->first()){
            $stock = BookLibrary::groupBy('bookId')
            ->selectRaw('SUM(`stock`) as total_stock')
            ->where('bookId', $id)
            ->first()->total_stock;
        }

        // dd($book);
        if(Auth::user()->role_id == 1){
            return view('bookDetailAdmin', compact('book', 'stock'));
        }
        else if(Auth::user()->role_id == 2){
            return view('bookDetailMember', compact('book', 'stock'));
        }
        else{
            return redirect()->route('home');
        }
    }

    public function addBookToCart(Request $request, $bookId){
        $userId = Auth::user()->id;
        $libraryId = $request['library'];

        //if user didn't choose a library
        if($libraryId == 0){
            return redirect()->back()->withErrors('Choose a library');
        }

        //create cartHeader if doesn't exist
        if(!CartHeader::where('memberId', '=', $userId, 'and')->where('libraryId', $libraryId)->first()){
            $cartHeader = new CartHeader();
            $cartHeader->memberId = $userId;
            $cartHeader->libraryId =$libraryId;
            $cartHeader->save();
        }
        $cartHeaderId = CartHeader::where('memberId', '=', $userId, 'and')->where('libraryId', $libraryId)->first()->id;

        //validate if book already in cart
        $libraryName = Library::whereId($libraryId)->first()->name;
        if(CartDetail::where('cartHeaderId', '=', $cartHeaderId, 'and')->where('bookId', $bookId)->first()){
            return redirect()->back()->withErrors('This book from '.$libraryName.'is already in cart');
        }

        $cartDetail = new CartDetail();
        $cartDetail->cartHeaderId = $cartHeaderId;
        $cartDetail->bookId = $bookId;
        $cartDetail->save();

        return redirect()->route('cart');
    }

    public function category($name){
        $category = Category::where('name', $name)->first();
        if($category == NULL){
            return redirect()->route('home');
        }

        $books = Book::whereHas('category', function($x) use ($name){
            $x->where('name', $name);
        })->orderBy('books.id')->get();
        return view('category', compact('books', 'name'));
    }

    public function bookAuthor($name){
        $author = Author::where('name', $name)->first();
        if($author == NULL){
            return redirect()->route('home');
        }

        $books = Book::whereHas('author', function($x) use ($name){
            $x->where('name', $name);
        })->orderBy('books.id')->get();
        return view('booksByAuthor', compact('books', 'name', 'author'));
    }

    public function getBookDetail(){
        $userId = Auth::user()->id;
        $libraryId = Admin::where('userId', $userId)->get()->first()->libraryId;
        $books = Book::whereRelation('library', 'libraryId', $libraryId)->get();
        // dd($books);
        return view('manageBook', compact('books'));
    }

    public function updateBook($bookId){
        $currBook = Book::where('id', $bookId)->first();
        $authors = Author::get();
        $publishers = Publisher::get();
        $languages = Language::get();
        $categories = Category::get();

        $userId = Auth::user()->id;
        $libraryId = Admin::where('userId', $userId)->get()->first()->libraryId;
        $currStock = BookLibrary::where('bookId', '=', $bookId, 'and')->where('libraryId', $libraryId)->first()->stock;
        return view('updateBook', compact('currBook', 'publishers', 'languages', 'categories', 'authors', 'currStock'));
    }

    public function updateBooktoMaster(Request $request, $bookId){

        // $image = $request->file('inputImage');
        // $imageName = $image->getClientOriginalName();

        // Please check path
        // Storage::putFileAs('public/images/books/', $image, $imageName);
        // $inputPhotopath = $imageName;

        //validate input first
        $request->validate([
            'isbn' => 'required|min:10|max:13|unique:books,isbn',
            'title' => 'required|min:5|string',
            'synopsis' => 'required|min:5',
            'publishedYear' => 'required|min:4|max:4',
            'stock' => 'required|min:1',
            'author' => 'required',
            'language' => 'required',
            'publisher' => 'required',
            'weight' => 'required|min:1'
        ]);

        //Update Book Details
        Book::where('id', $bookId) //Eloquent?
        ->update([
            'authorId' => $request->author,
            'publisherId' => $request->publisher,
            'title' => $request->title,
            'ISBN' => $request->isbn,
            'synopsis' => $request->synopsis,
            'languageId' => $request->language,
            'publishedYear' => $request->publishedYear,
            'weight' => $request->weight,
        ]);


        //Update Stock at Library
        $userId = Auth::user()->id;
        $libraryId = Admin::where('userId', $userId)->first()->libraryId;

        BookLibrary::where('libraryId', '=', $libraryId, 'and')
        ->where('bookId', $bookId)
        ->update([
            'stock' => $request->stock
        ]);

        return redirect()->route('manageBook');

    }


    public function insertBook(){
        $authors = DB::table('authors')->get();
        $publishers = DB::table('publishers')->get();
        $languages = DB::table('languages')->get();
        $categories = DB::table('categories')->get();
        return view('insertBook', compact('publishers', 'authors', 'languages', 'categories'    ));

    }

    public function insertBooktoMaster(Request $request){
        $request->validate([
            'isbn' => 'required|min:10|max:13|unique:books,isbn',
            'title' => 'required|min:5|string',
            'synopsis' => 'required|min:5',
            'publishedYear' => 'required|min:4|max:4',
            'author' => 'required',
            'language' => 'required',
            'category' => 'required',
            'publisher' => 'required',
            'weight' => 'required|min:1',
            'inputImage' => 'required|file'
        ]);

        $image = $request->file('inputImage');
        $imageName = $image->getClientOriginalName();

        // Please check path
        Storage::putFileAs('public/images/books/', $image, $imageName);
        $inputPhotopath = $imageName;

        $newBook = new Book();
        $newBook->authorId = $request->input('author');
        $newBook->publisherId = $request->input('publisher');
        $newBook->title = $request->input('title');
        $newBook->ISBN = $request->input('isbn');
        $newBook->photoPath = $inputPhotopath;
        $newBook->synopsis = $request->input('synopsis');
        $newBook->languageId = $request->input('language');
        $newBook->publishedYear = $request->input('publishedYear');
        $newBook->weight = $request->input('weight');
        $newBook->save();


        //add new BookId to a category?

        $bookId = Book::latest()->first()->id;
        $newBookCategories = new BookCategory();
        $newBookCategories->bookId = $bookId;
        $newBookCategories->categoryId = $request->input('category');
        $newBookCategories->save();

        return redirect()->route('manageBook');

    }

    public function viewAddToLibrary(){
        $books = Book::all();
        return view('addToLibrary', compact('books'));
    }

    public function addToLibrary(Request $request){

        $request->validate([
            'isbn' => 'required|min:10|max:13|',
            'stock' => 'required|min:1',
        ]); //Validate ISBN

        if (!Book::where('ISBN', '=', $request->input('isbn'))->exists()) {

            return redirect()->back()->withErrors('ISBN not found. Please insert the book first.');
        }

        // book found
        $currBookId = Book::where('ISBN', $request->input('isbn'))->first()->id;

        $userId = Auth::user()->id;
        $libraryId = Admin::where('userId', $userId)->first()->libraryId;

        //check if book already in library
        if(BookLibrary::where('bookId', '=', $currBookId, 'and')->where('libraryId', $libraryId)->first() != null){
            return redirect()->back()->withErrors('Book exists');
        }

        $newBookLibrary = new BookLibrary();
        $newBookLibrary->bookId = $currBookId;
        $newBookLibrary->libraryId = $libraryId;
        $newBookLibrary->stock = $request->input('stock');
        $newBookLibrary->save(); //Add to Library

        return redirect()->route('manageBook');

    }

    public function history(){
        return view('history');
    }
}
