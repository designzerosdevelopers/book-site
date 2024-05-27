<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use App\Models\Component;
use App\Models\Settings;
use App\Models\Categories;
use App\Models\Item;
use App\Models\Home;
use App\Models\Purchase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class PagesSettingController extends Controller
{
    public function themeUpdate(Request $r)
    {

        $css = \App\Helpers\SiteviewHelper::page('site')->css;
        
        if ($r->page == 'home') {

             $css = preg_replace('/(\.item-title\s*{[^}]*?color:\s*)([^;]+)(\s* !important\s*;\s*})/i', '$1' . $r->title_color . '$3', $css);
             $css = preg_replace('/(\.item-title\s*{[^}]*?font-size:\s*)([^;]+)(\s* !important\s*;\s*[^}]*})/i', '$1$2' . '0' . $r->title_size . '$3', $css);
             $css = preg_replace('/(\.item-price\s*{[^}]*?color:\s*)([^;]+)(\s* !important\s*;\s*})/i', '$1' . $r->price_color . '$3', $css);
             $css = preg_replace('/(\.item-price\s*{[^}]*?font-size:\s*)([^;]+)(\s* !important\s*;\s*[^}]*})/i', '$1$2' . '0' . $r->price_size . '$3', $css);
             $css = preg_replace('/(\.item-thumbnail-size\s*{\s*.*?height:\s*)([^;]+)(.*?})/s', '$1$2' . '0' . $r->image_height . '$3', $css);
             $css = preg_replace('/(\.item-thumbnail-size\s*{\s*.*?width:\s*)([^;]+)(.*?})/s', '$1$2' . '0' . $r->image_width . '$3', $css);

            Component::where('name', 'home')->update([
                'data' => [
                    'display_product' => $r->display_product,
                    'product_section_title' => $r->section_title,
                    'product_section_description' => $r->section_description,
                    'product_section_button'=> $r->section_button_name,
                    'product_section_button_url'=> $r->section_button_url,
                    ]
            ]);

            Component::where('name', 'site')->update([
                'css' => $css,
            ]);
        } elseif ($r->page == 'shop') {

            Component::where('name', 'shop')->update([
                'data' => ['display_product' => $r->display_product]
            ]);
        } elseif ($r->page == 'contact') {

            $css = preg_replace('/(\.service .service-icon\s*{\s*.*?background:\s*)([^;]+)(.*?})/s', '$1' . $r->iconBG . '$3', $css);
            $css = preg_replace('/(\.service .service-icon\s*{\s*.*?color:\s*)([^;]+)(.*?})/s', '$1' . $r->textColor . '$3', $css);
            Component::where('name', 'site')->update([
                'css' => $css,
            ]);

            Component::where('name', 'contact')->update([
                'data' => [
                    'address' => $r->address,
                    'phone' => $r->phone,
                    'email' => $r->email,
                ]
            ]);

        } elseif ($r->page == 'productdetailsetting') {

            $css = preg_replace('/(\.product-title\s*{\s*.*?color:\s*)([^;]+)(.*?})/s', '$1' . $r->product_title_color . '$3', $css);
            $css = preg_replace('/(\.product-title\s*{\s*.*?font-size:\s*)([^;]+)(.*?})/s', '$1$2' . '0' . $r->product_title_size . '$3', $css);
            $css = preg_replace('/(\.product-price\s*{[^}]*?color:\s*)[^;]+(;[^}]*})/si', '$1' . $r->product_price_color . '$2', $css);
            $css = preg_replace('/(\.product-price\s*{\s*.*?font-size:\s*)([^;]+)(.*?})/s', '$1$2' . '0' . $r->product_price_size . '$3', $css);
            $css = preg_replace('/(\.product-detail-main-img img\s*{\s*.*?height:\s*)([^;]+)(.*?})/s', '$1$2' . '0' . $r->product_image_height . '$3', $css);
            $css = preg_replace('/(\.product-detail-main-img img\s*{\s*.*?width:\s*)([^;]+)(.*?})/s', '$1$2' . '0' . $r->product_image_width . '$3', $css);

            Component::where('name', 'productdetail')->update([
                'data' => [
                    'product_button_name'=> $r->product_button_name,
                    ]
            ]);
            Component::where('name', 'site')->update([
                'css' => $css,
            ]);

        }else {
            $css = preg_replace('/(\.hero\s*{\s*.*?background:\s*)([^;]+)(.*?})/s', '$1' . $r->hero_color . '$3', $css);
            $css = preg_replace('/(body\s*{\s*)(.*?background-color:\s*)([^;]+)(.*?})/s', '$1$2' . $r->bg_color . '$4', $css);
            $css = preg_replace('/(a\s*{\s*)(.*?color:\s*)([^;]+)(.*?})/s', '$1$2' . $r->bg_color . '$4', $css);
            $css = preg_replace('/(\.custom-navbar\s*{\s*.*?background:\s*)([^;]+)(.*?})/s', '$1' . $r->navbar_color . ' !important $3', $css);
            $css = preg_replace('/(\.footer-section\s*{\s*.*?background:\s*)([^;]+)(.*?})/s', '$1' . $r->footer_color . '$3', $css);

            Component::where('name', 'site')->update([
                'css' => $css,
            ]);
        }




        return redirect()->back();
    }


    public function dashboard()
    {

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
            'last7days_items_sold' => $last7days_item_count,
            'last30days_items_sold' => $last30DaysSaleCount,

            // registered users
            'users' => $users
        ]);
    }



    public function indexitem()
    {
        // Fetch the pages data
        $items = Item::get(); // Retrieve the first pages record

        // Pass the data to the view
        return view('adminpages.item.index', ['items' => $items]);
    }

    public function createitem()
    {
        $categories = Categories::get();

        // Pass the data to the view
        return view('adminpages.item.create', ['categories' => $categories]);
    }


    public function storeitem(Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size is 2MB (2048 KB)
            'bookfile' => 'required|file|mimes:pdf|max:10000', // Only PDF files allowed, max size is 10MB (10000 KB)
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

        // Move and get original file name for image
        $imageName = $validatedData['image']->getClientOriginalName();
        $validatedData['image']->move(public_path('book_images'), $imageName);
        $item->image = $imageName;

        // Move and get original file name for bookfile
        $fileName = $validatedData['bookfile']->getClientOriginalName();
        $validatedData['bookfile']->move(public_path('book_files'), $fileName);
        $item->file = $fileName;

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
        return view('adminpages.item.edit', compact('categories', 'item'));
    }

    public function updateitem(Request $request, $id)
    {
        // Retrieve the item by its ID
        $item = Item::find($id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Max size is 2MB (2048 KB)
            'bookfile' => 'file|mimes:pdf|max:10000', // Only PDF files allowed, max size is 10MB (10000 KB)
            'category' => 'required|string',
            'description' => 'required|string',

        ]);


        // Update item attributes with the new data
        $item->name = $request->name;
        $item->price = $request->price;
        $item->category = $request->category;
        $item->description = $request->description;

        // Check if a new image file is provided
        if ($request->hasFile('image')) {
            // Move and get original file name for new image
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('book_images'), $imageName);
            $item->image = $imageName;
        }

        // Check if a new file is provided
        if ($request->hasFile('bookfile')) {
            // Move and get original file name for new file
            $fileName = $request->file('bookfile')->getClientOriginalName();
            $request->file('bookfile')->move(public_path('book_files'), $fileName);
            $item->file = $fileName;
        }

        $item->save();


        return redirect()->back()->with('success', 'Item updated successfully');
    }


    public function deleteitem($id)
    {

        $item = Item::find($id);
        // Delete the item
        $item->delete();

        // Find the purchase record by its ID
        $purchase = Purchase::where('item_id', $id);
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


    public function editmanu()
    {
        return view('adminpages.editpages.editmanu');
    }

    public function indexhome()
    {
        // Fetch the pages data
        $pages = Home::first(); // Retrieve the first pages record

        // Pass the data to the view
        return view('adminpages.editpages.homesetting', compact('pages'));
    }

    public function upload_image(Request $request){

    }

    public function updatePage(Request $r)
    {
        if ($r->isXmlHttpRequest()) {
            // Handle AJAX request

            // Retrieve the uploaded image
            $image = $r->file('image');

            // Get the original name of the uploaded image
            $imageName = $image->getClientOriginalName();

            // Construct the path for the uploaded image
            $imagePath = public_path('images/' . $imageName);

            // Check if the same image already exists
            if (file_exists($imagePath)) {
                // If the image exists, delete it
                unlink($imagePath);
            }


            $image->move(public_path('images'), $imageName);

            $imageUrl = asset('images/' . $imageName);

            return response()->json(['url' => $imageUrl]);
        }




        $component = Component::where('name', $r->comp_name);

        $status = $component->update([
            $r->part => $r->html
        ]);

        if ($status == 1) {
            return redirect()->back()->with('status', 'Component updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Component could not be updated!');
        }

        if ($status == 1) {
            return redirect()->back()->with('status', 'Component updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Component could not be updated!');
        }
    }


    public function indexcategories(Request $request)
    {

        $data = Categories::all();
        $categories =  $data->toArray();
        return view('adminpages.categories', compact('categories'));
    }

    public function createcategory(Request $request)
    {
        $rules = [
            'category_name' => 'required|string|max:255|unique:categories,category_name',
        ];


        // Custom validation messages
        $messages = [
            'category_name.required' => 'Category name is required.',
            'category_name.unique' => 'Category name must be unique.',
            // Add any other custom messages as needed
        ];

        // Validate the request
        $validatedData = $request->validate($rules, $messages);

        // Create a new category record
        Categories::create([
            'category_name' => $category_name = $request->category_name,
        ]);

        // Return a redirect response with a success message
        return redirect()->back()->with('success', 'Record Created Successfully.');
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
                    return redirect()->back()->with('error', 'Empty cell found at (Row ' . ($idx + 2) . '). Please fill in the missing data.');
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
        $paypalSettings = [];
        $mailSettings = [];

        foreach ($settings as $setting) {
            if ($setting->key === 'STRIPE_KEY' || $setting->key === 'STRIPE_SECRET') {
                $stripeSettings[] = $setting;
            } elseif ($setting->key === 'PAYPAL_KEY' || $setting->key === 'PAYPAL_SECRET') {
                $paypalSettings[] = $setting;
            }
        }


        foreach ($settings as $setting) {
            if (
                $setting->key === 'MAIL_MAILER' || $setting->key === 'MAIL_HOST' || $setting->key === 'MAIL_PORT' ||
                $setting->key === 'MAIL_USERNAME' || $setting->key === 'MAIL_PASSWORD' || $setting->key === 'MAIL_ENCRYPTION' ||
                $setting->key === 'MAIL_FROM_ADDRESS' || $setting->key === 'MAIL_FROM_NAME'
            ) {
                $mailSettings[] = $setting;
            }
        }

        return view("adminpages.setting", ['stripeSettings' => $stripeSettings, 'paypalSettings' => $paypalSettings, 'mailSettings' => $mailSettings]);
    }


    public function updatesettings(Request $request)
    {
        $mailSettings = [];
        $updateData = [
            'STRIPE_KEY' => $request->STRIPE_KEY,
            'STRIPE_SECRET' => $request->STRIPE_SECRET,
            'PAYPAL_KEY' => $request->PAYPAL_KEY,
            'PAYPAL_SECRET' => $request->PAYPAL_SECRET,
            'MAIL_MAILER' => $request->MAIL_MAILER,
            'MAIL_HOST' => $request->MAIL_HOST,
            'MAIL_PORT' => $request->MAIL_PORT,
            'MAIL_USERNAME' => $request->MAIL_USERNAME,
            'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
            'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION,
            'MAIL_FROM_ADDRESS' => $request->MAIL_FROM_ADDRESS,
            'MAIL_FROM_NAME' => $request->MAIL_FROM_NAME,
        ];

        foreach ($updateData as $key => $value) {
            if (!is_null($value)) {
                Settings::where('key', $key)->update(['value' => $value]);
            }
        }
        // Fetch data from the database (example)
        $mailSettings = Settings::all();

        // Create a separate array to hold the mail configuration settings
        $configSettings = [];

        foreach ($mailSettings as $setting) {
            // Check if the setting key matches any of the mail configuration keys
            if (in_array($setting->key, ['MAIL_MAILER', 'MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_ENCRYPTION', 'MAIL_FROM_ADDRESS', 'MAIL_FROM_NAME'])) {
                // Add the setting to the configuration settings array
                $configSettings[$setting->key] = $setting->value;
            }
        }

        // Dynamically update the mail configuration
        config(["mail.mailers.smtp" => $configSettings]);

        // Cache the configuration
        Artisan::call('config:cache');



        // Flash a success message to the session
        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}
