<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashbook Design</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .header .date {
            font-size: 14px;
        }

        /* Table layout */
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .content-table th, .content-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .content-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .content-table td {
            vertical-align: top;
        }

        .total-section {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .total-section .totals {
            width: 20%;
            border: 1px solid black;
            padding: 10px;
        }

        .total-section .totals p {
            margin: 5px 0;
        }

        /* Signature section */
        .signature-section {
            margin-top: 100px;
            display: flex;
            justify-content: space-between;
        }

        .signature-section .signature {
            text-align: center;
            width: 30%;
            border-top: 1px solid black;
            padding-top: 5px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap; /* Ensures side-by-side layout adapts to smaller screens */
        }

        .col-md-6 {
            width: 48%;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .cat {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            background-color: silver;
            font-weight: bold;
        }

         /* Print-specific styles */
         @media print {
            body {
                font-size: 14px;
            }

            .container {
                border: none;
                padding: 0;
            }

            .no-print {
                display: none;
            }
        }

        /* Word Export - Handle the table wrapping issue */
        @media screen {
            .content {
                display: flex;
            }
        }
    </style>
</head>
<div id="exportContent">

    <!-- Header -->
    <div class="header">
        <h1>দৈনিক আজকের বার্তা</h1>
        <p>বরিশাল</p>
       
        <b><p class="date" align="right">তারিখ: {{ ($range != '' ) ? $range :  \Illuminate\Support\Carbon::parse($calculation->date)->format('d/m/Y')}}</p></b>
    </div>

    <div class="row">
                <!-- Income Section -->
                <div class="col-md-6">

    <!-- Content Section -->
    
    <table class="content-table">
        <tr>
            <th colspan="3">আয়</th>
            
        </tr>

        <tr>
                <td><b>Date</b></td>
                <td><b>Description</b></td>
                <td><b>Amount</b></td>
        </tr>

        @if ($previousBalance > 0)
        <tr>
            <td></td>
            <td>আগত তহবিল</td>
            <td>{{ number_format($previousBalance, 2) }}</td>
        </tr>
        @endif

        @php $totalIncome = 0; @endphp
                @foreach($incomeEntries->groupBy('category_id') as $category_id => $entries)
       @if ($category_id)
       
            <tr>
                <td class="cat" colspan="3">{{$entries->first()->category->name}}</td>
            </tr>
       @endif

       @foreach($entries as $income)
       @php
                        $inc = \App\Models\Calculation::where('id', $income->calculation_id)->first();
        @endphp
                        <tr>
                            <td>{{ \Illuminate\Support\Carbon::parse($inc->date)->format('d/m/Y') }}</td>
                            <td>{{ $income->description }}</td>
                            <td>{{ number_format($income->amount, 2) }}</td>
                        </tr>
                        @php $totalIncome += $income->amount; @endphp
        @endforeach
                        
                @endforeach
        
        
        
        <tr>
            <td colspan="2"><b>মোট:</b></td>
            <td colspan="1"><b>{{ number_format($previousBalance, 2) + number_format($totalIncome, 2) }}/-</b></td>
        </tr>
    </table>

    
    </div>


                <!-- Income Section -->
                <div class="col-md-6">
    <table class="content-table">
    <tr>
            <th colspan="3">ব্যয়</th>
            
        </tr>

        <tr>
                <td><b>Date</b></td>
                <td><b>Description</b></td>
                <td><b>Amount</b></td>
        </tr>

        @php $totalExpense = 0; @endphp
        @foreach($expenseEntries->groupBy('category_id') as $category_id => $entries)
       @if ($category_id)
       
            <tr>
                <td class="cat" colspan="3">{{$entries->first()->category->name}}</td>
            </tr>
       @endif

       @foreach($entries as $expense)
                        @php
                        $inc = \App\Models\Calculation::where('id', $expense->calculation_id)->first();
                        @endphp
                        <tr>
                            <td>{{ \Illuminate\Support\Carbon::parse($inc->date)->format('d/m/Y') }}</td>
                            <td>{{ $expense->description }}</td>
                            <td>{{ number_format($expense->amount, 2) }}</td>
                        </tr>
                        @php $totalExpense += $expense->amount; @endphp


       @endforeach
                        
                @endforeach
                <tr>
            <td colspan="2"><b>মোট:</b></td>
            <td colspan="1"><b>{{ number_format($totalExpense, 2) }}/-</b></td>
        </tr>
    </table>
    

                </div>
                </div>

    <!-- Totals Section -->
    <div class="total-section">
        <div class="totals">
            <p><strong>আয়:</strong> {{number_format($previousBalance, 2) + number_format($totalIncome, 2)}}/-</p>
            <p><strong>ব্যয়:</strong> {{number_format($totalExpense, 2)}}/-</p>
            @php
                                $netChange = $totalIncome - $totalExpense;
                                $netBalance = $previousBalance + $netChange;
            @endphp
                            
            <p><strong>স্থিতি:</strong> {{ number_format($netBalance, 2) }}/-</p>
        </div>
    </div>

    <!-- Signature Section -->
    <div class="signature-section">
        <div class="signature">
            হিসাব রক্ষক
        </div>
        <div class="signature">
            ব্যবস্থাপনা সম্পাদক
        </div>
        <div class="signature">
            সম্পাদক
        </div>
    </div>
    </div>

    <!-- JavaScript for Word Export -->
    <script>
    function Export2Word(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}
</script>

<!-- Buttons for Print and Word Export (hidden in print mode) -->
<div class="no-print" style="text-align:center; margin-top: 20px;">
    <button onclick="window.print()">Print</button>
    <button onclick="Export2Word('exportContent', 'word-content.docx');">Export to Word</button>
</div>

</body>
</html>
