# Findings — Drupal 11 / jQuery 4 / Bootstrap 4

## 1. Drupal 11 core ships jQuery 4

Drupal 11 updated the core jQuery library to **4.0.0** (`core/jquery` in
`core/core.libraries.yml`). jQuery 4 removed long‑deprecated APIs and dropped Internet
Explorer support. Core ships no site‑wide backward‑compatibility shim; contributed and
custom code must adapt.

- Drupal core issue: **[#3411839 — \[11.x\] Update to jQuery 4.0.x](https://www.drupal.org/project/drupal/issues/3411839)**
- jQuery 4.0 upgrade guide: <https://jquery.com/upgrade-guide/4.0/>

## 2. Why Bootstrap 4 breaks on jQuery 4

Bootstrap 4’s JavaScript is jQuery‑dependent and asserts a supported jQuery range at start‑up.
The bundled `js/bootstrap/bootstrap.min.js` (Bootstrap **v4.6.0**) contains:

```js
// jQuery version check (minified): rejects jQuery major >= 4
...||t[0]>=4)throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")
```

`t[0]` is the jQuery major version. On Drupal 11 (`t[0] === 4`) the check throws, so none of
the Bootstrap behaviours initialise. Symptoms on the front end: sticky/affix header not
sticking, scroll state classes never added, dropdowns / navbar toggler / collapse / modal /
carousel inert, and a console error on every page.

Upstream Bootstrap declares the peer dependency `jquery@"1.9.1 - 3"`, which also blocks
jQuery 4 at the package level:

- Bootstrap (twbs) issue: **[#42023 — jQuery 4 support for Bootstrap 4](https://github.com/twbs/bootstrap/issues/42023)**

Note: **Bootstrap 5** removed the jQuery dependency entirely and is not affected.

## 3. How the Drupal community handled this

Two consistent strategies appear across themes: **patch the bundled Bootstrap JS version
gate** (for projects staying on Bootstrap 3/4), or **move to Bootstrap 5** (no jQuery).

| Project | Bootstrap | Approach | Landed in |
| --- | --- | --- | --- |
| [Bootstrap (8.x‑3.x)](https://www.drupal.org/project/bootstrap) | 3 | Switched the bundled library to a maintained fork (`entreprise7pro/bootstrap`) patched to accept jQuery 4; removed IE support. See **[#3464373](https://www.drupal.org/project/bootstrap/issues/3464373)** and **[#3428283](https://www.drupal.org/project/bootstrap/issues/3428283)**. | `8.x‑3.34` / `8.x‑3.35` |
| [Bootstrap 4](https://www.drupal.org/project/bootstrap4) | 4 | Updated the bundled Bootstrap JS to remove the `< 4.0.0` jQuery constraint. See **[#3549897](https://www.drupal.org/project/bootstrap4/issues/3549897)**. | `3.0.7` |
| [Radix](https://www.drupal.org/project/radix) | 4 | Closed as won’t‑fix (Bootstrap 4 / Radix 4 end‑of‑life); recommends Radix 5 / Bootstrap 5. Interim workarounds noted: `jquery_downgrade`, `libraries-override`. See **[#3530127](https://www.drupal.org/project/radix/issues/3530127)**. | — |
| [Bootstrap SASS](https://www.drupal.org/project/bootstrap_sass) | 5 | Drupal 11 / jQuery 4 readiness (Bootstrap 5, jQuery‑free). See **[#3484929](https://www.drupal.org/project/bootstrap_sass/issues/3484929)**. | — |

Related contributed module: **[jQuery Downgrade](https://www.drupal.org/project/jquery_downgrade)**
replaces jQuery 4 with jQuery 3 on selected nodes, view routes, or themes (requires
configuration).

## 4. What Vartheme BS4 does

Vartheme BS4 follows the same precedent as the Bootstrap 4 and Bootstrap themes: it raises
the bundled JS gate `t[0]>=4` → `t[0]>=5`, keeping a single jQuery (Drupal core 4), no new
dependency, and no bundled jQuery copy. The admin theme (Claro) is unaffected and keeps
jQuery 4.

Tracking issue: **[#3607041](https://www.drupal.org/project/vartheme_bs4/issues/3607041)**.

## References

- Drupal core — Update to jQuery 4.0.x: <https://www.drupal.org/project/drupal/issues/3411839>
- jQuery 4.0 upgrade guide: <https://jquery.com/upgrade-guide/4.0/>
- Bootstrap (twbs) — jQuery 4 support for Bootstrap 4: <https://github.com/twbs/bootstrap/issues/42023>
- Drupal Bootstrap 4 theme — jQuery 4 compatibility (3.0.7): <https://www.drupal.org/project/bootstrap4/issues/3549897>
- Drupal Bootstrap theme — jQuery 4 compatibility (8.x‑3.35): <https://www.drupal.org/project/bootstrap/issues/3464373>
- Drupal Bootstrap theme — D11 automated compatibility: <https://www.drupal.org/project/bootstrap/issues/3428283>
- Radix theme — jQuery 4 error and workarounds: <https://www.drupal.org/project/radix/issues/3530127>
- Bootstrap SASS — Drupal 11 / jQuery 4: <https://www.drupal.org/project/bootstrap_sass/issues/3484929>
- jQuery Downgrade module: <https://www.drupal.org/project/jquery_downgrade>
