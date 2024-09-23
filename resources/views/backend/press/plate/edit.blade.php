@extends('boilerplate::layout.index', [
    'title' => 'Press plate',
    'subtitle' => 'Edit press plate',
    'breadcrumb' => [
        'Press plate list' => 'backend.plate.index',
    ]
])

@section('content')
<x-boilerplate::form :route="['backend.plate.update', $plate->id]">
@method('PUT')
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.plate.index") }}" class="btn btn-default" data-toggle="tooltip" title="Press plate lists">
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
                <x-boilerplate::input name='advance_paid' type='text' value="{{$plate->advance_paid}}" label='অগ্রিম প্রদান' clearable=true placeholder='অগ্রিম প্রদান' />
                </div>

                <div class="col-6">
                <x-boilerplate::input name='cut_amount' type='text' value="{{$plate->cut_amount}}" label='কর্তনকৃত টাকা' clearable=true placeholder='কর্তনকৃত টাকা' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::datetimepicker name="published_date" clearable=true placeholder='ছাপার তারিখ' value="{{$plate->published_date}}" required label="ছাপার তারিখ" format="D/M/Y"/>
                </div>


                <br><br>


                <div class="col-6">
                <x-boilerplate::input name='daily_plate' type='text' label='প্রতিদিনের প্লেট' value="{{$plate->daily_plate}}" clearable=true placeholder='প্রতিদিনের প্লেট' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='new_plate' type='text' label='নতুন প্লেট' value="{{$plate->new_plate}}" clearable=true placeholder='নতুন প্লেট'/>
                </div>

            </div>
</x-boilerplate::card>
        </div>
    </div>
</x-boilerplate::form>
@endsection