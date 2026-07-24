<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$rows = Illuminate\Support\Facades\DB::table('articles')->select('id', 'category_id', 'title')->limit(20)->get();
foreach ($rows as $row) {
    echo $row->id . '|' . $row->category_id . '|' . $row->title . PHP_EOL;
}
