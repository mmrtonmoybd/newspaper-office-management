@extends('boilerplate::layout.index', [
    'title' => 'Circulation representative list',
    'subtitle' => 'Circulation representative list',
    'breadcrumb' => [
        'Circulation representative list' => 'backend.representative.index',
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{route('backend.representative.create')}}" class="btn btn-primary">
                    Add a Circulation representative
                </a>
            </span>
        </div>
    </div>
    <x-boilerplate::card>
    <x-boilerplate::datatable name="representative" />
    </x-boilerplate::card>
@endsection