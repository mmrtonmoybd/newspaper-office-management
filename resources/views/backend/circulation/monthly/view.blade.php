@extends('boilerplate::layout.index', [
    'title' => 'Circulation monthly',
    'subtitle' => 'View circulation monthly',
    'breadcrumb' => [
        'Circulation monthly list' => 'backend.monthly.index',
    ]
])

@section('content')

        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.monthly.index") }}" class="btn btn-default" data-toggle="tooltip" title="Circulation monthly list">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card>
            <div class="row">

                <div class="col-6">
                <th><b>প্রতিনিধির নাম: </b></th><td>{{$monthly->representative->name}}</td>
                </div>

                <div class="col-6">
                <th><b>উপজেলার নাম: </b></th><td>{{$monthly->district}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>প্রতিদিন প্রেরণকৃত প্রত্রিকার সংখ্যা: </b></th><td>{{$monthly->send_quantity}}</td>
                </div>

                <div class="col-6">
                <th><b>মাসিক বিল: </b></th><td>{{$monthly->monthly_bill}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">

                <div class="col-6">
                <th><b>পরিশোধিত বিল: </b></th><td>{{$monthly->paid_bill}}</td>
                </div>

                <div class="col-6">
                <th><b>পরিশোধের তারিখ: </b></th><td>{{\Illuminate\Support\Carbon::parse($monthly->paid_date)->format('d/M/Y')}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>অতিরিক্ত বকেয়া: </b></th><td>{{$monthly->extra_due_bill}}</td>
                </div>

                <div class="col-6">
                <th><b>তারিখ: </b></th><td>{{\Illuminate\Support\Carbon::parse($monthly->created_at)->format('d/M/Y')}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">
                <div class="col-12">
                <th><b>মন্তব্য: </b></th><td>{{$monthly->comment}}</td>
                </div>
            </div>
</x-boilerplate::card>
        </div>
    </div>
@endsection