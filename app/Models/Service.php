<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasFactory;
    protected $table = 'tbl_service';

    public function readAllService()
    {
        return DB::table($this->table . ' as P')
            ->select("P.*", 'P.id as service_code',
                    'servicename',
                    'orig_price', 
                    'selling_price',
                    'B.branchname' 
                    )
            ->leftJoin('tbl_branch as B', 'B.id', '=', 'P.branch_id')
            ->where('P.status', 1)
            ->where('P.branch_id', 1)
            ->get();
    }
}
