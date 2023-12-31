@extends('layout.admin')

@section('title')
    <title>Thêm slider</title>
@endsection

@section('css')
      <link href="{{ asset('admins/slider/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name' => "Slider", 'key'=>'Add'])

        <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('slider.store') }}"  method='post' enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label>Tên slider</label>
                          <input type="text" 
                          class="form-control @error('name') is-invalid @enderror" 
                          name='name' 
                          placeholder="Nhập tên"
                          value='{{ old('name') }}'>
                          @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                          <label>Mô tả slider</label>

                          <textarea name="description" 
                          class="form-control @error('description') is-invalid @enderror" 
                          id="" cols="30" rows="4">{{ old('description') }}</textarea>

                          @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" 
                            class="form-control @error('image_path') is-invalid @enderror" 
                            name='image_path'>
                            @error('image_path')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          

                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
        </div>
        </div>
    </div>
@endsection
