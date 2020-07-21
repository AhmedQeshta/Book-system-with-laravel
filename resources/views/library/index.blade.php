@extends('base_layouts.master_layout')
@section('title' , __('library.titlelibrary'))


@section('content')
       
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>{{__('library.Search')}}</strong></h3>
    </div>
    <div class="panel-body"> 
       <form action="" method="get">
           <div class="form-grop">
               <label for="Search">{{__('library.Name')}}</label>
               <input type="text" name="name"  class="form-control " value="{{app('request')->input('name')}}">
           </div>
        <br>
        <div class="form-action">
            <input type="submit" value="{{__('library.Search')}}" class="btn btn-primary"/>      
            <a  class="btn btn-default" href="{{route('library.index')}}">{{__('library.Cansel')}}</a>      
          </div>
       </form>
      
    </div>
</div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>{{__('library.Libraries')}}</strong></h3>
        </div>
        <div class="panel-body"> 
             <table class="table table-striped table-inverse table-responsive">
                 <thead class="thead-inverse">
                     <tr>
                         <th>{{__('library.Name')}}</th>
                         <th>{{__('library.email')}}</th>
                         <th>{{__('library.phone')}}</th>
                         <th>{{__('library.opration')}}</th>
                         
                     </tr>
                     </thead>
                     <tbody>
                        @foreach ($libraries as $library)
                        <tr>
                            <td scope="row">{{$library->name}}</td>
                            <td>{{$library->email}}</td>
                            <td>{{$library->phone}}</td>
                            <td>
                                <span>
                                    <a class="btn btn-primary " href="{{route('library.edit',$library->slug)}}">
                                        <span>
                                            <i class="fa fa-edit"></i>
                                        </span> {{__('library.Edit')}}
                                    </a>
                                    <a class="btn btn-warning " href="#">
                                        <span>
                                            <i class="fa fa-eye"></i>
                                        </span> {{__('library.Show')}}
                                    </a>
                                    {{-- href="{{route('library.destroy',$library->id)}}" --}}
                                    <a class="btn btn-danger remove-library" data-value="{{$library->id}}" >
                                            <span>
                                                <i class="fa fa-trash"></i>
                                            </span> {{__('library.Delete')}}
                                    </a>
                                </span>
                            </td>
                           
                        </tr> 
                        @endforeach
                     </tbody>
             </table>
             <div >
                {{ $libraries->links() }}
             </div>
        </div>
    </div>

    
@endsection

@section('script')
    <script>
        $('.remove-library').click(function(){
            var id = $(this).data('value');
            console.log(id);
            swal({
               title: "{{__('library.Areyousure')}} ",
                text: "{{__('library.messagesDelete')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
               confirmButtonText: "{{__('library.Deleteit')}}",
                closeOnConfirm: false
            },
            function(){
                window.location = '{{route('library.destroy')}}/' + id ;
                // swal("Deleted!", "Your imaginary file has been deleted.", "success");
            }); 
        });
        
    </script>
@endsection
