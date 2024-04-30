<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserServiceRequest;
use App\Models\Service;
use App\Models\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if (isset($from_date)){
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
        return redirect()->route('user_services.index')->with('success',"Sug'urta tuzildi");
    }

    /**
     * Display the specified resource.
     */
    public function show(UserService $userService)
    {
        //
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
        $userService->delete();
        return redirect()->route('user_services.index')->with('success',"Sug'urta tugatildi.");
    }
}
