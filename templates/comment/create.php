<?php require(dirname(__DIR__).'/header.php');?>
<form action="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/store" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'])?>">
    <div class="mb-3">
        <label for="text" class="form-label">Text</label>
        <textarea class="form-control" id="text" rows="3" name="text"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

<?php require(dirname(__DIR__).'/footer.html');?>