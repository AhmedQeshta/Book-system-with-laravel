@extends('base_layouts.master_layout')
@section('title' , __('book.titleCreatebook'))


@section('content')
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center"><strong>{{__('book.CreateBook')}}</strong></h3>
            </div>
        </div>
        <div class="col col-md-12">
            <form action="{{route('book.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group text-center">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 300px; height: 250px;">
                            <img src="http://www.placehold.it/300x250" alt=""> </div>
                            @error('book_image')
                                <div class="invalid-feedback alert-danger text-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 250px; line-height: 10px;"></div>
                        <div class="text-center">
                            <span class="btn default btn-file">
                                <span class="fileinput-new">{{__('book.selecteimageCreatebook')}}</span>
                                <span class="fileinput-exists">{{__('book.ChangeImageCreatebook')}}</span>
                                {{-- <input type="hidden"  value="" name="..."> --}}
                                <input type="file"  class="@error('book_image') is-invalid @enderror" value="{{ old('book_image') }}"  name="book_image"></span>
                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">{{__('book.RemoveImageCreatebook')}}</a>
                        </div>
                    </div>
                    
                </div>
                 <div class="col-xs-6 col-sm-6 col-md-6">                         
                    <div class="form-group">
                        <label for="title">{{__('book.TitleCreatebook')}}</label>
                        <input type="text" required class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"  >
                        @error('title')
                            <span class="invalid-feedback alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>                              
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="author">{{__('book.authorCreatebook')}}</label>
                        <input type="text" required class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}"  >
                        @error('author')
                            <span class="invalid-feedback alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> 
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="writer">{{__('book.writerCreatebook')}}</label>
                        <input type="text" required class="form-control @error('writer') is-invalid @enderror" name="writer" value="{{ old('writer') }}"  >
                        @error('writer')
                            <span class="invalid-feedback alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> 
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="publisher">{{__('book.publisherCreatebook')}}</label>
                        <input type="text" required class="form-control @error('publisher') is-invalid @enderror" name="publisher" value="{{ old('publisher') }}"  >
                        @error('publisher')
                            <span class="invalid-feedback alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                </div> 
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="category">{{__('book.CategoriesCreatebook')}}</label>
                        <select class="form-control @error('book_image') is-invalid @enderror" name="category_id" id="category">
                            @foreach ($categories as $category)
                                <option required value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="library">{{__('book.LibrariesCreatebook')}}</label>
                        <select class="form-control @error('book_image') is-invalid @enderror " name="library_id" id="library">
                            @foreach ($libraries as $library)
                                <option required value="{{$library->id}}">{{$library->name}}</option>
                            @endforeach
                        </select>
                        @error('library_id')
                            <span class="invalid-feedback alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-action">
                    <input type="submit" value="{{__('book.saveCreatebook')}}" class="btn btn-primary">
                    <input type="reset" value="{{__('book.canselCreatebook')}}" class="btn btn-default">
                </div>
            </form>
        </div>
    </div>
@endsection



    
