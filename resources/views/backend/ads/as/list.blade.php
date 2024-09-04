@extends('boilerplate::layout.index', [
    'title' => 'A/N Ads',
    'subtitle' => 'A/N Ads lists',
    'breadcrumb' => [
        'A/S' => 'backend.ads.as.index',
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{route('backend.ads.as.create')}}" class="btn btn-primary">
                    Add a A/S
                </a>
            </span>
        </div>
    </div>
    <x-boilerplate::card>
    <x-boilerplate::datatable name="advertisingas" />
    </x-boilerplate::card>
@endsection