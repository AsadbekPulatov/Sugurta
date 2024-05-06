<?php

namespace App\Http\Controllers;

use App\Models\RestoreService;
use App\Models\UserService;
use Illuminate\Http\Request;

class RestoreServiceController extends Controller
{
    public function restore_service(Request $request){
        $image = $request['image'];
        $user_service_id = $request['user_service_id'];

        $userService = UserService::findorfail($user_service_id);
        if ($userService->status == "1"){
            if (isset($image)){
                $filename = time().'.'.$image->getClientOriginalExtension();
                $image->move('restore', $filename);
                $restore = new RestoreService();
                $restore->user_service_id = $user_service_id;
                $restore->image = $filename;
                $restore->save();
                return redirect()->back()->with('success', 'Qayta tiklashga ariza yuborildi.');
            }
        }
        return redirect()->back()->with('error', 'Xatolik kuzatildi.');
    }

    public function list_restore_service_all(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if (isset($from_date)) {
            $user_services = RestoreService::whereBetween('created_at', [$from_date, $to_date])->get();
        } else
            $user_services = RestoreService::orderby('created_at', 'DESC')->get();
        return view('admin.restore_service.index', compact('user_services'));
    }

    public function restore_service_status($id){
        $user_service = RestoreService::findorfail($id);
        $user_service->status = 1;
        $user_service->save();

        $user_service = $user_service->user_service->id;
        $user_service = UserService::findorfail($user_service);
        $user_service->status = 2;
        $user_service->save();
        return redirect()->route('list_restore_service_all')->with('success', 'Tasdiqlandi');
    }

    public function delete($id){
        $restore = RestoreService::findorfail($id);
        if ($restore->status == 0){
            $restore->delete();
            return redirect()->back()->with('success', 'Bekor qilindi.');
        }
        return redirect()->back()->with('error', 'Bekor qilish mumkin emas');
    }
}
