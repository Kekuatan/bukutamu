<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="http://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/base.css')}}" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/css-pph.css')}}" rel="stylesheet">
    <title>Bukuku Personal</title>
</head>
<body>
{{--
<ion-header class="header-md">
    <ion-toolbar >

        <div  style="text-align: right;">
            <img src="{{asset('img/arrow-right.svg')}}" style="float: left; width: 60%; transform: rotate(180deg);">
        </div>
        <ion-title>
            Laporan PPh 21 Orang Pribadi
        </ion-title>
    </ion-toolbar>
</ion-header>
--}}

<img src="{{ asset('img/logo/bukuku_personal.svg') }}" alt="" class="logo-personal">

<div class="header-title font-size-12">
    <span class="font-size-12 font-weight-bold">{{ $title }}</span>
</div>

<ion-content>
    <mat-tab-group>

        <mat-tab-body>

            <ion-list>
                <ion-item>
                    <ion-grid>
                        @foreach($dataContent as $item)
                            <ion-row>
                                <ion-col>
                                    <div class="font-size-11"> {{$item->year}} </div>
                                    <div class="font-size-11"> Penghasilan Bruto</div>
                                    <div class="font-size-12 number font-rp"> {{ $item->subtotal }} </div>
                                </ion-col>
                                <ion-col>
                                    <div class="font-size-11"> Pph 21</div>
                                    <div class="font-size-12 number font-rp"> {{$item->tax}} </div>
                                </ion-col>
                            </ion-row>
                        @endforeach
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
    convertNumber(x, 'id-ID')

</script>
</html>
