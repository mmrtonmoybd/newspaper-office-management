@extends('boilerplate::layout.index', [
    'title' => 'Create Cashbook',
    'subtitle' => 'Create Cashbook',
    'breadcrumb' => [
        'Cashbook' => 'backend.calculations.create',
    ]
])

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">Create Cashbook</div>
        <div class="card-body">
            <form action="{{ route('backend.calculations.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Calculation Name</label>
                    <input type="text" name="name" class="form-control" >
                </div>

                <h4>Income Entries</h4>
                <div id="income-entries"></div>
                <button type="button" class="btn btn-secondary" id="add-income">Add Income</button>

                <h4>Expense Entries</h4>
                <div id="expense-entries"></div>
                <button type="button" class="btn btn-secondary" id="add-expense">Add Expense</button>

                <button type="submit" class="btn btn-primary mt-3">Save Cashbook</button>
            </form>
        </div>
    </div>
</div>

<script>
    let incomeCount = 0;
    let expenseCount = 0;

    document.getElementById('add-income').addEventListener('click', function () {
        let newEntry = `
            <div class="form-group">
                <label for="income[${incomeCount}][description]">Description</label>
                <input type="text" name="income[${incomeCount}][description]" class="form-control">
            </div>
            <div class="form-group">
                <label for="income[${incomeCount}][amount]">Amount</label>
                <input type="number" step="0.01" name="income[${incomeCount}][amount]" class="form-control" required>
            </div>
            <!--
            <div class="form-group">
                <label for="income[${incomeCount}][date]">Date</label>
                <input type="date" name="income[${incomeCount}][date]" class="form-control">
            </div>
            -->
            <div class="form-group">
                <label for="income[${incomeCount}][category_id]">Entries heading</label>
                <select name="income[${incomeCount}][category_id]" class="form-control">
                    <option value="">No Entries heading</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        `;
        document.getElementById('income-entries').insertAdjacentHTML('beforeend', newEntry);
        incomeCount++;
    });

    document.getElementById('add-expense').addEventListener('click', function () {
        let newEntry = `
            <div class="form-group">
                <label for="expense[${expenseCount}][description]">Description</label>
                <input type="text" name="expense[${expenseCount}][description]" class="form-control">
            </div>
            <div class="form-group">
                <label for="expense[${expenseCount}][amount]">Amount</label>
                <input type="number" step="0.01" name="expense[${expenseCount}][amount]" class="form-control" required>
            </div>
            <!--
            <div class="form-group">
                <label for="expense[${expenseCount}][date]">Date</label>
                <input type="date" name="expense[${expenseCount}][date]" class="form-control">
            </div>
            -->
            <div class="form-group">
                <label for="expense[${expenseCount}][category_id]">Entries heading</label>
                <select name="expense[${expenseCount}][category_id]" class="form-control">
                    <option value="">No Entries heading</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        `;
        document.getElementById('expense-entries').insertAdjacentHTML('beforeend', newEntry);
        expenseCount++;
    });
</script>

@endsection
