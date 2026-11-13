# LabActivity10-Cortez

**Barangay Bulletin – Purok Cortez**
A small bulletin board for Barangay Matina Crossing Hall, Davao City. Officials post announcements; residents browse, search and page through them. Built with Laravel, Eloquent, SQLite and Blade + Tailwind (via Vite).

Lab Activity 10 · 4-334 Full-Stack Web Development · Ateneo de Davao University
By Jez Cortez

## My personalization

| Item | Value |

|---|---|

| Site title | Barangay Bulletin – Purok Cortez |
| Posts per page | **6**. "Cortez" has 6 letters, which is also the minimum |
| Custom category | **Livelihood** (plus Announcement, Health, Peace & Order, Ayuda) |
| Birthday post date | **YYYY-MM-DD** (fill in; must be a 2026 date) |
| Pinned post | "Purok Cortez Clean-up Drive" |
| Kagawad author | Kagawad Jez Cortez · kagawad.cortez@bulletin.test |

## Features

- Migrations for `authors` and `posts`, plus a separate `add_views_to_posts_table` migration
- Eloquent models with `$fillable` and casts
- Faker factories, including a `draft()` state
- Seeders: 5 authors, 51 posts (40 published, 10 drafts, 1 pinned)
- `/posts`: published only, pinned first, then newest, with `?q=` title search and `?category=` filter
- Pagination that keeps the search and filter (`withQueryString()`)
- `/posts/{id}`: 404 for missing or draft posts, and increments the view counter

## How to run

``` bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run dev          # terminal 1
php artisan serve    # terminal 2
```

If `database/database.sqlite` doesn't exist, create it first:
`touch database/database.sqlite` (Git Bash) or `New-Item database/database.sqlite` (PowerShell).

Then open http://127.0.0.1:8000/posts.

For a production build, run `npm run build`. It creates `public/build/manifest.json`.

After seeding, tinker should report 5 authors, 51 posts and 10 drafts:

``` bash
php artisan tinker
>>> App\Models\Author::count()
>>> App\Models\Post::count()
>>> App\Models\Post::where('is_published', false)->count()
```

## Tinker screenshot

`docs/tinker.png` shows `find()`, changing an attribute, then `save()`.
