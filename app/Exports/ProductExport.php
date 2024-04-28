<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\ProductAdditionalField;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::with('additionalFields')->get();
        $store = collect();
        foreach($products as $product) {
            $additionalFields = $product->additionalFields->pluck('value', 'key')->toArray();
            $store->push(array_merge($product->toArray(),$additionalFields));
        }
        return $store;
    }
    public function headings(): array {
        
        $productHeadings = (new Product())->getFillable();
        $additionalFieldHeadings = ProductAdditionalField::distinct('key')->pluck('key')->toArray();
        $productHeadings[0] = "Внешний код"; 
        $productHeadings[1] = "Наименование";
        $productHeadings[2] = "Описание";
        $productHeadings[3] = "Цена:Цена продажи";
        $productHeadings[4] = "Скидка";

         return array_merge($productHeadings, $additionalFieldHeadings);
    }

}
