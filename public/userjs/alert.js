function error(message){
    Swal.fire({
        icon: 'error',
        text: message,
        allowOutsideClick: false
    }).then(function () {swal.close();})
}
function success(message){
    Swal.fire({
        icon: 'success',
        text: message,
        allowOutsideClick: false
    }).then(function () {location.reload();})
}
function success_noreload(message){
    Swal.fire({
        icon: 'success',
        text: message,
        allowOutsideClick: false
    }).then(function () {swal.close();})
}
function success_login(message){
    Swal.fire({
        icon: 'success',
        text: message
    }).then(function () { window.location.href = "/login"; })
}
function error_noreload(message){
    Swal.fire({
        icon: 'error',
        text: message,
        allowOutsideClick: false
    }).then(function () {swal.close();})
}
function success_to(message,tolocation){
    Swal.fire({
        icon: 'success',
        text: message,
        allowOutsideClick: false
    }).then(function () {
        window.location.href = tolocation; 
    })
}
function success_to_newTab(message,tolocation){
    Swal.fire({
        icon: 'success',
        text: message,
        allowOutsideClick: false
    }).then(function () {
        window.open(tolocation, "_blank");
    })
}
function success_auto_to(message, tolocation){
    Swal.fire({
        position: "center",
        icon: "success",
        html: "<h4>"+message+"</h4>",
        showConfirmButton: false,
        allowOutsideClick: false,
        timer: 1200
    }).then(function () {
        window.location.href = tolocation; 
    });
}

function error_to(message,tolocation){
    Swal.fire({
        icon: 'success',
        text: message,
        allowOutsideClick: false
    }).then(function () {
        window.location.href = tolocation; 
    })
}
function success_auto(message){
    Swal.fire({
        position: "center",
        icon: "success",
        html: "<h4>"+message+"</h4>",
        showConfirmButton: false,
        allowOutsideClick: false,
        timer: 1200
    }).then(function () {
        location.reload();
    });
}

function success_autore(message, redirectUrl) {
    Swal.fire({
        position: "center",
        icon: "success",
        html: "<h4>" + message + "</h4>",
        showConfirmButton: false,
        allowOutsideClick: false,
        timer: 1200
    }).then(function () {
        window.location.href = redirectUrl; // Redirect to the specified URL
    });
}

function success_autotimer_noreload(message, timer){
    Swal.fire({
        position: "center",
        icon: "success",
        html: "<h4>"+message+"</h4>",
        showConfirmButton: false,
        allowOutsideClick: false,
        timer: timer
    }).then(function () {
        swal.close();
    });
}
function success_auto_noreload(message){
    Swal.fire({
        position: "center",
        icon: "success",
        html: "<h4>"+message+"</h4>",
        showConfirmButton: false,
        allowOutsideClick: false,
        timer: 1200
    }).then(function () {
        swal.close();
    });
}
function loaderSwal(){
    Swal.fire({
        html: '<img src="https://limitless-allaccess.s3.ap-southeast-1.amazonaws.com/rbrnd/bottle/fn0QIaSHpCiYmajAE6qkrqrNVj3ZKaR4bV3P3EDd.gif" alt="Custom GIF" style="width: 50% !important"><br><center><p>Loading, please wait...</p></center>',
        showConfirmButton: false,
        allowOutsideClick: false,
    });
}
function confirmation(){
    Swal.fire({
        text: 'Are you sure you want to remove this laboratory?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.isConfirmed) {
            
        }
    });
}
function confirmationWithData(text, data, link) {
    return new Promise((resolve, reject) => {
        Swal.fire({
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(link, data, function(response){
                    resolve(response);
                }, 'json');
            }
        });
    });
}