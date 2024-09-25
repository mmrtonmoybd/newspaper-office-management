@extends('boilerplate::layout.index', [
    'title' => 'Ads panel',
    'subtitle' => 'Ads panel lists',
    'breadcrumb' => [
        'Ads panel' => 'backend.ads.panel.index',
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
                <a href="{{ route("backend.ads.panel.index") }}" class="btn btn-default" data-toggle="tooltip" title="Ads panel lists">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card class="printable">
            <div class="row">

                <div class="col-6">
                <th><b>প্রতিষ্ঠানের নাম: </b></th><td>{{$panel->org_name}}</td>
                </div>

                <div class="col-6">
                <th><b>টাকা: </b></th><td>{{$panel->amount}}</td>
                </div>
                <br><br>

                <div class="col-6">
                <th><b>বিজ্ঞাপন শুরু: </b></th><td>{{ (!empty($panel->advertisment_start_date)) ? \Illuminate\Support\Carbon::parse($panel->advertisment_start_date)->format('d/M/Y') : ''}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>বিজ্ঞাপন শেষ: </b></th><td>{{ (!empty($panel->publishadvertisment_end_dateed_date)) ? \Illuminate\Support\Carbon::parse($panel->publishadvertisment_end_dateed_date)->format('d/M/Y') : ''}}</td>
                </div>


                <div class="col-6">
                <th><b>প্ররিশোদের তারিখ: </b></th><td>{{ (!empty($panel->paid_date)) ? \Illuminate\Support\Carbon::parse($panel->paid_date)->format('d/M/Y') : ''}}</td>
                </div>

                <div class="col-6">
                <th><b>তারিখ: </b></th><td>{{ (!empty($panel->date)) ? \Illuminate\Support\Carbon::parse($panel->date)->format('d/M/Y') : ''}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">
                <div class="col-12">
                <th><b>মন্তব্য: </b></th><td>{{$panel->comment}}</td>
                </div>
            </div>
</x-boilerplate::card>
<button type="button" class="no-print primary-success btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
@endsection