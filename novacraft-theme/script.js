/* ========================================
   NOVACRAFT — Main JavaScript
   ======================================== */

document.addEventListener('DOMContentLoaded', () => {
  initHeader();
  initRevealAnimations();
  initScrollTop();
  initPhoneMask();
  initBurgerMenu();
  initQuiz();
  initActiveNavLinks();
});

/* ---------- ACTIVE NAV LINKS ---------- */
function initActiveNavLinks() {
  const currentPath = window.location.pathname.split('/').pop() || 'index.html';
  const navLinks = document.querySelectorAll('.header__nav a, .header__nav--mobile a');
  
  navLinks.forEach(link => {
    let href = link.getAttribute('href');
    if (!href) return;
    
    // ignore query params
    href = href.split('?')[0];

    // Some pages might not be named perfectly, let's handle 'project-'
    let isActive = false;
    if (currentPath === href) {
      isActive = true;
    } else if (currentPath.startsWith('project-') && href === 'projects.html') {
      isActive = true;
    }

    if (isActive) {
      link.classList.add('active');
    }
  });
}

/* ---------- HEADER scroll effect ---------- */
function initHeader() {
  const header = document.getElementById('header');
  let lastScroll = 0;

  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    if (currentScroll > 60) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
    lastScroll = currentScroll;
  }, { passive: true });
}

/* ---------- REVEAL on scroll (IntersectionObserver) ---------- */
function initRevealAnimations() {
  const reveals = document.querySelectorAll('.reveal');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.15,
    rootMargin: '0px 0px -40px 0px'
  });

  reveals.forEach(el => observer.observe(el));
}

/* ---------- SCROLL TO TOP ---------- */
function initScrollTop() {
  const btn = document.getElementById('scrollTop');
  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 600) {
      btn.classList.add('visible');
    } else {
      btn.classList.remove('visible');
    }
  }, { passive: true });
}

/* ---------- MOBILE MENU ---------- */
function initBurgerMenu() {
  const burger = document.getElementById('burgerBtn');
  const mobileNav = document.getElementById('mobileNav');

  burger.addEventListener('click', () => {
    const isOpen = mobileNav.classList.contains('active');
    if (isOpen) {
      mobileNav.classList.remove('active');
      setTimeout(() => { mobileNav.style.display = 'none'; }, 350);
      document.body.style.overflow = '';
    } else {
      mobileNav.style.display = '';
      requestAnimationFrame(() => mobileNav.classList.add('active'));
      document.body.style.overflow = 'hidden';
    }
    burger.classList.toggle('active');
  });
}

function closeMobileMenu() {
  const burger = document.getElementById('burgerBtn');
  const mobileNav = document.getElementById('mobileNav');
  burger.classList.remove('active');
  mobileNav.classList.remove('active');
  setTimeout(() => { mobileNav.style.display = 'none'; }, 350);
  document.body.style.overflow = '';
}

/* ---------- MODAL ---------- */
function openModal() {
  const overlay = document.getElementById('modalOverlay');
  overlay.classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  const overlay = document.getElementById('modalOverlay');
  overlay.classList.remove('active');
  document.body.style.overflow = '';
}

function openCalculationModal() {
  const overlay = document.getElementById('calculationModalOverlay');
  if (overlay) {
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
}

function closeCalculationModal() {
  const overlay = document.getElementById('calculationModalOverlay');
  if (overlay) {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
  }
}

// Close modal on overlay click
document.addEventListener('click', (e) => {
  const overlay = document.getElementById('modalOverlay');
  if (e.target === overlay) closeModal();
  const calcOverlay = document.getElementById('calculationModalOverlay');
  if (calcOverlay && e.target === calcOverlay) closeCalculationModal();
});

// Close modal on Escape key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    const calcOverlay = document.getElementById('calculationModalOverlay');
    if (calcOverlay && calcOverlay.classList.contains('active')) closeCalculationModal();
    else { closeModal(); closeQuizModal(); }
  }
});

/* ---------- QUIZ MODAL ---------- */
let currentQuizStep = 1;
const totalQuizSteps = 4;

