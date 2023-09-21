



<tr>
    <th colspan="8">
        <?php
function getOtions() {

}
$data = [];
$list = '';
$result = [];
// foreach($request['option_value_2'] as $option_value) {
       

//             array_push($data, [2 => $option_value]);
       
//     }
//     foreach($request['option_value_1'] as $option_value) {

//         foreach ($data as $key => $render) {
//             # code...
//             array_push($data[$key], [1 => $option_value]);
//         }
       
//     }
//     print_r($data[0]);


foreach($request->option_name as $index => $option_name) {
    if($index == 0) {
        foreach($request['option_value_'.$option_name] as $option_value) {
            array_push($data, [$option_name => $option_value]);
            $result = $data;
        }
    }
    else {
        foreach ($data as $key => $render) {
            $temp = [];
            foreach($request['option_value_'.$option_name] as $option_value) {
                array_push($temp, [$option_name => $option_value]);
            }
            array_push($data[$key], $temp);
        }
    }
    // 
}
print_r($data);

?>
    </th>
    {{-- <th><input type="text"></th>
    <th><input type="text"></th>
    <th><input type="text"></th>
    <th><input type="text"></th>
    <th><input type="text"></th>
    <th><input type="text"></th>
    <th><input type="text"></th>
    <th><input type="text"></th>
    <th><input type="text"></th>
    <th><input type="text"></th>
    <th><input type="text"></th>
    <th><input type="text"></th> --}}


</tr>

@foreach ($data as $item)
<tr>
<th colspan="8"><?php print_r($item);?></th>
{{-- <th><input type="text"></th>
<th><input type="text"></th>
<th><input type="text"></th>
<th><input type="text"></th>
<th><input type="text"></th>
<th><input type="text"></th>
<th><input type="text"></th>
<th><input type="text"></th>
<th><input type="text"></th>
<th><input type="text"></th>
<th><input type="text"></th>
<th><input type="text"></th>  --}}
</tr>
@endforeach