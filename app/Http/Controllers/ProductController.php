<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Exports\ProductExport;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAdditionalField;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    //
    public function index()
    {
        
        $products = Product::with('additionalFields')->get();
        $stores = collect();
        foreach($products as $product) {
            $additionalFields = $product->additionalFields->pluck('value', 'key')->toArray();
            $stores->push(array_merge($product->toArray(),$additionalFields));
        }
        $productHeadings = (new Product())->getFillable();
        $additionalFieldHeadings = ProductAdditionalField::distinct('key')->pluck('key')->toArray();
        $names = array_merge($productHeadings, $additionalFieldHeadings);
         return view('index', compact('names','stores','products'));
    }
        
        public function show($id)
        {
        $products = Product::findOrFail($id);
        $fields = $products->additionalFields;
        $images = $products->images;
        $fields = $fields->pluck('value', 'key')->toArray();
        unset($fields['seo h1']);
        $productHeadings = (new Product())->getFillable();
        $additionalFieldHeadings = ProductAdditionalField::distinct('key')->pluck('key')->toArray();
        $names = array_merge($productHeadings, $additionalFieldHeadings);
         return view('show', compact('names','fields','products','images'));
    }

    public function showForm()
    {
        return view('import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        ini_set('max_execution_time',3600);
        try {
            // Попытка вставки данных
            Excel::import(new ProductImport, $request->file('file'));
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Обработка ошибки дубликата уникального ключа
                return redirect()->route('import')->withErrors('Такой товар уже существует.');
            } else {
                // Обработка других ошибок
                return redirect()->back()->withErrors('Произошла ошибка при обработке запроса.');
            }
        }
        return redirect()->route('products.index')->with('success', 'Товары успешно импортированы.');
    }

    public function export() {
            
            return Excel::download(new ProductExport(),'Export.xlsx');
  
    }
}