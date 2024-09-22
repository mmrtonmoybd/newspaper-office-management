@extends('boilerplate::layout.index', [
    'title' => 'Circulation daily',
    'subtitle' => 'Create circulation daily',
    'breadcrumb' => [
        'Circulation daily create' => 'backend.daily.create',
    ]
])

@section('content')
<x-boilerplate::form route='backend.daily.store'>
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.daily.index") }}" class="btn btn-default" data-toggle="tooltip" title="Circulation daily lists">
                    <span class="far fa-arrow-alt-circle-left text-muted"></span>
                </a>
                <span class="btn-group float-right">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
<x-boilerplate::card>
            <div class="row">

                 <!-- Left side -->
                 <div class="col-md-6">
                            <!-- প্রতিনিধির নাম -->
                            <div class="form-group">
                            <x-boilerplate::datetimepicker name="sell_date" clearable=true placeholder='বিক্রির তারিখ' label="বিক্রির তারিখ" format="D/M/Y" />
                            </div>

                            <!-- উপজেলার নাম -->
                            <div class="form-group">
                                <x-boilerplate::input name='buyer_name' type='text' label='হকার/এজেন্সি' clearable=true placeholder='হকার/এজেন্সি' required/>
                            </div>

                        </div>

                        <!-- Right side -->
                        <div class="col-md-6">
                            <!-- পরিশোধিত বিল -->
                            <div class="form-group">
                                <x-boilerplate::input name='sell_quantity' type='number' label='পত্রিকার সংখ্যা' clearable=true placeholder='পত্রিকার সংখ্যা' required/>
                            </div>

                            <!-- পরিশোধের তারিখ -->
                            <div class="form-group">
                                <x-boilerplate::input name='per_price' type='number' label='পত্রিকার মূল্য' step=".01" clearable=true placeholder='পত্রিকার মূল্য' required/>
                            </div>

                        
                        </div>

                
                </div>
                
</x-boilerplate::card>
            </div>

        </div>
    </div>
</x-boilerplate::form>
@endsection
