@extends('boilerplate::layout.index', [
    'title' => 'Press plate list',
    'subtitle' => 'Press plate list',
    'breadcrumb' => [
        'Press plate list' => 'backend.plate.index',
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{route('backend.plate.create')}}" class="btn btn-primary">
                    Add a Press plate
                </a>
            </span>
        </div>
    </div>
    <x-boilerplate::card>
    <x-boilerplate::datatable name="plate" />
    </x-boilerplate::card>
@endsection