@extends('boilerplate::layout.index', [
    'title' => 'A/N Ads',
    'subtitle' => 'A/N Ads lists',
    'breadcrumb' => [
        'A/N' => 'backend.ads.an.index',
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{route('backend.ads.an.create')}}" class="btn btn-primary">
                    Add a A/N
                </a>
            </span>
        </div>
    </div>
    <x-boilerplate::card>
    <x-boilerplate::datatable name="advertisan" />
    </x-boilerplate::card>
@endsection