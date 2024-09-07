<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

function createUniqueSlug($table, $name)
{
    $items = DB::table($table)->where('name', $name)->get();
    if ($items->isNotEmpty()) {
        $counter = 1;
        foreach ($items as $item) {
            $counter++;
        }
        return Str::slug($name).'-'.$counter;
    }
    return Str::slug($name);
}

function generateParentId($table, $attempts)
{
    $id = null;
    $lastItemId = DB::table($table)->orderByDesc('id')->first()->id;

    while ($attempts != 0) {
        $id = fake()->numberBetween(1, $lastItemId);

        if (DB::table($table)->where('id', $id)->exists()) {
            return $id;
        }
        $attempts--;
    }
    return null;
}

function staticImages(&$counter)
{
    $counter++;
    if (strlen($counter) == 1) {
        return "uploads/0" . $counter . '.png';
    }
    return "uploads/" . $counter . '.png';
}
