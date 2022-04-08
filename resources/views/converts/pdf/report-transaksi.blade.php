<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="http://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/base.css')}}" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/css-transaksi.css')}}" rel="stylesheet">
    <title>Bukuku Personal</title>
    <style>
        ion-row, ion-col {
            padding: 0px;
            height: auto;
        }
    </style>
</head>
<body class="report-transaksi">
<img src="{{ asset('img/logo/bukuku_personal.svg') }}" alt="" class="logo-personal">
{{--<ion-header class="header-md">--}}
{{--    <ion-toolbar>--}}
{{--        <div _style="text-align: right;">--}}
{{--            <img src="{{asset('img/ic_search_report.svg')}}"--}}
{{--                 style="float: left; width: 60%; transform: rotate(180deg);">--}}
{{--        </div>--}}
{{--        <ion-title>--}}
{{--            {{$title}}--}}
{{--        </ion-title>--}}
{{--    </ion-toolbar>--}}
{{--</ion-header>--}}

<div class="header-title font-size-12">
    <span class="font-size-12 font-weight-bold">{{ $title }}</span>
</div>

{{--@if($is_search)--}}
{{--    <div class="header-title font-size-12">--}}
{{--        <span class="font-size-11 font-weight-bold get-month-long-name">{{ $start }}</span>--}}
{{--    </div>--}}
{{--@else--}}
{{--    <div class="header-title font-size-12">--}}
{{--        <span class="font-size-11 font-weight-bold">{{ $start }} - {{ $until }}</span>--}}
{{--    </div>--}}
{{--@endif--}}

<ion-content>
    <mat-tab-group>
        {{--        <mat-tab-header>--}}
        {{--            <div class="mat-tab-label-container">--}}
        {{--                <tab-list class="mat-tab-list">--}}
        {{--                    <div class="mat-tab-labels">--}}
        {{--                        @foreach($monthList as $month)--}}
        {{--                        <div role="tab" class="mat-tab-label">--}}
        {{--                            <div class="mat-tab-label-content">--}}
        {{--                                {{$month}}--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        @endforeach--}}
        {{--                        <div class="mat-ink-bar">--}}

        {{--                        </div>--}}

        {{--                    </div>--}}
        {{--                </tab-list>--}}
        {{--            </div>--}}
        {{--        </mat-tab-header>--}}

        {{--        <mat-tab-body>--}}
        {{--            <ion-grid class="grid-date-picker">--}}
        {{--                <ion-row class="row-date">--}}
        {{--                    <ion-col class="col-datestart">--}}
        {{--                        <ion-datetime>--}}
        {{--                            <input type="text" class="aux-input" name="ion-dt-0" value="{{$start}}">--}}
        {{--                        </ion-datetime>--}}
        {{--                    </ion-col>--}}
        {{--                    <ion-col class="strip">--}}
        {{--                        <div class="datetime-strip"> -</div>--}}
        {{--                    </ion-col>--}}
        {{--                    <ion-col class="col-dateuntil">--}}
        {{--                        <ion-datetime>--}}
        {{--                            <input type="text" class="aux-input" name="ion-dt-0" value="{{$until}}">--}}
        {{--                        </ion-datetime>--}}
        {{--                    </ion-col>--}}
        {{--                    <ion-col class="col-button-grid-date">--}}
        {{--                        <div _ngcontent-mof-c209="" style="text-align: right;">--}}
        {{--                            <img _ngcontent-mof-c209="" src="{{asset('img/ic_search_report.svg')}}"--}}
        {{--                                 style="float: left; width: 60%; rotation: 180deg">--}}
        {{--                        </div>--}}
        {{--                    </ion-col>--}}
        {{--                </ion-row>--}}
        {{--            </ion-grid>--}}

        <ion-list>
            <ion-item>
                <ion-grid>
                    @if($is_group_by_month)
                        @foreach($dataContent as $monthYear => $dates)
                            <div class="header-subtitle font-size-11">
                                <span class="font-size-11 font-weight-bold">{{ $monthYear }}</span>
                            </div>
                            @foreach($dates as $items)
                                @foreach($items as $item)
                                    <ion-row>
                                        <ion-col class="list-item-date">
                                            <div
                                                class="font-color-gray font-size-11">{{ optional($item)['date'] }}</div>
                                        </ion-col>
                                        <ion-col class="list-item-note">
                                            <div class="font-size-11">{{ optional($item)['note'] }}</div>
                                        </ion-col>
                                        <ion-col class="list-item-amount {{optional($item)['status_credit'] == 1 ? 'font-color-green' : 'font-color-red'}}">
                                            <div class="number {{ optional($item)['status_credit'] == 1 ? 'font-rp-green' : 'font-rp-spending'}}">
                                                {{ optional($item)['amount'] }}
                                            </div>
                                        </ion-col>
                                    </ion-row>
                                @endforeach
                            @endforeach
                        @endforeach
                    @else
                        <div class="header-title font-size-12">
                            <span class="font-size-11 font-weight-bold">{{ $start }} - {{ $until }}</span>
                        </div>
                        @foreach($dataContent as $item)
                            <ion-row>
                                <ion-col><span class="font-color-gray font-size-11">{{ optional($item)['date'] }}</span>
                                </ion-col>
                                <ion-col class="list-item-note">
                                    <div class="font-size-11">{{ optional($item)['note'] }}</div>
                                </ion-col>
                                <ion-col class="list-item-amount {{optional($item)['status_credit'] == 1 ? 'font-color-green' : 'font-color-red'}}">
                                    <div class="number {{ optional($item)['status_credit'] == 1 ? 'font-rp-green' : 'font-rp-spending'}}">
                                        {{ optional($item)['amount'] }}
                                    </div>
                                </ion-col>
                            </ion-row>
                        @endforeach
                    @endif
                </ion-grid>
            </ion-item>
        </ion-list>
        <devider></devider>

        {{--</mat-tab-body>--}}


    </mat-tab-group>
</ion-content>
</body>

<script src="{{asset('js/export-pdf.js')}}"></script>
<script>
    let language = @json($language);
    let x = document.querySelectorAll(".number");
    let nx = document.querySelectorAll(".get-month-long-name");

    convertDateToLongMonth(nx, language)
    convertNumber(x, 'id-ID')
</script>


</html>
