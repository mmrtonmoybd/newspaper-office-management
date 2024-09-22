@extends('boilerplate::layout.index', [
    'title' => 'Circulation daily',
    'subtitle' => 'View circulation daily',
    'breadcrumb' => [
        'Circulation daily list' => 'backend.daily.index',
    ]
])

@section('content')

        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.daily.index") }}" class="btn btn-default" data-toggle="tooltip" title="Circulation monthly list">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card>
            <div class="row">

                <div class="col-6">
                <th><b>বিক্রির তারিখ: </b></th><td>{{\Illuminate\Support\Carbon::parse($daily->sell_date)->format('d/M/Y')}}</td>
                </div>

                <div class="col-6">
                <th><b>হকার/এজেন্সি: </b></th><td>{{$daily->buyer_name}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>পত্রিকার সংখ্যা: </b></th><td>{{$daily->sell_quantity}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">

                <div class="col-6">
                <th><b>পত্রিকার মূল্য: </b></th><td>{{$daily->per_price}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>মোট টাকা: </b></th><td>{{$daily->total_price}}</td>
                </div>

            </div>

</x-boilerplate::card>
        </div>
    </div>
@endsection