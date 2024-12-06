<?php

$erro = $_SESSION['error'] ?? null;
unset($_SESSION['error']);

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card bg-light p-5 shadow mt-5">
                <div class="row">
                    <div class="col">
                        <p class="display-6 fw-lighter">LOGIN</p>
                    </div>
                    <div class="col text-end">
                        <img src="\assets\images\user-interface.png" class="img-fluid w-50" alt="user image">
                    </div>
                </div>
                <hr>
                <form action="?route=login_submit" method="post">
                    <div class="mb-3">
                        <label for="text_usuario" class="form-label">Usuário</label>
                        <input type="text" name="text_usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="text_senha" class="form-label">Senha</label>
                        <input type="password" name="text_senha" class="form-control" required>
                    </div>
                    <div>
                        <input type="submit" value="Entrar" class="btn btn-secondary w-100">
                    </div>
                </form>
                <?php if (!empty($erro)) : ?>
                <div class="alert alert-danger mt-3 p-2 text-center">
                    <?= $erro ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>