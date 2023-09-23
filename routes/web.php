<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSkuController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\DistributorController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UnitTypeController;
use App\Http\Controllers\Admin\ReviewController;


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Admin\Customer\SaleController as CustomerSaleController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\CartController as FrontendCartController;
use App\Http\Controllers\Frontend\CustomerAuthController;
use App\Http\Controllers\Frontend\Customer\AddressController as CustomerAddressController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\Customer\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\MaterialInwardController;

use App\Http\Controllers\Admin\SupplierBillController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\Admin\FrontendMenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FolloweUpController;
use App\Http\Controllers\Admin\TempOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Spatie\Permission\Models\Permission;


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

        foreach($list['items'] as $item) {
            $child = Permission::where('name', $item['name'])->first();
            if(!$child) {
                $child = new Permission();
                $child->lable = $item['lable'];
                $child->name = $item['name'];
                $child->parent_id = $parent->id;
                $child->guard_name = 'web';
                $child->save();
            }
        }
    }
});


Route::get('index', [CustomAuthController::class, 'dashboard']);
Route::get('signin', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customSignin'])->name('signin.custom');
Route::get('signup', [CustomAuthController::class, 'registration'])->name('signup');
Route::post('custom-register', [CustomAuthController::class, 'customSignup'])->name('signup.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('scanner', function () {
    return view('admin.sales.scanner');
});

