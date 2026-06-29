# Drupal 11, jQuery 4 and Bootstrap 4 — compatibility in Vartheme (Bootstrap 4 - SASS)

This folder documents how Vartheme BS4 keeps its Bootstrap 4 front end working on
**Drupal ~11.3**, which ships **jQuery 4** in core, and how teams building **custom themes
and modules** should approach the same change.

It is written for the community: maintainers, site builders and contributors can read it,
link to it, and follow the upstream and contrib issues it references.

## The short version

- Drupal 11 core ships **jQuery 4.0.0** (`core/jquery`).
- Bootstrap 4 JavaScript is jQuery‑dependent and contains a hard version gate that **rejects
  jQuery ≥ 4**, throwing on every page:
  `Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0`.
- When it throws, Bootstrap behaviours stop running: sticky/affix header, scroll classes,
  dropdowns, collapse / navbar toggler, modal, carousel, tooltips.
- Bootstrap 5 dropped the jQuery dependency, so it is unaffected.

## What this theme does

Vartheme BS4 raises the gate in its bundled `js/bootstrap/bootstrap.min.js` from `t[0]>=4`
to `t[0]>=5`, so Bootstrap 4.6 runs on Drupal’s jQuery 4 with no extra dependency and no
second copy of jQuery. This mirrors the approach taken by the official Drupal **Bootstrap 4**
theme (release `3.0.7`) and the **Bootstrap** theme (`8.x-3.35`).

Tracking issue: **[#3607041 — Fix Bootstrap JavaScript jQuery 4 compatibility on Drupal
~11.3](https://www.drupal.org/project/vartheme_bs4/issues/3607041)**.

## Contents

- [FINDINGS.md](FINDINGS.md) — root cause, the upstream/contrib precedents, and the source links.
- [SOLUTIONS.md](SOLUTIONS.md) — the ranked options (A–D) with trade‑offs, and guidance for
  custom themes and modules migrating jQuery 3 code to jQuery 4.

See also `js/bootstrap/README.md` in this theme for the in‑place note next to the patched file.
