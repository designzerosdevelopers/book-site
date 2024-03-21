<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;
use App\Models\Upload;
use App\Models\Settings;
use App\Models\Categories;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;






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
        // Fetch specific columns from the database
        $items = DB::table('items')->select('id', 'name', 'price', 'image', 'file', 'description', 'category')->get();
    
        // Fetch category data from the category table
        $categories = DB::table('categories')->pluck('category_name', 'id');
    
        // Create CSV file content
        $csvData = '';
    
        // Add header row
        if (!empty($items)) {
            $csvData .= "id,name,price,image,file,description,category\n";
    
            // Add data rows
            foreach ($items as $item) {
                // Escape commas in description and category
                $description = str_replace(',', ' ', $item->description);
                $categoryName = isset($categories[$item->category]) ? $categories[$item->category] : '';
    
                // Combine all fields into CSV format
                $csvData .= "{$item->id},{$item->name},{$item->price},{$item->image},{$item->file},\"{$description}\",\"{$categoryName}\"\n";
            }
        }
    
        // Set headers for CSV file download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="items.csv"',
        ];
    
        // Return CSV file as response with appropriate headers
        return response()->make($csvData, 200, $headers);
    }

    function uploadsindex()
    {
        $files = Upload::get();
        return view('adminpages.uploads', ['uploadedFiles' => $files]);
    }

    function saveuploads(Request $request)
    {
        
        if ($request->hasFile('uploadfiles')) {
            $files = $request->file('uploadfiles');
           
            foreach ($files as $file) {
                // Validate file extension
                $validator = Validator::make(['file' => $file], [
                    'file' => 'mimes:pdf,jpeg,png,gif|required|max:2048', // Adjust max file size if needed
                ]);
        
                if ($validator->fails()) {
                    // Flash validation errors to the session
                    $request->session()->flash('upload_errors', $validator->errors()->all());
                    return redirect()->back();
                }
        
                // Generate a unique filename
                $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension(); 
        
                // Move each uploaded file to a new location
                $file->move(public_path('uploads'), $filename);  
        
                // Save file information to the database
                Upload::create([
                    'file' => $filename,
                ]);
            }
        
            // Set success message in session flash data
            if (!$request->session()->has('success')) {
                $request->session()->flash('success', 'Uploaded successfully!');
            }
        
            return redirect()->back();
        } else {
            return 'No file uploaded.';
        }
        
        
        
    }

   
    public function deleteUploads(Request $request)
    {
        $id = $request->deleteid;
        $upload = Upload::find($id); // Find the Upload model instance by its id
        
        if ($upload) {
            $file = public_path('uploads/') . $upload->file; // Construct the absolute file path
        
            // Ensure that $file contains a safe path
            if (file_exists($file)) {
                if (unlink($file)) {
                    $upload->delete(); // Delete the Upload
                    // Redirect back to the previous page with success message
                    return redirect()->back()->with('error', 'File deleted successfully');
                } else {
                    // Redirect back to the previous page with error message
                    return redirect()->back()->with('error', 'Failed to delete file');
                }
            } else {
                // Redirect back to the previous page with error message
                return redirect()->back()->with('error', 'File not found or not writable');
            }
        } else {
            // Redirect back to the previous page with error message
            return redirect()->back()->with('error', 'Upload not found');
        }
        
    }

    public function purchases()
    {
        // get user id from auth
        $userid = Auth()->id();

        
        // fetch from item table 
        $itemIds = [];
        $purchases = Purchase::where('user_id', $userid)->get();
        
        foreach ($purchases as $purchase) {
            $itemIds[] = $purchase->item_id;
        }
        
        // Retrieve items based on the collected item IDs
        $items = Item::whereIn('id', $itemIds)->get();
        
    
        
         // Return the view with cart data
         return view('adminpages.purchases', [
            'cartItems' => $items,
        ]);
    }

    public function settingsindex()
    {
        $settings = Settings::get(["key", "value", "display_name"]);

        $stripeSettings = [];
        $paypalSettings = [];
        
        foreach ($settings as $setting) {
            if ($setting->key === 'STRIPE_KEY' || $setting->key === 'STRIPE_SECRET') {
                $stripeSettings[] = $setting;
            } elseif ($setting->key === 'PAYPAL_KEY' || $setting->key === 'PAYPAL_SECRET') {
                $paypalSettings[] = $setting;
            }
        }
       
        return view("adminpages.setting", ['stripeSettings' => $stripeSettings, 'paypalSettings' => $paypalSettings]);
    }

    
    public function updatesettings(Request $request)
    {
        // Update settings where key is 'STRIPE_KEY'
        if (!is_null($request->STRIPE_KEY)) {
            Settings::where('key', 'STRIPE_KEY')->update(['value' => $request->STRIPE_KEY]);
        }
    
        // Update settings where key is 'STRIPE_SECRET'
        if (!is_null($request->STRIPE_SECRET)) {
            Settings::where('key', 'STRIPE_SECRET')->update(['value' => $request->STRIPE_SECRET]);
        }
    
        // Update settings where key is 'PAYPAL_KEY'
        if (!is_null($request->PAYPAL_KEY)) {
            Settings::where('key', 'PAYPAL_KEY')->update(['value' => $request->PAYPAL_KEY]);
        }
    
        // Update settings where key is 'PAYPAL_SECRET'
        if (!is_null($request->PAYPAL_SECRET)) {
            Settings::where('key', 'PAYPAL_SECRET')->update(['value' => $request->PAYPAL_SECRET]);
        }
    
        // Flash a success message to the session
        return redirect()->back()->with('success', 'Settings updated successfully');
    }
    

    
    
    
    
        
    
}
