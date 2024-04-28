<?php

namespace App\Http\Controllers\Web;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    // Index
    public function index() {
        $brands = Brand::all()->paginate(10);

        return view("brand.index", [
            "title" => "Brands",
            "brands" => $brands
        ]);
    }

    // Create
    public function create() {
        return view("brand.create", [
            "title" => "Add new Brand"
        ]);
    }

    // Store
    public function store(Request $request) {
        $validate = $request->validate([
            "brand_name" => "required|max:50",
            "image" => "image|file|nullable"
        ]);

        if(empty($validate['image'])) {
            $file = NULL;
        } else {
            $file = $validate['image'];
        }

        $file_name = NULL;

        if($request['image']) {
            $file_name = $file->getClientOriginalName();
            $file->move('images/brands', $file_name);
        }

        $create = Brand::create([
            'brand_name' => $validate['brand_name'],
            'image' => $file_name
        ]);

        if($create) {
            return redirect()->route('brand.index')->with('success', 'Brand added successfully!');
        } else {
            return redirect()->route('brand.index')->with('danger', 'Fail to add new Brand!');
        }
    }

    // Edit
    public function edit(Brand $brand) {
        return view('brand.edit', [
            "title" => "Edit brand",
            "brand" => $brand
        ]);
    }

    // Update
    public function update(Request $request, Brand $brand) {
        $validate = $request->validate([
            "brand_name" => "required|max:50",
            "image" => "image|file|nullable"
        ]);

        if(empty($validate['image'])) {
            $file = NULL;
        } else {
            $file = $validate['image'];
        }

        $file_name = $brand->image;

        if($request['image']) {
            if(!empty($brand->image)) {
                File::delete(public_path('images/brands/'.$brand->image));
            }

            $file_name = $file->getClientOriginalName();
            $file->move('images/brands', $file_name);
        }

        $update = $brand->update([
            'brand_name' => $validate['brand_name'],
            'image' => $file_name
        ]);

        if($update) {
            return redirect()->route('brand.index')->with('success', 'Brand edited successfully!');
        } else {
            return redirect()->route('brand.index')->with('danger', 'Fail to edit new Brand!');
        }
    }

    // Delete
    public function destroy(Brand $brand) {
        if(!empty($brand->image)) {
            if(File::delete(public_path('images/brands/'.$brand->image)) AND $brand->delete()) {
                return redirect()->route('brand.index')->with('success', 'Brand deleted successfully!');
            } else {
                return redirect()->route('brand.index')->with('danger', 'Fail to delete Brand!');
            }
        } else {
            $delete = $brand->delete();

            if($delete) {
                return redirect()->route('brand.index')->with('success', 'Brand deleted successfully!');
            } else {
                return redirect()->route('brand.index')->with('danger', 'Fail to delete Brand!');
            }
        }
    }
}
