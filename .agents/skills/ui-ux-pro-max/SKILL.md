---
name: ui-ux-pro-max
description: Project-local UI/UX design guidance based on the official UI UX Pro Max v2.15.0. Use for designing, building, reviewing, or fixing interfaces in this Laravel storefront, including layout, accessibility, responsive behavior, typography, color, motion, icons, and conversion-oriented ecommerce structure.
---

# UI/UX Pro Max — Project Profile

This project profile is derived from the official UI UX Pro Max v2.15.0 guidance.

## Before changing UI
1. Read `design-system/nova-shop/MASTER.md`.
2. For the homepage, also read `design-system/nova-shop/pages/home.md`.
3. Keep the existing Laravel + Blade + Vite stack. Use `@vite` for assets.
4. Prefer semantic HTML, SVG icons, CSS design tokens, and reusable Blade components for repeated UI.

## Ecommerce direction
For this storefront use:
- Product type: E-commerce
- Primary direction: Vibrant & Block-based
- Supporting direction: restrained Aurora UI / Motion-Driven accents
- Landing structure: Feature-Rich Showcase
- Palette direction: emerald brand primary + success green with orange action accents
- Main objective: strong visual hierarchy without noisy decoration

## Interaction rules
- One clear primary CTA per region; secondary actions are visually subordinate.
- Use visible hover/focus/pressed states without shifting layout.
- Keep interactive targets comfortable and keyboard accessible.
- Use SVG icons from one visual family; never use emoji as structural icons.
- Use reduced-motion fallbacks.
- Search/filter interactions must work without hover-only behavior.
- Use accessible names for icon-only controls.

## Responsive rules
- Mobile-first layout.
- No horizontal scrolling.
- Preserve readable text measure.
- Use consistent spacing tokens on an approximately 4/8px rhythm.
- Reserve media dimensions to reduce layout shift.
- Avoid excessive continuous animation.

## Accessibility
- Keep normal text contrast at least 4.5:1.
- Use semantic headings in order.
- Use `aria-label` for icon-only buttons.
- Use `aria-live` for cart/feedback status.
- Keep focus visible with ` :focus-visible` styles.
- Respect `prefers-reduced-motion`.

## Delivery checklist
Before finalizing a page:
- Check 375px and desktop layouts.
- Check keyboard focus and icon labels.
- Check reduced motion.
- Check long Persian text wrapping.
- Check that price, badge, and search states do not cause layout jumps.
- Run the Laravel/Vite build after UI changes.

## Official source
https://github.com/nextlevelbuilder/ui-ux-pro-max-skill
Reference release: v2.15.0
