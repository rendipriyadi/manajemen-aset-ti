<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="active">
                <a href="{{ route('backsite.dashboard.index') }}">
                    <i
                        class="{{ request()->is('backsite/dashboard') || request()->is('backsite/dashboard/*') ? 'bx bx-category-alt bx-flashing' : 'bx bx-category-alt' }}"></i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <li class=" navigation-header"><span data-i18n="Master Data">Master Data</span><i class="la la-ellipsis-h"
                    data-toggle="tooltip" data-placement="right" data-original-title="Master Data"></i></li>

            {{-- @can('location') --}}
            <li class=" nav-item"><a href="{{ route('backsite.location.index') }}"><i
                        class="{{ request()->is('backsite/location') || request()->is('backsite/location/*') || request()->is('backsite/*/location') || request()->is('backsite/*/location/*') ? 'bx bx-current-location bx-flashing' : 'bx bx-current-location' }}"></i><span
                        class="menu-title" data-i18n="Lokasi">Lokasi</span></a>
            </li>
            {{-- @endcan --}}

            {{-- @can('division') --}}
            <li class=" nav-item"><a href="#"><i
                        class="{{ request()->is('backsite/division') || request()->is('backsite/division/*') || request()->is('backsite/*/division') || request()->is('backsite/*/division/*') || request()->is('backsite/department') || request()->is('backsite/department/*') || request()->is('backsite/*/department') || request()->is('backsite/*/department/*') || request()->is('backsite/section') || request()->is('backsite/section/*') || request()->is('backsite/*/section') || request()->is('backsite/*/section/*') ? 'bx bx-store-alt bx-flashing' : 'bx bx-store-alt' }}"></i><span
                        class="menu-title" data-i18n="Divisi">Divisi</span></a>
                <ul class="menu-content">
                    {{-- @can('division') --}}
                    <li
                        class="{{ request()->is('backsite/division') || request()->is('backsite/division/*') || request()->is('backsite/*/division') || request()->is('backsite/*/division/*') ? 'active' : '' }} ">
                        <a class="menu-item" href="{{ route('backsite.division.index') }}">
                            <i></i><span>Divisi</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('department') --}}
                    <li
                        class="{{ request()->is('backsite/department') || request()->is('backsite/department/*') || request()->is('backsite/*/department') || request()->is('backsite/*/department/*') ? 'active' : '' }} ">
                        <a class="menu-item" href="{{ route('backsite.department.index') }}">
                            <i></i><span>Departemen</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('section-') --}}
                    <li
                        class="{{ request()->is('backsite/section') || request()->is('backsite/section/*') || request()->is('backsite/*/section') || request()->is('backsite/*/section/*') ? 'active' : '' }} ">
                        <a class="menu-item" href="{{ route('backsite.section.index') }}">
                            <i></i><span>Seksi</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                </ul>
            </li>
            {{-- @endcan --}}

            {{-- @can('employee') --}}
            <li class=" nav-item"><a href="{{ route('backsite.employee.index') }}"><i
                        class="{{ request()->is('backsite/employee') || request()->is('backsite/employee/*') || request()->is('backsite/*/employee') || request()->is('backsite/*/employee/*') ? 'bx bx-user-pin bx-flashing' : 'bx bx-user-pin' }}"></i><span
                        class="menu-title" data-i18n="Karyawan">Karyawan</span></a>
            </li>
            {{-- @endcan --}}

            {{-- @can('software') --}}
            <li class=" nav-item"><a href="{{ route('backsite.software.index') }}"><i
                        class="{{ request()->is('backsite/software') || request()->is('backsite/software/*') || request()->is('backsite/*/software') || request()->is('backsite/*/software/*') ? 'bx bx-code-block bx-flashing' : 'bx bx-code-block' }}"></i><span
                        class="menu-title" data-i18n="Software">Software</span></a>
            </li>
            {{-- @endcan --}}

            {{-- @can('Hardware') --}}
            <li class=" nav-item"><a href="#"><i
                        class="{{ request()->is('backsite/hardisk') ||request()->is('backsite/hardisk/*') ||request()->is('backsite/*/hardisk') ||request()->is('backsite/*/hardisk/*') ||request()->is('backsite/monitor') ||request()->is('backsite/monitor/*') ||request()->is('backsite/*/monitor') ||request()->is('backsite/*/monitor/*') ||request()->is('backsite/motherboard') ||request()->is('backsite/motherboard/*') ||request()->is('backsite/*/motherboard') ||request()->is('backsite/*/motherboard/*') ||request()->is('backsite/processor') ||request()->is('backsite/processor/*') ||request()->is('backsite/*/processor') ||request()->is('backsite/*/processor/*') ||request()->is('backsite/ram') ||request()->is('backsite/ram/*') ||request()->is('backsite/*/ram') ||request()->is('backsite/*/ram/*') ||request()->is('backsite/type_device') ||request()->is('backsite/type_device/*') ||request()->is('backsite/*/type_device') ||request()->is('backsite/*/type_device/*') ||request()->is('backsite/additional_device') ||request()->is('backsite/additional_device/*') ||request()->is('backsite/*/additional_device') ||request()->is('backsite/*/additional_device/*')? 'bx bx-desktop bx-flashing': 'bx bx-desktop' }}"></i><span
                        class="menu-title" data-i18n="Hardware">Hardware</span></a>
                <ul class="menu-content">
                    <li class=" nav-item"><a href="#"><span class="menu-title"
                                data-i18n="Komponen">Komponen</span></a>
                        <ul class="menu-content">
                            {{-- @can('Hardisk') --}}
                            <li
                                class="{{ request()->is('backsite/hardisk') || request()->is('backsite/hardisk/*') || request()->is('backsite/*/hardisk') || request()->is('backsite/*/hardisk/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.hardisk.index') }}">
                                    <i></i><span>Hardisk</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('Motherboard') --}}
                            <li
                                class="{{ request()->is('backsite/motherboard') || request()->is('backsite/motherboard/*') || request()->is('backsite/*/motherboard') || request()->is('backsite/*/motherboard/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.motherboard.index') }}">
                                    <i></i><span>Motherboard</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('Prosessor') --}}
                            <li
                                class="{{ request()->is('backsite/processor') || request()->is('backsite/processor/*') || request()->is('backsite/*/processor') || request()->is('backsite/*/processor/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.processor.index') }}">
                                    <i></i><span>Processor</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                            {{-- @can('Ram') --}}
                            <li
                                class="{{ request()->is('backsite/ram') || request()->is('backsite/ram/*') || request()->is('backsite/*/ram') || request()->is('backsite/*/ram/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.ram.index') }}">
                                    <i></i><span>Ram</span>
                                </a>
                            </li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @can('Type_Device') --}}
                    <li
                        class="{{ request()->is('backsite/type_device') || request()->is('backsite/type_device/*') || request()->is('backsite/*/type_device') || request()->is('backsite/*/type_device/*') ? 'active' : '' }} ">
                        <a class="menu-item" href="{{ route('backsite.type_device.index') }}">
                            <i></i><span>Tipe Device</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                </ul>
            </li>

            <li class=" navigation-header"><span data-i18n="Data">Data</span><i class="la la-ellipsis-h"
                    data-toggle="tooltip" data-placement="right" data-original-title="Data"></i></li>
            {{-- @can('device_hardware') --}}
            <li class=" nav-item"><a href="{{ route('backsite.device_hardware.index') }}"><i
                        class="{{ request()->is('backsite/device_hardware') || request()->is('backsite/device_hardware/*') || request()->is('backsite/*/device_hardware') || request()->is('backsite/*/device_hardware/*') ? 'bx bx-laptop bx-flashing' : 'bx bx-laptop' }}"></i><span
                        class="menu-title" data-i18n="Device Hardware">Device Hardware</span></a>
            </li>
            {{-- @endcan --}}
            {{-- @can('device_user') --}}
            <li class=" nav-item"><a href="{{ route('backsite.device_user.index') }}"><i
                        class="{{ request()->is('backsite/device_user') || request()->is('backsite/device_user/*') || request()->is('backsite/*/device_user') || request()->is('backsite/*/device_user/*') ? 'bx bx-user-circle bx-flashing' : 'bx bx-user-circle' }}"></i><span
                        class="menu-title" data-i18n="Device User">Device User</span></a>
            </li>
            {{-- @endcan --}}
            {{-- @can('device_division') --}}
            <li class=" nav-item"><a href="{{ route('backsite.device_division.index') }}"><i
                        class="{{ request()->is('backsite/device_division') || request()->is('backsite/device_division/*') || request()->is('backsite/*/device_division') || request()->is('backsite/*/device_division/*') ? 'bx bx-user-circle bx-flashing' : 'bx bx-user-circle' }}"></i><span
                        class="menu-title" data-i18n="Device Division">Device Division</span></a>
            </li>
            {{-- @endcan --}}

            <li class=" navigation-header"><span data-i18n="Application">Application</span><i class="la la-ellipsis-h"
                    data-toggle="tooltip" data-placement="right" data-original-title="Application"></i></li>

            @if (Auth::user()->detail_user->type_user_id == 1)
                {{-- @can('management_access') --}}
                <li class=" nav-item"><a href="#"><i
                            class="{{ request()->is('backsite/user') || request()->is('backsite/user/*') || request()->is('backsite/*/user') || request()->is('backsite/*/user/*') || request()->is('backsite/type_user') || request()->is('backsite/type_user/*') || request()->is('backsite/*/type_user') || request()->is('backsite/*/type_user/*') ? 'bx bx-group bx-flashing' : 'bx bx-group' }}"></i><span
                            class="menu-title" data-i18n="Management Access">Management Access</span></a>
                    <ul class="menu-content">
                        {{-- @can('type_user_access') --}}
                        <li
                            class="{{ request()->is('backsite/type_user') || request()->is('backsite/type_user/*') || request()->is('backsite/*/type_user') || request()->is('backsite/*/type_user/*') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('backsite.type_user.index') }}">
                                <i></i><span>Type User</span>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('user_access') --}}
                        <li
                            class="{{ request()->is('backsite/user') || request()->is('backsite/user/*') || request()->is('backsite/*/user') || request()->is('backsite/*/user/*') ? 'active' : '' }} ">
                            <a class="menu-item" href="{{ route('backsite.user.index') }}">
                                <i></i><span>User</span>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcan --}}
            @endif

            {{-- @can('setting') --}}
            <li class=" nav-item"><a href="#"><i
                        class="{{ request()->is('logout') || request()->is('backsite/profile') || request()->is('backsite/profile/*') || request()->is('backsite/*/profile') || request()->is('backsite/*/profile/*') ? 'bx bx-brightness bx-flashing' : 'bx bx-brightness' }}"></i><span
                        class="menu-title" data-i18n="Setting">Setting</span></a>
                <ul class="menu-content">
                    {{-- @can('profile') --}}
                    <li
                        class="{{ request()->is('backsite/profile') || request()->is('backsite/profile/*') || request()->is('backsite/*/profile') || request()->is('backsite/*/profile/*') ? 'active' : '' }} ">
                        <a class="menu-item" href="{{ route('backsite.profile.index') }}">
                            <i></i><span>Profil</span>
                        </a>
                    </li>
                    {{-- @endcan --}}

                    {{-- @can('logout') --}}
                    <li class="{{ request()->is('logout') ? 'active' : '' }} ">
                        <a class="menu-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i></i><span>Logout</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </li>
                    {{-- @endcan --}}
                </ul>
            </li>
            {{-- @endcan --}}
        </ul>
    </div>
</div>

<!-- END: Main Menu-->
