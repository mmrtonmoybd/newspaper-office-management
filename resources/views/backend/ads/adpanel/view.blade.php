@extends('boilerplate::layout.index', [
    'title' => 'Ads panel',
    'subtitle' => 'Ads panel lists',
    'breadcrumb' => [
        'Ads panel' => 'backend.ads.panel.index',
    ]
])

@section('content')

        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.ads.panel.index") }}" class="btn btn-default" data-toggle="tooltip" title="Ads panel lists">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                <span class="btn-group float-right">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card>
            <div class="row">

                <div class="col-6">
                <th><b>প্রতিষ্ঠানের নাম: </b></th><td>{{$panel->org_name}}</td>
                </div>

                <div class="col-6">
                <th><b>টাকা: </b></th><td>{{$panel->amount}}</td>
                </div>
                <br><br>

                <div class="col-6">
                <th><b>বিজ্ঞাপন শুরু: </b></th><td>{{\Illuminate\Support\Carbon::parse($panel->advertisment_start_date)->format('d/M/Y')}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>বিজ্ঞাপন শেষ: </b></th><td>{{\Illuminate\Support\Carbon::parse($panel->publishadvertisment_end_dateed_date)->format('d/M/Y')}}</td>
                </div>


                <div class="col-6">
                <th><b>প্ররিশোদের তারিখ: </b></th><td>{{\Illuminate\Support\Carbon::parse($panel->paid_date)->format('d/M/Y')}}</td>
                </div>

                <div class="col-6">
                <th><b>তারিখ: </b></th><td>{{\Illuminate\Support\Carbon::parse($panel->created_at)->format('d/M/Y')}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">
                <div class="col-12">
                <th><b>মন্তব্য: </b></th><td>{{$panel->comment}}</td>
                </div>
            </div>
</x-boilerplate::card>
        </div>
    </div>
@endsection