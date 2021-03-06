<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}"> <i class="menu-icon fa fa-users"></i>Users</a>
                    </li>
                    <li class="{{ Request::is('admin/contributions*') ? 'active' : '' }}">
                        <a href="{{ route('contributions.index') }}"> <i class="menu-icon fa fa-plus-circle"></i>Contributions</a>
                    </li>
                    <li class="{{ Request::is('admin/loans*') ? 'active' : '' }} {{ Request::is('admin/paid/loans*') ? 'active' : '' }} {{ Request::is('admin/defaulted/loans*') ? 'active' : '' }}">
                        <a href="{{ route('loans.index') }}"> <i class="menu-icon fa fa-credit-card"></i>Loans</a>
                    </li>
                    <li class="{{ Request::is('admin/expenses*') ? 'active' : '' }}">
                        <a href="{{ route('expenses.index') }}"> <i class="menu-icon fa fa-usd"></i>Expenses</a>
                    </li>
                    <li class="{{ Request::is('admin/projects*') ? 'active' : '' }} {{ Request::is('admin/completed/projects*') ? 'active' : '' }} {{ Request::is('admin/failed/projects*') ? 'active' : '' }}">
                        <a href="{{ route('projects.index') }}"> <i class="menu-icon fa fa-briefcase"></i>Projects</a>
                    </li>
                    
                    <!-- <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Pages</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="page-login.html">Login</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="page-register.html">Register</a></li>
                            <li><i class="menu-icon fa fa-paper-plane"></i><a href="pages-forget.html">Forget Pass</a></li>
                        </ul>
                    </li> -->
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>