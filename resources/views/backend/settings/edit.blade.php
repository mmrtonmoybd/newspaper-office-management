@extends('boilerplate::layout.index', [
    'title' => 'Settings',
    'subtitle' => 'Settings',
    'breadcrumb' => [
        'Settings' => 'backend.settings.index',
    ]
])

@section('content')
<x-boilerplate::form route='backend.settings.update'>
        <div class="row">
            <div class="col-12 pb-3">
                
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
                            

                            <!-- উপজেলার নাম -->
                            <div class="form-group">
                                <x-boilerplate::input name='update_within' type='text' label='Update within hour' value="{{$update->value}}" clearable=true placeholder='Update within hour' required/>
                            </div>

                        </div>

                        <!-- Right side -->
                        <div class="col-md-6">
                            <!-- পরিশোধিত বিল -->
                            <div class="form-group">
                                <x-boilerplate::input name='delete_within' type='text' label='Delete within hour' value="{{$delete->value}}" clearable=true placeholder='Delete within hour' required/>
                            </div>

                        
                        </div>

                
                </div>
                
</x-boilerplate::card>
        </div>
    </div>
</x-boilerplate::form>

@endsection