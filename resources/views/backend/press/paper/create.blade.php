@extends('boilerplate::layout.index', [
    'title' => 'Press paper',
    'subtitle' => 'Create press paper',
    'breadcrumb' => [
        'Press paper create' => 'backend.paper.create',
    ]
])

@section('content')
<x-boilerplate::form route='backend.paper.store'>
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.paper.index") }}" class="btn btn-default" data-toggle="tooltip" title="Press paper lists">
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
                <x-boilerplate::input name='roll' label='রোল নং' clearable=true placeholder='রোল নং' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='roll_weight' label='রোলের ওজন' clearable=true placeholder='রোলের ওজন' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::datetimepicker name="date" clearable=true placeholder='তারিখ' required label="তারিখ" format="D/M/Y"/>
                </div>


                <br><br>


                <div class="col-6">
                <x-boilerplate::input name='published_order' type='number' label='ছাপার অর্ডার' clearable=true placeholder='ছাপার অর্ডার' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='wastage' type='number' label='ওসেস্টেজ' clearable=true placeholder='ওসেস্টেজ' required/>
                </div>

            </div>
</x-boilerplate::card>
        </div>
    </div>
</x-boilerplate::form>
@endsection