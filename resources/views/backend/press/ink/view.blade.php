@extends('boilerplate::layout.index', [
    'title' => 'Press ink',
    'subtitle' => 'Press ink',
    'breadcrumb' => [
        'Press ink list' => 'backend.ink.index',
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
                <a href="{{ route("backend.ink.index") }}" class="btn btn-default" data-toggle="tooltip" title="Press ink list">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card class="printable">
            <div class="row">

                <div class="col-6">
                <th><b>কালার: </b></th><td>{{$ink->color}}</td>
                </div>

                <div class="col-6">
                <th><b>ক্রয়ের তারিখ: </b></th><td>{{ (!empty($ink->purchased_date)) ? \Illuminate\Support\Carbon::parse($ink->purchased_date)->format('d/M/Y') : ''}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">

                <div class="col-6">
                <th><b>টাকা: </b></th><td>{{$ink->amount}}</td>
                </div>

                <div class="col-6">
                <th><b>পরিমান: </b></th><td>{{$ink->quantity}}</td>
                </div>
                <br><br>

                <div class="col-6">
                <th><b>কালি শেষ হওয়ার তারিখ: </b></th><td>{{(!empty($ink->ink_end)) ? \Illuminate\Support\Carbon::parse($ink->ink_end)->format('d/M/Y') : ''}}</td>
                </div>
                <br><br>
            </div>

</x-boilerplate::card>
<button type="button" class="no-print primary-success btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
@endsection