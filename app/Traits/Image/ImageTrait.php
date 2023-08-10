<?php

namespace App\Traits\Image;

use Carbon\Carbon;
use Illuminate\Support\Str;

trait ImageTrait {


    public function uploadImage($photo){


        $allowedfileExtension = ['jpg', 'png', 'bmp', 'jpeg'];

        $extension = $photo->getClientOriginalExtension();

        $extension = strtolower($extension);

        // dd($photo->getSize(), $extension);

        $size = $photo->getSize();

        if ($size > 1000000) {
            return [false, 'Your photo is too large. compress and try again.'];
        }

        $time = Carbon::now();

        $check = in_array(strtolower($extension), $allowedfileExtension);

        $filename = Str::random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;

        if ($check) {

            $directory = 'data/uploads';
            $url = $directory . '/' . $filename;

            $photo->move(public_path($directory),$filename);
            //store to thumb

            return [true,$url];

        } else {

            return [false, 'Your photo must be of types : jpeg, bmp, png, jpg.'];

        }

    }

    public function unlinkFile($url){
        if(!empty($url)){
            try{
                unlink($url);
            }catch (\Exception $er){

            }
        }
    }

}
