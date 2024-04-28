<?php

namespace App\Imports;

// use Illuminate\Support\Collection;
// use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAdditionalField;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $product = new Product([
            
            'external_code' => $row['Внешний код'],
            'name' => $row['Наименование'],
            'description' => $row['Описание'],
            'price' => str_replace(',','.',$row['Цена: Цена продажи']),
            'discount' => 0,
        ]);

        // Сохраняем товар
        $product->save();

                // Обработка дополнительных полей (k, v)
                foreach ($row as $key => $value) {
                    if (strpos($key, 'Доп. поле: ') === 0) {
                        if(empty($value)) {
                            $value = ' ';
                        }
                        $attribute = substr($key, strlen('Доп. поле: '));
                        $prod = new ProductAdditionalField();
                        $prod->product_id = $product->id;
                        $prod->key = $attribute;
                        $prod->value = $value;
                        $prod->save();
                        if($attribute=="Ссылки на фото") {
                            $img_urls = explode(', ',$value);
                            $this->saveImages($product->id, $img_urls);
                        }
                    }
                }
        
                // return $product;
    }

    public function saveImages($product_id, $img_urls) {
        foreach($img_urls as $url) {
            $response = Http::get($url);    
            if($response->successful()) {
                $filename = basename($url);
                $filepath = 'images/' . $filename;
                Storage::disk('public')->put($filepath, $response->body());
                $product = new ProductImage();
                    $product->product_id = $product_id;
                    $product->url = $url;
                    $product->path = $filepath;
                    $product->save();
                // return response()->json(['path'=> 'storage/images' . $filename],200);
            } else continue;
        }
    }
}
