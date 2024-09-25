@extends('boilerplate::layout.index', [
    'title' => 'A/s Ads',
    'subtitle' => 'A/S Ads lists',
    'breadcrumb' => [
        'A/S' => 'backend.ads.as.index',
    ]
])
@push('css')
<style>
        /* Hide everything by default when printing */
        @media print {
            body * {
                visibility: hidden;
            }

            /* Only print content inside .printable */
            .printable, .printable * {
                visibility: visible;
            }

            /* Center content on print page */
            .printable {
            }

            /* Font size responsive for print */
            .printable {
                font-size: 14pt; /* Default font size */
            }

            .no-print {
                display: none;
            }

            /* Larger font for higher-resolution print */
            @media print and (min-resolution: 300dpi) {
                .printable {
                    font-size: 18pt; /* Larger font for high-resolution prints */
                }
            }
        }
</style>
@endpush
@section('content')

        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.ads.as.index") }}" class="btn btn-default" data-toggle="tooltip" title="A/S lists">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12 printable">
<x-boilerplate::card class="printable">
            <div class="row ">

                <div class="col-6">
                <th><b>বিবরণ / আদেশ: </b></th><td>{{$adas->details}}</td>
                </div>

                <div class="col-6">
                <th><b>বিষয়: </b></th><td>{{$adas->subject}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>ছাপার তারিখ: </b></th><td>{{ (!empty($adas->published_date)) ? \Illuminate\Support\Carbon::parse($adas->published_date)->format('d/M/Y') : ''}}</td>
                </div>

                <div class="col-6">
                <th><b>তারিখ: </b></th><td>{{ (!empty($adas->date)) ? \Illuminate\Support\Carbon::parse($adas->date)->format('d/M/Y') : ''}}</td>
                </div>
                <br><br>
            </div>

            <div class="row ">

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

            <div class="row ">
                <div class="col-12">
                <th><b>মন্তব্য: </b></th><td>{{$adas->comment}}</td>
                </div>
            </div>

            
</x-boilerplate::card>
<button type="button" class="no-print primary-success btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
@endsection