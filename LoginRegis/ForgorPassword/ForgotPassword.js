var OTPcode = null;
var otpTimeout;

document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('InputPassword');
    const showPasswordIcon = document.getElementById('ShowPassword');

    const confirmpasswordInput = document.getElementById('InputConfirmPassword');

    showPasswordIcon.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            confirmpasswordInput.type = 'text';
            showPasswordIcon.classList.remove('fa-eye-slash');
            showPasswordIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            confirmpasswordInput.type = 'password';
            showPasswordIcon.classList.remove('fa-eye');
            showPasswordIcon.classList.add('fa-eye-slash');
        }
    });
});

function CheckDB(){
    var password = document.getElementById('InputPassword').value;
    var confirmpassword = document.getElementById('InputConfirmPassword').value;
    var errorMessages = document.getElementById('errorMessages');
    var ForgotPasswordForm = document.getElementById('ForgotPasswordForm');
    var SubmitButton = document.getElementById('ChangePassButton');
    var loader = document.getElementById('loader');

    if(password == confirmpassword){
        SubmitButton.style.display = 'none';
        loader.style.display = 'flex';

        ForgotPasswordForm.action = 'CheckEmailDB.php';
        ForgotPasswordForm.submit();
    }
    else{
        errorMessages.innerHTML = 'Wrong password confirmation!';
    }

}

function StartCountdown(){
    var SubmitButton = document.getElementById('ButtonSubmit');
    var loader = document.getElementById('loaderOTP');
    var ResendButton = document.getElementById('ButtonResend');

    let counter = 60;
    document.getElementById('countdown').innerText = '';

    otpTimeout = setInterval(function() {
        counter--;
        document.getElementById('countdown').innerText = `Resend in ${counter}s`;

        if (counter <= 0) {
            clearInterval(otpTimeout);
            OTPcode = null;
            document.getElementById('countdown').innerText = '';
            loader.style.display = 'none';
            SubmitButton.style.display = 'none';
            ResendButton.style.display = 'block';
        }
    }, 1000);
}

function CloseOTP(){
    clearInterval(otpTimeout);
    OTPcode = null;

    var SubmitButton = document.getElementById('ButtonSubmit');
    var loader = document.getElementById('loaderOTP');
    var ResendButton = document.getElementById('ButtonResend');

    var OGloader = document.getElementById('loader');
    var ChangePassButton = document.getElementById('ChangePassButton');

    var BoxOTP = document.getElementById('BoxOTP');
    var Blur = document.getElementById('BackgroundBlur');

    loader.style.display = 'none';
    SubmitButton.style.display = 'block';
    ResendButton.style.display = 'none';

    OGloader.style.display = 'none';
    ChangePassButton.style.display = 'block';
    
    BoxOTP.classList.add('hidden');
    Blur.classList.add('hidden');
}

function GenerateOTP(){
    return Math.floor(100000 + Math.random() * 900000);
}

function OpenOTP(){

    var SubmitButton = document.getElementById('ButtonSubmit');
    var loader = document.getElementById('loaderOTP');
    var ResendButton = document.getElementById('ButtonResend');

    loader.style.display = 'none';
    SubmitButton.style.display = 'block';
    ResendButton.style.display = 'none';

    var email = document.getElementById('email').value.toLowerCase().trim();

    var BoxOTP = document.getElementById('BoxOTP');
    var Blur = document.getElementById('BackgroundBlur');
    
    BoxOTP.classList.remove('hidden');
    Blur.classList.remove('hidden'); 

    OTPcode = GenerateOTP();
    
    SendOTPCode(OTPcode, email);
    StartCountdown();
}

function SendOTPCode(otp, addr){
    var SubmitButton = document.getElementById('ButtonSubmit');
    var loader = document.getElementById('loaderOTP');
    var ResendButton = document.getElementById('ButtonResend');

    var ErrorMessageOTP = document.getElementById('OTPError');

    const templateParams = {
        email: addr,
        otp: otp
    };

    emailjs.send('service_azg2b1t', 'template_ul7bnee', templateParams)
    .then((response) => {
        console.log('SUCCESS!', response.status, response.text);
        loader.style.display = 'none';
        SubmitButton.style.display = 'block';
        ResendButton.style.display = 'none';

    }, (error) => {
        console.error('FAILED...', error);
        loader.style.display = 'none';
        SubmitButton.style.display = 'none';
        ResendButton.style.display = 'block';
        clearInterval(otpTimeout);
        document.getElementById('countdown').innerText = '';
        ErrorMessageOTP.innerText='Failed to send code, please try again.';
    });
}

function VerifyOTP(){

    var email = document.getElementById('email').value;
    var password = document.getElementById('InputPassword').value;

    var hidden_email = document.getElementById('hidden_email');
    var hidden_password = document.getElementById('hidden_password');
    var hidden_form = document.getElementById('hiddenform');

    var OTPInput = document.getElementById('OTPInput');

    var ErrorMessageOTP = document.getElementById('OTPError');

    var SubmitButton = document.getElementById('ButtonSubmit');
    var loader = document.getElementById('loaderOTP');
    var ResendButton = document.getElementById('ButtonResend');

    
    if(OTPInput.value == OTPcode){
        clearInterval(otpTimeout);
        document.getElementById('countdown').innerText = '';

        loader.style.display = 'flex';
        SubmitButton.style.display = 'none';
        ResendButton.style.display = 'none';

        ErrorMessageOTP.innerHTML = '';

        hidden_email.value = email;
        hidden_password.value = password;

        hidden_form.action = 'EditPasswordDB.php';
        hidden_form.submit();

    }
    else{
        ErrorMessageOTP.innerHTML = 'Invalid OTP code';
    }
}

function ResendOTP(){
    var email = document.getElementById('email').value.toLowerCase().trim();

    var SubmitButton = document.getElementById('ButtonSubmit');
    var loader = document.getElementById('loaderOTP');
    var ResendButton = document.getElementById('ButtonResend');

    loader.style.display = 'flex';
    SubmitButton.style.display = 'none';
    ResendButton.style.display = 'none';

    OTPcode = GenerateOTP();
    clearInterval(otpTimeout);
    document.getElementById('countdown').innerText = '';
    SendOTPCode(OTPcode, email);
    StartCountdown();
}