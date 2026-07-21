<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Profile</title>
<style>
  :root{
    --bg: #0a0a0a;
    --card: #161616;
    --card-border: rgba(255,255,255,0.06);
    --text: #f5f5f5;
    --text-dim: #8a8a8a;
    --text-faint: #5c5c5c;
    --accent: #f5f5f5;
    --accent-muted: #666;
    --radius: 16px;
  }

  * { box-sizing: border-box; }

  html, body {
    margin: 0;
    padding: 0;
    background: var(--bg);
    color: var(--text);
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  }

  .page {
    max-width: 480px;
    margin: 0 auto;
    min-height: 100vh;
    background: var(--bg);
    padding-bottom: 40px;
  }

  /* Header */
  .header {
    position: sticky;
    top: 0;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 20px;
    background: rgba(10,10,10,0.85);
    backdrop-filter: blur(10px);
  }

  .icon-btn {
    background: none;
    border: none;
    color: var(--text);
    cursor: pointer;
    padding: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .icon-btn svg { width: 22px; height: 22px; }

  .header h1 {
    font-size: 17px;
    font-weight: 700;
    margin: 0;
  }

  .save-btn {
    background: none;
    border: none;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    color: var(--text-faint);
    transition: color 0.2s ease;
  }
  .save-btn.active {
    color: #4da3ff;
  }

  /* Avatar */
  .avatar-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 28px 20px 24px;
    text-align: center;
  }

  .avatar-wrap {
    position: relative;
    width: 116px;
    height: 116px;
    margin-bottom: 18px;
  }

  .avatar-circle {
    width: 116px;
    height: 116px;
    border-radius: 50%;
    background: #2a2a2a;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border: 1px solid var(--card-border);
  }

  .avatar-circle svg {
    width: 60%;
    height: 60%;
    color: #555;
  }

  .avatar-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .camera-btn {
    position: absolute;
    bottom: 0;
    right: 2px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #2b2b2b;
    border: 2px solid var(--bg);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
  }
  .camera-btn svg { width: 17px; height: 17px; color: var(--text); }

  .display-name {
    font-size: 22px;
    font-weight: 700;
    margin: 0 0 4px;
  }

  .handle {
    font-size: 14px;
    color: var(--text-dim);
    margin: 0;
  }

  /* Form */
  .form {
    padding: 0 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .field {
    background: var(--card);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    padding: 12px 16px 14px;
  }

  .field label {
    display: block;
    font-size: 12.5px;
    color: var(--text-dim);
    margin-bottom: 4px;
  }

  .field input,
  .field textarea {
    width: 100%;
    background: none;
    border: none;
    outline: none;
    color: var(--text);
    font-size: 16px;
    font-family: inherit;
    padding: 0;
  }

  .field input::placeholder,
  .field textarea::placeholder {
    color: var(--text-faint);
  }

  .field textarea {
    resize: none;
    min-height: 44px;
  }

  .bio-counter {
    display: flex;
    justify-content: flex-end;
    font-size: 12.5px;
    color: var(--text-faint);
    margin-top: 2px;
  }

  /* Row field (Profile Picture, Cover Photo header) */
  .row-field {
    background: var(--card);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    padding: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    transition: background 0.15s ease;
  }
  .row-field:active { background: #1e1e1e; }

  .row-field .label {
    font-size: 15px;
    font-weight: 600;
  }

  .row-field .right {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--text-dim);
  }

  .mini-avatar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #2a2a2a;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }
  .mini-avatar svg { width: 60%; height: 60%; color: #555; }
  .mini-avatar img { width: 100%; height: 100%; object-fit: cover; }

  .chevron { width: 18px; height: 18px; color: var(--text-faint); flex-shrink: 0; }

  /* Cover photo block */
  .cover-block {
    background: var(--card);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .cover-block .top-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
  }

  .cover-drop {
    height: 140px;
    border-radius: 12px;
    background: #1d1d1d;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4a4a4a;
    cursor: pointer;
    overflow: hidden;
    position: relative;
  }
  .cover-drop img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .cover-drop svg { width: 34px; height: 34px; }

  /* List group (Location / Website / Birthday) */
  .list-group {
    background: var(--card);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    overflow: hidden;
  }

  .list-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 16px;
    cursor: pointer;
    transition: background 0.15s ease;
  }
  .list-item:active { background: #1e1e1e; }

  .list-item + .list-item {
    border-top: 1px solid var(--card-border);
  }

  .list-item svg.leading {
    width: 19px;
    height: 19px;
    color: var(--text-dim);
    flex-shrink: 0;
  }

  .list-item .item-label {
    font-size: 15.5px;
    font-weight: 500;
    flex-shrink: 0;
  }

  .list-item .item-value {
    flex: 1;
    text-align: right;
    color: var(--text-faint);
    font-size: 15px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .list-item .item-value.filled { color: var(--text-dim); }

  input[type="file"] { display: none; }

  @media (max-width: 380px) {
    .avatar-wrap { width: 100px; height: 100px; }
    .avatar-circle { width: 100px; height: 100px; }
    .display-name { font-size: 20px; }
  }
</style>
</head>
<body>
<div class="page">

  <div class="header">
    <button class="icon-btn" aria-label="Back">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
    </button>
    <h1>Edit Profile</h1>
    <button class="save-btn" id="saveBtn">Save</button>
  </div>

  <div class="avatar-section">
    <div class="avatar-wrap">
      <div class="avatar-circle" id="avatarCircle">
        <svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
      </div>
      <button class="camera-btn" id="avatarUploadBtn" aria-label="Change profile photo">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
      </button>
      <input type="file" id="avatarInput" accept="image/*">
    </div>
    <p class="display-name" id="displayName">Your Username</p>
    <p class="handle" id="displayHandle">@yourusername</p>
  </div>

  <form class="form" id="profileForm">

    <div class="field">
      <label for="nameInput">Name</label>
      <input id="nameInput" type="text" value="Your Name" maxlength="50" autocomplete="off">
    </div>

    <div class="field">
      <label for="usernameInput">Username</label>
      <input id="usernameInput" type="text" value="yourusername" maxlength="30" autocomplete="off">
    </div>

    <div class="field">
      <label for="bioInput">Bio</label>
      <textarea id="bioInput" placeholder="Write something about yourself..." maxlength="150" rows="2"></textarea>
      <div class="bio-counter"><span id="bioCount">0</span>/150</div>
    </div>

    <div class="row-field" id="profilePicRow">
      <span class="label">Profile Picture</span>
      <span class="right">
        <span class="mini-avatar" id="miniAvatar">
          <svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
        </span>
        <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
      </span>
    </div>

    <div class="cover-block">
      <div class="top-row" id="coverPhotoRow">
        <span class="label">Cover Photo</span>
        <svg class="chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="cover-drop" id="coverDrop">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
      </div>
      <input type="file" id="coverInput" accept="image/*">
    </div>

    <div class="list-group">
      <div class="list-item" id="locationRow">
        <svg class="leading" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span class="item-label">Location</span>
        <span class="item-value" id="locationValue">Add your location</span>
      </div>
      <div class="list-item" id="websiteRow">
        <svg class="leading" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.5.5l2-2a5 5 0 0 0-7-7l-1.5 1.5"/><path d="M14 11a5 5 0 0 0-7.5-.5l-2 2a5 5 0 0 0 7 7l1.5-1.5"/></svg>
        <span class="item-label">Website</span>
        <span class="item-value" id="websiteValue">Add your website</span>
      </div>
      <div class="list-item" id="birthdayRow">
        <svg class="leading" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        <span class="item-label">Birthday</span>
        <span class="item-value" id="birthdayValue">Add your birthday</span>
      </div>
    </div>

  </form>
</div>

<script>
  const state = { dirty: false };

  const saveBtn = document.getElementById('saveBtn');
  function markDirty() {
    state.dirty = true;
    saveBtn.classList.add('active');
  }

  // Name / username / bio sync
  const nameInput = document.getElementById('nameInput');
  const usernameInput = document.getElementById('usernameInput');
  const bioInput = document.getElementById('bioInput');
  const bioCount = document.getElementById('bioCount');
  const displayName = document.getElementById('displayName');
  const displayHandle = document.getElementById('displayHandle');

  nameInput.addEventListener('input', () => {
    displayName.textContent = nameInput.value.trim() || 'Your Name';
    markDirty();
  });

  usernameInput.addEventListener('input', () => {
    const clean = usernameInput.value.trim();
    displayHandle.textContent = '@' + (clean || 'yourusername');
    markDirty();
  });

  bioInput.addEventListener('input', () => {
    bioCount.textContent = bioInput.value.length;
    markDirty();
  });

  // Avatar upload
  const avatarInput = document.getElementById('avatarInput');
  const avatarCircle = document.getElementById('avatarCircle');
  const miniAvatar = document.getElementById('miniAvatar');
  const avatarUploadBtn = document.getElementById('avatarUploadBtn');
  const profilePicRow = document.getElementById('profilePicRow');

  function openAvatarPicker() { avatarInput.click(); }
  avatarUploadBtn.addEventListener('click', openAvatarPicker);
  profilePicRow.addEventListener('click', openAvatarPicker);

  avatarInput.addEventListener('change', () => {
    const file = avatarInput.files[0];
    if (!file) return;
    const url = URL.createObjectURL(file);
    avatarCircle.innerHTML = `<img src="${url}" alt="Profile photo">`;
    miniAvatar.innerHTML = `<img src="${url}" alt="Profile photo">`;
    markDirty();
  });

  // Cover photo upload
  const coverInput = document.getElementById('coverInput');
  const coverDrop = document.getElementById('coverDrop');
  const coverPhotoRow = document.getElementById('coverPhotoRow');

  function openCoverPicker() { coverInput.click(); }
  coverDrop.addEventListener('click', openCoverPicker);
  coverPhotoRow.addEventListener('click', openCoverPicker);

  coverInput.addEventListener('change', () => {
    const file = coverInput.files[0];
    if (!file) return;
    const url = URL.createObjectURL(file);
    coverDrop.innerHTML = `<img src="${url}" alt="Cover photo">`;
    markDirty();
  });

  // Location / Website / Birthday — simple inline prompt-based edit
  function wireListRow(rowId, valueId, placeholder, promptText, type) {
    const row = document.getElementById(rowId);
    const valueEl = document.getElementById(valueId);
    row.addEventListener('click', () => {
      const current = valueEl.dataset.raw || '';
      const result = window.prompt(promptText, current);
      if (result === null) return;
      const trimmed = result.trim();
      if (trimmed) {
        valueEl.textContent = trimmed;
        valueEl.classList.add('filled');
        valueEl.dataset.raw = trimmed;
      } else {
        valueEl.textContent = placeholder;
        valueEl.classList.remove('filled');
        valueEl.dataset.raw = '';
      }
      markDirty();
    });
  }

  wireListRow('locationRow', 'locationValue', 'Add your location', 'Enter your location:');
  wireListRow('websiteRow', 'websiteValue', 'Add your website', 'Enter your website URL:');
  wireListRow('birthdayRow', 'birthdayValue', 'Add your birthday', 'Enter your birthday (e.g. Jan 1, 1990):');

  saveBtn.addEventListener('click', (e) => {
    e.preventDefault();
    if (!state.dirty) return;
    saveBtn.textContent = 'Saved';
    setTimeout(() => { saveBtn.textContent = 'Save'; }, 1200);
  });
</script>
</body>
</html>
