(function () {
  'use strict';

  var header = document.getElementById('yr-header');
  var toggle = document.getElementById('yr-nav-toggle');
  var mobileNav = document.getElementById('yr-mobile-nav');

  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-scrolled', window.scrollY > 40);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  if (toggle && mobileNav) {
    var openIcon = toggle.querySelector('.yr-nav__toggle-open');
    var closeIcon = toggle.querySelector('.yr-nav__toggle-close');

    toggle.addEventListener('click', function () {
      var open = mobileNav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      if (openIcon) openIcon.hidden = open;
      if (closeIcon) closeIcon.hidden = !open;
    });

    mobileNav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        mobileNav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        if (openIcon) openIcon.hidden = false;
        if (closeIcon) closeIcon.hidden = true;
      });
    });
  }

  var hero = document.querySelector('[data-hero]');
  if (hero) {
    var slides = hero.querySelectorAll('[data-hero-slide]');
    var dots = hero.querySelectorAll('[data-hero-dot]');
    var eyebrow = hero.querySelector('[data-hero-eyebrow]');
    var subtitles = Array.prototype.map.call(slides, function (_, i) {
      return dots[i] ? dots[i].getAttribute('data-subtitle') || '' : '';
    });
    var current = 0;
    var timer;

    function loadSlide(slide) {
      var src = slide.getAttribute('data-hero-src');
      if (src && !slide.style.backgroundImage) {
        slide.style.backgroundImage = "url('" + src + "')";
      }
    }

    function goTo(index) {
      if (!slides.length) return;
      current = index;
      slides.forEach(function (slide, i) {
        if (i === current) {
          loadSlide(slide);
        }
        slide.classList.toggle('is-active', i === current);
      });
      dots.forEach(function (dot, i) {
        dot.classList.toggle('is-active', i === current);
      });
    }

    dots.forEach(function (dot) {
      dot.addEventListener('click', function () {
        goTo(parseInt(dot.getAttribute('data-hero-dot'), 10));
        clearInterval(timer);
        timer = setInterval(function () {
          goTo((current + 1) % slides.length);
        }, 5000);
      });
    });

    if (slides.length > 1) {
      timer = setInterval(function () {
        goTo((current + 1) % slides.length);
      }, 5000);
    }
  }

  var filters = document.getElementById('yr-menu-filters');
  var grid = document.getElementById('yr-menu-grid');
  if (filters && grid) {
    filters.addEventListener('click', function (e) {
      var btn = e.target.closest('[data-filter]');
      if (!btn) return;
      var filter = btn.getAttribute('data-filter');
      filters.querySelectorAll('.yr-filter-pill').forEach(function (pill) {
        pill.classList.toggle('is-active', pill === btn);
      });
      grid.querySelectorAll('[data-category]').forEach(function (item) {
        var cat = item.getAttribute('data-category');
        item.style.display = filter === 'all' || cat === filter ? '' : 'none';
      });
    });
  }

  var revealNodes = document.querySelectorAll('[data-reveal]');
  if (revealNodes.length) {
    if ('IntersectionObserver' in window) {
      var revealObserver = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('is-visible');
              revealObserver.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.16, rootMargin: '0px 0px -8% 0px' }
      );
      revealNodes.forEach(function (node) {
        revealObserver.observe(node);
      });
    } else {
      revealNodes.forEach(function (node) {
        node.classList.add('is-visible');
      });
    }
  }

})();
