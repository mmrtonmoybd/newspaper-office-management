@extends('boilerplate::layout.index', [
    'title' => 'Press paper',
    'subtitle' => 'Edit press paper',
    'breadcrumb' => [
        'Press paper list' => 'backend.paper.index',
    ]
])

@section('content')
<x-boilerplate::form :route="['backend.paper.update', $paper->id]">
@method('PUT')
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
                <x-boilerplate::input name='roll' value="{{$paper->roll}}" label='রোল নং' clearable=true placeholder='রোল নং' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='roll_weight' value="{{$paper->roll_weight}}" label='রোলের ওজন' clearable=true placeholder='রোলের ওজন' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::datetimepicker name="date" value="{{$paper->date}}" clearable=true placeholder='তারিখ' required label="তারিখ" format="D/M/Y"/>
                </div>


                <br><br>


                <div class="col-6">
                <x-boilerplate::input name='published_order' value="{{$paper->published_order}}" type='text' label='ছাপার অর্ডার' clearable=true placeholder='ছাপার অর্ডার' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='wastage' value="{{$paper->wastage}}" type='text' label='ওসেস্টেজ' clearable=true placeholder='ওসেস্টেজ' required/>
                </div>

            </div>
</x-boilerplate::card>
        </div>
    </div>
</x-boilerplate::form>
@endsection