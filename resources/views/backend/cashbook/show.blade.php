@extends('boilerplate::layout.index', [
    'title' => 'Cashbook',
    'subtitle' => 'Cashbook',
    'breadcrumb' => [
        'Cashbook' => 'backend.calculations.index',
    ]
])

@section('content')

<div class="card">
<div class="card-header bg-primary text-white">
        <h3 class="card-title">Cashbook Details</h3>
    </div>

    <div class="card-body">

        <!-- Date Range Form -->
        <form action="{{ route('backend.calculations.show', $calculation->id) }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate ?? '' }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter by Date</button>
                </div>
            </div>
        </form>

        <center><strong><h4 class="text-info">{{ $calculation->name }}</h4></strong></center>

         <!-- Previous Balance Section -->

         @if ($previousBalance > 0)
         <div class="alert alert-secondary">
            <h5>Previous Balance: <strong>{{ number_format($previousBalance, 2) }}</strong></h5>
        </div>
        @endif

        <div class="row">
            <!-- Income Section -->
            <div class="col-md-6">
                <div class="border rounded p-3 mb-3 bg-light">
                    <h5 class="text-success"><strong>Income</strong></h5>
                @php $totalIncome = 0; @endphp
                @foreach($incomeEntries->groupBy('category_id') as $category_id => $entries)
                <h6 class="text-primary font-weight-bold">{{ $category_id ? $entries->first()->category->name : '' }}</h6>
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entries as $income)

                        @php
                        $inc = \App\Models\Calculation::where('id', $income->calculation_id)->first();
                        @endphp
                        <tr>
                            <td>{{ $inc->created_at->format('Y-m-d') }}</td>
                            <td>{{ $income->description }}</td>
                            <td>{{ number_format($income->amount, 2) }}</td>
                        </tr>
                        @php $totalIncome += $income->amount; @endphp
                        @endforeach
                    </tbody>
                </table>
                @endforeach
                <h6><strong>Total Income:</strong> {{ number_format($totalIncome, 2) }}</h6>
            </div>
            </div>

            <!-- Expense Section -->
            <div class="col-md-6">
            <div class="border rounded p-3 mb-3 bg-light">
                <h5 class="text-danger"><strong>Expense</strong></h5>
                @php $totalExpense = 0; @endphp
                @foreach($expenseEntries->groupBy('category_id') as $category_id => $entries)
                <h6 class="text-primary font-weight-bold">{{ $category_id ? $entries->first()->category->name : '' }}</h6>
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entries as $expense)
                        @php
                        $inc = \App\Models\Calculation::where('id', $expense->calculation_id)->first();
                        @endphp
                        <tr>
                            <td>{{ $inc->created_at->format('Y-m-d') }}</td>
                            <td>{{ $expense->description }}</td>
                            <td>{{ number_format($expense->amount, 2) }}</td>
                        </tr>
                        @php $totalExpense += $expense->amount; @endphp
                        @endforeach
                    </tbody>
                </table>
                @endforeach
                <h6><strong>Total Expense:</strong> {{ number_format($totalExpense, 2) }}</h6>
            </div>
        </div>
        </div>

       <!-- Net Balance Calculation -->
       <div class="alert alert-info mt-4">
            <h4>Net Balance</h4>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Total Income</th>
                        <td>{{ number_format($totalIncome, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Total Expense</th>
                        <td>{{ number_format($totalExpense, 2) }}</td>
                    </tr>
                    @if ($previousBalance > 0)
                    <tr>
                        <th>Previous Balance</th>
                        <td>{{ number_format($previousBalance, 2) }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Net Balance</th>
                        <td>
                            @php
                                $netChange = $totalIncome - $totalExpense;
                                $netBalance = $previousBalance + $netChange;
                            @endphp
                            {{ number_format($netBalance, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Detailed Calculation -->
        <div class="mt-4">
            <h5>Calculation Details:</h5>
            <p>
            @if ($previousBalance > 0) <strong>Previous Balance:</strong> {{ number_format($previousBalance, 2) }}<br>@endif
                <strong>+/- Income - Expense:</strong> {{ number_format($totalIncome, 2) }} - {{ number_format($totalExpense, 2) }} = {{ number_format($netChange, 2) }}<br>
                <strong>Final Net Balance:</strong> {{ number_format($previousBalance, 2) }} + {{ number_format($netChange, 2) }} = <strong>{{ number_format($netBalance, 2) }}</strong>
            </p>
        </div>
    </div>

    <div class="card-footer">
        <a href="{{ route('backend.calculations.index') }}" class="btn btn-primary">Back to List</a>
    </div>
</div>

@endsection