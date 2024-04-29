
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li>
                <a class="ai-icon" href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="la la-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="{{ route('companies.index') }}" aria-expanded="false">
                    <i class="la la-building"></i>
                    <span class="nav-text">Companies</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="{{ route('employee.index') }}" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Employees</span>
                </a>
            </li>
            <li>
                <a class="ai-icon" href="{{ route('logout') }}" aria-expanded="false">
                    <i class="la la-sign-out"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>