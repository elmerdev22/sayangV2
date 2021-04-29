<?php

namespace App\Imports;

use App\Model\Product;
use App\Model\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Utility;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        $partner  = Utility::auth_partner();
        $category = Category::where('slug','others')->first();
        
        $data                  = new Product();
        $data->partner_id      = $partner->id;
        $data->category_id     = $category->id;
        $data->name            = $row['product_name'];
        $data->description     = $row['description'];
        $data->reminders       = $row['reminders'];
        $data->regular_price   = $row['regular_price'];
        $data->buy_now_price   = $row['buy_now_price'];
        $data->lowest_price    = $row['lowest_price'];
        $data->slug            = Utility::generate_table_slug('Product', $row['product_name']);
        $data->weight          = $row['weight'];
        $data->length          = $row['length'];
        $data->width           = $row['width'];
        $data->height          = $row['height'];
        $data->shelf_life      = $row['shelf_life'];
        $data->key_token       = Utility::generate_table_token('Product');
        $data->paper_packaging = $row['paper_packaging'];
        $data->about_product   = $row['about_product'];
        $data->save();

    }
}
