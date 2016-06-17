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
    <?= $this->Html->css('plugins/morris.css') ?>
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


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Administración</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i>Ver perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i>Cerrar sesión</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="menu_tipo_menus">
                        <a  data-toggle="collapse" data-target="#menu_id">Tipos de Menú</a>
                        <div id="menu_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nuevo Tipo Menú',['controller'=>'Menus','action'=>'add']);?></li>
                                <li><?php echo $this->Html->link('Administrar Tipos Menús',['controller'=>'Menus','action'=>'index']);?></li>
                            </ul>
                        </div>
                    </li>
                    <li id="menu_platos">
                        <a  data-toggle="collapse" data-target="#dishes_id">Platillos</a>
                        <div id="dishes_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nuevo Platillo',['controller'=>'Dishes','action'=>'add']);?></li>
                                <li><?php echo $this->Html->link('Administrar Platillos',['controller'=>'Dishes','action'=>'index']);?></li>
                            </ul>
                        </div>
                    </li>
                    <li id="menu_categorias">
                        <a  data-toggle="collapse" data-target="#categories_id">Tipos de Platillos</a>
                        <div id="categories_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nuevo Tipo',['controller'=>'Categories','action'=>'add']);?></li>
                                <li><?php echo $this->Html->link('Administrar Tipos',['controller'=>'Categories','action'=>'index']);?></li>
                            </ul>
                        </div>
                    </li>

                    <li id="menu_menus">
                        <a  data-toggle="collapse" data-target="#menus_id">Menús</a>
                        <div id="menus_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nuevo Menú',['controller'=>'MenusDishesCategories','action'=>'add']);?></li>
                                <li><?php echo $this->Html->link('Administrar Menús',['controller'=>'MenusDishesCategories','action'=>'index']);?></li>
                            </ul>
                        </div>
                    </li>

                    <li id="menu_sodas">
                        <a  data-toggle="collapse" data-target="#restaurants_id">Sodas</a>
                        <div id="restaurants_id" class="collapse">

                            <ul>
                                <li><?php echo $this->Html->link('Nueva Soda',['controller'=>'Restaurants','action'=>'add']);?></li>
                                <li><?php echo $this->Html->link('Administrar Sodas',['controller'=>'Restaurants','action'=>'index']);?></li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a  data-toggle="collapse" data-target="#associations_id">Asociaciones</a>
                        <div id="associations_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nueva Asociación',['controller'=>'Associations','action'=>'add']);?></li>
                                <li><?php echo $this->Html->link('Administrar Asociaciones',['controller'=>'Associations','action'=>'index']);?></li>
                            </ul>
                        </div>
                    </li>

                    <li id="menu_sedes">
                        <a  data-toggle="collapse" data-target="#headquarters_id">Sedes</a>
                        <div id="headquarters_id" class="collapse">
                            <ul>
                                <li><?php echo $this->Html->link('Nueva Sede',['controller'=>'Headquarters','action'=>'add']);?></li>
                                <li><?php echo $this->Html->link('Administrar Sedes',['controller'=>'Headquarters','action'=>'index']);?></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?= $this->fetch('content') ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>

    <!-- jQuery -->
    <?=$this->Html->script('jquery.js') ?>
    <!-- /#wrapper -->
    <?=$this->Html->script('plugins/morris/morris.min.js') ?>
    <?=$this->Html->script('plugins/morris/morris-data.js') ?>

    <!-- Bootstrap Core JavaScript -->

    <?=$this->Html->script('bootstrap.min.js') ?>

    <!-- Morris Charts JavaScript -->

    <?=$this->Html->script('plugins/morris/raphael.min.js') ?>


</body>

</html>
