# Deployment (CI/CD)

Auto-deploy via GitHub Actions + rsync-over-SSH to Hostinger.

## Flow

```
feature/*  --PR-->  staging  --(auto deploy)-->  stage.emxautodiagnosisandrepair.com
                       |
                   review on stage
                       |
                   PR staging --> master  --(deploy)-->  www.emxautodiagnosisandrepair.com
```

- Push/merge to **`staging`** → deploys the **staging** site.
- Push/merge to **`master`** → deploys **production**.
- You can also re-run a deploy manually from the **Actions** tab (workflow_dispatch).

## One-time setup

### 1. GitHub repository secrets
Repo → **Settings → Secrets and variables → Actions → New repository secret**:

| Secret | Value |
|--------|-------|
| `SSH_HOST` | `92.112.189.249` |
| `SSH_PORT` | `65002` |
| `SSH_USER` | `u302575614` |
| `SSH_PRIVATE_KEY` | full contents of the deploy private key (`-----BEGIN …` to `… END-----`) |

### 2. Branches
Create a long-lived `staging` branch from `master` and push it. Both branches must
contain `.github/workflows/deploy.yml` for deploys to trigger.

### 3. (Optional) Production approval gate
Repo → **Settings → Environments → `production` → Required reviewers** → add yourself.
Merges to `master` will then build and **wait for your approval** before writing to the
live server. Without this, production deploys run automatically.

## What a deploy does

1. `rsync --delete` the repo to the target folder, honoring `.deploy/rsync-exclude.txt`.
2. On the server: `composer install --no-dev`, rebuild Laravel caches, `storage:link`.
3. **Production only:** `php artisan migrate --force`.
4. **Staging only:** overwrite `public/robots.txt` with `Disallow: /`.

## Never touched by a deploy (protected in `.deploy/rsync-exclude.txt`)

`.env` · `storage/` · `public/uploads/` · `vendor/` · root `.htaccess` ·
the nested `stage.…/` folder (so a prod deploy can't wipe staging).

## Important caveats

- **Shared database.** Staging and production currently share one DB
  (`u302575614_emx`). Because of this, **migrations run on production only** — a
  staging deploy will NOT alter the shared schema. When you split the DB (give
  staging its own `.env` DB credentials), add the migrate step to the staging
  branch too.
- **Server `.env` is the source of truth** for config. Production must have
  `APP_ENV=production` and `APP_DEBUG=false`. Deploys never overwrite `.env`.
- **robots.txt**: the committed version is the production version. Do not add
  `Disallow: /` to it — staging gets that automatically at deploy time.

## Rollback

Revert the bad commit (or merge the previous good state) and push to the branch —
the pipeline redeploys the reverted code. For an instant manual rollback, you can
also `git revert` and push, or re-run an older successful deploy via workflow_dispatch
after checking out the good ref.
