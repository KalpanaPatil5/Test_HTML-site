/*!
* Start Bootstrap - Landing Page v6.0.6 (https://startbootstrap.com/theme/landing-page)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-landing-page/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project

//declaring a const variable for storing user details on click of Sign Up button
const registerUser = document.getElementById('submitButton');

//adding eventListener for button click
registerUser.addEventListener('click', function(event){
    event.preventDefault(); // Prevent the default form submission

    //storing input values
    const first_name = document.getElementById('validationCustom01').value;
    const last_name = document.getElementById('validationCustom02').value;
    const phone = document.getElementById('validationCustom06').value;
    const email = document.getElementById('validationCustom03').value;
    const password = document.getElementById('validationDefaultpass').value;
    const confirmPassword = document.getElementById('validationConfirmpass').value;

    //comparing both the passwords
    if(password !== confirmPassword){
        console.log("Passwords do not match");
        return;
    }

    //creating new FormData object
    const formData = new FormData();
    formData.append('first_name', first_name);
    formData.append('last_name', last_name);
    formData.append('phone', phone);
    formData.append('email', email);
    formData.append('password', password);

    //API integration/ API calling
    fetch('http://localhost/Test%20HTML%20site/controller/apis/register_user.php',{
        method : 'POST',
        body : formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('API Response:', data);

        if(data.status === true){
            sessionStorage.setItem('userData', JSON.stringify(data.data));
            showNotification('success', 'Registered successfully! Verification mail has been sent to your mail, please verify');

            // Close the Signup modal
            document.getElementById('Signup').classList.remove('show');

            //after successful registration, empty the form fields
            document.getElementById('validationCustom01').value = '';
            document.getElementById('validationCustom02').value = '';
            document.getElementById('validationCustom06').value = '';
            document.getElementById('validationCustom03').value = '';
            document.getElementById('validationDefaultpass').value = '';
            document.getElementById('validationConfirmpass').value = '';
        } else {
            showNotification('error', 'Something went wrong. Please try again.');
            console.log("Something went wrong");
        }
    })
    .catch(error => {
        //error handling
        console.error('Error',error);
    });
});

//declaring a const variable for storing user details on click of Login button
const loginUser = document.getElementById('login');

const currentUrl = window.location.href;
console.log("url", currentUrl);

//adding eventListener for button click
loginUser.addEventListener('click', function(event){
    event.preventDefault(); // Prevent the default form submission

    //storing input values
    const email = document.getElementById('validationCustom').value;
    const password = document.getElementById('validationpass').value;

    //creating new FormData object
    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    //API integration/ API calling
    fetch('http://localhost/Test%20HTML%20site/controller/apis/login.php',{
        method : 'POST',
        body : formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('API Response:', data);

        // Close the Login modal
        document.getElementById('Login').classList.remove('show');

        //after successful login, empty the form fields
        document.getElementById('validationCustom').value = '';
        document.getElementById('validationpass').value = '';

        // Redirect to the profile.html page if login is successful
        if (data.status === true) {
            showNotification('success', 'Login successful!');
            // Store user data in session storage
            sessionStorage.setItem('userData', JSON.stringify(data.data));

            //redirecting to profile page after successful login
            window.location.href = 'profile.html';
        } else {
            showNotification('error', 'Invalid email or password or user not verified.');
            console.log("Something went wrong");
        }
    })
    .catch(error => {
        //error handling
        console.error('Error',error);
    });
});