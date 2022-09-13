<?php require_once 'parts/header.php' ?>

<div class="table-body p-3 d-flex flex-column min-vh-100">
    
    <?php require 'parts/bttn.php' ?>

    <div class="table-body__table flex-grow-1">
    
        <table class="table table-dark">
            
            <thead>
                <tr>
                    <th class="table-body__title" data-index="0" scope="col">&#8661; Name</th>
                    <th class="table-body__title" data-index="1" scope="col">&#8661; Surname</th>
                </tr>
            </thead>
            
            <tbody class="table-body__body">

                <?php foreach ($users as $user): ?>

                    <tr class="table-body__row">
                        <td><?php echo $user['name'] ?></td>
                        <td><?php echo $user['surname'] ?></td>
                    </tr>

                <?php endforeach ?>

            </tbody>
        
        </table>
    
    </div>                

    <?php require 'parts/bttn.php' ?>

</div>

<?php require_once 'parts/footer.php' ?>
