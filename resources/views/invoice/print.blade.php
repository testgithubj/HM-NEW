<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" href="">
    <!-- Font -->
    <title>Print Invoice</title>
    <style>
        body {
            background-color: #444;
        }

        .btn {
            color: #fff;
            cursor: pointer;
            font-size: 17px;
            border-radius: 2px;
            text-decoration: none;
            border: 1px solid inherit;
            height: 40px;
            padding: 10px 35px;
            font-family: sans-serif;
        }

        .back-to-list {
            background-color: #FF9800;
            border: 1px solid #FF9800;
            margin: 0 20px;
        }

        .back-to-dashboard {
            background-color: #2196F3;
            border: 1px solid #2196F3;
            margin: 0 20px;
        }

        .print-button {
            background-color: #673AB7;
            border: 1px solid #673AB7;
            margin: 0 20px;
        }

        .send-to-email {
            background-color: #FF5722;
            border: 1px solid #FF5722;
            margin: 0 20px;
        }

        .send-to-whatsapp {
            background-color: #22ff2d;
            border: 1px solid #22ff2d;
            margin: 0 20px;
        }

        .action-button {
            position: fixed;
            left: 0;
            bottom: 0;
            background: #081624;
            width: 100%;
            text-align: center;
            padding: 11px 0;
            z-index: 123;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('pos/css/toastr.css') }}">
</head>

<body>


<div class="table-responsive">
    <div id="invoice" class="row">
        @if(Auth::check())
            <div class="action-button">
                <a href="{{ route('dashboard') }}" class="btn back-to-dashboard">
                    Back to Dashboard
                </a>
                <a href="{{ url()->previous() }}" class="btn back-to-list">
                    Back to list
                </a>
                <button type="button" onclick="printDiv('invoiceArea')" class="btn print-button">
                    Print
                </button>
                @if($invoice->customer_id != 0)
                    <a href="{{ route('pos.send_invoice_to_email', $invoice->id) }}" class="btn send-to-email">
                        Send to email
                    </a>
                @endif
            </div>
        @endif
        <section
                style="width: 302px; margin: 10px auto;background-color: #fff; padding:5px;margin-bottom: 70px;height: auto;"
                id="invoiceArea">
            <header style="text-align: center; padding-bottom: 0px">
                <h2 style="font-size: 24px; font-weight: 700; margin: 0; padding: 0;">{{setting('name')}}</h2>
                <div style="margin-bottom: 5px; line-height: 1;">
                    <span style="font-size: 12px;">{{setting('address')}}</span>
                    <div style="display: block;">
                        <span style="font-size: 12px;">Mobile: {{setting('phone')}}</span>, <span
                                style="font-size: 12px;">Email: {{setting('email')}}</span>
                    </div>
                </div>
            </header>
            --------------------------------------------------------
            <section style="font-size: 12px;  line-height: 1.222;">
                <table style="width: 100%;">
                    <tr style="border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        <td class="w-30" style="font-size:12px"><span style="font-size:12px"><b>Date:</b></span></td>
                        <td style="font-size:12px">{{date('d M, Y', strtotime($invoice->date))}} {{ date('h:i A', strtotime($invoice->created_at)) }}</td>
                    </tr>
                    <tr style="border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        <td class="w-30" style="font-size:12px"><span style="font-size:12px"><b>Invoice ID:</b></span>
                        </td>
                        <td style="font-size:12px">{{$invoice->inv_id}}</td>
                    </tr>
                    @if($invoice->customer_id != 0)
                        <tr style="border-top: 1px solid #000; border-bottom: 1px solid #000;">
                            <td class="w-30" style="font-size:12px"><b>Customer Name:</b></td>
                            <td style="font-size:12px">{{@$invoice->customer->name}}</td>
                        </tr>
                        <tr style="border-top: 1px solid #000; border-bottom: 1px solid #000;">
                            <td class="w-30" style="font-size:12px"><b>Phone:</b></td>
                            <td style="font-size:12px">{{@$invoice->customer->phone}}</td>
                        </tr>
                        <tr style="border-top: 1px solid #000; border-bottom: 1px solid #000;">
                            <td class="w-30" style="font-size:12px"><b>Address:</b></td>
                            <td style="font-size:12px">{{ @$invoice->customer->address}}</td>
                        </tr>
                    @else
                        <tr style="border-top: 1px solid #000; border-bottom: 1px solid #000;">
                            <td class="w-30" style="font-size:12px"><b>Customer Name:</b></td>
                            <td style="font-size:12px">Walking Customer</td>
                        </tr>

                    @endif
                </table>
            </section>

            <h4 style="font-size: 18px;
    font-weight: 700;
    text-align: center;
    margin: 5px 0 0px 0;
    padding: 0px 0;">INVOICE</h4>
            --------------------------------------------------------
            @php
