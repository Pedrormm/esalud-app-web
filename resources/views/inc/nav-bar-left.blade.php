
<nav class="left">
    <div class="user">
        <img class="avatar big" src="{{ asset('images/avatars/admin.png') }}">
        <div>
            <span class="name"> {{ $user->name }}</span>
            <span class="lastname"> {{ $user->lastname }}</span>
        </div>
    </div>

    <ul>
        <li>
            <a name="record" href="?v=record">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-folder-open-o fa-stack-1x fa-inverse"></i>
                </span>
                <label>Historiales Medicos</label>
            </a>
        </li>
        <li>
            <a name="chats" href="?v=chats">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-comments-o fa-stack-1x fa-inverse"></i>
                </span>
                <label>Mensajeria</label>
            </a>
        </li>
        <li>
            <a name="calendar" href="?v=calendar">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
                </span>
                <label>Gestión de citas</label>
            </a>
        </li>
        <li>
            <a name="staff" href="?v=staff">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-user-md fa-stack-1x fa-inverse"></i>
                </span>
                <label>Gestión del Personal</label>
            </a>
        </li>
        <li>
            <a name="patients" href="?v=patients">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-group fa-stack-1x fa-inverse"></i>
                </span>
                <label>Gestión de Pacientes</label>
            </a>
        </li>        
        <li>
            <a name="users" href="?v=users">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-h-square fa-stack-1x fa-inverse"></i>
                </span>
                <label>Usuarios</label>
            </a>
        </li>        
        <li>
            <a name="roles" href="?v=roles">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-key fa-stack-1x fa-inverse"></i>
                </span>
                <label>Gestion de roles</label>
            </a>
        </li>        
        <li>
            <a name="profile" href="?v=profile">
                    <span class="fa-stack fa-2x menu_icon">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-cog fa-stack-1x fa-inverse"></i>
                    </span>
                <label>Ajustes</label>
            </a>
        </li>
        <li href="">
            <a href="core/logout.php" name="logout">
                <span class="fa-stack fa-2x menu_icon">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-power-off fa-stack-1x fa-inverse"></i>
                </span>
                <label>Salir</label>
            </a>
        </li>
    </ul>

</nav>