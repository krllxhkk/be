<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PraktijkmanagementController extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    return view('Praktijkmanagement.index', [
        'title' => 'Praktijkmanagement Home'
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
    $user = $this->userModel->sp_GetUserById($id);
    $userroles = $this->userModel->sp_GetAllUserroles();
    return view('Praktijkmanagement.edit', [
        'title' => 'Wijzig gebruikersrol',
        'user' => $user,
        'userroles' => $userroles
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd(request->all());
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string','max:255'],
            'rolename' => ['required', 'string'],
        ]);
    
    // dd($validated);
    $affected = $this->userModel->sp_UpdateUser(
        $id,
        $validated['name'],
        $validated['email'],
        $validated['rolename']
    );
    if ($affected ===0){
        return back()->with('error', 'Er is iets misgegaan bij het updaten van de gebruiker.');
    }
    return redirect()->route('praktijkmanagement.userroles')->with('success', 'Gebruiker succesvol bijgewerkt.');
    
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userid)
{
    $result = $this->userModel->sp_DeleteUser($userid);

    if ($result && $result->affectedRows > 0) {
        return redirect()->route('praktijkmanagement.userroles')
            ->with('success', 'User is succesvol verwijderd');
    }

    return redirect()->route('praktijkmanagement.userroles')
        ->with('error', 'User is niet verwijderd');
}
    public function manageUserroles()
    {
        $users = $this->userModel->sp_GetAllUsers(auth()->user()->id);
        return view('Praktijkmanagement.Userroles', [
            'title' => 'Gebrukersrollen',
            'users' => $users
        ]);
    }
}
