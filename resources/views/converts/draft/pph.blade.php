<!DOCTYPE html>

<!--
blue = #0020c9 , rgb(0, 32, 201)
orange : orange, rgb(252, 164, 58)
grey : #5D6975, rgb(151, 152, 155)
-->

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
</head>
<body style="position: relative;width: 21cm;height: 29.7cm;margin: 0 auto;color: #5D6975;background: #FFFFFF;font-family: Arial;font-size: 12px;">
<header class="clearfix" style="padding: 10px 0;margin-bottom: 30px;">

    <h1 style="margin-top:100px;font-family: sans-serif;color: #0020c9;font-size: 2em;line-height: 1.4em;font-weight: normal;text-align: center;margin: 0 0 30px 0;padding: 10px;border-bottom: solid 1px #C1CED9;">{{$title}}</h1>
    <!--
    <div id="company" class="clearfix">
      <div>Company Name</div>
      <div>455 Foggy Heights,<br /> AZ 85004, US</div>
      <div>(602) 519-0450</div>
      <div><a href="mailto:company@example.com">company@example.com</a></div>
    </div>
    -->
    <div id="project" style="float: left;">
        <div style="white-space: nowrap;"><span style="color: #0020c9;font-family: sans-serif;margin-bottom: 5px;font-weight: bolder;text-align: left;width: 150px;margin-right: 10px;display: inline-block;font-size: 0.8em;">NPWP</span> Yes </div>
        <div style="white-space: nowrap;"><span style="color: #0020c9;font-family: sans-serif;margin-bottom: 5px;font-weight: bolder;text-align: left;width: 150px;margin-right: 10px;display: inline-block;font-size: 0.8em;">STATUS</span> Kawin </div>
        <div style="white-space: nowrap;"><span style="color: #0020c9;font-family: sans-serif;margin-bottom: 5px;font-weight: bolder;text-align: left;width: 150px;margin-right: 10px;display: inline-block;font-size: 0.8em;">JUMLAH TANGGUNGAN</span> Kawin </div>
    </div>
</header>
<main style="margin-top: 80px;">
    <table style="width: 100%;border-collapse: collapse;border-spacing: 0;margin-bottom: 20px;">
        <thead>

        <tr>
            <th class="date" style="text-align: left;padding: 5px 20px;color: #0020c9;border-bottom: 2px solid #0020c9;white-space: nowrap;font-weight: bolder;">DATE</th>
            <th class="pemasukan" style="text-align: left;padding: 5px 20px;color: #0020c9;border-bottom: 2px solid #0020c9;white-space: nowrap;font-weight: bolder;">PEMASUKAN</th>
            <th style="text-align: center;padding: 5px 20px;color: #0020c9;border-bottom: 2px solid #0020c9;white-space: nowrap;font-weight: bolder;">TOTAL</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $month = '';
        ?>

        @foreach( $responseData['journals'][$year] as $journal)
        <tr>
            @if($journal['month'] == $month)
                <td class="date" style="text-align: left;padding: 20px;vertical-align: top;"></td>
                <td class="pemasukan" style="text-align: left;padding: 20px;vertical-align: top;">{{$journal['name']}}</td>
                <td class="total" style="text-align: right;padding: 20px;color: orange;">RP {{$journal['total']}}</td>
            @else
                @php
                $month = $journal['month'];
                @endphp
                <td class="date" style="border-bottom: 2px solid orange;border-top: 1px solid #0020c9;color:#0020c9;text-align: left;padding: 20px;vertical-align: top;">{{$monthName[$journal['month']]}}</td>
                <td class="pemasukan" style="border-top: 1px solid #0020c9;text-align: left;padding: 20px;vertical-align: top;">{{$journal['name']}}</td>
                <td class="total" style="border-top: 1px solid #0020c9;text-align: right;padding: 20px;color: orange;">RP {{$journal['total']}}</td>
            @endif

        </tr>
        @endforeach

        <tr style="background-color: orange; !important;-webkit-print-color-adjust: exact;color-adjust: exact;">
            <td class="bg-orange" colspan="2" style="text-align: right;padding: 20px;color: #ffff;">Total Penghasilan</td>
            <td class="bg-orange" style="text-align: right;padding: 20px;background: orange;color: #ffff;">$5,200.00</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;padding: 20px;">Tunjangan lain</td>
            <td class="total" style="text-align: right;padding: 20px;color: orange;">$1,300.00</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;padding: 20px;">Tunjangan premi asuransi</td>
            <td class="total" style="text-align: right;padding: 20px;color: orange;">$1,300.00</td>
        </tr>
        <tr>
            <td class="text-orange border-bottom-orange-1"  style="text-align: right;padding: 20px;color: orange;"></td>
            <td class="text-orange border-bottom-orange-1"  style="text-align: left;padding: 20px;border-bottom: solid 2px orange;border-top: solid 1px #0020c9;color: orange;"> Pengurangan</td>
            <td class="text-orange border-bottom-orange-1"  style="text-align: right;padding: 20px;border-top: solid 1px #0020c9;color: orange;"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;padding: 20px;">Biaya Jabatan</td>
            <td class="total" style="text-align: right;padding: 20px;color: orange;">$1,300.00</td>
        </tr>

        <tr>
            <td colspan="2" style="text-align: right;padding: 20px;">PTKP</td>
            <td class="total" style="text-align: right;padding: 20px;color: orange;">$1,300.00</td>
        </tr>

        <tr>
            <td colspan="2" style="text-align: right;padding: 20px;">Iuran Premi JHT</td>
            <td class="total" style="text-align: right;padding: 20px;color: orange;">$1,300.00</td>
        </tr>

        <tr>
            <td colspan="2" style="text-align: right;padding: 20px;">Total Pengeluaran</td>
            <td class="total" style="text-align: right;padding: 20px;color: orange;">$1,300.00</td>
        </tr>

        <tr>
            <td colspan="2" class="grand grand-total" style="text-align: right;padding: 20px;border-top: 2px solid #0020c9;color: #0020c9;">PPh 21 Orang Pribadi</td>
            <td class="grand total" style="text-align: right;padding: 20px;color: orange;font-size: 1.2em;border-top: 2px solid #0020c9;">$6,500.00</td>
        </tr>
        </tbody>
    </table>
    <!--
    <div id="notices">
      <div>NOTICE:</div>
      <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    </div>
    -->
</main>
<footer style="color: #5D6975;width: 100%;height: 30px;position: absolute;bottom: 0;border-top: 1px solid #C1CED9;padding: 8px 0;text-align: center;">
    Perhitungan PPh 21 orang pribadi Tahun 2020
</footer>
</body>
</html>