function initQuiz() {
  const form = document.getElementById('quizForm');
  if (!form) return;

  const radios = form.querySelectorAll('input[type="radio"]');
  radios.forEach(radio => {
    radio.addEventListener('change', () => {
      validateQuizStep();
      // Auto advance
      setTimeout(() => {
        if (currentQuizStep < totalQuizSteps) {
          nextQuizStep();
        }
      }, 350);
    });
  });
}

function openQuizModal() {
  currentQuizStep = 1;
  updateQuizView();
  const overlay = document.getElementById('quizModalOverlay');
  if (overlay) {
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }
}

function closeQuizModal() {
  const overlay = document.getElementById('quizModalOverlay');
  if (overlay) {
    overlay.classList.remove('active');
    document.body.style.overflow = '';
    setTimeout(() => {
      document.getElementById('quizForm').reset();
      currentQuizStep = 1;
      updateQuizView();
    }, 300);
  }
}

function nextQuizStep() {
  if (currentQuizStep < totalQuizSteps) {
    currentQuizStep++;
    updateQuizView();
  }
}

function prevQuizStep() {
  if (currentQuizStep > 1) {
    currentQuizStep--;
    updateQuizView();
  }
}

function updateQuizView() {
  for (let i = 1; i <= totalQuizSteps; i++) {
    const stepEl = document.getElementById(`quizStep${i}`);
    if (stepEl) {
      if (i === currentQuizStep) {
        stepEl.classList.add('active');
      } else {
        stepEl.classList.remove('active');
      }
    }
  }

  const currentStepEl = document.getElementById('quizCurrentStep');
  if (currentStepEl) currentStepEl.textContent = currentQuizStep;

  const progressFill = document.getElementById('quizProgressFill');
  if (progressFill) progressFill.style.width = `${(currentQuizStep / totalQuizSteps) * 100}%`;

  const prevBtn = document.getElementById('quizPrevBtn');
  const nextBtn = document.getElementById('quizNextBtn');
  const submitBtn = document.getElementById('quizSubmitBtn');

  if (prevBtn) prevBtn.style.display = currentQuizStep === 1 ? 'none' : 'block';
  if (nextBtn && submitBtn) {
    if (currentQuizStep === totalQuizSteps) {
      nextBtn.style.display = 'none';
      submitBtn.style.display = 'block';
    } else {
      nextBtn.style.display = 'block';
      submitBtn.style.display = 'none';
    }
  }

  validateQuizStep();
}

function validateQuizStep() {
  const nextBtn = document.getElementById('quizNextBtn');
  if (!nextBtn) return;

  if (currentQuizStep === 1) {
    const checked = document.querySelector('input[name="quiz_type"]:checked');
    nextBtn.disabled = !checked;
  } else if (currentQuizStep === 2) {
    const checked = document.querySelector('input[name="quiz_style"]:checked');
    nextBtn.disabled = !checked;
  } else if (currentQuizStep === 3) {
    const checked = document.querySelector('input[name="quiz_region"]:checked');
    nextBtn.disabled = !checked;
  }
}

