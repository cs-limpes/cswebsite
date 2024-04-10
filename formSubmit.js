document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('form');
      
      form.addEventListener('submit', function(e) {
          e.preventDefault(); // Prevent the default form submission
          
          const formData = new FormData(form);
          fetch('submit.php', {
              method: 'post',
              body: formData,
          })
          .then(response => response.text())
          .then(data => {
              // Replace the form with the success message
              document.querySelector('.contact').innerHTML = data;
          })
          .catch(error => console.error('Error:', error));
      });
  });
  