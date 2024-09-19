@extends('boilerplate::layout.index', [
    'title' => 'Press ink',
    'subtitle' => 'Edit press ink',
    'breadcrumb' => [
        'Press ink list' => 'backend.ink.index',
    ]
])

@section('content')
<x-boilerplate::form :route="['backend.ink.update', $ink->id]">
@method('PUT')
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.ink.index") }}" class="btn btn-default" data-toggle="tooltip" title="Press ink lists">
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
<x-boilerplate::input name='color' type='text' label='কালার' value="{{$ink->color}}" clearable=true placeholder='কালার' required/>
</div>

<div class="col-6">
<x-boilerplate::input name='amount' type='number' label='টাকা' value="{{$ink->amount}}" clearable=true placeholder='টাকা' required/>
</div>

<div class="col-6">
<x-boilerplate::datetimepicker name="purchased_date" value="{{$ink->purchased_date}}" clearable=true placeholder='ক্রয়ের তারিখ' required label="ক্রয়ের তারিখ" format="D/M/Y" />
</div>


<br><br>


<div class="col-6">
<x-boilerplate::input name='quantity' type='text' label='পরিমান' value="{{$ink->quantity}}" clearable=true placeholder='পরিমান' required/>
</div>

<div class="col-6">
<x-boilerplate::datetimepicker name="ink_end" value="{{$ink->ink_end}}" clearable=true placeholder='কালি শেষ হওয়ার তারিখ' label="কালি শেষ হওয়ার তারিখ" format="D/M/Y" />
</div>

</div>
</x-boilerplate::card>
        </div>
    </div>
</x-boilerplate::form>
@endsection