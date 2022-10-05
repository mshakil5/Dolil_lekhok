<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class BuyerController extends Controller
{
    public function index()
    {
        $data = Buyer::all();
        return view('admin.buyer.index',compact('data'));
    }

    public function store(Request $request)
    {
        

            try{
                $data = new Buyer();
                $data->name = $request->name;
                $data->phone = $request->phone;
                $data->address = $request->address; 
                $data->voter_id = $request->voter_id; 
                $data->passport_id = $request->passport_id;

                $data->created_by= Auth::user()->id;
                $data->save();

                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
                return response()->json(['status'=> 300,'message'=>$message]);

            }catch (\Exception $e){
                return response()->json(['status'=> 303,'message'=>'Server Error!!']);

            }

    }

    public function edit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = Buyer::where($where)->get()->first();
        return response()->json($info);
    }

    public function update(Request $request, $id)
    {
        $data = Buyer::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address; 
        $data->voter_id = $request->voter_id; 
        $data->passport_id = $request->passport_id;
        $data->updated_by= Auth::user()->id;
        

        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function delete($id)
    {
        if(Buyer::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Listing Deleted']);
        }
        else{
            return response()->json(['success'=>false,'message'=>'Update Failed']);
        }
    }
}
