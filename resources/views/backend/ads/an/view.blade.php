@extends('boilerplate::layout.index', [
    'title' => 'আ/ন Ads',
    'subtitle' => 'আ/ন Ads lists',
    'breadcrumb' => [
        'A/N' => 'backend.ads.an.index',
    ]
])

@section('content')

        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.ads.an.index") }}" class="btn btn-default" data-toggle="tooltip" title="A/N lists">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card>
            <div class="row">

                <div class="col-6">
                <th><b>বিবরণ / আদেশ: </b></th><td>{{$adan->details}}</td>
                </div>

                <div class="col-6">
                <th><b>বিষয়: </b></th><td>{{$adan->subject}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>ছাপার তারিখ: </b></th><td>{{\Illuminate\Support\Carbon::parse($adan->published_date)->format('d/M/Y')}}</td>
                </div>

                <div class="col-6">
                <th><b>তারিখ: </b></th><td>{{\Illuminate\Support\Carbon::parse($adan->date)->format('d/M/Y')}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">

                <div class="col-6">
                <th><b>টাকা: </b></th><td>{{$adan->amount}}</td>
                </div>

                <div class="col-6">
                <th><b>সাইজ: </b></th><td>{{$adan->size}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>পৃষ্ঠা: </b></th><td>{{$adan->page}}</td>
                </div>

                <div class="col-6">
                <th><b>আ/ন: </b></th><td>{{$adan->an}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">
                <div class="col-12">
                <th><b>মন্তব্য: </b></th><td>{{$adan->comment}}</td>
                </div>
            </div>
</x-boilerplate::card>
        </div>
    </div>
@endsection