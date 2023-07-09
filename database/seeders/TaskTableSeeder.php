<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Tag;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::truncate();

        Task::create([
            'name' => 'Perform routine system maintenance, including updates, patches, and security fixes',
            'list_id' => 1,
            'order_within_list' => 1,
        ]);

        Task::create([
            'name' => 'Monitor system performance, analyze logs, and troubleshoot any issues that arise',
            'list_id' => 1,
            'order_within_list' => 2,
        ]);

        Task::create([
            'name' => 'Manage user accounts, including creating, modifying, and disabling accounts as needed',
            'list_id' => 1,
            'order_within_list' => 3,
        ]);

        Task::create([
            'name' => 'Implement and maintain backup and disaster recovery solutions',
            'list_id' => 1,
            'order_within_list' => 4,
        ]);

        Task::create([
            'name' => 'Configure and maintain network infrastructure, including routers, switches, and firewalls',
            'list_id' => 1,
            'order_within_list' => 5,
        ]);

        Task::create([
            'name' => 'Implement and enforce security policies, including access controls and user permissions',
            'list_id' => 1,
            'order_within_list' => 6,
        ]);

        Task::create([
            'name' => 'Provide technical support to users, troubleshoot hardware and software issues',
            'list_id' => 1,
            'order_within_list' => 7,
        ]);

        Task::create([
            'name' => 'Perform routine system maintenance, including updates, patches, and security fixes',
            'list_id' => 1,
            'order_within_list' => 8,
        ]);

        Task::create([
            'name' => 'Play golf with Barack Obama',
            'list_id' => 2,
            'order_within_list' => 1,
            'image' => 'play-golf.jpg'
        ]);

        Task::create([
            'name' => 'F@ck the queen',
            'list_id' => 2,
            'order_within_list' => 2,
        ]);

        Task::create([
            'name' => 'Steal the car',
            'list_id' => 2,
            'order_within_list' => 3,
            'image' => 'steal-the-car.jpeg'
        ]);

        Task::create([
            'name' => 'Ascend Elbrus mountain in Russia',
            'list_id' => 2,
            'order_within_list' => 4,
        ]);

        Task::create([
            'name' => 'Mow the lawn in the frontyard',
            'list_id' => 3,
            'order_within_list' => 1,
            'image' => 'mow-the-lawn.jpg'
        ]);

        Task::create([
            'name' => 'Fix the car engine',
            'list_id' => 3,
            'order_within_list' => 2,
            'image' => 'fix-the-car-engine.jpg'
        ]);

        Task::create([
            'name' => 'Get the hair cut',
            'list_id' => 3,
            'order_within_list' => 3,
            'image' => 'haircut.jpg'
        ]);

        Task::create([
            'name' => 'Perform in a movie in Hollywood',
            'list_id' => 4,
            'order_within_list' => 1,
        ]);

        Task::create([
            'name' => 'Play poker game with celebs',
            'list_id' => 4,
            'order_within_list' => 2,
            'image' => 'play-poker.jpg'
        ]);

        Task::create([
            'name' => 'Marry handsome dude from Argentina',
            'list_id' => 4,
            'order_within_list' => 3,
        ]);

        Task::create([
            'name' => '[Work] Finish drawing for the Up and Down pilot',
            'list_id' => 5,
            'order_within_list' => 1,
            'image' => 'make-a-cartoon.jpg'
        ]);

        Task::create([
            'name' => 'Vacuum the floor in the living room',
            'list_id' => 5,
            'order_within_list' => 2,
            'image' => 'woman-vacuuming.jpg'
        ]);

        Task::create([
            'name' => 'Eat some candies',
            'list_id' => 5,
            'order_within_list' => 3,
            'image' => 'eat-candies.jpg'
        ]);

        Task::create([
            'name' => 'Call mom',
            'list_id' => 5,
            'order_within_list' => 4,
            'image' => 'call-mom.jpg'
        ]);

        $this->attachTags();
    }

    public function attachTags(): void
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $tags = Tag::inRandomOrder()->take(rand(0, 4))->get();
   
            $task->tags()->attach($tags);
        }
    }
}
