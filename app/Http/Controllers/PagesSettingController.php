<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;
use App\Models\Item;
use App\Models\Categories;


class PagesSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexitem()
    {
        // Fetch the homepage data
        $items = Item::get(); // Retrieve the first homepage record
    
        // Pass the data to the view
        return view('adminpages.item.index', ['items' => $items]);
    }

    public function createitem()
    {

        // Pass the data to the view
        return view('adminpages.item.create');
    }

    public function deleteitem($id)
    {

        $item = Item::find($id);

        $imagePath = public_path('book_images/' . $item->image);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Deletes the image file
        }
    
        // Delete file
        $filePath = public_path('book_files/' . $item->file);
        if (file_exists($filePath)) {
            unlink($filePath); // Deletes the file
        }
    
        // Delete the item
        $item->delete();
    
        return redirect()->route('indexitem')->with('success', 'Item deleted successfully.');


    }

     public function indexhome()
     {
         // Fetch the homepage data
         $homepage = Homepage::first(); // Retrieve the first homepage record
     
         // Pass the data to the view
         return view('adminpages.editpages.homesetting', compact('homepage'));
     }
     

    /**
     * Show the form for creating a new resource.
     */
   public function updatehome(Request $request)
{
    // Validate the request
    $request->validate([
        'hero_heading' => 'required|string',
        'hero_paragraph' => 'required|string',
        'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1000', // Allow nullable image field
    ]);

    // Fetch the existing homepage record
    $homepage = Homepage::first();

    if ($homepage) {
        // Update only if the user uploaded a new image
        if ($request->hasFile('hero_image')) {
            // Delete the existing image file if it exists
            if (file_exists(public_path('clientside/images/' . $homepage->hero_image))) {
                unlink(public_path('clientside/images/' . $homepage->hero_image));
            }

            // Get the original file name and extension
            $original_image = $request->hero_image->getClientOriginalName();
            $extension = $request->hero_image->getClientOriginalExtension();

            // Generate a unique file name
            $unique_image = uniqid() . '-' . 'hero_image.' . $extension;

            // Move the uploaded file to a temporary location
            $request->hero_image->storeAs('temp', $unique_image); // Assuming you have a 'temp' folder

            // Update the homepage record in the database
            $homepage->update([
                'hero_heading' => $request->hero_heading,
                'hero_paragraph' => $request->hero_paragraph,
                'hero_image' => $unique_image, // Save the unique image name in the database
            ]);

            // Move the uploaded file to the public images folder with its original extension
            $request->hero_image->move(public_path('/clientside/images'), $unique_image);
        } else {
            // Update only text fields if no new image is uploaded
            $homepage->update([
                'hero_heading' => $request->hero_heading,
                'hero_paragraph' => $request->hero_paragraph,
            ]);
        }

        // Return a redirect response with a success message
        return redirect()->back()->with('status', 'Update Successful.');
    } else {
        // If no homepage record exists, create a new one
        if ($request->hasFile('hero_image')) {
            // Get the original file name and extension
            $original_image = $request->hero_image->getClientOriginalName();
            $extension = $request->hero_image->getClientOriginalExtension();

            // Generate a unique file name
            $unique_image = uniqid() . '-' . 'hero_image.' . $extension;

            // Move the uploaded file to the public images folder with its original extension
            $request->hero_image->move(public_path('/clientside/images'), $unique_image);

            // Create a new homepage record in the database
            Homepage::create([
                'hero_heading' => $request->hero_heading,
                'hero_paragraph' => $request->hero_paragraph,
                'hero_image' => $unique_image, // Save the unique image name in the database
            ]);
        } else {
            // Create a new homepage record with only text fields
            Homepage::create([
                'hero_heading' => $request->hero_heading,
                'hero_paragraph' => $request->hero_paragraph,
            ]);
        }

        // Return a redirect response with a success message
        return redirect()->back()->with('status', 'Homepage Created Successfully.');
    }
}

    public function indexcategories(Request $request)
    {
        $data = Categories::all();
        $categories =  $data->toArray();
        return view('adminpages.categories', compact('categories'));
    }

    public function updatecategories(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'category_name' => 'required|string|max:255', // Adjust validation rules as needed
        ]);
    
        try {
            // Update the category based on the provided ID
            $category = Categories::findOrFail($request->id);
            $category->category_name = $request->category_name;
            $category->save();
    
            // Optionally, you can return a success message or redirect the user
            return redirect()->back()->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            // Handle any errors that occur during the update process
            return redirect()->back()->with('error', 'Error updating category: ' . $e->getMessage());
        }
    }

    public function deletecategories(Request $request)
    {
        try {
            // Find the category based on the provided ID and delete it
            $category = Categories::findOrFail($request->id);
            $category->delete();
    
            // Optionally, you can return a success message or redirect the user
            return redirect()->back()->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            // Handle any errors that occur during the deletion process
            return redirect()->back()->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }
    


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
