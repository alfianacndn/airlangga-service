<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TravelImg;
use App\Models\TravelPack;
Use Exception;
use App\Helpers\Tool;

use Symfony\Component\HttpFoundation\Response;

class TravelImgController extends Controller
{
    public function create(Request $request) {
        DB::beginTransaction();
        try {
            $this->validate($request,[
                "travel_pack_id" => "required"
            ]);
            $data = $request->all();
            $travelpack = TravelPack::where('id',$data['travel_pack_id'])->first();
            if (!$travelpack){
                throw new Exception ('Travel Pack id is not found');
            }
            $travelimg = TravelImg::create([
                "travel_pack_id" => $data['travel_pack_id'],
            ]);

            DB::commit();
            return Tool::MyResponse(true,"Create travelimg Is Successfully",$travelimg,Response::HTTP_CREATED);
        }
        catch (Exception $e){
            Db::rollBack();
            return Tool::MyResponse(false,$e,null,401);
        }
    }

    public function getall(){
        $get = TravelImg::get();
        return Tool::MyResponse(true,"Get All Of travelimg is Successfully",$get, Response::HTTP_CREATED);
    }
    public function getbyid($id){
        $get = TravelImg::find($id);
        return Tool::MyResponse(true,"Get All Of travelimg is Successfully",$get,Response::HTTP_CREATED);
    }

    public function update(Request $request,$id){
        Db::beginTransaction();
        try {
            $this->validate($request,[
                "travel_pack_id" => "required"
            ]);
            $arg = $request->all();
            $travelimg = TravelImg::find($id)->first();

            if (!$travelimg){
                throw New Exception ('ID of facility is doesnt exist');
            }
            $data['facility_nm'] = $arg['facility_nm'];
            $travelimg->fill($data);
            $travelimg->save();
            DB::commit();
            return Tool::MyResponse(true,"Get All Of travelimg is Successfully",$travelimg,Response::HTTP_CREATED);
        }
        catch (Exception $e){
            Db::rollBack();
            return Tool::MyResponse(false,$e,null,401);
        }
    }

    public function delete($id){
        Db::beginTransaction();
        try {
            $facility = TravelImg::find($id);
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
