@extends('boilerplate::layout.index', [
    'title' => 'Circulation daily list',
    'subtitle' => 'Circulation daily list',
    'breadcrumb' => [
        'Circulation daily list' => 'backend.daily.index',
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{route('backend.daily.create')}}" class="btn btn-primary">
                    Add a Circulation daily
                </a>
            </span>
        </div>
    </div>
    <x-boilerplate::card>
    <x-boilerplate::datatable name="daily" />
    </x-boilerplate::card>
@endsection