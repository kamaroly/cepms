   <html>
    <head>
        <title></title>
    
    <link href="<?php echo assets_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/bootstrap-responsive.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/font-awesome.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo assets_url('css/datepicker.css'); ?>"rel="stylesheet" type="text/css" >
    <link href="<?php echo assets_url('css/pages/dashboard.css'); ?>" rel="stylesheet">

 </head>
    <body>
  
<style type="text/css">
body{background: #eee url(http://subtlepatterns.com/patterns/sativa.png);}

.login-container{
    position: relative;
    width: 300px;
    margin: 80px auto;
    padding: 00px 40px 40px;
    text-align: center;
    background: #fff;
    border: 1px solid #ccc;
}

#output{
    position: absolute;
    width: 300px;
    top: -75px;
    left: 0;
    color: #fff;
}

#output.alert-success{
    background: rgb(25, 204, 25);
}

#output.alert-danger{
    background: rgb(228, 105, 105);
}


.login-container::before,.login-container::after{
    content: "";
    position: absolute;
    width: 100%;height: 100%;
    left: 0;
    background: #fff;
    z-index: -1;
    -webkit-transform: rotateZ(4deg);
    -moz-transform: rotateZ(4deg);
    -ms-transform: rotateZ(4deg);
    border: 1px solid #ccc;

}

.login-container::after{
    top:0px;
    z-index: -2;
    -webkit-transform: rotateZ(-2deg);
     -moz-transform: rotateZ(-2deg);
      -ms-transform: rotateZ(-2deg);

}

.avatar{
    width: 100px;
    height: 50px;
    margin: 10px 20px 20px 10px;

    background-size: cover;
}

.avatar img{
    width: 250px;
    height: 60px;
    margin: 10px auto 30px;
    background-size: cover;
}


.form-box input{
    width: 100%;
    padding: 20px;
    text-align: center;
    height:20px;
    border: 1px solid #ccc;;
    background: #fafafa;
    transition:0.2s ease-in-out;

}

.form-box input:focus{
    outline: 0;
    background: #eee;
}

.form-box input[type="text"]{
    border-radius: 5px 5px 0 0;
    text-transform: lowercase;
}

.form-box input[type="password"]{
    border-radius: 0 0 5px 5px;
    border-top: 0;
}

.form-box button.login{
    margin-top:15px;
    padding: 10px 20px;
}

.animated {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInUp {
  0% {
    opacity: 0;
    -webkit-transform: translateY(20px);
    transform: translateY(20px);
  }

  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
    transform: translateY(0);
  }
}

@keyframes fadeInUp {
  0% {
    opacity: 0;
    -webkit-transform: translateY(20px);
    -ms-transform: translateY(20px);
    transform: translateY(20px);
  }

  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
    -ms-transform: translateY(0);
    transform: translateY(0);
  }
}

.fadeInUp {
  -webkit-animation-name: fadeInUp;
  animation-name: fadeInUp;
}
</style>
<div class="container">
    <div class="">


<?php echo form_open("users/login",array('class'=>'form-signin'));?>

   <div class="login-container">
            <div id="output">
    <?php if(! empty($message)): ?>


         <div class="alert alert-success">
                     <button type="button" class="close" data-dismiss="alert">Close</button>
                    <?php echo $message;?>       
         </div>

     <?php endif; ?>
            </div>
            <div class="avatar">
                <img src="<?php echo site_url('/assets/img/headers/logo.png') ?>" width="180">
            </div>
            <div class="form-box">
                <form action="" method="">
                    <?php echo bs_form_input($identity);?>
                           <?php echo bs_form_input($password);?>
                    <button class="btn btn-info btn-block login" type="submit">Login</button>
                </form>
            </div>
        </div>
<?php echo form_close();?>


</div>
</div>
<script src="<?php echo assets_url('js/jquery-1.7.2.min.js'); ?>"></script>
<script src="<?php echo assets_url('js/bootstrap.js'); ?>"></script>
<script src="<?php echo assets_url('js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo assets_url('js/main.js'); ?>"></script>
<script src="<?php echo assets_url('js/angular.min.js'); ?>"></script>

<script src="<?php echo assets_url('js/base.js'); ?>"></script>
  
    </body>
    </html>

