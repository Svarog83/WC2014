<div>
    <form action="index.php?todo=save_settings" method="post">
        <? foreach ( $settings_arr AS $key => $value ): ?>
        <?= $key?>: <input type="text" size="30" name="form_sett[<?= $key?>]" value="<?= $value?>">
        <? endforeach ?>
        <br>
        <input type="submit" value="Save"> 
    </form>
</div>