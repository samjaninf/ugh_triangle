<?php
namespace App\Http\Controllers\App;


use App\Contracts\PostRepositoryInterface;
use App\Draft;
use App\Http\Requests\CreatePostFormRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    // Posts repository
    private $post;

    public function __construct()
    {
        $this->post = new \App\Classes\Post();
    }

    /*
     * Publishing a post
     */
    public function post(Request $request, CreatePostFormRequest $reques, PostRepositoryInterface $repo)
    {
        $response = $repo->proceed($request, $this->post);
        return $response;
    }

    /*
     * Saves a draft
     */
    public function saveDraft()
    {
        Draft::doSave();
    }

    /*
     * Load saved drafts
     */
    public function loadDrafts()
    {
        $drafts = Draft::own()->orderBy('created_at', 'DESC')->get();
        return view('app.parts.drafts', compact('drafts'));
    }

    /*
     * Deletes a post
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->profile->getRepository()->delete($post);
        $post->delete();
    }

}
