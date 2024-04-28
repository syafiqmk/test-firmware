<?php

namespace App\Http\Controllers\Web;

use App\Models\Brand;
use App\Models\Firmware;
use Illuminate\Http\Request;
use App\Models\DeviceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class FirmawareController extends Controller
{
    // Index
    public function index() {
        if(request()->search) {
            $search = request()->search;
        } else {
            $search = "";
        }

        if(request()->category) {
            $category = request()->category;
        } else {
            $category = "";
        }

        if(request()->brand) {
            $brand = request()->brand;
        } else {
            $brand = "";
        }

        $firmwares = Firmware::where('series', 'LIKE', '%'.$search.'%')->where('category_id', '=', $category)->where('brand_id', '=', $brand)->orderBy('id', 'ASC')->paginate(10);
        $brands = Brand::all();
        $categories = DeviceCategory::all();

        return view('firmware.index', [
            "title" => "Firmwares",
            "firmwares" => $firmwares,
            "brands" => $brands,
            "categories" => $categories
        ]);
    }

    // Create
    public function create() {
        $brands = Brand::all();
        $categories = DeviceCategory::all();

        return view('firmware.create', [
            "title" =>  "Add new Firmware",
            "brands" => $brands,
            "categories" => $categories
        ]);
    }

    // Store
    public function store(Request $request) {
        $validate = $request->validate([
            "series" => "required|max:50",
            "brand" => "required",
            "category" => "required",
            "file" => "required|file",
        ]);

        $file = $request['file'];
        $file_name = NULL;

        if($request['file']) {
            $file_name = $file->getClientOriginalName();
            $file->move('files/firmwares', $file_name);
        }

        $create = Firmware::create([
            "series" => $validate['series'],
            "file" => $file_name,
            "brand_id" => $validate['brand'],
            "category_id" => $validate['category']
        ]);

        if($create) {
            return redirect()->route('firmware.index')->with('success', 'Firmware added successfully!');
        } else {
            return redirect()->route('firmware.index')->with('danger', 'Fail to add new Firmware!');
        }
    }

    // Edit
    public function edit(Firmware $firmware) {
        $brands = Brand::all();
        $categories = DeviceCategory::all();

        return view('firmware.edit', [
            "title" => "Edit Firmware",
            "firmware" => $firmware,
            "brands" => $brands,
            "categories" => $categories
        ]);
    }

    // Update
    public function update(Request $request, Firmware $firmware) {
        $validate = $request->validate([
            "series" => "required|max:50",
            "brand" => "required",
            "category" => "required",
            "file" => "file",
        ]);

        $file = $request['file'];
        $file_name = $firmware->file;

        if($request['file']) {
            File::delete(public_path('files/firmwares/'.$firmware->file));

            $file_name = $file->getClientOriginalName();
            $file->move('files/firmwares', $file_name);
        }

        $update = $firmware->update([
            "series" => $validate['series'],
            "file" => $file_name,
            "brand_id" => $validate['brand'],
            "category_id" => $validate['category']
        ]);

        if($update) {
            return redirect()->route('firmware.index')->with('success', 'Firmware edited successfully!');
        } else {
            return redirect()->route('firmware.index')->with('danger', 'Fail to edit Firmware!');
        }
    }

    // Delete
    public function destroy(Firmware $firmware) {
        if(File::delete(public_path('files/firmwares/'.$firmware->file)) AND $firmware->delete()) {
            return redirect()->route('firmware.index')->with('success', 'Firmware deleted successfully!');
        } else {
            return redirect()->route('firmware.index')->with('danger', 'Fail to delete Firmware!');
        }
    }
}
