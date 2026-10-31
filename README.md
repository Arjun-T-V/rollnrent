# RollNRent

RollNRent is a bike rental website built with PHP, MySQL and Bootstrap. It combines three parts in one folder:

| Part | What it is | Entry point |
|---|---|---|
| **Bike site** | Static marketing pages (home, about, bikes, partner, membership, rental types, contact) | `index.html` |
| **Rental portal** | PHP user area: bike listing, search, details, booking, profile, testimonials (based on the CarForYou template) | `car-listing.php` |
| **Admin panel** | Manage brands, vehicles, bookings, users, testimonials, pages and subscribers | `admin-login.php` |

## Requirements

- PHP 7.4 or newer with the `pdo_mysql` and `mysqli` extensions
- MySQL or MariaDB
- Apache (XAMPP, WAMP or similar), or PHP's built-in server for a quick look

## Setup

1. Copy the project folder into your web root (for XAMPP: `htdocs/rollnrent-main`).
2. Create the portal database and import the dump:
   - Create a database named `bikerental`.
   - Import `carrental.sql` into it.
3. Create the database used by the bike-site login and registration:
   - Create a database named `project`.
   - Add a `users` table with the columns `id` (auto-increment primary key), `username`, `email` and `password`.
4. Check the database settings if your MySQL setup differs from the defaults (`localhost`, user `root`, empty password):
   - `includes/config.php` for the portal and admin panel (database `bikerental`)
   - `php/config.php` for `login.php` and `register.php` (database `project`)
5. Open `http://localhost/rollnrent-main/index.html`.

## Pages and URLs

**Bike site (static):** `index.html`, `aboutus.html`, `bike.html`, `partner.html`, `membership.html`, `rentaltype.html`, `contact.html`. The "Get Started" button opens `login.php`.

**Bike-site login:** `login.php` and `register.php` (stored in the `project` database).

**Rental portal:**

- Browse: `car-listing.php`, `search.php`, `search-carresult.php`, `vehical-details.php`
- Content: `aboutus.php`, `contact-us.php`, `page.php?type=faqs` (also `aboutus`, `privacy`, `terms`)
- Account (requires the portal login): `profile.php`, `update-password.php`, `my-booking.php`, `post-testimonial.php`, `my-testimonials.php`
- Login, registration and forgot-password are modal windows included on the portal pages.

**Admin panel:** sign in at `admin-login.php`. After login you land on `dashboard.php`, and the sidebar links to every management page.

The seeded admin account is `admin` with the password `Test@12345`. Change it from **Change Password** in the admin panel straight away.

## Project structure

```
rollnrent-main/
├── index.html, aboutus.html, ...   Bike site pages
├── login.php, register.php         Bike-site login/registration (php/config.php)
├── car-listing.php, ...            Rental portal pages
├── admin-login.php, dashboard.php, manage-*.php, ...   Admin panel pages
├── includes/
│   ├── config.php                  Portal/admin database connection (PDO)
│   ├── header.php, footer.php      Portal header and footer
│   ├── sidebar.php                 Portal account sidebar
│   ├── login.php, registration.php, forgotpassword.php   Portal modals
│   ├── admin-header.php            Admin top bar
│   └── leftbar.php                 Admin sidebar
├── php/config.php                  Bike-site database connection (mysqli)
├── css/                            Stylesheets
├── js/                             Scripts
├── img/                            Images (img/vehicleimages holds vehicle photos)
├── images/                         Portal page images
├── fonts/                          Font Awesome and Glyphicons
├── carrental.sql                   Database dump for the portal and admin panel
└── project/                        Standalone copy of the bike site
```

### Which CSS and JS goes with which part

| Part | CSS | JS |
|---|---|---|
| Bike site | `css/bike-style.css` (home), `about.css`, `bike.css`, `contact.css`, `membership.css`, `partner.css`, `rentaltype.css`, `login.css` | `js/bike-menu.js` |
| Rental portal | `css/style.css`, `bootstrap.min.css`, `font-awesome.min.css`, plus the carousel and slider styles | `js/interface.js`, `jquery.min.js`, `bootstrap.min.js` and the carousel and slider scripts |
| Admin panel | `css/admin.css`, `bootstrap.min.css`, `font-awesome.min.css`, DataTables, bootstrap-select, fileinput and checkbox styles | `js/admin.js`, `jquery.min.js`, `bootstrap.min.js`, DataTables, bootstrap-select, fileinput and Chart.js |

Keep these separate. `css/style.css` is the portal theme, so the bike homepage must not use it. This is why the bike styles live in `css/bike-style.css`.

## How redirects work

- Admin pages check `$_SESSION['alogin']` and redirect to `admin-login.php` when it is missing.
- Portal account pages check `$_SESSION['login']` and redirect to `index.html` when it is missing.
- `logout.php` ends the session and sends admins to `admin-login.php` and everyone else to `index.html`.

## Known limitations

- The two logins use separate databases. The bike-site login uses the `project` database, and the portal login uses `bikerental`. A user created in one cannot sign in to the other.
- The `users` table for the bike-site login is not part of `carrental.sql`.
- After a bike-site login, `login.php` redirects to the static `index.html`, so the page does not show the user as signed in.
- Passwords in the bike-site login are stored as plain text. The portal and admin panel use MD5. Both are weak, so switch to `password_hash()` and `password_verify()` before putting this online.
- `register.php` puts raw form input into its SQL, and `login.php` only escapes it. Use prepared statements, as the portal pages do, before putting this online.
- `css/style.css` references about 15 images that are not in the project (for example `help_bg.jpg` and `facts_bg.jpg`). No current page uses them.
- `css/admin.css` and `js/admin.js` are replacements written for this project, so the admin panel does not match the original template exactly.

## Credits

The libraries used are Bootstrap 3, jQuery, Font Awesome, Owl Carousel, Slick, DataTables, bootstrap-select, bootstrap-fileinput and Chart.js.
