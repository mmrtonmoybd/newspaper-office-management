<?php

namespace App\Http\Controllers\Cashbook;

use App\Models\Calculation;
use App\Models\Category;
use App\Models\ExpenseEntry;
use App\Models\IncomeEntry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalculationController extends Controller
{
    public function index()
    {
        // Get all calculations in DESC order with pagination (e.g., 10 per page)
        $calculations = Calculation::with(['incomeEntries', 'expenseEntries'])
            ->orderBy('created_at', 'DESC')
            ->paginate(22);

        // Process each calculation to compute total income, total expense, and net balance
        $calculationsData = $calculations->map(function ($calculation) {
            $totalIncome = $calculation->incomeEntries->sum('amount');
            $totalExpense = $calculation->expenseEntries->sum('amount');
            $netChange = $totalIncome - $totalExpense;
            $netBalance = $calculation->previous_balance + $netChange;

            return [
                'id' => $calculation->id,
                'name' => $calculation->name,
                'date' => $calculation->created_at->format('Y-m-d'),
                'totalIncome' => $totalIncome,
                'totalExpense' => $totalExpense,
                'netBalance' => $netBalance,
            ];
        });

        return view('backend.cashbook.index', compact('calculationsData', 'calculations'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('backend.cashbook.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $previousCalculation = Calculation::latest()->first();
        $previousBalance = $previousCalculation ? $previousCalculation->balance : 0;

        $calculation = Calculation::create([
            'name' => $request->name,
            'previous_balance' => $previousBalance,
            'balance' => $previousBalance,
        ]);

        // Save income entries
        foreach ($request->income as $income) {
            IncomeEntry::create([
                'calculation_id' => $calculation->id,
                'description' => $income['description'],
                'amount' => $income['amount'],
                //'date' => $income['date'],
                'category_id' => $income['category_id'],
            ]);
            $calculation->balance += $income['amount'];
        }

        // Save expense entries
        foreach ($request->expense as $expense) {
            ExpenseEntry::create([
                'calculation_id' => $calculation->id,
                'description' => $expense['description'],
                'amount' => $expense['amount'],
                //'date' => $expense['date'],
                'category_id' => $expense['category_id'],
            ]);
            $calculation->balance -= $expense['amount'];
        }

        $calculation->save();

        return redirect()->route('backend.calculations.index');
    }

    public function edit(Calculation $calculation)
    {
        $categories = Category::all();

        return view('backend.cashbook.edit', compact('calculation', 'categories'));
    }

    public function update(Request $request, Calculation $calculation)
    {
        $calculation->name = $request->name;
        $calculation->balance = $calculation->previous_balance;

        // Update income entries
        $calculation->incomeEntries()->delete();
        foreach ($request->income as $income) {
            IncomeEntry::create([
                'calculation_id' => $calculation->id,
                'description' => $income['description'],
                'amount' => $income['amount'],
                //'date' => $income['date'],
                'category_id' => $income['category_id'],
            ]);
            $calculation->balance += $income['amount'];
        }

        // Update expense entries
        $calculation->expenseEntries()->delete();
        foreach ($request->expense as $expense) {
            ExpenseEntry::create([
                'calculation_id' => $calculation->id,
                'description' => $expense['description'],
                'amount' => $expense['amount'],
                //'date' => $expense['date'],
                'category_id' => $expense['category_id'],
            ]);
            $calculation->balance -= $expense['amount'];
        }

        $calculation->save();

        return redirect()->route('backend.calculations.index');
    }

    public function show(Calculation $calculation, Request $request)
    {
        // Get the start and end dates from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // If dates are provided, filter the income and expense entries
        $incomeEntries = $calculation->incomeEntries();
        $expenseEntries = $calculation->expenseEntries();

        // Step 1: Calculate the previous balance before the start date
        $previousBalance = $calculation->previous_balance;

        if ($startDate) {
            
            // Check if there is no entry is smaller then start date
            
            $rowcheck = Calculation::where('created_at', '<=', $startDate)->count();
            if ($rowcheck > 1) {
                // Get all calculations before the start date to adjust the previous balance
            $previousIncome = Calculation::with('incomeEntries')->where('created_at', '<', $startDate)->get()->pluck('incomeEntries')->collapse()->sum('amount');
            $previousExpense = Calculation::with('expenseEntries')->where('created_at', '<', $startDate)->get()->pluck('expenseEntries')->collapse()->sum('amount');
            $previousNet = $previousIncome - $previousExpense;
    
            // Adjust previous balance
            $previousBalance += $previousNet;
            } else {
                $previousBalance = 0; // There is no calculation before start date, so we set the previous balance to 0
            }
            
        }

        if ($startDate && $endDate) {
            $cal = Calculation::whereBetween('created_at', [$startDate, $endDate])->pluck('id')->toArray();
            $incomeEntries = IncomeEntry::whereIn('calculation_id', $cal);
            $expenseEntries = ExpenseEntry::whereIn('calculation_id', $cal);
            //$incomeEntries->whereBetween('date', [$startDate, $endDate]);
            //$expenseEntries->whereBetween('date', [$startDate, $endDate]);
        }

        // Get the filtered entries
        $incomeEntries = $incomeEntries->get();
        $expenseEntries = $expenseEntries->get();

        //dd($incomeEntries);

        // Calculate total income, total expense, and net balance
        $totalIncome = $incomeEntries->sum('amount');
        $totalExpense = $expenseEntries->sum('amount');
        $netChange = $totalIncome - $totalExpense;
        $netBalance = $previousBalance + $netChange;

        return view('backend.cashbook.show', compact('calculation', 'incomeEntries', 'expenseEntries', 'totalIncome', 'totalExpense', 'netBalance', 'previousBalance', 'startDate', 'endDate'));
    }

    public function destroy($id)
    {
        // Find the calculation to delete
        $calculationToDelete = Calculation::findOrFail($id);

        // Delete the calculation
        $calculationToDelete->delete();

        // Fetch the previous calculation (before the deleted one)
        $previousCalculation = Calculation::where('id', '<', $id)->orderBy('id', 'desc')->first();

        // Determine the starting balance (from the previous calculation if it exists)
        $previousBalance = $previousCalculation ? $previousCalculation->getCurrentBalance() : 0;

        // Fetch all subsequent calculations that need recalculation
        $subsequentCalculations = Calculation::where('id', '>', $id)->orderBy('id', 'asc')->get();

        // Recalculate balances for subsequent calculations
        foreach ($subsequentCalculations as $subsequentCalculation) {
            // Fetch income and expense totals for this calculation
            $totalIncome = $subsequentCalculation->incomeEntries->sum('amount');
            $totalExpense = $subsequentCalculation->expenseEntries->sum('amount');

            // Calculate the net balance (Income - Expense)
            $netBalance = $totalIncome - $totalExpense;

            // Calculate the current balance for this calculation
            $currentBalance = $previousBalance + $netBalance;

            // Update the subsequent calculation balance with recalculated data
            $subsequentCalculation->update([
                'previous_balance' => $previousBalance, // You should not have to create a new column; this is conceptual for recalculation
                'balance' => $currentBalance,   // Update the current balance for the record
            ]);

            // Set the previous balance for the next iteration
            $previousBalance = $currentBalance;
        }

        // Redirect back with a success message
        return redirect()->route('backend.calculations.index')->with('success', 'Cashbook deleted and balances recalculated.');
    }
}