$total = 0;
$total_vat_amount = 0;
$paid = \App\Models\InvoicePay::where('invoice_id', $invoice->id)->sum('amount');
$medicine = json_decode($invoice['medicines'], true);
$count = count($medicine);
$igta = 0;
            @endphp
            <section style="line-height: 1.23;">
                <table style="width: 100%">
                    <thead>
                    <tr style="border-top: 1px solid #000; border-bottom: 1px solid #000; font-weight: 700;">
                        <th class="w-10 text-center" style="font-size: 12px; text-align: center">Sl.</th>
                        <th class="w-40" style="font-size: 12px;">Name</th>
                        <th class="w-15 text-center" style="font-size: 12px; text-align: center">Qty</th>
                        <th class="w-15 text-right" style="font-size: 12px; text-align: center">Price</th>
                        <th class="w-20 text-right"
                            style="border-bottom: none; font-size: 12px; text-align: center">Total
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @for ($i = 0; $i < $count; $i++)
                        @php
                        if (isset($medicine[$i]['batch_id'])) {
                            $batch = \App\Models\Batch::find($medicine[$i]['batch_id']);
                            $detail = \App\Models\Medicine::find($medicine[$i]['id']);
                            $amount = ($batch->price * $medicine[$i]['quantity']);
                            $total += $amount;
                            $total_vat_amount += $medicine[$i]['vat'];
                            $igta += $medicine[$i]['igta'];
                                            @endphp
                                            <tr style="border-top: 1px solid #000; border-bottom: 1px solid #000;">
                                                <td class="text-center"
                                                    style="vertical-align: top; font-size: 12px; text-align: center">{{($i + 1)}}</td>
                                                    <td style="vertical-align: top; font-size: 12px">{{ Str::limit($detail->name, 150)  }}
                                                        @if(!empty($detail->strength))
                                                            <small>[{{ Str::limit($detail->strength, 50) }}]</small>
                                                        @endif
                                                        @if(!empty($detail->type['name']))
                                                            <small>[{{ Str::limit($detail->type['name'], 50) }}]</small>
                                                        @endif
                                                    </td>
                                                <td class="text-center"
                                                    style="vertical-align: top; font-size: 12px; text-align: center">{{$medicine[$i]['quantity']}} </td>
                                                <td class="text-right"
                                                    style="vertical-align: top; font-size: 12px; text-align: center">{{priceFormat($batch->price)}}</td>
                                                <td class="text-right"
                                                    style="border-bottom: none;vertical-align: top;font-size: 12px;text-align: center ">{{priceFormat($amount)}}</td>
                                            </tr>
                                            @php
                        }
                        @endphp
                    @endfor
                    </tbody>
                </table>
            </section>
            @php
