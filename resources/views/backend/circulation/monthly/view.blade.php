@extends('boilerplate::layout.index', [
    'title' => 'Circulation monthly',
    'subtitle' => 'View circulation monthly',
    'breadcrumb' => [
        'Circulation monthly list' => 'backend.monthly.index',
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
                <a href="{{ route("backend.monthly.index") }}" class="btn btn-default" data-toggle="tooltip" title="Circulation monthly list">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card class="printable">
            <div class="row">

                <div class="col-6">
                <th><b>প্রতিনিধির নাম: </b></th><td><a href="{{route('backend.representative.show', $monthly->representative->id)}}">{{$monthly->representative->name}}</a></td>
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
                <th><b>পরিশোধের তারিখ: </b></th><td>{{ (!empty($monthly->paid_date)) ? \Illuminate\Support\Carbon::parse($monthly->paid_date)->format('d/M/Y') : ''}}</td>
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
<button type="button" class="no-print primary-success btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
@endsection