<nav class="main hidden-xs hidden-sm">
    
    <ul>
        <li>
            <a name="records" href="{{ URL::asset('/user/records') }}">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-folder-open-o fa-stack-1x fa-inverse"></i>
                </span>
                <label>Historiales Medicos</label>
            </a>
        </li>
        <li>
            <a name="chat" href="{{ URL::asset('/user/chat') }}">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-comments-o fa-stack-1x fa-inverse"></i>
                </span>
                <label>Mensajería</label>
            </a>
        </li>
        <li>
            <a name="calendar" href="{{ URL::asset('/user/calendar') }}">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
                </span>
                <label>Gestión de citas</label>
            </a>
        </li>
        <li>
            <a name="staff" href="{{ URL::asset('/user/staff') }}">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-user-md fa-stack-1x fa-inverse"></i>
                </span>
                <label>Gestión del Personal</label>
            </a>
        </li>
        <li>
            <a name="patient" href="{{ URL::asset('/user/patient') }}">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-group fa-stack-1x fa-inverse"></i>
                </span>
                <label>Gestión de Pacientes</label>
            </a>
        </li>
        <li>
            <a name="user" href="{{ URL::asset('/user/user') }}">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-h-square fa-stack-1x fa-inverse"></i>
                </span>
                <label>Usuarios</label>
            </a>
        </li>
        <li>
            <a name="rol" href="{{ URL::asset('/user/rol') }}">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-key fa-stack-1x fa-inverse"></i>
                </span>
                <label>Gestión de roles</label>
            </a>
        </li>
        <li>
            <a name="profile" href="{{ URL::asset('/user/profile') }}">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-cog fa-stack-1x fa-inverse"></i>
                </span>
                <label>Ajustes</label>
            </a>
        </li>
        <li>
            <a name="logout" href="{{ URL::asset('/logout') }}">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-power-off fa-stack-1x fa-inverse"></i>
                </span>
                <label>Salir</label>
            </a>
        </li>
    </ul>

</nav>