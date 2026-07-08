<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Waypoint — Home</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,400;0,500;0,600;1,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --bg: #0D0F0C;
    --surface: #16180F;
    --surface-raised: #1C1F14;
    --hairline: rgba(242,241,236,0.08);
    --hairline-strong: rgba(242,241,236,0.16);
    --text-primary: #F2F1EC;
    --text-secondary: #A6A497;
    --text-muted: #6E6C61;
    --amber: #E2A155;
    --amber-dim: rgba(226,161,85,0.16);
    --teal: #6E9C8F;
    --font-voice: 'Newsreader', Georgia, serif;
    --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    --radius-card: 16px;
    --radius-pill: 999px;
    --max-feed: 560px;
  }

  *{ box-sizing: border-box; margin:0; padding:0; }

  html{ background: var(--bg); }

  body{
    background: var(--bg);
    color: var(--text-primary);
    font-family: var(--font-sans);
    -webkit-font-smoothing: antialiased;
    min-height: 100vh;
  }

  a{ color: inherit; text-decoration: none; }

  button{
    font-family: inherit;
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0;
  }

  img{ display:block; max-width:100%; }

  /* ---------- App shell ---------- */

  .app-shell{
    max-width: 1160px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr;
    min-height: 100vh;
  }

  header.topbar{
    position: sticky;
    top: 0;
    z-index: 20;
    background: rgba(13,15,12,0.92);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--hairline);
    padding: 14px 16px;
  }

  .topbar-inner{
    max-width: var(--max-feed);
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .brand{
    font-family: var(--font-voice);
    font-style: italic;
    font-size: 21px;
    font-weight: 500;
    letter-spacing: 0.2px;
    white-space: nowrap;
    display: none;
  }

  .search-wrap{
    flex: 1;
    display: flex;
    align-items: center;
    gap: 10px;
    background: var(--surface);
    border: 1px solid var(--hairline);
    border-radius: var(--radius-pill);
    padding: 9px 16px;
    color: var(--text-muted);
  }

  .search-wrap svg{ flex-shrink:0; opacity:0.7; }

  .search-wrap input{
    all: unset;
    flex: 1;
    font-size: 14px;
    color: var(--text-primary);
  }
  .search-wrap input::placeholder{ color: var(--text-muted); }

  .profile-chip{
    display:flex;
    align-items:center;
    gap:8px;
    background: var(--surface);
    border: 1px solid var(--hairline);
    border-radius: var(--radius-pill);
    padding: 6px 14px 6px 6px;
    flex-shrink: 0;
  }

  .avatar-ring{
    position: relative;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    flex-shrink: 0;
  }
  .avatar-ring svg{ position:absolute; inset:0; transform: rotate(-90deg); }
  .avatar-ring .avatar-img{
    position:absolute;
    inset: 3px;
    border-radius: 50%;
    background: #2A2D20;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow: hidden;
  }
  .profile-chip span{ font-size: 13px; color: var(--text-secondary); }

  /* ---------- Layout: feed + rail ---------- */

  .content-row{
    display: grid;
    grid-template-columns: 1fr;
    gap: 0;
    justify-content: center;
  }

  main.feed{
    width: 100%;
    max-width: var(--max-feed);
    margin: 0 auto;
    padding: 20px 16px 60px;
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  aside.rail{
    display: none;
  }

  /* ---------- Post card ---------- */

  .post{
    background: var(--surface);
    border: 1px solid var(--hairline);
    border-radius: var(--radius-card);
    overflow: hidden;
  }

  .post-head{
    display:flex;
    align-items:center;
    gap: 10px;
    padding: 12px 14px;
  }

  .post-head .avatar-img{
    width: 36px; height:36px; border-radius:50%;
    flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    overflow:hidden;
    background: #2A2D20;
  }

  .post-head .who{ flex:1; min-width:0; }
  .post-head .name{ font-size: 14px; font-weight: 500; }
  .post-head .place{
    display:flex; align-items:center; gap:4px;
    font-size: 12px; color: var(--text-secondary);
    margin-top: 1px;
  }
  .post-head .place svg{ width:11px; height:11px; flex-shrink:0; color: var(--amber); }

  .more-btn{ color: var(--text-muted); padding: 6px; }

  /* media */
  .post-media{
    position: relative;
    display: grid;
    grid-auto-flow: column;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    gap: 2px;
    scrollbar-width: none;
  }
  .post-media::-webkit-scrollbar{ display:none; }

  .post-media.single{ grid-auto-columns: 100%; }
  .post-media.multi{ grid-auto-columns: 82%; padding-right: 18%; }

  .media-slide{
    scroll-snap-align: start;
    aspect-ratio: 4/5;
    width: 100%;
  }

  .dots{
    display:flex;
    justify-content:center;
    gap: 5px;
    padding: 10px 0 0;
  }
  .dot{ width:5px; height:5px; border-radius:50%; background: var(--hairline-strong); }
  .dot.active{ background: var(--amber); }

  /* actions */
  .post-actions{
    display:flex;
    align-items:center;
    padding: 10px 14px 4px;
    gap: 16px;
  }
  .action-btn{
    display:flex; align-items:center; gap: 6px;
    color: var(--text-secondary);
    font-size: 13px;
  }
  .action-btn svg{ width:21px; height:21px; transition: transform .15s ease; }
  .action-btn.liked svg{ color: var(--amber); }
  .action-btn.liked.pulse svg{ animation: pulse .35s ease; }
  @keyframes pulse{ 40%{ transform: scale(1.25);} 100%{ transform: scale(1);} }
  .spacer{ flex:1; }
  .save-btn svg{ width:20px; height:20px; color: var(--text-secondary); }
  .save-btn.saved svg{ color: var(--text-primary); }

  .post-body{
    padding: 6px 14px 16px;
  }
  .likes-line{
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 4px;
  }
  .caption{
    font-size: 14px;
    line-height: 1.5;
    color: var(--text-primary);
  }
  .caption .cap-name{ font-weight: 500; margin-right: 5px; }
  .caption-muted{ color: var(--text-secondary); }
  .view-comments{
    font-size: 13px;
    color: var(--text-muted);
    margin-top: 6px;
  }
  .timestamp{
    font-size: 11px;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.4px;
    margin-top: 8px;
  }

  /* text-only post */
  .text-post{
    padding: 4px 14px 18px;
    font-family: var(--font-voice);
    font-size: 17px;
    line-height: 1.6;
    color: var(--text-primary);
  }

  /* ---------- Rail cards (desktop) ---------- */
  .rail-card{
    background: var(--surface);
    border: 1px solid var(--hairline);
    border-radius: var(--radius-card);
    padding: 16px;
    margin-bottom: 16px;
  }
  .rail-title{
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: var(--text-muted);
    margin-bottom: 12px;
  }
  .trend-row{
    display:flex;
    align-items:center;
    gap: 10px;
    padding: 8px 0;
  }
  .trend-row + .trend-row{ border-top: 1px solid var(--hairline); }
  .trend-thumb{
    width: 38px; height:38px; border-radius: 10px;
    flex-shrink:0; overflow:hidden;
  }
  .trend-name{ font-size: 13px; font-weight:500; }
  .trend-count{ font-size: 12px; color: var(--text-muted); }

  /* ---------- Responsive breakpoints ---------- */

  @media (min-width: 640px){
    .brand{ display:block; }
    main.feed{ padding-top: 28px; }
  }

  @media (min-width: 860px){
    header.topbar{ padding: 16px 32px; }
    .topbar-inner{ max-width: 1096px; }
    .content-row{
      grid-template-columns: minmax(0, var(--max-feed)) 280px;
      gap: 32px;
      padding: 0 32px;
      align-items: start;
    }
    main.feed{ padding: 28px 0 60px; margin: 0; }
    aside.rail{
      display:block;
      position: sticky;
      top: 84px;
      padding-top: 28px;
    }
  }

  @media (min-width: 1160px){
    .content-row{ padding: 0; }
  }

  @media (prefers-reduced-motion: reduce){
    .action-btn.pulse svg{ animation: none; }
  }
</style>
</head>
<body>

<header class="topbar">
  <div class="topbar-inner">
    <span class="brand">Waypoint</span>
    <div class="search-wrap">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
      <input type="text" placeholder="Search places, journals, people">
    </div>
    <div class="profile-chip">
      <span class="avatar-ring">
        <svg width="30" height="30" viewBox="0 0 30 30"><circle cx="15" cy="15" r="13" fill="none" stroke="var(--hairline-strong)" stroke-width="2"/><circle cx="15" cy="15" r="13" fill="none" stroke="var(--amber)" stroke-width="2" stroke-linecap="round" stroke-dasharray="81.6" stroke-dashoffset="24"/></svg>
        <span class="avatar-img"><svg width="16" height="16" viewBox="0 0 24 24" fill="var(--text-muted)"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg></span>
      </span>
      <span>You</span>
    </div>
  </div>
</header>

<div class="app-shell">
  <div class="content-row">

    <main class="feed" id="feed"></main>

    <aside class="rail">
      <div class="rail-card">
        <div class="rail-title">Trending waypoints</div>
        <div id="trend-list"></div>
      </div>
      <div class="rail-card">
        <div class="rail-title">Your journal</div>
        <div style="font-size:13px; color:var(--text-secondary); line-height:1.6;">
          4 trips logged this year. Next stop: add your Kyoto entries before they fade from memory.
        </div>
      </div>
    </aside>

  </div>
</div>

<script>
function svgScene(kind){
  const scenes = {
    ridge: `<svg viewBox="0 0 400 500" preserveAspectRatio="xMidYMid slice" width="100%" height="100%">
      <rect width="400" height="500" fill="#20241A"/>
      <path d="M0 340 L90 220 L150 300 L230 160 L320 300 L400 250 L400 500 L0 500 Z" fill="#2B301F"/>
      <path d="M0 400 L110 300 L200 380 L280 280 L400 370 L400 500 L0 500 Z" fill="#363B26"/>
      <circle cx="320" cy="110" r="34" fill="#E2A155" opacity="0.85"/>
      <path d="M0 470 L400 470" stroke="#454B31" stroke-width="1"/>
    </svg>`,
    coast: `<svg viewBox="0 0 400 500" preserveAspectRatio="xMidYMid slice" width="100%" height="100%">
      <rect width="400" height="500" fill="#1B2422"/>
      <rect y="320" width="400" height="180" fill="#243430"/>
      <path d="M0 320 Q100 300 200 322 T400 315 V500 H0 Z" fill="#2F433D"/>
      <circle cx="90" cy="120" r="46" fill="#E2A155" opacity="0.9"/>
      <path d="M0 250 Q60 240 130 252 T260 246 T400 255" stroke="#6E9C8F" stroke-width="2" fill="none" opacity="0.6"/>
    </svg>`,
    desert: `<svg viewBox="0 0 400 500" preserveAspectRatio="xMidYMid slice" width="100%" height="100%">
      <rect width="400" height="500" fill="#241C16"/>
      <path d="M0 360 Q120 300 220 350 T400 330 V500 H0 Z" fill="#382C20"/>
      <path d="M0 420 Q150 380 260 410 T400 400 V500 H0 Z" fill="#463726"/>
      <circle cx="310" cy="100" r="40" fill="#E2A155"/>
    </svg>`,
    trail: `<svg viewBox="0 0 400 500" preserveAspectRatio="xMidYMid slice" width="100%" height="100%">
      <rect width="400" height="500" fill="#1C2117"/>
      <path d="M0 300 L140 190 L400 300 V500 H0 Z" fill="#272E1D"/>
      <path d="M60 500 Q140 380 200 320 Q260 260 360 240" stroke="#6E9C8F" stroke-width="3" fill="none" stroke-dasharray="2 10" stroke-linecap="round" opacity="0.7"/>
      <circle cx="140" cy="150" r="30" fill="#E2A155" opacity="0.85"/>
    </svg>`
  };
  return scenes[kind] || scenes.ridge;
}

function personSvg(){
  return `<svg width="60%" height="60%" viewBox="0 0 24 24" fill="var(--text-muted)"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>`;
}

const posts = [
  {
    id: 1,
    name: "Mireille Aubert",
    place: "Chamonix, France",
    media: [{kind:"ridge"}],
    likes: 214,
    caption: "Four hours up, twenty minutes at the top just to watch the cloud line move.",
    comments: 12,
    time: "2 hours ago"
  },
  {
    id: 2,
    name: "Kofi Owusu",
    place: "Zanzibar, Tanzania",
    media: [{kind:"coast"}, {kind:"trail"}],
    likes: 89,
    caption: "Low tide reveals a different island every morning.",
    comments: 6,
    time: "5 hours ago"
  },
  {
    id: 3,
    name: "Priya Nair",
    place: "Jaisalmer, India",
    text: "Slept under more stars last night than I've seen all year in the city. Writing this from a dune with sand still in my notebook.",
    likes: 47,
    comments: 3,
    time: "Yesterday"
  },
  {
    id: 4,
    name: "Tomas Vural",
    place: "Cappadocia, Türkiye",
    media: [{kind:"trail"}, {kind:"ridge"}],
    likes: 132,
    caption: "Balloons at dawn, then straight back to bed. No regrets.",
    comments: 9,
    time: "2 days ago"
  }
];

const trends = [
  {name:"Hallstatt, Austria", count:"1.2k journals", kind:"coast"},
  {name:"Salar de Uyuni, Bolivia", count:"940 journals", kind:"desert"},
  {name:"Faroe Islands", count:"812 journals", kind:"ridge"}
];

function heartIcon(filled){
  return filled
    ? `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-7.5-4.6-10-9.3C.4 8.4 2 5 5.4 5c2 0 3.5 1 4.6 2.6C11.1 6 12.6 5 14.6 5 18 5 19.6 8.4 22 11.7 19.5 16.4 12 21 12 21Z"/></svg>`
    : `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"><path d="M12 21s-7.5-4.6-10-9.3C.4 8.4 2 5 5.4 5c2 0 3.5 1 4.6 2.6C11.1 6 12.6 5 14.6 5 18 5 19.6 8.4 22 11.7 19.5 16.4 12 21 12 21Z"/></svg>`;
}
function commentIcon(){
  return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" stroke-linecap="round"><path d="M21 12a8 8 0 1 1-3.4-6.5L21 4l-1 4.2A7.9 7.9 0 0 1 21 12Z"/></svg>`;
}
function pinIcon(){
  return `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a6 6 0 0 0-6 6c0 4.5 6 12 6 12s6-7.5 6-12a6 6 0 0 0-6-6Zm0 8.2A2.2 2.2 0 1 1 12 5.8a2.2 2.2 0 0 1 0 4.4Z"/></svg>`;
}
function bookmarkIcon(filled){
  return filled
    ? `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M6 2h12a1 1 0 0 1 1 1v19l-7-4.5L5 22V3a1 1 0 0 1 1-1Z"/></svg>`
    : `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"><path d="M6 2h12a1 1 0 0 1 1 1v19l-7-4.5L5 22V3a1 1 0 0 1 1-1Z"/></svg>`;
}
function moreIcon(){
  return `<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><circle cx="5" cy="12" r="1.6"/><circle cx="12" cy="12" r="1.6"/><circle cx="19" cy="12" r="1.6"/></svg>`;
}

function renderPost(p){
  const mediaHtml = p.media ? `
    <div class="post-media ${p.media.length > 1 ? 'multi' : 'single'}">
      ${p.media.map(m => `<div class="media-slide">${svgScene(m.kind)}</div>`).join('')}
    </div>
    ${p.media.length > 1 ? `<div class="dots">${p.media.map((_,i)=>`<span class="dot ${i===0?'active':''}"></span>`).join('')}</div>` : ''}
  ` : '';

  const bodyHtml = p.text
    ? `<div class="text-post">${p.text}</div>`
    : `<div class="post-body">
        <div class="likes-line" data-likes>${p.likes} likes</div>
        <div class="caption"><span class="cap-name">${p.name.split(' ')[0]}</span>${p.caption}</div>
        <div class="view-comments">View all ${p.comments} comments</div>
        <div class="timestamp">${p.time}</div>
      </div>`;

  return `
    <article class="post" data-id="${p.id}">
      <div class="post-head">
        <span class="avatar-img">${personSvg()}</span>
        <div class="who">
          <div class="name">${p.name}</div>
          <div class="place">${pinIcon()}${p.place}</div>
        </div>
        <button class="more-btn" aria-label="More options">${moreIcon()}</button>
      </div>
      ${mediaHtml}
      <div class="post-actions">
        <button class="action-btn like-btn" aria-label="Like">
          ${heartIcon(false)}
          <span>${p.text ? p.likes : ''}</span>
        </button>
        <button class="action-btn" aria-label="Comment">
          ${commentIcon()}
          <span>${p.comments}</span>
        </button>
        <div class="spacer"></div>
        <button class="action-btn save-btn" aria-label="Save">${bookmarkIcon(false)}</button>
      </div>
      ${p.text ? `<div style="padding:0 14px 16px; font-size:11px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.4px;">${p.time}</div>` : ''}
    </article>
  `;
}

document.getElementById('feed').innerHTML = posts.map(renderPost).join('');

document.getElementById('trend-list').innerHTML = trends.map(t => `
  <div class="trend-row">
    <div class="trend-thumb">${svgScene(t.kind)}</div>
    <div>
      <div class="trend-name">${t.name}</div>
      <div class="trend-count">${t.count}</div>
    </div>
  </div>
`).join('');

document.querySelectorAll('.post').forEach(post => {
  const likeBtn = post.querySelector('.like-btn');
  const saveBtn = post.querySelector('.save-btn');
  const likesLine = post.querySelector('[data-likes]');
  const isTextPost = !likesLine;
  let liked = false;
  let saved = false;
  const baseLikes = parseInt((likesLine ? likesLine.textContent : likeBtn.querySelector('span').textContent) || '0', 10);

  likeBtn.addEventListener('click', () => {
    liked = !liked;
    likeBtn.classList.toggle('liked', liked);
    likeBtn.classList.remove('pulse');
    void likeBtn.offsetWidth;
    if(liked) likeBtn.classList.add('pulse');
    likeBtn.innerHTML = heartIcon(liked) + (isTextPost ? `<span>${baseLikes + (liked?1:0)}</span>` : '<span></span>');
    if(likesLine){
      likesLine.textContent = `${baseLikes + (liked?1:0)} likes`;
    }
  });

  saveBtn.addEventListener('click', () => {
    saved = !saved;
    saveBtn.classList.toggle('saved', saved);
    saveBtn.innerHTML = bookmarkIcon(saved);
  });

  const dots = post.querySelectorAll('.dot');
  const mediaTrack = post.querySelector('.post-media');
  if(mediaTrack && dots.length){
    mediaTrack.addEventListener('scroll', () => {
      const idx = Math.round(mediaTrack.scrollLeft / mediaTrack.clientWidth);
      dots.forEach((d,i) => d.classList.toggle('active', i === idx));
    });
  }
});
</script>

</body>
</html>
