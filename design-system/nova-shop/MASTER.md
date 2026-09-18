# NOVA SHOP — UI/UX Pro Max Design System

## Source
Based on UI UX Pro Max v2.15.0:
https://github.com/nextlevelbuilder/ui-ux-pro-max-skill

## Product
E-commerce storefront, Persian RTL, Laravel + Blade + Vite.

## Design direction
Primary: Vibrant & Block-based.
Supporting accents: restrained Aurora UI and Motion-Driven micro-interactions.
Landing pattern: Feature-Rich Showcase.

## Color tokens
Use an emerald-led light palette inspired by the E-commerce profile:
- primary: #059669
- primary-strong: #047857
- secondary: #10B981
- accent: #EA580C
- background: #ECFDF5
- foreground: #064E3B
- surface: #FFFFFF
- muted-surface: #E8F1F3
- muted-text: #475569
- border: #A7F3D0
- destructive: #DC2626

Keep semantic tokens in CSS; do not scatter raw colors through Blade markup.

## Typography
Keep Vazirmatn for Persian readability. Use a clear type scale, strong heading hierarchy, body text around 16px+, and comfortable line-height.

## Homepage composition
Hero > categories > featured products > promotion > benefits/trust > footer.

The hero should communicate the value proposition immediately, contain one dominant CTA, and expose a visual product cue without depending on heavy animation.

Product cards should be image-first, scannable, consistent, and include title, short metadata, rating, price, discount/badge, and an obvious add-to-cart action.

## Motion
Use short, contextual transitions. Prefer opacity/transform. Avoid animating layout dimensions. Disable decorative motion under reduced-motion preferences.

## Icons
Use one consistent outline SVG family. Structural icons must never be emoji or text glyph substitutes.

## Accessibility
Normal text contrast >= 4.5:1. Provide visible focus, semantic headings, accessible icon controls, keyboard support, and aria-live feedback for cart/toasts.

## Responsive
Mobile-first, no horizontal scroll, consistent container width, comfortable touch targets, and stable media aspect ratios.

## Laravel
Use @vite for assets. Keep repeated interface patterns ready for extraction into Blade components as the project grows.
