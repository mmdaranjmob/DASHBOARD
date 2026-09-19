@extends('layouts.store')

@section('content')
<style>
:root{--editorial:#f2f0ec;--ink:#0d0c0b;--soft:rgba(13,12,11,.64);--faint:rgba(13,12,11,.42);--rule:rgba(13,12,11,.12);--accent:#08a9df}
.store-home{margin-inline:calc((100vw - min(1270px,calc(100% - 34px)))/-2);background:var(--editorial);color:var(--ink)}
.hero{height:100vh;min-height:640px;position:relative;overflow:hidden;background:var(--editorial)}
.hero-stage{position:absolute;inset:0;overflow:hidden;background:var(--editorial)}
.hero-stage video{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transform:scale(1.02);filter:contrast(1.02);opacity:.72}
.hero-veil{position:absolute;inset:0;background:linear-gradient(to bottom,rgba(242,240,236,.9) 0%,rgba(242,240,236,.18) 24%,rgba(242,240,236,.12) 70%,rgba(242,240,236,.86) 100%),radial-gradient(100% 80% at 50% 48%,transparent 0%,rgba(242,240,236,.4) 100%)}
.hero-grain{position:absolute;inset:-50%;opacity:.1;mix-blend-mode:multiply;pointer-events:none;background-image:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='140' height='140'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='3'/></filter><rect width='140' height='140' filter='url(%23n)' opacity='.5'/></svg>")}
.hero-copy{position:relative;z-index:2;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:120px 20px 90px}
.eyebrow{font-size:12px;letter-spacing:.06em;color:var(--soft);margin-bottom:20px}
.hero h1{font-weight:400;font-size:clamp(42px,7.5vw,105px);line-height:.94;letter-spacing:-.045em;max-width:10ch;margin:0;text-wrap:balance}
.hero-sub{margin:25px 0 0;max-width:520px;color:var(--soft);font-size:16px;line-height:1.7}
.hero-actions{display:flex;gap:10px;margin-top:34px;flex-wrap:wrap;justify-content:center}
.dark-pill,.light-pill{height:48px;border-radius:999px;padding:0 25px;display:inline-flex;align-items:center;justify-content:center;font-size:14px;font-weight:500}
.dark-pill{background:#0a0908;color:#fff}.light-pill{border:1px solid var(--rule);background:rgba(255,255,255,.65);color:var(--ink)}
.scroll-cue{position:absolute;bottom:28px;left:50%;transform:translateX(-50%);font-size:11px;color:var(--faint);letter-spacing:.06em}
.progress-line{position:absolute;left:0;top:0;width:100%;height:2px;background:var(--ink);transform-origin:left;transform:scaleX(0);z-index:4;opacity:.6}
.catalog-section{padding:78px 18px 35px;background:#f7f5f1}
.section-head{display:flex;align-items:end;justify-content:space-between;gap:20px;margin-bottom:28px}
.section-kicker{font-size:11px;color:var(--faint);letter-spacing:.06em}.section-title{margin:6px 0 0;font-size:clamp(30px,4vw,52px);font-weight:400;letter-spacing:-.035em}
.search-box{width:min(360px,100%)}.search-box input{width:100%;height:46px;border:1px solid var(--rule);border-radius:999px;background:#fff;padding:0 18px;outline:0;color:var(--ink)}.search-box input:focus{border-color:#999}
.category-strip{display:flex;gap:8px;overflow:auto;padding-bottom:16px;margin-bottom:10px}.category-chip{white-space:nowrap;border:1px solid var(--rule);background:#fff;border-radius:999px;padding:9px 15px;font-size:12px;color:#665f59}.category-chip.active{background:#0d0c0b;color:#fff;border-color:#0d0c0b}
.products-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px}.product-card{background:#fff;border:1px solid var(--rule);border-radius:18px;overflow:hidden;transition:.3s ease}.product-card:hover{transform:translateY(-4px);box-shadow:0 15px 35px rgba(13,12,11,.08)}.product-media{aspect-ratio:1/.82;background:#eeece8;display:grid;place-items:center;overflow:hidden}.product-media img{width:100%;height:100%;object-fit:cover}.product-placeholder{font-size:48px;color:#aaa39c}.product-body{padding:16px}.product-name{font-size:14px;color:#25211e;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.product-meta{display:flex;justify-content:space-between;gap:8px;margin-top:10px;color:#817971;font-size:11px}.buy-row{display:flex;justify-content:space-between;align-items:center;margin-top:15px}.buy-button{height:36px;border:0;border-radius:999px;background:#0d0c0b;color:#fff;padding:0 15px;cursor:pointer;font-size:11px}.empty-state{padding:70px 20px;text-align:center;border:1px dashed var(--rule);border-radius:18px;color:var(--soft)}
.story{padding:90px 18px;background:#f2f0ec}.story-grid{display:grid;grid-template-columns:1.1fr .9fr;gap:45px;align-items:start}.story h2{font-size:clamp(34px,5vw,68px);font-weight:400;line-height:.98;letter-spacing:-.04em;margin:0}.story p{font-size:15px;line-height:2;color:var(--soft);margin:0 0 18px}.feature-list{display:grid;grid-template-columns:1fr 1fr;gap:10px}.feature{padding:18px;border:1px solid var(--rule);border-radius:14px;background:rgba(255,255,255,.45)}.feature strong{display:block;font-size:12px;margin-bottom:7px}.feature span{font-size:11px;line-height:1.8;color:var(--soft)}
@media(max-width:900px){.products-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.story-grid{grid-template-columns:1fr}.section-head{align-items:stretch;flex-direction:column}.search-box{width:100%}}
@media(max-width:560px){.hero{min-height:620px}.hero h1{font-size:clamp(38px,12vw,56px)}.hero-sub{font-size:14px}.dark-pill,.light-pill{height:44px;padding:0 19px}.catalog-section,.story{padding-inline:12px}.products-grid{grid-template-columns:1fr 1fr;gap:8px}.product-body{padding:12px}.product-name{font-size:12px}.product-meta{font-size:10px}.buy-button{height:34px;padding:0 11px}.story{padding-top:65px;padding-bottom:65px}.feature-list{grid-template-columns:1fr}}
</style>

<div class="store-home">
    <section class="hero" id="storeHero">
        <div class="hero-stage">
            <video id="storeHeroVideo" muted playsinline preload="auto" disablepictureinpicture></video>
            <div class="hero-veil"></div>
            <div class="hero-grain"></div>
        </div>
        <div class="progress-line" id="storeProgress"></div>
        <div class="hero-copy">
            <div class="eyebrow">DIGITAL GOODS · FAST DELIVERY · {{ $siteName }}</div>
            <h1>خرید دیجیتال، ساده و تمیز.</h1>
            <p class="hero-sub">سرویس‌ها و محصولات دیجیتال موردنیازت را انتخاب کن، پرداخت کن و سفارش را از حساب کاربری پیگیری کن.</p>
            <div class="hero-actions">
                <a class="dark-pill" href="#catalog">مشاهده محصولات</a>
                @auth
                    <a class="light-pill" href="{{ route('account.dashboard') }}">حساب من</a>
                @else
                    <a class="light-pill" href="{{ route('auth') }}">ورود / ثبت‌نام</a>
                @endauth
            </div>
        </div>
        <div class="scroll-cue">SCROLL TO EXPLORE</div>
    </section>

    <section class="catalog-section" id="catalog">
        <div class="section-head">
            <div>
                <div class="section-kicker">THE SHOP · {{ $products->count() }} ITEMS</div>
                <h2 class="section-title">{{ $selectedTab?->name ?: ($selectedCategory?->name ?: 'محصولات و خدمات') }}</h2>
            </div>
            <form class="search-box" method="GET" action="{{ route('home') }}">
                @if($selectedCategory)<input type="hidden" name="category" value="{{ $selectedCategory->slug }}">@endif
                @if($selectedTab)<input type="hidden" name="tab" value="{{ $selectedTab->slug }}">@endif
                <input name="q" value="{{ request('q') }}" placeholder="جستجو در محصولات..." aria-label="جستجو در محصولات">
            </form>
        </div>

        <div class="category-strip">
            @foreach($categories as $category)
                <a class="category-chip {{ $selectedCategory?->id === $category->id ? 'active' : '' }}" href="{{ route('home', ['category'=>$category->slug]) }}">{{ $category->name }}</a>
            @endforeach
        </div>

        @if($products->isNotEmpty())
            <div class="products-grid">
                @foreach($products as $product)
                    <a class="product-card" href="{{ route('product.show',$product) }}">
                        <div class="product-media">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <div class="product-placeholder">{{ mb_substr($product->name,0,1) }}</div>
                            @endif
                        </div>
                        <div class="product-body">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-meta">
                                <span>{{ $product->category?->name ?: 'Digital' }}</span>
                                <span>{{ number_format($product->price) }} {{ $product->currency === 'IRR' ? 'ریال' : $product->currency }}</span>
                            </div>
                            <div class="buy-row"><span style="font-size:10px;color:#aaa">جزئیات و خرید</span><span class="buy-button">مشاهده</span></div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty-state">در این دسته هنوز محصولی ثبت نشده است.</div>
        @endif
    </section>

    <section class="story" id="about">
        <div class="story-grid">
            <div>
                <div class="section-kicker">WHY {{ strtoupper($siteName) }}</div>
                <h2>کمتر کلیک کن.<br>سریع‌تر تحویل بگیر.</h2>
            </div>
            <div>
                <p>فروشگاه برای خرید سریع محصولات دیجیتال طراحی شده؛ قیمت‌ها شفاف هستند و سفارش‌ها از داخل حساب کاربری قابل پیگیری‌اند.</p>
                <div class="feature-list">
                    <div class="feature"><strong>تحویل سریع</strong><span>سفارش‌ها بعد از پرداخت وارد فرآیند تحویل می‌شوند.</span></div>
                    <div class="feature"><strong>کیف پول</strong><span>موجودی حساب و تراکنش‌ها در پنل کاربری ثبت می‌شوند.</span></div>
                    <div class="feature"><strong>پیگیری سفارش</strong><span>جزئیات سفارش‌ها و وضعیت تحویل همیشه در دسترس است.</span></div>
                    <div class="feature"><strong>پشتیبانی</strong><span>برای مشکل یا سوال، از بخش تیکت با پشتیبانی در ارتباط باش.</span></div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
(function(){
    "use strict";
    var VIDEO_URL = "https://d2ol7oe51mr4n9.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/45567745-d826-44a2-a5ce-7ef670944e60.mp4";
    // The supplied 1920x1080 all-intra clip is keyframe-friendly, so scroll scrubbing can seek accurately.
    var hero=document.getElementById("storeHero"), clip=document.getElementById("storeHeroVideo"), meter=document.getElementById("storeProgress");
    if(!hero||!clip)return;
    var duration=0,target=0,current=0,ready=false,attached=false;
    function clamp(v,a,b){return Math.max(a,Math.min(b,v))}
    function read(){
        var rect=hero.getBoundingClientRect(), max=Math.max(1,hero.offsetHeight-window.innerHeight);
        var p=clamp((window.pageYOffset-hero.offsetTop)/max,0,1);
        target=p*duration;
        meter.style.transform="scaleX("+p+")";
    }
    function attach(src){
        if(attached)return; attached=true;
        clip.addEventListener("loadedmetadata",function(){duration=clip.duration||0;clip.pause();read();current=target;try{clip.currentTime=current}catch(e){}});
        clip.addEventListener("loadeddata",function(){ready=true});
        clip.addEventListener("canplaythrough",function(){ready=true});
        clip.addEventListener("error",function(){ready=false});
        clip.src=src;clip.load();
    }
    function preload(){
        if(!window.fetch){attach(VIDEO_URL);return}
        var controller=window.AbortController?new AbortController():null, bail=setTimeout(function(){if(!attached){if(controller)controller.abort();attach(VIDEO_URL)}},9000);
        fetch(VIDEO_URL,controller?{signal:controller.signal}:{}).then(function(res){
            if(!res.ok||!res.body)throw new Error("video");
            return res.blob();
        }).then(function(blob){
            clearTimeout(bail);attach(URL.createObjectURL(blob));
        }).catch(function(){clearTimeout(bail);attach(VIDEO_URL)});
    }
    function unlock(){
        var p=clip.play();
        if(p&&p.then)p.then(function(){clip.pause()}).catch(function(){});
        else clip.pause();
    }
    ["touchstart","pointerdown","wheel","keydown"].forEach(function(ev){window.addEventListener(ev,unlock,{once:true,passive:true})});
    function frame(){
        if(ready&&duration){
            var gap=target-current;
            if(Math.abs(gap)>.0008){
                current+=gap*.115;
                if(clip.readyState>=2&&!clip.seeking){try{clip.currentTime=current}catch(e){}}
            }
        }
        requestAnimationFrame(frame);
    }
    window.addEventListener("scroll",read,{passive:true});
    window.addEventListener("resize",read);
    read();preload();requestAnimationFrame(frame);
})();
</script>
@endsection
