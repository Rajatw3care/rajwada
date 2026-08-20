<script>
(function () {
  'use strict';

  /* ---- mobile navigation ---- */
  var toggle = document.querySelector('.nav-toggle');
  var nav    = document.getElementById('primary-nav');

  toggle.addEventListener('click', function () {
    var open = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!open));
    nav.classList.toggle('is-open', !open);
  });

  nav.addEventListener('click', function (e) {
    if (e.target.tagName === 'A') {
      toggle.setAttribute('aria-expanded', 'false');
      nav.classList.remove('is-open');
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && nav.classList.contains('is-open')) {
      toggle.setAttribute('aria-expanded', 'false');
      nav.classList.remove('is-open');
      toggle.focus();
    }
  });

  /* ---- contact form validation ---- */
  var form = document.querySelector('.contact-form');
  if (form) {
    var fields = form.querySelectorAll('.field input, .field textarea');

    var messageFor = function (field) {
      var label = field.dataset.label || 'This field';
      if (field.validity.valueMissing) return label + ' is required.';
      if (field.validity.typeMismatch && field.type === 'email') return 'Please enter a valid email address.';
      if ((field.validity.patternMismatch || field.validity.tooShort) && field.name === 'phone') return 'Enter a valid phone number (digits only, 7–15 digits).';
      if (field.validity.tooShort) return label + ' is too short.';
      if (field.validity.tooLong) return label + ' is too long.';
      return 'Please check this field.';
    };

    var showError = function (field, message) {
      var wrapper = field.closest('.field');
      wrapper.classList.add('has-error');
      var msg = wrapper.querySelector('.field-error');
      if (!msg) {
        msg = document.createElement('span');
        msg.className = 'field-error';
        wrapper.appendChild(msg);
      }
      msg.textContent = message;
    };

    var clearError = function (field) {
      var wrapper = field.closest('.field');
      wrapper.classList.remove('has-error');
      var msg = wrapper.querySelector('.field-error');
      if (msg) msg.remove();
    };

    /* ---- phone: digits only, nothing else can even be typed ---- */
    var phoneField = form.querySelector('#f-phone');
    if (phoneField) {
      phoneField.addEventListener('keypress', function (e) {
        if (e.key && e.key.length === 1 && !/[0-9]/.test(e.key)) {
          e.preventDefault();
        }
      });
      phoneField.addEventListener('input', function () {
        var cursor = phoneField.selectionStart;
        var before = phoneField.value;
        var digitsOnly = before.replace(/[^0-9]/g, '');
        if (digitsOnly !== before) {
          var keptBeforeCursor = before.slice(0, cursor).replace(/[^0-9]/g, '').length;
          phoneField.value = digitsOnly;
          phoneField.setSelectionRange(keptBeforeCursor, keptBeforeCursor);
        }
      });
      phoneField.addEventListener('paste', function (e) {
        e.preventDefault();
        var text = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
        document.execCommand('insertText', false, text);
      });
    }

    fields.forEach(function (field) {
      field.addEventListener('blur', function () {
        if (!field.checkValidity()) {
          showError(field, messageFor(field));
        } else {
          clearError(field);
        }
      });
      field.addEventListener('input', function () {
        if (field.checkValidity()) clearError(field);
      });
    });

    form.addEventListener('submit', function (e) {
      var firstInvalid = null;
      fields.forEach(function (field) {
        if (!field.checkValidity()) {
          showError(field, messageFor(field));
          if (!firstInvalid) firstInvalid = field;
        } else {
          clearError(field);
        }
      });

      var status = form.querySelector('.form-status');
      if (firstInvalid) {
        e.preventDefault();
        firstInvalid.focus();
        if (status) {
          status.textContent = 'Please check the highlighted fields below.';
          status.classList.remove('is-success');
          status.classList.add('is-error');
        }
      } else if (status) {
        status.textContent = '';
        status.classList.remove('is-error');
      }
    });
  }
})();
</script>
