@extends('boilerplate::layout.index', [
    'title' => 'Circulation monthly',
    'subtitle' => 'Create circulation monthly',
    'breadcrumb' => [
        'Circulation monthly create' => 'backend.monthly.create',
    ]
])

@section('content')
<x-boilerplate::form route='backend.monthly.store'>
        <div class="row">
            <div class="col-12 pb-3">
                <a href="{{ route("backend.monthly.index") }}" class="btn btn-default" data-toggle="tooltip" title="Circulation monthly lists">
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
                                <x-boilerplate::select2 label="প্রতিনিধির নাম" name="monthly_circulation_repen_id" model="App\Models\MonthlyCirculationRepen|name" allow-clear placeholder="প্রতিনিধির নাম" required/>
                            </div>

                            <!-- উপজেলার নাম -->
                            <div class="form-group">
                                <x-boilerplate::input name='district' type='text' label='উপজেলার নাম' clearable=true placeholder='উপজেলার নাম' required/>
                            </div>

                            <!-- প্রতিদিন প্রেরণকৃত প্রত্রিকার সংখ্যা -->
                            <div class="form-group">
                                <x-boilerplate::input name='send_quantity' type='number' label='প্রতিদিন প্রেরণকৃত প্রত্রিকার সংখ্যা' clearable=true placeholder='প্রতিদিন প্রেরণকৃত প্রত্রিকার সংখ্যা' required/>
                            </div>

                            <!-- মাসিক বিল -->
                            <div class="form-group">
                                <x-boilerplate::input name='monthly_bill' type='number' label='মাসিক বিল' clearable=true placeholder='মাসিক বিল' required/>
                            </div>
                        </div>

                        <!-- Right side -->
                        <div class="col-md-6">
                            <!-- পরিশোধিত বিল -->
                            <div class="form-group">
                                <x-boilerplate::input name='paid_bill' type='number' label='পরিশোধিত বিল' clearable=true placeholder='পরিশোধিত বিল' required/>
                            </div>

                            <!-- পরিশোধের তারিখ -->
                            <div class="form-group">
                                <x-boilerplate::datetimepicker name="paid_date" clearable=true placeholder='পরিশোধের তারিখ' label="পরিশোধের তারিখ" format="D/M/Y" required/>
                            </div>

                            <!-- চলতি বকেয়া -->
                            
                                <x-boilerplate::input name='due_bill' type='number' id="due_bill" label='চলতি বকেয়া' clearable=true placeholder='চলতি বকেয়া' disabled/>
                                <small class="form-text text-muted">মাসিক বিল থেকে পরিশোধিত বিল বাদ দিয়ে চলতি বকেয়া নির্ণয় গণনা করা হয়। <br><font color='red'>বি:দ্র: যদি চলমান বকেয়া গণনার(মাসিক বিল - পরিশোধিত বিল) অতিরিক্ত বকেয়া থাকে তবে "কাস্টম চলতি বকেয়া" বাটন টি চাপ দিয়ে উক্ত ফর্মে গণনাকৃত (মাসিক বিল - পরিশোধিত বিল) বকেয়াটি বাদ দিয়ে অতিরিক্তটি লিখতে হবে।</font></small>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="enableDueBill">
                                    <label class="form-check-label" for="enableDueBill">কাস্টম চলতি বকেয়া</label>
                                </div>
                            

                            
                        </div>

                        <div class="form-group col-md-12">
                            <x-boilerplate::input name='comment' type='textarea' label='মন্তব্য' clearable=true placeholder='মন্তব্য'/>
                        </div>
                </div>
                
</x-boilerplate::card>
            </div>

        </div>
    </div>
</x-boilerplate::form>

<x-boilerplate::minify>
<script>
    // Enable or disable the due_bill input field based on the checkbox
    document.getElementById('enableDueBill').addEventListener('change', function() {
        var dueBillInput = document.getElementById('due_bill');
        dueBillInput.disabled = !this.checked;
    });
</script>
</x-boilerplate::minify>
@endsection