function handleQuizSubmit(e) {
  e.preventDefault();
  const form = e.target;

  const btn = form.querySelector('button[type="submit"]');
  const originalText = btn.innerHTML;
  btn.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
    Заявка отправлена!
  `;
  btn.style.background = '#4A8C5C';
  btn.disabled = true;

  setTimeout(() => {
    closeQuizModal();
    btn.innerHTML = originalText;
    btn.style.background = '';
    btn.disabled = false;
  }, 2000);
}

// Update click out for both modals
document.addEventListener('click', (e) => {
  const quizOverlay = document.getElementById('quizModalOverlay');
  if (e.target === quizOverlay) {
    closeQuizModal();
  }
});

/* ---------- PHONE MASK ---------- */
function initPhoneMask() {
  const phoneInputs = document.querySelectorAll('input[type="tel"]');

  phoneInputs.forEach(input => {
    input.addEventListener('input', (e) => {
      let value = e.target.value.replace(/\D/g, '');

      // Ensure starts with 7
      if (value.length > 0 && value[0] !== '7') {
        if (value[0] === '8') {
          value = '7' + value.slice(1);
        } else {
          value = '7' + value;
        }
      }

      let formatted = '';
      if (value.length > 0) formatted += '+7';
      if (value.length > 1) formatted += ' (' + value.slice(1, 4);
      if (value.length > 4) formatted += ') ' + value.slice(4, 7);
      if (value.length > 7) formatted += '-' + value.slice(7, 9);
      if (value.length > 9) formatted += '-' + value.slice(9, 11);

      e.target.value = formatted;
    });

    input.addEventListener('focus', (e) => {
      if (!e.target.value) {
        e.target.value = '+7';
      }
    });

    input.addEventListener('blur', (e) => {
      if (e.target.value === '+7') {
        e.target.value = '';
      }
    });
  });
}

/* ---------- FORM SUBMISSION ---------- */
function handleSubmit(e) {
  e.preventDefault();
  const form = e.target;
  const formData = new FormData(form);

  // Show success state
  const btn = form.querySelector('button[type="submit"]');
  const originalText = btn.innerHTML;
  btn.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
    Заявка отправлена!
  `;
  btn.style.background = '#4A8C5C';
  btn.disabled = true;

  setTimeout(() => {
    btn.innerHTML = originalText;
    btn.style.background = '';
    btn.disabled = false;
    form.reset();
  }, 3000);
}

function handleModalSubmit(e) {
  e.preventDefault();
  const form = e.target;

  const btn = form.querySelector('button[type="submit"]');
  const originalText = btn.innerHTML;
  btn.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
    Заявка отправлена!
  `;
  btn.style.background = '#4A8C5C';
  btn.disabled = true;

  setTimeout(() => {
    closeModal();
    btn.innerHTML = originalText;
    btn.style.background = '';
    btn.disabled = false;
    form.reset();
  }, 2000);
}

function handleCalculationModalSubmit(e) {
  e.preventDefault();
  const form = e.target;
  const btn = form.querySelector('button[type="submit"]');
  const originalText = btn.innerHTML;
  btn.innerHTML = 'Заявка отправлена!';
  btn.disabled = true;
  setTimeout(() => {
    closeCalculationModal();
    btn.innerHTML = originalText;
    btn.disabled = false;
    form.reset();
    const fileInput = document.getElementById('calculationFileInput');
    if (fileInput) fileInput.value = '';
  }, 2000);
}

/* ---------- SMOOTH SCROLL for anchors ---------- */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href === '#') return;

    e.preventDefault();
    const target = document.querySelector(href);
    if (target) {
      const headerHeight = document.getElementById('header').offsetHeight;
      const top = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
      window.scrollTo({
        top: top,
        behavior: 'smooth'
      });
    }
  });
});

/* ---------- COUNTER ANIMATION for stats ---------- */
function animateCounter(element, target, suffix = '') {
  const duration = 2000;
  const start = 0;
  const startTime = performance.now();

  function update(currentTime) {
    const elapsed = currentTime - startTime;
    const progress = Math.min(elapsed / duration, 1);

    // Ease out cubic
    const eased = 1 - Math.pow(1 - progress, 3);
    const current = Math.floor(start + (target - start) * eased);

    element.textContent = current.toLocaleString('ru-RU') + suffix;

    if (progress < 1) {
      requestAnimationFrame(update);
    }
  }

  requestAnimationFrame(update);
}

// Animate hero stats when visible
const heroStats = document.querySelectorAll('.hero__stat-number');
const statsObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el = entry.target;
      const text = el.textContent;

      if (text.includes('30')) {
        animateCounter(el, 30, '+');
      } else if (text.includes('2000')) {
        animateCounter(el, 2000, '+');
      }
      // "5 лет" stays as text

      statsObserver.unobserve(el);
    }
  });
}, { threshold: 0.5 });

heroStats.forEach(stat => {
  if (stat.textContent.includes('30') || stat.textContent.includes('2000')) {
    statsObserver.observe(stat);
  }
});
