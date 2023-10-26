<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Logging\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index',[
            'users'=>User::paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * *
     * @param User $user
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(User $user, Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user->delete();
            $request->session()->flash('status', 'Użytkownik Usunięty');
            return response()->json([
                'status'=>'succes'
            ]);
        }catch (Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Wystąpił błąd!'
            ])->setStatusCode(500);
        }
    }
}
