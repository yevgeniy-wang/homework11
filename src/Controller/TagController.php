<?php


namespace Hillel\Homework11\Controller;


use Hillel\Homework11\Model\Tag;
use Illuminate\Http\RedirectResponse;


class TagController
{
    public function list()
    {
        $table = Tag::paginate(3);
        $page = 'tags';

        return view('pages/tags/table', compact('table', 'page'));
    }

    public function create()
    {

        $tag = new Tag();

        return view('pages/tags/form', compact('tag'));
    }

    public function store()
    {
        $data = request()->all();

        $validator = validator()->make($data, [
            'title' => ['required', 'min:5', 'unique:tags,title'],
            'slug'  => ['required', 'min:5', 'unique:tags,slug'],
        ]);

        $error = $validator->errors();

        if (count($error) > 0) {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error->toArray();
            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $tag = new tag();
        $tag->title = $data['title'];
        $tag->slug = $data['slug'];
        $tag->save();

        $_SESSION['message'] = [
            'status' => 'success',
            'text'   => "Tag \"{$data['title']}\" successfully saved"
        ];

        return new RedirectResponse('/tags');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('pages/tags/form', compact('tag'));
    }

    public function update($id)
    {
        $tag = Tag::find($id);

        $data = request()->all();

        $validator = validator()->make($data, [
            'title' => ['required', 'min:5', 'unique:tags,title,' . $id],
            'slug'  => ['required', 'min:5', 'unique:tags,slug,' . $id],
        ]);

        $error = $validator->errors();

        if (count($error) > 0) {
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error->toArray();
            return new RedirectResponse($_SERVER['HTTP_REFERER']);
        }

        $tag->title = $data['title'];
        $tag->slug = $data['slug'];
        $tag->save();

        $_SESSION['message'] = [
            'status' => 'success',
            'text'   => "Tag \"{$data['title']}\" successfully saved"
        ];

        return new RedirectResponse('/tags');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);

        $tag->posts()->detach();
        $tag->delete();

        $_SESSION['message'] = [
            'status' => 'success',
            'text'   => "Tag \"{$tag->title}\" successfully deleted"
        ];

        return new RedirectResponse('/tags');
    }
}