@extends('boilerplate::layout.index', [
    'title' => 'Ads panel',
    'subtitle' => 'Ads panel lists',
    'breadcrumb' => [
        'A/N' => 'backend.ads.panel.index',
    ]
])

@section('content')
    <div class="row">
        <div class="col-12 mbl">
            <span class="float-right pb-3">
                <a href="{{route('backend.ads.panel.create')}}" class="btn btn-primary">
                    Add a Ads Panel
                </a>
            </span>
        </div>
    </div>
    <x-boilerplate::card>
    <x-boilerplate::datatable name="advertisingpanel" />
    </x-boilerplate::card>
@endsection