@extends('base_layouts.master_layout')
@section('title' , __('category.titleCategory'))


@section('content')
       
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>{{__('category.Search')}}</strong></h3>
    </div>
    <div class="panel-body"> 
       <form action="" method="get">
           <div class="form-grop">
               <label for="Search"><strong>{{__('category.Name')}}</label>
               <input type="text" name="name"  class="form-control " value="{{app('request')->input('name')}}">
           </div>
           <br>
           <div class="form-grop py-2">
            <label for="lang">{{__('category.Language')}}</label>
            <select name="lang"  id="lang" class="form-control " ">
                <option value="-1">{{__('category.ChooseLangouage')}}</option>
                <option value="en" {{app('request')->input('lang') == 'en' ? 'selected' : '' }}>{{__('category.English')}}</option>
                <option value="ar" {{app('request')->input('lang') == 'ar' ? 'selected' : '' }}>{{__('category.Arabic')}}</option>
            </select>   
        </div>
        <br>
        <div class="form-action">
            <input type="submit" value="{{__('category.Search')}}" class="btn btn-primary"/>      
            <a  class="btn btn-default" href="{{route('category.index')}}"><strong>{{__('category.Cansel')}}</a>      
          </div>
       </form>
      
    </div>
</div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>{{__('category.Categories')}}</strong></h3>
        </div>
        <div class="panel-body"> 
             <table class="table table-striped table-inverse table-responsive">
                 <thead class="thead-inverse">
                     <tr>
                         <th>{{__('category.Name')}}</th>
                         <th>{{__('category.Language')}}</th>
                         <th>{{__('category.opration')}}</th>
                         
                     </tr>
                     </thead>
                     <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td scope="row">{{$category->name}}</td>
                            <td>{{$category->getLanguage()}}</td>
                            <td>
                                <span>
                                    <a class="btn btn-primary " href="{{route('category.edit',$category->slug)}}">
                                        <span>
                                            <i class="fa fa-edit"></i>
                                        </span>{{__('category.Edit')}} 
                                    </a>
                                    <a class="btn btn-warning book-number" data-value="{{$category->id}}">
                                        <span>
                                            <i class="fa fa-eye"></i>
                                        </span>{{__('category.Show')}}  
                                    </a>
                                    {{-- href="{{route('category.destroy',$category->id)}}" --}}
                                    <a class="btn btn-danger remove-category" data-value="{{$category->id}}" >
                                            <span>
                                                <i class="fa fa-trash"></i>
                                            </span>{{__('category.Delete')}}  
                                    </a>
                                </span>
                            </td>
                           
                        </tr> 
                        @endforeach
                     </tbody>
             </table>
             <div >
                {{ $categories->links() }}
             </div>
        </div>
    </div>

    
@endsection

@section('script')
    <script>
        $('.remove-category').click(function(){
            var id = $(this).data('value');
            console.log(id);
            swal({
                
                title: "{{__('category.Areyousure')}} ",
                text: "{{__('category.messagesDelete')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "{{__('category.Deleteit')}}",
                closeOnConfirm: false ,
            },
            function(){
                window.location = '{{route('category.destroy')}}/' + id ;
                // swal("Deleted!", "Your imaginary file has been deleted.", "success");
            }); 
        });
        

        $('.book-number').click(function(){
            var id = $(this).data('value');
            $.ajax({
                url : '{{route('category.book.count')}}/' + id,
                method: 'POST',
                data: {
                    body:'',
                    _token:'{{csrf_token()}}'
                    }
            }).success(function(response){
                if (response.status=='200') {
                    swal('Books number is ' + response.message , ); 
                }
            })
        });
    </script>
@endsection
