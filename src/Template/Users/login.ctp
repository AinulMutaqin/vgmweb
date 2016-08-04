<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo $this->request->webroot ?>icons/favicon.ico">
    <title>Signin Template for Bootstrap</title>
	<link rel="stylesheet" href="<?php echo $this->request->webroot ?>css/signin.css">
	<link rel="stylesheet" href="css/bootstrap-custom.css">
  </head>
<body>
	<div class="login-box-body">
		<?= $this->Flash->render('auth') ?>
		<?= $this->Form->create(null,['class'=>'form-signin animated fadeIn']) ?>
			<label class="form-signin-heading">Please enter your username and password</label>
			<?= $this->Form->input('username',['class'=>'form-control', 'placeholder'=>'username']) ?>
			<?= $this->Form->input('password',['class'=>'form-control', 'placeholder'=>'password']) ?>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		<?= $this->Form->end() ?>
	</div>
</body>
</html>