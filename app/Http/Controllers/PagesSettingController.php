<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Upload;
use App\Models\Component;
use App\Models\Settings;
use App\Models\Categories;
use App\Models\Item;
use App\Models\Home;
use App\Models\Footer;
use App\Models\Contact;
use App\Models\About;
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



    // public function deleteManu(Request $request) 
    // {
    //     $filename = $request->filename;
    //     //   deleting the nambar
    //     $id = $request->id;
    //     $nav = Navbar::find($id);
    //     $nav->delete();

    //     $filename = $request->filename;
    //     $filePath = resource_path("views/clientpages/{$filename}.blade.php");

    //     if (File::exists($filePath)) {
    //         File::delete($filePath);
    //         $message = "File '{$filename}.blade.php' has been deleted successfully.";
    //         return redirect()->back()->with('success', $message); 
    //     } else {
    //         $error = "File '{$filename}.blade.php' does not exist.";
    //         return redirect()->back()->with('error', $error); 
    //     }

    // }




    public function updatehome(Request $request)
    {
        $formType = $request->input('section');


        switch ($formType) {
            case 'hero_section':
                // You can access form data using $request->input('field_name')
                // Validate the request
                $request->validate([
                    'hero_heading' => 'required|string',
                    'hero_paragraph' => 'required|string',
                    'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1000',
                ]);

                // Fetch the existing pages record
                $pages = Home::first();

                if ($pages) {
                    // Update only if the user uploaded a new image
                    if ($request->hasFile('hero_image')) {
                        if (!empty($pages->hero_image)) {
                            // Delete the existing image file if it exists
                            if (file_exists(public_path('clientside/images/' . $pages->hero_image))) {
                                unlink(public_path('clientside/images/' . $pages->hero_image));
                            }
                        }

                        // Get the original file name and extension
                        $original_image = $request->hero_image->getClientOriginalName();
                        $extension = $request->hero_image->getClientOriginalExtension();

                        // Generate a unique file name
                        $unique_image = uniqid() . '-' . 'hero_image.' . $extension;

                        // Move the uploaded file to a temporary location
                        $request->hero_image->storeAs('temp', $unique_image);

                        // Update the pages record in the database
                        $pages->update([
                            'hero_heading' => $request->hero_heading,
                            'hero_paragraph' => $request->hero_paragraph,
                            'hero_image' => $unique_image,
                        ]);

                        // Move the uploaded file to the public images folder with its original extension
                        $request->hero_image->move(public_path('/clientside/images'), $unique_image);
                        return redirect()->back()->with('status', 'Product section Updated Successfully.');
                    } else {
                        // Update only text fields if no new image is uploaded
                        $update = $pages->update([
                            'hero_heading' => $request->hero_heading,
                            'hero_paragraph' => $request->hero_paragraph,
                        ]);
                        if ($update) {
                            return redirect()->back()->with('status', 'Product section Updated Successfully, but image is not given');
                        }
                    }
                } else {
                    // If no pages record exists, create a new one
                    if ($request->hasFile('hero_image')) {
                        // Get the original file name and extension
                        $original_image = $request->hero_image->getClientOriginalName();
                        $extension = $request->hero_image->getClientOriginalExtension();

                        $unique_image = uniqid() . '-' . 'hero_image.' . $extension;

                        $request->hero_image->move(public_path('/clientside/images'), $unique_image);

                        $home = Home::create([
                            'hero_heading' => $request->hero_heading,
                            'hero_paragraph' => $request->hero_paragraph,
                            'hero_image' => $unique_image,
                        ]);
                        if ($home) {
                            return redirect()->back()->with('status', 'Product section created Successfully.');
                        }
                    } else {
                        Home::create([
                            'hero_heading' => $request->hero_heading,
                            'hero_paragraph' => $request->hero_paragraph,
                        ]);
                        return redirect()->back()->with('status', 'Product section created Successfully. but image is not given!');
                    }
                }
                break;
            case 'product_section':

                // Fetch only the specified fields from the pages table
                $pages = Home::first();

                // Check if the record exists
                if ($pages) {
                    // Update the fields
                    $pages->ps_title = $request->section_title;
                    $pages->ps_description = $request->section_description;

                    // Save the changes to the database
                    $pages->save();

                    // Optionally, you can return a success message or perform other actions
                    return redirect()->back()->with("status", " Product section title and description updated successfully.");
                } else {
                    // Create a new record with the provided data
                    $pages = Home::create([
                        'ps_title' => $request->section_title,
                        'ps_description' => $request->section_description,
                    ]);

                    // Optionally, you can return a success message or perform other actions
                    return redirect()->back()->with("status", " section title and description created successfully.");
                }
                break;
            case 'why_choose_us':
                $data = $request->only([
                    'section_title',
                    'section_description',
                    'feature_1',
                    'feature_1_description',
                    'feature_2',
                    'feature_2_description',
                    'feature_3',
                    'feature_3_description',
                    'feature_4',
                    'feature_4_description',
                    'wcu_image'
                ]);

                $columns =  [
                    'wcu_title',
                    'wcu_description',
                    'wcu_feature_1_title',
                    'wcu_feature_1_description',
                    'wcu_feature_2_title',
                    'wcu_feature_2_description',
                    'wcu_feature_3_title',
                    'wcu_feature_3_description',
                    'wcu_feature_4_title',
                    'wcu_feature_4_description',
                    'home_wcu_image',
                ];
                $request->validate([
                    'wcu_image' => 'image|mimes:jpeg,png,jpg,gif',
                ]);
                $pages = Home::first();

                if ($pages) {
                    if ($request->hasFile('wcu_image')) {
                        if (!empty($pages->home_wcu_image)) {
                            // Delete the existing image file if it exists
                            if (file_exists(public_path('clientside/images/' . $pages->home_wcu_image))) {
                                unlink(public_path('clientside/images/' . $pages->home_wcu_image));
                            }
                        }

                        // Get the original file name and extension
                        $original_image = $request->wcu_image->getClientOriginalName();
                        $extension = $request->wcu_image->getClientOriginalExtension();

                        // Generate a unique file name
                        $unique_image = uniqid() . '-' . 'image.' . $extension;

                        // Move the uploaded file to a temporary location
                        $request->wcu_image->storeAs('temp', $unique_image);

                        // Move the uploaded file to the public images folder with its original extension
                        $request->wcu_image->move(public_path('/clientside/images'), $unique_image);

                        $update = $pages->update([
                            $pages->wcu_title = $data['section_title'],
                            $pages->wcu_description = $data['section_description'],
                            $pages->wcu_feature_1_title = $data['feature_1'],
                            $pages->wcu_feature_1_description = $data['feature_1_description'],
                            $pages->wcu_feature_2_title = $data['feature_2'],
                            $pages->wcu_feature_2_description = $data['feature_2_description'],
                            $pages->wcu_feature_3_title = $data['feature_3'],
                            $pages->wcu_feature_3_description = $data['feature_3_description'],
                            $pages->wcu_feature_4_title = $data['feature_4'],
                            $pages->wcu_feature_4_description = $data['feature_4_description'],
                            $pages->home_wcu_image = $unique_image,
                        ]);
                        if ($update) {
                            return redirect()->back()->with('status', 'Why choose us section updated successfully!');
                        }
                    }
                }



                break;
            case 'we_help':
                $columns = [
                    'wh_title',
                    'wh_description',
                    'wh_feature_1',
                    'wh_feature_2',
                    'wh_feature_3',
                    'wh_feature_4',
                ];
                $data = $request->only([
                    'we_help_title',
                    'we_help_description',
                    'feature_1',
                    'feature_2',
                    'feature_3',
                    'feature_4',
                ]);
                $pages = Home::first();
                if ($pages) {
                    $update = $pages->update([
                        $pages->wh_title = $data['we_help_title'],
                        $pages->wh_description = $data['we_help_description'],
                        $pages->wh_feature_1 = $data['feature_1'],
                        $pages->wh_feature_2 = $data['feature_2'],
                        $pages->wh_feature_3 = $data['feature_3'],
                        $pages->wh_feature_4 = $data['feature_4'],

                    ]);
                    if ($update) {
                        return redirect()->back()->with('status', 'We help section updated successfully!');
                    }
                } else {
                    $create = Home::create(array_combine($columns, $data));
                    if ($create) {
                        return redirect()->back()->with('status', 'We help section created successfully!');
                    }
                }
                break;
            case 'about_us':
                $data = $request->only([
                    'about_us_title',
                    'about_us_description',
                ]);
                $pages = About::first();
                if ($pages) {
                    $update = $pages->update([
                        'about_hs_title' => $data['about_us_title'],
                        'about_hs_description' => $data['about_us_description'],
                    ]);
                    if ($update) {
                        return redirect()->back()->with('status', 'About Us section updated successfully!');
                    }
                } else {
                    $update = $pages->create([
                        'about_hs_title' => $data['about_us_title'],
                        'about_hs_description' => $data['about_us_description'],
                    ]);
                    if ($update) {
                        return redirect()->back()->with('status', 'About Us section created successfully!');
                    } else {
                        return redirect()->back()->with('error', 'About Us section could not be Created/updated!');
                    }
                }
                break;
            case 'contact':
                $data = $request->only([
                    'contact_hs_title',
                    'contact_hs_description',
                ]);
                $pages = Contact::first();
                if ($pages) {
                    $update = $pages->update([
                        'contact_hs_title' => $data['contact_hs_title'],
                        'contact_hs_description' => $data['contact_hs_description'],
                    ]);
                    if ($update) {
                        return redirect()->back()->with('status', 'Contact section updated successfully!');
                    }
                } else {
                    $update = $pages->create([
                        'contact_hs_title' => $data['contact_hs_title'],
                        'contact_hs_description' => $data['contact_hs_description'],
                    ]);
                    if ($update) {
                        return redirect()->back()->with('status', 'Contact section created successfully!');
                    } else {
                        return redirect()->back()->with('error', 'Contact section could not be Created/updated!');
                    }
                }
                break;
            case 'home_button_1':
                $data =  $request->only([
                    'button_1_name',
                    'button_1_url',
                ]);
                $pages = Home::first();
                $update = $pages->update([
                    $pages->button_1_name = $data['button_1_name'],
                    $pages->button_1_url = $data['button_1_url'],
                ]);
                if ($update) {
                    return redirect()->back()->with('status', ' Section updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Section could not be Created/updated!');
                }

                break;
            case 'home_button_2':
                $data =  $request->only([
                    'button_2_name',
                    'button_2_url',
                ]);
                $pages = Home::first();
                $update = $pages->update([
                    $pages->button_2_name = $data['button_2_name'],
                    $pages->button_2_url = $data['button_2_url'],
                ]);
                if ($update) {
                    return redirect()->back()->with('status', ' Section updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Section could not be Created/updated!');
                }

                break;
            case 'about_button_1':
                $data =  $request->only([
                    'button_1_name',
                    'button_1_url',
                ]);
                $pages = About::first();
                $update = $pages->update([
                    $pages->button_1_name = $data['button_1_name'],
                    $pages->button_1_url = $data['button_1_url'],
                ]);
                if ($update) {
                    return redirect()->back()->with('status', ' Section updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Section could not be Created/updated!');
                }
                break;
            case 'about_button_2':
                $data =  $request->only([
                    'button_2_name',
                    'button_2_url',
                ]);
                $pages = About::first();
                $update = $pages->update([
                    $pages->button_2_name = $data['button_2_name'],
                    $pages->button_2_url = $data['button_2_url'],
                ]);
                if ($update) {
                    return redirect()->back()->with('status', ' Section updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Section could not be Created/updated!');
                }

                break;
            case 'contact_button_1':
                $data =  $request->only([
                    'button_1_name',
                    'button_1_url',
                ]);
                $pages = Contact::first();
                $update = $pages->update([
                    $pages->button_1_name = $data['button_1_name'],
                    $pages->button_1_url = $data['button_1_url'],
                ]);
                if ($update) {
                    return redirect()->back()->with('status', ' Section updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Section could not be Created/updated!');
                }

                break;
            case 'contact_button_2':
                $data =  $request->only([
                    'button_2_name',
                    'button_2_url',
                ]);
                $pages = Contact::first();
                $update = $pages->update([
                    $pages->button_2_name = $data['button_2_name'],
                    $pages->button_2_url = $data['button_2_url'],
                ]);
                if ($update) {
                    return redirect()->back()->with('status', ' Section updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Section could not be Created/updated!');
                }
                break;
            case 'site_name':
                $data =  $request->only([
                    'site_name',
                ]);
                $pages = Home::first();
                $update = $pages->update([
                    $pages->site_name = $data['site_name'],
                ]);
                if ($update) {
                    return redirect()->back()->with('status', ' Site name updated successfully!');
                } else {
                    return redirect()->back()->with('error', ' Site name could not be Created/updated!');
                }
                break;
            default:
                return redirect()->back()->with('error', 'Invalid Request');
                break;
        }
    }

    public function upload_image()
    {
        // Simulate an error response
        return response()->json(['status' => 'success', 'message' => 'request successt'], 200);
    }
    

    public function updatePage(Request $r)
{
    if ($r->isXmlHttpRequest()) {
        // Handle AJAX request
        $image = $r->file('image');
        $imageName = $image->getClientOriginalName(); // Use the original filename
        $imagePath = public_path('images');
        
        // Move the new image to the images folder
        $image->move($imagePath, $imageName);
        $imageUrl = asset('images/' . $imageName);
        
        return response()->json(['url' => $imageUrl]);
    }
    
    

    // Handle non-AJAX request
    if ($r->comp_name == 'home') {
        $component = Component::where('name', 'site_bg');
        $status = $component->update([
            'css' => $r->site_bg
        ]);
    }

    // Uncomment the code below to handle footer component
    // if ($r->comp_name == 'footer') {
    //     // Handle footer component update
    // }

    $component = Component::where('name', $r->comp_name);
    $status = $component->update([
        'html' => $r->html
    ]);

    if ($status == 1) {
        return redirect()->back()->with('status', 'Component updated successfully!');
    } else {
        return redirect()->back()->with('error', 'Component could not be updated!');
    }
}



    public function about_edit()
    {
        $pages = About::first();
        return view('adminpages.editpages.about', compact('pages'));
    }

    public function product()
    {
        return view('adminpages.editpages.product');
    }


    public function shop()
    {
        return view('adminpages.editpages.shop');
    }

    public function update_shop(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'shop' => 'required',
        ]);

        try {

            $shop = Component::where('name', 'shop')->firstOrFail();

            $shop->html = $request->input('shop');

            $shop->save();

            // If successful, redirect back with success message
            return redirect()->back()->with('success', 'Shop data updated successfully');
        } catch (\Exception $e) {
            // If an error occurs, redirect back with error message
            return redirect()->back()->with('error', 'Failed to update shop data: ' . $e->getMessage());
        }
    }


    public function contact_edit()
    {
        $pages = Contact::first();
        return view('adminpages.editpages.contact', compact('pages'));
    }

    public function footer()
    {

        $footerData = Footer::orderBy('id', 'asc')->first();
        $footer = $footerData->footer;
        $css = $footerData->css;
        return view('adminpages.editpages.footer', ['footer' => $footer, 'css' => $css]);
    }
    public function update_footer(Request $request)
    {
        $footer = Footer::orderBy('id', 'asc')->first();
        $html = $request->htmlInput;
        $footer->footer = $html;
        $footer->save();
        return redirect()->back()->with('success', 'Footer updated successfully');
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
