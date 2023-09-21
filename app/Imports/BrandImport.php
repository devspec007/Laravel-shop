<?php

namespace App\Imports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class BrandImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        ini_set('max_execution_time', '0');

        foreach ($rows as $key => $row) {
            // print_r($row);
            // die;
            if ($key > 0) {
               

                $brand = Brand::where('name', $row[0])->first();
                if (!$brand) {
                    $brand = new Brand();
                    $brand->name = $row[0];
                }
                $brand->slug = Str::slug($row[0]);
                $brand->description = $row[1];
                $brand->save();
            }
        }
    }
}
