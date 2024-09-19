@extends('boilerplate::layout.index', [
    'title' => 'Press ink list',
    'subtitle' => 'Press ink list',
    'breadcrumb' => [
        'Press ink list' => 'backend.ink.index',
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{route('backend.ink.create')}}" class="btn btn-primary">
                    Add a Press ink
                </a>
            </span>
        </div>
    </div>
    <x-boilerplate::card>
    <x-boilerplate::datatable name="ink" />
    </x-boilerplate::card>
@endsection