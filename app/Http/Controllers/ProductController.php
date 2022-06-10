<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use App\DataTables\BookDataTable; 
use App\Models\Writer;
use App\Models\Publisher;
use App\Models\Category;


use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(  )
   
    {
        $books = Book::getAllBook();
        
        return view('admin.product.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers=Publisher::get();
        $category=Category::get();
        $writers = Writer::get();
        return view('admin.product.create')->with("publishers", $publishers)->with("category", $category)->with("writers", $writers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'image'=>'image|file|max:2048',
            'stock'=>"required|numeric",
            'category_id'=>'required|exists:category,id',
            'publisher_id'=>'required|exists:publishers,id',
            'writer_id'=>'required|exists:writer,id',
            'status'=>'required|in:active,inactive',
            'price'=>'required|numeric',
            'discount' => 'required|numeric'
        ]);


        $book = $request->all();
        //store image 
        if($request->file('image')){
            $book['image'] = $request->file('image')->store('images');    
        }
    
        $slug = Str::slug($request->name);
        
        //make sure slug unique in database and if exist add a number to the end of slug
        // $count = Book::where('slug', $slug)->count();
        // if($count > 0){
        //     $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        // };

        $book['slug'] = $slug;

        $status=Book::create($book);
        if($status){
            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $publishers=Publisher::get();
        $product=Book::findOrFail($id);
        $category=Category::get();
        $writers = Writer::get();
        // return $items;
        return view('admin.product.edit')->with('product',$product)
                    ->with('publishers',$publishers)
                    ->with('category',$category)
                    ->with('writers',$writers);
       
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


        $book=Book::findOrFail($id);
        $this->validate($request,[
            'name' => 'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'image'=>'image|file|max:2048',
            'stock'=>"required|numeric",
            'category_id'=>'required|exists:category,id',
            'publisher_id'=>'required|exists:publishers,id',
            'writer_id'=>'required|exists:writer,id',
            'status'=>'required|in:active,inactive',
            'price'=>'required|numeric',
            'discount' => 'required|numeric'
        ]);


        $data = $request->all();
        //store image 
        if($request->file('image')){
            $data['image'] = $request->file('image')->store('images');    
        }
        $data['image'] = $book['image'];
    
        $slug = Str::slug($request->name);
        
        //make sure slug unique in database and if exist add a number to the end of slug
        // $count = Book::where('slug', $slug)->count();
        // if($count > 0){
        //     $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        // };

        $data['slug'] = $slug;


        $status=$book->fill($data)->save();
        if($status){
            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Book::findOrFail($id);
        $status=$product->delete();
        
        if($status){
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('product.index');
    }
}
