<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function PHPUnit\Framework\fileExists;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Category::paginate(5);

        $filterByCategory = $request->get('name');

        if ($filterByCategory) {

            $items = Category::where('name', 'LIKE', "%$filterByCategory%")->paginate(5);
        }

        return view('pages.categories.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_category = new Category;

        $name = $request->get('name');

        $new_category->name = $name;

        if ($request->file('image')) {

            $img_path = $request->file('image')
                ->store('categori_img', 'public');

            $new_category->image = $img_path;
        }

        $new_category->created_by = Auth::user()->id;

        $new_category->slug = Str::slug($name, '-');

        $new_category->save();

        return redirect()->route('categories.index')->with('status', 'Created category is successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Category::findOrFail($id);

        return view('pages.categories.details', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Category::findOrFail($id);

        return view('pages.categories.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->get('name');

        $category = Category::findOrFail($id);

        $category->name = $name;

        if ($request->file('image')) {

            if ($category->image && fileExists(storage_path('app/public/' . $category->image))) {

                Storage::delete('public/' . $category->name);
            }

            $new_image = $request->file('image')->store('categori_img', 'public');

            $category->image = $new_image;
        }
        $category->updated_by = Auth::user()->id;

        $category->slug = Str::slug($name);

        $category->save();

        return redirect()->route('categories.index')->with('status', 'Updated category successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Category::findOrFail($id);

        $item->delete();

        return redirect()->route('categories.index')->with('status', 'Category deleted is successfully, moved to trash');
    }



    public function trash(Request $request)
    {
        $trash_categories = Category::onlyTrashed()->paginate(5);

        $filter_category = $request->get('name');

        if ($filter_category) {

            $trash_categories = Category::onlyTrashed()
                ->where('name', 'LIKE', "%$filter_category%")
                ->paginate(5);
        }

        return view('pages.categories.trash', [

            'trash_categories' => $trash_categories
        ]);
    }


    public function restore($id)
    {
        $restore_category = Category::withTrashed()->findOrFail($id);

        if ($restore_category->trashed()) {

            $restore_category->restore();
        } else {

            return redirect()->route('categories.index')
                ->with('status', 'Category is not in trash');
        }

        return redirect()->route('categories.index')
            ->with('status', 'Category successfully restored');
    }


    public function deletePermanent($id)
    {
        $delete_permanent = Category::withTrashed()->findOrFail($id);

        if (!$delete_permanent->trashed()) {

            return redirect()->route('categories-trash')
                ->with('status', 'Cant not delete permanent active category');
        } else {

            $delete_permanent->forceDelete();

            return redirect()->route('categories-trash')
                ->with('status', 'Deleted permanent is successfully');
        }
    }
}
