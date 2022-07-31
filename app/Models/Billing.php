<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Billing extends Model
{
    use HasFactory;
    protected $table = 'tbl_billingtray';

    public function readCashieringTray(){
        return DB::table('tbl_billingtray as C')
            ->select("C.*", 'S.*' ,'S.selling_price as selling_price2','P.*','C.qty as qty_order', 'C.id as id')
            ->leftJoin('tbl_product as P', 'C.product_id', '=', 'P.id')
            ->leftJoin('tbl_service as S', 'C.product_id', '=', 'S.id')
            ->get();
    }

    public function readTotalAmount(){
        return $this->max();
    }
}
