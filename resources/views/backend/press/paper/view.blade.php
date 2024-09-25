@extends('boilerplate::layout.index', [
    'title' => 'Press paper',
    'subtitle' => 'Press paper',
    'breadcrumb' => [
        'Press paper list' => 'backend.paper.index',
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
                <a href="{{ route("backend.paper.index") }}" class="btn btn-default" data-toggle="tooltip" title="Press paper list">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card class="printable">
            <div class="row">

                <div class="col-6">
                <th><b>রোল নং: </b></th><td>{{$paper->roll}}</td>
                </div>

                <div class="col-6">
                <th><b>রোলের ওজন: </b></th><td>{{$paper->roll_weight}}</td>
                </div>
                <br><br>

                <div class="col-6">
                <th><b>ছাপার অর্ডার: </b></th><td>{{$paper->published_order}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">

                <div class="col-6">
                <th><b>ওসেস্টেজ: </b></th><td>{{$paper->wastage}}</td>
                </div>

                <div class="col-6">
                <th><b>মোট: </b></th><td>{{$paper->total}}</td>
                </div>
                <br><br>

                <div class="col-6">
                <th><b>তারিখ: </b></th><td>{{(!empty($paper->date)) ? \Illuminate\Support\Carbon::parse($paper->date)->format('d/M/Y') : ''}}</td>
                </div>
                <br><br>
            </div>

</x-boilerplate::card>
<button type="button" class="no-print primary-success btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
@endsection