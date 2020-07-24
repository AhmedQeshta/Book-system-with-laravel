<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
            
            
        </style>
        <!-- Styles -->
        <style>
            :root{
                --backColor : #ff8c57de;
                --textColor : #ffffff;
                --backColorHover : #f8773ce3 ;
                --padding_10px : 10px;
                --backColorImg : #ac8b7ce3 ; 
                --backColorImgHover : #000000e3 ; 
            }
            html, body {
                background-color: #fff;
                color: var(--backColorImg);
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .top-left{
                position: absolute;
                left: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: var(--backColorImg);
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .links > a:hover {
                color: var(--backColorImgHover);
                transition: ease-in-out 0.5s ;
                
            }

            .m-b-md {
                margin-bottom: 30px;
            }
          
            /* body{
                padding: 0px;
                margin: 0px auto;
                box-sizing: border-box;
                width: 100%;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                
            } */
            .contaner{  
                padding: 5px;
                margin: 5px;
        
            }
            .contaner>.row{
                padding: var(--padding_10px);
                margin: 20px auto ; 
                /* background-color: #fdc0a4; */
                background-color: var(--backColor);
                border-radius: 10px 30px ; 
            }
            .contaner>.row>h1{
                color: var(--textColor);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                text-shadow: 15px;
            }
            .contaner>img{
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
                margin-top: -60px;
                margin-bottom: -60px;
            }
            .top-left.links>img{
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 15%;
                background-color: var(--backColorImg);
                padding: 5px;
                border-radius: 50%;
            }
            .contaner>.row>h1>a{
                padding: var(--padding_10px);
                border-radius: 20px ; 
                color: var(--textColor);
                font-family: Georgia, 'Times New Roman', Times, serif;
                text-decoration: none;
            }
            .contaner>.row>h1>a:hover{
                outline: none;
                background-color: var(--backColorHover);
                padding: var(--padding_10px);
                transition: ease-in-out 0.75s ;
                text-decoration: none;
                
            }
           
          
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            <div class="top-left links">
                <img src="http://nick.mtvnimages.com/nick/nick-web/error/404-sb-web.png?width=250&quality=0.6" alt="404 Page not Found">
                <a href="{{route('test')}}">category</a>
            </div>
        
    <div class="contaner">
        <img src="http://nick.mtvnimages.com/nick/nick-web/error/404-sb-web.png?width=250&quality=0.6" alt="404 Page not Found">
        <div class="row">
            <h1>WellCome to Web site, user Page</h1>
        </div>
    </div>
</div>
    </body>
</html>
