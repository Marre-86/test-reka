<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::truncate();

        $tags = [
            'design',
            'development',
            'marketing',
            'sales',
            'writing',
            'research',
            'planning',
            'collaboration',
            'presentation',
            'analysis',
            'testing',
            'training',
            'maintenance',
            'documentation',
            'support',
            'meetings',
            'budgeting',
            'reporting',
            'implementation',
            'innovation',
        ];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }

    }
}
