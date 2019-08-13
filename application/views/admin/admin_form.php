<!doctype html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Admin <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Admin <?php echo form_error('nama_admin') ?></label>
            <input type="text" class="form-control" name="nama_admin" id="nama_admin" placeholder="Nama Admin" value="<?php echo $nama_admin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email Admin <?php echo form_error('email_admin') ?></label>
            <input type="text" class="form-control" name="email_admin" id="email_admin" placeholder="Email Admin" value="<?php echo $email_admin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password Admin <?php echo form_error('password_admin') ?></label>
            <input type="text" class="form-control" name="password_admin" id="password_admin" placeholder="Password Admin" value="<?php echo $password_admin; ?>" />
        </div>
	    <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('admin') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>