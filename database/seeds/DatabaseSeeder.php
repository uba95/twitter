<?php

use App\Models\Like;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 20)->create();

        $users->each(function (User $user) {
            
            $tweets = factory(App\Tweet::class, rand(3, 6))->create(['user_id' => $user->id]);

        });

        for ($i=1;$i<100;$i++) {

            $u_ids = User::all()->pluck('id');
            $u_id1 = $u_ids[array_rand($u_ids->all())];
            $u_id2 = $u_ids[array_rand($u_ids->all())];
            $user1 = User::find($u_id1);
            $user2 = User::find($u_id2);
            $user1->follow($user2);
        }

        $follows =  DB::table('follows')->groupBy('user_id', 'following_user_id')->get();
        $ids = array_column($follows ->toArray(), 'id');
        Like::whereNotIn('id', $ids )->delete();

        for ($i=1;$i<1000;$i++) {

            $u_ids = User::all()->pluck('id')->all();
            $u_id = $u_ids[array_rand($u_ids)];

            $t_ids = Tweet::all()->pluck('id')->all();
            $t_id = $t_ids[array_rand($t_ids)];

            factory(App\Like::class)->create(['user_id' => $u_id, 'tweet_id' =>  $t_id]);

        }
        
        $likes = Like::groupBy('user_id', 'tweet_id')->get();
        $ids = array_column($likes ->toArray(), 'id');
        Like::whereNotIn('id', $ids )->delete();

    }
    
}
            // factory(App\Like::class, rand(5, 20))->create(['user_id' => $user->id]);
            // $user->likes()->saveMany(
            //     factory(App\Like::class, rand(1, 5))->create()
            // );
        

// $authors = factory(App\Author::class, 5)->create();
// $authors->each(function ($author) {
//     $author
//         ->profile()
//         ->save(factory(App\Profile::class)->make());
//     $author
//         ->posts()
//         ->saveMany(
//             factory(App\Post::class, rand(20,30))->make()
//         );
// });
// $tweets = factory(App\Tweet::class, rand(3, 6))->create(['user_id' => $user->id]);

//             $tweets->each(function ($tweet) {

//                 factory(App\Like::class, rand(1, 10))->create(['user_id' => $tweet->user->id, 'tweet_id' => $tweet->id]);
                
//             });
//     $allUsers = User::all()->skip($user->id)->pluck('id')->all();
//     DB::table('follows')->insert([
//         'user_id' => $user->id, 'following_user_id' => array_rand($allUsers),
//     ]);

// $u_ids = User::all()->skip($user->id)->pluck('id');
// if (!$u_ids->isEmpty()) {

//     $u_id = $u_ids->random(1);
//     $u_id = User::find($u_ids[0]);
//     $user->follow($u_id);
// }
