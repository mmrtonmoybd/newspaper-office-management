@extends('boilerplate::layout.index', [
    'title' => 'আ/ন Ads',
    'subtitle' => 'আ/ন Ads lists',
    'breadcrumb' => [
        'A/N' => 'backend.ads.an.index',
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
                <a href="{{ route("backend.ads.an.index") }}" class="btn btn-default" data-toggle="tooltip" title="A/N lists">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card class="printable">
            <div class="row">

                <div class="col-6">
                <th><b>বিবরণ / আদেশ: </b></th><td>{{$adan->details}}</td>
                </div>

                <div class="col-6">
                <th><b>বিষয়: </b></th><td>{{$adan->subject}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>ছাপার তারিখ: </b></th><td>{{ (!empty($adan->published_date)) ? \Illuminate\Support\Carbon::parse($adan->published_date)->format('d/M/Y') : ''}}</td>
                </div>

                <div class="col-6">
                <th><b>তারিখ: </b></th><td>{{ (!empty($adan->date)) ? \Illuminate\Support\Carbon::parse($adan->date)->format('d/M/Y') : ''}}</td>
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
<button type="button" class="no-print primary-success btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
@endsection