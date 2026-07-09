<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baseDir = database_path('seeders/images');
        $destDir = storage_path('app/public/images');

        if (File::exists($baseDir)) {
            // コピー先のディレクトリを自動作成
            File::ensureDirectoryExists($destDir);

            // コピー元のすべてのファイルを取得
            $files = File::allFiles($baseDir);

            foreach ($files as $file) {
                $filename = $file->getFilename();
                $targetPath = $destDir . '/' . $filename;

                File::copy($file->getRealPath(), $targetPath);
            }
        }

        // DB登録
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-02-19', 'note' => "一行日記を始めました。", 'color_code' => '#00ffff', 'image_path' => '']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-03-20', 'note' => "近所の公園で散歩した。", 'color_code' => '', 'image_path' => 'images/fuefukigawa-riverside-path_small.jpg']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-04-03', 'note' => "桜の季節。\n今が満開です！", 'color_code' => '#ffc0cb', 'image_path' => 'images/cherry-blossoms-1_small.jpg']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-05-05', 'note' => "今日は端午の節句。\nまさに五月晴れ！", 'color_code' => '', 'image_path' => 'images/carp-streamer_small.jpg']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-06-10', 'note' => "梅雨入りしました。\n蒸し暑いです。", 'color_code' => '#00008b', 'image_path' => '']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-06-24', 'note' => "梅雨で雨続き。\n紫陽花がきれいに咲いていた。", 'color_code' => '', 'image_path' => 'images/blue-purple-hydrangea-bush_small.jpg']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-07-01', 'note' => "公園で鴨の親子を見かけた。", 'color_code' => '', 'image_path' => 'images/duck-9_small.jpg']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-07-17', 'note' => "今日は早朝ランニングをした。", 'color_code' => '', 'image_path' => 'images/teine-asukaze-promenade_small.jpg']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-08-23', 'note' => "キャンプに来ました🏕️\n今年は蚊が少ない気がします。", 'color_code' => '#008000', 'image_path' => 'images/mosquito-repellent-incense_small.jpg']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-09-08', 'note' => "沖縄に来ました。\n海がとても綺麗です。", 'color_code' => '', 'image_path' => 'images/okinawa-sea-1_small.jpg']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-10-17', 'note' => "天高く馬肥ゆる秋です！", 'color_code' => '#f0f8ff', 'image_path' => 'images/sky-and-trees_small.jpg']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-10-23', 'note' => "もうすぐハロウィン！\nかぼちゃが可愛かった。", 'color_code' => '#ff7f50', 'image_path' => 'images/halloween-pumpkin-jack-o-lantern-on-grass_small.jpg']);
        \App\Models\Note::create(['user_id' => 1, 'date' => '2026-12-01', 'note' => "街で綺麗なクリスマスツリーを見かけた。\n早いものでもう一年も終わりです。", 'color_code' => '#006400', 'image_path' => 'images/christmas-tree-2_small.jpg']);
    }
}
