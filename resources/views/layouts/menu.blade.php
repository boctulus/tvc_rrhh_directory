<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('brands.index') }}" class="nav-link {{ Request::is('brands*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Brands</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('areas.index') }}" class="nav-link {{ Request::is('areas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Areas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('certifications.index') }}" class="nav-link {{ Request::is('certifications*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Certifications</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('lines-families.index') }}" class="nav-link {{ Request::is('linesFamilies*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Lines Families</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('positions.index') }}" class="nav-link {{ Request::is('positions*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Positions</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('professionals.index') }}" class="nav-link {{ Request::is('professionals*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Professionals</p>
    </a>
</li>

<!-- <li class="nav-item">
    <a href="{{ route('professional-areas.index') }}" class="nav-link {{ Request::is('professionalAreas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Professional Areas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('professional-brands.index') }}" class="nav-link {{ Request::is('professionalBrands*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Professional Brands</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('professional-certifications.index') }}" class="nav-link {{ Request::is('professionalCertifications*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Professional Certifications</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('professional-line-families.index') }}" class="nav-link {{ Request::is('professionalLineFamilies*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Professional Line Families</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('professional-skills.index') }}" class="nav-link {{ Request::is('professionalSkills*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Professional Skills</p>
    </a>
</li> -->

<li class="nav-item">
    <a href="{{ route('states.index') }}" class="nav-link {{ Request::is('states*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>States</p>
    </a>
</li>

<li class="nav-header">NAVEGACIÓN</li>
<li class="nav-item">
    <a href="{{ route('personal.index') }}" class="nav-link {{ Request::is('personal*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th-large"></i>
        <p>Ir al Grid</p>
    </a>
</li>
