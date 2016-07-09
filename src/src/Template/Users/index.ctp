
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Lista de usuarios</h2>

    </div>
</div>

<div class="row">
    <div class="col-xs-12">
    <table class="table table-responsive">
    <thead>
        <th>Nombre de Usuario</th>
        <th>Nombre Completo</th>
        <th>Rol</th>
        <th>Asociación que administra</th>
        <th>Acciones</th>
    </thead>
    <tbody>
        <?php foreach($users as $user){
            echo '<tr>' .
                "<td>{$user['username']}</td>" .
                "<td>{$user['name']} {$user['last_name_1']} {$user['last_name_2']}</td>" .
                "<td>{$user['role']}</td>" .
                "<td>{$user['association']['name']}</td>" .
                "<td>{$this->Html->link( 'Editar', ['controller' => 'Users', 'action' => 'edit', $user['id']])} |
                     {$this->Html->link( 'Eliminar', ['controller' => 'Users', 'action' => 'delete', $user['id']], ['confirm' => 'Confirma que desea eliminar este usuario?'])}".
                '</td></tr>';
        }
        ?>
        </tbody>
    </tbody>

        
    </table>
</div>
    
</div>
<script>
    document.getElementById('menu_users').classList.add('active');
</script>