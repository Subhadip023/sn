const yearEl = document.getElementById('year');
if (yearEl) yearEl.textContent = new Date().getFullYear();

const menuBtn = document.getElementById('menuBtn');
const nav = document.getElementById('nav');
if (menuBtn && nav) {
  menuBtn.addEventListener('click', () => {
    const open = nav.classList.contains('flex');
    nav.classList.toggle('hidden', open);
    nav.classList.toggle('flex', !open);
    nav.classList.toggle('flex-col', !open);
    nav.classList.toggle('gap-4', !open);
    nav.classList.toggle('bg-slate-950', !open);
    nav.classList.toggle('border', !open);
    nav.classList.toggle('border-white/10', !open);
    nav.classList.toggle('absolute', !open);
    nav.classList.toggle('right-4', !open);
    nav.classList.toggle('top-16', !open);
    nav.classList.toggle('px-4', !open);
    nav.classList.toggle('py-3', !open);
    nav.classList.toggle('rounded-xl', !open);
    menuBtn.setAttribute('aria-expanded', String(!open));
  });
}

const themeBtn = document.getElementById('themeBtn');
const STORAGE_KEY = 'newsroom-theme';
function setTheme(mode) {
  const light = mode === 'light';
  document.body.classList.toggle('bg-slate-50', light);
  document.body.classList.toggle('text-slate-900', light);
  document.body.classList.toggle('bg-slate-950', !light);
  document.body.classList.toggle('text-slate-50', !light);

  document.querySelectorAll('.bg-white\\/5, .bg-slate-100').forEach((el) => {
    if (light) {
      el.classList.remove('bg-white/5');
      el.classList.add('bg-slate-100');
    } else {
      el.classList.remove('bg-slate-100');
      el.classList.add('bg-white/5');
    }
  });
  document.querySelectorAll('.bg-white\\/10, .bg-slate-200').forEach((el) => {
    if (light) {
      el.classList.remove('bg-white/10');
      el.classList.add('bg-slate-200');
    } else {
      el.classList.remove('bg-slate-200');
      el.classList.add('bg-white/10');
    }
  });
  document.querySelectorAll('.bg-slate-950\\/90, .bg-white\\/90').forEach((el) => {
    if (light) {
      el.classList.remove('bg-slate-950/90');
      el.classList.add('bg-white/90');
    } else {
      el.classList.remove('bg-white/90');
      el.classList.add('bg-slate-950/90');
    }
  });
  document.querySelectorAll('.border-white\\/10, .border-slate-200').forEach((el) => {
    if (light) el.classList.add('border-slate-200');
    else el.classList.remove('border-slate-200');
  });
  document.querySelectorAll('.border-white\\/5, .border-slate-200').forEach((el) => {
    if (light) el.classList.add('border-slate-200');
    else el.classList.remove('border-slate-200');
  });
  document.querySelectorAll('.text-slate-300, .text-slate-600').forEach((el) => {
    if (light) el.classList.add('text-slate-600');
    else el.classList.remove('text-slate-600');
  });
  document.querySelectorAll('.text-slate-200, .text-slate-700').forEach((el) => {
    if (light) el.classList.add('text-slate-700');
    else el.classList.remove('text-slate-700');
  });
  document.querySelectorAll('.text-slate-400, .text-slate-500').forEach((el) => {
    if (light) el.classList.add('text-slate-500');
    else el.classList.remove('text-slate-500');
  });

  localStorage.setItem(STORAGE_KEY, light ? 'light' : 'dark');
}

if (themeBtn) {
  const saved = localStorage.getItem(STORAGE_KEY);
  if (saved === 'light') setTheme('light');
  themeBtn.addEventListener('click', () => {
    const isLight = document.body.classList.contains('bg-slate-50');
    setTheme(isLight ? 'dark' : 'light');
  });
}

const signupForm = document.getElementById('signupForm');
const signupHint = document.getElementById('signupHint');
if (signupForm && signupHint) {
  signupForm.addEventListener('submit', (e) => {
    e.preventDefault();
    signupHint.textContent = 'Subscribed — demo only.';
    signupForm.reset();
  });
}

const categorySignup = document.getElementById('categorySignup');
const categoryHint = document.getElementById('categoryHint');
if (categorySignup && categoryHint) {
  categorySignup.addEventListener('submit', (e) => {
    e.preventDefault();
    categoryHint.textContent = 'Saved! Expect daily briefs (demo).';
    categorySignup.reset();
  });
}

