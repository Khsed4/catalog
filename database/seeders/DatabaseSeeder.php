<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Catalogue;
use App\Models\CompanySetting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@catalog.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        // Create Company Settings
        CompanySetting::create([
            'company_name' => 'Unique Natural LLC',
            'address' => '123 Business Street, Suite 456, New York, NY 10001',
            'phone' => '+1 (240) 605-1416',
            'email' => 'uniquenaturalllc@gmail.com',
            'cover_image' => null
        ]);

        // Create Catalogues
        $catalogueData = [
            ['name' => 'Kitchenware', 'description' => 'Kitchen products and accessories'],
            ['name' => 'Islamic Items', 'description' => 'Islamic art and decor items'],
            ['name' => 'New Products', 'description' => 'Latest additions to our collection'],
            ['name' => 'Outdoor Collection', 'description' => 'Products for outdoor use'],
        ];

        $catalogueModels = [];
        foreach ($catalogueData as $catalogue) {
            $catalogueModels[] = Catalogue::create($catalogue);
        }

        // Create Categories
        $categories = [
            ['name' => 'Dinner Sets', 'description' => 'Complete dining sets with plates, bowls, and serving pieces'],
            ['name' => 'Decorative Items', 'description' => 'Beautiful decorative pieces for home and office'],
            ['name' => 'Kitchen Accessories', 'description' => 'Essential kitchen tools and accessories'],
            ['name' => 'Glassware', 'description' => 'High-quality glass items for beverages and dining'],
            ['name' => 'Serving Platters', 'description' => 'Elegant serving dishes and platters'],
            ['name' => 'Storage Solutions', 'description' => 'Practical storage containers and organizers'],
            ['name' => 'Tea & Coffee Sets', 'description' => 'Beautiful tea and coffee service sets'],
            ['name' => 'Outdoor & Picnic', 'description' => 'Durable items for outdoor dining and picnics'],
            ['name' => 'Islamic Decor', 'description' => 'Islamic art and decorative pieces'],
            ['name' => 'Carpets & Rugs', 'description' => 'High-quality carpets and area rugs']
        ];

        $categoryModels = [];
        foreach ($categories as $category) {
            $categoryModels[] = Category::create($category);
        }

        // Get all image files from public/images directory
        $imagesPath = public_path('images');
        $imageFiles = scandir($imagesPath);
        $imageFiles = array_filter($imageFiles, function($file) {
            return in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']);
        });
        $imageFiles = array_values($imageFiles);

        // Product name prefixes for variety
        $productPrefixes = [
            'Elegant', 'Modern', 'Classic', 'Luxury', 'Premium', 'Handcrafted',
            'Vintage', 'Contemporary', 'Traditional', 'Designer', 'Artisan',
            'Deluxe', 'Royal', 'Supreme', 'Elite', 'Exclusive'
        ];

        $productTypes = [
            'Dinner Sets' => ['Set', 'Collection', 'Service Set', 'Dinner Set', 'Plate Set'],
            'Decorative Items' => ['Vase', 'Sculpture', 'Ornament', 'Figurine', 'Wall Art'],
            'Kitchen Accessories' => ['Tool Set', 'Utensil Set', 'Knife Set', 'Mixer', 'Gadget'],
            'Glassware' => ['Glass Set', 'Tumbler Set', 'Wine Glasses', 'Champagne Flutes', 'Pitcher'],
            'Serving Platters' => ['Platter', 'Serving Dish', 'Tray', 'Bowl Set', 'Serving Set'],
            'Storage Solutions' => ['Container Set', 'Storage Box', 'Organizer', 'Jar Set', 'Canister Set'],
            'Tea & Coffee Sets' => ['Tea Set', 'Coffee Set', 'Teapot', 'Coffee Maker', 'Cup & Saucer Set'],
            'Outdoor & Picnic' => ['Picnic Set', 'Cooler Bag', 'Outdoor Set', 'Camping Set', 'Travel Set'],
            'Islamic Decor' => ['Wall Frame', 'Prayer Mat', 'Islamic Art', 'Calligraphy', 'Decor Piece'],
            'Carpets & Rugs' => ['Area Rug', 'Prayer Mat', 'Runner', 'Persian Carpet', 'Floor Mat']
        ];

        // Create products using available images
        $productCount = min(count($imageFiles), 500); // Limit to 500 products for reasonable seeding time

        echo "Creating {$productCount} products...\n";

        for ($i = 0; $i < $productCount; $i++) {
            $category = $categoryModels[array_rand($categoryModels)];
            $prefix = $productPrefixes[array_rand($productPrefixes)];
            $type = $productTypes[$category->name][array_rand($productTypes[$category->name])];

            // Extract SKU from image filename (without extension)
            $imageName = $imageFiles[$i];
            $sku = pathinfo($imageName, PATHINFO_FILENAME);

            // Assign a random catalogue (70% chance) or none (30% chance)
            $catalogueId = rand(1, 10) <= 7 ? $catalogueModels[array_rand($catalogueModels)]->id : null;

            Product::create([
                'name' => $prefix . ' ' . $type,
                'price' => rand(999, 29999) / 100, // Random price between $9.99 and $299.99
                'SKU' => $sku,
                'item_number' => 'ITEM-' . str_pad($i + 1, 5, '0', STR_PAD_LEFT),
                'description' => 'High-quality ' . strtolower($type) . ' perfect for modern living. Features excellent craftsmanship and durable materials.',
                'category_id' => $category->id,
                'catalogue_id' => $catalogueId,
                'image' => $imageName,
                'out_of_stock' => (bool)rand(0, 10) > 1, // 90% in stock
                'quantity' => rand(0, 100)
            ]);

            // Show progress every 50 products
            if (($i + 1) % 50 == 0) {
                echo "Created " . ($i + 1) . " products...\n";
            }
        }

        echo "\nSeeding completed successfully!\n";
        echo "- Created " . User::count() . " users\n";
        echo "- Created " . Catalogue::count() . " catalogues\n";
        echo "- Created " . Category::count() . " categories\n";
        echo "- Created " . Product::count() . " products\n";
    }
}
