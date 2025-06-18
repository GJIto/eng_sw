<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    public function index()
    {   
        dd('teste index');
        $expenses = Expense::with('employer')->latest()->simplePaginate(3);
        dd($expenses);
        return view('expenses.index', [
            'expenses' => $expenses
        ]);
    }

    public function create(Group $group)
    {
        //  dd($group);
        return view('expenses.create', compact('group'));
    }

    public function show(Expense $expense)
    {
        dd('teste show');
        return view('expenses.show', ['expense'=>$expense]);
    }

    public function store()
    {      
        // dd( $expense->group_id);
            // dd(request());
        request()->validate([
            'value' => ['required', 'decimal:2'],
            'description' => ['required'],
            'group_id' => ['required', 'exists:groups,id'],
        ]);

        $expense=Expense::create([
            'amount' => request('value'),
            'description' => request('description'),
            'group_id' =>  request('group_id'),
            'user_id' => Auth::user()->id
        ]);

        return redirect('/groups/' . $expense->group_id);
    }

    public function edit(Expense $expense)
    {
        Gate::authorize('edit-expense', $expense);

        return view('expenses.edit', ['expense' => $expense]);
    }

    public function update(Expense $expense)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $expense->update([
            'title'=>request('title'),
            'salary'=>request('salary')
        ]);

        return redirect('/expenses/' . $expense->id);
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect('/expenses');
    }
}