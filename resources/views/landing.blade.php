<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awfulnotes — Less stress. More done.</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&family=Geist+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/landing.css'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --brand-white:       #ffffff;
            --brand-lime:        #d1ff6e;
            --brand-green:       #026232;
            --brand-orange:      #ff5b26;
            --brand-blue:        #1c64f5;
            --brand-grey:        #94959a;
            --brand-almost-black:#272727;
            --background:        #dadee1;
            --type:              #161616;
            --type-light:        #e7e7e7;
            --type-60:           rgba(22,22,22,.6);
            --type-light-60:     rgba(231,231,231,.6);
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
            background: #212121;
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
            background: var(--brand-lime);
            color: var(--brand-green);
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
            background: var(--brand-green);
            transition: left .4s ease; z-index: -1; border-radius: 10px;
        }
        .cta-btn:hover { box-shadow: 0 4px 12px rgba(0,0,0,.15); color: var(--brand-lime); }
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
            background: #272727;
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
        .section-hero::before {
            content: '';
            position: absolute; inset: -20% 0;
            background: radial-gradient(ellipse at 30% 50%, rgba(163,0,0,.18) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 20%, rgba(28,100,245,.08) 0%, transparent 50%);
            z-index: -1;
        }
        .hero-bg-grid {
            position: absolute; inset: 0; pointer-events: none; z-index: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse at 50% 40%, black 20%, transparent 80%);
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
            color: #e5eaed; font-size: 20px; font-weight: 400;
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
            background: var(--background);
            color: var(--background);
            padding: 80px 60px 100px;
            position: relative;
        }
        .pain-container {
            max-width: 1200px; margin: 0 auto;
            display: flex; gap: 80px; align-items: center; width: 100%;
        }
        .pain-bubbles-wrap {
            flex: 1; display: grid; grid-template-columns: 1fr 1fr;
            gap: 12px; max-width: 560px;
        }
        .pain-bubble-card {
            background: #161616; color: #fff;
            padding: 18px 20px; border-radius: 16px;
            font-size: 14px; font-weight: 400; line-height: 1.5;
            display: flex; align-items: flex-start; gap: 10px;
        }
        .pain-bubble-card-wide { grid-column: 1 / -1; }
        .pain-bubble-icon {
            width: 28px; height: 28px; border-radius: 50%;
            background: rgba(255,255,255,.1); flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; font-size: 14px;
        }
        .pain-text-block { max-width: 480px; position: relative; z-index: 2; }
        .pain-m-logo {
            font-size: 22px; font-weight: 800; color: #a30000; margin-bottom: 16px;
            font-family: 'Geist', sans-serif; letter-spacing: -.03em;
        }
        .pain-title {
            font-size: 32px; font-weight: 500; color: var(--brand-almost-black);
            margin-bottom: 20px; line-height: 1.2; letter-spacing: -.02em; margin-top: 8px;
        }
        .pain-subtitle { font-size: 16px; line-height: 1.6; color: var(--type); }
        .pain-subtitle strong { font-weight: 500; }
        .pain-cta-link { display: inline-block; margin-top: 28px; }
        .pain-cta {
            font-family: 'Geist', sans-serif; font-size: 14px; font-weight: 500;
            padding: 8px 18px; background: var(--brand-lime); color: var(--type);
            border-radius: 10px; display: inline-flex; align-items: center; gap: 6px;
            transition: opacity .2s; height: 40px;
        }
        .pain-cta:hover { opacity: .85; }

        /* ─── STACKING FOLDER CARDS ────────────────── */
        .stacking-cards-container { position: relative; }
        .stacking-card {
            position: sticky; top: 0;
            height: 100vh; min-height: 600px;
            display: flex; align-items: flex-start; justify-content: center;
            padding-top: 0;
        }
        .folder-wrapper {
            position: relative;
            width: calc(100vw - 40px);
            max-width: 1400px;
            height: 100%;
        }
        /* The unique folder SVG shape - same path as MonoDesk */
        .folder-shape-bg {
            position: absolute; top: 0; left: 0;
            width: 100%; height: 100%; z-index: 0; pointer-events: none;
        }
        .folder-wrapper > *:not(.folder-shape-bg) { position: relative; z-index: 1; }

        /* Folder header/tab area */
        .folder-header-bar {
            width: 100%; padding: 0;
            display: flex; align-items: flex-end; justify-content: flex-start;
            height: 100px;
        }
        .folder-tab-label {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 22px; border-radius: 10px 10px 0 0;
            font-size: 13px; font-weight: 600; letter-spacing: .04em;
            margin-left: 60px; margin-bottom: 0;
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
        .app-side-item.active { background: rgba(163,0,0,.2); color: rgba(255,218,212,.9); }
        .app-side-cta {
            margin-top: auto; background: #a30000; border-radius: 7px;
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

        /* Calendar mockup */
        .cal-grid { display: grid; grid-template-columns: repeat(7,1fr); gap: 6px; }
        .cal-head { font-size: 10px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: rgba(255,255,255,.25); padding-bottom: 8px; border-bottom: 1px solid rgba(255,255,255,.08); text-align: center; }
        .cal-cell { border-radius: 8px; background: rgba(255,255,255,.03); min-height: 70px; padding: 8px; }
        .cal-cell.today { background: rgba(163,0,0,.15); border: 1px solid rgba(163,0,0,.3); }
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
        .bubble-ai { background: rgba(163,0,0,.12); border: 1px solid rgba(163,0,0,.25); border-radius: 12px 12px 12px 2px; }
        .chat-input-bar { border-top: 1px solid rgba(255,255,255,.08); display: flex; }
        .chat-input-bar input { flex: 1; padding: 11px 14px; background: transparent; border: none; outline: none; font-family: 'Geist', sans-serif; font-size: 12px; color: #fff; }
        .chat-input-bar input::placeholder { color: rgba(255,255,255,.2); }
        .chat-send-btn { background: #a30000; border: none; padding: 0 16px; cursor: pointer; display: flex; align-items: center; }
        .chat-send-btn svg { width: 16px; height: 16px; stroke: #fff; stroke-width: 2; fill: none; }

        /* Card spacer */
        .card-spacer { height: 100vh; }

        /* ─── TIMELINE / HOW IT WORKS ──────────────── */
        .timeline-section {
            width: 100%; background: #212121;
            padding: 100px 30px 80px;
            position: relative; z-index: 10;
            margin-top: -200px; border-radius: 20px 20px 0 0;
            min-height: 100vh; display: flex; flex-direction: column; justify-content: center;
        }
        .timeline-header-wrapper { text-align: center; margin-bottom: 60px; padding: 0 60px; }
        .section-title { font-size: 36px; font-weight: 600; letter-spacing: -.6px; line-height: 1; color: #e7e7e7; }
        .timeline-container {
            display: grid; grid-template-columns: 1fr auto 1fr;
            gap: 40px; max-width: 1200px; margin: 0 auto;
            align-items: start; padding: 0 60px;
        }
        .timeline-media {
            max-width: 520px; width: 100%;
            display: flex; flex-direction: column; align-items: center;
            grid-column: 1; justify-self: end;
            position: sticky; top: calc(50vh - 260px);
        }
        .timeline-img-wrapper { position: relative; width: 100%; }
        .timeline-preview-img {
            width: 100%; height: auto; object-fit: contain;
            opacity: 0; transform: scale(1.04);
            transition: opacity .5s ease, transform .5s ease;
            border-radius: 12px;
        }
        .timeline-preview-img:not(.active) { position: absolute; top: 0; left: 0; }
        .timeline-preview-img.active { opacity: 1; transform: scale(1); }
        .timeline-dots { display: flex; justify-content: center; gap: 10px; margin-top: 18px; }
        .timeline-dot {
            width: 10px; height: 10px; border-radius: 50%; border: none;
            background: rgba(255,255,255,.25); cursor: pointer; padding: 0;
            transition: background .3s ease;
        }
        .timeline-dot.active { background: var(--brand-orange); }
        .timeline-content {
            max-width: 560px; display: flex; flex-direction: column;
            gap: 0; grid-column: 2 / 4; justify-self: start;
        }
        .timeline-step {
            display: flex; gap: 16px; padding: 24px 20px;
            opacity: .5; transition: opacity .4s; cursor: pointer;
        }
        .timeline-step:hover { opacity: .8; }
        .timeline-step.active { opacity: 1; }
        .timeline-number {
            position: relative; width: 30px; height: 30px;
            background: var(--brand-blue); border-radius: 50%;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0; z-index: 2;
            transition: background .4s;
        }
        .timeline-step.active .timeline-number { background: var(--brand-orange); }
        .timeline-number span { font-family: 'Geist Mono', monospace; font-size: 14px; font-weight: 500; color: #fff; }
        .timeline-line {
            position: absolute; top: 100%; left: 50%; transform: translateX(-50%);
            width: 1px; height: 80px;
            background: repeating-linear-gradient(to bottom, #e7e7e7 1px, #e7e7e7 1px, transparent 4px, transparent 4px);
        }
        .timeline-step:last-child .timeline-line { display: none; }
        .timeline-text { display: flex; flex-direction: column; gap: 8px; padding-left: 16px; padding-top: 4px; }
        .timeline-step-title { font-size: 22px; font-weight: 600; color: var(--type-light); letter-spacing: -.3px; }
        .timeline-step.active .timeline-step-title { color: #fff; }
        .timeline-step-desc { font-size: 15px; font-weight: 400; color: var(--type-light-60); line-height: 1.55; }

        /* ─── FAQ ───────────────────────────────────── */
        .faq-section {
            width: 100%; background: #212121;
            padding: 80px 30px; display: flex; justify-content: center;
            position: relative; z-index: 10; margin-top: -1px;
        }
        .faq-container { width: 100%; max-width: 760px; }
        .faq-title {
            font-size: 36px; font-weight: 600; color: var(--background);
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

        /* ─── PRICING / INCLUDED ────────────────────── */
        .pricing-section {
            width: 100%; display: flex; align-items: center; justify-content: center;
            padding: var(--spacing-2xl) var(--spacing-xl);
            background: var(--background);
            position: relative; z-index: 10;
        }
        .pricing-container { position: relative; width: 100%; max-width: 1000px; margin: 0 auto; }
        .price-card {
            color: #fff; background: var(--brand-almost-black);
            border-radius: var(--radius-xl);
            padding: 56px 80px;
            display: flex; align-items: center; justify-content: center; gap: 56px;
        }
        .price-left { display: flex; flex-direction: column; align-items: center; }
        .price-headline {
            font-size: 30px; font-weight: 600; color: #fff;
            letter-spacing: -.3px; margin-bottom: 28px; text-align: center; line-height: 1.2;
        }
        .price-features-grid {
            display: grid; grid-template-columns: repeat(2, 200px); gap: 12px 28px;
        }
        .price-feature { display: flex; align-items: center; gap: 8px; }
        .price-feature-icon { width: 16px; height: 16px; color: #fff; flex-shrink: 0; }
        .price-feature span { font-size: 13px; font-weight: 500; color: var(--brand-grey); }
        .price-divider { height: 110px; width: 1px; background: rgba(255,255,255,.2); }
        .price-right { display: flex; flex-direction: column; align-items: center; gap: 20px; min-width: 260px; }
        .price-subtext { font-size: 18px; font-weight: 400; color: rgba(255,255,255,.75); text-align: center; }
        .price-cta-wrap { display: flex; flex-direction: column; align-items: center; gap: 10px; }

        /* ─── FINAL CTA ─────────────────────────────── */
        .final-cta {
            width: 100%; position: relative; z-index: 10;
            overflow: hidden; background: #2c48e3;
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
        .cta-title { font-size: 72px; font-weight: 500; color: #fff; letter-spacing: -1.44px; line-height: 1; }
        .cta-subtitle { font-size: 20px; font-weight: 400; color: rgba(218,222,225,.8); }

        /* ─── FOOTER ────────────────────────────────── */
        .site-footer {
            background: #212121; padding: 24px 0;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .site-footer-inner {
            max-width: 1200px; margin: 0 auto; padding: 0 40px;
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;
        }
        .footer-links { display: flex; gap: 24px; }
        .footer-links a { font-size: 14px; color: var(--brand-grey); transition: color .2s; }
        .footer-links a:hover { color: #fff; }
        .footer-social { display: flex; gap: 16px; align-items: center; }
        .footer-social a { color: var(--brand-grey); transition: color .2s; display: flex; }
        .footer-social a:hover { color: #fff; }
        .footer-copy { font-size: 14px; color: rgba(255,255,255,.25); }

        /* ─── RESPONSIVE ────────────────────────────── */
        @media (max-width: 900px) {
            .menu-links { display: none; }
            .hero-title { font-size: 44px; width: 100%; }
            .hero-content { padding-left: 24px; padding-right: 24px; }
            .hero-m-outline { display: none; }
            .pain-container { flex-direction: column; gap: 40px; padding: 0; }
            .pain-bubbles-wrap { max-width: 100%; }
            .section-pain { padding: 64px 24px; }
            .stacking-card { height: auto; position: relative; }
            .folder-hero { flex-direction: column; padding: 24px; }
            .folder-card-title { font-size: 36px; }
            .timeline-container { grid-template-columns: 1fr; padding: 0 20px; }
            .timeline-media { justify-self: center; position: static; max-width: 100%; }
            .timeline-content { grid-column: 1; max-width: 100%; }
            .timeline-section { margin-top: 0; border-radius: 0; }
            .price-card { flex-direction: column; padding: 40px 24px; gap: 32px; }
            .price-divider { width: 100%; height: 1px; }
            .price-features-grid { grid-template-columns: 1fr; }
            .cta-title { font-size: 44px; }
            .site-footer-inner { flex-direction: column; align-items: flex-start; }
            .faq-title { white-space: normal; font-size: 28px; }
        }
    </style>
</head>
<body>

<!-- ══════════ NAV ══════════ -->
<div class="menu" id="main-menu">
    <div class="menu-logo">
        <a href="#"><span class="menu-logo-text">awful<em>notes</em></span></a>
    </div>
    <nav class="menu-links">
        <a href="#features"  class="menu-link">Features</a>
        <a href="#how"       class="menu-link">How It Works</a>
        <a href="#pricing"   class="menu-link">Pricing</a>
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
        <path d="M0,0 Q360,80 720,40 Q1080,0 1440,60 L1440,80 L0,80 Z" fill="#dadee1"/>
    </svg>
</div>

<!-- ══════════ PAIN / INTRO ══════════ -->
<section class="section-pain">
    <div class="pain-container">
        <!-- Left: pain bubbles -->
        <div class="pain-bubbles-wrap">
            <div class="pain-bubble-card">
                <div class="pain-bubble-icon">⏰</div>
                <span>Deadlines missed because you forgot to check your email</span>
            </div>
            <div class="pain-bubble-card">
                <div class="pain-bubble-icon">💬</div>
                <span>Assignments disappearing in the noise of group chats</span>
            </div>
            <div class="pain-bubble-card">
                <div class="pain-bubble-icon">🗂️</div>
                <span>10 tabs open and still can't find where to start</span>
            </div>
            <div class="pain-bubble-card">
                <div class="pain-bubble-icon">😰</div>
                <span>The 2am panic of not knowing what's due tomorrow</span>
            </div>
        </div>

        <!-- Right: text -->
        <div class="pain-text-block">
            <div class="pain-m-logo">awfulnotes</div>
            <h2 class="pain-title">We get it. Student life isn't just dream assignments.</h2>
            <p class="pain-subtitle">
                It's deadlines buried in group chats, feedback lost in threads, late submissions, and the constant anxiety of not knowing what's due — while juggling it all alone.<br><br>
                Awfulnotes replaces the endless tab-switching and chaos with one calm workspace.
            </p>
            <p class="pain-subtitle" style="margin-top: 12px; font-size: 15px;">
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
                <path d="M1347.27 818.671C1358.17 818.671 1367 809.839 1367 798.944L1367 125.99C1367 115.094 1358.17 106.262 1347.27 106.262L367.077 106.262C361.101 106.262 355.447 103.553 351.702 98.8955L278.11 7.36607C274.366 2.70872 268.712 -0.000169299 262.736 -0.00016822L19.7279 -0.00012435C8.83249 -0.000122383 3.53992e-05 8.83234 3.49229e-05 19.7277L8.62331e-07 798.943C3.86078e-07 809.839 8.83246 818.671 19.7279 818.671L1347.27 818.671Z" fill="#1c64f5"/>
            </svg>
            <div class="folder-header-bar">
                <div class="folder-tab-label" style="background:#272727;color:rgba(255,255,255,.8);border:1px solid rgba(255,255,255,.15);border-bottom:none;">
                    📋 Assignments
                </div>
            </div>
            <div class="folder-hero">
                <div class="folder-text" style="color:#fff;">
                    <h1 class="folder-card-title">Assignments</h1>
                    <h4 class="folder-card-h4">Stay organised with simple task lists.</h4>
                    <p class="folder-card-body">Keep your projects, deadlines, and teammates connected with easy-to-scan boards. No more losing track of what's due.</p>
                </div>
                <div class="folder-visual">
                    <div class="app-mockup">
                        <div class="app-bar">
                            <div class="app-dot"></div><div class="app-dot"></div><div class="app-dot"></div>
                            <div class="app-url">awfulnotes.app/assignments</div>
                        </div>
                        <div class="app-layout">
                            <div class="app-side">
                                <div class="app-side-lbl">My Teams</div>
                                <div class="app-side-item active">👥 Team Alpha</div>
                                <div class="app-side-item">👥 Team Beta</div>
                                <div class="app-side-item" style="color:rgba(255,255,255,.2)">＋ Join team</div>
                                <div class="app-side-cta">＋ Add Assignment</div>
                            </div>
                            <div class="app-main">
                                <div class="status-pills">
                                    <span class="sp sp-todo">Todo (3)</span>
                                    <span class="sp sp-prog">Progress (2)</span>
                                    <span class="sp sp-done">Done (5)</span>
                                    <span class="sp sp-late">Late (1)</span>
                                </div>
                                <div class="task-row"><div><div class="task-name">Math Problem Set #7</div><div class="task-meta">Due: Tomorrow · Team Alpha</div></div><span class="t-badge b-late">Late</span></div>
                                <div class="task-row"><div><div class="task-name">Physics Lab Report</div><div class="task-meta">Due: Friday · Team Beta</div></div><span class="t-badge b-prog">In Progress</span></div>
                                <div class="task-row"><div><div class="task-name">History Essay Draft</div><div class="task-meta">Due: Next Week · Solo</div></div><span class="t-badge b-todo">Todo</span></div>
                                <div class="task-row"><div><div class="task-name">Chemistry Quiz Notes</div><div class="task-meta">Due: Jun 5 · Team Alpha</div></div><span class="t-badge b-done">Done ✓</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-spacer"></div>

    <!-- Card 2: Planner (Orange) -->
    <div class="stacking-card" style="z-index:2;">
        <div class="folder-wrapper">
            <svg class="folder-shape-bg" viewBox="0 0 1367 819" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1347.27 818.671C1358.17 818.671 1367 809.839 1367 798.944L1367 125.99C1367 115.094 1358.17 106.262 1347.27 106.262L367.077 106.262C361.101 106.262 355.447 103.553 351.702 98.8955L278.11 7.36607C274.366 2.70872 268.712 -0.000169299 262.736 -0.00016822L19.7279 -0.00012435C8.83249 -0.000122383 3.53992e-05 8.83234 3.49229e-05 19.7277L8.62331e-07 798.943C3.86078e-07 809.839 8.83246 818.671 19.7279 818.671L1347.27 818.671Z" fill="#FF5B26"/>
            </svg>
            <div class="folder-header-bar">
                <div class="folder-tab-label" style="background:#272727;color:rgba(255,255,255,.8);border:1px solid rgba(255,255,255,.15);border-bottom:none;">
                    📅 Planner
                </div>
            </div>
            <div class="folder-hero">
                <div class="folder-text" style="color:#fff;">
                    <h1 class="folder-card-title">Planner</h1>
                    <h4 class="folder-card-h4">A weekly plan you can actually trust.</h4>
                    <p class="folder-card-body">See what's due next, what's in progress, and what's done. Start every day with clarity, not tab chaos.</p>
                </div>
                <div class="folder-visual">
                    <div class="app-mockup" style="padding: 20px;">
                        <div class="cal-grid" style="margin-bottom: 10px;">
                            <div class="cal-head">Mon</div><div class="cal-head">Tue</div><div class="cal-head">Wed</div>
                            <div class="cal-head">Thu</div><div class="cal-head">Fri</div><div class="cal-head">Sat</div><div class="cal-head">Sun</div>
                        </div>
                        <div class="cal-grid">
                            <div class="cal-cell"></div>
                            <div class="cal-cell"><div class="cal-ev ev-red">Math PS #7</div></div>
                            <div class="cal-cell"><div class="cal-ev ev-amber">Physics Lab</div></div>
                            <div class="cal-cell"></div>
                            <div class="cal-cell today"><div class="cal-today-lbl">Today</div><div class="cal-ev ev-blue">History Essay</div></div>
                            <div class="cal-cell"></div>
                            <div class="cal-cell"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-spacer"></div>

    <!-- Card 3: AI Agent (Gradient) -->
    <div class="stacking-card" style="z-index:3;">
        <div class="folder-wrapper">
            <svg class="folder-shape-bg" viewBox="0 0 1367 819" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="grad-ai" x1="1367" y1="0" x2="645" y2="1205" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#C0FF01"/>
                        <stop offset="1" stop-color="#1C64F5"/>
                    </linearGradient>
                </defs>
                <path d="M1347.27 818.671C1358.17 818.671 1367 809.839 1367 798.944L1367 125.99C1367 115.094 1358.17 106.262 1347.27 106.262L367.077 106.262C361.101 106.262 355.447 103.553 351.702 98.8955L278.11 7.36607C274.366 2.70872 268.712 -0.000169299 262.736 -0.00016822L19.7279 -0.00012435C8.83249 -0.000122383 3.53992e-05 8.83234 3.49229e-05 19.7277L8.62331e-07 798.943C3.86078e-07 809.839 8.83246 818.671 19.7279 818.671L1347.27 818.671Z" fill="url(#grad-ai)"/>
            </svg>
            <div class="folder-header-bar">
                <div class="folder-tab-label" style="background:#272727;color:rgba(255,255,255,.8);border:1px solid rgba(255,255,255,.15);border-bottom:none;">
                    🤖 AI Agent
                </div>
            </div>
            <div class="folder-hero">
                <div class="folder-text" style="color:#161616;">
                    <h1 class="folder-card-title" style="color:#161616;">AI Agent</h1>
                    <h4 class="folder-card-h4" style="color:rgba(22,22,22,.7);">Your admin sidekick for academic flow.</h4>
                    <p class="folder-card-body" style="color:rgba(22,22,22,.6);">Outline essays, summarise notes, and get project-aware feedback — so your work is polished before you submit.</p>
                </div>
                <div class="folder-visual">
                    <div class="app-mockup">
                        <div class="app-bar">
                            <div class="app-dot"></div><div class="app-dot"></div><div class="app-dot"></div>
                            <div class="app-url">awfulnotes.app/ai</div>
                        </div>
                        <div class="chat-msgs">
                            <div class="chat-row user">
                                <div class="chat-av av-user">👤</div>
                                <div class="chat-bubble bubble-user">Can you help me structure my Physics lab report?</div>
                            </div>
                            <div class="chat-row">
                                <div class="chat-av av-ai">🤖</div>
                                <div class="chat-bubble bubble-ai">Sure! Structure: <strong style="color:#ffdad4">Title → Abstract → Introduction → Methodology → Results → Discussion → Conclusion</strong>. Want me to draft the Methodology?</div>
                            </div>
                            <div class="chat-row user">
                                <div class="chat-av av-user">👤</div>
                                <div class="chat-bubble bubble-user">Yes, draft the Methodology section.</div>
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
            <div class="timeline-img-wrapper">
                <div class="timeline-preview-img active" data-step="1" style="background:#272727;border-radius:12px;height:320px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:14px;">
                    <div style="text-align:center;">
                        <div style="font-size:48px;margin-bottom:12px;">✉️</div>
                        <div>Create account</div>
                    </div>
                </div>
                <div class="timeline-preview-img" data-step="2" style="background:#272727;border-radius:12px;height:320px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:14px;">
                    <div style="text-align:center;">
                        <div style="font-size:48px;margin-bottom:12px;">📋</div>
                        <div>Add assignments</div>
                    </div>
                </div>
                <div class="timeline-preview-img" data-step="3" style="background:#272727;border-radius:12px;height:320px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:14px;">
                    <div style="text-align:center;">
                        <div style="font-size:48px;margin-bottom:12px;">🤖</div>
                        <div>AI handles admin</div>
                    </div>
                </div>
                <div class="timeline-preview-img" data-step="4" style="background:#272727;border-radius:12px;height:320px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:14px;">
                    <div style="text-align:center;">
                        <div style="font-size:48px;margin-bottom:12px;">👥</div>
                        <div>Collaborate as a team</div>
                    </div>
                </div>
            </div>
            <div class="timeline-dots">
                <button class="timeline-dot active" data-step="1"></button>
                <button class="timeline-dot" data-step="2"></button>
                <button class="timeline-dot" data-step="3"></button>
                <button class="timeline-dot" data-step="4"></button>
            </div>
        </div>

        <!-- Steps right -->
        <div class="timeline-content">
            <div class="timeline-step active" data-step="1">
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
                <div class="timeline-number"><span>4</span></div>
                <div class="timeline-text">
                    <h3 class="timeline-step-title">Collaborate as a team</h3>
                    <p class="timeline-step-desc">Track every member's progress, keep everyone aligned, and never ask "so who's doing what?" ever again.</p>
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
            <div class="faq-answer"><p>Awfulnotes is a calm homework workspace built for students. It combines assignment tracking, team collaboration, weekly planning, and AI assistance in one place — replacing the chaos of juggling multiple apps and group chats.</p></div>
        </div>
        <div class="faq-divider"></div>
        <div class="faq-item">
            <button class="faq-question">
                <span>Is Awfulnotes free to use?</span>
                <svg class="faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
            </button>
            <div class="faq-answer"><p>Yes! Early access is completely free. You get unlimited assignments, team collaboration, the weekly planner, and the AI assistant — no credit card required.</p></div>
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


<!-- ══════════ PRICING / INCLUDED ══════════ -->
<section class="pricing-section" id="pricing">
    <div class="pricing-container">
        <div class="price-card">
            <div class="price-left">
                <h3 class="price-headline">Included in your<br>calm workspace:</h3>
                <div class="price-features-grid">
                    <div class="price-feature">
                        <svg class="price-feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>Unlimited assignments</span>
                    </div>
                    <div class="price-feature">
                        <svg class="price-feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>Team collaboration</span>
                    </div>
                    <div class="price-feature">
                        <svg class="price-feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>Weekly planner</span>
                    </div>
                    <div class="price-feature">
                        <svg class="price-feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>AI admin assistant</span>
                    </div>
                    <div class="price-feature">
                        <svg class="price-feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>Deadline reminders</span>
                    </div>
                    <div class="price-feature">
                        <svg class="price-feature-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <span>Good grades (probably)</span>
                    </div>
                </div>
            </div>
            <div class="price-divider"></div>
            <div class="price-right">
                <div class="price-subtext">Try Awfulnotes for free while in beta</div>
                <div class="price-cta-wrap">
                    <a href="{{ route('register') }}" class="cta-btn" style="min-width:200px;">
                        Get started free
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <span style="font-size:12px;color:var(--brand-grey);">No credit card required</span>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ══════════ FINAL CTA ══════════ -->
<section class="final-cta">
    <div class="final-cta-container">
        <div class="cta-text">
            <div class="cta-logo">AN</div>
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
        <div class="footer-links">
            <a href="https://www.envato.com/privacy/" target="_blank" rel="noopener">Privacy Policy</a>
            <a href="#">Terms</a>
        </div>
        <div class="footer-social">
            <a href="mailto:ryzzkun08@gmail.com" aria-label="Email">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </a>
        </div>
        <p class="footer-copy">© {{ date('Y') }} Awfulnotes. All rights reserved.</p>
    </div>
</footer>


<script>
// Nav scroll
const menuEl = document.getElementById('main-menu');
window.addEventListener('scroll', () => {
    menuEl && (window.scrollY > 40 ? menuEl.classList.add('is-scrolled') : menuEl.classList.remove('is-scrolled'));
}, { passive: true });

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
}
document.querySelectorAll('.timeline-step').forEach(s => s.addEventListener('click', () => setTimelineStep(+s.dataset.step)));
document.querySelectorAll('.timeline-dot').forEach(d => d.addEventListener('click', () => setTimelineStep(+d.dataset.step)));

// Stacking cards scroll (simple CSS sticky approach)
// Cards stack naturally via position:sticky + z-index
</script>

</body>
</html>