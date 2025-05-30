<?
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public const MAX_RECORDS = 10;

    public function run(): void
    {
        // Xoá dữ liệu cũ
        DB::table('categories')->truncate();

        $categories = [];

        // Thêm option 0 là Khác
        $categories[] = [
            'id'         => 0,
            'name'       => 'Khác',
            'slug'       => 'khac',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Seed các category khác
        for ($i = 1; $i <= self::MAX_RECORDS; $i++) {
            $categories[] = [
                'name'       => 'Category '.$i,
                'slug'       => 'category-'.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert 1 lần
        DB::table('categories')->insert($categories);
    }
}
