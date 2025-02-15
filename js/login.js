// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Get the login form element
    const loginForm = document.getElementById('login_form');

    // Add a submit event listener to the form
    loginForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way

        // Get the username and password from the form inputs
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Log the input values for debugging
        console.log('username:', username);
        console.log('password:', password);

        // Send the login data to the server using fetch
        fetch('includes/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username, password })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                document.getElementById('loginStatus').textContent = 'Login successful!';
                document.getElementById('loginStatus').style.color = 'green';
                window.location.href = 'dashboard.html';
            } else {
                document.getElementById('loginStatus').textContent = 'Invalid username or password.';
                document.getElementById('loginStatus').style.color = 'red';
            }
        })
        .catch(error => {
            console.error('Error during fetch:', error);
            document.getElementById('loginStatus').textContent = 'An error occurred. Please try again.';
            document.getElementById('loginStatus').style.color = 'red';
        });
        
    });
});
