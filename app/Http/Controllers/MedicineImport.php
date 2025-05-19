<?php

namespace App\Http\Controllers;

use App\Models\Leaf;
use App\Models\Type;
use App\Models\Unit;
use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MedicineImport implements ToModel, WithHeadingRow {
    /**
     * @param array $row
     *
     * @return Medicine|null
     */
    public function model( array $row ) {

// Grab the shop_id, default to 1 if not provided
        // $shop_id = $row['shop_id'] ?? 1;
        $shop_id = !empty( $row['shop_id'] ) ? $row['shop_id'] : ( Auth::user()->shop_id ?? 1 );

        // Convert "Active" and "Inactive" to 1 and 0
        $status = strtolower( trim( $row['status'] ) ) == 'active' ? 1 : 0;

        // Convert date format to YYYY-MM-DD
        $mfg_date = ( !empty( $row['mfg_date'] ) && strtotime( $row['mfg_date'] ) ) ? date( 'Y-m-d', strtotime( $row['mfg_date'] ) ) : null;
        $exp_date = ( !empty( $row['exp_date'] ) && strtotime( $row['exp_date'] ) ) ? date( 'Y-m-d', strtotime( $row['exp_date'] ) ) : null;

        // Ensure Leaf is connected with shop_id
        $leaf = Leaf::firstOrCreate(
            ['name' => $row['leaf_name'], 'shop_id' => $shop_id]
        );

        // Ensure Type is connected with shop_id
        $type = Type::firstOrCreate(
            ['name' => $row['type_name'], 'shop_id' => $shop_id]
        );

        // Ensure Unit is connected with shop_id
        $unit = Unit::firstOrCreate(
            ['name' => $row['unit_name'], 'shop_id' => $shop_id]
        );

        // Ensure Supplier is connected with shop_id
        $supplier = Supplier::firstOrCreate(
            ['name' => $row['supplier_name'], 'shop_id' => $shop_id]
        );

        // Check for duplicate medicine (based on name + qr_code)
        $existingMedicine = Medicine::where( 'name', $row['name'] )
            ->where( 'qr_code', $row['qr_code'] )
            ->first();

// If duplicate exists, update it instead of inserting a new one
        if ( $existingMedicine ) {
            $existingMedicine->update( [
                'product_type' => $row['product_type'],
                'strength'     => $row['strength'],
                'leaf_id'      => $leaf->id,
                'shelf'        => $row['shelf'],
                'type_id'      => $type->id,
                'supplier_id'  => $supplier->id,
                'vat'          => $row['vat'],
                'status'       => $status,
                'generic_name' => $row['generic_name'],
                'unit_id'      => $unit->id,
                'des'          => $row['des'],
                'price'        => $row['price'],
                'buy_price'    => $row['buy_price'],
                'mfg_date'     => $mfg_date,
                'exp_date'     => $exp_date,
                'shop_id'      => $shop_id,
            ] );
            return null; // Prevent duplicate insertions
        }

        // Insert new medicine if not duplicate
        return new Medicine( [
            'qr_code'      => $row['qr_code'],
            'product_type' => $row['product_type'],
            'strength'     => $row['strength'],
            'leaf_id'      => $leaf->id,
            'shelf'        => $row['shelf'],
            'type_id'      => $type->id,
            'supplier_id'  => $supplier->id,
            'vat'          => $row['vat'],
            'status'       => $status,
            'name'         => $row['name'],
            'generic_name' => $row['generic_name'],
            'unit_id'      => $unit->id,
            'des'          => $row['des'],
            'price'        => $row['price'],
            'buy_price'    => $row['buy_price'],
            'mfg_date'     => $mfg_date,
            'exp_date'     => $exp_date,
            'shop_id'      => $shop_id,
        ] );
    }

}
