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
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Navbar;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;





class PagesSettingController extends Controller
{
 
    public function dashboard() {
            
        // Last 7 days date range
        $last7DaysStartDate = Carbon::now()->subDays(6)->startOfDay(); // Start from 7 days ago
        $last7DaysEndDate = Carbon::now()->endOfDay(); // Today's date

        // Last 30 days date range
        $last30DaysStartDate = Carbon::now()->subDays(29)->startOfDay(); // Start from 30 days ago
        $last30DaysEndDate = Carbon::now()->endOfDay(); // Today's date

        // Total price for last week
        $last7days_sale = DB::table('purchases')
            ->join('items', 'purchases.item_id', '=', 'items.id')
            ->whereBetween('purchases.created_at', [$last7DaysStartDate, $last7DaysEndDate])
            ->sum(DB::raw('items.price'));

        // Total price for last month
        $last30days_sale = DB::table('purchases')
            ->join('items', 'purchases.item_id', '=', 'items.id')
            ->whereBetween('purchases.created_at', [$last30DaysStartDate, $last30DaysEndDate])
            ->sum(DB::raw('items.price'));

        $totalSaleAmount = Purchase::join('items', 'purchases.item_id', '=', 'items.id')
        ->sum('items.price');

      
        $totalItemCount = Purchase::count('item_id');

        $last7days_item_count = DB::table('purchases')
        ->join('items', 'purchases.item_id', '=', 'items.id')
        ->whereBetween('purchases.created_at', [$last7DaysStartDate, $last7DaysEndDate])
        ->count(); // Count the number of records returned by the query

               
        $last30DaysSaleCount = DB::table('purchases')
        ->join('items', 'purchases.item_id', '=', 'items.id')
        ->whereBetween('purchases.created_at', [$last30DaysStartDate, $last30DaysEndDate])
        ->count();

        $users = DB::table('users')
        ->where('role', 0)
        ->get();




        return view('adminpages.dashboard', [
            // sales
            'totalsale' => $totalSaleAmount,
            'lastweek' => $last7days_sale,
            'lastmonth' => $last30days_sale,

            // items sold
            'total_item_sold' => $totalItemCount,
            'last7days_items_sold'=>$last7days_item_count, 
            'last30days_items_sold'=>$last30DaysSaleCount,

            // registered users
            'users'=>$users
        ]);

    }

   

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
            'image' => 'required|url',
            'bookfile' => 'required|url',
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

    
        // Process the validated data and store it in the database
        $item = new Item();
        $item->name = $validatedData['name'];
        $item->price = $validatedData['price'];
        $item->image = $validatedData['image'];
        $item->file = $validatedData['bookfile'];
        $item->category = $validatedData['category'];
        $item->description = $validatedData['description'];
        $item->slug = $uniqueSlug;
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
            'image' => 'url', // Example validation for image file
            'bookfile' => 'url', // Example validation for file
        ]);
    
        // Update item attributes with the new data
        $item->name = $request->name;
        $item->price = $request->price;
        $item->image = $request->image;
        $item->file = $request->bookfile;
        $item->category = $request->category;
        $item->description = $request->description;
    
       
    
        // Save the changes to the database
        $item->save();
    
        return redirect()->back()->with('success', 'Item updated successfully');
    }
    

    public function deleteitem($id)
    {

        $item = Item::find($id);
        // Delete the item
        $item->delete();

        // Find the purchase record by its ID
        $purchase = Purchase::where('item_id',$id);
        // Delete the purchase record
        $purchase->delete();

        $imagePath = public_path('book_images/' . $item->image);
        if (file_exists($imagePath)) {
            unlink($imagePath); // Deletes the image file
        }

         
    
        // Delete file
        $filePath = public_path('book_files/' . $item->file);
        if (file_exists($filePath)) {
            unlink($filePath); // Deletes the file
        }

       

    
      
    
        return redirect()->route('indexitem')->with('error', 'Item deleted successfully.');
    }

    public function indexhome()
    {
        // Fetch the homepage data
        $homepage = Homepage::first(); // Retrieve the first homepage record
    
        // Pass the data to the view
        return view('adminpages.editpages.homesetting', compact('homepage'));
    }

    public function editmanu()
    {
          return view('adminpages.editpages.editmanu');
    }


    public function deleteManu(Request $request) 
    {
        $filename = $request->filename;
        //   deleting the nambar
        $id = $request->id;
        $nav = Navbar::find($id);
        $nav->delete();

        $filename = $request->filename;
        $filePath = resource_path("views/clientpages/{$filename}.blade.php");
        
        if (File::exists($filePath)) {
            File::delete($filePath);
            $message = "File '{$filename}.blade.php' has been deleted successfully.";
            return redirect()->back()->with('success', $message); 
        } else {
            $error = "File '{$filename}.blade.php' does not exist.";
            return redirect()->back()->with('error', $error); 
        }
        
    }

    public function updateOrder(Request $request)
    {
       
        foreach ($request->updated_data as $key => $value) {
           dd($value);
        }
        $filtered = $request->updated_data;
        foreach ($filtered as $value) {
            dd($value['name']);
        }
       
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
            'csv_file' => 'required|file|mimes:txt,csv',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Retrieve the uploaded CSV file
        $csvFile = $request->file('csv_file');
        
        // Read the CSV file
        $csvData = array_map('str_getcsv', file($csvFile));
        
        // Extract header row from CSV
        $header = array_shift($csvData);
        
        // Define the required columns
        $requiredColumns = ['name', 'price', 'description', 'category'];
        
        // Check if all required columns exist in the header
        $missingColumns = array_diff($requiredColumns, $header);
        
        if (!empty($missingColumns)) {
            // Construct the error message
            $errorMessage = 'The CSV file is missing the following column(s): ' . implode(', ', $missingColumns);
            return redirect()->back()->with('error', $errorMessage);
        }
        
        // Check for empty cells
        foreach ($csvData as $idx => $row) {
            foreach ($row as  $value) {
                if ($value === "") {
                    return redirect()->back()->with('error', 'Empty cell found at (Row '.($idx + 2).'). Please fill in the missing data.');
                }
            }
        }
        
        // Process the CSV data and insert into the database
        try {
            DB::beginTransaction();

            
        
            foreach ($csvData as $indx => $row) {

                
                $itemData = [];
                foreach ($header as $index => $columnName) {
                    switch ($columnName) {
                        case 'name':
                        case 'price':
                        case 'image':
                        case 'file':
                        case 'description':
                            $itemData[$columnName] = $row[$index];
                            break;
                        case 'category':
                            // Fetch category ID based on the given category name
                            $categoryName = $row[$index];

                            // Check if the category exists in the database
                            $categoryId = Categories::where('category_name', $categoryName)->value('id');
                            
                            if ($categoryId) {
                                // If the category exists, assign its ID to the item data
                                $itemData['category'] = $categoryId;
                            } else {
                                // If the category doesn't exist, create it
                                $newCategory = Categories::create(['category_name' => $categoryName]);
                            
                                // Check if the category was created successfully
                                if ($newCategory) {
                                    // Assign the newly created category's ID to the item data
                                    $itemData['category'] = $newCategory->id;
                                } else {
                                    // Log error and skip insertion
                                    Log::error("Failed to create category '$categoryName' for item '{$row['name']}'");
                                    continue 2; // Skip to the next row
                                }
                            }
                            
                        break;                            
                    }
                }
        
                // Generate slug from name
                $itemData['slug'] = Str::slug($itemData['name']);
        
                // Insert into the database
                Item::create($itemData);
            }
        
            DB::commit();
        
            // Redirect back with a success message
            return redirect()->back()->with('status', 'CSV file uploaded and data saved to database.');
        
        } catch (\Exception $e) {
            DB::rollback();
            Log::error("Error processing CSV file: " . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing the CSV file.');
        }
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
        
        $files = Upload::orderBy('created_at', 'desc')->get();
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
