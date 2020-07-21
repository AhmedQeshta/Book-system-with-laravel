@extends('base_layouts.master_layout')
@section('title' , __('book.titlebook'))


@section('content')
       
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>{{__('book.Search')}}</strong></h3>
    </div>
    <div class="panel-body"> 
       <form action="" method="get">
           <div class="form-grop">
               <label for="Search">{{__('book.title')}}</label>
               <input type="text" name="title"  class="form-control " value="{{app('request')->input('title')}}">
           </div>
            
            <div class="form-grop">
                <label for="Search">{{__('book.author')}}</label>
                <input type="text" name="author"  class="form-control " value="{{app('request')->input('author')}}">
            </div>
            <br>
            <div class="form-action">
                <input type="submit" value="{{__('book.Search')}}" class="btn btn-primary"/>      
                <a  class="btn btn-default" href="{{route('book.index')}}">{{__('book.Cansel')}}</a>      
            </div>
          
       </form>
      
    </div>
</div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>{{__('book.Books')}}</strong></h3>
        </div>
        <div class="panel-body"> 
             <table class="table table-striped table-inverse table-responsive">
                 <thead class="thead-inverse">
                     <tr>
                         <th>{{__('book.title')}}</th>
                         <th>{{__('book.author')}}</th>
                         <th>{{__('book.Writer')}}</th>
                         <th>{{__('book.Publisher')}}</th>
                         <th>{{__('book.Category')}}</th>
                         <th>{{__('book.Library')}}</th>
                         <th>{{__('book.opration')}}</th>
                         
                     </tr>
                     </thead>
                     <tbody>
                        @foreach ($books as $book)
                        <tr>
                            <td scope="row">{{$book->title}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->writer}}</td>
                            <td>{{$book->writer}}</td>
                            <td>{{$book->category->name}}</td>
                            <td>{{$book->library->name}}</td>
                            <td>
                                <span>
                                    <a class="btn btn-primary " href="{{route('book.edit',$book->slug)}}">
                                        <span>
                                            <i class="fa fa-edit"></i>
                                        </span> {{__('book.Edit')}}
                                    </a>
                                    <a class="btn btn-warning " href="#">
                                        <span>
                                            <i class="fa fa-eye"></i>
                                        </span> {{__('book.Show')}}
                                    </a>
                                    {{-- href="{{route('book.destroy',$book->id)}}" --}}
                                    <a class="btn btn-danger remove-book" data-value="{{$book->id}}" >
                                            <span>
                                                <i class="fa fa-trash"></i>
                                            </span> {{__('book.Delete')}}
                                    </a>
                                </span>
                            </td>
                           
                        </tr> 
                        @endforeach
                     </tbody>  
             </table>
             <div >
                {{ $books->links() }}
             </div>
        </div>
    </div>

    
@endsection

@section('script')
    <script>
        $('.remove-book').click(function(){
            var id = $(this).data('value');
            console.log(id);
            swal({
                title:"{{__('book.Areyousure')}} ",
                text: "{{__('book.messagesDelete')}}",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "{{__('book.Deleteit')}}",
                closeOnConfirm: false
            },
            function(){
                window.location = '{{route('book.destroy')}}/' + id ;
                // swal("Deleted!", "Your imaginary file has been deleted.", "success");
            }); 
        });
        
    </script>
@endsection
