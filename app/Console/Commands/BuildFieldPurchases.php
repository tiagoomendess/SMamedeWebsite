<?php

namespace App\Console\Commands;

use App\FieldPurchase;
use Illuminate\Log\Logger;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class BuildFieldPurchases extends AbstractCommand
{
    private const LOG_TAG = "[Build FP]: ";
    private const OUTPUT_DIR = "images/field_purchases/";

    private const FIELD_WIDTH = 64;
    private const FIELD_HEIGHT = 100;
    private const IMAGE_SCALE = 30; //How many pixels does a meter have

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'field_purchases:build_image {--snapshot}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Builds an image that reflects the field purchases';

    /** @var Logger */
    private $logger;

    private $manager;

    private $width;

    private $height;

    private $lineWidth;

    public function __construct(Logger $logger, ImageManager $manager)
    {
        $this->logger = $logger;
        $this->manager = $manager;
        $this->width = self::FIELD_WIDTH * self::IMAGE_SCALE;
        $this->height = self::FIELD_HEIGHT * self::IMAGE_SCALE;
        $this->lineWidth = self::IMAGE_SCALE / 10;
        $this->logTag = self::LOG_TAG;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '1024M');
        $isSnapshot = $this->option('snapshot');

        $this->log("Building field purchases");
        $this->ensureDir();
        $field_purchases = FieldPurchase::all();
        $this->log("Processing " . count($field_purchases) . " purchases");

        $field_base = $this->manager->canvas($this->width, $this->height);

        //Fill with green of grass
        $field_base->fill('008000');

        foreach ($field_purchases as $field_purchase) {
            $y = ($field_purchase->row - 1) * self::IMAGE_SCALE;
            $x = ($field_purchase->column - 1) * self::IMAGE_SCALE;

            $field_base->rectangle($x, $y, $x + self::IMAGE_SCALE, $y + self::IMAGE_SCALE, function ($draw) use($field_purchase) {
                //$draw->border(2, '#000');
                $draw->background($field_purchase->color);
            });

            $field_base->text($field_purchase->letter, $x + (self::IMAGE_SCALE * 0.5), $y + (self::IMAGE_SCALE * 0.5), function($font) use($field_purchase) {
                $font->file(public_path('fonts/Roboto-Black.ttf'));
                $font->size(self::IMAGE_SCALE * 0.9);
                $font->color('#ffffff');
                $font->align('center');
                $font->valign('middle');
            });
        }

        $field_markings = $this->getFieldMarkings();
        $field_base->insert($field_markings);

        if ($isSnapshot) {
            $filename = public_path(self::OUTPUT_DIR . time() . ".png");
        } else {
            $filename = public_path(self::OUTPUT_DIR . 'current.png');
        }

        $this->log("Saving final Image ($filename)");
        $field_base->save($filename);
        $this->log("All finished!");
        return;
    }

    private function getFieldMarkings(): Image
    {
        $this->log("Building field markings");
        $lineWidth = $this->lineWidth;

        $field_markings = $this->manager->canvas($this->width, $this->height);

        //Draw penalty Boxes
        $field_markings->rectangle(
            ($this->width / 2) - ((40.3 * self::IMAGE_SCALE) / 2),
            $this->height,
            ($this->width / 2) + ((40.3 * self::IMAGE_SCALE) / 2),
            $this->height - (16.5 * self::IMAGE_SCALE),
            function ($draw) use($lineWidth) {
                $draw->border($lineWidth, '#ffffff');
            });
        $field_markings->rectangle(
            ($this->width / 2) - ((40.3 * self::IMAGE_SCALE) / 2),
            0,
            ($this->width / 2) + ((40.3 * self::IMAGE_SCALE) / 2),
            16.5 * self::IMAGE_SCALE,
            function ($draw) use($lineWidth) {
                $draw->border($lineWidth, '#ffffff');
            });

        //Draw small Boxes
        $field_markings->rectangle(
            ($this->width / 2) - ((18.56 * self::IMAGE_SCALE) / 2),
            $this->height,
            ($this->width / 2) + ((18.56 * self::IMAGE_SCALE) / 2),
            $this->height - (5.5 * self::IMAGE_SCALE),
            function ($draw) use ($lineWidth) {
                $draw->border($lineWidth, '#ffffff');
            });
        $field_markings->rectangle(
            ($this->width / 2) - ((18.56 * self::IMAGE_SCALE) / 2),
            0,
            ($this->width / 2) + ((18.56 * self::IMAGE_SCALE) / 2),
            5.5 * self::IMAGE_SCALE,
            function ($draw) use($lineWidth) {
                $draw->border($lineWidth, '#ffffff');
            });

        //Penalty kick mark
        $field_markings->circle(0.3 * self::IMAGE_SCALE, $this->width / 2, 11 * self::IMAGE_SCALE, function ($draw) {
            $draw->background('#ffffff');
        });
        $field_markings->circle(0.3 * self::IMAGE_SCALE, $this->width / 2, $this->height - (11 * self::IMAGE_SCALE), function ($draw) {
            $draw->background('#ffffff');
        });

        //Penalty Kick arcs
        $field_markings->insert($this->drawPenaltyArcs(), 'top-left', 0,(int)(16.5 * self::IMAGE_SCALE));

        // draw center circle
        $field_markings->circle((9.15 * self::IMAGE_SCALE) * 2, $this->width / 2, $this->height / 2, function ($draw) use ($lineWidth) {
            $draw->border($lineWidth + 1, '#ffffff');
        });
        $field_markings->circle(0.4 * self::IMAGE_SCALE, $this->width / 2, $this->height / 2, function ($draw) {
            $draw->background('#ffffff');
        });

        //Half way line
        $field_markings->rectangle(0, ($this->height / 2) - ($lineWidth / 2), $this->width, ($this->height / 2) + ($lineWidth / 2), function ($draw) {
            $draw->background('#ffffff');
        });

        //Draw corner arcs
        $field_markings->circle((1 * self::IMAGE_SCALE) * 2, 0,0, function ($draw) use($lineWidth) {
            $draw->border($lineWidth, '#ffffff');
        });
        $field_markings->circle((1 * self::IMAGE_SCALE) * 2, $this->width,0, function ($draw) use($lineWidth) {
            $draw->border($lineWidth, '#ffffff');
        });
        $field_markings->circle((1 * self::IMAGE_SCALE) * 2, $this->width, $this->height, function ($draw) use($lineWidth) {
            $draw->border($lineWidth, '#ffffff');
        });
        $field_markings->circle((1 * self::IMAGE_SCALE) * 2, 0, $this->height, function ($draw) use($lineWidth) {
            $draw->border($lineWidth, '#ffffff');
        });

        //Outer lines
        $field_markings->rectangle(
            $lineWidth / 2,
            ($lineWidth / 2),
            $this->width - ($lineWidth / 2),
            $this->height - ($lineWidth / 2),
            function ($draw) use($lineWidth) {
                $draw->border($lineWidth, '#ffffff');
            });

        $this->log("Finished building field markings");
        return $field_markings;
    }

    private function drawPenaltyArcs(): Image
    {
        $arcs = $this->manager->canvas($this->width, $this->height);
        $lineWidth = $this->lineWidth;

        //top penalty shootout arcs
        $arcs->circle((9.15 * self::IMAGE_SCALE) * 2, $this->width / 2, 11 * self::IMAGE_SCALE, function ($draw) use($lineWidth) {
            $draw->border($lineWidth + 1, '#ffffff');
        });
        $arcs->circle((9.15 * self::IMAGE_SCALE) * 2, $this->width / 2, $this->height - (11 * self::IMAGE_SCALE), function ($draw) use($lineWidth) {
            $draw->border($lineWidth + 1, '#ffffff');
        });

        $arcs->crop(
            $this->width,
            (int)$this->height - ((16.5 * self::IMAGE_SCALE) * 2),
            0,
            (int)(16.5 * self::IMAGE_SCALE)
        );

        return $arcs;
    }

    private function ensureDir()
    {
        try {
            mkdir(self::OUTPUT_DIR);
        } catch (\Exception $e) {
            //All cool, dir already exists
        }
    }
}
