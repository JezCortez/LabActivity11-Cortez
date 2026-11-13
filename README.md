# LabActivity11-Cortez

**Barangay Bulletin – Purok Cortez**, Lab Activity 11: relationships, eager loading and Form Requests.
By Jez Cortez · 4-334 Full-Stack Web Development · Ateneo de Davao University

Builds on Lab 10. Posts now show their author and tags, residents can comment, and Kagawads can write posts from the site.

## Logins

Both use password `bulletin2026`.

| Role | Email |
| --- | --- |
| Resident | lola.cortez@bulletin.test |
| Kagawad (has an author profile) | kagawad.cortez@bulletin.test |

## Tags

Purok Cortez, Urgent, Libre, Schedule, Pamilya (my own).

## Relationships and why

- **User hasOne Author.** A login account is linked to at most one author profile. Only users with one can post.
- **Author hasMany Post / Post belongsTo Author.** One author writes many posts; each post has one author.
- **Post hasMany Comment / Comment belongsTo Post.** A post collects many comments.
- **User hasMany Comment / Comment belongsTo User.** A resident can write many comments.
- **Post belongsToMany Tag** (pivot `post_tag`). A post has several tags and a tag is on many posts.
- **Author hasManyThrough Comment** (via Post). Counts "comments received" on the author page without looping over posts.

## Run

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run dev          # terminal 1
php artisan serve    # terminal 2
```

If `database/database.sqlite` is missing, create it first.
