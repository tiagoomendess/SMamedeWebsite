<?php

namespace App\Services;

use App\FieldPurchaser;
use Illuminate\Support\Facades\DB;

class TurfProjectService
{
    public function getTopBuyers(): array
    {
        $fieldPurchases = DB::table('field_purchases')
            ->groupBy('field_purchaser_id')
            ->orderBy('meters', 'desc')
            ->limit(10)
            ->get([
                DB::raw('count(1) as meters'),
                'field_purchaser_id'
            ]);

        $topBuyers = [];
        foreach ($fieldPurchases as $fieldPurchase) {
            $topBuyers[] = [
                'field_purchaser' => FieldPurchaser::find($fieldPurchase->field_purchaser_id),
                'meters' => $fieldPurchase->meters
            ];
        }

        return $topBuyers;
    }
}
