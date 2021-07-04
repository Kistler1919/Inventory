<?php

namespace App\Http\Controllers\Api;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    
    public function index()
    {
        $expenses = Expense::all();

        return response()->json($expenses);
    }


    public function store(Request $request)
    {
        $fields = $request->validate([
            'details' => 'required|string',
            'amount' => 'required|string',
            'date' => 'date',
        ]);
        $expense = Expense::create([
            'details' => $fields['details'],
            'amount' => $fields['amount'],
            'date' => $fields['date'],
        ]);

        return response()->json($expense);
    }

    public function show($id)
    {
        $expense = Expense::where('id', $id)->first();
        return response()->json($expense);
    }

    public function update(Request $request, $id)
    {
        $newExpense = array();
        $newExpense['details'] = $request->details;
        $newExpense['amount'] = $request->amount;
        $newExpense['date'] = $request->date;
        Expense::where('id', $id)->first()->update($newExpense);
    }

    public function destroy($id)
    {
        $expense = Expense::where('id', $id)->first()->delete();
    }
}
