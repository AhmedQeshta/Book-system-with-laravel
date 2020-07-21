  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
          <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
              <li class="sidebar-toggler-wrapper hide">
                  <div class="sidebar-toggler">
                      <span></span>
                  </div>
              </li>
              <li class="nav-item start ">
                  <a href="#" class="nav-link nav-toggle">
                      <i class="icon-home"></i>
                      <span class="title">{{__('Dashboard.Dashboard')}}</span>
                  </a>
              </li>
              <li class="heading">
                  <h3 class="uppercase">{{__('Dashboard.Features')}}</h3>
              </li>
              <li  class="nav-item @if(true) active open  @endif" id="category">
                  <a href="javascript:;" class="nav-link nav-toggle">
                      <i class="icon-bulb"></i>
                      <span class="title">{{__('category.category')}}</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub-menu">
                      <li class="nav-item " >
                          <a href="{{route('category.index')}}" id="all-category" class="nav-link ">
                              <span class="title">{{__('category.AllCategory')}}</span>
                          </a>
                      </li>
                      <li class="nav-item @if(false) active open  @endif" id="category_create">
                          <a href="{{route('category.create')}}" class="nav-link ">
                              <span class="title">{{__('category.CreateCategory')}}</span>
                          </a>
                      </li>
                  </ul>
              </li>

              <li  class="nav-item @if(true) active open  @endif" id="library">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bulb"></i>
                    <span class="title">{{__('library.library')}}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item " >
                        <a href="{{route('library.index')}}" id="all-library" class="nav-link ">
                            <span class="title">{{__('library.Alllibrary')}}</span>
                        </a>
                    </li>
                    <li class="nav-item @if(false) active open  @endif" id="library_create">
                        <a href="{{route('library.create')}}" class="nav-link ">
                            <span class="title">{{__('library.Createlibrary')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
             
            <li  class="nav-item @if(true) active open  @endif" id="book">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bulb"></i>
                    <span class="title">{{__('book.book')}}</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item " >
                        <a href="{{route('book.index')}}" id="all-book" class="nav-link ">
                            <span class="title">{{__('book.Allbook')}}</span>
                        </a>
                    </li>
                    <li class="nav-item @if(false) active open  @endif" id="book_create">
                        <a href="{{route('book.create')}}" class="nav-link ">
                            <span class="title">{{__('book.Createbook')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
          </ul>
          <!-- END SIDEBAR MENU -->
          <!-- END SIDEBAR MENU -->
      </div>
      <!-- END SIDEBAR -->
  </div>
  <!-- END SIDEBAR -->


 

 