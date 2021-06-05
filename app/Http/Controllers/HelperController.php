<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\City;
use App\Models\MetaKeyword;
use App\Models\ProductVariation;
use App\Models\State;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller {

    /**
     * @name select2MetaKeywords
     * 
     */
    public function select2MetaKeywords ( Request $request) {
        $metaKeywords = MetaKeyword::select('name as id', 'name as text');
        if( $request->has('search' ) ){
            $metaKeywords = $metaKeywords->where('name', 'like', '%'. $request->get('search' ) . '%');
        }
        $metaKeywords = $metaKeywords->simplePaginate( 12 );
        $data = [
            'data' => $metaKeywords->items(),
            'hasMorePage' => $metaKeywords->hasMorePages(),
        ];

        return response()->json( $data, 200 );

    }

    /**
     * @name select2Category
     * 
     */
    public function select2Category ( Request $request) {
        $grandParentName = 'IF( grand_parent_category.name IS NOT NULL, CONCAT( grand_parent_category.name, " => ") ,"") ';
        $parentName = 'IF( parent_category.name IS NOT NULL, CONCAT( parent_category.name, " => " ), "" )';
        $categoryName = 'category.name';
        $nameText = 'CONCAT( '.$grandParentName.',' . $parentName . ', '. $categoryName . ')';
        $category = Category::select(
                                    'category.id', 
                                    DB::raw( $nameText. ' as text' )
                                )
                                ->joinParentCategory()
                                ->joinGrandParentCategory();

        if( $request->has('id' ) && !empty( $request->get('id') ) ){
            $category = $category->where('category.id', '!=', $request->get('id') );
        }

        if( $request->has('search' ) ){
            $category = $category->having( DB::raw('text'), 'like', '%'. $request->get('search' ) . '%');
        }

        $category = $category->orderBy('text')->simplePaginate( 12 );

        $data = [
            'data' => $category->items(),
            'hasMorePage' => $category->hasMorePages(),
        ];

        return response()->json( $data, 200 );

    }

    
    /**
     * @name select2Attributes
     * 
     */
    public function select2Attributes ( Request $request) {
        $selectedAttr = $request->get('selected');
        if( is_array( $selectedAttr ) ){
            $selectedAttr = implode(',', $selectedAttr);
        }else{
            $selectedAttr = '';

        }
        $attributes = Attribute::select(
                                    'id', 
                                    'name as text',
                                    DB::raw('CASE WHEN FIND_IN_SET( id, "' . $selectedAttr .'") != 0 THEN true ELSE false END as disabled' )
                                );
        if( $request->has('search' ) ){
            $attributes = $attributes->where('name', 'like', '%'. $request->get('search' ) . '%');
        }
        $attributes = $attributes->simplePaginate( 30 );
        $data = [
            'data' => $attributes->items(),
            'hasMorePage' => $attributes->hasMorePages(),
        ];

        return response()->json( $data, 200 );

    }
    
    /**
     * @name select2AttributeValues
     * 
     */
    public function select2AttributeValues ( Request $request) {
        $attributeValues = AttributeValue::select(
                                'id', 
                                'attr_value as text'
                            )
                            ->where('attr_id', $request->get('attr_id'));
        if( $request->has('search' ) ){
            $attributeValues = $attributeValues->where('attr_value', 'like', '%'. $request->get('search' ) . '%');
        }
        $attributeValues = $attributeValues->simplePaginate( 30 );
        $data = [
            'data' => $attributeValues->items(),
            'hasMorePage' => $attributeValues->hasMorePages(),
        ];

        return response()->json( $data, 200 );

    }
    
    /**
     * @name select2VariationSku
     * 
     */
    public function select2VariationSku ( Request $request) {
        $productionVariationSkus = ProductVariation::select(
                                'id', 
                                'sku as text'
                            )
                            ->notDeleted()
                            ->where('product_id', $request->get('product_id'));
        if( $request->has('search' ) ){
            $productionVariationSkus = $productionVariationSkus->where('sku', 'like', '%'. $request->get('search' ) . '%');
        }
        $productionVariationSkus = $productionVariationSkus->simplePaginate( 30 );
        $data = [
            'data' => $productionVariationSkus->items(),
            'hasMorePage' => $productionVariationSkus->hasMorePages(),
        ];

        return response()->json( $data, 200 );

    }
    
    /**
     * @name select2ProductAttributeValues
     * 
     */
    public function select2ProductAttributeValues ( Request $request) {
        $attributeValues = AttributeValue::select(
                                'attribute_values.id', 
                                'attribute_values.attr_value as text'
                            )
                            ->join('product_attrs', 'product_attrs.attr_val_id', '=', 'attribute_values.id')
                            ->where('product_attrs.product_id', $request->get('product_id'))
                            ->where('product_attrs.attr_id', $request->get('attr_id'))
                            ->groupBy('attribute_values.id');
        if( $request->has('search' ) ){
            $attributeValues = $attributeValues->where('attribute_values.attr_value', 'like', '%'. $request->get('search' ) . '%');
        }
        $attributeValues = $attributeValues->simplePaginate( 30 );
        $data = [
            'data' => $attributeValues->items(),
            'hasMorePage' => $attributeValues->hasMorePages(),
        ];

        return response()->json( $data, 200 );

    }
    
    /**
     * @name select2AreaData
     * 
     */
    public function select2AreaData ( Request $request) {
        $city = $request->get('city_id');
        if( !empty( $city ) ){
            $city = City::where('name', $city)->first();
        }

        $areas = Area::select(
                                'name as id', 
                                'name as text'
                            )
                            ->active();
        if( $request->has('search' ) ){
            $areas = $areas->where('name', 'like', '%'. $request->get('search' ) . '%');
        }
        if( !empty( $city ) ){
            $areas = $areas->where('city_id', $city->id );
        }
        $areas = $areas->simplePaginate( 30 );
        $areas->getCollection()->transform(function( $i ){
            $i->incrementing = false;
            return $i;
        });
        $data = [
            'data' => $areas->items(),
            'hasMorePage' => $areas->hasMorePages(),
        ];

        return response()->json( $data, 200 );

    }
    
    /**
     * @name select2CityData
     * 
     */
    public function select2CityData ( Request $request) {
        $state = $request->get('state_id');
        if( !empty( $state ) ){
            $state = State::where('name', $state)->first();
        }
        $cityData = City::select(
                                'name as id', 
                                'name as text'
                            )
                            ->active();
        if( $request->has('search' ) ){
            $cityData = $cityData->where('name', 'like', '%'. $request->get('search' ) . '%');
        }
        if( !empty( $state ) ){
            $cityData = $cityData->where('state_id', $state->id );
        }
        $cityData = $cityData->simplePaginate( 30 );
        $cityData->getCollection()->transform(function( $i ){
            $i->incrementing = false;
            return $i;
        });
        $data = [
            'data' => $cityData->items(),
            'hasMorePage' => $cityData->hasMorePages(),
        ];

        return response()->json( $data, 200 );

    }
    
    /**
     * @name select2StateData
     * 
     */
    public function select2StateData ( Request $request) {
      
        $stateData = State::select(
                                'name as id', 
                                'name as text'
                            )
                            ->active();
        if( $request->has('search' ) ){
            $stateData = $stateData->where('name', 'like', '%'. $request->get('search' ) . '%');
        }
        $stateData = $stateData->simplePaginate( 30 );
        $stateData->getCollection()->transform(function( $i ){
            $i->incrementing = false;
            return $i;
        });
        $data = [
            'data' => $stateData->items(),
            'hasMorePage' => $stateData->hasMorePages(),
        ];

        return response()->json( $data, 200 );

    }
    
    /**
     * @name select2SuppliersData
     * 
     */
    public function select2SuppliersData ( Request $request) {
      
        $stateData = Supplier::select(
                                'id', 
                                'name',
                                'email',
                                'mobile',
                                'locality'
                            )
                            ->active();
        if( $request->has('search' ) ){
            $stateData = $stateData->where('name', 'like', '%'. $request->get('search' ) . '%');
        }
        $stateData = $stateData->simplePaginate( 30 );
        $stateData->getCollection()->transform(function( $i ){
            
            $i->text = $i->text_select2;
            return $i;
        });
        $data = [
            'data' => $stateData->items(),
            'hasMorePage' => $stateData->hasMorePages(),
        ];

        return response()->json( $data, 200 );

    }
}