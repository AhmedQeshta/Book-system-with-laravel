@extends('base_layouts.master_layout')
@section('title' , __('library.titleEditlibrary'))


@section('content')

    <div class="row">
        <div class="col col-md-12">
            <form action="{{route('library.update',$library->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="form-group text-center">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail" style="width: 300px; height: 250px;">
                            <img src="{{asset($library->image)}}" width="100%" alt="{{$library->name}}"> </div>
                            @error('library_image')
                            <div class="invalid-feedback alert-danger text-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                    @enderror
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 250px; line-height: 10px;"></div>
                        <div class="text-center">
                            <span class="btn default btn-file">
                                <span class="fileinput-new">{{__('library.selecteimageEditlibrary')}}</span>
                                <span class="fileinput-exists">{{__('library.ChangeImageEditlibrary')}}</span>
                                {{-- <input type="hidden"  value="" name="..."> --}}
                                <input type="file"  class="@error('library_image') is-invalid @enderror"   name="library_image"></span>
                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">{{__('library.RemoveImageEditlibrary')}}</a>
                        </div>
                    </div>
                    
                </div>
               
              
                
                <div class="form-group">
                    <label for="name">{{__('library.Name')}}</label>
                    <input type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{$library->name}}"  >
                    @error('name')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">{{__('library.email')}}</label>
                    <input type="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{$library->email}}"  >
                    @error('email')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">{{__('library.phone')}}</label>
                    <input type="text"  class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$library->phone}}"  >
                    @error('phone')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">{{__('library.passwordEditlibrary')}}</label>
                    <input type="password"  class="form-control @error('password') is-invalid @enderror" name="password" value=""  >
                    @error('password')
                        <span class="invalid-feedback alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-action">
                    <input type="submit" value="{{__('library.saveEditlibrary')}}" class="btn btn-primary">
                    <input type="reset" value="{{__('library.canselEditlibrary')}}" class="btn btn-default">
                </div>
            </form>
        </div>
    </div>
@endsection



    
