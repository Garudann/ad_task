document.getElementById('login_form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('Username').value;
    const password = document.getElementById('password').value;
  
    if (username === 'sindhu' && password === 'Gokul#123') {
        document.getElementById('loginStatus').textContent = 'Login successful!';
        document.getElementById('loginStatus').style.color = 'green';
        //if logged int succesfully, it will redirect to this page.
        window.location.href='dashboard.html'
    } else {
        document.getElementById('loginStatus').textContent = 'Invalid username or password.';
        document.getElementById('loginStatus').style.color = 'red';
    }
  });