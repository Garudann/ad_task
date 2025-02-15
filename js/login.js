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
        console.log('Password:', password);

        // Send the login data to the server using fetch
        fetch('includes/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json' // Specify the content type as JSON
            },
            body: JSON.stringify({ username: username, password: password }) // Convert data to JSON
        })
        .then(response => {
            // Check if the response is OK (status code 200-299)
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json(); // Parse the JSON response
        })
        .then(data => {
            // Log the response data for debugging
            console.log('Response data:', data);

            // Check if the login was successful
            if (data.success) {
                // Display success message
                document.getElementById('loginStatus').textContent = 'Login successful!';
                document.getElementById('loginStatus').style.color = 'green';

                // Redirect to another page (e.g., dashboard)
                window.location.href = 'dashboard.html'; // Replace with your desired redirect URL
            } else {
                // Display error message
                document.getElementById('loginStatus').textContent = 'Invalid username or password.';
                document.getElementById('loginStatus').style.color = 'red';
            }
        })
        .catch(error => {
            // Log any errors to the console
            console.error('Error during fetch:', error);

            // Display a generic error message to the user
            document.getElementById('loginStatus').textContent = 'An error occurred. Please try again.';
            document.getElementById('loginStatus').style.color = 'red';
        });
    });
});