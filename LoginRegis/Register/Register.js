var OTPcode = null;
let otpTimeout;

function checkInput() {

    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    let errorMessages = [];

    if (username.length < 3) {
        errorMessages.push('Username must be more than 3 letters!');
    }

    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        errorMessages.push('Email is not valid.');
    }

    if (password.length < 6) {
        errorMessages.push('Password must have atleast 6 letters in it');
    }

    if (password !== confirmPassword) {
        errorMessages.push('Wrong password confirmation!');
    }

    const errorMessagesDiv = document.getElementById('errorMessages');
    errorMessagesDiv.innerHTML = '';
    if (errorMessages.length > 0) {
        errorMessages.forEach(function(message) {
            errorMessagesDiv.innerHTML = message;
        });
    }
    
    else{

        var RegisButton = document.getElementById('RegisButton');
        var loader = document.getElementById('loader');

        loader.style.display = 'flex';
        RegisButton.style.display = 'none';

        var form = document.getElementById('formRegis');
        form.action = 'CheckDB.php';
        form.submit();

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
    var RegisButton = document.getElementById('RegisButton');

    loader.style.display = 'none';
    SubmitButton.style.display = 'block';
    ResendButton.style.display = 'none';

    OGloader.style.display = 'none';
    RegisButton.style.display = 'block';

    var BoxOTP = document.getElementById('BoxOTP');
    var Blur = document.getElementById('BackgroundBlur');
    
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
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    var hidden_email = document.getElementById('hidden_email');
    var hidden_username = document.getElementById('hidden_username');
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
        hidden_username.value = username;
        hidden_password.value = password;

        hidden_form.action = 'SaveInformationBeforeAddToDB.php';
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

document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const showPasswordIcon = document.getElementById('ShowPassword');

    const confirmpasswordInput = document.getElementById('confirmPassword');

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