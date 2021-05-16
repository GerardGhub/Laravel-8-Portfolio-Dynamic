<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
        public function AllCat(){
            $categories = DB::table('categories')
            ->join('users','categories.user_id','users.id')
            ->select('categories.*','users.name')
            ->latest()->paginate(5);

            // $categories = DB::table('categories')->latest()->paginate(5);
            return view('admin.category.index', compact('categories'));
        }

        public function AddCat(Request $request)
        {
             $validatedData = $request -> validate([
                 'category_name' => 'required|unique:categories|max:255',

             ],
             [
                'category_name.required' => 'Please Input Category Name',
                'category_name.max' => 'Category Less than 255 Characters',
            
            
            ]);

            $data = array();
            $data['category_name'] = $request->category_name;
            $data['user_id'] = Auth::user()->id;
            DB::table('categories')->insert($data);


            return Redirect()->back()->with('success','Category Inserted Successfull');
        }
    
        public function Edit($id){

            $categories = DB::table('categories')->where('id',$id)->first();
            return view ('admin.category.edit', compact('categories'));
        }

        public function Update(Request $request , $id){

            $data = array();
            $data['category_name'] = $request->category_name;
            $data['user_id'] = Auth::user()->id;
            DB::table('categories')->where('id',$id)->update($data);

            
            return Redirect()->route('all.category')->with('success','Category Updated Successfull');
        }
}
