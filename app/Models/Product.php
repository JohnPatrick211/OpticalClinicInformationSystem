<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Input;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;
    protected $table = 'tbl_product';

    public function readAllProduct()
    {

        return DB::table($this->table . ' as P')
            ->select("P.*", 'P.id as product_code',
                    'productname',
                    'reorder', 
                    'orig_price', 
                    'selling_price', 
                    'qty', 
                    'C.name as category',
                    'B.branchname'
                    )
            ->leftJoin('tbl_category as C', 'C.id', '=', 'P.category_id')
            ->leftJoin('tbl_branch as B', 'B.id', '=', 'P.branch_id')
            ->where('P.status', 1)
            ->where('P.branch_id', 1)
            ->get();
    }

    // public function readFastAndSlow($date_from,$date_to)
    // {
    //     $data = DB::table($this->table . ' as P')
    //         ->select("P.*", DB::raw('CONCAT(P.prefix, P.id) as product_code'),
    //                 'description',
    //                 'reorder', 
    //                 'orig_price', 
    //                 'selling_price', 
    //                 'P.qty', 
    //                 'U.name as unit', 
    //                 'S.supplier_name as supplier', 
    //                 'C.name as category',
    //                 'sales.qty as qty_purchased'
    //                 )
    //         ->leftJoin('supplier as S', 'S.id', '=', 'P.supplier_id')
    //         ->leftJoin('category as C', 'C.id', '=', 'P.category_id')
    //         ->leftJoin('unit as U', 'U.id', '=', 'P.unit_id')
    //         ->leftJoin('sales', 'sales.product_code', '=', DB::raw('CONCAT(P.prefix, P.id)'))
    //         ->whereBetween(DB::raw('DATE(sales.created_at)'), [$date_from, $date_to])
    //         ->distinct('sales.product_code')
    //         ->get();
    //     return $data;
    // }

    // public function readArchiveProduct($date_from, $date_to)
    // {
    //     return DB::table($this->table . ' as P')
    //         ->select("P.*", DB::raw('CONCAT(prefix, P.id) as product_code'),
    //                 'description',
    //                 'reorder', 
    //                 'orig_price', 
    //                 'selling_price', 
    //                 'qty', 
    //                 'U.name as unit', 
    //                 'S.supplier_name as supplier', 
    //                 'C.name as category',
    //                 'P.updated_at'
    //                 )
    //         ->leftJoin('supplier as S', 'S.id', '=', 'P.supplier_id')
    //         ->leftJoin('category as C', 'C.id', '=', 'P.category_id')
    //         ->leftJoin('unit as U', 'U.id', '=', 'P.unit_id')
    //         ->whereBetween(DB::raw('DATE(P.updated_at)'), [$date_from, $date_to])
    //         ->where('P.status', -1)
    //         ->get();
    // }

    // public function readProductByCategory($category_id)
    // {
    //     return DB::table($this->table . ' as P')
    //         ->select("P.*", DB::raw('CONCAT(prefix, P.id) as product_code'),
    //                 'description',
    //                 'reorder', 
    //                 'orig_price', 
    //                 'selling_price', 
    //                 'qty', 
    //                 'U.name as unit', 
    //                 'C.name as category'
    //                 )
    //         ->leftJoin('category as C', 'C.id', '=', 'P.category_id')
    //         ->leftJoin('unit as U', 'U.id', '=', 'P.unit_id')
    //         ->where('P.status', 1)
    //         ->where('P.category_id', $category_id)
    //         ->get();
    // }

    // public function seachProduct(Request $request) 
    // {
    //     $data = $request->all();
    //     $key = $data['search_key'];
    //     return DB::table('tbl_product as P', 'tbl_service as S')
    //     ->select("P.*", "S.*")
    //     ->where('P.status', 1)
    //     >where('S.status', 1)
    //     ->where('P.productname', 'LIKE', '%'.$key.'%')
    //     ->orWhere('S.servicename', 'LIKE', '%'.$key.'%')
    //     ->get();
    // }

    // public function readReorderBySupplier($supplier_id){
    //     return DB::table($this->table . ' as P')
    //         ->select("P.*", DB::raw('CONCAT(prefix, P.id) as product_code'),
    //                 'description',
    //                 'reorder', 
    //                 'qty', 
    //                 'U.name as unit', 
    //                 'S.supplier_name as supplier', 
    //                 'C.name as category'
    //                 )
    //         ->leftJoin('supplier as S', 'S.id', '=', 'P.supplier_id')
    //         ->leftJoin('category as C', 'C.id', '=', 'P.category_id')
    //         ->leftJoin('unit as U', 'U.id', '=', 'P.unit_id')
    //         ->where('P.status', 1)
    //         ->where('P.supplier_id', $supplier_id)
    //         ->whereColumn('P.reorder','>=', 'P.qty')
    //         ->get();
    // }
}
