<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use App\Models\ai_images;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
    
    

use Validator;

class PostController extends Controller
{

    /**
     * Display a listing of the myformPost.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxValidation()
    {
            return view('add');
    }
 
    public function ajaxValidationStore(Request $request)
    {
            
        $validator = Validator::make($request->all(), [
            'input' => 'required',
            
        ]);

        if ($validator->passes()) {

            $ai = ai_images::create([
                'img_id'=>$request->id,
                'input'=>$request->input
            ]);

            
          $data = [
            'id'  => $request->id,
            'input'   => $request->input
        ];
            
            return view('image')->with($data);      
    
            
        }

        return response()->json(['error'=>$validator->errors()]);
    }




    


}
?>