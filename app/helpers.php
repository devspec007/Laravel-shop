<?php

use App\Models\Adminmenu;
use App\Models\Category;
use App\Models\NavMaster;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

function getParentCategories() {
    return Category::getParentCategories();
}


function nav()
    {
        Artisan::call('cache:clear');
        $parent = NavMaster::where('parent_id', 0)
            ->orderBy('orders', 'ASC')->get();
        $nav = [];
        foreach ($parent as $row) {
            if (Auth::user()->canany(explode(',', $row->permissions))) {
                $child = NavMaster::where('parent_id', $row->id)
                    ->orderBy('orders', 'ASC')->get();

                $tmp = [];
                foreach ($child as $cRow) {
                    if (Auth::user()->canany(explode(',', $cRow->permissions))) {
                        array_push($tmp, array('name' => $cRow->name, 'parent_id' => $cRow->parent_id, 'path' => $cRow->path, 'icons' => ($cRow->icons) ? $cRow->icons : '<i class="fas fa-fw fa-cog"></i>'));
                    }
                }

                if (count($tmp) > 0) {
                    array_push($nav, array('name' => $row->name, 'parent_id' => $row->parent_id, 'path' => $row->path, 'icons' => (($row->icons) ? $row->icons : '<i class="fas fa-fw fa-cog"></i>'), 'childs' => $tmp));
                } else {
                    array_push($nav, array('name' => $row->name, 'parent_id' => $row->parent_id, 'path' => $row->path, 'icons' => (($row->icons) ? $row->icons : '<i class="fas fa-fw fa-cog"></i>'), 'childs' => []));
                }
            }
        }
        return $nav;
    }


    function purchaseTax() {
        return [
            ['value' => 18.0, 'name' => "18.0 %(18.0%)"],
            ['value' => 3.0, 'name' => "Gst 3(3.0%)"],
            ['value' => 15.0, 'name' => "Gst 15(15.0%)"],
        ];
    }

    
    function saleTax() {
        return [
            ['value' => 18.0, 'name' => "18.0 %(18.0%)"],
            ['value' => 3.0, 'name' => "Gst 3(3.0%)"],
            ['value' => 15.0, 'name' => "Gst 15(15.0%)"],
        ];
    }

    function discountType($type = null) {
        $discount_types =  [
            '1' => 'Fixed',
            '2' => 'Percentage'
        ];
        if($type == null) {
            return $discount_types;
        }
        else {
            return $discount_types[$type]; 
        }
    }
    function statusList() {
        return  [
            'active' => 'Active','inactive' => 'Inactive'
        ];
        
    }

    function gstTypes() {
        return ['un-registered' => 'Un Registered',
         'registered' => 'Registered',
          'composition schema' => 'Composition Schema',
           'input service distributor' => 'Input Service Distributor',
           'e-commerce operator' => 'E-Commerce Operator',
           'uin holder' => 'UIN Holder'
        ];
    }

    function getStatusDetail($status = null) {
        $status_list = [
                        'in progress' => ['name' => 'In Progress' , 'color' => 'bg-lightred'],
                        'partially delivered' => ['name' => 'Partially Delivered' , 'color' => 'bg-lightyellow'],
                        'delivered' => ['name' => 'Delivered' , 'color' => 'bg-lightgreen'],
                        'paid' => ['name' => 'Paid' , 'color' => 'bg-lightgreen'],
                        'unpaid' => ['name' => 'Un Paid' , 'color' => 'bg-lightred'],
                        'partial' => ['name' => 'Partial' , 'color' => 'bg-lightyellow'],
                        'cancelled' => ['name' => 'Cancelled' , 'color' => 'bg-lightred'],

                        

                    ];
        if($status ==null) {

            return $status_list;
        }
        else {
            $status_data = $status_list[$status];

        return '<span class="badges '.$status_data['color'].'">'.$status_data['name'].'</span>';
        }
    }

    function bannerType($status = null) {
        $status_list = [
                        'mobile' => ['name' => 'Mobile' , 'color' => 'bg-lightred'],
                        'desktop' => ['name' => 'Desktop' , 'color' => 'bg-lightyellow'],
                        
                    ];
        if($status ==null) {

            return $status_list;
        }
        else {
            $status_data = $status_list[$status];

        return '<span class="badges '.$status_data['color'].'">'.$status_data['name'].'</span>';
        }
    }

    function dateFormat($date = null) {
        if($date != null) {
            return Carbon::parse($date)->format('d/m/Y');
        }
        return '';
    }
    function dateTimeFormat($date = null) {
        if($date != null) {
            return Carbon::parse($date)->format('d/m/Y g:i A');
        }
        return '';
    }
    

     function numberToWord($num = '')

    {

        $num    = (string) ((int) $num);



        if ((int) ($num) && ctype_digit($num)) {

            $words  = array();



            $num    = str_replace(array(',', ' '), '', trim($num));



            $list1  = array(
                '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',

                'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',

                'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
            );



            $list2  = array(
                '', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty',

                'seventy', 'eighty', 'ninety', 'hundred'
            );



            $list3  = array(
                '', 'thousand', 'million', 'billion', 'trillion',

                'quadrillion', 'quintillion', 'sextillion', 'septillion',

                'octillion', 'nonillion', 'decillion', 'undecillion',

                'duodecillion', 'tredecillion', 'quattuordecillion',

                'quindecillion', 'sexdecillion', 'septendecillion',

                'octodecillion', 'novemdecillion', 'vigintillion'
            );



            $num_length = strlen($num);

            $levels = (int) (($num_length + 2) / 3);

            $max_length = $levels * 3;

            $num    = substr('00' . $num, -$max_length);

            $num_levels = str_split($num, 3);



            foreach ($num_levels as $num_part) {

                $levels--;

                $hundreds   = (int) ($num_part / 100);

                $hundreds   = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');

                $tens       = (int) ($num_part % 100);

                $singles    = '';



                if ($tens < 20) {
                    $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
                } else {
                    $tens = (int) ($tens / 10);
                    $tens = ' ' . $list2[$tens] . ' ';
                    $singles = (int) ($num_part % 10);
                    $singles = ' ' . $list1[$singles] . ' ';
                }
                $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
            }
            $commas = count($words);
            if ($commas > 1) {

                $commas = $commas - 1;
            }



            $words  = implode(', ', $words);



            $words  = trim(str_replace(' ,', ',', ucwords($words)), ', ');

            if ($commas) {

                $words  = str_replace(',', ' and', $words);
            }



            return $words;
        } else if (!((int) $num)) {

            return 'Zero';
        }

        return '';
    }

    
    function MenuPositions()
{
	$data['header']="Header";
	$data['footer_left']="Footer left";
	$data['footer_right']="Footer right";
	$data['footer_center']="Footer center";

	return $data;
}

