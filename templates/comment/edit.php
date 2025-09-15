<?php require(dirname(__DIR__).'/header.php');?>
<form action="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/<?=$comment->getId();?>/update" method="post">
    <!-- <div class="mb-3">
    <label for="date" class="form-label">Public date</label>
    <input type="text" class="form-control" id="date" name="date" value="<?=$comment->getCreatedAt();?>">
    </div> -->
    <div class="mb-3">
    <label for="text" class="form-label">Text</label>
    <textarea class="form-control" id="text" rows="3" name="text"><?=$comment->getText();?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php require(dirname(__DIR__).'/footer.html');?>