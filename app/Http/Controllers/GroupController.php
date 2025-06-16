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
        $groups = Group::with('user')->simplePaginate(3);

        return view('groups.index', [
            'groups' => $groups
        ]);
    }

    public function create()
    {
        return view('groups.create');
    }

    public function show(Group $group)
    {
        $groups = Group::with('expenses','user')->find($group->id);
        // dd($groups['expenses']);
        return view('groups.show', ['group'=>$groups]);
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
