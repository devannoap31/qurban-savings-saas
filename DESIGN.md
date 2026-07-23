---
version: alpha
name: Webflow Dynamic Minimal
description: A bright, high-contrast SaaS system with bold typography, crisp blue accents, and spacious editorial hierarchy.
colors:
  primary: "#146EF5"
  secondary: "#D8D8D8"
  tertiary: "#F0F0F0"
  neutral: "#FFFFFF"
  surface: "#FFFFFF"
  on-surface: "#080808"
  muted: "#6B6B6B"
  border: "#D8D8D8"
  background: "#FFFFFF"
  error: "#D92D20"
  success: "#12B76A"
typography:
  headline-display:
    fontFamily: WF Visual Sans Variable
    fontSize: 64px
    fontWeight: 600
    lineHeight: 1.04
    letterSpacing: -0.01em
  headline-lg:
    fontFamily: WF Visual Sans Variable
    fontSize: 45px
    fontWeight: 600
    lineHeight: 1.04
    letterSpacing: 0em
  headline-md:
    fontFamily: WF Visual Sans Variable
    fontSize: 22px
    fontWeight: 600
    lineHeight: 1.3
    letterSpacing: 0em
  headline-sm:
    fontFamily: WF Visual Sans Variable
    fontSize: 18px
    fontWeight: 600
    lineHeight: 1.22
    letterSpacing: 0em
  body-lg:
    fontFamily: WF Visual Sans Variable
    fontSize: 18px
    fontWeight: 400
    lineHeight: 1.6
    letterSpacing: 0em
  body-md:
    fontFamily: WF Visual Sans Variable
    fontSize: 16px
    fontWeight: 400
    lineHeight: 1.6
    letterSpacing: 0em
  body-sm:
    fontFamily: WF Visual Sans Variable
    fontSize: 14px
    fontWeight: 400
    lineHeight: 1.5
    letterSpacing: 0em
  label-lg:
    fontFamily: WF Visual Sans Variable
    fontSize: 16px
    fontWeight: 500
    lineHeight: 1.4
    letterSpacing: 0em
  label-md:
    fontFamily: WF Visual Sans Variable
    fontSize: 14px
    fontWeight: 500
    lineHeight: 1.4
    letterSpacing: 0em
  label-sm:
    fontFamily: WF Visual Sans Variable
    fontSize: 12px
    fontWeight: 500
    lineHeight: 1.3
    letterSpacing: 0em
rounded:
  none: 0px
  sm: 4px
  md: 8px
  lg: 12px
  xl: 16px
  full: 9999px
spacing:
  xs: 8px
  sm: 16px
  md: 24px
  lg: 52px
  xl: 88px
components:
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "{colors.neutral}"
    typography: "{typography.label-lg}"
    rounded: "{rounded.sm}"
    padding: 16px 24px
    size: 144px
    height: 58px
  button-secondary:
    backgroundColor: "{colors.neutral}"
    textColor: "{colors.on-surface}"
    typography: "{typography.label-lg}"
    rounded: "{rounded.sm}"
    padding: 16px 24px
    size: 144px
    height: 58px
  button-link:
    backgroundColor: "transparent"
    textColor: "{colors.on-surface}"
    typography: "{typography.body-md}"
    rounded: "{rounded.none}"
    padding: 0px
  card:
    backgroundColor: "{colors.tertiary}"
    textColor: "{colors.on-surface}"
    rounded: "{rounded.md}"
    padding: 13px
  input:
    backgroundColor: "{colors.neutral}"
    textColor: "{colors.on-surface}"
    rounded: "{rounded.sm}"
    padding: 16px 16px
    height: 56px
  chip:
    backgroundColor: "{colors.tertiary}"
    textColor: "{colors.on-surface}"
    typography: "{typography.label-sm}"
    rounded: "{rounded.full}"
    padding: 6px 10px
---

# Webflow Dynamic Minimal

## Overview
This system feels polished, fast, and conversion-focused, with a strong SaaS/editorial personality. It balances a clean white canvas with a vivid blue accent, creating a tone that is confident and modern rather than decorative. The layout is spacious and highly legible, suited to marketing pages that need to communicate complexity with clarity.

