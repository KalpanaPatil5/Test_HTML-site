function showNotification(type, message) {
    const notificationElement = document.getElementById('notification');
    notificationElement.textContent = message;
  
    if (type === 'success') {
      notificationElement.className = 'alert alert-success';
    } else if (type === 'error') {
      notificationElement.className = 'alert alert-error';
    }
  
    // Show the notification
    notificationElement.style.display = 'block';
  
    // Close the notification after 5 seconds
    setTimeout(() => {
      notificationElement.style.display = 'none';
    }, 5000);
  }