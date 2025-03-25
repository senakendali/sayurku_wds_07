<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\Navigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PageManagementController extends Controller
{
    private $view_directory = 'pages.admin.page.';
    private $url = 'page-management';
    private $page_title = 'Page Management';

    public function index(){
        return view($this->view_directory.'index',
            [
                'navigations' => Navigation::where('category', 'admin')->where('status', 'show')->get(),
                'page_title' => $this->page_title,
                'current_page' => $this->url,
                'data' => Page::paginate(10),
                'javascript_file' =>'',
            ]
        );
    }

    public function create(){
        return view($this->view_directory.'create',
            [
                'navigations' => Navigation::where('category', 'admin')->where('status', 'show')->get(),
                'page_title' => $this->page_title,
                'current_page' => $this->url,
                'javascript_file' =>'admin/page/create.js',
            ]
        );
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,png',
        ]);

        $folder_destination = 'uploads/pages';
        $file = $request->file('image');
        $file_name = time().'-'.$request->file('image')->getClientOriginalName();
        $file->move($folder_destination, $file_name);

        try{
            $data['title'] = $request->title;
            $data['slug'] = Str::slug($request->title);
            $data['content'] = $request->content;
            $data['image'] = $folder_destination.'/'.$file_name;
            if(Page::create($data)){
                return response()->json([
                    'status' => 201,
                    'message' => 'The pages has been added.'
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => 'Sorry, failed to add the product.'
                ]);
            }
        }catch(\Exception $error){
            return response()->json([
                'status' => 422,
                'message' => 'Sorry, failed to add the product.' .$error->getMessage()
            ]);
        }
    }

    public function edit($id){
        return view($this->view_directory.'edit',
            [
                'navigations' => Navigation::where('category', 'admin')->where('status', 'show')->get(),
                'page_title' => $this->page_title,
                'current_page' => $this->url,
                'detail' => Page::find($id),
                'javascript_file' =>'admin/page/edit.js',
            ]
        );
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        try{
            $data = Page::find($request->id);

            if($data){
                $data->title = $request->title;
                $data->slug = Str::slug($request->title);
                $data->content = $request->content;

                if($request->file('image')){
                    $folder_destination = 'uploads/pages';
                    $file = $request->file('image');
                    $file_name = time().'-'.$request->file('image')->getClientOriginalName();
                    $file->move($folder_destination, $file_name);

                    $data->image = $folder_destination.'/'.$file_name;
                }

                $data->save();
            }

            return response()->json([
                'status' => 201,
                'message' => 'The product has been updated',
            ]);

        }catch(\Exception $error){
            return response()->json([
                'status' => 422,
                'message' => 'Failed to update data' .$error->getMessage(),
            ]);
        }
    }

    public function destroy($id){
        $data = Page::find($id);
        if($data){
            $data->delete();
            session::flash('message', 'The data has been deleted');
            return redirect('/page-management');
        }
    }
}
