<?php

use Illuminate\Database\Seeder;
use App\CompleteIdTracker;
class CompleteIdTrackerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompleteIdTracker::truncate();
        CompleteIdTracker::create([
            'track_id'=>100
        ]);
        CompleteIdTracker::create([
            'track_id'=>100
        ]);
        CompleteIdTracker::create([
            'track_id'=>100
        ]);

         CompleteIdTracker::create([
            'track_id'=>1
        ]);
          CompleteIdTracker::create([
            'track_id'=>1
        ]);
    }
}
