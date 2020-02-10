<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ArbitreRequest;
use Illuminate\Support\Facades\Hash;

class ArbitreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arbitres = User::where('role', 'arbitre')->orderBy('fullname', 'asc')->get();
        return view('app.arbitre.index', compact('arbitres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArbitreRequest $request, User $model)
    {
        $model->create(
            $request->merge([
                'role' => 'arbitre',
                'password' => Hash::make($request->get('password'))
            ])
            ->all()
        );

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->get()->first();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(ArbitreRequest $request, User $arbitre)
    {
        $arbitre->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));
        
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User  $user)
    {
        $user->delete();

        return redirect()->route('arbitre.index')->withStatus(__('User successfully deleted.'));
    }
}
