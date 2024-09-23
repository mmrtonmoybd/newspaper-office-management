@extends('boilerplate::layout.index', [
    'title' => 'A/N Ads',
    'subtitle' => 'A/N Ads lists',
    'breadcrumb' => [
        'A/N' => 'backend.ads.an.index',
    ]
])

@section('content')
<x-boilerplate::form route='backend.ads.an.store'>
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.ads.an.index") }}" class="btn btn-default" data-toggle="tooltip" title="A/N lists">
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
                <x-boilerplate::input name='details' label='বিবরণ / আদেশ' clearable=true placeholder='বিবরণ / আদেশ' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='subject' label='বিষয়' clearable=true placeholder='বিষয়' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::datetimepicker name="date" clearable=true placeholder='তারিখ' required label="তারিখ" value="{{\Illuminate\Support\Carbon::now()}}" format="D/M/Y"/>
                </div>

                <div class="col-6">
                <x-boilerplate::datetimepicker name="published_date" clearable=true placeholder='ছাপার তারিখ' required label="ছাপার তারিখ" format="D/M/Y"/>
                </div>

            </div>

            <div class="row">

                <div class="col-6">
                <x-boilerplate::input name='amount' label='টাকা' clearable=true placeholder='টাকা' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='size' label='সাইজ' clearable=true placeholder='সাইজ' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='page' label='পৃষ্ঠা' clearable=true placeholder='পৃষ্ঠা' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='an' label='আ/ন' clearable=true placeholder='আ/ন' required/>
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