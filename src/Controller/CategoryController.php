<?php


namespace Hillel\Homework11\Controller;

use Hillel\Homework11\Model\Category;
use Illuminate\Http\RedirectResponse;


class CategoryController
{
    public function list()
    {

        $categories = Category::paginate(3);
        return view('pages/categories/table', compact('categories'));
    }

    public function create()
    {

        $category = new Category();

        return view('pages/categories/form', compact('category'));
    }

    public function store()
    {
        $data = request()->all();

        $validator = validator()->make($data, [
            'title' => ['required', 'min:5', 'unique:categories,title'],
            'slug'  => ['required', 'min:5', 'unique:categories,slug'],
        ]);

        $error = $validator->errors();

        if (count($error) > 0) {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error->toArray();
            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $category = new Category();
        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->save();

        $_SESSION['message'] = [
            'status' => 'success',
            'text'   => "Category \"{$data['title']}\" successfully saved"
        ];

        return new RedirectResponse('/categories');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('pages/categories/form', compact('category'));
    }

    public function update($id)
    {
        $category = Category::find($id);

        $data = request()->all();

        $validator = validator()->make($data, [
            'title' => ['required', 'min:5', 'unique:categories,title,' . $id],
            'slug'  => ['required', 'min:5', 'unique:categories,slug,' . $id],
        ]);

        $error = $validator->errors();

        if (count($error) > 0) {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error->toArray();
            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $category->title = $data['title'];
        $category->slug = $data['slug'];
        $category->save();

        $_SESSION['message'] = [
            'status' => 'success',
            'text'   => "Category \"{$data['title']}\" successfully saved"
        ];

        return new RedirectResponse('/categories');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $posts = $category->posts;
        foreach ($posts as $post) {
            $post->tags()->detach();
            $post->delete();
        }
        $category->delete();

        $_SESSION['message'] = [
            'status' => 'success',
            'text'   => "Category \"{$category->title}\" successfully deleted"
        ];


        return new RedirectResponse('/categories');
    }


}