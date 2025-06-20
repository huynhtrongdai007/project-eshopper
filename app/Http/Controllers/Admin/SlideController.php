<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Traits\StorareImageTrait;
use App\Requests\SliderAddRequest;
use Illuminate\Support\Facades\Log;
class SlideController extends Controller
{
    use StorareImageTrait;
    private $slide;

    public function __construct(Slide $slide) {
        $this->slide = $slide;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = $this->slide->all();
        return view('admin.modules.slide.index',\compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderAddRequest $request)
    {
      try {
            
        $dataInsert = [
            'name' => $request->name,
            'description' => $request->description
        ];

        $dataImageSlider =  $this->storageTraitUpload($request,'image_path','slider');
        if(!empty($dataImageSlider)) {
            $dataInsert['image_name'] = $dataImageSlider['file_name'];
            $dataInsert['image_path'] = $dataImageSlider['file_path'];
        }

        $this->slide->create($dataInsert);
        return back()->with('message','inserted successfully');
      } catch (\Throwable $th) {
        Log::error('Message:'.$th->getMessage().'  Line : ' . $th->getLine());
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = $this->slide->find($id);
        return view('admin.modules.slide.edit',\compact('slide'));
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
        try {
            
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description
            ];
    
            $dataImageSlider =  $this->storageTraitUpload($request,'image_path','slider');
            if(!empty($dataImageSlider)) {
                $dataUpdate['image_name'] = $dataImageSlider['file_name'];
                $dataUpdate['image_path'] = $dataImageSlider['file_path'];
            }
    
            $this->slide->find($id)->update($dataUpdate);
            return redirect()->route('admin.slide.index')->with('message','Updated Successfully');

          } catch (\Throwable $th) {
            Log::error('Message:'.$th->getMessage().'  Line : ' . $th->getLine());
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->slide->find($id)->delete();
             return response()->json([
                 'code' => 200,
                 'message' => 'success'
             ]);
         } catch (\Throwable $th) {
             Log::error('Message:'.$exception->getMessage().'  Line : ' . $exception->getLine());
 
             return response()->json([
                 'code' => 500,
                 'message' => 'fail'
             ]);
         }
    }

    public function StatusActive(Request $request) {
        $id = $request->id;
        $this->slide->where('id',$id)->update(['status'=>1]);
    }

    public function StatusUntive(Request $request) {
        $id = $request->id;
        $this->slide->where('id',$id)->update(['status'=>0]);
    }
}
