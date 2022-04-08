<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="http://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/base.css')}}" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/css-umkm.css')}}" rel="stylesheet">
    <script src="{{asset('js/export-pdf.js')}}"></script>
    <title>Bukuku Personal</title>
</head>
<body>
{{--
<ion-header class="header-md">
    <ion-toolbar >

        <div _ngcontent-mof-c209="" style="text-align: right;">
            <img _ngcontent-mof-c209="" src="{{asset('img/ic_search_report.svg')}}" style="float: left; width: 60%; transform: rotate(180deg);">
        </div>
        <ion-title>
            Laporan PPh UMKM
        </ion-title>
    </ion-toolbar>
</ion-header>
--}}

<img src="{{ asset('img/logo/bukuku_personal.svg') }}" alt="" class="logo-personal">

<div class="header-title font-size-12">
    <span class="font-size-12 font-weight-bold">{{ $title }}</span>
</div>

<div class="header-title font-size-12">
    <span class="font-size-11 font-weight-bold">{{ $year }}</span>
</div>

<ion-content>
    <mat-tab-group>
        {{--        <mat-tab-header>--}}
        {{--            <div class="mat-tab-label-container">--}}
        {{--                <tab-list class="mat-tab-list">--}}
        {{--                    <div class="mat-tab-labels">--}}
        {{--                        @foreach($yearList as $list)--}}
        {{--                            <div role="tab" class="mat-tab-label">--}}
        {{--                                <div class="mat-tab-label-content">--}}
        {{--                                    {{$list->year}}--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        @endforeach--}}
        {{--                        <div class="mat-ink-bar">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </tab-list>--}}
        {{--            </div>--}}
        {{--        </mat-tab-header>--}}

        <mat-tab-body>

            <ion-list>
                <ion-item>
                    <ion-grid>
                        <ion-row>
                            <ion-col>
                                <div class="font-size-12 "> Bulan </div>
                            </ion-col>
                            <ion-col class="list-item-amount">
                                <div class="font-size-12 "> Penghasilan Bruto </div>
                            </ion-col>
                            <ion-col class="list-item-amount">
                                <div class="font-size-12 "> PP 23 - 0.5% </div>
                            </ion-col>
                        </ion-row>
                        @foreach($dataContent as $item)
                            <ion-row>
                                <ion-col class="font-size-11">
                                    {{ month_number_to_name($item->month) }}
                                </ion-col>
                                <ion-col class="list-item-amount font-size-12 font-color-black">
                                    <div class="number font-rp-normal ">
                                        {{ optional($item)['subtotal'] }}
                                    </div>
                                </ion-col>
                                <ion-col class="list-item-amount font-size-12 font-color-black">
                                    <div class="number font-rp-normal ">
                                        {{$item->tax}}
                                    </div>
                                </ion-col>
                            </ion-row>
                        @endforeach
                    </ion-grid>
                </ion-item>
            </ion-list>
            <devider></devider>

            <ion-total class="noBreak">
                <ion-total-title>
                    Jumlah Setahun
                </ion-total-title>
                <ion-total-content>
                    <ion-total-item>
                        <div> Penghasilan Bruto</div>
                        <div class="number font-rp font-blue font-dash"> {{$sumSubtotal}}</div>
                    </ion-total-item>
                    <ion-total-item>
                        <div> PPh 23 -0.5%</div>
                        <div class="number font-rp font-blue font-dash"> {{$sumTax}}</div>
                    </ion-total-item>
                </ion-total-content>

            </ion-total>

        </mat-tab-body>


    </mat-tab-group>
</ion-content>
</body>
</html>


<script>

    let language = @json($language);
    let x = document.querySelectorAll(".number");
    let nm = document.querySelectorAll(".number-to-long-month");

    convertNumber(x, 'id-ID');
    convertNumberToLongMonth(nm, language);


</script>
