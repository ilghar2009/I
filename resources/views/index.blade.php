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
  :root {
    /* Transitions for a smooth theme swap */
    --theme-transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;

    /* Dark Theme (Default) */
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
    --avatar-bg: #2A2D20;
    --danger: #e74c3c;
  }

  /* Light Theme Overrides */
  [data-theme="light"] {
    --bg: #F9F9F6;
    --surface: #FFFFFF;
    --surface-raised: #F2F1EC;
    --hairline: rgba(13,15,12,0.08);
    --hairline-strong: rgba(13,15,12,0.16);
    --text-primary: #1C1F14;
    --text-secondary: #6E6C61;
    --text-muted: #A6A497;
    --amber: #D9822B;
    --avatar-bg: #EAE9E2;
  }

  *{ box-sizing: border-box; margin:0; padding:0; }

  html{ background: var(--bg); transition: var(--theme-transition); }

  body{
    background: var(--bg);
    color: var(--text-primary);
    font-family: var(--font-sans);
    -webkit-font-smoothing: antialiased;
    min-height: 100vh;
    transition: var(--theme-transition);
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
    background: var(--bg);
    opacity: 0.96;
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--hairline);
    padding: 12px;
    transition: var(--theme-transition);
  }

  .topbar-inner{
    max-width: var(--max-feed);
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 8px; /* Reduced gap for better mobile fit */
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
    gap: 8px;
    background: var(--surface);
    border: 1px solid var(--hairline);
    border-radius: var(--radius-pill);
    padding: 8px 12px;
    color: var(--text-muted);
    transition: var(--theme-transition);
    min-width: 0; /* Ensures it shrinks on mobile */
  }

  .search-wrap svg{ flex-shrink:0; opacity:0.7; width: 16px; height: 16px; }

  .search-wrap input{
    all: unset;
    flex: 1;
    font-size: 14px;
    color: var(--text-primary);
    min-width: 0;
  }
  .search-wrap input::placeholder{ color: var(--text-muted); }

  /* Create Post Button */
  .create-post-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    background: var(--amber);
    color: #0D0F0C;
    padding: 8px 14px;
    border-radius: var(--radius-pill);
    font-weight: 600;
    font-size: 14px;
    transition: opacity 0.2s;
    text-decoration: none;
    flex-shrink: 0;
  }
  .create-post-btn:hover {
    opacity: 0.85;
  }
  
  /* Hide text on small screens, keep icon */
  .create-text { display: none; }

  /* Theme Toggle Button Style */
  .theme-toggle-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: var(--surface);
    border: 1px solid var(--hairline);
    border-radius: 50%;
    color: var(--text-secondary);
    transition: var(--theme-transition);
    flex-shrink: 0;
  }
  .theme-toggle-btn:hover {
    color: var(--text-primary);
    border-color: var(--hairline-strong);
  }
  .theme-toggle-btn .sun-icon { display: none; }
  [data-theme="light"] .theme-toggle-btn .moon-icon { display: none; }
  [data-theme="light"] .theme-toggle-btn .sun-icon { display: block; }

  .profile-chip{
    display:flex;
    align-items:center;
    gap:8px;
    background: var(--surface);
    border: 1px solid var(--hairline);
    border-radius: var(--radius-pill);
    padding: 6px 14px 6px 6px;
    flex-shrink: 0;
    transition: var(--theme-transition);
  }

  /* Hide 'You' text on small mobile devices to save space */
  .profile-name { display: none; }

  .avatar-ring{
    position: relative;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    flex-shrink: 0;
  }
  .avatar-ring svg{ position:absolute; inset:0; transform: rotate(-90deg); width: 100%; height: 100%;}
  .avatar-ring .avatar-img{
    position:absolute;
    inset: 2px;
    border-radius: 50%;
    background: var(--avatar-bg);
    display:flex;
    align-items:center;
    justify-content:center;
    overflow: hidden;
    transition: var(--theme-transition);
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
    padding: 16px 12px 60px;
    display: flex;
    flex-direction: column;
    gap: 16px;
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
    transition: var(--theme-transition), opacity 0.3s ease, transform 0.3s ease;
  }
  
  .post.deleting {
    opacity: 0;
    transform: scale(0.95);
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
    background: var(--avatar-bg);
    transition: var(--theme-transition);
  }

  .post-head .who{ flex:1; min-width:0; }
  .post-head .name{ font-size: 14px; font-weight: 500; }
  .post-head .place{
    display:flex; align-items:center; gap:4px;
    font-size: 12px; color: var(--text-secondary);
    margin-top: 1px;
  }
  .post-head .place svg{ width:11px; height:11px; flex-shrink:0; color: var(--amber); }

  /* Delete button styling */
  .delete-btn{ 
    color: var(--text-muted); 
    padding: 6px; 
    border-radius: 50%;
    transition: color 0.15s ease, background 0.15s ease;
  }
  .delete-btn:hover { 
    color: var(--danger);
    background: rgba(231, 76, 60, 0.1);
  }

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
    cursor: pointer;
    user-select: none;
  }
  .view-comments:hover{ color: var(--text-secondary); }
  
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

  /* ---------- Comments System styles ---------- */
  .comments-section {
    display: none;
    padding: 12px 14px;
    border-top: 1px solid var(--hairline);
    background: rgba(242, 241, 236, 0.02);
    transition: var(--theme-transition);
  }
  .comments-section.active {
    display: block;
  }
  .comments-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-height: 220px;
    overflow-y: auto;
    padding-right: 4px;
  }
  .comments-container::-webkit-scrollbar {
    width: 4px;
  }
  .comments-container::-webkit-scrollbar-thumb {
    background: var(--hairline-strong);
    border-radius: var(--radius-pill);
  }
  .comment-item {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    font-size: 13px;
    line-height: 1.4;
    padding: 2px 0;
  }
  .comment-item-body {
    color: var(--text-primary);
  }
  .comment-user {
    font-weight: 600;
    margin-right: 6px;
    color: var(--text-primary);
  }
  .comment-text {
    color: var(--text-secondary);
  }
  .comment-like-btn {
    display: flex;
    align-items: center;
    gap: 4px;
    color: var(--text-muted);
    cursor: pointer;
    font-size: 11px;
    transition: color 0.15s ease;
  }
  .comment-like-btn:hover {
    color: var(--text-secondary);
  }
  .comment-like-btn.liked {
    color: var(--amber);
  }
  .comment-like-btn svg {
    width: 12px;
    height: 12px;
  }
  .comment-form {
    display: flex;
    gap: 10px;
    margin-top: 12px;
    border-top: 1px solid var(--hairline);
    padding-top: 10px;
  }
  .comment-input {
    flex: 1;
    background: var(--surface-raised);
    border: 1px solid var(--hairline);
    border-radius: var(--radius-pill);
    padding: 8px 14px;
    font-size: 13px;
    color: var(--text-primary);
    transition: var(--theme-transition);
  }
  .comment-input:focus {
    outline: none;
    border-color: var(--hairline-strong);
  }
  .comment-submit {
    font-size: 13px;
    font-weight: 500;
    color: var(--amber);
    padding: 0 4px;
    transition: opacity 0.15s ease;
  }
  .comment-submit:hover {
    opacity: 0.8;
  }

  /* ---------- Rail cards (desktop) ---------- */
  .rail-card{
    background: var(--surface);
    border: 1px solid var(--hairline);
    border-radius: var(--radius-card);
    padding: 16px;
    margin-bottom: 16px;
    transition: var(--theme-transition);
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

  @media (min-width: 480px){
    .create-text { display: inline; }
    .create-post-btn { padding: 8px 16px; }
    .profile-name { display: inline; }
    .avatar-ring{ width: 30px; height: 30px; }
    .avatar-ring .avatar-img{ inset: 3px; }
  }

  @media (min-width: 640px){
    .brand{ display:block; }
    main.feed{ padding-top: 28px; }
  }

  @media (min-width: 860px){
    header.topbar{ padding: 16px 32px; }
    .topbar-inner{ max-width: 1096px; gap: 12px; }
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
    .post { transition: none; }
  }
</style>
</head>
<body>

<header class="topbar">
  <div class="topbar-inner">
    <span class="brand">Waypoint</span>
    <div class="search-wrap">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
      <input type="text" placeholder="Search places, people">
    </div>
    
    <a href="#create" class="create-post-btn" aria-label="Create Post">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
      <span class="create-text">Create</span>
    </a>

    <button class="theme-toggle-btn" id="theme-toggle" aria-label="Toggle theme">
      <svg class="moon-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
      <svg class="sun-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="18.36" x2="5.64" y2="19.78"></line><line x1="18.36" y1="4.22" x2="19.78" y2="4.22"></line></svg>
    </button>

    <div class="profile-chip">
      <span class="avatar-ring">
        <svg width="30" height="30" viewBox="0 0 30 30"><circle cx="15" cy="15" r="13" fill="none" stroke="var(--hairline-strong)" stroke-width="2"/><circle cx="15" cy="15" r="13" fill="none" stroke="var(--amber)" stroke-width="2" stroke-linecap="round" stroke-dasharray="81.6" stroke-dashoffset="24"/></svg>
        <span class="avatar-img"><svg width="16" height="16" viewBox="0 0 24 24" fill="var(--text-muted)"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg></span>
      </span>
      <span class="profile-name">You</span>
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
    time: "2 hours ago",
    commentsList: [
      { author: "Sina", text: "Incredible scale! Added to my wish list.", likes: 8 },
      { author: "Chloe", text: "Was it windy up there?", likes: 3 }
    ]
  },
  {
    id: 2,
    name: "Kofi Owusu",
    place: "Zanzibar, Tanzania",
    media: [{kind:"coast"}, {kind:"trail"}],
    likes: 89,
    caption: "Low tide reveals a different island every morning.",
    time: "5 hours ago",
    commentsList: [
      { author: "Liam", text: "Zanzibar has the absolute best waters.", likes: 11 }
    ]
  },
  {
    id: 3,
    name: "Priya Nair",
    place: "Jaisalmer, India",
    text: "Slept under more stars last night than I've seen all year in the city. Writing this from a dune with sand still in my notebook.",
    likes: 47,
    time: "Yesterday",
    commentsList: [
      { author: "Deepak", text: "Stargazing there is pure magic.", likes: 5 }
    ]
  },
  {
    id: 4,
    name: "Tomas Vural",
    place: "Cappadocia, Türkiye",
    media: [{kind:"trail"}, {kind:"ridge"}],
    likes: 132,
    caption: "Balloons at dawn, then straight back to bed. No regrets.",
    time: "2 days ago",
    commentsList: []
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
function trashIcon(){
  return `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>`;
}

function renderPost(p){
  const mediaHtml = p.media ? `
    <div class="post-media ${p.media.length > 1 ? 'multi' : 'single'}">
      ${p.media.map(m => `<div class="media-slide">${svgScene(m.kind)}</div>`).join('')}
    </div>
    ${p.media.length > 1 ? `<div class="dots">${p.media.map((_,i)=>`<span class="dot ${i===0?'active':''}"></span>`).join('')}</div>` : ''}
  ` : '';

  const commentsItemsHtml = p.commentsList.map(c => `
    <div class="comment-item">
      <div class="comment-item-body">
        <span class="comment-user">${c.author}</span>
        <span class="comment-text">${c.text}</span>
      </div>
      <button class="comment-like-btn">
        <span class="c-likes-count">${c.likes}</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7.5-4.6-10-9.3C.4 8.4 2 5 5.4 5c2 0 3.5 1 4.6 2.6C11.1 6 12.6 5 14.6 5 18 5 19.6 8.4 22 11.7 19.5 16.4 12 21 12 21Z"/></svg>
      </button>
    </div>
  `).join('');

  const bodyHtml = p.text
    ? `<div class="text-post">${p.text}</div>`
    : `<div class="post-body">
        <div class="likes-line" data-likes>${p.likes} likes</div>
        <div class="caption"><span class="cap-name">${p.name.split(' ')[0]}</span>${p.caption}</div>
        <div class="view-comments js-comment-toggle">View all <span class="comments-counter">${p.commentsList.length}</span> comments</div>
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
        <button class="delete-btn" aria-label="Delete post">${trashIcon()}</button>
      </div>
      ${mediaHtml}
      <div class="post-actions">
        <button class="action-btn like-btn" aria-label="Like">
          ${heartIcon(false)}
          <span>${p.text ? p.likes : ''}</span>
        </button>
        <button class="action-btn comment-btn js-comment-toggle" aria-label="Comment">
          ${commentIcon()}
          <span class="comments-counter">${p.commentsList.length}</span>
        </button>
        <div class="spacer"></div>
        <button class="action-btn save-btn" aria-label="Save">${bookmarkIcon(false)}</button>
      </div>
      ${p.text ? `<div class="js-comment-toggle" style="padding:0 14px 4px; font-size:13px; color:var(--text-muted); cursor:pointer; user-select:none;">View all <span class="comments-counter">${p.commentsList.length}</span> comments</div><div style="padding:0 14px 16px; font-size:11px; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.4px;">${p.time}</div>` : bodyHtml}
      
      <div class="comments-section">
        <div class="comments-container">
          ${commentsItemsHtml}
        </div>
        <form class="comment-form">
          <input type="text" class="comment-input" placeholder="Add a comment..." required>
          <button type="submit" class="comment-submit">Post</button>
        </form>
      </div>
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
  const deleteBtn = post.querySelector('.delete-btn');
  const likesLine = post.querySelector('[data-likes]');
  const isTextPost = !likesLine;
  let liked = false;
  let saved = false;
  const baseLikes = parseInt((likesLine ? likesLine.textContent : likeBtn.querySelector('span').textContent) || '0', 10);

  // New Delete Action
  deleteBtn.addEventListener('click', () => {
    // Add visual feedback before removing
    post.classList.add('deleting');
    setTimeout(() => {
      post.remove();
    }, 300); // Matches the CSS transition time
  });

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

  // Toggle Comments Area
  const commentsSection = post.querySelector('.comments-section');
  post.querySelectorAll('.js-comment-toggle').forEach(trigger => {
    trigger.addEventListener('click', () => {
      commentsSection.classList.toggle('active');
    });
  });

  // Comment Like Handler Logic
  const initCommentLike = (commentEl) => {
    const cLikeBtn = commentEl.querySelector('.comment-like-btn');
    if(!cLikeBtn) return;
    
    let cLiked = false;
    const cLikesCount = cLikeBtn.querySelector('.c-likes-count');
    const startLikes = parseInt(cLikesCount.textContent, 10);

    cLikeBtn.addEventListener('click', () => {
      cLiked = !cLiked;
      cLikeBtn.classList.toggle('liked', cLiked);
      const svg = cLikeBtn.querySelector('svg');
      if(cLiked) {
        svg.setAttribute('fill', 'currentColor');
        cLikesCount.textContent = startLikes + 1;
      } else {
        svg.setAttribute('fill', 'none');
        cLikesCount.textContent = startLikes;
      }
    });
  };

  // Initialize existing comments
  post.querySelectorAll('.comment-item').forEach(initCommentLike);

  // Submit New Comment Form Handler
  const cForm = post.querySelector('.comment-form');
  const cInput = post.querySelector('.comment-input');
  const cContainer = post.querySelector('.comments-container');
  const cCounters = post.querySelectorAll('.comments-counter');

  cForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const textStr = cInput.value.trim();
    if(!textStr) return;

    const newComment = document.createElement('div');
    newComment.className = 'comment-item';
    newComment.innerHTML = `
      <div class="comment-item-body">
        <span class="comment-user">You</span>
        <span class="comment-text">${textStr}</span>
      </div>
      <button class="comment-like-btn">
        <span class="c-likes-count">0</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7.5-4.6-10-9.3C.4 8.4 2 5 5.4 5c2 0 3.5 1 4.6 2.6C11.1 6 12.6 5 14.6 5 18 5 19.6 8.4 22 11.7 19.5 16.4 12 21 12 21Z"/></svg>
      </button>
    `;

    initCommentLike(newComment);
    cContainer.appendChild(newComment);
    cInput.value = '';
    cContainer.scrollTop = cContainer.scrollHeight;

    // Increment overall post counters
    cCounters.forEach(cnt => {
      cnt.textContent = parseInt(cnt.textContent, 10) + 1;
    });
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

// ---------- Theme Switching Logic ----------
const themeToggle = document.getElementById('theme-toggle');
themeToggle.addEventListener('click', () => {
  const currentTheme = document.documentElement.getAttribute('data-theme');
  if (currentTheme === 'light') {
    document.documentElement.removeAttribute('data-theme');
  } else {
    document.documentElement.setAttribute('data-theme', 'light');
  }
});
</script>

</body>
</html>