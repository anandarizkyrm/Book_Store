<?php

namespace App\Http\Controllers;
use App\Models\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $writer = Writer::all();
        return view('admin.writer.index')->with('writer', $writer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $writer=Writer::orderBy('name','ASC')->get();
        return view('admin.writer.create')->with('writer',$writer);
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
            'email'=>'email|required',
            
        ]);
        $data= $request->all();

        // return $data;   
        $status=Writer::create($data);
        if($status){
            request()->session()->flash('success','Writer successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('writer.index');

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
        $writer=Writer::get();
    
        return view('admin.writer.edit')->with('writer',$writer);
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
         $writer=Writer::findOrFail($id);
         $this->validate($request,[
             'name'=>'string|required',
                'email'=>'email|required',
         ]);
         $data= $request->all();
       
 
         // return $data;
         $status=$writer->fill($data)->save();
         if($status){
             request()->session()->flash('success','Writer successfully updated');
         }
         else{
             request()->session()->flash('error','Error occurred, Please try again!');
         }
         return redirect()->route('writer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $writer = Writer::findOrFail($id);
        $check = $writer->books;

        if(count($check)>0){
            request()->session()->flash('error','Writer cannot be deleted as it has books');
            return redirect()->route('writer.index');
        }
        
        $status = $writer->delete();
        if($status){
            request()->session()->flash('success','Writer successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting writer');
        }
        return redirect()->route('writer.index');
    }
}
