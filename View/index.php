<?php include 'header.php' ?>;
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0" action="javascript:void()">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="searchButton">Search</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" id="category">CATEGORIES</a>
                    </li>
                </ul>
                <div id="jstree_demo_div">
                </div>


            </nav>

            <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
                <h1>Dashboard</h1>

                <section class="row text-center placeholders">
                    <!-- MESSAGE D'EURREUR -->
                    <div id="succes" class="alert alert-success alert-dismissible fade show" role="alert" style="width: 90%;margin-left: 20px;height: 55px;display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong></strong>
                    </div>
                    <div id="error" class="alert alert-warning alert-dismissible fade show" role="alert" style="width: 90%;margin-left: 20px;height: 55px;display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Operation n'abouti pas </strong>
                    </div>
                    <!-- FIN MESSAGE D'EURREUR -->
                    <button type="button" class="btn btn-primary editFiche" data-value="new">Nouveau Fiche</button>
                </section>
                <div id="tableContent" style="display: none;">
                    <!--                   table content-->
                </div>
                <div id="img-loading" class="img-loading">
                    <img src="../Assets/Images/loading.gif"  height = "200px">
                </div>
            </main>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <div style="display: none;">
        <div id="dialog-confirm" title="Confirmation">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Voulez-vous supprimer ?</p>
        </div>
    </div>
    <div style="display: none;">
        <div id="dialog-edit-fiche" title="Modification Fiche">
            <input type="hidden" id='idEdit'>
            <label>Categories</label>&nbsp;&nbsp;&nbsp;
            <select id='selectEditCategory' class="width">
            </select><br />
            <label>Libellé</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" id='libelleEdit'class="width controlVide"/>
            <div id="img-loading-edit">
                <img src="../Assets/Images/loading.gif" style="height: 30px;float: right;display: none;">
            </div>
        </div>
    </div>
    <div style="display: none;">
        <div id="dialog-edit-category" title="Modification Fiche">
            <input type="hidden" id='idEditCategory' />
            <label>parentId</label>&nbsp;&nbsp;&nbsp;
            <select id='selectEditCategoryC' class="width">
            </select><br />
            <label>Libellé</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" id='libelleEditCategory'class="width controlVide"/>
            <label>Description</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <textarea type="text" id='descriptionCategory'class="width controlVide"></textarea>
            <div id="img-loading-edit-category">
                <img src="../Assets/Images/loading.gif" style="height: 30px;float: right;display: none;" />
            </div>
        </div>
    </div>
</body>
</html>
