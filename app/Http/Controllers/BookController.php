<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function PHPUnit\Framework\fileExists;

class BookController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');

        if ($status) {
            $items = Book::with('categories')->where('status', strtoupper($status))->paginate(5);
        } else {
            $items = Book::with('categories')->paginate(5);
        }

        return view('pages.book.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_book = new Book;

        $new_book->title = $request->get('title');
        $new_book->description = $request->get('description');
        $new_book->stock = $request->get('stock');
        $new_book->author = $request->get('author');
        $new_book->publisher = $request->get('publisher');
        $new_book->price = $request->get('price');

        $new_book->status = $request->get('save_action');

        // menangkap file upload cover
        $cover = $request->file('cover');
        // jika ada ? masukan ke directory book-cover didalam public
        if ($cover) {
            $path = $cover->store('book-covers', 'public');
            $new_book->cover = $path;
        }

        // slug tangkap dari title
        $new_book->slug = Str::slug($request->get('title'));

        // created_by berdasarkan id
        $new_book->created_by = Auth::user()->id;

        // save & masukan ke db
        $new_book->save();

        $new_book->Categories()->attach($request->get('categories'));

        // redirect dngn pesan berdasarkan pilihan save PUBLISH or DRAFT
        if ($request->get('save_action') == 'PUBLISH') {
            return redirect()
                ->route('book.index')
                ->with('status', 'Book saved as published is successfully');
        } else {
            return redirect()
                ->route('book.index')
                ->with('status', 'Book saved as draft is successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Book::findOrFail($id);

        return view('pages.book.details', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Book::findOrFail($id);

        return view('pages.book.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $book->title = $request->get('title');
        $book->description = $request->get('description');
        $book->stock = $request->get('stock');
        $book->author = $request->get('author');
        $book->publisher = $request->get('publisher');
        $book->price = $request->get('price');

        // edit image
        if ($request->file('cover')) {

            if ($book->cover && fileExists(storage_path('app/public/' . $book->cover))) {
                Storage::delete('public/' . $book->cover);
            }

            $update_cover = $request->file('cover')->store('book-covers', 'public');

            $book->cover = $update_cover;
        }

        $book->status = $request->get('status');

        $book->updated_by = Auth::user()->id;

        // update yang diambil dari ajak
        $book->categories()->sync($request->get('categories'));

        $book->save();

        return redirect()->route('book.index')
            ->with('status', 'Updated book is succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();

        return redirect()->route('book.index')
            ->with('status', 'Deleted book is successfully, moved to trash.');
    }


    public function trash(Request $request)
    {
        $status = $request->get('status');

        if ($status) {
            $book_trash = Book::onlyTrashed()->where('status', strtoupper($status))->paginate(5);
        } else {
            $book_trash = Book::onlyTrashed()->paginate(5);
        }

        return view('pages.book.trash', [
            'book_trash' => $book_trash
        ]);
    }

    public function restore($id)
    {
        $book_restore = Book::withTrashed()
            ->findOrFail($id);

        if ($book_restore->trashed()) {
            $book_restore->restore();
        } else {
            return redirect()->route('book.index')
                ->with('status', 'Category is not in trash ');
        }
        return redirect()->route('book-trash')
            ->with('status', 'Restore is successfully');
    }

    public function deletePermanent($id)
    {
        $delete_book = Book::withTrashed()->findOrFail($id);

        if (!$delete_book->trashed()) {

            return redirect()->route('book-trash')->with('status', 'can not delete book beacause status active ');
        }

        $delete_book->forceDelete();
        return redirect()->route('book-trash')->with('status', 'delete permanent is successfully');
    }
}
