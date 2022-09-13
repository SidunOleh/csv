<?php require_once 'parts/header.php' ?>

<div class="form-csv p-3">

    <?php if (isset($_SESSION['message'])): ?>

        <div class="message mb-4"><?php echo $_SESSION['message'] ?></div>

    <?php unset($_SESSION['message']); endif ?>
    

    <form action="/import" method="POST" class="form mb-4" enctype="multipart/form-data">
        <div class="mb-3">
            <input class="form-control form-control-lg" id="formFileLg" type="file" name="csv" accept=".csv">
        </div>

        <div>
            <button type="submit" class="btn btn-primary w-100">Send</button>
        </div>
    </form>

    <div class="link text-center">
        <a href="/table">Show table</a>
    </div>

</div>

<?php require_once 'parts/footer.php' ?>
