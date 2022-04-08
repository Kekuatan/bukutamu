<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="http://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/base.css')}}" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/css-tax-rate.css')}}" rel="stylesheet">
    <title>Bukuku Personal</title>
</head>
<body>

<img src="{{ asset('img/logo/bukuku_personal.svg') }}" alt="" class="logo-personal">
<div class="header-title font-size-12" style="background: blue">
    <span class="font-size-12 font-weight-bold">{{ $title }}</span>
</div>
{{--<ion-header class="header-md">--}}
{{--    <ion-toolbar >--}}

{{--        <div  style="text-align: right;">--}}
{{--            <img src="{{asset('img/ic_search_report.svg')}}" style="float: left; width: 60%; transform: rotate(180deg);">--}}
{{--        </div>--}}
{{--        <ion-title>--}}
{{--            Tax Rates--}}
{{--        </ion-title>--}}
{{--    </ion-toolbar>--}}
{{--</ion-header>--}}

<ion-content>
    <mat-tab-group>

        <mat-tab-body>

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
            {{--                        <div style="text-align: right;">--}}
            {{--                            <img class="date-button" src="{{asset('img/ic_search_report.svg')}}">--}}
            {{--                        </div>--}}
            {{--                    </ion-col>--}}
            {{--                </ion-row>--}}
            {{--            </ion-grid>--}}

            <div class="grid-tax-title">
                <br>
                <span class="font-weight-bold">{{ optional(optional($dataContent)[0])->rule_number }}</span> <br>
                <span class="font-weight-normal">Tanggal Berlaku:
                    <span class="get-date">
                        {{ optional(\Illuminate\Support\Carbon::parse(optional(optional($dataContent)[0])->start_from))->format('d/m/Y') }}
                    </span>
                        -
                    <span class="get-date">
                        {{ optional(\Illuminate\Support\Carbon::parse(optional(optional($dataContent)[0])->valid_until))->format('d/m/Y') }}
                    </span>
                </span>

                <img width="100vw" height="auto" src="{{ asset('img/bg/background_kurs.svg') }}"
                     style="width:100vw; height: auto; top:-2px;position:relative;display: block;"> </img>
            </div>
            <ion-list>
                <ion-item>
                    <ion-grid>
                        @if(!blank($dataContent))
                            @foreach($dataContent as $item)
                                <ion-row>
                                    <ion-col>
                                        <div class="cut-currency font-size-11">
                                            <span
{{--                                                class="font-color-blue font-weight-bold"--}}
                                                style="font-weight: bold"
                                            >
                                                {{$item->currency}}
                                            </span>
                                        </div>
                                        <div class=" font-size-11"> {{$item->currency_symbol}} </div>
                                    </ion-col>
                                    <ion-col>
                                        <div
{{--                                            class="font-size-11"--}}
{{--                                            style="color: black; font-weight: normal !important;"--}}
                                        >
                                            {{ number_format_rupiah(optional($item)->current_value) }}
                                        </div>
                                        <div class="number font-size-11
                                             @if(is_numeric($item->update_value))
                                                {{ (($item->update_value) * 1 ) < 0 ? 'font-red' : 'font-blue' }}
                                            @else
                                                font-red
                                            @endif
                                            "> {{ $item->update_value }}
                                        </div>
                                    </ion-col>
                                </ion-row>
                            @endforeach
                        @endif
                    </ion-grid>
                </ion-item>
            </ion-list>
            <devider></devider>

        </mat-tab-body>


    </mat-tab-group>
</ion-content>
</body>

<script src="{{asset('js/export-pdf.js')}}"></script>
<script>

    let x = document.querySelectorAll(".number");
    let language = @json($language);
    convertNumber(x, 'id-ID')

    let cc = document.querySelectorAll(".cut-currency")
    let dd = document.querySelectorAll(".get-date")
    convertDateByCountryCodeHTML(dd, language)

    for (let i = 0, len = cc.length; i < len; i++) {
        let str = cc[i].innerHTML
        let currency = str.split('(')
        let mySubString = str.substring(
            str.lastIndexOf("(") + 1,
            str.lastIndexOf(")")
        );

        cc[i].innerHTML = currency[0];
    }


</script>
</html>