//this is admin.
Route::group(['prefix' => 'admin', 'namespance' => 'Admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');


    Route::get('pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('pages/store', [PageController::class, 'store'])->name('pages.store');

    Route::get('pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::post('pages/{id}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('pages/{id}', [PageController::class, 'destroy'])->name('pages.delete');

    Route::get('frontend-menu', [FrontendMenuController::class, 'index'])->name('frontend-menu.index');
    Route::get('frontend-menu/create', [FrontendMenuController::class, 'create'])->name('frontend-menu.create');
    Route::get('frontend-menu/show/{id}', [FrontendMenuController::class, 'show'])->name('frontend-menu.show');
    Route::get('frontend-menu/edit/{id}', [FrontendMenuController::class, 'edit'])->name('frontend-menu.edit');
    Route::put('frontend-menu/update/{id}', [FrontendMenuController::class, 'update'])->name('frontend-menu.update');
    Route::post('menus/MenuNodeStore', [FrontendMenuController::class, 'MenuNodeStore'])->name('frontend-menus.MenuNodeStore');

    Route::post('frontend-menu/store', [FrontendMenuController::class, 'store'])->name('frontend-menu.store');
    Route::post('frontend-menu/destroy', [FrontendMenuController::class, 'destroy'])->name('frontend-menu.destroy');
    Route::post('frontend-menu-upload-media', [FrontendMenuController::class, 'uploadMedia'])->name('frontend-menu.upload-media');



    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');



    Route::get('sub-category', [SubCategoryController::class, 'index'])->name('sub-category.index');
    Route::get('sub-category/create', [SubCategoryController::class, 'create'])->name('sub-category.create');
    Route::post('sub-category/store', [SubCategoryController::class, 'store'])->name('sub-category.store');
    Route::get('sub-category/edit/{id}', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
    Route::post('sub-category/update/{id}', [SubCategoryController::class, 'update'])->name('sub-category.update');
    Route::get('filter-sub-category', [SubCategoryController::class, 'filterSubCategory'])->name('filter-sub-category');
    Route::delete('sub-category/{id}', [CategoryContSubCategoryControllerroller::class, 'destroy'])->name('sub-category.delete');



    Route::get('department', [DepartmentController::class, 'index'])->name('department.index');
    Route::get('department/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('department/store', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('department/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('department/{id}', [DepartmentController::class, 'destroy'])->name('department.delete');
    Route::get('permission/{id}', [PermissionController::class, 'show'])->name('permission.index');
    Route::patch('permission/{id}', [PermissionController::class, 'update'])->name('permission.update');

    Route::resource('unit-type', UnitTypeController::class);

    Route::resource('menu', MenuController::class);
    Route::post('menu/update/{id}', [MenuController::class, 'update'])->name('menus.update');

    Route::resource('role', RoleController::class);
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');


    Route::get('brand', [BrandController::class, 'index'])->name('brand.index');
    Route::get('brand/create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::post('brand/import', [BrandController::class, 'fileImport'])->name('brand.import');
    Route::delete('brand/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
    Route::get('filter-sub-brand', [BrandController::class, 'filterSubBrand'])->name('filter-sub-brand');



    Route::get('attribute', [AttributeController::class, 'index'])->name('attribute.index');
    Route::get('attribute/create', [AttributeController::class, 'create'])->name('attribute.create');
    Route::post('attribute/store', [AttributeController::class, 'store'])->name('attribute.store');
    Route::get('attribute/edit/{id}', [AttributeController::class, 'edit'])->name('attribute.edit');
    Route::post('attribute/update/{id}', [AttributeController::class, 'update'])->name('attribute.update');
    Route::get('filter-attribute', [AttributeController::class, 'filterAttribute'])->name('filter-attribute');




    Route::get('product', [ProductController::class, 'index'])->name('product.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::post('multiple-product/store', [ProductController::class, 'multipleProductStore'])->name('multiple-product.store');
    Route::get('product-multiple', [ProductController::class, 'multipleProductIndex'])->name('multiple-products');
    Route::get('render-multiple-product', [ProductController::class, 'renderMultipleProduct'])->name('render.multiple-products');
    Route::get('import-product', [ProductController::class, 'importIndex'])->name('import-products');
    Route::post('import-product-store', [ProductController::class, 'importProduct'])->name('import-product.store');

    Route::get('search-product', [ProductController::class, 'searchProduct'])->name('search-product');
    Route::get('search-product-for-transer', [ProductController::class, 'searchProductForTranser'])->name('search-product.for.tansfer');

    Route::get('variant-template', [ProductController::class, 'getVariantTemplate'])->name('variant-template');

    Route::get('product-multiple-variant/{id}/{type?}', [ProductController::class, 'getMultipleVariant'])->name('product-multiple-variant');

    Route::get('product-multiple-variant-template/{id}', [ProductController::class, 'getMultipleVariantTemplate'])->name('product-multiple-variant-template');




    Route::get('product-sku/{product_id}', [ProductSkuController::class, 'index'])->name('sku.index');
    Route::get('product-sku/{product_id}/create', [ProductSkuController::class, 'create'])->name('sku.create');
    Route::post('product-sku/{product_id}/store', [ProductSkuController::class, 'store'])->name('sku.store');
    Route::get('product-sku/{product_id}/edit/{id}', [ProductSkuController::class, 'edit'])->name('sku.edit');
    Route::post('product-sku/{product_id}/update/{id}', [ProductSkuController::class, 'update'])->name('sku.update');
    // Route::get('sku/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('product-sku', [ProductSkuController::class, 'getSkuDetails'])->name('get-sku.details');
    Route::post('add-product-variants/{product_id}', [ProductSkuController::class, 'addMultipleVariants'])->name('add-product-variants');

    Route::post('update-product-variants/{product_id}', [ProductSkuController::class, 'updateMultipleVariants'])->name('update-product-variants');




    Route::get('state', [StateController::class, 'index'])->name('state.index');
    Route::get('state/create', [StateController::class, 'create'])->name('state.create');
    Route::post('state/store', [StateController::class, 'store'])->name('state.store');
    Route::get('state/edit/{id}', [StateController::class, 'edit'])->name('state.edit');
    Route::post('state/update/{id}', [StateController::class, 'update'])->name('state.update');


    Route::get('city', [CityController::class, 'index'])->name('city.index');
    Route::get('city/create', [CityController::class, 'create'])->name('city.create');
    Route::post('city/store', [CityController::class, 'store'])->name('city.store');
    Route::get('city/edit/{id}', [CityController::class, 'edit'])->name('city.edit');
    Route::post('city/update/{id}', [CityController::class, 'update'])->name('city.update');
    Route::get('filter-city', [CityController::class, 'filterCity'])->name('filter-city');



    Route::get('supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('supplier/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::post('supplier/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.delete');
    Route::get('supplierreport', [SupplierController::class, 'supplierReport'])->name('supplierreport');
    Route::get('get-supplier_data', [SupplierController::class, 'getSupplierData'])->name('get-supplier-data');


    Route::get('distributor', [DistributorController::class, 'index'])->name('distributor.index');
    Route::get('distributor/create', [DistributorController::class, 'create'])->name('distributor.create');
    Route::post('distributor/store', [DistributorController::class, 'store'])->name('distributor.store');
    Route::get('distributor/edit/{id}', [DistributorController::class, 'edit'])->name('distributor.edit');
    Route::post('distributor/update/{id}', [DistributorController::class, 'update'])->name('distributor.update');
    Route::delete('distributor/{id}', [DistributorController::class, 'destroy'])->name('distributor.delete');



    Route::get('store', [StoreController::class, 'index'])->name('store.index');
    Route::get('store/create', [StoreController::class, 'create'])->name('store.create');
    Route::post('store/store', [StoreController::class, 'store'])->name('store.store');
    Route::get('store/edit/{id}', [StoreController::class, 'edit'])->name('store.edit');
    Route::post('store/update/{id}', [StoreController::class, 'update'])->name('store.update');
    Route::delete('store/{id}', [StoreController::class, 'destroy'])->name('store.delete');
    Route::get('store/show/{id}', [StoreController::class, 'inventoryIndex'])->name('store.show');


    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::get('customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::post('customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');


    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('purchase/pdf/{id}', [PurchaseController::class, 'invoicePdf'])->name('purchase.pdf');

    Route::get('purchase/{id}/edit', [PurchaseController::class, 'edit'])->name('purchase.edit');

    Route::get('purchase', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::get('purchase/create', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::post('purchase/store', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('purchase/{id}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::get('purchase-product-form', [PurchaseController::class, 'getPurchaseItem'])->name('purchase-product-form');
    Route::get('import-purchase', [PurchaseController::class, 'importIndex'])->name('import-purchase');
    Route::post('import-purchase-data', [PurchaseController::class, 'importProduct'])->name('import-purchase.data');
    Route::post('purchase-transaction', [PurchaseController::class, 'purchaseTransaction'])->name('purchase-transaction');
    Route::post('purchase/{id}', [PurchaseController::class, 'update'])->name('purchase.update');
    Route::delete('purchase/{id}/delete', [PurchaseController::class, 'destroy'])->name('purchase.delete');

    Route::get('purchase/return/create', [PurchaseController::class, 'returnCreate'])->name('purchase.return.create');
    Route::get('purchase-return', [PurchaseController::class, 'returnIndex'])->name('purchase.return.index');
    Route::post('purchase/return/update/{order_id}', [PurchaseController::class, 'returnUpdate'])->name('return.purchase.product');
    Route::get('purchase/return/edit/{id}', [PurchaseController::class, 'returnEdit'])->name('purchase.return.edit');
    Route::post('purchase/return/update-item/{id}', [PurchaseController::class, 'returnUpdateitem'])->name('purchase.return.update-item');
    Route::get('purchasereport', [PurchaseController::class, 'purchaseReport'])->name('purchasereport');

    Route::get('get-purchase-data', [PurchaseController::class, 'getPurchaseData'])->name('get-purchase-data');



    Route::get('supplier-payments/{id}', [PurchaseController::class, 'getPayments'])->name('supplier.payments');
    Route::get('inward/pdf/{id}', [MaterialInwardController::class, 'invoicePdf'])->name('material-inward.pdf');

    Route::resource('material-inward', MaterialInwardController::class);
    Route::post('supplier-transaction', [SupplierBillController::class, 'supplierBillTransaction'])->name('supplier-transaction');
    Route::get('supplier-bills/{id}/{type}',  [SupplierBillController::class, 'supplierBillDetails'])->name('supplierBillDetails');

    Route::resource('supplier-bills', SupplierBillController::class);
    Route::get('get-inward-data', [PurchaseController::class, 'getInwardData'])->name('get-inward-data');


    Route::get('transfer', [TransferController::class, 'index'])->name('transfer.index');
    Route::get('transfer/create', [TransferController::class, 'create'])->name('transfer.create');
    Route::post('transfer/store', [TransferController::class, 'store'])->name('transfer.store');
    Route::get('transfer/{id}', [TransferController::class, 'show'])->name('transfer.show');
    Route::get('transfer-product-form', [TransferController::class, 'getTransferItem'])->name('transfer-product-form');
    Route::get('import-transfer', [TransferController::class, 'importIndex'])->name('import-transfer');
    Route::post('import-transfer-data', [TransferController::class, 'importProduct'])->name('import-transfer.data');


    Route::get('sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('pos', [SalesController::class, 'create'])->name('sales.create');
    Route::get('sales-products', [SalesController::class, 'getProducts'])->name('sales-products');
    Route::post('add-to-cart', [SalesController::class, 'addToCart'])->name('sales-add-to-cart');
    Route::post('update-add-to-cart', [SalesController::class, 'updateAddToCart'])->name('sales-update-add-to-cart');
    Route::delete('delete-add-to-cart', [SalesController::class, 'deleteAddToCart'])->name('sales-delete-add-to-cart');
    Route::post('place-order', [SalesController::class, 'placeOrder'])->name('place-order');
    Route::get('sales/{order_id}', [SalesController::class, 'show'])->name('sales.show');
    Route::post('update-to-cart-price', [SalesController::class, 'updateAddToCartPrice'])->name('sales-update-to-cart-price');
    Route::post('order-transaction', [SalesController::class, 'orderTransaction'])->name('order-transaction');


    Route::get('invoice/{order_id}', [SalesController::class, 'invoice'])->name('sales.invoice');
    Route::get('sale/return/create', [SalesController::class, 'returnCreate'])->name('sales.return.create');
    Route::get('sale/return', [SalesController::class, 'returnIndex'])->name('sales.return.index');
    Route::post('sale/return/update/{order_id}', [SalesController::class, 'returnUpdate'])->name('return.sale.product');
    Route::get('sale/return/edit/{id}', [SalesController::class, 'returnEdit'])->name('sales.return.edit');
    Route::post('sale/return/update-item/{id}', [SalesController::class, 'returnUpdateitem'])->name('sales.return.update-item');

    Route::get('sales-report', [SalesController::class, 'report'])->name('sales.report');
    Route::get('sales-payments/{id}', [SalesController::class, 'getPayments'])->name('sales.payments');






    Route::get('inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('inventory/edit/{id}', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::post('inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
    Route::get('product-inventory/{product_id}', [InventoryController::class, 'index'])->name('product-inventory');
    Route::get('product-inventory/{product_id}/create', [InventoryController::class, 'create'])->name('product-inventory.create');
    Route::post('product-inventory/{product_id}', [InventoryController::class, 'store'])->name('product-inventory.store');


    Route::get('expense-category', [ExpenseCategoryController::class, 'index'])->name('expense-category.index');
    Route::get('expense-category/create', [ExpenseCategoryController::class, 'create'])->name('expense-category.create');
    Route::post('expense-category', [ExpenseCategoryController::class, 'store'])->name('expense-category.store');
    Route::get('expense-category/edit/{id}', [ExpenseCategoryController::class, 'edit'])->name('expense-category.edit');
    Route::post('expense-category/{id}', [ExpenseCategoryController::class, 'update'])->name('expense-category.update');

    Route::get('customer-sales', [CustomerSaleController::class, 'index'])->name('customer-sales.index');
    Route::get('customer-sales/create', [CustomerSaleController::class, 'create'])->name('customer-sales.create');

    Route::post('customer-place-order', [CustomerSaleController::class, 'placeOrder'])->name('customer-place-order');

    Route::get('customer-order-products', [CustomerSaleController::class, 'getProducts'])->name('customer-order-products');


    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::get('order-invoice/{id}', [AdminOrderController::class, 'invoice'])->name('order-invoice');
    Route::post('orders/{id}', [AdminOrderController::class, 'update'])->name('orders.update');
    Route::post('orders/{id}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');


    Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('banners/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('banners', [BannerController::class, 'store'])->name('banners.store');
    Route::get('banners/{id}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::post('banners/{id}', [BannerController::class, 'update'])->name('banners.update');
    Route::delete('banners/{id}/delete', [BannerController::class, 'destroy'])->name('banners.destroy');

    Route::get('faqs', [FaqController::class, 'index'])->name('faqs.index');
    Route::get('faqs/create', [FaqController::class, 'create'])->name('faqs.create');
    Route::post('faqs', [FaqController::class, 'store'])->name('faqs.store');
    Route::get('faqs/{id}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
    Route::post('faqs/{id}', [FaqController::class, 'update'])->name('faqs.update');
    Route::delete('faqs/{id}/delete', [FaqController::class, 'destroy'])->name('faqs.destroy');



    Route::get('customer-follow-up', [FolloweUpController::class, 'index'])->name('customer-follow-up.index');
    Route::post('customer-followup-save', [FolloweUpController::class, 'save_notes'])->name('customer.customerFollowUp.save');
    Route::post('customer-followup-view', [FolloweUpController::class, 'view_notes'])->name('customer.customerFollowUp.view');

    Route::post('order-followup-save', [FolloweUpController::class, 'save_notes'])->name('store.orderFollowUp.save');
    Route::post('order-followup-view', [FolloweUpController::class, 'view_notes'])->name('store.orderFollowUp.view');

    Route::get('temp-orders', [TempOrderController::class, 'index'])->name('temp-orders.index');
    Route::get('temp-orders/create', [TempOrderController::class, 'create'])->name('temp-orders.create');
    Route::post('temp-orders', [TempOrderController::class, 'store'])->name('temp-orders.store');

    
});

//this is for frontend.
Route::group(['namespance' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', [FrontendController::class, 'home'])->name('home');
    // Route::get('/about-us', [FrontendController::class, 'about'])->name('about');
    Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
    Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
    Route::get('/thanks', [FrontendController::class, 'thanks'])->name('thanks');
    Route::get('/failed', [FrontendController::class, 'paymentFailed'])->name('payment_failed');
    Route::get('/faqs', [FrontendController::class, 'faq'])->name('faqs');

    Route::get('search-product', [FrontendProductController::class, 'searchProduct'])->name('search-product');

    Route::get('get-variant-details', [FrontendProductController::class, 'getVariantDetails'])->name('get-variant-details');


    Route::post('post_review', [FrontendProductController::class, 'addReview'])->name('post_review');

    Route::get('get_shop_products', [FrontendProductController::class, 'getShopProducts'])->name('get_shop_products');
    Route::get('product-quick-view/{product_id}', [FrontendProductController::class, 'quickView'])->name('product-quick-view');
    
    //Product Detail Page
    Route::get('product/{product_slug}', [FrontendProductController::class, 'product'])->name('product-details');

    Route::post('add-to-cart', [FrontendCartController::class, 'create'])->name('add-to-cart');
    Route::post('update-cart', [FrontendCartController::class, 'update'])->name('update-cart');
    Route::get('delete-cart/{cart_id}', [FrontendCartController::class, 'destroy'])->name('delete-cart');
    Route::get('filter-city', [CustomerAddressController::class, 'filterCity'])->name('filter-city');

    Route::post('place-order', [OrderController::class, 'store'])->name('place-order');
    Route::post('razorupdate', [OrderController::class, 'razorUpdate'])->name('razorupdate');



    Route::group(['namespance' => 'Customer', 'as' => 'customer.'], function () {

        Route::get('/login', [CustomerAuthController::class, 'login'])->name('login');
        Route::post('/customer-signin', [CustomerAuthController::class, 'signin'])->name('customer-signin');
        Route::post('/register-signin', [CustomerAuthController::class, 'register'])->name('register-signin');

        Route::group(['middleware' => [], 'prefix' => 'customer'], function () {
            Route::get('address', [CustomerAddressController::class, 'index'])->name('address.index');
            Route::get('address/create', [CustomerAddressController::class, 'create'])->name('address.create');
            Route::post('address/store', [CustomerAddressController::class, 'store'])->name('address.store');
            Route::get('address/{id}', [CustomerAddressController::class, 'edit'])->name('address.edit');
            Route::post('address/{id}', [CustomerAddressController::class, 'update'])->name('address.update');
        });
    });



    //this is your target url
    Route::get('{slug_1?}/{slug_2?}',[FrontendController::class, 'shop'])->name('shop');


});


// Route::get('print', function () {
//     // for($i = 0; $i<7 ;$i++) {
//     //     echo "*";
//     // }
//     // echo '<br>';
//     for ($i = 1; $i < 8; $i++) {
//         if ($i == 1) {
//             for ($j = 1; $j <= 8; $j++) {

//                 echo   "*";
//             }
//             echo '<br>';
//         }
//         for ($j = 1; $j <= 4; $j++) {

//             if ($j == 4) {
//                 echo "*";
//             } else {
//                 echo " ";
//             }
//         }
//         echo '<br>';
//     }
// });


// Route::get('enc', function () {

//     $str = 'Emma';
//     $str = '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';

//     $key = 'PBKDF2WithHmacSHA256';
//     $iv  = str_repeat(chr(0), 16);
//     $encodedEncryptedData = base64_encode(openssl_decrypt($str, "AES-126-CBC", $key, OPENSSL_RAW_DATA, $iv));
//     echo $encodedEncryptedData; // OUTPUT: wuN9UzYYdmevVxgTxcYIbw==
//     die;

//     $key = 'PBKDF2WithHmacSHA256';
//     $plaintext = json_encode(
//         ["ResultStatus" => "Success", "ResultCode" => 0, "ResultMessage" => null, "APIRequestID" => "61794e11-7296404a-b6e2-
//         7367c630313c", "Result" => ["OrderID" => 123, "IsAutoCommitted" => "true", "ActualPayableAmount" => 299, "PG
//         Mode" => "PayTM", "PGAction" => "Instant", "PGResponse" => null]]
//     );
//     $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
//     $iv = openssl_random_pseudo_bytes($ivlen);
//     $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
//     $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
//     $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
//     echo $ciphertext;
//     echo '<br><br>';
//     echo $iv;
//     echo '<br><br>';

//     //decrypt later....
//     $c = base64_decode($ciphertext);
//     $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
//     $iv = substr($c, 0, $ivlen);
//     $hmac = substr($c, $ivlen, $sha2len = 32);
//     $ciphertext_raw = substr($c, $ivlen + $sha2len);
//     $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
//     $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
//     print_r($calcmac);
//     // if (hash_equals($hmac, $calcmac))// timing attack safe comparison
//     // {
//     //     echo $original_plaintext."\n";
//     // }

// });
