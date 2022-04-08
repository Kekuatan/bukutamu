<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="http://fonts.cdnfonts.com/css/gilroy-bold" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/base.css')}}" rel="stylesheet">
    <link href="{{asset('css/convert-pdf/css-income.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.3.0/d3.min.js"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <title>Bukuku Personal</title>


</head>
<style>
    .photo-frame{
        height: 300px;
        width: 200px;
        padding: 10px;
        background-color: red;
        -webkit-print-color-adjust: exact;
        margin: auto;
    }
    .photo-frame img{
        width: 100%;
        background-color: white;
        -webkit-print-color-adjust: exact;
    }
    .photo-name{
        text-align: center;
    }
    .photo-container{
        padding: 10px;
        background-color: #5D6975;
        -webkit-print-color-adjust: exact;
    }
</style>
<body>
    <div class="photo-container">
        <div class="row">
            <div class="col-3">
                <div class="photo-frame">
                    <img class="" src="{{asset('img/seeder/guest/001.png')}}">
                </div>
                <p class="photo-name"> Dean Kurniawan</p>

            </div>
            <div class="col-3">
                <div class="photo-frame">
                    hello
                </div>
            </div>
            <div class="col-3">
                <div class="photo-frame">
                    hello
                </div>
            </div>

            <div class="col-3">
                <div class="photo-frame">
                    hello
                </div>
            </div>

        </div>
    </div>
</body>
</html>

<script>
    {{--let chartData = @json($chartData);--}}
    {{--let language = @json($language);--}}
</script>
