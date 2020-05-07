<?php
error_reporting(0);
session_start();
if(isset($_SESSION['isAdmin'])){
  if($_SESSION['isAdmin'] = true){
      header("location: dashboardX");
  }
}


$token2222 = $_SESSION['tokenInvalidCounter'];

if (isset($_SESSION['tokenInvalidCounter'])) {
  
  if ($_SESSION['tokenInvalidCounter'] === $_GET['token']) {
    echo "<script>alert('Suspicious Attempt!')</script>";
    session_destroy();
  } else if ($_SESSION['tokenInvalidCounter'] === null) {  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset=utf-8 />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dash</title>

  <!-- Material Design Theming -->
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/aes.js"></script>

  <link rel="stylesheet" href="main.css">
</head>

<body>
  <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-header">

    <!-- Header section containing title -->
    <header class="mdl-layout__header mdl-color-text--white mdl-color--light-blue-700">
      <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-grid">
        <div class="mdl-layout__header-row mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--8-col-desktop">
          <a href="/">
            <h3>Admin Login</h3>
          </a>
        </div>
      </div>
    </header>

    <main class="mdl-layout__content mdl-color--grey-100">
      <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-grid">

        <!-- Container for the demo -->
        <div id="sign-in-card" class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
          <div class="mdl-card__title mdl-color--light-blue-600 mdl-color-text--white">
            <h2 class="mdl-card__title-text">Enter Phone number</h2>
          </div>
          <div class="mdl-card__supporting-text mdl-color-text--grey-600">
            <p>Sign in with your phone number below.</p>

            <form id="sign-in-form" action="#">
              <!-- Input to enter the phone number -->
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" pattern="\+[0-9\s\-\(\)]+" id="phone-number">

                <span class="mdl-textfield__error">Input is not an international phone number!</span>
              </div>

              <!-- Sign-in button -->
              <button disabled class="mdl-button mdl-js-button mdl-button--raised" id="sign-in-button">Sign-in</button>
            </form>

            <!-- Button that handles sign-out -->
            <button class="mdl-button mdl-js-button mdl-button--raised" id="sign-out-button">Sign-out</button>

            <form id="verification-code-form" action="#">
              <!-- Input to enter the verification code -->
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="verification-code">
                <label class="mdl-textfield__label" for="verification-code">Enter the verification code...</label>
              </div>

              <!-- Button that triggers code verification -->
              <input type="submit" class="mdl-button mdl-js-button mdl-button--raised" id="verify-code-button" value="Verify Code" />
              <!-- Button to cancel code verification -->
              <button class="mdl-button mdl-js-button mdl-button--raised" id="cancel-verify-code-button">Cancel</button>
            </form>
          </div>
        </div>

        <!-- Container for the sign in status and user info -->
        <h6 id="uurrll"></h6>
      </div>
    </main>
  </div>

  <script src="https://www.gstatic.com/firebasejs/6.1.1/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/6.1.1/firebase-auth.js"></script>
  <script src="init.js"></script>

  <script type="text/javascript">
    window.onload = function() {

      function prifnc() {
        var prifncNum = document.querySelector("#phone-number")
        window.location = "?number=" + prifncNum;
      }
      // Listening for auth state changes.
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          // User is signed in.
          var phoneNumber = user.phoneNumber;
          var isAnonymous = user.isAnonymous;
        }
        updateSignInButtonUI();
        updateSignInFormUI();
        updateSignOutButtonUI();
        updateSignedInUserStatusUI();
        updateVerificationCodeFormUI();
      });
      // Event bindings.
      document.getElementById('sign-out-button').addEventListener('click', onSignOutClick);
      document.getElementById('phone-number').addEventListener('keyup', updateSignInButtonUI);
      document.getElementById('phone-number').addEventListener('change', updateSignInButtonUI);
      document.getElementById('verification-code').addEventListener('keyup', updateVerifyCodeButtonUI);
      document.getElementById('verification-code').addEventListener('change', updateVerifyCodeButtonUI);
      document.getElementById('verification-code-form').addEventListener('submit', onVerifyCodeSubmit);
      document.getElementById('cancel-verify-code-button').addEventListener('click', cancelVerification);
      // [START appVerifier]
      window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('sign-in-button', {
        'size': 'invisible',
        'callback': function(response) {
          // reCAPTCHA solved, allow signInWithPhoneNumber.
          onSignInSubmit();
        }
      });
      // [END appVerifier]
      recaptchaVerifier.render().then(function(widgetId) {
        window.recaptchaWidgetId = widgetId;
        updateSignInButtonUI();
      });
    };

    function onSignInSubmit() {

      if (isPhoneNumberValid()) {
        window.signingIn = true;
        updateSignInButtonUI();
        var phoneNumber = getPhoneNumberFromUserInput();
        var appVerifier = window.recaptchaVerifier;
        var windowUrlNum = "http://localhost/coupon%20site/admin?number=" + phoneNumber
        console.log(windowUrlNum)

        $.ajax({
          type: "POST",
          url: '../admin/load.php',
          data: {
            numb: phoneNumber
          },
        }).done(function(dataSb) {

          if (dataSb == true) {
            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
              .then(function(confirmationResult) {
                window.confirmationResult = confirmationResult;
                window.signingIn = false;
                updateSignInButtonUI();
                updateVerificationCodeFormUI();
                updateVerifyCodeButtonUI();
                updateSignInFormUI();
              }).catch(function(error) {
                // Error; SMS not sent
                console.error('Error during signInWithPhoneNumber', error);
                window.alert('Error during signInWithPhoneNumber:\n\n' +
                  error.code + '\n\n' + error.message);
                window.signingIn = false;
                updateSignInFormUI();
                updateSignInButtonUI();
              });
          } else {
            console.log(dataSb)
            alert("invalid")
          }

        })
      }
    }

    function onVerifyCodeSubmit(e) {
      e.preventDefault();
      if (!!getCodeFromUserInput()) {
        window.verifyingCode = true;
        updateVerifyCodeButtonUI();
        var code = getCodeFromUserInput();
        confirmationResult.confirm(code).then(function(result) {
          // User signed in successfully.
          var user = result.user;
          window.verifyingCode = false;
          window.confirmationResult = null;
          updateVerificationCodeFormUI();
        }).catch(function(error) {
          // User couldn't sign in (bad verification code?)
          console.error('Error while checking the verification code', error);
          window.alert('Error while checking the verification code:\n\n' +
            error.code + '\n\n' + error.message);
          window.verifyingCode = false;
          updateSignInButtonUI();
          updateVerifyCodeButtonUI();
        });
      }
    }

    function cancelVerification(e) {
      e.preventDefault();
      window.confirmationResult = null;
      updateVerificationCodeFormUI();
      updateSignInFormUI();
    }

    function onSignOutClick() {
      firebase.auth().signOut();
    }

    function getCodeFromUserInput() {
      return document.getElementById('verification-code').value;
    }

    function getPhoneNumberFromUserInput() {
      return document.getElementById('phone-number').value;
    }

    function isPhoneNumberValid() {
      var pattern = /^\+[0-9\s\-\(\)]+$/;
      var phoneNumber = getPhoneNumberFromUserInput();
      return phoneNumber.search(pattern) !== -1;
    }

    function resetReCaptcha() {
      if (typeof grecaptcha !== 'undefined' &&
        typeof window.recaptchaWidgetId !== 'undefined') {
        grecaptcha.reset(window.recaptchaWidgetId);
      }
    }

    function updateSignInButtonUI() {
      document.getElementById('sign-in-button').disabled = !isPhoneNumberValid() ||
        !!window.signingIn;
    }

    function updateVerifyCodeButtonUI() {
      document.getElementById('verify-code-button').disabled = !!window.verifyingCode ||
        !getCodeFromUserInput();
    }

    function updateSignInFormUI() {
      if (firebase.auth().currentUser || window.confirmationResult) {
        document.getElementById('sign-in-form').style.display = 'none';
      } else {
        resetReCaptcha();
        document.getElementById('sign-in-form').style.display = 'block';
      }
    }

    function updateVerificationCodeFormUI() {
      if (!firebase.auth().currentUser && window.confirmationResult) {
        document.getElementById('verification-code-form').style.display = 'block';
      } else {
        document.getElementById('verification-code-form').style.display = 'none';
      }
    }

    function updateSignOutButtonUI() {
      if (firebase.auth().currentUser) {
        document.getElementById('sign-out-button').style.display = 'block';
      } else {
        document.getElementById('sign-out-button').style.display = 'none';
      }
    }

    function updateSignedInUserStatusUI() {
      var user = firebase.auth().currentUser;
      if (user) {
        firebase.auth().signOut()
        window.location = "http://localhost/coupon%20site/admin/login/"
      } else {

      }
    }
  </script>
</body>

</html>