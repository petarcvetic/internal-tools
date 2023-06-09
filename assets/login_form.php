<?php

if (isset($_SESSION['error_msg'])) {
	$msg = $_SESSION['error_msg'];
}

?>

<div class="login-box move-left-50">

  <br>

  <form class="login-form" id="login" method="POST">
    <fieldset>
      <div class="center-text"> <b>LOGIN:</b> </div>
<!--      <legend><b>LOGIN</b></legend>  -->

      <div class="login-div">
        <input type="text" name="username" id="username" class="center-text input-field" placeholder="Username" autofocus>
      </div>

      <div class="login-div">
        <input type="password" name="password" id="user-password" class="center-text input-field" placeholder="Password">
        <div class="label-center">
          <label><input type="checkbox" onclick="showPassword()"> Show Password</label>
        </div>
        <br><br>
      </div>

      <div class="login-div">
        <input type="submit" class="submit button-center" name="submitBtnLogin" value="Login"><br><br>
      </div>


      <div class="loginMsg"><?php echo $msg; ?></div>

    </fieldset>

  </form>

</div>

<script type="text/javascript">

/*
    if (window.matchMedia('(max-device-width: 768px)').matches) {
      alert('<768');
    } else {
      alert('>768');
    }
*/

  function mediaSize(){
    if (window.matchMedia('(max-device-width: 768px)').matches){
      $("body").css("background-image", "url('images/background_mobile.webp')");
      $(".header").css("border-bottom", "none");
    }
    else{
      $("body").css("background-image", "url('images/background.webp')");
    }
  }

  mediaSize();
  window.addEventListener('resize', mediaSize, false);
  $("#headerTop").css("background-color", "rgba(10,10,10,0)");
  $("#pc-code-logo").css("display", "none");

</script>