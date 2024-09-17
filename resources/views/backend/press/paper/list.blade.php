@extends('boilerplate::layout.index', [
    'title' => 'Press paper list',
    'subtitle' => 'Press paper list',
    'breadcrumb' => [
        'Press paper list' => 'backend.paper.index',
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{route('backend.paper.create')}}" class="btn btn-primary">
                    Add a Press paper
                </a>
            </span>
        </div>
    </div>
    <x-boilerplate::card>
    <x-boilerplate::datatable name="paper" />
    </x-boilerplate::card>
@endsection