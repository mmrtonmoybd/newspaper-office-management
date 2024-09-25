@extends('boilerplate::layout.index', [
    'title' => 'Circulation daily',
    'subtitle' => 'View circulation daily',
    'breadcrumb' => [
        'Circulation daily list' => 'backend.daily.index',
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
                <a href="{{ route("backend.daily.index") }}" class="btn btn-default" data-toggle="tooltip" title="Circulation monthly list">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card class="printable">
            <div class="row">

                <div class="col-6">
                <th><b>বিক্রির তারিখ: </b></th><td>{{ (!empty($daily->sell_date)) ? \Illuminate\Support\Carbon::parse($daily->sell_date)->format('d/M/Y') : ''}}</td>
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
<button type="button" class="no-print primary-success btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
@endsection