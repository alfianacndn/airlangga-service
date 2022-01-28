<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TravelPack;
use App\Helpers\Tool;
Use Exception;

use Symfony\Component\HttpFoundation\Response;
class TravelPackController extends Controller
{
    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $this->validate($request,[
                "pack_nm" => "required",
                "city" => "required",
                "price" => "required",
                "pack_desc" => "required",
                "use_mk" => "required"

            ]);
            $data = $request->all();
            $user= Auth::user();
            $travelpack = TravelPack::create([
                "pack_nm" => $data['pack_nm'],
                "city" =>$data['city'],
                "price" => $data['price'],
                "pack_desc" =>$data['pack_desc'],
                "use_mk" =>$data['use_mk'],
                "create_user" => $user->name
            ]);

            DB::commit();
            return Tool::MyResponse(true,"Create Travel Pack Is Successfully",$travelpack,Response::HTTP_CREATED);
        }
        catch (Exception $e){
            Db::rollBack();
            return Tool::MyResponse(false,$e,null,Response::HTTP_CREATED);
        }
    }

    public function getall(){
        $get = TravelPack::get();
        return Tool::MyResponse(true,"Get All Of Travel Pack is Successfully",$get,Response::HTTP_CREATED);
    }
    public function getbyid($id){
        $get = TravelPack::find($id);
        return Tool::MyResponse(true,"Get Travel Pack is Successfully",$get,Response::HTTP_CREATED);
    }

    public function update(Request $request,$id){
        Db::beginTransaction();
        try {
            $arg = $request->all();
            $facility = TravelPack::find($id)->first();

            if (!$facility){
                throw New Exception ('ID of Travel Pack is doesnt exist');
            }
            $data['pack_nm'] = $arg['pack_nm'];
            $data['city'] = $arg['city'];
            $data['price'] = $arg['price'];
            $data['pask_desc'] = $arg['pask_desc'];

            $facility->fill($data);
            $facility->save();
            DB::commit();
            return Tool::MyResponse(true,"Travel Pack is Successfully Updated",$facility,Response::HTTP_CREATED);
        }
        catch (Exception $e){
            Db::rollBack();
            return Tool::MyResponse(false,$e,null,Response::HTTP_CREATED);
        }
    }

    public function delete($id){
        Db::beginTransaction();
        try {
            $facility = TravelPack::find($id);
            $facility->delete();
            DB::commit();
            return Tool::MyResponse(true,"Delete is successfully",null,Response::HTTP_CREATED);

        }
        catch (Exception $e){
            DB::rollBack();
            throw new Exception($e);
        }
    }
}
