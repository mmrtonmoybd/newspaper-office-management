<?php
// app/Http/Controllers/CalculationController.php
namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\IncomeEntry;
use App\Models\ExpenseEntry;
use App\Models\Category;
use Illuminate\Http\Request;

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
                'date' => $income['date'],
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
                'date' => $expense['date'],
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
                'date' => $income['date'],
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
                'date' => $expense['date'],
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

    if ($startDate && $endDate) {
        $incomeEntries->whereBetween('date', [$startDate, $endDate]);
        $expenseEntries->whereBetween('date', [$startDate, $endDate]);
    }

    // Get the filtered entries
    $incomeEntries = $incomeEntries->get();
    $expenseEntries = $expenseEntries->get();

    // Calculate total income, total expense, and net balance
    $totalIncome = $incomeEntries->sum('amount');
    $totalExpense = $expenseEntries->sum('amount');
    $netChange = $totalIncome - $totalExpense;
    $netBalance = $calculation->previous_balance + $netChange;

    return view('backend.cashbook..show', compact('calculation', 'incomeEntries', 'expenseEntries', 'totalIncome', 'totalExpense', 'netBalance'));
}

    public function destroy($id)
{
    // Find and delete the calculation
    $calculation = Calculation::findOrFail($id);
    $calculation->delete();

    // Get the next calculation after the deleted one
    $nextCalculation = Calculation::where('created_at', '>', $calculation->created_at)
        ->orderBy('created_at', 'ASC')
        ->first();

    // If there's a next calculation, recalculate its previous balance
    if ($nextCalculation) {
        $previousCalculation = Calculation::where('created_at', '<', $nextCalculation->created_at)
            ->orderBy('created_at', 'DESC')
            ->first();

        // If there's a previous calculation, update the next calculation's previous balance
        if ($previousCalculation) {
            $nextCalculation->previous_balance = $previousCalculation->net_balance;
        } else {
            // If no previous calculation, set previous balance to 0
            $nextCalculation->previous_balance = 0;
        }

        // Recalculate the next calculation's net balance
        $totalIncome = $nextCalculation->incomeEntries->sum('amount');
        $totalExpense = $nextCalculation->expenseEntries->sum('amount');
        $nextCalculation->net_balance = $nextCalculation->previous_balance + ($totalIncome - $totalExpense);

        $nextCalculation->save();
    }

    return redirect()->route('backend.calculations.index')->with('success', 'Calculation deleted successfully, and balances updated.');
}
}
