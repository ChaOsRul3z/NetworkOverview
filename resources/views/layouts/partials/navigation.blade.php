<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #263238;border-bottom: 4px  solid #90A4AE; box-shadow: 0 2px 5px rgba(0,0,0,.26);">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', '') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php $buildings = App\Models\Building::all()->load('floors'); ?>
                @foreach($buildings as $building)
                    <li class="nav-item dropdown">
                        <a class="nav-link @if($building->floors->count()){{ 'dropdown-toggle' }}@endif" href="{{ route('buildings.show', $building) }}"
                           @if($building->floors->count()) id="navbarDropdown-{{ $building->id }}" @endif
                           role="button" @if($building->floors->count()) {{ 'data-toggle=dropdown' }} @endif aria-haspopup="true" aria-expanded="false">
                            {{ $building->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown-{{ $building->id }}">
                            @if($building->floors->count())
                                @foreach($building->floors as $floor)
                                    <a class="dropdown-item fa-" href="{{ route('buildings.floors.show', [$building, $floor])}}">{{ $floor->name }}</a>
                                @endforeach
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
            <ul class="navbar-nav ml-auto text-white">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">@lang('app.menu.login')</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">@lang('app.menu.register')</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" id="admin-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('app.menu.admin-panel')</a>
                        <div class="dropdown-menu" aria-labelledby="admin-dropdown">
                            <?php $sorts = App\Models\Sort::all(); ?>
                            <a href="{{ route('sorts.index') }}" class="dropdown-item">@lang('app.menu.sorts')</a>
                            <a href="{{ route('properties.index') }}" class="dropdown-item">@lang('app.menu.properties')</a>
                            <a href="{{ route('vlans.index') }}" class="dropdown-item">@lang('app.menu.vlans')</a>
                            <a href="{{ route('patchcables.index') }}" class="dropdown-item">@lang('app.menu.patchcables')</a>
                            <a href="{{ route('devices.index') }}" class="dropdown-item">@lang('app.menu.devices')</a>
                                <div class="dropdown-divider"></div>
                            <a href="{{ route('inventory') }}" class="dropdown-item">@lang('app.menu.inventory')</a>
                                <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('app.menu.logout')</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }} </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
