<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <img src="{{ asset((setting('logo')) ? '/storage/'.setting('logo') : 'dist/img/logo/logoaz.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">CF</div>
    </a>
    <hr class="sidebar-divider my-0">

    @can('dashboard')
    <x-nav-link text="Dashboard" icon="th" url="{{ route('admin.dashboard') }}" active="{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}" />

    <hr class="sidebar-divider mt-3 mb-0">
    @endcan

    @can('penentuan')
    <x-nav-link text="Penentuan" icon="stethoscope" url="{{ route('admin.penentuan') }}" active="{{ request()->routeIs('admin.penentuan') ? ' active' : '' }}" />
    @endcan

    @can('hasil-list')
    <x-nav-link text="hasil Penentuan" icon="notes-medical" url="{{ route('admin.hasil.daftar') }}" active="{{ request()->routeIs('admin.hasil.daftar') ? ' active' : '' }}" />
    @endcan

    @can('member-list')
    <hr class="sidebar-divider mt-3 mb-0">

    <x-nav-link text="Daftar User" icon="users" url="{{ route('admin.member') }}" active="{{ request()->routeIs('admin.member') ? ' active' : '' }}" />
    @endcan

    @can('defect-list')
    <x-nav-link text="Daftar Defect" icon="th-list" url="{{ route('admin.defect') }}" active="{{ request()->routeIs('admin.defect') ? ' active' : '' }}" />
    @endcan

    @can('ciriciri-list')
    <x-nav-link text="Daftar Ciri ciri" icon="th-list" url="{{ route('admin.ciriciri') }}" active="{{ request()->routeIs('admin.ciriciri') ? ' active' : '' }}" />
    @endcan

    @can('rulesdefect-list')
    <x-nav-link text="Basis Rules defects" icon="briefcase-medical" url="{{ route('admin.rulesdefect', 1) }}" active="{{ request()->routeIs('admin.rulesdefect') ? ' active' : '' }}" />
    @endcan

    <hr class="sidebar-divider mb-0">


    {{--
    <hr class="sidebar-divider mb-0"> --}}

</ul>