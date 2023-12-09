<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Validator;
use Request;

class CategoryController extends Controller
{
    public function __constructor(){
        $this->category = new CategoryModel();
    }

    public function index(){
        return CategoryModel::all();
    }

    public function store(Request $request){
        $validator = Validator::make(Request::all(),[
            'category_name' => 'required',
            'category_desc' => 'required'
        ]);

        $data = Request::all();

        if($validator->fails()){
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }else{
            $result = CategoryModel::create($data);
            return response()->json(["statis" => 400,"message" => "Category Addes successfully!"]);
        }
    }
}
