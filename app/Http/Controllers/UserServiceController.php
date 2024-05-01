<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserServiceRequest;
use App\Models\Service;
use App\Models\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserServiceController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('user', ['index', 'create', 'store']),
            new Middleware('admin', ['user_service_status', 'list_user_service_all']),
        ];
    }

//   index for admin
    public function list_user_service_all(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if (isset($from_date)) {
            $user_services = UserService::whereBetween('created_at', [$from_date, $to_date])->get();
        } else
            $user_services = UserService::orderby('created_at', 'DESC')->get();
        return view('admin.user_services.admin', compact('user_services'));
    }

    public function user_service_status($id)
    {
        $user_service = UserService::findorfail($id);
        $user_service->status = 1;
        $user_service->save();

        return redirect()->route('list_user_service_all')->with('success', 'Tasdiqlandi');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if (isset($from_date)) {
            $user_services = UserService::where('user_id', auth()->id())->whereBetween('created_at', [$from_date, $to_date])->get();
        } else
            $user_services = UserService::where('user_id', auth()->id())->get();
        return view('admin.user_services.index', compact('user_services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all()->keyBy('id');
        return view('admin.user_services.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserServiceRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['details'] = json_encode($data['details']);
        UserService::create($data);
        return redirect()->route('user_services.index')->with('success', "Sug'urta tuzildi");
    }

    /**
     * Display the specified resource.
     */
    public function show(UserService $userService)
    {
        if ($userService->user_id != auth()->id() && auth()->id() != 1)
            abort(404);
        return view('admin.user_services.show', compact('userService'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserService $userService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserService $userService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserService $userService)
    {
        if (auth()->id() == 1){
            $userService->delete();
            return redirect()->route('list_user_service_all')->with('success', "Sug'urta bekor qilindi.");
        }
        else {
            if ($userService->status == 0)
                $userService->delete();
            else
                return redirect()->route('user_services.index')->with('error', "Sug'urtani bekor qila olmaysiz!");
        }
        return redirect()->route('user_services.index')->with('success', "Sug'urta bekor qilindi.");
    }
}
