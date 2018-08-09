<?php use App\MyClass\Format;?>
        <!doctype html>
<html>
<head>
    <style>
        table {
            font-family: Calibri;
            font-size: 10pt;
        }

        td {
            font-family: Calibri;
            font-size: 10pt;
        }

        @page {
            header: page-header;
            footer: page-footer;

            margin-top: 8cm;
            margin-bottom: 4cm;

            margin-header: .5cm;
            margin-footer: .5cm;
            margin-left: .75cm;
            margin-right: .75cm;
        }

        @page {
            sheet-size: Letter-L;
        }
    </style>

</head>
<body>

<htmlpageheader name="page-header">
    <table style="width: 100%">
        <tr>
            <td width="110px"><img src="{{ asset('logos/' . $soa_header->company_code . '.png') }}" height="110px"></td>
            <td style="padding-left: 10px">
                {{ $soa_header->company_name }} <br>
                {{ $soa_header->company_address }} <br>
                {{ $soa_header->company_telephone }} <br>
                {{ $soa_header->company_tin }} <br>
            </td>
            <td width="160px">
                Date : {{ $soa_header->created_date }} <br>
                Time : {{ $soa_header->created_time }} <br>
                User : {{ $soa_header->username }} <br>
                {{ $soa_header->soa_number }} <br>
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td style="padding-bottom: 8px; padding-top: -8px"><b>As Of {{ $soa_header->cutoff_date }}</b></td>
        </tr>
        <tr>
            <td colspan="3" style="border: 1px solid black; text-align: center; padding: 1px; font-size: 13pt">S T A T E
                M E N T &nbsp; O F &nbsp; A C C O U N T
            </td>
        </tr>
    </table>

    <table style="margin-top: 2mm">
        <tr>
            <td style="width: 7cm">Customer Name</td>
            <td>{{ $soa_header->customer_name }}</td>
        </tr>
        <tr>
            <td>Customer Address</td>
            <td>{{ $soa_header->customer_address }}</td>
        </tr>
        <tr>
            <td>Tax Identification Number</td>
            <td>{{ $soa_header->customer_tin }}</td>
        </tr>
        <tr>
            <td>Credit Limit</td>
            <td>{{ number_format($soa_header->customer_credit, 2, '.', ',') }}</td>
        </tr>
        <tr>
            <td>Credit Terms</td>
            <td>{{ $soa_header->pay_term_description }}</td>
        </tr>
    </table>

</htmlpageheader>

<htmlpagefooter name="page-footer">
    <table style="width: 100%; font-size: 10pt">
        <tr>
            <td style="width: 50%; text-align: left;"></td>
            <td style="width: 50%; padding-left: 2cm">
                @if($hasPtu)
                    PTU NO.: 1712_0123_PTU_CAS_000250 ; DATE OF ISSUE - <br>
                    12/28/2017 <br>
                    RANGE OF SERIAL NUMBER FROM FL10 000000001 - 999999999 <br>
                    THIS IS A SYSTEM GENERATED STATEMENT OF ACCOUNT  <br>
                    "THIS DOCUMENT IS NOT VALID FOR CLAIM OF INPUT TAXES"
                @endif
            </td>
        </tr>

        <tr>
            <td style="font-size: 8pt;text-align: center;" colspan="2">Page {PAGENO} of {nbpg}</td>
        </tr>
    </table>
</htmlpagefooter>

