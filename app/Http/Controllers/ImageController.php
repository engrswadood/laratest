<?php
  
namespace App\Http\Controllers;
  
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
  
class imageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image_links = Image::latest()->paginate(5);
		$uname = Auth::user()->name;
    
        return view('images.index',compact('image_links', 'uname'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image_link' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
		$uname = Auth::user()->name;
		
        $input = $request->all();
		$input["user_id"] = Auth::user()->id;
		
		
        if ($image_link = $request->file('image_link')) {
            $destinationPath = 'image_link/'.$uname.'/';
            $profileimage_link = date('YmdHis') . "." . $image_link->getClientOriginalExtension();
            $image_link->move($destinationPath, $profileimage_link);
            $input['image_link'] = "$profileimage_link";
        }
    
        Image::create($input);
     
        return redirect()->route('images.index')
                        ->with('success','Image created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $Image_prod
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
		$uname = Auth::user()->name;
        return view('images.show',compact('image', 'uname'));
    }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $Image_prod
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
		$uname = Auth::user()->name;
        return view('images.edit',compact('image', 'uname'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $Image_prod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
		
		$uname = Auth::user()->name;
        $input = $request->all();
  
		$input["user_id"] = Auth::user()->id;
		
  
        if ($image_link = $request->file('image_link')) {
            $destinationPath = 'image_link/'.$uname.'/';
            $profileimage_link = date('YmdHis') . "." . $image_link->getClientOriginalExtension();
            $image_link->move($destinationPath, $profileimage_link);
            $input['image_link'] = "$profileimage_link";
        }else{
            unset($input['image_link']);
        }
          
        $image->update($input);
    
        return redirect()->route('images.index')
                        ->with('success','Image updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $Image_prod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->delete();
     
        return redirect()->route('images.index')
                        ->with('success','Image deleted successfully');
    }
}