<?php

declare(strict_types=1);

namespace Meubleo\Platform\Database\Seeders;

use Illuminate\Database\Seeder;
use Meubleo\Platform\Models\Category;
use Meubleo\Platform\Models\Product;

class MeubleoSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Canapés & Sofas',    'slug' => 'canapes-sofas',     'description' => 'Confort et élégance pour votre salon'],
            ['name' => 'Tables & Bureaux',    'slug' => 'tables-bureaux',    'description' => 'Des surfaces pour travailler et se retrouver'],
            ['name' => 'Chaises & Fauteuils', 'slug' => 'chaises-fauteuils', 'description' => 'Asseyez-vous en tout style'],
            ['name' => 'Rangements',          'slug' => 'rangements',        'description' => 'Bibliothèques, commodes et placards'],
            ['name' => 'Chambres',            'slug' => 'chambres',          'description' => 'Lits, chevets et armoires'],
            ['name' => 'Luminaires',          'slug' => 'luminaires',        'description' => 'Éclairez votre intérieur avec style'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        $map = Category::pluck('id', 'slug');

        $desc    = "Un meuble d'exception alliant savoir-faire artisanal et design contemporain.";
        $details = "• Fabrication européenne\n• Garantie 2 ans\n• Livraison offerte dès 500€\n• Retours 30 jours";

        $products = [
            ['cat' => 'canapes-sofas',     'name' => 'Canapé Haussmann 3 places', 'price' => 1290, 'sale_price' => 990,  'stock' => 8,  'material' => 'Velours',      'color' => 'Vert forêt',  'dimensions' => '220x90x80 cm',  'featured' => true,  'sku' => 'CNP-001'],
            ['cat' => 'canapes-sofas',     'name' => "Canapé d'angle Oslo",        'price' => 1890, 'sale_price' => null, 'stock' => 5,  'material' => 'Tissu',        'color' => 'Gris clair',  'dimensions' => '280x160x75 cm', 'featured' => true,  'sku' => 'CNP-002'],
            ['cat' => 'canapes-sofas',     'name' => 'Méridienne Rivoli',           'price' => 750,  'sale_price' => null, 'stock' => 12, 'material' => 'Lin',          'color' => 'Écru',        'dimensions' => '170x80x70 cm',  'featured' => false, 'sku' => 'CNP-003'],
            ['cat' => 'tables-bureaux',    'name' => 'Table basse Atelier',         'price' => 349,  'sale_price' => null, 'stock' => 20, 'material' => 'Chêne massif', 'color' => 'Naturel',     'dimensions' => '120x60x45 cm',  'featured' => true,  'sku' => 'TBL-001'],
            ['cat' => 'tables-bureaux',    'name' => 'Table à manger Silo 6p',      'price' => 1150, 'sale_price' => 895,  'stock' => 7,  'material' => 'Noyer',        'color' => 'Foncé',       'dimensions' => '180x90x76 cm',  'featured' => true,  'sku' => 'TBL-002'],
            ['cat' => 'tables-bureaux',    'name' => 'Bureau Manuscrit',            'price' => 620,  'sale_price' => null, 'stock' => 15, 'material' => 'Métal & bois', 'color' => 'Noir/Chêne',  'dimensions' => '140x70x76 cm',  'featured' => false, 'sku' => 'TBL-003'],
            ['cat' => 'chaises-fauteuils', 'name' => 'Fauteuil Voltaire',           'price' => 490,  'sale_price' => null, 'stock' => 18, 'material' => 'Velours',      'color' => 'Terracotta',  'dimensions' => '80x85x95 cm',   'featured' => true,  'sku' => 'CHR-001'],
            ['cat' => 'chaises-fauteuils', 'name' => 'Chaise Louis en rotin',       'price' => 189,  'sale_price' => 149,  'stock' => 30, 'material' => 'Rotin',        'color' => 'Naturel',     'dimensions' => '50x55x85 cm',   'featured' => false, 'sku' => 'CHR-002'],
            ['cat' => 'rangements',        'name' => 'Bibliothèque Modula 5 cases', 'price' => 695,  'sale_price' => null, 'stock' => 10, 'material' => 'MDF laqué',    'color' => 'Blanc mat',   'dimensions' => '100x35x200 cm', 'featured' => false, 'sku' => 'RNG-001'],
            ['cat' => 'rangements',        'name' => 'Commode Japonaise 4 tiroirs', 'price' => 520,  'sale_price' => null, 'stock' => 6,  'material' => 'Bouleau',      'color' => 'Naturel',     'dimensions' => '80x45x90 cm',   'featured' => true,  'sku' => 'RNG-002'],
            ['cat' => 'chambres',          'name' => 'Lit plateforme Zen 160x200',  'price' => 980,  'sale_price' => null, 'stock' => 9,  'material' => 'Chêne',        'color' => 'Naturel',     'dimensions' => '175x210x30 cm', 'featured' => true,  'sku' => 'CHB-001'],
            ['cat' => 'chambres',          'name' => 'Chevet Cannage',              'price' => 185,  'sale_price' => 145,  'stock' => 25, 'material' => 'Rotin',        'color' => 'Naturel',     'dimensions' => '45x35x55 cm',   'featured' => false, 'sku' => 'CHB-002'],
            ['cat' => 'luminaires',        'name' => 'Suspension Soleil Levant',    'price' => 290,  'sale_price' => null, 'stock' => 14, 'material' => 'Laiton',       'color' => 'Doré',        'dimensions' => 'Ø50 cm',        'featured' => true,  'sku' => 'LUM-001'],
            ['cat' => 'luminaires',        'name' => 'Lampe à poser Céramique',     'price' => 145,  'sale_price' => null, 'stock' => 20, 'material' => 'Céramique',    'color' => 'Blanc crème', 'dimensions' => 'H 42 cm',       'featured' => false, 'sku' => 'LUM-002'],
        ];

        foreach ($products as $data) {
            Product::firstOrCreate(['sku' => $data['sku']], [
                'category_id' => $map[$data['cat']],
                'name'        => $data['name'],
                'price'       => $data['price'],
                'sale_price'  => $data['sale_price'],
                'stock'       => $data['stock'],
                'material'    => $data['material'],
                'color'       => $data['color'],
                'dimensions'  => $data['dimensions'],
                'is_featured' => $data['featured'],
                'is_active'   => true,
                'description' => $desc,
                'details'     => $details,
            ]);
        }

        $this->command?->info('✓ Meubleo demo data seeded (6 categories, 14 products).');
    }
}
