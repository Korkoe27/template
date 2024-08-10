
$(function(){


    //show/hide password function
    var showPassword = $(".showPwd");
var hidePassword = $(".hidePwd");
var password = $(".pwd");

showPassword.click(function(){
    $(this).hide();
    $(".hidePwd").show();


    password.prop("type","text");

});

hidePassword.click(function(){
    $(this).hide();
    $(".showPwd").show();


    password.prop("type","password");
});


});






const gallery = document.getElementById('gallery');

// Function to fetch photos from JSONPlaceholder API
async function fetchPhotos() {
    try {
        const response = await fetch('https://jsonplaceholder.typicode.com/photos');
        const photos = await response.json();
        
        // Display only the first 10 photos
        const firstTenPhotos = photos.slice(0, 10);
        firstTenPhotos.forEach(photo => {
            const img = document.createElement('img');
            img.src = photo.thumbnailUrl;
            img.alt = photo.title;
            gallery.appendChild(img);
        });
    } catch (error) {
        console.error('Error fetching photos:', error);
    }
}

// Fetch and display photos when the page loads
fetchPhotos();



function pwdCheck() {
    const createPassword = document.getElementById('userPassword').value;
    const confirmPassword = document.getElementById('confirmPwd').value;
    const messageDiv = document.getElementById('message');

    if (confirmPassword === "") {
        messageDiv.style.display = 'none';
        return;
    }

    if (createPassword === confirmPassword) {
        messageDiv.textContent = 'Passwords match';
        messageDiv.className = 'success';
    } else {
        messageDiv.textContent = 'Both passwords do not match';
        messageDiv.className = 'error';
    }

    messageDiv.style.display = 'block';
}


