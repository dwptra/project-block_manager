<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Block;
use App\Models\BlockCategory;
use App\Models\Page;
use App\Models\PageDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    // Blocks
    public function print($pageId)
    {
        $pagePrint = Page::findOrFail($pageId);
        $projectPrint = Project::findOrFail($pagePrint->project_id);
        $blockPrint = PageDetails::with('blocks')->where('page_id', $pageId)->orderby('sort', 'asc')->get();
    
        return view('print.block_print', compact('pagePrint', 'blockPrint', 'projectPrint'));
    }    
    
    public function blockMaster()
    {
        $blockCategory = Block::with('categories')->get();
        return view('block_master.block_master', compact('blockCategory'));
    }
    
    public function blockMasterCreate()
    {
        $blockCategoryCreate = BlockCategory::all();

        return view('block_master.block_master_create', compact('blockCategoryCreate'));
    }
    
    public function blockMasterPost(Request $request)
    {
        $request->validate([
            'block_name' => 'required',
            'category_id' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'mobile_image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'sample_image_1' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'sample_image_2' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        
        $mainImage = $request->file('main_image')->store('public/images/main_image');
        $mobileImage = $request->file('mobile_image')->store('public/images/mobile_image');
        $sampelImage1 = $request->file('sample_image_1')->store('public/images/sample_image_1');
        $sampelImage2 = $request->file('sample_image_2')->store('public/images/sample_image_2');

        Block::create([
            'block_name' => $request->block_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => $request->status,
            'main_image' => $mainImage,
            'mobile_image' => $mobileImage,
            'sample_image_1' => $sampelImage1,
            'sample_image_2' => $sampelImage2,
        ]);

        return redirect()->route('block.master')->with('createBlockMaster', 'Berhasil membuat block');
    }

    public function blockMasterView()
    {

        return view('block_master.block_master_view');
    }

    public function blockMasterEdit($id)
    {
        $blockEdit = Block::findOrFail($id);
        $blockCategoryEdit = BlockCategory::all();
        
        return view('block_master.block_master_edit', compact('blockEdit', 'blockCategoryEdit'));
    }

    public function blockMasterUpdate(Request $request, $id)
    {
        $request->validate([
            'block_name' => 'required',
            'category_id' => 'required',
            'main_image' => 'image|mimes:jpeg,png,jpg',
            'mobile_image' => 'image|mimes:jpeg,png,jpg',
            'sample_image_1' => 'image|mimes:jpeg,png,jpg',
            'sample_image_2' => 'image|mimes:jpeg,png,jpg',
        ]);
        
        $block = Block::findOrFail($id);

        $mainImage = $block->main_image;
        $mobileImage = $block->mobile_image;
        $sampelImage1 = $block->sample_image_1;
        $sampelImage2 = $block->sample_image_2;

        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image')->store('public/images/main_image');
            Storage::delete('public/images/main_image/' . $block->main_image);
        }
        if ($request->hasFile('mobile_image')) {
            $mobileImage = $request->file('mobile_image')->store('public/images/mobile_image');
            Storage::delete('public/images/mobile_image/' . $block->mobile_image);
        }
        if ($request->hasFile('sample_image_1')) {
            $sampelImage1 = $request->file('sample_image_1')->store('public/images/sample_image_1');
            Storage::delete('public/images/sample_image_1/' . $block->sample_image_1);
        }
        if ($request->hasFile('sample_image_2')) {
            $sampelImage2 = $request->file('sample_image_2')->store('public/images/sample_image_2');
            Storage::delete('public/images/sample_image_2/' . $block->sample_image_2);
        }

        $block->update([
            'block_name' => $request->block_name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'status' => $request->status,
            'main_image' => $mainImage,
            'mobile_image' => $mobileImage,
            'sample_image_1' => $sampelImage1,
            'sample_image_2' => $sampelImage2,
        ]);
        
        return redirect()->route('block.master')->with('updateBlockMaster', 'Berhasil mengubah block');
    }

    public function blockMasterDelete($id)
    {
        Block::where('id', '=', $id)->delete();
        return redirect()->route('block.master')->with('deleteBlockMaster', 'Berhasil menghapus block');
    }

    public function block($id)
    {
        $pageDB = Page::findOrFail($id);
        $blockList = PageDetails::with('pages')->where('page_id', $id)->get();
        return view('blocks.block', compact( 'blockList', 'pageDB'));
    }

    public function deleteBlock($id)
    {
        $block_delete = PageDetails::findOrFail($id);
        $block_delete->delete();
        // Berhasil menghapus data, arahkan kembali ke halaman /block dengan pemberitahuan
        return redirect()->route('block', $block_delete->page_id)->with('deleteBlock', 'Berhasil menghapus data!');
    }

    public function blockCreate($id)
    {
        $page    = Page::with('projects', 'projects.projectManager')->findOrFail($id);
        $blockDB = Block::with('categories')->get();
        return view('blocks.block_create', compact('page', 'blockDB'));
    }

    public function postBlock(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $request->validate([
            'section_name' => 'required|min:3',
            'block_id' => 'required',
        ]);



        // Membuat data baru dengan isian dari request
        PageDetails::create([
            'section_name' => $request->section_name,
            'note' => $request->note,
            'block_id' => $request->block_id,
            'page_id' => $page->id, //mengambil id dari objek page
            'sort' => $request->sort,
        ]);
        
        // Jika berhasil, arahkan ke halaman /page dengan pemberitahuan berhasil
        return redirect()->route('block', $page->id)->with('createblock', 'Berhasil membuat block!');
    }

    public function blockEdit($id)
    {
        $blockEdit = PageDetails::findOrFail($id);
        $sort = PageDetails::all();
        $blockDB   = Block::all();
        $page      = Page::with('projects', 'projects.projectManager')->findOrFail($blockEdit->page_id);
        
        // $pageSec = Page::select('pages.*', 'projects.project_name as project_name', 'project_managers.name as project_manager')
        //                 ->join('projects', 'projects.id', '=', 'pages.project_id')
        //                 ->join('project_managers', 'project_managers.id', '=', 'projects.project_manager')
        //                 ->find($blockEdit->page_id);
        
        return view('blocks.block_edit', compact('blockDB', 'blockEdit', 'page', 'sort'));
    } 

    public function updateBlock(Request $request, $id)
    {
        $request->validate([
            'section_name' => 'required|min:3',
            'block_id' => 'required',
        ]);

        $page = PageDetails::findOrFail($id);

        // Dapatkan project_id dari halaman yang diupdate
        $page_id = $page->page_id;

        // Ubah sort dari item yang sedang diedit menjadi sort yang baru diinputkan
        $newSort = $request->sort;
        $oldSort = $page->sort;
        $page->update([
            'section_name' => $request->section_name,
            'note' => $request->note,
            'block_id' => $request->block_id,
            'sort' => $newSort,
        ]);

        // Cek apakah ada item lain dengan sort id yang sama
        $sameSortItems = PageDetails::where('page_id', $page_id)->where('sort', $newSort)->get();
        if ($sameSortItems->count() > 1) {
            // Jika ada, maka tukar sort dengan item yang memiliki nilai sort berbeda
            foreach ($sameSortItems as $item) {
                if ($item->id != $id) {
                    $tempSort = $item->sort;
                    $item->update(['sort' => $oldSort]);
                    $page->update(['sort' => $tempSort]);
                    break;
                }
            }
        } else {
            // Jika tidak ada, update sort id dari item lain yang berbeda
            $otherItems = PageDetails::where('page_id', $page_id)->where('id', '<>', $id)->orderBy('sort')->get();
            $currentSort = 1;
            foreach ($otherItems as $item) {
                if ($item->sort == $newSort) {
                    $item->update(['sort' => $currentSort]);
                } else {
                    $currentSort = $item->sort;
                    $item->update(['sort' => $currentSort]);
                }
            }
        }

        // Kalau berhasil, arahkan ke halaman proyek dengan pemberitahuan berhasil
        return redirect()->route('block', $page_id)->with('updatePage', 'Berhasil mengubah page!');
    }

    public function blockCategory()
    {
        $categoriesDB = BlockCategory::all();
        return view('blocks.block_categories', compact('categoriesDB'));
    }

    public function postCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|min:3',
        ]);

        // bikin data baru dengan isian dari request
        BlockCategory::create([
            'category_name' => $request->category_name,
        ]);
        return redirect()->route('block.categories')->with('createCategory', 'Berhasil membuat Category baru!');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|min:3'
        ]);

        BlockCategory::find($id)->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('block.categories')->with('updateCategory', 'Berhasil merubah Category!');
    }

    public function deleteCategory(Request $request, $id)
    {
        BlockCategory::where('id', '=', $id)->delete();
        return redirect()->route('block.categories')->with('deleteCategory', 'Berhasil menghapus Category.');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Block $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Block $block)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block)
    {
        //
    }
}