const newArticle = document.getElementById('newArticle');
const newArticleHint = document.getElementById('newArticleHint');
if (newArticle && newArticleHint) {
  const urlSlugInput = document.getElementById('urlSlug');
  const metaTitleInput = document.getElementById('metaTitle');
  const metaDescriptionInput = document.getElementById('metaDescription');
  
  // Auto-generate URL slug from headline
  if (headlineInput && urlSlugInput) {
    headlineInput.addEventListener('keyup', (e) => {
      if (!urlSlugInput.matches(':focus')) { // Only auto-generate if slug field isn't focused
        const slug = headlineInput.value
          .toLowerCase()
          .replace(/[^\w\s-]/g, '') // Remove special chars
          .replace(/\s+/g, '-') // Replace spaces with -
          .replace(/--+/g, '-') // Replace multiple - with single -
          .substring(0, 60) // Limit length
          .replace(/-+$/, ''); // Remove trailing -
        urlSlugInput.value = slug;
      }
      
      // Auto-populate meta title if empty
      if (metaTitleInput && !metaTitleInput.value) {
        metaTitleInput.value = headlineInput.value.substring(0, 60);
      }
    });
  }
  
  // Auto-populate meta description from summary if empty
  if (summaryInput && metaDescriptionInput) {
    summaryInput.addEventListener('keyup', (e) => {
      if (!metaDescriptionInput.matches(':focus')) {
        metaDescriptionInput.value = summaryInput.value.substring(0, 160);
      }
    });
  }
  
  newArticle.addEventListener('submit', (e) => {
    e.preventDefault();
    
    // Form values are already available directly from the inputs
    
    // Get SEO data
    const seoData = {
      metaTitle: metaTitleInput?.value || '',
      metaDescription: metaDescriptionInput?.value || '',
      urlSlug: urlSlugInput?.value || ''
    };
    
    console.log('SEO Data:', seoData); // For demo purposes
    
    newArticleHint.textContent = 'Draft saved with SEO data (demo).';
    newArticle.reset();
    
    // Clear all form fields
    newArticle.reset();
    
    // Clear SEO fields separately since they're not part of the form
    if (metaTitleInput) metaTitleInput.value = '';
    if (metaDescriptionInput) metaDescriptionInput.value = '';
    if (urlSlugInput) urlSlugInput.value = '';
  });
}

const inviteUser = document.getElementById('inviteUser');
const inviteHint = document.getElementById('inviteHint');
if (inviteUser && inviteHint) {
  inviteUser.addEventListener('submit', (e) => {
    e.preventDefault();
    inviteHint.textContent = 'Invite sent (demo).';
    inviteUser.reset();
  });
}

// Form elements
const headlineInput = document.getElementById('headline');
const summaryInput = document.getElementById('summary');
const bodyInput = document.getElementById('body');

const refreshQueue = document.getElementById('refreshQueue');
const queueTable = document.getElementById('queueTable');
if (refreshQueue && queueTable) {
  refreshQueue.addEventListener('click', () => {
    refreshQueue.textContent = 'Refreshing...';
    refreshQueue.disabled = true;
    setTimeout(() => {
      queueTable.innerHTML = `
        <tr>
          <td class="py-2">Q&A: Climate adaptation</td>
          <td class="py-2">Climate</td>
          <td class="py-2"><span class="px-2 py-1 rounded-full bg-amber-500/20 text-amber-200 text-xs">Review</span></td>
          <td class="py-2">10:12</td>
          <td class="py-2 space-x-2">
            <a class="text-brand-200 hover:text-brand-100" href="./article.html">View</a>
            <a class="text-slate-200 hover:text-white" href="./admin-content.html">Edit</a>
          </td>
        </tr>
        <tr>
          <td class="py-2">EV battery breakthrough</td>
          <td class="py-2">Tech</td>
          <td class="py-2"><span class="px-2 py-1 rounded-full bg-emerald-500/20 text-emerald-200 text-xs">Ready</span></td>
          <td class="py-2">10:05</td>
          <td class="py-2 space-x-2">
            <a class="text-brand-200 hover:text-brand-100" href="./article.html">View</a>
            <a class="text-slate-200 hover:text-white" href="./admin-content.html">Edit</a>
          </td>
        </tr>
      `;
      refreshQueue.textContent = 'Refresh';
      refreshQueue.disabled = false;
    }, 600);
  });
}

const editorsCount = document.getElementById('editorsCount');
if (editorsCount) {
  setInterval(() => {
    const updated = 5 + Math.floor(Math.random() * 6);
    editorsCount.textContent = updated.toString();
  }, 3500);
}

const activity = document.getElementById('activity');
if (activity) {
  setInterval(() => {
    const now = new Date();
    const time = `${now.getHours()}:${String(now.getMinutes()).padStart(2, '0')}`;
    const messages = [
      'Published: Economic outlook Q4',
      'Draft edited: Streaming bundle guide',
      'Scheduled: Morning briefing',
      'Updated: Photo captions for markets'
    ];
    const msg = messages[Math.floor(Math.random() * messages.length)];
    const item = document.createElement('div');
    item.className = 'flex items-center justify-between bg-white/5 px-3 py-2 rounded-lg';
    item.innerHTML = `<span>${msg}</span><span class="text-slate-400">${time}</span>`;
    activity.prepend(item);
    if (activity.children.length > 6) activity.lastElementChild?.remove();
  }, 4000);
}

