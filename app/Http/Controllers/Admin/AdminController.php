<?php
// app/Http/Controllers/Admin/AdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Memory;
use App\Models\Media;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'memories' => Memory::count(),
            'pending_memories' => Memory::pending()->count(),
            'media' => Media::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
