<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            '*.product_name' => 'required|string',
            '*.product_qty' => 'required|integer|min:1'
        ]);

        $products = $request->post();
        $wareHouseMaterials = Warehouse::all();

        $results = [];

        foreach ($products as $product) {
            $prod = Product::query()->where(['name' => $product['product_name']])->first();
            $prodMaterials = ProductMaterial::query()->where(['product_id' => $prod->id])->get();
            $productMaterials = [];

            foreach ($prodMaterials as $prodMaterial) {
                $overallQuantity = ($prodMaterial->quantity) * $product['product_qty'];
                $whMaterials = [];
                foreach ($wareHouseMaterials as $wareHouseMaterial) {
                    if ($wareHouseMaterial->material_id === $prodMaterial->material_id) {
                        array_push($whMaterials, $wareHouseMaterial);
                    }
                }
                foreach ($whMaterials as $whMaterial) {
                    if ($whMaterial->id == null) {
                        continue;
                    }
                    if ($whMaterial->remainder > $overallQuantity) {
                        $productMaterials[] = [
                            'warehouse_id' => $whMaterial->id,
                            'material_name' => $prodMaterial->material->name,
                            'qty' => $overallQuantity,
                            'price' => $whMaterial->price
                        ];
                        foreach ($wareHouseMaterials as $wareHouseMaterial) {
                            if ($wareHouseMaterial->id == $whMaterial->id) {
                                $wareHouseMaterial->remainder = $whMaterial->remainder - $overallQuantity;
                            }
                        }
                        break;
                    } else {
                        $productMaterials[] = [
                            'warehouse_id' => $whMaterial->id,
                            'material_name' => $prodMaterial->material->name,
                            'qty' => $whMaterial->remainder,
                            'price' => $whMaterial->price
                        ];
                        $overallQuantity = $overallQuantity - $whMaterial->remainder;
                        foreach ($wareHouseMaterials as $wareHouseMaterial) {
                            if ($wareHouseMaterial->id == $whMaterial->id) {
                                $wareHouseMaterial->id = null;
                            }
                        }
                    }

                    if ($whMaterial->remainder < $overallQuantity) {
                        $productMaterials[] = [
                            'warehouse_id' => null,
                            'material_name' => $prodMaterial->material->name,
                            'qty' => $overallQuantity,
                            'price' => null
                        ];
                    }
                }
            }

            if (!empty($productMaterials)) {
                $product['product_materials'] = $productMaterials;
            }

            $results[] = $product;
        }

        return response()->json([
            'result' => $results
        ]);
    }
}
