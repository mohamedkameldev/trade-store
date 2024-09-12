<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

function upload($file)
{
    // dump($file->getSize());
    // dump($file->getFileInfo());
    // dump($file->getFilename());     // the current name in the temp folder
    // dump($file->getClientOriginalName());
    // dump($file->getClientOriginalExtension());
    // dump($file->getMimeType());
    // dd($file);

    // $path = $file->store('uploads'); // .env disk
    // $path = $file->store('uploads', 'local'); // local disk (storage/app)
    // $path = $file->store('uploads', 'public'); // public disk (storeag/app/public)
    // $path = $file->store('uploads', [
    //     'disk' => 'public'
    // ]);
    // store function make a random name for the file

    $file_name = now()->timestamp . '_' . $file->getClientOriginalName();
    $path = $file->storeAs('uploads', $file_name, 'public');

    return $path;
}

function adding_tags($request_tags)
{
    $user_tags = json_decode($request_tags);
    $db_tags = DB::table('tags')->get();
    $tag_ids = [];

    foreach ($user_tags as $user_tag) {
        $slug = Str::slug($user_tag->value);
        $tag = $db_tags->where('slug', $slug)->first();

        if (!$tag) {
            DB::table('tags')->insert([
                'name' => $user_tag->value,
                'slug' => $slug
            ]);
            $tag = DB::table('tags')->where('slug', $slug)->first();
        }
        $tag_ids[] = $tag->id;
    }
    return $tag_ids;
}

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
