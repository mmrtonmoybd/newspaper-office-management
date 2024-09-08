@extends('boilerplate::layout.index', [
    'title' => 'Category',
    'subtitle' => 'Categories lists',
    'breadcrumb' => [
        'Calculation' => 'backend.categories.index',
    ]
])

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Category</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('backend.categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter category name" required>
            </div>

            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
</div>

@endsection