function bannerSection() {
    return ['main-banner' => 'Main Banner', '2nd-banner' => '2nd Banner', '3rd-banner' => '3rd Banner', '4th-banner' => '4th Banner'];
}

function CollapseAbleMenu($position,$ul=''){
	$menu_position = $position;
	$menus=menu_query($menu_position);
	
	return view('frontend.menu.parent',compact('menus','ul'));
}



function menu_query($menu_position){
   $menus=Adminmenu::where('position','header')->first();
   return $menus=json_decode($menus->data ?? '');
}

function CollapseAbleMobileMenu($position,$ul=''){
	$menu_position = $position;
	$menus=menu_query($menu_position);
	
	return view('frontend.mobile_menu.parent',compact('menus','ul'));
}

function transitStatus($type = null) {
    $data = [
        'order_placed' => ['name' => 'Order Placed', 'color' => 'text-info'],
        'intransit' => ['name' => 'In-Transit by admin store', 'color' => 'text-green'],
        'store_received' => ['name' => 'Received by store', 'color' => 'text-warnig'],

    ];
    if($type != null) {
        if(!$data[$type]) {
            return '';
        }
        $status_data = $data[$type];

        return '<span class="'.$status_data['color'].'"><strong>'.$type.'</strong></span>';
    }
    return $data;
}

function variantProductPrice($sku) {
    $discount_percent = 0;
    $price = 0;
    $discounted_price = 0;
    if($sku) {
        $price = $sku->price;
        $discounted_price =  $sku->discount+$price;
        $discount_percent = ($sku->discount/$discounted_price)*100;
    }
    return ['price' => $price, 'discounted_price' => $discounted_price, 'discount_percent' => $discount_percent];  
}