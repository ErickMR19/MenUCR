<?php 
    $name = $this->request->session()->read('Auth.User.name');
    $idUser = $this->request->session()->read('Auth.User.id');    
    $isAdmin = $this->request->session()->read('Auth.User.role') === 'admin'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php echo $this->Html->meta('favicon.ico','webroot/favicon.ico',array('type' => 'icon'));?>
    <title>Administración</title>

    <!-- Bootstrap Core CSS -->
    <?= $this->Html->css('bootstrap.min.css') ?>

    <!-- Custom CSS -->
    <?= $this->Html->css('sb-admin.css') ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">


    <?= $this->Html->css('layout.css') ?>




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?php if (! $idUser): ?>
    <style>
        #wrapper {
            padding: 0;
            width: 80%;
            margin: 0 auto;
        }
    </style>
    <?php endif; ?>

</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <?php if ($idUser): ?>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php endif; ?>
                <a class="navbar-brand" href="#">Administración</a>
            </div>
            <!-- Top Menu Items -->
            <?php if ($idUser): ?>
            <ul class="nav navbar-right top-nav">


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$name?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?= $this->Html->link('<i class="fa fa-fw fa-key"></i>Cambiar contraseña',['controller'=>'Users','action'=>'changePassword'],
    ['escape' => false, 'style'=>'white-space: nowrap;']);?>
                        </li>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-fw fa-user"></i>Modificar perfil',['controller'=>'Users','action'=>'edit', $idUser],
    ['escape' => false]);?>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-fw fa-power-off"></i>Cerrar sesión',['controller'=>'Users','action'=>'logout'],
    ['escape' => false]);?>
                        </li>
                    </ul>
                </li>
            </ul>
            <?php endif; ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php if ($idUser): ?>
                <ul id="menu_lateral" class="nav navbar-nav side-nav">
                    <li id="menu_tipo_menus">
                        <a  data-toggle="collapse" data-target="#menu_id">Tipos de Menú</a>
                        <ul id="menu_id" class="collapse">
                            <li><?php echo $this->Html->link('Nuevo Tipo Menú',['controller'=>'Menus','action'=>'add']);?></li>
                            <li><?php echo $this->Html->link('Administrar Tipos Menús',['controller'=>'Menus','action'=>'index']);?></li>
                        </ul>
                    </li>
                    <li id="menu_platos">
                        <a  data-toggle="collapse" data-target="#dishes_id">Platillos</a>
                        <ul id="dishes_id" class="collapse">
                            <li><?php echo $this->Html->link('Nuevo Platillo',['controller'=>'Dishes','action'=>'add']);?></li>
                            <li><?php echo $this->Html->link('Administrar Platillos',['controller'=>'Dishes','action'=>'index']);?></li>
                        </ul>
                    </li>
                    <li id="menu_categorias">
                        <a  data-toggle="collapse" data-target="#categories_id">Tipos de Platillos</a>
                        <ul id="categories_id" class="collapse">
                            <li><?php echo $this->Html->link('Nuevo Tipo',['controller'=>'Categories','action'=>'add']);?></li>
                            <li><?php echo $this->Html->link('Administrar Tipos',['controller'=>'Categories','action'=>'index']);?></li>
                        </ul>
                    </li>

                    <li id="menu_menus">
                        <a  data-toggle="collapse" data-target="#menus_id">Menús</a>
                        <ul id="menus_id" class="collapse">
                            <li><?php echo $this->Html->link('Nuevo Menú',['controller'=>'MenusDishesCategories','action'=>'add']);?></li>
                            <li><?php echo $this->Html->link('Administrar Menús',['controller'=>'MenusDishesCategories','action'=>'index']);?></li>
                        </ul>
                    </li>
                    <?php if ($isAdmin): ?>
                    <li id="menu_sodas">
                        <a  data-toggle="collapse" data-target="#restaurants_id">Sodas</a>
                        <ul id="restaurants_id" class="collapse">
                            <li><?php echo $this->Html->link('Nueva Soda',['controller'=>'Restaurants','action'=>'add']);?></li>
                            <li><?php echo $this->Html->link('Administrar Sodas',['controller'=>'Restaurants','action'=>'index']);?></li>
                        </ul>
                    </li>

                    <li id="menu_associations">
                        <a  data-toggle="collapse" data-target="#associations_id">Asociaciones</a>
                        <ul id="associations_id" class="collapse">
                            <li><?php echo $this->Html->link('Nueva Asociación',['controller'=>'Associations','action'=>'add']);?></li>
                            <li><?php echo $this->Html->link('Administrar Asociaciones',['controller'=>'Associations','action'=>'index']);?></li>
                        </ul>
                    </li>

                    <li id="menu_sedes">
                            <a data-toggle="collapse" data-target="#headquarters_id">Sedes</a>
                            <ul id="headquarters_id" class="collapse">
                                <li><?php echo $this->Html->link('Nueva Sede',['controller'=>'Headquarters','action'=>'add']);?></li>
                                <li><?php echo $this->Html->link('Administrar Sedes',['controller'=>'Headquarters','action'=>'index']);?></li>
                            </ul>
                    </li>

                    <li id="menu_users">
                        <a data-toggle="collapse" data-target="#users_id">Usuarios</a>
                        <ul id="users_id" class="collapse">
                            <li><?php echo $this->Html->link('Nuevo Usuario',['controller'=>'Users','action'=>'add']);?></li>
                            <li><?php echo $this->Html->link('Administrar Usuarios',['controller'=>'Users','action'=>'index']);?></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <?php $this->Flash->render() ?>
            <div class="container-fluid">

                <?= $this->fetch('content') ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    
    <!-- jQuery -->
    <?=$this->Html->script('jquery.js') ?>

    <!-- Bootstrap Core JavaScript -->
    <?=$this->Html->script('bootstrap.min.js') ?>

</body>

</html>
