@extends('boilerplate::layout.index', [
    'title' => 'A/s Ads',
    'subtitle' => 'A/S Ads lists',
    'breadcrumb' => [
        'A/S' => 'backend.ads.as.index',
    ]
])

@section('content')

        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.ads.as.index") }}" class="btn btn-default" data-toggle="tooltip" title="A/S lists">
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
                <th><b>বিবরণ / আদেশ: </b></th><td>{{$adas->details}}</td>
                </div>

                <div class="col-6">
                <th><b>বিষয়: </b></th><td>{{$adas->subject}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>ছাপার তারিখ: </b></th><td>{{\Illuminate\Support\Carbon::parse($adas->published_date)->format('d/M/Y')}}</td>
                </div>

                <div class="col-6">
                <th><b>তারিখ: </b></th><td>{{\Illuminate\Support\Carbon::parse($adas->created_at)->format('d/M/Y')}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">

                <div class="col-6">
                <th><b>টাকা: </b></th><td>{{$adas->amount}}</td>
                </div>

                <div class="col-6">
                <th><b>সাইজ: </b></th><td>{{$adas->size}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>পৃষ্ঠা: </b></th><td>{{$adas->page}}</td>
                </div>

                <div class="col-6">
                <th><b>আ/স: </b></th><td>{{$adas->as}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">
                <div class="col-12">
                <th><b>মন্তব্য: </b></th><td>{{$adas->comment}}</td>
                </div>
            </div>
</x-boilerplate::card>
        </div>
    </div>
@endsection