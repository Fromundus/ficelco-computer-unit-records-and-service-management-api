<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    // ✅ Get all devices
    public function index()
    {
        $devices = Device::all();
        return response()->json($devices);
    }

    // public function indexByType()
    // {
    //     $devices = Device::with('employee')->get()
    //         ->groupBy('type')
    //         ->map(function ($items, $type) {
    //             return [
    //                 'type' => $type,
    //                 'devices' => $items->values() // reset indexes
    //             ];
    //         })
    //         ->values(); // reset outer indexes

    //     return response()->json($devices);
    // }

    public function indexByType()
    {
        $priorityOrder = [
            'Computer',
            'Printer',
            'Scanner',
            'Monitor',
            'UPS',
            'Speaker',
            'Keyboard',
            'Mouse',
            'Other',
        ];

        $devices = Device::with('employee')->get()
            ->groupBy('type')
            ->map(function ($items, $type) {
                return [
                    'type' => $type,
                    'devices' => $items->values()
                ];
            })
            ->sortBy(function ($item) use ($priorityOrder) {
                $index = array_search($item['type'], $priorityOrder);
                return $index === false ? 999 : $index; // fallback for unknown types
            })
            ->values();

        return response()->json($devices);
    }

    // ✅ Store new device
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employeeid' => 'required|integer',
            'employee_name' => 'required|string',
            'name' => 'required|string|unique:devices,name',
            'type' => 'required|string',
            'brand' => 'required|string',
            'model' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'status' => 'nullable|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string',

            'processor' => 'required_if:type,Computer|nullable',
            'ram' => 'required_if:type,Computer|nullable',
            'system_type' => 'required_if:type,Computer|nullable',
            'operating_system' => 'required_if:type,Computer|nullable',
            'storage' => 'required_if:type,Computer|nullable',
            'mac_address' => 'required_if:type,Computer|nullable',
        ]);

        $user = $request->user();

        $device = Device::create([
            ...$validated,
            "created_by_employeeid" => $user->employeeid,
        ]);

        return response()->json([
            'message' => 'Device created successfully',
            'data' => $device
        ], 201);
    }

    // ✅ Show single device
    public function show($id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        return response()->json($device);
    }

    // ✅ Update device
    public function update(Request $request, $id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        $validated = $request->validate([
            'employeeid' => 'required|integer',
            'employee_name' => 'required|string',
            'name' => 'required|string|unique:devices,name,' . $id,
            'type' => 'required|string',
            'brand' => 'required|string',
            'model' => 'nullable|string',
            'serial_number' => 'nullable|string',
            'status' => 'nullable|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string',

            'processor' => 'required_if:type,Computer|nullable',
            'ram' => 'required_if:type,Computer|nullable',
            'system_type' => 'required_if:type,Computer|nullable',
            'operating_system' => 'required_if:type,Computer|nullable',
            'storage' => 'required_if:type,Computer|nullable',
            'mac_address' => 'required_if:type,Computer|nullable',
        ]);

        $user = $request->user();

        $device->update([
            ...$validated,
            "updated_by_employeeid" => $user->employeeid,
        ]);

        return response()->json([
            'message' => 'Device updated successfully',
            'data' => $device
        ]);
    }

    // ✅ Delete device
    public function destroy($id)
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        $device->delete();

        return response()->json([
            'message' => 'Device deleted successfully'
        ]);
    }
}