<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
class UploadImageController extends Controller
{
    public function __construct()
    {
        $this->filePath = public_path('image_data/upload_image_data.json');

    }

    public function allImage(Request $request){
        $jsonString =File::get($this->filePath);
        $fileData = isset($jsonString) ? json_decode($jsonString,true) : [];
        return response()->json(['data'=>array_reverse($fileData),'code'=>200,'message'=>'Image Upload Successfully']);
    }

    public function storeImage(Request $request){

        $request->validate([
            'image' => 'required|image|mimes:png|max:5120',
            'image_title' =>'required|max:200'
        ]);

        $jsonString =File::get($this->filePath);
        $fileData = isset($jsonString) ? json_decode($jsonString,true) : [];

        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = time() . '.' . $imagePath->getClientOriginalName();
            $imagePath =  $request->file('image')->storeAs('uploads', $imageName, 'public');
        }

        $data['id'] = isset($fileData) ? count($fileData)+1 : 1;
        $data['image_url'] = url('/').'/storage/'.$imagePath;
        $data['image_title'] = ($request->image_title) ? $request->image_title:null;
        $newdata  = [$data];

        $oldData = isset($fileData) ? $fileData : [];
        $updateData = array_merge($oldData,$newdata);
        File::put($this->filePath,json_encode($updateData));
       return response()->json(['data'=>$newdata,'code'=>200,'message'=>'Image Upload Successfully']);
    }

    public function removeImage(Request $request){

        $jsonString =File::get($this->filePath);
        $fileData = isset($jsonString) ? json_decode($jsonString,true) : [];

        $arr_index = array();
        foreach ($fileData as $key => $value) {
            if ($value['id'] == $request->image_id) {
                $this->deleteOldImage($value['image_url']);
                $arr_index[] = $key;
            }
        }

        foreach ($arr_index as $i) {
            unset($fileData[$i]);
        }

        $json_arr = array_values($fileData);
        File::put($this->filePath,json_encode($json_arr));

        return response()->json(['image_id'=>$request->image_id,'code'=>200,'message'=>'Image Remove Successfully']);
    }

    private function deleteOldImage($imagePath): void
    {
        if (isset($imagePath)) {
            $filePath = explode("/", $imagePath);
            $file = array_pop($filePath);
            if (File::exists("storage/uploads/".$file)) {
                File::delete("storage/uploads/".$file);
            }
        }
    }
}
