@extends('boilerplate::layout.index', [
    'title' => 'Circulation representative',
    'subtitle' => 'Circulation representative',
    'breadcrumb' => [
        'Circulation representative list' => 'backend.representative.index',
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
                <a href="{{ route("backend.representative.index") }}" class="btn btn-default" data-toggle="tooltip" title="Circulation representative list">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card class="printable">
            <div class="row">

                <div class="col-6">
                <th><b>প্রতিনিধির নাম: </b></th><td>{{$representative->name}}</td>
                </div>

                <div class="col-6">
                    @php
                        $monthly = App\Models\MonthlyCirculation::where('monthly_circulation_repen_id', $representative->id)->orderBy('id', 'desc')->first();
                        $due = !empty($monthly->due_bill) ? $monthly->due_bill : 0;
                    @endphp
                <th><b>মোট বকেয়া: </b></th><td>{{$due}}</td>
                </div>
                <br><br>
                <div class="col-6">
                <th><b>ইমেইল: </b></th><td>{{$representative->email}}</td>
                </div>
                <br><br>
            </div>

            <div class="row">

                <div class="col-6">
                <th><b>মোবাইল: </b></th><td>{{$representative->mobile}}</td>
                </div>

                <div class="col-6">
                <th><b>ঠিকানা: </b></th><td>{{$representative->address}}</td>
                </div>
                <br><br>

                <div class="col-6">
                <th><b>তারিখ: </b></th><td>{{\Illuminate\Support\Carbon::parse($representative->created_at)->format('d/M/Y')}}</td>
                </div>
                <br><br>
            </div>

</x-boilerplate::card>
<button type="button" class="no-print primary-success btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
@endsection