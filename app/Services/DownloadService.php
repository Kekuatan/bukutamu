<?php


namespace App\Services\Helpers;


use App\Enums\DiskEnum;
use App\Enums\ExternalLinkEnum;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadService
{
    public function handle($request, $responseData, $start, $until, $page)
    {
        $payload = [];

        if ($page == 'cashbank') {
            $htmlView = 'converts.pdf.report-cashbank';
            $chartData = [
                [
                    'label' => __('download.pdf.cashbank.chart.label_spending'),
                    'value' => $responseData['total_spending'],
                    'icon_url' => asset('img/icon_spending_report_cashbank.svg'),
                    'color' => '#11AA25'
                ],
                [
                    'label' => __('download.pdf.cashbank.chart.label_income'),
                    'value' => $responseData['total_income'],
                    'icon_url' => asset('img/icon_income_report_cashbank.svg'),
                    'color' => '#0021C9'
                ]
            ];

            if ($responseData['total_spending'] == 0) {
                $chartData = [
                    [
                        'label' => __('download.pdf.cashbank.chart.label_income'),
                        'value' => $responseData['total_income'],
                        'icon_url' => asset('img/icon_income_report_cashbank.svg'),
                        'color' => '#11AA25'
                    ],
                ];
            }

            if ($responseData['total_income'] == 0) {
                $chartData = [
                    [
                        'label' => __('download.pdf.cashbank.chart.label_spending'),
                        'value' => $responseData['total_spending'],
                        'icon_url' => asset('img/icon_spending_report_cashbank.svg'),
                        'color' => '#0021C9'
                    ]
                ];
            }

            $payload = [
                'dataContent' => $responseData['journals'],
                'cashbank_balance' => $responseData['cashbank_balance'],
                'cashbank_balance_txt' => __('download.pdf.cashbank.cashbank_balance_txt'),
                'monthList' => $responseData['month_list'],
                'chartData' => $chartData,
                'start' => \Carbon\Carbon::parseFromLocale($start)->format('d/m/Y'),
                'until' => Carbon::parseFromLocale($until)->format('d/m/Y'),
                'title' => __('download.pdf.cashbank.title', ['name' => $responseData['cashbank_name']]),
                'is_search' => $request->is_search,
                'language' => $request->user()->language,
            ];
        }

        if ($page == 'income') {
            $htmlView = 'converts.pdf.report-income';
            $payload = [
                'dataContent' => $responseData['journals'],
                'monthList' => $responseData['month_list'],
                'chartData' => $responseData['total'],
                'start' => \Carbon\Carbon::parseFromLocale($start)->format('d/m/Y'),
                'until' => Carbon::parseFromLocale($until)->format('d/m/Y'),
                'title' => __('download.pdf.income.title'),
                'is_search' => $request->is_search,
                'language' => $request->user()->language,
            ];
        }

        if ($page == 'journal') {
            $htmlView = 'converts.pdf.report-transaksi';
            $payload = [
                'dataContent' => $responseData['journals'],
                'monthList' => $responseData['month_list'],
                'start' => \Carbon\Carbon::parseFromLocale($start)->format('d/m/Y'),
                'until' => Carbon::parseFromLocale($until)->format('d/m/Y'),
                'title' => __('download.pdf.transaction.title'),
                'is_search' => $request->is_search,
                'language' => $request->user()->language,
            ];
        }

        if ($page == 'spending') {
            $htmlView = 'converts.pdf.report-spending';
            $payload = [
                'dataContent' => $responseData['journals'],
                'monthList' => $responseData['month_list'],
                'chartData' => $responseData['total'],
                'start' => \Carbon\Carbon::parseFromLocale($start)->format('d/m/Y'),
                'until' => Carbon::parseFromLocale($until)->format('d/m/Y'),
                'title' => __('download.pdf.spending.title'),
                'is_search' => $request->is_search,
                'language' => $request->user()->language,
            ];
        }

        if ($page == 'loan') {
            $htmlView = 'converts.pdf.report-loan';
            $payload = [
                'dataContent' => $responseData['journals'],
                'monthList' => $responseData['month_list'],
                'chartData' => $responseData['total'],
                'start' => \Carbon\Carbon::parseFromLocale($start)->format('d/m/Y'),
                'until' => Carbon::parseFromLocale($until)->format('d/m/Y'),
                'title' => __('download.pdf.loan.title'),
                'language' => $request->user()->language,
            ];
        }

        if ($page == 'cc-payment') {
            $htmlView = 'converts.pdf.report-cc-payment';
            $payload = [
                'dataContent' => $responseData['journals'],
                'monthList' => $responseData['month_list'],
                'balance' => $responseData['sum_total'],
                'balance_txt' => __('download.pdf.cc-payment.balance-txt'),
                'listText' => __('download.pdf.cc-payment.list-text'),
                'start' => \Carbon\Carbon::parseFromLocale($start)->format('d/m/Y'),
                'until' => Carbon::parseFromLocale($until)->format('d/m/Y'),
                'title' => __('download.pdf.cc-payment.title'),
                'language' => $request->user()->language,
            ];
        }

        if ($page == 'cc') {
            $htmlView = 'converts.pdf.report-cc';
            $payload = [
                'dataContent' => $responseData['journals'],
                'monthList' => $responseData['month_list'],
                'balance' => $responseData['total'],
                'balance_txt' => __('download.pdf.cc.balance-txt'),
                'start' => \Carbon\Carbon::parseFromLocale($start)->format('d/m/Y'),
                'until' => Carbon::parseFromLocale($until)->format('d/m/Y'),
                'title' => __('download.pdf.cc.title'),
                'is_search' => $request->is_search,
                'language' => $request->user()->language,
            ];
        }


        if ($page == 'umkm') {
            $htmlView = 'converts.pdf.report-umkm';
            $payload = [
                'dataContent' => $responseData['taxReport'],
                'yearList' => $responseData['yearList'],
                'year' => $responseData['year'],
                'title' => __('download.pdf.umkm.title'),
                'sumSubtotal' => $responseData['taxReport']->sum('subtotal'),
                'sumTax' => $responseData['taxReport']->sum('tax'),
                'language' => $request->user()->language,
            ];
        }
        if ($page == 'pph') {
            $htmlView = 'converts.pdf.report-pph';
            $payload = [
                'dataContent' => $responseData,
                'title' => __('download.pdf.pph.title'),
                'language' => $request->user()->language,
            ];
        }
        if ($page == 'tax-rate') {
            $htmlView = 'converts.pdf.tax-rate';
            $payload = [
                'dataContent' => $responseData,
                'start' => Carbon::parseFromLocale($request->input('start-from-from'))->format('d/m/Y'),
                'until' => Carbon::parseFromLocale($request->input('valid-until-from'))->format('d/m/Y'),
                'title' => __('download.pdf.tax-rate.title'),
                'language' => $request->user()->language,
            ];

        }

        $is_group_by_month = false;
        if ($request->has('group_by_month')) {
            $is_group_by_month = $request->group_by_month == 1;
        }

        $payload = Arr::add($payload, 'is_group_by_month', $is_group_by_month);
        $htmlView = 'converts.pdf.report-cashbank';
        $html = view($htmlView, $payload)->render();

        $client = new Client(['base_uri' => ExternalLinkEnum::PDFGENERATOR]);
        $response = $client->post('pdf-generator', [
            'form_params' => ['html' => $html]
        ]);

        $fileName = '1' . '.pdf';
        Storage::disk(DiskEnum::PUBLIC)
            ->put(config('constants.storage_path.guest_pdf') . '/' . $fileName, $response->getBody()
                ->getContents());
        return ['pdf_link' => Storage::disk(DiskEnum::PUBLIC)
            ->url(config('constants.storage_path.guest_pdf') . '/' . $fileName)];

    }
}
