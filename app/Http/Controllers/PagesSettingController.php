<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;
use App\Models\Categories;
use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;



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
        return view('adminpages.item.index', ['items'=> $items]);
    }

    public function createitem()
    {
        $categories = Categories::get();

        // Pass the data to the view
        return view('adminpages.item.create', ['categories' => $categories]) ;
    }


    public function storeitem(Request $request)
    {
        
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bookfile' => 'required|mimes:pdf|max:2048',
            'category' => 'required|string',
            'description' => 'required|string',
        ]);

        // Generate slug from the name
        $slug = Str::slug($validatedData['name']); 

        // Ensure slug uniqueness
        $uniqueSlug = $slug;
        $counter = 1;
        while (Item::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter;
            $counter++;
        }

        // Store image file
        $imageExtension = $request->file('image')->extension();
        $fileExtension = $request->file('bookfile')->extension();
        
        $unique_image =  uniqid() . '.' . $imageExtension;
        $uniquesfile =  $request->name . '.' . $fileExtension;

        $request->file('image')->move(public_path('book_images'), $unique_image);
        $request->file('bookfile')->move(public_path('book_files'), $uniquesfile);

        // Process the validated data and store it in the database
        $item = new Item();
        $item->name = $validatedData['name'];
        $item->price = $validatedData['price'];
        $item->image = $unique_image;
        $item->file = $uniquesfile;
        $item->category = $validatedData['category'];
        $item->description = $validatedData['description'];
        $item->slug = $uniqueSlug; // Assign the unique slug to the item
        $item->save();

        // Redirect the user or return a response indicating success
        return redirect()->route('indexitem')->with('success', 'Item added successfully!');
    }

    function edititem($id)
    {
        $categories = Categories::all();
        $item = Item::find($id);
        return view('adminpages.item.edit', compact('categories','item'));
    }

    public function updateitem(Request $request, $id)
    {
        // Retrieve the item by its ID
        $item = Item::find($id);
    
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for image file
            'bookfile' => 'max:2048', // Example validation for file
        ]);
    
        // Update item attributes with the new data
        $item->name = $request->name;
        $item->price = $request->price;
        $item->category = $request->category;
        $item->description = $request->description;
    
        // Handle image update if provided
        if ($request->hasFile('image')) {
            // Delete previous image if it exists
            if ($item->image && file_exists(public_path('book_images/'.$item->image))) {
                unlink(public_path('book_images/'.$item->image));
            }
    
            $imageExtension = $request->file('image')->extension();
            $uniqueImage = uniqid() . '.' . $imageExtension;
            $request->file('image')->move(public_path('book_images'), $uniqueImage);
            $item->image = $uniqueImage;
        }
    
        // Handle file update if provided
        if ($request->hasFile('bookfile')) {
            // Delete previous file if it exists
            if ($item->file && file_exists(public_path('book_files/'.$item->file))) {
                unlink(public_path('book_files/'.$item->file));
            }
    
            $fileExtension = $request->file('bookfile')->extension();
            $uniqueFile = $request->name . '.' . $fileExtension;
            $request->file('bookfile')->move(public_path('book_files'), $uniqueFile);
            $item->file = $uniqueFile;
        }
    
        // Save the changes to the database
        $item->save();
    
        return redirect()->back()->with('success', 'Item updated successfully');
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
    
        return redirect()->route('indexitem')->with('error', 'Item deleted successfully.');
    }

    public function indexhome()
    {
        // Fetch the homepage data
        $homepage = Homepage::first(); // Retrieve the first homepage record
    
        // Pass the data to the view
        return view('adminpages.editpages.homesetting', compact('homepage'));
    }
            
  
    public function updatehome(Request $request)
    {
        // Validate the request
        $request->validate([
            'hero_heading' => 'required|string',
            'hero_paragraph' => 'required|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1000',
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
                $request->hero_image->storeAs('temp', $unique_image);

                // Update the homepage record in the database
                $homepage->update([
                    'hero_heading' => $request->hero_heading,
                    'hero_paragraph' => $request->hero_paragraph,
                    'hero_image' => $unique_image,
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

                $unique_image = uniqid() . '-' . 'hero_image.' . $extension;

                $request->hero_image->move(public_path('/clientside/images'), $unique_image);

                Homepage::create([
                    'hero_heading' => $request->hero_heading,
                    'hero_paragraph' => $request->hero_paragraph,
                    'hero_image' => $unique_image,
                ]);
            } else {
               
                Homepage::create([
                    'hero_heading' => $request->hero_heading,
                    'hero_paragraph' => $request->hero_paragraph,
                ]);
            }


            return redirect()->back()->with('status', 'Homepage Created Successfully.');
        }
    }

    public function indexcategories(Request $request)
    {
        
        $data = Categories::all();
        $categories =  $data->toArray();
        return view('adminpages.categories', compact('categories'));
    }

    public function updatecategory(Request $request)
    {
    
        // Validate the incoming request
        $request->validate([
            'category_name' => 'required|string|max:255',
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

    public function deletecategory(Request $request)
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

    public function createcategory(Request $request)
    {
        // Create a new category record
        Categories::create([
            'category_name' => $request->category_name,
        ]);
    
        // Return a redirect response with a success message
        return redirect()->back()->with('success', 'Record Created Successfully.');
        
    }

    public function homeedit(Request $request)
    {
        return view('adminpages.editpages.homeedit');
    }

    public function CsvImport()
    {
        return view('adminpages.csv');
    }

   
    public function CsvSave(Request $request)
    {
        // Validate the CSV file
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt|max:2048', // Adjust the file size limit if necessary
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve the uploaded CSV file
        $csvFile = $request->file('csv_file');
       // Read the CSV file
        $csvData = array_map('str_getcsv', file($csvFile));

        // Read the CSV file
        $csvData = array_map('str_getcsv', file($csvFile));

        // Extract header row from CSV
        $header = array_shift($csvData);

        // Process the CSV data and insert into the database
        foreach ($csvData as $row) {
            $itemData = [];
            foreach ($header as $index => $columnName) {
                switch ($columnName) {
                    case 'name':
                        $itemData['name'] = $row[$index];
                        break;
                    case 'price':
                        $itemData['price'] = $row[$index];
                        break;
                    case 'image':
                        $itemData['image'] = $row[$index];
                        break;
                    case 'file':
                        $itemData['file'] = $row[$index];
                        break;
                    case 'description':
                        $itemData['description'] = $row[$index];
                        break;
                        case 'category':
                            // Fetch category ID based on the given category name
                            $categoryName = $row[$index];
                            $categoryId = Categories::where('category_name','=',$categoryName)->firstOrFail()->id;
                            $itemData['category']=$categoryId;
                        break;  
                    }
            }
            
            // Generate slug from name
            $itemData['slug'] = Str::slug($itemData['name']);

            // Assuming Item is the model name for your database table
            Item::create($itemData);
        }

        // Redirect back with a success message
        return redirect()->back()->with('status', 'CSV file uploaded and data saved to database.');
    }
   
    public function ExportCsv()
    {
        // Fetch all items from the database
        $items = Item::all();

        // Set CSV file headers
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=items.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        // Define CSV file handle
        $handle = fopen('php://output', 'w');

        // Get the attribute names dynamically from the model
        $attributes = array_diff(array_keys($items->first()->getAttributes()), ['created_at', 'updated_at']);

        // Add CSV headers dynamically
        fputcsv($handle, $attributes);

        // Add data rows
        foreach ($items as $item) {
            // Extract values for each attribute
            $rowData = [];
          
            foreach ($attributes as $attribute) {
                $category = Categories::find($item->category);
                if ($category) {
                    $categoryName = $category->category_name;
                } 
                if ($attribute == 'category') {
                    // Assuming $category_name is the name of the category
                    $rowData[] = $categoryName;
                }else {
                    $rowData[] = $item->{$attribute};
                }            

               
            }
            // Write the data row to the CSV file
            fputcsv($handle, $rowData);
        }

        // Close file handle
        fclose($handle);

        // Return CSV file as response
        return Response::make('', 200, $headers);
    }
}
