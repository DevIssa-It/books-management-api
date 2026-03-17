<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return new BookResource(true, 'List Data Buku', $books);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required|string|max:255',
            'author'    => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year'      => 'required|integer|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book = Book::create($request->only(['title', 'author', 'publisher', 'year']));

        return new BookResource(true, 'Buku Berhasil Ditambahkan!', $book);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Buku Tidak Ditemukan!'], 404);
        }

        return new BookResource(true, 'Detail Data Buku', $book);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required|string|max:255',
            'author'    => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year'      => 'required|integer|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book = Book::find($id);

        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Buku Tidak Ditemukan!'], 404);
        }

        $book->update($request->only(['title', 'author', 'publisher', 'year']));

        return new BookResource(true, 'Buku Berhasil Diubah!', $book);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Buku Tidak Ditemukan!'], 404);
        }

        $book->delete();

        return new BookResource(true, 'Buku Berhasil Dihapus!', null);
    }
}
