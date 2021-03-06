@extends('base_layouts.master_layout')
@section('title' , __('category.titleCreateCategory'))


@section('content')
    <div class="row">
        <div class="col col-md-12">
            <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group text-center">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 300px; height: 250px;">
                            <img src="http://www.placehold.it/300x250" alt=""> </div>
                            @error('image')
                                <div class="invalid-feedback alert-danger text-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 250px; line-height: 10px;"></div>
                        <div class="text-center">
                            <span class="btn default btn-file">
                                <span class="fileinput-new"> {{__('category.selecteimageCreateCategory')}} </span>
                                <span class="fileinput-exists"> {{__('category.ChangeImageCreateCategory')}} </span>
                                {{-- <input type="hidden"  value="" name="..."> --}}
                                <input type="file" required class="@error('image') is-invalid @enderror"  name="category_image"></span>
                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">{{__('category.RemoveImageCreateCategory')}}</a>
                        </div>
                    </div>
                    
                </div>
              
                
                <div class="form-group">
                    <label for="name">{{__('category.nameCreateCategory')}}</label>
                    <input type="text" required class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  >
                    @error('name')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lang">{{__('category.languageCreateCategory')}}</label>
                    <select name="lang" required  id="lang" class="form-control @error('lang') is-invalid @enderror">
                        <option value="en">{{__('category.enCreateCategory')}}</option>
                        <option value="ar">{{__('category.arCreateCategory')}}</option>
                    </select>
                    @error('lang')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-action">
                    <input type="submit" value="{{__('category.saveCreateCategory')}}" class="btn btn-primary">
                    <input type="reset" value="{{__('category.canselCreateCategory')}}" class="btn btn-default">
                </div>
            </form>
        </div>
    </div>
@endsection



    
