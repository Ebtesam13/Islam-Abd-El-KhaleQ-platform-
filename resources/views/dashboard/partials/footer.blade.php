<footer class="footer">
    <div class="container-fluid d-flex justify-content-between">
        <nav class="pull-left">
            <ul class="nav">
                <li class="nav-item">
                    &copy; <a class="border-bottom" href="{{route('home')}}">{{config('app.name')}}</a>, {{__('labels.rights_reserved')}}
                </li>
                <li class="nav-item">
                    <a href="{{route('home')}}">{{__('labels.home')}}</a> &nbsp;
                </li>
                <li class="nav-item">
                    <a href="{{route('terms')}}">{{__('labels.terms_conditions')}}</a> &nbsp;
                </li>
            </ul>
        </nav>
        <div class="copyright">
            2024, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="https://www.linkedin.com/in/maha-ahmed-ebrahim/" target="_blank">Maha A.</a>
        </div>
        <div>
            @php
                $languages = ['ar','en'];
                auth()->check() ? array_splice($languages,array_search(auth()->user()->language,$languages),1) :
                array_splice($languages,array_search(app()->getLocale(),$languages),1);
            @endphp
            <a href="{{route('localization.set-locale',['lang'=>$languages[0]])}}">
                <i class="fa-light fa fa-globe"></i> &nbsp;{{$languages[0]}}
            </a>
        </div>
    </div>
</footer>