$subTotalAmount = $total - $invoice->discount;
$taxAmount = $subTotalAmount * $invoice->tax / 100;
$grand_total = ($total) - $invoice->discount + $taxAmount;
            @endphp
            <section style="line-height: 1.23; font-size: 12px; border-top: 2px solid #000;">
                <table style="width: 100%">
                    <tr style=" border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        <td style="text-align: right; font-size: 12px; width: 70%">Sub Total:</td>
                        <td style="text-align: right; font-size: 12px; width: 70%">{{priceFormat($total)}}</td>
                    </tr>
                    <tr style=" border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        <td style="text-align: right; font-size: 12px; width: 70%">Discount:</td>
                        <td style="text-align: right; font-size: 12px; width: 70%">{{priceFormat($invoice->discount)}}</td>
                    </tr>
                    {{-- <tr style=" border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        <td style="text-align: right; font-size: 12px; width: 70%">Vat:</td>
                        <td style="text-align: right; font-size: 12px; width: 70%">{{priceFormat($total_vat_amount)}}</td>
                    </tr> --}}
                    <tr style=" border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        <td style="text-align: right; font-size: 12px; width: 70%">GST/ Tax Amount:</td>
                        <td style="text-align: right; font-size: 12px; width: 70%">{{priceFormat($taxAmount)}}</td>
                    </tr>
                    {{-- <tr style=" border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        <td style="text-align: right; font-size: 12px; width: 70%">IGTA:</td>
                        <td style="text-align: right; font-size: 12px; width: 70%">{{priceFormat($igta)}}</td>
                    </tr> --}}
                    <tr style=" border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        <td style="text-align: right; font-size: 12px; width: 70%">Due:</td>
                        <td style="text-align: right; font-size: 12px; width: 70%">{{priceFormat($invoice->due_price)}}</td>
                    </tr>

                    <tr style=" border-top: 1px solid #000; border-bottom: 1px solid #000;">
                        <td style="text-align: right; font-size: 12px; width: 70%">Grand Total:</td>
                        <td style="text-align: right; font-size: 12px; width: 70%">{{priceFormat($grand_total)}}</td>
                    </tr>
                </table>
            </section>
            @php
$f = new NumberFormatter(locale_get_default(), \NumberFormatter::SPELLOUT);

$word = $f->format(round($grand_total, 2));
            @endphp
            --------------------------------------------------------
            <section style="line-height: 1.222; font-size: 12px; font-style: italic; padding: 0px 0">
                <span style="line-height: 1.222; font-size: 12px; font-style: italic;"><b>In Text:</b> {{strtoupper($word)}} ONLY</span><br>
            </section>
            --------------------------------------------------------

            <section style="line-height: 1.222;">
                <div style=" position: relative;">
                    <h2 style="font-size: 12px;  font-weight: 700;  margin: 0px 0 0px 0;">Payments</h2>
                </div>
                <table style="width: 100%">
                    <tr>
                        <td style="font-size: 12px;">-{{$invoice->method->name ?? "Cash Payment"}}</td>
                        <td style="font-size: 12px;text-align: right;">{{priceFormat($grand_total)}}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px;">-RECEIVED PAYMENT</td>
                        <td style="font-size: 12px;text-align: right;">{{priceFormat($invoice->paid_amount)}}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 12px;">-RETURNED AMOUNT</td>
                        <td style="font-size: 12px;text-align: right;">{{priceFormat($invoice->returned_amount)}}</td>
                    </tr>
                </table>
            </section>
            --------------------------------------------------------

            <section style="font-size: 12px; line-height: 1.222; text-align: center; padding-top: 0px">
                <span style="display: block; font-weight: 700;">Thank you for choosing us!</span>
                {{-- <span style="display: block;">Software Developed By Ayaantech Limited. www.ayaantec.com</span> --}}
            </section>

        </section>
    </div>
</div>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        // location.reload();
    }
</script>
<script src="{{asset('pos/js/vendor.min.js') }}"></script>
<script src="{{asset('pos/js/theme.min.js') }}"></script>
<script src="{{asset('pos/js/sweet_alert.js') }}"></script>
<script src="{{asset('pos/js/toastr.js') }}"></script>
{!! Toastr::message() !!}
</body>
</html>