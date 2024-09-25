@extends('boilerplate::layout.index', [
    'title' => 'Press plate',
    'subtitle' => 'Press plate',
    'breadcrumb' => [
        'Press plate list' => 'backend.plate.index',
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
                <a href="{{ route("backend.plate.index") }}" class="btn btn-default" data-toggle="tooltip" title="Press plate list">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card class="printable">
            <div class="row">

                <div class="col-6">
                <th><b>ছাপার তারিখ: </b></th><td>{{(!empty($plate->published_date)) ? \Illuminate\Support\Carbon::parse($plate->published_date)->format('d/M/Y') : ''}}</td>
                </div>

                <div class="col-6">
                <th><b>অগ্রিম প্রদান: </b></th><td>{{$plate->advance_paid}}</td>
                </div>
                <br><br>

                <div class="col-6">
                <th><b>কর্তনকৃত টাকা: </b></th><td>{{$plate->cut_amount}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">

                <div class="col-6">
                <th><b>প্রতিদিনের প্লেট: </b></th><td>{{$plate->daily_plate}}</td>
                </div>

                <div class="col-6">
                <th><b>নতুন প্লেট: </b></th><td>{{$plate->new_plate}}</td>
                </div>
                <br><br>

                <div class="col-6">
                <th><b>টোটাল প্লেট: </b></th><td>{{$plate->total_plate}}</td>
                </div>
                <br><br>
            </div>

</x-boilerplate::card>
<button type="button" class="no-print primary-success btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
@endsection