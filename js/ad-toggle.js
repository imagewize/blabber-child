jQuery(document).ready(function ($) {
  console.log('Ad toggle script loaded');
  
  // Cookie functions
  function setCookie(name, value, days) {
    var expires = '';
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + (value || '') + expires + '; path=/';
    console.log('Setting cookie: ' + name + '=' + value);
  }

  function getCookie(name) {
    var match = document.cookie.match(new RegExp('(^|;\\s*)(' + name + ')=([^;]*)'));
    return match ? match[3] : null;
  }

  // Ad visibility functions
  function hideCasinoHighlightBlocks() {
    $('.code-block').addClass('d-none');
    console.log('Hiding ads');
  }

  function displayCasinoHighlightBlocks() {
    $('.code-block').removeClass('d-none');
    console.log('Showing ads');
  }

  // Toggle button for ads (fallback for any manual toggles)
  var $toggleInput = $('#toggle_inputAds');
  
  if ($toggleInput.length > 0) {
    $toggleInput.on('change', function() {
      console.log('Toggle changed: ' + this.checked);
      if (this.checked) {
        setCookie('canSeeAds', 'false', 365);
        hideCasinoHighlightBlocks();
      } else {
        setCookie('canSeeAds', 'true', 365);
        displayCasinoHighlightBlocks();
      }
    });

    // Initialize toggle button state based on cookie
    var cookieValue = getCookie('canSeeAds');
    console.log('Cookie value:', cookieValue);
    
    if (cookieValue === 'true') {
      displayCasinoHighlightBlocks();
      $toggleInput.prop('checked', false);
    } else {
      hideCasinoHighlightBlocks();
      $toggleInput.prop('checked', true);
    }
  }
});
