@extends('boilerplate::layout.index', [
    'title' => 'Circulation representative',
    'subtitle' => 'Create circulation representative',
    'breadcrumb' => [
        'Circulation representative create' => 'backend.representative.create',
    ]
])

@section('content')
<x-boilerplate::form route='backend.representative.store'>
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
                <x-boilerplate::input name='name' type='text' label='নাম' clearable=true placeholder='নাম' required/>
                </div>

                <div class="col-6">
                <x-boilerplate::input name='email' type='email' label='ইমেইল' clearable=true placeholder='ইমেইল' />
                </div>


                <br><br>


                <div class="col-6">
                <x-boilerplate::input name='mobile' type='text' label='মোবাইল' clearable=true placeholder='মোবাইল' />
                </div>

                <div class="col-6">
                <x-boilerplate::input name='address' type='text' label='ঠিকানা' clearable=true placeholder='ঠিকানা' />
                </div>

            </div>
</x-boilerplate::card>
        </div>
    </div>
</x-boilerplate::form>
@endsection