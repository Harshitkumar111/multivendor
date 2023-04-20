<?php

namespace App\Http\Controllers\Backend;
use Image;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
class BrandController extends Controller
{
    public function allBrand(){
        $brands= Brand::latest()->get();
        return view('backend.brand.brand_all',compact('brands'));
    }
    public function AddBrand(){
        return view('backend.brand.brand_add');
    }
    public function StoreBrand(Request $request){
        $image=$request->file('brand_image');
        $name_gen= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url ='upload/brand/'.$name_gen;
        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
            'brand_image'=>$save_url,

        ]);
        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);

    }
    public function EditBrand($id){
        $brand= Brand::findOrFail($id);

        return view('backend.brand.brand_edit',compact('brand'));

    }
    public function updateBrand(Request $request){
      $brand_id=$request->id;
      $old_image=$request->old_image;
      if($request->file('brand_image')){
        $image=$request->file('brand_image');
        $name_gen= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url ='upload/brand/'.$name_gen;

       if(file_exists($old_image)){
        unlink($old_image);
       }

        Brand::findOrFail($brand_id)->update([
            'brand_name'=>$request->brand_name,
            'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
            'brand_image'=>$save_url,

        ]);
        $notification = array(
            'message' => 'Brand Update With image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);
      }else{
        Brand::findOrFail($brand_id)->update([
            'brand_name'=>$request->brand_name,
            'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),

        ]);
        $notification = array(
            'message' => 'Brand Update With Out Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);



      }

    }
    public function deleteBrand($id){
        $brand= Brand::findOrFail($id);
        $img= $brand->brand_image;
        if(file_exists($img)){
            unlink($img);
           }
       
        Brand::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Delete Brand Successfully',
            'alert-type' => 'success'
        );
    
        return redirect()->back()->with($notification);
    }


}
