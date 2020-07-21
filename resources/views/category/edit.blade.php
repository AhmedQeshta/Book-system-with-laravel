@extends('base_layouts.master_layout')
@section('title' , __('category.titleEditCategory'))


@section('content')

    <div class="row">
        <div class="col col-md-12">
            <form action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="form-group text-center">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 300px; height: 250px;">
                            <img src="{{asset($category->image)}}" width="100%" alt="{{$category->name}}"> </div>
                            @error('category_image')
                            <div class="invalid-feedback alert-danger text-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                    @enderror
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 250px; line-height: 10px;"></div>
                        <div class="text-center">
                            <span class="btn default btn-file">
                                <span class="fileinput-new">{{__('category.selecteimageEditCategory')}}</span>
                                <span class="fileinput-exists"> {{__('category.ChangeImageEditCategory')}}</span>
                                {{-- <input type="hidden"  value="" name="..."> --}}
                                <input type="file"  class="@error('category_image') is-invalid @enderror"   name="category_image"></span>
                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">{{__('category.RemoveImageEditCategory')}}</a>
                        </div>
                    </div>
                    
                </div>
               
              
                
                <div class="form-group">
                    <label for="name">{{__('category.nameEditCategory')}}</label>
                    <input type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{$category->name}}"  >
                    @error('name')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lang">{{__('category.languageEditCategory')}}</label>
                    <select name="lang"   id="lang"  class="form-control @error('lang') is-invalid @enderror">
                        <option value="en" {{$category->lang == 'en' ? 'selected' :''}}>{{__('category.enEditCategory')}}</option>
                        <option value="ar" {{$category->lang == 'ar' ? 'selected' :''}}>{{__('category.arEditCategory')}}</option>
                    </select>
                    @error('lang')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-action">
                    <input type="submit" value="{{__('category.saveEditCategory')}}" class="btn btn-primary">
                    <input type="reset" value="{{__('category.canselEditCategory')}}" class="btn btn-default">
                </div>
            </form>
        </div>
    </div>
@endsection



    
