<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Kota;
use App\Models\User;
use App\Models\Alamat;
use App\Models\Negara;
use App\Models\Pondok;
use App\Models\Kawasan;
use App\Models\Provinsi;
use App\Models\Kecamatan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Alamatable;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $negaras = Negara::factory(2)->create();

        foreach ($negaras as $negara) {
            $Provinsis = Provinsi::factory(2)->create(['negara_id' => $negara->id]);

            foreach ($Provinsis as $provinsi) {
                $kotas = Kota::factory(2)->create(['provinsi_id' => $provinsi->id]);

                foreach ($kotas as $kota) {
                    $kecamatans = Kecamatan::factory(2)->create(['kota_id' => $kota->id]);

                    foreach ($kecamatans as $kecamatan) {
                        $desas = Desa::factory(2)->create(['kecamatan_id' => $kecamatan->id]);

                        foreach ($desas as $desa) {
                            $alamats = Alamat::factory(2)->create(['desa_id' => $desa->id]);

                            for ($i = 0; $i < count($alamats); $i++) {
                                Pondok::factory()->create();
                                Kawasan::factory()->create();
                                User::factory()->create();
                                Alamatable::factory()->create();
                            }

                        }
                    }
                }
            }


        }
    }
}
