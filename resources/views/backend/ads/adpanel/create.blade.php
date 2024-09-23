@extends('boilerplate::layout.index', [
    'title' => 'Create Ads panel',
    'subtitle' => 'Create Ads panel',
    'breadcrumb' => [
        'Ads panel' => 'backend.ads.panel.create',
    ]
])

@section('content')
<x-boilerplate::form route='backend.ads.panel.store'>
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.ads.panel.index") }}" class="btn btn-default" data-toggle="tooltip" title="Ads panel lists">
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

                <div class="col-6">
                <x-boilerplate::input name='org_name' label='প্রতিষ্ঠানের নাম' clearable=true placeholder='প্রতিষ্ঠানের নাম' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='amount' label='টাকা' clearable=true placeholder='টাকা' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::datetimepicker name="advertisment_start_date" clearable=true placeholder='বিজ্ঞাপন শুরু' required label="বিজ্ঞাপন শুরু" format="D/M/Y"/>
                </div>
                <div class="col-6">
                <x-boilerplate::datetimepicker name="advertisment_end_date" clearable=true placeholder='বিজ্ঞাপন শেষ' required label="বিজ্ঞাপন শেষ" format="D/M/Y"/>
                </div>

            </div>

            <div class="row">

                

                <div class="col-6">
                <x-boilerplate::datetimepicker name="paid_date" clearable=true placeholder='প্ররিশোদের তারিখ' required label="প্ররিশোদের তারিখ" format="D/M/Y"/>
                </div>

                <div class="col-6">
                <x-boilerplate::datetimepicker name="date" clearable=true placeholder='তারিখ' required label="তারিখ" value="{{\Illuminate\Support\Carbon::now()}}" format="D/M/Y"/>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                <x-boilerplate::input name='comment' type='textarea' label='মন্তব্য' clearable=true placeholder='মন্তব্য' required/>
                </div>
            </div>
</x-boilerplate::card>
        </div>
    </div>
</x-boilerplate::form>
@endsection