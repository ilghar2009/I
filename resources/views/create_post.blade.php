<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Create Post</title>
<style>
  :root{
    --bg:#0b0b0d;
    --card:#1a1b1f;
    --card-2:#232529;
    --text:#f2f2f3;
    --text-dim:#9a9ba1;
    --text-faint:#66676d;
    --accent:#5b8cff;
    --radius:16px;
  }
  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}
  body{
    background:var(--bg);
    color:var(--text);
    font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
    min-height:100dvh;
    display:flex;
    justify-content:center;
    -webkit-tap-highlight-color:transparent;
  }
  .app{
    width:100%;
    max-width:480px;
    min-height:100dvh;
    background:var(--bg);
    display:flex;
    flex-direction:column;
    position:relative;
  }

  .header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:calc(14px + env(safe-area-inset-top)) 16px 12px;
    position:sticky;
    top:0;
    background:var(--bg);
    z-index:20;
  }
  .icon-btn{
    background:none;
    border:none;
    color:var(--text);
    cursor:pointer;
    padding:6px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:50%;
  }
  .icon-btn:hover{background:var(--card);}
  .header h1{
    font-size:clamp(15px,4vw,17px);
    font-weight:600;
    margin:0;
    letter-spacing:0.2px;
    white-space:nowrap;
  }
  .header-title-wrap{display:flex;flex-direction:column;align-items:center;}
  .header-underline{
    width:26px;height:2px;background:var(--accent);border-radius:2px;margin-top:6px;
  }
  .post-btn{
    background:var(--card-2);
    color:var(--text-faint);
    border:none;
    font-weight:700;
    font-size:14px;
    padding:8px 18px;
    border-radius:20px;
    cursor:not-allowed;
    transition:background .2s ease, color .2s ease, transform .1s ease;
    flex-shrink:0;
  }
  .post-btn.active{
    background:var(--accent);
    color:#fff;
    cursor:pointer;
  }
  .post-btn.active:active{transform:scale(0.96);}

  .body-scroll{
    flex:1;
    overflow-y:auto;
    -webkit-overflow-scrolling:touch;
    padding:4px 16px calc(40px + env(safe-area-inset-bottom));
  }

  .profile-row{
    display:flex;
    align-items:center;
    gap:10px;
    margin-top:6px;
  }
  .avatar{
    width:44px;height:44px;border-radius:50%;
    background:var(--card);
    display:flex;align-items:center;justify-content:center;
    flex-shrink:0;
    overflow:hidden;
  }
  .avatar svg{width:22px;height:22px;color:var(--text-faint);}
  .profile-meta{display:flex;flex-direction:column;gap:6px;min-width:0;}
  .username-row{
    display:flex;align-items:center;gap:4px;
    font-weight:700;font-size:15px;
  }
  .pill{
    display:inline-flex;align-items:center;gap:6px;
    background:var(--card);
    color:var(--text-dim);
    font-size:12.5px;font-weight:600;
    padding:5px 10px 5px 8px;
    border-radius:20px;
    cursor:pointer;
    width:fit-content;
    transition:background-color .15s ease, color .15s ease;
  }
  .pill:hover{background:var(--card-2);color:var(--text);}
  .chev{width:13px;height:13px;flex-shrink:0;}

  .caption-wrap{
    margin-top:18px;
    position:relative;
  }
  textarea.caption{
    width:100%;
    background:transparent;
    border:none;
    resize:none;
    color:var(--text);
    font-size:17px;
    line-height:1.5;
    min-height:90px;
    font-family:inherit;
    padding:0 34px 0 0;
  }
  textarea.caption::placeholder{color:var(--text-faint);}
  textarea.caption:focus{outline:none;}
  .emoji-toggle{
    position:absolute;
    right:0;
    bottom:6px;
    background:var(--card);
    border:none;
    border-radius:50%;
    width:34px;height:34px;
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;
    font-size:16px;
    color:var(--text-dim);
    transition:background-color .15s ease, color .15s ease, transform .1s ease;
  }
  .emoji-toggle:hover{background:var(--card-2);color:var(--accent);}
  .emoji-toggle:active{transform:scale(0.92);}
  .char-count{
    font-size:11.5px;
    color:var(--text-faint);
    text-align:right;
    margin-top:2px;
    height:14px;
  }
  .char-count.warn{color:#f0a83c;}

  .emoji-picker{
    position:absolute;
    z-index:50;
    background:var(--card);
    border:none;
    border-radius:14px;
    padding:10px;
    box-shadow:0 12px 30px rgba(0,0,0,0.55);
    width:280px;
    max-width:calc(100vw - 32px);
    max-height:220px;
    display:none;
  }
  .emoji-picker.open{display:block;}
  .emoji-cats{
    display:flex;gap:6px;overflow-x:auto;
    margin-bottom:6px;padding-bottom:6px;
  }
  .emoji-cat-btn{
    background:none;border:none;color:var(--text-faint);
    font-size:15px;padding:4px 6px;border-radius:8px;cursor:pointer;flex-shrink:0;
  }
  .emoji-cat-btn.active{background:var(--card-2);color:var(--text);}
  .emoji-grid{
    display:grid;
    grid-template-columns:repeat(7,1fr);
    gap:2px;
    max-height:150px;
    overflow-y:auto;
  }
  .emoji-grid button{
    background:none;border:none;font-size:19px;
    padding:5px 0;border-radius:8px;cursor:pointer;
    line-height:1;
  }
  .emoji-grid button:hover{background:var(--card-2);}

  .media-add-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
    margin-top:14px;
  }
  .media-add-btn{
    background:var(--card);
    border:none;
    border-radius:var(--radius);
    padding:26px 10px;
    display:flex;flex-direction:column;align-items:center;gap:8px;
    cursor:pointer;
    color:var(--text-dim);
    transition:background-color .15s ease, color .15s ease;
  }
  .media-add-btn:hover{background:var(--card-2);color:var(--accent);}
  .media-add-btn svg{width:26px;height:26px;color:var(--text-faint);}
  .media-add-btn span{font-size:13.5px;font-weight:600;}
  input[type=file]{display:none;}

  .media-gallery{
    margin-top:16px;
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:10px;
  }
  .media-item{
    background:var(--card);
    border-radius:var(--radius);
    overflow:hidden;
    position:relative;
    aspect-ratio:1/1;
  }
  .media-item img,.media-item video{
    width:100%;height:100%;object-fit:cover;display:block;
  }
  .media-badge{
    position:absolute;top:8px;left:8px;
    background:rgba(0,0,0,0.55);
    color:#fff;font-size:11px;font-weight:700;
    padding:3px 8px;border-radius:10px;
    display:flex;align-items:center;gap:4px;
    backdrop-filter:blur(4px);
  }
  .remove-btn{
    position:absolute;top:8px;right:8px;
    width:28px;height:28px;border-radius:50%;
    background:rgba(0,0,0,0.55);
    border:none;color:#fff;
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;
    backdrop-filter:blur(4px);
    transition:background .15s ease;
  }
  .remove-btn:hover{background:rgba(255,92,92,0.85);}

  .options-card{
    margin-top:18px;
    background:var(--card);
    border-radius:var(--radius);
    overflow:hidden;
  }
  .option-row{
    display:flex;align-items:center;gap:12px;
    padding:14px 14px;
    cursor:pointer;
    transition:background .15s ease;
  }
  .option-row + .option-row{
    box-shadow:0 1px 0 0 rgba(255,255,255,0.05);
  }
  .option-row:hover{background:var(--card-2);}
  .option-row svg{width:19px;height:19px;color:var(--text-dim);flex-shrink:0;}
  .option-row span{flex:1;font-size:14.5px;font-weight:500;}
  .option-row .chev-right{width:15px;height:15px;color:var(--text-faint);flex-shrink:0;}

  .audience-card{
    margin-top:14px;
    background:var(--card);
    border-radius:var(--radius);
    padding:14px 14px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    flex-wrap:wrap;
  }
  .audience-card .label{font-size:14.5px;font-weight:700;}
  .audience-card .sub{font-size:12.5px;color:var(--text-faint);margin-top:2px;}

  ::-webkit-scrollbar{width:6px;height:6px;}
  ::-webkit-scrollbar-thumb{background:#333;border-radius:3px;}

  @media (max-width:360px){
    .body-scroll{padding-left:12px;padding-right:12px;}
    .media-add-btn{padding:20px 8px;}
    .media-gallery{grid-template-columns:1fr 1fr;gap:8px;}
  }

  @media (min-width:481px){
    body{padding:24px 16px;}
    .app{
      min-height:auto;
      max-height:calc(100dvh - 48px);
      border-radius:22px;
      box-shadow:0 30px 70px rgba(0,0,0,0.55);
      overflow:hidden;
    }
    .body-scroll{max-height:calc(100dvh - 48px - 60px);}
  }

  @media (min-width:820px){
    .app{max-width:560px;}
    .media-gallery{grid-template-columns:repeat(3,1fr);}
  }
</style>
</head>
<body>
<div class="app">

  <div class="header">
    <button class="icon-btn" aria-label="Back">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
    </button>
    <div class="header-title-wrap">
      <h1>Create Post</h1>
      <div class="header-underline"></div>
    </div>
    <button class="post-btn" id="postBtn">Post</button>
  </div>

  <div class="body-scroll">

    <div class="profile-row">
      <div class="avatar">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.4c-3.3 0-9.8 1.6-9.8 4.9v2.5h19.6v-2.5c0-3.3-6.5-4.9-9.8-4.9z"/></svg>
      </div>
      <div class="profile-meta">
        <div class="username-row">
          Your Username
          <svg class="chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
        </div>
        <div class="pill" id="visibilityPill">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.5 3.5 5.5 3.5 9s-1 6.5-3.5 9c-2.5-2.5-3.5-5.5-3.5-9s1-6.5 3.5-9z"/></svg>
          Public
          <svg class="chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
        </div>
      </div>
    </div>

    <div class="caption-wrap">
      <textarea class="caption" id="captionInput" placeholder="What's happening?" rows="3"></textarea>
      <button class="emoji-toggle" id="captionEmojiBtn" aria-label="Add emoji">🙂</button>
      <div class="emoji-picker" id="captionEmojiPicker"></div>
    </div>
    <div class="char-count" id="captionCount"></div>

    <div class="media-add-row">
      <label class="media-add-btn" for="imageInput">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
        <span>Add Image</span>
      </label>
      <input type="file" id="imageInput" accept="image/*" multiple>

      <label class="media-add-btn" for="videoInput">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="m10 9 5 3-5 3z" fill="currentColor" stroke="none"/></svg>
        <span>Add Video</span>
      </label>
      <input type="file" id="videoInput" accept="video/*" multiple>
    </div>

    <div class="media-gallery" id="mediaGallery"></div>

    <div class="options-card">
      <div class="option-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span>Add Location</span>
        <svg class="chev-right" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
      </div>
      <div class="option-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 9h16M4 15h16M10 3 8 21M16 3l-2 18"/></svg>
        <span>Add Hashtag</span>
        <svg class="chev-right" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
      </div>
      <div class="option-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M8 14s1.5 2 4 2 4-2 4-2M9 9h.01M15 9h.01"/></svg>
        <span>Feeling / Activity</span>
        <svg class="chev-right" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
      </div>
      <div class="option-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        <span>Tag People</span>
        <svg class="chev-right" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
      </div>
    </div>

    <div class="audience-card">
      <div>
        <div class="label">Audience</div>
        <div class="sub">Who can see this post?</div>
      </div>
      <div class="pill" id="audiencePill">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.5 3.5 5.5 3.5 9s-1 6.5-3.5 9c-2.5-2.5-3.5-5.5-3.5-9s1-6.5 3.5-9z"/></svg>
        Public
        <svg class="chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
      </div>
    </div>

  </div>
</div>

<script>
const EMOJI_CATS = {
  "🔥": ["😂","🤣","😎","🔥","💯","🙌","👏","😍","🥳","✨","🤩","💪","👌","🤙","🎉"],
  "🙂": ["😀","😁","😊","😘","😇","🙃","😉","😅","🥰","😴","🤔","😱","😢","😭","😡"],
  "❤️": ["❤️","🧡","💛","💚","💙","💜","🖤","🤍","💖","💗","💓","💞","💕","😻","💌"],
  "🍕": ["🍕","🍔","🍟","🌮","🍣","🍰","🍩","☕","🍺","🍷","🍎","🍇","🍓","🥑","🍦"],
  "🐶": ["🐶","🐱","🐼","🦁","🐯","🐰","🦊","🐨","🐸","🦄","🐙","🦋","🌸","🌻","🌈"],
  "⚽": ["⚽","🏀","🎾","🎮","🎨","🎵","📸","✈️","🚗","🏖️","⛰️","🗺️","🎬","📚","💡"],
  "👍": ["👍","👎","👋","🤝","✌️","🤟","🫶","👀","🧠","💡","⭐","🏆","🎯","✅","❌"]
};

function buildEmojiPicker(container, onPick){
  const catRow = document.createElement('div');
  catRow.className = 'emoji-cats';
  const grid = document.createElement('div');
  grid.className = 'emoji-grid';

  function renderGrid(cat){
    grid.innerHTML = '';
    EMOJI_CATS[cat].forEach(e=>{
      const b = document.createElement('button');
      b.type = 'button';
      b.textContent = e;
      b.addEventListener('click', ()=> onPick(e));
      grid.appendChild(b);
    });
  }

  Object.keys(EMOJI_CATS).forEach((cat, i)=>{
    const b = document.createElement('button');
    b.type = 'button';
    b.className = 'emoji-cat-btn' + (i===0 ? ' active' : '');
    b.textContent = cat;
    b.addEventListener('click', ()=>{
      catRow.querySelectorAll('.emoji-cat-btn').forEach(x=>x.classList.remove('active'));
      b.classList.add('active');
      renderGrid(cat);
    });
    catRow.appendChild(b);
  });

  container.appendChild(catRow);
  container.appendChild(grid);
  renderGrid(Object.keys(EMOJI_CATS)[0]);
}

function insertAtCursor(textarea, text){
  const start = textarea.selectionStart ?? textarea.value.length;
  const end = textarea.selectionEnd ?? textarea.value.length;
  const val = textarea.value;
  textarea.value = val.slice(0,start) + text + val.slice(end);
  const pos = start + text.length;
  textarea.selectionStart = textarea.selectionEnd = pos;
  textarea.focus();
  textarea.dispatchEvent(new Event('input'));
}

const captionInput = document.getElementById('captionInput');
const captionEmojiBtn = document.getElementById('captionEmojiBtn');
const captionEmojiPicker = document.getElementById('captionEmojiPicker');
buildEmojiPicker(captionEmojiPicker, (e)=> insertAtCursor(captionInput, e));

captionEmojiBtn.addEventListener('click', (ev)=>{
  ev.stopPropagation();
  closeAllPickers(captionEmojiPicker);
  captionEmojiPicker.classList.toggle('open');
  captionEmojiPicker.style.right = '0px';
  captionEmojiPicker.style.left = 'auto';
  captionEmojiPicker.style.bottom = '42px';
});

function closeAllPickers(except){
  document.querySelectorAll('.emoji-picker.open').forEach(p=>{
    if(p !== except) p.classList.remove('open');
  });
}
document.addEventListener('click', (e)=>{
  if(!e.target.closest('.emoji-picker') && !e.target.closest('.emoji-toggle')){
    closeAllPickers(null);
  }
});

const postBtn = document.getElementById('postBtn');
const captionCount = document.getElementById('captionCount');
const MAX_LEN = 500;

function refreshPostState(){
  const hasText = captionInput.value.trim().length > 0;
  const hasMedia = mediaGallery.children.length > 0;
  if(hasText || hasMedia){
    postBtn.classList.add('active');
  } else {
    postBtn.classList.remove('active');
  }
  const len = captionInput.value.length;
  captionCount.textContent = len > 0 ? `${len} / ${MAX_LEN}` : '';
  captionCount.classList.toggle('warn', len > MAX_LEN);
}
captionInput.addEventListener('input', refreshPostState);

postBtn.addEventListener('click', ()=>{
  if(!postBtn.classList.contains('active')) return;
  postBtn.textContent = 'Posted ✓';
  setTimeout(()=> postBtn.textContent = 'Post', 1400);
});

const mediaGallery = document.getElementById('mediaGallery');
const imageInput = document.getElementById('imageInput');
const videoInput = document.getElementById('videoInput');
let mediaCounter = 0;

function handleFiles(fileList, type){
  Array.from(fileList).forEach(file=>{
    const id = 'm' + (mediaCounter++);
    const url = URL.createObjectURL(file);
    addMediaItem(id, url, type, file.name);
  });
  refreshPostState();
}

imageInput.addEventListener('change', (e)=>{
  handleFiles(e.target.files, 'image');
  e.target.value = '';
});
videoInput.addEventListener('change', (e)=>{
  handleFiles(e.target.files, 'video');
  e.target.value = '';
});

function addMediaItem(id, url, type, name){
  const item = document.createElement('div');
  item.className = 'media-item';
  item.dataset.id = id;

  const badge = document.createElement('div');
  badge.className = 'media-badge';
  badge.textContent = type === 'video' ? '▶ Video' : '🖼 Image';
  item.appendChild(badge);

  const removeBtn = document.createElement('button');
  removeBtn.className = 'remove-btn';
  removeBtn.innerHTML = '✕';
  removeBtn.addEventListener('click', ()=>{
    item.remove();
    refreshPostState();
  });
  item.appendChild(removeBtn);

  if(type === 'image'){
    const img = document.createElement('img');
    img.src = url;
    img.alt = name;
    item.appendChild(img);
  } else {
    const vid = document.createElement('video');
    vid.src = url;
    vid.muted = true;
    vid.playsInline = true;
    vid.addEventListener('mouseenter', ()=> vid.play().catch(()=>{}));
    vid.addEventListener('mouseleave', ()=>{ vid.pause(); vid.currentTime = 0; });
    item.appendChild(vid);
  }

  mediaGallery.appendChild(item);
}

document.querySelectorAll('.pill').forEach(p=>{
  p.addEventListener('click', ()=>{
    const label = p.childNodes[2];
    const isPublic = p.textContent.includes('Public');
    const newText = isPublic ? 'Friends' : 'Public';
    label.textContent = ' ' + newText + ' ';
  });
});
</script>
</body>
</html>
