<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="http://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/base.css')}}" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/css-loan.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.3.0/d3.min.js"></script>
    <title>Bukuku Personal</title>
</head>
<body>
{{--
<ion-header class="header-md">
    <ion-toolbar>

        <div style="text-align: right;">
            <img src="{{asset('img/arrow-right.svg')}}" style="float: left; width: 60%; transform: rotate(180deg);">
        </div>
        <ion-title>
            Laporan
        </ion-title>

    </ion-toolbar>
    <ion-selection>
        <select id="select-category">
            <option>Pengeluaran</option>
        </select>
    </ion-selection>
</ion-header>
--}}

<img src="{{ asset('img/logo/bukuku_personal.svg') }}" alt="" class="logo-personal">

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
        {{--
        <mat-tab-header>
            <div class="mat-tab-label-container">
                <tab-list class="mat-tab-list">
                    <div class="mat-tab-labels">
                        @foreach($monthList as $month)
                            <div role="tab" class="mat-tab-label">
                            <div class="mat-tab-label-content font-blue">
                                {{$month}}
                            </div>
                        </div>
                        @endforeach
                        <div class="mat-ink-bar">

                        </div>

                    </div>
                </tab-list>
            </div>
        </mat-tab-header>
        --}}

        <mat-tab-body>
            {{--            <ion-grid class="grid-date-picker">--}}
            {{--                <ion-row class="row-date">--}}
            {{--                    --}}
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
            {{--                        <div style="text-align: right;">--}}
            {{--                            <img class="date-button" src="{{asset('img/ic_search_report.svg')}}">--}}
            {{--                        </div>--}}
            {{--                    </ion-col>--}}
            {{--                </ion-row>--}}
            {{--            </ion-grid>--}}
            {{--            <ion-grid class="grid-chart">--}}
            {{--                <svg id="chart" style="width:100%; height: 300px;">--}}
            {{--                    <g id="labels"/>--}}
            {{--                </svg>--}}
            {{--            </ion-grid>--}}
            @if($is_group_by_month)
                @foreach($dataContent as $monthYear => $items)
                    <div class="header-subtitle font-size-11">
                        <span class="font-size-11 font-weight-bold">{{ $monthYear }}</span>
                    </div>
                    @foreach($items as $key => $content)
                        <ion-list>
                            <ion-item>
                                <ion-grid>
                                    <ion-row class="list-date">
                                        <ion-col>
                                            <div>
                                                <p class="get-two-number-date">{{$key}}</p>
                                            </div>
                                        </ion-col>
                                        <ion-col>
                                            <div class="get-month-with-year"> {{$key}}</div>
                                            <div class="get-local-day"> {{$key}}</div>
                                        </ion-col>
                                        <ion-col>
                                        </ion-col>
                                    </ion-row>
                                    @foreach($content as $item)
                                        <ion-row class="list-item">
                                            <ion-col class="list-item-icon">
                                                <img
                                                    src="{{ $item->loan->icon_id ? $item->loan->icon_url : asset('img/ic_wallet.svg')}}"
                                                    class="col-icon">
                                            </ion-col>
                                            <ion-col class="list-item-note">
                                                <div> {{$item->loan->name}}</div>
                                                <div> {{$item->cashbank->name}}</div>
                                            </ion-col>
                                            <ion-col class="list-item-amount {{ $item->status_credit == 1 ? 'font-color-blue' : 'font-color-red' }}">
                                                <div class="{{ $item->status_credit == 1 ? 'font-rp-income' : 'font-rp-spending' }} number">
                                                    {{$item->amount}}
                                                </div>
                                            </ion-col>
                                        </ion-row>
                                    @endforeach
                                </ion-grid>
                            </ion-item>
                        </ion-list>
                        <devider></devider>
                    @endforeach
                @endforeach
            @else
                <div class="header-title font-size-12">
                    <span class="font-size-11 font-weight-bold">{{ $start }} - {{ $until }}</span>
                </div>
                @foreach($dataContent as $key => $content)
                    <ion-list>
                        <ion-item>
                            <ion-grid>

                                <ion-row class="list-date">
                                    <ion-col>
                                        <div>
                                            <p class="get-two-number-date">{{$key}}</p>
                                        </div>
                                    </ion-col>
                                    <ion-col>
                                        <div class="get-month-with-year"> {{$key}}</div>
                                        <div class="get-local-day"> {{$key}}</div>
                                    </ion-col>
                                    <ion-col>
                                    </ion-col>
                                </ion-row>
                                @foreach($content as $item)
                                    <ion-row class="list-item">
                                        <ion-col>
                                            <img
                                                src="{{ $item->loan->icon_id ? $item->loan->icon_url : asset('img/ic_wallet.svg')}}"
                                                class="col-icon">
                                        </ion-col>
                                        <ion-col class="list-item-note">
                                            <div> {{$item->loan->name}}</div>
                                            <div> {{$item->cashbank->name}}</div>
                                            <div></div>
                                        </ion-col>
                                        <ion-col class="list-item-amount {{ $item->status_credit == 1 ? 'font-color-blue' : 'font-color-red' }}">
                                            <div class="{{ $item->status_credit == 1 ? 'font-rp-income' : 'font-rp-spending' }} number">
                                                {{$item->amount}}
                                            </div>
                                        </ion-col>
                                    </ion-row>
                                @endforeach
                            </ion-grid>
                        </ion-item>
                    </ion-list>
                    <devider></devider>
                @endforeach
            @endif
        </mat-tab-body>


    </mat-tab-group>
</ion-content>
</body>
</html>

<script src="{{asset('js/export-pdf.js')}}"></script>
<script>
    let language = @json($language);

    let x = document.querySelectorAll(".number");

    let d = document.querySelectorAll(".get-two-number-date");
    let y = document.querySelectorAll(".get-month-with-year");
    let dy = document.querySelectorAll(".get-local-day");
    let nx = document.querySelectorAll(".get-month-long-name");

    convertNumber(x, 'id-ID');
    convertDateToLongMonth(nx, language)
    //convertDateIncomeOrSpending(d, dy, y, language)
    convertDateToTwoDigit(d)
    convertDateToDay(dy, language)
    convertDateToMonthAndYear(y, language)
</script>
