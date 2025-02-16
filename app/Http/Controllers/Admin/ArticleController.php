<?php
// app/Http/Controllers/Admin/ArticleController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Статья успешно создана.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Статья успешно обновлена.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Статья успешно удалена.');
    }
}
