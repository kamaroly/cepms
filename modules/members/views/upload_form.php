
<?php var_dump($errors); ?>
<?php echo form_open_multipart('members/multipleuploads'); ?>
    <p>
        <?php echo form_label('File 1: ', 'file1') ?>
        <?php echo form_upload('file1') ?>
    </p>
    <p>
        <?php echo form_label('File 2: ', 'file2') ?>
        <?php echo form_upload('file2') ?>
    </p>
    <p><?php echo form_submit('submit', 'Upload them files!') ?></p>
 <?php echo form_close() ?>