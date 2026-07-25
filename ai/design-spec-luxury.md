# DineCraft Luxury Redesign Spec

## Direction
**Maison Atelier** — cool-stone luxury dining: ink, champagne brass, and editorial typography. Distinct from the prior warm-cream / terracotta restaurant template.

Reference screenshot (`localhost:3002/.../1784989418719-3d079898a139.png`) was unreachable from this environment; direction follows the customer **Luxury** hint plus theme design rules.

## Palette
| Token | Value | Role |
|-------|-------|------|
| `--yr-bg` | `#F1F0EC` | Cool stone page ground |
| `--yr-fg` | `#141210` | Ink text |
| `--yr-card` | `#FAFAF8` | Soft surfaces |
| `--yr-primary` | `#1A1714` | Ink primary (restraint) |
| `--yr-accent` | `#A8875B` | Champagne brass |
| `--yr-secondary` | `#E6E4DE` | Stone wash bands |
| `--yr-dark` | `#0D0C0B` | Cinematic sections |
| `--yr-cta` | `#3D2A24` | Deep espresso CTA band |
| `--yr-muted` | `#6A655F` | Secondary copy |

## Typography
- Display: **Cormorant Garamond** (serif, italic highlights)
- UI / body: **Outfit** (geometric sans, not Inter/system)

## Layout principles
1. Full-bleed cinematic hero; brand name is a hero-level signal.
2. Stats live below the first viewport (after 100vh hero).
3. Dish / menu items keep interactive card chrome; testimonials / values use lighter editorial treatment.
4. Subtle paper-grain atmosphere on light sections; no purple glow or pill clusters.
5. Motions: header glass on scroll, hero ken-burns, reveal-on-scroll for sections.

## Mapping
| Component | Files |
|-----------|-------|
| Tokens / global | `assets/css/main.css`, `theme.json`, `style.css` |
| Header / fonts | `header.php` |
| Hero / home | `front-page.php` |
| Cards | `template-parts/*-card.php` |
| Footer | `footer.php` |
| Motion | `assets/js/main.js` |

## Protected (unchanged)
`functions.php`, `inc/**`, booking/WooCommerce PHP logic, APIs, admin, database.
