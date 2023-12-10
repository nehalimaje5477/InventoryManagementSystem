<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemModel;
use Validator;

class ItemController extends Controller
{

    public function index(){
        return ItemModel::all();
    }
    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'category_id' => 'required',
            'item_name' => 'required',
            'item_desc' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        $data = array(
            'category_id' => $request->category_id,
            'item_name' => $request->item_name,
            'item_desc' => $request->item_desc,
            'price' => $request->price,
            'quantity' => $request->quantity
        );

        if($validator->fails()){
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }else{
            $result = ItemModel::create($data);
            return response()->json(["status" => 400,"message" => "Item details added successfully!"]);
        }
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'category_id' => 'required',
            'item_name' => 'required',
            'item_desc' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        $item = ItemModel::find($id);
        $item->category_id = $request->category_id;
        $item->item_name = $request->item_name;
        $item->item_desc = $request->item_desc;
        $item->price = $request->price;
        $item->quantity = $request->quantity;

        if($validator->fails()){
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }else{
            if($item->save()){
                return response()->json(["message" => "Item details are Updated!"],404);
            }else{
                return response()->json(["message" => "Item details are not Updated"]);
            }
        }
    }

    public function delete(Request $request,$id){
        $item = ItemModel::find($id);
        if($item->delete()){
            return response()->json(["message" => "Item details deleted successfully!"],404);
        }else{
            return response()->json(["message" => "Unable to delete item details"]);
        }
    }
}
