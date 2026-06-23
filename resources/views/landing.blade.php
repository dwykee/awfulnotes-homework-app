<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awfulnotes — Less stress. More done.</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&family=Geist+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

    @vite(['resources/css/landing.css'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --brand-white:       #ffffff;
            --brand-lime:        #ffdad4;
            --brand-green:       #7a0000;
            --brand-orange:      #d10000;
            --brand-blue:        #a30000;
            --brand-grey:        #936e69;
            --brand-almost-black:#141d23;
            --background:        #ecf5fe;
            --type:              #141d23;
            --type-light:        #f6faff;
            --type-60:           rgba(20,29,35,.6);
            --type-light-60:     rgba(246,250,255,.55);
            --spacing-xs: 8px;
            --spacing-sm: 16px;
            --spacing-md: 24px;
            --spacing-lg: 40px;
            --spacing-xl: 60px;
            --spacing-2xl: 80px;
            --radius-sm: 10px;
            --radius-md: 14px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-2xl: 30px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Geist', system-ui, sans-serif;
            background: #0d1117;
            color: var(--brand-white);
            overflow-x: hidden;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        a { text-decoration: none; color: inherit; }

        /* ─── NAV ─────────────────────────────────── */
        .menu {
            position: fixed;
            top: 10px; left: 12px; right: 12px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 20px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,.12);
            z-index: 1000;
            background: transparent;
            transition: background .3s ease, border-color .3s ease;
        }
        .menu.is-scrolled {
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-color: rgba(255,255,255,.25);
        }
        .menu-logo a { display: flex; align-items: center; }
        .menu-logo-text {
            font-size: 18px; font-weight: 600; letter-spacing: -.03em; color: #fff;
        }
        .menu-logo-text em { color: #a30000; font-style: normal; }
        .menu-links { display: flex; gap: 4px; align-items: center; }
        .menu-link {
            font-size: 14px; font-weight: 400; color: rgba(255,255,255,.7);
            padding: 7px 14px; border-radius: 8px;
            transition: color .2s, background .2s;
        }
        .menu-link:hover { color: #fff; background: rgba(255,255,255,.07); }
        .menu-actions { display: flex; align-items: center; gap: 12px; }
        .menu-login {
            font-size: 14px; font-weight: 500; color: rgba(255,255,255,.7);
            transition: color .2s;
        }
        .menu-login:hover { color: #fff; }

        /* ─── CTA BUTTON (exact MonoDesk style) ─── */
        .cta-btn {
            font-family: 'Geist', sans-serif;
            font-size: 14px; font-weight: 500;
            padding: 8px 16px;
            background: #d10000;
            color: #fff;
            border: none; border-radius: 10px;
            display: inline-flex; align-items: center; justify-content: center; gap: 6px;
            cursor: pointer; white-space: nowrap;
            height: 40px; min-width: 160px;
            position: relative; overflow: hidden; z-index: 1;
            transition: box-shadow .3s ease; text-decoration: none;
        }
        .cta-btn::before {
            content: '';
            position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: #7a0000;
            transition: left .4s ease; z-index: -1; border-radius: 10px;
        }
        .cta-btn:hover { box-shadow: 0 4px 12px rgba(0,0,0,.2); color: #ffdad4; }
        .cta-btn:hover::before { left: 0; }
        .cta-btn svg { width: 16px; height: 16px; stroke-width: 2; position: relative; z-index: 2; }
        .cta-btn-secondary {
            background: rgba(255,255,255,.15) !important;
            color: #fff !important;
            backdrop-filter: blur(8px);
        }
        .cta-btn-secondary::before { background: rgba(255,255,255,.25) !important; }
        .cta-btn-secondary:hover { color: #fff !important; }

        /* ─── HERO ─────────────────────────────────── */
        .section-hero {
            background: #0d0608;
            color: #fff;
            padding: 180px 0 120px;
            position: relative;
            z-index: 0;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        /* Layer 1: SVG noise texture — adds grain depth like MonoDesk's studio photo */
        .section-hero::before {
            content: '';
            position: absolute; inset: 0 0 0 -15%;
            width: 115%;
            background:
                radial-gradient(ellipse 90% 80% at 10% 15%, rgba(130,0,0,.55) 0%, transparent 60%),
                radial-gradient(ellipse 100% 100% at 50% 50%, rgba(10,3,6,.85) 0%, rgba(5,1,8,.95) 100%),
                url('/images/hero-bg.jpg') right center / cover no-repeat;
            z-index: -1;
            pointer-events: none;
        }
        /* Layer 3: subtle dot grid overlay */
        .hero-bg-grid {
            position: absolute; inset: 0; pointer-events: none; z-index: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,.1) 1px, transparent 1px);
            background-size: 30px 30px;
            mask-image: radial-gradient(ellipse 75% 65% at 50% 45%, black 5%, transparent 70%);
        }
        .section-hero > * { position: relative; z-index: 1; }
        .hero-content {
            display: flex;
            align-items: flex-start;
            padding-left: max(60px, calc((100vw - 1320px) / 4 + 60px));
            padding-right: max(60px, calc((100vw - 1320px) / 4 + 60px));
        }
        .hero-text { max-width: 700px; display: flex; flex-direction: column; align-items: flex-start; }
        .pill-tag {
            display: inline-block;
            background: transparent;
            color: rgba(255,255,255,1);
            font-family: 'Geist Mono', monospace;
            font-weight: 500; font-size: 14px;
            padding: 6px 0;
            border-radius: 6px;
            margin-bottom: 12px;
            opacity: .4;
            text-transform: uppercase;
        }
        .hero-title {
            font-size: 72px; font-weight: 400; line-height: 1.05;
            letter-spacing: -.02em;
            margin-bottom: 24px;
            width: 850px; max-width: 100%;
        }
        .hero-subtitle {
            color: rgba(246,250,255,.75); font-size: 20px; font-weight: 400;
            margin-bottom: 20px; max-width: 480px; line-height: 1.5;
        }
        .hero-cta-row { display: flex; align-items: center; gap: 12px; margin-top: 8px; }
        .hero-fineprint {
            font-family: 'Geist Mono', monospace;
            font-size: 12px; color: #fff; margin-top: 16px; opacity: .8;
        }
        .hero-m-outline {
            position: absolute; bottom: -200px; right: 0;
            width: auto; height: 70%; pointer-events: none; z-index: 0;
            opacity: .06;
            font-size: 600px; font-weight: 800; line-height: 1;
            color: transparent;
            -webkit-text-stroke: 1px rgba(255,255,255,.5);
            user-select: none; letter-spacing: -.1em;
        }

        /* ─── WAVE DIVIDER ─────────────────────────── */
        .section-wave-divider {
            position: relative; z-index: 5;
            margin-top: -2px; line-height: 0;
        }
        .section-wave-divider svg { display: block; width: 100%; }

        /* ─── PAIN SECTION ─────────────────────────── */
        .section-pain {
            background: #ecf5fe;
            padding: 120px 60px;
            position: relative;
            min-height: 600px;
            display: flex;
            align-items: center;
        }
        .pain-container {
            max-width: 1440px; margin: 0 auto;
            display: flex; gap: 120px; align-items: center; width: 100%;
        }
        .pain-bubbles-wrap {
            flex: 1; position: relative; height: 400px; max-width: 650px;
        }
        .pain-bubble {
            position: absolute;
            background: #1a1a1a; color: rgba(255,255,255,.9);
            padding: 14px 24px; border-radius: 100px;
            font-size: 14px; font-weight: 400; white-space: nowrap;
            display: inline-flex; align-items: center; gap: 10px;
            letter-spacing: -.2px;
        }
        .pain-text-block { max-width: 480px; position: relative; z-index: 2; }
        .pain-m-logo {
            font-size: 22px; font-weight: 800; color: #a30000; margin-bottom: 16px;
            font-family: 'Geist', sans-serif; letter-spacing: -.03em;
        }
        .pain-m-logo img {
            height: 48px;     
            width: auto;     
            object-fit: contain; 
            display: block;
        }
        .pain-title {
            font-size: 32px; font-weight: 500; color: var(--brand-almost-black);
            margin-bottom: 24px; line-height: 1.2; letter-spacing: -.02em; margin-top: 24px;
        }
        .pain-subtitle { font-size: 16px; line-height: 1.5; color: #161616; }
        .pain-subtitle strong { font-weight: 500; }
        .pain-cta-link { display: inline-block; margin-top: 32px; }
        .pain-cta {
            font-family: 'Geist', sans-serif; font-size: 14px; font-weight: 500;
            padding: 8px 18px; background: #d10000; color: #fff;
            border-radius: 10px; display: inline-flex; align-items: center; gap: 6px;
            transition: opacity .2s; height: 40px;
        }
        .pain-cta:hover { opacity: .85; }

        /* ─── STACKING FOLDER CARDS ────────────────── */
        .stacking-cards-container { 
            background-color: #ecf5fe !important;

        }
        .stacking-card {
            position: sticky; top: 0;
            height: 100vh; min-height: 600px;
            display: flex; align-items: flex-start; justify-content: center;
            padding-top: 0;
            background-color: transparent;
        }
        .folder-wrapper {
            position: relative;
            width: calc(100vw - 40px);
            max-width: 1400px;
            height: 100%;
            background: transparent;
            overflow: hidden;
        }
        /* The unique folder SVG shape - same path as MonoDesk */
        .folder-shape-bg {
            position: absolute; top: 0; left: 0;
            width: 100%; height: 100%; z-index: 0; pointer-events: none;
            background: transparent;
        }
        .folder-wrapper > *:not(.folder-shape-bg) { position: relative; z-index: 1; }

        /* Folder header/tab area */
        .folder-header-bar {
            width: 100%; padding: 0;
            display: flex; align-items: flex-end; justify-content: flex-start;
            height: 100px;
            background: transparent;
        }
        .folder-tab-label {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 22px; border-radius: 10px 10px 0 0;
            font-size: 13px; font-weight: 600; letter-spacing: .04em;
            margin-left: 60px; margin-bottom: 0;
            background: transparent !important;
            border-color: transparent !important;
            color: rgba(246,250,255,.9) !important;
        }

        /* Folder inner hero */
        .folder-hero {
            display: flex; align-items: flex-start; justify-content: space-between;
            padding: 40px 60px 0 60px; gap: 40px;
            height: calc(100% - 100px);
        }
        .folder-text { max-width: 420px; flex-shrink: 0; padding-top: 20px; }
        .folder-card-title {
            font-size: 52px; font-weight: 500; line-height: 1.0;
            letter-spacing: -.03em; margin-bottom: 14px;
        }
        .folder-card-h4 {
            font-size: 18px; font-weight: 400; margin-bottom: 16px; line-height: 1.4;
            opacity: .75;
        }
        .folder-card-body {
            font-size: 15px; font-weight: 400; line-height: 1.6; opacity: .65;
        }
        .folder-visual { flex: 1; position: relative; overflow: hidden; }

        /* ─── APP MOCKUP ────────────────────────────── */
        .app-mockup {
            background: rgba(0,0,0,.2);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 14px; overflow: hidden;
            box-shadow: 0 24px 48px rgba(0,0,0,.3);
            max-width: 640px;
        }
        .app-bar {
            background: rgba(0,0,0,.25); border-bottom: 1px solid rgba(255,255,255,.1);
            padding: 11px 16px; display: flex; align-items: center; gap: 7px;
        }
        .app-dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(255,255,255,.2); }
        .app-url {
            background: rgba(255,255,255,.08); border-radius: 5px;
            padding: 3px 12px; font-size: 11px; color: rgba(255,255,255,.4);
            font-family: 'Geist Mono', monospace; max-width: 240px;
        }
        .app-layout { display: grid; grid-template-columns: 190px 1fr; min-height: 280px; }
        .app-side { border-right: 1px solid rgba(255,255,255,.08); padding: 16px; display: flex; flex-direction: column; gap: 3px; }
        .app-side-lbl { font-size: 10px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: rgba(255,255,255,.25); margin: 8px 0 5px; }
        .app-side-item {
            padding: 7px 10px; border-radius: 7px; font-size: 12px; color: rgba(255,255,255,.5);
            display: flex; align-items: center; gap: 7px; cursor: pointer; transition: background .1s;
        }
        .app-side-item:hover { background: rgba(255,255,255,.05); }
        .app-side-item.active { background: rgba(163,0,0,.25); color: #ffdad4; }
        .app-side-cta {
            margin-top: auto; background: #d10000; border-radius: 7px;
            padding: 8px 10px; text-align: center; font-size: 12px; font-weight: 600; color: #fff; cursor: pointer;
        }
        .app-main { padding: 16px; display: flex; flex-direction: column; gap: 8px; }
        .status-pills { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 4px; }
        .sp { padding: 3px 10px; border-radius: 100px; font-size: 10px; font-weight: 600; }
        .sp-todo { background: rgba(59,130,246,.18); color: #93c5fd; }
        .sp-prog { background: rgba(245,158,11,.18); color: #fcd34d; }
        .sp-done { background: rgba(16,185,129,.18); color: #6ee7b7; }
        .sp-late { background: rgba(239,68,68,.18); color: #fca5a5; }
        .task-row {
            background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);
            border-radius: 8px; padding: 10px 13px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .task-name { font-size: 12px; font-weight: 500; color: #fff; }
        .task-meta { font-size: 10px; color: rgba(255,255,255,.4); margin-top: 1px; }
        .t-badge { padding: 2px 8px; border-radius: 100px; font-size: 9px; font-weight: 600; }
        .b-late { background: rgba(239,68,68,.18); color: #fca5a5; }
        .b-prog { background: rgba(245,158,11,.18); color: #fcd34d; }
        .b-todo { background: rgba(59,130,246,.18); color: #93c5fd; }
        .b-done { background: rgba(16,185,129,.18); color: #6ee7b7; }

        /* Dashboard mockup */
        .dash-mockup {
            max-width: 720px;
            background: rgba(0,0,0,.2);
            color: #fff;
            border-color: rgba(255,255,255,.15);
            box-shadow: 0 26px 70px rgba(0,0,0,.28);
        }
        .dash-topbar {
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            padding: 14px 18px; border-bottom: 1px solid rgba(255,255,255,.1); background: rgba(0,0,0,.25);
        }
        .dash-brand { display: flex; align-items: center; gap: 10px; min-width: 0; }
        .dash-logo {
            width: 30px; height: 30px; border-radius: 8px;
            background: linear-gradient(135deg, #800020, #a0002a);
            color: #fff; display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 14px;
        }
        .dash-brand-name { font-size: 13px; font-weight: 900; letter-spacing: -.03em; line-height: 1; color: #fff; }
        .dash-brand-sub { font-size: 8px; color: rgba(255,218,212,.82); font-weight: 700; letter-spacing: .08em; margin-top: 3px; }
        .dash-stats { display: flex; gap: 12px; align-items: baseline; }
        .dash-stat { display: flex; align-items: baseline; gap: 3px; white-space: nowrap; }
        .dash-stat strong { font-size: 18px; line-height: 1; color: #fff; }
        .dash-stat span { font-size: 9px; color: rgba(255,255,255,.5); font-weight: 700; }
        .dash-search {
            min-width: 140px; padding: 7px 12px; border-radius: 999px;
            background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.1);
            color: rgba(255,255,255,.55); font-size: 11px;
        }
        .dash-body { display: grid; grid-template-columns: 155px 1fr; min-height: 360px; background: transparent; }
        .dash-sidebar {
            border-right: 1px solid rgba(255,255,255,.08); padding: 16px 0;
            display: flex; flex-direction: column; gap: 2px;
        }
        .dash-side-title {
            padding: 0 16px 8px; font-size: 9px; color: rgba(255,255,255,.28);
            text-transform: uppercase; letter-spacing: .12em; font-weight: 900;
        }
        .dash-side-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 8px 14px; border-left: 3px solid transparent;
            font-size: 12px; color: rgba(255,255,255,.55);
        }
        .dash-side-item.active { background: rgba(163,0,0,.25); border-left-color: #ffdad4; color: #ffdad4; font-weight: 800; }
        .dash-side-count { font-size: 10px; background: rgba(255,255,255,.08); color: rgba(255,255,255,.56); padding: 1px 7px; border-radius: 999px; font-weight: 700; }
        .dash-main { padding: 18px; background: transparent; }
        .dash-alert {
            display: flex; gap: 9px; align-items: center;
            padding: 10px 12px; border-radius: 12px;
            background: rgba(245,158,11,.16);
            border: 1px solid rgba(245,158,11,.24); color: #fcd34d; margin-bottom: 14px;
        }
        .dash-alert strong { display: block; font-size: 12px; }
        .dash-alert span { display: block; font-size: 10px; color: rgba(252,211,77,.72); margin-top: 1px; }
        .dash-heading { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 12px; }
        .dash-heading h3 { font-size: 17px; color: #fff; margin: 0; font-weight: 900; }
        .dash-heading p { font-size: 11px; color: rgba(255,255,255,.48); margin: 2px 0 0; }
        .dash-actions { display: flex; gap: 8px; }
        .dash-chip {
            border-radius: 10px; border: 1px solid rgba(255,255,255,.12); padding: 7px 10px;
            font-size: 11px; font-weight: 800; color: #ffdad4; background: rgba(255,255,255,.06);
        }
        .dash-chip.primary { border-color: #d10000; background: #d10000; color: #fff; }
        .dash-cards { display: grid; grid-template-columns: repeat(2,minmax(0,1fr)); gap: 10px; }
        .dash-card {
            border: 1px solid rgba(255,255,255,.1); border-radius: 12px; padding: 12px;
            background: rgba(255,255,255,.04);
            box-shadow: 0 4px 18px rgba(0,0,0,.12);
        }
        .dash-card-title { font-size: 13px; color: #fff; font-weight: 850; margin-bottom: 5px; }
        .dash-card-meta { font-size: 10px; color: rgba(255,255,255,.45); margin-bottom: 10px; }
        .dash-card-foot { display: flex; align-items: center; justify-content: space-between; gap: 8px; }
        .dash-progress {
            height: 6px; flex: 1; border-radius: 999px; background: rgba(255,255,255,.08); overflow: hidden;
        }
        .dash-progress span { display: block; height: 100%; border-radius: inherit; background: #ffdad4; }
        .team-mockup { max-width: 560px; background: rgba(0,0,0,.2); color: #fff; border-color: rgba(255,255,255,.15); }
        .team-panel-head {
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            padding: 18px 20px; border-bottom: 1px solid rgba(255,255,255,.1); background: rgba(0,0,0,.25);
        }
        .team-panel-title { display: flex; align-items: center; gap: 12px; }
        .team-icon {
            width: 40px; height: 40px; border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #800020, #a0002a); color: #fff; font-size: 18px;
        }
        .team-panel-title h3 { color: #fff; font-size: 17px; font-weight: 850; margin: 0; }
        .team-panel-title p { color: rgba(255,255,255,.5); font-size: 11px; margin-top: 2px; }
        .team-tabs {
            display: grid; grid-template-columns: repeat(3,1fr); gap: 4px;
            margin: 18px 20px; padding: 4px; border-radius: 10px; background: rgba(255,255,255,.08);
        }
        .team-tab {
            border-radius: 8px; padding: 7px 0; text-align: center;
            font-size: 11px; font-weight: 800; color: rgba(255,218,212,.78);
        }
        .team-tab.active { background: rgba(255,255,255,.14); color: #fff; box-shadow: 0 1px 4px rgba(0,0,0,.12); }
        .team-list { padding: 0 20px 20px; display: flex; flex-direction: column; gap: 12px; }
        .team-card {
            border: 1px solid rgba(255,255,255,.1); border-radius: 12px; padding: 14px;
            background: rgba(255,255,255,.04); box-shadow: 0 4px 18px rgba(0,0,0,.12);
        }
        .team-card-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; margin-bottom: 10px; }
        .team-card-name { font-size: 14px; font-weight: 850; color: #fff; }
        .team-card-meta { font-size: 11px; color: rgba(255,255,255,.45); margin-top: 2px; }
        .team-action {
            border-radius: 999px; padding: 4px 10px; font-size: 10px; font-weight: 800;
            background: rgba(163,0,0,.25); color: #ffdad4; border: 1px solid rgba(255,218,212,.12);
        }
        .team-code {
            display: flex; align-items: center; gap: 8px;
            padding: 8px 10px; border: 1px dashed rgba(255,218,212,.3); border-radius: 8px; background: rgba(255,255,255,.05);
        }
        .team-code span:first-child { font-size: 10px; color: rgba(255,255,255,.45); }
        .team-code strong { flex: 1; font-size: 13px; color: #ffdad4; letter-spacing: .15em; }
        .team-members { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 10px; }
        .team-member {
            padding: 3px 9px; border-radius: 999px; background: rgba(255,255,255,.07);
            color: rgba(255,255,255,.78); border: 1px solid rgba(255,255,255,.1); font-size: 10px; font-weight: 700;
        }

        /* Calendar mockup */
        .cal-grid { display: grid; grid-template-columns: repeat(7,1fr); gap: 6px; }
        .cal-head { font-size: 10px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: rgba(255,255,255,.25); padding-bottom: 8px; border-bottom: 1px solid rgba(255,255,255,.08); text-align: center; }
        .cal-cell { border-radius: 8px; background: rgba(255,255,255,.03); min-height: 70px; padding: 8px; }
        .cal-cell.today { background: rgba(163,0,0,.12); border: 1px solid rgba(163,0,0,.3); }
        .cal-today-lbl { font-size: 9px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: #ffdad4; margin-bottom: 4px; }
        .cal-ev { border-radius: 4px; padding: 3px 6px; font-size: 9px; font-weight: 600; margin-bottom: 3px; }
        .ev-red   { background: rgba(163,0,0,.3); color: #fca5a5; }
        .ev-amber { background: rgba(245,158,11,.2); color: #fcd34d; }
        .ev-blue  { background: rgba(59,130,246,.2); color: #93c5fd; }

        /* Chat mockup */
        .chat-msgs { display: flex; flex-direction: column; gap: 14px; padding: 20px; }
        .chat-row { display: flex; gap: 10px; }
        .chat-row.user { flex-direction: row-reverse; }
        .chat-av { width: 26px; height: 26px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 11px; }
        .av-user { background: rgba(59,130,246,.3); color: #93c5fd; }
        .av-ai   { background: rgba(163,0,0,.3); color: #ffdad4; }
        .chat-bubble { max-width: 300px; padding: 10px 14px; font-size: 12px; font-weight: 400; line-height: 1.55; color: rgba(255,255,255,.8); border-radius: 12px; }
        .bubble-user { background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.1); border-radius: 12px 12px 2px 12px; }
        .bubble-ai { background: rgba(163,0,0,.1); border: 1px solid rgba(163,0,0,.22); border-radius: 12px 12px 12px 2px; }
        .chat-input-bar { border-top: 1px solid rgba(255,255,255,.08); display: flex; }
        .chat-input-bar input { flex: 1; padding: 11px 14px; background: transparent; border: none; outline: none; font-family: 'Geist', sans-serif; font-size: 12px; color: #fff; }
        .chat-input-bar input::placeholder { color: rgba(255,255,255,.2); }
        .chat-send-btn { background: #d10000; border: none; padding: 0 16px; cursor: pointer; display: flex; align-items: center; }
        .chat-send-btn svg { width: 16px; height: 16px; stroke: #fff; stroke-width: 2; fill: none; }

        /* Card spacer */
        .card-spacer { height: 100vh; }

        /* ─── TIMELINE / HOW IT WORKS ──────────────── */
        .timeline-section {
            width: 100%; background: #0d1117;
            padding: 100px 30px 80px;
            position: relative; z-index: 10;
            margin-top: -200px; border-radius: 20px 20px 0 0;
            min-height: 100vh; display: flex; flex-direction: column; justify-content: center;
        }
        .timeline-header-wrapper { text-align: center; margin-bottom: 60px; padding: 0 60px; }
        .section-title { font-size: 36px; font-weight: 600; letter-spacing: -.6px; line-height: 1; color: #e7e7e7; }
        .timeline-container {
            display: grid; grid-template-columns: minmax(0,1fr) minmax(0,1fr);
            gap: 60px; max-width: 1440px; margin: 0 auto;
            align-items: stretch; padding: 0 60px;
        }
        .timeline-media {
            width: 100%; display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            grid-column: 1;
        }
        .timeline-image-wrapper { position: relative; width: 100%; flex: 1; overflow: hidden; background: transparent; }
        .timeline-preview-img {
            position: absolute; top: 0; left: 0;
            width: 100%; height: 100%; object-fit: contain;
            opacity: 0; transform: scale(1.05);
            transition: opacity .6s ease, transform .6s ease;
            border-radius: 10px;
        }
        .timeline-preview-img:not(.active) { position: absolute; top: 0; left: 0; }
        .timeline-preview-img.active { opacity: 1; transform: scale(1); }
        .timeline-dots { display: none; }
        .timeline-dot {
            width: 10px; height: 10px; border-radius: 50%; border: none;
            background: rgba(255,255,255,.3); cursor: pointer; padding: 0;
            transition: background .3s ease, transform .2s ease;
        }
        .timeline-dot:hover { background: rgba(255,255,255,.5); transform: scale(1.2); }
        .timeline-dot.active { background: #d10000; }
        .timeline-content {
            display: flex; flex-direction: column; gap: 48px;
            max-width: none; width: 100%; grid-column: 2;
            justify-self: stretch; align-items: flex-start;
        }
        .timeline-display {
            display: flex; flex-direction: column; gap: 16px; width: 100%;
            min-height: 200px;
        }
        .timeline-display-title {
            font-family: 'Geist', sans-serif; font-size: 56px; font-weight: 400;
            color: #ffffff; letter-spacing: -1.5px; line-height: 1.05;
            margin: 0; min-height: 118px;
        }
        .timeline-display-desc {
            font-family: 'Geist', sans-serif; font-size: 18px; font-weight: 400;
            color: rgba(223,223,223,.65); line-height: 1.6; letter-spacing: -.2px;
            margin: 0; min-height: 58px;
        }
        .timeline-selectors {
            display: flex; flex-direction: column; width: 100%;
            border-top: 1px solid rgba(255,255,255,.1);
        }
        .timeline-selector {
            display: flex; align-items: center; gap: 14px;
            padding: 18px 0; border: none;
            border-bottom: 1px solid rgba(255,255,255,.1);
            background: none; text-align: left; cursor: pointer;
            width: 100%; opacity: .4; transition: opacity .25s ease;
        }
        .timeline-selector:hover, .timeline-selector.active { opacity: 1; }
        .timeline-selector-num {
            width: 28px; height: 28px; background: #5e3f3a; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
            font-family: 'Geist Mono', monospace; font-size: 14px; font-weight: 500;
            color: #e7e7e7; transition: background .3s ease;
        }
        .timeline-selector.active .timeline-selector-num { background: #d10000; }
        .timeline-selector-label {
            font-family: 'Geist', sans-serif; font-size: 24px; font-weight: 500;
            color: rgba(231,231,231,1); letter-spacing: -.2px;
        }
        /* Mobile steps (hidden on desktop) */
        .timeline-steps { display: none; }
        .timeline-step-img { display: none; }
        .timeline-step {
            display: flex; gap: 16px; padding: 24px 20px;
            opacity: .6; transition: opacity .4s; cursor: pointer;
        }
        .timeline-step:hover { opacity: .95; }
        .timeline-step.active { opacity: 1; }
        .timeline-step:last-child { min-height: 240px; padding-bottom: 60px; }
        .timeline-number {
            position: relative; width: 30px; height: 30px;
            background: #5e3f3a; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0; z-index: 2;
            transition: background .5s ease;
        }
        .timeline-step.active .timeline-number { background: #d10000; }
        .timeline-number span { font-family: 'Geist Mono', monospace; font-size: 16px; font-weight: 500; color: #e7e7e7; position: relative; z-index: 3; }
        .timeline-line {
            position: absolute; top: 100%; left: 50%; transform: translateX(-50%);
            width: 1px; height: 250px;
            background: repeating-linear-gradient(to bottom, #e7e7e7 1px, #e7e7e7 1px, transparent 4px, transparent 4px);
            z-index: 0;
        }
        .timeline-step:last-child .timeline-line { display: none; }
        .timeline-text { display: flex; flex-direction: column; gap: 8px; padding-left: 16px; padding-top: 4px; }
        .timeline-step-title { font-family: 'Geist', sans-serif; font-size: 24px; font-weight: 700; color: rgba(231,231,231,1); letter-spacing: -.3px; transition: color .3s ease; }
        .timeline-step.active .timeline-step-title { color: #fff; }
        .timeline-step-desc { font-family: 'Geist', sans-serif; font-size: 16px; font-weight: 400; color: rgba(223,223,223,.6); letter-spacing: -.3px; line-height: 1.5; }

        /* ─── FAQ ───────────────────────────────────── */
        .faq-section {
            width: 100%; background: #0d1117;
            padding: 80px 30px; display: flex; justify-content: center;
            position: relative; z-index: 10; margin-top: -10px;
            margin-bottom: 80px; border-radius: 20px 20px 0 0;
        }
        .faq-container { width: 100%; max-width: 760px; }
        .faq-title {
            font-size: 36px; font-weight: 600; color: #ecf5fe;
            text-align: center; letter-spacing: -.6px; line-height: 1;
            margin-bottom: 56px; white-space: nowrap;
        }
        .faq-item { margin-bottom: 0; }
        .faq-question {
            width: 100%; display: flex; justify-content: space-between; align-items: center;
            padding: 24px 0; background: transparent; border: none; cursor: pointer;
            text-align: left; transition: all .3s ease;
        }
        .faq-question span {
            font-size: 16px; font-weight: 400; color: rgba(255,255,255,.8);
            letter-spacing: -.3px; line-height: 1.4; padding-right: 20px; flex: 1;
        }
        .faq-icon {
            flex-shrink: 0; color: #fff; width: 20px; height: 20px;
            transition: transform .3s ease;
        }
        .faq-item.active .faq-icon { transform: rotate(180deg); }
        .faq-answer {
            max-height: 0; overflow: hidden;
            transition: max-height .4s ease, padding .4s ease; padding: 0;
        }
        .faq-item.active .faq-answer { max-height: 400px; padding-bottom: 24px; }
        .faq-answer p { font-size: 15px; font-weight: 400; color: rgba(255,255,255,.7); line-height: 1.65; }
        .faq-divider { width: 100%; height: 1px; background: rgba(255,255,255,.1); }

        /* ─── FINAL CTA ─────────────────────────────── */
        .final-cta {
            width: 100%; position: relative; z-index: 10;
            overflow: hidden; background: #ecf5fe;
            color: #ecf5fe;
        }
        .final-cta-container {
            max-width: 1200px; margin: 0 auto; padding: 40px 30px;
            min-height: calc(100vh - 85px);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 16px; color: #fff; text-align: center;
            position: relative; z-index: 10;
        }
        .cta-logo {
            width: 56px; height: 56px; border-radius: 14px;
            background: rgba(255,255,255,.15);
            display: flex; align-items: center; justify-content: center; margin-bottom: 8px;
            font-size: 26px; font-weight: 800; font-family: 'Geist', sans-serif;
            letter-spacing: -.04em; color: #fff;
        }
        .cta-text { display: flex; flex-direction: column; gap: 16px; align-items: center; }
        .cta-title { font-size: 72px; font-weight: 500; color: #d10000; letter-spacing: -1.44px; line-height: 1; }
        .cta-subtitle { font-size: 20px; font-weight: 400; color: #0d1117; }

        /* ─── FOOTER ────────────────────────────────── */
        .site-footer {
            background: #0d1117;
            padding: 48px 0 28px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .site-footer-inner {
            max-width: 1200px; margin: 0 auto; padding: 0 40px;
            display: flex; align-items: flex-start; justify-content: space-between;
            flex-wrap: wrap; gap: 32px;
        }

        /* Brand block */
        .footer-brand { display: flex; flex-direction: column; gap: 8px; }
        .footer-logo-wrap {
            display: flex; align-items: center; gap: 8px; text-decoration: none;
        }
        .footer-brand-name {
            font-size: 16px; font-weight: 600; letter-spacing: -.03em; color: #fff;
        }
        .footer-brand-name em { color: #a30000; font-style: normal; }
        .footer-tagline { font-size: 13px; color: rgba(255,255,255,.35); }

        /* Nav links */
        .footer-links {
            display: flex; flex-direction: row; gap: 35px; padding-top: 4px;
        }
        .footer-links a {
            font-size: 13px; color: rgba(255,255,255,.45);
            text-decoration: none; transition: color .2s;
        }
        .footer-links a:hover { color: #fff; }

        /* Right block */
        .footer-right {
            display: flex; flex-direction: row; align-items: flex-end; gap: 12px;
        }
        .footer-social { display: flex; gap: 12px; align-items: flex-end; }
        .footer-social a {
            color: rgba(255,255,255,.4); transition: color .2s;
            display: flex; align-items: center;
        }
        .footer-social a:hover { color: #fff; }
        .footer-copy { font-size: 12px; color:rgba(255,255,255,.45) }

@media (max-width: 900px) {
    /* ── NAV ── */
    .menu { top: 8px; left: 8px; right: 8px; padding: 8px 14px; }
    .menu-links { display: none; }
    .menu-login { display: none; }
    .cta-btn { min-width: auto; padding: 8px 14px; font-size: 13px; height: 36px; }

    /* ── HERO ── */
    .section-hero { padding: 120px 0 72px; min-height: auto; }
    .hero-content { padding-left: 24px; padding-right: 24px; }
    .hero-title { font-size: 44px; width: 100%; letter-spacing: -.03em; margin-bottom: 16px; }
    .hero-subtitle { font-size: 16px; max-width: 100%;}
    .hero-cta-row { flex-direction: row; width: 80%; gap: 10px; }
    .hero-cta-row .cta-btn { width: 100%; min-width: unset; height: 48px; font-size: 15px; justify-content: center; }
    .hero-fineprint { font-size: 11px; line-height: 1.6; }
    .hero-m-outline { display: none; }

/* ─── WAVE DIVIDER ─────────────────────────── */
        .section-wave-divider {
            position: relative; 
            z-index: 5;
            line-height: 0;
            margin-bottom: -2px; /* Tutup celah bawah biar ga bolong */
        }
        
        .section-wave-divider svg { 
            display: block; 
            width: 100%; 
            height: 80px;
        }

        .section-wave-divider path {
            fill: #ecf5fe;
            stroke: #ecf5fe; /* Garis tepi disamakan dengan warna ombak */
            stroke-width: 2px; /* Ini kuncinya: menambal celah tipis */
        }

    /* ── PAIN ── */
    .section-pain { padding: 64px 24px; min-height: auto; }
    .pain-container { flex-direction: column; gap: 0; }
    .pain-bubbles-wrap { display: none; }
    .pain-text-block { max-width: 100%; width: 100%; }
    .pain-title { font-size: 26px; margin-top: 16px; margin-bottom: 16px; }
    .pain-subtitle { font-size: 15px; }
    .pain-cta-link { width: 100%; }

    /* ── STACKING CARDS mobile: sticky tetap, edge-to-edge, height auto ── */
    .stacking-card {
        position: sticky !important;
        height: auto !important;
        min-height: auto !important;
        border-radius: 16px;
        margin: 0;              /* edge-to-edge, no side margin */
        overflow: hidden;
    }
    .folder-wrapper {
        width: 100%;
        max-width: 100%;
        height: auto;
        border-radius: 0;
        margin: 0;
        overflow: hidden;
    }
    .folder-shape-bg { display: block; width: 100%; }
    .folder-header-bar { height: 60px; }
    .folder-tab-label { margin-left: 20px; font-size: 12px; }

    .stacking-card:nth-child(1) { top: 0; }
    .stacking-card:nth-child(3) { top: 0; }
    .stacking-card:nth-child(5) { top: 0; }

    /* Stack vertikal */
    .folder-hero {
        flex-direction: column !important;
        align-items: flex-start !important;
        padding: 50px 20px 40px !important;
        gap: 16px !important;
        height: auto !important;
    }
    .folder-text {
        max-width: 100% !important;
        width: 100%;
        padding-top: 0;
    }
    .folder-card-title {
        font-size: 40px;
        line-height: 1.05;
        margin-top: 14px !important;
        margin-bottom: 2px !important;
        white-space: normal !important;
        width: 100% !important;
    }
    .folder-card-h4 {
        font-size: 20px !important;
        line-height: 1.25 !important;
        margin-bottom: 6px !important;
        white-space: normal !important;
        width: 100% !important;
    }
    .folder-card-body {
        font-size: 14px;
        line-height: 1.55;
        white-space: normal !important;
        width: 100% !important;
    }

    /* Mockup full width */
    .folder-visual {
        width: 100% !important;
        overflow: visible !important;
        flex: 0 0 auto !important;
    }
    .app-mockup,
    .dash-mockup,
    .team-mockup {
        width: 100% !important;
        max-width: 100% !important;
        min-width: 0 !important;
        border-radius: 12px;
    }
    .dash-body        { grid-template-columns: 1fr; min-height: auto; }
    .dash-sidebar     { display: none; }
    .dash-cards       { grid-template-columns: 1fr; }
    .dash-topbar      { flex-wrap: wrap; gap: 10px; }
    .dash-stats       { order: 3; width: 100%; justify-content: space-between; }
    .dash-search      { display: none; }
    .team-panel-head  { flex-wrap: wrap; }

    /* Spacer 38vh — MonoDesk exact */
    .card-spacer { display: block !important; height: 0vh !important; }

    /* ── TIMELINE ── */
    .timeline-section {
        margin-top: -200px !important;
        border-radius: 20px 20px 0 0 !important;
        position: relative !important;
        z-index: 10 !important;
    }
    .timeline-header-wrapper { padding: 0 24px; margin-bottom: 32px; }
    .section-title { font-size: 28px; text-align: center; }
    .timeline-container { grid-template-columns: 1fr; padding: 0 24px; gap: 0; }
    .timeline-media { display: none; }
    .timeline-content { grid-column: 1; align-items: stretch; gap: 0; }
    .timeline-display { display: none; }
    .timeline-selectors { display: none; }
    /* Step cards — persis MonoDesk: gambar atas, teks bawah, card border */
    .timeline-steps { display: flex; flex-direction: column; gap: 16px; }
    .timeline-step {
        flex-direction: column; align-items: flex-start;
        padding: 20px; opacity: 1; min-height: auto !important;
        background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 16px; cursor: default;
    }
    .timeline-step:last-child { padding-bottom: 20px; }
    .timeline-step-img {
        display: block; width: 100%; height: auto;
        border-radius: 10px; margin-bottom: 20px; order: -1;
    }
    .timeline-number { display: none; }
    .timeline-line { display: none; }
    .timeline-text { padding-left: 0; padding-top: 0; align-items: flex-start; }
    .timeline-step-title { font-size: 20px; text-align: left; color: #fff; }
    .timeline-step-desc { font-size: 15px; text-align: left; color: rgba(255,255,255,.65); }

    /* ── FAQ ── */
    .faq-section { padding: 60px 24px; margin-bottom: 0; border-radius: 20px 20px 0 0; }
    .faq-title { font-size: 28px; text-align: left; white-space: normal; margin-bottom: 32px; }
    .faq-question span { font-size: 15px; }
    .faq-answer p { font-size: 14px; }

    /* ── FINAL CTA ── */
    .final-cta-container { padding: 200px 24px; min-height: auto; gap: 24px; }
    .cta-title { font-size: 34px; letter-spacing: -1px; }
    .cta-subtitle { font-size: 14px; }
    .final-cta-container .cta-btn { width: 100%; max-width: 40px; height: 48px; font-size: 15px; }

    /* ── FOOTER ── */
    .site-footer-inner {
        height: auto; flex-direction: column;
        align-items: flex-start; padding: 36px 24px; gap: 28px;
    }
    .footer-links { flex-direction: column; align-items: flex-start; justify-content: flex-start; gap: 14px; }
    .footer-right { flex-direction: column; align-items: flex-start; gap: 12px; }
}
    </style>
</head>
<body>

<!-- ══════════ NAV ══════════ -->
<div class="menu" id="main-menu">
    <div class="menu-logo">
        <a href="#" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
            <img src="/images/logoA.svg" alt="awfulnotes" 
                style="display:block; height:32px; width:32px; border-radius:50%; object-fit:cover;">
            <span class="menu-logo-text">awful<em>notes</em></span>
        </a>
    </div>
    <nav class="menu-links">
        <a href="#features"  class="menu-link">Features</a>
        <a href="#how"       class="menu-link">How It Works</a>
        <a href="#faq"       class="menu-link">FAQ</a>
    </nav>
    <div class="menu-actions">
        <a href="{{ route('login') }}" class="menu-login">Log in</a>
        <a href="{{ route('register') }}" class="cta-btn">
            Get started free
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
</div>


<!-- ══════════ HERO ══════════ -->
<section class="section-hero">
    <div class="hero-bg-grid"></div>
    <span class="hero-m-outline">A</span>

    <div class="hero-content">
        <div class="hero-text">
            <span class="pill-tag">For students</span>
            <h1 class="hero-title">Less stress.<br>More done.</h1>
            <p class="hero-subtitle">One workspace built for students.</p>
            <div class="hero-cta-row">
                <a href="{{ route('register') }}" class="cta-btn">
                    Get started free
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('login') }}" class="cta-btn cta-btn-secondary">
                    Log in
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
            <p class="hero-fineprint">Try for free during beta, no credit card required, zero commitment</p>
        </div>
    </div>
</section>

<!-- ══════════ WAVE DIVIDER ══════════ -->
<div class="section-wave-divider">
    <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,0 Q360,80 720,40 Q1080,0 1440,60 L1440,80 L0,80 Z" fill="#ecf5fe"/>
    </svg>
</div>

<!-- ══════════ PAIN / INTRO ══════════ -->
<section class="section-pain">
    <div class="pain-container">
        <!-- Left: floating pill bubbles -->
<div class="pain-bubbles-wrap">
    <div class="pain-bubble" style="top: 8%; left: 15%;">
        <x-lucide-alarm-clock class="w-5 h-5 shrink-0" />
        <span>Deadlines missed because you forgot</span>
    </div>

    <div class="pain-bubble" style="top: 32%; right: 2%;">
        <x-lucide-messages-square class="w-5 h-5 shrink-0" />
        <span>Assignments lost in group chats</span>
    </div>

    <div class="pain-bubble" style="top: 58%; left: 12%;">
        <x-lucide-files class="w-5 h-5 shrink-0" />
        <span>10 tabs open, can't find where to start</span>
    </div>

    <div class="pain-bubble" style="bottom: 5%; left: 45%;">
        <x-lucide-triangle-alert class="w-5 h-5 shrink-0" />
        <span>2am panic — what's due tomorrow?</span>
    </div>
</div>

        <!-- Right: text -->
        <div class="pain-text-block">
            <div class="pain-m-logo"><img src="/images/logoA.svg" alt=""></div>
            <h2 class="pain-title">We get it. Student life isn't<br>just dream assignments.</h2>
            <p class="pain-subtitle">
                It's deadlines buried in group chats, feedback lost in threads, late submissions, and the constant anxiety of not knowing what's due — while juggling it all alone.<br><br>
                Awfulnotes replaces the endless tab-switching and chaos with one calm workspace.
            </p>
            <p class="pain-subtitle" style="margin: 8px 0 0; font-size: 16px;">
                <strong>Built for how students <em>actually</em> work.</strong>
            </p>
            <a href="{{ route('register') }}" class="pain-cta-link">
                <span class="pain-cta">
                    See how it works
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </span>
            </a>
        </div>
    </div>
</section>


<!-- ══════════ STACKING FOLDER CARDS ══════════ -->
<div class="stacking-cards-container" id="features">

    <!-- Card 1: Assignments (Dark/Blue) -->
    <div class="stacking-card" style="z-index:1;">
        <div class="folder-wrapper">
            <!-- Folder shape SVG - exact MonoDesk path -->
            <svg class="folder-shape-bg" viewBox="0 0 1367 819" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1347.27 818.671C1358.17 818.671 1367 809.839 1367 798.944L1367 125.99C1367 115.094 1358.17 106.262 1347.27 106.262L367.077 106.262C361.101 106.262 355.447 103.553 351.702 98.8955L278.11 7.36607C274.366 2.70872 268.712 -0.000169299 262.736 -0.00016822L19.7279 -0.00012435C8.83249 -0.000122383 3.53992e-05 8.83234 3.49229e-05 19.7277L8.62331e-07 798.943C3.86078e-07 809.839 8.83246 818.671 19.7279 818.671L1347.27 818.671Z" fill="#111827"/>
            </svg>
            <div class="folder-header-bar">
                <div class="folder-tab-label">
                </div>
            </div>
            <div class="folder-hero">
                <div class="folder-text" style="color:#fff;">
                    <h1 class="folder-card-title">Assignments</h1>
                    <h4 class="folder-card-h4">The dashboard view for every task.</h4>
                    <p class="folder-card-body">Track assignments by status, subject, priority, deadline, and team. Search fast, spot urgent work, and add new tasks right from the dashboard.</p>
                </div>
                <div class="folder-visual">
                    <div class="app-mockup dash-mockup">
                        <div class="dash-topbar">
                            <div class="dash-brand">
                                <div class="dash-logo">A</div>
                                <div>
                                    <div class="dash-brand-name">awfulnotes</div>
                                    <div class="dash-brand-sub">LAZY COLLEGERS SOCIETY</div>
                                </div>
                            </div>
                            <div class="dash-stats">
                                <div class="dash-stat"><strong>12</strong><span>Total</span></div>
                                <div class="dash-stat"><strong>5</strong><span>To Do</span></div>
                                <div class="dash-stat"><strong>4</strong><span>Progress</span></div>
                                <div class="dash-stat"><strong>3</strong><span>Done</span></div>
                            </div>
                            <div class="dash-search">Search assignments...</div>
                        </div>
                        <div class="dash-body">
                            <div class="dash-sidebar">
                                <div class="dash-side-title">Status</div>
                                <div class="dash-side-item active"><span>All</span><span class="dash-side-count">12</span></div>
                                <div class="dash-side-item"><span>To Do</span><span class="dash-side-count">5</span></div>
                                <div class="dash-side-item"><span>In Progress</span><span class="dash-side-count">4</span></div>
                                <div class="dash-side-item"><span>Done</span><span class="dash-side-count">3</span></div>
                                <div class="dash-side-title" style="margin-top:16px;">Subject</div>
                                <div class="dash-side-item"><span>Physics</span><span class="dash-side-count">3</span></div>
                                <div class="dash-side-item"><span>History</span><span class="dash-side-count">2</span></div>
                            </div>
                            <div class="dash-main">
                                <div class="dash-heading">
                                    <div>
                                        <h3>All Assignments</h3>
                                        <p>12 assignment found</p>
                                    </div>
                                    <div class="dash-actions">
                                        <div class="dash-chip primary">+ Add Assignment</div>
                                    </div>
                                </div>
                                <div class="dash-cards">
                                    <div class="dash-card">
                                        <div class="dash-card-title">Physics Lab Report</div>
                                        <div class="dash-card-meta">Praktikum · Due tomorrow · High</div>
                                        <div class="dash-card-foot">
                                            <span class="t-badge b-prog">In Progress</span>
                                            <div class="dash-progress"><span style="width:68%;"></span></div>
                                        </div>
                                    </div>
                                    <div class="dash-card">
                                        <div class="dash-card-title">History Essay</div>
                                        <div class="dash-card-meta">Essay · Team · Medium</div>
                                        <div class="dash-card-foot">
                                            <span class="t-badge b-todo">To Do</span>
                                            <div class="dash-progress"><span style="width:22%;"></span></div>
                                        </div>
                                    </div>
                                    <div class="dash-card">
                                        <div class="dash-card-title">Math Problem Set</div>
                                        <div class="dash-card-meta">Quiz · Personal · Done</div>
                                        <div class="dash-card-foot">
                                            <span class="t-badge b-done">Done</span>
                                            <div class="dash-progress"><span style="width:100%;"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-spacer"></div>

    <!-- Card 2: Team (Orange) -->
    <div class="stacking-card" style="z-index:2;">
        <div class="folder-wrapper">
            <svg class="folder-shape-bg" viewBox="0 0 1367 819" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1347.27 818.671C1358.17 818.671 1367 809.839 1367 798.944L1367 125.99C1367 115.094 1358.17 106.262 1347.27 106.262L367.077 106.262C361.101 106.262 355.447 103.553 351.702 98.8955L278.11 7.36607C274.366 2.70872 268.712 -0.000169299 262.736 -0.00016822L19.7279 -0.00012435C8.83249 -0.000122383 3.53992e-05 8.83234 3.49229e-05 19.7277L8.62331e-07 798.943C3.86078e-07 809.839 8.83246 818.671 19.7279 818.671L1347.27 818.671Z" fill="#b45309"/>
            </svg>
            <div class="folder-header-bar">
                <div class="folder-tab-label">
                </div>
            </div>
            <div class="folder-hero">
                <div class="folder-text" style="color:#fff;">
                    <h1 class="folder-card-title">Team</h1>
                    <h4 class="folder-card-h4">Create, join, and manage study groups.</h4>
                    <p class="folder-card-body">Use invite codes, see members, copy team codes, and keep shared assignments tied to the right classmates from the same dashboard flow.</p>
                </div>
                <div class="folder-visual">
                    <div class="app-mockup team-mockup">
                        <div class="team-panel-head">
                            <div class="team-panel-title">
                                <div class="team-icon">👥</div>
                                <div>
                                    <h3>Team up!</h3>
                                    <p>Bring your folks</p>
                                </div>
                            </div>
                            <div class="team-action">2 teams</div>
                        </div>
                        <div class="team-tabs">
                            <div class="team-tab active">My Team</div>
                            <div class="team-tab">Create</div>
                            <div class="team-tab">Join</div>
                        </div>
                        <div class="team-list">
                            <div class="team-card">
                                <div class="team-card-top">
                                    <div>
                                        <div class="team-card-name">Study Group A</div>
                                        <div class="team-card-meta">4 members · owner</div>
                                    </div>
                                    <div class="team-action">Delete</div>
                                </div>
                                <div class="team-code">
                                    <span>Code:</span>
                                    <strong>AWFUL7</strong>
                                    <span class="team-action">Copy</span>
                                </div>
                                <div class="team-members">
                                    <span class="team-member">👑 Raka</span>
                                    <span class="team-member">Naya</span>
                                    <span class="team-member">Dimas</span>
                                    <span class="team-member">Salsa</span>
                                </div>
                            </div>
                            <div class="team-card">
                                <div class="team-card-top">
                                    <div>
                                        <div class="team-card-name">Physics Lab Crew</div>
                                        <div class="team-card-meta">3 members · joined</div>
                                    </div>
                                    <div class="team-action">Leave</div>
                                </div>
                                <div class="team-code">
                                    <span>Code:</span>
                                    <strong>LAB404</strong>
                                    <span class="team-action">Copied</span>
                                </div>
                                <div class="team-members">
                                    <span class="team-member">Mira</span>
                                    <span class="team-member">Adit</span>
                                    <span class="team-member">You</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-spacer"></div>

    <!-- Card 3: Babu-Mu AI (Gradient) -->
    <div class="stacking-card" style="z-index:3;">
        <div class="folder-wrapper">
            <svg class="folder-shape-bg" viewBox="0 0 1367 819" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="grad-ai" x1="0" y1="0" x2="0" y2="819" gradientUnits="userSpaceOnUse">
                        <stop offset="0%"   stop-color="#7a0000"/>
                        <stop offset="50%"  stop-color="#a84040"/>
                        <stop offset="100%" stop-color="#c97a7a"/>
                    </linearGradient>
                </defs>
                <path d="M1347.27 818.671C1358.17 818.671 1367 809.839 1367 798.944L1367 125.99C1367 115.094 1358.17 106.262 1347.27 106.262L367.077 106.262C361.101 106.262 355.447 103.553 351.702 98.8955L278.11 7.36607C274.366 2.70872 268.712 -0.000169299 262.736 -0.00016822L19.7279 -0.00012435C8.83249 -0.000122383 3.53992e-05 8.83234 3.49229e-05 19.7277L8.62331e-07 798.943C3.86078e-07 809.839 8.83246 818.671 19.7279 818.671L1347.27 818.671Z" fill="url(#grad-ai)"/>
            </svg>
            <div class="folder-header-bar">
                <div class="folder-tab-label">
                </div>
            </div>
            <div class="folder-hero">
                <div class="folder-text" style="color:#fff;">
                    <h1 class="folder-card-title">Babu-Mu AI</h1>
                    <h4 class="folder-card-h4">The dashboard chatbot for assignment help.</h4>
                    <p class="folder-card-body">Ask questions from the floating assistant, get structured replies, and keep the conversation close while you manage assignments.</p>
                </div>
                <div class="folder-visual">
                    <div class="app-mockup">
                        <div class="app-bar">
                            <div class="app-dot"></div><div class="app-dot"></div><div class="app-dot"></div>
                            <div class="app-url">awfulnotes.app/assignments</div>
                        </div>
                        <div class="chat-msgs">
                            <div class="chat-row user">
                                <div class="chat-av av-user">👤</div>
                                <div class="chat-bubble bubble-user">Tanya soal tugas...</div>
                            </div>
                            <div class="chat-row">
                                <div class="chat-av av-ai">🤖</div>
                                <div class="chat-bubble bubble-ai">Halo! Aku <strong style="color:#ffdad4">Babu-Mu</strong>. Kirim detail tugas, deadline, atau topik yang mau dibantu.</div>
                            </div>
                            <div class="chat-row user">
                                <div class="chat-av av-user">👤</div>
                                <div class="chat-bubble bubble-user">Bantu bikin outline History Essay.</div>
                            </div>
                            <div class="chat-row">
                                <div class="chat-av av-ai">🤖</div>
                                <div class="chat-bubble bubble-ai"> Siap bos, laksanakan</div>
                            </div>
                            <div class="chat-row user">
                                <div class="chat-av av-user">👤</div>
                                <div class="chat-bubble bubble-user">Mana?</div>
                            </div>
                            <div class="chat-row">
                                <div class="chat-av av-ai">🤖</div>
                                <div class="chat-bubble bubble-ai"> Sedang progress bos, harap tunggu..</div>
                            </div>
                        </div>
                        <div class="chat-input-bar">
                            <input type="text" placeholder="Ask about any assignment...">
                            <button class="chat-send-btn">
                                <svg viewBox="0 0 24 24"><path d="M22 2L11 13M22 2L15 22l-4-9-9-4 20-7z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-spacer" style="height:50vh;"></div>
</div>


<!-- ══════════ HOW IT WORKS ══════════ -->
<section class="timeline-section" id="how">
    <div class="timeline-header-wrapper">
        <h2 class="section-title">How Awfulnotes works</h2>
    </div>
    <div class="timeline-container">
        <!-- Image left -->
        <div class="timeline-media">
            <div class="timeline-image-wrapper">
                <img class="timeline-preview-img active" data-step="1" src="/images/steps/create_acc.png" alt="Set up in minutes">
                <img class="timeline-preview-img" data-step="2" src="/images/steps/add_assgn.png" alt="Add your assignments">
                <img class="timeline-preview-img" data-step="3" src="/images/steps/ai_handle.png" alt="Let the AI handle the admin">
                <img class="timeline-preview-img" data-step="4" src="/images/steps/team_up.png" alt="Collaborate as a team">
            </div>
            <div class="timeline-dots">
                <button class="timeline-dot active" data-step="1" aria-label="View step 1"></button>
                <button class="timeline-dot" data-step="2" aria-label="View step 2"></button>
                <button class="timeline-dot" data-step="3" aria-label="View step 3"></button>
                <button class="timeline-dot" data-step="4" aria-label="View step 4"></button>
            </div>
        </div>

        <!-- Right panel -->
        <div class="timeline-content">
            <!-- Desktop: large text display -->
            <div class="timeline-display">
                <h3 class="timeline-display-title">Set up in minutes</h3>
                <p class="timeline-display-desc">Create your account, build a team, and invite classmates instantly with an invite code. No tutorials, no complex setup.</p>
            </div>
            <!-- Desktop: selector buttons -->
            <div class="timeline-selectors">
                <button class="timeline-selector active" data-step="1" data-title="Set up in minutes" data-desc="Create your account, build a team, and invite classmates instantly with an invite code. No tutorials, no complex setup.">
                    <div class="timeline-selector-num"><span>1</span></div>
                    <span class="timeline-selector-label">Set up in minutes</span>
                </button>
                <button class="timeline-selector" data-step="2" data-title="Add your assignments" data-desc="Create assignments with deadlines, statuses, and team members. Everything in one place — not scattered across five group chats.">
                    <div class="timeline-selector-num"><span>2</span></div>
                    <span class="timeline-selector-label">Add your assignments</span>
                </button>
                <button class="timeline-selector" data-step="3" data-title="Let the AI handle the admin" data-desc="Ask the AI to outline essays, summarise notes, draft study plans, and review your work before you submit.">
                    <div class="timeline-selector-num"><span>3</span></div>
                    <span class="timeline-selector-label">Let the AI handle the admin</span>
                </button>
                <button class="timeline-selector" data-step="4" data-title="Collaborate as a team" data-desc="Track every member's progress, keep everyone aligned, and never ask &quot;so who's doing what?&quot; ever again.">
                    <div class="timeline-selector-num"><span>4</span></div>
                    <span class="timeline-selector-label">Collaborate as a team</span>
                </button>
            </div>
            <!-- Mobile: step cards -->
            <div class="timeline-steps">
                <div class="timeline-step active" data-step="1">
                    <img src="/images/steps/create_acc.png" alt="Set up in minutes" class="timeline-step-img">
                    <div class="timeline-number">
                        <span>1</span>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-text">
                        <h3 class="timeline-step-title">Set up in minutes</h3>
                        <p class="timeline-step-desc">Create your account, build a team, and invite classmates instantly with an invite code. No tutorials, no complex setup.</p>
                    </div>
                </div>
                <div class="timeline-step" data-step="2">
                    <img src="/images/steps/add_assgn.png" alt="Add your assignments" class="timeline-step-img">
                    <div class="timeline-number">
                        <span>2</span>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-text">
                        <h3 class="timeline-step-title">Add your assignments</h3>
                        <p class="timeline-step-desc">Create assignments with deadlines, statuses, and team members. Everything in one place — not scattered across five group chats.</p>
                    </div>
                </div>
                <div class="timeline-step" data-step="3">
                    <img src="/images/steps/ai_handle.png" alt="Let the AI handle the admin" class="timeline-step-img">
                    <div class="timeline-number">
                        <span>3</span>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-text">
                        <h3 class="timeline-step-title">Let the AI handle the admin</h3>
                        <p class="timeline-step-desc">Ask the AI to outline essays, summarise notes, draft study plans, and review your work before you submit.</p>
                    </div>
                </div>
                <div class="timeline-step" data-step="4">
                    <img src="/images/steps/team_up.png" alt="Collaborate as a team" class="timeline-step-img">
                    <div class="timeline-number"><span>4</span></div>
                    <div class="timeline-text">
                        <h3 class="timeline-step-title">Collaborate as a team</h3>
                        <p class="timeline-step-desc">Track every member's progress, keep everyone aligned, and never ask "so who's doing what?" ever again.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ══════════ FAQ ══════════ -->
<section class="faq-section" id="faq">
    <div class="faq-container">
        <h2 class="faq-title">Frequently Asked Questions</h2>

        <div class="faq-item active">
            <button class="faq-question">
                <span>What is Awfulnotes?</span>
                <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
            </button>
            <div class="faq-answer"><p>Awfulnotes is a calm homework workspace built for students. It combines assignment tracking, team collaboration, and AI assistance in one place — replacing the chaos of juggling multiple apps and group chats.</p></div>
        </div>
        <div class="faq-divider"></div>
        <div class="faq-item">
            <button class="faq-question">
                <span>Is Awfulnotes free to use?</span>
                <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
            </button>
            <div class="faq-answer"><p>Yes! Early access is completely free. You get unlimited assignments, team collaboration, and the AI assistant — no credit card required.</p></div>
        </div>
        <div class="faq-divider"></div>
        <div class="faq-item">
            <button class="faq-question">
                <span>How does team collaboration work?</span>
                <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
            </button>
            <div class="faq-answer"><p>Create a team, invite classmates with an invite code or email, and share assignments instantly. Everyone updates statuses in real-time — no more "who's doing what?" in group chats.</p></div>
        </div>
        <div class="faq-divider"></div>
        <div class="faq-item">
            <button class="faq-question">
                <span>Who is Awfulnotes built for?</span>
                <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
            </button>
            <div class="faq-answer"><p>Awfulnotes works for any academic level — high school, university, or graduate programs. Whether you're solo or a team of 20, the platform scales to your needs.</p></div>
        </div>
        <div class="faq-divider"></div>
        <div class="faq-item">
            <button class="faq-question">
                <span>What happens when beta ends?</span>
                <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
            </button>
            <div class="faq-answer"><p>Beta users get special lifetime pricing as a thank-you for being early supporters. We'll announce details well in advance — you'll never be forced into a paid plan without your consent.</p></div>
        </div>
    </div>
</section>

<!-- ══════════ FINAL CTA ══════════ -->
<section class="final-cta">
    <canvas id="cta-canvas"></canvas>
    
    <div class="final-cta-container">
        <div class="cta-text">
            <div class="cta-logo"><img src="/images/logoA.svg" alt=""></div>
            <h2 class="cta-title">You made it this far.</h2>
            <p class="cta-subtitle">Might as well see what all the fuss is about.</p>
        </div>
        <a href="{{ route('register') }}" class="cta-btn" style="min-width:200px;">
            Get started free
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>


<!-- ══════════ FOOTER ══════════ -->
<footer class="site-footer">
    <div class="site-footer-inner">

        <!-- Brand -->
        <div class="footer-brand">
            <a href="#" class="footer-logo-wrap">
                <img src="/images/logoA.svg" alt="Awfulnotes" style="width:28px; height:28px; border-radius:50%; object-fit:cover;">
                <span class="footer-brand-name">awful<em>notes</em></span>
            </a>
        </div>

        <!-- Links -->
        <div class="footer-links">
            <a href="#features">Features</a>
            <a href="#how">How It Works</a>
            <a href="#faq">FAQ</a>
            <a href="https://www.envato.com/privacy/" target="_blank" rel="noopener">Privacy Policy</a>
        </div>

        <!-- Right: social + copy -->
        <div class="footer-right">
            <div class="footer-social">
                <a href="mailto:ryzzkun08@gmail.com" aria-label="Email">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </a>
            </div>
            <p class="footer-copy">© {{ date('Y') }} Awfulnotes. All rights reserved.</p>
        </div>

    </div>
</footer>


<script>
// Nav scroll
const menuEl = document.getElementById('main-menu');
window.addEventListener('scroll', () => {
    menuEl && (window.scrollY > 40 ? menuEl.classList.add('is-scrolled') : menuEl.classList.remove('is-scrolled'));
}, { passive: true });


// lenis smooth scroll setup
const lenis = new Lenis({
    duration: 1.4,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    smoothTouch: false,
});
function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}
requestAnimationFrame(raf);

// Smooth anchor scroll with fixed nav offset
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', (event) => {
        const hash = link.getAttribute('href');
        if (!hash || hash === '#') return;

        const target = document.querySelector(hash);
        if (!target) return;

        event.preventDefault();
        const menuHeight = menuEl ? menuEl.offsetHeight + 24 : 0;
        const targetTop = target.getBoundingClientRect().top + window.scrollY - menuHeight;

        window.scrollTo({
            top: Math.max(targetTop, 0),
            behavior: 'smooth'
        });

        history.pushState(null, '', hash);
    });
});

// FAQ accordion
document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', () => {
        const item = btn.closest('.faq-item');
        const isOpen = item.classList.contains('active');
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));
        if (!isOpen) item.classList.add('active');
    });
});

// Timeline
function setTimelineStep(step) {
    document.querySelectorAll('.timeline-step').forEach(s => s.classList.toggle('active', +s.dataset.step === step));
    document.querySelectorAll('.timeline-preview-img').forEach(i => i.classList.toggle('active', +i.dataset.step === step));
    document.querySelectorAll('.timeline-dot').forEach(d => d.classList.toggle('active', +d.dataset.step === step));
    document.querySelectorAll('.timeline-selector').forEach(s => s.classList.toggle('active', +s.dataset.step === step));
    const activeSelector = document.querySelector(`.timeline-selector[data-step="${step}"]`);
    if (activeSelector) {
        const title = activeSelector.dataset.title;
        const desc = activeSelector.dataset.desc;
        const displayTitle = document.querySelector('.timeline-display-title');
        const displayDesc = document.querySelector('.timeline-display-desc');
        if (displayTitle) displayTitle.textContent = title;
        if (displayDesc) displayDesc.textContent = desc;
    }
}
document.querySelectorAll('.timeline-selector').forEach(s => s.addEventListener('click', () => setTimelineStep(+s.dataset.step)));
document.querySelectorAll('.timeline-selector').forEach(s => s.addEventListener('mouseenter', () => setTimelineStep(+s.dataset.step)));
document.querySelectorAll('.timeline-step').forEach(s => s.addEventListener('click', () => setTimelineStep(+s.dataset.step)));
document.querySelectorAll('.timeline-dot').forEach(d => d.addEventListener('click', () => setTimelineStep(+d.dataset.step)));

// Stacking cards scroll (simple CSS sticky approach)
// Cards stack naturally via position:sticky + z-index
</script>

</body>
</html>
