<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        return view('admin.Customers.customers');
    }

    public function importExcel(Request $request)
    {
        $jsonData = $request->json('data');

    if (!$jsonData) {
        return response()->json(['message' => 'No data provided.'], 400);
    }

    // return response()->json(['message' =>  $jsonData[0]['A']], 200);
        try {

            foreach ($jsonData as $customerData) {
                // return response()->json(['message' =>  $customerData], 404);
                // Customize this part based on your Excel structure
                Customer::create([
                    'organization' => !empty($customerData['A']) ? $customerData['A'] : NULL,
                    'customer_name' => !empty($customerData['B']) ? $customerData['B'] : NULL,
                    'gender' => !empty($customerData['C']) ? $customerData['C'] : NULL,
                    'customer_type' => !empty($customerData['D']) ? $customerData['D'] : NULL,
                    'customer_balance' => !empty($customerData['E']) ? $customerData['E'] : NULL,
                    'document_number' => !empty($customerData['F']) ? $customerData['F'] : NULL,
                    'account_number' => !empty($customerData['G']) ? $customerData['G'] : NULL,
                    'customer_phone_one' => !empty($customerData['H']) ? $customerData['H'] : NULL,
                    'customer_phone_two' => !empty($customerData['I']) ? $customerData['I'] : NULL,
                    'email' => !empty($customerData['J']) ? $customerData['J'] : NULL,
                    'geo_county' => !empty($customerData['K']) ? $customerData['K'] : NULL,
                    'geo_district' => !empty($customerData['L']) ? $customerData['L'] : NULL,
                    'geo_zone' => !empty($customerData['M']) ? $customerData['M'] : NULL,
                    'geo_community' => !empty($customerData['N']) ? $customerData['N'] : NULL,
                    'street' => !empty($customerData['O']) ? $customerData['O'] : NULL,
                    'building_description' => !empty($customerData['P']) ? $customerData['P'] : NULL,
                    'service_type' => !empty($customerData['Q']) ? $customerData['Q'] : NULL,
                    'route' => !empty($customerData['R']) ? $customerData['R'] : NULL,
                    'itinerary' => !empty($customerData['S']) ? $customerData['S'] : NULL,
                    'tariff_category' => !empty($customerData['T']) ? $customerData['T'] : NULL,
                    'tariff_description' => !empty($customerData['U']) ? $customerData['U'] : NULL,
                    'phase' => !empty($customerData['V']) ? $customerData['V'] : NULL,
                    'activity' => !empty($customerData['W']) ? $customerData['W'] : NULL,
                    'subactivity' => !empty($customerData['X']) ? $customerData['X'] : NULL,
                    'premise_type' => !empty($customerData['Y']) ? $customerData['Y'] : NULL,
                    'none_disconnectable_indicator' => !empty($customerData['Z']) ? $customerData['Z'] : NULL,
                    'cnumber' => !empty($customerData['AA']) ? explode('-', $customerData['AA'])[0] : NULL,
                    'contract_status' => !empty($customerData['AB']) ? $customerData['AB'] : NULL,
                    'contract_activation_date' => !empty($customerData['AC']) ? \Carbon\Carbon::parse($customerData['AC'])->format('Y-m-d') : NULL,
                    'contract_termination_date' => !empty($customerData['AD']) ?\Carbon\Carbon::parse($customerData['AD'])->format('Y-m-d') : NULL,
                    'tax_indicator' => !empty($customerData['AE']) ? $customerData['AE'] : NULL,
                    'estimated_monthly_consumption' => !empty($customerData['AF']) ? $customerData['AF'] : NULL,
                    'group_account' => !empty($customerData['AG']) ? $customerData['AG'] : NULL,
                    'connection_type' => !empty($customerData['AH']) ? $customerData['AH'] : NULL,
                    'meter_owner' => !empty($customerData['AI']) ? $customerData['AI'] : NULL,
                    'meter_type' => !empty($customerData['AJ']) ? $customerData['AJ'] : NULL,
                    'meter_make' => !empty($customerData['AK']) ? $customerData['AK'] : NULL,
                    'meter_model' => !empty($customerData['AL']) ? $customerData['AL'] : NULL,
                    'meter_number' => !empty($customerData['AM']) ? $customerData['AM'] : NULL,
                    's_substation_no' => !empty($customerData['AN']) ? $customerData['AN'] : NULL,
                    'gis_x_coordinates' => !empty($customerData['AO']) ? (float)$customerData['AO'] : NULL,
                    'gis_y_coordinates' => !empty($customerData['AP']) ? (float)$customerData['AP'] : NULL,
                    'feeder_number' => !empty($customerData['AQ']) ? $customerData['AQ'] : NULL,
                    'lv_circuit_no' => !empty($customerData['AR']) ? $customerData['AR'] : NULL,
                    'source' => !empty($customerData['AS']) ? $customerData['AS'] : NULL,
                    'verification' => !empty($customerData['AT']) ? $customerData['AT'] : NULL,
                    'donor_type' => !empty($customerData['AU']) ? $customerData['AU'] : NULL,
                    'pole_number' => !empty($customerData['AV']) ? $customerData['AV'] : NULL,
                    // ... add other fields as needed
                ]);
                
                
            }
            

            return response()->json(['message' => 'Data imported successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error importing data.', 'error' => $e->getMessage()], 500);
        }
    }


    public function importExcelConsumption(Request $request)
    {
        $jsonData = $request->json('data');

    if (!$jsonData) {
        return response()->json(['message' => 'No data provided.'], 400);
    }

    return response()->json(['message' =>  $jsonData], 200);
    
        try {

            foreach ($jsonData as $customerData) {
                // return response()->json(['message' =>  $customerData], 200);
                // Customize this part based on your Excel structure
                Billing::create([
                    // 'organization' => !empty($customerData['A']) ? $customerData['A'] : NULL,
                    // 'customer_name' => !empty($customerData['B']) ? $customerData['B'] : NULL,
                    // 'gender' => !empty($customerData['C']) ? $customerData['C'] : NULL,
                    // 'customer_type' => !empty($customerData['D']) ? $customerData['D'] : NULL,
                    // 'customer_balance' => !empty($customerData['E']) ? $customerData['E'] : NULL,
                    // 'document_number' => !empty($customerData['F']) ? $customerData['F'] : NULL,
                    // 'account_number' => !empty($customerData['G']) ? $customerData['G'] : NULL,
                    // 'customer_phone_one' => !empty($customerData['H']) ? $customerData['H'] : NULL,
                    // 'customer_phone_two' => !empty($customerData['I']) ? $customerData['I'] : NULL,
                    // 'email' => !empty($customerData['J']) ? $customerData['J'] : NULL,
                    // 'geo_county' => !empty($customerData['K']) ? $customerData['K'] : NULL,
                    // 'geo_district' => !empty($customerData['L']) ? $customerData['L'] : NULL,
                    // 'geo_zone' => !empty($customerData['M']) ? $customerData['M'] : NULL,
                    // 'geo_community' => !empty($customerData['N']) ? $customerData['N'] : NULL,
                    // 'street' => !empty($customerData['O']) ? $customerData['O'] : NULL,
                    // 'building_description' => !empty($customerData['P']) ? $customerData['P'] : NULL,
                    // 'service_type' => !empty($customerData['Q']) ? $customerData['Q'] : NULL,
                    // 'route' => !empty($customerData['R']) ? $customerData['R'] : NULL,
                    // 'itinerary' => !empty($customerData['S']) ? $customerData['S'] : NULL,
                    // 'tariff_category' => !empty($customerData['T']) ? $customerData['T'] : NULL,
                    // 'tariff_description' => !empty($customerData['U']) ? $customerData['U'] : NULL,
                    // 'phase' => !empty($customerData['V']) ? $customerData['V'] : NULL,
                    // 'activity' => !empty($customerData['W']) ? $customerData['W'] : NULL,
                    // 'subactivity' => !empty($customerData['X']) ? $customerData['X'] : NULL,
                    // 'premise_type' => !empty($customerData['Y']) ? $customerData['Y'] : NULL,
                    // 'none_disconnectable_indicator' => !empty($customerData['Z']) ? $customerData['Z'] : NULL,
                    // 'cnumber' => !empty($customerData['AA']) ? $customerData['AA'] : NULL,
                    // 'contract_status' => !empty($customerData['AB']) ? $customerData['AB'] : NULL,
                    // 'contract_activation_date' => !empty($customerData['AC']) ? \Carbon\Carbon::parse($customerData['AC'])->format('Y-m-d H:i:s') : NULL,
                    // 'contract_termination_date' => !empty($customerData['AD']) ? $customerData['AD'] : NULL,
                    // 'tax_indicator' => !empty($customerData['AE']) ? $customerData['AE'] : NULL,
                    // 'estimated_monthly_consumption' => !empty($customerData['AF']) ? $customerData['AF'] : NULL,
                    // 'group_account' => !empty($customerData['AG']) ? $customerData['AG'] : NULL,
                    // 'connection_type' => !empty($customerData['AH']) ? $customerData['AH'] : NULL,
                    // 'meter_owner' => !empty($customerData['AI']) ? $customerData['AI'] : NULL,
                    // 'meter_type' => !empty($customerData['AJ']) ? $customerData['AJ'] : NULL,
                    // 'meter_make' => !empty($customerData['AK']) ? $customerData['AK'] : NULL,
                    // 'meter_model' => !empty($customerData['AL']) ? $customerData['AL'] : NULL,
                    // 'meter_number' => !empty($customerData['AM']) ? $customerData['AM'] : NULL,
                    // 's_substation_no' => !empty($customerData['AN']) ? $customerData['AN'] : NULL,
                    // 'gis_x_coordinates' => !empty($customerData['AO']) ? (float)$customerData['AO'] : NULL,
                    // 'gis_y_coordinates' => !empty($customerData['AP']) ? (float)$customerData['AP'] : NULL,
                    // 'feeder_number' => !empty($customerData['AQ']) ? $customerData['AQ'] : NULL,
                    // 'lv_circuit_no' => !empty($customerData['AR']) ? $customerData['AR'] : NULL,
                    // 'source' => !empty($customerData['AS']) ? $customerData['AS'] : NULL,
                    // 'verification' => !empty($customerData['AT']) ? $customerData['AT'] : NULL,
                    // 'donor_type' => !empty($customerData['AU']) ? $customerData['AU'] : NULL,
                    // 'pole_number' => !empty($customerData['AV']) ? $customerData['AV'] : NULL,
                    // ... add other fields as needed
                ]);
                
                
            }
            

            return response()->json(['message' => 'Data imported successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error importing data.', 'error' => $e->getMessage()], 500);
        }
    }

//     public function importExcel(Request $request)
// {
//     $jsonData = $request->json('data');

//     if (!$jsonData) {
//         return response()->json(['message' => 'No data provided.'], 400);
//     }

//     return response()->json(['message' =>  $jsonData[19][1]], 200);


//     // Decode the JSON data
//     $dataArray = json_decode($jsonData, true);

//     // Check if the JSON decoding was successful
//     // if (!$dataArray) {
//     //     return response()->json(['message' => 'Invalid JSON data.'], 400);
//     // }

//     // Process each record
//     foreach ($dataArray as $record) {
//         // Perform operations on each $record
//         // Example: Insert into database, update, or any other business logic
//         // Access individual fields like $record['fieldName']
//     }

//     return response()->json(['message' => 'Data processed successfully.'], 200);
// }


    public function customerProfile($customer_id)
    {
        return view('admin.Customers.customer-profile')->with('customer_id', $customer_id);
    }

    public function getCustomers()
    {
        $customers = Customer::with('location')->get();
        return response()->json($customers);
    }
}
