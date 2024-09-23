@extends('boilerplate::layout.index', [
    'title' => 'A/S Ads',
    'subtitle' => 'A/S Ads lists',
    'breadcrumb' => [
        'A/S' => 'backend.ads.as.index',
    ]
])

@section('content')
<x-boilerplate::form :route="['backend.ads.as.update', $adas->id]">
@method('PUT')
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.ads.as.index") }}" class="btn btn-default" data-toggle="tooltip" title="A/S lists">
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
                <x-boilerplate::input name='details' label='বিবরণ / আদেশ' clearable=true placeholder='বিবরণ / আদেশ' value="{{$adas->details}}" required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='subject' label='বিষয়' clearable=true placeholder='বিষয়' value="{{$adas->subject}}" required/>
                </div>

                <div class="col-6">
                <x-boilerplate::datetimepicker name="published_date" clearable=true placeholder='ছাপার তারিখ' required label="ছাপার তারিখ" value="{{$adas->published_date}}" format="D/M/Y"/>
                </div>

                <div class="col-6">
                <x-boilerplate::datetimepicker name="date" clearable=true placeholder='তারিখ' required label="তারিখ" value="{{$adas->date}}" format="D/M/Y"/>
                </div>

            </div>

            <div class="row">

                <div class="col-6">
                <x-boilerplate::input name='amount' label='টাকা' clearable=true placeholder='টাকা' value="{{$adas->amount}}" required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='size' label='সাইজ' clearable=true placeholder='সাইজ' value="{{$adas->size}}" required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='page' label='পৃষ্ঠা' clearable=true placeholder='পৃষ্ঠা' value="{{$adas->page}}" required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='as' label='আ/স' clearable=true placeholder='আ/স' value="{{$adas->as}}" required/>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                <x-boilerplate::input name='comment' type='textarea' label='মন্তব্য' clearable=true placeholder='মন্তব্য' value="{{$adas->comment}}" required/>
                </div>
            </div>
</x-boilerplate::card>
        </div>
    </div>
</x-boilerplate::form>
@endsection