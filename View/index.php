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
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
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
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="fiche">FICHES</a>
                    </li>
                </ul>


            </nav>

            <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
                <h1>Dashboard</h1>

                <section class="row text-center placeholders">

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
</body>
</html>
