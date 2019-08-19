<?php

namespace App\Console\Commands;

use App\FieldPurchaser;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PopulateFieldPurchases extends AbstractCommand
{
    private const LOG_TAG = "[Populate FP]: ";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'field_purchases:populate {percentage=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills the field_purchases table with random lines';

    public function __construct(Logger $logger)
    {
        $this->logTag = self::LOG_TAG;
        parent::__construct();
    }

    public function handle()
    {
        $percentage = $this->argument('percentage');
        $this->log("Filling $percentage% of the field...");

        $this->log("Emptying table...");
        DB::table('field_purchases')->truncate();

        $this->log("Adding 1 Field Purchaser, all purchasers will be tied to that Purchaser");
        $purchaser = new FieldPurchaser();
        $purchaser->name = 'Populate Test';
        $purchaser->email = time() . "@test.com";
        $purchaser->save();

        $colors = [
            '#1114d3',
            '#fe1ea4',
            '#927c3d',
            '#e0b2ae',
            '#8cdf06',
            '#df53e5',
            '#ff0000',
            '#2c7014',
            '#1c5dd6',
            '#050505',
            '#fffc00',
            '#8a06b5',
            '#d46e00',
            '#000000',
            '#a07ff8',
            '#300952',
            '#f63a66',
            '#15839c',
            '#fdb802',
            '#45143a',
            '#740cde',
            '#a43655',
            '#dd62e3',
            '#6ed984',
            '#6a7ab9'
        ];

        $absMax = 6400 * ($percentage * 0.01);
        $count = 1;
        $this->log("Populating table with $absMax rows...");
        for ($i = 1; $i <= 100; $i++) {
            for ($j = 1; $j <= 64; $j++) {
                $count++;
                DB::table('field_purchases')->insert([
                    'row' => $i,
                    'column' => $j,
                    'letter' => strtoupper(Str::random(1)),
                    'field_purchaser_id' => $purchaser->id,
                    'color' => $colors[random_int(0,13)]
                ]);
                if ($count > $absMax) {
                    $count = DB::table('field_purchases')->count('id');
                    $this->log("Finished! $count rows were inserted");
                    return;
                }
            }
        }

        $count = DB::table('field_purchases')->count('id');
        $this->log("Finished! $count rows were inserted");

        return;
    }
}
