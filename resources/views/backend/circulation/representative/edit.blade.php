@extends('boilerplate::layout.index', [
    'title' => 'Circulation representative',
    'subtitle' => 'Edit circulation representative',
    'breadcrumb' => [
        'Circulation representative list' => 'backend.representative.index',
    ]
])

@section('content')
<x-boilerplate::form :route="['backend.representative.update', $representative->id]">
@method('PUT')
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.representative.index") }}" class="btn btn-default" data-toggle="tooltip" title="Circulation representative lists">
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
                <x-boilerplate::input name='name' type='text' label='নাম' value="{{$representative->name}}" clearable=true placeholder='নাম' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='email' type='email' label='ইমেইল' value="{{$representative->email}}" clearable=true placeholder='ইমেইল' />
                </div>


                <br><br>


                <div class="col-6">
                <x-boilerplate::input name='mobile' type='text' label='মোবাইল' value="{{$representative->mobile}}" clearable=true placeholder='মোবাইল' />
                </div>

                <div class="col-6">
                <x-boilerplate::input name='address' type='text' label='ঠিকানা' value="{{$representative->address}}" clearable=true placeholder='ঠিকানা' />
                </div>

</div>
</x-boilerplate::card>
        </div>
    </div>
</x-boilerplate::form>
@endsection