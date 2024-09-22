@extends('boilerplate::layout.index', [
    'title' => 'Circulation daily',
    'subtitle' => 'Edit circulation daily',
    'breadcrumb' => [
        'Circulation daily list' => 'backend.daily.index',
    ]
])

@section('content')
<x-boilerplate::form :route="['backend.daily.update', $daily->id]">
@method('PUT')
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.daily.index") }}" class="btn btn-default" data-toggle="tooltip" title="Circulation daily lists">
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

                 <!-- Left side -->
                 <div class="col-md-6">
                            <!-- প্রতিনিধির নাম -->
                            <div class="form-group">
                            <x-boilerplate::datetimepicker name="sell_date" clearable=true placeholder='বিক্রির তারিখ' value="{{$daily->sell_date}}" label="বিক্রির তারিখ" format="D/M/Y" />
                            </div>

                            <!-- উপজেলার নাম -->
                            <div class="form-group">
                                <x-boilerplate::input name='buyer_name' type='text' label='হকার/এজেন্সি' value="{{$daily->buyer_name}}" clearable=true placeholder='হকার/এজেন্সি' required/>
                            </div>

                        </div>

                        <!-- Right side -->
                        <div class="col-md-6">
                            <!-- পরিশোধিত বিল -->
                            <div class="form-group">
                                <x-boilerplate::input name='sell_quantity' type='number' label='পত্রিকার সংখ্যা' value="{{$daily->sell_quantity}}" clearable=true placeholder='পত্রিকার সংখ্যা' required/>
                            </div>

                            <!-- পরিশোধের তারিখ -->
                            <div class="form-group">
                                <x-boilerplate::input name='per_price' type='number' label='পত্রিকার মূল্য' value="{{$daily->per_price}}" clearable=true placeholder='পত্রিকার মূল্য' required/>
                            </div>

                        
                        </div>

                
                </div>
                
</x-boilerplate::card>
        </div>
    </div>
</x-boilerplate::form>

@endsection