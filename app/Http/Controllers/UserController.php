<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
            return datatables()->of(User::all())
                ->addColumn("action", function ($user) {
                    return view("users.action", ["user" => $user]);
                })
                ->toJson();

        return view("users.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:users|max:255|email',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'password' => 'required|confirmed|min:6|max:255',
        ]);

        $validatedData["image"] = $this->image();
        $validatedData["password"] = bcrypt($request->password);

        User::create($validatedData);

        return redirect("users")
            ->with('success','User added successfully!');
    }

    private function image()
    {
        $imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);

        return "images/$imageName";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("users.edit", ["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:users,email,' . $user->id . '|max:255|email',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'password' => 'confirmed|max:255',
        ]);

        if (isset($validatedData["image"])) {
            $validatedData["image"] = $this->image();

            File::delete($user->image);
        }

        if ($validatedData["password"]) $validatedData["password"] = bcrypt($request->password);
        else unset($validatedData["password"]);


        $user->update($validatedData);

        return redirect("users")
            ->with('success','User edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect("users")
            ->with('success','User deleted successfully!');
    }
}
