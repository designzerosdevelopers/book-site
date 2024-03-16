$(document).ready(function() {
  'use strict';

  // Your color variables
  var ChartColor = ["#5D62B4", "#54C3BE", "#EF726F", "#F9C446", "rgb(93.0, 98.0, 180.0)", "#21B7EC", "#04BCCC"];
  var primaryColor = getComputedStyle(document.body).getPropertyValue('--primary');
  var secondaryColor = getComputedStyle(document.body).getPropertyValue('--secondary');
  var successColor = getComputedStyle(document.body).getPropertyValue('--success');
  var warningColor = getComputedStyle(document.body).getPropertyValue('--warning');
  var dangerColor = getComputedStyle(document.body).getPropertyValue('--danger');
  var infoColor = getComputedStyle(document.body).getPropertyValue('--info');
  var darkColor = getComputedStyle(document.body).getPropertyValue('--dark');
  var lightColor = getComputedStyle(document.body).getPropertyValue('--light');

  // Function to add active class to nav-link based on URL
  function addActiveClass(element) {
    var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');

    if (current === "") {
      // For root URL
      if (element.attr('href').indexOf("index.html") !== -1) {
        element.parents('.nav-item').last().addClass('active');
        if (element.parents('.sub-menu').length) {
          element.closest('.collapse').addClass('show');
          element.addClass('active');
        }
      }
    } else {
      // For other URLs
      if (element.attr('href').indexOf(current) !== -1) {
        element.parents('.nav-item').last().addClass('active');
        if (element.parents('.sub-menu').length) {
          element.closest('.collapse').addClass('show');
          element.addClass('active');
        }
        if (element.parents('.submenu-item').length) {
          element.addClass('active');
        }
      }
    }
  }

  // Add active class to nav links
  $('.nav li a, .horizontal-menu .nav li a').each(function() {
    var $this = $(this);
    addActiveClass($this);
  });

  // Close other submenu in sidebar on opening any
  $('.sidebar').on('show.bs.collapse', '.collapse', function() {
    $('.sidebar').find('.collapse.show').collapse('hide');
  });

  // Toggle sidebar
  $('[data-toggle="minimize"]').on("click", function() {
    var body = $('body');
    if ((body.hasClass('sidebar-toggle-display')) || (body.hasClass('sidebar-absolute'))) {
      body.toggleClass('sidebar-hidden');
    } else {
      body.toggleClass('sidebar-icon-only');
    }
  });

  // Checkbox and radios styling
  $(".form-check label, .form-radio label").append('<i class="input-helper"></i>');

  // Fullscreen functionality
  $("#fullscreen-button").on("click", function toggleFullScreen() {
    var doc = document.documentElement;
    var requestFullScreen = doc.requestFullScreen || doc.mozRequestFullScreen || doc.webkitRequestFullScreen || doc.msRequestFullscreen;
    var cancelFullScreen = doc.cancelFullScreen || doc.mozCancelFullScreen || doc.webkitCancelFullScreen || doc.msExitFullscreen;

    if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
      requestFullScreen.call(doc);
    } else {
      cancelFullScreen.call(doc);
    }
  });

  // Banner display logic
  if ($.cookie('purple-free-banner') !== "true") {
    $('#proBanner').addClass('d-flex');
    $('.navbar').removeClass('fixed-top');
  } else {
    $('#proBanner').addClass('d-none');
    $('.navbar').addClass('fixed-top');
  }

  // Adjust page-body-wrapper and navbar classes based on fixed-top class presence
  if ($(".navbar").hasClass("fixed-top")) {
    $('.page-body-wrapper').removeClass('pt-0');
    $('.navbar').removeClass('pt-5');
  } else {
    $('.page-body-wrapper').addClass('pt-0');
    $('.navbar').addClass('pt-5');
    $('.navbar').addClass('mt-3');
  }

  // Event listener for banner close
  $('#bannerClose').on('click', function() {
    $('#proBanner').addClass('d-none').removeClass('d-flex');
    $('.navbar').removeClass('pt-5').addClass('fixed-top');
    $('.page-body-wrapper').addClass('proBanner-padding-top').removeClass('mt-3');
    var date = new Date();
    date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
    $.cookie('purple-free-banner', "true", { expires: date });
  });
});