## Colors
- **Primary (#146EF5):** A saturated electric blue used for the main CTA, product highlights, announcement bars, and interactive emphasis. It gives the brand energy and immediacy without overpowering the page.
- **Neutral / Surface (#FFFFFF):** The dominant background color, providing an open, bright stage for dense content and strong typographic hierarchy.
- **On-surface (#080808):** A near-black used for headlines, navigation, body text, and utility text. It creates sharp contrast and keeps the interface crisp.
- **Secondary (#D8D8D8):** A light border and divider tone used to separate navigation, cards, and subtle UI edges.
- **Tertiary (#F0F0F0):** A soft neutral panel color for cards and elevated content blocks, keeping the interface light and understated.
- **Muted (#6B6B6B):** A supporting text tone for descriptions and secondary labels, helping establish hierarchy without reducing readability too much.
- **Error (#D92D20):** Reserved for validation, destructive actions, and alert states where a clear semantic signal is needed.
- **Success (#12B76A):** A utility semantic green for confirmations and positive system feedback.

## Typography
The system uses **WF Visual Sans Variable** across headlines, body, and labels, creating a unified and contemporary voice. Headlines are bold and compact, with the display size set large and tight for strong hero messaging; the H1 treatment feels especially purposeful with a subtle negative letter-spacing. Body text stays clean at 16px with comfortable line-height, while labels and navigation use medium weight for clarity and scannability. Uppercase styling is not a dominant pattern; the brand relies more on weight, size, and spacing than on all-caps conventions.

## Layout
The page uses a fluid, full-width marketing layout with a centered content axis and large vertical breathing room between sections. The spacing rhythm is generous, with clear jumps between hero, feature cards, and supporting trust content; the scale in `xs`, `sm`, `md`, `lg`, and `xl` should be used consistently to preserve that airy feel. Cards and content blocks use modest internal padding rather than heavy framing, and major sections rely on white space rather than dense separators. The overall effect is editorial and expansive, with strong alignment and predictable gutters.

## Elevation & Depth
Depth is intentionally restrained. The UI leans on contrast, thin borders, and tonal surfaces instead of dramatic shadows; most controls and cards remain flat. Where depth does appear, it is subtle and functional, such as soft shadowing on floating overlays or cookie dialogs, but the primary hierarchy comes from size, color, and whitespace. This keeps the interface feeling fast, modern, and uncluttered.

## Shapes
Corner radii are minimal and consistent, with `4px` on interactive controls and a slightly softer `8px` on cards. The shape language feels efficient and product-led rather than playful. Rounded elements exist to soften the system just enough, but never enough to dilute the crisp, professional character.

## Components
**Buttons:** The primary button (`button-primary`) is a solid blue CTA with white text, 16px/24px padding, 58px height, and a 4px radius. It should be used for the most important action on a page, especially conversion points like “Start for free.” The secondary button (`button-secondary`) is white with a light border and dark text, matching the same size and padding for balanced pairing. Link-style actions (`button-link`) are text-only, borderless, and visually quiet, reserved for low-emphasis actions such as inline navigation or supporting CTAs.

**Cards:** Cards (`card`) use a pale neutral surface, a faint border, and `8px` radius. They should feel like lightly framed content modules rather than elevated containers. Padding is modest, so content can remain compact without feeling crowded.

**Inputs:** Inputs should mirror the button and card language: white surfaces, subtle borders, and `4px` rounding. Fields should feel clean, stable, and easy to scan, with labels in medium-weight body styles. Error states should use the `error` color sparingly and clearly.

**Chips and tags:** Chips should be small, rounded pills with the tertiary background and compact padding. They work best for status markers like “NEW” or version badges such as “2.0,” where the goal is quick recognition without distracting from adjacent headlines.

**Navigation:** Top-nav links are plain, dark, and lightweight, with minimal ornamentation. The header should remain calm and functional, allowing the primary CTA to stand out through color and button treatment alone.

**Announcement bars and utility banners:** These should use the `primary` color with white text and tight vertical spacing. They are best treated as attention cues, not as competing hero content.

## Do's and Don'ts
- Do keep the page mostly white and let typography carry the hierarchy.
- Do use the primary blue sparingly for the strongest action or key product signals.
- Do maintain consistent 4px radii on controls and 8px on cards.
- Do prefer light borders and tonal surfaces over heavy shadows or loud separators.
- Do use WF Visual Sans Variable for every text style to preserve the brand voice.
- Don't introduce highly saturated secondary colors that compete with the primary blue.
- Don't make cards overly elevated or shadow-heavy; the system is intentionally flat.
- Don't use decorative type treatments, scripts, or exaggerated letter-spacing.