# Solutions — ranked

Four ways to keep a Bootstrap‑4 front end working on Drupal 11 (jQuery 4). All four were
verified on Drupal 11.3 with the front end rendering, the browser console clean, and the
Bootstrap behaviours (sticky/affix header, scroll classes, dropdowns, collapse, modal,
carousel) running. In every option the admin theme (Claro) keeps jQuery 4.

| # | Solution | What it does | Pros | Cons | Verdict |
| --- | --- | --- | --- | --- | --- |
| **A** | Patch the bundled `bootstrap.min.js` jQuery gate `t[0]>=4` → `t[0]>=5` | Lets Bootstrap 4.6 JS run on Drupal core jQuery 4 | One‑line change; single core jQuery; no new dependency; no bundled jQuery copy; matches [bootstrap4 3.0.7](https://www.drupal.org/project/bootstrap4/issues/3549897) and [bootstrap 8.x‑3.35](https://www.drupal.org/project/bootstrap/issues/3464373) | Carries a locally modified vendor file (documented in `js/bootstrap/README.md`) | **Recommended — shipped by this theme** |
| **B** | Theme‑scoped `libraries-override` of `core/jquery` to a jQuery 3.7.x build | Front end uses jQuery 3.7.x; admin keeps jQuery 4 | No vendor patch | Two jQuery versions on the site; bundles a jQuery copy; diverges from core | Fallback |
| **C** | [`jquery_downgrade`](https://www.drupal.org/project/jquery_downgrade) module | Replaces jQuery 4 with jQuery 3 per node / view route / theme | No theme changes | Extra module; requires configuration; broader than necessary | Use only if A/B are not possible |
| **D** | Move to Bootstrap 5 (jQuery‑free), e.g. Vartheme BS5 | Removes the jQuery dependency at the source | Long‑term correct; maintainers’ recommended path | A migration, not a fix; out of scope for the Bootstrap‑4 line | Long‑term direction |

## Building a custom front-end theme on Bootstrap 4?

Apply the same gate change to your bundled Bootstrap JS (`t[0]>=4` → `t[0]>=5`), or migrate to
Bootstrap 5. Do not ship a second copy of jQuery unless you have a specific reason; prefer the
single core jQuery 4.

## Building a custom theme or module that uses jQuery directly?

Drupal 11 is jQuery 4. Audit and migrate your JavaScript. Common removals/changes:

- `.bind() / .unbind() / .delegate() / .undelegate()` → `.on() / .off()`
- `.size()` → `.length`
- `$.trim`, `$.isArray`, `$.isFunction`, `$.isNumeric`, `$.type`, `$.now`, `$.parseJSON` →
  native `String.prototype.trim`, `Array.isArray`, `typeof x === 'function'`,
  `Number.isFinite`, `JSON.parse`, `Date.now()`
- `.hover()` → `.on('mouseenter mouseleave', …)`
- `$.ajax` `success` / `error` / `complete` → `.done()` / `.fail()` / `.always()`
- `.load()` / `.unload()` / `.error()` event shorthands → `.on('load' …)` etc.

Recommended practice:

1. Attach behaviours through `Drupal.behaviors` with `once()` (`core/once`), not bare
   `$(document).ready`. Declare `core/drupal`, `core/once`, and `core/jquery` (only if needed)
   as library dependencies.
2. Prefer **vanilla JavaScript** for new code (`querySelector`, `addEventListener`,
   `classList`, `fetch`) — no jQuery dependency.
3. In development only, run the official **jQuery Migrate** plugin to log what breaks, then
   remove it before release: <https://github.com/jquery/jquery-migrate>.

## References

See [FINDINGS.md](FINDINGS.md) for the full list of upstream and contributed issues, and the
jQuery 4.0 upgrade guide: <https://jquery.com/upgrade-guide/4.0/>.
