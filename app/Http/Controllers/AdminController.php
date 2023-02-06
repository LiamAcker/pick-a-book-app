<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookLibrary;
use App\Models\Category;
use App\Models\Language;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends BaseController
{
    public function deleteBook($bookId){
        $userId = Auth::user()->id;
        $libraryId = Admin::where('userId', $userId)->first()->libraryId;
        BookLibrary::where('bookId', '=', $bookId, 'and')->where('libraryId', $libraryId)->delete();

        return redirect()->route('manageBook');
    }

    public function edit($bookId){

        $currBook = Book::where('bookId', $bookId)->first()->bookId;
        $authors = Author::get(); // Eloquent?
        $publishers = Publisher::get();
        $languages = Language::get();
        $categories = Category::get();
        return view('updateBook', compact('currBook', 'publishers', 'languages', 'categories', 'authors'));

    }

    public function updateBook(Request $request, $bookId){

        $image = $request->file('inputImage');
        $imageName = $image->getClientOriginalName();

        // Please check path
        Storage::putFileAs('public/images/books/', $image, $imageName);
        $inputPhotopath = $imageName;

        Book::where('id', $bookId) //Eloquent?
        ->update([
            'authorId' => $request->inputAuthor,
            'publisherId' => $request->inputPublisher,
            'title' => $request->inputTitle,
            'ISBN' => $request->inputISBN,
            'photoPath' => $inputPhotopath,
            'synopsis' => $request->inputSynopsis,
            'languageId' => $request->inputLanguageId,
            'publishedYear' => $request->inputPublishedYear,
            'weight' => $request->inputWeight,
        ]);

        BookCategory::where('bookId', $bookId)
        ->first()
        ->update([
            'categoryId' => $request->categoryId
        ]);

        return redirect()->route('manageBook');

    }

}
