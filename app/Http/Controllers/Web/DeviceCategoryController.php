<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DeviceCategory;
use Illuminate\Http\Request;

class DeviceCategoryController extends Controller
{
    // Index
    public function index() {
        $deviceCategories = DeviceCategory::all()->paginate(10);

        return view('deviceCategory.index', [
            "title" => "Device Categories",
            "deviceCategories" => $deviceCategories
        ]);
    }

    // Create
    public function create() {
        return view('deviceCategory.create', [
            "title" => "Add new Device Category"
        ]);
    }

    // Store
    public function store(Request $request) {
        $validate = $request->validate([
            "category" => "required|max:30"
        ]);

        $create = DeviceCategory::create([
            "category" => $validate['category']
        ]);

        if($create) {
            return redirect()->route('deviceCategory.index')->with('success', 'Category added successfully!');
        } else {
            return redirect()->route('deviceCategory.index')->with('danger', 'Fail to add new Category!');
        }
    }

    // Edit
    public function edit(DeviceCategory $deviceCategory) {
        return view('deviceCategory.edit', [
            "title" => "Edit Category",
            "category" => $deviceCategory
        ]);
    }

    // Update
    public function update(Request $request, DeviceCategory $deviceCategory) {
        $validate = $request->validate([
            "category" => "required|max:30"
        ]);

        $update = $deviceCategory->update([
            "category" => $validate['category']
        ]);

        if($update) {
            return redirect()->route('deviceCategory.index')->with('success', 'Category edited successfully!');
        } else {
            return redirect()->route('deviceCategory.index')->with('danger', 'Fail to edit Category!');
        }
    }

    // Delete
    public function destroy(DeviceCategory $deviceCategory) {
        $delete = $deviceCategory->delete();

        if($delete) {
            return redirect()->route('deviceCategory.index')->with('success', 'Category deleted successfully!');
        } else {
            return redirect()->route('deviceCategory.index')->with('danger', 'Fail to delete Category!');
        }
    }
}
