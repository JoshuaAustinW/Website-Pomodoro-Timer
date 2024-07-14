function usernameInputFilter(event){
    var key = event.key;
    if (!/^[a-zA-Z0-9]$/.test(key)) {
        event.preventDefault();
    }
}

function preventSpace(event) {
    if (event.key === ' ') {
        event.preventDefault();
    }
}