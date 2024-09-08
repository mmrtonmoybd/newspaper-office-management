@extends('boilerplate::layout.index', [
    'title' => 'Cashbook',
    'subtitle' => 'Cashbook',
    'breadcrumb' => [
        'Cashbook' => 'backend.calculations.index',
    ]
])

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cashbook Details</h3>
    </div>

    <div class="card-body">
        <h4>{{ $calculation->name }}</h4>

        <div class="row">
            <!-- Income Section -->
            <div class="col-md-6">
                <h5>Income</h5>
                @php $totalIncome = 0; @endphp
                @foreach($calculation->entries->where('type', 'income')->groupBy('category_id') as $category_id => $entries)
                <h6>{{ $category_id ? $entries->first()->category->name : 'No Category' }}</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entries as $income)
                        <tr>
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

            <!-- Expense Section -->
            <div class="col-md-6">
                <h5>Expense</h5>
                @php $totalExpense = 0; @endphp
                @foreach($calculation->entries->where('type', 'expense')->groupBy('category_id') as $category_id => $entries)
                <h6>{{ $category_id ? $entries->first()->category->name : 'No Category' }}</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entries as $expense)
                        <tr>
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

        <!-- Net Profit Calculation -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Net Profit</h4>
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
                        <tr>
                            <th>Net Profit</th>
                            <td>
                                @php
                                    $netProfit = $totalIncome - $totalExpense;
                                @endphp
                                {{ number_format($netProfit, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <a href="{{ route('backend.cashbook.calculations.index') }}" class="btn btn-primary">Back to List</a>
    </div>
</div>


@endsection