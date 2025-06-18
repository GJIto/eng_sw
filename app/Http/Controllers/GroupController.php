<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GroupController extends Controller
{
    public function index()
    {
        // $groups = Group::with('user')->simplePaginate(3);
        $user = User::with('groups')->find(Auth::user()->id);
        $usergroups = $user->groups->all();
        // dd($usergroups);


        // $groups = Group::with('user')->find(2);
        // dd($groups);

        // dd(Auth::user()->id);

        // dd($groups[0]->user[0]->first_name);

        return view('groups.index', [
            'groups' => $usergroups
        ]);
    }

    public function create()
    {
        return view('groups.create');
    }

    public function show(Group $group)
    {
        // $groups = Group::with('expenses','user')->findOrFail($group->id);
        // // dd($groups);
        // // dd($groups['expenses']);
        // return view('groups.show', ['group'=>$groups]);

        // $group = Group::with(['expenses.user', 'user'])->findOrFail($group->id);

        // return view('groups.show', compact('group'));

        $group->load('user', 'expenses'); // Eager-load relationships
        return view('groups.show', compact('group'));
    }

    public function store()
    {

        request()->validate([
            'group_name' => ['required'],
            'description' => ['required']
        ]);

        $group=Group::create([
            'group_name' => request('group_name'),
            'description' => request('description')
        ]);
        $group->user()->attach(Auth::user()->id);


        return redirect('/groups');
    }


    public function addMember(Request $request, Group $group)
    {
        
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
        
        // Find user by email
        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            // Attach user to group without duplicates
            $group->user()->syncWithoutDetaching($user->id);
            // dd('teste');

            return redirect()->back()->with('success', 'Member added successfully!');
        }

        return redirect()->back()->withErrors(['email' => 'User with this email not found.']);
    }


    public function edit(Group $group)
    {
        Gate::authorize('edit-group', $group);

        return view('groups.edit', ['group' => $group]);
    }

    public function update(Group $group)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $group->update([
            'title'=>request('title'),
            'salary'=>request('salary')
        ]);

        return redirect('/groups/' . $group->id);
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect('/groups');
    }
}
