<?php include 'header.php' ?>;
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand navbar-brand-size" href="javascript:void()">TABLEAU DE BORD</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <div class="searchbtn">
                <form class="form-inline mt-2 mt-md-0" action="javascript:void()">
                    <input class="form-control mr-sm-2" type="text" placeholder="Rechercher Fiche" aria-label="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-outline-success" type="submit" id="searchButton">Search</button>
                    </span>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column categ">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" id="category">CATEGORIES</a>
                    </li>
                </ul>
                <span class="input-group-btn nvcateg">
                    <button class="btn btn-primary col-sm-12" type="button" id="editNouvCat">Nouveau +</button>
                </span>
                <div id="jstree_demo_div">
                </div>


            </nav>
            <div class="ctb">
                <div class="container_box">
                    <main class="col-sm-12" role="main">
                        <div class="hero-unit">
                            <div class="span2">
                                <h1>Liste des fichiers</h1>
                            </div>
                        </div>
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
                            <span class="col-sm-2">
                                <button type="button" class="btn btn-primary editFiche" data-value="new">Nouveau Fiche</button>
                            </span>
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
            <div class="form-group-perso">
                <div class="row">
                    <label class="control-label col-sm-4">Categories :</label>
                    <select id='selectEditCategory' class="width form-control form-control-perso">
                    </select>
                </div>
            </div>
            <div class="clearfix" style="margin-top:10px;"></div>
            <div class="form-group-perso">
                <div class="row">
                    <label class="control-label col-sm-4">Libellé :</label>
                    <input type="text" id='libelleEdit'class="width controlVide form-control form-control-perso"/>
                </div>
            </div>
            <div id="img-loading-edit">
                <img src="../Assets/Images/loading.gif" style="height: 30px;float: right;display: none;">
            </div>
        </div>
    </div>
    <div style="display: none;">
        <div id="dialog-edit-category" title="Modification Fiche">
            <input type="hidden" id='idEditCategory' />
            <div class="form-group-perso">
                <div class="row">
                    <label class="control-label col-sm-4">Parent : </label>
                    <select id='selectEditCategoryC' class="form-control form-control-perso width">
                    </select>
                </div>
            </div>
            <div class="clearfix" style="margin-top:10px;"></div>
            <div class="form-group-perso">
                <div class="row">
                    <label class="control-label col-sm-4">Libellé :</label>
                    <input type="text" id='libelleEditCategory'class="width controlVide form-control form-control-perso"/>
                </div>
            </div>
            <div class="clearfix" style="margin-top:10px;"></div>
            <div class="form-group-perso">
                <div class="row">
                    <label class="control-label col-sm-4">Description :</label>
                    <textarea type="text" id='descriptionCategory'class="width controlVide form-control form-control-perso"></textarea>
                </div>
            </div>
            <div id="img-loading-edit-category">
                <img src="../Assets/Images/loading.gif" style="height: 30px;float: right;display: none;" />
            </div>
        </div>
    </div>
</body>
</html>
