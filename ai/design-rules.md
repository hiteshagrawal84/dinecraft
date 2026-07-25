# DineCraft AI Design Rules

You are redesigning the **existing** DineCraft WordPress theme. You are NOT creating a new theme.

## Absolute rules

1. Preserve WordPress, booking/reservation, WooCommerce, payments, APIs, authentication, admin, and database behavior.
2. Do not replace dynamic data with mock/hardcoded content.
3. Do not modify protected files unless a presentation-only change is required and cannot be done in CSS/templates.
4. Do not change database schema or REST/API contracts.
5. Keep the theme responsive (mobile, tablet, desktop).
6. Match the customer prompt and reference screenshot as closely as practical without breaking functionality.
7. If the screenshot conflicts with functionality, preserve functionality.
8. Reuse existing components and template parts; avoid new heavy dependencies.
9. Strip secrets from any commit; never add API keys or `.env` files.
10. Keep `style.css` theme header (Theme Name, Version, Text URI) valid for WordPress.

## Preferred edit surfaces

- Colors, typography, spacing via CSS custom properties / `theme.json`
- Layout and component chrome in template parts
- Hero, cards, navigation presentation
- Asset imagery when the customer provides direction

## Output expectations

- Meaningful visual redesign aligned to the customer brief
- Working theme that activates in WordPress without PHP fatals
- Responsive layouts
- Document known limitations briefly in the final response
