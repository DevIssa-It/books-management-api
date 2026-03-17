# Dokumentasi API Manajemen Buku

Ini adalah dokumentasi untuk API manajemen buku yang telah dibuat.

## 1. Link Proyek Github

[Silakan ganti dengan link ke repositori Github Anda](https://github.com/user/repo)

## 2. Pengujian API menggunakan Postman

Berikut adalah contoh bagaimana melakukan pengujian setiap endpoint menggunakan Postman.

**Catatan:** Pastikan Anda menjalankan server Laravel Anda (`php artisan serve`) dan database Anda sudah di-migrasi (`php artisan migrate`).

### GET /api/books (Index)

*   **Method:** `GET`
*   **URL:** `http://127.0.0.1:8000/api/books`
*   **Headers:**
    *   `Accept: application/json`

*   **Contoh Response (Success):**
    ```json
    {
        "success": true,
        "message": "List Data Buku",
        "data": {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "title": "Judul Buku Pertama",
                    "author": "Penulis Pertama",
                    "publisher": "Penerbit Pertama",
                    "year": "2023",
                    "created_at": "2026-03-17T10:00:00.000000Z",
                    "updated_at": "2026-03-17T10:00:00.000000Z"
                }
            ],
            "first_page_url": "http://127.0.0.1:8000/api/books?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://127.0.0.1:8000/api/books?page=1",
            "links": [
                // ...
            ],
            "next_page_url": null,
            "path": "http://127.0.0.1:8000/api/books",
            "per_page": 10,
            "prev_page_url": null,
            "to": 1,
            "total": 1
        }
    }
    ```

### POST /api/books (Store)

*   **Method:** `POST`
*   **URL:** `http://127.0.0.1:8000/api/books`
*   **Headers:**
    *   `Accept: application/json`
    *   `Content-Type: application/json`
*   **Body (raw, JSON):**
    ```json
    {
        "title": "Buku Baru",
        "author": "Penulis Baru",
        "publisher": "Penerbit Baru",
        "year": "2024"
    }
    ```

*   **Contoh Response (Success):**
    ```json
    {
        "success": true,
        "message": "Buku Berhasil Ditambahkan!",
        "data": {
            "id": 2,
            "title": "Buku Baru",
            "author": "Penulis Baru",
            "publisher": "Penerbit Baru",
            "year": "2024",
            "updated_at": "2026-03-17T10:05:00.000000Z",
            "created_at": "2026-03-17T10:05:00.000000Z"
        }
    }
    ```

### GET /api/books/{id} (Show)

*   **Method:** `GET`
*   **URL:** `http://127.0.0.1:8000/api/books/1`
*   **Headers:**
    *   `Accept: application/json`

*   **Contoh Response (Success):**
    ```json
    {
        "success": true,
        "message": "Detail Data Buku",
        "data": {
            "id": 1,
            "title": "Judul Buku Pertama",
            "author": "Penulis Pertama",
            "publisher": "Penerbit Pertama",
            "year": "2023",
            "created_at": "2026-03-17T10:00:00.000000Z",
            "updated_at": "2026-03-17T10:00:00.000000Z"
        }
    }
    ```

### PUT /api/books/{id} (Update)

*   **Method:** `PUT`
*   **URL:** `http://127.0.0.1:8000/api/books/1`
*   **Headers:**
    *   `Accept: application/json`
    *   `Content-Type: application/json`
*   **Body (raw, JSON):**
    ```json
    {
        "title": "Judul Buku Diedit",
        "author": "Penulis Diedit",
        "publisher": "Penerbit Diedit",
        "year": "2025"
    }
    ```

*   **Contoh Response (Success):**
    ```json
    {
        "success": true,
        "message": "Buku Berhasil Diubah!",
        "data": {
            "id": 1,
            "title": "Judul Buku Diedit",
            "author": "Penulis Diedit",
            "publisher": "Penerbit Diedit",
            "year": "2025",
            "created_at": "2026-03-17T10:00:00.000000Z",
            "updated_at": "2026-03-17T10:10:00.000000Z"
        }
    }
    ```

### DELETE /api/books/{id} (Destroy)

*   **Method:** `DELETE`
*   **URL:** `http://127.0.0.1:8000/api/books/1`
*   **Headers:**
    *   `Accept: application/json`

*   **Contoh Response (Success):**
    ```json
    {
        "success": true,
        "message": "Buku Berhasil Dihapus!",
        "data": null
    }
    ```

## 3. Alur Kerja Endpoint

Berikut adalah penjelasan alur kerja untuk setiap endpoint dari request hingga response.

1.  **Request URL:** Pengguna atau klien mengirim request HTTP ke URL tertentu (misalnya, `GET /api/books`).
2.  **Route (`routes/api.php`):** Laravel menerima request dan mencocokkannya dengan route yang terdaftar di `routes/api.php`. Dalam kasus ini, `Route::apiResource('/books', BookController::class);` menangani semua endpoint RESTful untuk buku.
3.  **Controller (`BookController.php`):** Route yang cocok akan memanggil metode yang sesuai di `BookController`.
    *   `GET /api/books` -> `index()`
    *   `POST /api/books` -> `store()`
    *   `GET /api/books/{id}` -> `show()`
    *   `PUT /api/books/{id}` -> `update()`
    *   `DELETE /api/books/{id}` -> `destroy()`
4.  **Logic & Model:** Di dalam metode controller, logika bisnis dieksekusi. Ini biasanya melibatkan interaksi dengan database melalui Model Eloquent (`Book.php`).
    *   `index()`: Mengambil semua buku.
    *   `store()`: Memvalidasi data input dan menyimpan buku baru.
    *   `show()`: Mencari satu buku berdasarkan ID.
    *   `update()`: Memvalidasi data input dan memperbarui buku yang ada.
    *   `destroy()`: Menghapus buku dari database.
5.  **Resource (`BookResource.php`):** Sebelum mengirim data kembali, controller membungkusnya dengan `BookResource`. Kelas ini bertanggung jawab untuk memformat data (misalnya, menambahkan field `success` dan `message`) menjadi struktur JSON yang konsisten.
6.  **Response:** Laravel mengirimkan response JSON yang telah diformat oleh Resource kembali ke klien dengan status code HTTP yang sesuai.

## 4. Penamaan Fungsi Controller pada `apiResource`

**Pertanyaan:** Dalam penggunaan `ApiResource`, mengapa penamaan fungsi di controller harus `index`, `store`, `show`, `update`, `destroy`? Bisakah kita mengubah `store` menjadi `simpan`?

**Jawaban:**

Ya, penamaan tersebut adalah **konvensi** yang ditetapkan oleh Laravel untuk `resource controllers`. Ketika Anda menggunakan `Route::apiResource(...)` atau `Route::resource(...)`, Laravel secara otomatis memetakan metode HTTP dan URL ke nama-nama metode standar ini.

**Tabel Pemetaan `apiResource`:**

| Verb (Metode HTTP) | URI                  | Action (Metode Controller) | Route Name      |
| ------------------ | -------------------- | -------------------------- | --------------- |
| `GET`              | `/books`             | `index`                    | `books.index`   |
| `POST`             | `/books`             | `store`                    | `books.store`   |
| `GET`              | `/books/{book}`      | `show`                     | `books.show`    |
| `PUT`/`PATCH`      | `/books/{book}`      | `update`                   | `books.update`  |
| `DELETE`           | `/books/{book}`      | `destroy`                  | `books.destroy` |

**Bisakah mengubah `store` menjadi `simpan`?**

**Bisa**, tetapi Anda **tidak bisa lagi menggunakan `Route::apiResource`** secara langsung untuk route tersebut. Anda harus mendefinisikan route tersebut secara manual.

Jika Anda ingin menggunakan nama metode `simpan` untuk membuat buku baru, Anda harus mengubah file `routes/api.php` Anda seperti ini:

```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

// Definisikan route untuk 'simpan' secara manual
Route::post('/books', [BookController::class, 'simpan'])->name('books.simpan');

// Anda masih bisa menggunakan apiResource untuk route lainnya,
// tetapi Anda perlu mengecualikan 'store' agar tidak ada duplikasi.
Route::apiResource('/books', BookController::class)->except(['store']);

// Atau, jika Anda ingin mendefinisikan semuanya secara manual:
// Route::get('/books', [BookController::class, 'index']);
// Route::get('/books/{id}', [BookController::class, 'show']);
// Route::put('/books/{id}', [BookController::class, 'update']);
// Route::delete('/books/{id}', [BookController::class, 'destroy']);
```

Kemudian di `BookController.php`, Anda akan mengganti nama metode `store` menjadi `simpan`.

**Kesimpulan:** Mengikuti konvensi (`index`, `store`, `show`, `update`, `destroy`) sangat disarankan karena membuat kode Anda lebih mudah dibaca, diprediksi, dan konsisten dengan ekosistem Laravel. Ini juga memungkinkan Anda memanfaatkan fitur seperti `Route::apiResource` secara maksimal. Mengubahnya memerlukan konfigurasi route manual.