{{-- BODY --}}
<table border="1" cellspacing="0" cellpadding="2" style="width: 100%; border-collapse: collapse;">
    <thead>
    <tr>
        <td style="border-style: none" colspan="2"></td>
        <td style="text-align: center" colspan="7"><b>PAST DUE</b></td>
    </tr>
    <tr>
        <td style="width: 11%; text-align: center"><b>Invoice <br> Number</b></td>
        <td style="width: 11%; text-align: center"><b>Date</b></td>
        <td style="width: 11%; text-align: center"><b>Amount</b></td>z
        <td style="width: 11%; text-align: center"><b>Current</b></td>
        <td style="width: 11%; text-align: center"><b>01-30</b></td>
        <td style="width: 11%; text-align: center"><b>31-60</b></td>
        <td style="width: 11%; text-align: center"><b>61-90</b></td>
        <td style="width: 11%; text-align: center"><b>91-120</b></td>
        <td style="width: 11%; text-align: center"><b>Over 120</b></td>
    </tr>
    </thead>

    <tbody>

    <?php
    $total_amount = 0.0;
    $total_current = 0.0;
    $total_z30 = 0.0;
    $total_z60 = 0.0;
    $total_z90 = 0.0;
    $total_z120 = 0.0;
    $total_zov120 = 0.0;
    ?>

    @foreach($soa_details as $soa_detail)

        <?php
        $total_amount += $soa_detail->amount;
        $total_current += $soa_detail->current;
        $total_z30 += $soa_detail->z30;
        $total_z60 += $soa_detail->z60;
        $total_z90 += $soa_detail->z90;
        $total_z120 += $soa_detail->z120;
        $total_zov120 += $soa_detail->zov120;
        ?>

        <tr>
            <td style="text-align: center; ">{{ $soa_detail->invoice_no }}</td>
            <td style="text-align: center; ">{{ date("m-d-Y", strtotime($soa_detail->posting_date)) }}</td>
            <td style="text-align: right; ">{{ Format::toMonetary($soa_detail->amount) }}</td>
            <td style="text-align: right; ">{{ Format::toMonetary($soa_detail->current) }}</td>
            <td style="text-align: right; ">{{ Format::toMonetary($soa_detail->z30) }}</td>
            <td style="text-align: right; ">{{ Format::toMonetary($soa_detail->z60) }}</td>
            <td style="text-align: right; ">{{ Format::toMonetary($soa_detail->z90) }}</td>
            <td style="text-align: right; ">{{ Format::toMonetary($soa_detail->z120) }}</td>
            <td style="text-align: right; ">{{ Format::toMonetary($soa_detail->zov120) }}</td>
        </tr>
    @endforeach

    {{-- Totals --}}
    <tr>
        <td colspan="2"><b>TOTALS - Net of PDC/CWT</b></td>
        <td style="text-align: right">{{ Format::toMonetary($total_amount) }}</td>
        <td style="text-align: right">{{ Format::toMonetary($total_current) }}</td>
        <td style="text-align: right">{{ Format::toMonetary($total_z30) }}</td>
        <td style="text-align: right">{{ Format::toMonetary($total_z60) }}</td>
        <td style="text-align: right">{{ Format::toMonetary($total_z90) }}</td>
        <td style="text-align: right">{{ Format::toMonetary($total_z120) }}</td>
        <td style="text-align: right">{{ Format::toMonetary($total_zov120) }}</td>
    </tr>

    {{-- Percentage --}}
    <tr>
        <td style="border-style: none" colspan="3"></td>
        <td style="text-align: right">{{ getPercentage($total_current, $total_amount) }}%</td>
        <td style="text-align: right">{{ getPercentage($total_z30, $total_amount) }}%</td>
        <td style="text-align: right">{{ getPercentage($total_z60, $total_amount) }}%</td>
        <td style="text-align: right">{{ getPercentage($total_z90, $total_amount) }}%</td>
        <td style="text-align: right">{{ getPercentage($total_z120, $total_amount) }}%</td>
        <td style="text-align: right">{{ getPercentage($total_zov120, $total_amount) }}%</td>
    </tr>

    </tbody>
</table>

<br>

{{-- total computations --}}
<table style="width: 100%">
    <tr>
        <td style="width: 11%;"><b>PDC on hand </b></td>
        <td style="width: 11%;" colspan="8">{{ Format::toMonetary($soa_header->pdc_on_hand) }} </td>
    </tr>
    <tr>
        <td style="width: 11%;"><b>CWT on hand</b></td>
        <td style="width: 11%;" colspan="8">{{ Format::toMonetary($soa_header->cwt_on_hand) }} </td>
    </tr>
    <tr>
        <td style="width: 11%;"><b>Bounce Check</b></td>
        <td style="width: 11%;" colspan="8">{{ Format::toMonetary($soa_header->bounce_check) }} </td>
    </tr>
    <tr>
        <td style="width: 11%;"><b>PDC Nontrade</b></td>
        <td style="width: 11%;" colspan="8">{{ Format::toMonetary($soa_header->pdc_non_trade) }}</td>
    </tr>

</table>

@if($soa_header->server = 'PFMC')
    <br>
    <span style="font-style: italic; font-size: 10pt">The Seller shall impose upon the Buyer an interest of 1% per month or 12% per annum, should the latter fail to pay in accordance to the agreed payment terms from receipt of the goods.</span>
@endif


</body>
</html>


<?php

function getPercentage($value, $total)
{
    if ($total > 0) {
        $result = ($value / $total) * 100;
        $result = Format::toMonetary($result);
    } else {
        $result = 0;
    }

    return $result;
}
?>
