<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\SliderAddRequest;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;


class SliderAdminController extends Controller
{
    use DeleteModelTrait;
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider){
        $this->slider = $slider;
    }

    public function index(){
        $sliders = $this->slider->latest()->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }
     
    public function create(){
        return view('admin.slider.add');
    }
    
    public function store(SliderAddRequest $request){
        try{
            $dataInsert = [
                'name' => $request -> name,
                'description' => $request -> description, 
            ];
            $dataImageSlider = $this -> storageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataImageSlider)){
                $dataInsert['image_name'] = $dataImageSlider['file_name'];
                $dataInsert['image_path'] = $dataImageSlider['file_path'];
            }
            $this -> slider -> create($dataInsert);
            return redirect()->route('slider.index');
        } catch (Exception $exception) {
            Log:error('Lỗi: '. $exception->getMessage() . '--- Lines: '. $exception->getLine());
        }
    }

    public function edit($id){
        $slider = $this -> slider->find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id){
        try{
            $dataUpdate = [
                'name' => $request -> name,
                'description' => $request -> description, 
            ];
            $dataImageSlider = $this -> storageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataImageSlider)){
                $dataUpdate['image_name'] = $dataImageSlider['file_name'];
                $dataUpdate['image_path'] = $dataImageSlider['file_path'];
            }
            $this -> slider -> find($id) -> update($dataUpdate);
            return redirect()->route('slider.index');
        } catch (Exception $exception) {
            Log:error('Lỗi: '. $exception->getMessage() . '--- Lines: '. $exception->getLine());
        }
    }

    public function delete($id){
        return $this -> deleteModelTrait($id, $this->slider);
    }
}