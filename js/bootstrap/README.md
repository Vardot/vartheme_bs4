Move the Bootstrap JavaScript files into our js/bootstrap folder

---

## Drupal 11 / jQuery 4 note

`bootstrap.min.js` is **Bootstrap v4.6.0**. Drupal 11 core ships **jQuery 4**, which the stock
Bootstrap 4 JS rejects (`requires at least jQuery v1.9.1 but less than v4.0.0`). This theme
raises the gate `t[0]>=4` → `t[0]>=5` so it runs on jQuery 4. **If you re-minify or replace
this file, re-apply that change.**

Full background, options, and jQuery 3 → 4 migration guidance for custom themes and modules:
see `../../docs/Drupal11-jQuery4-Bootstrap-Compatibility/` and issue
https://www.drupal.org/project/vartheme_bs4/issues/3607041
