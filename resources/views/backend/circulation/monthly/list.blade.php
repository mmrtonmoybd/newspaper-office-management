@extends('boilerplate::layout.index', [
    'title' => 'Circulation monthly list',
    'subtitle' => 'Circulation monthly list',
    'breadcrumb' => [
        'Circulation monthly list' => 'backend.monthly.index',
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{route('backend.monthly.create')}}" class="btn btn-primary">
                    Add a Circulation monthly
                </a>
            </span>
        </div>
    </div>
    <x-boilerplate::card>
    <x-boilerplate::datatable name="monthly" />
    </x-boilerplate::card>
@endsection