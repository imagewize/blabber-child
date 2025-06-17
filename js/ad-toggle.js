jQuery(document).ready(function ($) {
  // Functions for handling cookies (reusing from existing code)
  const setCookie = (name, value, days) => {
    var expires = '';
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + (value || '') + expires + '; path=/';
  };

  const getCookie = (name) => {
    return (
      document.cookie
        .split('; ')
        .find((row) => row.startsWith(name + '='))
        ?.split('=')[1] || null
    );
  };

  // Functions for hiding/showing ads
  const hideCasinoHighlightBlocks = () => {
    document.querySelectorAll('.code-block').forEach((element) => {
      if (element) {
        element.classList.add('d-none');
      }
    });
  };

  const displayCasinoHighlightBlocks = () => {
    document.querySelectorAll('.code-block').forEach((element) => {
      if (element) {
        element.classList.remove('d-none');
      }
    });
  };

  // Initialize based on cookie
  const handleInitialCheckboxState = () => {
    const canSeeAds = getCookie('canSeeAds');
    if (canSeeAds === 'true') {
      $('#toggle_inputAds').prop('checked', false);
      displayCasinoHighlightBlocks();
    } else if (canSeeAds === 'false') {
      $('#toggle_inputAds').prop('checked', true);
      hideCasinoHighlightBlocks();
    }
  };

  // Toggle button click handler
  $('#toggle_inputAds, #labelToggle').on('click', function(e) {
    if (e.target.id === 'labelToggle') {
      // If the label was clicked, toggle the checkbox
      $('#toggle_inputAds').prop('checked', !$('#toggle_inputAds').prop('checked'));
    }
    
    // Get current state
    const isChecked = $('#toggle_inputAds').prop('checked');
    
    // Update cookie and visibility based on checkbox state
    if (isChecked) {
      setCookie('canSeeAds', 'false', 365);
      hideCasinoHighlightBlocks();
    } else {
      setCookie('canSeeAds', 'true', 365);
      displayCasinoHighlightBlocks();
    }
  });

  // Run on page load
  handleInitialCheckboxState();
});
