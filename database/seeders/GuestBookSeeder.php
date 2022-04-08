<?php

namespace Database\Seeders;

use App\Enums\DiskEnum;
use App\Models\GuestBook;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class GuestBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        DB::table('guest_books')->truncate();
        Schema::enableForeignKeyConstraints();

        File::cleanDirectory(
            Storage::disk(DiskEnum::PUBLIC)
                ->path(config('constants.storage_path.guest_photo'))
        );

        $index = 1;
        $arrayName = ['Tri Prasetyo Utomo', 'Bulan', 'Yerry Kurnia Aji', 'Dean Kurniawan', 'Achmad Rojikin Toro Saputo'];
        $payload = [];

        foreach ($arrayName as $name) {
            $noBarcode = $this->getNoBarcode($index);
            $payload[] = [
                'name' => $name,
                'no_barcode' => $noBarcode,
                'photo' => asset('img/seeder/guest/00' . $index . '.png')
            ];
            $index = $index + 1;
        }

        GuestBook::upsert($payload, ['no_barcode'], ['name']);
    }

    private function getNoBarcode($i)
    {
        if ($i < 10) {
            return '000' . $i;
        }
        if ($i < 100) {
            return '00' . $i;
        }
        if ($i < 1000) {
            return '0' . $i;
        }
        if ($i < 10000) {
            return $i;
        }
    }
}
