@extends('boilerplate::layout.index', [
    'title' => 'Edit Cashbook',
    'subtitle' => 'Edit Cashbook',
    'breadcrumb' => [
        'Cashbook' => 'backend.calculations.index',
    ]
])

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">Edit Cashbook</div>
        <div class="card-body">
            <form action="{{ route('backend.calculations.update', $calculation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Cashbook Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $calculation->name }}" >
                </div>

                <h4>Income Entries</h4>
                <div id="income-entries">
                    @foreach($calculation->incomeEntries as $index => $income)
                        <div class="form-group">
                            <label for="income[{{ $index }}][description]">Description</label>
                            <input type="text" name="income[{{ $index }}][description]" class="form-control" value="{{ $income->description }}">
                        </div>
                        <div class="form-group">
                            <label for="income[{{ $index }}][amount]">Amount</label>
                            <input type="number" step="0.01" name="income[{{ $index }}][amount]" class="form-control" value="{{ $income->amount }}" required>
                        </div>
                        <!--
                        <div class="form-group">
                            <label for="income[{{ $index }}][date]">Date</label>
                            <input type="date" name="income[{{ $index }}][date]" class="form-control" value="{{ $income->date }}">
                        </div>
                         -->
                        <div class="form-group">
                            <label for="income[{{ $index }}][category_id]">Entries heading</label>
                            <select name="income[{{ $index }}][category_id]" class="form-control">
                                <option value="">No Entries heading</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $income->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary" id="add-income">Add Income</button>

                <h4>Expense Entries</h4>
                <div id="expense-entries">
                    @foreach($calculation->expenseEntries as $index => $expense)
                        <div class="form-group">
                            <label for="expense[{{ $index }}][description]">Description</label>
                            <input type="text" name="expense[{{ $index }}][description]" class="form-control" value="{{ $expense->description }}">
                        </div>
                        <div class="form-group">
                            <label for="expense[{{ $index }}][amount]">Amount</label>
                            <input type="number" step="0.01" name="expense[{{ $index }}][amount]" class="form-control" value="{{ $expense->amount }}" required>
                        </div>
                        <!--
                        <div class="form-group">
                            <label for="expense[{{ $index }}][date]">Date</label>
                            <input type="date" name="expense[{{ $index }}][date]" class="form-control" value="{{ $expense->date }}">
                        </div>
                        -->
                        <div class="form-group">
                            <label for="expense[{{ $index }}][category_id]">Entries heading</label>
                            <select name="expense[{{ $index }}][category_id]" class="form-control">
                                <option value="">No Entries heading</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $expense->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary" id="add-expense">Add Expense</button>

                <button type="submit" class="btn btn-primary mt-3">Update Cashbook</button>
            </form>
        </div>
    </div>
</div>

<script>
    let incomeCount = {{ $calculation->incomeEntries->count() }};
    let expenseCount = {{ $calculation->expenseEntries->count() }};

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