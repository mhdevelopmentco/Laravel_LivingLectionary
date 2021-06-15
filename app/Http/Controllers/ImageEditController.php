<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ImageEditController extends Controller
{
    //save image edited
    public static function save_image_edited($file, $x, $y, $w, $h, $path)
    {
        $file_name = $file->getClientOriginalName();

        $move_name = explode('.', $file_name);
        $file_name = reset($move_name);
        $extension = end($move_name);
        $extension = strtolower($extension);

        $filename_new = $file_name . str_random(8) . "." . $extension;

        if ($file->move($path, $filename_new)) {

            $save_file = $path . $filename_new;
            $extension = File::extension($save_file);
            $extension = strtolower($extension);

            if ($extension == "png") {
                $quality = 1;

                /*$img = imagecreatefrompng($save_file);*/
                $img = imagecreatefromstring(file_get_contents($save_file));
                $dest = imagecreatetruecolor($w, $h);
                imagecopyresampled($dest, $img, 0, 0, $x,
                    $y, $w, $h,
                    $w, $h);
                imagepng($dest, $save_file, $quality);
            } else if ($extension == "jpg" || $extension == "jpeg") {

                $quality = 90;
                $img = imagecreatefromjpeg($save_file);
                $dest = imagecreatetruecolor($w, $h);
                imagecopyresampled($dest, $img, 0, 0, $x, $y, $w, $h, $w, $h);
                imagejpeg($dest, $save_file, $quality);

            } else if ($extension == "gif") {

                $img = imagecreatefromgif($save_file);
                $dest = imagecreatetruecolor($w, $h);
                imagecopyresampled($dest, $img, 0, 0, $x,
                    $y, $w, $h,
                    $w, $h);
                imagegif($dest, $save_file);
            } else {
            }
        } else {
        }

        return $filename_new;
    }
}

?>
