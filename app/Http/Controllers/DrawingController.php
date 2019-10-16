<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrawingController extends Controller
{
    //
    public function drawing()
    {
        return view('web.drawing.upload');
    }

    public function uploadDrawing(Request $request)
    {
        $this->validate($request, [
            'mc_type' => 'required',
        ]);
        if (request()->hasFile('mc_type'))
        {
            $allowedfileExtension = ['pdf','jpg','png','tiff'];
            $extension = $request->mc_type->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $randomName = time();
                $image = $randomName . '.' . $request->mc_type->getClientOriginalExtension();
                $request->mc_type->move(public_path('uploads/mc-types'), $image);
                $url = 'uploads/mc-types/' . $image;
                /**
                 * convert pdf to image start here
                 */
                $outputImgURL = 'uploads/mc-types/'.$randomName.'.jpg';
                if ($extension !== 'pdf') {
                    $output_image = $this->convertImage(public_path('uploads/mc-types/').$image, public_path('uploads/mc-types/'.$randomName.'.jpg'), 100);
                } else {
                    // create Imagick object
                    $imagick = new \Imagick();
                    // Reads image from PDF
                    $imagick->readImage(public_path('uploads/mc-types/').$image);
                    // Writes an image
                    $imagick->writeImage(public_path('uploads/mc-types/'.$randomName.'.jpg'));
                }

                /**
                 * convert pdf to image end here
                 */
                return response()->json(['url' => $outputImgURL]);
            }
            else {
                echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload pdf, jpg and png</div>';
            }
        }
        else{
            return "file not present";
        }
    }

    function convertImage($originalImage, $outputImage, $quality)
    {
        // jpg, png, gif or bmp?
        $exploded = explode('.',$originalImage);
        $ext = $exploded[count($exploded) - 1];

        if (preg_match('/jpg|jpeg/i',$ext))
            $imageTmp=imagecreatefromjpeg($originalImage);
        else if (preg_match('/png/i',$ext))
            $imageTmp=imagecreatefrompng($originalImage);
        else if (preg_match('/gif/i',$ext))
            $imageTmp=imagecreatefromgif($originalImage);
        else if (preg_match('/bmp/i',$ext))
            $imageTmp=imagecreatefrombmp($originalImage);
        else
            return 0;

        // quality is a value from 0 (worst) to 100 (best)
        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        return 1;
    }

}
