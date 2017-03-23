<?php
namespace App\Http\Controllers\App;


use App\Classes\UploadHandler;
use Illuminate\Routing\Controller;

class UploadController extends Controller
{

    public function upload()
    {
        $class = new UploadHandler();
    }

    public function delete()
    {
        $name = \Request::input('name');
        $name = str_replace(url('/') . '/files/', "", $name);
        \File::delete('files/' . $name);
        \File::delete('files/thumbnail/' . $name);

    }

}