<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Orphanage;

class OrphanageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Orphanage::create([
            'Orphanage_id' => 'ORP001', // identifiant interne si différent de l'id auto-incrémenté
            'admin_id' => 1, // Assure-toi qu’un user avec id=1 existe
            'name' => 'Maison des Anges',
            'longitude' => '11.5020',
            'latitude' => '3.8480',
            'country' => 'Cameroun',
            'city' => 'Yaoundé',
            'region' => 'Centre',
            'address' => 'Quartier Melen, rue 237',
            'logo' => 'logos/maison_des_anges.png', // chemin d'un fichier dans public/storage
            'num_enregistrement' => 'REG-2024-0001',
            'description' => 'Un orphelinat qui accueille des enfants de 0 à 12 ans avec un encadrement bienveillant.',
            'email' => 'contact@maisonanges.org',
            'phone' => '+237690001122',
        ]);
    }
}
