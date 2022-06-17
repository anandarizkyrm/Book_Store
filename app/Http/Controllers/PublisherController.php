<?php

namespace App\Http\Controllers;
use App\Models\Publisher;
use Illuminate\Http\Request;


class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publisher = Publisher::all();
        return view('admin.publisher.index')->with('publisher', $publisher);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publisher=Publisher::orderBy('name','ASC')->get();
        return view('admin.publisher.create')->with('publisher',$publisher);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
      
        $this->validate($request,[
            'name'=>'string|required',
            'email' => 'email|required',
            'address' => 'string|required',
 
        ]);
        $data= $request->all();
 
        // return $data;
        $status=Publisher::create($data);
        if($status){
            request()->session()->flash('success','Publisher successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('publisher.index');

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

        $publisher=Publisher::findOrFail($id);
        return view('admin.publisher.edit')->with('publisher',$publisher);
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
       // return $request->all();
       $category=Publisher::findOrFail($id);
       $this->validate($request,[
           'name'=>'string|required',
           'email' => 'email|required',
           'address' => 'string|required',

       ]);
       $data= $request->all();

       // return $data;
       $status=$category->fill($data)->save();
       if($status){
           request()->session()->flash('success','Publisher successfully updated');
       }
       else{
           request()->session()->flash('error','Error occurred, Please try again!');
       }
       return redirect()->route('publisher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publisher = Publisher::findOrFail($id);
        $book = $publisher->books;

        if(count($book)>0){
            request()->session()->flash('error','Category cannot be deleted as it has books');
            return redirect()->route('publisher.index');
        }
        
        $status = $publisher->delete();
        if($status){
            request()->session()->flash('success','Category successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting publisher');
        }
        return redirect()->route('publisher.index');
    }
}
