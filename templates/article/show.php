<?php require(dirname(__DIR__).'/header.php');?>
<div class="card mt-3" style="width: 100%; border: 0px">
  <div class="card-body"  style="border: 1px solid gray; border-radius: 1rem;">
    <h5 class="card-title"><?=$article->getTitle();?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?=$article->getAuthorId()->getNickname();?></h6>
    <p class="card-text"><?=$article->getText();?></p>
  </div>
  <div class="buttons_container" style="margin: 1rem; display: flex; flex-diretion: row; gap: 1rem;">
    <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/<?=$article->getId();?>/edit" class="btn btn-sm btn-outline-secondary">Редактировать статью</a>
    <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/<?=$article->getId();?>/delete" class="btn btn-sm btn-outline-secondary">Удалить статью</a>
    <a class="btn btn-sm btn-outline-secondary" href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/create?id=<?= $article->getId()?>">Оставить комментарий</a>
  </div>
  <p>Комментарии:</p>
  <div class="comments_wrapper" style="padding: 0rem 2rem 2rem 2rem; display: flex; flex-direction: column; gap: 1rem;">
    <?php foreach ($article->getComments() as $comment): ?>
      <div class="comment" id="comment<?= $comment->getId(); ?>" style="border: 1px solid gray; padding: 1rem; border-radius:1rem; max-width:28rem">
          <p style="margin: 0; "><?= $comment->getAuthorNickName(); ?>:</p>
          <p style="margin-left: 0.5rem;"><?= $comment->getText(); ?></p>
          <p class="comment-date" style="font-size:13px;"><?= $comment->getCreatedAt(); ?></p>
          <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/comment/<?= $comment->getId(); ?>/edit" class="btn btn-sm btn-outline-secondary">Редактировать</a>
          <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/comment/<?= $comment->getId(); ?>/delete" class="btn btn-sm btn-outline-secondary">Удалить</a>
      </div>
    <?php endforeach; ?>  
  </div>
</div>
<?php require(dirname(__DIR__).'/footer.html');?>