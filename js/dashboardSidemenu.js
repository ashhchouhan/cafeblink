 var userIcon = document.getElementById('user-icon');
  var profileSection = document.getElementById('profile-section');

  // Add click event listener to the user icon
  userIcon.addEventListener('click', function() {
    // Toggle the 'profile-hidden' class on the profile section
    profileSection.classList.toggle('profile-hidden');
  });