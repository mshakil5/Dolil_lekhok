<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $data = Client::all();
        return view('admin.client.index',compact('data'));
    }

    public function store(Request $request)
    {
        

            try{
                $data = new Client();
                $data->name = $request->name;
                $data->phone = $request->phone;
                $data->address = $request->address; 
                $data->amount = $request->amount; 
                $data->ref = $request->ref;

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
        $info = Client::where($where)->get()->first();
        return response()->json($info);
    }

    public function update(Request $request, $id)
    {
        $data = Client::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address; 
        $data->amount = $request->amount; 
        $data->ref = $request->ref;
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
        if(Client::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Listing Deleted']);
        }
        else{
            return response()->json(['success'=>false,'message'=>'Update Failed']);
        }
    }
}
