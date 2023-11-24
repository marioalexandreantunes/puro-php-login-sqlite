<nav class="container mt-1 p-4 border rounded-3 shadow-sm bg-light">
    <div class="row align-items-center">
        <div class="col">
            <h4 class="fw-light">PURO PHP LOGIN</h4>
        </div>

        <div class="col text-center">
            <a href="?route=home">Home</a>
            <span class="mx-2">|</span>
            <a href="?route=blog">Blog</a>
        </div>

        <div class="col text-end">
            <span class="fw-lighter" >Usuário logado: <strong><?= $_SESSION['user']['name']?></strong></span>
            <span class="mx-2">|</span>
            <a href="?route=logout">Sair</a>
        </div>
    </div>
</nav>