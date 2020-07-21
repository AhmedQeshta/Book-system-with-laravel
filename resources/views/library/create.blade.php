@extends('base_layouts.master_layout')
@section('title' , __('library.titleCreatelibrary'))


@section('content')
    <div class="row">
        <div class="col col-md-12">
            <form action="{{route('library.store')}}" method="POST" enctype="multipart/form-data">
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
                                <span class="fileinput-new">{{__('library.selecteimageCreatelibrary')}}</span>
                                <span class="fileinput-exists">{{__('library.ChangeImageCreatelibrary')}}</span>
                                {{-- <input type="hidden"  value="" name="..."> --}}
                                <input type="file" required class="@error('image') is-invalid @enderror" value="{{ old('library_image') }}"  name="library_image"></span>
                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">{{__('library.RemoveImageCreatelibrary')}}</a>
                        </div>
                    </div>
                    
                </div>
              
                <div class="form-group">
                    <label for="name">{{__('library.Name')}}</label>
                    <input type="text" required class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  >
                    @error('name')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
              
                <div class="form-group">
                    <label for="email">{{__('library.email')}}</label>
                    <input type="email" required class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  >
                    @error('email')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
              
                <div class="form-group">
                    <label for="phone">{{__('library.phone')}}</label>
                    <input type="text" required class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  >
                    @error('phone')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
              
                <div class="form-group">
                    <label for="password">{{__('library.passwordCreatelibrary')}}</label>
                    <input type="password" required class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  >
                    @error('password')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
               
                <div class="form-action">
                    <input type="submit" value="{{__('library.saveCreatelibrary')}}" class="btn btn-primary">
                    <input type="reset" value="{{__('library.canselCreatelibrary')}}" class="btn btn-default">
                </div>
            </form>
        </div>
    </div>
@endsection



    
