<?php

namespace App\Console\Commands;

use App\Prometheus\Counters\BuildCount;
use App\Prometheus\Gauges\BillableUsage;

use Illuminate\Console\Command;

class GenerateMetricsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metrics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate phony metrics';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Generate some metrics for build count and 
        // billable builds with some randomness
        
        
        // Add between 0 and 5 builds to the count in the last 5 minutes
        // We'll pretend each build is from a separate team (billable user) of the application
        $buildCount =  mt_rand(0, 5);
        for ($k = 0 ; $k < $buildCount; $k++) { 
            BuildCount::inc([
                mt_rand(1, 20), // team label - the ID of a team. We pretend there are only 20 teams!
                'fly' // platform label - on the fly platform
            ]);
        }
        


        // Roughly half the time, add some units to the billable count
        $addBillableCount = mt_rand(0,1);

        if ($addBillableCount) {
            // Pretend some number (0-5) of teams had builds that were billable
            $numberTeamsWithBillableBuilds =  mt_rand(0, 5);
            for ($j = 0 ; $j < $numberTeamsWithBillableBuilds; $j++) { 
                // Generate some number of billable builds per team that,
                // for the sake of generating numbers that somewhat follows reality
                // increase along with the numerical date of the month (resetting back to zero
                // at the beginning of each month)
                $billableBuilds = (int)date('d') + mt_rand(0, 5); 
                
                // Set the number of billable builds for some randomish team id (1-20)
                // We use a small set of teams here (20) to increase the odds that just
                // some teams get a bunch of billable builds
                BillableUsage::set($billableBuilds, [mt_rand(1,20)]);
            }
        }
    }
}
