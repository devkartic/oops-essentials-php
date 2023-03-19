<?php
include('autoloader.php');
include('includes/header.php');

$obj = new \Classes\QueryBuilder();
$results = $obj->get('category');
?>
<div class="container">
    <div class="card">
        <div class="card-header">Item List</div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sl = 0;
                while ($row = mysqli_fetch_assoc($results)) {
                    ++$sl;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $sl;?></th>
                        <td><?php echo $row['Name'];?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

