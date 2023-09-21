<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('create-permissions', function(){
    $lists = [
                // ['type' => 'Product',
                // 'items' => [
                //     [
                //         'name' => 'product-list',
                //         'lable' => 'Manage'
                //     ],
                //     [
                //         'name' => 'product-create',
                //         'lable' => 'Create'
                //     ],
                //     [
                //         'name' => 'product-edit',
                //         'lable' => 'Edit'
                //     ],
                //     [
                //         'name' => 'product-delete',
                //         'lable' => 'Delete'
                //     ]
                // ]],
                ['type' => 'Category',
                'items' => [
                    [
                        'name' => 'category-list',
                        'lable' => 'Manage Category'
                    ],
                    [
                        'name' => 'category-create',
                        'lable' => 'Category Create'
                    ],
                    [
                        'name' => 'category-edit',
                        'lable' => 'Category Edit'
                    ],
                    [
                        'name' => 'category-delete',
                        'lable' => 'Category Delete'
                    ]
                ]],
                ['type' => 'Brand',
                'items' => [
                    [
                        'name' => 'brand-list',
                        'lable' => 'Manage Brand'
                    ],
                    [
                        'name' => 'brand-create',
                        'lable' => 'Brand Create'
                    ],
                    [
                        'name' => 'brand-edit',
                        'lable' => 'Brand Edit'
                    ],
                    [
                        'name' => 'brand-delete',
                        'lable' => 'Brand Delete'
                    ]
                ]]
            ];
    foreach($lists as $list) {
        // print_r($list);die;
        $parent = Permission::where('lable', $list['type'])->first();
        if(!$parent) {
            $parent = new Permission();
            $parent->lable = $list['type'];
            $parent->guard_name = 'web';
            $parent->save();
        }

        // foreach($list['items'] as $item) {
        //     $child = Permission::where('name', $item['name'])->first();
        //     if(!$child) {
        //         $child = new Permission();
        //         $child->lable = $item['lable'];
        //         $child->name = $item['name'];
        //         $child->parent_id = $parent->id;
        //         $child->guard_name = 'web';
        //         $child->save();
        //     }
        // }
    }
});


