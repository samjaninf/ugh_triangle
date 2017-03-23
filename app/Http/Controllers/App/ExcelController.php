<?php
namespace App\Http\Controllers\App;


use App\Http\Controllers\Controller;
use App\Post;
use App\Profile;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    private $post;

    public function __construct()
    {
        $this->post = new \App\Classes\Post();
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        if ($file->getClientOriginalExtension() != "csv") {
            return ['e', 'Invalid .csv'];
        } else {
            \File::delete('excel/import.csv');
            $file->move('excel', 'import.csv');
            $can = true;
            $posts = \Excel::load('excel/import.csv', function ($file) {
                return $file->get();
            });
            $posts = $posts->parsed;
            $profiles = Profile::where('is_active', 1)->where('user_id', \Auth::user()->id)->get();
            if (count($profiles) == 0) {
                return ['e', trans('messages.you_have_no_activated_profiles')];
            }
            $ids = [];
            foreach ($profiles as $profile) {
                $ids[] = $profile->id;
            }
            $row = 1;
            if (count($posts) > 50) {
                return ['e', trans('messages.max_50_posts_at_once')];
            }
            foreach ($posts as $post) {
                $row++;
                $date = strtotime($post->date);
                if (!$date) {
                    return ['e', 'Error while reading the table. Invalid date on row ' . $row];
                }
                if ($date > time()) {
                    if (strlen(trim($post->text)) < 1) {
                        return ['e', 'The text is missing on row ' . $row];
                    }
                    if (strlen($post->text) > 2000) {
                        return ['e', 'The text is too long on row ' . $row];
                    }
                    foreach ($profiles as $profile) {
                        $type = $post->image != null ? "photo" : ($post->link != null ? "link" : "");
                        $this->post->save(new Post(), $profile, [
                            "submit" => "schedule",
                            "date" => $post->date,
                            "text" => $post->text,
                            "type" => $type,
                            "link" => $post->link != null ? $post->link : "",
                            "urls" => json_encode(["http://blog.mrwebmaster.it/files/2012/07/php.png"])
                        ]);
                    }
                }
            }
            return ['s', 'Successfully imported ' . ($row - 1) . ' posts'];
        }

    }
}